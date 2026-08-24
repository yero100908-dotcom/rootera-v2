<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gallery;
use Illuminate\Support\Str;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonPath = resource_path('data/portfolio.json');

        if (!file_exists($jsonPath)) {
            $this->command->error("File portfolio.json not found at: {$jsonPath}");
            return;
        }

        $items = json_decode(file_get_contents($jsonPath), true);

        if (!$items) {
            $this->command->error("Failed to parse portfolio.json");
            return;
        }

        // Purge legacy dummy items to ensure 100% genuine real field documentation
        Gallery::query()->delete();

        foreach ($items as $index => $item) {
            $mediaType = $item['mediaType'] ?? ($item['fileType'] ?? 'image');
            $fileName = $item['fileName'];
            
            if ($mediaType === 'video' || Str::endsWith($fileName, '.mp4')) {
                // If it's the initial video, check where it exists or default to videos/dokumentasi/
                if (file_exists(public_path('videos/dokumentasi/' . $fileName))) {
                    $mediaPath = 'videos/dokumentasi/' . $fileName;
                } elseif (file_exists(public_path('images/dokumentasi/' . $fileName))) {
                    $mediaPath = 'images/dokumentasi/' . $fileName;
                } else {
                    $mediaPath = 'videos/dokumentasi/' . $fileName;
                }
                
                if (!empty($item['thumbnail'])) {
                    $thumbnailPath = 'images/dokumentasi/' . $item['thumbnail'];
                } else {
                    $thumbnailPath = 'images/dokumentasi/inspeksi-cctv-saluran-kloset-mampet.webp';
                }
            } else {
                $mediaPath = 'images/dokumentasi/' . $fileName;
                $thumbnailPath = !empty($item['thumbnail']) ? 'images/dokumentasi/' . $item['thumbnail'] : $mediaPath;
            }

            // Before image path
            $beforePath = null;
            if (!empty($item['beforeFileName'])) {
                $beforePath = 'images/dokumentasi/' . $item['beforeFileName'];
            }

            // Related service URL mapping
            $serviceUrl = match($item['serviceType'] ?? '') {
                'Kitchen Sink & Drainase' => '/layanan',
                'Floor Drain' => '/layanan',
                'Saluran Kloset / Toilet' => '/layanan',
                'Talang Air / Gutter' => '/layanan',
                'Bak Kontrol & Grease Trap' => '/layanan',
                'Inspeksi Kamera CCTV' => '/layanan',
                default => '/layanan',
            };

            if (in_array('b2b_landing', $item['placement'] ?? [])) {
                $serviceUrl = '/layanan-b2b-komersial';
            }

            $isFeatured = in_array('home_featured', $item['placement'] ?? []) || in_array('home_hero', $item['placement'] ?? []);

            Gallery::updateOrCreate(
                ['slug' => Str::slug($item['title'])],
                [
                    'title'               => $item['title'],
                    'slug'                => Str::slug($item['title']),
                    'category'            => $item['category'],
                    'media_type'          => $mediaType,
                    'thumbnail_path'      => $thumbnailPath,
                    'media_file_path'     => $mediaPath,
                    'external_media_url'  => null,
                    'before_image_path'   => $beforePath,
                    'location_tag'        => $item['location'] ?? 'Jabodetabek',
                    'related_service_url' => $serviceUrl,
                    'description'         => $item['description'] ?? $item['altText'],
                    'is_featured'         => $isFeatured,
                    'is_active'           => true,
                    'sort_order'          => $index + 1,
                ]
            );
        }

        $this->command->info('GallerySeeder: successfully seeded ' . count($items) . ' real documentation items.');
    }
}
