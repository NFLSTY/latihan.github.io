<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            // NIK sebagai Primary Key (Int)
            $table->integer('NIK')->primary();
            $table->string('NAMA_KARYAWAN', 25);
            $table->string('PASSWORD', 25);
            
            // ID_DEPARTEMEN sebagai Foreign Key yang merujuk ke tabel departemen_xxxx
            $table->integer('ID_DEPARTEMEN');
            $table->foreign('ID_DEPARTEMEN')
                ->references('ID_DEPARTEMEN')
                ->on('departments')
                ->onDelete('cascade'); // Menghapus karyawan jika departemen dihapus
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
