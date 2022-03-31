<?php

class Form extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model('Asset');
		$this->load->library('session');
	}

	public function addRumah(){
		// $this->form_validation->set_rules('nama', 'Nama Aset', 'required');
		// $this->form_validation->set_rules('kode', 'Kode Aset', 'required');
		// $this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
		// $this->form_validation->set_rules('tanggal', 'Tanggal Pengadaan', 'required');
		// $this->form_validation->set_rules('jenis', 'Jenis Aset', 'required');
		// $this->form_validation->set_rules('kondisi', 'Kondisi Awal', 'required');
		// $this->form_validation->set_rules('kamar', 'Kamar Tidur', 'required');
		// $this->form_validation->set_rules('toilet', 'Kamar Mandi', 'required');
		// $this->form_validation->set_rules('carport', 'Carport', 'required');

		// if ($this->form_validation->run() == FALSE)
		// {	
		// 	$this->session->set_flashdata('error', validation_errors());
		// 	redirect('Master/masterrumah');
		// 	$this->load->view('master/rumahdinas');
		// }
		// else
		// {
		// 	$this->load->view('formsuccess');
		// }
	}
}
