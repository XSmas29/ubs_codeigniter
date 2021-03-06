<?php
class Asset extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
	}

	public function getJumRumahDinas() {
		$jumlah['active'] = $this->db->query("select count(*) as jumlah from asset where fk_kategori=1 and is_deleted=0")->result()[0]->jumlah; 
		$jumlah['available'] = $this->db->query("select count(*) as jumlah from asset where fk_kategori=1 and is_deleted=0 and status=0")->result()[0]->jumlah; 
		$jumlah['deleted'] = $this->db->query("select count(*) as jumlah from asset where fk_kategori=1 and is_deleted=1")->result()[0]->jumlah; 
		return $jumlah;
	}

	public function getJumGedung() {
		$jumlah['active'] = $this->db->query("select count(*) as jumlah from asset where fk_kategori=2 and is_deleted=0")->result()[0]->jumlah; 
		$jumlah['available'] = $this->db->query("select count(*) as jumlah from asset where fk_kategori=2 and is_deleted=0 and status=0")->result()[0]->jumlah; 
		$jumlah['deleted'] = $this->db->query("select count(*) as jumlah from asset where fk_kategori=2 and is_deleted=1")->result()[0]->jumlah; 
		return $jumlah;
	}

	public function getJumKendaraan() {
		$jumlah['active'] = $this->db->query("select count(*) as jumlah from asset where fk_kategori=3 and is_deleted=0")->result()[0]->jumlah; 
		$jumlah['available'] = $this->db->query("select count(*) as jumlah from asset where fk_kategori=3 and is_deleted=0 and status=0")->result()[0]->jumlah; 
		$jumlah['deleted'] = $this->db->query("select count(*) as jumlah from asset where fk_kategori=3 and is_deleted=1")->result()[0]->jumlah; 
		return $jumlah;
	}

	public function getJumAsrama() {
		$jumlah['active'] = $this->db->query("select count(*) as jumlah from asset where fk_kategori=4 and is_deleted=0")->result()[0]->jumlah; 
		$jumlah['available'] = $this->db->query("select count(*) as jumlah from asset where fk_kategori=4 and is_deleted=0 and status=0")->result()[0]->jumlah; 
		$jumlah['deleted'] = $this->db->query("select count(*) as jumlah from asset where fk_kategori=4 and is_deleted=1")->result()[0]->jumlah; 
		return $jumlah;
	}

	public function getJumFasilitas() {
		$jumlah['active'] = $this->db->query("select count(*) as jumlah from asset where fk_kategori=5 and is_deleted=0")->result()[0]->jumlah; 
		$jumlah['available'] = $this->db->query("select count(*) as jumlah from asset where fk_kategori=5 and is_deleted=0 and status=0")->result()[0]->jumlah; 
		$jumlah['deleted'] = $this->db->query("select count(*) as jumlah from asset where fk_kategori=5 and is_deleted=1")->result()[0]->jumlah; 
		return $jumlah;
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

	public function getAssetbyFilterAndCategory($data) {
		$query = $this->db->query("select * from asset where fk_kategori='".$data["kategori"]."' and nama_asset like '%".$data["nama"]."%' and info_1 like '%".$data["lokasi"]."%' and is_deleted=0"); 
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

	public function getAssetCount($key) {
		$query = $this->db->query("select count(fk_kategori) as jumlah from asset where fk_kategori='$key'"); 
		return $query->result();
	}

	public function getDetailHistory($key) {
		$query = $this->db->query("select * from transaksi where KODE_TRANSAKSI='$key'"); 
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
				'USER_TRANSAKSI' => $data['user'],
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
				'USER_TRANSAKSI' => $data['user'],
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
				'USER_TRANSAKSI' => $data['user'],
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

				$config['upload_path'] = './assets/files/repair';
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
				'USER_TRANSAKSI' => $data['user'],
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
				'INFO_1' => "Lt. ".$data['lantai']." No. ".$data['kamar'],
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
					'USER_TRANSAKSI' => $data['user'],
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
					'USER_TRANSAKSI' => $data['user'],
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

	public function addFasilitas($data, $key){
		$this->db->trans_begin();
			//insert data ke tabel asset
			$values = array(
				'KODE_ASSET' => $data['kode'],
				'FK_KATEGORI' => 5,
				'NAMA_ASSET' => $data['nama'],
				'INFO_1' => $data['lokasi'],
				'INFO_2' => $data['jenis'],
				'INFO_3' => $data['kondisi'],
				'INFO_4' => $data['garansi'],
				'TGL_PENGADAAN' => $data['tanggal'],
			);
			$this->db->insert('asset', $values);
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

					$filename = 'FASILITAS'.substr($data['kode'], -3).'_'.str_pad($ctr, 3, "0", STR_PAD_LEFT).'.'.$ext;
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
			return "Terjadi kesalahan dalam memasukkan data fasilitas!";
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
				'USER_TRANSAKSI' => $data['user'],
				'AKTIVITAS_TRANSAKSI' => "pengadaan",
				'KETERANGAN_1' => "pengadaan fasilitas ".substr($data['kode'], -3),
			);
			$this->db->insert('transaksi', $values);

			return 1;
		}
	}

	public function editFasilitas($data, $key){
		$this->db->trans_begin();
			
			//ganti data di tabel asset
			$values = array(
				'FK_KATEGORI' => 5,
				'NAMA_ASSET' => $data['nama'],
				'INFO_1' => $data['lokasi'],
				'INFO_2' => $data['jenis'],
				'INFO_3' => $data['kondisi'],
				'INFO_4' => $data['garansi'],
			);
			$this->db->where('KODE_ASSET', $data['kode']);
			$this->db->update('asset', $values);
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

					$filename = 'FASILITAS'.substr($data['kode'], -3).'_'.str_pad($ctr, 3, "0", STR_PAD_LEFT).'.'.$ext;
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
			return "Terjadi kesalahan dalam mengupdate fasilitas!";
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
				'USER_TRANSAKSI' => $data['user'],
				'AKTIVITAS_TRANSAKSI' => "perubahan",
				'KETERANGAN_1' => "perubahan data fasilitas ".substr($data['kode'], -3),
			);
			$this->db->insert('transaksi', $values);
			return 1;
		}
	}

	public function addGedung($data, $key){
		$this->db->trans_begin();
			//insert data ke tabel asset
			$values = array(
				'KODE_ASSET' => $data['kode'],
				'FK_KATEGORI' => 2,
				'NAMA_ASSET' => $data['nama'],
				'INFO_1' => $data['lokasi'],
				'INFO_2' => $data['jenis'],
				'INFO_3' => $data['peruntukkan'],
				'INFO_4' => ucwords(strtolower($data['gedung'])),
				'INFO_5' => $data['imb'],
				'TGL_PENGADAAN' => $data['tanggal'],
			);
			$this->db->insert('asset', $values);
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

					$filename = 'GEDUNG'.substr($data['kode'], -3).'_'.str_pad($ctr, 3, "0", STR_PAD_LEFT).'.'.$ext;
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
			return "Terjadi kesalahan dalam memasukkan data gedung!";
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
				'USER_TRANSAKSI' => $data['user'],
				'AKTIVITAS_TRANSAKSI' => "pengadaan",
				'KETERANGAN_1' => "pengadaan gedung ".substr($data['kode'], -3),
			);
			$this->db->insert('transaksi', $values);

			return 1;
		}
	}

	public function editGedung($data, $key){
		$this->db->trans_begin();

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

					$filename = 'GEDUNG'.substr($data['kode'], -3).'_'.str_pad($ctr, 3, "0", STR_PAD_LEFT).'.'.$ext;
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

			//insert data ke tabel asset
			$values = array(
				'KODE_ASSET' => $data['kode'],
				'FK_KATEGORI' => 2,
				'NAMA_ASSET' => $data['nama'],
				'INFO_1' => $data['lokasi'],
				'INFO_2' => $data['jenis'],
				'INFO_3' => $data['peruntukkan'],
				'INFO_4' => ucwords(strtolower($data['gedung'])),
				'INFO_5' => $data['imb'],
				'TGL_PENGADAAN' => $data['tanggal'],
			);
			$this->db->where('KODE_ASSET', $data['kode']);
			$this->db->update('asset', $values);
			//

		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return "Terjadi kesalahan dalam mengupdate data gedung!";
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
				'USER_TRANSAKSI' => $data['user'],
				'AKTIVITAS_TRANSAKSI' => "perubahan",
				'KETERANGAN_1' => "perubahan gedung ".substr($data['kode'], -3),
			);
			$this->db->insert('transaksi', $values);

			return 1;
		}
	}

	public function addKendaraan($data, $key){
		$this->db->trans_begin();
			//insert data ke tabel asset
			$values = array(
				'KODE_ASSET' => $data['kode'],
				'FK_KATEGORI' => 3,
				'NAMA_ASSET' => $data['nama'],
				'INFO_1' => $data['lokasi'],
				'INFO_2' => $data['jenis'],
				'INFO_3' => $data['kondisi'],
				'INFO_4' => $data['kategori'],
				'INFO_5' => $data['nopolisi'],
				'INFO_6' => $data['nomesin'],
				'INFO_7' => $data['mbpajak'],
				'INFO_8' => $data['mbplat'],
				'INFO_9' => $data['bpkb'],
				'TGL_PENGADAAN' => $data['tanggal'],
			);
			$this->db->insert('asset', $values);
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

					$filename = 'KENDARAAN'.substr($data['kode'], -3).'_'.str_pad($ctr, 3, "0", STR_PAD_LEFT).'.'.$ext;
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
			return "Terjadi kesalahan dalam memasukkan data kendaraan!";
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
				'USER_TRANSAKSI' => $data['user'],
				'AKTIVITAS_TRANSAKSI' => "pengadaan",
				'KETERANGAN_1' => "pengadaan kendaraan ".substr($data['kode'], -3),
			);
			$this->db->insert('transaksi', $values);

			return 1;
		}
	}

	public function editKendaraan($data, $key){
		$this->db->trans_begin();
			
			//ganti data di tabel asset
			$values = array(
				'KODE_ASSET' => $data['kode'],
				'FK_KATEGORI' => 3,
				'NAMA_ASSET' => $data['nama'],
				'INFO_1' => $data['lokasi'],
				'INFO_2' => $data['jenis'],
				'INFO_3' => $data['kondisi'],
				'INFO_4' => $data['kategori'],
				'INFO_5' => $data['nopolisi'],
				'INFO_6' => $data['nomesin'],
				'INFO_7' => $data['mbpajak'],
				'INFO_8' => $data['mbplat'],
				'INFO_9' => $data['bpkb'],
				'TGL_PENGADAAN' => $data['tanggal'],
			);
			$this->db->where('KODE_ASSET', $data['kode']);
			$this->db->update('asset', $values);
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
					
					// var_dump(str_pad($ctr, 3, "0", STR_PAD_LEFT)." - ".$ctr);
					// die();
					$filename = 'KENDARAAN'.substr($data['kode'], -3).'_'.str_pad($ctr, 3, "0", STR_PAD_LEFT).'.'.$ext;
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
			return "Terjadi kesalahan dalam mengupdate kendaraan!";
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
				'USER_TRANSAKSI' => $data['user'],
				'AKTIVITAS_TRANSAKSI' => "perubahan",
				'KETERANGAN_1' => "perubahan data kendaraan ".substr($data['kode'], -3),
			);
			$this->db->insert('transaksi', $values);
			return 1;
		}
	}

	public function searchDataAsset($data){
		//TARUH QUERY DISINI
		$query = 'SELECT * FROM transaksi, asset where transaksi.FK_ASSET=asset.KODE_ASSET';
		if (!empty($data['dateFrom'])) {
			$query .= " AND transaksi.TGL_TRANSAKSI >= '" . $data['dateFrom'] . "'";
		}
		if (!empty($data['dateTo'])) {
			$query .= " AND transaksi.TGL_TRANSAKSI <= '" . $data['dateTo'] . "'";
		}
		if (!empty($data['kategori'])) {
			$query .= " AND asset.FK_KATEGORI = '" . $data['kategori'] . "'";
		}
		if (!empty($data['aktivitas'])) {
			$query .= " AND transaksi.AKTIVITAS_TRANSAKSI = '" . $data['aktivitas'] . "'";
		}
		
		$result = $this->db->query($query);
		return $result->result();
	}

	public function addPeminjaman($data){
		$this->db->trans_begin();

			//get max value dari transaksi
			$query = $this->db->query("select max(kode_transaksi) as max from transaksi");
			$newkode = intval(substr($query->result()[0]->max, -7)) + 1;
			//
			$now = date('Y-m-d');
			//insert data ke tabel transaksi
			
			//
			if (isset($_FILES["file"])){
				// upload gambar ke dalam folder CI nya

				$config['upload_path'] = './assets/files/peminjaman';
				$config['allowed_types'] = '*';

				$path = $_FILES['file']['name'];
				$ext = pathinfo($path, PATHINFO_EXTENSION);
				
				//var_dump(str_pad($ctr, 3, "0", STR_PAD_LEFT)." - ".$ctr);

				$filename = "PINJAM_".str_pad($newkode, 7, "0", STR_PAD_LEFT).'.'.$ext;
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

				//insert data transaksi ke database
				$values = array(
					'KODE_TRANSAKSI' => "TRANS_".str_pad($newkode, 7, "0", STR_PAD_LEFT),
					'FK_ASSET' => $data['kode'],
					'TGL_TRANSAKSI' => $now,
					'USER_TRANSAKSI' => $data["user"],
					'AKTIVITAS_TRANSAKSI' => 'peminjaman',
					'KETERANGAN_1' => 'serah terima aset ke user '.$data["nik"],
					'KETERANGAN_2' => $data['nik'],
					'KETERANGAN_3' => $filename,
					'TGL_PINJAM' => $data["tanggal"],
				);
	
				$this->db->insert('transaksi', $values);
				//
			}

			$kode = $data["kode"];
			if ($data["kategori"] == 4){
				$asrama = $this->db->query("select * from asset where kode_asset='$kode'")->result();
				//mengganti status jika kapasitas sudah full
				$status = 0;
				if ((int)$asrama[0]->INFO_3 == (int)$asrama[0]->INFO_4 + 1){
					$status = 1;
				}
				//menambah jumlah penghuni asrama
				$values = array(
					'STATUS' => $status,
					'INFO_4' => (int)$asrama[0]->INFO_4 + 1,
				);
				$this->db->where('KODE_ASSET', $data['kode']);
				$this->db->update('asset', $values);

				//memasukkan fk_asrama di tabel user
				$values = array(
					'FK_ASSET' => $data["kode"],
				);

				$this->db->where('NIK', $data['nik']);
				$this->db->update('user', $values);
				//
			}
			else{
				$values = array(
					'STATUS' => 1,
					'FK_USER' => $data['nik'],
				);
				$this->db->where('KODE_ASSET', $data['kode']);
				$this->db->update('asset', $values);
			}

		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return "Terjadi kesalahan dalam input data peminjaman!";
		}
		else{
			$this->db->trans_commit();
			
			return 1;
		}
	}

	function searchPenggunaAset($data){
		$query = 'SELECT * FROM transaksi, asset, user where transaksi.FK_ASSET=asset.KODE_ASSET AND user.NIK=transaksi.KETERANGAN_2 AND transaksi.AKTIVITAS_TRANSAKSI="peminjaman" AND transaksi.TGL_KEMBALI IS NULL';
		if (!empty($data['nik'])) {
			$query .= " AND transaksi.KETERANGAN_2 = '" . $data['nik'] . "'";
		}
		if (!empty($data['kategori'])) {
			$query .= " AND asset.FK_KATEGORI = '" . $data['kategori'] . "'";
		}
		if (!empty($data['aset'])) {
			$query .= " AND asset.NAMA_ASSET LIKE '%" . $data['aset'] . "%'";
		}
		
		$result = $this->db->query($query);
		return $result->result();
	}

	function pengembalianAset($data){
		$trans = $this->db->query("select * from transaksi where kode_transaksi='".$data["kode"]."'")->result()[0];

		$values = array(
			'TGL_KEMBALI' => date('Y-m-d'),
		);

		$this->db->where('KODE_TRANSAKSI', $data['kode']);
		$this->db->update('transaksi', $values);

		$asset = $this->db->query("select * from asset where kode_asset='".$trans->FK_ASSET."'")->result()[0];

		if ($asset->FK_KATEGORI == 4){
			$values = array(
				'STATUS' => 0,
				'INFO_4' => (int)$asset->INFO_4 - 1,
			);
	
			$this->db->where('KODE_ASSET', $trans->FK_ASSET);
			$this->db->update('asset', $values);

			$user = $this->db->query("select * from user where NIK='".$trans->KETERANGAN_2."'")->result()[0];

			$values = array(
				'FK_ASSET' => NULL,
			);
	
			$this->db->where('NIK', $trans->KETERANGAN_2);
			$this->db->update('user', $values);
		}
		else{
			$values = array(
				'STATUS' => 0,
				'FK_USER' => NULL,
			);
	
			$this->db->where('KODE_ASSET', $trans->FK_ASSET);
			$this->db->update('asset', $values);
		}
		return 1;
	}
}
?>
