<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Profile extends Model
{
    protected $table = 'tb_guru'; // Nama tabel di database

    protected $fillable = [
        'nip', 'nama_guru', 
    ];
    // Definisikan relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'nip','id_user');
        
    }
    // Relasi dengan Jadwal (setiap guru bisa mengajar beberapa jadwal)
    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'nip');
    }
}
