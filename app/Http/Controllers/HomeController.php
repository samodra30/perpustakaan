<?php

namespace Perpustakaan\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Perpustakaan\Anggota;
use Perpustakaan\Buku;
use Perpustakaan\Kas;
use Perpustakaan\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        //Grafik Peminjaman
        $countPinjam = DB::table('transaksi')->count(DB::raw('DISTINCT tgl_pinjam')); //10
        $limitPinjam = 8;
        $skipPinjam = $countPinjam - $limitPinjam;

        $pinjam = DB::table('transaksi')
        ->select('tgl_pinjam', DB::raw('count(*) as total_pinjam'))
        ->groupBy('tgl_pinjam')
        ->skip($skipPinjam)
        ->take($limitPinjam)
        ->get();

        //Grafik Pengembalian
        $countKembali = DB::table('transaksi')->where('status', 'Kembali')->count(DB::raw('DISTINCT tgl_kembali'));
        $limitKembali = 30;
        $skipKembali = $countKembali - $limitKembali;

        $kembali = DB::table('transaksi')
        ->select('tgl_kembali', DB::raw('count(*) as total_kembali'), 'status')
        ->where('status', 'Kembali')
        ->groupBy('tgl_kembali', 'status')
        ->skip($skipKembali)
        ->take($limitKembali)
        ->get();

        //Count
        $countAnggota = Anggota::count();
        $countBuku = Buku::count();
        $pemasukan = Kas::sum('pemasukan');
        $pengeluaran = Kas::sum('pengeluaran');
        $total_kas = $pemasukan - $pengeluaran;

        //Peringkat User
        $rateUser = Anggota::orderBy('rating_pinjam', 'DESC')->take(5)->get();
        $rateBuku = DB::table('buku')
        ->select('buku.id_buku', 'buku.judul', DB::raw('count(transaksi.id_buku) as rating_buku'))
        ->leftJoin('transaksi', 'buku.id_buku', '=', 'transaksi.id_buku')
        ->groupBy('buku.id_buku', 'buku.judul')
        ->orderBy(DB::raw('count(transaksi.id_buku)'), 'DESC')
        ->take(5)
        ->get();

        return view('home')
        ->with('pinjam', $pinjam)
        ->with('kembali', $kembali)
        ->with('countAnggota', $countAnggota)
        ->with('countBuku', $countBuku)
        ->with('saldo', $total_kas)
        ->with('rateUser', $rateUser)
        ->with('rateBuku', $rateBuku);
    }
}
