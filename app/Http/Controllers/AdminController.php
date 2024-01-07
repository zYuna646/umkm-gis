<?php

namespace App\Http\Controllers;

use App\Models\artikel;
use App\Models\Catalog;
use App\Models\Category;
use App\Models\Information;
use App\Models\JenisUsaha;
use App\Models\KategoriArtikel;
use App\Models\KlasifikasiUsaha;
use App\Models\UMKM;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use App\Charts\BantuanChart;
use App\Charts\JenisUsahaChart;
use App\Charts\KecamatanChart;
use App\Charts\KlasifikasiUsahaChart;
use App\Charts\PendapatanChart;
use App\Charts\TenagaKerjaChart;
use App\Charts\TotalUMKMChart;
use App\Charts\BantuanChart_;
use App\Charts\JenisUsahaChart_;
use App\Charts\KecamatanChart_;
use App\Charts\KlasifikasiUsahaChart_;
use App\Charts\PendapatanChart_;
use App\Charts\TenagaKerjaChart_;
use App\Charts\TotalUMKMChart_;

class AdminController extends Controller
{
    public function index(  PendapatanChart $pendapatanChart,
    TotalUMKMChart $totalUMKMChart,
    TenagaKerjaChart $tenagaKerjaChart,
    BantuanChart $bantuanChart,
    JenisUsahaChart $jenisUsahaChart,
    KlasifikasiUsahaChart $klasifikasiUsahaChart,
    KecamatanChart $kecamatanChart,
    
    PendapatanChart_ $pendapatanChart_,
    TotalUMKMChart_ $totalUMKMChart_,
    TenagaKerjaChart_ $tenagaKerjaChart_,
    BantuanChart_ $bantuanChart_,
    JenisUsahaChart_ $jenisUsahaChart_,
    KlasifikasiUsahaChart_ $klasifikasiUsahaChart_,
    KecamatanChart_ $kecamatanChart_
    
    )
    {
        $count_catalog = artikel::count();
        $count_category = UMKM::count();
        $count_video = JenisUsaha::count();
        $count_information = KlasifikasiUsaha::count();
        $count_kategori = KategoriArtikel::count();

        $latest_products = Catalog::orderBy('created_at', 'desc')->take(5)->get();
        $latest_video = Video::orderBy('created_at', 'desc')->take(1)->first();
        $latest_informations = Information::orderBy('created_at', 'desc')->take(3)->get();
        $umkm = UMKM::all();
        return view('admin.dashboard', [
            'title' => 'Dashboard',
            'subtitle' => '',
            'active' => 'dashboard',
            'count_catalog' => $count_catalog,
            'count_category' => $count_category,
            'count_video' => $count_video,
            'count_kategori' => $count_kategori,
            'count_information' => $count_information,
            'latest_products' => $latest_products,
            'latest_video' => $latest_video,
            'latest_informations' => $latest_informations,
            'umkms' => $umkm,
            'pendapatanChart' => $pendapatanChart->build(),
            'totalUMKMChart' => $totalUMKMChart->build(),
            'tenagaKerjaChart' => $tenagaKerjaChart->build(),
            'bantuanChart' => $bantuanChart->build(),
            'jenisUsahaChart' => $jenisUsahaChart->build(),
            'klasifikasiUsahaChart' => $klasifikasiUsahaChart->build(),
            'kecamatanChart' => $kecamatanChart->build(),
            'pendapatanChart_' => $pendapatanChart_->build(),
            'totalUMKMChart_' => $totalUMKMChart_->build(),
            'tenagaKerjaChart_' => $tenagaKerjaChart_->build(),
            'bantuanChart_' => $bantuanChart_->build(),
            'jenisUsahaChart_' => $jenisUsahaChart_->build(),
            'klasifikasiUsahaChart_' => $klasifikasiUsahaChart_->build(),
            'kecamatanChart_' => $kecamatanChart_->build()
            
        ]);
    }

    public function accountSetting()
    {
        return view('admin.settings.account-setting.index', [
            'title' => 'Account Setting',
            'subtitle' => '',
            'active' => 'account-setting',
        ]);
    }

    public function changePassword(Request $request, $id)
    {
        $this->validate($request, [
            'current_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_new_password' => 'required|same:new_password',
        ], [
            'current_password.required' => 'Current Password is required',
            'new_password.required' => 'New Password is required',
            'new_password.min' => 'New Password must be at least 8 characters',
            'confirm_new_password.required' => 'Confirm New Password is required',
            'confirm_new_password.same' => 'Confirm New Password must be same with New Password',
        ]);

        $user = User::findOrFail($id);

        if (password_verify($request->current_password, $user->password)) {
            $user->update([
                'password' => bcrypt($request->new_password),
            ]);

            return redirect()->back()->with('success', 'Password has been changed');
        } else {
            return redirect()->back()->with('error', 'Current Password is wrong');
        }
    }

    public function changeInformation(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
        ], [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email must be a valid email address',
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Information has been changed');
    }
}
