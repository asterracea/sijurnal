<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataGuru extends Model
{
    use HasFactory;

    protected $table = 'tb_guru';
    protected $primaryKey = 'nip';
    protected $fillable = ['nip', 'nama_guru'];
    public $timestamps = false;

    // Relasi dengan User
    public function user()
    {
        return $this->hasOne(User::class, 'nip', 'nip');
    }
}

