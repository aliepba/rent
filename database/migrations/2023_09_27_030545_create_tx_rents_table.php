<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTxRentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tx_rents', function (Blueprint $table) {
            $table->id();
            $table->string('no_pinjam');
            $table->date('tgl_mulai');
            $table->date('tgl_akhir');
            $table->unsignedBigInteger('barang_id')->references('id')->on('mt_barang');
            $table->integer('jumlah');
            $table->boolean('is_done')->default(false);
            $table->integer('user_id');
            $table->date('tgl_acc')->nullable();
            $table->date('tgl_kembali')->nullable();
            $table->unsignedBigInteger('approve_by')->nullable();
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
        Schema::dropIfExists('tx_rents');
    }
}
