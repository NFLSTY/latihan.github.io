<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    // READ (Tampilkan Semua Data)
    public function index()
    {
        $karyawan = Employee::with('departemen')->get();
        $departemen = Department::all(); // Untuk pilihan drop-down di form
        return view('index', compact('karyawan', 'departemen'));
    }

    // CREATE (Simpan Data Baru)
    public function store(Request $request)
    {
        $request->validate([
            'NIK' => 'required|numeric|unique:employees,NIK',
            'NAMA_KARYAWAN' => 'required|max:25',
            'PASSWORD' => 'required|max:25',
            'ID_DEPARTEMEN' => 'required'
        ]);

        Employee::create($request->all());
        return redirect()->back()->with('success', 'Karyawan berhasil ditambahkan!');
    }

    // UPDATE (Simpan Perubahan)
    public function update(Request $request, int $nik)
    {
        $request->validate([
            'NAMA_KARYAWAN' => 'required|max:25',
            'PASSWORD' => 'required|max:25',
            'ID_DEPARTEMEN' => 'required'
        ]);

        $karyawan = Employee::findOrFail($nik);
        $karyawan->update($request->all());
        return redirect()->back()->with('success', 'Data karyawan berhasil diubah!');
    }

    // DELETE (Hapus Data)
    public function destroy(int $nik)
    {
        $karyawan = Employee::findOrFail($nik);
        $karyawan->delete();
        return redirect()->back()->with('success', 'Karyawan berhasil dihapus!');
    }
}
