<!DOCTYPE html>
<html>
<head>
    <title>Kasirmu - Laporan Keuangan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .main-content { margin-left: 260px; padding: 40px; }
        .card { border: none; border-radius: 16px; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.03); background: #ffffff; }
    </style>
</head>
<body>
    <?php $this->load->view('v_sidebar'); ?>

    <div class="main-content">
        <div class="mb-4">
            <h2 class="font-weight-bold text-dark m-0">Laporan Keuangan & Omzet</h2>
            <p class="text-muted small m-0">Pantau seluruh riwayat transaksi dan total pendapatan bisnis Anda.</p>
        </div>

        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card bg-white border-left border-success border-top-0 border-bottom-0 border-right-0 p-3">
                    <div class="card-body">
                        <div class="text-muted small text-uppercase font-weight-bold mb-1">Total Pendapatan / Omzet Keseluruhan</div>
                        <h2 class="font-weight-bold text-success mb-0">Rp <?php echo number_format($total_omzet); ?></h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-white py-3 border-bottom">
                <h5 class="font-weight-bold text-dark m-0"><i class="fas fa-file-invoice-dollar mr-2 text-success"></i>Riwayat Transaksi Penjualan</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th class="py-3 pl-4">No Transaksi</th>
                                <th class="py-3">Tanggal Waktu</th>
                                <th class="py-3">Pelanggan</th>
                                <th class="py-3">Tipe Pesanan</th>
                                <th class="py-3">Total Belanja</th>
                                <th class="py-3 text-center pr-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($penjualan as $p): ?>
                            <tr>
                                <td class="align-middle pl-4 font-weight-bold text-dark">#<?php echo $p->id; ?></td>
                                <td class="align-middle text-muted"><?php echo $p->tanggal; ?></td>
                                <td class="align-middle font-weight-bold text-primary"><?php echo isset($p->nama_pelanggan) ? $p->nama_pelanggan : 'Umum'; ?></td>
                                <td class="align-middle"><span class="badge badge-info px-2 py-1"><?php echo $p->jenis_pesanan; ?></span></td>
                                <td class="align-middle text-success font-weight-bold">Rp <?php echo number_format($p->total_harga); ?></td>
                                <td class="align-middle text-center pr-4">
                                    <a href="<?php echo site_url('barang/detail_laporan/'.$p->id); ?>" class="btn btn-info btn-sm text-white px-3 font-weight-bold" style="border-radius: 8px;"><i class="fas fa-eye mr-1"></i> Detail</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>