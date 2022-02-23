<?php

namespace App\Http\Controllers\DataTable;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Spatie\Activitylog\Models\Activity;

class DataTableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function dataPengguna()
    {
        $users = User::all()->sortByDesc('id');
        return DataTables::of($users)
            ->editColumn('username', function($user){
                return Str::title($user->username);
            })
            ->editColumn('role', function ($user) {
                if ($user->role == 'admin') {
                    return '<span class="badge badge-primary">Admin</span>';
                } elseif ($user->role == 'manager') {
                    return '<span class="badge badge-warning">Manager</span>';
                } else {
                    return '<span class="badge badge-secondary">'.Str::title($user->role).'</span>';
                }
            })
            ->addColumn('created', function ($user) {
                return Carbon::parse($user->created_at)->diffForHumans();
            })
            ->addColumn('action', function ($user) {
                return '
                <button id="btn-user-edit" data-id="'.$user->id.'"  class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                <button id="btn-user-delete" data-id="'.$user->id.'"  class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                ';
            })
            ->rawColumns(['action', 'role'])
            ->make(true);
    }

    public function dataMenu()
    {
        $menus = Menu::all()->sortByDesc('id');
        return DataTables::of($menus)
            ->editColumn('nama_menu', function($menu){
                return Str::title($menu->nama_menu);
            })
            ->editColumn('harga', function($menu){
                return 'Rp. '.number_format($menu->harga, 0, ',', '.');
            })
            ->editColumn('stok', function($menu){
                return $menu->stok.' pcs / porsi';
            })
            ->editColumn('deskripsi', function($menu){
                return Str::limit($menu->deskripsi, 50);
            })
            ->addColumn('created', function ($menu) {
                return Carbon::parse($menu->created_at)->diffForHumans();
            })
            ->editColumn('created_by', function($menu){
                return Str::title($menu->user->username);
            })
            ->addColumn('action', function ($menu) {
                return '
                <button id="btn-menu-edit" data-id="'.$menu->id.'"  class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                <button id="btn-menu-delete" data-id="'.$menu->id.'"  class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                ';
            })
            ->addColumn('action_cart', function($menu){
                return '
                <button id="btn-menu-cart" data-max_qty="'.$menu->stok.'" data-nama_menu="'.$menu->nama_menu.'" data-harga="'.$menu->harga.'" data-id="'.$menu->id.'" class="btn btn-sm btn-primary fas fa-cart-plus"></button>
                ';
            })
            ->rawColumns(['action', 'action_cart'])
            ->make(true);
    }

    public function dataTransaksi()
    {
        if(Auth::user()->role == 'kasir'){
            $transaksis = Transaksi::whereKasirId(Auth::id())->get()->sortByDesc('id');
        } else {
            $transaksis = Transaksi::all()->sortByDesc('id');
        }
        if(isset($_GET['date_from']) && isset($_GET['date_to'])){
            $date_from = Carbon::parse($_GET['date_from']);
            $date_to = Carbon::parse(date($_GET['date_to'] . ' 23:59:59'));
            if(Auth::user()->role == 'manager'){
                $transaksis = Transaksi::whereBetween('created_at', [$date_from, $date_to])->get()->sortByDesc('id');
            } else {
                $transaksis = Transaksi::whereKasirId(Auth::id())->whereBetween('created_at', [$date_from, $date_to])->get()->sortByDesc('id');
            }
        }
        return DataTables::of($transaksis)
            ->editColumn('nama_menu', function($transaksi){
                return Str::title($transaksi->menu->nama_menu);
            })
            ->addColumn('nama_pelanggan', function($transaksi){
                return Str::title($transaksi->nama_pelanggan);
            })
            ->addColumn('kasir', function($transaksi){
                return Str::title($transaksi->kasir->username);
            })
            ->addColumn('tanggal', function($transaksi){
                return Carbon::parse($transaksi->created_at)->format('Y-m-d');
            })
            ->editColumn('total_harga', function($transaksi) {
                return 'Rp. ' . number_format($transaksi->total_harga, 0, ',', '.');
            })
            ->make(true);
    }

    public function dataAktivitas()
    {
        $activities = Activity::whereCauserId(Auth::id());

        return DataTables::of($activities)
                ->addColumn('tanggal', function($activity){
                    return Carbon::parse($activity->created_at)->format('Y-m-d');
                })
                ->make(true);
    }
}
