<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi CRUD Karyawan & Departemen</title>
    <!-- Menggunakan CDN Tailwind agar sinkron dengan struktur class di app.css bawaan modern -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-slate-50 min-h-screen text-slate-800 antialiased font-sans">

    <div class="max-w-6xl mx-auto px-4 py-10">
        <!-- HEADER -->
        <div class="mb-8 border-b border-slate-200 pb-5">
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Manajemen Data Karyawan</h1>
            <p class="text-sm text-slate-500 mt-1">Tugas Praktikum Operasi CRUD & Relasi Database dengan Laravel Eloquent</p>
        </div>

        @if(session('success'))
            <div class="mb-6 flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-sm shadow-sm">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            
            <!-- PANEL KIRI: FORM TAMBAH DATA (Poin 5) -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200/80">
                <h3 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
                     Input Data Karyawan
                </h3>
                
                <form action="{{ route('karyawan.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1">NIK Karyawan</label>
                        <input type="number" name="NIK" placeholder="Contoh: 202601" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition" required>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1">Nama Lengkap</label>
                        <input type="text" name="NAMA_KARYAWAN" placeholder="Nama Karyawan" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition" required>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1">Password</label>
                        <input type="password" name="PASSWORD" placeholder="••••••••" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition" required>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1">ID Departemen</label>
                        <!-- Drop-down list menampilkan ID sesuai gambar instruksi (Poin 5) -->
                        <select name="ID_DEPARTEMEN" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition cursor-pointer" required>
                            <option value="" disabled selected>-- Pilih ID --</option>
                            @foreach($departemen as $d)
                                <option value="{{ $d->ID_DEPARTEMEN }}">{{ $d->ID_DEPARTEMEN }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="w-full mt-2 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-4 rounded-lg text-sm transition-all shadow-sm shadow-blue-500/10">
                        Submit Data
                    </button>
                </form>
            </div>

            <!-- PANEL KANAN: TABEL DATA (Poin 6) -->
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-200/80 overflow-hidden">
                <div class="px-6 py-4 bg-slate-50 border-b border-slate-100 flex justify-between items-center">
                    <h3 class="text-base font-bold text-slate-900">Daftar Karyawan Terdaftar</h3>
                    <span class="px-2.5 py-1 text-xs font-semibold bg-blue-50 text-blue-600 rounded-full">Total: {{ $karyawan->count() }}</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50 text-slate-500 border-b border-slate-200">
                                <th class="px-6 py-3 font-semibold text-xs uppercase tracking-wider">NIK</th>
                                <th class="px-6 py-3 font-semibold text-xs uppercase tracking-wider">Nama Karyawan</th>
                                <th class="px-6 py-3 font-semibold text-xs uppercase tracking-wider">Nama Departemen</th>
                                <th class="px-6 py-3 font-semibold text-xs uppercase tracking-wider text-center">Aksi / Modifikasi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @if($karyawan->isEmpty())
                                <tr>
                                    <td colspan="4" class="px-6 py-10 text-center text-slate-400 text-sm">Belum ada data karyawan. Masukkan data melalui panel kiri.</td>
                                </tr>
                            @endif

                            @foreach($karyawan as $k)
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="px-6 py-4 font-mono font-medium text-slate-700">{{ $k->NIK }}</td>
                                <td class="px-6 py-4 font-medium text-slate-900">{{ $k->NAMA_KARYAWAN }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800">
                                        {{ $k->departemen->NAMA_DEPARTEMEN ?? 'Tidak Diketahui' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <!-- FORM INLINE EDIT UNTUK MEMPERMUDAH MODIFIKASI DATA -->
                                    <div class="flex items-center justify-center gap-3">
                                        <form action="{{ route('karyawan.update', $k->NIK) }}" method="POST" class="inline-flex items-center gap-1.5 bg-slate-50 p-1.5 rounded-lg border border-slate-200">
                                            @csrf @method('PUT')
                                            <input type="text" name="NAMA_KARYAWAN" value="{{ $k->NAMA_KARYAWAN }}" class="px-2 py-1 border border-slate-200 rounded text-xs w-28 bg-white focus:outline-none" required placeholder="Nama">
                                            <input type="password" name="PASSWORD" value="{{ $k->PASSWORD }}" class="px-2 py-1 border border-slate-200 rounded text-xs w-20 bg-white focus:outline-none" required placeholder="Pass">
                                            
                                            <select name="ID_DEPARTEMEN" class="px-1 py-1 border border-slate-200 rounded text-xs bg-white focus:outline-none cursor-pointer" required>
                                                @foreach($departemen as $d)
                                                    <option value="{{ $d->ID_DEPARTEMEN }}" {{ $k->ID_DEPARTEMEN == $d->ID_DEPARTEMEN ? 'selected' : '' }}>
                                                        {{ $d->ID_DEPARTEMEN }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            
                                            <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white font-medium px-2 py-1 rounded text-[11px] transition shadow-sm">
                                                Update
                                            </button>
                                        </form>

                                        <!-- FORM HAPUS -->
                                        <form action="{{ route('karyawan.destroy', $k->NIK) }}" method="POST" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="bg-red-50/80 hover:bg-red-100 text-red-600 border border-red-200 px-2.5 py-1.5 rounded-lg text-xs font-medium transition" onclick="return confirm('Apakah Anda yakin ingin menghapus data karyawan ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

</body>
</html>
