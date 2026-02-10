@extends('layouts.app')

@section('content')

<style>
:root {
    --primary: #009DA5;
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
    background: linear-gradient(135deg, var(--primary), #004269);
    color: white;
    border-radius: 16px;
    padding: 24px;
}

#datetime {
    font-size: 14px;
    margin-top: 6px;
    opacity: .9;
}

/* CARD */
.card {
    background: #fff;
    border-radius: 14px;
    padding: 20px;
    border: 1px solid var(--border);
}

.grid-3 {
    display: grid;
    grid-template-columns: repeat(3,1fr);
    gap: 20px;
    margin-top: 22px;
}

.card i {
    font-size: 24px;
    color: var(--primary);
}

.card h3 {
    margin: 12px 0 6px;
}

.card p {
    font-size: 13px;
    color: #6b7280;
}

.card a {
    font-size: 13px;
    color: var(--primary);
    font-weight: 600;
    text-decoration: none;
}

/* ICON GRID (ABSENSI, GAJI DLL) */
.icon-grid {
    display: grid;
    grid-template-columns: repeat(2,1fr);
    gap: 18px;
    margin-top: 24px;
}

.icon-card {
    background: white;
    border-radius: 14px;
    padding: 26px 20px;
    border: 1px solid var(--border);
    text-align: center;
    font-weight: 600;
    color: #374151;
}

.icon-card i {
    font-size: 28px;
    margin-bottom: 6px;
    color: var(--primary);
}

/* RIGHT BAR */
.rightbar {
    background: linear-gradient(180deg, var(--dark1), var(--dark2));
    border-radius: 18px;
    padding: 22px;
    color: white;
}

/* CALENDAR */
.calendar h4 {
    text-align: center;
    margin-bottom: 16px;
}

.calendar-grid {
    display: grid;
    grid-template-columns: repeat(7,1fr);
    gap: 8px;
    text-align: center;
    font-size: 13px;
}

.calendar-grid .day {
    color: #7dd3fc;
    font-weight: bold;
}

.calendar-grid .date {
    padding: 8px 0;
    border-radius: 8px;
    background: rgba(255,255,255,.08);
}

.calendar-grid .today {
    background: var(--primary);
    font-weight: bold;
}
</style>

<div class="page-wrapper">
<div class="dashboard">

    <!-- LEFT -->
    <div>

        <div class="welcome">
            <h2>HII, {{ Auth::user()->name }}!</h2>
            <p>Dashboard Pendidik</p>
            <p id="datetime"></p>
        </div>

        <div class="grid-3">
            <div class="card">
                <i class="fa-solid fa-calendar-days"></i>
                <h3>Jadwal Mengajar</h3>
                <p>Lihat jadwal Anda minggu ini.</p>
                <a href="{{ route('pendidik.jadwal.index') }}">Lihat Jadwal →</a>
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

        <!-- 🔴 BAGIAN INI TIDAK HILANG -->
        <div class="icon-grid">
            <a href="{{ route('pendidik.absen') }}" class="icon-card">
                <i class="fa-solid fa-user-check"></i>
                <div>Absensi</div>
            </a>

            <a href="{{ route('pendidik.gaji') }}" class="icon-card">
                <i class="fa-solid fa-money-bill-wave"></i>
                <div>Gaji</div>
            </a>

            <a href="#" class="icon-card">
                <i class="fa-solid fa-file-arrow-down"></i>
                <div>Download SAP</div>
            </a>

            <a href="{{ route('nilai.index') }}" class="icon-card">
                <i class="fa-solid fa-star"></i>
                <div>Nilai</div>
            </a>
        </div>
        <!-- 🔴 END -->

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

<!-- ================= REAL TIME CLOCK + CALENDAR ================= -->
<script>
// JAM REAL TIME
function updateDateTime() {
    const now = new Date();
    const days = ["Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"];
    const months = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];

    const h = String(now.getHours()).padStart(2,'0');
    const m = String(now.getMinutes()).padStart(2,'0');
    const s = String(now.getSeconds()).padStart(2,'0');

    document.getElementById('datetime').innerText =
        `${days[now.getDay()]}, ${now.getDate()} ${months[now.getMonth()]} ${now.getFullYear()} • ${h}:${m}:${s} WIB`;
}
updateDateTime();
setInterval(updateDateTime,1000);

// CALENDAR
const today = new Date();
const year = today.getFullYear();
const month = today.getMonth();
const dateToday = today.getDate();

const monthNames = ["January","February","March","April","May","June","July","August","September","October","November","December"];
document.getElementById('calendar-title').innerText = `${monthNames[month]} ${year}`;

const days = ["Sun","Mon","Tue","Wed","Thu","Fri","Sat"];
const daysEl = document.getElementById('calendar-days');
const datesEl = document.getElementById('calendar-dates');

days.forEach(d=>{
    const div=document.createElement('div');
    div.className='day';
    div.innerText=d;
    daysEl.appendChild(div);
});

const firstDay = new Date(year,month,1).getDay();
const totalDays = new Date(year,month+1,0).getDate();

for(let i=0;i<firstDay;i++) datesEl.appendChild(document.createElement('div'));

for(let d=1;d<=totalDays;d++){
    const div=document.createElement('div');
    div.className='date';
    if(d===dateToday) div.classList.add('today');
    div.innerText=d;
    datesEl.appendChild(div);
}
</script>

@endsection
