<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    protected $table = 'tb_mapel'; // Nama tabel yang sesuai dengan database
    protected $fillable = ['nama_mapel'];

    public $timestamps = false; // Menonaktifkan timestamps jika tidak diperlukan
}
