@extends('layouts.app')

@section('content')

<style>
:root {
    --indigo: #004269;
    --viridian: #009DA5;
    --dark1: #033a57;
    --dark2: #022b40;
    --border: #e5e7eb;
}

/* PAGE */
.page-wrapper {
    background: #f4f6f8;
    padding: 24px;
}

/* LAYOUT */
.dashboard {
    display: grid;
    grid-template-columns: 3fr 1.2fr;
    gap: 22px;
}

/* WELCOME */
.welcome {
    background: linear-gradient(135deg, #009DA5, #004269);
    color: white;
    border-radius: 14px;
    padding: 22px;
}

.welcome h2 {
    margin: 0;
}

.welcome p {
    margin-top: 4px;
    opacity: .9;
}

/* WHITE CARD */
.card {
    background: #fff;
    border-radius: 14px;
    padding: 18px;
    border: 1px solid var(--border);
}

.grid-3 {
    display: grid;
    grid-template-columns: repeat(3,1fr);
    gap: 18px;
    margin-top: 20px;
}

.card i {
    font-size: 24px;
    color: var(--viridian);
}

.card h3 {
    margin: 12px 0 6px;
    font-size: 16px;
    color: var(--indigo);
}

.card p {
    font-size: 13px;
    color: #6b7280;
}

.card a {
    font-size: 13px;
    color: var(--viridian);
    font-weight: 600;
    text-decoration: none;
}

/* SHORTCUT */
.icon-grid {
    display: grid;
    grid-template-columns: repeat(2,1fr);
    gap: 16px;
    margin-top: 22px;
}

.icon-card {
    background: white;
    border-radius: 14px;
    padding: 20px;
    border: 1px solid var(--border);
    text-align: center;
}

.icon-card i {
    font-size: 24px;
    color: var(--viridian);
}

/* RIGHT SIDEBAR */
.rightbar {
    background: linear-gradient(180deg, var(--dark1), var(--dark2));
    border-radius: 16px;
    padding: 20px;
    color: white;
}

/* CALENDAR */
.calendar h4 {
    text-align: center;
    margin-bottom: 12px;
}

.calendar-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 6px;
    text-align: center;
    font-size: 13px;
}

.calendar-grid .day {
    font-weight: bold;
    color: #a5f3fc;
}

.calendar-grid .date {
    padding: 8px 0;
    border-radius: 6px;
    background: rgba(255,255,255,.08);
}

.calendar-grid .today {
    background: var(--viridian);
    font-weight: bold;
}
</style>

<div class="page-wrapper">
<div class="dashboard">

    <!-- LEFT -->
    <div>

        <div class="welcome">
            <h2>Good Day, {{ Auth::user()->name }}!</h2>
            <p>Dashboard Dosen</p>
        </div>

        <div class="grid-3">

            <div class="card">
                <i class="fa-solid fa-calendar-days"></i>
                <h3>Jadwal Mengajar</h3>
                <p>Lihat jadwal Anda minggu ini.</p>
                <a href="{{ route('dosen.jadwal.index') }}">Lihat Jadwal →</a>
            </div>

            <div class="card">
                <i class="fa-solid fa-file-lines"></i>
                <h3>Tugas Mahasiswa</h3>
                <p>Pantau tugas mahasiswa.</p>
                <a href="{{ route('tugas.pilih') }}">Kelola Tugas →</a>
            </div>

            <div class="card">
                <i class="fa-solid fa-book"></i>
                <h3>Materi Kuliah</h3>
                <p>Upload dan update materi.</p>
                <a href="{{ route('materi.pilih') }}">Kelola Materi →</a>
            </div>

        </div>

        <div class="icon-grid">

            <a href="{{ route('dosen.absen') }}" class="icon-card">
                <i class="fa-solid fa-user-check"></i>
                <p>Absensi</p>
            </a>

            <a href="#" class="icon-card">
                <i class="fa-solid fa-money-bill-wave"></i>
                <p>Gaji</p>
            </a>

            <a href="#" class="icon-card">
                <i class="fa-solid fa-file-arrow-down"></i>
                <p>Download SAP</p>
            </a>

            <a href="{{ route('nilai.index') }}" class="icon-card">
                <i class="fa-solid fa-star"></i>
                <p>Nilai</p>
            </a>

        </div>

    </div>

    <!-- RIGHT -->
    <div class="rightbar">

        <div class="calendar">
            <h4 id="calendar-title"></h4>

            <div class="calendar-grid" id="calendar-days"></div>
            <div class="calendar-grid" id="calendar-dates"></div>
        </div>

    </div>

</div>
</div>

<!-- REAL TIME CALENDAR SCRIPT -->
<script>
const now = new Date();
const year = now.getFullYear();
const month = now.getMonth();
const today = now.getDate();

const monthNames = [
    "January","February","March","April","May","June",
    "July","August","September","October","November","December"
];

document.getElementById("calendar-title").innerText =
    monthNames[month] + " " + year;

const days = ["Sun","Mon","Tue","Wed","Thu","Fri","Sat"];
const daysContainer = document.getElementById("calendar-days");
const datesContainer = document.getElementById("calendar-dates");

days.forEach(d => {
    const div = document.createElement("div");
    div.className = "day";
    div.innerText = d;
    daysContainer.appendChild(div);
});

const firstDay = new Date(year, month, 1).getDay();
const totalDays = new Date(year, month + 1, 0).getDate();

for (let i = 0; i < firstDay; i++) {
    datesContainer.appendChild(document.createElement("div"));
}

for (let d = 1; d <= totalDays; d++) {
    const div = document.createElement("div");
    div.className = "date";
    if (d === today) div.classList.add("today");
    div.innerText = d;
    datesContainer.appendChild(div);
}
</script>

@endsection
