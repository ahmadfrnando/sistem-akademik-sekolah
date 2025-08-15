<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RefKelas;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KelasController extends Controller
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
                    $btn = '<button type="button" data-id="' . $row->id . '" id="edit" data-bs-toggle="modal"
                    data-bs-target="#modalForm" class="me-2 edit btn btn-primary btn-sm" data-id="' . $row->id . '"><i class="bi bi-pencil"></i></button>';
                    $btn .= '<button type="button" data-id="' . $row->id . '" id="delete" class="me-2 btn btn-danger btn-sm" data-id="' . $row->id . '"><i class="bi bi-trash"></i></button>';
                    return
                        '<div class="d-flex align-items-center">' .
                        $btn .
                        '</div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.admin.kelas.index');
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
                'nama_kelas' => 'required|unique:ref_kelas,nama_kelas',
            ]);
            $data = RefKelas::create($validatedData);
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
        $data = RefKelas::findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validatedData = $request->validate([
                'nama_kelas' => 'required|unique:ref_kelas,nama_kelas,' . $id,
            ]);
            $data = RefKelas::findOrFail($id);
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
            $data = RefKelas::findOrFail($id);
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
