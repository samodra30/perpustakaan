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
  <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />

@endsection
@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Peminjaman</h3>
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
          <form method="post" action="{{ url('peminjaman/pinjam') }}">
          {!! csrf_field() !!}
            <div class="form-group">
              <label>Anggota</label>
                <select class="form-control" name="id_anggota">
                  <option value="" hidden="">Nama Anggota</option>
                  @foreach ($anggota as $item)
                    <option value="{{ $item->id_anggota }}">{{ $item->nama }}</option>
                  @endforeach
                </select>
            </div>
            <div class="form-group">
              <label>Buku</label>
              <select class="form-control select2" name="buku[]" multiple="multiple" placeholder="Pilih buku . ." style="width: 100%">
                @foreach ($buku as $item)
                  <option value="{{ $item->id_buku }}">{{ $item->judul }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>Tgl. Kembali</label>
              <input type="date" name="tgl_kembali" class="form-control">
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
  <script src="{{ asset('js/select2.full.min.js') }}"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $('.select2').select2();
      $("#example2").DataTable({
          "lengthMenu": 5,
          "lengthChange" : false,
          "language": {
            "lengthMenu": "_MENU_ Data per halaman",
            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entries",
            "zeroRecords": "Tidak ada data yang cocok",
            "search": "Pencarian :",
          }
      });
    });
    
  </script>
@endsection