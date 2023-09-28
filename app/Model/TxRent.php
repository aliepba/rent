<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class TxRent extends Model
{
    protected $guarded = [];

    public function barang(){
        return $this->hasOne(MtBarang::class, 'id', 'barang_id');
    }

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
