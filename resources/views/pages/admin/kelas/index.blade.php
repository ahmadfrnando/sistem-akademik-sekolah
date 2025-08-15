@extends('pages.layouts.admin')

@section('title', 'Data Kelas')
@section('description', 'Berikut adalah semua data kelas yang telah tercatat.')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title">
                Semua Kelas
            </h5>
            <button type="button" id="create" class="btn btn-primary block" data-bs-toggle="modal"
                data-bs-target="#modalForm">
                <i class="bi bi-plus me-1 fs-5"></i>Tambah Kelas
            </button>
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
    @include('pages.admin.kelas.create-modal')
</section>
@push('scripts')
<script type="text/javascript">
    $(function() {
        var route = "{{ route('admin.kelas.index') }}";
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

        $(document).on('click', '#create', function() {
            let formSelector = '#submitForm';
            let modal = '#modalForm';
            $(modal).find('.modal-title').html('Tambah Kelas');
            let actionUrl = "{{ route('admin.kelas.store') }}";
            let successMessage = 'Data berhasil disimpan!';
            submitFormAjaxModal(formSelector, actionUrl, successMessage, modal, table);
        })

        $(document).on('click', '#edit, .btn-edit', function() {
            const id = $(this).data('id');
            const $modal = $('#modalForm');
            const $form = $('#submitForm');
            $($modal).find('.modal-title').html('Ubah Kelas');

            $form.attr('method', 'POST'); // Sementara set ke POST
            $form.append('<input type="hidden" name="_method" value="PUT">'); // Menambahkan _method untuk mengindikasikan PUT


            let actionUrl = "{{ route('admin.siswa.update', ':id') }}".replace(':id', id);
            let successMessage = 'Data berhasil diubah!';
            submitFormAjaxModal('#submitForm', actionUrl, successMessage, '#modalForm', table);

            $modal.modal && $modal.modal('show');

            $.ajax({
                url: "{{ route('admin.siswa.edit', ':id') }}".replace(':id', id),
                method: 'GET'
            }).done(function(response) {
                const d = response.data;
                console.log(d.kelas.id);
                $('#nama_kelas').val(d.nama_kelas);
            }).fail(function(xhr) {
                console.error(xhr.responseText || xhr.statusText);
                alert('Gagal memuat data.');
            });
        });

        $(document).on('click', '#delete', function() {
            var id = $(this).data('id');
            var route = "{{ route('admin.kelas.destroy', ':id') }}";
            route = route.replace(':id', id);
            deleteDataAjax(route, table);
        });
    })
</script>
@endpush
@endsection