@extends('layouts.app')

@section('content-title', 'Laporan')
@section('content-subtitle', 'Peringkat Anggota')
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Peringkat Anggota</h3>
      </div>
      <div class="box-body">
        @if (session('status'))
        <div class="alert alert-success" id="message">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          {{ session('status') }}
        </div>
        @endif
        <div class="table-responsive">
          <br><table class="table table-bordered table-striped" id="report">
              <thead>
                  <tr>
                      <th>#</th>
                      <th>Nama</th>
                      <th>Kelas</th>
                      <th>Jurusan</th>
                      <th>Jenis Kelamin</th>
                      <th>Alamat</th>
                      <th>Telepon</th>
                      <th>Rating Pinjam</th>
                      <th>Rating Buku</th>
                  </tr>
              </thead>
              <tbody>
              @foreach($data as $item)
                  <tr>
                      <td>{{ $loop->iteration . '.' }}</td>
                      <td>{{ $item->nama }}</td>
                      <td>{{ $item->kelas }}</td>
                      <td>{{ $item->jurusan }}</td>
                      <td>{{ $item->jenis_kelamin }}</td>
                      <td>{{ $item->alamat }}</td>
                      <td>{{ $item->telepon }}</td>
                      <td>{{ $item->rating_pinjam . " Kali pinjam"}}</td>
                      <td>{{ $item->rating_buku . " Buku"}}</td>
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
@section('script')
  <script type="text/javascript">
    $(document).ready(function() {
        var table = $('#report').DataTable( {
            dom: '<"row"<"col-lg-4"l><"col-lg-4"B><"col-lg-4"f>>rtip',
            buttons: [
            {
                extend : 'excel',
                text : '<i class="fa fa-file-excel-o"></i> Excel',
                title : 'Laporan Anggota',
                exportOptions: {
                  columns: ':visible',
                }
            },{
                extend : 'pdf',
                text : '<i class="fa fa-file-pdf-o"></i> PDF',
                title : 'Laporan Anggota',
                exportOptions: {
                  columns: ':visible',
                }
            },{
                extend : 'print',
                text : '<i class="fa fa-print"></i> Print',
                title : 'Laporan Anggota',
                exportOptions: {
                  columns: ':visible',
                }
            },{
              extend : 'colvis',
              text : '<i class="fa fa-eye"></i>'
            }
            ],
            "language": {
              "lengthMenu": "_MENU_ Data per halaman",
              "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
              "zeroRecords": "Tidak ada data yang cocok",
              "search": "Pencarian :",
            },
        } );
    } );
  </script>
@endsection
