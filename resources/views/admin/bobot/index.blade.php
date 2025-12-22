@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-100 to-slate-200 dark:from-gray-900 dark:to-gray-800 py-10 px-4">

    <div class="max-w-6xl mx-auto">

        {{-- Card --}}
        <div class="bg-white/80 dark:bg-gray-900/80 backdrop-blur-xl rounded-2xl shadow-2xl border border-gray-200 dark:border-gray-700 transition-all duration-500">

            {{-- Header --}}
            <div class="px-8 py-6 border-b border-gray-200 dark:border-gray-700">
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white tracking-wide">
                    ⚙️ Pengaturan Bobot Nilai
                </h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Pastikan total bobot bernilai <span class="font-semibold">100%</span>
                </p>
            </div>

            {{-- Body --}}
            <div class="p-8">

                {{-- Alert --}}
                @if(session('success'))
                    <div class="mb-6 px-5 py-4 rounded-xl bg-green-100 dark:bg-green-900/40 text-green-800 dark:text-green-300 shadow">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 px-5 py-4 rounded-xl bg-red-100 dark:bg-red-900/40 text-red-800 dark:text-red-300 shadow">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.bobot.store') }}">
                    @csrf

                    {{-- Mata Kuliah --}}
                    <div class="mb-10">
                        <label class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                            Mata Kuliah
                        </label>
                        <select
                            name="kode_mk"
                            id="kode_mk"
                            required
                            class="w-full px-4 py-3 rounded-xl bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600
                                   text-gray-800 dark:text-white
                                   focus:ring-4 focus:ring-blue-400/40 focus:border-blue-500
                                   transition-all duration-300 shadow-sm"
                        >
                            <option value="">-- Pilih Mata Kuliah --</option>
                            @foreach($matakuliah as $mk)
                                <option value="{{ $mk->kode_mk }}">
                                    {{ $mk->kode_mk }} - {{ $mk->nama_mk }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Bobot --}}
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6 mb-10">
                        @foreach(['kehadiran','sikap','formatif','tugas','uts','uas'] as $item)
                            <div class="group">
                                <label class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-400 capitalize">
                                    {{ $item }} (%)
                                </label>
                                <input
                                    type="number"
                                    name="{{ $item }}"
                                    min="0"
                                    value="0"
                                    class="bobot w-full text-center px-3 py-3 rounded-xl
                                           bg-gray-50 dark:bg-gray-800
                                           border border-gray-300 dark:border-gray-600
                                           text-gray-800 dark:text-white
                                           focus:ring-4 focus:ring-indigo-400/40
                                           focus:border-indigo-500
                                           transition-all duration-300
                                           group-hover:scale-105"
                                >
                            </div>
                        @endforeach
                    </div>

                    {{-- Total --}}
                    <div class="mb-10 flex items-center gap-4">
                        <span class="text-lg font-semibold text-gray-700 dark:text-gray-300">
                            Total Bobot:
                        </span>
                        <span
                            id="totalBadge"
                            class="px-5 py-2 rounded-full text-lg font-bold bg-red-500 text-white shadow-lg transition-all duration-500"
                        >
                            <span id="total">0</span>%
                        </span>
                    </div>

                    {{-- Action --}}
                    <div class="flex justify-between items-center">
                       <a href="{{ route('admin.dashboard') }}"
   class="group inline-flex items-center gap-2 px-5 py-2.5
          rounded-xl bg-gradient-to-r from-gray-600 to-gray-700
          dark:from-gray-700 dark:to-gray-800
          text-white font-semibold shadow-lg
          hover:shadow-2xl hover:from-gray-700 hover:to-gray-800
          transition-all duration-300 transform hover:-translate-x-1">

    <span class="text-lg transition-transform duration-300 group-hover:-translate-x-1">
        ←
    </span>

    <span>Back</span>
</a>


                        <button
                            id="btnSimpan"
                            disabled
                            class="px-8 py-3 rounded-xl font-semibold text-white
                                   bg-gradient-to-r from-blue-600 to-indigo-600
                                   hover:from-indigo-600 hover:to-blue-600
                                   shadow-xl hover:shadow-2xl
                                   disabled:opacity-50 disabled:cursor-not-allowed
                                   transition-all duration-500 transform hover:scale-105"
                        >
                            💾 Simpan Bobot
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>

{{-- JS --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function () {
    function hitungTotal() {
        let total = 0;
        $('.bobot').each(function () {
            total += parseInt($(this).val()) || 0;
        });

        $('#total').text(total);

        if (total === 100) {
            $('#btnSimpan').prop('disabled', false);
            $('#totalBadge')
                .removeClass('bg-red-500')
                .addClass('bg-green-500 scale-110');
        } else {
            $('#btnSimpan').prop('disabled', true);
            $('#totalBadge')
                .removeClass('bg-green-500 scale-110')
                .addClass('bg-red-500');
        }
    }

    $('.bobot').on('input', hitungTotal);
});
</script>
@endsection
