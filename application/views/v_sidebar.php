<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

<div class="sidebar d-flex flex-column justify-content-between p-4" id="sidebarMenu">
    <div>
        <div class="d-flex align-items-center mb-4 px-2">
            <div class="bg-gradient bg-primary rounded-circle d-flex align-items-center justify-content-center mr-3 shadow" style="width: 42px; height: 42px; background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);">
                <i class="fas fa-cube text-white"></i>
            </div>
            <div>
                <h5 class="text-white font-weight-bold m-0" style="letter-spacing: -0.5px;">Kasirmu<span class="text-indigo"></span></h5>
            </div>
        </div>

        <div class="text-muted small text-uppercase font-weight-bold px-2 mb-2" style="font-size: 10px; letter-spacing: 1px;">Navigasi Utama</div>
        <ul class="nav flex-column">
            <li class="nav-item mb-1">
                <a href="<?php echo site_url('barang/index'); ?>" class="nav-link px-3 py-2 rounded-lg <?php echo($this->uri->segment(2) == 'index' || $this->uri->segment(2) == '') ? 'active font-weight-bold shadow-sm' : ''; ?>">
                    <i class="fas fa-chart-pie mr-3 text-center" style="width: 20px;"></i> Dashboard
                </a>
            </li>
            <li class="nav-item mb-1">
                <a href="<?php echo site_url('barang/kasir'); ?>" class="nav-link px-3 py-2 rounded-lg <?php echo($this->uri->segment(2) == 'kasir') ? 'active font-weight-bold shadow-sm' : ''; ?>">
                    <i class="fas fa-terminal mr-3 text-center" style="width: 20px;"></i> Terminal POS
                </a>
            </li>
            <li class="nav-item mb-1">
                <a href="<?php echo site_url('barang/inventaris'); ?>" class="nav-link px-3 py-2 rounded-lg <?php echo($this->uri->segment(2) == 'inventaris' || $this->uri->segment(2) == 'tambah' || $this->uri->segment(2) == 'edit') ? 'active font-weight-bold shadow-sm' : ''; ?>">
                    <i class="fas fa-database mr-3 text-center" style="width: 20px;"></i> Inventaris
                </a>
            </li>
            <li class="nav-item mb-1">
                <a href="<?php echo site_url('barang/pelanggan'); ?>" class="nav-link px-3 py-2 rounded-lg <?php echo($this->uri->segment(2) == 'pelanggan' || $this->uri->segment(2) == 'tambah_pelanggan') ? 'active font-weight-bold shadow-sm' : ''; ?>">
                    <i class="fas fa-user-friends mr-3 text-center" style="width: 20px;"></i> Pelanggan CRM
                </a>
            </li>
            <li class="nav-item mb-1">
                <a href="<?php echo site_url('barang/laporan'); ?>" class="nav-link px-3 py-2 rounded-lg <?php echo($this->uri->segment(2) == 'laporan' || $this->uri->segment(2) == 'detail_laporan') ? 'active font-weight-bold shadow-sm' : ''; ?>">
                    <i class="fas fa-receipt mr-3 text-center" style="width: 20px;"></i> Laporan Keuangan
                </a>
            </li>
            <li class="nav-item mb-1">
                <a href="<?php echo site_url('barang/pengaturan'); ?>" class="nav-link px-3 py-2 rounded-lg <?php echo($this->uri->segment(2) == 'pengaturan') ? 'active font-weight-bold shadow-sm' : ''; ?>">
                    <i class="fas fa-sliders-h mr-3 text-center" style="width: 20px;"></i> Pengaturan Toko
                </a>
            </li>
        </ul>
    </div>

    <div class="p-3 rounded-lg border border-secondary bg-dark text-center shadow-sm">
        <div class="d-flex align-items-center justify-content-center mb-1">
            <span class="spinner-grow spinner-grow-sm text-indigo mr-2" role="status" aria-hidden="true" style="width: 8px; height: 8px; background-color: #a855f7;"></span>
            <span class="text-white small font-weight-bold">Mesin Kasir</span>
        </div>
        <small class="text-muted" style="font-size: 10px;">Aplikasi Kasir Siap</small>
    </div>
</div>

<style>
    body { font-family: 'Plus Jakarta Sans', sans-serif !important; background-color: #0b0f19 !important; color: #1e293b !important; }
    .sidebar { min-height: 100vh; background-color: #0f172a; position: fixed; width: 260px; top: 0; left: 0; z-index: 1000; border-right: 1px solid #1e293b; }
    .sidebar .nav-link { color: #94a3b8; transition: all 0.2s ease; font-size: 14px; }
    .sidebar .nav-link:hover { color: #fff; background-color: rgba(255, 255, 255, 0.04); }
    .sidebar .nav-link.active { color: #fff !important; background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%) !important; box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4) !important; }
    .main-content { margin-left: 260px; padding: 40px; background-color: #f8fafc; min-height: 100vh; border-top-left-radius: 28px; box-shadow: inset 10px 0 30px rgba(0,0,0,0.02); }
</style>