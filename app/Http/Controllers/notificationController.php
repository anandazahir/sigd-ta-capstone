<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notifikasi;

class notificationController extends Controller
{
    public function index()
    {
        return view('pages.notification');
    }
    
    public function filter(Request $request)
    {
        $searchTerm = $request->input('search');
        $userId = auth()->user()->id;

        $query = Notifikasi::where('user_id', $userId);

        if ($searchTerm) {
            $query->where(function ($query) use ($searchTerm) {
                $query
                    ->where('sender', 'like', '%' . $searchTerm . '%')
                    ->orWhere('message', 'like', '%' . $searchTerm . '%');
            });
        }

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


    public function delete(Request $request)
    {
        $notifikasi = Notifikasi::findOrFail($request->id);
        $notifikasi->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Notifikasi Berhasil Dihapus!',
        ]);
    }
}
