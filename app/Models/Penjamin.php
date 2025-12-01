<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penjamin extends Model
{
    use HasFactory;
    protected $table = 'penjamin';
    protected $fillable = ['nama_penjamin','tipe','keterangan'];

    public function pasien()
    {
        return $this->hasMany(Pasien::class);
    }
}
