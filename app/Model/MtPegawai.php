<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MtPegawai extends Model
{
    use SoftDeletes;

    protected $table = 'mt_pegawai';
}
