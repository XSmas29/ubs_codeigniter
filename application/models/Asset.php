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

	public function getJumlahPenghuni($listkey) {
		$listjumlah = [];
		foreach($listkey as $key){
			$keycode = $key->KODE_ASSET;
			$query = $this->db->query("select count(fk_asset) as jumlah from user where fk_asset='$keycode'")->result();
			array_push($listjumlah, $query[0]->jumlah);
		}
		return $listjumlah;
	}

	public function getGedung() {
		$query = $this->db->query("select * from asset where fk_kategori=2"); 
		return $query->result();
	}

	public function getKendaraan() {
		$query = $this->db->query("select * from asset where fk_kategori=3"); 
		return $query->result();
	}

	public function getDataKategori() {
		$query = $this->db->query("select * from kategori")->result(); 
		return $query;
	}
	public function getDataAktivitas() {
		$query = $this->db->query("select * from transaksi")->result(); 
		return $query;
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

	public function getKodeAsrama($data){
		$nama = $data["asrama"];
		$query = $this->db->query("select kode_asset from asset where fk_kategori=4 and lower(nama_asset)=lower('$nama') limit 1");
		
		$newkode = date("d/m/Y", strtotime($data["tanggal"]));
		
		if ($query->num_rows() == 1){
			$arrkode = explode('/', $query->result()[0]->kode_asset);
			$newkode = $newkode.'/A/UBS/'.$arrkode[5].'/'.$data["lantai"].'/'.$data["kamar"];
		}
		else{
			$query = $this->db->query("select max(substring(kode_asset, 18, 3)) as kode_asset from asset where fk_kategori=4");
			$maxkode = $query->result()[0]->kode_asset;
			$indexkode = intval($maxkode);
			$newkode = $newkode.'/A/UBS/'.str_pad(($indexkode + 1), 3, "0", STR_PAD_LEFT).'/'.$data["lantai"].'/'.$data["kamar"];
		}
		return $newkode;
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

			//get max value dari transaksi
			$query = $this->db->query("select max(kode_transaksi) as max from transaksi");
			$newkode = intval(substr($query->result()[0]->max, -7)) + 1;
			//

			$values = array(
				'KODE_TRANSAKSI' => "TRANS_".str_pad($newkode, 7, "0", STR_PAD_LEFT),
				'FK_ASSET' => $data['kode'],
				'TGL_TRANSAKSI' => $data['tanggal'],
				'USER_TRANSAKSI' => "SYSTEM ADMIN",
				'AKTIVITAS_TRANSAKSI' => "pengadaan",
				'KETERANGAN_1' => "pengadaan rumah dinas ".substr($data['kode'], -3),
			);
			$this->db->insert('transaksi', $values);

			return 1;
		}
	}

	public function editRumah($data, $key){
		$this->db->trans_begin();
			
			//ganti data di tabel asset
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
			$this->db->where('KODE_ASSET', $data['kode']);
			$this->db->update('asset', $values);
			//

			//hapus data, lalu insert data ke tabel fasilitas
			$this->db->delete('fasilitas', array('FK_ASSET' => $data['kode']));

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


			//hapus data gambar based on img object lalu add img baru
			$array = explode(',', $data["currentimage"]);
			$this->db->where_not_in('KODE_GAMBAR', $array);
			$this->db->where('FK_ASSET',  $data['kode']);
			$this->db->delete('gambar');

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

					if(file_exists($config['upload_path']."/".$config['file_name'])) unlink($config['upload_path']."/".$config['file_name']);

					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					
					if(!$this->upload->do_upload('file'))
					{  
						echo $this->upload->display_errors();
					}  
					else  
					{  
						$imgdata = $this->upload->data();
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
			return "Terjadi kesalahan dalam mengupdate rumah dinas!";
		}
		else{
			$this->db->trans_commit();

			//get max value dari transaksi
			$query = $this->db->query("select max(kode_transaksi) as max from transaksi");
			$newkode = intval(substr($query->result()[0]->max, -7)) + 1;
			//
			$date = date('Y-m-d');

			$values = array(
				'KODE_TRANSAKSI' => "TRANS_".str_pad($newkode, 7, "0", STR_PAD_LEFT),
				'FK_ASSET' => $data['kode'],
				'TGL_TRANSAKSI' => $date,
				'USER_TRANSAKSI' => "SYSTEM ADMIN",
				'AKTIVITAS_TRANSAKSI' => "perubahan",
				'KETERANGAN_1' => "perubahan data rumah dinas ".substr($data['kode'], -3),
			);
			$this->db->insert('transaksi', $values);
			return 1;
		}
	}

	public function fixAsset($data){
		$this->db->trans_begin();

			//get max value dari transaksi
			$query = $this->db->query("select max(kode_transaksi) as max from transaksi");
			$newkode = intval(substr($query->result()[0]->max, -7)) + 1;
			//

			$date = date('Y-m-d');
			//insert data ke tabel transaksi
			$values = array(
				'KODE_TRANSAKSI' => "TRANS_".str_pad($newkode, 7, "0", STR_PAD_LEFT),
				'FK_ASSET' => $data['kode'],
				'TGL_TRANSAKSI' => $date,
				'USER_TRANSAKSI' => "SYSTEM ADMIN",
				'AKTIVITAS_TRANSAKSI' => "perbaikan",
				'KETERANGAN_1' => $data['kronologi'],
				'KETERANGAN_2' => $data['kondisi'],
				'KETERANGAN_3' => $data['action'],
				'KETERANGAN_4' => $data['rab'],
			);

			$this->db->insert('transaksi', $values);
			//
			if (isset($_FILES["gambar"])){
				// upload gambar ke dalam folder CI nya

				$config['upload_path'] = './assets/img/repair';
				$config['allowed_types'] = '*';

				$path = $_FILES['gambar']['name'];
				$ext = pathinfo($path, PATHINFO_EXTENSION);
				
				//var_dump(str_pad($ctr, 3, "0", STR_PAD_LEFT)." - ".$ctr);

				$filename = "TRANS_".str_pad($newkode, 7, "0", STR_PAD_LEFT).'.'.$ext;
				$config['file_name'] = $filename;
	
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				
				if(!$this->upload->do_upload('gambar'))
				{  
					echo $this->upload->display_errors();  
				}  
				else  
				{  
					$imgdata = $this->upload->data();
				}
				//


				//insert data gambar ke database
				$values = array(
					'KODE_GAMBAR' => $filename,
					'FK_ASSET' => "TRANS_".str_pad($newkode, 7, "0", STR_PAD_LEFT),
				);
				$this->db->insert('gambar', $values);
				//
			}

		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return "Terjadi kesalahan dalam input data perbaikan asset!";
		}
		else{
			$this->db->trans_commit();
			return 1;
		}
	}

	public function deleteAsset($data){
		$this->db->trans_begin();

			//get max value dari transaksi
			$query = $this->db->query("select max(kode_transaksi) as max from transaksi");
			$newkode = intval(substr($query->result()[0]->max, -7)) + 1;
			//

			$date = date('Y-m-d');
			//insert data ke tabel transaksi
			$values = array(
				'KODE_TRANSAKSI' => "TRANS_".str_pad($newkode, 7, "0", STR_PAD_LEFT),
				'FK_ASSET' => $data['kode'],
				'TGL_TRANSAKSI' => $date,
				'USER_TRANSAKSI' => "SYSTEM ADMIN",
				'AKTIVITAS_TRANSAKSI' => "penghapusan",
				'KETERANGAN_1' => $data['alasan']
			);
			$this->db->insert('transaksi', $values);
			//

			//ubah data is_deleted di aset
			$values = array(
				'is_deleted' => 1,
			);

			$this->db->where('KODE_ASSET', $data['kode']);
			$this->db->update('asset', $values);
			//


		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return "Terjadi kesalahan dalam penghapusan asset!";
		}
		else{
			$this->db->trans_commit();
			return 1;
		}
	}

	function addAsrama($data){
		$key = substr($data["kode"], 11);
		$query = $this->db->query("select kode_asset from asset where substring(kode_asset, 12, 20)='$key'");
		if ($query->num_rows() == 0){
			$this->db->trans_begin();
			//insert data ke tabel asset
			$values = array(
				'KODE_ASSET' => $data['kode'],
				'FK_KATEGORI' => 4,
				'NAMA_ASSET' => ucwords(strtolower($data['asrama'])),
				'INFO_1' => $data['lantai'],
				'INFO_2' => $data['kamar'],
				'INFO_3' => $data['kapasitas'],
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

			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				return "Terjadi kesalahan dalam memasukkan data asrama!";
			}
			else{
				$this->db->trans_commit();

				//get max value dari transaksi
				$query = $this->db->query("select max(kode_transaksi) as max from transaksi");
				$newkode = intval(substr($query->result()[0]->max, -7)) + 1;
				//

				$values = array(
					'KODE_TRANSAKSI' => "TRANS_".str_pad($newkode, 7, "0", STR_PAD_LEFT),
					'FK_ASSET' => $data['kode'],
					'TGL_TRANSAKSI' => $data['tanggal'],
					'USER_TRANSAKSI' => "SYSTEM ADMIN",
					'AKTIVITAS_TRANSAKSI' => "pengadaan",
					'KETERANGAN_1' => "pengadaan asrama ".ucwords(strtolower($data['asrama']))." lantai ".$data["lantai"]." kamar no ".$data["kamar"],
				);
				$this->db->insert('transaksi', $values);

				return 1;
			}
		}
		else{
			return 2;
		}
	}

	function editAsrama($data){
		$key = substr($data["kodebaru"], 11);
		$oldkey = substr($data["kodelama"], 11);
		$query = $this->db->query("select kode_asset from asset where substring(kode_asset, 12, 20)='$key'");
		if ($query->num_rows() == 0 || $key == $oldkey){
			$this->db->trans_begin();
				//hapus data, lalu insert data ke tabel fasilitas
				$this->db->delete('fasilitas', array('FK_ASSET' => $data['kodelama']));

				for ($i=0; $i < count($data["namafasilitas"]); $i++) { 
					if ($data["namafasilitas"][$i] != "" && $data["jumlahfasilitas"][$i] != ""){
						$values = array(
							'FK_ASSET' => $data['kodebaru'],
							'NAMA' => $data["namafasilitas"][$i],
							'JUMLAH' => $data["jumlahfasilitas"][$i],
						);
						$this->db->insert('fasilitas', $values);
					}
				}
				//

				$values = array(
					'KODE_ASSET' => $data['kodebaru'],
					'FK_KATEGORI' => 4,
					'NAMA_ASSET' => ucwords(strtolower($data['asrama'])),
					'INFO_1' => $data['lantai'],
					'INFO_2' => $data['kamar'],
					'INFO_3' => $data['kapasitas'],
					'TGL_PENGADAAN' => $data['tanggal'],
				);
				$this->db->where('KODE_ASSET', $data['kodelama']);
				$this->db->update('asset', $values);

			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				return "Terjadi kesalahan dalam mengubah data asrama!";
			}
			else{
				$this->db->trans_commit();

				//get max value dari transaksi
				$query = $this->db->query("select max(kode_transaksi) as max from transaksi");
				$newkode = intval(substr($query->result()[0]->max, -7)) + 1;
				//

				$values = array(
					'KODE_TRANSAKSI' => "TRANS_".str_pad($newkode, 7, "0", STR_PAD_LEFT),
					'FK_ASSET' => $data['kodebaru'],
					'TGL_TRANSAKSI' => $data['tanggal'],
					'USER_TRANSAKSI' => "SYSTEM ADMIN",
					'AKTIVITAS_TRANSAKSI' => "perubahan",
					'KETERANGAN_1' => "perubahan asrama ".ucwords(strtolower($data['asrama']))." lantai ".$data["lantai"]." kamar no ".$data["kamar"],
				);
				$this->db->insert('transaksi', $values);

				return 1;
			}
		}
		else {
			return 2;
		}
	}
}
?>
