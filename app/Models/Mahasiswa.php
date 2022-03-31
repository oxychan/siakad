<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'id_mahasiswa';

    protected $fillable = [
        'nim',
        'nama',
        'kelas',
        'jurusan',
        'jenisKelamin',
        'email',
        'alamat',
        'tglLahir'
    ];
}
