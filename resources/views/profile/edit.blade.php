<x-app-layout>
    {{-- Load Cropper.js CDN --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile Dashboard') }}
        </h2>
    </x-slot>

    @php
        $photoUrl = null;
        if ($user->role === 'pendidik' && $user->pendidik && $user->pendidik->foto) {
            $photoUrl = asset('storage/' . $user->pendidik->foto);
        }
    @endphp

    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            
            {{-- Header Profile Card --}}
            <div class="bg-gradient-to-r from-[#004269] to-[#009DA5] rounded-t-2xl p-6 md:p-8 text-white shadow-lg relative overflow-hidden mb-6">
                <div class="absolute -right-10 -bottom-10 opacity-10 text-white pointer-events-none">
                    <i class="fa-solid fa-user text-9xl"></i>
                </div>
                
                <div class="flex flex-col md:flex-row items-center gap-6 relative z-10">
                    {{-- Avatar Section --}}
                    <div class="relative group">
                        @if ($photoUrl)
                            <img src="{{ $photoUrl }}" alt="Profile Photo" class="w-28 h-28 rounded-full object-cover border-4 border-white/30 shadow-lg group-hover:opacity-85 transition">
                        @else
                            <div class="w-28 h-28 rounded-full bg-white/10 backdrop-blur flex items-center justify-center border-4 border-white/20 shadow-lg">
                                <span class="text-4xl font-extrabold text-white">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </span>
                            </div>
                        @endif
                    </div>
                    
                    <div class="text-center md:text-left">
                        <h1 class="text-2xl font-bold md:text-3xl">{{ $user->name }}</h1>
                        <p class="text-white/80 text-sm mt-1 flex items-center justify-center md:justify-start gap-1">
                            <i class="fa-solid fa-envelope"></i> {{ $user->email }}
                        </p>
                        <span class="inline-block px-3 py-1 bg-white/20 backdrop-blur text-xs font-semibold rounded-full mt-3 uppercase tracking-wider">
                            {{ $user->role }}
                        </span>
                    </div>
                </div>
            </div>

            @if (session('status'))
                <div class="mb-6 p-4 rounded-xl bg-green-50 border-l-4 border-green-500 text-green-800 shadow-sm flex items-center gap-2">
                    <i class="fa-solid fa-circle-check text-green-600"></i>
                    <span>
                        {{ session('status') === 'profile-updated' ? 'Profile information successfully updated!' : (session('status') === 'password-updated' ? 'Password successfully updated!' : session('status')) }}
                    </span>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                {{-- Column 1: Forms (Span 2) --}}
                <div class="lg:col-span-2 space-y-6">
                    
                    {{-- Profile Edit Form --}}
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <div class="flex items-center gap-2 mb-6 border-b border-gray-100 pb-3">
                            <i class="fa-solid fa-user-edit text-[#009DA5]"></i>
                            <h3 class="text-lg font-bold text-gray-800">Edit Profile Info</h3>
                        </div>

                        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
                            @csrf
                            @method('patch')

                            {{-- Hidden cropped photo string --}}
                            <input type="hidden" name="cropped_foto" id="cropped_foto">

                            {{-- Photo Upload (Conditional for Pendidik) --}}
                            @if ($user->role === 'pendidik')
                                <div>
                                    <x-input-label for="foto" :value="__('Change Profile Picture (With Cropping)')" />
                                    <div class="mt-2 flex items-center gap-4">
                                        <div class="relative group">
                                            @if ($photoUrl)
                                                <img id="previewImg" src="{{ $photoUrl }}" alt="Preview" class="w-16 h-16 rounded-full object-cover border border-gray-200">
                                            @else
                                                <div id="previewPlaceholder" class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center border border-gray-200">
                                                    <span class="text-xl font-bold text-gray-500">
                                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                                    </span>
                                                </div>
                                            @endif
                                        </div>
                                        <input type="file" id="foto" name="foto" class="block w-full text-sm text-gray-500
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded-full file:border-0
                                            file:text-sm file:font-semibold
                                            file:bg-indigo-50 file:text-[#004269]
                                            hover:file:bg-indigo-100" accept="image/*">
                                    </div>
                                    <x-input-error :messages="$errors->get('foto')" class="mt-2" />
                                </div>
                            @endif

                            {{-- Full Name --}}
                            <div>
                                <x-input-label for="name" :value="__('Full Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                              :value="old('name', $user->name)" required autofocus autocomplete="name" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            {{-- Email --}}
                            <div>
                                <x-input-label for="email" :value="__('Email Address')" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                                              :value="old('email', $user->email)" required autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            {{-- Password Update Section --}}
                            <div class="border-t border-gray-100 pt-6">
                                <div class="flex items-center gap-2 mb-4">
                                    <i class="fa-solid fa-lock text-[#009DA5]"></i>
                                    <h3 class="text-md font-bold text-gray-800">Update Password (Optional)</h3>
                                </div>

                                <div class="space-y-4">
                                    <div>
                                        <x-input-label for="current_password" :value="__('Current Password')" />
                                        <x-text-input id="current_password" name="current_password" type="password"
                                                      class="mt-1 block w-full" autocomplete="current-password" />
                                        <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-input-label for="password" :value="__('New Password')" />
                                        <x-text-input id="password" name="password" type="password"
                                                      class="mt-1 block w-full" autocomplete="new-password" />
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-input-label for="password_confirmation" :value="__('Confirm New Password')" />
                                        <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                                                      class="mt-1 block w-full" autocomplete="new-password" />
                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                    </div>
                                </div>
                            </div>

                            {{-- Actions --}}
                            <div class="flex flex-wrap items-center justify-end gap-3 border-t border-gray-100 pt-4">
                                <a href="{{ url()->previous() }}"
                                   class="px-4 py-2 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-semibold transition text-center w-full sm:w-auto">
                                    Cancel
                                </a>
                                <button type="submit" class="px-5 py-2 rounded-lg bg-[#004269] hover:bg-[#00304B] text-white text-sm font-semibold transition text-center w-full sm:w-auto">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Column 2: Academic Profile / Meta (Span 1) --}}
                <div>
                    @if ($user->role === 'pendidik' && $user->pendidik)
                        @php
                            $p = $user->pendidik;
                        @endphp
                        {{-- Pendidik Details Card --}}
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-6">
                            <div class="flex items-center gap-2 border-b border-gray-100 pb-3">
                                <i class="fa-solid fa-graduation-cap text-[#009DA5]"></i>
                                <h3 class="text-lg font-bold text-gray-800">Academic Card</h3>
                            </div>

                            <div class="space-y-4">
                                <div class="flex flex-col bg-gray-50 p-3 rounded-lg">
                                    <span class="text-xs text-gray-500 font-semibold uppercase">ID PENDIDIK</span>
                                    <span class="text-sm font-bold text-gray-800">{{ $p->id_pendidik }}</span>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div class="flex flex-col">
                                        <span class="text-xs text-gray-500 font-semibold uppercase">PENDIDIKAN</span>
                                        <span class="text-sm font-medium text-gray-800 mt-1">{{ $p->pendidikan }}</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-xs text-gray-500 font-semibold uppercase">BIDANG</span>
                                        <span class="text-sm font-medium text-gray-800 mt-1">{{ $p->bidang }}</span>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4 border-t border-gray-100 pt-3">
                                    <div class="flex flex-col">
                                        <span class="text-xs text-gray-500 font-semibold uppercase">TEMPAT LAHIR</span>
                                        <span class="text-sm font-medium text-gray-800 mt-1">{{ $p->tempat_lahir }}</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-xs text-gray-500 font-semibold uppercase">TGL LAHIR</span>
                                        <span class="text-sm font-medium text-gray-800 mt-1">
                                            {{ \Carbon\Carbon::parse($p->tgl_lahir)->format('d-m-Y') }}
                                        </span>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4 border-t border-gray-100 pt-3">
                                    <div class="flex flex-col">
                                        <span class="text-xs text-gray-500 font-semibold uppercase">GENDER</span>
                                        <span class="text-sm font-medium text-gray-800 mt-1">{{ $p->jenis_kelamin }}</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-xs text-gray-500 font-semibold uppercase">AGAMA</span>
                                        <span class="text-sm font-medium text-gray-800 mt-1">{{ $p->agama }}</span>
                                    </div>
                                </div>

                                <div class="border-t border-gray-100 pt-3 space-y-3">
                                    <div class="flex items-center gap-2 text-sm text-gray-700">
                                        <i class="fa-solid fa-phone text-gray-400 w-5"></i>
                                        <span>{{ $p->no_tlp }}</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-sm text-gray-700">
                                        <i class="fa-solid fa-dollar-sign text-gray-400 w-5"></i>
                                        <span>Rate Gaji: Rp {{ number_format($p->rate_gaji, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-sm text-gray-700">
                                        <i class="fa-solid fa-info-circle text-gray-400 w-5"></i>
                                        <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold 
                                            @if($p->status === 'Aktif') bg-green-100 text-green-800
                                            @elseif($p->status === 'Kontrak') bg-yellow-100 text-yellow-800
                                            @else bg-gray-100 text-gray-800 @endif">
                                            {{ $p->status }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- Admin Info Card --}}
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-6">
                            <div class="flex items-center gap-2 border-b border-gray-100 pb-3">
                                <i class="fa-solid fa-shield-halved text-[#009DA5]"></i>
                                <h3 class="text-lg font-bold text-gray-800">System Information</h3>
                            </div>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                You are logged in as an <b>Admin</b>. You have full access to manage accounts, academic data, salaries, and system configurations.
                            </p>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>

    {{-- Cropper Modal --}}
    <div id="cropperModal" class="fixed inset-0 z-50 hidden bg-black/60 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-md w-full overflow-hidden shadow-2xl">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-[#004269] text-white">
                <h3 class="font-bold text-sm">Crop Profile Picture</h3>
                <button type="button" onclick="closeCropperModal()" class="text-white hover:text-gray-200">
                    <span class="text-xl">&times;</span>
                </button>
            </div>
            <div class="p-6">
                <div class="max-h-[300px] overflow-hidden flex items-center justify-center bg-gray-50 rounded-lg">
                    <img id="cropperImage" src="" alt="Source Image" class="max-w-full max-h-[250px]">
                </div>
                
                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" onclick="closeCropperModal()" class="px-4 py-2 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-semibold transition">
                        Cancel
                    </button>
                    <button type="button" id="btnCropSave" class="px-5 py-2 rounded-lg bg-[#009DA5] hover:bg-[#007C82] text-white text-sm font-semibold transition">
                        Crop & Save
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- IMAGE PREVIEW & CROPPER SCRIPT --}}
    <script>
        let cropper = null;
        const fileInput = document.getElementById('foto');
        const modal = document.getElementById('cropperModal');
        const cropperImg = document.getElementById('cropperImage');
        const hiddenInput = document.getElementById('cropped_foto');
        const previewImg = document.getElementById('previewImg');
        const previewPlaceholder = document.getElementById('previewPlaceholder');

        fileInput?.addEventListener('change', function (e) {
            if (e.target.files && e.target.files[0]) {
                const file = e.target.files[0];
                const reader = new FileReader();
                reader.onload = function (event) {
                    cropperImg.src = event.target.result;
                    modal.classList.remove('hidden');
                    
                    if (cropper) {
                        cropper.destroy();
                    }
                    
                    // Wait for the img to load to correctly calculate dimensions
                    setTimeout(() => {
                        cropper = new Cropper(cropperImg, {
                            aspectRatio: 1,
                            viewMode: 2,
                            dragMode: 'move',
                            autoCropArea: 1,
                            restore: false,
                            guides: true,
                            center: true,
                            highlight: false,
                            cropBoxMovable: true,
                            cropBoxResizable: true,
                            toggleDragModeOnDblclick: false
                        });
                    }, 100);
                };
                reader.readAsDataURL(file);
            }
        });

        function closeCropperModal() {
            modal.classList.add('hidden');
            if (fileInput) fileInput.value = ''; // Reset file input
            if (cropper) {
                cropper.destroy();
                cropper = null;
            }
        }

        document.getElementById('btnCropSave')?.addEventListener('click', function () {
            if (cropper) {
                // Get high quality cropped canvas (256x256 is perfect for avatars)
                const canvas = cropper.getCroppedCanvas({
                    width: 256,
                    height: 256
                });
                
                const dataUrl = canvas.toDataURL('image/jpeg', 0.9);
                hiddenInput.value = dataUrl;
                
                // Update preview in form
                if (previewImg) {
                    previewImg.src = dataUrl;
                } else if (previewPlaceholder) {
                    const img = document.createElement('img');
                    img.id = 'previewImg';
                    img.src = dataUrl;
                    img.alt = 'Preview';
                    img.className = 'w-16 h-16 rounded-full object-cover border border-gray-200';
                    previewPlaceholder.replaceWith(img);
                }
                
                modal.classList.add('hidden');
                cropper.destroy();
                cropper = null;
            }
        });
    </script>
</x-app-layout>
