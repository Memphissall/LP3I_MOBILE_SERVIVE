<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MatkulSeeder extends Seeder
{
    public function run()
    {
        // Program Studi IDs from database
        // 1 = Accounting Information System (AIS)
        // 2 = Application Software Engineering (ASE)
        // 3 = Office Administration Automatization (OAA)

        $oaa = 3; // Office Administration Automatization
        $ais = 2; // Accounting Information System
        $ase = 1; // Application Software Engineering

        $matkul = [
            // ===== OAA - Semester 1 =====
            ['kode_mk' => '23OM0101', 'nama_mk' => 'English for General Communication 1', 'sks' => 4, 'semester' => 1, 'id_program_studi' => $oaa, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23OM0102', 'nama_mk' => 'Computer for Office 1', 'sks' => 2, 'semester' => 1, 'id_program_studi' => $oaa, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23OM0103', 'nama_mk' => 'Personality Development & Communication Skill', 'sks' => 2, 'semester' => 1, 'id_program_studi' => $oaa, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23OM0104', 'nama_mk' => 'Business Correspondence 1', 'sks' => 2, 'semester' => 1, 'id_program_studi' => $oaa, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23OM0105', 'nama_mk' => 'Accounting for Business', 'sks' => 2, 'semester' => 1, 'id_program_studi' => $oaa, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23OM0106', 'nama_mk' => 'Modern Office Administration', 'sks' => 2, 'semester' => 1, 'id_program_studi' => $oaa, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23OM0107', 'nama_mk' => 'Administration Principle', 'sks' => 2, 'semester' => 1, 'id_program_studi' => $oaa, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23OM0108', 'nama_mk' => 'Human Resources Management 1', 'sks' => 2, 'semester' => 1, 'id_program_studi' => $oaa, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23OM0109', 'nama_mk' => 'Mentoring of Religion', 'sks' => 0, 'semester' => 1, 'id_program_studi' => $oaa, 'tipe_matakuliah' => 0],
            
            // ===== OAA - Semester 2 =====
            ['kode_mk' => '23OM0201', 'nama_mk' => 'English for General Communication 2', 'sks' => 2, 'semester' => 2, 'id_program_studi' => $oaa, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23OM0202', 'nama_mk' => 'Smart Entrepreneurship 1', 'sks' => 2, 'semester' => 2, 'id_program_studi' => $oaa, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23OM0203', 'nama_mk' => 'Human Resources Management 2', 'sks' => 4, 'semester' => 2, 'id_program_studi' => $oaa, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23OM0204', 'nama_mk' => 'Marketing Principles', 'sks' => 2, 'semester' => 2, 'id_program_studi' => $oaa, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23OM0205', 'nama_mk' => 'Filing Digital', 'sks' => 4, 'semester' => 2, 'id_program_studi' => $oaa, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23OM0206', 'nama_mk' => 'Applied Computer 2', 'sks' => 2, 'semester' => 2, 'id_program_studi' => $oaa, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23OM0207', 'nama_mk' => 'Business Correspondence 2', 'sks' => 2, 'semester' => 2, 'id_program_studi' => $oaa, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23OM0208', 'nama_mk' => 'Education of Religion', 'sks' => 2, 'semester' => 2, 'id_program_studi' => $oaa, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23OM0209', 'nama_mk' => 'Design Thinking', 'sks' => 2, 'semester' => 2, 'id_program_studi' => $oaa, 'tipe_matakuliah' => 0],
            
            // ===== OAA - Semester 3 =====
            ['kode_mk' => '23OM0301', 'nama_mk' => 'English for Workplace Communication', 'sks' => 2, 'semester' => 3, 'id_program_studi' => $oaa, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23OM0302', 'nama_mk' => 'Stock Exchange', 'sks' => 2, 'semester' => 3, 'id_program_studi' => $oaa, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23OM0303', 'nama_mk' => 'Industrial Psychology', 'sks' => 2, 'semester' => 3, 'id_program_studi' => $oaa, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23OM0304', 'nama_mk' => 'Banking and Non Banking', 'sks' => 2, 'semester' => 3, 'id_program_studi' => $oaa, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23OM0305', 'nama_mk' => 'Computer for Database', 'sks' => 4, 'semester' => 3, 'id_program_studi' => $oaa, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23OM0306', 'nama_mk' => 'Taxation', 'sks' => 4, 'semester' => 3, 'id_program_studi' => $oaa, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23OM0307', 'nama_mk' => 'Logistic Management', 'sks' => 2, 'semester' => 3, 'id_program_studi' => $oaa, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23OM0308', 'nama_mk' => 'K3 & ISO', 'sks' => 2, 'semester' => 3, 'id_program_studi' => $oaa, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23OM0309', 'nama_mk' => 'Digital Literacy', 'sks' => 2, 'semester' => 3, 'id_program_studi' => $oaa, 'tipe_matakuliah' => 0],
            
            // ===== OAA - Semester 4 =====
            ['kode_mk' => '22OM0401', 'nama_mk' => 'English for Job Seeker', 'sks' => 2, 'semester' => 4, 'id_program_studi' => $oaa, 'tipe_matakuliah' => 0],
            ['kode_mk' => '22OM0402', 'nama_mk' => 'Smart Entrepreneurship 2', 'sks' => 2, 'semester' => 4, 'id_program_studi' => $oaa, 'tipe_matakuliah' => 0],
            ['kode_mk' => '22OM0403', 'nama_mk' => 'Psychology and Professional Ethics', 'sks' => 2, 'semester' => 4, 'id_program_studi' => $oaa, 'tipe_matakuliah' => 0],
            ['kode_mk' => '22OM0404', 'nama_mk' => 'Application Project', 'sks' => 4, 'semester' => 4, 'id_program_studi' => $oaa, 'tipe_matakuliah' => 0],
            ['kode_mk' => '22OM0405', 'nama_mk' => 'Office Management Practice', 'sks' => 4, 'semester' => 4, 'id_program_studi' => $oaa, 'tipe_matakuliah' => 0],
            ['kode_mk' => '22OM0406', 'nama_mk' => 'Financial Management', 'sks' => 2, 'semester' => 4, 'id_program_studi' => $oaa, 'tipe_matakuliah' => 0],
            ['kode_mk' => '22OM0407', 'nama_mk' => 'Export Import Administration', 'sks' => 4, 'semester' => 4, 'id_program_studi' => $oaa, 'tipe_matakuliah' => 0],
            ['kode_mk' => '22OM0408', 'nama_mk' => 'Leadership & Critical Thinking', 'sks' => 2, 'semester' => 4, 'id_program_studi' => $oaa, 'tipe_matakuliah' => 0],

            // ===== AIS - Semester 1 =====
            ['kode_mk' => '23CA0101', 'nama_mk' => 'English for General Communication 1', 'sks' => 4, 'semester' => 1, 'id_program_studi' => $ais, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23CA0102', 'nama_mk' => 'Computer for Office 1', 'sks' => 2, 'semester' => 1, 'id_program_studi' => $ais, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23CA0103', 'nama_mk' => 'Computer for Office 2', 'sks' => 2, 'semester' => 1, 'id_program_studi' => $ais, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23CA0104', 'nama_mk' => 'Accounting Principle', 'sks' => 4, 'semester' => 1, 'id_program_studi' => $ais, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23CA0105', 'nama_mk' => 'Taxation 1', 'sks' => 4, 'semester' => 1, 'id_program_studi' => $ais, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23CA0106', 'nama_mk' => 'Basic Economic', 'sks' => 2, 'semester' => 1, 'id_program_studi' => $ais, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23CA0107', 'nama_mk' => 'Personality Development & Communication Skills', 'sks' => 2, 'semester' => 1, 'id_program_studi' => $ais, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23CA0108', 'nama_mk' => 'Mentoring of Religion', 'sks' => 0, 'semester' => 1, 'id_program_studi' => $ais, 'tipe_matakuliah' => 0],
            
            // ===== AIS - Semester 2 =====
            ['kode_mk' => '23CA0201', 'nama_mk' => 'English for General Communication 2', 'sks' => 2, 'semester' => 2, 'id_program_studi' => $ais, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23CA0202', 'nama_mk' => 'Accounting Practice 1', 'sks' => 2, 'semester' => 2, 'id_program_studi' => $ais, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23CA0203', 'nama_mk' => 'Cost Accounting', 'sks' => 2, 'semester' => 2, 'id_program_studi' => $ais, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23CA0204', 'nama_mk' => 'Intermediate Accounting', 'sks' => 4, 'semester' => 2, 'id_program_studi' => $ais, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23CA0205', 'nama_mk' => 'Excel for Accounting', 'sks' => 2, 'semester' => 2, 'id_program_studi' => $ais, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23CA0206', 'nama_mk' => 'Taxation 2', 'sks' => 4, 'semester' => 2, 'id_program_studi' => $ais, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23CA0207', 'nama_mk' => 'Smart Entrepreneurship 1', 'sks' => 2, 'semester' => 2, 'id_program_studi' => $ais, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23CA0208', 'nama_mk' => 'Design Thinking', 'sks' => 2, 'semester' => 2, 'id_program_studi' => $ais, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23CA0209', 'nama_mk' => 'Education of Religion', 'sks' => 2, 'semester' => 2, 'id_program_studi' => $ais, 'tipe_matakuliah' => 0],
            
            // ===== AIS - Semester 3 =====
            ['kode_mk' => '23CA0301', 'nama_mk' => 'English for Workplace Communication', 'sks' => 2, 'semester' => 3, 'id_program_studi' => $ais, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23CA0302', 'nama_mk' => 'Advance Accounting', 'sks' => 4, 'semester' => 3, 'id_program_studi' => $ais, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23CA0303', 'nama_mk' => 'Financial Management', 'sks' => 2, 'semester' => 3, 'id_program_studi' => $ais, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23CA0304', 'nama_mk' => 'Cost Accounting Practice', 'sks' => 2, 'semester' => 3, 'id_program_studi' => $ais, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23CA0305', 'nama_mk' => 'Accounting System', 'sks' => 4, 'semester' => 3, 'id_program_studi' => $ais, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23CA0306', 'nama_mk' => 'Tax Accounting', 'sks' => 4, 'semester' => 3, 'id_program_studi' => $ais, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23CA0307', 'nama_mk' => 'K3 & ISO', 'sks' => 2, 'semester' => 3, 'id_program_studi' => $ais, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23CA0308', 'nama_mk' => 'Digital Literacy', 'sks' => 2, 'semester' => 3, 'id_program_studi' => $ais, 'tipe_matakuliah' => 0],
            
            // ===== AIS - Semester 4 =====
            ['kode_mk' => '22AIS0401', 'nama_mk' => 'English for Job Seeker', 'sks' => 2, 'semester' => 4, 'id_program_studi' => $ais, 'tipe_matakuliah' => 0],
            ['kode_mk' => '22AIS0402', 'nama_mk' => 'Application Project', 'sks' => 4, 'semester' => 4, 'id_program_studi' => $ais, 'tipe_matakuliah' => 0],
            ['kode_mk' => '22AIS0403', 'nama_mk' => 'Intermediate Accounting Practice', 'sks' => 2, 'semester' => 4, 'id_program_studi' => $ais, 'tipe_matakuliah' => 0],
            ['kode_mk' => '22AIS0404', 'nama_mk' => 'Tax Practice', 'sks' => 2, 'semester' => 4, 'id_program_studi' => $ais, 'tipe_matakuliah' => 0],
            ['kode_mk' => '22AIS0405', 'nama_mk' => 'Accounting Software', 'sks' => 4, 'semester' => 4, 'id_program_studi' => $ais, 'tipe_matakuliah' => 0],
            ['kode_mk' => '22AIS0406', 'nama_mk' => 'Business & Professional Ethics', 'sks' => 2, 'semester' => 4, 'id_program_studi' => $ais, 'tipe_matakuliah' => 0],
            ['kode_mk' => '22AIS0407', 'nama_mk' => 'Budgeting', 'sks' => 2, 'semester' => 4, 'id_program_studi' => $ais, 'tipe_matakuliah' => 0],
            ['kode_mk' => '22AIS0408', 'nama_mk' => 'Leadership & Critical Thinking', 'sks' => 2, 'semester' => 4, 'id_program_studi' => $ais, 'tipe_matakuliah' => 0],
            ['kode_mk' => '22AIS0409', 'nama_mk' => 'Smart Entrepreneurship 2', 'sks' => 2, 'semester' => 4, 'id_program_studi' => $ais, 'tipe_matakuliah' => 0],

            // ===== ASE - Semester 1 =====
            ['kode_mk' => '23IC0101', 'nama_mk' => 'English for General Communication 1', 'sks' => 4, 'semester' => 1, 'id_program_studi' => $ase, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23IC0102', 'nama_mk' => 'Personality Development & Communication Skill', 'sks' => 2, 'semester' => 1, 'id_program_studi' => $ase, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23IC0103', 'nama_mk' => 'Web Design', 'sks' => 2, 'semester' => 1, 'id_program_studi' => $ase, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23IC0104', 'nama_mk' => 'Algorithm & Basic Programming', 'sks' => 4, 'semester' => 1, 'id_program_studi' => $ase, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23IC0105', 'nama_mk' => 'Computer for Office 1', 'sks' => 2, 'semester' => 1, 'id_program_studi' => $ase, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23IC0106', 'nama_mk' => 'Introduction to Computer Technology', 'sks' => 2, 'semester' => 1, 'id_program_studi' => $ase, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23IC0107', 'nama_mk' => 'Computer for Office 2', 'sks' => 2, 'semester' => 1, 'id_program_studi' => $ase, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23IC0108', 'nama_mk' => 'Mentoring of Religion', 'sks' => 0, 'semester' => 1, 'id_program_studi' => $ase, 'tipe_matakuliah' => 0],
            
            // ===== ASE - Semester 2 =====
            ['kode_mk' => '23IC0201', 'nama_mk' => 'Database Administration', 'sks' => 2, 'semester' => 2, 'id_program_studi' => $ase, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23IC0202', 'nama_mk' => 'Web Programming 1', 'sks' => 4, 'semester' => 2, 'id_program_studi' => $ase, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23IC0203', 'nama_mk' => 'Computer Network Design', 'sks' => 2, 'semester' => 2, 'id_program_studi' => $ase, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23IC0204', 'nama_mk' => 'English for General Communication 2', 'sks' => 2, 'semester' => 2, 'id_program_studi' => $ase, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23IC0205', 'nama_mk' => 'Technique of Presentation', 'sks' => 2, 'semester' => 2, 'id_program_studi' => $ase, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23IC0206', 'nama_mk' => 'Education of Religion', 'sks' => 2, 'semester' => 2, 'id_program_studi' => $ase, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23IC0207', 'nama_mk' => 'Smart Entrepreneurship 1', 'sks' => 2, 'semester' => 2, 'id_program_studi' => $ase, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23IC0208', 'nama_mk' => 'Design Thinking', 'sks' => 2, 'semester' => 2, 'id_program_studi' => $ase, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23IC0209', 'nama_mk' => 'Graphics Design', 'sks' => 2, 'semester' => 2, 'id_program_studi' => $ase, 'tipe_matakuliah' => 0],
            
            // ===== ASE - Semester 3 =====
            ['kode_mk' => '23IC0301', 'nama_mk' => 'Framework Programming', 'sks' => 4, 'semester' => 3, 'id_program_studi' => $ase, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23IC0302', 'nama_mk' => 'Digital Literacy', 'sks' => 2, 'semester' => 3, 'id_program_studi' => $ase, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23IC0303', 'nama_mk' => 'Network Security', 'sks' => 2, 'semester' => 3, 'id_program_studi' => $ase, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23IC0304', 'nama_mk' => 'Design Graphics 2', 'sks' => 2, 'semester' => 3, 'id_program_studi' => $ase, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23IC0305', 'nama_mk' => 'English for Workplace Communication', 'sks' => 2, 'semester' => 3, 'id_program_studi' => $ase, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23IC0306', 'nama_mk' => 'Mobile Programming', 'sks' => 4, 'semester' => 3, 'id_program_studi' => $ase, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23IC0307', 'nama_mk' => 'System Design Analyst', 'sks' => 2, 'semester' => 3, 'id_program_studi' => $ase, 'tipe_matakuliah' => 0],
            ['kode_mk' => '23IC0308', 'nama_mk' => 'K3 & ISO', 'sks' => 2, 'semester' => 3, 'id_program_studi' => $ase, 'tipe_matakuliah' => 0],
            
            // ===== ASE - Semester 4 =====
            ['kode_mk' => '22IC0401', 'nama_mk' => 'English for Job Seeker', 'sks' => 2, 'semester' => 4, 'id_program_studi' => $ase, 'tipe_matakuliah' => 0],
            ['kode_mk' => '22IC0402', 'nama_mk' => 'Smart Entrepreneurship 2', 'sks' => 2, 'semester' => 4, 'id_program_studi' => $ase, 'tipe_matakuliah' => 0],
            ['kode_mk' => '22IC0403', 'nama_mk' => 'Application Project', 'sks' => 4, 'semester' => 4, 'id_program_studi' => $ase, 'tipe_matakuliah' => 0],
            ['kode_mk' => '22IC0404', 'nama_mk' => 'Object Oriented Programming', 'sks' => 4, 'semester' => 4, 'id_program_studi' => $ase, 'tipe_matakuliah' => 0],
            ['kode_mk' => '22IC0405', 'nama_mk' => 'UI/UX Design', 'sks' => 2, 'semester' => 4, 'id_program_studi' => $ase, 'tipe_matakuliah' => 0],
            ['kode_mk' => '22IC0406', 'nama_mk' => 'Computer Networking 2', 'sks' => 2, 'semester' => 4, 'id_program_studi' => $ase, 'tipe_matakuliah' => 0],
            ['kode_mk' => '22IC0407', 'nama_mk' => 'Psychology and Professional Ethics', 'sks' => 2, 'semester' => 4, 'id_program_studi' => $ase, 'tipe_matakuliah' => 0],
            ['kode_mk' => '22IC0408', 'nama_mk' => 'Leadership & Critical Thinking', 'sks' => 2, 'semester' => 4, 'id_program_studi' => $ase, 'tipe_matakuliah' => 0],
            ['kode_mk' => '22IC0409', 'nama_mk' => 'Framework Programming 2', 'sks' => 4, 'semester' => 4, 'id_program_studi' => $ase, 'tipe_matakuliah' => 0],
        ];

        foreach ($matkul as $mk) {
            DB::table('matakuliah')->updateOrInsert(
                ['kode_mk' => $mk['kode_mk']], // Key to check for existence
                array_merge($mk, [
                    'deskripsi' => null,
                    'updated_at' => now(),
                    'created_at' => now(),
                ])
            );
        }
    }
}
