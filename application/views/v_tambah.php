<!DOCTYPE html>
<html>
<head>
    <title>Kasirmu - Tambah Barang Baru</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body { background-color: #f3f4f6; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #1f2937; }
        .sidebar { min-height: 100vh; background-color: #0f172a; color: #fff; position: fixed; width: 260px; top: 0; left: 0; z-index: 1000; box-shadow: 4px 0 10px rgba(0,0,0,0.05); }
        .sidebar .nav-link { color: #94a3b8; transition: all 0.2s; }
        .sidebar .nav-link:hover { color: #fff; background-color: rgba(255,255,255,0.05); }
        .sidebar .nav-link.active { color: #fff !important; background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%) !important; box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4); }
        .main-content { margin-left: 260px; padding: 35px; }
        .card { border: none; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.03); }
    </style>
</head>
<body>
    <?php $this->load->view('v_sidebar'); ?>

    <div class="main-content">
        <div class="mb-4">
            <h2 class="font-weight-bold text-dark m-0">Tambah Barang Baru</h2>
            <p class="text-muted small m-0">Masukkan detail produk baru ke dalam sistem inventaris.</p>
        </div>
        
        <div class="card p-4 shadow-sm" style="max-width: 650px;">
            <form action="<?php echo site_url('barang/tambah_aksi'); ?>" method="post">
                <div class="form-group mb-3">
                    <label class="font-weight-bold text-dark">Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control" placeholder="Contoh: Kopi Susu Aren" required>
                </div>
                <div class="form-group mb-3">
                    <label class="font-weight-bold text-dark">Kategori</label>
                    <input type="text" name="kategori" class="form-control" placeholder="Contoh: Minuman, Makanan, Snack" required>
                </div>
                <div class="form-group mb-3">
                    <label class="font-weight-bold text-dark">Harga Jual (Rp)</label>
                    <input type="number" name="harga" class="form-control" placeholder="Contoh: 15000" required>
                </div>
                <div class="form-group mb-4">
                    <label class="font-weight-bold text-dark">Stok Awal</label>
                    <input type="number" name="stok" class="form-control" placeholder="Contoh: 100" required>
                </div>
                <div class="d-flex">
                    <button type="submit" class="btn btn-primary font-weight-bold px-4 py-2 shadow-sm mr-2"><i class="fas fa-save mr-2"></i> Simpan Barang</button>
                    <a href="<?php echo site_url('barang/inventaris'); ?>" class="btn btn-light border font-weight-bold px-4 py-2 text-dark">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>