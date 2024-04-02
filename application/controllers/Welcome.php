<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public $input;
	public $MSudi;

	function __construct()
	{
		parent::__construct();
		$this->load->model('MSudi');
	}
	
	public function index()
	{
		if (!$this->session->userdata('user_id')) {
			redirect('login');
		}

		$role = $this->session->userdata('role');
		if ($role == 'admin') {
			
			$this->load->view('_layout/header', $data);
			$this->load->view('_layout/sidebarAdmin', $data);
			$this->load->view('_layout/topbar', $data);
			$this->load->model('MSudi');
			$data['jumlahPelanggan'] = $this->MSudi->getJumlahPelanggan();
			$data['jumlahProduk'] = $this->MSudi->getJumlahProduk();
			$data['jumlahDetailPenjualan'] = $this->MSudi->getJumlahDetailPenjualan();
			$this->load->view('admin/beranda_admin', $data);
			$this->load->view('_layout/footer');
		} elseif ($role == 'petugas') {
			$this->load->view('_layout/header', $data);
			$this->load->view('_layout/sidebarPetugas', $data);
			$this->load->view('_layout/topbar', $data);
			$this->load->model('MSudi');
			$data['jumlahPelanggan'] = $this->MSudi->getJumlahPelanggan();
			$data['jumlahProduk'] = $this->MSudi->getJumlahProduk();
			$data['jumlahDetailPenjualan'] = $this->MSudi->getJumlahDetailPenjualan();
			$this->load->view('petugas/beranda_petugas', $data);
			$this->load->view('_layout/footer');

		} else {
			redirect('landingpage'); 
		}
	}

	public function pelanggan()
	{
		if (!$this->session->userdata('user_id')) {
			redirect('login');
		}

		$role = $this->session->userdata('role');
		if ($role == 'admin') {
			$data['title'] = 'Data Pelanggan';
			
			$this->load->model('MSudi');
			$this->load->view('_layout/header', $data);
			$this->load->view('_layout/sidebarAdmin', $data);
			$this->load->view('_layout/topbar', $data);
            $cari = $this->input->post('txt_cari');
            $data['DataPelanggan'] = $this->MSudi->GetData('pelanggan');
            $data['DataPelanggan'] = $this->MSudi->DataPelanggan($cari)->result();
			$this->load->view('admin/VPelanggan', $data);
			$this->load->view('_layout/footer');
		} elseif ($role == 'petugas') {
			$this->load->model('MSudi');
			$this->load->view('_layout/header', $data);
			$this->load->view('_layout/sidebarPetugas', $data);
			$this->load->view('_layout/topbar', $data);
			$cari = $this->input->post('txt_cari');
            $data['DataPelanggan'] = $this->MSudi->GetData('pelanggan');
            $data['DataPelanggan'] = $this->MSudi->DataPelanggan($cari)->result();
			$this->load->view('petugas/VPelanggan', $data);
			$this->load->view('_layout/footer');

		} else {
			redirect('landingpage'); 
		}
	}

	public function penjualan()
	{
		if (!$this->session->userdata('user_id')) {
			redirect('login');
		}

		$role = $this->session->userdata('role');
		if ($role == 'admin') {
			$data['title'] = 'Data Penjualan';
			
			$this->load->view('_layout/header', $data);
			$this->load->view('_layout/sidebarAdmin', $data);
			$this->load->view('_layout/topbar', $data);
			$this->load->model('MSudi');
			$data['DataProduk'] = $this->MSudi->GetData('produk');
			$data['DataPenjualan'] = $this->MSudi->GetData('penjualan');
			$this->load->view('admin/VPenjualan', $data);
			$this->load->view('_layout/footer');
		} elseif ($role == 'petugas') {
			$this->load->view('_layout/header', $data);
			$this->load->view('_layout/sidebarPetugas', $data);
			$this->load->view('_layout/topbar', $data);
			$this->load->model('MSudi');
			$data['DataProduk'] = $this->MSudi->GetData('produk');
			$data['DataPenjualan'] = $this->MSudi->GetData('penjualan');
			$this->load->view('petugas/VPenjualan', $data);
			$this->load->view('_layout/footer');

		} else {
			redirect('landingpage'); 
		}
	}

	public function detailPenjualan()
	{
		if (!$this->session->userdata('user_id')) {
			redirect('login');
		}

		$role = $this->session->userdata('role');
		if ($role == 'admin') {
			$data['title'] = 'Data Produk';
			
			$this->load->view('_layout/header', $data);
			$this->load->view('_layout/sidebarAdmin', $data);
			$this->load->view('_layout/topbar', $data);
			$this->load->model('MSudi');
            $cari= $this->input->post('txt_cari');
            $data['DetailPenjualan'] = $this->MSudi->GetData('detailpenjualan');
            $data['DataProduk'] = $this->MSudi->GetData('produk');
            $data['DataPelanggan'] = $this->MSudi->GetData('pelanggan');
            $data['DataPenjualan'] = $this->MSudi->GetData('penjualan');
			$this->load->view('admin/VDPenjualan', $data);
			$this->load->view('_layout/footer');
		} elseif ($role == 'petugas') {
			$this->load->view('_layout/header', $data);
			$this->load->view('_layout/sidebarPetugas', $data);
			$this->load->view('_layout/topbar', $data);
			$this->load->model('MSudi');
            $cari= $this->input->post('txt_cari');
            $data['DetailPenjualan'] = $this->MSudi->GetData('detailpenjualan');
            $data['DataProduk'] = $this->MSudi->GetData('produk');
			$data['DataPelanggan'] = $this->MSudi->GetData('pelanggan');
            $data['DataPenjualan'] = $this->MSudi->GetData('penjualan');
			$this->load->view('petugas/VDPenjualan', $data);
			$this->load->view('_layout/footer');

		} else {
			redirect('landingpage'); 
		}
	}

	public function produk()
	{
		if (!$this->session->userdata('user_id')) {
			redirect('login');
		}

		$role = $this->session->userdata('role');
		if ($role == 'admin') {
			$data['title'] = 'Data Produk';
			
			$this->load->view('_layout/header', $data);
			$this->load->view('_layout/sidebarAdmin', $data);
			$this->load->view('_layout/topbar', $data);
			$this->load->model('MSudi');
			$cari=$this->input->post('txt_cari');
            $data['DataProduk'] = $this->MSudi->GetData('produk');
			$data['DataProduk'] = $this->MSudi->get_produk_with_kategori();
            $data['DataKategori'] = $this->MSudi->GetData('kategori');
            $data['DataProduk'] = $this->MSudi->DataProduk($cari)->result();
			$this->load->view('admin/VProduk', $data);
			$this->load->view('_layout/footer');
		} elseif ($role == 'petugas') {
			$this->load->view('_layout/header', $data);
			$this->load->view('_layout/sidebarPetugas', $data);
			$this->load->view('_layout/topbar', $data);
			$this->load->model('MSudi');
			$cari=$this->input->post('txt_cari');
            $data['DataProduk'] = $this->MSudi->GetData('produk');
			$data['DataProduk'] = $this->MSudi->get_produk_with_kategori();
			$data['DataKategori'] = $this->MSudi->GetData('kategori');
            $data['DataProduk'] = $this->MSudi->DataProduk($cari)->result();
			$this->load->view('petugas/VProduk', $data);
			$this->load->view('_layout/footer');

		} else {
			redirect('landingpage'); 
		}
	}

	public function tambah_ke_penjualan()
    {
        $id_produk = $this->input->post('ProdukID');
        $nama_produk = $this->input->post('NamaProduk');
        $harga = $this->input->post('Harga');
        $quantity = $this->input->post('Stok');

        $total_harga = $harga * $quantity;

        $data_penjualan = array(
            'TanggalPenjualan' => date('Y-m-d H:i:s'),
            'Harga' => $total_harga,
            'ProdukID' => $id_produk,
            'quantity' => $quantity
        );

        $this->load->model('MSudi'); 
        $this->MSudi->InsertData('penjualan', $data_penjualan);
        $this->MSudi->update_stok_produk($id_produk, $quantity);

        redirect(site_url('Welcome/penjualan'));
    }

	// Controller Add Data

    public function addDataPelanggan()
    {

            $add['PelangganID'] = $this->input->post('PelangganID');
            $add['NamaPelanggan'] = $this->input->post('NamaPelanggan');
            $add['Alamat'] = $this->input->post('Alamat');
            $add['NomorTelepon'] = $this->input->post('NomorTelepon');
    
            $this->MSudi->AddData('pelanggan', $add);
    
            redirect(site_url('Welcome/pelanggan'));
    }

    public function addDataPenjualan()
    {

            $add['PenjualanID'] = $this->input->post('PenjualanID');
            $add['TanggalPenjualan'] = $this->input->post('TanggalPenjualan');
            $add['TotalHarga'] = $this->input->post('TotalHarga');
            $add['PelangganID'] = $this->input->post('PelangganID');
    
            $this->MSudi->AddData('penjualan', $add);
    
            redirect(site_url('Welcome/penjualan'));
    }

    public function addDetailPenjualan()
    {

            $add['DetailID'] = $this->input->post('DetailID');
            $add['PenjualanID'] = $this->input->post('PenjualanID');
            $add['ProdukID'] = $this->input->post('ProdukID');
            $add['JumlahProduk'] = $this->input->post('JumlahProduk');
            $add['Subtotal'] = $this->input->post('Subtotal');

            $this->MSudi->AddData('detailpenjualan', $add);

            redirect(site_url('Welcome/detailPenjualan'));
    }


    public function addDataProduk()
	{
			$add['ProdukID'] = $this->input->post('ProdukID');
			$add['NamaProduk'] = $this->input->post('NamaProduk');
			$add['KategoriID'] = $this->input->post('KategoriID'); 
			$add['Harga'] = $this->input->post('Harga');
			$add['Stok'] = $this->input->post('Stok');

			// Call the model method to insert data into the database
			$this->MSudi->AddData('produk', $add);

			// Redirect to the specified page after successful data insertion
			redirect(site_url('Welcome/produk'));
	}

    // Controller Update Data

    public function updatePelanggan()
    {
        $a = $this->input->post('PelangganID');
        $update['NamaPelanggan'] = $this->input->post('NamaPelanggan');
        $update['Alamat'] = $this->input->post('Alamat');
        $update['NomorTelepon'] = $this->input->post('NomorTelepon');

        $this->MSudi->UpdateData('pelanggan', 'PelangganID',  $a, $update);

        redirect(site_url('Welcome/pelanggan'));
        
    }

    public function updateDataPenjualan()
    {

        $a = $this->input->post('PenjualanID');
        $update['TanggalPenjualan'] = $this->input->post('TanggalPenjualan');
        $update['TotalHarga'] = $this->input->post('TotalHarga');
        $update['PelangganID'] = $this->input->post('PelangganID');

        $this->MSudi->UpdateData('penjualan', 'PenjualanID', $a, $update);

        redirect(site_url('Welcome/penjualan'));
    }

    public function updateDataDetailPenjualan()
    {

        $a = $this->input->post('DetailID');
        $update['PejualanID'] = $this->input->post('PejualanID');
        $update['ProdukID'] = $this->input->post('ProdukID');
        $update['JumlahProduk'] = $this->input->post('JumlahProduk');
        $update['Subtotal'] = $this->input->post('Subtotal');

        $this->MSudi->UpdateData('detailpenjualan', 'DetailID', $a, $update);
            
        redirect(site_url('Welcome/detailPenjualan'));
    }

    public function updateDataProduk()
    {

        $a = $this->input->post('ProdukID');
        $update['NamaProduk'] = $this->input->post('NamaProduk');
        $update['KategoriID'] = $this->input->post('KategoriID');
        $update['Harga'] = $this->input->post('Harga');
        $update['Stok'] = $this->input->post('Stok');

        $this->MSudi->UpdateData('produk', 'ProdukID', $a, $update);

        redirect(site_url('Welcome/produk'));
    }


    // Controller Delete Data

    public function deleteDataPelanggan($PelangganID)
    {

            $this->load->model('MSudi');
            $this->MSudi->DeleteData('pelanggan', 'PelangganID', $PelangganID);

        // Redirect ke halaman master setelah penghapusan
            redirect(site_url('Welcome/pelanggan'));
    }

    public function deleteDataPenjualan($PenjualanID)
    {
        
            $this->load->model('MSudi');
            $this->MSudi->DeleteData('penjualan', 'PenjualanID', $PenjualanID);

        // Redirect ke halaman master setelah penghapusan
            redirect(site_url('Welcome/penjualan'));
    }

    public function deleteDataDetailPenjualan($DetailID)
    {

            $this->load->model('MSudi');
            $this->MSudi->DeleteData('detailpenjualan', 'DetailID', $DetailID);

        // Redirect ke halaman master setelah penghapusan
            redirect(site_url('Welcome/detailPenjualan'));
    }

    public function deleteDataProduk($ProdukID)
    {

            $this->load->model('MSudi');
            $this->MSudi->DeleteData('produk', 'ProdukID', $ProdukID);

        // Redirect ke halaman master setelah penghapusan
            redirect(site_url('Welcome/produk'));
    }

	public function getDataPenjualan() 
	{
        $query = $this->db->query("SELECT PenjualanID, JumlahPenjualan FROM detaipenjualan");
        $result = $query->result_array();

        echo json_encode($result);
    }
}
