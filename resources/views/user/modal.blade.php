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
                        <label for="name">Nama User</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan Nama User">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan Username">
                    </div>
                    <div class="form-group">
                        <label for="gambar">Photo</label>
                        <input type="file" name="gambar" id="gambar" class="form-control" placeholder="Masukkan Photo">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan Email">
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <div>
                            <select name="role" id="role" class="form-control">
                                <option value="">-Pilih-</option>
                                @foreach($role as $item)
                                <option value="{{$item->config_name}}">{{$item->config_name}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan Password">
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
<div class="modal fade" id="modal-storage">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-judul">Default Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-tambah-edit2" enctype="multipart/form-data">
                    <input type="text" name="id2" class="form-control" id="id2">
                    <div class="form-group">
                        <label for="maksimal_storage">Maksimal Storage</label>
                        <input type="text" name="maksimal_storage" id="maksimal_storage" class="form-control" placeholder="Masukkan Maksimal Storage">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal" data-toggle="tooltip" data-placement="top" title="Klik disini untuk menutup modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" id="btn-simpan2" data-toggle="tooltip" data-placement="top" title="Klik disini untuk meyimpan data">Update</button>
                    </div>
                </form>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
{{-- Modal End --}}