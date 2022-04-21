<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
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
		$this->load->model('User');
	}

	public function rumah(){
		if (!empty($this->session->flashdata('message'))) {
			$data['message'] = $this->session->flashdata('message');
		} elseif (!empty($this->session->flashdata('error'))) {
			$data['error'] = $this->session->flashdata('error');
		}

		$data['listrumah'] = $this->Asset->getRumahDinas();
		$this->load->view('master/rumahdinas', $data);
	}
}
