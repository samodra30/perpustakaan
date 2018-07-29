@extends('layouts.app')

@section('content-title', 'Master')
@section('content-subtitle', 'Anggota')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Detail Anggota</h3>
      </div>
      <div class="box-body">
        <a href="{{ url('/anggota') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</button></a>
        <a href="{{ url('anggota/edit/' . $anggota->id_anggota) }}" title="Edit Anggota"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

        <form method="POST" action="{{ url('anggota/hapus/' . $anggota->id_anggota) }}" accept-charset="UTF-8" style="display:inline">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger btn-sm" title="Delete Anggota" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
        </form>
        <div class="row">
          <div class="col-md-6">
            <div class="table-responsive">
              <table class="table">
                  <tbody>
                      <tr>
                          <th>ID</th><td>{{ $anggota->id_anggota }}</td>
                      </tr>
                      <tr>
                          <th> Nama </th><td> {{ $anggota->nama }} </td>
                      </tr>
                      <tr>
                          <th> Kelas </th><td> {{ $anggota->kelas }} </td>
                      </tr>
                      <tr>
                          <th> Jurusan </th><td> {{ $anggota->jurusan }} </td>
                      </tr>
                      <tr>
                          <th> Jenis Kelamin </th><td> {{ $anggota->jenis_kelamin }} </td>
                      </tr>
                      <tr>
                          <th> Alamat </th><td> {{ $anggota->alamat }} </td>
                      </tr>
                      <tr>
                          <th> Telepon </th><td> {{ $anggota->telepon }} </td>
                      </tr>
                      <tr>
                          <th> Rating Pinjam </th><td> {{ $anggota->rating_pinjam }} </td>
                      </tr>
                      <tr>
                          <th> Rating Buku </th><td> {{ $anggota->rating_buku }} </td>
                      </tr>
                  </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection