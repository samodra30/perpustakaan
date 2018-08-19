<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateAnggotaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggota', function (Blueprint $table) {
            $table->increments('id_anggota');
            $table->string('nama');
            $table->enum('kelas', ['X', 'XI', 'XII']);
            $table->string('jurusan');
            $table->enum('jenis_kelamin',['Laki-Laki', 'Perempuan']);
            $table->string('alamat');
            $table->string('telepon');
            $table->integer('rating_pinjam')->default('0');
            $table->integer('rating_buku')->default('0');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE anggota AUTO_INCREMENT = 11111;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anggota');
    }
}
