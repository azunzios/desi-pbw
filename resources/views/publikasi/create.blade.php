<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Publikasi</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-light">

<nav class="navbar navbar-dark mb-4" style="background:#1a5c8a;">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/publikasi">BPS PROVINSI SUMATERA UTARA</a>
    </div>
</nav>

<div class="container" style="max-width:720px;">
    <h1 class="h4 fw-bold mb-3">Tambah Publikasi</h1>

    <form action="/publikasi" method="POST" enctype="multipart/form-data" class="card card-body shadow-sm">
        @csrf

        <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" name="judul" value="{{ old('judul') }}"
                   class="form-control @error('judul') is-invalid @enderror">
            @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Rilis</label>
            <input type="date" name="tanggal_rilis" value="{{ old('tanggal_rilis') }}"
                   class="form-control @error('tanggal_rilis') is-invalid @enderror">
            @error('tanggal_rilis') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Sampul</label>
             <input type="file" name="sampul" id="sampul"
                 accept=".jpg,.jpeg,.png,image/jpeg,image/png"
                   class="form-control @error('sampul') is-invalid @enderror">
             <div class="form-text">Maksimal ukuran file 5MB (JPG/JPEG/PNG).</div>
            @error('sampul') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" rows="4" class="form-control">{{ old('deskripsi') }}</textarea>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="/publikasi" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<script>
    (function () {
        const maxSize = 5 * 1024 * 1024;
        const input = document.getElementById('sampul');

        if (!input) {
            return;
        }

        input.addEventListener('change', function () {
            const file = this.files && this.files[0];

            if (!file) {
                this.setCustomValidity('');
                this.classList.remove('is-invalid');
                return;
            }

            if (file.size > maxSize) {
                this.value = '';
                this.setCustomValidity('Ukuran file sampul maksimal 5MB.');
                this.classList.add('is-invalid');
                alert('Ukuran file melebihi 5MB. Silakan pilih file lain.');
                this.reportValidity();
                return;
            }

            this.setCustomValidity('');
            this.classList.remove('is-invalid');
        });
    })();
</script>

</body>
</html>