@extends('pages.layouts.admin')

@section('title', 'Data Guru')
@section('description', 'Berikut adalah semua data guru yang telah tercatat.')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title">
                Semua Guru
            </h5>
            <button type="button" id="create" class="btn btn-primary block" data-bs-toggle="modal"
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
                            <th>Nama</th>
                            <th>Akun</th>
                            <th>Mata Pelajaran</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
    @include('pages.admin.guru.create-modal')
    @include('pages.admin.guru.edit-akun-modal')
    @include('pages.admin.guru.edit-password-modal')
</section>
@push('scripts')
<script type="text/javascript">
    $(function() {
        var route = "{{ route('admin.guru.index') }}";
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
                data: 'user_id',
                name: 'user_id',
            },
            {
                data: 'mapel_id',
                name: 'mapel_id',
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
            const $form = $('#submitForm');
            $form.attr('method', 'POST');
            $form.find('input[name="_method"]').remove(); // Hapus _method jika ada
            $form.append('<input type="hidden" name="_method" value="POST">');
            let select2 = '#mapel_id';
            $(select2).select2({
                placeholder: 'Pilih Mapel',
                allowClear: true,
                width: 'resolve',
                dropdownParent: $('#modalForm'),
                ajax: {
                    url: "{{route('search.mapel')}}",
                    dataType: 'json',
                    processResults: data => {
                        return {
                            results: data.map(res => {
                                return {
                                    text: res.nama_mapel,
                                    id: res.id
                                }
                            })
                        }
                    }
                }
            });
            let formSelector = '#submitForm';
            let modal = '#modalForm';
            $(modal).find('.modal-title').html('Tambah Guru');
            let actionUrl = "{{ route('admin.guru.store') }}";
            let successMessage = 'Data berhasil disimpan!';
            submitFormAjaxModal(formSelector, actionUrl, successMessage, modal, table, select2);
        })

        $(document).on('click', '#edit, .btn-edit', function() {
            const id = $(this).data('id');
            const $modal = $('#modalForm');
            const $form = $('#submitForm');
            const $mapel = $('#mapel_id');
            $($modal).find('.modal-title').html('Ubah Guru');

            $form.attr('method', 'POST');
            $form.find('input[name="_method"]').remove(); // Hapus _method jika ada
            $form.append('<input type="hidden" name="_method" value="PUT">');



            let actionUrl = "{{ route('admin.guru.update', ':id') }}".replace(':id', id);
            let successMessage = 'Data berhasil diubah!';
            submitFormAjaxModal('#submitForm', actionUrl, successMessage, '#modalForm', table);

            $modal.modal && $modal.modal('show');

            $.ajax({
                url: "{{ route('admin.guru.edit', ':id') }}".replace(':id', id),
                method: 'GET'
            }).done(function(response) {
                const d = response.data;
                console.log(d.mapel.id);

                $('#nama').val(d.nama);
                $('#tgl_lahir').val(d.tgl_lahir);
                $('#alamat').val(d.alamat);

                if ($mapel.hasClass('select2-hidden-accessible')) {
                    $mapel.select2('destroy');
                }

                $mapel.select2({
                    placeholder: 'Pilih Mapel',
                    allowClear: true,
                    width: '100%',
                    dropdownParent: $modal,
                    data: d.mapel ? [{
                        id: d.mapel.id,
                        text: d.mapel.nama_mapel
                    }] : [],
                    ajax: {
                        url: "{{ route('search.mapel') }}",
                        dataType: 'json',
                        delay: 250,
                        data: params => ({
                            q: params.term || ''
                        }),
                        processResults: data => ({
                            results: data.map(res => ({
                                id: res.id,
                                text: res.nama_mapel
                            }))
                        }),
                        cache: true
                    }
                });
                if (d.mapel_id && d.mapel && d.mapel.nama_mapel) {
                    const option = new Option(d.mapel.nama_mapel, d.mapel_id, true, true);
                    $mapel.append(option).trigger('change');
                } else {
                    $mapel.val(null).trigger('change');
                }

            }).fail(function(xhr) {
                console.error(xhr.responseText || xhr.statusText);
                alert('Gagal memuat data.');
            });
        });

        $(document).on('click', '#updatePassword', function() {
            const id = $(this).data('id');
            const $modal = $('#modalUpdatePasswordForm');
            const $form = $('#submitUpdatePasswordForm');

            $form.attr('method', 'POST'); // Sementara set ke POST
            $form.append('<input type="hidden" name="_method" value="PUT">'); // Menambahkan _method untuk mengindikasikan PUT

            let actionUrl = "{{ route('admin.password.update', ':id') }}".replace(':id', id);
            let successMessage = 'Data berhasil diubah!';
            submitFormAjaxModal('#submitUpdatePasswordForm', actionUrl, successMessage, '#modalUpdatePasswordForm', table);
        });

        $(document).on('click', '#updateAkun', function() {
            const id = $(this).data('id');
            const $modal = $('#modalUpdateAkunForm');
            const $form = $('#submitUpdateAkunForm');

            $form.attr('method', 'POST'); // Sementara set ke POST
            $form.append('<input type="hidden" name="_method" value="PUT">'); // Menambahkan _method untuk mengindikasikan PUT

            let actionUrl = "{{ route('admin.akun.update', ':id') }}".replace(':id', id);
            let successMessage = 'Data berhasil diubah!';
            submitFormAjaxModal('#submitUpdateAkunForm', actionUrl, successMessage, '#modalUpdateAkunForm', table);

            $.ajax({
                url: "{{ route('admin.akun.edit', ':id') }}".replace(':id', id),
                method: 'GET'
            }).done(function(response) {
                const d = response.data;

                $('#name').val(d.name);
                $('#username').val(d.username);
            }).fail(function(xhr) {
                console.error(xhr.responseText || xhr.statusText);
                alert('Gagal memuat data.');
            });
        });

        $(document).on('click', '#delete', function() {
            var id = $(this).data('id');
            var route = "{{ route('admin.guru.destroy', ':id') }}";
            route = route.replace(':id', id);
            deleteDataAjax(route, table);
        });
    })
</script>
@endpush
@endsection