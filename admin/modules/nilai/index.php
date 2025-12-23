<?php
include '../../../config/koneksi.php';
include '../../layout/header.php';
?>

<div class="module-header">
    <div style="flex: 1;">
        <h2><i class="fas fa-graduation-cap"></i> Kelola Nilai</h2>
    </div>
    <div style="display:flex; gap:10px;">
        <button onclick="document.getElementById('importModal').style.display='flex'" class="btn"
            style="background:#10b981; color:white;">
            <i class="fas fa-file-csv"></i> Import Excel/CSV
        </button>
        <a href="tambah.php" class="btn btn-primary">
            <i class="fas fa-plus"></i> Input Nilai
        </a>
    </div>
</div>

<div class="card" style="margin-bottom: 20px; padding: 1.5rem;">
    <form action="" method="GET" style="display: flex; gap: 10px;">
        <input type="text" name="q" class="form-control" placeholder="Cari nama peserta..."
            value="<?= isset($_GET['q']) ? $_GET['q'] : '' ?>" style="flex: 1;">
        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Cari</button>
        <?php if (isset($_GET['q'])): ?>
            <a href="index.php" class="btn btn-outline"
                style="border:1px solid #ddd; display: flex; align-items: center;">Reset</a>
        <?php endif; ?>
    </form>
</div>

<!-- Import Modal -->
<div id="importModal" class="sidebar-overlay"
    style="z-index:9999; display:none; align-items:center; justify-content:center; backdrop-filter: blur(8px); background: rgba(0,0,0,0.5);">
    <div class="card"
        style="width:90%; max-width:450px; position:relative; animation: slideIn 0.4s cubic-bezier(0.16, 1, 0.3, 1); border-radius: 24px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25); border: none; padding: 0; overflow: hidden;">

        <!-- Header -->
        <div
            style="background: linear-gradient(135deg, #5b21b6 0%, #7c3aed 100%); padding: 2rem 1.5rem; text-align: center; color: white; position: relative;">
            <button onclick="document.getElementById('importModal').style.display='none'"
                style="position: absolute; top: 15px; right: 15px; background: rgba(255,255,255,0.2); border: none; color: white; width: 32px; height: 32px; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: background 0.2s;">
                <i class="fas fa-times"></i>
            </button>
            <div
                style="width: 64px; height: 64px; background: rgba(255,255,255,0.2); border-radius: 20px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; backdrop-filter: blur(10px); box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                <i class="fas fa-file-csv" style="font-size: 1.8rem;"></i>
            </div>
            <h3 style="margin: 0; font-weight: 700; font-size: 1.25rem; letter-spacing: -0.025em;">Import Data Nilai
            </h3>
            <p style="margin: 0.5rem 0 0; opacity: 0.9; font-size: 0.9rem; font-weight: 400;">Upload file CSV untuk
                input data massal</p>
        </div>

        <div style="padding: 1.5rem;">
            <!-- Template Download -->
            <div
                style="background: #f8fafc; padding: 1rem; border-radius: 16px; border: 1px dashed #cbd5e1; display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem; gap: 1rem;">
                <div style="text-align: left;">
                    <p style="margin: 0; font-weight: 600; color: #334155; font-size: 0.85rem;">Belum punya format?</p>
                    <p style="margin: 0; font-size: 0.75rem; color: #64748b;">Download template resmi dulu.</p>
                </div>
                <a href="template_nilai.csv" download class="btn"
                    style="background: white; border: 1px solid #e2e8f0; color: #5b21b6; font-size: 0.8rem; padding: 8px 14px; border-radius: 10px; font-weight: 600; white-space: nowrap; box-shadow: 0 2px 4px rgba(0,0,0,0.05); transition: all 0.2s;">
                    <i class="fas fa-download" style="margin-right: 6px;"></i> Download
                </a>
            </div>

            <form action="proses.php?aksi=import" method="POST" enctype="multipart/form-data" class="form-confirm">
                <!-- Custom File Input -->
                <div class="form-group mb-4">
                    <label
                        style="display:block; margin-bottom:8px; font-weight: 600; color: #334155; font-size: 0.9rem;">Pilih
                        File CSV</label>
                    <label for="file_csv"
                        style="display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 2rem; border: 2px dashed #cbd5e1; border-radius: 16px; cursor: pointer; transition: all 0.3s; background: #f8fafc; min-height: 120px;"
                        onmouseover="this.style.borderColor='#7c3aed'; this.style.background='#f5f3ff'"
                        onmouseout="this.style.borderColor='#cbd5e1'; this.style.background='#f8fafc'">
                        <i class="fas fa-cloud-upload-alt"
                            style="font-size: 2rem; color: #94a3b8; margin-bottom: 10px; transition: color 0.3s;"></i>
                        <span style="color: #64748b; font-size: 0.85rem; font-weight: 500;">Klik untuk pilih file
                            CSV</span>
                        <input type="file" id="file_csv" name="file_csv" accept=".csv" required style="display: none;"
                            onchange="document.getElementById('fileName').textContent = this.files[0].name; document.getElementById('fileName').style.display='block';">
                        <span id="fileName"
                            style="margin-top: 10px; font-weight: 600; color: #7c3aed; font-size: 0.85rem; display: none; background: rgba(124, 58, 237, 0.1); padding: 4px 10px; border-radius: 6px;"></span>
                    </label>
                </div>

                <div style="display:flex; gap:12px; margin-top:20px;">
                    <button type="button" onclick="document.getElementById('importModal').style.display='none'"
                        class="btn"
                        style="flex: 1; background: white; color: #64748b; border: 1px solid #e2e8f0; font-weight: 600; padding: 12px; border-radius: 12px; transition: all 0.2s;">Batal</button>
                    <button type="submit" class="btn btn-primary"
                        style="flex: 1; padding: 12px; font-weight: 600; border-radius: 12px; box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3); border: none; background: linear-gradient(135deg, #5b21b6 0%, #7c3aed 100%); transition: transform 0.2s;">
                        Import Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="card" style="padding: 0; border-radius: 12px; overflow: hidden; border: 1px solid #e5e7eb;">
    <div class="table-responsive">
        <table class="certificate-table" style="width: 100%; min-width: 700px;">
            <thead>
                <tr>
                    <th style="width: 5%; text-align:center;">No</th>
                    <th>Nama Peserta</th>
                    <th>Kelas</th>
                    <th style="text-align:center;">Nilai</th>
                    <th style="text-align:center;">Status</th>
                    <th style="text-align:center;">Ijazah</th>
                    <th style="width: 15%; text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;

                // SEARCH & SORT LOGIC
                $q = "";
                if (isset($_GET['q'])) {
                    $q = $_GET['q'];
                    $searchTerm = "%" . $q . "%";
                    $stmt = mysqli_prepare($koneksi, "SELECT * FROM nilai WHERE nama_peserta LIKE ? ORDER BY id ASC");
                    mysqli_stmt_bind_param($stmt, "s", $searchTerm);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                } else {
                    $query = mysqli_query($koneksi, "SELECT * FROM nilai ORDER BY id ASC");
                    $result = $query; // Use $result consistently
                }

                if (mysqli_num_rows($result) > 0) {
                    while ($data = mysqli_fetch_array($result)) {
                        $statusBadge = ($data['status'] == 'Lulus')
                            ? '<span style="background:#dcfce7; color:#166534; padding:4px 12px; border-radius:20px; font-size:0.8rem; font-weight:bold;">Lulus</span>'
                            : '<span style="background:#fee2e2; color:#991b1b; padding:4px 12px; border-radius:20px; font-size:0.8rem; font-weight:bold;">Belum</span>';
                        ?>
                        <tr>
                            <td style="text-align:center;"><?= $no++ ?></td>
                            <td style="font-weight:600;"><?= $data['nama_peserta'] ?></td>
                            <td><?= $data['kelas'] ?></td>
                            <td style="text-align:center; font-weight:bold;"><?= $data['nilai_akhir'] ?></td>
                            <td style="text-align:center;"><?= $statusBadge ?></td>
                            <td style="text-align:center;">
                                <?php if (!empty($data['link_ijazah'])): ?>
                                    <a href="<?= $data['link_ijazah'] ?>" target="_blank"
                                        style="color:#2563eb; background:#eff6ff; padding:5px 10px; border-radius:6px; font-size:0.85rem; text-decoration:none;"><i
                                            class="fas fa-link"></i> Link</a>
                                <?php else: ?>
                                    <span style="color:#ccc;">-</span>
                                <?php endif; ?>
                            </td>
                            <td style="text-align:center;">
                                <a href="edit.php?id=<?= $data['id'] ?>" class="table-action-btn"
                                    style="background: #fbbf24; color: #fff;"><i class="fas fa-edit"></i></a>
                                <a href="proses.php?aksi=hapus&id=<?= $data['id'] ?>" class="table-action-btn btn-delete"
                                    style="background: #ef4444; color: #fff;"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo '<tr><td colspan="7" class="text-center p-4">Belum ada data nilai.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../../layout/footer.php'; ?>