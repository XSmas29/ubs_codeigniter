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

	public function getAssetCount($key) {
		$query = $this->db->query("select count(fk_kategori) as jumlah from asset where fk_kategori='$key'"); 
		return $query->result();
	}

	public function addRumah($data){
		$this->db->trans_begin();
			//insert data ke tabel asset
			$values = array(
				'KODE_ASSET' => $data['kode'],
				'FK_KATEGORI' => 1,
				'NAMA_ASSET' => $data['nama'],
				'INFO_1' => $data['lokasi'],
				'INFO_2' => $data['jenis'],
				'INFO_3' => $data['kondisi'],
				'INFO_4' => $data['kamar'],
				'INFO_5' => $data['toilet'],
				'INFO_6' => $data['carport'],
				'TGL_PENGADAAN' => $data['tanggal'],
			);
			$this->db->insert('asset', $values);
			//

			//insert data ke tabel fasilitas

			for ($i=0; $i < count($data["namafasilitas"]); $i++) { 
				$values = array(
					'FK_ASSET' => $data['kode'],
					'NAMA' => $data["namafasilitas"][$i],
					'JUMLAH' => $data["jumlahfasilitas"][$i],
				);
				$this->db->insert('fasilitas', $values);
			}

		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return "Terjadi kesalahan dalam memasukkan data rumah dinas!";
		}
		else{
			$this->db->trans_commit();
			return "Sukses menambah data rumah dinas!";
		}
	}
}
?>
