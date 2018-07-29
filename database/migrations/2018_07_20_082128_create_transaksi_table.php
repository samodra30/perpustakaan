<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->increments('id_transaksi');
            $table->integer('id_anggota')->unsigned();
            $table->integer('id_buku')->unsigned();
            $table->foreign('id_anggota')->references('id_anggota')->on('anggota')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_buku')->references('id_buku')->on('buku')->onDelete('cascade')->onUpdate('cascade');
            $table->date('tgl_pinjam');
            $table->date('terakhir_kembali');
            $table->date('tgl_kembali')->nullable();
            $table->enum('status', ['Pinjam', 'Kembali'])->default('Pinjam');
            $table->integer('operator')->unsigned();
            $table->foreign('operator')->references('id')->('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
}
