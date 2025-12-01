<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran';

    protected $fillable = [
        'pasien_id',
        'poli_id',
        'dokter_id',
        'penjamin_id',
        'no_antrian',
        'tanggal_daftar',
        'status'
    ];

    protected $casts = [
        'tanggal_daftar' => 'date'
    ];

    // Set default otomatis jika belum diisi
    protected static function booted()
    {
        static::creating(function ($model) {

            if (!$model->tanggal_daftar) {
                $model->tanggal_daftar = Carbon::today();
            }

            if (!$model->status) {
                $model->status = 'Terdaftar';
            }
        });
    }

    // ================= RELATIONS =================

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'pasien_id');
    }

    public function poli()
    {
        return $this->belongsTo(Poli::class, 'poli_id');
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id');
    }

    public function penjamin()
    {
        return $this->belongsTo(Penjamin::class, 'penjamin_id');
    }

    public function rekamMedis()
    {
        return $this->hasOne(RekamMedis::class, 'pendaftaran_id');
    }

    public function transaksi()
    {
        return $this->hasOne(Transaksi::class, 'pendaftaran_id');
    }
}
