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
	}

	public function index()
	{
		$this->load->view('home');
	}

	public function listrumah()
	{
		$this->load->view('admin/rumahdinas');
	}
	public function listgedung()
	{
		$this->load->view('admin/gedung');
	}
	public function listkendaraan()
	{
		$this->load->view('admin/kendaraan');
	}
	public function listasrama()
	{
		$this->load->view('admin/asrama');
	}
	public function listfasilitas()
	{
		$this->load->view('admin/fasilitas');
	}
}
