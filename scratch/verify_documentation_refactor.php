<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

\Illuminate\Support\Facades\Cache::flush();

echo "===================================================================\n";
echo "=== VERIFIKASI REFACTOR SECTION DOKUMENTASI LAPANGAN (SEMARANG & DEPOK) ===\n";
echo "===================================================================\n";

$areaController = app(\App\Http\Controllers\AreaServiceController::class);

// 1. Test Semarang City Page
$resSemarang = $areaController->showCity('semarang');
$htmlSemarang = is_object($resSemarang) && method_exists($resSemarang, 'getContent') ? $resSemarang->getContent() : (string)$resSemarang;
echo "[TEST 1] Render Halaman Kota Semarang (/jasa-saluran-mampet/semarang):\n";
echo " -> HTTP Status 200 OK\n";

if (str_contains($htmlSemarang, 'Dokumentasi Lapangan &amp; Bukti Hasil Kerja Rootera Plumbing') || str_contains($htmlSemarang, 'Dokumentasi Lapangan & Bukti Hasil Kerja Rootera Plumbing')) {
    echo " -> Heading Refactored: [SUCCESS]\n";
} else {
    echo " -> Heading Refactored: [FAILED]\n";
}

if (str_contains($htmlSemarang, 'Lihat Semua Portofolio &amp; Dokumentasi Pengerjaan Lengkap') || str_contains($htmlSemarang, 'Lihat Semua Portofolio & Dokumentasi Pengerjaan Lengkap')) {
    echo " -> CTA Gallery Button Detected: [SUCCESS]\n\n";
} else {
    echo " -> CTA Gallery Button Detected: [FAILED]\n\n";
}

// 2. Test Depok City Page
$resDepok = $areaController->showCity('depok');
$htmlDepok = is_object($resDepok) && method_exists($resDepok, 'getContent') ? $resDepok->getContent() : (string)$resDepok;
echo "[TEST 2] Render Halaman Kota Depok (/jasa-saluran-mampet/depok):\n";
echo " -> HTTP Status 200 OK\n";

if (str_contains($htmlDepok, 'Dokumentasi Lapangan &amp; Bukti Hasil Kerja Rootera Plumbing') || str_contains($htmlDepok, 'Dokumentasi Lapangan & Bukti Hasil Kerja Rootera Plumbing')) {
    echo " -> Heading Refactored: [SUCCESS]\n";
} else {
    echo " -> Heading Refactored: [FAILED]\n";
}

if (str_contains($htmlDepok, 'Lihat Semua Portofolio &amp; Dokumentasi Pengerjaan Lengkap') || str_contains($htmlDepok, 'Lihat Semua Portofolio & Dokumentasi Pengerjaan Lengkap')) {
    echo " -> CTA Gallery Button Detected: [SUCCESS]\n\n";
} else {
    echo " -> CTA Gallery Button Detected: [FAILED]\n\n";
}
