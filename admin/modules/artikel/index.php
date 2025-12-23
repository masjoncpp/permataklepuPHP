<?php
include '../../../config/koneksi.php';
include '../../layout/header.php';
?>

<div class="module-header">
    <h2><i class="fas fa-newspaper"></i> Kelola Artikel</h2>
    <a href="tambah.php" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tulis Artikel
    </a>
</div>

<div class="card" style="padding: 0; border-radius: 12px; overflow: hidden; border: 1px solid #e5e7eb;">
    <div class="table-responsive">
        <table class="certificate-table" style="width: 100%; min-width: 700px;">
            <thead>
                <tr>
                    <th style="width: 5%; text-align:center;">No</th>
                    <th style="width: 10%;">Sampul</th>
                    <th style="width: 30%;">Judul Artikel</th>
                    <th style="width: 15%;">Kategori</th>
                    <th style="width: 15%;">Tanggal</th>
                    <th style="width: 15%; text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $query = mysqli_query($koneksi, "SELECT * FROM artikel ORDER BY tanggal DESC");

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
                                <img src="<?= $img_src ?>" style="width: 60px; height: 60px; object-fit: cover;">
                            </td>
                            <td>
                                <div style="font-weight:600; color:#111; margin-bottom:4px;"><?= $data['judul'] ?></div>
                                <div style="font-size:0.8rem; color:#888;"><?= substr(strip_tags($data['isi']), 0, 40) ?>...
                                </div>
                            </td>
                            <td><span class="badge"
                                    style="background:#e0e7ff; color:#4338ca; padding:5px 10px; border-radius:20px; font-size:0.75rem; font-weight:600;"><?= $data['kategori'] ?></span>
                            </td>
                            <td style="font-size:0.9rem;"><?= date('d M Y', strtotime($data['tanggal'])) ?></td>
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
                    echo '<tr><td colspan="6" class="text-center p-4">Belum ada artikel.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../../layout/footer.php'; ?>