@extends('layouts.app')

@section('title', 'Surat Pengantar - E-Academic LP3I')
@section('page-title', 'Surat Pengantar')
@section('page-description', 'Buat dan cetak surat pengantar kegiatan LP3I College Karawang.')

@section('content')
<div class="p-6">

    {{-- Hero Card --}}
    <div class="bg-white rounded-2xl shadow-xl shadow-gray-200/50 mb-8 overflow-hidden relative border border-gray-100">
        <div class="h-1.5 w-full bg-gradient-to-r from-[#004269] via-[#00536e] to-[#009DA5]"></div>

        <div class="p-6 md:p-8">
            {{-- Header --}}
            <div class="flex items-center space-x-3 mb-6 border-b border-gray-100 pb-4">
                <div class="bg-[#004269]/10 p-2.5 rounded-xl text-[#004269]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-gray-800">Form Surat Pengantar</h2>
                    <p class="text-xs text-gray-400 font-medium">Isi data kegiatan untuk menghasilkan surat pengantar resmi LP3I</p>
                </div>
            </div>

            <form id="form-surat" method="GET" action="{{ route('admin.surat_pengantar.print') }}" target="_blank">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Nomor Surat --}}
                    <div class="group">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-1.5 text-[#009DA5]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/></svg>
                            Nomor Surat
                        </label>
                        <input type="text" name="nomor_surat" id="nomor_surat"
                               class="w-full p-3 text-sm font-medium text-gray-700 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:bg-white focus:border-[#009DA5] focus:ring-4 focus:ring-[#009DA5]/10 transition-all duration-200 hover:border-gray-300"
                               placeholder="cth: 0135/02/SPR/CKW/IV/2024"
                               value="{{ old('nomor_surat') }}">
                    </div>

                    {{-- Tanggal Surat --}}
                    <div class="group">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-1.5 text-[#009DA5]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Tanggal Surat
                        </label>
                        <input type="date" name="tanggal_surat" id="tanggal_surat"
                               class="w-full p-3 text-sm font-medium text-gray-700 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:bg-white focus:border-[#009DA5] focus:ring-4 focus:ring-[#009DA5]/10 transition-all duration-200 hover:border-gray-300"
                               value="{{ old('tanggal_surat', date('Y-m-d')) }}">
                    </div>

                    {{-- Kepada Yth --}}
                    <div class="group">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-1.5 text-[#009DA5]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            Kepada Yth.
                        </label>
                        <input type="text" name="kepada_yth" id="kepada_yth"
                               class="w-full p-3 text-sm font-medium text-gray-700 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:bg-white focus:border-[#009DA5] focus:ring-4 focus:ring-[#009DA5]/10 transition-all duration-200 hover:border-gray-300"
                               placeholder="cth: Bapak/Ibu Pimpinan"
                               value="{{ old('kepada_yth', 'Bapak/Ibu Pimpinan') }}">
                    </div>

                    {{-- Nama Instansi Tujuan --}}
                    <div class="group">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-1.5 text-[#009DA5]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            Nama Instansi / Tempat Tujuan
                        </label>
                        <input type="text" name="instansi_tujuan" id="instansi_tujuan"
                               class="w-full p-3 text-sm font-medium text-gray-700 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:bg-white focus:border-[#009DA5] focus:ring-4 focus:ring-[#009DA5]/10 transition-all duration-200 hover:border-gray-300"
                               placeholder="cth: Dinas Koperasi"
                               value="{{ old('instansi_tujuan') }}">
                    </div>

                    {{-- Perihal --}}
                    <div class="group">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-1.5 text-[#009DA5]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/></svg>
                            Perihal
                        </label>
                        <input type="text" name="perihal" id="perihal"
                               class="w-full p-3 text-sm font-medium text-gray-700 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:bg-white focus:border-[#009DA5] focus:ring-4 focus:ring-[#009DA5]/10 transition-all duration-200 hover:border-gray-300"
                               placeholder="cth: Permohonan Izin Sosialisasi/Seminar"
                               value="{{ old('perihal') }}">
                    </div>

                    {{-- Lampiran --}}
                    <div class="group">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-1.5 text-[#009DA5]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>
                            Lampiran
                        </label>
                        <input type="text" name="lampiran" id="lampiran"
                               class="w-full p-3 text-sm font-medium text-gray-700 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:bg-white focus:border-[#009DA5] focus:ring-4 focus:ring-[#009DA5]/10 transition-all duration-200 hover:border-gray-300"
                               placeholder="cth: - (atau 1 Berkas)"
                               value="{{ old('lampiran', '-') }}">
                    </div>

                    {{-- Tema / Nama Kegiatan --}}
                    <div class="group md:col-span-2">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-1.5 text-[#009DA5]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                            Tema / Nama Kegiatan
                        </label>
                        <input type="text" name="tema_kegiatan" id="tema_kegiatan"
                               class="w-full p-3 text-sm font-medium text-gray-700 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:bg-white focus:border-[#009DA5] focus:ring-4 focus:ring-[#009DA5]/10 transition-all duration-200 hover:border-gray-300"
                               placeholder="cth: Pengembangan Bisnis UMKM melalui Aplikasi TikTok"
                               value="{{ old('tema_kegiatan') }}">
                    </div>

                    {{-- Hari & Tanggal Kegiatan --}}
                    <div class="group">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-1.5 text-[#009DA5]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Hari &amp; Tanggal Kegiatan
                        </label>
                        <input type="date" name="tanggal_kegiatan" id="tanggal_kegiatan"
                               class="w-full p-3 text-sm font-medium text-gray-700 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:bg-white focus:border-[#009DA5] focus:ring-4 focus:ring-[#009DA5]/10 transition-all duration-200 hover:border-gray-300"
                               value="{{ old('tanggal_kegiatan') }}">
                    </div>

                    {{-- Waktu --}}
                    <div class="group">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-1.5 text-[#009DA5]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Waktu
                        </label>
                        <input type="text" name="waktu" id="waktu"
                               class="w-full p-3 text-sm font-medium text-gray-700 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:bg-white focus:border-[#009DA5] focus:ring-4 focus:ring-[#009DA5]/10 transition-all duration-200 hover:border-gray-300"
                               placeholder="cth: 09.00 – 12.00 WIB"
                               value="{{ old('waktu') }}">
                    </div>

                    {{-- Tempat Kegiatan --}}
                    <div class="group md:col-span-2">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-1.5 text-[#009DA5]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Tempat Kegiatan
                        </label>
                        <input type="text" name="tempat" id="tempat"
                               class="w-full p-3 text-sm font-medium text-gray-700 bg-gray-50 border border-gray-200 rounded-xl outline-none focus:bg-white focus:border-[#009DA5] focus:ring-4 focus:ring-[#009DA5]/10 transition-all duration-200 hover:border-gray-300"
                               placeholder="cth: Aula Dinas Koperasi"
                               value="{{ old('tempat') }}">
                    </div>

                </div>

                {{-- Action Buttons --}}
                <div class="mt-8 flex items-center justify-end space-x-3">
                    <button type="button" onclick="resetForm()"
                            class="px-5 py-2.5 rounded-xl border border-gray-200 text-gray-600 font-semibold text-sm hover:bg-gray-50 transition-all duration-200">
                        Reset
                    </button>
                    <button type="submit"
                            class="relative overflow-hidden group bg-[#004269] hover:bg-[#003350] text-white px-6 py-2.5 rounded-xl font-bold text-sm transition-all duration-300 shadow-lg hover:-translate-y-0.5 active:translate-y-0 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                        </svg>
                        Buat &amp; Cetak Surat
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Info Card --}}
    <div class="bg-[#004269]/5 border border-[#004269]/15 rounded-2xl p-5 flex items-start gap-4">
        <div class="bg-[#004269]/10 p-2.5 rounded-xl text-[#004269] flex-shrink-0 mt-0.5">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <div>
            <p class="font-bold text-[#004269] text-sm">Informasi</p>
            <p class="text-gray-600 text-xs mt-1 leading-relaxed">
                Surat akan otomatis dibuka di tab baru dalam format siap cetak. Kop surat, tanda tangan, dan identitas LP3I College Karawang sudah disertakan secara otomatis dalam template. Isi form sesuai dengan detail kegiatan yang akan diselenggarakan.
            </p>
        </div>
    </div>

</div>

<script>
    function resetForm() {
        document.getElementById('form-surat').reset();
        document.getElementById('tanggal_surat').value = new Date().toISOString().substring(0, 10);
        document.getElementById('kepada_yth').value = 'Bapak/Ibu Pimpinan';
        document.getElementById('lampiran').value = '-';
    }
</script>
@endsection
