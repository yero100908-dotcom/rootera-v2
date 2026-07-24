<?php
$files = glob('resources/views/admin/**/*.blade.php');
$count = 0;
foreach($files as $f) {
    $content = file_get_contents($f);
    $orig = $content;
    
    // Modal background
    $content = str_replace(
        'style="position:fixed;inset:0;background:rgba(0,0,0,0.5);z-index:50;display:none;align-items:center;justify-content:center;padding:1rem"',
        'class="fixed inset-0 bg-slate-900/50 z-50 hidden items-center justify-center p-4"',
        $content
    );
    // Modal container 500px
    $content = str_replace(
        'style="background:#fff;border-radius:16px;box-shadow:0 20px 25px -5px rgba(0,0,0,0.1);width:100%;max-width:500px;overflow:hidden"',
        'class="bg-white rounded-2xl shadow-xl w-full max-w-lg mx-auto overflow-hidden"',
        $content
    );
    // Modal container 600px
    $content = str_replace(
        'style="background:#fff;border-radius:16px;box-shadow:0 20px 25px -5px rgba(0,0,0,0.1);width:100%;max-width:600px;overflow:hidden"',
        'class="bg-white rounded-2xl shadow-xl w-full max-w-xl mx-auto overflow-hidden"',
        $content
    );
    // Modal header
    $content = str_replace(
        'style="display:flex;align-items:center;justify-content:space-between;padding:1.25rem 1.5rem;border-bottom:1px solid #e5e7eb"',
        'class="flex items-center justify-between p-4 sm:p-6 border-b border-slate-200"',
        $content
    );
    // Modal form padding
    $content = preg_replace(
        '/<form([^>]*?)style="padding:1\.5rem"/',
        '<form$1class="p-4 sm:p-6"',
        $content
    );
    // Buttons Edit
    $content = str_replace(
        'class="text-slate-500 hover:text-emerald-600 font-medium text-sm transition-colors"',
        'class="text-slate-600 bg-slate-100 hover:bg-emerald-100 hover:text-emerald-700 font-medium text-sm transition-colors px-3 py-2 rounded-lg"',
        $content
    );
    // Buttons Hapus
    $content = str_replace(
        'class="text-slate-400 hover:text-rose-600 font-medium text-sm transition-colors"',
        'class="text-slate-600 bg-slate-100 hover:bg-rose-100 hover:text-rose-700 font-medium text-sm transition-colors px-3 py-2 rounded-lg"',
        $content
    );
    // Buttons Batal
    $content = str_replace(
        'style="padding:.5rem 1rem;border:1px solid #e5e7eb;border-radius:8px;background:#fff;color:#6b7280;font-size:.9rem;font-weight:500;cursor:pointer"',
        'class="px-4 py-2 border border-slate-200 rounded-lg bg-white text-slate-500 hover:bg-slate-50 text-sm font-medium transition-colors"',
        $content
    );
    // Buttons Simpan
    $content = str_replace(
        'style="padding:.5rem 1rem;border:none;border-radius:8px;background:#169F81;color:#fff;font-size:.9rem;font-weight:500;cursor:pointer"',
        'class="px-4 py-2 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium transition-colors"',
        $content
    );

    if ($orig !== $content) {
        file_put_contents($f, $content);
        echo "Updated: $f\n";
        $count++;
    }
}
echo "Total updated: $count\n";
