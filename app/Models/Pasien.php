<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasien';

    protected $fillable = [
        'no_rm',
        'nik',
        'nama',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'no_hp',
        'penjamin_id'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date'
    ];

    public function penjamin()
    {
        return $this->belongsTo(Penjamin::class, 'penjamin_id');
    }

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'pasien_id');
    }

    public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class, 'pasien_id');
    }
}
