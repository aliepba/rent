<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMtHeadDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mt_head_departments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('department_id')->references('id')->on('mt_departments');
            $table->unsignedBigInteger('employee_id')->references('id')->on('mt_pegawai');
            $table->softDeletes();
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
        Schema::dropIfExists('mt_head_departments');
    }
}
