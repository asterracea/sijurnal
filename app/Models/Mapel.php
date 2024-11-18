<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    protected $table = 'tb_mapel';
    protected $fillable = ['nama_mapel'];

    public $timestamps = false;

    public $incrementing = true;
    protected $primaryKey = 'id_mapel';
}
