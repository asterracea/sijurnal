<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    protected $table = 'tb_jurnal';
    protected $primaryKey = 'id_jurnal';
    protected $fillable = ['id_jurnal', 'nip','id_jadwal', 'tanggal', 'jam_mulai', 'jam_selesai', 'rencana','realisasi', 'foto'];
    public $timestamps = false;
    public function guru()
    {
        return $this->belongsTo(User::class, 'nip');
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal');
    }
    
}

?>