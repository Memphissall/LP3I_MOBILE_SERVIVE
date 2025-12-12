// resources/js/app.jsx

import './bootstrap';
import React from 'react';
import { createRoot } from 'react-dom/client';
import LecturerManagement from './components/LecturerManagement'; 

// --- BUNGKUS SELURUH LOGIKA KE DALAM FUNGSI UTAMA (INIT) ---
function initializeApp() {
    const rootElement = document.getElementById('lecturer-management-root');

    if (!rootElement) {
        // Jika elemen root tidak ada, kita bisa langsung keluar tanpa error
        return; 
    }

    // Pindah inisialisasi root di luar if/else parsing data
    const root = createRoot(rootElement);
    
    const initialDataString = rootElement.getAttribute('data-initial-data');
    let initialLecturers = [];

    if (initialDataString) {
        try {
            // Logika parsing JSON yang sudah kita sepakati (menggunakan unescape)
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = initialDataString;
            const unescapedJsonString = tempDiv.innerText;

            initialLecturers = JSON.parse(unescapedJsonString);

        } catch (error) {
            console.error("Gagal parsing data dosen! Pastikan format JSON valid.", error);
            console.error("String JSON mentah yang gagal diproses:", initialDataString);
            
            // Render pesan error visual ke dalam elemen root
            root.render(
                <div class="text-center py-10 text-red-600 border border-red-300 bg-red-50 rounded-lg">
                    <p>
                        <strong>Kesalahan Muat Data:</strong> Format data dari server tidak valid. Silakan cek konsol untuk detail.
                    </p>
                </div>
            );
            return; // <<-- return sudah legal karena berada di dalam fungsi initializeApp
        }
    }

    // Jika berhasil parsing, render komponen utama
    root.render(
        <React.StrictMode>
            <LecturerManagement initialData={initialLecturers} />
        </React.StrictMode>
    );
}

// Panggil fungsi utama saat skrip dimuat
initializeApp();