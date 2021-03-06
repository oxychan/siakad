@extends('mahasiswa.layout')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left mt-2">
            <h2>JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG</h2>
        </div>
        <form action="{{ route('mahasiswa.search') }}" class="mt-4" method="get">
            @csrf
            <div class="row flex-row">
                <div class="col-md-4">
                    <div class="input-group">    
                        <input type="text" name="search" class="form-control" placeholder="Nim/Nama/Email/Jurusan/Kelas" aria-label="Username" aria-describedby="basic-addon1">
                        <div class="input-group-append">
                            <input type="submit" value="Cari" class="btn btn-secondary" id="searchnich"></input>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="float-right my-2">
                        <a class="btn btn-success" href="{{ route('mahasiswa.create') }}"> Input Mahasiswa</a>
                    </div>
                </div>                     
            </div>
        </form>
    </div>
</div>
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
@if ($message = Session::get('error'))
<div class="alert alert-error">
    <p>{{ $message }}</p>
</div>
@endif
<table class="table table-bordered">
    <tr>
        <th>Nim</th>
        <th>Nama</th>
        <th>Kelas</th>
        <th>Jurusan</th>
        <th>Foto</th>
        <th width="300px">Action</th>
    </tr>
@foreach ($mahasiswa as $mhs)
    <tr>
        <td>{{ $mhs->nim }}</td>
        <td>{{ $mhs->nama }}</td>
        <td>{{ $mhs->kelas->nama_kelas }}</td>
        <td>{{ $mhs->jurusan }}</td>
        <td><img src="{{ asset('storage/' . $mhs->featured_image) }}" width="40px" alt="Foto"></td>
        <td>
            <form action="{{ route('mahasiswa.destroy', $mhs->nim) }}" method="POST">
                <a class="btn btn-info" href="{{ route('mahasiswa.show',$mhs->nim) }}">Show</a>
                <a class="btn btn-primary" href="{{ route('mahasiswa.edit',$mhs->nim) }}">Edit</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
                <a class="btn btn-warning text-white" href="{{ route('mahasiswa.nilai', $mhs->id_mahasiswa) }}">Nilai</a>
            </form>
        </td>
    </tr>
@endforeach
</table>
<div class="d-flex justify-content-center">
 {{ $mahasiswa->withQueryString()->links() }}
</div>
@endsection