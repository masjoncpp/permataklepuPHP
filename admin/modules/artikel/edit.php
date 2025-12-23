<?php
include '../../../config/koneksi.php';
include '../../layout/header.php';

$id = $_GET['id'];
$stmt = mysqli_prepare($koneksi, "SELECT * FROM artikel WHERE id=?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_array($result);
?>

<div class="mb-3">
    <a href="index.php" class="btn btn-outline"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>

<div class="card" style="padding: 2rem;">
    <h3 class="mb-4">Edit Artikel</h3>

    <form action="proses.php?aksi=edit" method="POST" enctype="multipart/form-data" class="form-confirm">
        <input type="hidden" name="id" value="<?= $data['id'] ?>">
        <input type="hidden" name="foto_lama" value="<?= $data['gambar'] ?>">

        <div class="row">
            <div class="col-md-8" style="flex: 2; padding-right: 20px;">
                <div class="form-group">
                    <label>Judul Artikel</label>
                    <input type="text" name="judul" class="form-control" required value="<?= $data['judul'] ?>">
                </div>

                <div class="form-group">
                    <label>Isi Artikel</label>
                    <textarea name="isi" class="form-control" rows="10" required><?= $data['isi'] ?></textarea>
                </div>
            </div>

            <div class="col-md-4" style="flex: 1;">
                <div class="form-group">
                    <label>Kategori</label>
                    <select name="kategori" class="form-control" required>
                        <option value="Ibu Cakap Usaha" <?= ($data['kategori'] == 'Ibu Cakap Usaha') ? 'selected' : '' ?>>
                            Ibu Cakap Usaha</option>
                        <option value="Ibu Rawat Bumi" <?= ($data['kategori'] == 'Ibu Rawat Bumi') ? 'selected' : '' ?>>Ibu
                            Rawat Bumi</option>
                        <option value="Ibu Sejahtera" <?= ($data['kategori'] == 'Ibu Sejahtera') ? 'selected' : '' ?>>Ibu
                            Sejahtera</option>
                        <option value="Umum" <?= ($data['kategori'] == 'Umum') ? 'selected' : '' ?>>Berita Umum</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="<?= $data['tanggal'] ?>" required>
                </div>

                <div class="form-group">
                    <label>Gambar Saat Ini</label><br>
                    <?php
                    $path_upload = "../../../assets/uploads/" . $data['gambar'];
                    $img_url = (file_exists($path_upload) && $data['gambar'] != "")
                        ? BASE_URL . "assets/uploads/" . $data['gambar']
                        : BASE_URL . "assets/img/" . $data['gambar'];
                    ?>
                    <img src="<?= $img_url ?>" style="width: 100%; border-radius: 8px; margin-bottom: 10px;">
                </div>

                <div class="form-group">
                    <label>Ganti Gambar</label>
                    <input type="file" name="foto" class="form-control" accept="image/*">
                </div>

                <div class="form-group">
                    <label>Link Drive</label>
                    <input type="url" name="link_drive" class="form-control" value="<?= $data['link_drive'] ?>">
                </div>

                <button type="submit" class="btn btn-primary btn-block" style="margin-top: 1rem;">
                    <i class="fas fa-save"></i> Update Artikel
                </button>
            </div>
        </div>
    </form>
</div>

<?php include '../../layout/footer.php'; ?>