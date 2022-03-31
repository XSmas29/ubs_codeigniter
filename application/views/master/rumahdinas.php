<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Master | Rumah Dinas</title>
</head>
<style>
	select option{
		zoom: 1.1;
	}

	.file-upload {
		background-color: black;
		width: 600px;
		margin: 0 auto;
		padding: 20px;
	}

	.file-upload-content {
		display: none;
		text-align: center;
	}


	.file-upload-input {
		opacity: 0; 
		border: none;
		border-radius: 3px;
		position: absolute;
		left: 0px;    
		width: 100%;
		top: 0px;
		height: 100%;
		cursor: pointer;
	}

	.image-upload-wrap {
		border-radius: 12px;
		border: 3px dashed black;
		position: relative;
		width: 150px;
		height: 150px;
	}

	.image-dropping,
	.image-upload-wrap:hover {
		border-radius: 12px;
		background-color: #222;
		border: 3px dashed black;
		transition: 0.25s;
	}

	.image-title-wrap {
		padding: 0 15px 15px 15px;
		color: #222;
	}

	.drag-text {
		text-align: center;
	}

	.drag-text h3 {
		font-weight: 200;
		text-transform: uppercase;
		color: black;
		font-size: 21px;
		padding: 25px 0;
	}

	.file-upload-image {
		max-width: 100%;
		max-height: 100%;
		top: 0;
		bottom: 0;
		margin: auto;
	}

	.file-upload-remove {
		opacity: 0;
		background-color: #999999;
		position: absolute;
		top: 45px;
		left: 45px;
		width: 56px;
		height: 56px;
		border-radius:20px;
	}

	.file-upload-wrapper{
		height : 150px;
		width: 150px;
		min-height : 100px;
		min-width: 100px;
		border-radius: 12px;
		border: 3px solid black;
	}

	.file-upload-wrapper:hover{
		filter: brightness(70%);
		transition: 0.4s;
	}

	.file-upload-wrapper:hover .file-upload-remove{
		transition: 0.4s;
		opacity: 1;
	}

	.form__group {
		position: relative;
		padding: 18px 0 0;
		margin-top: 10px;
		width: 100%;
	}

	.form__field {
		font-family: inherit;
		width: 100%;
		border: 0;
		border-bottom: 1px solid black;
		outline: 0;
		padding: 7px 0;
		background: transparent;
		transition: border-color 0.2s;
		color: #999999;
	}

	.form__field2 {
		width: 75%;
	}

	.form__field::placeholder {
		color: transparent;
		opacity: 0;
		
	}
	.form__field:placeholder-shown ~ .form__label {
		cursor: text;
		top: 20px;
	}

	.form__label {
		position: absolute;
		top: 0;
		display: block;
		transition: 0.2s;;
		color: black;
	}

	.form__field:focus {
		padding-bottom: 6px;
		border-width: 2px;
		border-image: black;
		border-image-slice: 1;
	}
	.form__field:focus ~ .form__label {
		position: absolute;
		top: 0;
		display: block;
		transition: 0.2s;
		color: black;
		font-size: 17px;
	}

	/* reset input */
	.form__field:required, .form__field:invalid {
		box-shadow: none;
	}

</style>

<body>
	<main class="main" id="top">
		<?php require_once(APPPATH . 'views\template\header.php') ?>

		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.bundle.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css"/>

		<section id="home">
			<div class="bg-holder" style="background-image:url(<?php echo base_url(); ?>assets/img/gallery/hero.png);background-position:center;background-size:cover;">
			</div>

			<div class="container-fluid">
				<div class="row mx-5">
					<div class="col-12">
						<h3 class="text-light">Master Data</h3>
						<div class="bg-light min-vh-50 min-vh-sm-75 p-4 rounded-3 fs-5">
							<div class="row">
								<div class="col-2">
									<?php require_once(APPPATH . 'views\template\navbar.php') ?>
								</div>
								<div class="col-10">
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
												?>
														<tr>
														<td><?= $listrumah[$i]->NAMA_ASSET?></td>
														<td><?= $listrumah[$i]->KODE_ASSET?></td>
														<td><?= $listrumah[$i]->INFO_1?></td>
														<td><?= $listrumah[$i]->TGL_PENGADAAN?></td>
														<td>
															<?php 
															if ($listrumah[$i]->STATUS == 0){
																echo "<button disabled class='btn btn-sm btn-success'>Available</button>";
															}
															else if ($listrumah[$i]->STATUS == 1){
																echo "<button disabled class='btn btn-sm btn-warning'>In Use</button>";
															}
															else{
																echo "<button disabled class='btn btn-sm btn-danger'>Deleted</button>";
															}
															//SATU LAGI KONDISI UNTUK YANG PENDING >>>> PPT PAGE KE-21
															?>
														</td>
														<td>
														<button type="button" class="btn btn-sm btn-info">
															<img src="<?php echo base_url(); ?>assets/img/icons/edit.png" width="16" height="16">
														</button>
														<button type="button" class="btn btn-sm btn-secondary">
															<img src="<?php echo base_url(); ?>assets/img/icons/repair.png" width="16" height="16">
														</button>
														<button type="button" class="btn btn-sm btn-danger">
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
					</div>
				</div>
			</div>
		</section>
	</main>

	<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
		<div class="modal-dialog modal-dialog-centered modal-xl">
			<div class="modal-content">
				<div class="modal-header">
				<h4 class="modal-title">Form Pengadaan Asset</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body pt-0 min-vh-25 min-vh-sm-50">
					<div class="row text-center">
						<div class="col-4">
							<div class="form__group field mb-5">
								<input type="text" class="form__field" name="nama" id="nama" placeholder="Nama Aset"  />
								<label class="form__label">Nama Aset</label>
							</div>
							<div class="form__group field mb-5">
								<input type="text" id="kodeaset" class="form__field" name="kode" id="kode" placeholder="Kode Aset"  disabled/>
								<label class="form__label">Kode Aset</label>
							</div>
							<div class="form__group field mb-5">
								<input type="text" class="form__field" name="lokasi" id="lokasi" placeholder="Lokasi" />
								<label class="form__label">Lokasi</label>
							</div>
							<div class="form__group field mb-5">
								<input type="date" class="form__field" name="tanggal" id="tanggal" placeholder="Tanggal Pengadaan"  disabled/>
								<label class="form__label">Tanggal Pengadaan</label>
							</div>
							<div class="form__group field mb-5">
								<select class="form__field" name="jenis" id="jenis" placeholder="Jenis Aset" >
									<option value="" selected></option>
									<option value="tetap">Tetap</option>
									<option value="bergerak">Bergerak</option>
								</select>
								<label class="form__label">Jenis Aset</label>
							</div>
							<div class="form__group field mb-5">
								<input type="text" class="form__field" name="kondisi" id="kondisi" placeholder="Kondisi Awal" />
								<label class="form__label">Kondisi Awal</label>
							</div>
						</div>
						<div class="col-4">
							<div class="form__group field mb-5">
								<input type="text" class="form__field" name="kamar" id="kamar" placeholder="Kamar Tidur"  />
								<label class="form__label">Kamar Tidur</label>
							</div>
							<div class="form__group field mb-5">
								<input type="text" class="form__field" name="toilet" id="toilet" placeholder="Kamar Mandi"  />
								<label class="form__label">Kamar Mandi</label>
							</div>
							<div class="form__group field mb-5">
								<select class="form__field" name="carport" id="carport" placeholder="Carport" >
									<option value="" selected></option>
									<option value="true">Ada</option>
									<option value="false">Tidak Ada</option>
								</select>
								<label class="form__label">Carport</label>
							</div>
							<div class="row">
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
											<input type="text" class="form__field form__field2" name="jumlahfas[]" id="fasilitas" placeholder="Jumlah"/>
											<button type="button" class="btn btn-dark ms-3" onclick="addFasilitas()"><strong>+</strong></button>
										</div>
									</div>
								</div>
							</div>
							
						</div>
						<div class="col-4">
							<h3 class="my-4">Upload Foto</h3>
							<div class="d-flex flex-wrap justify-content-start" id="image-upload-wrapper">
								<div class="image-upload-wrap mx-1">
									<input class="file-upload-input" type='file' id='imagefasilitas[]' onchange="readURL(this);" accept="image/*" />
									<div class="drag-text">
										<h3>Drag and drop or select an Image</h3>
									</div>
								</div>
							</div>
							
							<div class="file-upload-content d-flex flex-wrap justify-content-center" id="listimage">
							</div>
						</div>
						<div class="d-flex justify-content-end">
							<button type="button" class="btn btn-outline-dark px-5 me-3" onclick="resetInput()">Reset</button>
							<button type="button" class="btn btn-dark px-5" id="btnsubmit">Save</button>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					
				</div>
			</div>
		</div>
	</div>
	
</body>

</html>
<script type="text/javascript">
	var today = new Date();
	var date = today.getDate() + "/" + (today.getMonth()+1)+"/" + today.getFullYear();

	$(document).ready( function () 
	{
		$('#myTable').DataTable( 
			{
				responsive: true
			} 
		);
		var now = new Date();
		var day = ("0" + now.getDate()).slice(-2);
		var month = ("0" + (now.getMonth() + 1)).slice(-2);
		var today = now.getFullYear()+"-"+(month)+"-"+(day) ;

		$('#tanggal').val(today);
	});

	$('#btnadd').click(function(){
		$.ajax({
			type: "POST",
			url: "<?php echo site_url(); ?>"+"/Master/jumlahAsset",
			data: {key: 1},
			cache: false,
			success: function(response){
				let data = JSON.parse(response);

				let jumlah = data["count"][0].jumlah;
				let next = (parseInt(jumlah) + 1).toString();
				kode = date + "/R/UBS/" + next.padStart(3, "0");
				$("#kodeaset").val(kode);
				console.log(kode);
			}, error: function(){
				console.log("Error when counting asset!")
			}
		});
	});

	$('#btnsubmit').click(function(){
		
		var image_data = new FormData();
        for (var x = 0; x < $(".file-upload-input"); x++) {
            form_data.append("files[]", document.getElementById('multiFiles').files[x]);
        }

		let listnama = [];
		$('input[name="namafas[]"]').each( function() {
			listnama.push(this.value);
		});

		let listjumlah = [];
		$('input[name="jumlahfas[]"]').each( function() {
			listjumlah.push(this.value);
		});
		
		$.ajax({
			type: "POST",
			url: "<?php echo site_url(); ?>"+"/Master/addrumah",
			data: {
				nama: $("#nama").val(),
				kode: $("#kodeaset").val(),
				lokasi: $("#lokasi").val(),
				tanggal: $("#tanggal").val(),
				jenis: $("#jenis").val(),
				kondisi: $("#kondisi").val(),
				kamar: $("#kamar").val(),
				toilet: $("#toilet").val(),
				carport: $("#carport").val(),
				namafasilitas: listnama,
				jumlahfasilitas: listjumlah,
				gambar: $("#nama").val(),//
			},
			cache: false,
			success: function(response){
				console.log(response);
			}, error: function(xhr, status, error) {
				alert(xhr.responseText);
			},
		});

		
		
	});

	function readURL(input) {
		if (input.files && input.files[0]) {
			$(".file-upload-input").hide();

			var reader = new FileReader();

			reader.onload = function(e) {
				$("#image-upload-wrapper").prepend(
					"<div class='file-upload-wrapper mx-1 mb-1 bg-light d-flex align-items-center'>" + 
						"<img class='file-upload-image' src='" + e.target.result + "'>" +
						'<div class="file-upload-remove cursor-pointer d-flex align-items-center justify-content-center" onclick="removeImage(this)">' +
							"<img src='<?php echo base_url(); ?>assets/img/icons/remove.png'" + "' width=24px>" +
						'</div>' + 
					"</div>"
				);
				$('.file-upload-content').show();

				$('.image-title').html(input.files[0].name);
			};

			reader.readAsDataURL(input.files[0]);
			$(".image-upload-wrap").append(
				'<input class="file-upload-input" type="file" id="imagefasilitas[]" onchange="readURL(this);" accept="image/*" />'
			);
		} else {
			removeUpload();
		}
	};

	$(function() {
		$('.image-upload-wrap').hover(function() {
			$('.drag-text h3').css('color', 'white');
		}, function() {
			$('.drag-text h3').css('color', 'black');
		});

		$('.file-upload-wrapper').hover(function() {
			$('.file-upload-remove').css('opacity', 1);
		}, function() {
			$('.file-upload-remove').css('opacity', 0);
		});
	});

	function removeImage(image){
		$(image).parent().remove();
	}

	function resetInput(){
		$("#nama").val('');
		$("#lokasi").val('');
		$("#jenis").val('');
		$("#kondisi").val('');
		$("#kamar").val('');
		$("#toilet").val('');
		$("#carport").val('');
		$("#fasilitas").val('');
		$("#listimage").html('');
	}

	function addFasilitas(){

		//menambah field nama fasilitas di paling atas
		$("#listnamafasilitas").find('.form__label').remove();
		$("#listnamafasilitas").prepend(
			'<label class="form__label">Fasilitas</label>' + 
			'<input type="text" class="form__field mb-2" name="namafas[]" id="fasilitas" placeholder="Fasilitas"/>'
		);

		//menambah field jumlah & button add fasilitas di paling atas
		$("#listjumlahfasilitas").prepend(
			'<div class="d-flex justify-content-start align-items-center mb-2">' + 
				'<input type="text" class="form__field form__field2" name="jumlahfas[]" id="fasilitas" placeholder="Jumlah"/>' +
				'<button type="button" class="btn btn-dark ms-3" onclick="addFasilitas()"><strong>+</strong></button>' + 
			'</div>'
		);

		//replace button add dgn button remove
		$($("#listjumlahfasilitas").find('.d-flex')[1]).children().last().remove();
		$($("#listjumlahfasilitas").find('.d-flex')[1]).append('<button type="button" class="btn btn-danger ms-3 btn-delete" onclick="removeFasilitas(this)"><strong>x</strong></button>');
	}

	

	function removeFasilitas(element){
		//menghapus fasilitas di index tsb
		let index = $(".btn-delete").index(element);
		console.log(index);
		$("#listnamafasilitas").find('.form__field')[index + 1].remove();
		$("#listjumlahfasilitas").find('.d-flex')[index + 1].remove();
	}
	
</script>

