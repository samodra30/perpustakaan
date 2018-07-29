@extends('layouts.app')

@section('content-title', 'Master')
@section('content-subtitle', 'Anggota')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Edit Anggota</h3>
      </div>
      <div class="box-body">
        @if (session('status'))
        <div class="alert alert-success">
          {{ session('status') }}
        </div>
        @endif
        <form action="{{ url('anggota/update/' . $anggota->id_anggota) }}" method="POST" role="form">
          {!! csrf_field() !!}
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" placeholder="Nama" name="nama" value="{{ $anggota->nama }}">
              </div>
              <div class="form-group">
                <label>Kelas</label>
                <select class="form-control" name="kelas">
                  <option value="X" {{ $anggota->kelas == 'X' ? 'selected' : '' }}>X</option>
                  <option value="XI" {{ $anggota->kelas == 'XI' ? 'selected' : '' }}>XI</option>
                  <option value="XII" {{ $anggota->kelas == 'XII' ? 'selected' : '' }}>XII</option>
                </select>
              </div>
              <div class="form-group">
                <label>Jurusan</label>
                <select class="form-control" name="jurusan">
                  <option value="Rekayasa Perangkat Lunak" {{ $anggota->jurusan == 'Rekayasa Perangkat Lunak' ? 'selected' : '' }}>Rekayasa Perangkat Lunak</option>
                  <option value="Teknik Gambar Bangunan" {{ $anggota->jurusan == 'Teknik Gambar Bangunan' ? 'selected' : '' }}>Teknik Gambar Bangunan</option>
                  <option value="Teknik Elektronika Industri" {{ $anggota->jurusan == 'Teknik Elektronika Industri' ? 'selected' : '' }}>Teknik Elektronika Industri</option>
                  <option value="Teknik Otomasi Industri" {{ $anggota->jurusan == 'Teknik Otomasi Industri' ? 'selected' : '' }}>Teknik Otomasi Industri</option>
                  <option value="Teknik Sepeda Motor" {{ $anggota->jurusan == 'Teknik Sepeda Motor' ? 'selected' : '' }}>Teknik Sepeda Motor</option>
                  <option value="Teknik Las" {{ $anggota->jurusan == 'Teknik Las' ? 'selected' : '' }}>Teknik Las</option>
                  <option value="Teknik Permesinan" {{ $anggota->jurusan == 'Teknik Permesinan' ? 'selected' : '' }}>Teknik Permesinan</option>
                  <option value="Teknik Konstruksi Kayu" {{ $anggota->jurusan == 'Teknik Konstruksi Kayu' ? 'selected' : '' }}>Teknik Konstruksi Kayu</option>
                </select>
              </div>
              <div class="form-group">
                <label>Jenis Kelamin</label>
                <div class="radio">
                  <label class="col-md-4">
                    <input type="radio" name="jenis_kelamin" id="laki-laki" value="Laki-Laki" {{ $anggota->jenis_kelamin == 'Laki-Laki' ? 'checked' : '' }}> Laki-Laki
                  </label>
                  <label class="col-md-4">
                    <input type="radio" name="jenis_kelamin" id="perempuan" value="Perempuan" {{ $anggota->jenis_kelamin == 'Perempuan' ? 'checked' : '' }}> Perempuan
                  </label>
                </div>
              </div><br>
              <div class="form-group">
                <label>Alamat</label>
                <input type="text" class="form-control" placeholder="Alamat" name="alamat" value="{{ $anggota->alamat }}">
              </div>
              <div class="form-group">
                <label>Telepon</label>
                <input type="text" class="form-control" placeholder="Telepon" name="telepon" value="{{ $anggota->telepon }}">
              </div>
              <div align="right">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ url('anggota') }}" class="btn btn-danger">Batal</a>  
              </div>
            </div>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>
@endsection
