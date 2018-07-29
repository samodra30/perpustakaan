@extends('layouts.app')

@section('content-title', 'Home')
@section('content-subtitle', 'Dashboard')
@php
  $pinjamHarian = array();
  $totalPinjam = array();

  foreach ($pinjam as $item) {
      $pinjamHarian[] = $item->tgl_pinjam;
      $totalPinjam[] = $item->total_pinjam;
  }
  $tglPinjam = array_map(function ($date) {
      return date('d/m/Y', strtotime($date));
  }, $pinjamHarian);

  $kembaliHarian = array();
  $totalKembali = array();

  foreach ($kembali as $item) {
      $kembaliHarian[] = $item->tgl_kembali;
      $totalKembali[] = $item->total_kembali;
  }
  $tglKembali = array_map(function ($date) {
      return date('d/m/Y', strtotime($date));
  }, $kembaliHarian);

@endphp
@section('content')
<div class="row">
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Anggota</span>
        <span class="info-box-number">{{ $countAnggota }}</span>
      </div>
    </div>
  </div>
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-red"><i class="fa fa-book"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Buku</span>
        <span class="info-box-number">{{ $countBuku }}</span>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-green"><i class="fa fa-money"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Saldo Kas</span>
        <span class="info-box-number">{{ "Rp. " . number_format($saldo, 2, ',', '.') }}</span>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Peringkat Anggota</h3>
      </div>
      <div class="box-body">
        <div class="table-responsive">
          <table class="table table-hover table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Nama Anggota</th>
                <th>Rating Pinjam</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($rateUser as $item)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->rating_pinjam . ' Kali Pinjam'}}</td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Peringkat Buku</h3>
      </div>
      <div class="box-body">
        <div class="table-responsive">
          <table class="table table-hover table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Judul</th>
                <th>Rating Buku</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($rateBuku as $item)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->judul }}</td>
                <td>{{ $item->rating_buku . ' Kali Dipinjam'}}</td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Grafik</h3>
      </div>
      <div class="box-body">
        @if (session('status'))
        <div class="alert alert-success">
          {{ session('status') }}
        </div>
        @endif
        <div class="col-md-6">
          <div class="chart">
            <h4>Peminjaman</h4>
            <canvas id="bar-chart1"></canvas>
          </div>
        </div>
        <div class="col-md-6">
          <div class="chart">
            <h4>Pengembalian</h4>
            <canvas id="bar-chart2"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
  <script>
      var barchart1 = document.getElementById('bar-chart1');
      var chart1 = new Chart(barchart1, {
        type: 'bar',
        data: {
          labels: <?php echo json_encode($tglPinjam) ?>,
          datasets: [{
            label: 'Peminjaman Buku',
            data: <?php echo json_encode($totalPinjam) ?>,
            backgroundColor: '#00A65A',
          }]
        }
      });
      var barchart2 = document.getElementById('bar-chart2');
      var chart2 = new Chart(barchart2, {
        type: 'bar',
        data: {
          labels: <?php echo json_encode($tglKembali) ?>,
          datasets: [{
            label: 'Peminjaman Buku',
            data: <?php echo json_encode($totalKembali) ?>,
            backgroundColor: '#F39C12',
          }]
        }
      });
  </script>
@endsection
