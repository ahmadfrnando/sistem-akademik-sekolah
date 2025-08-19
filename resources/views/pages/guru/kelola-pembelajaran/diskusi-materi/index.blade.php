@extends('pages.layouts.guru')

@section('title', 'Diskusi Materi Pembelajaran')
@section('description', 'Berikut adalah semua diskusi materi pembelajaran yang telah tercatat.')

@section('content')
<section class="section">
    <a href="{{ route('guru.kelola-pembelajaran.show', $dataMateri->kelas_id) }}" class="btn mb-3"><i class="bi bi-arrow-left"></i> Kembali</a>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="mb-2 row">
                    <div class="d-flex align-items-center">
                        <div class="ms-3">
                            <h3 class="mb-0 fw-bolder">{{ $dataMateri->nama_materi }}</h3>
                            <span class="mb-0 fw-bolder text-muted">Deskripsi: {{ $dataMateri->deskripsi }}</span>
                            <div class="d-flex gap-4 mt-2 align-items-center justify-content-start">
                                <div>
                                    <i class="ti ti-cake text-muted"></i>
                                    <span class="text-muted">Total Siswa: 0 Siswa</span>
                                </div>
                                <div>
                                    <i class="ti ti-cake text-muted"></i>
                                    <span class="text-muted">Total Siswa Yang Sudah Mengerjakan: 0 Siswa</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0">Nama Siswa</h5>
                            <small class="text-muted">Posted 20 minutes ago by KenyeW</small>
                        </div>
                        <span class="text-muted">jawaban siswa</span>
                        <button type="button" class="btn btn-outline-secondary btn-sm">Lihat Jawaban</button>
                    </li>
                </ul>
        </div>
    </div>
</section>
@endsection