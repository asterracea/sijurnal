<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuruPiket extends Model
{
    protected $table = 'tb_piket';

    public $timestamps = false;

    protected $fillable = [
        'nip',
        'id_tahun',
        'hari',
        'jam_mulai',
        'jam_selesai',
    ];

    public $incrementing = true;
    protected $primaryKey = 'id_piket';
    public function guru()
    {
        return $this->belongsTo(DataGuru::class, 'nip', 'nip');
    }

    public function tahun()
    {
        return $this->belongsTo(Tahun::class, 'id_tahun', 'id_tahun');
    }
    public function jadwal()
    {
    return $this->belongsTo(Jadwal::class, 'hari', 'hari');
    }
    public function jurnal()
    {
    return $this->hasMany(Jurnal::class, 'id_piket', 'id_piket'); // Hubungan kebalikannya
    }


}
