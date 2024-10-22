<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'tb_kelas'; // Nama tabel yang sesuai dengan database
    protected $fillable = ['nama_kelas'];

    public $timestamps = false; // Menonaktifkan timestamps
}
