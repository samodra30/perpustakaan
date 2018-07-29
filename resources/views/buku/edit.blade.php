@extends('layouts.app')

@section('content-title', 'Master')
@section('content-subtitle', 'Buku')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Edit Buku</h3>
      </div>
      <div class="box-body">
        @if (session('status'))
        <div class="alert alert-success">
          {{ session('status') }}
        </div>
        @endif
        <form action="{{ url('buku/update/' . $buku->id_buku) }}" method="POST" role="form">
          {!! csrf_field() !!}
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Judul</label>
                <input type="text" class="form-control" placeholder="Judul" name="judul" value="{{ $buku->judul }}">
              </div>
              <div class="form-group">
                <label>Pengarang</label>
                <input type="text" class="form-control" placeholder="Pengarang" name="pengarang" value="{{ $buku->pengarang }}">
              </div>
              <div class="form-group">
                <label>Penerbit</label>
                <input type="text" class="form-control" placeholder="Penerbit" name="penerbit" value="{{ $buku->penerbit }}">
              </div>
              <div class="form-group">
                <label>Tahun</label>
                <input type="text" class="form-control" placeholder="Tahun" name="tahun" value="{{ $buku->tahun }}">
              </div>
              <div class="form-group">
                <label>Halaman</label>
                <input type="text" class="form-control" placeholder="Halaman" name="halaman" value="{{ $buku->halaman }}">
              </div>
              <div class="form-group">
                <label>Kategori</label>
                <input type="text" class="form-control" placeholder="Kategori" name="kategori" value="{{ $buku->kategori }}">
              </div>
              <div class="form-group">
                <label>Stok</label>
                <input type="text" class="form-control" placeholder="Stok" name="stok" value="{{ $buku->stok }}">
              </div>
              <div class="form-group">
                <label>Rak</label>
                <input type="text" class="form-control" placeholder="Rak" name="rak" value="{{ $buku->rak }}">
              </div>
              <div align="right">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ url('buku') }}" class="btn btn-danger">Batal</a>  
              </div>
            </div>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>
@endsection
