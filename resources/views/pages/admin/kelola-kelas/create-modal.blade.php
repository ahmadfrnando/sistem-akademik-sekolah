<div class="modal fade text-left" id="modalForm" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel4" data-bs-backdrop="false" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel4"></h4>
                <button type="button" class="close" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form id="submitForm">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="kelas_id" id="kelas_id" readonly>
                    <input type="hidden" name="nama_kelas" id="nama_kelas" readonly>
                    <div class="mb-4">
                        <label for="guru_id">Nama Guru</label>
                        <select id="guru_id" name="guru_id" style="width: 100%; height: 100%" required>
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