<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

// Rute langsung mengarah ke halaman utama CRUD Karyawan
Route::get('/', [EmployeeController::class, 'index'])->name('karyawan.index');
Route::post('/karyawan', [EmployeeController::class, 'store'])->name('karyawan.store');
Route::put('/karyawan/{nik}', [EmployeeController::class, 'update'])->name('karyawan.update');
Route::delete('/karyawan/{nik}', [EmployeeController::class, 'destroy'])->name('karyawan.destroy');