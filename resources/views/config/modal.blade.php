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
                        <label for="config_order">Config Order</label>
                        <input type="text" name="config_order" id="config_order" class="form-control" placeholder="Masukkan Config Order">
                    </div>
                    <div class="form-group">
                        <label for="config_code">Config Code</label>
                        <input type="text" name="config_code" id="config_code" class="form-control" placeholder="Masukkan Config Code">
                    </div>
                    <div class="form-group">
                        <label for="config_name">Config Name</label>
                        <input type="text" name="config_name" id="config_name" class="form-control" placeholder="Masukkan Config Name">
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