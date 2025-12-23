<?php
include '../../../config/koneksi.php';
include '../../layout/header.php';
?>

<div class="mb-3">
    <a href="index.php" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>

<div class="card" style="max-width: 600px; margin: 0 auto; padding: 2rem;">
    <h3 class="mb-4">Tambah Galeri Baru</h3>

    <form action="proses.php?aksi=tambah" method="POST" enctype="multipart/form-data" class="form-confirm">
        <div class="form-group">
            <label>Judul Kegiatan / Caption</label>
            <input type="text" name="judul" class="form-control" required
                placeholder="Contoh: Panen Raya Sayur Organik">
        </div>

        <div class="form-group">
            <label>Tanggal Kegiatan</label>
            <input type="date" name="tanggal" class="form-control" required value="<?= date('Y-m-d') ?>">
        </div>

        <div class="form-group">
            <label>Upload Foto</label>
            <input type="file" name="foto" class="form-control" required accept="image/*">
            <small style="color: gray;">Format: JPG, PNG, JPEG (Max 2MB)</small>
        </div>

        <button type="submit" class="btn btn-primary btn-block" style="margin-top: 1rem;">
            <i class="fas fa-save"></i> Simpan Galeri
        </button>
    </form>
</div>

<?php include '../../layout/footer.php'; ?>