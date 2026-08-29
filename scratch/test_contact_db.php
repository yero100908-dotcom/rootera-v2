<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$contact = \App\Models\Contact::create([
    'name' => 'Budi Test Automated',
    'phone' => '081234567890',
    'email' => 'budi.test@example.com',
    'service_type' => 'Pelancaran Wastafel Dapur',
    'area' => 'Jakarta',
    'message' => 'Test pesan otomatis untuk pengujian form kontak.',
]);

echo "✅ Contact Created ID: {$contact->id}\n";
echo "✅ Saved Name: {$contact->name}\n";
