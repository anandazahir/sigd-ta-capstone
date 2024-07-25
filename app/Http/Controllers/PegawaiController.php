<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Rats\Zkteco\Lib\ZKTeco;

class PegawaiController extends Controller
{
    public function index()
    {
        return view('pages.direktur.pegawai');
    }
    public function indexpegawai()
    {
        $pegawai = Auth::user();
        $cuti = $pegawai->pengajuan->where('jenis_pengajuan', 'pengajuan cuti')->count();
        $kenaikangaji = $pegawai->pengajuan->where('jenis_pengajuan', 'kenaikan gaji')->count();
        return view('pages.pegawai', compact('pegawai', 'cuti', 'kenaikangaji'));
    }
    public function show($id)
    {
        $pegawai = User::findOrFail($id);
        $cuti = $pegawai->pengajuan->where('jenis_pengajuan', 'pengajuan cuti')->count();
        $kenaikangaji = $pegawai->pengajuan->where('jenis_pengajuan', 'kenaikan gaji')->count();
        return view('pages.direktur.pegawai-more', compact('pegawai', 'kenaikangaji', 'cuti'));
    }
    public function store(Request $request)
    {
        $tiga_tahun_yang_lalu = date('Y-m-d', strtotime('2020-01-01'));
        $validator = Validator::make($request->all(), [
            'nip' => 'required|numeric|digits:18|unique:users,nip',
            'nik' => 'required|numeric|digits:16|unique:users,nik',
            'nama' => 'required|string|min:5|unique:users,nama',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|unique:users,username',
            'jabatan' => 'required|string',
            'alamat' => 'required|string|unique:users,alamat',
            'agama' => 'required|string',
            'JK' => 'required|string',
            'pendidikan_terakhir' => 'required|string',
            'tanggal_lahir' => 'required|date|before:' . $tiga_tahun_yang_lalu,
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
        /*$zk = new ZKTeco('192.168.0.201');
        $zk->connect();
        $zk->setUser(($user->id + 1), ($user->id + 1), $user->username, null, 0);
        $zk->disableDevice();*/
        return response()->json([
            'success' => true,
            'message' => 'Data Pegawai Berhasil Disimpan!',
        ]);
    }

    public function update(Request $request, $id)
    {
        $pegawai = user::findOrFail($id);
        $tiga_tahun_yang_lalu = date('Y-m-d', strtotime('2020-01-01'));
        $validator = Validator::make($request->all(), [
            'nip' => 'required|numeric|digits:18|unique:users,nip,' . $id,
            'nik' => 'required|numeric|digits:16|unique:users,nik,' . $id,
            'nama' => 'required|string|min:5|unique:users,nama,' . $id,
            'username' => 'required|string|unique:users,username,' . $id,
            'jabatan' => 'required|string|unique:users,jabatan,' . $id,
            'alamat' => 'required|string|unique:users,alamat,' . $id,
            'agama' => 'required|string',
            'JK' => 'required|string',
            'pendidikan_terakhir' => 'required|string',
            'tanggal_lahir' => 'required|date|before:' . $tiga_tahun_yang_lalu,
            'status_menikah' => 'required|string',
            'no_hp' => 'required|numeric|digits_between:10,13|unique:users,no_hp,' . $id,
        ]);


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $username =  strtolower($request->username);
        $name = strtolower($request->nama);
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
    public function changeprofilpicture(Request $request)
    {
        $userId = auth()->id();
        $user = User::findOrFail($userId);
        $validator = Validator::make($request->all(), [
            'foto' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if ($user->foto && $request->type == 'delete') {
            if (Storage::disk('public')->exists($user->foto)) {
                Storage::disk('public')->delete($user->foto);
            }
            $user->foto = null;
            $user->save();
        }
        if ($request->type == 'changed') {
            if ($user->foto) {
                if (Storage::disk('public')->exists($user->foto)) {
                    Storage::disk('public')->delete($user->foto);
                }
            }

            $newImagePath = $request->file("foto")->store('uploads', 'public');
            $user->foto = $newImagePath;
            $user->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Foto Profil Berhasil Diubah!',
        ]);
    }
}
