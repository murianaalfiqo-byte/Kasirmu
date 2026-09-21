<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_barang extends CI_Model {
    public function tampil_data() {
        return $this->db->get('barang')->result();
    }

    public function get_kategori() {
        $this->db->distinct();
        $this->db->select('kategori');
        return $this->db->get('barang')->result();
    }

    public function tambah_data($data) {
        $this->db->insert('barang', $data);
    }

    public function edit_data($where) {
        return $this->db->get_where('barang', $where)->row();
    }

    public function update_data($where, $data) {
        $this->db->where($where);
        $this->db->update('barang', $data);
    }

    public function hapus_data($where) {
        $this->db->where($where);
        $this->db->delete('barang');
    }

    public function get_by_id($id) {
        return $this->db->get_where('barang', array('id' => $id))->row();
    }

    public function tampil_pelanggan() {
        return $this->db->get('pelanggan')->result();
    }

    public function tambah_pelanggan($data) {
        $this->db->insert('pelanggan', $data);
    }

    public function hapus_pelanggan($where) {
        $this->db->where($where);
        $this->db->delete('pelanggan');
    }

    public function simpan_transaksi($data_penjualan, $cart_items) {
        $this->db->insert('penjualan', $data_penjualan);
        $id_penjualan = $this->db->insert_id();

        foreach ($cart_items as $item) {
            $data_detail = array(
                'id_penjualan' => $id_penjualan,
                'id_barang' => $item['id'],
                'jumlah' => $item['qty'],
                'subtotal' => $item['subtotal']
            );
            $this->db->insert('detail_penjualan', $data_detail);

            $barang = $this->get_by_id($item['id']);
            $sisa_stok = $barang->stok - $item['qty'];
            $this->db->where('id', $item['id']);
            $this->db->update('barang', array('stok' => $sisa_stok));
        }

        return $id_penjualan;
    }

    public function tampil_penjualan() {
        $this->db->select('penjualan.*, pelanggan.nama_pelanggan');
        $this->db->from('penjualan');
        $this->db->join('pelanggan', 'pelanggan.id = penjualan.id_pelanggan', 'left');
        $this->db->order_by('penjualan.id', 'DESC');
        return $this->db->get()->result();
    }

    public function get_produk_terlaris() {
        $this->db->select('barang.nama_barang, SUM(detail_penjualan.jumlah) as total_terjual');
        $this->db->from('detail_penjualan');
        $this->db->join('barang', 'barang.id = detail_penjualan.id_barang');
        $this->db->group_by('detail_penjualan.id_barang');
        $this->db->order_by('total_terjual', 'DESC');
        $this->db->limit(5);
        return $this->db->get()->result();
    }

    public function get_stok_menipis() {
        return $this->db->where('stok <=', 5)->get('barang')->result();
    }
}