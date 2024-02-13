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
                        <label for="display_menu">Display Menu</label>
                        <input type="text" name="display_menu" id="display_menu" class="form-control" placeholder="Masukkan Display Menu">
                    </div>
                    <div class="form-group">
                        <label for="url">Url</label>
                        <input type="text" name="url" id="url" class="form-control" placeholder="Masukkan Url">
                    </div>
                    <div class="form-group">
                        <label for="controller">Controller</label>
                        <input type="text" name="controller" id="controller" class="form-control" placeholder="Masukkan Controller">
                    </div>
                    <div class="form-group">
                        <label>Posisi</label>
                        <div>
                            <select name="posisi" id="posisi" class="form-control">
                                <option value="">-Pilih-</option>
                                <option value="Root">Root</option>
                                <option value="Sub">Sub</option>

                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nourut">No Urut</label>
                        <input type="text" name="nourut" id="nourut" class="form-control" placeholder="Masukkan No Urut">
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