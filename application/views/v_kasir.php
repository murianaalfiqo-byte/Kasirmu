<!DOCTYPE html>
<html>
<head>
    <title>Kasirmu - Apex POS Pro v19.7</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        html, body { height: 100vh; height: 100dvh; overflow: hidden; background: #0f172a !important; font-family: 'Plus Jakarta Sans', sans-serif !important; color: #1e293b; margin: 0; -webkit-text-size-adjust: 100%; }

        /* SIDEBAR & OVERLAY STYLING */
        .sidebar-overlay { display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(2px); z-index: 1045; }
        .sidebar-overlay.show { display: block !important; }

        .sidebar { position: fixed !important; top: 0; left: 0; bottom: 0; width: 260px !important; z-index: 1050 !important; transform: translateX(-100%) !important; transition: transform 0.3s ease-in-out !important; box-shadow: 15px 0 35px rgba(0,0,0,0.6); background: #0f172a !important; }
        .sidebar.show { transform: translateX(0) !important; }

        .main-content { display: flex; flex-direction: column; height: 100vh; height: 100dvh; padding: 10px !important; margin-left: 0 !important; background-color: #f1f5f9; overflow: hidden; width: 100%; }
        @media (min-width: 992px) { .main-content { padding: 20px !important; border-top-left-radius: 24px; border-bottom-left-radius: 24px; box-shadow: -10px 0 30px rgba(0,0,0,0.3); } }

        .pos-topbar { flex-shrink: 0; background: #ffffff; padding: 10px 14px; border-radius: 14px; box-shadow: 0 2px 10px rgba(0,0,0,0.03); margin-bottom: 10px; display: flex; justify-content: space-between; align-items: center; border: 1px solid #e2e8f0; }

        .app-row { flex: 1; min-height: 0; display: flex; position: relative; overflow: hidden; margin: 0; }

        .catalog-panel, .cart-panel { display: flex; flex-direction: column; height: 100%; width: 100%; padding: 0 4px; }

        @media (max-width: 991.98px) {
            .catalog-panel, .cart-panel { height: calc(100vh - 125px); height: calc(100dvh - 125px); position: absolute; top: 0; left: 0; right: 0; bottom: 0; padding: 0; background: #f1f5f9; }
            .cart-panel { display: none; padding-bottom: 60px; }
            .cart-panel.mobile-show { display: flex; z-index: 10; }
            .catalog-panel.mobile-hide { display: none; }
        }

        .card { flex: 1; display: flex; flex-direction: column; min-height: 0; overflow: hidden; border: none; border-radius: 14px; box-shadow: 0 4px 20px -4px rgba(0, 0, 0, 0.05); background: #ffffff; margin-bottom: 0 !important; }
        .card-header, .search-area, .bottom-fixed-area { flex-shrink: 0; }

        .scroll-area { flex: 1; min-height: 0; overflow-y: auto; padding-bottom: 15px; -webkit-overflow-scrolling: touch; }
        .cart-items-scroll { flex: 1; min-height: 0; max-height: 160px; overflow-y: auto; padding-right: 4px; -webkit-overflow-scrolling: touch; }
        @media (min-width: 992px) { .cart-items-scroll { max-height: 240px; } }

        .product-card { transition: all 0.15s ease; border-radius: 12px; border: 1px solid #e2e8f0; background: #ffffff; cursor: pointer; position: relative; overflow: hidden; }
        .product-card:active { transform: scale(0.97); background: #f8fafc; }
        @media (min-width: 992px) {
            .product-card:hover { transform: translateY(-3px); box-shadow: 0 10px 25px -5px rgba(99, 102, 241, 0.2); border-color: #6366f1 !important; }
        }
        .product-img-wrapper { width: 100%; height: 100px; background: linear-gradient(135deg, #e0e7ff 0%, #f3e8ff 100%); border-top-left-radius: 11px; border-top-right-radius: 11px; display: flex; align-items: center; justify-content: center; overflow: hidden; }
        @media (min-width: 992px) { .product-img-wrapper { height: 115px; } }
        .product-img-wrapper img { width: 100%; height: 100%; object-fit: cover; }
        .product-img-placeholder { font-size: 24px; color: #6366f1; }

        .form-control { border-radius: 8px; border: 1px solid #cbd5e1; padding: 8px 12px; font-size: 14px; background: #ffffff; }
        .form-control:focus { box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15); border-color: #6366f1; }
        .btn-pill { border-radius: 20px; font-size: 12px; font-weight: 600; padding: 6px 14px; margin-right: 6px; }
        .quick-cash-btn { font-size: 12px; font-weight: 700; border-radius: 6px; padding: 8px 4px; background: #e0e7ff; color: #4338ca; border: none; flex: 1; margin: 0 2px; }

        .hotkey-badge { font-size: 9px; background: #1e1b4b; color: #fff; padding: 2px 5px; border-radius: 4px; margin-left: 4px; font-weight: 700; }
        .change-box { background: #f8fafc; border-radius: 8px; padding: 8px 12px; margin-top: 4px; border: 1px dashed #cbd5e1; }
        .gradient-header { background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%) !important; color: #ffffff !important; border-top-left-radius: 14px; border-top-right-radius: 14px; }
        .view-mode-btn { background: #f1f5f9; border: 1px solid #cbd5e1; color: #475569; font-size: 12px; font-weight: 600; border-radius: 8px; padding: 6px 10px; }
        .view-mode-btn.active { background: #6366f1; color: #ffffff; border-color: #6366f1; }

        .mobile-bottom-nav { position: fixed; bottom: 0; left: 0; right: 0; background: #ffffff; box-shadow: 0 -4px 20px rgba(0,0,0,0.1); display: flex; justify-content: space-around; z-index: 1040; padding: 8px 8px; border-top: 1px solid #e2e8f0; }
        .mobile-bottom-nav .nav-item { flex: 1; text-align: center; border: none; background: none; color: #64748b; font-size: 12px; font-weight: 700; padding: 8px 0; border-radius: 10px; transition: all 0.2s; }
        .mobile-bottom-nav .nav-item i { font-size: 18px; margin-bottom: 3px; display: block; }
        .mobile-bottom-nav .nav-item.active { color: #4f46e5; background: #e0e7ff; }
        @media (min-width: 992px) { .mobile-bottom-nav { display: none !important; } }
    </style>
</head>
<body>
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    <?php
        $this->load->view('v_sidebar');
        $cart_data  = $this->session->userdata('cart');
        $cart_count = ! empty($cart_data) ? count($cart_data) : 0;
    ?>

    <div class="main-content">
        <div class="pos-topbar">
            <div class="d-flex align-items-center">
                <button class="btn btn-dark btn-sm mr-2 shadow-sm" onclick="toggleSidebar()" style="background: #0f172a; border-radius: 10px; width: 40px; height: 40px;">
                    <i class="fas fa-bars"></i>
                </button>
                <div>
                    <h5 class="font-weight-bold text-dark m-0" style="font-size: 15px;">Kasirmu POS</h5>
                    <span class="text-muted d-none d-sm-inline" style="font-size: 11px;">Shortcut: [F1] Cari | [F2] Bayar | [F9] Pas | [F10] Eksekusi</span>
                </div>
            </div>
            <div class="d-flex align-items-center">
                <button type="button" class="btn btn-outline-secondary btn-sm mr-2 font-weight-bold shadow-sm d-none d-sm-inline-block" onclick="openCashDrawer()" style="border-radius: 10px; font-size: 12px; border-color: #cbd5e1;">
                    <i class="fas fa-cash-register text-success mr-1"></i> Buka Laci [F3]
                </button>
                <span class="badge badge-pill badge-primary px-3 py-2 font-weight-bold shadow-sm" style="background: #6366f1; font-size: 12px;">
                    <i class="fas fa-bolt mr-1"></i> Online
                </span>
            </div>
        </div>

        <div class="app-row">
            <div class="col-12 col-lg-7 catalog-panel px-1 px-lg-2" id="catalogPanel">
                <div class="card">
                    <div class="card-header bg-white py-3 px-3 border-bottom-0 d-flex justify-content-between align-items-center flex-wrap">
                        <div>
                            <h6 class="font-weight-bold text-dark m-0" style="font-size: 14px;"><i class="fas fa-th text-primary mr-1"></i> Katalog Produk</h6>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="btn-group btn-group-sm" role="group">
                                <button type="button" id="btnModeGrid" class="view-mode-btn active" onclick="setCatalogView('grid')">Grid</button>
                                <button type="button" id="btnModeCompact" class="view-mode-btn" onclick="setCatalogView('compact')">List</button>
                            </div>
                        </div>
                    </div>

                    <div class="search-area px-3 pb-2">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-light border-right-0" style="border-radius: 8px 0 0 8px;"><i class="fas fa-search text-muted"></i></span>
                            </div>
                            <input type="text" id="searchProduct" class="form-control border-left-0 bg-light" placeholder="Cari nama barang / barcode... [F1]" onkeyup="filterProducts()" onkeypress="handleSearchEnter(event)">
                        </div>
                        <div class="d-flex overflow-auto pb-1" style="-webkit-overflow-scrolling: touch;">
                            <button class="btn btn-sm btn-dark btn-pill active flex-shrink-0" onclick="filterCategory('semua', this)" style="background: #0f172a;">Semua</button>
                            <?php foreach ($kategori as $kat): ?>
                            <button class="btn btn-sm btn-light border btn-pill text-muted flex-shrink-0" onclick="filterCategory('<?php echo strtolower($kat->kategori); ?>', this)"><?php echo ucfirst($kat->kategori); ?></button>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="scroll-area px-3 pt-1">
                        <div class="row" id="productList">
                            <?php foreach ($barang as $b): ?>
                            <div class="col-6 col-md-4 mb-3 px-1 product-item" data-id="<?php echo $b->id; ?>" data-name="<?php echo strtolower($b->nama_barang); ?>" data-category="<?php echo strtolower($b->kategori); ?>">

                                <form action="<?php echo site_url('barang/tambah_cart'); ?>" method="post" id="form_prod_<?php echo $b->id; ?>">
                                    <input type="hidden" name="id_barang" value="<?php echo $b->id; ?>">
                                    <input type="hidden" name="qty" value="1">
                                </form>

                                <div class="card product-card h-100" onclick="document.getElementById('form_prod_<?php echo $b->id; ?>').submit(); playScanBeep();">
                                    <div class="product-img-wrapper product-visual-element">
                                        <?php if (! empty($b->gambar)): ?>
                                            <img src="<?php echo base_url('uploads/' . $b->gambar); ?>" alt="<?php echo $b->nama_barang; ?>">
                                        <?php else: ?>
                                            <div class="product-img-placeholder"><i class="fas fa-box-open"></i></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="card-body text-center d-flex flex-column justify-content-center p-2">
                                        <h6 class="card-title font-weight-bold text-dark mb-1" style="font-size: 13px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo $b->nama_barang; ?></h6>
                                        <span class="badge badge-pill badge-light text-muted border px-2 mb-1 mx-auto" style="font-size: 9px;"><?php echo $b->kategori; ?></span>
                                        <div class="text-primary font-weight-bold" style="font-size: 13px; color: #6366f1 !important;">Rp <?php echo number_format($b->harga); ?></div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-5 cart-panel px-1 px-lg-2" id="cartPanel">
                <div class="card h-100 d-flex flex-column">
                    <div class="card-header gradient-header py-3 px-3 font-weight-bold d-flex justify-content-between align-items-center">
                        <span style="font-size: 14px;"><i class="fas fa-shopping-bag mr-1 text-warning"></i> Keranjang Belanja</span>
                        <span class="badge badge-pill badge-warning text-dark px-2 font-weight-bold" style="font-size: 10px;">POS Terminal</span>
                    </div>

                    <div class="px-3 pt-2 pb-2 bg-light border-bottom">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white text-muted" style="font-size: 12px;"><i class="fas fa-user-tag"></i></span>
                            </div>
                            <input type="text" form="checkoutForm" name="id_pelanggan" id="inputPelanggan" list="listPelanggan" class="form-control font-weight-bold bg-white" placeholder="Pilih Pelanggan (Opsional)..." autocomplete="off" style="font-size: 13px;">
                            <datalist id="listPelanggan">
                                <?php foreach ($pelanggan as $plg): ?>
                                <option value="<?php echo $plg->id; ?> - <?php echo $plg->nama_pelanggan; ?>">
                                <?php endforeach; ?>
                            </datalist>
                        </div>
                    </div>

                    <div class="card-body p-3 d-flex flex-column justify-content-between flex-grow-1" style="overflow: hidden;">

                        <div class="cart-items-scroll mb-2">
                            <table class="table table-sm align-middle mb-0">
                                <thead>
                                    <tr class="text-muted small border-top-0" style="font-size: 11px;">
                                        <th>Item</th>
                                        <th>Subtotal</th>
                                        <th class="text-center" style="width: 70px;">Qty</th>
                                        <th class="text-right" style="width: 65px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $subtotal_raw = 0;
                                        if (! empty($cart_data)):
                                            foreach ($cart_data as $item):
                                                $subtotal_raw += $item['subtotal'];
                                    ?>
                                    <tr>
                                        <td class="align-middle">
                                            <div class="font-weight-bold text-dark" style="font-size: 12px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 95px;"><?php echo $item['nama']; ?></div>
                                            <small class="text-muted" style="font-size: 10px;">Rp <?php echo number_format($item['harga']); ?></small>
                                        </td>
                                        <td class="align-middle font-weight-bold text-success" style="font-size: 12px;">Rp <?php echo number_format($item['subtotal']); ?></td>
                                        <td class="align-middle text-center">
                                            <form action="<?php echo site_url('barang/set_cart_qty/' . $item['id']); ?>" method="post">
                                                <input type="number" name="qty" value="<?php echo $item['qty']; ?>" min="1" class="form-control text-center p-0 font-weight-bold" style="height: 32px; font-size: 13px;" onchange="this.form.submit()">
                                            </form>
                                        </td>
                                        <td class="align-middle text-right">
                                            <a href="<?php echo site_url('barang/hapus_cart/' . $item['id']); ?>" class="btn btn-danger btn-sm text-white px-2 py-1 shadow-sm" style="font-size: 11px; border-radius: 6px;" title="Hapus">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach;else: ?>
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">
                                            <i class="fas fa-shopping-basket fa-2x text-black-50 mb-2"></i><br>
                                            <span class="small font-weight-bold" style="font-size: 12px;">Keranjang kosong</span>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        <form action="<?php echo site_url('barang/proses_checkout'); ?>" method="post" id="checkoutForm" onsubmit="return false;" class="bottom-fixed-area mt-auto">
                            <input type="hidden" id="rawSubtotal" value="<?php echo $subtotal_raw; ?>">

                            <input type="hidden" name="jenis_pesanan" value="Offline / Toko">
                            <input type="hidden" name="catatan" value="">

                            <div class="bg-light p-2 rounded border mb-2" style="font-size: 12px;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="font-weight-bold text-dark text-uppercase" style="font-size: 12px;">Grand Total:</span>
                                    <span class="font-weight-bold text-success h5 m-0">Rp <span id="lblGrandTotal">0</span></span>
                                </div>
                            </div>

                            <div class="form-group mb-2">
                                <label class="small font-weight-bold text-muted mb-1" style="font-size: 11px;">Metode Pembayaran</label>
                                <select name="metode_pembayaran" id="metodeBayar" class="form-control font-weight-bold py-0 mb-1" style="height: 34px; font-size: 12px;" onchange="toggleBayar()">
                                    <option value="Tunai">Tunai (Cash)</option>
                                    <option value="QRIS">QRIS / E-Wallet</option>
                                    <option value="Transfer Bank">Transfer Bank</option>
                                </select>
                            </div>

                            <div class="form-group mb-2" id="groupBayar">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <label class="small font-weight-bold text-dark m-0" style="font-size: 11px;">Nominal Bayar <span class="badge badge-dark">[F2]</span></label>
                                    <div class="d-flex w-50 justify-content-end">
                                        <button type="button" class="quick-cash-btn" onclick="setCashExact()">Pas</button>
                                        <button type="button" class="quick-cash-btn" onclick="setCashVal(20000)">20k</button>
                                        <button type="button" class="quick-cash-btn" onclick="setCashVal(50000)">50k</button>
                                        <button type="button" class="quick-cash-btn" onclick="setCashVal(100000)">100k</button>
                                    </div>
                                </div>
                                <input type="text" name="bayar" id="inputBayar" class="form-control font-weight-bold text-primary text-center shadow-sm" style="height: 44px; font-size: 18px; border-radius: 8px;" placeholder="Nominal Bayar..." onkeyup="formatRupiah(this); calculateChange();" autocomplete="off" required>

                                <div class="change-box d-flex justify-content-between align-items-center py-2 px-2 mt-1">
                                    <span class="font-weight-bold text-muted" style="font-size: 12px;">Kembalian:</span>
                                    <span class="font-weight-bold h6 m-0 text-dark" id="lblKembalian" style="font-size: 14px;">Rp 0</span>
                                </div>
                            </div>

                            <button type="button" id="btnSubmitPayment" onclick="lakukanCheckout()" class="btn btn-success btn-block font-weight-bold shadow-sm py-2" style="border-radius: 8px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none; font-size: 13px;" <?php echo empty($cart_data) ? 'disabled style="opacity: 0.5;"' : ''; ?>>
                                <i class="fas fa-check-circle mr-1"></i> Eksekusi Pembayaran <span class="hotkey-badge" style="background:#047857; font-size:10px;">F10</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mobile-bottom-nav">
        <button id="navKatalog" class="nav-item active" onclick="switchMobileTab('katalog')">
            <i class="fas fa-box"></i> Katalog
        </button>
        <button id="navKeranjang" class="nav-item" onclick="switchMobileTab('keranjang')">
            <i class="fas fa-shopping-cart"></i> Keranjang
            <span class="badge badge-danger badge-pill ml-1" style="font-size: 10px; vertical-align: top;"><?php echo $cart_count; ?></span>
        </button>
    </div>

    <script>
        let currentGrandTotal = 0;

        function switchMobileTab(tab) {
            let catalog = document.getElementById('catalogPanel');
            let cart = document.getElementById('cartPanel');
            let btnKat = document.getElementById('navKatalog');
            let btnKer = document.getElementById('navKeranjang');

            if(tab === 'keranjang') {
                catalog.classList.add('mobile-hide');
                cart.classList.add('mobile-show');
                btnKat.classList.remove('active');
                btnKer.classList.add('active');
            } else {
                catalog.classList.remove('mobile-hide');
                cart.classList.remove('mobile-show');
                btnKat.classList.add('active');
                btnKer.classList.remove('active');
            }
        }

        function setCatalogView(mode) {
            let elements = document.getElementsByClassName('product-visual-element');
            let btnGrid = document.getElementById('btnModeGrid');
            let btnCompact = document.getElementById('btnModeCompact');

            if (mode === 'compact') {
                for (let i = 0; i < elements.length; i++) { elements[i].style.display = 'none'; }
                btnCompact.classList.add('active'); btnGrid.classList.remove('active');
            } else {
                for (let i = 0; i < elements.length; i++) { elements[i].style.display = 'flex'; }
                btnGrid.classList.add('active'); btnCompact.classList.remove('active');
            }
        }

        function openCashDrawer() {
            playScanBeep();
            let printWindow = window.open('', '', 'width=100,height=100');
            printWindow.document.write('<html><body><script>window.print();window.close();<\/script></body></html>');
            printWindow.document.close();
        }

        function playScanBeep() {
            try {
                let ctx = new (window.AudioContext || window.webkitAudioContext)();
                let osc = ctx.createOscillator();
                let gain = ctx.createGain();
                osc.type = 'sine'; osc.frequency.setValueAtTime(1200, ctx.currentTime);
                gain.gain.setValueAtTime(0.1, ctx.currentTime);
                osc.connect(gain); gain.connect(ctx.destination);
                osc.start(); osc.stop(ctx.currentTime + 0.1);
            } catch(e) {}
        }

        function playChaChing() {
            try {
                let ctx = new (window.AudioContext || window.webkitAudioContext)();
                let now = ctx.currentTime;
                let osc1 = ctx.createOscillator(); let gain1 = ctx.createGain();
                osc1.type = 'triangle'; osc1.frequency.setValueAtTime(987.77, now);
                gain1.gain.setValueAtTime(0.15, now); gain1.gain.exponentialRampToValueAtTime(0.001, now + 0.3);
                osc1.connect(gain1); gain1.connect(ctx.destination); osc1.start(now); osc1.stop(now + 0.3);
            } catch(e) {}
        }

        function lakukanCheckout() {
            let input = document.getElementById('inputBayar');
            if(input) {
                input.value = input.value.replace(/\./g, '');
            }
            let submitBtn = document.getElementById('btnSubmitPayment');
            if (submitBtn && !submitBtn.disabled) {
                playChaChing();
                document.getElementById('checkoutForm').submit();
            }
        }

        document.addEventListener('keydown', function(event) {
            if (event.key === 'F1') {
                event.preventDefault();
                document.getElementById('searchProduct').focus();
            }
            else if (event.key === 'F2') {
                event.preventDefault();
                let ib = document.getElementById('inputBayar');
                if(ib) { ib.focus(); ib.select(); }
            }
            else if (event.key === 'F3') {
                event.preventDefault();
                openCashDrawer();
            }
            else if (event.key === 'F9') {
                event.preventDefault();
                setCashExact();
            }
            else if (event.key === 'F10') {
                event.preventDefault();
                lakukanCheckout();
            }
        });

        function handleSearchEnter(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                let items = document.getElementsByClassName('product-item');
                for (let i = 0; i < items.length; i++) {
                    if (items[i].style.display !== 'none') {
                        let id = items[i].getAttribute('data-id');
                        let form = document.getElementById('form_prod_' + id);
                        if (form) { playScanBeep(); form.submit(); break; }
                    }
                }
            }
        }

        function toggleSidebar() {
            let sidebar = document.getElementById('sidebarMenu');
            let overlay = document.getElementById('sidebarOverlay');
            if (sidebar && overlay) {
                sidebar.classList.toggle('show');
                overlay.classList.toggle('show');
            }
        }

        function recalculateTotal() {
            let rawSub = parseFloat(document.getElementById('rawSubtotal').value) || 0;
            currentGrandTotal = rawSub;

            document.getElementById('lblGrandTotal').innerText = currentGrandTotal.toLocaleString('id-ID');
            calculateChange();
        }

        window.onload = function() {
            recalculateTotal();
            let sp = document.getElementById('searchProduct');
            if(sp) sp.focus();
        };

        function formatRupiah(el) {
            let val = el.value.replace(/[^,\d]/g, '').toString();
            let split = val.split(','); let sisa = split[0].length % 3;
            let rupiah = split[0].substr(0, sisa); let ribuan = split[0].substr(sisa).match(/\d{3}/gi);
            if (ribuan) { let separator = sisa ? '.' : ''; rupiah += separator + ribuan.join('.'); }
            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            el.value = rupiah;
        }

        function calculateChange() {
            let inputBayarStr = document.getElementById('inputBayar').value.replace(/\./g, '');
            let bayar = parseFloat(inputBayarStr) || 0;
            let lblKembalian = document.getElementById('lblKembalian');
            let selisih = bayar - currentGrandTotal;
            if (selisih >= 0) {
                lblKembalian.innerText = 'Rp ' + selisih.toLocaleString('id-ID');
                lblKembalian.className = 'font-weight-bold h6 m-0 text-success';
            } else {
                let kurang = Math.abs(selisih);
                lblKembalian.innerText = 'Kurang Rp ' + kurang.toLocaleString('id-ID');
                lblKembalian.className = 'font-weight-bold h6 m-0 text-danger';
            }
        }

        function setCashExact() {
            let input = document.getElementById('inputBayar');
            input.value = currentGrandTotal.toLocaleString('id-ID');
            calculateChange();
        }

        function setCashVal(amount) {
            let input = document.getElementById('inputBayar');
            input.value = amount.toLocaleString('id-ID');
            calculateChange();
        }

        function filterProducts() {
            let input = document.getElementById('searchProduct').value.toLowerCase();
            let items = document.getElementsByClassName('product-item');
            for (let i = 0; i < items.length; i++) {
                let name = items[i].getAttribute('data-name');
                if (name.includes(input)) { items[i].style.display = ""; }
                else { items[i].style.display = "none"; }
            }
        }

        function filterCategory(category, btn) {
            let buttons = document.querySelectorAll('.btn-pill');
            buttons.forEach(b => { b.classList.remove('btn-dark', 'active'); b.classList.add('btn-light', 'border', 'text-muted'); b.style.background = ''; });
            btn.classList.remove('btn-light', 'border', 'text-muted'); btn.classList.add('btn-dark', 'active'); btn.style.background = '#0f172a';

            let items = document.getElementsByClassName('product-item');
            for (let i = 0; i < items.length; i++) {
                let cat = items[i].getAttribute('data-category');
                if (category === 'semua' || cat === category) { items[i].style.display = ""; }
                else { items[i].style.display = "none"; }
            }
        }

        function toggleBayar() {
            let metode = document.getElementById('metodeBayar').value;
            let groupBayar = document.getElementById('groupBayar');
            let inputBayar = document.getElementById('inputBayar');
            if (metode !== 'Tunai') {
                groupBayar.style.display = 'none'; inputBayar.removeAttribute('required'); inputBayar.value = '0';
            } else {
                groupBayar.style.display = 'block'; inputBayar.setAttribute('required', 'true'); inputBayar.value = '';
            }
        }
    </script>
</body>
</html>