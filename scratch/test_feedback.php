<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$faq = App\Models\Faq::first();
if ($faq) {
    App\Models\FaqFeedback::create([
        'faq_id'     => $faq->id,
        'is_helpful' => true,
        'reason'     => 'Sangat Membantu',
        'comment'    => 'Panduan sangat mudah dipahami dan membantu!',
        'ip_address' => '127.0.0.1',
    ]);

    App\Models\FaqFeedback::create([
        'faq_id'     => $faq->id,
        'is_helpful' => false,
        'reason'     => 'Penjelasan kurang jelas',
        'comment'    => 'Mohon tambahkan estimasi biaya untuk pipa diameter 4 inch.',
        'ip_address' => '127.0.0.1',
    ]);
}

echo "FEEDBACK COUNT: " . App\Models\FaqFeedback::count() . PHP_EOL;
