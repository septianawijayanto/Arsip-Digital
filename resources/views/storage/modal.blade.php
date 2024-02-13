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
                        <label for="kode_storage">Kode</label>
                        <input type="text" name="kode_storage" id="kode_storage" value="{{$kode}}" readonly class="form-control" placeholder="Masukkan Kode">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan Nama">
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <div>
                            <select name="kategori_id" id="kategori_id" class="form-control">
                                <option value="">-Pilih-</option>
                                @foreach($kategori as $item)
                                <option value="{{$item->id}}">{{$item->kode_kategori}} ({{$item->nama_kategori}})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="file">File</label>
                        <input type="file" name="file" id="file" class="form-control" placeholder="Masukkan File">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3" placeholder="Enter ..."></textarea>

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