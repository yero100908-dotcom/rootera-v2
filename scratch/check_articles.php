<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$articles = App\Models\Article::take(10)->get();

echo "TOTAL ARTIKEL: " . $articles->count() . "\n\n";

foreach ($articles as $a) {
    echo "ID: " . $a->id . "\n";
    echo "Title: " . $a->title . "\n";
    echo "Slug: " . $a->slug . "\n";
    echo "YouTube ID: " . ($a->youtube_video_id ?? 'N/A') . "\n";
    echo "Thumbnail URL: " . $a->thumbnail_url . "\n";
    echo "URL Detail Blog: " . route('blog.show', $a->slug) . "\n";
    echo "---------------------------------------------\n";
}
