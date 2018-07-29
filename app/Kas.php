<?php

namespace Perpustakaan;

use Illuminate\Database\Eloquent\Model;

class Kas extends Model
{
    protected $table = 'kas';

    protected $primaryKey = 'id_kas';

    protected $fillable = ['id_kas', 'tanggal', 'pemasukan', 'pengeluaran', 'keterangan', 'operator'];
}
