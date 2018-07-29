<?php

namespace Perpustakaan;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';

    protected $primaryKey = 'id_transaksi';

    protected $fillable = ['id_transaksi', 'id_anggota', 'id_buku', 'tgl_pinjam', 'terakhir_kembali', 'tgl_kembali', 'status', 'operator'];
}
