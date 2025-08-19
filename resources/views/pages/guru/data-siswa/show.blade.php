@extends('pages.layouts.guru')

@section('title', 'Data Siswa Kelas')
@section('description', 'Berikut adalah semua data kelas yang telah tercatat.')

@section('content')
<section class="section">
    <a href="{{ route('guru.data-siswa.index') }}" class="btn mb-3"><i class="bi bi-arrow-left"></i> Kembali</a>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="mb-2 row">
                    <div class="d-flex align-items-center">
                        <div class="ms-3">
                            <h3 class="mb-0 fw-bolder">Kelas {{ $kelas->nama_kelas }}</h3>
                            <div class="d-flex gap-4 mt-2 align-items-center justify-content-start">
                                <div>
                                    <i class="ti ti-cake text-muted"></i>
                                    <span class="text-muted">Total Siswa: {{ $kelas->siswa->count() ?? 0 }} Orang</span>
                                </div>
                                <div>
                                    <i class="ti ti-gender-male text-muted"></i>
                                    <span class="text-muted">Total Guru: {{ $kelas->guru_kelas->count() ?? 0 }} Orang</span>
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
            <div class="card-header">
                <h5 class="card-title">
                    Semua Data Siswa
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table data-table" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th>Tanggal Lahir</th>
                                <th>Alamat</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@push('scripts')
<script type="text/javascript">
    $(function() {
        var route = "{{ route('guru.data-siswa.show', $kelas->id) }}";
        var selector = ".data-table";
        var columns = [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                className: 'w-8 text-center text-sm',
                orderable: false,
                searchable: false
            },
            {
                data: 'nama',
                name: 'nama',
                orderable: true,
                searchable: true
            },
            {
                data: 'tgl_lahir',
                name: 'tgl_lahir',
                render: function(data, type, row) {
                    return moment(data).locale('id').format('ll') ?? '-';
                }
            },
            {
                data: 'alamat',
                name: 'alamat',
                orderable: true,
                searchable: true
            },
        ];
        var table = initializeDataTable(selector, route, columns);
    })
</script>
@endpush
@endsection