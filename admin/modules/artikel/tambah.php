<?php
include '../../../config/koneksi.php';
include '../../layout/header.php';
?>

<div class="mb-3">
    <a href="index.php" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>

<div class="card" style="padding: 2rem;">
    <h3 class="mb-4">Tulis Artikel Baru</h3>

    <form action="proses.php?aksi=tambah" method="POST" enctype="multipart/form-data" class="form-confirm">
        <div class="row">
            <div class="col-md-8" style="flex: 2; padding-right: 20px;">
                <div class="form-group">
                    <label>Judul Artikel</label>
                    <input type="text" name="judul" class="form-control" required placeholder="Judul yang menarik...">
                </div>

                <div class="form-group">
                    <label>Isi Artikel</label>
                    <textarea name="isi" class="form-control" rows="10" required
                        placeholder="Tulis isi artikel di sini..."></textarea>
                </div>
            </div>

            <div class="col-md-4" style="flex: 1;">
                <div class="form-group">
                    <label>Kategori Program</label>
                    <select name="kategori" class="form-control" required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="Ibu Cakap Usaha">Ibu Cakap Usaha</option>
                        <option value="Ibu Rawat Bumi">Ibu Rawat Bumi</option>
                        <option value="Ibu Sejahtera">Ibu Sejahtera</option>
                        <option value="Umum">Berita Umum</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Tanggal Publish</label>
                    <input type="date" name="tanggal" class="form-control" value="<?= date('Y-m-d') ?>" required>
                </div>

                <div class="form-group">
                    <label>Gambar Sampul</label>
                    <input type="file" name="foto" class="form-control" accept="image/*" required>
                </div>

                <div class="form-group">
                    <label>Link Google Drive (Modul/PDF)</label>
                    <input type="url" name="link_drive" class="form-control" placeholder="https://drive.google.com/...">
                    <small class="text-muted">Opsional, jika ada file materi.</small>
                </div>

                <button type="submit" class="btn btn-primary btn-block" style="margin-top: 1rem;">
                    <i class="fas fa-paper-plane"></i> Terbitkan
                </button>
            </div>
        </div>
    </form>
</div>

<?php include '../../layout/footer.php'; ?>