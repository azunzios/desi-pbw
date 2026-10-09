<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Publikasi BPS Provinsi Sumatera Utara</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-light">

<nav class="navbar navbar-dark mb-4" style="background:#1a5c8a;">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2 fw-bold" href="/publikasi">
            <img src="/images/logo-bps1.png" alt="Logo BPS" height="40">
            BPS PROVINSI SUMATERA UTARA
        </a>
    </div>
</nav>

<div class="container">

    <h1 class="h4 fw-bold mb-3">Daftar Publikasi</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="/publikasi/create" class="btn btn-primary mb-3">+ Tambah Publikasi</a>

    <table class="table table-bordered table-hover align-middle bg-white">
        <thead style="background-color: #1a5c8a; color: white;">
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Tanggal Rilis</th>
                <th>Sampul</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($publikasi as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->judul }}</td>
                    <td>{{ $item->tanggal_rilis }}</td>
                    <td>
                        @if ($item->sampul)
                            <img src="/images/{{ $item->sampul }}" alt="{{ $item->judul }}" width="80">
                        @endif
                    </td>
                    <td>{{ $item->deskripsi }}</td>
                    <td>
                        <a href="/publikasi/{{ $item->id }}/edit" class="btn btn-warning btn-sm">Edit</a>

                        <form action="/publikasi/{{ $item->id }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Yakin ingin menghapus publikasi ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Belum ada data publikasi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <footer class="text-center text-muted small border-top py-3 mt-4">
        <address class="mb-1">Copyright 2026 Politeknik Statistika STIS</address>
        <address class="mb-0">Created by Desi Natalia Magdalena Naibaho (222413542@stis.ac.id)</address>
    </footer>
</div>

</body>
</html>