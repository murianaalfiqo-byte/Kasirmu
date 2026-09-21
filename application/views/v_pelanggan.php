<!DOCTYPE html>
<html>
<head>
    <title>Kasirmu Pro - Manajemen Pelanggan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .main-content { margin-left: 260px; padding: 40px; }
        .card { border: none; border-radius: 16px; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.03); background: #ffffff; }
        .form-control { border-radius: 10px; border: 1px solid #cbd5e1; padding: 10px 14px; font-size: 14px; }
    </style>
</head>
<body>
    <?php $this->load->view('v_sidebar'); ?>

    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="font-weight-bold text-dark m-0">Manajemen Pelanggan (CRM)</h2>
                <p class="text-muted small m-0">Kelola daftar data member atau pelanggan setia toko Anda.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card p-4 shadow-sm">
                    <h5 class="font-weight-bold mb-3"><i class="fas fa-user-plus text-primary mr-2"></i>Tambah Pelanggan Baru</h5>
                    <form action="<?php echo site_url('barang/tambah_pelanggan_aksi'); ?>" method="post">
                        <div class="form-group mb-3">
                            <label class="small font-weight-bold text-muted">Nama Pelanggan</label>
                            <input type="text" name="nama_pelanggan" class="form-control" placeholder="Nama lengkap..." required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="small font-weight-bold text-muted">No. Telepon / WhatsApp</label>
                            <input type="text" name="telepon" class="form-control" placeholder="Contoh: 08123456789">
                        </div>
                        <div class="form-group mb-4">
                            <label class="small font-weight-bold text-muted">Alamat</label>
                            <textarea name="alamat" class="form-control" rows="2" placeholder="Alamat singkat..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block font-weight-bold shadow-sm py-2" style="background: #4f46e5; border-radius: 10px;">
                            <i class="fas fa-save mr-2"></i> Simpan Pelanggan
                        </button>
                    </form>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-white py-3 border-bottom">
                        <h5 class="font-weight-bold text-dark m-0"><i class="fas fa-address-book text-primary mr-2"></i>Daftar Pelanggan Terdaftar</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="pl-4 py-3">No</th>
                                        <th class="py-3">Nama Pelanggan</th>
                                        <th class="py-3">Telepon</th>
                                        <th class="py-3">Alamat</th>
                                        <th class="text-center pr-4 py-3">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; foreach($pelanggan as $p): ?>
                                    <tr>
                                        <td class="pl-4 align-middle font-weight-bold"><?php echo $no++; ?></td>
                                        <td class="align-middle font-weight-bold text-dark"><?php echo $p->nama_pelanggan; ?></td>
                                        <td class="align-middle text-muted"><?php echo $p->telepon ?: '-'; ?></td>
                                        <td class="align-middle text-muted"><?php echo $p->alamat ?: '-'; ?></td>
                                        <td class="text-center pr-4 align-middle">
                                            <?php if($p->id != 1): ?>
                                            <a href="<?php echo site_url('barang/hapus_pelanggan/'.$p->id); ?>" class="btn btn-danger btn-sm font-weight-bold px-3" onclick="return confirm('Yakin ingin menghapus data pelanggan ini?')" style="border-radius: 8px;">
                                                <i class="fas fa-trash-alt mr-1"></i> Hapus
                                            </a>
                                            <?php else: ?>
                                            <span class="badge badge-secondary px-2 py-1">Default System</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>