@extends('layouts.app')

@section('content-title', 'Master')
@section('content-subtitle', 'Anggota')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Tambah Anggota</h3>
      </div>
      <div class="box-body">
        @if (session('status'))
        <div class="alert alert-success">
          {{ session('status') }}"
        </div>
        @endif
        @if ($errors->any())
          <div class="alert alert-danger">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}"</li>
                  @endforeach
              </ul>
          </div>
        @endif
        <form action="{{ url('anggota/store') }}"" method="POST" role="form">
          {!! csrf_field() !!}
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" placeholder="Nama" name="nama" value="{{ old('nama') }}">
              </div>
              <div class="form-group">
                <label>Kelas</label>
                <select class="form-control" name="kelas">
                  <option value="" hidden="">Kelas</option>
                  @php
                    $kelas = ['X', 'XI', 'XII'];
                  @endphp
                  @foreach ($kelas as $list)
                    <option value="{{ $list }}" {{ old('kelas') == $list ? 'selected':'' }}>{{ $list }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Jurusan</label>
                <select class="form-control" name="jurusan">
                  @php
                    $jurusan = ['Rekayasa Perangkat Lunak', 'Teknik Gambar Bangunan', 'Teknik Elektronika Industri', 'Teknik Otomasi Industri', 'Teknik Sepeda Motor', 'Teknik Las', 'Teknik Permesinan', 'Teknik Konstruksi Kayu'];
                  @endphp
                  <option value="" hidden="">Jurusan</option>
                  @foreach ($jurusan as $list)
                    <option value="{{ $list }}" {{ old('jurusan') == $list ? 'selected':'' }}>{{ $list }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Jenis Kelamin</label>
                <div class="radio">
                  @php
                    $jenkel = ['Laki-Laki', 'Perempuan'];
                  @endphp
                  @foreach ($jenkel as $list)
                    <label class="col-md-4">
                      <input type="radio" name="jenis_kelamin" value="{{ $list }}" {{ (old('jenis_kelamin') == $list ? 'checked':'') }}> {{ $list }}
                    </label>
                  @endforeach
                </div>
              </div><br>
              <div class="form-group">
                <label>Alamat</label>
                <input type="text" class="form-control" placeholder="Alamat" name="alamat" value="{{ old('alamat') }}">
              </div>
              <div class="form-group">
                <label>Telepon</label>
                <input type="text" class="form-control" placeholder="Telepon" name="telepon" value="{{ old('telepon') }}">
              </div>
              <div align="right">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ url('anggota') }}"" class="btn btn-danger">Batal</a>  
              </div>
            </div>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>
@endsection
