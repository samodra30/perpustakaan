<?php

namespace Perpustakaan\Http\Controllers;

use Illuminate\Http\Request;
use Perpustakaan\Anggota;
use Perpustakaan\Buku;
use Perpustakaan\Transaksi;
use Perpustakaan\Kas;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct ()
    {
        $this->middleware('auth');
    }

    public function peminjaman()
    {
        $anggota = Anggota::orderBy('nama', 'ASC')->get();
        $buku = Buku::orderBy('judul', 'ASC')->get();
        $transaksi = Transaksi::leftJoin('anggota', 'transaksi.id_anggota', '=', 'anggota.id_anggota')->leftJoin('buku', 'transaksi.id_buku', '=', 'buku.id_buku')->leftJoin('users', 'transaksi.operator', '=', 'users.id')->where('status', 'Pinjam')->orderBy('transaksi.created_at', 'DESC')->paginate();
        return view('transaksi.peminjaman')->with('anggota', $anggota)->with('buku', $buku)->with('transaksi', $transaksi);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pengembalian()
    {
        $anggota = Anggota::orderBy('nama', 'ASC')->get();
        $buku = Buku::orderBy('judul', 'ASC')->get();
        $transaksi = Transaksi::leftJoin('anggota', 'transaksi.id_anggota', '=', 'anggota.id_anggota')->leftJoin('buku', 'transaksi.id_buku', '=', 'buku.id_buku')->leftJoin('users', 'transaksi.operator', '=', 'users.id')->where('status', 'Pinjam')->orderBy('transaksi.created_at', 'DESC')->paginate();
        return view('transaksi.pengembalian2')->with('anggota', $anggota)->with('buku', $buku)->with('transaksi', $transaksi);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        foreach ($request->buku as $buku) {
            $tambah = new Transaksi();
            $tambah->id_anggota = $request['id_anggota'];
            $tambah->id_buku = $buku;
            $tambah->tgl_pinjam = date("Y-m-d");
            $tambah->terakhir_kembali = $request['tgl_kembali'];
            $tambah->operator = auth()->user()->id;
            $tambah->save();
            DB::table('buku')->where('id_buku', $buku )->update(['stok' => DB::raw('stok-1')]);
            DB::table('anggota')->where('id_anggota', $request['id_anggota'] )->update(['rating_buku' => DB::raw('rating_buku+1')]);
        }
        DB::table('anggota')->where('id_anggota', $request['id_anggota'] )->update(['rating_pinjam' => DB::raw('rating_pinjam+1')]);
        return redirect()->to('/peminjaman')->withStatus('Peminjaman Berhasil!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function kembali($id){
        $transaksi = Transaksi::findOrFail($id);
        $terakhir_kembali = \Carbon\Carbon::parse($transaksi->terakhir_kembali);
        $telat = $terakhir_kembali->diffInDays(date('Y-m-d'), false);
        $denda = $telat * 500;
        if ($telat < 1) {
            $telat = 0;
            $denda = 0;
        } else {
            $tambah = new Kas();
            $tambah->tanggal = date("Y-m-d");
            $tambah->pemasukan = $denda;
            $tambah->pengeluaran = '0';
            $tambah->keterangan = 'Denda Transaksi '. $id;
            $tambah->operator = auth()->user()->id;
            $tambah->save();
        }
        DB::table('transaksi')
        ->where('id_transaksi', $transaksi->id_transaksi)
        ->where('id_anggota', $transaksi->id_anggota)
        ->where('id_buku', $transaksi->id_buku)
        ->update(['status' => 'Kembali', 'tgl_kembali' => date("Y-m-d")]);
        return back()->withStatus('Buku berhasil dikembalikan!');
    }
}
