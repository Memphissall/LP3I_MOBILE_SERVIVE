<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Dashboard Pendaftar</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    :root{--basic:#004269;--adv:#40826D}
    .btn-basic{background:linear-gradient(90deg,var(--basic),var(--adv));box-shadow:0 6px 12px rgba(0,0,0,0.08)}
    .accent-color{color:var(--basic)}
    .card-accent{border-left:4px solid var(--adv)}
    /* Caret/button animation */
    #akunCaret{transition:transform .2s ease;transform-origin:center}
    .caret-rotated{transform:rotate(180deg)}
    .btn-basic{transition:transform .18s ease,box-shadow .18s ease}
    .btn-basic:hover{transform:translateY(-3px);box-shadow:0 12px 20px rgba(0,0,0,0.12)}
    
    /* Progress tracker responsive styling */
    .progress-container {
      display: flex;
      align-items: center;
      gap: 1rem;
      overflow-x: auto;
      padding-bottom: 0.5rem;
    }
    
    .progress-item {
      display: flex;
      align-items: center;
      flex: 1;
      min-width: 0;
    }
    
    .progress-dot {
      flex-shrink: 0;
      width: 2.5rem;
      height: 2.5rem;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.875rem;
      font-weight: 600;
    }
    
    .progress-label {
      margin-top: 0.75rem;
      font-size: 0.75rem;
      text-align: center;
      color: #475569;
      word-break: normal;
      word-wrap: break-word;
      hyphens: none;
      overflow-wrap: break-word;
      line-height: 1.3;
      flex: 0 1 auto;
      width: 100%;
      white-space: normal;
    }
    
    .progress-connector {
      flex: 1;
      height: 0.125rem;
      border-radius: 0.25rem;
      background: #e2e8f0;
      min-width: 0.5rem;
      flex-shrink: 0;
    }
    
    /* Mobile: 6 columns - sangat kecil */
    @media (max-width: 640px) {
      .progress-container {
        gap: 0.25rem;
        padding: 0;
      }
      
      .progress-item {
        gap: 0;
      }
      
      .progress-dot {
        width: 1.75rem;
        height: 1.75rem;
        font-size: 0.6rem;
      }
      
      .progress-label {
        font-size: 0.65rem;
        margin-top: 0.5rem;
        width: 65px;
        line-height: 1.4;
      }
      
      .progress-connector {
        min-width: 0.25rem;
        margin: 0 0.125rem;
      }
      
      .progress-svg {
        width: 0.875rem !important;
        height: 0.875rem !important;
      }
    }
    
    /* Tablet: 6 columns - sedang */
    @media (min-width: 641px) and (max-width: 1024px) {
      .progress-container {
        gap: 0.5rem;
      }
      
      .progress-dot {
        width: 2rem;
        height: 2rem;
        font-size: 0.75rem;
      }
      
      .progress-label {
        font-size: 0.7rem;
        margin-top: 0.5rem;
        width: 70px;
        line-height: 1.4;
      }
      
      .progress-connector {
        min-width: 0.5rem;
        margin: 0 0.25rem;
      }
      
      .progress-svg {
        width: 1rem !important;
        height: 1rem !important;
      }
    }
    
    /* Desktop: 6 columns - normal */
    @media (min-width: 1025px) {
      .progress-container {
        gap: 1rem;
      }
      
      .progress-dot {
        width: 2.5rem;
        height: 2.5rem;
      }
      
      .progress-label {
        font-size: 0.75rem;
        margin-top: 0.75rem;
        width: 80px;
        line-height: 1.4;
      }
      
      .progress-connector {
        min-width: 1rem;
      }
      
      .progress-svg {
        width: 1.25rem !important;
        height: 1.25rem !important;
      }
    }
  </style>
</head>
<body class="text-slate-800" style="background:var(--basic);">
  <div class="max-w-6xl mx-auto p-6 lg:p-8">
    <div class="grid grid-cols-1 lg:grid-cols-[280px_1fr] gap-6 items-start">
      <!-- Sidebar -->
      <aside class="bg-white rounded-xl border p-5 shadow-sm sticky top-6">
        <div class="flex items-center gap-3 mb-4">
          <svg class="w-8 h-8 accent-color" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" d="M12 11c2.761 0 5-2.239 5-5S14.761 1 12 1 7 3.239 7 6s2.239 5 5 5zM3 21a9 9 0 0118 0"/></svg>
          <div>
            <div class="text-sm text-slate-400">Halo</div>
            <div class="font-semibold"><?php echo e(Auth::user()->name ?? 'Pendaftar'); ?></div>
          </div>
        </div>

        <nav class="space-y-2 text-sm">
          <a class="flex items-center gap-3 px-3 py-2 rounded-md hover:bg-slate-50" href="<?php echo e(route('pendaftar.dashboard')); ?>">
            <span class="text-slate-600">Dashboard</span>
          </a>
          <a class="flex items-center gap-3 px-3 py-2 rounded-md hover:bg-slate-50" href="<?php echo e(route('pendaftar.biodata.show')); ?>">
            <span class="text-slate-600">Biodata</span>
          </a>
          <div class="relative">
            <button id="akunToggle" class="w-full text-left px-3 py-2 rounded-md hover:bg-slate-50 flex items-center gap-2">
              <svg class="w-4 h-4 text-[#004269]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" d="M16 11c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM4 20c0-2.761 3.582-5 8-5s8 2.239 8 5v1H4v-1z"/></svg>
              <span class="font-medium">Akun Saya</span>
              <svg id="akunCaret" class="w-3 h-3 ml-auto text-slate-400 transition-transform" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd"/></svg>
            </button>
            <div id="akunMenu" class="mt-2 bg-white border rounded shadow-sm" style="display:none;">
              <a class="block px-3 py-2 text-sm text-slate-700 hover:bg-slate-50" href="<?php echo e(route('pendaftar.akun.email')); ?>">✉️ Ubah Email</a>
              <a class="block px-3 py-2 text-sm text-slate-700 hover:bg-slate-50" href="<?php echo e(route('pendaftar.akun.password')); ?>">🔒 Ubah Password</a>
              <a class="block px-3 py-2 text-sm text-slate-700 hover:bg-slate-50" href="<?php echo e(route('pendaftar.akun.phone')); ?>">📱 Ubah Nomor Telepon</a>
              <a class="block px-3 py-2 text-sm text-slate-700 hover:bg-slate-50" href="<?php echo e(route('pendaftar.akun.whatsapp')); ?>">💬 Ubah WhatsApp</a>
            </div>
          </div>
        </nav>

        
      </aside>

      <!-- Main -->
      <main class="space-y-6">
        

        
        <div class="bg-white rounded-xl border p-5 shadow-sm">
          <div class="mb-4 text-sm text-slate-600">Progres pendaftaran</div>
          <div class="progress-container">
            <?php
              // Flow: Pendaftaran -> Pembayaran -> Menunggu Verifikasi -> Pembayaran Registrasi -> Selesai
              $steps = [
                ['label'=>'Pendaftaran','status'=> $step1 ?? 'completed'],
                ['label'=>'Pembayaran','status'=> $step2 ?? 'inactive'],
                ['label'=>'Menunggu Verifikasi','status'=> $step3 ?? 'inactive'],
                ['label'=>'Pembayaran Registrasi','status'=> $step4 ?? 'inactive'],
                ['label'=>'Selesai','status'=> $step5 ?? 'inactive'],
              ];
            ?>

            <?php $__currentLoopData = $steps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="progress-item">
                <div style="display: flex; flex-direction: column; align-items: center;">
                  <?php
                    $status = $s['status'];
                    $isCompleted = $status === 'completed';
                    $isActive = $status === 'active';
                    $isRejected = $status === 'rejected';
                    $dotBg = $isCompleted ? 'bg-green-500' : ($isActive ? 'bg-amber-400' : ($isRejected ? 'bg-red-500' : 'bg-slate-200'));
                    $dotTxt = $isCompleted ? 'text-white' : ($isActive ? 'text-white' : 'text-slate-600');
                  ?>

                  <div class="progress-dot <?php echo e($dotBg); ?> <?php echo e($dotTxt); ?>">
                    <?php if($isCompleted): ?>
                      <svg class="progress-svg text-white" viewBox="0 0 24 24" fill="none"><path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    <?php else: ?>
                      <span><?php echo e($i + 1); ?></span>
                    <?php endif; ?>
                  </div>
                  <div class="progress-label"><?php echo e($s['label']); ?></div>
                </div>
              </div>

              <?php if(!$loop->last): ?>
                <div class="progress-connector" style="<?php if($isCompleted && ($steps[$i+1]['status'] === 'completed' || $steps[$i+1]['status'] === 'active')): ?> background: #4ade80; <?php endif; ?>"></div>
              <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>

          <div class="mt-4 text-sm text-slate-500">
            <div>Progres pendaftaran akan diperbarui oleh Staff LP3I karawang.</div>
          </div>
        </div>

        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
          <div class="lg:col-span-2 bg-white rounded-xl border p-5 shadow-sm">
            <h3 class="text-sm font-semibold mb-3">Detail Pendaftar</h3>
            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm text-slate-700">
              <div class="p-3 bg-slate-50 rounded"><dt class="text-xs text-slate-400">Nomor NIPD</dt><dd class="font-medium mt-1"><?php echo e(($step4 === 'completed' && $calon->nipd) ? $calon->nipd : '-'); ?></dd></div>
              <div class="p-3 bg-slate-50 rounded"><dt class="text-xs text-slate-400">Nama</dt><dd class="font-medium mt-1"><?php echo e($calon->nama_mhs ?? '-'); ?></dd></div>
              <div class="p-3 bg-slate-50 rounded"><dt class="text-xs text-slate-400">Bidang Keahlian</dt><dd class="font-medium mt-1"><?php echo e(\App\Helpers\JurusanHelper::getFormat($calon->jurusan ?? null)); ?></dd></div>
              
            </dl>
          </div>

          <aside class="bg-white rounded-xl border p-5 shadow-sm">
            <h3 class="text-sm font-semibold mb-3">Aksi</h3>
            <div class="space-y-3">
              <?php if(($payment ?? 'unpaid') === 'unpaid'): ?>
                <a href="<?php echo e(route('pendaftar.payment.show')); ?>" class="block text-center w-full btn-basic text-white px-4 py-2 rounded-md font-semibold">Bayar Sekarang</a>
              <?php else: ?>
                <a href="<?php echo e(route('pendaftar.receipt')); ?>" class="block text-center w-full btn-basic text-white px-4 py-2 rounded-md font-semibold" target="_blank">Download Kuitansi</a>
              <?php endif; ?>
              <a href="<?php echo e(url('/')); ?>" class="block text-center w-full bg-slate-400 hover:bg-slate-500 text-white px-4 py-2 rounded-md font-semibold transition" style="display:flex; align-items:center; justify-content:center; gap:0.5rem;">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h12a1 1 0 001-1v-10"/><path stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" d="M9 21v-6a1 1 0 011-1h4a1 1 0 011 1v6"/></svg>
                Kembali ke Home
              </a>
            </div>
          </aside>
        </div>
      </main>
    </div>
  </div>
</body>
<script>
  document.addEventListener('DOMContentLoaded', function(){
    const t = document.getElementById('akunToggle');
    const m = document.getElementById('akunMenu');
    if (t && m) {
      t.addEventListener('click', function(){
        const isHidden = m.style.display === 'none' || m.style.display === '' ? true : (m.style.display === 'none');
        m.style.display = isHidden ? 'block' : 'none';
        const caret = document.getElementById('akunCaret'); if (caret) caret.classList.toggle('caret-rotated');
      });
    }
  });
</script>
</html><?php /**PATH D:\LP3IKARAWANG\LP3I_MOBILE_SERVIVE\resources\views/pendaftar/dashboard.blade.php ENDPATH**/ ?>