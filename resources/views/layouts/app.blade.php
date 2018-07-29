@extends('admin-lte::layouts.main')

@if (auth()->check())
@section('user-avatar', asset('images/'. auth()->user()->avatar))
@section('user-name', auth()->user()->name)
@section('since', date_format(auth()->user()->created_at, 'd-m-Y'))
@endif

@section('breadcrumbs')
@include('admin-lte::layouts.content-wrapper.breadcrumbs', [
  'breadcrumbs' => [
    (object) [ 'title' => 'Home', 'url' => route('home') ]
  ]
])
@endsection

@section('sidebar-menu')
<ul class="sidebar-menu" data-widget="tree">
  <li class="header">MAIN NAVIGATOR</li>
  <li>
    <a href="{{ route('home') }}">
      <i class="fa fa-home"></i>
      <span>Home</span>
    </a>
  </li>
  <li>
    <a href="{{ url('anggota') }}">
      <i class="fa fa-user"></i>
      <span>Anggota</span>
    </a>
  </li>
  <li>
    <a href="{{ url('buku') }}">
      <i class="fa fa-book"></i>
      <span>Buku</span>
    </a>
  </li>
  <li>
    <a href="{{ url('kas') }}">
      <i class="fa fa-money"></i>
      <span>Kas</span>
    </a>
  </li>
  <li class="treeview">
    <a href="#">
      <i class="fa fa-exchange"></i> <span>Transaksi</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="{{ url('peminjaman') }}"><i class="fa fa-arrow-up"></i> Peminjaman</a></li>
      <li><a href="{{ url('pengembalian') }}"><i class="fa fa-arrow-down"></i> Pengembalian</a></li>
    </ul>
  </li>
  <li class="treeview">
    <a href="#">
      <i class="fa fa-bar-chart-o"></i> <span>Laporan</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="{{ url('laporan/anggota') }}"><i class="fa fa-circle-o"></i> Anggota</a></li>
      <li><a href="{{ url('laporan/buku') }}"><i class="fa fa-circle-o"></i> Buku</a></li>
      <li class="treeview">
        <a href="#"><i class="fa fa-circle-o"></i> Kas
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{ url('laporan/kas') }}"><i class="fa fa-circle-o"></i> Kas</a></li>
          <li><a href="{{ url('laporan/kasmasuk') }}"><i class="fa fa-circle-o"></i> Kas Masuk</a></li>
          <li><a href="{{ url('laporan/kaskeluar') }}"><i class="fa fa-circle-o"></i> Kas Keluar</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-circle-o"></i> <span>Grafik</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{ url('laporan/grafikpeminjaman') }}"><i class="fa fa-circle-o"></i> Peminjaman</a></li>
          <li><a href="{{ url('laporan/grafikpengembalian') }}"><i class="fa fa-circle-o"></i> Pengembalian</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-circle-o"></i> <span>Peringkat</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{ url('laporan/peringkat/anggota') }}"><i class="fa fa-circle-o"></i> Anggota</a></li>
          <li><a href="{{ url('laporan/peringkat/buku') }}"><i class="fa fa-circle-o"></i> Buku</a></li>
        </ul>
      </li>
    </ul>
  </li>
</ul>
@endsection
