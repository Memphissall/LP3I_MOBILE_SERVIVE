import React, { useState, useMemo, useCallback } from 'react';
import { Plus, Edit, Trash, X, AlertTriangle, BookOpen, User } from 'lucide-react';
// import axios from 'axios'; // Import ini akan digunakan nanti untuk API call

// ----------------------------------------------------------------------
// --- Opsi Dropdown
// ----------------------------------------------------------------------
const lecturerOptions = {
    jenis_kelamin: ['Laki-laki', 'Perempuan'],
    pendidikan_terakhir: ['S1', 'S2', 'S3'],
    agama: ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'],
    status: ['Aktif', 'Cuti', 'Non-Aktif', 'Tugas Belajar'],
};

// ----------------------------------------------------------------------
// --- Komponen Umum: InputGroup, SelectGroup, ConfirmationModal (TIDAK BERUBAH)
// ----------------------------------------------------------------------

const InputGroup = ({ label, name, value, onChange, required = false, type = 'text', placeholder = '' }) => (
    <div>
        <label htmlFor={name} className="block text-sm font-medium text-gray-700">
            {label}{required && <span className="text-red-500">*</span>}
        </label>
        {name === 'alamat' || name === 'kelas_diajar' ? (
            <textarea
                name={name}
                id={name}
                value={value}
                onChange={onChange}
                required={required}
                rows={name === 'alamat' ? "2" : "3"}
                placeholder={placeholder}
                className="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
            />
        ) : (
            <input
                type={type}
                name={name}
                id={name}
                value={value}
                onChange={onChange}
                required={required}
                placeholder={placeholder}
                className="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
            />
        )}
    </div>
);

const SelectGroup = ({ label, name, value, onChange, options, required = false }) => (
    <div>
        <label htmlFor={name} className="block text-sm font-medium text-gray-700">
            {label}{required && <span className="text-red-500">*</span>}
        </label>
        <select
            name={name}
            id={name}
            value={value}
            onChange={onChange}
            required={required}
            className="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 bg-white"
        >
            <option value="" disabled>Pilih {label}</option>
            {options.map(opt => (
                <option key={opt} value={opt}>{opt}</option>
            ))}
        </select>
    </div>
);

const ConfirmationModal = ({ isOpen, onClose, onConfirm, title, message }) => {
    if (!isOpen) return null;

    return (
        <div className="fixed inset-0 bg-black bg-opacity-50 z-50 flex justify-center items-center p-4">
            <div className="bg-white rounded-xl shadow-2xl w-full max-w-sm transform transition-all duration-300">
                <div className="p-6 space-y-4">
                    <div className="flex items-center space-x-3">
                        <AlertTriangle className="text-red-500 flex-shrink-0" size={24} />
                        <h2 className="text-xl font-bold text-gray-800">{title}</h2>
                    </div>
                    <p className="text-gray-600 text-sm">{message}</p>
                </div>
                <div className="p-4 border-t flex justify-end space-x-3 bg-gray-50 rounded-b-xl">
                    <button
                        onClick={onClose}
                        className="px-4 py-2 text-sm font-semibold text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 transition"
                    >
                        Batal
                    </button>
                    <button
                        onClick={onConfirm}
                        className="px-4 py-2 text-sm font-semibold text-white bg-red-600 rounded-lg shadow-md hover:bg-red-700 transition duration-150"
                    >
                        Hapus
                    </button>
                </div>
            </div>
        </div>
    );
};

// ----------------------------------------------------------------------
// --- Komponen Modal Tambah/Edit Dosen (PERBAIKAN DEPENDENCY ARRAY)
// ----------------------------------------------------------------------
const LecturerFormModal = ({ isOpen, onClose, mode, lecturerData, onSave }) => {

    const defaultData = useMemo(() => ({
        nidn: '',
        nama: '',
        kelas_diajar: '',
        tempat_lahir: '',
        tanggal_lahir: '',
        alamat: '',
        jenis_kelamin: lecturerOptions.jenis_kelamin[0],
        pendidikan_terakhir: lecturerOptions.pendidikan_terakhir[0],
        bidang: '',
        agama: lecturerOptions.agama[0],
        foto: '',
        email: '',
        no_tlp: '',
        honor: '',
        status: lecturerOptions.status[0],
    }), []);

    const [formData, setFormData] = useState(lecturerData || defaultData);

    // FIX: Menghapus 'defaultData' dari dependency array untuk menghindari warning
    React.useEffect(() => {
        if (isOpen) {
            // Gunakan spread operator pada lecturerData untuk memastikan selalu ada objek
            setFormData(lecturerData ? { ...lecturerData } : defaultData);
        }
    }, [isOpen, lecturerData]); // Dependency array yang bersih

    if (!isOpen) return null;

    const handleChange = (e) => {
        const { name, value } = e.target;
        setFormData(prev => ({ ...prev, [name]: value }));
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        onSave(formData);
        onClose(); // Tutup modal setelah disimpan
    };

    const title = mode === 'add' ? 'Tambah Data Dosen Baru' : `Edit Dosen: ${formData.nama}`;
    const submitText = mode === 'add' ? 'Simpan Data' : 'Perbarui Data';

    return (
        <div className="fixed inset-0 bg-black bg-opacity-50 z-50 flex justify-center items-center p-4 overflow-y-auto">
            <div className="bg-white rounded-xl shadow-2xl w-full max-w-3xl my-8 transform transition-all duration-300 scale-100 opacity-100">
                <div className="p-6 border-b flex justify-between items-center bg-white rounded-t-xl">
                    <h2 className="text-2xl font-bold text-gray-800">{title}</h2>
                    <button onClick={onClose} className="text-gray-400 hover:text-gray-600 p-2 rounded-full hover:bg-gray-100 transition">
                        <X size={24} />
                    </button>
                </div>
                <form onSubmit={handleSubmit} className="p-6 space-y-6">
                    <div className="border p-4 rounded-lg bg-gray-50/50">
                        <h3 className="font-semibold text-lg mb-4 text-blue-600 border-b pb-2">Informasi Dasar</h3>
                        <div className='mb-4'>
                            <InputGroup 
                                label="Kelas yang Diajar (Pisahkan dengan koma)" 
                                name="kelas_diajar" 
                                value={formData.kelas_diajar} 
                                onChange={handleChange} 
                                required 
                                placeholder="Contoh: Struktur Data, Algoritma Lanjut"
                            />
                        </div>
                        <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <InputGroup label="NIDN" name="nidn" value={formData.nidn} onChange={handleChange} required />
                            <InputGroup label="Nama Lengkap & Gelar" name="nama" value={formData.nama} onChange={handleChange} required />
                            <SelectGroup label="Status Kepegawaian" name="status" value={formData.status} onChange={handleChange} options={lecturerOptions.status} required />
                        </div>
                    </div>

                    <div className="border p-4 rounded-lg bg-gray-50/50">
                        <h3 className="font-semibold text-lg mb-4 text-blue-600 border-b pb-2">Data Pribadi</h3>
                        <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <InputGroup label="Tempat Lahir" name="tempat_lahir" value={formData.tempat_lahir} onChange={handleChange} />
                            <InputGroup label="Tanggal Lahir" name="tanggal_lahir" value={formData.tanggal_lahir} onChange={handleChange} type="date" />
                            <SelectGroup label="Jenis Kelamin" name="jenis_kelamin" value={formData.jenis_kelamin} onChange={handleChange} options={lecturerOptions.jenis_kelamin} />
                            <SelectGroup label="Pendidikan Terakhir" name="pendidikan_terakhir" value={formData.pendidikan_terakhir} onChange={handleChange} options={lecturerOptions.pendidikan_terakhir} />
                            <SelectGroup label="Agama" name="agama" value={formData.agama} onChange={handleChange} options={lecturerOptions.agama} />
                            <InputGroup label="Bidang Keahlian" name="bidang" value={formData.bidang} onChange={handleChange} placeholder="Contoh: Jaringan, Akuntansi Syariah" />
                        </div>
                        <div className='mt-4'>
                            <InputGroup label="Alamat Lengkap" name="alamat" value={formData.alamat} onChange={handleChange} />
                        </div>
                    </div>

                    <div className="border p-4 rounded-lg bg-gray-50/50">
                        <h3 className="font-semibold text-lg mb-4 text-blue-600 border-b pb-2">Kontak & Finansial</h3>
                        <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <InputGroup label="Email" name="email" value={formData.email} onChange={handleChange} type="email" />
                            <InputGroup label="No. Telepon" name="no_tlp" value={formData.no_tlp} onChange={handleChange} type="tel" />
                            <InputGroup label="Honor Pokok (Rp)" name="honor" value={formData.honor} onChange={handleChange} placeholder="Contoh: 15.000.000" />
                        </div>
                        <InputGroup label="URL Foto Profil" name="foto" value={formData.foto} onChange={handleChange} placeholder="URL ke foto dosen (Opsional)" className="mt-4" />
                    </div>

                    <div className="pt-4 border-t flex justify-end space-x-3">
                        <button
                            type="button"
                            onClick={onClose}
                            className="px-6 py-2 text-base font-semibold text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition"
                        >
                            Batal
                        </button>
                        <button
                            type="submit"
                            className="px-6 py-2 text-base font-semibold text-white bg-blue-600 rounded-lg shadow-lg hover:bg-blue-700 transition duration-150 transform hover:scale-[1.02] active:scale-100"
                        >
                            {submitText}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    );
};

// ----------------------------------------------------------------------
// --- KOMPONEN MANAJEMEN DOSEN UTAMA
// ----------------------------------------------------------------------
const LecturerManagement = ({ initialData }) => {
    // 1. Inisialisasi state lecturers dengan data yang diterima dari Blade (initialData)
    const [lecturers, setLecturers] = useState(initialData || []); 
    
    // States untuk Modal
    const [isModalOpen, setIsModalOpen] = useState(false);
    const [modalMode, setModalMode] = useState('add');
    const [currentLecturer, setCurrentLecturer] = useState(null);

    // States untuk Konfirmasi Hapus
    const [isDeleteModalOpen, setIsDeleteModalOpen] = useState(false);
    const [lecturerToDelete, setLecturerToDelete] = useState(null);

    // FUNGSI UTAMA UNTUK C.R.U.D
    // CATATAN: Fungsi ini masih menggunakan SIMULASI data lokal.
    // Ganti dengan AXIOS/FETCH API call ke Laravel!

    const handleAddLecturer = () => {
        setCurrentLecturer(null);
        setModalMode('add');
        setIsModalOpen(true);
    };

    const handleEditLecturer = useCallback((lecturer) => {
        setCurrentLecturer(lecturer);
        setModalMode('edit');
        setIsModalOpen(true);
    }, []);

    const handleDeleteLecturer = (lecturer) => {
        setLecturerToDelete(lecturer);
        setIsDeleteModalOpen(true);
    };

    const confirmDelete = () => {
        if (lecturerToDelete) {
            // ** GANTI INI DENGAN AXIOS.DELETE(URL_API) **
            console.log(`[API CALL: DELETE] Menghapus dosen dengan ID: ${lecturerToDelete.id}`); 
            setLecturers(prev => prev.filter(l => l.id !== lecturerToDelete.id));
        }
        setLecturerToDelete(null);
        setIsDeleteModalOpen(false);
    };

    const handleSaveLecturer = (newLecturerData) => {
        let dataToSave = { ...newLecturerData };

        // Logic foto placeholder
        if (!dataToSave.foto) {
             const initials = dataToSave.nama.split(' ').map(n => n[0]).join('').toUpperCase().substring(0, 2);
             dataToSave.foto = `https://placehold.co/50x50/cccccc/333333?text=${initials}`;
        }
        
        if (modalMode === 'add') {
            // ** GANTI INI DENGAN AXIOS.POST(URL_API) **
            console.log("[API CALL: POST] Menambah dosen baru:", dataToSave);
            // Simulasi ID baru
            const newId = lecturers.length > 0 ? Math.max(...lecturers.map(l => l.id)) + 1 : 1;
            setLecturers(prev => [...prev, { ...dataToSave, id: newId }]);
        } else {
            // ** GANTI INI DENGAN AXIOS.PUT/PATCH(URL_API) **
            console.log(`[API CALL: PUT] Memperbarui dosen ID ${currentLecturer.id}:`, dataToSave);
            setLecturers(prev => prev.map(l =>
                l.id === currentLecturer.id ? { ...dataToSave, id: currentLecturer.id } : l
            ));
        }
    };

    const StatusBadge = ({ status }) => {
        let colorClass = 'bg-gray-100 text-gray-800';
        if (status === 'Aktif') colorClass = 'bg-green-100 text-green-800';
        else if (status === 'Cuti') colorClass = 'bg-yellow-100 text-yellow-800';
        else if (status === 'Tugas Belajar') colorClass = 'bg-blue-100 text-blue-800';
        else if (status === 'Non-Aktif') colorClass = 'bg-red-100 text-red-800';

        return (
            <span className={`inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full ${colorClass}`}>
                {status}
            </span>
        );
    };
    
    return (
        <div className="space-y-6">
            <header className="flex items-center space-x-4 text-gray-800 border-b border-gray-200 pb-4 mb-6">
                <BookOpen size={40} className="text-blue-600" />
                <h1 className="text-3xl font-extrabold tracking-tight">
                    Sistem Manajemen Data Dosen
                </h1>
            </header>
            
            <div className="bg-white p-4 md:p-6 rounded-xl shadow-lg border border-gray-100 flex justify-between items-center">
                <h2 className="text-xl font-semibold text-gray-700">Daftar Dosen ({lecturers.length} data)</h2>
                <button
                    onClick={handleAddLecturer}
                    className="flex items-center space-x-2 px-4 py-2 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 transition duration-150 transform hover:scale-[1.02] active:scale-100 text-sm">
                    <Plus size={20} />
                    <span>Tambah Dosen</span>
                </button>
            </div>

            <div className="bg-white p-4 md:p-6 rounded-xl shadow-lg border border-gray-100">
                <div className="overflow-x-auto rounded-lg border border-gray-200">
                    {lecturers.length > 0 ? (
                        <table className="min-w-full divide-y divide-gray-200">
                            <thead className="bg-gray-100">
                                <tr>
                                    <th className="px-6 py-3 text-center text-xs font-bold text-gray-600 uppercase tracking-wider w-[60px]">Foto</th>
                                    <th className="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider w-[150px]">NIDN</th>
                                    <th className="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider min-w-[250px]">Nama Dosen</th>
                                    <th className="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider min-w-[200px]">Kelas yang Diajar</th>
                                    <th className="px-6 py-3 text-center text-xs font-bold text-gray-600 uppercase tracking-wider w-[120px]">Status</th>
                                    <th className="px-6 py-3 text-center text-xs font-bold text-gray-600 uppercase tracking-wider w-[100px]">Aksi</th>
                                </tr>
                            </thead>
                            <tbody className="bg-white divide-y divide-gray-200">
                                {lecturers.map((lecturer) => (
                                    <tr key={lecturer.id} className="hover:bg-blue-50/50 transition duration-100">
                                        <td className="px-6 py-2 text-center">
                                            {lecturer.foto ? (
                                                <img 
                                                    src={lecturer.foto} 
                                                    alt={lecturer.nama} 
                                                    className="w-10 h-10 rounded-full mx-auto object-cover border border-gray-300" 
                                                    onError={(e) => {
                                                         // Jika URL foto gagal dimuat, tampilkan placeholder inisial
                                                         e.target.onerror = null; 
                                                         const initials = lecturer.nama.split(' ').map(n => n[0]).join('').toUpperCase().substring(0, 2);
                                                         e.target.src = `https://placehold.co/50x50/cccccc/333333?text=${initials}`;
                                                    }}
                                                />
                                            ) : (
                                                <div className="w-10 h-10 rounded-full mx-auto bg-gray-200 flex items-center justify-center border border-gray-300 text-gray-600">
                                                    <User size={18} />
                                                </div>
                                            )}
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{lecturer.nidn}</td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{lecturer.nama}</td>
                                        <td className="px-6 py-4 text-sm text-gray-700 max-w-xs truncate" title={lecturer.kelas_diajar}>{lecturer.kelas_diajar}</td>
                                        <td className="px-6 py-4 whitespace-nowrap text-center">
                                            <StatusBadge status={lecturer.status} />
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm font-medium flex justify-center space-x-2">
                                            <button
                                                onClick={() => handleEditLecturer(lecturer)}
                                                className="text-blue-600 hover:text-white bg-blue-100 p-2 rounded-full transition duration-150 hover:bg-blue-600 hover:shadow-md"
                                                title="Edit Data">
                                                <Edit size={16} />
                                            </button>
                                            <button
                                                onClick={() => handleDeleteLecturer(lecturer)}
                                                className="text-red-600 hover:text-white bg-red-100 p-2 rounded-full transition duration-150 hover:bg-red-600 hover:shadow-md"
                                                title="Hapus Data">
                                                <Trash size={16} />
                                            </button>
                                        </td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    ) : (
                        <div className="text-center py-10 text-gray-500 bg-gray-50">
                            <p>Tidak ada data dosen yang tersedia.</p>
                            <p className="mt-2 text-sm">Gunakan tombol "Tambah Dosen" untuk menambahkan data baru.</p>
                        </div>
                    )}
                </div>
            </div>

            <LecturerFormModal
                isOpen={isModalOpen}
                onClose={() => setIsModalOpen(false)}
                mode={modalMode}
                lecturerData={currentLecturer}
                onSave={handleSaveLecturer}
            />

            <ConfirmationModal
                isOpen={isDeleteModalOpen}
                onClose={() => setIsDeleteModalOpen(false)}
                onConfirm={confirmDelete}
                title="Konfirmasi Hapus Data Dosen"
                message={`Anda yakin ingin menghapus data dosen "${lecturerToDelete?.nama || ''}" (NIDN: ${lecturerToDelete?.nidn || ''})? Aksi ini tidak dapat dibatalkan.`}
            />
        </div>
    );
};

export default LecturerManagement;