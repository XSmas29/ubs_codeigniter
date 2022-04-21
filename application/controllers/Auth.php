<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
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


	public function login(){

		// delete_cookie("login");
		// unset($_SESSION['login']);
		// var_dump($this->session->has_userdata('login'));
		// die();
		$this->form_validation->set_rules('nik', 'NIK', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		$this->form_validation->set_message('required', ' {field} harus diisi!&nbsp');
		$this->form_validation->set_error_delimiters('<small class="form-error">', '</small>');
		$data['nik'] = $this->input->post('nik');
		$data['password'] = $this->input->post('password');
		$data['rememberme'] = $this->input->post('rememberme');

		if (get_cookie("login") != NULL){
			$this->session->set_userdata('login', get_cookie("login"));
		}
		if (!$this->session->has_userdata('login')){
			if ($this->form_validation->run() == FALSE)
			{	
				$json_response = $this->form_validation->error_array();
				$this->load->view('login', $json_response);
			}
			else
			{
				$response["message"] = $this->User->login($data);
				// var_dump($this->session->userdata("login"));
				// var_dump(get_cookie("login"));
				// var_dump((array)json_decode(get_cookie("login")));
				// die();
				$this->session->set_flashdata('msg', $response["message"]);
				$this->load->view('login');
			}
		}
		else{
			$this->load->library('user_agent');

			if ($this->agent->is_referral()){
				redirect($this->agent->referrer());
			}
			else{
				redirect(site_url("master"));
			}
		}
	}

	public function logout(){
		delete_cookie("login");
		unset($_SESSION['login']);
		
		redirect(site_url("Auth/login"));
	}
}
