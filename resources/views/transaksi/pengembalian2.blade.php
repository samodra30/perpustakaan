@extends('layouts.app')

@section('content-title', 'Transaksi')
@section('content-subtitle', 'Pengembalian')

@section('styletambahan')
  <style type="text/css">
    .modal-dialog {
        position: relative;
        overflow-y: auto;
        width: 60%;
        padding: 15px;
    }
  </style>

@endsection
@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Pengembalian</h3>
      </div>
      <div class="box-body">
        @if (session('status'))
          <div class="alert alert-success" id="message">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session('status') }}
          </div>
        @endif
      <div class="row">
        <div class="col-md-12">
            <p id="selectTriggerFilter"><label><b>Filter Anggota:</b></label><br></p>
            <div class="table-responsive col-md-12">
              <br><table class="table table-bordered table-striped" id="example">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Nama Anggota</th>
                          <th>Judul Buku</th>
                          <th>Tgl. Pinjam</th>
                          <th>Terakhir Kembali</th>
                          <th>Telat</th>
                          <th>Denda</th>
                          <th>Aksi</th>
                      </tr>
                  </thead>
                  <tbody>
                  @foreach($transaksi as $item)
                    @php
                      $terakhir_kembali = \Carbon\Carbon::parse($item->terakhir_kembali);
                      $telat = $terakhir_kembali->diffInDays(date('Y-m-d'), false);
                      $denda = $telat * 500;
                    @endphp
                    @if ($telat < 0)
                        @php
                          $telat = 0;
                          $denda = 0;
                        @endphp
                    @endif
                      <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $item->nama }}</td>
                          <td>{{ $item->judul }}</td>
                          <td>{{ $item->tgl_pinjam }}</td>
                          <td>{{ $item->terakhir_kembali }}</td>
                          <td>{{ $telat . ' Hari'}}</td>
                          <td>{{ 'Rp. ' . $denda }}</td>
                          <td><a href="{{ url('pengembalian/kembali/' . $item->id_transaksi) }}" class="btn btn-warning btn-sm"><i class="fa fa-reply" aria-hidden="true"></i> Kembali</a></td>
                      </tr>
                  @endforeach
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
@section('script')
  <script type="text/javascript">
    $(document).ready(function() {
      var table = $('#example').DataTable({
          "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
          "language": {
            "lengthMenu": "_MENU_ Data per halaman",
            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
            "zeroRecords": "Tidak ada data yang cocok",
            "search": "Pencarian :",
          },
          "deferRender": true,
          initComplete: function() {
            var column = this.api().column(1);

            var select = $('<select class="filter form-control"><option value=""></option></select>')
              .appendTo('#selectTriggerFilter')
              .on('change', function() {
                var val = $(this).val();
                column.search(val ? '^' + $(this).val() + '$' : val, true, false).draw();
              });

            column.data().unique().sort().each(function(d, j) {
              select.append('<option value="' + d + '">' + d + '</option>');
            });
          }
      });
    } );
  </script>
@endsection