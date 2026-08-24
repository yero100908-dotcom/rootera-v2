<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Models\Article;
use Carbon\Carbon;

class SyncYouTubeFeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'youtube:sync-feed {--channel-id= : YouTube Channel ID}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync latest YouTube videos from channel RSS feed into Article blog database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $channelId = $this->option('channel-id') ?: config('services.youtube.channel_id', env('YOUTUBE_CHANNEL_ID', 'UCKC8vr5ES6beRrSkgOq_4qw'));

        $this->info("Menghubungi YouTube RSS Feed untuk Channel ID: {$channelId}...");

        $feedUrl = "https://www.youtube.com/feeds/videos.xml?channel_id={$channelId}";

        try {
            $response = Http::timeout(15)->get($feedUrl);

            if ($response->failed()) {
                $this->error("Gagal mengambil feed XML YouTube. Status: " . $response->status());
                return Command::FAILURE;
            }

            $xml = @simplexml_load_string($response->body());

            if (!$xml || !isset($xml->entry)) {
                $this->warn("Tidak ada video yang ditemukan dalam feed RSS YouTube.");
                return Command::SUCCESS;
            }

            $createdCount = 0;
            $updatedCount = 0;

            foreach ($xml->entry as $entry) {
                $yt = $entry->children('yt', true);
                $videoId = (string) $yt->videoId;

                if (empty($videoId)) {
                    continue;
                }

                $media = $entry->children('media', true);
                $mediaGroup = $media->group ?? null;

                $rawTitle = (string) $entry->title;
                $published = (string) $entry->published;
                $description = $mediaGroup ? (string) $mediaGroup->description : '';

                // Sanitize title (remove hashtags like #shorts, #fypyoutube)
                $title = trim(preg_replace('/\s+/', ' ', preg_replace('/#\S+/', '', $rawTitle)));

                $thumbnailUrl = "https://i.ytimg.com/vi/{$videoId}/hqdefault.jpg";
                $embedUrl = "https://www.youtube-nocookie.com/embed/{$videoId}";

                $baseSlug = Str::slug($title);
                $slug = $baseSlug;

                // Ensure unique slug if new record
                $existingArticle = Article::where('youtube_video_id', $videoId)->first();
                if (!$existingArticle) {
                    $count = 1;
                    while (Article::where('slug', $slug)->exists()) {
                        $slug = $baseSlug . '-' . $count++;
                    }
                } else {
                    $slug = $existingArticle->slug;
                }

                $data = [
                    'title'            => $title,
                    'slug'             => $slug,
                    'post_type'        => 'video_guide',
                    'category'         => 'Edukasi & Video Panduan',
                    'thumbnail'        => $thumbnailUrl,
                    'video_embed_url'  => $embedUrl,
                    'excerpt'          => Str::limit(strip_tags($description), 200),
                    'content'          => '<div class="aspect-video w-full rounded-2xl overflow-hidden shadow-lg mb-6"><iframe class="w-full h-full" src="' . $embedUrl . '" allowfullscreen style="width:100%;height:420px;border:0;"></iframe></div><p>' . nl2br(e($description)) . '</p>',
                    'author'           => 'Rootera Plumbing',
                    'status'           => 'published',
                    'published_at'     => Carbon::parse($published),
                    'meta_title'       => $title . ' | Video Panduan Rootera Plumbing',
                    'meta_description' => Str::limit(strip_tags($description), 150),
                ];

                $article = Article::updateOrCreate(
                    ['youtube_video_id' => $videoId],
                    $data
                );

                if ($article->wasRecentlyCreated) {
                    $createdCount++;
                    $this->line("  ➕ Video Baru Diimpor: {$title}");
                } else {
                    $updatedCount++;
                    $this->line("  🔄 Video Diperbarui: {$title}");
                }
            }

            $total = $createdCount + $updatedCount;
            $this->info("✅ Penarikan Feed YouTube Selesai! Total: {$total} video ({$createdCount} baru, {$updatedCount} diperbarui).");
            Log::info("YouTube RSS Feed Sync Completed. {$createdCount} new, {$updatedCount} updated.");

            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error("Terjadi kesalahan saat memproses RSS Feed: " . $e->getMessage());
            Log::error("YouTube RSS Feed Sync Error: " . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
