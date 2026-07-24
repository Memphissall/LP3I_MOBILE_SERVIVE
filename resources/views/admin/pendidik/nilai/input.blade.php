@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">

    <form id="form-nilai" action="{{ route('nilai.store') }}" method="POST">

@csrf

<input type="hidden" name="id_kelas" value="{{ $id_kelas }}">
<input type="hidden" name="id_mk" value="{{ $id_mk }}">
<input type="hidden" name="semester" value="{{ $semester }}">

<div class="bg-white rounded-xl shadow-lg overflow-hidden">

    {{-- HEADER --}}
    <div class="bg-blue-600 text-white px-6 py-4">
        <h2 class="text-lg font-semibold flex items-center gap-2">
            📝 Input Score Mahasiswa
        </h2>
        <p class="text-sm text-blue-100">
            Default kehadiran 100, Alpha -5
        </p>
    </div>

    {{-- TABLE --}}
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-center border-separate border-spacing-y-2 px-4 py-3">
            <thead>
                <tr class="text-gray-600">
                    <th class="text-left px-3 py-2">NIPD</th> {{-- TAMBAHAN --}}
                    <th class="text-left px-3 py-2">Nama Mahasiswa</th>
                    <th>Attendance</th>
                    <th>Attitude</th>
                    <th>Formative</th>
                    <th>Assignment</th>
                    <th>Mid Exam</th>
                    <th>Final Exam</th>
                </tr>
            </thead>

            <tbody>
            @foreach($mahasiswa as $mhs)
                <tr class="bg-gray-50 hover:bg-blue-50 transition rounded-lg">

                    {{-- NIPD --}}
                    <td class="text-left px-3 py-2 font-medium text-gray-600 whitespace-nowrap">
                        {{ $mhs->nipd }}
                    </td>

                    {{-- NAMA --}}
                    <td class="text-left px-3 py-2 font-medium text-gray-700 whitespace-nowrap">
                        {{ $mhs->nama_mhs }}
                        <input type="hidden" name="id_mahasiswa[]" value="{{ $mhs->id_mahasiswa }}">
                    </td>

                    {{-- KEHADIRAN --}}
                    <td>
                        <input type="number"
                        name="nilai_kehadiran[]"
                        value="{{ $nilaiKehadiran[$mhs->id_mahasiswa] }}"
                        readonly
                        class="w-28 mx-auto text-center rounded-md border-gray-300 bg-gray-100 focus:ring-0">
                    </td>

                    {{-- INPUT NILAI --}}
                   @foreach(['nilai_sikap','nilai_formative','nilai_tugas','nilai_uts','nilai_uas'] as $field)
                    <td>
                        <input type="number"
                            name="{{ $field }}[]"
                            min="0" max="100"
                            class="nilai-input w-20 mx-auto text-center rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                    </td>
                    @endforeach

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    {{-- FOOTER --}}
    <div class="flex flex-wrap justify-between items-center gap-3 px-6 py-4 bg-gray-50">
        <a href="{{ route('nilai.index') }}"
           class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm">
            ← Back
        </a>

        <button type="submit"
            class="px-5 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold">
            💾 Submit
        </button>
    </div>

</div>
</form>
</div>

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("form-nilai");
    if (!form) return;

    form.addEventListener("submit", function (e) {
        const rows = document.querySelectorAll("tbody tr");

        for (const row of rows) {
            const inputs = row.querySelectorAll(".nilai-input");

            let filled = 0;
            inputs.forEach(i => {
                if (i.value.trim() !== "") filled++;
            });

            if (filled > 0 && filled < inputs.length) {
                e.preventDefault();

                const emptyInput = [...inputs].find(i => i.value.trim() === "");

                emptyInput.required = true;
                emptyInput.setCustomValidity("Harap lengkapi semua nilai pada baris mahasiswa yang sudah diisi");
                emptyInput.reportValidity();
                emptyInput.focus();

                return;
            }
        }
    });

    document.querySelectorAll(".nilai-input").forEach(input => {
        input.addEventListener("input", () => {
            input.required = false;
            input.setCustomValidity("");
        });
    });

});
</script>
@endpush
@endsection
