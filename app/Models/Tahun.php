<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tahun extends Model
{
    protected $table = 'tb_tahun';
    protected $fillable = ['tahun_ajaran', 'semester', 'status'];

    public $timestamps = false;

    public $incrementing = true;
    protected $primaryKey = 'id_tahun';

}
