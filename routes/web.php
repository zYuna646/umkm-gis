<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\accountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\artikelController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontPageController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\JenisUsahaController;
use App\Http\Controllers\kategoriArtikelController;
use App\Http\Controllers\KlasifikasiUsahaController;
use App\Http\Controllers\MainSliderController;
use App\Http\Controllers\ReviewSliderController;
use App\Http\Controllers\UMKMController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [FrontPageController::class, 'index'])->name('home');
Route::get('/contact', [FrontPageController::class, 'contact'])->name('contact');
Route::get('/catalog', [FrontPageController::class, 'catalog'])->name('catalog');
Route::get('/umkm', [FrontPageController::class, 'umkm'])->name('umkm');
Route::get('/catalog/artikel/{id}', [FrontPageController::class, 'artikelDetail'])->name('artikel.detail');
Route::get('/catalog/umkm/{id}', [FrontPageController::class, 'umkmDetail'])->name('umkm.detail');
Route::get('/kategori', [FrontPageController::class, 'kategori'])->name('kategori');

Route::get('/catalog/product/{slug}', [FrontPageController::class, 'productDetail'])->name('product.detail');

/* Authentication Routes... */
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Auth::routes([
    'register' => false, // Register Routes...
    'reset' => false, // Reset Password Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::middleware(['auth', 'login-check'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/category', [CategoryController::class, 'index'])->name('admin.category');
    Route::get('/admin/category/add', [CategoryController::class, 'create'])->name('admin.category.create');
    Route::post('/admin/category/store', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('/admin/category/{id}/edit', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::put('/admin/category/{id}/update', [CategoryController::class, 'update'])->name('admin.category.update');
    Route::delete('/admin/category/{id}/delete', [CategoryController::class, 'destroy'])->name('admin.category.delete');

    Route::get('/admin/user', [accountController::class, 'index'])->name('admin.user');
    Route::get('/admin/user/add', [accountController::class, 'create'])->name('admin.user.create');
    Route::post('/admin/user/store', [accountController::class, 'store'])->name('admin.user.store');
    Route::get('/admin/user/{id}/edit', [accountController::class, 'edit'])->name('admin.user.edit');
    Route::put('/admin/user/{id}/update', [accountController::class, 'update'])->name('admin.user.update');
    Route::delete('/admin/user/{id}/delete', [accountController::class, 'destroy'])->name('admin.user.delete');

    Route::get('/admin/jenis_usaha', [JenisUsahaController::class, 'index'])->name('admin.JenisUsaha');
    Route::get('/admin/jenis_usaha/add', [JenisUsahaController::class, 'create'])->name('admin.JenisUsaha.create');
    Route::post('/admin/jenis_usaha/store', [JenisUsahaController::class, 'store'])->name('admin.JenisUsaha.store');
    Route::get('/admin/jenis_usaha/{id}/edit', [JenisUsahaController::class, 'edit'])->name('admin.JenisUsaha.edit');
    Route::put('/admin/jenis_usaha/{id}/update', [JenisUsahaController::class, 'update'])->name('admin.JenisUsaha.update');
    Route::delete('/admin/jenis_usaha/{id}/delete', [JenisUsahaController::class, 'destroy'])->name('admin.JenisUsaha.delete');

    Route::get('/admin/klasifikasi_usaha', [KlasifikasiUsahaController::class, 'index'])->name('admin.KlasifikasiUsaha');
    Route::get('/admin/klasifikasi_usaha/add', [KlasifikasiUsahaController::class, 'create'])->name('admin.KlasifikasiUsaha.create');
    Route::post('/admin/klasifikasi_usaha/store', [KlasifikasiUsahaController::class, 'store'])->name('admin.KlasifikasiUsaha.store');
    Route::get('/admin/klasifikasi_usaha/{id}/edit', [KlasifikasiUsahaController::class, 'edit'])->name('admin.KlasifikasiUsaha.edit');
    Route::put('/admin/klasifikasi_usaha/{id}/update', [KlasifikasiUsahaController::class, 'update'])->name('admin.KlasifikasiUsaha.update');
    Route::delete('/admin/klasifikasi_usaha/{id}/delete', [KlasifikasiUsahaController::class, 'destroy'])->name('admin.KlasifikasiUsaha.delete');


    Route::get('/admin/umkm', [UMKMController::class, 'index'])->name('admin.umkm');
    Route::post('/admin/umkm/report', [UMKMController::class, 'report'])->name('admin.umkm.report');
    Route::post('/admin/umkm/pengajuan/report', [UMKMController::class, 'pengajuan'])->name('admin.umkm.permintaan.report');
    Route::get('/admin/umkm/permintaan', [UMKMController::class, 'permintaan'])->name('admin.umkm.permintaan');
    Route::put('/admin/umkm/permintaan/{id}/{status}/{message}', [UMKMController::class, 'status'])->name('admin.umkm.permintaan.edit');
    Route::post('/admin/umkm/import', [UMKMController::class, 'import'])->name('admin.umkm.import');
    Route::get('/admin/umkm/add', [UMKMController::class, 'create'])->name('admin.umkm.create');
    Route::post('/admin/umkm/store', [UMKMController::class, 'store'])->name('admin.umkm.store');
    Route::get('/admin/umkm/{id}/edit', [UMKMController::class, 'edit'])->name('admin.umkm.edit');
    Route::put('/admin/umkm/{id}/update', [UMKMController::class, 'update'])->name('admin.umkm.update');
    Route::delete('/admin/umkm/{id}/delete', [UMKMController::class, 'destroy'])->name('admin.umkm.delete');
    Route::get('/admin/umkm/download', [UMKMController::class, 'download'])->name('admin.umkm.download');


    Route::get('/admin/kategori_artikel', [kategoriArtikelController::class, 'index'])->name('admin.KategoriArtikel');
    Route::get('/admin/kategori_artikel/add', [kategoriArtikelController::class, 'create'])->name('admin.KategoriArtikel.create');
    Route::post('/admin/kategori_artikel/store', [kategoriArtikelController::class, 'store'])->name('admin.KategoriArtikel.store');
    Route::get('/admin/kategori_artikel/{id}/edit', [kategoriArtikelController::class, 'edit'])->name('admin.KategoriArtikel.edit');
    Route::put('/admin/kategori_artikel/{id}/update', [kategoriArtikelController::class, 'update'])->name('admin.KategoriArtikel.update');
    Route::delete('/admin/kategori_artikel/{id}/delete', [kategoriArtikelController::class, 'destroy'])->name('admin.KategoriArtikel.delete');
    
    Route::get('/admin/artikel', [artikelController::class, 'index'])->name('admin.artikel');
    Route::get('/admin/artikel/add', [artikelController::class, 'create'])->name('admin.artikel.create');
    Route::post('/admin/artikel/store', [artikelController::class, 'store'])->name('admin.artikel.store');
    Route::get('/admin/artikel/{id}/edit', [artikelController::class, 'edit'])->name('admin.artikel.edit');
    Route::put('/admin/artikel/{id}/update', [artikelController::class, 'update'])->name('admin.artikel.update');
    Route::delete('/admin/artikel/{id}/delete', [artikelController::class, 'destroy'])->name('admin.artikel.delete');

    Route::get('/admin/catalog', [CatalogController::class, 'index'])->name('admin.catalog');
    Route::get('/admin/catalog/add', [CatalogController::class, 'create'])->name('admin.catalog.create');
    Route::post('/admin/catalog/store', [CatalogController::class, 'store'])->name('admin.catalog.store');
    Route::get('/admin/catalog/{id}/show', [CatalogController::class, 'show'])->name('admin.catalog.show');
    Route::get('/admin/catalog/{id}/edit', [CatalogController::class, 'edit'])->name('admin.catalog.edit');
    Route::put('/admin/catalog/{id}/update', [CatalogController::class, 'update'])->name('admin.catalog.update');
    Route::delete('/admin/catalog/{id}/delete', [CatalogController::class, 'destroy'])->name('admin.catalog.delete');
    Route::delete('/admin/catalog/{id}/delete-image', [CatalogController::class, 'destroyImage'])->name('admin.catalog.delete-image');

    Route::get('/admin/gallery', [CatalogController::class, 'gallery'])->name('admin.gallery');


    Route::get('/admin/video', [VideoController::class, 'index'])->name('admin.video');
    Route::get('/admin/video/add', [VideoController::class, 'create'])->name('admin.video.create');
    Route::post('/admin/video/store', [VideoController::class, 'store'])->name('admin.video.store');
    Route::delete('/admin/video/{id}/delete', [VideoController::class, 'destroy'])->name('admin.video.delete');

    Route::get('/admin/information', [InformationController::class, 'index'])->name('admin.information');
    Route::get('/admin/information/add', [InformationController::class, 'create'])->name('admin.information.create');
    Route::post('/admin/information/store', [InformationController::class, 'store'])->name('admin.information.store');
    Route::delete('/admin/information/{id}/delete', [InformationController::class, 'destroy'])->name('admin.information.delete');

    Route::get('/admin/main-slider', [MainSliderController::class, 'index'])->name('admin.main-slider');
    Route::get('/admin/main-slider/add', [MainSliderController::class, 'create'])->name('admin.main-slider.create');
    Route::post('/admin/main-slider/store', [MainSliderController::class, 'store'])->name('admin.main-slider.store');
    Route::get('/admin/main-slider/{id}/edit', [MainSliderController::class, 'edit'])->name('admin.main-slider.edit');
    Route::put('/admin/main-slider/{id}/update', [MainSliderController::class, 'update'])->name('admin.main-slider.update');
    Route::delete('/admin/main-slider/{id}/delete', [MainSliderController::class, 'destroy'])->name('admin.main-slider.delete');

    Route::get('/admin/review-slider', [ReviewSliderController::class, 'index'])->name('admin.review-slider');
    Route::get('/admin/review-slider/add', [ReviewSliderController::class, 'create'])->name('admin.review-slider.create');
    Route::post('/admin/review-slider/store', [ReviewSliderController::class, 'store'])->name('admin.review-slider.store');
    Route::get('/admin/review-slider/{id}/edit', [ReviewSliderController::class, 'edit'])->name('admin.review-slider.edit');
    Route::put('/admin/review-slider/{id}/update', [ReviewSliderController::class, 'update'])->name('admin.review-slider.update');
    Route::delete('/admin/review-slider/{id}/delete', [ReviewSliderController::class, 'destroy'])->name('admin.review-slider.delete');

    Route::get('/admin/about-us', [AboutUsController::class, 'index'])->name('admin.about-us');
    Route::put('/admin/about-us/{id}/update', [AboutUsController::class, 'update'])->name('admin.about-us.update');

    Route::get('/admin/account-setting', [AdminController::class, 'accountSetting'])->name('admin.account-setting');
    Route::put('/admin/change-password/{id}', [AdminController::class, 'changePassword'])->name('admin.change-password');
    Route::put('/admin/change-information/{id}', [AdminController::class, 'changeInformation'])->name('admin.change-information');
});