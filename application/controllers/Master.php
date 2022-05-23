<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master extends CI_Controller
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

	public function index()
	{
		if (get_cookie("login") != NULL){
			$this->session->set_userdata('login', get_cookie("login"));
		}
		if ($this->session->has_userdata('login')){
			$data["login"] = $this->User->getUserLogin($this->session->userdata('login'));
			$data['jumlahrumah'] = $this->Asset->getJumRumahDinas();
			$data['jumlahgedung'] = $this->Asset->getJumGedung();
			$data['jumlahkendaraan'] = $this->Asset->getJumKendaraan();
			$data['jumlahasrama'] = $this->Asset->getJumAsrama();
			$data['jumlahfasilitas'] = $this->Asset->getJumFasilitas();
			$this->load->view('home', $data);
		}
		else{
			redirect(site_url("auth/login"));
		}
	}

	public function profil()
	{
		if (get_cookie("login") != NULL){
			$this->session->set_userdata('login', get_cookie("login"));
		}
		if ($this->session->has_userdata('login')){
			$data["login"] = $this->User->getUserLogin($this->session->userdata('login'));
			$this->load->view('master/profil', $data);
		}
		else{
			redirect(site_url("auth/login"));
		}
	}

	public function ubahPassword(){
		$this->form_validation->set_rules('passlama', 'Password lama', 'required|callback_checkpassword');
		$this->form_validation->set_rules('passbaru', 'Password baru', 'required|min_length[8]|alpha_dash');
		$this->form_validation->set_rules('konfirmasi', 'Konfirmasi password', 'required|matches[passbaru]');

		$this->form_validation->set_message('required', ' {field} harus diisi!&nbsp');
		$this->form_validation->set_message('min_length', ' {field} minimal 8 digit!&nbsp');
		$this->form_validation->set_message('alpha_dash', ' {field} hanya boleh huruf, angka, underscore, dan dash!&nbsp');
		$this->form_validation->set_message('matches', ' password & konfirmasi harus sama!&nbsp');

		$data["passbaru"] = $this->input->post('passbaru');
		$data["nik"] = $this->User->getUserLogin($this->session->userdata('login'))->NIK;

		if ($this->form_validation->run() == FALSE)
		{	
			$json_response = $this->form_validation->error_array();
			echo json_encode($json_response);
		}
		else
		{
			$response["message"] = $this->User->ubahPassword($data);
			echo json_encode($response);
		}
	}

	public function checkPassword(){
		if (get_cookie("login") != NULL){
			$this->session->set_userdata('login', get_cookie("login"));
		}
		if ($this->session->has_userdata('login')){
			$data["login"] = $this->User->getUserLogin($this->session->userdata('login'));
			$passlama = $this->input->post('passlama');
			if ($passlama == $data["login"]->PASSWORD){
				return true;
			}
			else{
				$this->form_validation->set_message('checkpassword',' Password salah!&nbsp');
        		return false;
			}
		}
		else{
			redirect(site_url("auth/login"));
		}
	}

	public function listrumah()
	{
		if (get_cookie("login") != NULL){
			$this->session->set_userdata('login', get_cookie("login"));
		}
		if ($this->session->has_userdata('login')){
			$data["login"] = $this->User->getUserLogin($this->session->userdata('login'));
			$data['listrumah'] = $this->Asset->getRumahDinas();
			$data['user'] = $this->User->getUser();
			$this->load->view('list/rumahdinas', $data);
		}
		else{
			redirect(site_url("auth/login"));
		}
	}
	public function listgedung()
	{
		if (get_cookie("login") != NULL){
			$this->session->set_userdata('login', get_cookie("login"));
		}
		if ($this->session->has_userdata('login')){
			$data["login"] = $this->User->getUserLogin($this->session->userdata('login'));
			$data['listgedung'] = $this->Asset->getGedung();
			$data['user'] = $this->User->getUser();
			$this->load->view('list/gedung', $data);
		}
		else{
			redirect(site_url("auth/login"));
		}
	}
	public function listkendaraan()
	{
		if (get_cookie("login") != NULL){
			$this->session->set_userdata('login', get_cookie("login"));
		}
		if ($this->session->has_userdata('login')){
			$data["login"] = $this->User->getUserLogin($this->session->userdata('login'));
			$data['listkendaraan'] = $this->Asset->getKendaraan();
			$data['user'] = $this->User->getUser();
			$this->load->view('list/kendaraan', $data);
		}
		else{
			redirect(site_url("auth/login"));
		}
	}
	public function listasrama()
	{
		if (get_cookie("login") != NULL){
			$this->session->set_userdata('login', get_cookie("login"));
		}
		if ($this->session->has_userdata('login')){
			$data["login"] = $this->User->getUserLogin($this->session->userdata('login'));
			$data['listAsrama'] = $this->Asset->getAsrama();
			$data['listJumlahPenghuni'] = $this->User->getJumlahPenghuni($data['listAsrama']);
			$data['user'] = $this->User->getUser();
			$this->load->view('list/asrama', $data);
		}
		else{
			redirect(site_url("auth/login"));
		}
	}
	public function listfasilitas()
	{
		
		if (get_cookie("login") != NULL){
			$this->session->set_userdata('login', get_cookie("login"));
		}
		if ($this->session->has_userdata('login')){
			$data["login"] = $this->User->getUserLogin($this->session->userdata('login'));
			$data['listFasilitas'] = $this->Asset->getFasilitas();
			$data['user'] = $this->User->getUser();
			$this->load->view('list/fasilitas', $data);
		}
		else{
			redirect(site_url("auth/login"));
		}
	}
	public function detailAsset()
	{
		$key = $this->input->post('key');
		$data["asset"] = $this->Asset->getAssetbyKey($key);
		$data["fasilitas"] = $this->Asset->getFasilitasAsset($key);
		$data["transaksi"] = $this->Asset->getTransaksiAsset($key);
		$data["gambar"] = $this->Asset->getImageAsset($key);
		$data["user"] = $this->User->getUserAsset($key);
		echo json_encode($data);
	}

	public function searchAssetPeminjaman(){
		$data["nama"] = $this->input->post('nama');
		$data["lokasi"] = $this->input->post('lokasi');
		$data["kategori"] = $this->input->post('kategori');
		$data["aset"] = $this->Asset->getAssetbyFilterAndCategory($data);
		echo json_encode($data);
	}

	public function searchPenggunaAset(){
		$filter["nik"] = $this->input->post('nik');
		$filter["kategori"] = $this->input->post('kategori');
		$filter["aset"] = $this->input->post('aset');
		$data["peminjaman"] = $this->Asset->searchPenggunaAset($filter);
		echo json_encode($data);
	}

	public function detailUser()
	{
		$key = $this->input->post('key');
		$data["user"] = $this->User->getUserbyKey($key);
		echo json_encode($data);
	}

	public function detailhistory()
	{
		$key = $this->input->post('key');
		$data["transaksi"] = $this->Asset->getDetailHistory($key);
		$data["gambar"] = $this->Asset->getImageAsset($key);
		echo json_encode($data);
	}

	public function master(){
		if (get_cookie("login") != NULL){
			$this->session->set_userdata('login', get_cookie("login"));
		}
		if ($this->session->has_userdata('login')){
			//sudah login
			$user = $this->User->getUserLogin($this->session->userdata('login'));
			$data["login"] = $user;
			if ($user->AKSES_RUMAH + $user->AKSES_GEDUNG + $user->AKSES_KENDARAAN + $user->AKSES_ASRAMA + $user->AKSES_FASILITAS + $user->AKSES_USER + $user->AKSES_LAPORAN > 0){
				$this->load->view('master/home', $data);
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

	public function masterUser(){
		if (get_cookie("login") != NULL){
			$this->session->set_userdata('login', get_cookie("login"));
		}
		if ($this->session->has_userdata('login')){
			//sudah login
			$user = $this->User->getUserLogin($this->session->userdata('login'));
			if ($user->AKSES_USER == 1){
				$data['listuser'] = $this->User->getUser();
				$data["login"] = $user;
				$this->load->view('master/user',$data);
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

	public function masterRumah(){
		if (get_cookie("login") != NULL){
			$this->session->set_userdata('login', get_cookie("login"));
		}
		if ($this->session->has_userdata('login')){
			//sudah login
			$user = $this->User->getUserLogin($this->session->userdata('login'));
			if ($user->AKSES_RUMAH == 1 || $user->AKSES_RUMAH == 3){
				$data["login"] = $user;
				$data['listrumah'] = $this->Asset->getRumahDinas();
				$this->load->view('master/rumahdinas', $data);
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
	
	public function masterGedung(){
		if (get_cookie("login") != NULL){
			$this->session->set_userdata('login', get_cookie("login"));
		}
		if ($this->session->has_userdata('login')){
			//sudah login
			$user = $this->User->getUserLogin($this->session->userdata('login'));
			if ($user->AKSES_GEDUNG == 1 || $user->AKSES_GEDUNG == 3){
				$data["login"] = $user;
				$data['listgedung'] = $this->Asset->getGedung();
				$this->load->view('master/gedung',$data);
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

	public function masterKendaraan(){
		if (get_cookie("login") != NULL){
			$this->session->set_userdata('login', get_cookie("login"));
		}
		if ($this->session->has_userdata('login')){
			//sudah login
			$user = $this->User->getUserLogin($this->session->userdata('login'));
			if ($user->AKSES_KENDARAAN == 1 || $user->AKSES_KENDARAAN == 3){
				$data["login"] = $user;
				$data['listkendaraan'] = $this->Asset->getKendaraan();
				$this->load->view('master/kendaraan', $data);
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

	public function masterAsrama(){
		if (get_cookie("login") != NULL){
			$this->session->set_userdata('login', get_cookie("login"));
		}
		if ($this->session->has_userdata('login')){
			//sudah login
			$user = $this->User->getUserLogin($this->session->userdata('login'));
			if ($user->AKSES_ASRAMA == 1 || $user->AKSES_ASRAMA == 3){
				$data["login"] = $user;
				$data['listAsrama'] = $this->Asset->getAsrama();
				$data['listJumlahPenghuni'] = $this->User->getJumlahPenghuni($data['listAsrama']);
				$this->load->view('master/asrama', $data);
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

	public function masterFasilitas(){
		if (get_cookie("login") != NULL){
			$this->session->set_userdata('login', get_cookie("login"));
		}
		if ($this->session->has_userdata('login')){
			//sudah login
			$user = $this->User->getUserLogin($this->session->userdata('login'));
			if ($user->AKSES_FASILITAS == 1 || $user->AKSES_FASILITAS == 3){
				$data["login"] = $user;
				$data['listFasilitas'] = $this->Asset->getFasilitas();
				$this->load->view('master/fasilitas', $data);
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

	public function masterLaporan(){
		if (get_cookie("login") != NULL){
			$this->session->set_userdata('login', get_cookie("login"));
		}
		if ($this->session->has_userdata('login')){
			//sudah login
			$user = $this->User->getUserLogin($this->session->userdata('login'));
			if ($user->AKSES_LAPORAN == 1){
				$data["login"] = $user;
				$data['listDataKategori'] = $this->Asset->getDataKategori();
				$data['listDataAktivitas'] = $this->Asset->getDataAktivitas();
				$this->load->view('master/laporan', $data);
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

	public function jumlahAsset(){
		$key = $this->input->post('key');
		$data['count'] = $this->Asset->getAssetCount($key);
		echo json_encode($data);
	}

	public function generateNIK(){
		$data['count'] = str_pad(($this->User->getUserCount() + 1), 6, "0", STR_PAD_LEFT);;
		echo json_encode($data);
	}

	public function jumlahAsrama(){
		$fk = $this->input->post('key');
		$nama = $this->input->post('nama');
		$data['count'] = $this->Asset->getAssetCount($fk, $nama);
		echo json_encode($data);
	}

	public function addUser(){
		$this->form_validation->set_rules('nik', 'NIK', 'required');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('departemen', 'Departemen', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|alpha_dash');
		$this->form_validation->set_rules('konfirmasi', 'Konfirmasi password', 'required|matches[password]');

		$this->form_validation->set_message('required', ' {field} harus diisi!&nbsp');
		$this->form_validation->set_message('min_length', ' {field} minimal 8 digit!&nbsp');
		$this->form_validation->set_message('alpha_dash', ' {field} hanya boleh huruf, angka, underscore, dan dash!&nbsp');
		$this->form_validation->set_message('matches', ' password & konfirmasi harus sama!&nbsp');

		$data['nik'] = $this->input->post('nik');
		$data['nama'] = $this->input->post('nama');	
		$data['departemen'] = $this->input->post('departemen');
		$data['password'] = $this->input->post('password');

		$data['masterrumah'] = $this->input->post('masterrumah');
		$data['transrumah'] = $this->input->post('transrumah');
		$data['mastergedung'] = $this->input->post('mastergedung');
		$data['transgedung'] = $this->input->post('transgedung');
		$data['masterkendaraan'] = $this->input->post('masterkendaraan');
		$data['transkendaraan'] = $this->input->post('transkendaraan');
		$data['masterasrama'] = $this->input->post('masterasrama');
		$data['transasrama'] = $this->input->post('transasrama');
		$data['masterfasilitas'] = $this->input->post('masterfasilitas');
		$data['transfasilitas'] = $this->input->post('transfasilitas');
		
		$data['masteruser'] = $this->input->post('masteruser');
		$data['masterlaporan'] = $this->input->post('masterlaporan');

		if ($this->form_validation->run() == FALSE)
		{	
			$json_response = $this->form_validation->error_array();
			echo json_encode($json_response);
		}
		else
		{
			$response["message"] = $this->User->addUser($data);
			echo json_encode($response);
		}
	}

	public function editUser(){
		$this->form_validation->set_rules('nik', 'NIK', 'required');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('departemen', 'Departemen', 'required');

		$this->form_validation->set_message('required', ' {field} harus diisi!&nbsp');

		$data['nik'] = $this->input->post('nik');
		$data['nama'] = $this->input->post('nama');
		$data['departemen'] = $this->input->post('departemen');
		
		$data['masterrumah'] = $this->input->post('masterrumah');
		$data['transrumah'] = $this->input->post('transrumah');
		$data['mastergedung'] = $this->input->post('mastergedung');
		$data['transgedung'] = $this->input->post('transgedung');
		$data['masterkendaraan'] = $this->input->post('masterkendaraan');
		$data['transkendaraan'] = $this->input->post('transkendaraan');
		$data['masterasrama'] = $this->input->post('masterasrama');
		$data['transasrama'] = $this->input->post('transasrama');
		$data['masterfasilitas'] = $this->input->post('masterfasilitas');
		$data['transfasilitas'] = $this->input->post('transfasilitas');

		$data['masteruser'] = $this->input->post('masteruser');
		$data['masterlaporan'] = $this->input->post('masterlaporan');

		if ($this->form_validation->run() == FALSE)
		{	
			$json_response = $this->form_validation->error_array();
			echo json_encode($json_response);
		}
		else
		{
			$response["message"] = $this->User->editUser($data);
			echo json_encode($response);
		}
	}

	public function banUser(){
		$data['nik'] = $this->input->post('key');
		$response["message"] = $this->User->banUser($data['nik']);
		echo json_encode($response);
	}

	public function unbanUser(){
		$data['nik'] = $this->input->post('key');
		$response["message"] = $this->User->unbanUser($data['nik']);
		echo json_encode($response);
	}

	public function addRumah(){
		$this->form_validation->set_rules('nama', 'Nama aset', 'required');
		$this->form_validation->set_rules('kodeaset', 'Kode aset', 'required');
		$this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
		$this->form_validation->set_rules('tanggal', 'Tanggal pengadaan', 'required');
		$this->form_validation->set_rules('jenis', 'Jenis aset', 'required');
		$this->form_validation->set_rules('kondisi', 'Kondisi awal', 'required');
		$this->form_validation->set_rules('kamar', 'Kamar tidur', 'required');
		$this->form_validation->set_rules('toilet', 'Kamar mandi', 'required');
		$this->form_validation->set_rules('carport', 'Carport', 'required');
		// $this->form_validation->set_rules('gambar', 'Gambar', 'required');

		$this->form_validation->set_message('required', ' {field} harus diisi!&nbsp');

		$data['nama'] = $this->input->post('nama');
		$data['user'] = $this->User->getUserLogin($this->session->userdata('login'))->NAMA;
		$data['kode'] = $this->input->post('kodeaset');
		$data['lokasi'] = $this->input->post('lokasi');
		$data['tanggal'] = $this->input->post('tanggal');
		$data['jenis'] = $this->input->post('jenis');
		$data['kondisi'] = $this->input->post('kondisi');
		$data['kamar'] = $this->input->post('kamar');
		$data['toilet'] = $this->input->post('toilet');
		$data['carport'] = $this->input->post('carport');
		$data['namafasilitas'] = explode(",",$this->input->post('namafasilitas'));
		$data['jumlahfasilitas'] = explode(",",$this->input->post('jumlahfasilitas'));
		$data['gambar'] = $this->input->post('gambar');

		// if (isset($_FILES["files"])) {
		// 	print_r($_FILES["files"]);
		// }
		
		//print_r('-'.$data['jumlahfasilitas'][0].'-');

		if ($this->form_validation->run() == FALSE)
		{	
			$json_response = $this->form_validation->error_array();
			echo json_encode($json_response);
		}
		else
		{
			$key = $data["kode"];
			$ctr = substr($this->Asset->getMaxImageIndexbyKey($key),9,3);
			$response["message"] = $this->Asset->addRumah($data, $ctr);
			echo json_encode($response);
		}
	}

	public function editRumah(){
		$this->form_validation->set_rules('nama', 'Nama aset', 'required');
		$this->form_validation->set_rules('kodeaset', 'Kode aset', 'required');
		$this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
		$this->form_validation->set_rules('tanggal', 'Tanggal pengadaan', 'required');
		$this->form_validation->set_rules('jenis', 'Jenis aset', 'required');
		$this->form_validation->set_rules('kondisi', 'Kondisi awal', 'required');
		$this->form_validation->set_rules('kamar', 'Kamar tidur', 'required');
		$this->form_validation->set_rules('toilet', 'Kamar mandi', 'required');
		$this->form_validation->set_rules('carport', 'Carport', 'required');
		// $this->form_validation->set_rules('gambar', 'Gambar', 'required');

		$this->form_validation->set_message('required', ' {field} harus diisi!&nbsp');

		$data['nama'] = $this->input->post('nama');
		$data['user'] = $this->User->getUserLogin($this->session->userdata('login'))->NAMA;
		$data['kode'] = $this->input->post('kodeaset');
		$data['lokasi'] = $this->input->post('lokasi');
		$data['tanggal'] = $this->input->post('tanggal');
		$data['jenis'] = $this->input->post('jenis');
		$data['kondisi'] = $this->input->post('kondisi');
		$data['kamar'] = $this->input->post('kamar');
		$data['toilet'] = $this->input->post('toilet');
		$data['carport'] = $this->input->post('carport');
		$data['namafasilitas'] = explode(",",$this->input->post('namafasilitas'));
		$data['jumlahfasilitas'] = explode(",",$this->input->post('jumlahfasilitas'));
		$data['gambar'] = $this->input->post('gambar');
		$data['currentimage'] = $this->input->post('currentimage');
		if ($this->form_validation->run() == FALSE)
		{	
			$json_response = $this->form_validation->error_array();
			echo json_encode($json_response);
		}
		else
		{
			$key = $data["kode"];
			$ctr = substr($this->Asset->getMaxImageIndexbyKey($key),9,3);
			$response["message"] = $this->Asset->editRumah($data, $ctr);
			echo json_encode($response);
		}
	}

	public function fixAsset(){
		$this->form_validation->set_rules('tanggalrepair', 'Tanggal perbaikan', 'required');
		$this->form_validation->set_rules('kronologirepair', 'Kronologi', 'required');
		$this->form_validation->set_rules('kondisirepair', 'Kondisi aset', 'required');
		$this->form_validation->set_rules('actionrepair', 'Action plan', 'required');
		$this->form_validation->set_rules('rabrepair', 'Jenis aset', 'required');

		$this->form_validation->set_message('required', ' {field} harus diisi!&nbsp');

		$data['user'] = $this->User->getUserLogin($this->session->userdata('login'))->NAMA;
		$data['kode'] = $this->input->post('kodeaset');
		$data['tanggal'] = $this->input->post('tanggalrepair');
		$data['kronologi'] = $this->input->post('kronologirepair');
		$data['kondisi'] = $this->input->post('kondisirepair');
		$data['action'] = $this->input->post('actionrepair');
		$data['rab'] = $this->input->post('rabrepair');
		$data['gambar'] = $this->input->post('gambar');

		// var_dump($data['gambar']);
		// die();

		if ($this->form_validation->run() == FALSE)
		{	
			$json_response = $this->form_validation->error_array();
			echo json_encode($json_response);
		}
		else
		{
			$response["message"] = $this->Asset->fixAsset($data);
			echo json_encode($response);
		}
	}

	public function deleteAsset(){
		$this->form_validation->set_rules('tanggaldelete', 'Tanggal penghapusan', 'required');
		$this->form_validation->set_rules('alasandelete', 'Alasan penghapusan', 'required');

		$this->form_validation->set_message('required', ' {field} harus diisi!&nbsp');

		$data['user'] = $this->User->getUserLogin($this->session->userdata('login'))->NAMA;
		$data['kode'] = $this->input->post('kodeaset');
		$data['tanggal'] = $this->input->post('tanggaldelete');
		$data['alasan'] = $this->input->post('alasandelete');

		if ($this->form_validation->run() == FALSE)
		{	
			$json_response = $this->form_validation->error_array();
			echo json_encode($json_response);
		}
		else
		{
			$response["message"] = $this->Asset->deleteAsset($data);
			echo json_encode($response);
		}
	}

	public function addAsrama(){
		$this->form_validation->set_rules('asrama', 'Asrama', 'required');
		$this->form_validation->set_rules('lantai', 'Lantai', 'required');
		$this->form_validation->set_rules('kamar', 'Kamar', 'required');
		$this->form_validation->set_rules('tanggal', 'Tanggal Pengadaan', 'required');
		$this->form_validation->set_rules('kapasitas', 'Maksimal Penghuni', 'required');

		$this->form_validation->set_message('required', ' {field} harus diisi!&nbsp');

		$data['user'] = $this->User->getUserLogin($this->session->userdata('login'))->NAMA;
		$data['asrama'] = $this->input->post('asrama');
		$data['lantai'] = $this->input->post('lantai');
		$data['kamar'] = $this->input->post('kamar');
		$data['tanggal'] = $this->input->post('tanggal');
		$data['kapasitas'] = $this->input->post('kapasitas');
		$data['namafasilitas'] = explode(",",$this->input->post('namafasilitas'));
		$data['jumlahfasilitas'] = explode(",",$this->input->post('jumlahfasilitas'));

		if ($this->form_validation->run() == FALSE)
		{	
			$json_response = $this->form_validation->error_array();
			echo json_encode($json_response);
		}
		else
		{
			$data['kode'] = $this->Asset->getKodeAsrama($data);
			$response["message"] = $this->Asset->addAsrama($data);
			echo json_encode($response);
		}
	}

	public function editAsrama(){
		$this->form_validation->set_rules('asrama', 'Asrama', 'required');
		$this->form_validation->set_rules('lantai', 'Lantai', 'required');
		$this->form_validation->set_rules('kamar', 'Kamar', 'required');
		$this->form_validation->set_rules('tanggal', 'Tanggal Pengadaan', 'required');
		$this->form_validation->set_rules('kapasitas', 'Maksimal Penghuni', 'required');

		$this->form_validation->set_message('required', ' {field} harus diisi!&nbsp');

		$data['user'] = $this->User->getUserLogin($this->session->userdata('login'))->NAMA;
		$data['asrama'] = $this->input->post('asrama');
		$data['kodelama'] = $this->input->post('kodelama');
		$data['lantai'] = $this->input->post('lantai');
		$data['kamar'] = $this->input->post('kamar');
		$data['tanggal'] = $this->input->post('tanggal');
		$data['kapasitas'] = $this->input->post('kapasitas');
		$data['namafasilitas'] = explode(",",$this->input->post('namafasilitas'));
		$data['jumlahfasilitas'] = explode(",",$this->input->post('jumlahfasilitas'));

		if ($this->form_validation->run() == FALSE)
		{	
			$json_response = $this->form_validation->error_array();
			echo json_encode($json_response);
		}
		else
		{
			$data['kodebaru'] = $this->Asset->getKodeAsrama($data);
			$response["message"] = $this->Asset->editAsrama($data);
			echo json_encode($response);
		}
	}

	public function addFasilitas(){
		$this->form_validation->set_rules('nama', 'Nama Aset', 'required');
		$this->form_validation->set_rules('kodeaset', 'Kode Aset', 'required');
		$this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
		$this->form_validation->set_rules('tanggal', 'Tanggal Pengadaan', 'required');
		$this->form_validation->set_rules('jenis', 'Jenis Aset', 'required');
		$this->form_validation->set_rules('kondisi', 'Kondisi Awal', 'required');
		$this->form_validation->set_rules('garansi', 'Garansi', 'required');
		// $this->form_validation->set_rules('gambar', 'Gambar', 'required');

		$this->form_validation->set_message('required', ' {field} harus diisi!&nbsp');

		$data['user'] = $this->User->getUserLogin($this->session->userdata('login'))->NAMA;
		$data['nama'] = $this->input->post('nama');
		$data['kode'] = $this->input->post('kodeaset');
		$data['lokasi'] = $this->input->post('lokasi');
		$data['tanggal'] = $this->input->post('tanggal');
		$data['jenis'] = $this->input->post('jenis');
		$data['kondisi'] = $this->input->post('kondisi');
		$data['garansi'] = $this->input->post('garansi');
		$data['gambar'] = $this->input->post('gambar');

		if ($this->form_validation->run() == FALSE)
		{	
			$json_response = $this->form_validation->error_array();
			echo json_encode($json_response);
		}
		else
		{
			$key = $data["kode"];
			$ctr = substr($this->Asset->getMaxImageIndexbyKey($key),9,3);
			$response["message"] = $this->Asset->addFasilitas($data, $ctr);
			echo json_encode($response);
		}
	}

	public function editFasilitas(){
		$this->form_validation->set_rules('nama', 'Nama aset', 'required');
		$this->form_validation->set_rules('kodeaset', 'Kode aset', 'required');
		$this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
		$this->form_validation->set_rules('tanggal', 'Tanggal pengadaan', 'required');
		$this->form_validation->set_rules('jenis', 'Jenis aset', 'required');
		$this->form_validation->set_rules('kondisi', 'Kondisi awal', 'required');
		$this->form_validation->set_rules('garansi', 'Garansi', 'required');
		// $this->form_validation->set_rules('gambar', 'Gambar', 'required');

		$this->form_validation->set_message('required', ' {field} harus diisi!&nbsp');

		$data['user'] = $this->User->getUserLogin($this->session->userdata('login'))->NAMA;
		$data['nama'] = $this->input->post('nama');
		$data['kode'] = $this->input->post('kodeaset');
		$data['lokasi'] = $this->input->post('lokasi');
		$data['tanggal'] = $this->input->post('tanggal');
		$data['jenis'] = $this->input->post('jenis');
		$data['kondisi'] = $this->input->post('kondisi');
		$data['garansi'] = $this->input->post('garansi');
		$data['gambar'] = $this->input->post('gambar');
		$data['currentimage'] = $this->input->post('currentimage');
		if ($this->form_validation->run() == FALSE)
		{	
			$json_response = $this->form_validation->error_array();
			echo json_encode($json_response);
		}
		else
		{
			$key = $data["kode"];
			$ctr = substr($this->Asset->getMaxImageIndexbyKey($key),13,3);
			$response["message"] = $this->Asset->editFasilitas($data, $ctr);
			echo json_encode($response);
		}
	}

	public function addGedung(){
		$this->form_validation->set_rules('gedung', 'Gedung', 'required');
		$this->form_validation->set_rules('kodeaset', 'Kode aset', 'required');
		$this->form_validation->set_rules('imb', 'No IMB', 'required');
		$this->form_validation->set_rules('nama', 'Nama aset', 'required');
		$this->form_validation->set_rules('jenis', 'Jenis aset', 'required');
		$this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
		$this->form_validation->set_rules('tanggal', 'Tanggal pengadaan', 'required');
		$this->form_validation->set_rules('peruntukkan', 'Peruntukkan', 'required');

		$this->form_validation->set_message('required', ' {field} harus diisi!&nbsp');

		$data['user'] = $this->User->getUserLogin($this->session->userdata('login'))->NAMA;
		$data['gedung'] = $this->input->post('gedung');
		$data['kode'] = $this->input->post('kodeaset');
		$data['imb'] = $this->input->post('imb');
		$data['nama'] = $this->input->post('nama');
		$data['jenis'] = $this->input->post('jenis');
		$data['lokasi'] = $this->input->post('lokasi');
		$data['tanggal'] = $this->input->post('tanggal');
		$data['peruntukkan'] = $this->input->post('peruntukkan');
		$data['namafasilitas'] = explode(",",$this->input->post('namafasilitas'));
		$data['jumlahfasilitas'] = explode(",",$this->input->post('jumlahfasilitas'));
		$data['gambar'] = $this->input->post('gambar');

		if ($this->form_validation->run() == FALSE)
		{	
			$json_response = $this->form_validation->error_array();
			echo json_encode($json_response);
		}
		else
		{	
			$key = $data["kode"];
			$ctr = substr($this->Asset->getMaxImageIndexbyKey($key),9,3);
			$response["message"] = $this->Asset->addGedung($data, $ctr);
			echo json_encode($response);
		}
	}

	public function editGedung(){
		$this->form_validation->set_rules('gedung', 'Gedung', 'required');
		$this->form_validation->set_rules('kodeaset', 'Kode aset', 'required');
		$this->form_validation->set_rules('imb', 'No IMB', 'required');
		$this->form_validation->set_rules('nama', 'Nama aset', 'required');
		$this->form_validation->set_rules('jenis', 'Jenis aset', 'required');
		$this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
		$this->form_validation->set_rules('tanggal', 'Tanggal pengadaan', 'required');
		$this->form_validation->set_rules('peruntukkan', 'Peruntukkan', 'required');

		$this->form_validation->set_message('required', ' {field} harus diisi!&nbsp');

		$data['user'] = $this->User->getUserLogin($this->session->userdata('login'))->NAMA;
		$data['gedung'] = $this->input->post('gedung');
		$data['kode'] = $this->input->post('kodeaset');
		$data['imb'] = $this->input->post('imb');
		$data['nama'] = $this->input->post('nama');
		$data['jenis'] = $this->input->post('jenis');
		$data['lokasi'] = $this->input->post('lokasi');
		$data['tanggal'] = $this->input->post('tanggal');
		$data['peruntukkan'] = $this->input->post('peruntukkan');
		$data['namafasilitas'] = explode(",",$this->input->post('namafasilitas'));
		$data['jumlahfasilitas'] = explode(",",$this->input->post('jumlahfasilitas'));
		$data['currentimage'] = $this->input->post('currentimage');

		if ($this->form_validation->run() == FALSE)
		{	
			$json_response = $this->form_validation->error_array();
			echo json_encode($json_response);
		}
		else
		{
			$key = $data["kode"];
			$ctr = substr($this->Asset->getMaxImageIndexbyKey($key),13,3);
			$response["message"] = $this->Asset->editGedung($data, $ctr);
			echo json_encode($response);
		}
	}

	public function addKendaraan(){
		$this->form_validation->set_rules('nama', 'Nama aset', 'required');
		$this->form_validation->set_rules('kodeaset', 'Kode aset', 'required');
		$this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
		$this->form_validation->set_rules('tanggal', 'Tanggal pengadaan', 'required');
		$this->form_validation->set_rules('jenis', 'Jenis aset', 'required');
		$this->form_validation->set_rules('kondisi', 'Kondisi awal', 'required');
		$this->form_validation->set_rules('kategori', 'Kategori', 'required');
		$this->form_validation->set_rules('nopolisi', 'No polisi', 'required');
		$this->form_validation->set_rules('nomesin', 'No mesin', 'required');
		$this->form_validation->set_rules('mbpajak', 'Masa berlaku pajak', 'required');
		$this->form_validation->set_rules('mbplat', 'Masa berlaku plat', 'required');
		$this->form_validation->set_rules('bpkb', 'BPKB', 'required');
		// $this->form_validation->set_rules('gambar', 'Gambar', 'required');

		$this->form_validation->set_message('required', ' {field} harus diisi!&nbsp');

		$data['user'] = $this->User->getUserLogin($this->session->userdata('login'))->NAMA;
		$data['nama'] = $this->input->post('nama');
		$data['kode'] = $this->input->post('kodeaset');
		$data['lokasi'] = $this->input->post('lokasi');
		$data['tanggal'] = $this->input->post('tanggal');
		$data['jenis'] = $this->input->post('jenis');
		$data['kondisi'] = $this->input->post('kondisi');
		$data['kategori'] = $this->input->post('kategori');
		$data['nopolisi'] = $this->input->post('nopolisi');
		$data['nomesin'] = $this->input->post('nomesin');
		$data['mbpajak'] = $this->input->post('mbpajak');
		$data['mbplat'] = $this->input->post('mbplat');
		$data['bpkb'] = $this->input->post('bpkb');
		$data['gambar'] = $this->input->post('gambar');

		// if (isset($_FILES["files"])) {
		// 	print_r($_FILES["files"]);
		// }
		
		//print_r('-'.$data['jumlahfasilitas'][0].'-');

		if ($this->form_validation->run() == FALSE)
		{	
			$json_response = $this->form_validation->error_array();
			echo json_encode($json_response);
		}
		else
		{
			$key = $data["kode"];
			$ctr = substr($this->Asset->getMaxImageIndexbyKey($key),9,3);
			$response["message"] = $this->Asset->addKendaraan($data, $ctr);
			echo json_encode($response);
		}
	}

	public function editKendaraan(){
		$this->form_validation->set_rules('nama', 'Nama aset', 'required');
		$this->form_validation->set_rules('kodeaset', 'Kode aset', 'required');
		$this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
		$this->form_validation->set_rules('tanggal', 'Tanggal pengadaan', 'required');
		$this->form_validation->set_rules('jenis', 'Jenis aset', 'required');
		$this->form_validation->set_rules('kondisi', 'Kondisi awal', 'required');
		$this->form_validation->set_rules('kategori', 'Kategori', 'required');
		$this->form_validation->set_rules('nopolisi', 'No polisi', 'required');
		$this->form_validation->set_rules('nomesin', 'No mesin', 'required');
		$this->form_validation->set_rules('mbpajak', 'Masa berlaku pajak', 'required');
		$this->form_validation->set_rules('mbplat', 'Masa berlaku plat', 'required');
		$this->form_validation->set_rules('bpkb', 'BPKB', 'required');
		// $this->form_validation->set_rules('gambar', 'Gambar', 'required');

		$this->form_validation->set_message('required', ' {field} harus diisi!&nbsp');

		$data['user'] = $this->User->getUserLogin($this->session->userdata('login'))->NAMA;
		$data['nama'] = $this->input->post('nama');
		$data['kode'] = $this->input->post('kodeaset');
		$data['lokasi'] = $this->input->post('lokasi');
		$data['tanggal'] = $this->input->post('tanggal');
		$data['jenis'] = $this->input->post('jenis');
		$data['kondisi'] = $this->input->post('kondisi');
		$data['kategori'] = $this->input->post('kategori');
		$data['nopolisi'] = $this->input->post('nopolisi');
		$data['nomesin'] = $this->input->post('nomesin');
		$data['mbpajak'] = $this->input->post('mbpajak');
		$data['mbplat'] = $this->input->post('mbplat');
		$data['bpkb'] = $this->input->post('bpkb');
		$data['gambar'] = $this->input->post('gambar');
		$data['currentimage'] = $this->input->post('currentimage');

		// if (isset($_FILES["files"])) {
		// 	print_r($_FILES["files"]);
		// }
		
		//print_r('-'.$data['jumlahfasilitas'][0].'-');

		if ($this->form_validation->run() == FALSE)
		{	
			$json_response = $this->form_validation->error_array();
			echo json_encode($json_response);
		}
		else
		{
			$key = $data["kode"];
			$ctr = substr($this->Asset->getMaxImageIndexbyKey($key),13,3);
			$response["message"] = $this->Asset->editKendaraan($data, $ctr);
			echo json_encode($response);
		}
	}

	//BAGIAN SEARCH DATA LAPORAN ASSET
	public function searchDataAsset(){
										//NM FIELD,	NM TAMPIL,
		// $this->form_validation->set_rules('dateFrom', 'Date From', 'required');
		// $this->form_validation->set_rules('dateTo', 'Date To', 'required');
		
		// $this->form_validation->set_message('required', ' {field} harus diisi!&nbsp');

		//parameter
		$data['dateFrom'] = $this->input->post('dateFrom');
		$data['dateTo'] = $this->input->post('dateTo');
		$data['kategori'] = $this->input->post('kategori');
		$data['aktivitas'] = $this->input->post('aktivitas');

		$response["message"] = $this->Asset->searchDataAsset($data);
		echo json_encode($response);

		// if ($this->form_validation->run() == FALSE)
		// {	
		// 	$json_response = $this->form_validation->error_array();
		// 	echo json_encode($json_response);
		// }
		// else
		// {
		// 	var_dump("LALALA");
		// 	$response["message"] = $this->Asset->searchDataAsset($data);
		// }
	}

	public function selectAssetPeminjaman(){
		$key = $this->input->post('kode');
		$response["aset"] = $this->Asset->getAssetbyKey($key);
		echo json_encode($response);
	}
}
