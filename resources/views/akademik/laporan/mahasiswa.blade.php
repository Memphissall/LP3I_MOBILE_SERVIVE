@extends('layouts.app')

@section('content')
<div class="p-6">
    <nav class="flex mb-5 text-sm text-gray-500">
        <span>Kelola Laporan</span>
        <i data-lucide="chevron-right" class="w-4 h-4 mx-2"></i>
        <span class="text-blue-600 font-semibold">Mahasiswa</span>
    </nav>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6 bg-gradient-to-r from-blue-600 to-indigo-700 text-white flex items-center space-x-4">
            <div class="p-3 bg-white/20 rounded-xl">
                <i data-lucide="users" class="w-8 h-8"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold">Laporan Data Mahasiswa</h1>
                <p class="text-blue-100 opacity-80">Filter data berdasarkan kriteria untuk preview laporan.</p>
            </div>
        </div>

        <div class="p-8">
            <form action="{{ route('laporan.mhs.cetak') }}" method="POST" target="_blank">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="flex flex-col space-y-2">
                        <label class="font-semibold text-gray-700">Program Studi</label>
                        <select name="prodi" class="p-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
                            <option value="">Semua Program Studi</option>
                            <option value="TI">Teknik Informatika</option>
                            <option value="SI">Sistem Informasi</option>
                            <option value="AK">Akuntansi</option>
                        </select>
                    </div>

                    <div class="flex flex-col space-y-2">
                        <label class="font-semibold text-gray-700">Angkatan</label>
                        <select name="angkatan" class="p-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
                            <option value="">Semua Angkatan</option>
                            @for ($i = date('Y'); $i >= 2020; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="flex flex-col space-y-2">
                        <label class="font-semibold text-gray-700">Status</label>
                        <select name="status" class="p-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
                            <option value="">Semua Status</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Cuti">Cuti</option>
                            <option value="Lulus">Lulus</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end pt-6 border-t border-gray-100">
                    <button type="submit" class="flex items-center space-x-2 bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-bold transition-all shadow-lg shadow-blue-200">
                        <i data-lucide="printer" class="w-5 h-5"></i>
                        <span>Preview PDF</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection