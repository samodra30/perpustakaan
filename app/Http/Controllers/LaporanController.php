<?php

namespace Perpustakaan\Http\Controllers;

use Illuminate\Http\Request;
use Perpustakaan\Anggota;
use Perpustakaan\Buku;
use Perpustakaan\Kas;
use Perpustakaan\Transaksi;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function __construct ()
    {
        $this->middleware('auth');
    }

    public function anggota()
    {
        $data = Anggota::orderBy('kelas', 'ASC')->orderBy('nama', 'ASC')->paginate();

        return view('laporan.reportAnggota')->with('data', $data);
    }

    public function buku()
    {
        $data = Buku::orderBy('judul', 'ASC')->paginate();
        return view('laporan.reportBuku')->with('data', $data);
    }

    public function kas()
    {
        $data = Kas::leftJoin('users', 'kas.operator', '=', 'users.id')->orderBy('kas.created_at', 'DESC')->paginate();
        $pemasukan = Kas::sum('pemasukan');
        $pengeluaran = Kas::sum('pengeluaran');
        $total_kas = $pemasukan - $pengeluaran;
        return view('laporan.reportKas')->with('data', $data)->with('total_kas', $total_kas);
    }

    public function kasmasuk()
    {
        $data = Kas::leftJoin('users', 'kas.operator', '=', 'users.id')->where('pengeluaran', '0')->orderBy('kas.created_at', 'DESC')->paginate();
        $pemasukan = Kas::sum('pemasukan');
        return view('laporan.reportKasMasuk')->with('data', $data)->with('pemasukan', $pemasukan);
    }

    public function kaskeluar()
    {
        $data = Kas::leftJoin('users', 'kas.operator', '=', 'users.id')->where('pemasukan', '0')->orderBy('kas.created_at', 'DESC')->paginate();
        $pengeluaran = Kas::sum('pengeluaran');
        return view('laporan.reportKasKeluar')->with('data', $data)->with('pengeluaran', $pengeluaran);
    }

    public function grafikPeminjaman()
    {

        $countHarian = DB::table('transaksi')->count(DB::raw('DISTINCT tgl_pinjam')); //10
        $limit = 30;
        $skip = $countHarian - $limit;

        $harian = DB::table('transaksi')
        ->select('tgl_pinjam', DB::raw('count(*) as total_pinjam'))
        ->groupBy('tgl_pinjam')
        ->skip($skip)
        ->take($limit)
        ->get();

        $bulanan = DB::table('transaksi')
        ->select(DB::raw('count(*) as total_pinjam'),DB::raw("CONCAT_WS('-',YEAR(tgl_pinjam),MONTH(tgl_pinjam)) as bln"))
       ->groupBy('bln')
       ->orderBy('bln', 'ASC')
       ->get();

        $countBulanan = $bulanan->count(DB::raw('DISTINCT bln'));
        $limit = 8;
        $skip = $countHarian - $limit;

        $bulanan = DB::table('transaksi')
        ->select(DB::raw('count(*) as total_pinjam'),DB::raw("CONCAT_WS('-',YEAR(tgl_pinjam),MONTH(tgl_pinjam)) as bln"))
       ->groupBy('bln')
       ->orderBy('bln', 'ASC')
       ->skip($skip)
       ->take($limit)
       ->get();

        $tahunan = DB::table('transaksi')
        ->select(DB::raw('count(*) as total_pinjam'),DB::raw("CONCAT_WS('-',YEAR(tgl_pinjam)) as thn"))
        ->groupBy('thn')
        ->get();


        return view('laporan.reportGrafikPeminjaman')
        ->with('harian', $harian)
        ->with('bulanan', $bulanan)
        ->with('tahunan', $tahunan);
    }

    public function grafikPengembalian()
    {

        $countHarian = DB::table('transaksi')->where('status', 'Kembali')->count(DB::raw('DISTINCT tgl_kembali'));
        $limit = 30;
        $skip = $countHarian - $limit;

        $harian = DB::table('transaksi')
        ->select('tgl_kembali', DB::raw('count(*) as total_pinjam'), 'status')
        ->where('status', 'Kembali')
        ->groupBy('tgl_kembali', 'status')
        ->skip($skip)
        ->take($limit)
        ->get();

        $bulanan = DB::table('transaksi')
        ->select(DB::raw('count(*) as total_pinjam'),DB::raw("CONCAT_WS('-',YEAR(tgl_kembali),MONTH(tgl_kembali)) as bln"), 'status')
        ->where('status', 'Kembali')
        ->groupBy('bln', 'status')
        ->orderBy('bln', 'ASC')
        ->get();

        $countBulanan = $bulanan->where('status', 'Kembali')->count(DB::raw('DISTINCT bln'));
        $limit = 8;
        $skip = $countHarian - $limit;

        $bulanan = DB::table('transaksi')
        ->select(DB::raw('count(*) as total_pinjam'),DB::raw("CONCAT_WS('-',YEAR(tgl_kembali),MONTH(tgl_kembali)) as bln"), 'status')
        ->where('status', 'Kembali')
        ->groupBy('bln', 'status')
        ->orderBy('bln', 'ASC')
        ->skip($skip)
        ->take($limit)
        ->get();

        $tahunan = DB::table('transaksi')
        ->select(DB::raw('count(*) as total_pinjam'),DB::raw("CONCAT_WS('-',YEAR(tgl_kembali)) as thn"), 'status')
        ->where('status', 'Kembali')
        ->groupBy('thn', 'status')
        ->get();


        return view('laporan.reportGrafikPengembalian')
        ->with('harian', $harian)
        ->with('bulanan', $bulanan)
        ->with('tahunan', $tahunan);
    }

    public function peringkatAnggota()
    {
        $rateUser = Anggota::orderBy('rating_pinjam', 'DESC')->get();

        return view('laporan.reportPeringkatAnggota')->with('data', $rateUser);
    }

    public function peringkatBuku()
    {
        $rateBuku = DB::table('buku')
        ->select('buku.id_buku', 'buku.judul', 'buku.pengarang', 'buku.penerbit', 'buku.tahun', 'buku.stok', 'buku.rak', DB::raw('count(transaksi.id_buku) as rating_buku'))
        ->leftJoin('transaksi', 'buku.id_buku', '=', 'transaksi.id_buku')
        ->groupBy('buku.id_buku', 'buku.judul', 'buku.pengarang', 'buku.penerbit', 'buku.tahun', 'buku.stok', 'buku.rak')
        ->orderBy(DB::raw('count(transaksi.id_buku)'), 'DESC')
        ->get();
        
        return view('laporan.reportPeringkatBuku')->with('data', $rateBuku);
    }
}
