<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'tb_kelas';
    protected $fillable = ['nama_kelas'];

    public $timestamps = false;

    public $incrementing = true;
    protected $primaryKey = 'id_kelas';

    public function jadwalPelajaran()
    {
        return $this->hasMany(Jadwal::class, 'id_kelas');
    }
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'id_kelas', 'id_kelas');
    }

    // public function jurnal()
    // {
    //     return $this->hasMany(Jurnal::class, 'id_kelas');
    // }
}
    


