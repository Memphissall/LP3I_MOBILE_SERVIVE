<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MatkulSeeder extends Seeder
{
    public function run()
    {
        // Get bidang keahlian IDs with robust fallback
        $bkMap = DB::table('bidang_keahlian')->pluck('id_bidang_keahlian', 'kode');

        // Map legacy codes to possible new codes (LP3I standard)
        $oaa = $bkMap['OAA'] ?? $bkMap['AB'] ?? $bkMap['KA'] ?? $bkMap['MP'] ?? null;
        $ais = $bkMap['AIS'] ?? $bkMap['SI'] ?? $bkMap['MI'] ?? null;
        $ase = $bkMap['ASE'] ?? $bkMap['TI'] ?? $bkMap['IF'] ?? null;

        if (!$oaa || !$ais || !$ase) {
            $this->command->warn("Warning: Some Bidang Keahlian codes (OAA, AIS, ASE) not found. Seeder might skip some data.");
            // Try to fetch ANY id if specific ones are missing, to avoid crash
            $firstId = DB::table('bidang_keahlian')->value('id_bidang_keahlian');
            $oaa = $oaa ?? $firstId;
            $ais = $ais ?? $firstId;
            $ase = $ase ?? $firstId;
        }

        $matkul = [
            // OAA - Semester 1
            ['kode_mk' => '23OM0101', 'nama_mk' => 'English for General Communication 1', 'sks' => 4, 'bobot_kompetensi' => 80, 'semester' => 1, 'id_bidang_keahlian' => $oaa],
            ['kode_mk' => '23OM0102', 'nama_mk' => 'Computer for Office 1', 'sks' => 2, 'bobot_kompetensi' => 75, 'semester' => 1, 'id_bidang_keahlian' => $oaa],
            ['kode_mk' => '23OM0103', 'nama_mk' => 'Personality Development & Communication 1', 'sks' => 2, 'bobot_kompetensi' => 70, 'semester' => 1, 'id_bidang_keahlian' => $oaa],
            ['kode_mk' => '23OM0104', 'nama_mk' => 'Business Administration', 'sks' => 2, 'bobot_kompetensi' => 75, 'semester' => 1, 'id_bidang_keahlian' => $oaa],
            ['kode_mk' => '23OM0105', 'nama_mk' => 'Accounting for Business', 'sks' => 4, 'bobot_kompetensi' => 80, 'semester' => 1, 'id_bidang_keahlian' => $oaa],
            ['kode_mk' => '23OM0106', 'nama_mk' => 'Modern Office Administration', 'sks' => 2, 'bobot_kompetensi' => 75, 'semester' => 1, 'id_bidang_keahlian' => $oaa],
            ['kode_mk' => '23OM0107', 'nama_mk' => 'Administration Principle', 'sks' => 2, 'bobot_kompetensi' => 70, 'semester' => 1, 'id_bidang_keahlian' => $oaa],
            ['kode_mk' => '23OM0108', 'nama_mk' => 'Human Resources Management 1', 'sks' => 2, 'bobot_kompetensi' => 75, 'semester' => 1, 'id_bidang_keahlian' => $oaa],
            ['kode_mk' => '23OM0109', 'nama_mk' => 'Mentoring of Religion', 'sks' => 0, 'bobot_kompetensi' => 50, 'semester' => 1, 'id_bidang_keahlian' => $oaa],
            
            // OAA - Semester 2
            ['kode_mk' => '23OM0201', 'nama_mk' => 'English for General Communication 2', 'sks' => 2, 'bobot_kompetensi' => 80, 'semester' => 2, 'id_bidang_keahlian' => $oaa],
            ['kode_mk' => '23OM0202', 'nama_mk' => 'Smart Entrepreneurship 1', 'sks' => 2, 'bobot_kompetensi' => 70, 'semester' => 2, 'id_bidang_keahlian' => $oaa],
            ['kode_mk' => '23OM0203', 'nama_mk' => 'Human Resources Management 2', 'sks' => 4, 'bobot_kompetensi' => 80, 'semester' => 2, 'id_bidang_keahlian' => $oaa],
            ['kode_mk' => '23OM0204', 'nama_mk' => 'Marketing Principles', 'sks' => 2, 'bobot_kompetensi' => 75, 'semester' => 2, 'id_bidang_keahlian' => $oaa],
            ['kode_mk' => '23OM0205', 'nama_mk' => 'Filing Digital', 'sks' => 4, 'bobot_kompetensi' => 85, 'semester' => 2, 'id_bidang_keahlian' => $oaa],
            ['kode_mk' => '23OM0206', 'nama_mk' => 'Applied Computer 2', 'sks' => 2, 'bobot_kompetensi' => 80, 'semester' => 2, 'id_bidang_keahlian' => $oaa],
            ['kode_mk' => '23OM0207', 'nama_mk' => 'Business Correspondence 2', 'sks' => 2, 'bobot_kompetensi' => 75, 'semester' => 2, 'id_bidang_keahlian' => $oaa],
            ['kode_mk' => '23OM0208', 'nama_mk' => 'Education of Religion', 'sks' => 2, 'bobot_kompetensi' => 70, 'semester' => 2, 'id_bidang_keahlian' => $oaa],
            ['kode_mk' => '23OM0209', 'nama_mk' => 'Design Thinking', 'sks' => 2, 'bobot_kompetensi' => 75, 'semester' => 2, 'id_bidang_keahlian' => $oaa],
            
            // OAA - Semester 3
            ['kode_mk' => '23OM0301', 'nama_mk' => 'English for Workplace Communication', 'sks' => 2, 'bobot_kompetensi' => 85, 'semester' => 3, 'id_bidang_keahlian' => $oaa],
            ['kode_mk' => '23OM0302', 'nama_mk' => 'Stock Exchange', 'sks' => 2, 'bobot_kompetensi' => 70, 'semester' => 3, 'id_bidang_keahlian' => $oaa],
            ['kode_mk' => '23OM0303', 'nama_mk' => 'Industrial Psychology', 'sks' => 2, 'bobot_kompetensi' => 75, 'semester' => 3, 'id_bidang_keahlian' => $oaa],
            ['kode_mk' => '23OM0304', 'nama_mk' => 'Banking and Non Banking', 'sks' => 2, 'bobot_kompetensi' => 75, 'semester' => 3, 'id_bidang_keahlian' => $oaa],
            ['kode_mk' => '23OM0305', 'nama_mk' => 'Computer on Database', 'sks' => 4, 'bobot_kompetensi' => 85, 'semester' => 3, 'id_bidang_keahlian' => $oaa],
            ['kode_mk' => '23OM0306', 'nama_mk' => 'Taxation', 'sks' => 4, 'bobot_kompetensi' => 80, 'semester' => 3, 'id_bidang_keahlian' => $oaa],
            ['kode_mk' => '23OM0307', 'nama_mk' => 'Logistic Management', 'sks' => 2, 'bobot_kompetensi' => 75, 'semester' => 3, 'id_bidang_keahlian' => $oaa],
            ['kode_mk' => '23OM0308', 'nama_mk' => 'K3 & ISO', 'sks' => 2, 'bobot_kompetensi' => 70, 'semester' => 3, 'id_bidang_keahlian' => $oaa],
            ['kode_mk' => '23OM0309', 'nama_mk' => 'Digital Literacy', 'sks' => 2, 'bobot_kompetensi' => 80, 'semester' => 3, 'id_bidang_keahlian' => $oaa],
            
            // OAA - Semester 4
            ['kode_mk' => '23OM0401', 'nama_mk' => 'English for Job Seeker', 'sks' => 2, 'bobot_kompetensi' => 85, 'semester' => 4, 'id_bidang_keahlian' => $oaa],
            ['kode_mk' => '23OM0402', 'nama_mk' => 'Smart Entrepreneurship 2', 'sks' => 2, 'bobot_kompetensi' => 75, 'semester' => 4, 'id_bidang_keahlian' => $oaa],
            ['kode_mk' => '23OM0403', 'nama_mk' => 'Psychology and Professional Ethics', 'sks' => 2, 'bobot_kompetensi' => 70, 'semester' => 4, 'id_bidang_keahlian' => $oaa],
            ['kode_mk' => '23OM0404', 'nama_mk' => 'Application Project', 'sks' => 4, 'bobot_kompetensi' => 90, 'semester' => 4, 'id_bidang_keahlian' => $oaa],
            ['kode_mk' => '23OM0405', 'nama_mk' => 'Office Management Practice', 'sks' => 4, 'bobot_kompetensi' => 85, 'semester' => 4, 'id_bidang_keahlian' => $oaa],
            ['kode_mk' => '23OM0406', 'nama_mk' => 'Financial Management', 'sks' => 2, 'bobot_kompetensi' => 80, 'semester' => 4, 'id_bidang_keahlian' => $oaa],
            ['kode_mk' => '23OM0407', 'nama_mk' => 'Export Import Administration', 'sks' => 4, 'bobot_kompetensi' => 75, 'semester' => 4, 'id_bidang_keahlian' => $oaa],
            ['kode_mk' => '23OM0408', 'nama_mk' => 'Leadership & Critical Thinking', 'sks' => 2, 'bobot_kompetensi' => 80, 'semester' => 4, 'id_bidang_keahlian' => $oaa],
            
            // AIS - Semester 1
            ['kode_mk' => '23CA0101', 'nama_mk' => 'English for General Communication 1', 'sks' => 4, 'bobot_kompetensi' => 80, 'semester' => 1, 'id_bidang_keahlian' => $ais],
            ['kode_mk' => '23CA0102', 'nama_mk' => 'Computer for Office 1', 'sks' => 2, 'bobot_kompetensi' => 75, 'semester' => 1, 'id_bidang_keahlian' => $ais],
            ['kode_mk' => '23CA0103', 'nama_mk' => 'Computer for Office 2', 'sks' => 2, 'bobot_kompetensi' => 75, 'semester' => 1, 'id_bidang_keahlian' => $ais],
            ['kode_mk' => '23CA0104', 'nama_mk' => 'Accounting Principle', 'sks' => 4, 'bobot_kompetensi' => 85, 'semester' => 1, 'id_bidang_keahlian' => $ais],
            ['kode_mk' => '23CA0105', 'nama_mk' => 'Taxation 1', 'sks' => 4, 'bobot_kompetensi' => 80, 'semester' => 1, 'id_bidang_keahlian' => $ais],
            ['kode_mk' => '23CA0106', 'nama_mk' => 'Basic Economic', 'sks' => 2, 'bobot_kompetensi' => 70, 'semester' => 1, 'id_bidang_keahlian' => $ais],
            ['kode_mk' => '23CA0107', 'nama_mk' => 'Personality Development & Communication Skill', 'sks' => 2, 'bobot_kompetensi' => 75, 'semester' => 1, 'id_bidang_keahlian' => $ais],
            ['kode_mk' => '23CA0108', 'nama_mk' => 'Mentoring of Religion', 'sks' => 0, 'bobot_kompetensi' => 50, 'semester' => 1, 'id_bidang_keahlian' => $ais],
            
            // AIS - Semester 2
            ['kode_mk' => '23CA0201', 'nama_mk' => 'English for General Communication 2', 'sks' => 2, 'bobot_kompetensi' => 80, 'semester' => 2, 'id_bidang_keahlian' => $ais],
            ['kode_mk' => '23CA0202', 'nama_mk' => 'Accounting Practice 1', 'sks' => 2, 'bobot_kompetensi' => 85, 'semester' => 2, 'id_bidang_keahlian' => $ais],
            ['kode_mk' => '23CA0203', 'nama_mk' => 'Cost Accounting', 'sks' => 2, 'bobot_kompetensi' => 80, 'semester' => 2, 'id_bidang_keahlian' => $ais],
            ['kode_mk' => '23CA0204', 'nama_mk' => 'Intermediate Accounting', 'sks' => 4, 'bobot_kompetensi' => 85, 'semester' => 2, 'id_bidang_keahlian' => $ais],
            ['kode_mk' => '23CA0205', 'nama_mk' => 'Excel for Accounting', 'sks' => 2, 'bobot_kompetensi' => 80, 'semester' => 2, 'id_bidang_keahlian' => $ais],
            ['kode_mk' => '23CA0206', 'nama_mk' => 'Taxation 2', 'sks' => 4, 'bobot_kompetensi' => 85, 'semester' => 2, 'id_bidang_keahlian' => $ais],
            ['kode_mk' => '23CA0207', 'nama_mk' => 'Smart Entrepreneurship 1', 'sks' => 2, 'bobot_kompetensi' => 70, 'semester' => 2, 'id_bidang_keahlian' => $ais],
            ['kode_mk' => '23CA0208', 'nama_mk' => 'Design Thinking', 'sks' => 2, 'bobot_kompetensi' => 75, 'semester' => 2, 'id_bidang_keahlian' => $ais],
            ['kode_mk' => '23CA0209', 'nama_mk' => 'Education of Religion', 'sks' => 2, 'bobot_kompetensi' => 70, 'semester' => 2, 'id_bidang_keahlian' => $ais],
            
            // AIS - Semester 3
            ['kode_mk' => '23CA0301', 'nama_mk' => 'English for Workplace Communication', 'sks' => 2, 'bobot_kompetensi' => 85, 'semester' => 3, 'id_bidang_keahlian' => $ais],
            ['kode_mk' => '23CA0302', 'nama_mk' => 'Advance Accounting', 'sks' => 4, 'bobot_kompetensi' => 90, 'semester' => 3, 'id_bidang_keahlian' => $ais],
            ['kode_mk' => '23CA0303', 'nama_mk' => 'Financial Management', 'sks' => 2, 'bobot_kompetensi' => 85, 'semester' => 3, 'id_bidang_keahlian' => $ais],
            ['kode_mk' => '23CA0304', 'nama_mk' => 'Cost Accounting Practice', 'sks' => 2, 'bobot_kompetensi' => 80, 'semester' => 3, 'id_bidang_keahlian' => $ais],
            ['kode_mk' => '23CA0305', 'nama_mk' => 'Accounting System', 'sks' => 4, 'bobot_kompetensi' => 85, 'semester' => 3, 'id_bidang_keahlian' => $ais],
            ['kode_mk' => '23CA0306', 'nama_mk' => 'Tax Accounting', 'sks' => 4, 'bobot_kompetensi' => 85, 'semester' => 3, 'id_bidang_keahlian' => $ais],
            ['kode_mk' => '23CA0307', 'nama_mk' => 'K3 & ISO', 'sks' => 2, 'bobot_kompetensi' => 70, 'semester' => 3, 'id_bidang_keahlian' => $ais],
            ['kode_mk' => '23CA0308', 'nama_mk' => 'Digital Literacy', 'sks' => 2, 'bobot_kompetensi' => 80, 'semester' => 3, 'id_bidang_keahlian' => $ais],
            
            // AIS - Semester 4
            ['kode_mk' => '22A1S0401', 'nama_mk' => 'English for Job Seeker', 'sks' => 2, 'bobot_kompetensi' => 85, 'semester' => 4, 'id_bidang_keahlian' => $ais],
            ['kode_mk' => '22A1S0402', 'nama_mk' => 'Application Project', 'sks' => 4, 'bobot_kompetensi' => 90, 'semester' => 4, 'id_bidang_keahlian' => $ais],
            ['kode_mk' => '22A1S0403', 'nama_mk' => 'Intermediate Accounting Practice', 'sks' => 2, 'bobot_kompetensi' => 85, 'semester' => 4, 'id_bidang_keahlian' => $ais],
            ['kode_mk' => '22A1S0404', 'nama_mk' => 'Tax Practice', 'sks' => 2, 'bobot_kompetensi' => 85, 'semester' => 4, 'id_bidang_keahlian' => $ais],
            ['kode_mk' => '22A1S0405', 'nama_mk' => 'Accounting Software', 'sks' => 4, 'bobot_kompetensi' => 90, 'semester' => 4, 'id_bidang_keahlian' => $ais],
            ['kode_mk' => '22A1S0406', 'nama_mk' => 'Business & Professional Ethics', 'sks' => 2, 'bobot_kompetensi' => 75, 'semester' => 4, 'id_bidang_keahlian' => $ais],
            ['kode_mk' => '22A1S0407', 'nama_mk' => 'Budgeting', 'sks' => 2, 'bobot_kompetensi' => 80, 'semester' => 4, 'id_bidang_keahlian' => $ais],
            ['kode_mk' => '22A1S0408', 'nama_mk' => 'Leadership & Critical Thinking', 'sks' => 2, 'bobot_kompetensi' => 80, 'semester' => 4, 'id_bidang_keahlian' => $ais],
            ['kode_mk' => '22A1S0409', 'nama_mk' => 'Smart Entrepreneurship 2', 'sks' => 2, 'bobot_kompetensi' => 75, 'semester' => 4, 'id_bidang_keahlian' => $ais],
            
            // ASE - Semester 1
            ['kode_mk' => '231C0101', 'nama_mk' => 'English for General Communication 1', 'sks' => 4, 'bobot_kompetensi' => 80, 'semester' => 1, 'id_bidang_keahlian' => $ase],
            ['kode_mk' => '231C0102', 'nama_mk' => 'Personality Development & Communication Skill', 'sks' => 2, 'bobot_kompetensi' => 75, 'semester' => 1, 'id_bidang_keahlian' => $ase],
            ['kode_mk' => '231C0103', 'nama_mk' => 'Web Design', 'sks' => 2, 'bobot_kompetensi' => 85, 'semester' => 1, 'id_bidang_keahlian' => $ase],
            ['kode_mk' => '231C0104', 'nama_mk' => 'Algorithm & Basic Programming', 'sks' => 4, 'bobot_kompetensi' => 90, 'semester' => 1, 'id_bidang_keahlian' => $ase],
            ['kode_mk' => '231C0105', 'nama_mk' => 'Computer for Office 1', 'sks' => 2, 'bobot_kompetensi' => 75, 'semester' => 1, 'id_bidang_keahlian' => $ase],
            ['kode_mk' => '231C0106', 'nama_mk' => 'Introduction to Computer Technology', 'sks' => 2, 'bobot_kompetensi' => 80, 'semester' => 1, 'id_bidang_keahlian' => $ase],
            ['kode_mk' => '231C0107', 'nama_mk' => 'Computer for Office 2', 'sks' => 2, 'bobot_kompetensi' => 75, 'semester' => 1, 'id_bidang_keahlian' => $ase],
            ['kode_mk' => '231C0108', 'nama_mk' => 'Mentoring of Religion', 'sks' => 0, 'bobot_kompetensi' => 50, 'semester' => 1, 'id_bidang_keahlian' => $ase],
            
            // ASE - Semester 2
            ['kode_mk' => '231C0201', 'nama_mk' => 'Database Administration', 'sks' => 2, 'bobot_kompetensi' => 85, 'semester' => 2, 'id_bidang_keahlian' => $ase],
            ['kode_mk' => '231C0202', 'nama_mk' => 'Web Programming 1', 'sks' => 4, 'bobot_kompetensi' => 90, 'semester' => 2, 'id_bidang_keahlian' => $ase],
            ['kode_mk' => '231C0203', 'nama_mk' => 'Computer Network Design', 'sks' => 2, 'bobot_kompetensi' => 80, 'semester' => 2, 'id_bidang_keahlian' => $ase],
            ['kode_mk' => '231C0204', 'nama_mk' => 'English for General Communication 2', 'sks' => 2, 'bobot_kompetensi' => 80, 'semester' => 2, 'id_bidang_keahlian' => $ase],
            ['kode_mk' => '231C0205', 'nama_mk' => 'Technique of Presentation', 'sks' => 2, 'bobot_kompetensi' => 75, 'semester' => 2, 'id_bidang_keahlian' => $ase],
            ['kode_mk' => '231C0206', 'nama_mk' => 'Education of Religion', 'sks' => 2, 'bobot_kompetensi' => 70, 'semester' => 2, 'id_bidang_keahlian' => $ase],
            ['kode_mk' => '231C0207', 'nama_mk' => 'Smart Entrepreneurship 1', 'sks' => 2, 'bobot_kompetensi' => 70, 'semester' => 2, 'id_bidang_keahlian' => $ase],
            ['kode_mk' => '231C0208', 'nama_mk' => 'Design Thinking', 'sks' => 2, 'bobot_kompetensi' => 75, 'semester' => 2, 'id_bidang_keahlian' => $ase],
            ['kode_mk' => '231C0209', 'nama_mk' => 'Graphics Design', 'sks' => 2, 'bobot_kompetensi' => 80, 'semester' => 2, 'id_bidang_keahlian' => $ase],
            
            // ASE - Semester 3
            ['kode_mk' => '231C0301', 'nama_mk' => 'Framework Programming', 'sks' => 4, 'bobot_kompetensi' => 90, 'semester' => 3, 'id_bidang_keahlian' => $ase],
            ['kode_mk' => '231C0302', 'nama_mk' => 'Digital Literacy', 'sks' => 2, 'bobot_kompetensi' => 80, 'semester' => 3, 'id_bidang_keahlian' => $ase],
            ['kode_mk' => '231C0303', 'nama_mk' => 'Mobile Programming', 'sks' => 4, 'bobot_kompetensi' => 90, 'semester' => 3, 'id_bidang_keahlian' => $ase],
            ['kode_mk' => '231C0304', 'nama_mk' => 'Design Graphics 2', 'sks' => 2, 'bobot_kompetensi' => 80, 'semester' => 3, 'id_bidang_keahlian' => $ase],
            ['kode_mk' => '231C0305', 'nama_mk' => 'English for Workplace Communication', 'sks' => 2, 'bobot_kompetensi' => 85, 'semester' => 3, 'id_bidang_keahlian' => $ase],
            ['kode_mk' => '231C0306', 'nama_mk' => 'Mobile Programming', 'sks' => 4, 'bobot_kompetensi' => 90, 'semester' => 3, 'id_bidang_keahlian' => $ase],
            ['kode_mk' => '231C0307', 'nama_mk' => 'System Design Analyst', 'sks' => 2, 'bobot_kompetensi' => 85, 'semester' => 3, 'id_bidang_keahlian' => $ase],
            ['kode_mk' => '231C0308', 'nama_mk' => 'K3 & ISO', 'sks' => 2, 'bobot_kompetensi' => 70, 'semester' => 3, 'id_bidang_keahlian' => $ase],
            
            // ASE - Semester 4
            ['kode_mk' => '231C0401', 'nama_mk' => 'English for Job Seeker', 'sks' => 2, 'bobot_kompetensi' => 85, 'semester' => 4, 'id_bidang_keahlian' => $ase],
            ['kode_mk' => '231C0402', 'nama_mk' => 'Smart Entrepreneurship 2', 'sks' => 2, 'bobot_kompetensi' => 75, 'semester' => 4, 'id_bidang_keahlian' => $ase],
            ['kode_mk' => '231C0403', 'nama_mk' => 'Application Project', 'sks' => 4, 'bobot_kompetensi' => 95, 'semester' => 4, 'id_bidang_keahlian' => $ase],
            ['kode_mk' => '231C0404', 'nama_mk' => 'Object Oriented Programming', 'sks' => 4, 'bobot_kompetensi' => 90, 'semester' => 4, 'id_bidang_keahlian' => $ase],
            ['kode_mk' => '231C0405', 'nama_mk' => 'UI/UX Design', 'sks' => 2, 'bobot_kompetensi' => 85, 'semester' => 4, 'id_bidang_keahlian' => $ase],
            ['kode_mk' => '231C0406', 'nama_mk' => 'Computer Networking 2', 'sks' => 2, 'bobot_kompetensi' => 80, 'semester' => 4, 'id_bidang_keahlian' => $ase],
            ['kode_mk' => '231C0407', 'nama_mk' => 'Psychology and Professional Ethics', 'sks' => 2, 'bobot_kompetensi' => 75, 'semester' => 4, 'id_bidang_keahlian' => $ase],
            ['kode_mk' => '231C0408', 'nama_mk' => 'Leadership & Critical Thinking', 'sks' => 2, 'bobot_kompetensi' => 80, 'semester' => 4, 'id_bidang_keahlian' => $ase],
            ['kode_mk' => '231C0409', 'nama_mk' => 'Framework Programming 2', 'sks' => 2, 'bobot_kompetensi' => 90, 'semester' => 4, 'id_bidang_keahlian' => $ase],
        ];

        foreach ($matkul as $mk) {
            DB::table('mata_kuliah')->updateOrInsert(
                ['kode_mk' => $mk['kode_mk']], // Key to check for existence
                array_merge($mk, [
                    'deskripsi' => null,
                    'sap' => null,
                    'updated_at' => now(),
                    // created_at will be handled by DB default or preserved on update
                ])
            );
        }
    }
}
