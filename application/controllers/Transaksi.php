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

	public function rumah(){
		if (get_cookie("login") != NULL){
			$this->session->set_userdata('login', get_cookie("login"));
		}
		if ($this->session->has_userdata('login')){
			//sudah login
			$user = $this->User->getUserLogin($this->session->userdata('login'));
			if ($user->AKSES_RUMAH == 2 || $user->AKSES_RUMAH == 3){
				//memiliki akses
				$data["login"] = $user;
				$data['listrumah'] = $this->Asset->getRumahDinas();
				$this->load->view('transaksi/rumahdinas', $data);
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

	public function gedung(){
		if (get_cookie("login") != NULL){
			$this->session->set_userdata('login', get_cookie("login"));
		}
		if ($this->session->has_userdata('login')){
			//sudah login
			$user = $this->User->getUserLogin($this->session->userdata('login'));
			if ($user->AKSES_GEDUNG == 2 || $user->AKSES_GEDUNG == 3){
				//memiliki akses
				$data["login"] = $user;
				$data['listgedung'] = $this->Asset->getGedung();
				$this->load->view('transaksi/gedung', $data);
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

	public function kendaraan(){
		if (get_cookie("login") != NULL){
			$this->session->set_userdata('login', get_cookie("login"));
		}
		if ($this->session->has_userdata('login')){
			//sudah login
			$user = $this->User->getUserLogin($this->session->userdata('login'));
			if ($user->AKSES_KENDARAAN == 2 || $user->AKSES_KENDARAAN == 3){
				//memiliki akses
				$data["login"] = $user;
				$data['listkendaraan'] = $this->Asset->getKendaraan();
				$this->load->view('transaksi/kendaraan', $data);
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

	public function asrama(){
		if (get_cookie("login") != NULL){
			$this->session->set_userdata('login', get_cookie("login"));
		}
		if ($this->session->has_userdata('login')){
			//sudah login
			$user = $this->User->getUserLogin($this->session->userdata('login'));
			if ($user->AKSES_ASRAMA == 2 || $user->AKSES_ASRAMA == 3){
				//memiliki akses
				$data["login"] = $user;
				$data['listasrama'] = $this->Asset->getAsrama();
				$this->load->view('transaksi/asrama', $data);
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

	public function fasilitas(){
		if (get_cookie("login") != NULL){
			$this->session->set_userdata('login', get_cookie("login"));
		}
		if ($this->session->has_userdata('login')){
			//sudah login
			$user = $this->User->getUserLogin($this->session->userdata('login'));
			if ($user->AKSES_FASILITAS == 2 || $user->AKSES_FASILITAS == 3){
				//memiliki akses
				$data["login"] = $user;
				$data['listfasilitas'] = $this->Asset->getFasilitas();
				$this->load->view('transaksi/fasilitas', $data);
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
}
