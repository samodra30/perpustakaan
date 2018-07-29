@extends('layouts.app')

@section('content-title', 'Laporan')
@section('content-subtitle', 'Kas Masuk')
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Kas Masuk</h3>
      </div>
      <div class="box-body">
        @if (session('status'))
        <div class="alert alert-success" id="message">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          {{ session('status') }}
        </div>
        @endif
        <div class="row">
          <div class="col-md-4">
            <h4>Total Kas Masuk : {{ "Rp. " . number_format($pemasukan, 2, ',', '.') }}</h4>
          </div>
        </div>
        <div class="table-responsive">
          <br><table class="table table-bordered table-striped" id="report">
              <thead>
                  <tr>
                      <th>#</th>
                      <th>Tanggal</th>
                      <th>Pemasukan</th>
                      <th>Keterangan</th>
                      <th>Operator</th>
                  </tr>
              </thead>
              <tbody>
                @foreach($data as $item)
                @php
                  $tanggal = new DateTime($item->tanggal);
                @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ date_format($tanggal, 'd-m-Y') }}</td>
                        <td>{{ "Rp. " . number_format($item->pemasukan, 0, ',', '.') }}</td>
                        <td>{{ $item->keterangan }}</td>
                        <td>{{ $item->name }}</td>
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

        table.buttons().container()
        .appendTo( '#example_wrapper .col-sm-6:eq(0)' );
    } );
  </script>
@endsection