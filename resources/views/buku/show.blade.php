@extends('layouts.app')

@section('content-title', 'Master')
@section('content-subtitle', 'Buku')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Buku</h3>
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
            <a href="{{ url('buku/create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
          
          </div>
        </div>
        <div class="table-responsive">
          <br><table class="table table-bordered table-striped" id="example1">
              <thead>
                  <tr>
                      <th>#</th>
                      <th>Judul</th>
                      <th>Pengarang</th>
                      <th>Penerbit</th>
                      <th>Tahun</th>
                      <th>Rak</th>
                      <th>Aksi</th>
                  </tr>
              </thead>
              <tbody>
              @foreach($data as $item)
                  <tr>
                      <td>{{ $loop->iteration or $item->id_buku }}</td>
                      <td>{{ $item->judul }}</td>
                      <td>{{ $item->pengarang }}</td>
                      <td>{{ $item->penerbit }}</td>
                      <td>{{ $item->tahun }}</td>
                      <td>{{ $item->rak }}</td>
                      <td>
                          <a href="{{ url('/buku/view/' . $item->id_buku) }}" title="View buku"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                          <a href="{{ url('/buku/edit/' . $item->id_buku) }}" title="Edit buku"><button class="btn btn-warning btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                          <form method="POST" action="{{ url('/buku/hapus/' . $item->id_buku) }}" accept-charset="UTF-8" style="display:inline">
                              {{ method_field('DELETE') }}
                              {{ csrf_field() }}
                              <button type="submit" class="btn btn-danger btn-sm" title="Delete buku" onclick="return confirm(&quot;Anda yakin ingin menghapus data ini?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
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