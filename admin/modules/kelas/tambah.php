<?php
include '../../../config/koneksi.php';
include '../../layout/header.php';
?>

<div class="mb-3">
    <a href="index.php" class="btn btn-outline" style="border:1px solid #ddd; padding:5px 10px; border-radius:5px;">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card" style="padding: 2rem; max-width: 600px; margin:0 auto;">
    <h3 class="mb-4">Tambah Kelas Baru</h3>

    <form action="proses.php?aksi=tambah" method="POST" enctype="multipart/form-data" class="form-confirm">
        <div class="form-group mb-3">
            <label class="block mb-1 font-bold">Nama Kelas</label>
            <input type="text" name="nama_kelas" class="form-control" required placeholder="Contoh: Ibu Cerdas Digital">
        </div>

        <div class="form-group mb-3">
            <label class="block mb-1 font-bold">Deskripsi Program</label>
            <textarea name="deskripsi" class="form-control" rows="4" required
                placeholder="Jelaskan detail program ini..."></textarea>
        </div>

        <div class="form-group mb-3">
            <label class="block mb-1 font-bold">Gambar Cover</label>
            <input type="file" name="foto" class="form-control" accept="image/*" required>
        </div>

        <button type="submit" class="btn btn-primary btn-block w-100" style="margin-top: 1rem;">
            <i class="fas fa-save"></i> Simpan Kelas
        </button>
    </form>
</div>

<?php include '../../layout/footer.php'; ?>