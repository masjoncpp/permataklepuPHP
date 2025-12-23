<?php
include '../../../config/koneksi.php';
include '../../layout/header.php';
?>

<div class="mb-3">
    <a href="index.php" class="btn btn-outline" style="border:1px solid #ddd; padding:5px 10px; border-radius:5px;">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card" style="padding: 2rem; max-width: 600px; margin:0 auto;">
    <h3 class="mb-4">Input Data Peserta</h3>

    <form action="proses.php?aksi=tambah" method="POST" class="form-confirm">
        <div class="form-group mb-3">
            <label class="block mb-1 font-bold">Nama Peserta</label>
            <input type="text" name="nama_peserta" class="form-control" required placeholder="Nama Lengkap">
        </div>

        <div class="form-group mb-3">
            <label class="block mb-1 font-bold">Program Kelas</label>
            <select name="kelas" class="form-control" required>
                <option value="">-- Pilih Kelas --</option>
                <option value="Ibu Cerdas">Ibu Cerdas</option>
                <option value="Ibu Mandiri">Ibu Mandiri</option>
                <option value="Ibu Tangguh">Ibu Tangguh</option>
            </select>
        </div>

        <div class="row" style="display:flex; gap:15px;">
            <div class="col" style="flex:1;">
                <div class="form-group mb-3">
                    <label class="block mb-1 font-bold">Nilai Akhir</label>
                    <input type="number" step="0.01" name="nilai_akhir" class="form-control" required
                        placeholder="0-100">
                </div>
            </div>
            <div class="col" style="flex:1;">
                <div class="form-group mb-3">
                    <label class="block mb-1 font-bold">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="Lulus">Lulus</option>
                        <option value="Belum Lulus">Belum Lulus</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group mb-3">
            <label class="block mb-1 font-bold">Link Google Drive Ijazah (Opsional)</label>
            <input type="url" name="link_ijazah" class="form-control" placeholder="https://drive.google.com/...">
        </div>

        <button type="submit" class="btn btn-primary btn-block w-100" style="margin-top: 1rem;">
            <i class="fas fa-save"></i> Simpan Data
        </button>
    </form>
</div>

<?php include '../../layout/footer.php'; ?>