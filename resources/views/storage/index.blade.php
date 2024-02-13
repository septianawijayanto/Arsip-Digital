@extends('layouts.master')
@section('konten')
<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- jquery validation -->
        <div class="card card-navy">
            <div class="card-header">
                {{-- <h3 class="card-title">Quick Example <small>jQuery Validation</small></h3> --}}
                <button class="btn btn-primary btn-sm" id="btn-tambah" data-toggle="tooltip" data-placement="top" title="Klik disini untuk menambah data storage"><i class="fa fa-plus-circle"></i></button>
            </div>
            <div class="card-body">
                {{-- Table Star --}}
                <div class="table-responsive">
                    <!-- Tabel -->
                    <table class="table table-hover" id="tabel_user">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>User</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Tanggal</th>
                                <th>Size</th>
                                <th>Gambar</th>
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
@include('storage.modal')
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $('#tabel_user').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('storage.index') }}",
                type: "GET"
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                }, {
                    data: 'kode_storage',
                    name: 'kode_storage'
                }, {
                    data: 'siapa',
                    name: 'siapa'
                },
                {
                    data: 'nama',
                    name: 'nama'
                }, {
                    data: 'kategori',
                    name: 'kategori'
                }, {
                    data: 'tanggal',
                    name: 'tanggal'
                }, {
                    data: 'size',
                    name: 'size'
                }, {
                    data: 'file',
                    name: 'file',
                    render: function(data, type, full, meta) {
                        // Mendapatkan ekstensi file
                        var fileExtension = data.split('.').pop();
                        // Cek jika file adalah gambar
                        if (fileExtension.match(/(jpg|jpeg|png|gif)$/i)) {
                            // Jika iya, tampilkan gambar
                            return '<img src="{{ asset("file") }}/' + data + '" style="max-width: 100px; max-height: 100px;" />';
                        } else if (fileExtension.match(/(pdf)$/i)) {
                            // Jika bukan, dan file adalah PDF, tampilkan URL
                            return '<a href="{{ asset("file") }}/' + data + '">PDF Link</a>';
                        } else if (fileExtension.match(/(doc|docx)$/i)) {
                            // Jika file adalah dokumen Word, tampilkan tautan untuk mengunduh dokumen
                            return '<a href="{{ asset("file") }}/' + data + '" download>Download Word Document</a>';
                        } else if (fileExtension.match(/(xls|xlsx)$/i)) {
                            // Jika file adalah dokumen Excel, tampilkan tautan untuk mengunduh dokumen
                            return '<a href="{{ asset("file") }}/' + data + '" download>Download Excel Document</a>';
                        } else {
                            // Jika bukan keduanya, mungkin Anda ingin menambahkan logika untuk jenis file lainnya
                            return 'Tipe file tidak didukung';
                        }
                    }
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
            $('#modal-judul').html('Tambah Data');
            $('#modal-tambah-edit').modal('show');
        });

        // ketika class edit - post yang ada pada tag body di klik maka
        $('body').on('click', '.edit-post', function() {
            var data_id = $(this).data('id');
            $.get('storage/' + data_id + '/edit', function(data) {
                $('#modal-judul').html("Edit Data");
                $('#tombol-simpan').html("Rubah");
                $('#modal-tambah-edit').modal('show');

                //set value masing-masing id berdasarkan data yg diperoleh dari ajax get request diatas               
                $('#id').val(data.id);
                $('#kode_storage').val(data.kode_storage);
                $('#nama').val(data.nama);
                $('#tanggal').val(data.tanggal);
                $('#deskripsi').val(data.deskripsi);
                $('#kategori_id').val(data.kategori_id);
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
                url: "{{ route('storage.store') }}",
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

                url: "storage/" + dataId, //eksekusi ajax ke url ini
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

    $('#storage').addClass('active');
</script>
@endsection