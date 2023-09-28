<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MtHeadDepartment extends Model
{
    use SoftDeletes;

    public function department(){
        return $this->hasOne(MtDepartment::class, 'id', 'department_id');
    }

    public function employee(){
        return $this->hasOne(MtPegawai::class, 'id', 'employee_id');
    }
}
