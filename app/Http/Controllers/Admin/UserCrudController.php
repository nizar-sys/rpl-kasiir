<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestCreateOrUpdateUser;
use App\Models\User;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserCrudController extends Controller
{
    use ApiTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'users' => User::latest()->get(),
            'roles' => [
                'admin', 'manager', 'kasir'
            ]
        ];
        return Inertia::render('Dashboard/Admin/Users/Index', $data);
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
    public function store(RequestCreateOrUpdateUser $request)
    {
        try {
            $validated = $request->validated();
            $user = User::create([
                'username' => $validated['username'],
                'password' => Hash::make($validated['password']),
                'role' => $validated['role'],
                'created_at' => now(),
            ]);
            activity()->log('Menambahkan pengguna ' . $user->username);
            return redirect()->route('users.index')->with('succeess', 'Berhasil menambahkan pengguna baru');
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
                'users' => User::findOrFail($id),
            ];
            return $this->success($data, 'Data pengguna');
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
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
    public function update(RequestCreateOrUpdateUser $request, $id)
    {
        try {
            $validated = $request->validated();
            $user = User::findOrFail($id);
            if($user->username == $validated['username'] && $user->role == $validated['role']){
                return $this->error('Tidak ada perubahan');
            }
            $user->update([
                'username' => $validated['username'],
                'role' => $validated['role'],
                'updated_at' => now(),
            ]);
            activity()->log('Mengubah data pengguna ' . $user->username);
            return redirect()->route('users.index')->with('success', 'Berhasil mengubah data pengguna');
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
            $user = User::findOrFail($id);
            activity()->log('Menghapus data pengguna ' . $user->username);
            $user->delete();
            return $this->success(null, 'Pengguna berhasil dihapus');
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
    }
}
