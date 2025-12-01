<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RekamMedis extends Model
{
    use HasFactory;
    protected $table = 'rekam_medis';
    protected $fillable = ['pendaftaran_id','pasien_id','dokter_id','poli_id','keluhan','diagnosa','tindakan'];

    public function pendaftaran(){ return $this->belongsTo(Pendaftaran::class); }
    public function pasien(){ return $this->belongsTo(Pasien::class); }
    public function dokter(){ return $this->belongsTo(Dokter::class); }
    public function resep(){ return $this->hasOne(Resep::class); }
    public function lab(){ return $this->hasMany(LabPemeriksaan::class); }
}
