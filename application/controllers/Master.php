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
		$data['listkendaraan'] = $this->Asset->getKendaraan();
		$this->load->view('master/kendaraan', $data);
	}

	public function masterAsrama(){
		$data['listAsrama'] = $this->Asset->getAsrama();
		$this->load->view('master/asrama', $data);
	}

	public function masterFasilitas(){
		$data['listFasilitas'] = $this->Asset->getFasilitas();
		$this->load->view('master/fasilitas', $data);
	}
	public function jumlahAsset(){
		$key = $this->input->post('key');
		$data['count'] = $this->Asset->getAssetCount($key);
		echo json_encode($data);
	}

	public function addRumah(){
		$this->form_validation->set_rules('nama', 'Nama Aset', 'required');
		$this->form_validation->set_rules('kodeaset', 'Kode Aset', 'required');
		$this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
		$this->form_validation->set_rules('tanggal', 'Tanggal Pengadaan', 'required');
		$this->form_validation->set_rules('jenis', 'Jenis Aset', 'required');
		$this->form_validation->set_rules('kondisi', 'Kondisi Awal', 'required');
		$this->form_validation->set_rules('kamar', 'Kamar Tidur', 'required');
		$this->form_validation->set_rules('toilet', 'Kamar Mandi', 'required');
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
}
