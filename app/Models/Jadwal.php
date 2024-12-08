<?php

namespace App\Models;
use App\Models\DataGuru;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'tb_jadwal';

    public $timestamps = false;

    protected $fillable = [
        'nip',
        'id_tahun',
        'id_kelas',
        'id_mapel',
        'hari',
        'jam_mulai',
        'jam_selesai',
    ];

    public function guru()
    {
        return $this->belongsTo(DataGuru::class, 'nip', 'nip');
    }

    public function tahun()
    {
        return $this->belongsTo(Tahun::class, 'id_tahun', 'id_tahun');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'id_mapel', 'id_mapel');
    }

    public $incrementing = true;
    protected $primaryKey = 'id_jadwal';
}
