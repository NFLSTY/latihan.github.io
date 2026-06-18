<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';
    protected $primaryKey = 'ID_DEPARTEMEN';
    public $incrementing = false; // Karena ID diinput manual, bukan auto-increment
    protected $fillable = ['ID_DEPARTEMEN', 'NAMA_DEPARTEMEN'];

    public function karyawan()
    {
        return $this->hasMany(Employee::class, 'ID_DEPARTEMEN', 'ID_DEPARTEMEN');
    }
}
