@extends('pages.layouts.admin')

@section('title', 'Daftar Kelas')
@section('description', 'Berikut adalah semua daftar kelas yang telah tercatat.')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">
                Semua Kelas
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table data-table" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kelas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@push('scripts')
<script type="text/javascript">
    $(function() {
        var route = "{{ route('admin.kelola-siswa-kelas.index') }}";
        var selector = ".data-table";
        var columns = [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                className: 'w-8 text-center text-sm',
                orderable: false,
                searchable: false
            },
            {
                data: 'nama_kelas',
                name: 'nama_kelas',
                orderable: true,
                searchable: true
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ];
        var table = initializeDataTable(selector, route, columns);
    })
</script>
@endpush
@endsection