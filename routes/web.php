<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\ServiceCategoryController;
use App\Http\Controllers\Admin\ServiceAreaController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\ContactManageController;

/*
|--------------------------------------------------------------------------
| Public Front-End Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/layanan', [ServiceController::class, 'index'])->name('layanan');
Route::get('/tentang-kami', [AboutController::class, 'index'])->name('tentang-kami');
Route::get('/area-layanan', [AreaController::class, 'index'])->name('area-layanan');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/kontak', [ContactController::class, 'index'])->name('kontak');
Route::post('/kontak', [ContactController::class, 'store'])->name('kontak.store');

/*
|--------------------------------------------------------------------------
| Auth Routes (Manual Login — NOT as root URL)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/login', function (\Illuminate\Http\Request $request) {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard');
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->onlyInput('email');
    });
});

Route::post('/logout', function (\Illuminate\Http\Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->middleware('auth')->name('logout');

/*
|--------------------------------------------------------------------------
| Admin Panel Routes (Protected by Auth)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    // Redirect /admin directly to dashboard
    Route::redirect('/', '/admin/dashboard');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Articles CRUD
    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');

    // Service Categories CRUD
    Route::get('/service-categories', [ServiceCategoryController::class, 'index'])->name('service-categories.index');
    Route::post('/service-categories', [ServiceCategoryController::class, 'store'])->name('service-categories.store');
    Route::put('/service-categories/{serviceCategory}', [ServiceCategoryController::class, 'update'])->name('service-categories.update');
    Route::delete('/service-categories/{serviceCategory}', [ServiceCategoryController::class, 'destroy'])->name('service-categories.destroy');

    // Service Areas CRUD
    Route::get('/service-areas', [ServiceAreaController::class, 'index'])->name('service-areas.index');
    Route::get('/service-areas/create', [ServiceAreaController::class, 'create'])->name('service-areas.create');
    Route::post('/service-areas', [ServiceAreaController::class, 'store'])->name('service-areas.store');
    Route::get('/service-areas/{serviceArea}/edit', [ServiceAreaController::class, 'edit'])->name('service-areas.edit');
    Route::put('/service-areas/{serviceArea}', [ServiceAreaController::class, 'update'])->name('service-areas.update');
    Route::delete('/service-areas/{serviceArea}', [ServiceAreaController::class, 'destroy'])->name('service-areas.destroy');

    // Gallery
    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
    Route::post('/gallery', [GalleryController::class, 'store'])->name('gallery.store');
    Route::patch('/gallery/{galleryPhoto}/toggle', [GalleryController::class, 'toggleActive'])->name('gallery.toggle');
    Route::delete('/gallery/{galleryPhoto}', [GalleryController::class, 'destroy'])->name('gallery.destroy');

    // Contacts / Orders
    Route::get('/contacts', [ContactManageController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/{contact}', [ContactManageController::class, 'show'])->name('contacts.show');
    Route::put('/contacts/{contact}', [ContactManageController::class, 'update'])->name('contacts.update');
    Route::delete('/contacts/{contact}', [ContactManageController::class, 'destroy'])->name('contacts.destroy');
});
