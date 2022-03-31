@extends('mahasiswa.layout')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 24rem;">
            <div class="card-header">
            Edit Mahasiswa
            </div>
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form method="post" action="{{ route('mahasiswa.update', $Mahasiswa->nim) }}" id="myForm">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="Nim">Nim</label>
                        <input type="text" name="nim" class="form-control" id="Nim" value="{{ $Mahasiswa->nim }}" aria-describedby="Nim" >
                    </div>
                    <div class="form-group">
                        <label for="Nama">Nama</label>
                        <input type="text" name="nama" class="form-control" id="Nama" value="{{ $Mahasiswa->nama }}" aria-describedby="Nama" >
                    </div>
                    <div class="form-group">
                        <label for="jenisKelamin">Jenis Kelamin</label>
                        <select class="form-control" id="jenisKelamin" name="jenisKelamin" aria-label="Jenis">
                            @if ($Mahasiswa->jenisKelamin == 'L')
                            <option value="L" selected>Laki-laki</option>
                            <option value="P">Perempuan</option>
                            @else
                            <option value="L">Laki-laki</option>
                            <option value="P" selected>Perempuan</option>
                            @endif
                        </select>
                    </div>  
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" class="form-control" id="email" value="{{ $Mahasiswa->email }}" aria-describedby="email" >
                    </div>
                    <div class="form-group">
                        <label for="Kelas">Kelas</label>
                        <input type="text" name="kelas" class="form-control" id="Kelas" value="{{ $Mahasiswa->kelas }}" aria-describedby="Kelas" >
                    </div>
                    <div class="form-group">
                        <label for="Jurusan">Jurusan</label>
                        <input type="text" name="jurusan" class="form-control" id="Jurusan" value="{{ $Mahasiswa->jurusan }}" aria-describedby="Jurusan" >
                    </div>
                    <div class="form-group">
                        <label for="tglLahir">Tanggal Lahir</label>
                        <input type="date" name="tglLahir" class="form-control" value="{{ $Mahasiswa->tglLahir }}" id="tglLahir" aria-describedby="tglLahir" >
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" name="alamat" id="alamat" rows="3">{{ $Mahasiswa->alamat }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection