<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa'; // Eloquent akan membuat model mahasiswa menyimpan di tabel mahasiswa
    protected $primaryKey = 'id_mahasiswa'; // Memanggil isi DB dengan primaryKey

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

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
