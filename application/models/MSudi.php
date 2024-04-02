<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MSudi extends CI_Model
{

    // In your MSudi model
    public function get_detail_penjualan_by_date_range($startDate, $endDate)
    {
        $this->db->select('*');
        $this->db->from('detailpenjualan');
        $this->db->where('PenjualanID >=', $startDate);
        $this->db->where('PenjualanID <=', $endDate);
        $query = $this->db->get();
        return $query->result();
    }


    public function GetDailySales()
    {
        $this->db->select('DATE(PenjualanID) as TanggalPenjualan, SUM(Subtotal) as Subtotal');
        $this->db->from('detailpenjualan');
        $this->db->where('DATE(PenjulanID) >= CURDATE() - INTERVAL 7 DAY'); // Ambil data 7 hari terakhir
        $this->db->group_by('DATE(PenjulanID)');
        $query = $this->db->get();

        $dailySales = array();
        foreach ($query->result() as $row) {
            $dailySales[$row->TanggalPenjualan] = array(
                'Subtotal' => $row->Subtotal,
            );
        }

        return $dailySales;
    }

    function AddData($tabel, $data=array())
    {
        $this->db->insert($tabel,$data);
    }

    public function get_user($username)
    {
        $query = $this->db->get_where('users', array('username' => $username));
        return $query->row_array();
    }

    function UpdateData($tabel,$fieldid,$fieldvalue,$data=array())
    {
        $this->db->where($fieldid,$fieldvalue)->update($tabel,$data);
    }

    function DeleteData($tabel,$fieldid,$fieldvalue)
    {
        $this->db->where($fieldid,$fieldvalue)->delete($tabel);
    }

    function GetData($tabel)
    {
        $query= $this->db->get($tabel);
        return $query->result();
    }
	public function check_credentials($username, $password) {
        $user = $this->db->get_where('users', array('username' => $username))->row();

        if ($user && password_verify($password, $user->password)) {
            return true; // Authentication successful
        }

        return false; // Authentication failed
    }

    function GetDataWhere($tabel,$id,$nilai)
    {
        $this->db->where($id,$nilai);
        $query= $this->db->get($tabel);
        return $query;
    }

	public function GetDataPenjualan()
    {
        $this->db->select('penjualan.*, pelanggan.NamaPelanggan');
        $this->db->from('penjualan');
        $this->db->join('pelanggan', 'penjualan.PelangganID = pelanggan.PelangganID', 'left');
        $query = $this->db->get();
        return $query->result();

    }

    public function GetDataDetailPenjualan()
    {
        
        $this->db->select('detailpenjualan.DetailID, penjualan.TanggalPenjualan, produk.NamaProduk, detailpenjualan.JumlahProduk, detailpenjualan.Subtotal');
        $this->db->from('detailpenjualan');
        $this->db->join('penjualan', 'penjualan.PenjualanID = detailpenjualan.PenjualanID', 'penjualan.TanggalPenjualan = detailpenjualan.TanggalPenjualan', );
        $this->db->join('produk', 'produk.ProdukID = detailpenjualan.ProdukID');
        $query = $this->db->get();
        return $query->result();

    }
    

    function DataPelanggan($cari)
    {
        $query = $this->db->query("Select * From pelanggan where NamaPelanggan  like '%$cari%'");
        return $query;
    }


    function DetailPenjualan($cari)
    {
        $query = $this->db->query("Select * From detailpenjualan where PenjualanID like '%$cari%'");
        return $query;
    }

    function DataProduk($cari)
    {
        $query = $this->db->query("Select * From produk where NamaProduk like '%$cari%'");
        return $query;
    }

	public function InsertData($table, $data)
    {
        // Implementasi logika penyimpanan data di sini
        $this->db->insert($table, $data);
    }

    public function hapus_penjualan_by_pelanggan($pelanggan_id) {
        $this->db->where('PelangganID', $pelanggan_id);
        $this->db->delete('penjualan'); 
    }

	public function get_penjualan_belum_selesai_by_pelanggan($pelanggan_id) {
        $this->db->where('PelangganID', $pelanggan_id);
        $this->db->where('status', 'belum selesai');
        $query = $this->db->get('penjualan');

        return $query->result();
    }

    public function update_status_penjualan($penjualan_id) {
        $this->db->where('PenjualanID', $penjualan_id);
        $this->db->update('penjualan', array('status' => 'selesai'));
    }

    public function update_status_penjualan_selesai($pelanggan_id) {
        $dataPenjualanBelumSelesai = $this->get_penjualan_belum_selesai_by_pelanggan($pelanggan_id);

        foreach ($dataPenjualanBelumSelesai as $penjualan) {
            // Tandai penjualan sebagai 'selesai'
            $this->update_status_penjualan($penjualan->PenjualanID);

            // Pindahkan data penjualan ke tabel detail_penjualan
            $this->pindah_ke_detail_penjualan($penjualan);
        }
    }

    public function pindah_ke_detail_penjualan($penjualan) {
        // Struktur kolom di tabel detail_penjualan harus disesuaikan dengan kebutuhan aplikasi kamu
        $dataDetailPenjualan = array(
            'PenjualanID' => date('Y-m-d'),
            'ProdukID' => $penjualan->ProdukID,
            'JumlahProduk' => $penjualan->quantity,
            'Subtotal' => $penjualan->quantity * $penjualan->Harga
        );

        // Masukkan data ke tabel detail_penjualan
        $this->db->insert('detailpenjualan', $dataDetailPenjualan);

        // Hapus data dari tabel penjualan
        $this->hapus_penjualan($penjualan->PenjualanID);
    }

    public function hapus_penjualan($penjualan_id) {
        $this->db->where('PenjualanID', $penjualan_id);
        $this->db->delete('penjualan');
    }

    public function getProdukInfoById($produkID) {
        // Kueri untuk mendapatkan informasi produk berdasarkan ProdukID
        $this->db->select('*');
        $this->db->from('produk');
        $this->db->where('ProdukID', $produkID);
        $query = $this->db->get();
    
        // Periksa apakah kueri berhasil
        if ($query->num_rows() > 0) {
            return $query->row(); // Mengembalikan satu baris hasil kueri
        } else {
            return null; // Produk tidak ditemukan
        }
    }

    public function getPdfDetailPenjualan() 
    {
        return $this->db->get('detailPenjualan')->result();
    }

    public function tambah_produk($data)
    {
        // Menyisipkan data ke dalam tabel 'produk'
        $this->db->insert('produk', $data);

        // Mengembalikan ID produk yang baru saja disisipkan
        return $this->db->insert_id();
    }

    public function update_stok_produk($id_produk, $quantity)
    {
        // Mengambil stok produk saat ini dari database
        $stok_sekarang = $this->db->select('Stok')->where('ProdukID', $id_produk)->get('produk')->row()->Stok;

        // Menghitung stok baru
        $stok_baru = $stok_sekarang - $quantity;

        // Memperbarui stok di database
        $this->db->where('ProdukID', $id_produk)->update('produk', ['Stok' => $stok_baru]);
    }

    public function GetDataUsers($users)
    {
        // Your logic to get data from the 'users' table goes here
        return $this->db->get($users);
    }

    public function insert_user($data) {
        return $this->db->insert('users', $data);
    }

    public function GetDataKategori($kategori)
    {
        // Your logic to get data from the 'users' table goes here
        return $this->db->get($kategori);
    }

    public function insert_kategori($data) {
        return $this->db->insert('kategori', $data);
    }

    public function getJumlahPelanggan()
    {
        return $this->db->count_all_results('pelanggan');
    }

    public function getJumlahProduk()
    {
        return $this->db->count_all_results('produk');
    }

    public function getJumlahDetailPenjualan()
    {
        return $this->db->count_all_results('detailpenjualan');
    }
    
    public function get_produk_with_kategori() {
        $this->db->select('produk.*, kategori.NamaKategori');
        $this->db->from('produk');
        $this->db->join('kategori', 'produk.KategoriID = kategori.KategoriID', 'left');
        $query = $this->db->get();
        return $query->result();
    }

    // public function remove_from_penjualan($ProdukID) 
    // {
    //     $this->db->where('ProdukID', $ProdukID);
    //     $this->db->delete('penjualan');
    // }

    public function GetDataDetailPenjualanById($DetailID) {
        // Query untuk mengambil detail penjualan berdasarkan ProdukID
        $this->db->select('*');
        $this->db->from('detailpenjualan');
        $this->db->where('DetailID', $DetailID);
        $query = $this->db->get();
    
        // Mengembalikan hasil query dalam bentuk array objek
        return $query->result();
    }

    public function getDataByTanggal($tanggal)
    {
        $this->db->select('*');
        $this->db->from('detailpenjualan');
        $this->db->where('DATE_FORMAT(tanggal_penjualan, "%Y-%m-%d")', $tanggal);
        $query = $this->db->get();

        return $query->result();
    }

    public function getFilteredData($filterType, $startDate, $endDate)
    {
        $this->db->select('*')->from('detailpenjualan');

        if ($filterType == 'perhari') {
            $this->db->where('DATE(PenjualanID)', $startDate);
        } elseif ($filterType == 'peringgu') {
            $this->db->where("DATE(PenjualanID) BETWEEN '$startDate' AND '$endDate'");
        } elseif ($filterType == 'perbulan') {
            $this->db->where("MONTH(PenjualanID) = MONTH('$startDate') AND YEAR(PenjualanID) = YEAR('$startDate')");
        }

        $query = $this->db->get();
        return $query->result();
    }
} 
