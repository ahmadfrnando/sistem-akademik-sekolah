@extends('pages.layouts.admin')

@section('title', 'Detail Kelas')
@section('description', 'Berikut adalah semua data kelas yang telah tercatat.')

@section('content')
<section class="section">
    <a href="{{ route('admin.kelola-kelas.index') }}" class="btn btn-secondary mb-3"><i class="bi bi-arrow-left"></i> Kembali</a>
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
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title">
                    Semua Data Guru Kelas
                </h5>
                <button type="button" id="create" class="btn btn-primary block" data-nama="{{ $kelas->nama_kelas }}" data-id="{{ $kelas->id }}" data-bs-toggle="modal"
                    data-bs-target="#modalForm">
                    <i class="bi bi-plus me-1 fs-5"></i>Tambah Guru
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table data-table" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Guru</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('pages.admin.kelola-kelas.create-modal')
</section>
@push('scripts')
<script type="text/javascript">
    $(function() {
        var route = "{{ route('admin.kelola-kelas.show', $kelas->id) }}";
        var selector = ".data-table";
        var columns = [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                className: 'w-8 text-center text-sm',
                orderable: false,
                searchable: false
            },
            {
                data: 'guru',
                name: 'guru',
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

        $(document).on('click', '#create', function() {
            let id = $(this).data('id');
            let namaKelas = $(this).data('nama');
            $('#kelas_id').val(id);
            $('#nama_kelas').val(namaKelas);
            let formSelector = '#submitForm';
            $('#guru_id').select2({
                placeholder: 'Pilih Guru',
                allowClear: true,
                width: 'resolve',
                dropdownParent: $('#modalForm'),
                ajax: {
                    url: "{{route('search.guru-mapel')}}",
                    dataType: 'json',
                    processResults: data => {
                        return {
                            results: data.map(res => {
                                return {
                                    text: res.text,
                                    id: res.id
                                }
                            })
                        }
                    }
                }
            });
            let modal = '#modalForm';
            $(modal).find('.modal-title').html('Tambah Guru');
            let actionUrl = "{{ route('admin.kelola-kelas.store') }}";
            let successMessage = 'Data berhasil disimpan!';
            submitFormAjaxModal(formSelector, actionUrl, successMessage, modal, table);
        })

        $(document).on('click', '#delete', function() {
            var id = $(this).data('id');
            var route = "{{ route('admin.kelola-kelas.destroy', ':id') }}";
            route = route.replace(':id', id);
            deleteDataAjax(route, table);
        });
    })
</script>
@endpush
@endsection