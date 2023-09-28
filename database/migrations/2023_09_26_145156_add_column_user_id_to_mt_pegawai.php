<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnUserIdToMtPegawai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mt_pegawai', function (Blueprint $table) {
            $table->string('nik', 20);
            $table->unsignedBigInteger('user_id');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mt_pegawai', function (Blueprint $table) {
            $table->string('nik', 20);
            $table->unsignedBigInteger('user_id');
            $table->softDeletes();
        });
    }
}
