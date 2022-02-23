<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestStoreTransaksi;
use App\Models\Menu;
use App\Models\Transaksi;
use App\Models\User;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
class TransaksiCrudController extends Controller
{
    use ApiTrait;

    public function __construct()
    {
        $this->middleware('isKasir')->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role == 'manager'){
            $transaksi = Transaksi::select(DB::RAW('SUM(total_harga) as total'))->get()->first() ?? 0;
        } else {
            $transaksi = Transaksi::select(DB::RAW('SUM(total_harga) as total'))->whereKasirId(request()->user()->id)->get()->first() ?? 0;
        }
        $data = [
            'total_pendapatan' => number_format($transaksi->total, 0, ',', '.'),
        ];
        return Inertia::render('Dashboard/Kasir/Transaksi/Index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'menus' => Menu::all(),
            'users' => User::whereRole('pelanggan')->get(),
        ];
        return Inertia::render('Dashboard/Kasir/Transaksi/Create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $transaksi = Transaksi::insert($request->all());
            activity()
                ->log('Membuat transaksi baru');
            return $this->success($transaksi ,'Transaksi berhasil dibuat');
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
            //throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
