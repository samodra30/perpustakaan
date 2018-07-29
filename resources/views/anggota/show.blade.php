@extends('layouts.app')

@section('content-title', 'Master')
@section('content-subtitle', 'Anggota')
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Anggota</h3>
      </div>
      <div class="box-body">
        @if (session('status'))
        <div class="alert alert-success" id="message">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          {{ session('status') }}
        </div>
        @endif
        <div class="row">
          <div class="col-md-6">
            <a href="{{ url('anggota/create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
          
          </div>
          
        </div>
        <div class="table-responsive">
          <br><table class="table table-bordered table-striped" id="example1">
              <thead>
                  <tr>
                      <th>#</th>
                      <th>Nama</th>
                      <th>Kelas</th>
                      <th>Jurusan</th>
                      <th>Jenis Kelamin</th>
                      <th>Rating Pinjam</th>
                      <th>Rating Buku</th>
                      <th>Aksi</th>
                  </tr>
              </thead>
              <tbody>
              @foreach($data as $item)
                  <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $item->nama }}</td>
                      <td>{{ $item->kelas }}</td>
                      <td>{{ $item->jurusan }}</td>
                      <td>{{ $item->jenis_kelamin }}</td>
                      <td>{{ $item->rating_pinjam }}</td>
                      <td>{{ $item->rating_buku }}</td>
                      <td>
                          <a href="{{ url('/anggota/view/' . $item->id_anggota) }}" title="View Anggota"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                          <a href="{{ url('/anggota/edit/' . $item->id_anggota) }}" title="Edit Anggota"><button class="btn btn-warning btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                          <form method="POST" action="{{ url('/anggota/hapus/' . $item->id_anggota) }}" accept-charset="UTF-8" style="display:inline">
                              {{ method_field('DELETE') }}
                              {{ csrf_field() }}
                              <button type="submit" class="btn btn-danger btn-sm" title="Delete Anggota" onclick="return confirm(&quot;Anda yakin ingin menghapus data ini?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                          </form>
                      </td>
                  </tr>
              @endforeach
              </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
