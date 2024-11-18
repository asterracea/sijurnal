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
}
