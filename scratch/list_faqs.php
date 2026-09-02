<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$allFaqs = App\Models\Faq::all();
echo "TOTAL FAQS IN DB: " . $allFaqs->count() . PHP_EOL;

foreach ($allFaqs as $faq) {
    echo "ID: {$faq->id} | CategoryID: {$faq->faq_category_id} | Slug: '{$faq->slug}' | Question: {$faq->question}" . PHP_EOL;
}
