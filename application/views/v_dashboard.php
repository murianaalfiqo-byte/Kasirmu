<!DOCTYPE html>
<html>
<head>
    <title>Kasirmu Pro - Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .main-content { margin-left: 260px; padding: 40px; }
        .card { border: none; border-radius: 16px; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.03); background: #ffffff; }
        .card-stat:hover { transform: translateY(-3px); transition: transform 0.2s; }
    </style>
</head>
<body>
    <?php $this->load->view('v_sidebar'); ?>

    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="font-weight-bold text-dark m-0">Dashboard Pro</h2>
                <p class="text-muted small m-0">Analisis bisnis dan pemantauan inventaris real-time.</p>
            </div>
            <div>
                <a href="<?php echo site_url('barang/kasir'); ?>" class="btn btn-primary font-weight-bold px-4 py-2 shadow-sm" style="border-radius: 10px; background: #4f46e5;">
                    <i class="fas fa-cash-register mr-2"></i> Buka Kasir POS
                </a>
            </div>
        </div>

        <?php if(!empty($stok_menipis)): ?>
        <div class="alert alert-warning border-0 shadow-sm rounded-lg mb-4 d-flex align-items-center justify-content-between p-3" style="background: #fffbeb; color: #92400e;">
            <div>
                <i class="fas fa-exclamation-triangle mr-2 fa-lg"></i>
                <strong>Perhatian!</strong> Terdapat <strong><?php echo count($stok_menipis); ?> produk</strong> dengan stok menipis (&le; 5 unit). Segera lakukan restock!
            </div>
            <a href="<?php echo site_url('barang/inventaris'); ?>" class="btn btn-sm btn-warning font-weight-bold shadow-sm">Cek Inventaris</a>
        </div>
        <?php endif; ?>
        
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card card-stat bg-white border-left border-primary border-top-0 border-bottom-0 border-right-0 p-3">
                    <div class="card-body">
                        <div class="text-muted small text-uppercase font-weight-bold mb-1">Total Omzet Penjualan</div>
                        <h3 class="font-weight-bold text-primary mb-0">Rp <?php echo number_format($total_omzet); ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-stat bg-white border-left border-success border-top-0 border-bottom-0 border-right-0 p-3">
                    <div class="card-body">
                        <div class="text-muted small text-uppercase font-weight-bold mb-1">Total Transaksi Selesai</div>
                        <h3 class="font-weight-bold text-success mb-0"><?php echo $total_transaksi; ?> <span class="small font-weight-normal text-muted">Transaksi</span></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-stat bg-white border-left border-info border-top-0 border-bottom-0 border-right-0 p-3">
                    <div class="card-body">
                        <div class="text-muted small text-uppercase font-weight-bold mb-1">Jenis Produk Terdaftar</div>
                        <h3 class="font-weight-bold text-info mb-0"><?php echo $total_produk; ?> <span class="small font-weight-normal text-muted">Item</span></h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card p-4">
                    <h5 class="font-weight-bold mb-3 text-dark"><i class="fas fa-rocket text-primary mr-2"></i>Fitur Pro Mode Aktif</h5>
                    <p class="text-muted small">Sistem Anda kini dilengkapi dengan pencarian instan, filter kategori produk, peringatan otomatis stok menipis, serta manajemen pelanggan CRM.</p>
                    <hr>
                    <div class="d-flex">
                        <a href="<?php echo site_url('barang/kasir'); ?>" class="btn btn-primary font-weight-bold px-4 py-2 mr-2 shadow-sm" style="border-radius: 10px; background: #4f46e5;"><i class="fas fa-shopping-cart mr-2"></i> Kasir POS</a>
                        <a href="<?php echo site_url('barang/pelanggan'); ?>" class="btn btn-light border font-weight-bold px-4 py-2 text-dark" style="border-radius: 10px;"><i class="fas fa-users mr-2"></i> Data Pelanggan</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-4">
                    <h5 class="font-weight-bold mb-3 text-dark"><i class="fas fa-fire text-danger mr-2"></i>Produk Terlaris</h5>
                    <ul class="list-group list-group-flush">
                        <?php if(!empty($produk_terlaris)): foreach($produk_terlaris as $pt): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 bg-transparent">
                            <span class="font-weight-bold text-dark" style="font-size: 13px;"><?php echo $pt->nama_barang; ?></span>
                            <span class="badge badge-success px-2 py-1"><?php echo $pt->total_terjual; ?> terjual</span>
                        </li>
                        <?php endforeach; else: ?>
                        <div class="text-center py-3 text-muted small">Belum ada transaksi tercatat.</div>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
</html>