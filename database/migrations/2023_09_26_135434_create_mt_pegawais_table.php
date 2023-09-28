<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMtPegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mt_pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('no_pegawai')->unique()->nullable();
            $table->string('nama');
            $table->text('alamat');
            $table->date('tanggal_lahir');
            $table->string('kelamin');
            $table->string('kontak');
            $table->string('email');
            $table->unsignedBigInteger('department_id')->reference('id')->on('mt_departments');
            $table->string('photo');
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
        Schema::dropIfExists('mt_pegawai');
    }
}
