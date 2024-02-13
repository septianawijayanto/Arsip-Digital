@extends('layouts.master')
@section('konten')
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-navy">
                <div class="card-body">
                    <form action="{{ route('simpan.password') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="password-old">Password Lama</label>
                            <input id="password-old" type="password" class="form-control" name="password_lama"
                                autocomplete="old-password">
                        </div>
                        <div class="form-group">
                            <label for="password">Password Baru</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" autocomplete="new-password">
                        </div>
                        <div class="form-group">
                            <label for="password-confirm">Konfirmasi Password</label>
                            <input id="password-confirm" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password_confirmation"
                                autocomplete="new-password">
                        </div>
                        <div class="card-footer">
                            <!-- <a href="#" name="kembali" class="btn btn-default" id="back"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a> &nbsp; -->
                            <button name="submit" class="btn btn-primary"><i class="nav-icon"></i>Reset</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
