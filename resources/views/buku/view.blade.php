@extends('layouts.app')

@section('content-title', 'Master')
@section('content-subtitle', 'Buku')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Detail Buku</h3>
      </div>
      <div class="box-body">
        <a href="{{ url('/buku') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</button></a>
        <a href="{{ url('buku/edit/' . $buku->id_buku) }}" title="Edit Buku"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

        <form method="POST" action="{{ url('buku/hapus/' . $buku->id_buku) }}" accept-charset="UTF-8" style="display:inline">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger btn-sm" title="Delete Buku" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
        </form>
        <div class="row">
          <div class="col-md-6">
            <div class="table-responsive">
              <table class="table">
                  <tbody>
                      <tr>
                          <th>ID Buku</th><td>{{ $buku->id_buku }}</td>
                      </tr>
                      <tr>
                          <th> Judul </th><td> {{ $buku->judul }} </td>
                      </tr>
                      <tr>
                          <th> Pengarang </th><td> {{ $buku->pengarang }} </td>
                      </tr>
                      <tr>
                          <th> Penerbit </th><td> {{ $buku->penerbit }} </td>
                      </tr>
                      <tr>
                          <th> Tahun </th><td> {{ $buku->tahun }} </td>
                      </tr>
                      <tr>
                          <th> Halaman </th><td> {{ $buku->halaman }} </td>
                      </tr>
                      <tr>
                          <th> Kategori </th><td> {{ $buku->kategori }} </td>
                      </tr>
                      <tr>
                          <th> Stok </th><td> {{ $buku->stok }} </td>
                      </tr>
                      <tr>
                          <th> Rak </th><td> {{ $buku->rak }} </td>
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