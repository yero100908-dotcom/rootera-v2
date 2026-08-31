<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class WebpConverterService
{
    /**
     * Convert an uploaded image file to WebP format and store it in the target folder.
     * SVG files remain as vector SVG.
     *
     * @param UploadedFile $file
     * @param string $folder Target subfolder in storage (e.g., 'articles', 'galleries/thumbnails')
     * @param string $disk Storage disk (default: 'public')
     * @param int $quality Compression quality 80-85%
     * @return string Relative path stored in DB (e.g. 'articles/filename.webp')
     */
    public function convertAndStore(UploadedFile $file, string $folder, string $disk = 'public', int $quality = 85): string
    {
        $extension = strtolower($file->getClientOriginalExtension());
        $mimeType  = $file->getMimeType();

        // 1. Preserve vector SVG files as-is
        if ($extension === 'svg' || $mimeType === 'image/svg+xml') {
            return $file->store($folder, $disk);
        }

        // 2. Build clean slugified filename with timestamp and random string
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $cleanName    = Str::slug($originalName);
        if (empty($cleanName)) {
            $cleanName = 'img_' . time();
        }

        $webpFilename   = $cleanName . '_' . time() . '_' . Str::random(6) . '.webp';
        $relativeFolder = trim($folder, '/');
        
        $storageDir = storage_path("app/public/{$relativeFolder}");
        if ($disk !== 'public') {
            $storageDir = Storage::disk($disk)->path($relativeFolder);
        }

        if (!file_exists($storageDir)) {
            mkdir($storageDir, 0755, true);
        }

        $targetPath = $storageDir . '/' . $webpFilename;

        // 3. Convert to WebP using native GD library
        if (function_exists('imagecreatefromstring') && function_exists('imagewebp')) {
            $rawContent = file_get_contents($file->getRealPath());
            $img = @imagecreatefromstring($rawContent);

            if ($img !== false) {
                // Preserve PNG & WebP transparency channel
                imagealphablending($img, false);
                imagesavealpha($img, true);

                imagewebp($img, $targetPath, $quality);
                imagedestroy($img);

                return $relativeFolder . '/' . $webpFilename;
            }
        }

        // Fallback: store standard file if GD conversion fails
        return $file->store($relativeFolder, $disk);
    }

    /**
     * Delete an existing file from storage if present.
     */
    public function deleteIfExists(?string $path, string $disk = 'public'): void
    {
        if (empty($path)) {
            return;
        }

        // Skip static asset paths or external HTTP links
        if (Str::startsWith($path, ['http://', 'https://', 'images/', 'assets/'])) {
            return;
        }

        if (Storage::disk($disk)->exists($path)) {
            Storage::disk($disk)->delete($path);
        }
    }
}
