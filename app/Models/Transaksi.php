<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    protected $fillable = ['pasien_id','pendaftaran_id','total_biaya','bayar','kembalian','status'];

    public function pendaftaran(){ return $this->belongsTo(Pendaftaran::class); }
    public function pasien(){ return $this->belongsTo(Pasien::class); }
    public function detail(){ return $this->hasMany(TransaksiDetail::class); }
}
