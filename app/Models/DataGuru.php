<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataGuru extends Model
{
    use HasFactory;

    // Tabel yang digunakan oleh model
    protected $table = 'tb_guru';

    // Field yang bisa diisi secara massal (mass assignable)
    public $timestamps = false;

    protected $fillable = [
        'nip',
        'nama_guru',
    ];
}
