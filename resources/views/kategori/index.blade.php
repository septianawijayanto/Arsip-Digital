@extends('layouts.master')
@section('konten')
<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- jquery validation -->
        <div class="card card-navy">
            <div class="card-header">
                {{-- <h3 class="card-title">Quick Example <small>jQuery Validation</small></h3> --}}
                <button class="btn btn-primary btn-sm" id="btn-tambah" data-toggle="tooltip" data-placement="top" title="Klik disini untuk menambah data kategori"><i class="fa fa-plus-circle"></i></button>
            </div>
            <div class="card-body">
                {{-- Table Star --}}
                <div class="table-responsive">
                    <!-- Tabel -->
                    <table class="table table-hover" id="tabel_kategori">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Kategori</th>
                                <th>Nama Kategori</th>
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
@include('kategori.modal')
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $('#tabel_kategori').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('kategori.index') }}",
                type: "GET"
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                }, {
                    data: 'kode_kategori',
                    name: 'kode_kategori'
                },
                {
                    data: 'nama_kategori',
                    name: 'nama_kategori'
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
            $('#modal-judul').html('Tambah Data Kategori');
            $('#modal-tambah-edit').modal('show');
        });

        // ketika class edit - post yang ada pada tag body di klik maka
        $('body').on('click', '.edit-post', function() {
            var data_id = $(this).data('id');
            $.get('kategori/' + data_id + '/edit', function(data) {
                $('#modal-judul').html("Edit Data Kategori");
                $('#tombol-simpan').html("Rubah");
                $('#modal-tambah-edit').modal('show');

                //set value masing-masing id berdasarkan data yg diperoleh dari ajax get request diatas               
                $('#id').val(data.id);
                $('#kode_kategori').val(data.kode_kategori);
                $('#nama_kategori').val(data.nama_kategori);
            })
        });


        //Simpan dan Edit STore
        $('body').on('submit', '#form-tambah-edit', function(e) {
            e.preventDefault();
            var actionType = $('#btn-simpan').val();
            $('#btn-simpan').html('Menyimpan..');
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('kategori.store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    $('#form-tambah-edit').trigger('reset');
                    $('#modal-tambah-edit').modal('hide');
                    $('#btn-simpan').html('Save Changes');
                    var oTable = $('#tabel_kategori').dataTable();
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

                url: "kategori/" + dataId, //eksekusi ajax ke url ini
                type: 'delete',
                beforeSend: function() {
                    $('#tombol-hapus').text('Menghapus...'); //set text untuk tombol hapus
                },
                success: function(data) { //jika sukses
                    setTimeout(function() {
                        $('#konfirmasi-modal').modal(
                            'hide'); //sembunyikan konfirmasi modal
                        var oTable = $('#tabel_kategori').dataTable();
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

    $('#menuMaster').addClass('active');
    $('#liMaster').addClass('menu-open');
    $('#kategori').addClass('active');
</script>
@endsection