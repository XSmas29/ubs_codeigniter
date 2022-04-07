<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('table');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('cookie');
		$this->load->helper('url');
		$this->load->model('Asset');
	}

	public function index()
	{
		$this->load->view('home');
	}

	public function listrumah()
	{
		$data['listrumah'] = $this->Asset->getRumahDinas();
		$this->load->view('list/rumahdinas', $data);
	}
	public function listgedung()
	{
		$data['listgedung'] = $this->Asset->getGedung();
		$this->load->view('list/gedung', $data);
	}
	public function listkendaraan()
	{
		$data['listkendaraan'] = $this->Asset->getKendaraan();
		$this->load->view('list/kendaraan', $data);
	}
	public function listasrama()
	{
		$data['listAsrama'] = $this->Asset->getAsrama();
		$data['listJumlahPenghuni'] = $this->Asset->getJumlahPenghuni($data['listAsrama']);
		$this->load->view('list/asrama', $data);
	}
	public function listfasilitas()
	{
		$data['listFasilitas'] = $this->Asset->getFasilitas();
		$this->load->view('list/fasilitas', $data);
	}
	public function detailAsset()
	{
		$key = $this->input->post('key');
		$data["asset"] = $this->Asset->getAssetbyKey($key);
		$data["fasilitas"] = $this->Asset->getFasilitasAsset($key);
		$data["transaksi"] = $this->Asset->getTransaksiAsset($key);
		$data["gambar"] = $this->Asset->getImageAsset($key);
		$data["user"] = $this->Asset->getUserAsset($key);
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
		$this->load->view('master/home');
	}

	public function masterRumah(){
		if (!empty($this->session->flashdata('message'))) {
			$data['message'] = $this->session->flashdata('message');
		} elseif (!empty($this->session->flashdata('error'))) {
			$data['error'] = $this->session->flashdata('error');
		}

		$data['listrumah'] = $this->Asset->getRumahDinas();
		$this->load->view('master/rumahdinas', $data);
	}
	
	public function masterGedung(){
		$data['listgedung'] = $this->Asset->getGedung();
		$this->load->view('master/gedung',$data);
	}

	public function masterKendaraan(){
		if (!empty($this->session->flashdata('message'))) {
			$data['message'] = $this->session->flashdata('message');
		} elseif (!empty($this->session->flashdata('error'))) {
			$data['error'] = $this->session->flashdata('error');
		}

		$data['listkendaraan'] = $this->Asset->getKendaraan();
		$this->load->view('master/kendaraan', $data);
	}

	public function masterAsrama(){
		$data['listAsrama'] = $this->Asset->getAsrama();
		$data['listJumlahPenghuni'] = $this->Asset->getJumlahPenghuni($data['listAsrama']);
		$this->load->view('master/asrama', $data);
	}

	public function masterFasilitas(){
		$data['listFasilitas'] = $this->Asset->getFasilitas();
		$this->load->view('master/fasilitas', $data);
	}

	public function masterLaporan(){
		$data['listDataKategori'] = $this->Asset->getDataKategori();
		$data['listDataAktivitas'] = $this->Asset->getDataAktivitas();
		$this->load->view('master/laporan', $data);
	}
	// public function masterDataKategori(){
	// 	$data['listDataKategori'] = $this->Asset->getDataKategori();
	// 	$this->load->view('master/laporan', $data);
	// }
	// public function masterDataAktivitas(){
	// 	$data['listDataAktivitas'] = $this->Asset->getDataAktivitas();
	// 	$this->load->view('master/laporan', $data);
	// }

	public function jumlahAsset(){
		$key = $this->input->post('key');
		$data['count'] = $this->Asset->getAssetCount($key);
		echo json_encode($data);
	}

	public function jumlahAsrama(){
		$fk = $this->input->post('key');
		$nama = $this->input->post('nama');
		$data['count'] = $this->Asset->getAssetCount($fk, $nama);
		echo json_encode($data);
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

		$data['gedung'] = $this->input->post('gedung');
		$data['kode'] = $this->input->post('kodeaset');
		$data['imb'] = $this->input->post('imb');
		$data['nama'] = $this->input->post('nama');
		$data['jenis'] = $this->input->post('jenis');
		$data['lokasi'] = $this->input->post('lokasi');
		$data['tanggal'] = $this->input->post('tanggal');
		$data['peruntukkan'] = $this->input->post('peruntukkan');

		if ($this->form_validation->run() == FALSE)
		{	
			$json_response = $this->form_validation->error_array();
			echo json_encode($json_response);
		}
		else
		{
			$response["message"] = $this->Asset->addGedung($data);
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

		$data['gedung'] = $this->input->post('gedung');
		$data['kode'] = $this->input->post('kodeaset');
		$data['imb'] = $this->input->post('imb');
		$data['nama'] = $this->input->post('nama');
		$data['jenis'] = $this->input->post('jenis');
		$data['lokasi'] = $this->input->post('lokasi');
		$data['tanggal'] = $this->input->post('tanggal');
		$data['peruntukkan'] = $this->input->post('peruntukkan');

		if ($this->form_validation->run() == FALSE)
		{	
			$json_response = $this->form_validation->error_array();
			echo json_encode($json_response);
		}
		else
		{
			$response["message"] = $this->Asset->editGedung($data);
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
}
