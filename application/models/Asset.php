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

	public function getMaxImageIndexbyKey($key) {
		$query = $this->db->query("select max(kode_gambar) as max from gambar where fk_asset='$key'");
		return $query->result()[0]->max;
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

	public function addRumah($data, $key){
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
				if ($data["namafasilitas"][$i] != "" && $data["jumlahfasilitas"][$i] != ""){
					$values = array(
						'FK_ASSET' => $data['kode'],
						'NAMA' => $data["namafasilitas"][$i],
						'JUMLAH' => $data["jumlahfasilitas"][$i],
					);
					$this->db->insert('fasilitas', $values);
				}
			}
			
			//

			// urusan gambar
			//print_r($_FILES["files"]);
			if (isset($_FILES["files"])){
				$ctr = intval($key);
				for ($i=0; $i < count($_FILES["files"]["name"]); $i++) { 
					$ctr += 1;
					// upload gambar ke dalam folder CI nya
					$_FILES['file']['name']       = $_FILES['files']['name'][$i];
					$_FILES['file']['type']       = $_FILES['files']['type'][$i];
					$_FILES['file']['tmp_name']   = $_FILES['files']['tmp_name'][$i];
					$_FILES['file']['error']      = $_FILES['files']['error'][$i];
					$_FILES['file']['size']       = $_FILES['files']['size'][$i];

					$config['upload_path'] = './assets/img/asset';
					$config['allowed_types'] = '*';
	
					$path = $_FILES['file']['name'];
					$ext = pathinfo($path, PATHINFO_EXTENSION);
					
					//var_dump(str_pad($ctr, 3, "0", STR_PAD_LEFT)." - ".$ctr);

					$filename = 'RUMAH'.substr($data['kode'], -3).'_'.str_pad($ctr, 3, "0", STR_PAD_LEFT).'.'.$ext;
					$config['file_name'] = $filename;
		
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					
					if(!$this->upload->do_upload('file'))
					{  
						echo $this->upload->display_errors();  
					}  
					else  
					{  
						$imgdata = $this->upload->data();
						echo '<img src="'.base_url().'upload/'.$imgdata["file_name"].'" width="300" height="225" class="img-thumbnail" />';  
					}
					//
					
					//insert data gambar ke database
					$values = array(
						'KODE_GAMBAR' => $filename,
						'FK_ASSET' => $data['kode'],
					);

					$this->db->insert('gambar', $values);
				}
			}
			// 

		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return "Terjadi kesalahan dalam memasukkan data rumah dinas!";
		}
		else{
			$this->db->trans_commit();

			$values = array(
				'FK_ASSET' => $data['kode'],
				'TGL_TRANSAKSI' => $data['kode'],
				'USER_TRANSAKSI' => "SYSTEM ADMIN",
				'AKTIVITAS_TRANSAKSI' => "pengadaan",
				'KETERANGAN_TRANSAKSI' => "pengadaan rumah dinas ".substr($data['kode'], -3),
			);
			$this->db->insert('transaksi', $values);

			return "Sukses menambah data rumah dinas!";
		}
	}
}
?>
