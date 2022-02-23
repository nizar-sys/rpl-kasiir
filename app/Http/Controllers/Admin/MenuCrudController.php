<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestCreateOrUpdateMenu;
use App\Models\Menu;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MenuCrudController extends Controller
{
    use ApiTrait;

    public function __construct()
    {
        $this->middleware('isManager')->except('show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Dashboard/Manager/Menu/Index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestCreateOrUpdateMenu $request)
    {
        try {
            $validated = $request->validated();
            $menu = Menu::create([
                'nama_menu' => $validated['nama_menu'],
                'harga' => $validated['harga'],
                'deskripsi' => $validated['deskripsi'],
                'stok' => $validated['stok'],
                'created_by' => $request->user()->id,
                'created_at' => now(),
            ]);
            activity()->log('Menambahkan menu ' . $menu->nama_menu);
            return redirect()->route('menus.index')->with('success', 'Menu berhasil ditambahkan');
        } catch (\Throwable $th) {
            throw $th;
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
        try {
            $data = [
                'menu' => Menu::with('user')->findOrFail($id),
            ];
            return $this->success($data, 'Menu berhasil ditampilkan');
        } catch (\Throwable $th) {
            //throw $th;
        }
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
    public function update(RequestCreateOrUpdateMenu $request, $id)
    {
        try {
            $validated = $request->validated();
            $menu = Menu::findOrFail($id);
            if($menu->nama_menu == $validated['nama_menu'] && $menu->harga == $validated['harga'] && $menu->deskripsi == $validated['deskripsi'] && $menu->stok == $validated['stok']){
                return redirect()->route('menus.index')->with('error', 'Menu tidak berubah');
            }
            $menu->update([
                'nama_menu' => $validated['nama_menu'],
                'harga' => $validated['harga'],
                'deskripsi' => $validated['deskripsi'],
                'stok' => $validated['stok'],
                'updated_at' => now(),
            ]);
            activity()->log('Mengubah menu ' . $menu->nama_menu);
            return redirect()->route('menus.index')->with('success', 'Menu berhasil diubah');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $menu = Menu::findOrFail($id);
            activity()->log('Menghapus menu ' . $menu->nama_menu);
            $menu->delete();
            return $this->success(null, 'Menu berhasil dihapus');
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
            //throw $th;
        }
    }
}
