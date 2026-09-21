<!DOCTYPE html>
<html>
<head>
    <title>Kasirmu - Quantum Infinity POS v9.0</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif !important; background-color: #0b0f19 !important; color: #1e293b !important; overflow-x: hidden; }
        .sidebar { transform: translateX(-100%); transition: transform 0.3s ease-in-out; z-index: 1050; box-shadow: 10px 0 30px rgba(0,0,0,0.5); }
        .sidebar.show { transform: translateX(0); }
        .main-content { margin-left: 0 !important; padding: 25px !important; background-color: #f8fafc; min-height: 100vh; width: 100% !important; }
        .card { border: none; border-radius: 20px; box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.04); background: #ffffff; }
        .product-card { transition: all 0.2s ease; border-radius: 14px; border: 1px solid #e2e8f0; background: #ffffff; cursor: pointer; }
        .product-card:hover { transform: translateY(-4px); box-shadow: 0 15px 30px -5px rgba(99, 102, 241, 0.15); border-color: #6366f1 !important; }
        .form-control { border-radius: 10px; border: 1px solid #cbd5e1; padding: 8px 12px; font-size: 13px; }
        .form-control:focus { box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2); border-color: #6366f1; }
        .btn-pill { border-radius: 24px; font-size: 13px; font-weight: 600; padding: 6px 18px; margin-right: 6px; }
        .quick-cash-btn { font-size: 11px; font-weight: 700; border-radius: 6px; padding: 3px 8px; background: #e0e7ff; color: #3730a3; border: none; transition: 0.2s; }
        .quick-cash-btn:hover { background: #c7d2fe; }
        .custom-control-input:checked ~ .custom-control-label::before { background-color: #6366f1; border-color: #6366f1; }
        .pos-topbar { background: #ffffff; padding: 12px 25px; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.03); margin-bottom: 25px; display: flex; justify-content: space-between; align-items: center; }
        .hotkey-badge { font-size: 9px; background: #0f172a; color: #fff; padding: 2px 6px; border-radius: 4px; margin-left: 5px; font-weight: 600; }
        .change-box { background: #f1f5f9; border-radius: 10px; padding: 8px 12px; margin-top: 8px; border: 1px dashed #cbd5e1; }
    </style>
</head>
<body>
    <?php $this->load->view('v_sidebar'); ?>

    <div class="main-content">
        <div class="pos-topbar">
            <div class="d-flex align-items-center">
                <button class="btn btn-dark btn-sm mr-3 shadow-sm" onclick="toggleSidebar()" style="background: #0f172a; border-radius: 10px; width: 38px; height: 38px;">
                    <i class="fas fa-bars"></i>
                </button>
                <div>
                    <h5 class="font-weight-bold text-dark m-0" style="font-size: 16px;">Terminal Kasir Infinity v9.0</h5>
                    <span class="text-muted" style="font-size: 11px;">Synthetic Audio Engine & Hotkeys ([F1] Cari, [F2] Bayar, [F9] Pas, [F10] Eksekusi)</span>
                </div>
            </div>
            <div class="d-flex align-items-center">
                <span class="badge badge-pill badge-primary px-3 py-2 font-weight-bold shadow-sm" style="background: #6366f1; font-size: 11px;">
                    <i class="fas fa-volume-up mr-1"></i> Audio Feedback Active
                </span>
            </div>
        </div>

        <div class="row">
            <div class="col-md-7">
                <div class="card h-100">
                    <div class="card-header bg-white py-3 px-4 border-bottom-0 d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="font-weight-bold text-dark m-0">Katalog Produk Sektoral</h5>
                            <small class="text-muted">Tekan <span class="badge badge-dark">F1</span> untuk fokus pencarian / Barcode Scanner</small>
                        </div>
                        <span class="badge badge-pill badge-dark px-3 py-2 font-weight-bold shadow-sm" style="background: #0f172a;">
                            <i class="fas fa-microchip text-indigo mr-1"></i> Infinity Engine
                        </span>
                    </div>

                    <div class="px-4 pb-3">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-light border-right-0" style="border-radius: 12px 0 0 12px;"><i class="fas fa-search text-muted"></i></span>
                            </div>
                            <input type="text" id="searchProduct" class="form-control border-left-0 bg-light" placeholder="Cari nama produk atau scan barcode... (Tekan Enter)" onkeyup="filterProducts()" onkeypress="handleSearchEnter(event)">
                        </div>
                        <div class="d-flex overflow-auto pb-1">
                            <button class="btn btn-sm btn-dark btn-pill active" onclick="filterCategory('semua', this)" style="background: #0f172a;">Semua</button>
                            <?php foreach($kategori as $kat): ?>
                            <button class="btn btn-sm btn-light border btn-pill text-muted" onclick="filterCategory('<?php echo strtolower($kat->kategori); ?>', this)"><?php echo ucfirst($kat->kategori); ?></button>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="card-body px-4 pb-4 pt-1" style="height: 56vh; overflow-y: auto;">
                        <div class="row" id="productList">
                            <?php foreach($barang as $b): ?>
                            <div class="col-md-4 mb-3 product-item" data-id="<?php echo $b->id; ?>" data-name="<?php echo strtolower($b->nama_barang); ?>" data-category="<?php echo strtolower($b->kategori); ?>" data-stock="<?php echo $b->stok; ?>">
                                <div class="card product-card h-100 p-2">
                                    <div class="card-body text-center d-flex flex-column justify-content-between p-2">
                                        <div>
                                            <h6 class="card-title font-weight-bold text-dark mb-1" style="font-size: 14px;"><?php echo $b->nama_barang; ?></h6>
                                            <span class="badge badge-pill badge-light text-muted border px-2 mb-1" style="font-size: 10px;"><?php echo $b->kategori; ?></span>
                                            <div class="text-primary font-weight-bold mb-2" style="font-size: 15px; color: #6366f1 !important;">Rp <?php echo number_format($b->harga); ?></div>
                                        </div>
                                        <div>
                                            <div class="small text-muted mb-2" style="font-size: 11px;">Stok: <strong class="text-dark"><?php echo $b->stok; ?></strong></div>
                                            
                                            <form action="<?php echo site_url('barang/tambah_cart'); ?>" method="post" id="form_prod_<?php echo $b->id; ?>" onsubmit="playScanBeep()">
                                                <input type="hidden" name="id_barang" value="<?php echo $b->id; ?>">
                                                <input type="hidden" name="qty" id="hidden_qty_<?php echo $b->id; ?>" value="1">
                                                
                                                <div class="d-flex align-items-center justify-content-center mb-2">
                                                    <button type="button" class="btn btn-sm btn-light border px-2 py-1" onclick="adjustQty('<?php echo $b->id; ?>', -1)"><i class="fas fa-minus fa-xs"></i></button>
                                                    <input type="number" id="qty_<?php echo $b->id; ?>" value="1" min="1" max="<?php echo $b->stok; ?>" class="form-control form-control-sm text-center font-weight-bold p-0 border-top border-bottom" style="width: 45px; height: 31px;" readonly>
                                                    <button type="button" class="btn btn-sm btn-light border px-2 py-1" onclick="adjustQty('<?php echo $b->id; ?>', 1, <?php echo $b->stok; ?>)"><i class="fas fa-plus fa-xs"></i></button>
                                                </div>

                                                <button type="submit" class="btn btn-primary btn-sm btn-block font-weight-bold shadow-sm py-1" style="border-radius: 10px; background: #6366f1; border: none;" <?php echo ($b->stok <= 0) ? 'disabled' : ''; ?>>
                                                    <i class="fas fa-cart-plus mr-1"></i> Tambah
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card h-100 d-flex flex-column">
                    <div class="card-header bg-dark text-white py-2 px-4 font-weight-bold d-flex justify-content-between align-items-center" style="border-radius: 20px 20px 0 0; background: #0f172a !important;">
                        <span style="font-size: 14px;"><i class="fas fa-shopping-bag mr-2 text-warning"></i>Keranjang Terminal</span>
                        <span class="badge badge-pill badge-warning text-dark px-2 font-weight-bold" style="font-size: 10px;">Infinity Active</span>
                    </div>

                    <div class="card-body p-3 flex-grow-1" style="overflow-y: auto; max-height: calc(100vh - 280px);">
                        <table class="table table-sm align-middle mb-2">
                            <thead>
                                <tr class="text-muted small border-top-0">
                                    <th>Item</th>
                                    <th>Subtotal</th>
                                    <th class="text-center">Qty</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $cart = $this->session->userdata('cart');
                                $subtotal_raw = 0;
                                if(!empty($cart)): 
                                    foreach($cart as $item):
                                        $subtotal_raw += $item['subtotal'];
                                ?>
                                <tr>
                                    <td>
                                        <div class="font-weight-bold text-dark" style="font-size: 12px;"><?php echo $item['nama']; ?></div>
                                        <small class="text-muted" style="font-size: 10px;">Rp <?php echo number_format($item['harga']); ?></small>
                                    </td>
                                    <td class="font-weight-bold text-success" style="font-size: 12px;">Rp <?php echo number_format($item['subtotal']); ?></td>
                                    <td class="text-center" style="width: 80px;">
                                        <a href="<?php echo site_url('barang/update_cart/'.$item['id'].'/minus'); ?>" class="btn btn-light border btn-sm px-1 py-0"><i class="fas fa-minus fa-xs"></i></a>
                                        <span class="mx-1 font-weight-bold text-dark" style="font-size: 12px;"><?php echo $item['qty']; ?></span>
                                        <a href="<?php echo site_url('barang/update_cart/'.$item['id'].'/plus'); ?>" class="btn btn-light border btn-sm px-1 py-0"><i class="fas fa-plus fa-xs"></i></a>
                                    </td>
                                    <td class="text-right">
                                        <a href="<?php echo site_url('barang/hapus_cart/'.$item['id']); ?>" class="text-danger"><i class="fas fa-trash-alt fa-xs"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach; else: ?>
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-2">
                                        <i class="fas fa-shopping-basket fa-lg text-black-50 mb-1"></i><br>
                                        <span class="small font-weight-bold" style="font-size: 11px;">Keranjang kosong</span>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>

                        <form action="<?php echo site_url('barang/proses_checkout'); ?>" method="post" id="checkoutForm" onsubmit="playChaChing()">
                            <input type="hidden" id="rawSubtotal" value="<?php echo $subtotal_raw; ?>">

                            <div class="bg-light p-2 rounded border mb-2" style="font-size: 12px;">
                                <div class="d-flex justify-content-between mb-1 text-muted">
                                    <span>Subtotal:</span>
                                    <span class="font-weight-bold text-dark">Rp <span id="lblSubtotal"><?php echo number_format($subtotal_raw); ?></span></span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="text-muted font-weight-bold">Diskon:</span>
                                    <select name="diskon_persen" id="diskonPersen" class="form-control form-control-sm font-weight-bold w-50 py-0 px-1" style="height: 24px; font-size: 11px;" onchange="recalculateTotal()">
                                        <option value="0">0%</option>
                                        <option value="5">5%</option>
                                        <option value="10">10%</option>
                                        <option value="15">15%</option>
                                        <option value="20">20%</option>
                                        <option value="50">50%</option>
                                    </select>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <div class="custom-control custom-checkbox custom-control-inline m-0">
                                        <input type="checkbox" class="custom-control-input" id="useTax" name="use_tax" value="1" onchange="recalculateTotal()" checked>
                                        <label class="custom-control-label text-muted" for="useTax">PPN (11%)</label>
                                    </div>
                                    <span class="font-weight-bold text-dark">+Rp <span id="lblTax">0</span></span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <div class="custom-control custom-checkbox custom-control-inline m-0">
                                        <input type="checkbox" class="custom-control-input" id="useService" name="use_service" value="1" onchange="recalculateTotal()">
                                        <label class="custom-control-label text-muted" for="useService">Service (5%)</label>
                                    </div>
                                    <span class="font-weight-bold text-dark">+Rp <span id="lblService">0</span></span>
                                </div>
                                <hr class="my-1">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="font-weight-bold text-dark text-uppercase">Grand Total:</span>
                                    <span class="font-weight-bold text-success h6 m-0">Rp <span id="lblGrandTotal">0</span></span>
                                </div>
                            </div>

                            <div class="form-row mb-1">
                                <div class="col-6">
                                    <label class="small font-weight-bold text-muted mb-0" style="font-size: 11px;">Pelanggan</label>
                                    <select name="id_pelanggan" class="form-control form-control-sm font-weight-bold py-1" style="height: 30px;">
                                        <?php foreach($pelanggan as $plg): ?>
                                        <option value="<?php echo $plg->id; ?>"><?php echo $plg->nama_pelanggan; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label class="small font-weight-bold text-muted mb-0" style="font-size: 11px;">Metode Bayar</label>
                                    <select name="metode_pembayaran" id="metodeBayar" class="form-control form-control-sm font-weight-bold py-1" style="height: 30px;" onchange="toggleBayar()">
                                        <option value="Tunai">Tunai (Cash)</option>
                                        <option value="QRIS">QRIS / E-Wallet</option>
                                        <option value="Transfer Bank">Transfer Bank</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row mb-1">
                                <div class="col-6">
                                    <label class="small font-weight-bold text-muted mb-0" style="font-size: 11px;">Tipe Pesanan</label>
                                    <select name="jenis_pesanan" class="form-control form-control-sm font-weight-bold py-1" style="height: 30px;">
                                        <option value="Offline / Toko">Dine-in / Toko</option>
                                        <option value="Online / Delivery">Delivery / Online</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label class="small font-weight-bold text-muted mb-0" style="font-size: 11px;">Catatan</label>
                                    <input type="text" name="catatan" class="form-control form-control-sm py-1" style="height: 30px;" placeholder="Catatan...">
                                </div>
                            </div>

                            <div class="form-group mb-2" id="groupBayar">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <label class="small font-weight-bold text-muted m-0" style="font-size: 11px;">Uang Tunai <span class="hotkey-badge">F2</span></label>
                                    <div class="d-flex">
                                        <button type="button" class="quick-cash-btn mr-1" onclick="setCashExact()" title="Hotkey: F9">Pas <span style="font-size:9px; opacity:0.7;">[F9]</span></button>
                                        <button type="button" class="quick-cash-btn mr-1" onclick="setCashVal(20000)">20.000</button>
                                        <button type="button" class="quick-cash-btn mr-1" onclick="setCashVal(50000)">50.000</button>
                                        <button type="button" class="quick-cash-btn" onclick="setCashVal(100000)">100.000</button>
                                    </div>
                                </div>
                                <input type="text" name="bayar" id="inputBayar" class="form-control form-control-sm font-weight-bold text-primary py-1" style="height: 32px;" placeholder="0" onkeyup="formatRupiah(this); calculateChange();" required>
                                
                                <div class="change-box d-flex justify-content-between align-items-center">
                                    <span class="small font-weight-bold text-muted">Uang Kembalian:</span>
                                    <span class="font-weight-bold h6 m-0 text-dark" id="lblKembalian">Rp 0</span>
                                </div>
                            </div>

                            <button type="submit" id="btnSubmitPayment" class="btn btn-success btn-block font-weight-bold shadow-sm py-2" style="border-radius: 10px; background: #10b981; border: none; font-size: 13px;" <?php echo empty($cart) ? 'disabled style="opacity: 0.5; cursor: not-allowed;"' : ''; ?>>
                                <i class="fas fa-check-circle mr-1"></i> Eksekusi Pembayaran <span class="hotkey-badge" style="background:#047857;">F10</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentGrandTotal = 0;

        function playScanBeep() {
            try {
                let ctx = new (window.AudioContext || window.webkitAudioContext)();
                let osc = ctx.createOscillator();
                let gain = ctx.createGain();
                osc.type = 'sine';
                osc.frequency.setValueAtTime(1200, ctx.currentTime);
                gain.gain.setValueAtTime(0.1, ctx.currentTime);
                osc.connect(gain);
                gain.connect(ctx.destination);
                osc.start();
                osc.stop(ctx.currentTime + 0.1);
            } catch(e) {}
        }

        function playChaChing() {
            try {
                let ctx = new (window.AudioContext || window.webkitAudioContext)();
                let now = ctx.currentTime;
                
                let osc1 = ctx.createOscillator();
                let gain1 = ctx.createGain();
                osc1.type = 'triangle';
                osc1.frequency.setValueAtTime(987.77, now);
                gain1.gain.setValueAtTime(0.15, now);
                gain1.gain.exponentialRampToValueAtTime(0.001, now + 0.3);
                osc1.connect(gain1);
                gain1.connect(ctx.destination);
                osc1.start(now);
                osc1.stop(now + 0.3);

                let osc2 = ctx.createOscillator();
                let gain2 = ctx.createGain();
                osc2.type = 'sine';
                osc2.frequency.setValueAtTime(1318.51, now + 0.1);
                gain2.gain.setValueAtTime(0.2, now + 0.1);
                gain2.gain.exponentialRampToValueAtTime(0.001, now + 0.6);
                osc2.connect(gain2);
                gain2.connect(ctx.destination);
                osc2.start(now + 0.1);
                osc2.stop(now + 0.6);
            } catch(e) {}
        }

        document.addEventListener('keydown', function(event) {
            if (event.key === 'F1') {
                event.preventDefault();
                document.getElementById('searchProduct').focus();
            } else if (event.key === 'F2') {
                event.preventDefault();
                let inputBayar = document.getElementById('inputBayar');
                if (inputBayar) inputBayar.focus();
            } else if (event.key === 'F9') {
                event.preventDefault();
                setCashExact();
            } else if (event.key === 'F10') {
                event.preventDefault();
                let submitBtn = document.getElementById('btnSubmitPayment');
                if (submitBtn && !submitBtn.disabled) {
                    playChaChing();
                    document.getElementById('checkoutForm').submit();
                }
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
                        if (form) {
                            playScanBeep();
                            form.submit();
                            break;
                        }
                    }
                }
            }
        }

        function toggleSidebar() {
            let sidebar = document.getElementById('sidebarMenu');
            if (sidebar) {
                sidebar.classList.toggle('show');
            }
        }

        function recalculateTotal() {
            let rawSub = parseFloat(document.getElementById('rawSubtotal').value) || 0;
            let diskonPct = parseFloat(document.getElementById('diskonPersen').value) || 0;
            let useTax = document.getElementById('useTax').checked;
            let useService = document.getElementById('useService').checked;

            let diskonVal = rawSub * (diskonPct / 100);
            let afterDiskon = rawSub - diskonVal;

            let taxVal = useTax ? (afterDiskon * 0.11) : 0;
            let serviceVal = useService ? (afterDiskon * 0.05) : 0;

            currentGrandTotal = Math.round(afterDiskon + taxVal + serviceVal);

            document.getElementById('lblTax').innerText = Math.round(taxVal).toLocaleString('id-ID');
            document.getElementById('lblService').innerText = Math.round(serviceVal).toLocaleString('id-ID');
            document.getElementById('lblGrandTotal').innerText = currentGrandTotal.toLocaleString('id-ID');
            calculateChange();
        }

        window.onload = function() {
            recalculateTotal();
        };

        function adjustQty(id, change, maxStock) {
            let input = document.getElementById('qty_' + id);
            let hiddenInput = document.getElementById('hidden_qty_' + id);
            let val = parseInt(input.value) + change;
            if (val < 1) val = 1;
            if (maxStock && val > maxStock) val = maxStock;
            input.value = val;
            if (hiddenInput) hiddenInput.value = val;
        }

        function formatRupiah(el) {
            let val = el.value.replace(/[^,\d]/g, '').toString();
            let split = val.split(',');
            let sisa = split[0].length % 3;
            let rupiah = split[0].substr(0, sisa);
            let ribuan = split[0].substr(sisa).match(/\d{3}/gi);
            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
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

        document.getElementById('checkoutForm').addEventListener('submit', function() {
            let input = document.getElementById('inputBayar');
            input.value = input.value.replace(/\./g, '');
        });

        function filterProducts() {
            let input = document.getElementById('searchProduct').value.toLowerCase();
            let items = document.getElementsByClassName('product-item');
            for (let i = 0; i < items.length; i++) {
                let name = items[i].getAttribute('data-name');
                if (name.includes(input)) {
                    items[i].style.display = "";
                } else {
                    items[i].style.display = "none";
                }
            }
        }

        function filterCategory(category, btn) {
            let buttons = document.querySelectorAll('.btn-pill');
            buttons.forEach(b => {
                b.classList.remove('btn-dark', 'active');
                b.classList.add('btn-light', 'border', 'text-muted');
                b.style.background = '';
            });
            btn.classList.remove('btn-light', 'border', 'text-muted');
            btn.classList.add('btn-dark', 'active');
            btn.style.background = '#0f172a';

            let items = document.getElementsByClassName('product-item');
            for (let i = 0; i < items.length; i++) {
                let cat = items[i].getAttribute('data-category');
                if (category === 'semua' || cat === category) {
                    items[i].style.display = "";
                } else {
                    items[i].style.display = "none";
                }
            }
        }

        function toggleBayar() {
            let metode = document.getElementById('metodeBayar').value;
            let groupBayar = document.getElementById('groupBayar');
            let inputBayar = document.getElementById('inputBayar');
            if (metode !== 'Tunai') {
                groupBayar.style.display = 'none';
                inputBayar.removeAttribute('required');
                inputBayar.value = '0';
            } else {
                groupBayar.style.display = 'block';
                inputBayar.setAttribute('required', 'true');
                inputBayar.value = '';
            }
        }
    </script>
</body>
</html>