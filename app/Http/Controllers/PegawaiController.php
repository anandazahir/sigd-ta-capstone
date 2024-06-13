<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class PegawaiController extends Controller
{
    public function index()
    {
        return view('pages.direktur.pegawai');
    }
    public function show($id)
    {
        $pegawai = User::findOrFail($id);
        return view('pages.direktur.pegawai-more', compact('pegawai'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nip' => 'required|numeric|digits_between:8,13|unique:users,nip',
            'nik' => 'required|numeric|digits_between:8,13|unique:users,nik',
            'nama' => 'required|string|min:5|unique:users,nama',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|unique:users,username',
            'jabatan' => 'required|string',
            'alamat' => 'required|string|unique:users,alamat',
            'agama' => 'required|string',
            'JK' => 'required|string',
            'pendidikan_terakhir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'status_menikah' => 'required|string',
            'no_hp' => 'required|numeric|digits_between:10,13|unique:users,no_hp',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $password = Hash::make($request->nip);
        $username = strtolower($request->username);
        $name = strtolower($request->nama);
        $no_hp = '0' . $request->no_hp;

        $user = User::create([
            'nip' => $request->nip,
            'nama' => $name,
            'email' => $request->email,
            'nik' => $request->nik,
            'username' => $username,
            'password' => $password,
            'jabatan' => $request->jabatan,
            'alamat' => $request->alamat,
            'agama' => $request->agama,
            'JK' => $request->JK,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'status_menikah' => $request->status_menikah,
            'no_hp' => $no_hp,
        ]);

        $user->assignRole($request->jabatan);

        return response()->json([
            'success' => true,
            'message' => 'Data Pegawai Berhasil Disimpan!',
        ]);
    }

    public function update(Request $request, $id)
    {
        $pegawai = user::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'nip' => 'required|numeric|min:8|unique:users,nip,' . $id,
            'nik' => 'required|numeric|min:8|unique:users,nik,' . $id,
            'nama' => 'required|string|min:5|unique:users,nama,' . $id,
            'username' => 'required|string|unique:users,username,' . $id,
            'jabatan' => 'required|string|unique:users,jabatan,' . $id,
            'alamat' => 'required|string|unique:users,alamat,' . $id,
            'agama' => 'required|string',
            'JK' => 'required|string',
            'pendidikan_terakhir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'status_menikah' => 'required|string',
            'no_hp' => 'required|numeric|min:10|unique:users,no_hp,' . $id,
        ]);


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $username =  strtolower($request->username);
        $name = strtolower($request->name);
        $no_hp = '0' . $request->no_hp;
        $pegawai->update([
            'nip' => $request->nip,
            'nik' => $request->nik,
            'nama' => $name,
            'username' => $username,
            'jabatan' => $request->jabatan,
            'alamat' => $request->alamat,
            'agama' => $request->agama,
            'JK' => $request->JK,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'status_menikah' => $request->status_menikah,
            'no_hp' => $no_hp,
        ]);
        $pegawai->assignRole($request->jabatan);

        return response()->json([
            'success' => true,
            'message' => 'Data Transaksi Berhasil Diubah!',
        ]);
    }
    public function delete(Request $request)
    {

        $user = user::findOrFail($request->id);
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Peti Kemas Berhasil Dihapus!',
        ]);
    }
    public function filter(Request $request)
    {

        $searchTerm = $request->input('search');

        $query = User::query();
        $query->where(function ($query) use ($searchTerm) {
            $query
                ->where('username', 'like', '%' . $searchTerm . '%')
                ->orWhere('nip', 'like', '%' . $searchTerm . '%')
                ->orWhere('nama', 'like', '%' . $searchTerm . '%')
                ->orWhere('jabatan', 'like', '%' . $searchTerm . '%')
                ->orWhere('no_hp', 'like', '%' . $searchTerm . '%');
        });
        $perPage = 5;
        $filteredData = $query->paginate($perPage);

        if ($filteredData->isEmpty()) {
            return response()->json(['message' => 'No data found']);
        }

        return response()->json([
            'Data' => $filteredData->items(),
            'Count' => $filteredData->total(),
            'meta' => [
                'current_page' => $filteredData->currentPage(),
                'last_page' => $filteredData->lastPage(),
                'per_page' => $filteredData->perPage(),
            ],

        ]);
    }
}
