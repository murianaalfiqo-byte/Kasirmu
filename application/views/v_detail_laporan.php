<!DOCTYPE html>
<html>
<head>
    <title>Kasirmu - Detail Transaksi</title>
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
        <div class="card p-4 shadow-sm" style="max-width: 800px;">
            <div class="d-flex justify-content-between align-items-center pb-3 border-bottom mb-4">
                <div>
                    <h4 class="font-weight-bold text-dark m-0"><i class="fas fa-receipt text-primary mr-2"></i>Detail Transaksi #<?php echo $penjualan->id; ?></h4>
                </div>
                <div>
                    <a href="<?php echo site_url('barang/laporan'); ?>" class="btn btn-light border font-weight-bold btn-sm px-3">Kembali</a>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <span class="text-muted small d-block uppercase font-weight-bold">Waktu Transaksi</span>
                    <h6 class="font-weight-bold text-dark"><?php echo $penjualan->tanggal; ?></h6>
                </div>
                <div class="col-md-6 text-md-right">
                    <span class="text-muted small d-block uppercase font-weight-bold">Jenis Pesanan</span>
                    <h6><span class="badge badge-info px-3 py-1"><?php echo $penjualan->jenis_pesanan; ?></span></h6>
                </div>
            </div>

            <div class="table-responsive mb-4">
                <table class="table table-bordered align-middle">
                    <thead class="thead-light">
                        <tr>
                            <th class="pl-3">No</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th class="pr-3 text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach($detail as $d): ?>
                        <tr>
                            <td class="pl-3"><?php echo $no++; ?></td>
                            <td class="font-weight-bold text-dark"><?php echo $d->nama_barang; ?></td>
                            <td><?php echo $d->jumlah; ?> Unit</td>
                            <td class="pr-3 text-right text-success font-weight-bold">Rp <?php echo number_format($d->subtotal); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="bg-light p-3 rounded text-right">
                <h5 class="font-weight-bold text-success mb-1">Total Belanja: Rp <?php echo number_format($penjualan->total_harga); ?></h5>
                <p class="text-muted small mb-0">Uang Tunai Dibayar: Rp <?php echo number_format($penjualan->bayar); ?> | Kembalian: Rp <?php echo number_format($penjualan->kembalian); ?></p>
            </div>
        </div>
    </div>
</body>
</html>