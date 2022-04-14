<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\Mahasiswa_MataKuliah;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //fungsi eloquent menampilkan data menggunakan pagination
        // $mahasiswa = Mahasiswa::all(); // Mengambil semua isi tabel
        $mahasiswa = Mahasiswa::orderBy('id_mahasiswa', 'asc')->paginate(3);
        return view('mahasiswa.index', compact('mahasiswa'));
    }

    public function search(Request $request) 
    {
        $keyword = $request->search;
        $mahasiswa = Mahasiswa::with('kelas')
            ->where('nim', 'like', '%' .$keyword. '%')
            ->orWhere('nama', 'like', '%' .$keyword. '%')
            ->orWhere('jurusan', 'like', '%' .$keyword. '%')
            ->orWhere('email', 'like', '%' .$keyword. '%') 
            ->orWhereHas('kelas', function ($query){
                $query->where('nama_kelas', 'like', '%' .request('search'). '%');
            })
            ->paginate(3);
        
            return view('mahasiswa.index', compact('mahasiswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::all();
        return view('mahasiswa.create', compact('kelas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
            'jenisKelamin' => 'required',
            'email' => 'required',
            'tglLahir' => 'required',
            'alamat' => 'required',
        ]);

        $mahasiswa = new Mahasiswa;
        $mahasiswa->nim = request('nim');
        $mahasiswa->nama = request('nama');
        $mahasiswa->email = request('email');
        $mahasiswa->jurusan = request('jurusan');
        $mahasiswa->jenisKelamin = request('jenisKelamin');
        $mahasiswa->tglLahir = request('tglLahir');
        $mahasiswa->alamat = request('alamat');

        $kelas = new Kelas;
        $kelas->id = request('kelas');

        // fungsi eloquent untuk menambah data dengan relasi belongsTo
        $mahasiswa->kelas()->associate($kelas);
        $mahasiswa->save();

        //fungsi eloquent untuk menambah data
        // Mahasiswa::create($request->all());//jika data berhasil ditambahkan, akan kembali ke halaman utama
        return redirect()->route('mahasiswa.index')
        ->with('success', 'Mahasiswa Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($nim)
    {
        //menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa
        $mahasiswa = Mahasiswa::with('kelas')
            ->where('nim', $nim)->first();
        return view('mahasiswa.detail', compact('mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($nim)
    {
        //menampilkan detail data dengan menemukan berdasarkan Nim Mahasiswa untuk diedit
        $Mahasiswa = Mahasiswa::with('kelas')->where('nim', $nim)->first();
        $kelas = Kelas::all();
        return view('mahasiswa.edit', compact('Mahasiswa', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nim)
    {
        $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
            'jenisKelamin' => 'required',
            'email' => 'required',
            'tglLahir' => 'required',
            'alamat' => 'required',
        ]);

        $mahasiswa = Mahasiswa::with('kelas')->where('nim', $nim)->first();
        $mahasiswa->nim = request('nim');
        $mahasiswa->nama = request('nama');
        $mahasiswa->email = request('email');
        $mahasiswa->jurusan = request('jurusan');
        $mahasiswa->jenisKelamin = request('jenisKelamin');
        $mahasiswa->tglLahir = request('tglLahir');
        $mahasiswa->alamat = request('alamat');

        $kelas = new Kelas;
        $kelas->id = request('kelas');

        // fungsi eloquent untuk menambah data dengan relasi belongsTo
        $mahasiswa->kelas()->associate($kelas);
        $mahasiswa->save();
         
        //jika data berhasil diupdate, akan kembali ke halaman utama
        return redirect()
            ->route('mahasiswa.index')
            ->with('success', 'Mahasiswa Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($nim)
    {
        //fungsi eloquent untuk menghapus data
        Mahasiswa::where('nim', $nim)->delete();
        return redirect()
            ->route('mahasiswa.index')
            -> with('success', 'Mahasiswa Berhasil Dihapus');
    }
    
    public function nilai($idMhs)
    {
        $mhsMatkul = Mahasiswa_MataKuliah::with('matakuliah')
            ->where('mahasiswa_id', $idMhs)->get();
        $mhsMatkul->mahasiswa = Mahasiswa::with('kelas')
            ->where('id_mahasiswa', $idMhs)->first();
        
        return view('mahasiswa.nilai', compact('mhsMatkul'));
    }
}
