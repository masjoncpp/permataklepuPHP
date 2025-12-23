<?php
include '../../../config/koneksi.php';
include '../../layout/header.php';

$id = $_GET['id'];
$stmt = mysqli_prepare($koneksi, "SELECT * FROM nilai WHERE id=?");
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
    <h3 class="mb-4">Edit Data Peserta</h3>

    <form action="proses.php?aksi=edit" method="POST" class="form-confirm">
        <input type="hidden" name="id" value="<?= $data['id'] ?>">

        <div class="form-group mb-3">
            <label class="block mb-1 font-bold">Nama Peserta</label>
            <input type="text" name="nama_peserta" class="form-control" required value="<?= $data['nama_peserta'] ?>">
        </div>

        <div class="form-group mb-3">
            <label class="block mb-1 font-bold">Program Kelas</label>
            <select name="kelas" class="form-control" required>
                <option value="Ibu Cerdas" <?= ($data['kelas'] == 'Ibu Cerdas') ? 'selected' : '' ?>>Ibu Cerdas</option>
                <option value="Ibu Mandiri" <?= ($data['kelas'] == 'Ibu Mandiri') ? 'selected' : '' ?>>Ibu Mandiri</option>
                <option value="Ibu Tangguh" <?= ($data['kelas'] == 'Ibu Tangguh') ? 'selected' : '' ?>>Ibu Tangguh</option>
            </select>
        </div>

        <div class="row" style="display:flex; gap:15px;">
            <div class="col" style="flex:1;">
                <div class="form-group mb-3">
                    <label class="block mb-1 font-bold">Nilai Akhir</label>
                    <input type="number" step="0.01" name="nilai_akhir" class="form-control" required
                        value="<?= $data['nilai_akhir'] ?>">
                </div>
            </div>
            <div class="col" style="flex:1;">
                <div class="form-group mb-3">
                    <label class="block mb-1 font-bold">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="Lulus" <?= ($data['status'] == 'Lulus') ? 'selected' : '' ?>>Lulus</option>
                        <option value="Belum Lulus" <?= ($data['status'] == 'Belum Lulus') ? 'selected' : '' ?>>Belum Lulus
                        </option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group mb-3">
            <label class="block mb-1 font-bold">Link Ijazah</label>
            <input type="url" name="link_ijazah" class="form-control" value="<?= $data['link_ijazah'] ?>">
        </div>

        <div class="form-group mb-3" style="background: #f3f4f6; padding: 15px; border-radius: 8px;">
            <label class="block mb-1 font-bold">Ubah Password Siswa (Opsional)</label>
            <input type="password" name="password_baru" class="form-control"
                placeholder="Kosongkan jika tidak ingin mengubah password">
            <small class="text-muted">Isi hanya jika ingin mereset password siswa.</small>
        </div>

        <button type="submit" class="btn btn-primary btn-block w-100" style="margin-top: 1rem;">
            <i class="fas fa-save"></i> Update Data
        </button>
    </form>
</div>

<?php include '../../layout/footer.php'; ?>