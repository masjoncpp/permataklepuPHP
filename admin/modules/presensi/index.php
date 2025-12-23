<?php
include '../../../config/koneksi.php';
include '../../layout/header.php';

// Handle Toggle Status
if (isset($_POST['toggle_status'])) {
    $current_status = $_POST['current_status'];
    $new_status = ($current_status == 'buka') ? 'tutup' : 'buka';

    $stmt = mysqli_prepare($koneksi, "UPDATE pengaturan SET nilai = ? WHERE kunci = 'presensi_status'");
    mysqli_stmt_bind_param($stmt, "s", $new_status);
    mysqli_stmt_execute($stmt);

    // Redirect to avoid resubmission
    echo "<script>window.location.href='index.php';</script>";
    exit;
}

// Get Current Status
$query_setting = mysqli_query($koneksi, "SELECT nilai FROM pengaturan WHERE kunci = 'presensi_status'");
$setting = mysqli_fetch_assoc($query_setting);
$presensi_status = $setting['nilai'] ?? 'tutup';
?>

<div class="module-header">
    <div style="flex: 1;">
        <h2><i class="fas fa-calendar-check"></i> Data Presensi</h2>
    </div>
    <div style="display:flex; gap:10px; align-items: center;">
        <span style="font-weight: 600; color: #64748b;">Status Form: </span>
        <form method="POST" style="margin: 0;">
            <input type="hidden" name="current_status" value="<?= $presensi_status ?>">
            <button type="submit" name="toggle_status" class="btn"
                style="background: <?= $presensi_status == 'buka' ? '#10b981' : '#ef4444' ?>; color: white; min-width: 120px; border: none; cursor: pointer;">
                <i class="fas fa-<?= $presensi_status == 'buka' ? 'lock-open' : 'lock' ?>"></i>
                <?= strtoupper($presensi_status) ?>
            </button>
        </form>
    </div>
</div>

<div class="card"
    style="padding: 0; border-radius: 12px; overflow: hidden; border: 1px solid #e5e7eb; margin-top: 20px;">
    <div class="table-responsive">
        <table class="certificate-table" style="width: 100%; min-width: 700px;">
            <thead>
                <tr>
                    <th style="width: 5%; text-align:center;">No</th>
                    <th>Nama Lengkap</th>
                    <th>Alamat</th>
                    <th>Program</th>
                    <th>Waktu Input</th>
                    <th style="width: 10%; text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $query = mysqli_query($koneksi, "SELECT * FROM presensi ORDER BY id DESC");
                if (mysqli_num_rows($query) > 0) {
                    while ($data = mysqli_fetch_array($query)) {
                        ?>
                        <tr>
                            <td style="text-align:center;"><?= $no++ ?></td>
                            <td style="font-weight:600;"><?= htmlspecialchars($data['nama_lengkap']) ?></td>
                            <td><?= htmlspecialchars($data['alamat']) ?></td>
                            <td><span
                                    style="background:var(--secondary); color:var(--primary); padding: 4px 10px; border-radius: 12px; font-size: 0.85rem; font-weight: 600;"><?= htmlspecialchars($data['program']) ?></span>
                            </td>
                            <td><?= date('d M Y H:i', strtotime($data['tanggal'])) ?></td>
                            <td style="text-align:center;">
                                <a href="hapus.php?id=<?= $data['id'] ?>" class="table-action-btn btn-delete"
                                    style="background: #ef4444; color: #fff; padding: 6px 10px; border-radius: 6px;"><i
                                        class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo '<tr><td colspan="6" class="text-center p-4">Belum ada data presensi.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../../layout/footer.php'; ?>