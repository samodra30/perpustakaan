@extends('layouts.app')

@section('content-title', 'Laporan')
@section('content-subtitle', 'Grafik')
@section('content')
@php
  $tanggalHarian = array();
  $totalHarian = array();

  $tanggalBulanan = array();
  $totalBulanan = array();

  $tanggalTahunan = array();
  $totalTahunan = array();

  foreach ($harian as $item) {
      $tanggalHarian[] = $item->tgl_kembali;
      $totalHarian[] = $item->total_pinjam;
  }
  foreach ($bulanan as $item) {
    $tanggalBulanan[] = $item->bln;
    $totalBulanan[] = $item->total_pinjam;
  }
  $tglHarian = array_map(function ($date) {
      return date('d/m/Y', strtotime($date));
  }, $tanggalHarian);

  $tglBulanan = array_map(function ($date) {
      return date('m/Y', strtotime($date));
  }, $tanggalBulanan);

  foreach ($tahunan as $item) {
    $tanggalTahunan[] = $item->thn;
    $totalTahunan[] = $item->total_pinjam;
  }
@endphp

<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Grafik Pengembalian Buku</h3>
      </div>
      <div class="box-body">
        @if (session('status'))
        <div class="alert alert-success" id="message">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          {{ session('status') }}
        </div>
        @endif
        <div class="col-md-12">
          <div class="chart">
            <h4>Harian</h4>
            <canvas id="bar-chart1"></canvas>
          </div>
        </div>
        <div class="col-md-6">
          <div class="chart">
            <h4>Bulanan</h4>
            <canvas id="bar-chart2"></canvas>
          </div>
        </div>
        <div class="col-md-6">
          <div class="chart">
            <h4>Tahunan</h4>
            <canvas id="bar-chart3"></canvas>
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
  <script>
      var barchart1 = document.getElementById('bar-chart1');
      barchart1.height = 100;
      var chart1 = new Chart(barchart1, {
        type: 'bar',
        data: {
          labels: <?php echo json_encode($tglHarian) ?>, // Merubah data tanggal menjadi format JSON
          datasets: [{
            label: 'Pengembalian Buku',
            data: <?php echo json_encode($totalHarian) ?>,
            backgroundColor: '#00A65A',
          }]
        }
      });
      var barchart2 = document.getElementById('bar-chart2');
      var chart2 = new Chart(barchart2, {
        type: 'bar',
        data: {
          labels: <?php echo json_encode($tglBulanan) ?>, // Merubah data tanggal menjadi format JSON
          datasets: [{
            label: 'Pengembalian Buku',
            data: <?php echo json_encode($totalBulanan) ?>,
            backgroundColor: '#FFAC26',
          }]
        }
      });
      var barchart3 = document.getElementById('bar-chart3');
      var chart3 = new Chart(barchart3, {
        type: 'bar',
        data: {
          labels: <?php echo json_encode($tanggalTahunan) ?>, // Merubah data tanggal menjadi format JSON
          datasets: [{
            label: 'Pengembalian Buku',
            data: <?php echo json_encode($totalTahunan) ?>,
            backgroundColor: '#00ACD6',
          }]
        }
      });  

  </script>
@endsection
