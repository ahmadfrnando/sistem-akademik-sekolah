<?php

namespace App\Http\Controllers\Guru;

use App\Facades\Pengguna;
use App\Http\Controllers\Controller;
use App\Models\GuruKelas;
use App\Models\RefKelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DataSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $dataUser;
    protected $guruKelas;
    protected $siswa;

    // Fungsi __construct untuk inisialisasi variabel
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->dataUser = Pengguna::getUserGuru();
            return $next($request);
        });
        $this->guruKelas = new GuruKelas();
        $this->siswa = new Siswa();

    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->guruKelas->select('*')->where(['guru_id' => $this->dataUser->id]);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('kelas', function ($row) {
                    return $row->kelas->nama_kelas;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('guru.data-siswa.show', $row->kelas_id) . '" class="me-2 edit btn btn-outline-primary btn-sm">Detail</a>';
                    return $btn;
                })
                ->rawColumns(['action', 'kelas'])
                ->make(true);
        }
        return view('pages.guru.data-siswa.index');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        if ($request->ajax()) {
            $data = $this->siswa->select('*')->where('kelas_id', $id);
            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        $kelas = RefKelas::findOrFail($id);
        return view('pages.guru.data-siswa.show', compact('kelas'));
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
        //
    }
}
