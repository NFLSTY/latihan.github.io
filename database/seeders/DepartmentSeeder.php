<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;
use Illuminate\Support\Facades\Schema; // Tambahkan ini di bagian atas

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Matikan pengecekan Foreign Key untuk sementara
        Schema::disableForeignKeyConstraints();

        // 2. Kosongkan tabel (Sekarang tidak akan error lagi)
        Department::truncate();

        // 3. Masukkan data baru
        Department::create(['ID_DEPARTEMEN' => 1, 'NAMA_DEPARTEMEN' => 'IT Support']);
        Department::create(['ID_DEPARTEMEN' => 2, 'NAMA_DEPARTEMEN' => 'Human Resources']);
        Department::create(['ID_DEPARTEMEN' => 3, 'NAMA_DEPARTEMEN' => 'Finance']);

        // 4. Hidupkan kembali pengecekan Foreign Key
        Schema::enableForeignKeyConstraints();
    }
}
