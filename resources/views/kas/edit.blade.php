@extends('layouts.app')

@section('content-title', 'Kas')
@section('content-subtitle', 'Edit')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Edit</h3>
      </div>
      <div class="box-body">
        @if (session('status'))
        <div class="alert alert-success">
          {{ session('status') }}"
        </div>
        @endif
        <form action="{{ url('kas/update/' . $kas->id_kas) }}" method="POST" role="form">
          {!! csrf_field() !!}
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Pemasukan</label>
                <div class="input-group">
                  <span class="input-group-addon">Rp.</span>
                    <input type="text" class="form-control" placeholder="Pemasukan" name="pemasukan" value="{{ $kas->pemasukan }}" {{ $kas->pemasukan == '0' ? 'disabled' : 'required' }}>
                  <span class="input-group-addon">.00</span>
                </div>
              </div>
              <div class="form-group">
                <label>Pengeluaran</label>
                <div class="input-group">
                  <span class="input-group-addon">Rp.</span>
                    <input type="text" class="form-control" placeholder="Pengeluaran" name="pengeluaran" value="{{ $kas->pengeluaran }}" {{ $kas->pengeluaran == '0' ? 'disabled' : 'required' }}>
                  <span class="input-group-addon">.00</span>
                </div>
              </div>
              <div class="form-group">
                <label>Keterangan</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                  <input type="text" class="form-control" placeholder="Keterangan" name="keterangan" value="{{ $kas->keterangan }}">
                </div>
              </div>
              <div align="right">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ url('kas') }}"" class="btn btn-danger">Batal</a>  
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
