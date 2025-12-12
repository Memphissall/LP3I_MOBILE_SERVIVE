<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-800 leading-tight">Kartu Rencana Studi (KRS)</h2>
    </x-slot>

    <div class="bg-white shadow-xl sm:rounded-lg p-6">
        <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6">
            <p class="font-bold text-red-800">Perhatian: Periode Pengisian KRS akan berakhir 15 Desember 2025.</p>
        </div>

        <div class="mb-6 space-y-2 text-gray-700">
            <p><strong>Semester:</strong> Ganjil 2025/2026</p>
            <p><strong>Batas SKS Maksimal:</strong> 24 SKS</p>
            <p><strong>SKS Yang Diambil:</strong> 20 SKS</p>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pilih</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode MK</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Kuliah</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">SKS</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dosen Pengampu</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-center"><input type="checkbox" checked class="rounded text-indigo-600"></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">BD101</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Basis Data</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">3</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Dr. Andi Pratama</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-center"><input type="checkbox" class="rounded text-indigo-600"></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">SO102</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Sistem Operasi</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">4</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Budi Santoso</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="flex justify-end mt-6">
            <button class="bg-green-600 text-white py-3 px-6 rounded-lg font-bold hover:bg-green-700 transition duration-150">
                Ajukan KRS
            </button>
        </div>
    </div>
</x-app-layout>