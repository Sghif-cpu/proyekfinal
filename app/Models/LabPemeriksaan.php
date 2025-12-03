<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabPemeriksaan extends Model
{
    use HasFactory;

    protected $table = 'lab_pemeriksaan';

    protected $fillable = [
        'rekam_medis_id',
        'nama_pemeriksaan',
        'hasil',
        'satuan'
    ];

    public function rekamMedis()
    {
        return $this->belongsTo(RekamMedis::class);
    }
}
