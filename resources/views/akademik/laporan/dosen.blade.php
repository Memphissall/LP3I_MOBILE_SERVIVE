@extends('layouts.app')

@section('content')
<div class="p-6">
    <nav class="flex mb-5 text-sm text-gray-500">
        <span>Kelola Laporan</span>
        <i data-lucide="chevron-right" class="w-4 h-4 mx-2"></i>
        <span class="text-green-600 font-semibold">Dosen</span>
    </nav>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6 bg-gradient-to-r from-green-600 to-teal-700 text-white flex items-center space-x-4">
            <div class="p-3 bg-white/20 rounded-xl">
                <i data-lucide="user-check" class="w-8 h-8"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold">Laporan Data Dosen</h1>
                <p class="text-green-100 opacity-80">Filter data dosen berdasarkan jabatan dan prodi.</p>
            </div>
        </div>

        <div class="p-8">
            <form action="{{ route('laporan.dosen.cetak') }}" method="POST" target="_blank">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="flex flex-col space-y-2">
                        <label class="font-semibold text-gray-700">Jabatan Fungsional</label>
                        <select name="jabatan" class="p-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 outline-none">
                            <option value="">Semua Jabatan</option>
                            <option value="Asisten Ahli">Asisten Ahli</option>
                            <option value="Lektor">Lektor</option>
                            <option value="Lektor Kepala">Lektor Kepala</option>
                        </select>
                    </div>

                    <div class="flex flex-col space-y-2">
                        <label class="font-semibold text-gray-700">Prodi Homebase</label>
                        <select name="prodi" class="p-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 outline-none">
                            <option value="">Semua Prodi</option>
                            <option value="TI">Teknik Informatika</option>
                            <option value="SI">Sistem Informasi</option>
                        </select>
                    </div>

                    <div class="flex flex-col space-y-2">
                        <label class="font-semibold text-gray-700">Pendidikan Terakhir</label>
                        <select name="pendidikan" class="p-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 outline-none">
                            <option value="">Semua Pendidikan</option>
                            <option value="S2">Magister (S2)</option>
                            <option value="S3">Doktor (S3)</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end pt-6 border-t border-gray-100">
                    <button type="submit" class="flex items-center space-x-2 bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-xl font-bold transition-all shadow-lg shadow-green-200">
                        <i data-lucide="printer" class="w-5 h-5"></i>
                        <span>Preview PDF</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection