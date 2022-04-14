<?php

namespace App\Models;

use App\Models\Kelas;
use App\Models\Mahasiswa_MataKuliah;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function mahasiswa_matakuliah()
    {
        return $this->hasMany(Mahasiswa_MataKuliah::class);
    }
}
