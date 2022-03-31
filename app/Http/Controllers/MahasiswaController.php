<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
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
        $mahasiswa = Mahasiswa::orderBy('id_mahasiswa', 'asc')->paginate(5);
        return view('mahasiswa.index', compact('mahasiswa'));
    }

    public function search(Request $request) 
    {
        $keyword = $request->search;
        $mahasiswa = Mahasiswa::where('nim', 'like', '%' .$keyword. '%')
            ->orWhere('nama', 'like', '%' .$keyword. '%')
            ->orWhere('jurusan', 'like', '%' .$keyword. '%')
            ->orWhere('email', 'like', '%' .$keyword. '%' .$keyword. '%') 
            ->orWhere('kelas', 'like', '%' .$keyword. '%')
            ->paginate(3)->withQueryString();
        
            return view('mahasiswa.index', compact('mahasiswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mahasiswa.create');
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
        //fungsi eloquent untuk menambah data
        Mahasiswa::create($request->all());//jika data berhasil ditambahkan, akan kembali ke halaman utama
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
        $mahasiswa = Mahasiswa::where('nim', $nim)->first();
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
        $Mahasiswa = DB::table('mahasiswa')->where('nim', $nim)->first();
        return view('mahasiswa.edit', compact('Mahasiswa'));
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
            //fungsi eloquent untuk mengupdate data inputan kita
        Mahasiswa::where('nim', $nim)
        ->update([
            'nim'=>$request->nim,
            'nama'=>$request->nama,
            'kelas'=>$request->kelas,
            'jurusan'=>$request->jurusan,
            'jenisKelamin' => $request->jenisKelamin,
            'email' => $request->email,
            'tglLahir' => $request->tglLahir,
            'alamat' => $request->alamat,
        ]);
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
}
