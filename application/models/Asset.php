<?php
class Asset extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
	}
	
	public function getRumahDinas() {
		$query = $this->db->query("select * from asset where fk_kategori=1")->result(); 
		return $query;
	}

	public function getFasilitas() {
		$query = $this->db->query("select * from asset where fk_kategori=5")->result(); 
		return $query;
	}

	public function getAsrama() {
		$query = $this->db->query("select * from asset where fk_kategori=4")->result(); 
		return $query;
	}

	public function getGedung() {
		$query = $this->db->query("select * from asset where fk_kategori=2"); 
		return $query->result();
	}

	public function getKendaraan() {
		$query = $this->db->query("select * from asset where fk_kategori=3"); 
		return $query->result();
	}

	public function getAssetbyKey($key) {
		$query = $this->db->query("select * from asset where kode_asset='$key'"); 
		return $query->result();
	}

	public function getFasilitasAsset($key) {
		$query = $this->db->query("select * from fasilitas where fk_asset='$key'"); 
		return $query->result();
	}
	public function getTransaksiAsset($key) {
		$query = $this->db->query("select * from transaksi where fk_asset='$key'"); 
		return $query->result();
	}

	public function getImageAsset($key) {
		$query = $this->db->query("select * from gambar where fk_asset='$key'"); 
		return $query->result();
	}

	public function getUserAsset($key) {
		$query = $this->db->query("select * from user where fk_asset='$key'"); 
		return $query->result();
	}
}
?>
