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
		border: 2px dashed black;
		position: relative;
		width: 150px;
		height: 150px;
	}

	.image-dropping,
	.image-upload-wrap:hover {
		border-radius: 12px;
		background-color: #222;
		border: 2px dashed black;
		transition: 0.25s;
	}

	.image-upload-wrap:hover .drag-text h3{
		color: white;
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
		max-width: 95%;
		max-height: 95%;
		top: 0;
		bottom: 0;
		margin: auto;
	}

	#modalsuccess {
		background: rgba(0,0,0,0.5);
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
		border: 2px solid black;
		cursor: pointer;
		background: #DFEBF6;
	}

	.form-error{
		margin-left: 10px;
		background: #FF4859;
		border-radius: 12px;
		color: white;
		transition: 0.4s;
		opacity: 0;
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
		transition: 0.2s;
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
														<button data-bs-toggle="modal" href="#exampleModalToggle" role="button" class="btn btn-sm btn-info btn-edit" value="<?= $listrumah[$i]->KODE_ASSET ?>">
															<img src="<?php echo base_url(); ?>assets/img/icons/edit.png" width="16" height="16">
														</button>
														<button type="button" class="btn btn-sm btn-secondary btn-repair" value="<?= $listrumah[$i]->KODE_ASSET ?>">
															<img src="<?php echo base_url(); ?>assets/img/icons/repair.png" width="16" height="16">
														</button>
														<button type="button" class="btn btn-sm btn-danger btn-remove" value="<?= $listrumah[$i]->KODE_ASSET ?>">
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
											<input type="text" class="form__field form__field2" name="jumlahfas[]" id="fasilitas" placeholder="Jumlah"/>
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
						<div class="d-flex justify-content-end">
							<button type="button" class="btn btn-outline-dark px-5 me-3" onclick="resetInput()">Reset</button>
							<button type="button" class="btn btn-dark px-5 btn-submit" id="btnsave">Save</button>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					
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

	$('#btnadd').click(function(){
		resetInput();
		$('#btnsave').attr('onClick', 'addData()');
		$("#modaltitle").html("Form Pengadaan Aset");
		$('#btnsave').html('Save');

		let today = now.getFullYear()+"-"+(month)+"-"+(day);
		$('#tanggal').val(today);
		$.ajax({
			type: "POST",
			url: "<?php echo site_url(); ?>"+"/Master/jumlahAsset",
			data: {key: 1},
			cache: false,
			success: function(response){
				let data = JSON.parse(response);

				let jumlah = data["count"][0].jumlah;

				let today = (day)+"/"+(month)+"/"+now.getFullYear();
				let next = (parseInt(jumlah) + 1).toString();
				kode = today + "/R/UBS/" + next.padStart(3, "0");
				$("#kodeaset").val(kode);
				//console.log(kode);
			}, error: function(){
				console.log("Error when counting asset!")
			}
		});
	});

	function addData(){
		let form_data = new FormData();
		
        for (let x = 0; x < $(".file-upload-input").length - 1; x++) {
			//console.log($('.file-upload-input').eq(x).prop('files')[0]);
            form_data.append("files[]", $('.file-upload-input').eq(x).prop('files')[0]);
        }

		// for (var key of form_data.entries()) {
		// 	console.log(key[0] + ', ' + key[1]);
		// }

		let listnama = [];
		$('input[name="namafas[]"]').each( function() {
			listnama.push(this.value);
		});

		let listjumlah = [];
		$('input[name="jumlahfas[]"]').each( function() {
			listjumlah.push(this.value);
		});

		form_data.append("nama", $("#nama").val());
		form_data.append("kodeaset", $("#kodeaset").val());
		form_data.append("lokasi", $("#lokasi").val());
		form_data.append("tanggal", $("#tanggal").val());
		form_data.append("jenis", $("#jenis").val());
		form_data.append("kondisi", $("#kondisi").val());
		form_data.append("kamar", $("#kamar").val());
		form_data.append("toilet", $("#toilet").val());
		form_data.append("carport", $("#carport").val());
		form_data.append("namafasilitas", listnama);
		form_data.append("jumlahfasilitas", listjumlah);
		
		$.ajax({
			type: "POST",
			url: "<?php echo site_url(); ?>"+"/Master/addrumah",
			data: form_data,
			cache: false,
			processData: false,
			contentType: false,
			success: function(response){
				console.log(response);
				var message = JSON.parse(response);
				if (message["message"] == 1){
					$('#modalsuccessbody').html('Sukses menambah data rumah dinas!');
					$('#modalsuccess').show();
					setTimeout(function(){
						window.location.reload(); // you can pass true to reload function to ignore the client cache and reload from the server
					},1500);
				}
				raiseErrors(message);
			}, error: function(xhr, status, error) {
				console.log(xhr.responseText);
			},
		});
	};

	function editData(){
		let form_data = new FormData();

        for (let x = 0; x < $(".file-upload-input").length - 1; x++) {
			//console.log($('.file-upload-input').eq(x).prop('files')[0]);
            form_data.append("files[]", $('.file-upload-input').eq(x).prop('files')[0]);
        }

		// for (var key of form_data.entries()) {
		// 	console.log(key[0] + ', ' + key[1]);
		// }

		let listnama = [];
		$('input[name="namafas[]"]').each( function() {
			listnama.push(this.value);
		});

		let listjumlah = [];
		$('input[name="jumlahfas[]"]').each( function() {
			listjumlah.push(this.value);
		});

		form_data.append("nama", $("#nama").val());
		form_data.append("kodeaset", $("#kodeaset").val());
		form_data.append("lokasi", $("#lokasi").val());
		form_data.append("tanggal", $("#tanggal").val());
		form_data.append("jenis", $("#jenis").val());
		form_data.append("kondisi", $("#kondisi").val());
		form_data.append("kamar", $("#kamar").val());
		form_data.append("toilet", $("#toilet").val());
		form_data.append("carport", $("#carport").val());
		form_data.append("namafasilitas", listnama);
		form_data.append("jumlahfasilitas", listjumlah);
		form_data.append("currentimage", listcurrentimage);
		
		$.ajax({
			type: "POST",
			url: "<?php echo site_url(); ?>"+"/Master/editrumah",
			data: form_data,
			cache: false,
			processData: false,
			contentType: false,
			success: function(response){
				console.log(response);
				var message = JSON.parse(response);
				if (message["message"] == 1){
					$('#modalsuccessbody').html('Sukses mengubah data rumah dinas!');
					$('#modalsuccess').show();
					setTimeout(function(){
						window.location.reload();
					}, 1500);
				}
				raiseErrors(message);
			}, error: function(xhr, status, error) {
				console.log(xhr.responseText);
			},
		});
	}

	function raiseErrors(errors){
		$("#error-nama").html("");
		$("#error-kode").html("");
		$("#error-lokasi").html("");
		$("#error-tanggal").html("");
		$("#error-jenis").html("");
		$("#error-kondisi").html("");
		$("#error-kamar").html("");
		$("#error-toilet").html("");
		$("#error-carport").html("");
		$("#error-namafas").html("");
		$("#error-jumlahfas").html("");

		$("#error-nama").html(errors["nama"]).css("opacity", 1);
		$("#error-kode").html(errors["kode"]).css("opacity", 1);
		$("#error-lokasi").html(errors["lokasi"]).css("opacity", 1);
		$("#error-tanggal").html(errors["tanggal"]).css("opacity", 1);
		$("#error-jenis").html(errors["jenis"]).css("opacity", 1);
		$("#error-kondisi").html(errors["kondisi"]).css("opacity", 1);
		$("#error-kamar").html(errors["kamar"]).css("opacity", 1);
		$("#error-toilet").html(errors["toilet"]).css("opacity", 1);
		$("#error-carport").html(errors["carport"]).css("opacity", 1);
		$("#error-namafas").html(errors["namafas"]).css("opacity", 1);
		$("#error-jumlahfas").html(errors["jumlahfas"]).css("opacity", 1);
	}

	function readURL(input) {
		if (input.files && input.files[0]) {
			var fileExtension = ['jpeg', 'jpg', 'png'];
			if ($.inArray($(input).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
				alert("Only formats are allowed : "+fileExtension.join(', '));
			}
			else{
				$(".file-upload-input").hide();
				var reader = new FileReader();

				reader.onload = function(e) {
					$("#image-upload-wrapper").append(
						"<div class='file-upload-wrapper mx-1 mb-1 d-flex align-items-center' onclick='removeImage(this)'>" + 
							"<img class='file-upload-image' src='" + e.target.result + "'>" +
							'<div class="file-upload-remove cursor-pointer d-flex align-items-center justify-content-center">' +
								"<img src='<?php echo base_url(); ?>assets/img/icons/remove.png'" + "' width=24px>" +
							'</div>' + 
						"</div>"
					);

					$('.image-title').html(input.files[0].name);
				};

				reader.readAsDataURL(input.files[0]);
				$(".image-upload-wrap").append(
					'<input class="file-upload-input" type="file" id="imagefasilitas[]" onchange="readURL(this);" accept="image/*" />'
				);
			}
		}
		//console.log($('.file-upload-input').eq(0).prop('files')[0]);
	};

	function removeImage(image){
		//menghapus element image
		let index = $(image).index() - listcurrentimage.length;
		$(image).remove();
		//
		//menghapus element input file nya
		//console.log($(".image-upload-wrap").find(".file-upload-input").eq(index - 1).prop('files')[0]);
		let children = $(image).find(".file-upload-image")[0];
		if (!$(children).hasClass("current")) {
			$(".image-upload-wrap").find(".file-upload-input").get(index - 1).remove();
		}

		//menghapus list current image
		let imgsrc = $($(image).find(".file-upload-image")[0]).attr("src");
		let imgname = imgsrc.substr(imgsrc.lastIndexOf("/")+1);

		for (var i = 0; i < listcurrentimage.length; i++) {
			if (listcurrentimage[i] == imgname) {
				listcurrentimage.splice(i, 1);
			}
		}
	}

	function resetInput(){
		$("#modaltitle").html('');
		$(".form-error").text('');
		$("#nama").val('');
		$("#lokasi").val('');
		$("#jenis").val('');
		$("#kondisi").val('');
		$("#kamar").val('');
		$("#toilet").val('');
		$("#carport").val('');
		$("#fasilitas").val('');
		$("#listimage").html('');
		$("#rowfasilitas").html(
			'<div class="row">' + 
				'<div class="col-7">' + 
					'<div class="form__group field mb-5" id="listnamafasilitas">' + 
						'<label class="form__label">Fasilitas</label>' + 
						'<input type="text" class="form__field" name="namafas[]" id="fasilitas" placeholder="Fasilitas">	' + 					
					'</div>' + 
				'</div>' + 
				'<div class="col-5">' + 
					'<div class="form__group mb-5" id="listjumlahfasilitas">' + 
						'<label class="form__label">Jumlah</label>' + 
						'<div class="d-flex justify-content-start align-items-center">' + 
							'<input type="text" class="form__field form__field2" name="jumlahfas[]" id="fasilitas" placeholder="Jumlah">' + 
							'<button type="button" class="btn btn-dark ms-3" onclick="addFasilitas()"><strong>+</strong></button>' + 
						'</div>' + 
					'</div>' + 
				'</div>' + 
			'</div>'
		);
		$("#image-upload-wrapper").html(
			'<div class="image-upload-wrap mx-1">' + 
				'<input class="file-upload-input" type="file" id="imagefasilitas[]" onchange="readURL(this);" accept="image/*" />' + 
				'<div class="drag-text">' + 
					'<h3>Drag and drop or select an Image</h3>' + 
				'</div>' + 
			'</div>'
		);
		
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

	$(".btn-edit").click(function(){
		resetInput();

		listcurrentimage = [];

		let kode = $(this).attr('value');
		$('#btnsave').attr('onClick', 'editData()');
		$('#btnsave').html('Save Changes');
		$("#modaltitle").html("Edit Aset");
		$.ajax({
			type: "POST",
			url: "<?php echo site_url(); ?>"+"/Master/detailAsset",
			data: {key: kode},
			cache: false,
			success: function(response){

				//mengambil data dari asset tsb
				let data = JSON.parse(response);
				//console.log(data);
				$("#nama").val(data["asset"][0].NAMA_ASSET);
				$("#kodeaset").val(data["asset"][0].KODE_ASSET);
				$("#lokasi").val(data["asset"][0].INFO_1);
				$("#jenis").val(data["asset"][0].INFO_2);
				$("#kondisi").val(data["asset"][0].INFO_3);
				$("#kamar").val(data["asset"][0].INFO_4);
				$("#toilet").val(data["asset"][0].INFO_5);
				$("#carport").val(data["asset"][0].INFO_6);
				$("#tanggal").val(data["asset"][0].TGL_PENGADAAN);
				//

				//mengambil data fasilitas dari asset tsb
				for (let i = 0; i < data["fasilitas"].length; i++) {
					addFasilitas();
					$($("#listnamafasilitas").find(".form__field")[1]).val(data["fasilitas"][i].NAMA);
					$($("#listjumlahfasilitas").find(".d-flex").find(".form__field")[1]).val(data["fasilitas"][i].JUMLAH);
				}
				//

				//mengambil data gambar dari asset tsb
				data["gambar"].forEach(function(item){
					$("#image-upload-wrapper").append(
						"<div class='file-upload-wrapper mx-1 mb-1 d-flex align-items-center' onclick='removeImage(this)'>" + 
							"<img class='file-upload-image current' src='<?php echo base_url() ?>assets/img/asset/" + item.KODE_GAMBAR + "'>" +
							'<div class="file-upload-remove cursor-pointer d-flex align-items-center justify-content-center">' +
								"<img src='<?php echo base_url(); ?>assets/img/icons/remove.png'" + "' width=24px>" +
							'</div>' + 
						"</div>"
					);
				});
				//
				$("#image-upload-wrapper").find(".file-upload-wrapper").find(".file-upload-image").each( function() {
					let filename = $(this).attr('src').substr($(this).attr('src').lastIndexOf("/")+1);
					listcurrentimage.push(filename);
				});
			}, error: function(){
				alert("Error when loading asset!")
			}
		});

		
	});
	
</script>

