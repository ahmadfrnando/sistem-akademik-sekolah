<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuruKelasRequest;
use App\Models\Guru;
use App\Models\GuruKelas;
use App\Models\RefKelas;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KelolaGuruKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = RefKelas::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('admin.kelola-guru-kelas.show', $row->id) . '" class="me-2 edit btn btn-outline-primary btn-sm">Detail</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.admin.kelola-guru-kelas.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GuruKelasRequest $request)
    {
        try {
            // $mapel_id = Guru::where('id', $request->guru_id)->first()->mapel_id;
            $validatedData = $request->validated();
            $data = GuruKelas::create($validatedData);
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan!',
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        if ($request->ajax()) {
            $data = GuruKelas::select('*')->where('kelas_id', $id);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('guru', function ($row) {
                    return $row->guru->nama ?? '-';
                })
                ->addColumn('mapel', function ($row) {
                    return $row->mapel->nama_mapel ?? '-';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<button type="button" data-id="' . $row->id . '" id="delete" class="me-2 btn btn-danger btn-sm" data-id="' . $row->id . '">Hapus</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $kelas = RefKelas::findOrFail($id);
        return view('pages.admin.kelola-guru-kelas.show', compact('kelas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = GuruKelas::findOrFail($id);
            $data->delete();
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus!'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
