<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RefKelas;
use App\Models\Siswa;
use Yajra\DataTables\Facades\DataTables;

class KelolaSiswaKelasController extends Controller
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
                    $btn = '<a href="' . route('admin.kelola-siswa-kelas.show', $row->id) . '" class="me-2 edit btn btn-outline-primary btn-sm">Detail</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.admin.kelola-siswa-kelas.index');
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
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'kelas_id' => ['required', 'exists:ref_kelas,id'],
                'create_siswa_id' => ['required', 'exists:siswa,id'],
            ]);

            Siswa::where('id', $validatedData['create_siswa_id'])
                ->update(['kelas_id' => $validatedData['kelas_id']]);
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan!',
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
            $data = Siswa::select('*')->where('kelas_id', $id);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '
                     <button type="button" class="update-kelas btn btn-danger btn-sm block" data-id="' . $row->id . '" data-bs-toggle="modal"
                    data-bs-target="#updateModalForm">
                    <i class="bi bi-box-arrow-up-right me-2 fs-5"></i>Pindah Kelas
                     </button>
                    ';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $kelas = RefKelas::findOrFail($id);
        return view('pages.admin.kelola-siswa-kelas.show', compact('kelas'));
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
        try {
            $validatedData = $request->validate([
                'update_kelas_id' => ['required', 'exists:ref_kelas,id'],
                'siswa_id' => ['required', 'exists:siswa,id'],
            ]);
            Siswa::where('id', $validatedData['siswa_id'])->update(['kelas_id' => $validatedData['update_kelas_id']]);
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan!',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // try {
        //     $data = Siswa::findOrFail($id);
        //     $data->delete();
        //     return response()->json([
        //         'success' => true,
        //         'message' => 'Data berhasil dihapus!'
        //     ], 200);
        // } catch (\Exception $e) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Terjadi kesalahan: ' . $e->getMessage()
        //     ], 500);
        // }
    }
}
