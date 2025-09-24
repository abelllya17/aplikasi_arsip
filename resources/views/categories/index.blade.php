@extends('layouts.app')

@section('content')
    <h1>Kategori Surat</h1>
    <p>Berikut ini adalah kategori yang bisa digunakan untuk melabeli surat. Klik “Tambah” pada kolom aksi untuk menambahkan
        kategori baru.</p>

    <form class="toolbar" method="get">
        <input type="search" name="q" value="{{ $q }}" placeholder="search">
        <button class="btn">Cari!</button>
        <a class="btn btn-dark" class="btn" href="{{ route('categories.create') }}" style="margin-left:auto">[ + ] Tambah Kategori Baru…</a>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID Kategori</th>
                <th>Nama Kategori</th>
                <th>Keterangan</th>
                <th style="width:220px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $c)
                <tr>
                    <td>{{ $c->id }}</td>
                    <td>{{ $c->name }}</td>
                    <td>{{ $c->description }}</td>
                    <td class="actions">
                        <form action="{{ route('categories.destroy', $c) }}" method="post" style="display:inline"
                            onsubmit="return confirm('Hapus kategori ini?')">
                            @csrf @method('DELETE')
                            <button class="btn-red" type="submit">Hapus</button>
                        </form>
                        <a class="btn-blue" href="{{ route('categories.edit', $c) }}">Edit</a>
                    </td>
                </tr>
            @endforeach
            @if(!$categories->count())
                <tr>
                    <td colspan="4" style="text-align:center;padding:20px">Tidak ada data.</td>
                </tr>
            @endif
        </tbody>
    </table>

    <div style="margin-top:12px">{{ $categories->links() }}</div>
@endsection