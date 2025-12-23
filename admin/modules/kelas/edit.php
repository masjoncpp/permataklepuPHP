<?php
include '../../../config/koneksi.php';
include '../../layout/header.php';

$id = $_GET['id'];
$stmt = mysqli_prepare($koneksi, "SELECT * FROM kelas WHERE id=?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_array($result);
?>

<div class="mb-3">
    <a href="index.php" class="btn btn-outline" style="border:1px solid #ddd; padding:5px 10px; border-radius:5px;">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card" style="padding: 2rem; max-width: 600px; margin:0 auto;">
    <h3 class="mb-4">Edit Kelas</h3>

    <form action="proses.php?aksi=edit" method="POST" enctype="multipart/form-data" class="form-confirm">
        <input type="hidden" name="id" value="<?= $data['id'] ?>">
        <input type="hidden" name="foto_lama" value="<?= $data['gambar'] ?>">

        <div class="form-group mb-3">
            <label class="block mb-1 font-bold">Nama Kelas</label>
            <input type="text" name="nama_kelas" class="form-control" required value="<?= $data['nama_kelas'] ?>">
        </div>

        <div class="form-group mb-3">
            <label class="block mb-1 font-bold">Deskripsi Program</label>
            <textarea name="deskripsi" class="form-control" rows="4" required><?= $data['deskripsi'] ?></textarea>
        </div>

        <div class="form-group mb-3">
            <label class="block mb-1 font-bold">Ganti Gambar (Opsional)</label>
            <input type="file" name="foto" class="form-control" accept="image/*">
            <small class="text-muted">Biarkan kosong jika tidak ingin mengganti gambar.</small>
        </div>

        <button type="submit" class="btn btn-primary btn-block w-100" style="margin-top: 1rem;">
            <i class="fas fa-save"></i> Update Kelas
        </button>
    </form>
</div>

<?php include '../../layout/footer.php'; ?>