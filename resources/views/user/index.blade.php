@extends('layouts.master')
@section('konten')
<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- jquery validation -->
        <div class="card card-navy">
            <div class="card-header">
                {{-- <h3 class="card-title">Quick Example <small>jQuery Validation</small></h3> --}}
                <button class="btn btn-primary btn-sm" id="btn-tambah" data-toggle="tooltip" data-placement="top" title="Klik disini untuk menambah data user"><i class="fa fa-plus-circle"></i></button>
            </div>
            <div class="card-body">
                {{-- Table Star --}}
                <div class="table-responsive">
                    <!-- Tabel -->
                    <table class="table table-hover" id="tabel_user">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama User</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                    </table>
                    <!-- End Tabel -->
                </div>
                {{-- Table End --}}
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>
@include('user.modal')
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $('#tabel_user').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('users.index') }}",
                type: "GET"
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                }, {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'username',
                    name: 'username'
                }, {
                    data: 'email',
                    name: 'email'
                }, {
                    data: 'role',
                    name: 'role'
                }, {
                    data: 'action',
                    name: 'action'
                }
            ],
            order: [
                [0, 'DESC']
            ]
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //Ketika Tombol Tambah Di Klik
        $('#btn-tambah').click(function(e) {
            e.preventDefault();
            $('#btn-simpan').val('create-post');
            $('#btn-simpan').html('Simpan');
            $('#id').val('');
            $('#modal-tambah-edit').trigger('reset');
            $('#modal-judul').html('Tambah Data User');
            $('#modal-tambah-edit').modal('show');
        });

        // ketika class edit - post yang ada pada tag body di klik maka
        $('body').on('click', '.edit-post', function() {
            var data_id = $(this).data('id');
            $.get('users/' + data_id + '/edit', function(data) {
                $('#modal-judul').html("Edit Data User");
                $('#tombol-simpan').html("Rubah");
                $('#modal-tambah-edit').modal('show');

                //set value masing-masing id berdasarkan data yg diperoleh dari ajax get request diatas               
                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#username').val(data.username);
                $('#role').val(data.role);
                $('#email').val(data.email);
                $('#inisialisasi_id').val(data.inisialisasi_id);
            })
        });
        $('body').on('click', '.edit-storage', function() {
            var data_id2 = $(this).data('id');
            $.get('users/' + data_id2 + '/storage', function(data) {
                $('#modal-judul').html("Edit Maksimal Storage");
                $('#tombol-simpan').html("Rubah");
                $('#modal-storage').modal('show');

                //set value masing-masing id berdasarkan data yg diperoleh dari ajax get request diatas               
                $('#id2').val(data.id);
                $('#maksimal_storage').val(data.maksimal_storage);
            })
        });
        $("body").on('submit', '#form-tambah-edit2', function() {
            e.preventDefault();
            var actionType = $('#btn-simpan2').val();
            $('#btn-simpan2').html('Mengupdate..');
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('users.up_storage') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    $('#form-tambah-edit2').trigger('reset');
                    $('#modal-storage').modal('hide');
                    $('#btn-simpan2').html('Update');
                    var oTable = $('#tabel_user').dataTable();
                    oTable.fnDraw(false);
                    if (data.success === true) {
                        toastr.success(data.pesan, "Sukses!");
                    } else {
                        toastr.error(data.pesan, "Gagal!");
                    }
                },
                error: function(data) {
                    $('#btn-simpan2').html('Update');
                }
            });
        });
        //Simpan dan Edit STore
        $('body').on('submit', '#form-tambah-edit', function(e) {
            e.preventDefault();
            var actionType = $('#btn-simpan').val();
            $('#btn-simpan').html('Menyimpan..');
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('users.store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    $('#form-tambah-edit').trigger('reset');
                    $('#modal-tambah-edit').modal('hide');
                    $('#btn-simpan').html('Save Changes');
                    var oTable = $('#tabel_user').dataTable();
                    oTable.fnDraw(false);
                    if (data.success === true) {
                        toastr.success(data.pesan, "Sukses!");
                    } else {
                        toastr.error(data.pesan, "Gagal!");
                    }
                },
                error: function(data) {
                    $('#btn-simpan').html('Simpan');
                }
            });
        });

        //Hapus Data
        //Ketika Tombol hapus di klik keluar Modal Hapus 
        $(document).on('click', '.delete', function() {
            dataId = $(this).attr('id');
            $('#konfirmasi-modal').modal('show');
        });
        //jika tombol hapus pada modal konfirmasi di klik maka
        $('#tombol-hapus').click(function() {
            $.ajax({

                url: "users/" + dataId, //eksekusi ajax ke url ini
                type: 'delete',
                beforeSend: function() {
                    $('#tombol-hapus').text('Menghapus...'); //set text untuk tombol hapus
                },
                success: function(data) { //jika sukses
                    setTimeout(function() {
                        $('#konfirmasi-modal').modal(
                            'hide'); //sembunyikan konfirmasi modal
                        var oTable = $('#tabel_user').dataTable();
                        oTable.fnDraw(false); //reset datatable
                    });
                    toastr.success( //tampilkan toastr warning
                        'Data Berhasil Dihapus',
                    );
                }
            })
        });
    });

    //Navigasi

    $('#user').addClass('active');
</script>
@endsection