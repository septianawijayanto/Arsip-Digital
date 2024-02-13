@extends('layouts.master')
@section('konten')
<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- jquery validation -->
        <div class="card card-navy">
            <div class="card-header">
                {{-- <h3 class="card-title">Quick Example <small>jQuery Validation</small></h3> --}}
                <button class="btn btn-primary btn-sm" id="btn-tambah" data-toggle="tooltip" data-placement="top" title="Klik disini untuk menambah data cabang"><i class="fa fa-plus-circle"></i></button>
            </div>
            <div class="card-body">
                {{-- Table Star --}}
                <div class="table-responsive">
                    <!-- Tabel -->
                    <table class="table table-hover" id="tabel_cabang">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Cabang</th>
                                <th>Nama Cabang</th>
                                <th>Alamat</th>
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
@include('cabang.modal')
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $('#tabel_cabang').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('cabang.index') }}",
                type: "GET"
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                }, {
                    data: 'kode_cabang',
                    name: 'kode_cabang'
                },
                {
                    data: 'nama_cabang',
                    name: 'nama_cabang'
                }, {
                    data: 'alamat',
                    name: 'alamat'
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
            $('#modal-judul').html('Tambah Data Cabang');
            $('#modal-tambah-edit').modal('show');
        });

        // ketika class edit - post yang ada pada tag body di klik maka
        $('body').on('click', '.edit-post', function() {
            var data_id = $(this).data('id');
            $.get('cabang/' + data_id + '/edit', function(data) {
                $('#modal-judul').html("Edit Data Cabang");
                $('#tombol-simpan').html("Rubah");
                $('#modal-tambah-edit').modal('show');

                //set value masing-masing id berdasarkan data yg diperoleh dari ajax get request diatas               
                $('#id').val(data.id);
                $('#kode_cabang').val(data.kode_cabang);
                $('#nama_cabang').val(data.nama_cabang);
                $('#alamat').val(data.alamat);
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
                url: "{{ route('cabang.store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    $('#form-tambah-edit').trigger('reset');
                    $('#modal-tambah-edit').modal('hide');
                    $('#btn-simpan').html('Save Changes');
                    var oTable = $('#tabel_cabang').dataTable();
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

                url: "cabang/" + dataId, //eksekusi ajax ke url ini
                type: 'delete',
                beforeSend: function() {
                    $('#tombol-hapus').text('Menghapus...'); //set text untuk tombol hapus
                },
                success: function(data) { //jika sukses
                    setTimeout(function() {
                        $('#konfirmasi-modal').modal(
                            'hide'); //sembunyikan konfirmasi modal
                        var oTable = $('#tabel_cabang').dataTable();
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
    $('#cabang').addClass('active');
</script>
@endsection