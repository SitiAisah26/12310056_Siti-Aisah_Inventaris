@extends('layouts.app')

@section('content')

<h1 class="mt-4">Categories</h1>

<a href="/categories/create" class="btn btn-primary mb-3">+ Tambah</a>

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Aksi</th>
    </tr>

    @foreach($data as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->name }}</td>
        <td>
            <a href="/categories/{{ $item->id }}/edit" class="btn btn-warning btn-sm">Edit</a>

            <form action="/categories/{{ $item->id }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach

</table>
    
@endsection