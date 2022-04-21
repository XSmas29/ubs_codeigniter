<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Master | Rumah Dinas</title>
</head>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/master-asset.css">
<style>
	.link-admin-rumah{
		font-weight: bold;
		font-size: 21px;
		transition: 0.2s;
	}
</style>
<body>
	<main class="main" id="top">
		<?php require_once(APPPATH . 'views\template\header.php') ?>

		<section id="home">
			<div class="bg-holder" style="background-image:url(<?php echo base_url(); ?>assets/img/gallery/hero.png);background-position:center;background-size:cover;">
			</div>
			<?php require_once(APPPATH . 'views\template\navbar.php') ?>
			<div class="container-fluid">
				<div class="row">
					<div class="bg-light min-vh-50 min-vh-sm-75 p-4 rounded-3 fs-5" style="box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;">
						<div class="row align-items-start">
							<div>
								<h3 class="text-dark">Rumah Dinas</h3>
							</div>
						</div>
						<div class="d-flex justify-content-end">
							<a class="btn btn-sm btn-primary my-2" data-bs-toggle="modal" href="#exampleModalToggle" role="button" id="btnadd">+ NEW ASSET</a>
						</div>
						<table id="myTable" class="table table-striped table-bordered rounded text-center">
							<thead>
								<tr>
									<th>Nama Aset</th>
									<th>Kode Aset</th>
									<th>Lokasi</th>
									<th>Tanggal Pengadaan</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
									<?php 
										for ($i=0; $i < count($listrumah); $i++) {
											$status = '';
											if ($listrumah[$i]->IS_DELETED == 1) $status = "disabled";
									?>
											<tr>
											<td><?= $listrumah[$i]->NAMA_ASSET?></td>
											<td><?= $listrumah[$i]->KODE_ASSET?></td>
											<td><?= $listrumah[$i]->INFO_1?></td>
											<td><?= $listrumah[$i]->TGL_PENGADAAN?></td>
											<td>
												<?php 
												if ($listrumah[$i]->IS_DELETED == 1){
													echo "<button disabled class='btn btn-sm btn-danger'>Deleted</button>";
												}
												else{
													if ($listrumah[$i]->STATUS == 0){
														echo "<button disabled class='btn btn-sm btn-success'>Available</button>";
													}
													else if ($listrumah[$i]->STATUS == 1){
														echo "<button disabled class='btn btn-sm btn-warning'>In Use</button>";
													}
												}
												//SATU LAGI KONDISI UNTUK YANG PENDING >>>> PPT PAGE KE-21
												?>
											</td>
											<td>
												<button data-bs-toggle="modal" href="#exampleModalToggle" role="button" class="btn btn-sm btn-info btn-edit" value="<?= $listrumah[$i]->KODE_ASSET ?>" <?php echo $status?>>
													<img src="<?php echo base_url(); ?>assets/img/icons/edit.png" width="16" height="16">
												</button>
												<button data-bs-toggle="modal" href="#modalperbaikan" role="button" class="btn btn-sm btn-secondary btn-repair" value="<?= $listrumah[$i]->KODE_ASSET ?>" <?php echo $status?>>
													<img src="<?php echo base_url(); ?>assets/img/icons/repair.png" width="16" height="16">
												</button>
												<button data-bs-toggle="modal" href="#modaldelete" role="button" class="btn btn-sm btn-danger btn-remove" value="<?= $listrumah[$i]->KODE_ASSET ?>" <?php echo $status?>>
													<img src="<?php echo base_url(); ?>assets/img/icons/delete.png" width="16" height="16">
												</button>
											</td>
										</tr>
									<?php
										}
									?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</section>
	</main>

	<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
		<div class="modal-dialog modal-dialog-centered modal-xl">
			<div class="modal-content">
				<div class="modal-header">
				<h4 class="modal-title" id="modaltitle"></h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body pt-0 min-vh-25 min-vh-sm-50">
					<div class="row text-center">
						<div class="col-4">
							<div class="form__group field mb-5">
								<input type="text" class="form__field" name="nama" id="nama" placeholder="Nama Aset"/>
								<label class="form__label">Nama Aset<small class="form-error" id="error-nama"></small></label>
							</div>
							<div class="form__group field mb-5">
								<input type="text" id="kodeaset" class="form__field" name="kode" id="kode" placeholder="Kode Aset" disabled/>
								<label class="form__label">Kode Aset<small class="form-error" id="error-kode"></small></label>
							</div>
							<div class="form__group field mb-5">
								
								<input type="text" class="form__field" name="lokasi" id="lokasi" placeholder="Lokasi"/>
								<label class="form__label">Lokasi<small class="form-error" id="error-lokasi"></small></label>
							</div>
							<div class="form__group field mb-5">
								<input type="date" class="form__field" name="tanggal" id="tanggal" placeholder="Tanggal Pengadaan"  disabled/>
								<label class="form__label">Tanggal Pengadaan<small class="form-error" id="error-tanggal"></small></label>
							</div>
							<div class="form__group field mb-5">
								<select class="form__field" name="jenis" id="jenis" placeholder="Jenis Aset">
									<option value="" selected></option>
									<option value="tetap">Tetap</option>
									<option value="bergerak">Bergerak</option>
								</select>
								<label class="form__label">Jenis Aset<small class="form-error" id="error-jenis"></small></label>
							</div>
							<div class="form__group field mb-5">
								<input type="text" class="form__field" name="kondisi" id="kondisi" placeholder="Kondisi Awal"/>
								<label class="form__label">Kondisi Awal<small class="form-error"" id="error-kondisi"></small></label>
							</div>
						</div>
						<div class="col-4">
							<div class="form__group field mb-5">
								<input type="text" class="form__field" name="kamar" id="kamar" placeholder="Kamar Tidur"/>
								<label class="form__label">Kamar Tidur<small class="form-error" id="error-kamar"></small></label>
							</div>
							<div class="form__group field mb-5">
								<input type="text" class="form__field" name="toilet" id="toilet" placeholder="Kamar Mandi"/>
								<label class="form__label">Kamar Mandi<small class="form-error" id="error-toilet"></small></label>
							</div>
							<div class="form__group field mb-5">
								
								<select class="form__field" name="carport" id="carport" placeholder="Carport">
									<option value="" selected></option>
									<option value="ada">Ada</option>
									<option value="tidak ada">Tidak Ada</option>
								</select>
								<label class="form__label">Carport<small class="form-error" id="error-carport"></small></label>
							</div>
							<div class="row" id="rowfasilitas">
								<div class="col-7">
									<div class="form__group field mb-5" id="listnamafasilitas">
										<label class="form__label">Fasilitas</label>
										<input type="text" class="form__field" name="namafas[]" id="fasilitas" placeholder="Fasilitas"/>
										
									</div>
								</div>
								<div class="col-5">
									<div class="form__group mb-5" id="listjumlahfasilitas">
										<label class="form__label">Jumlah</label>
										<div class="d-flex justify-content-start align-items-center">
											<input type="number" class="form__field form__field2" name="jumlahfas[]" id="fasilitas" placeholder="Jumlah"/>
											<button type="button" class="btn btn-dark ms-3" onclick="addFasilitas()"><strong>+</strong></button>
										</div>
									</div>
								</div>
							</div>
							
						</div>
						<div class="col-4">
							<h3 class="my-4">Upload Foto</h3>
							<div class="d-flex flex-wrap justify-content-center" id="image-upload-wrapper">
								<div class="image-upload-wrap mx-1">
									<input class="file-upload-input" type='file' id='imagefasilitas[]' onchange="readURL(this);" accept="image/*" />
									<div class="drag-text">
										<h3>Drag and drop or select an Image</h3>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-dark px-5 me-3" onclick="resetInput()">Reset</button>
					<button type="button" class="btn btn-dark px-5 btn-submit" id="btnsave">Save</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modalperbaikan" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">
				<div class="modal-header">
				<h4 class="modal-title">Perbaikan Aset</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body pt-0 min-vh-25 min-vh-sm-50">
					<div class="row text-center">
						<div class="col-6">
								<input type="text" name="koderepair" id="koderepair" hidden/>
							<div class="form__group field mb-5">
								<input type="date" class="form__field" name="tanggalrepair" id="tanggalrepair" placeholder="Tanggal Kejadian" disabled/>
								<label class="form__label">Tanggal kejadian<small class="form-error" id="error-tanggal-perbaikan"></small></label>
							</div>
							<div class="form__group field mb-5">
								<textarea name="Text1" class="form__field" cols="40" rows="3" name="kronologirepair" id="kronologirepair" placeholder="Kronologi"></textarea>
								<label class="form__label">Kronologi<small class="form-error" id="error-kronologi-perbaikan"></small></label>
							</div>
							<div class="form__group field mb-5">
								<input type="text" class="form__field" name="kondisirepair" id="kondisirepair" placeholder="Kondisi Aset"/>
								<label class="form__label">Kondisi aset<small class="form-error" id="error-kondisi-perbaikan"></small></label>
							</div>
							<div class="form__group field mb-5">
								<input type="text" class="form__field" name="actionrepair" id="actionrepair" placeholder="Action plan"/>
								<label class="form__label">Action plan<small class="form-error" id="error-action-perbaikan"></small></label>
							</div>
							<div class="form__group field mb-5">
								<input type="text" class="form__field" name="rabrepair" id="rabrepair" placeholder="RAB"/>
								<label class="form__label">RAB<small class="form-error" id="error-rab-perbaikan"></small></label>
							</div>
						</div>
						<div class="col-6">
							<h3 class="my-4">Upload File</h3>
							<div class="d-flex flex-wrap justify-content-center" id="image-upload-wrapper-perbaikan">
								<div class="image-upload-wrap-perbaikan mx-1">
									<input class="file-upload-input" type='file' id='imageperbaikan' onchange="readURLperbaikan(this);" accept="file/*" />
									<div class="drag-text">
										<h3>Drag and drop or select a File</h3>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-dark px-5 me-3" onclick="resetInput()">Reset</button>
					<button type="button" class="btn btn-dark px-5 btn-submit" id="btnfix">Fix</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modaldelete" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">
				<div class="modal-header">
				<h4 class="modal-title">Delete Aset</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body pt-0">
					<div class="row text-center">
						<div class="col-5">
							<input type="text" name="kodedelete" id="kodedelete" hidden/>
							<div class="form__group field mb-5">
								<input type="date" class="form__field" name="tanggaldelete" id="tanggaldelete" placeholder="Tanggal Penghapusan" disabled/>
								<label class="form__label">Tanggal penghapusan<small class="form-error" id="error-tanggal-delete"></small></label>
							</div>
						</div>
						<div class="col-7">
						<div class="form__group field mb-5">
								<input type="text" class="form__field" name="alasandelete" id="alasandelete" placeholder="Alasan penghapusan"/>
								<label class="form__label">Alasan penghapusan<small class="form-error" id="error-alasan-delete"></small></label>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-dark px-5 me-3" onclick="resetInput()">Reset</button>
					<button type="button" class="btn btn-dark px-5 btn-submit" id="btndelete">Delete</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal" tabindex="1" id="modalsuccess">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header justify-content-center">
					<h5 class="modal-title">Success</h5>
				</div>
				<div class="modal-body text-center">
					<p id="modalsuccessbody">Modal body text goes here.</p>
				</div>
				<div class="modal-footer">
				</div>
			</div>
		</div>
	</div>
	
</body>

</html>
<script type="text/javascript">
	var now = new Date();
	var day = ("0" + now.getDate()).slice(-2);
	var month = ("0" + (now.getMonth() + 1)).slice(-2);

	var listcurrentimage = [];

	$(document).ready( function (){
		$('#myTable').DataTable( 
			{
				responsive: true
			} 
		);
	});
</script>
