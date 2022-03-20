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
		$this->load->view('admin/rumahdinas', $data);
	}
	public function listgedung()
	{
		$data['listgedung'] = $this->Asset->getGedung();
		$this->load->view('admin/gedung', $data);
	}
	public function listkendaraan()
	{
		$data['listkendaraan'] = $this->Asset->getKendaraan();
		$this->load->view('admin/kendaraan', $data);
	}
	public function listasrama()
	{
		$data['listAsrama'] = $this->Asset->getAsrama();
		$this->load->view('admin/asrama', $data);
	}
	public function listfasilitas()
	{
		$data['listFasilitas'] = $this->Asset->getFasilitas();
		$this->load->view('admin/fasilitas', $data);
	}
	public function detailAsset()
	{
		$key = $this->input->post('key');
		$data["asset"] = $this->Asset->getAssetbyKey($key);
		$data["fasilitas"] = $this->Asset->getFasilitasofAsset($key);
		$data["transaksi"] = $this->Asset->getTransaksiofAsset($key);
		echo json_encode($data);
	}
}
