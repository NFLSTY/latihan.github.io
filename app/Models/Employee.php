<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';
    protected $primaryKey = 'NIK';
    public $incrementing = false; // NIK diinput manual
    protected $fillable = ['NIK', 'NAMA_KARYAWAN', 'PASSWORD', 'ID_DEPARTEMEN'];

    public function departemen()
    {
        return $this->belongsTo(Department::class, 'ID_DEPARTEMEN', 'ID_DEPARTEMEN');
    }
}
