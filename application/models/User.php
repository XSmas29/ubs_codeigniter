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
		$values = array(
			'NIK' => $data['nik'],
			'NAMA' => $data['nama'],
			'DEPARTEMEN' => $data['departemen'],
			'PASSWORD' => $data['password'],
			'MASTER_RUMAH' => $data['masterrumah'],
			'MASTER_GEDUNG' => $data['mastergedung'],
			'MASTER_KENDARAAN' => $data['masterkendaraan'],
			'MASTER_ASRAMA' => $data['masterasrama'],
			'MASTER_FASILITAS' => $data['masterfasilitas'],
			'MASTER_USER' => $data['masteruser'],
			'MASTER_LAPORAN' => $data['masterlaporan'],
			'MASTER_TRANSAKSI' => $data['transaksi'],
		);

		$this->db->insert('user', $values);

		return 1;
	}

	public function editUser($data){
		$values = array(
			'NAMA' => $data['nama'],
			'DEPARTEMEN' => $data['departemen'],
			'MASTER_RUMAH' => $data['masterrumah'],
			'MASTER_GEDUNG' => $data['mastergedung'],
			'MASTER_KENDARAAN' => $data['masterkendaraan'],
			'MASTER_ASRAMA' => $data['masterasrama'],
			'MASTER_FASILITAS' => $data['masterfasilitas'],
			'MASTER_USER' => $data['masteruser'],
			'MASTER_LAPORAN' => $data['masterlaporan'],
			'MASTER_TRANSAKSI' => $data['transaksi'],
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
}
