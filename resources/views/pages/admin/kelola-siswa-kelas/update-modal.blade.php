<div class="modal fade text-left" id="updateModalForm" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel4" data-bs-backdrop="false" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel4">Ubah Kelas Siswa</h4>
                <button type="button" class="close" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form id="updateForm">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" name="siswa_id" id="siswa_id" readonly>
                    <div class="mb-4">
                        <label for="update_kelas_id">Nama Kelas</label>
                        <select id="update_kelas_id" name="update_kelas_id" style="width: 100%; height: 100%" required>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary"
                        data-bs-dismiss="modal">
                        <i class="bi bi-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Tutup</span>
                    </button>
                    <button type="submit" id="btnSubmit" class="btn btn-primary ms-1">
                        <i class="bi bi-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Simpan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>