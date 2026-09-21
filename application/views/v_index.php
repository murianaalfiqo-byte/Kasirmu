<!DOCTYPE html>
<html>
<head>
    <title>Kasirmu - Manajemen Inventaris</title>
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
                <h2 class="font-weight-bold text-dark m-0">Manajemen Inventaris</h2>
                <p class="text-muted small m-0">Kelola stok, harga, dan data produk toko Anda dengan mudah.</p>
            </div>
            <div>
                <a href="<?php echo site_url('barang/tambah'); ?>" class="btn btn-primary font-weight-bold px-4 py-2 shadow-sm" style="background: #4f46e5; border-radius: 10px;">
                    <i class="fas fa-plus mr-2"></i> Tambah Barang Baru
                </a>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card card-stat bg-white border-left border-primary border-top-0 border-bottom-0 border-right-0 p-3">
                    <div class="card-body">
                        <div class="text-muted small text-uppercase font-weight-bold mb-1">Total Jenis Produk</div>
                        <h3 class="font-weight-bold text-primary mb-0"><?php echo isset($total_produk) ? $total_produk : 0; ?> <span class="small font-weight-normal text-muted">Item</span></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-stat bg-white border-left border-info border-top-0 border-bottom-0 border-right-0 p-3">
                    <div class="card-body">
                        <div class="text-muted small text-uppercase font-weight-bold mb-1">Total Stok Barang</div>
                        <h3 class="font-weight-bold text-info mb-0"><?php echo isset($total_stok) ? $total_stok : 0; ?> <span class="small font-weight-normal text-muted">Unit</span></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-stat bg-white border-left border-success border-top-0 border-bottom-0 border-right-0 p-3">
                    <div class="card-body">
                        <div class="text-muted small text-uppercase font-weight-bold mb-1">Valuasi Inventaris</div>
                        <h3 class="font-weight-bold text-success mb-0">Rp <?php echo isset($total_nilai) ? number_format($total_nilai) : 0; ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-white py-3 border-bottom">
                <h5 class="font-weight-bold text-dark m-0"><i class="fas fa-boxes mr-2 text-primary"></i>Daftar Katalog Produk</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th class="py-3 pl-4">No</th>
                                <th class="py-3">Nama Barang</th>
                                <th class="py-3">Kategori</th>
                                <th class="py-3">Harga Jual</th>
                                <th class="py-3">Stok</th>
                                <th class="py-3 text-center pr-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach($barang as $b): ?>
                            <tr>
                                <td class="align-middle pl-4 font-weight-bold"><?php echo $no++; ?></td>
                                <td class="align-middle font-weight-bold text-dark"><?php echo $b->nama_barang; ?></td>
                                <td class="align-middle"><span class="badge badge-light border text-muted px-2 py-1"><?php echo $b->kategori; ?></span></td>
                                <td class="align-middle text-success font-weight-bold">Rp <?php echo number_format($b->harga); ?></td>
                                <td class="align-middle"><?php echo $b->stok; ?> Unit</td>
                                <td class="align-middle text-center pr-4">
                                    <a href="<?php echo site_url('barang/edit/'.$b->id); ?>" class="btn btn-warning btn-sm text-white px-3 font-weight-bold mr-1" style="border-radius: 8px;"><i class="fas fa-edit mr-1"></i> Edit</a>
                                    <a href="<?php echo site_url('barang/hapus/'.$b->id); ?>" class="btn btn-danger btn-sm px-3 font-weight-bold" onclick="return confirm('Yakin ingin menghapus data ini?')" style="border-radius: 8px;"><i class="fas fa-trash-alt mr-1"></i> Hapus</a>
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