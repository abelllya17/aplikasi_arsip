@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <h1>Arsip Surat >> {{ $mode === 'create' ? 'Unggah' : 'Ubah' }}</h1>
    <p>Simpan surat yang ingin diarsipkan pada form berikut.
        <br>Catatan: Gunakan file berformat PDF.
    </p>

    <div class="card">
        <form method="post" enctype="multipart/form-data"
            action="{{ $mode === 'create' ? route('archives.store') : route('archives.update', $archive) }}">
            @csrf
            @if($mode === 'edit') @method('PUT') @endif

            <div style="margin-bottom:10px">
                <label>Nomor Surat</label><br>
                <input type="text" name="number" value="{{ old('number', $archive->number) }}"
                    style="width:360px;padding:8px;border:2px solid #cfd8e3;border-radius:8px">
                @error('number') <div style="color:#ef4444">{{ $message }}</div> @enderror
            </div>

            <div style="margin-bottom:10px">
                <label>Kategori</label><br>
                <select name="category_id" style="width:360px;padding:8px;border:2px solid #cfd8e3;border-radius:8px">
                    <option value="">-- Pilih --</option>
                    @foreach($categories as $id => $name)
                        <option value="{{ $id }}" @selected(old('category_id', $archive->category_id) == $id)>{{ $name }}</option>
                    @endforeach
                </select>
                @error('category_id') <div style="color:#ef4444">{{ $message }}</div> @enderror
            </div>

            <div style="margin-bottom:10px">
                <label>Keterangan</label><br>
                <input type="text" name="title" value="{{ old('title', $archive->title) }}"
                    style="width:720px;padding:8px;border:2px solid #cfd8e3;border-radius:8px">
                @error('title') <div style="color:#ef4444">{{ $message }}</div> @enderror
            </div>

            <div style="margin-bottom:16px">
                <label>File Surat (PDF)</label><br>
                <input type="file" name="file" accept="application/pdf">
                @if($mode === 'edit' && $archive->file_path)
                    <div style="font-size:12px;color:#6b7280">Kosongkan jika tidak ingin mengganti file.</div>
                @endif
                @error('file') <div style="color:#ef4444">{{ $message }}</div> @enderror
            </div>

            <a class="btn btn-secondary" href="{{ route('archives.index') }}">&lt;&lt; Kembali</a>
            <button class="btn btn-success" type="submit">Simpan</button>
        </form>
    </div>
@endsection