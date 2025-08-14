<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SiswaRequest;
use App\Models\RefKelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Siswa::with('kelas', 'user')->select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('kelas_id', function ($row) {
                    return $row->kelas ? $row->kelas->nama_kelas : '-';
                })
                ->addColumn('user_id', function ($row) {
                    return $row->user ? $row->user->username : '-';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<button type="button" data-id="' . $row->id . '" id="edit" data-bs-toggle="modal"
                    data-bs-target="#modalForm" class="me-2 edit btn btn-primary btn-sm" data-id="' . $row->id . '"><i class="bi bi-pencil"></i></button>';
                    $btn .= '<button type="button" data-id="' . $row->id . '" id="delete" class="me-2 btn btn-danger btn-sm" data-id="' . $row->id . '"><i class="bi bi-trash"></i></button>';
                    $btn .= '<button type="button" data-id="' . $row->user_id . '" id="updateAkun" data-bs-toggle="modal"
                    data-bs-target="#modalUpdateAkunForm" class="me-2 btn btn-secondary btn-sm" data-id="' . $row->id . '"><i class="bi bi-person-check"></i></button>';
                    $btn .= '<button type="button" data-id="' . $row->user_id . '" id="updatePassword" data-bs-toggle="modal"
                    data-bs-target="#modalUpdatePasswordForm" class="me-2 btn btn-warning btn-sm" data-id="' . $row->id . '"><i class="bi bi-key"></i></button>';
                    
                    return 
                    '<div class="d-flex align-items-center">'.
                    $btn .
                    '</div>';
                })
                ->rawColumns(['kelas_id', 'action'])
                ->filterColumn('user_id', function ($query, $value) {
                    $query->whereHas('user', function ($q) use ($value) {
                        $q->where('username', 'LIKE', '%' . $value . '%');
                    });
                })
                ->filterColumn('kelas_id', function ($query, $value) {
                    $query->whereHas('kelas', function ($q) use ($value) {
                        $q->where('nama_kelas', 'LIKE', '%' . $value . '%');
                    });
                })
                ->make(true);
        }
        $kelas = RefKelas::all();
        return view('pages.admin.siswa.index', compact('kelas'));
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
    public function store(SiswaRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $data = Siswa::create($validatedData);
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $siswa = Siswa::with('kelas')->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $siswa
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SiswaRequest $request, string $id)
    {
        try {
            $validatedData = $request->validated();
            $data = Siswa::findOrFail($id);
            $data->update($validatedData);
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = Siswa::findOrFail($id);
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
