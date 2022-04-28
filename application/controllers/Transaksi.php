<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('user_agent');
		$this->load->library('table');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('cookie');
		$this->load->helper('url');
		$this->load->model('Asset');
		$this->load->model('User');
	}

	public function index(){
		if (get_cookie("login") != NULL){
			$this->session->set_userdata('login', get_cookie("login"));
		}
		if ($this->session->has_userdata('login')){
			//sudah login
			$user = $this->User->getUserLogin($this->session->userdata('login'));
			if ($user->AKSES_RUMAH >= 2 || $user->AKSES_GEDUNG >= 2 || $user->AKSES_KENDARAAN >= 2 || $user->AKSES_ASRAMA >= 2 || $user->AKSES_FASILITAS >= 2){
				//memiliki akses
				$data["login"] = $user;
				$data['listDataKategori'] = $this->Asset->getDataKategori();
				$this->load->view('transaksi', $data);
			}
			else{
				redirect($this->agent->referrer());
			}
		}
		else{
			//belum login
			redirect(site_url("auth/login"));
		}
	}

	public function addPeminjaman(){
		$this->form_validation->set_rules('kode', 'Kode aset', 'required');
		$this->form_validation->set_rules('nik', 'NIK', 'required');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
		if (empty($_FILES['file']['name']))
		{
			$this->form_validation->set_rules('hiddenfile', 'File', 'required');
		}
		if ($this->input->post('kategori') == 4){
			$this->form_validation->set_rules('nik', 'NIK', 'required|callback_checkuser['.$this->input->post('nik').']');
		}

		$this->form_validation->set_message('required', '&nbsp{field} harus diisi!&nbsp');

		$data['kode'] = $this->input->post('kode');
		$data['kategori'] = $this->input->post('kategori');
		$data['nik'] = $this->input->post('nik');
		$data['tanggal'] = $this->input->post('tanggal');
		$data['user'] = $this->User->getUserLogin($this->session->userdata('login'))->NAMA;
		$data['file'] = $this->input->post('file');
		
		if ($this->form_validation->run() == FALSE)
		{	
			$json_response = $this->form_validation->error_array();
			echo json_encode($json_response);
		}
		else
		{
			$response["message"] = $this->Asset->addPeminjaman($data);
			echo json_encode($response);
		}
	}

	public function checkUser($nik){
		if (get_cookie("login") != NULL){
			$this->session->set_userdata('login', get_cookie("login"));
		}
		if ($this->session->has_userdata('login')){
			$data["user"] = $this->User->getUserbyKey($nik)[0];
			if ($data["user"]->FK_ASSET == NULL){
				return true;
				
			}
			else{
				$this->form_validation->set_message('checkuser','&nbspUser sudah menempati asrama!&nbsp');
        		return false;
			}
		}
		else{
			redirect(site_url("auth/login"));
		}
	}

	public function PengembalianAset(){
		$this->form_validation->set_rules('kodetrans', 'Kode transaksi', 'required');

		$this->form_validation->set_message('required', '&nbsp{field} harus diisi!&nbsp');

		$data['kode'] = $this->input->post('kodetrans');
		
		if ($this->form_validation->run() == FALSE)
		{	
			$json_response = $this->form_validation->error_array();
			echo json_encode($json_response);
		}
		else
		{
			$response["message"] = $this->Asset->PengembalianAset($data);
			echo json_encode($response);
		}
	}

	// public function searchPenggunaAset(){
	// 	$data['nik'] = $this->input->post('nama');
	// 	$response["message"] = $this->Asset->searchPenggunaAset($data);
	// }
}
