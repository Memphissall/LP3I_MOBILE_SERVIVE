<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswas';

    protected $fillable = [
        'user_id', 'nipd', 'nipd_issued_at', 'nama_mhs', 'email', 'no_hp', 'jurusan', 'tahun_lulus', 'alamat', 'kecamatan',
        'tempat_lahir', 'tgl_lahir', 'jenis_kelamin', 'jenis_sekolah', 'kategori_sekolah', 'jenis_kelas',
        'status_verifikasi', 'payment_status', 'payment_amount', 'payment_method', 'payment_proof_path', 'payment_bank_origin', 'payment_account_name', 'payment_sender_name', 'payment_transfer_date', 'payment_expires_at', 'asal_sekolah', 'file_path', 'desa', 'kode_pos', 'marketing_notes', 'agama', 'status', 'registration_payment_status', 'registration_verification_status'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    // Generate a NIPD for a given jurusan using config/nipd.php
    public static function generateNipd(?string $jurusan = null): string
    {
        // Use branch_code but replace the leading year portion with the current year (2-digit)
        // so NIPD reflects the actual year automatically.
        $branchCfg = config('nipd.branch_code', '240781');
        $currentYearTwo = date('y');
        // if branch code is at least 2 chars, replace its first two chars with current year two-digit
        $branch = strlen($branchCfg) >= 2 ? ($currentYearTwo . substr($branchCfg, 2)) : $branchCfg;
        $programCodes = config('nipd.program_codes', []);
        $seqDigits = (int) config('nipd.sequence_digits', 4);
        $programKey = strtoupper($jurusan ?? '');
        $deptCode = $programCodes[$programKey] ?? '000';
        $prefix = $branch . $deptCode;

        // Count existing NIPDs with the same prefix that have been issued (nipd_issued_at is NOT NULL)
        // The sequence should be based on the count of issued NIPDs, not the max sequence
        $count = self::where('nipd', 'like', $prefix . '%')
            ->whereNotNull('nipd_issued_at')
            ->count();

        $next = $count + 1;
        $sequence = str_pad((string)$next, $seqDigits, '0', STR_PAD_LEFT);
        $candidate = $prefix . $sequence;

        // If this NIPD already exists, keep incrementing until we find an unused one
        $maxAttempts = 1000;
        $attempts = 0;
        while (self::where('nipd', $candidate)->exists() && $attempts < $maxAttempts) {
            $next++;
            $sequence = str_pad((string)$next, $seqDigits, '0', STR_PAD_LEFT);
            $candidate = $prefix . $sequence;
            $attempts++;
        }

        if ($attempts >= $maxAttempts) {
            throw new \RuntimeException("Unable to generate unique NIPD after {$maxAttempts} attempts for prefix {$prefix}");
        }

        return $candidate;
    }

    /**
     * Try to find a recent duplicate based on email or phone and same jurusan within a short window.
     * Returns the Mahasiswa model if found, otherwise null.
     */
    public static function findRecentDuplicate(array $attrs, ?int $minutes = 10)
    {
        $query = self::query();

        if ($minutes !== null) {
            $now = \Carbon\Carbon::now();
            $since = $now->subMinutes($minutes);
            $query->where('created_at', '>=', $since);
        }

        $query->where(function($q) use ($attrs) {
            if (!empty($attrs['email'])) {
                $q->orWhere('email', $attrs['email']);
            }
            if (!empty($attrs['no_hp'])) {
                $q->orWhere('no_hp', $attrs['no_hp']);
            }
        });

        if (!empty($attrs['jurusan'])) {
            $query->where('jurusan', $attrs['jurusan']);
        }

        return $query->orderByDesc('id')->first();
    }

    protected static function booted()
    {
        // NIPD is no longer auto-generated here
        // It will be generated manually by marketing when they approve registration payment
        // static::creating(function ($model) {
        //     if (empty($model->nipd)) {
        //         $model->nipd = self::generateNipd($model->jurusan ?? null);
        //     }
        // });
    }

    /**
     * DEPRECATED: This method is no longer used.
     * NIPD generation is now done manually when marketing approves registration payment.
     * Keeping method for backwards compatibility.
     *
     * @param array $attrs
     * @param int $maxAttempts
     * @return self
     * @throws \Throwable
     */
    public static function createWithUniqueNipd(array $attrs, int $maxAttempts = 5): self
    {
        // Just use regular create() - NIPD is now assigned manually by marketing
        return self::create($attrs);
    }
}

