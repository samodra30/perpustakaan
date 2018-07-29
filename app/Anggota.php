<?php

namespace Perpustakaan;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = 'anggota';

    protected $primaryKey = 'id_anggota';

    protected $fillable = ['nama', 'kelas', 'jurusan', 'jenis_kelamin', 'alamat', 'telepon', 'rating_pinjam', 'rating_buku'];
}
