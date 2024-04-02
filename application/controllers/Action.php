<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Action extends CI_Controller
{

    public $input;
	public $MSudi;

	function __construct()
	{
		parent::__construct();
		$this->load->model('MSudi');
	}

    public function users()
    {
        $this->load->model('MSudi');
        $data['DataUsers'] = $this->MSudi->GetData('users');
        
        $this->load->view('_layout/header', $data);
		$this->load->view('_layout/sidebarAdmin', $data);
		$this->load->view('_layout/topbar', $data);
        
        
        $this->load->view('VUsers', $data);
        $this->load->view('_layout/footer');
        
    }

    public function addUsers()
    {
        
        $this->load->model('MSudi');
            $add['id'] = $this->input->post('id');
            $add['username'] = $this->input->post('username');
            $add['email'] = $this->input->post('email');
            $add['password'] = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
            $add['role'] = $this->input->post('role');

            $this->MSudi->AddData('users', $add);

            redirect(site_url('Action/users'));
    }

    public function updateUsers()
    {
        $this->load->model('MSudi');
        $a = $this->input->post('id');
        $update['username'] = $this->input->post('username');
        $update['email'] = $this->input->post('email');
        $update['password'] = $this->input->post('password');
        $update['role'] = $this->input->post('role');

        $this->MSudi->UpdateData('users', 'id',  $a, $update);

        redirect(site_url('Action/users'));
    }

    public function deleteUsers($users)
    {
        
        $this->load->model('MSudi');
        $this->MSudi->DeleteData('users', 'id', $users);

        // Redirect ke halaman master setelah penghapusan
            redirect(site_url('Action/users'));
    }

    public function kategori()
    {
        $this->load->model('MSudi');
        $data['DataKategori'] = $this->MSudi->GetData('kategori');
        
        $this->load->view('_layout/header', $data);
		$this->load->view('_layout/sidebarAdmin', $data);
		$this->load->view('_layout/topbar', $data);

        $this->load->view('VKategori', $data);
        
    }

    public function addKategori()
    {
        $add['KategoriID'] = $this->input->post('KategoriID');
        $add['NamaKategori'] = $this->input->post('NamaKategori');
        $add['TanggalKategori'] = $this->input->post('TanggalKategori');

        $this->MSudi->AddData('kategori', $add);

        redirect(site_url('Action/kategori'));

    }

    public function updateKategori()
    {
        $this->load->model('MSudi');
        $a = $this->input->post('KategoriID');
        $update['NamaKategori'] = $this->input->post('NamaKategori');
        $update['TanggalKategori'] = $this->input->post('TanggalKategori');

        $this->MSudi->UpdateData('kategori', 'KategoriID',  $a, $update);

        redirect(site_url('Action/kategori'));
    }

    public function deleteKategori($kategori)
    {
        
        $this->load->model('MSudi');
        $this->MSudi->DeleteData('kategori', 'KategoriID', $kategori);

        // Redirect ke halaman master setelah penghapusan
            redirect(site_url('Action/kategori'));
    }



    public function registrasi() {
        $this->load->library('form_validation');
        $this->load->model('MSudi'); // Using MSudi as the model name
    
        // Form validation rules
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
    
        if ($this->form_validation->run() == FALSE) {
            // Validation failed, show registration form again
            $this->load->view('Register');
        } else {
            // Validation successful, insert user data into the database
            $data = array(
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                'role' => 'admin'
            );
    
            if ($this->MSudi->insert_user($data)) { // Using MSudi as the model name
                // Registration successful, redirect to a login page or show a success message
                redirect('login');
            } else {
                // Registration failed, show an error message
                echo "Registration failed!";
            }
        }
    }
    

    public function logout()
        {
            // Unset session data
            $this->session->unset_userdata('Login');

            // Redirect to 'Login' controller
            redirect(site_url('Login'));
        }

        public function simpan_pelanggan()
        {
            $this->load->model('MSudi');

            $dataPelanggan = array(
                'NamaPelanggan' => $this->input->post('NamaPelanggan'),
                'Alamat' => $this->input->post('Alamat'),
                'NomorTelepon' => $this->input->post('NomorTelepon')
            );

            $pelanggan_id = $this->MSudi->InsertData('pelanggan', $dataPelanggan);

            // Setelah berhasil menyimpan pelanggan, tandai penjualan sebagai 'selesai'
            $this->tandai_penjualan_selesai($pelanggan_id);

            // Redirect atau lakukan operasi lain
            redirect('welcome/penjualan');
        }

        private function tandai_penjualan_selesai($pelanggan_id) {
            // Tandai penjualan sebagai 'selesai' berdasafrkan pelanggan_id
            $this->MSudi->update_status_penjualan_selesai($pelanggan_id);
        }

		public function export_pdf_detailpenjualan()
		{
			$selectedDate = $this->input->post('selectedDate'); // Pastikan 'selectedDate' sesuai dengan nama input di form Anda

			$this->load->model('MSudi');
			$data['detailPenjualan'] = $this->MSudi->getPdfDetailPenjualan($selectedDate);
			$data['DataProduk'] = $this->MSudi->GetData('produk');

			$this->load->library('Pdf');
			$this->pdf->setPaper('A4', 'landscape');
			$this->pdf->filename = "laporan.pdf";
			$this->pdf->load_view('admin/ExportPdf', $data);
		}


    public function exportStruk($DetailID) 
    {
        $this->load->model('MSudi');
        $data['DetailPenjualan'] = $this->MSudi->GetDataDetailPenjualanById($DetailID);
        $data['DataProduk'] = $this->MSudi->GetData('produk');        
        $this->load->library('Pdf');
        
        $this->pdf->filename = "laporan.pdf";
        
        $this->pdf->load_view('petugas/ExportStruk', $data);
    }
    

    public function remove_from_penjualan($ProdukID) 
    {
        $this->MSudi->remove_from_penjualan($ProdukID);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function filter_detail_penjualan() 
    {
        $this->load->view('_layout/header');
        $this->load->view('_layout/sidebarAdmin');
        $this->load->view('_layout/topbar');
        
        // Get start and end date from form
        $startDate = $this->input->post('startDate');
        $endDate = $this->input->post('endDate');
        
        $this->load->model('MSudi');
        
        // Modify your model method to handle date range
        $filteredData = $this->MSudi->get_detail_penjualan_by_date_range($startDate, $endDate);
        
        $data['DetailPenjualan'] = $filteredData;
        $data['DataProduk'] = $this->MSudi->GetData('produk');
        
        $this->load->view('admin/VDPenjualan', $data);
        $this->load->view('_layout/footer');
    }



    public function GetChartData()
    {
        $dailySales = $this->MSudi->GetDailySales();
    
        // Tambahkan log
        error_log(print_r($dailySales, true));
    
        $dataPoints = array();
        foreach ($dailySales as $date => $daily) {
            $dataPoints[] = array(
                'date' => $date,
                'Subtotal' => $daily['Subtotal'],
            );
        }
    
        $result['chart_data'] = $dataPoints;
        echo json_encode($result);
    }
}

