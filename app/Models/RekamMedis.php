<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RekamMedis extends Model
{
    use HasFactory;

    protected $table = 'rekam_medis';

    protected $fillable = [
        'pendaftaran_id',
        'diagnosa',
        'tindakan',
        'catatan'
    ];

    /**
     * Relasi ke pendaftaran
     */
    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
    }

    /**
     * Relasi ke pasien (melalui tabel pendaftaran)
     */
    public function pasien()
    {
        return $this->hasOneThrough(
            Pasien::class,         // model tujuan
            Pendaftaran::class,    // model perantara
            'id',                  // foreign key di pendaftaran
            'id',                  // foreign key di pasien
            'pendaftaran_id',      // fk lokal
            'pasien_id'            // fk pendaftaran → pasien 
        );
    }

    /**
     * Relasi ke dokter (melalui pendaftaran)
     */
    public function dokter()
    {
        return $this->hasOneThrough(
            Dokter::class,
            Pendaftaran::class,
            'id',
            'id',
            'pendaftaran_id',
            'dokter_id'
        );
    }

    /**
     * Jika ada relasi resep
     */
    public function resep()
    {
        return $this->hasOne(Resep::class, 'rekam_medis_id');
    }

    /**
     * Jika ada pemeriksaan lab
     */
    public function lab()
    {
        return $this->hasMany(LabPemeriksaan::class, 'rekam_medis_id');
    }
}
