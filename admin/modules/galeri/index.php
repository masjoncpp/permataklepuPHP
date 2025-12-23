<?php
include '../../../config/koneksi.php';
include '../../layout/header.php';
?>

<div class="module-header">
    <h2><i class="fas fa-images"></i> Kelola Galeri</h2>
    <a href="tambah.php" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Foto
    </a>
</div>

<div class="card" style="padding: 0; border-radius: 12px; overflow: hidden; border: 1px solid #e5e7eb;">
    <div class="table-responsive">
        <table class="certificate-table" style="width: 100%; min-width: 600px;">
            <thead>
                <tr>
                    <th style="width: 5%; text-align:center;">No</th>
                    <th style="width: 12%;">Foto</th>
                    <th>Judul Kegiatan</th>
                    <th style="width: 20%;">Tanggal</th>
                    <th style="width: 15%; text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $query = mysqli_query($koneksi, "SELECT * FROM galeri ORDER BY tanggal DESC");

                if (mysqli_num_rows($query) > 0) {
                    while ($data = mysqli_fetch_array($query)) {
                        $img_src = BASE_URL . "assets/uploads/" . $data['gambar'];
                        if (!file_exists("../../../assets/uploads/" . $data['gambar']) || empty($data['gambar'])) {
                            $img_src = BASE_URL . "assets/img/" . $data['gambar'];
                        }
                        ?>
                        <tr>
                            <td style="text-align:center;"><?= $no++ ?></td>
                            <td>
                                <img src="<?= $img_src ?>" style="width: 70px; height: 50px; object-fit: cover;">
                            </td>
                            <td><b><?= $data['judul'] ?></b></td>
                            <td><span
                                    style="background:#f3f4f6; padding:4px 8px; border-radius:4px; font-size:0.85rem;"><?= date('d M Y', strtotime($data['tanggal'])) ?></span>
                            </td>
                            <td style="text-align:center;">
                                <a href="edit.php?id=<?= $data['id'] ?>" class="table-action-btn"
                                    style="background: #fbbf24; color: #fff;"><i class="fas fa-edit"></i></a>
                                <a href="proses.php?aksi=hapus&id=<?= $data['id'] ?>&gambar=<?= $data['gambar'] ?>"
                                    class="table-action-btn btn-delete" style="background: #ef4444; color: #fff;"><i
                                        class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php
                    }
                } else {
                    echo '<tr><td colspan="5" class="text-center p-4">Belum ada foto galeri.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../../layout/footer.php'; ?>