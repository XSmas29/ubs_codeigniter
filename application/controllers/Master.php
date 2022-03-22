<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('table');
		$this->load->helper('form');
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
		echo json_encode($data);
	}

	public function master(){
		$this->load->view('master/home');
	}

	public function masterRumah(){
		$this->load->view('master/rumahdinas');
	}
	
	public function masterGedung(){
		$this->load->view('master/gedung');
	}

	public function masterKendaraan(){
		$this->load->view('master/kendaraan');
	}

	public function masterAsrama(){
		$this->load->view('master/asrama');
	}

	public function masterFasilitas(){
		$this->load->view('master/fasilitas');
	}
}
