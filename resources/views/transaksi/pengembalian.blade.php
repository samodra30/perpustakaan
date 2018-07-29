@extends('layouts.app')

@section('content-title', 'Transaksi')
@section('content-subtitle', 'Peminjaman')

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
        @if (session('status2'))
          <div class="alert alert-success" id="message">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session('status2') }}
          </div>
        @endif
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ url('pengembalian/kembali') }}">
          {!! csrf_field() !!}
            {{-- <div class="form-group">
              <label>Anggota</label>
                <select class="form-control" name="id_anggota" id="anggota">
                  <option value="all" hidden="">Nama Anggota</option>
                  @foreach ($anggota as $item)
                    <option value="{{ $item->id_anggota }}">{{ $item->nama }}</option>
                  @endforeach
                </select>
            </div> --}}
            <p id="selectTriggerFilter"><label><b>Filter:</b></label><br></p>
            <div class="table-responsive">
              <br><table class="table table-bordered table-striped" id="example">
                  <thead>
                      <tr>
                          <th></th>
                          <th>#</th>
                          <th>Nama Anggota</th>
                          <th>Judul Buku</th>
                          <th>Tgl. Pinjam</th>
                          <th>Terakhir Kembali</th>
                          <th>Telat</th>
                          <th>Denda</th>
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
                          <td><input type="checkbox" name="id_buku[]" id="id_buku" value="{{ $item->id_buku }}"></td>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $item->nama }}</td>
                          <td>{{ $item->judul }}</td>
                          <td>{{ $item->tgl_pinjam }}</td>
                          <td>{{ $item->terakhir_kembali }}</td>
                          <td>{{ $telat . ' Hari'}}</td>
                          <td>{{ 'Rp. ' . $denda }}</td>
                      </tr>
                  @endforeach
                  </tbody>
              </table>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
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
    "deferRender": true,
    initComplete: function() {
      var column = this.api().column(2);

      var select = $('<select class="filter" name="id_anggota"><option value=""></option></select>')
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