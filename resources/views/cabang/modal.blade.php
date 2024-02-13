{{-- Modal Star --}}
<div class="modal fade" id="modal-tambah-edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-judul">Default Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-tambah-edit" enctype="multipart/form-data">
                    <input type="hidden" name="id" class="form-control" id="id">
                    <div class="form-group">
                        <label for="kode_cabang">Kode Cabang</label>
                        <input type="text" name="kode_cabang" id="kode_cabang" class="form-control" placeholder="Masukkan Kode Cabang">
                    </div>
                    <div class="form-group">
                        <label for="nama_cabang">Nama Cabang</label>
                        <input type="text" name="nama_cabang" id="nama_cabang" class="form-control" placeholder="Masukkan Nama Cabang">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="4" required></textarea>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal" data-toggle="tooltip" data-placement="top" title="Klik disini untuk menutup modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" id="btn-simpan" data-toggle="tooltip" data-placement="top" title="Klik disini untuk meyimpan data">Save changes</button>
                    </div>
                </form>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
{{-- Modal End --}}