<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_barang');
    }

    public function index()
    {
        $data['barang'] = $this->M_barang->tampil_data();
        $penjualan      = $this->M_barang->tampil_penjualan();

        $total_omzet = 0;
        foreach ($penjualan as $p) {
            $total_omzet += $p->total_harga;
        }

        $data['total_produk']    = count($data['barang']);
        $data['total_transaksi'] = count($penjualan);
        $data['total_omzet']     = $total_omzet;
        $data['produk_terlaris'] = $this->M_barang->get_produk_terlaris();
        $data['stok_menipis']    = $this->M_barang->get_stok_menipis();

        $this->load->view('v_dashboard', $data);
    }

    public function inventaris()
    {
        $data['barang'] = $this->M_barang->tampil_data();
        $total_produk   = count($data['barang']);
        $total_stok     = 0;
        $total_nilai    = 0;

        foreach ($data['barang'] as $b) {
            $total_stok  += $b->stok;
            $total_nilai += ($b->harga * $b->stok);
        }

        $data['total_produk'] = $total_produk;
        $data['total_stok']   = $total_stok;
        $data['total_nilai']  = $total_nilai;

        $this->load->view('v_index', $data);
    }

    public function tambah()
    {
        $this->load->view('v_tambah');
    }

    public function tambah_aksi()
    {
        $config['upload_path']   = './uploads/';
        $config['allowed_types'] = '*';
        $config['max_size']      = 2048;

        $this->load->library('upload', $config);

        $gambar = '';
        if ($this->upload->do_upload('gambar')) {
            $file_data = $this->upload->data();
            $gambar    = $file_data['file_name'];
        }

        $data = [
            'nama_barang' => $this->input->post('nama_barang'),
            'kategori'    => $this->input->post('kategori'),
            'harga'       => $this->input->post('harga'),
            'stok'        => $this->input->post('stok'),
            'gambar'      => $gambar,
        ];
        $this->M_barang->tambah_data($data);
        redirect('barang/inventaris');
    }

    public function simpan()
    {
        $this->tambah_aksi();
    }

    public function edit($id)
    {
        $data['barang'] = $this->M_barang->edit_data(['id' => $id]);
        $this->load->view('v_edit', $data);
    }

    public function update()
    {
        $id   = $this->input->post('id');
        $data = [
            'nama_barang' => $this->input->post('nama_barang'),
            'kategori'    => $this->input->post('kategori'),
            'harga'       => $this->input->post('harga'),
            'stok'        => $this->input->post('stok'),
        ];

        if (! empty($_FILES['gambar']['name'])) {
            $config['upload_path']   = './uploads/';
            $config['allowed_types'] = '*';
            $config['max_size']      = 2048;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('gambar')) {
                $old_barang = $this->M_barang->get_by_id($id);
                if ($old_barang && ! empty($old_barang->gambar) && file_exists('./uploads/' . $old_barang->gambar)) {
                    unlink('./uploads/' . $old_barang->gambar);
                }

                $file_data      = $this->upload->data();
                $data['gambar'] = $file_data['file_name'];
            }
        }

        $this->M_barang->update_data(['id' => $id], $data);
        redirect('barang/inventaris');
    }

    public function update_aksi($id)
    {
        $this->update();
    }

    public function hapus($id)
    {
        $old_barang = $this->M_barang->get_by_id($id);
        if ($old_barang && ! empty($old_barang->gambar) && file_exists('./uploads/' . $old_barang->gambar)) {
            unlink('./uploads/' . $old_barang->gambar);
        }
        $this->M_barang->hapus_data(['id' => $id]);
        redirect('barang/inventaris');
    }

    public function pelanggan()
    {
        $data['pelanggan'] = $this->M_barang->tampil_pelanggan();
        $this->load->view('v_pelanggan', $data);
    }

    public function tambah_pelanggan_aksi()
    {
        $data = [
            'nama_pelanggan' => $this->input->post('nama_pelanggan'),
            'telepon'        => $this->input->post('telepon'),
            'alamat'         => $this->input->post('alamat'),
        ];
        $this->M_barang->tambah_pelanggan($data);
        redirect('barang/pelanggan');
    }

    public function hapus_pelanggan($id)
    {
        $this->M_barang->hapus_pelanggan(['id' => $id]);
        redirect('barang/pelanggan');
    }

    public function kasir()
    {
        $data['barang']    = $this->M_barang->tampil_data();
        $data['kategori']  = $this->M_barang->get_kategori();
        $data['pelanggan'] = $this->M_barang->tampil_pelanggan();
        $this->load->view('v_kasir', $data);
    }

    public function tambah_cart()
    {
        $id_barang  = $this->input->post('id_barang');
        $qty_tambah = max(1, (int) $this->input->post('qty'));
        $barang     = $this->M_barang->get_by_id($id_barang);

        if ($barang && $barang->stok >= $qty_tambah) {
            $cart = $this->session->userdata('cart') ?: [];

            if (isset($cart[$id_barang])) {
                $new_qty = $cart[$id_barang]['qty'] + $qty_tambah;
                if ($new_qty <= $barang->stok) {
                    $cart[$id_barang]['qty']      = $new_qty;
                    $cart[$id_barang]['subtotal'] = $cart[$id_barang]['qty'] * $barang->harga;
                }
            } else {
                $cart[$id_barang] = [
                    'id'       => $barang->id,
                    'nama'     => $barang->nama_barang,
                    'harga'    => $barang->harga,
                    'qty'      => $qty_tambah,
                    'subtotal' => $qty_tambah * $barang->harga,
                ];
            }

            $this->session->set_userdata('cart', $cart);
        }
        redirect('barang/kasir');
    }

    public function set_cart_qty($id)
    {
        $qty    = (int) $this->input->post('qty');
        $cart   = $this->session->userdata('cart');
        $barang = $this->M_barang->get_by_id($id);

        if (isset($cart[$id]) && $barang) {
            if ($qty > 0 && $qty <= $barang->stok) {
                $cart[$id]['qty']      = $qty;
                $cart[$id]['subtotal'] = $qty * $barang->harga;
            } else if ($qty <= 0) {
                unset($cart[$id]);
            }
            $this->session->set_userdata('cart', $cart);
        }
        redirect('barang/kasir');
    }

    public function update_cart($id, $aksi)
    {
        $cart   = $this->session->userdata('cart');
        $barang = $this->M_barang->get_by_id($id);

        if (isset($cart[$id])) {
            if ($aksi == 'plus') {
                if ($cart[$id]['qty'] < $barang->stok) {
                    $cart[$id]['qty'] += 1;
                }
            } else if ($aksi == 'minus') {
                $cart[$id]['qty'] -= 1;
                if ($cart[$id]['qty'] <= 0) {
                    unset($cart[$id]);
                }
            }
            if (isset($cart[$id])) {
                $cart[$id]['subtotal'] = $cart[$id]['qty'] * $cart[$id]['harga'];
            }
            $this->session->set_userdata('cart', $cart);
        }
        redirect('barang/kasir');
    }

    public function hapus_cart($id)
    {
        $cart = $this->session->userdata('cart');
        if (isset($cart[$id])) {
            unset($cart[$id]);
            $this->session->set_userdata('cart', $cart);
        }
        redirect('barang/kasir');
    }

    public function proses_checkout()
    {
        $cart              = $this->session->userdata('cart');
        $bayar             = $this->input->post('bayar');
        $jenis_pesanan     = $this->input->post('jenis_pesanan');
        $metode_pembayaran = $this->input->post('metode_pembayaran');
        $id_pelanggan      = $this->input->post('id_pelanggan');
        $catatan           = $this->input->post('catatan');

        $subtotal_cart = 0;
        if (! empty($cart)) {
            foreach ($cart as $item) {
                $subtotal_cart += $item['subtotal'];
            }

            $total_harga = round($subtotal_cart);

            if ($metode_pembayaran != 'Tunai') {
                $bayar = $total_harga;
            }

            if ($bayar >= $total_harga) {
                $kembalian      = $bayar - $total_harga;
                $data_penjualan = [
                    'tanggal'           => date('Y-m-d H:i:s'),
                    'total_harga'       => $total_harga,
                    'bayar'             => $bayar,
                    'kembalian'         => $kembalian,
                    'jenis_pesanan'     => $jenis_pesanan ? $jenis_pesanan : 'Offline / Toko',
                    'metode_pembayaran' => $metode_pembayaran,
                    'id_pelanggan'      => $id_pelanggan,
                    'catatan'           => $catatan,
                    'diskon'            => 0,
                    'diskon_persen'     => 0,
                    'pajak'             => 0,
                    'service_charge'    => 0,
                ];

                $id_penjualan = $this->M_barang->simpan_transaksi($data_penjualan, $cart);
                $this->session->unset_userdata('cart');
                redirect('barang/struk/' . $id_penjualan);
            } else {
                echo "<script>alert('Uang pembayaran kurang!');window.location='" . site_url('barang/kasir') . "';</script>";
            }
        } else {
            redirect('barang/kasir');
        }
    }

    public function struk($id)
    {
        $this->db->select('penjualan.*, pelanggan.nama_pelanggan, pelanggan.telepon');
        $this->db->from('penjualan');
        $this->db->join('pelanggan', 'pelanggan.id = penjualan.id_pelanggan', 'left');
        $this->db->where('penjualan.id', $id);
        $data['penjualan'] = $this->db->get()->row();

        $data['pengaturan'] = $this->db->get_where('pengaturan', ['id' => 1])->row();

        $this->db->select('detail_penjualan.*, barang.nama_barang');
        $this->db->from('detail_penjualan');
        $this->db->join('barang', 'barang.id = detail_penjualan.id_barang');
        $this->db->where('detail_penjualan.id_penjualan', $id);
        $data['detail'] = $this->db->get()->result();

        $this->load->view('v_struk', $data);
    }

    public function laporan()
    {
        $data['penjualan'] = $this->M_barang->tampil_penjualan();
        $total_omzet       = 0;
        foreach ($data['penjualan'] as $p) {
            $total_omzet += $p->total_harga;
        }
        $data['total_omzet'] = $total_omzet;
        $this->load->view('v_laporan', $data);
    }

    public function detail_laporan($id)
    {
        $this->db->select('penjualan.*, pelanggan.nama_pelanggan');
        $this->db->from('penjualan');
        $this->db->join('pelanggan', 'pelanggan.id = penjualan.id_pelanggan', 'left');
        $this->db->where('penjualan.id', $id);
        $data['penjualan'] = $this->db->get()->row();

        $this->db->select('detail_penjualan.*, barang.nama_barang');
        $this->db->from('detail_penjualan');
        $this->db->join('barang', 'barang.id = detail_penjualan.id_barang');
        $this->db->where('detail_penjualan.id_penjualan', $id);
        $data['detail'] = $this->db->get()->result();

        $this->load->view('v_detail_laporan', $data);
    }

    public function pengaturan()
    {
        $data['pengaturan'] = $this->db->get_where('pengaturan', ['id' => 1])->row();
        $this->load->view('v_pengaturan', $data);
    }

    public function update_pengaturan()
    {
        $data = [
            'nama_toko'   => $this->input->post('nama_toko'),
            'alamat_toko' => $this->input->post('alamat_toko'),
        ];
        $this->db->where('id', 1);
        $this->db->update('pengaturan', $data);
        redirect('barang/pengaturan');
    }
}
