<?php
include '../../../config/koneksi.php';
include '../../layout/header.php';

$id = $_GET['id'];
$stmt = mysqli_prepare($koneksi, "SELECT * FROM galeri WHERE id=?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_array($result);
?>

<div class="mb-3">
    <a href="index.php" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>

<div class="card" style="max-width: 600px; margin: 0 auto; padding: 2rem;">
    <h3 class="mb-4">Edit Galeri</h3>

    <form action="proses.php?aksi=edit" method="POST" enctype="multipart/form-data" class="form-confirm">
        <input type="hidden" name="id" value="<?= $data['id'] ?>">
        <input type="hidden" name="foto_lama" value="<?= $data['gambar'] ?>">

        <div class="form-group">
            <label>Judul Kegiatan / Caption</label>
            <input type="text" name="judul" class="form-control" required value="<?= $data['judul'] ?>">
        </div>

        <div class="form-group">
            <label>Tanggal Kegiatan</label>
            <input type="date" name="tanggal" class="form-control" required value="<?= $data['tanggal'] ?>">
        </div>

        <div class="form-group">
            <label>Foto Saat Ini</label><br>
            <?php
            // Logika cek gambar sama seperti index
            $img_path_upload = "../../../assets/uploads/" . $data['gambar'];
            $img_url = (file_exists($img_path_upload) && $data['gambar'] != "")
                ? BASE_URL . "assets/uploads/" . $data['gambar']
                : BASE_URL . "assets/img/" . $data['gambar'];
            ?>
            <img src="<?= $img_url ?>" style="max-width: 150px; border-radius: 8px; margin-bottom: 10px;">
        </div>

        <div class="form-group">
            <label>Ganti Foto (Opsional)</label>
            <input type="file" name="foto" class="form-control" accept="image/*">
            <small style="color: gray;">Biarkan kosong jika tidak ingin mengganti foto.</small>
        </div>

        <button type="submit" class="btn btn-primary btn-block" style="margin-top: 1rem;">
            <i class="fas fa-save"></i> Simpan Perubahan
        </button>
    </form>
</div>

<?php include '../../layout/footer.php'; ?>