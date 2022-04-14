@extends('mahasiswa.layout')

@section('content')
    <h3 class="text-center mt-4">JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG</h3>
    <h2 class="text-center mt-5 mb-4">KARTU HASIL STUDI (KHS)</h2>
    <strong>Nama: </strong>{{ $mhsMatkul->mahasiswa->nama }}<br>
    <strong>NIM: </strong>{{ $mhsMatkul->mahasiswa->nim }}<br>
    <strong>Kelas: </strong>{{ $mhsMatkul->mahasiswa->kelas->nama_kelas }}
    <table class="table mt-2">
        <th>Mata Kuliah</th>
        <th>SKS</th>
        <th>Semester</th>
        <th>Nilai</th>
        @foreach($mhsMatkul as $nilai)
        <tr>
            <td>{{ $nilai->matakuliah->nama_matkul }}</td>
            <td>{{ $nilai->matakuliah->sks }}</td>
            <td>{{ $nilai->matakuliah->semester }}</td>
            <td>{{ $nilai->nilai }}</td>
        </tr>
        @endforeach
    </table>
    <div class="row justify-content-end">
        <a href="{{ route('mahasiswa.index') }}" class="btn btn-success">Kembali</a>
    </div>
@endsection