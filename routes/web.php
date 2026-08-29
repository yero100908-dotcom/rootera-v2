<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\AreaServiceController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\ServiceCategoryController;
use App\Http\Controllers\Admin\ServiceAreaController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\ContactManageController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\TechnologyController;
use App\Http\Controllers\Admin\ServiceSectorController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\SeoManageController;
use App\Http\Controllers\Admin\ProjectGalleryController;
use App\Http\Controllers\Admin\CityManageController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\ProgrammaticSeoController;

/*
|--------------------------------------------------------------------------
| Public Front-End Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/sitemap-main.xml', [SitemapController::class, 'main'])->name('sitemap.main');
Route::get('/sitemap-sectors.xml', [SitemapController::class, 'sectors'])->name('sitemap.sectors');
Route::get('/sitemap-cities.xml', [SitemapController::class, 'cities'])->name('sitemap.cities');
Route::get('/sitemap-districts.xml', [SitemapController::class, 'districts'])->name('sitemap.districts');
Route::get('/sitemap-services.xml', [SitemapController::class, 'services'])->name('sitemap.services');
Route::get('/sitemap-blog.xml', [SitemapController::class, 'blog'])->name('sitemap.blog');
Route::get('/sitemap-videos.xml', [SitemapController::class, 'videos'])->name('sitemap.videos');

Route::get('/layanan', [ServiceController::class, 'index'])->name('layanan');
Route::get('/layanan/{slug}', [ServiceController::class, 'show'])->name('layanan.show');

// New High-Intent Keyword-Rich Routes & Problem Hub
Route::get('/jasa-saluran-mampet', [AreaServiceController::class, 'indexDirectory'])->name('area-layanan');
Route::get('/jasa-saluran-mampet/{citySlug}', [AreaServiceController::class, 'showCity'])->name('area.city');
Route::get('/area-jasa-pipa-mampet/{regionSlug}', [AreaServiceController::class, 'showRegion'])->name('area.region');
Route::get('/layanan-pipa-mampet/{categorySlug}/{citySlug}', [ProgrammaticSeoController::class, 'show'])->name('layanan.city');
Route::get('/layanan-pipa-mampet/{categorySlug}/{citySlug}/{districtSlug}', [ProgrammaticSeoController::class, 'show'])->name('layanan.district');
Route::get('/solusi/{problemSlug}/{citySlug?}', [App\Http\Controllers\ProblemHubController::class, 'show'])->name('solusi.problem');

// Master B2B Commercial & Sector Programmatic Routes
Route::get('/layanan-b2b-komersial', [App\Http\Controllers\CommercialSectorController::class, 'index'])->name('b2b.index');
Route::get('/sektor-plumbing/{sectorSlug}', [App\Http\Controllers\CommercialSectorController::class, 'showSector'])->name('b2b.sector');
Route::get('/sektor-plumbing/{sectorSlug}/{citySlug}', [App\Http\Controllers\CommercialSectorController::class, 'showSectorCity'])->name('b2b.sector.city');
Route::get('/kontrak-maintenance-saluran/{sectorSlug}', [App\Http\Controllers\CommercialSectorController::class, 'maintenanceContract'])->name('b2b.contract');

// Public Property Category Direct-to-Consumer Routes
Route::get('/kategori-properti', [App\Http\Controllers\PropertyTypeController::class, 'index'])->name('property.index');
Route::get('/solusi-properti/{propertyTypeSlug}', [App\Http\Controllers\PropertyTypeController::class, 'show'])->name('property.show');
Route::get('/solusi-properti/{propertyTypeSlug}/{citySlug}', [App\Http\Controllers\PropertyTypeController::class, 'showCity'])->name('property.city');

// Legacy URL 301 Permanent Redirects for SEO Backlinks & Indexing
Route::redirect('/area-layanan', '/jasa-saluran-mampet', 301)->name('area.legacy.index');
Route::redirect('/area-layanan/{citySlug}', '/jasa-saluran-mampet/{citySlug}', 301)->name('area.legacy.city');
Route::redirect('/layanan/{categorySlug}/{citySlug}', '/layanan-pipa-mampet/{categorySlug}/{citySlug}', 301);
Route::redirect('/layanan/{categorySlug}/{citySlug}/{districtSlug}', '/layanan-pipa-mampet/{categorySlug}/{citySlug}/{districtSlug}', 301);
Route::redirect('/jasa-saluran-mampet/solo', '/jasa-saluran-mampet/surakarta', 301);

Route::get('/tentang-kami', [AboutController::class, 'index'])->name('tentang-kami');
Route::get('/tentang-kami/profil', [AboutController::class, 'profil'])->name('tentang-kami.profil');
Route::get('/tentang-kami/peralatan-teknologi', [AboutController::class, 'peralatanTeknologi'])->name('tentang-kami.peralatan-teknologi');
Route::get('/tentang-kami/portofolio-klien', [AboutController::class, 'portofolioKlien'])->name('tentang-kami.portofolio-klien');
Route::get('/tentang-kami/garansi-layanan', [AboutController::class, 'garansiLayanan'])->name('tentang-kami.garansi-layanan');
Route::redirect('/tentang-kami/faq', '/faq', 301)->name('tentang-kami.faq');
Route::get('/faq', [App\Http\Controllers\FaqController::class, 'index'])->name('faq.index');
Route::get('/faq/kategori/{categorySlug}', [App\Http\Controllers\FaqController::class, 'category'])->name('faq.category');
Route::get('/faq/{faqSlug}', [App\Http\Controllers\FaqController::class, 'show'])->name('faq.show');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/galeri-dokumentasi', [App\Http\Controllers\GalleryController::class, 'index'])->name('galeri');
Route::get('/galeri-dokumentasi/{slug}', [App\Http\Controllers\GalleryController::class, 'show'])->name('galeri.show');
Route::redirect('/galeri', '/galeri-dokumentasi', 301);
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

    // Gallery CRUD
    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
    Route::post('/gallery', [GalleryController::class, 'store'])->name('gallery.store');
    Route::put('/gallery/{gallery}', [GalleryController::class, 'update'])->name('gallery.update');
    Route::patch('/gallery/{gallery}/toggle', [GalleryController::class, 'toggleActive'])->name('gallery.toggle');
    Route::patch('/gallery/{gallery}/featured', [GalleryController::class, 'toggleFeatured'])->name('gallery.featured');
    Route::delete('/gallery/{gallery}', [GalleryController::class, 'destroy'])->name('gallery.destroy');

    // Contacts / Orders
    Route::get('/contacts', [ContactManageController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/{contact}', [ContactManageController::class, 'show'])->name('contacts.show');
    Route::put('/contacts/{contact}', [ContactManageController::class, 'update'])->name('contacts.update');
    Route::delete('/contacts/{contact}', [ContactManageController::class, 'destroy'])->name('contacts.destroy');

    // =====================================================
    // FAQ CRUD
    // =====================================================
    Route::get('/faqs', [FaqController::class, 'index'])->name('faqs.index');
    Route::post('/faqs', [FaqController::class, 'store'])->name('faqs.store');
    Route::put('/faqs/{faq}', [FaqController::class, 'update'])->name('faqs.update');
    Route::patch('/faqs/{faq}/toggle', [FaqController::class, 'toggleActive'])->name('faqs.toggle');
    Route::delete('/faqs/{faq}', [FaqController::class, 'destroy'])->name('faqs.destroy');

    // =====================================================
    // Technologies CRUD
    // =====================================================
    Route::get('/technologies', [TechnologyController::class, 'index'])->name('technologies.index');
    Route::post('/technologies', [TechnologyController::class, 'store'])->name('technologies.store');
    Route::put('/technologies/{technology}', [TechnologyController::class, 'update'])->name('technologies.update');
    Route::patch('/technologies/{technology}/toggle', [TechnologyController::class, 'toggleActive'])->name('technologies.toggle');
    Route::delete('/technologies/{technology}', [TechnologyController::class, 'destroy'])->name('technologies.destroy');

    // =====================================================
    // Service Sectors CRUD
    // =====================================================
    Route::get('/service-sectors', [ServiceSectorController::class, 'index'])->name('service-sectors.index');
    Route::post('/service-sectors', [ServiceSectorController::class, 'store'])->name('service-sectors.store');
    Route::put('/service-sectors/{serviceSector}', [ServiceSectorController::class, 'update'])->name('service-sectors.update');
    Route::patch('/service-sectors/{serviceSector}/toggle', [ServiceSectorController::class, 'toggleActive'])->name('service-sectors.toggle');
    Route::delete('/service-sectors/{serviceSector}', [ServiceSectorController::class, 'destroy'])->name('service-sectors.destroy');

    // =====================================================
    // Partners (Mitra) CRUD
    // =====================================================
    Route::get('/partners', [PartnerController::class, 'index'])->name('partners.index');
    Route::post('/partners', [PartnerController::class, 'store'])->name('partners.store');
    Route::put('/partners/{partner}', [PartnerController::class, 'update'])->name('partners.update');
    Route::delete('/partners/{partner}', [PartnerController::class, 'destroy'])->name('partners.destroy');

    // =====================================================
    // SEO Pages Metadata CRUD
    // =====================================================
    Route::get('/seo', [SeoManageController::class, 'index'])->name('seo.index');
    Route::put('/seo/{id}', [SeoManageController::class, 'update'])->name('seo.update');
    // =====================================================
    // Settings CRUD
    // =====================================================
    Route::get('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');

    // =====================================================
    // Project Galleries (Portofolio Proyek) CRUD
    // =====================================================
    Route::get('/project-galleries', [ProjectGalleryController::class, 'index'])->name('project-galleries.index');
    Route::post('/project-galleries', [ProjectGalleryController::class, 'store'])->name('project-galleries.store');
    Route::put('/project-galleries/{projectGallery}', [ProjectGalleryController::class, 'update'])->name('project-galleries.update');
    Route::patch('/project-galleries/{projectGallery}/toggle', [ProjectGalleryController::class, 'toggleActive'])->name('project-galleries.toggle');
    Route::delete('/project-galleries/{projectGallery}', [ProjectGalleryController::class, 'destroy'])->name('project-galleries.destroy');

    // =====================================================
    // Cities & Districts Management CRUD
    // =====================================================
    Route::get('/cities', [CityManageController::class, 'index'])->name('cities.index');
    Route::post('/cities', [CityManageController::class, 'store'])->name('cities.store');
    Route::put('/cities/{city}', [CityManageController::class, 'update'])->name('cities.update');
    Route::delete('/cities/{city}', [CityManageController::class, 'destroy'])->name('cities.destroy');
    Route::post('/cities/{city}/districts', [CityManageController::class, 'storeDistrict'])->name('cities.districts.store');
    Route::delete('/districts/{district}', [CityManageController::class, 'destroyDistrict'])->name('districts.destroy');

});
