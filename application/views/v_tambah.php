<!DOCTYPE html>
<html>
<head>
    <title>Tambah Barang - Kasirmu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif !important; background: #f8fafc; color: #1e293b; }
        .card { border: none; border-radius: 16px; box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.05); background: #ffffff; }
        .form-control { border-radius: 10px; border: 1px solid #cbd5e1; padding: 10px 14px; font-size: 13px; background: #fdfdfe; }
        .form-control:focus { box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15); border-color: #6366f1; background: #ffffff; }
    </style>
</head>
<body>
    <?php $this->load->view('v_sidebar'); ?>

    <div class="container-fluid py-4" style="margin-left: 240px; width: calc(100% - 240px);">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card p-4">
                    <h3 class="font-weight-bold text-dark mb-1">Tambah Barang Baru</h3>
                    <p class="text-muted small mb-4">Masukkan detail produk dan foto ke dalam sistem inventaris.</p>

                    <form action="<?php echo site_url('barang/tambah_aksi'); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold small text-dark">Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control" placeholder="Contoh: Kopi Susu Aren" required>
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold small text-dark">Kategori</label>
                            <input type="text" name="kategori" class="form-control" placeholder="Contoh: Minuman, Makanan, Snack" required>
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold small text-dark">Harga Jual (Rp)</label>
                            <input type="number" name="harga" class="form-control" placeholder="Contoh: 15000" required>
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold small text-dark">Stok Awal</label>
                            <input type="number" name="stok" class="form-control" placeholder="Contoh: 100" required>
                        </div>

                        <div class="form-group mb-4">
                            <label class="font-weight-bold small text-dark">Foto / Gambar Produk</label>
                            <input type="file" name="gambar" class="form-control-file border p-2 rounded w-100" accept="image/*">
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="<?php echo site_url('barang/inventaris'); ?>" class="btn btn-light border px-4 font-weight-bold" style="border-radius: 10px;">Batal</a>
                            <button type="submit" class="btn btn-primary px-4 font-weight-bold shadow-sm" style="border-radius: 10px; background: #6366f1; border: none;">
                                <i class="fas fa-save mr-1"></i> Simpan Barang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>