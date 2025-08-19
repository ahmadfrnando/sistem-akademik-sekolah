@extends('pages.layouts.admin')

@section('title', 'Data Mata Pelajaran')
@section('description', 'Berikut adalah semua data mata pelajaran yang telah tercatat.')

@section('content')
<section class="section">
    <a href="{{ route('admin.kelola-siswa-kelas.index') }}" class="btn mb-3"><i class="bi bi-arrow-left"></i> Kembali</a>
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
                    Semua Data Siswa Kelas
                </h5>
                <button type="button" id="create" class="btn btn-primary create-siswa block" data-id="{{ $kelas->id }}" data-bs-toggle="modal"
                    data-bs-target="#createModalForm">
                    <i class="bi bi-plus me-1 fs-5"></i>Tambah Siswa
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table data-table" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('pages.admin.kelola-siswa-kelas.create-modal')
    @include('pages.admin.kelola-siswa-kelas.update-modal')
</section>
@push('scripts')
<script>
    $(document).ready(function() {
        var route = "{{ route('admin.kelola-siswa-kelas.show', $kelas->id) }}";
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
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ];
        var table = initializeDataTable(selector, route, columns);

        $(document).on('click', '.create-siswa', function() {
            const kelasId = $(this).data('id');
            $('#kelas_id').val(kelasId);
        });
        
        $('#createModalForm').on('shown.bs.modal', function() {
            $('#create_siswa_id').select2({
                placeholder: 'Pilih Siswa',
                allowClear: true,
                width: 'resolve',
                dropdownParent: $('#createForm'),
                ajax: {
                    url: "{{route('search.siswa.kelas')}}",
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

        });

        var formCreate = "#createForm";
        var actionUrlCreate = "{{ route('admin.kelola-siswa-kelas.store') }}";
        var successMessageCreate = "Data Berhasil Ditambahkan";
        submitFormAjaxModal(formCreate, actionUrlCreate, successMessageCreate);

        $(document).on('click', '.update-kelas', function() {
            const siswaId = $(this).data('id');
            $('#siswa_id').val(siswaId);
        });

        $('#updateModalForm').on('shown.bs.modal', function() {
            $('#update_kelas_id').select2({
                placeholder: 'Pilih Kelas',
                allowClear: true,
                width: 'resolve',
                dropdownParent: $('#updateForm'),
                ajax: {
                    url: "{{route('search.kelas')}}",
                    dataType: 'json',
                    processResults: data => {
                        return {
                            results: data.map(res => {
                                return {
                                    text: res.nama_kelas,
                                    id: res.id
                                }
                            })
                        }
                    }
                }
            });
        });


        var formUpdate = "#updateForm";
        var actionUrlUpdate = "{{ route('admin.kelola-siswa-kelas.update', $kelas->id) }}";
        var successMessageUpdate = "Data Berhasil Diperbarui";
        submitFormAjaxModal(formUpdate, actionUrlUpdate, successMessageUpdate);

    });
</script>
@endpush
@endsection