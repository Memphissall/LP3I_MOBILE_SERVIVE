@extends('layouts.app')

@section('styles')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .dashboard-container {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05), 0 0 15px rgba(14, 165, 233, 0.1);
            background-image: linear-gradient(to right bottom, #f7faff, #f7f9fc);
            min-height: 90vh;
        }
        .table-action-header {
            background-color: #e0f7ff;
        }
        .table-action-header th {
            color: #0ea5e9;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .table-row-hover:hover {
            background-color: #f7fcff;
        }
        @media (max-width: 768px) {
            .dashboard-container {
                flex-direction: column;
                padding: 16px;
            }
        }
    </style>
@endsection

@section('content')
<div class="py-6 sm:py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="dashboard-container bg-white rounded-2xl p-6 lg:p-8 shadow-xl">
            <div class="w-full">

                {{-- JUDUL --}}
                <h1 class="text-3xl font-extrabold text-gray-800 mb-2">
                    Jadwal Mengajar
                </h1>

                {{-- TAB --}}
                <div class="flex space-x-6 border-b border-gray-200 mb-6">
                    <button class="text-sky-600 border-b-2 border-sky-600 pb-2 font-semibold text-sm">
                        Semua Jadwal
                    </button>
                </div>

                {{-- TABEL --}}
                <div class="overflow-x-auto bg-white rounded-lg shadow-lg border border-gray-100">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="table-action-header">
                            <tr>
                                <th class="px-4 py-3 text-left">Mata Kuliah</th>
                                <th class="px-4 py-3 text-left">Bidang Keahlian</th>
                                <th class="px-4 py-3 text-left">Kelas</th>
                                <th class="px-4 py-3 text-left">Hari</th>
                                <th class="px-4 py-3 text-left">Waktu</th>
                                <th class="px-4 py-3 text-left">Ruangan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($jadwal as $item)
                            <tr class="table-row-hover transition-colors duration-200">
                                <td class="px-4 py-3 text-sm font-medium text-gray-800">
                                    {{ $item->matakuliah->nama_mk ?? 'Mata Kuliah Tidak Ditemukan' }}
                                </td>

                                <td class="px-4 py-3 text-sm text-gray-700">
                                   {{ $item->kelas->programStudi->nama_program_studi ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-700">
                                    {{ $item->kelas->nama_kelas ?? '-' }}
                                </td>
                                
                                <td class="px-4 py-3 text-sm text-sky-600 font-bold">
                                    {{ $item->hari }}
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-700">
                                    <span class="bg-gray-100 px-2 py-1 rounded-md text-xs font-semibold">
                                        {{ $item->jam_mulai ?? '??:??' }} - {{ $item->jam_selesai ?? '??:??' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-700">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                        {{ $item->ruangan->nama_ruangan ?? 'Daring / Online' }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-6 text-gray-500 font-medium">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    Data jadwal mengajar belum tersedia.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- MODAL PESAN --}}
<div id="custom-message" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden items-center justify-center p-4 z-50">
    <div class="bg-white p-6 rounded-xl shadow-2xl max-w-sm w-full text-center">
        <i class="fas fa-info-circle text-6xl text-sky-500 mb-4"></i>
        <h3 class="text-xl font-bold mb-2 text-gray-800">Informasi</h3>
        <p class="text-gray-600 text-sm" id="message-content">
            Proses sedang dijalankan.
        </p>
        <button onclick="closeMessage()"
            class="mt-4 px-6 py-2 bg-sky-500 text-white rounded-lg hover:bg-sky-600 transition-colors">
            Tutup
        </button>
    </div>
</div>
@endsection
