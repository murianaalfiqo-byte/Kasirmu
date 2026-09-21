<!DOCTYPE html>
<html>
<head>
    <title>Struk Pembayaran - Kasirmu Enterprise</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 13px;
            width: 300px;
            margin: 20px auto;
            background: #fff;
            color: #000;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        hr { border: dashed 1px #000; }
        table { width: 100%; font-size: 12px; }
        .btn-print {
            display: block;
            width: 100%;
            padding: 10px;
            background: #0f172a;
            color: #fff;
            text-align: center;
            text-decoration: none;
            margin-top: 15px;
            border-radius: 6px;
            font-weight: bold;
        }
        @media print {
            .btn-print, .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="text-center">
        <h3 style="margin-bottom: 0; font-size: 16px;"><?php echo $pengaturan->nama_toko; ?></h3>
        <p style="margin-top: 3px; font-size: 11px;"><?php echo $pengaturan->alamat_toko; ?></p>
        <hr>
    </div>

    <p style="font-size: 11px; margin: 3px 0;">
        No Transaksi : #<?php echo $penjualan->id; ?><br>
        Tanggal      : <?php echo $penjualan->tanggal; ?><br>
        Pelanggan    : <strong><?php echo isset($penjualan->nama_pelanggan) ? $penjualan->nama_pelanggan : 'Umum'; ?></strong><br>
        Pembayaran   : <?php echo $penjualan->metode_pembayaran; ?><br>
        <?php if(!empty($penjualan->catatan)): ?>
        Catatan      : <strong><?php echo $penjualan->catatan; ?></strong><br>
        <?php endif; ?>
    </p>
    <hr>

    <table>
        <?php foreach($detail as $d): ?>
        <tr>
            <td colspan="3"><strong><?php echo $d->nama_barang; ?></strong></td>
        </tr>
        <tr>
            <td><?php echo $d->jumlah; ?> x <?php echo number_format($d->subtotal / $d->jumlah); ?></td>
            <td></td>
            <td class="text-right">Rp <?php echo number_format($d->subtotal); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <hr>
    <table>
        <?php if($penjualan->diskon > 0): ?>
        <tr>
            <td>Diskon (<?php echo $penjualan->diskon_persen; ?>%)</td>
            <td class="text-right">-Rp <?php echo number_format($penjualan->diskon); ?></td>
        </tr>
        <?php endif; ?>
        <?php if($penjualan->pajak > 0): ?>
        <tr>
            <td>Pajak PPN (11%)</td>
            <td class="text-right">+Rp <?php echo number_format($penjualan->pajak); ?></td>
        </tr>
        <?php endif; ?>
        <?php if($penjualan->service_charge > 0): ?>
        <tr>
            <td>Service (5%)</td>
            <td class="text-right">+Rp <?php echo number_format($penjualan->service_charge); ?></td>
        </tr>
        <?php endif; ?>
        <tr>
            <td><strong>Total Tagihan</strong></td>
            <td class="text-right"><strong>Rp <?php echo number_format($penjualan->total_harga); ?></strong></td>
        </tr>
        <?php if($penjualan->metode_pembayaran == 'Tunai'): ?>
        <tr>
            <td>Tunai Dibayar</td>
            <td class="text-right">Rp <?php echo number_format($penjualan->bayar); ?></td>
        </tr>
        <tr>
            <td>Uang Kembalian</td>
            <td class="text-right">Rp <?php echo number_format($penjualan->kembalian); ?></td>
        </tr>
        <?php endif; ?>
    </table>
    <hr>

    <div class="text-center" style="font-size: 11px;">
        <p>Terima Kasih Atas Kunjungan Anda!<br>Barang yang sudah dibeli tidak dapat ditukar.</p>
    </div>

    <a href="#" class="btn-print" onclick="window.print();"><i class="fas fa-print"></i> Cetak Struk Kasir</a>
    <a href="<?php echo site_url('barang/kasir'); ?>" class="btn-print no-print" style="background: #64748b; margin-top: 5px;">Kembali ke POS</a>
</body>
</html>