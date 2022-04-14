<?php

namespace App\Models;

use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mahasiswa_MataKuliah extends Model
{
    use HasFactory;

    protected $table='mahasiswa_matakuliah';
    protected $guarded = ['id'];

    public function matakuliah()
    {
        return $this->belongsTo(MataKuliah::class);
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}
