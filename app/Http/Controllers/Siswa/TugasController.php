<?php

namespace App\Http\Controllers\Siswa;

use App\Facades\Pengguna;
use App\Http\Controllers\Controller;
use App\Http\Requests\TanggapanMateriRequest;
use App\Models\Guru;
use App\Models\GuruKelas;
use App\Models\Materi;
use App\Models\RefMapel;
use App\Models\TanggapanMateri;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $siswa;
    protected $materi;
    protected $guruKelas;

    // Fungsi __construct untuk inisialisasi variabel
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->siswa = Pengguna::getUserSiswa();
            $this->materi = Materi::where(['kelas_id' => $this->siswa->kelas_id]);
            $this->guruKelas = GuruKelas::where(['kelas_id' => $this->siswa->kelas_id]);
            return $next($request);
        });

        // dd($this->materi->where('mapel_id', 1))->get();
    }

    public function index(Request $request)
    {
        $mapelIds = $this->materi->pluck('mapel_id')->unique()->toArray();
        if ($request->ajax()) {
            $data = $this->guruKelas->select('*')->whereIn('mapel_id', $mapelIds);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('nama_mapel', function ($row) {
                    return $row->mapel->nama_mapel ?? '-';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('siswa.tugas.list-materi', $row->mapel_id) . '" class="me-2 edit btn btn-outline-primary btn-sm" disabled>Lihat Tugas</a>';
                    return $btn;
                })
                ->rawColumns(['action', 'mapel'])
                ->make(true);
        }
        return view('pages.siswa.tugas.index');
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

    public function storeTanggapan(TanggapanMateriRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $validatedData['siswa_id'] = $this->siswa->id;
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $path = $file->store('uploads', 'public');
                $validatedData['file'] = $path;
            }
            $data = TanggapanMateri::create($validatedData);
            return response()->json(['success' => true]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $th->getMessage()
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

    public function listMateri(Request $request, $mapel_id)
    {
        $guruKelas = $this->guruKelas->where('mapel_id', $mapel_id)->first();
        if ($request->ajax()) {
            $data = $this->materi->select('*')->where('mapel_id', $mapel_id)->orWhere('guru_id', $guruKelas->guru_id);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    $color = $row->is_done ? 'danger' : 'success';
                    $text = $row->is_done ? 'Ditutup' : 'Dibuka';
                    $badge = '<span class="badge bg-' . $color . ' bg-success">' . $text . '</span>';
                    return $badge;
                })
                ->addColumn('action', function ($row) {
                    $open = '<a href="' . route('siswa.tugas.show-materi', $row->id) . '" class="me-2 edit btn btn-outline-primary btn-sm" style="white-space: nowrap !important" disabled>Detail Materi</a>';
                    $close = '<i style="white-space: nowrap !important">Sudah selesai</i>';
                    return $row->is_done ?  $close : $open;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        $dataCount = $this->materi->select('*')->where('mapel_id', $mapel_id)->orWhere('guru_id', $guruKelas->guru_id)->count();
        return view('pages.siswa.tugas.list-materi', compact('guruKelas', 'dataCount', 'mapel_id'));
    }

    public function showMateri(Request $request, string $id)
    {
        $data = Materi::findOrFail($id);
        $responses = TanggapanMateri::with('siswa')
            ->where('materi_id', $id)
            ->latest()
            ->paginate(10);
        return view('pages.siswa.tugas.tanggapan-materi.index', compact('data', 'responses'));
    }

    public function loadTanggapanPartial($id)
    {
        $responses = TanggapanMateri::with('siswa')
            ->where('materi_id', $id)
            ->latest()
            ->paginate(10);
        return view('pages.siswa.tugas.tanggapan-materi._komentar', compact('responses'));
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
