<?php

namespace App\Models;
use App\Models\DataGuru;
use App\Models\GuruPiket;
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

    public $incrementing = true;
    protected $primaryKey = 'id_jadwal';
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
    public function jurnal()
    {
        return $this->belongsTo(Jurnal::class, 'id_jurnal');
    }
    public function profile()
    {
        return $this->belongsTo(Profile::class, 'nip');
    }
    public function piket()
    {
    return $this->hasOne(GuruPiket::class, 'hari', 'hari');
    }
    public function jurnals()
{
    return $this->hasMany(Jurnal::class, 'id_jadwal', 'id_jadwal');
}


}
