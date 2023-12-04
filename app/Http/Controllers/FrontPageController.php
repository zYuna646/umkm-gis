<?php

namespace App\Http\Controllers;

use App\Charts\BantuanChart;
use App\Charts\JenisUsahaChart;
use App\Charts\KecamatanChart;
use App\Charts\KlasifikasiUsahaChart;
use App\Charts\PendapatanChart;
use App\Charts\TenagaKerjaChart;
use App\Charts\TotalUMKMChart;
use App\Models\AboutUs;
use App\Models\artikel;
use App\Models\Catalog;
use App\Models\Category;
use App\Models\Information;
use App\Models\JenisUsaha;
use App\Models\KategoriArtikel;
use App\Models\MainSlider;
use App\Models\ReviewSlider;
use App\Models\UMKM;
use App\Models\Video;

class FrontPageController extends Controller
{
    public function index()
    {
        $umkms = UMKM::where('is_Umum', true)
            ->where('status', 'terima')
            ->get();

        $artikels = artikel::all();
        $kategoriArtikel = KategoriArtikel::all();
        return view('front.home', [
            'title' => 'Home',
            'reviewSliders' => ReviewSlider::latest()->get(),
            'aboutUs' => AboutUs::first(),
            'galleries' => Catalog::latest()->take(10)->get(),
            'categories' => Category::orderBy('name', 'ASC')->take(5)->get(),
            'videos' => Video::latest()->take(3)->get(),
            'informations' => Information::latest()->get(),
            'umkms' => $umkms,
            'artikels' => $artikels,
            'kategori' => $kategoriArtikel
        ]);
    }

    public function contact()
    {
        return view('front.contact', [
            'title' => 'Contact',
            'mainSliders' => MainSlider::latest()->get(),
            'categories' => KategoriArtikel::orderBy('name', 'ASC')->get(),
            'products' => '',
        ]);
    }

    public function dashboard(
        PendapatanChart $pendapatanChart,
        TotalUMKMChart $totalUMKMChart,
        TenagaKerjaChart $tenagaKerjaChart,
        BantuanChart $bantuanChart,
        JenisUsahaChart $jenisUsahaChart,
        KlasifikasiUsahaChart $klasifikasiUsahaChart,
        KecamatanChart $kecamatanChart
    ) {
        return view('front.dashboard', [
            'title' => 'dashboard',
            'pendapatanChart' => $pendapatanChart->build(),
            'totalUMKMChart' => $totalUMKMChart->build(),
            'tenagaKerjaChart' => $tenagaKerjaChart->build(),
            'bantuanChart' => $bantuanChart->build(),
            'jenisUsahaChart' => $jenisUsahaChart->build(),
            'klasifikasiUsahaChart' => $klasifikasiUsahaChart->build(),
            'kecamatanChart' => $kecamatanChart->build()
        ]);
    }

    public function catalog()
    {
        $catalogs = artikel::latest()->filter(request(['search', 'category_product']))->paginate(16)->withQueryString();


        return view('front.catalog', [
            'title' => 'Catalog',
            'mainSliders' => MainSlider::latest()->get(),
            'categories' => KategoriArtikel::orderBy('name', 'ASC')->get(),
            'products' => $catalogs,
        ]);
    }

    public function umkm()
    {
        $catalogs = UMKM::where('is_Umum', true)
            ->where('status', 'terima')->get();

        return view('front.umkm', [
            'title' => 'Catalog',
            'mainSliders' => MainSlider::latest()->get(),
            'categories' => JenisUsaha::orderBy('name', 'ASC')->get(),
            'klasifikasiUsahas' => JenisUsaha::orderBy('name', 'ASC')->get(),
            'umkms' => $catalogs,
        ]);
    }

    public function Kategori()
    {
        return view('front.catalog', [
            'title' => 'Artikel',
            'mainSliders' => MainSlider::latest()->get(),
            'categories' => KategoriArtikel::all(),
            'products' => artikel::all(),
        ]);
    }

    public function productDetail($slug)
    {
        $product = Catalog::where('slug', $slug)->firstorfail();

        $no_hp = AboutUs::pluck('phone')->first(); // Assuming the phone number has '-' characters

        // Remove '-' characters from the phone number
        $no_hp = str_replace('-', '', $no_hp);

        $related_products = Catalog::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id) // Exclude the current product
            ->latest()->take('4')->get();

        return view('front.product-detail', [
            'title' => 'Product | ' . $product->name,
            'mainSliders' => MainSlider::latest()->get(),
            'no_hp' => $no_hp,
            'product' => $product,
            'related_products' => $related_products
        ]);
    }

    public function artikelDetail($id)
    {
        $artikel = artikel::findOrFail($id);
        return view('front.artikel-detail', [
            'title' => 'Artikel | ' . $artikel->name,
            'mainSliders' => MainSlider::latest()->get(),
            'artikel' => $artikel,
        ]);
    }

    public function umkmDetail($id)
    {
        $umkm = UMKM::findOrFail($id);
        return view('front.umkm-detail', [
            'title' => 'Artikel | ' . $umkm->nama_pemilik,
            'mainSliders' => MainSlider::latest()->get(),
            'umkm' => $umkm,
        ]);
    }
}
