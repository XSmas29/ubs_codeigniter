<?php
class User extends CI_Model
{
	public function __construct()
    {
        parent::__construct();
        $this->load->database();
	}

	public function getUser() {
		$query = $this->db->query("select * from user")->result(); 
		return $query;
	}

	public function getUserCount() {
		$query = $this->db->query("select count(*) as jumlah from user")->result(); 
		return $query[0]->jumlah;
	}

	public function getUserAsset($key) {
		$query = $this->db->query("select * from user where fk_asset='$key'"); 
		return $query->result();
	}

	public function getUserbyKey($key) {
		$query = $this->db->query("select * from user where NIK='$key'"); 
		return $query->result();
	}

	public function addUser($data){

		$akses['rumah'] = $data["masterrumah"] + ($data["transrumah"] * 2);
		$akses['gedung'] = $data["mastergedung"] + ($data["transgedung"] * 2);
		$akses['kendaraan'] = $data["masterkendaraan"] + ($data["transkendaraan"] * 2);
		$akses['asrama'] = $data["masterasrama"] + ($data["transasrama"] * 2);
		$akses['fasilitas'] = $data["masterfasilitas"] + ($data["transfasilitas"] * 2);

		$values = array(
			'NIK' => $data['nik'],
			'NAMA' => $data['nama'],
			'DEPARTEMEN' => $data['departemen'],
			'PASSWORD' => $data['password'],
			'AKSES_RUMAH' => $akses['rumah'] ,
			'AKSES_GEDUNG' => $akses['gedung'] ,
			'AKSES_KENDARAAN' => $akses['kendaraan'] ,
			'AKSES_ASRAMA' => $akses['asrama'] ,
			'AKSES_FASILITAS' => $akses['fasilitas'] ,
			'AKSES_USER' => $data['masteruser'],
			'AKSES_LAPORAN' => $data['masterlaporan'],
		);

		$this->db->insert('user', $values);

		return 1;
	}

	public function editUser($data){
		$akses['rumah'] = $data["masterrumah"] + ($data["transrumah"] * 2);
		$akses['gedung'] = $data["mastergedung"] + ($data["transgedung"] * 2);
		$akses['kendaraan'] = $data["masterkendaraan"] + ($data["transkendaraan"] * 2);
		$akses['asrama'] = $data["masterasrama"] + ($data["transasrama"] * 2);
		$akses['fasilitas'] = $data["masterfasilitas"] + ($data["transfasilitas"] * 2);
		
		$values = array(
			'NIK' => $data['nik'],
			'NAMA' => $data['nama'],
			'DEPARTEMEN' => $data['departemen'],
			'AKSES_RUMAH' => $akses['rumah'] ,
			'AKSES_GEDUNG' => $akses['gedung'] ,
			'AKSES_KENDARAAN' => $akses['kendaraan'] ,
			'AKSES_ASRAMA' => $akses['asrama'] ,
			'AKSES_FASILITAS' => $akses['fasilitas'] ,
			'AKSES_USER' => $data['masteruser'],
			'AKSES_LAPORAN' => $data['masterlaporan'],
		);

		$this->db->where('NIK', $data['nik']);
		$this->db->update('user', $values);

		return 1;
	}

	public function banUser($key){
		$values = array(
			'is_deleted' => 1,
		);

		$this->db->where('NIK', $key);
		$this->db->update('user', $values);

		return 1;
	}

	public function unbanUser($key){
		$values = array(
			'is_deleted' => 0,
		);

		$this->db->where('NIK', $key);
		$this->db->update('user', $values);

		return 1;
	}

	public function getJumlahPenghuni($listkey) {
		$listjumlah = [];
		foreach($listkey as $key){
			$keycode = $key->KODE_ASSET;
			$query = $this->db->query("select count(fk_asset) as jumlah from user where fk_asset='$keycode'")->result();
			array_push($listjumlah, $query[0]->jumlah);
		}
		return $listjumlah;
	}

	public function login($data){
		$query = $this->db->query("select * from user")->result();
		foreach($query as $user){
			if ($data["nik"] == $user->NIK){
				if ($data["password"] == $user->PASSWORD){
					$this->session->set_userdata('login', $user->NIK);
					if ($data['rememberme'] == "rememberme"){
						set_cookie("login", $user->NIK, 2592000);
					}
					else{
						delete_cookie("login");
					}
					return 1;
				}
				else{
					return "Password Salah!";
				}
			}
		}
		return "User Tidak Ditemukan!";
	}
}
