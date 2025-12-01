<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransaksiDetail extends Model
{
    use HasFactory;
    protected $table = 'transaksi_detail';
    protected $fillable = ['transaksi_id','item','qty','harga','subtotal'];

    public function transaksi(){ return $this->belongsTo(Transaksi::class); }
}
