<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Publikasi</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-light">

<nav class="navbar navbar-dark mb-4" style="background:#1a5c8a;">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/publikasi">BPS PROVINSI SUMATERA UTARA</a>
    </div>
</nav>

<div class="container" style="max-width:720px;">
    <h1 class="h4 fw-bold mb-3">Edit Publikasi</h1>

    <form action="/publikasi/{{ $publikasi->id }}" method="POST" enctype="multipart/form-data" class="card card-body shadow-sm">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" name="judul" value="{{ old('judul', $publikasi->judul) }}"
                   class="form-control @error('judul') is-invalid @enderror">
            @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Rilis</label>
            <input type="date" name="tanggal_rilis"
                   value="{{ old('tanggal_rilis', \Illuminate\Support\Carbon::parse($publikasi->tanggal_rilis)->format('Y-m-d')) }}"
                   class="form-control @error('tanggal_rilis') is-invalid @enderror">
            @error('tanggal_rilis') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Sampul saat ini</label><br>
            @if ($publikasi->sampul)
                <img src="/images/{{ $publikasi->sampul }}" alt="Sampul" width="80" class="mb-2">
            @else
                <span class="text-muted">Tidak ada gambar</span>
            @endif
            <input type="file" name="sampul"
                   class="form-control @error('sampul') is-invalid @enderror">
            <div class="form-text">Kosongkan jika tidak ingin mengganti sampul.</div>
            @error('sampul') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" rows="4" class="form-control">{{ old('deskripsi', $publikasi->deskripsi) }}</textarea>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="/publikasi" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

</body>
</html>