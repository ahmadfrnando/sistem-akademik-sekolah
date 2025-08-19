<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxLoadController extends Controller
{
    public function getSiswaKelas(Request $request)
    {
        $searchTerm = $request->input('q');
        $data = \App\Models\Siswa::with('kelas')->where('nama', 'LIKE', '%' . $searchTerm . '%')
            ->get(['id', 'nama', 'kelas_id'])
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'text' => $item->nama . ' - ' . $item->kelas->nama_kelas
                ];
            })
            ->toArray();

        return response()->json($data);  // Kembalikan sebagai JSON
    }

    public function getSiswa(Request $request)
    {
        $searchTerm = $request->input('q');
        $data = \App\Models\Siswa::where('nama', 'LIKE', '%' . $searchTerm . '%')
            ->get(['id', 'nama'])
            ->toArray();

        return response()->json($data);  // Kembalikan sebagai JSON
    }

    public function getKelas(Request $request)
    {
        $searchTerm = $request->input('q');
        $data = \App\Models\RefKelas::where('nama_kelas', 'LIKE', '%' . $searchTerm . '%')
            ->get(['id', 'nama_kelas'])
            ->toArray();

        return response()->json($data);  // Kembalikan sebagai JSON
    }

    public function getMapel(Request $request)
    {
        $searchTerm = $request->input('q');
        $data = \App\Models\RefMapel::where('nama_mapel', 'LIKE', '%' . $searchTerm . '%')
            ->get(['id', 'nama_mapel'])
            ->toArray();

        return response()->json($data);  // Kembalikan sebagai JSON
    }
    public function getGuruMapel(Request $request)
    {
        $searchTerm = $request->input('q');
        $data = \App\Models\Guru::with('mapel')->where('nama', 'LIKE', '%' . $searchTerm . '%')
            ->get(['id', 'nama', 'mapel_id'])
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'text' => $item->nama . ' - ' . $item->mapel->nama_mapel
                ];
            })
            ->toArray();

        return response()->json($data);  // Kembalikan sebagai JSON
    }
}
