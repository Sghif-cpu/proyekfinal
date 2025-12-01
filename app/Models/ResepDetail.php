<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ResepDetail extends Model
{
    use HasFactory;
    protected $table = 'resep_detail';
    protected $fillable = ['resep_id','obat_id','jumlah','aturan_pakai'];

    public function resep(){ return $this->belongsTo(Resep::class); }
    public function obat(){ return $this->belongsTo(Obat::class); }
}
