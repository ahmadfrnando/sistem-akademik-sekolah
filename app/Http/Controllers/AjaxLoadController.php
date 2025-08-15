<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxLoadController extends Controller
{
    public function getKelas(Request $request)
    {
        $searchTerm = $request->input('q'); 
        $kelas = \App\Models\RefKelas::where('nama_kelas', 'LIKE', '%' . $searchTerm . '%')
            ->get(['id', 'nama_kelas'])
            ->toArray();

        return response()->json($kelas);  // Kembalikan sebagai JSON
    }
    public function getMapel(Request $request)
    {
        $searchTerm = $request->input('q'); 
        $kelas = \App\Models\RefMapel::where('nama_mapel', 'LIKE', '%' . $searchTerm . '%')
            ->get(['id', 'nama_mapel'])
            ->toArray();

        return response()->json($kelas);  // Kembalikan sebagai JSON
    }
    public function getGuruMapel(Request $request)
    {
        $searchTerm = $request->input('q'); 
        $kelas = \App\Models\Guru::with('mapel')->where('nama', 'LIKE', '%' . $searchTerm . '%')
            ->get(['id', 'nama', 'mapel_id'])
            ->map(function($item) {
                return [
                    'id' => $item->id,
                    'text' => $item->nama . ' - ' . $item->mapel->nama_mapel
                ];
            })
            ->toArray();

        return response()->json($kelas);  // Kembalikan sebagai JSON
    }
}
