<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Resep extends Model
{
    use HasFactory;
    protected $table = 'resep';
    protected $fillable = ['rekam_medis_id','pasien_id','tanggal_resep'];

    public function rekamMedis(){ return $this->belongsTo(RekamMedis::class); }
    public function pasien(){ return $this->belongsTo(Pasien::class); }
    public function detail(){ return $this->hasMany(ResepDetail::class); }
}
