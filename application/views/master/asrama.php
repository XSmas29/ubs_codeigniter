<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Master | Asrama</title>
</head>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/master-asset.css">
<style>
	.link-admin-asrama{
		font-weight: bold;
		font-size: 21px;
		transition: 0.2s;
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
											<h3 class="text-dark">Asrama</h3>
										</div>
									</div>
									<div class="d-flex justify-content-end">
										<button type="button" class="btn btn-sm btn-primary my-2" data-bs-toggle="modal" href="#modaladdasrama" role="button" id="btnadd">+ NEW ASSET</button>
									</div>
											<table id="myTable" class="table table-striped table-bordered table-light text-center">
										<thead>
											<tr>
												<th>Asrama</th>
												<th>Lantai</th>
												<th>Kamar</th>
												<th>Kapasitas</th>
												<th>Penghuni</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
												<?php 
													for ($i=0; $i < count($listAsrama); $i++) {
														$status = '';
														if ($listAsrama[$i]->IS_DELETED == 1) $status = "disabled";
												?>
													<tr>
													<td><?= $listAsrama[$i]->NAMA_ASSET?></td>
													<td><?= $listAsrama[$i]->INFO_1?></td>
													<td><?= $listAsrama[$i]->INFO_2?></td>
													<td><?= $listAsrama[$i]->INFO_3?></td>
													<td><?= $listJumlahPenghuni[$i]?></td>
													<td>
														<?php 
														if ($listAsrama[$i]->IS_DELETED == 1){
															echo "<button disabled class='btn btn-sm btn-danger'>Deleted</button>";
														}
														else{
															if ($listAsrama[$i]->STATUS == 0){
																echo "<button disabled class='btn btn-sm btn-success'>Available</button>";
															}
															else if ($listAsrama[$i]->STATUS == 1){
																echo "<button disabled class='btn btn-sm btn-warning'>In Use</button>";
															}
														}
														?>
													</td>
													<td <?php echo ($listAsrama[$i]->IS_DELETED == 1) ? 'disabled' : ''; ?>>
														<button data-bs-toggle="modal" href="#modaladdasrama" role="button" class="btn btn-sm btn-info btn-edit" value='<?= $listAsrama[$i]->KODE_ASSET ?>' <?php echo $status?>>
															<img src="<?php echo base_url(); ?>assets/img/icons/edit.png" width="16" height="16">
														</button>
														<button data-bs-toggle="modal" href="#modalperbaikan" role="button" class="btn btn-sm btn-secondary btn-repair" value='<?= $listAsrama[$i]->KODE_ASSET ?>' <?php echo $status?>>
															<img src="<?php echo base_url(); ?>assets/img/icons/repair.png" width="16" height="16">
														</button>
														<button data-bs-toggle="modal" href="#modaldelete" role="button" class="btn btn-sm btn-danger btn-remove" value='<?= $listAsrama[$i]->KODE_ASSET ?>' <?php echo $status?>>
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

	<div class="modal fade" id="modaladdasrama" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">
				<div class="modal-header">
				<h4 class="modal-title" id="modaltitle"></h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body pt-0 min-vh-25 min-vh-sm-50">
					<div class="row text-center">
						<div class="col-6">
							<input type="text" class="form__field" name="kode" id="kode" hidden/>
							<div class="form__group field mb-5">
								<input type="text" class="form__field" name="asrama" id="asrama" placeholder="Asrama"/>
								<label class="form__label">Asrama<small class="form-error" id="error-asrama"></small></label>
							</div>
							<div class="form__group field mb-5">
								<input type="number" class="form__field" name="lantai" id="lantai" placeholder="Lantai"/>
								<label class="form__label">Lantai<small class="form-error" id="error-lantai"></small></label>
							</div>
							<div class="form__group field mb-5">
								<input type="number" class="form__field" name="kamar" id="kamar" placeholder="Kamar"/>
								<label class="form__label">Kamar<small class="form-error" id="error-kamar"></small></label>
							</div>
							<div class="form__group field mb-5">
								<input type="date" class="form__field" name="tanggal" id="tanggal" placeholder="Tanggal pengadaan" disabled/>
								<label class="form__label">Tanggal Pengadaan<small class="form-error" id="error-tanggal"></small></label>
							</div>
							<div class="form__group field mb-5">
								<input type="number" class="form__field" name="kapasitas" id="kapasitas" placeholder="Maksimal penghuni"/>
								<label class="form__label">Maksimal penghuni<small class="form-error" id="error-kapasitas"></small></label>
							</div>
						</div>
						<div class="col-6">
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
						<div class="d-flex justify-content-end">
							<button type="button" class="btn btn-outline-dark px-5 me-3" onclick="resetInput()">Reset</button>
							<button type="button" class="btn btn-dark px-5 btn-submit" id="btnfix">Fix</button>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					
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
						<div class="d-flex justify-content-end">
							<button type="button" class="btn btn-outline-dark px-5 me-3" onclick="resetInput()">Reset</button>
							<button type="button" class="btn btn-dark px-5 btn-submit" id="btndelete">Delete</button>
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

	$(document).ready( function () 
	{
		$('#myTable').DataTable( 
			{
				responsive: true
			} 
		);
	});

	function resetInput(){
		//add & edit
		$(".form-error").text('');
		$("#asrama").val('');
		$("#lantai").val('');
		$("#kamar").val('');
		$("#kapasitas").val('');

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
							'<input type="number" class="form__field form__field2" name="jumlahfas[]" id="fasilitas" placeholder="Jumlah">' + 
							'<button type="button" class="btn btn-dark ms-3" onclick="addFasilitas()"><strong>+</strong></button>' + 
						'</div>' + 
					'</div>' + 
				'</div>' + 
			'</div>'
		);
		//

		//perbaikan
		$("#image-upload-wrapper-perbaikan").html(
			'<div class="image-upload-wrap-perbaikan mx-1">' + 
				'<input class="file-upload-input" type="file" id="imageperbaikan" onchange="readURLperbaikan(this);" accept="file/*" />' + 
				'<div class="drag-text">' + 
					'<h3>Drag and drop or select a File</h3>' + 
				'</div>' + 
			'</div>'
		);

		$("#kronologirepair").val('');
		$("#kondisirepair").val('');
		$("#actionrepair").val('');
		$("#rabrepair").val('');
		//

		//delete
		$("#alasandelete").val('');
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
				'<input type="number" class="form__field form__field2" name="jumlahfas[]" id="fasilitas" placeholder="Jumlah"/>' +
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

	$('#btnadd').click(function(){
		resetInput();
		$('#btnsave').attr('onClick', 'addData()');
		$("#modaltitle").html("Form Pengadaan Aset");
		$('#btnsave').html('Save');
		$("#asrama").prop('disabled', false);
		$("#lantai").prop('disabled', false);
		$("#kamar").prop('disabled', false);
		let today = now.getFullYear()+"-"+(month)+"-"+(day);
		$('#tanggal').val(today);
	});

	function addData(){
		let form_data = new FormData();

		let listnama = [];
		$('input[name="namafas[]"]').each( function() {
			listnama.push(this.value);
		});

		let listjumlah = [];
		$('input[name="jumlahfas[]"]').each( function() {
			listjumlah.push(this.value);
		});

		form_data.append("asrama", $("#asrama").val());
		form_data.append("lantai", $("#lantai").val());
		form_data.append("kamar", $("#kamar").val());
		form_data.append("tanggal", $("#tanggal").val());
		form_data.append("kapasitas", $("#kapasitas").val());
		form_data.append("namafasilitas", listnama);
		form_data.append("jumlahfasilitas", listjumlah);
		
		$.ajax({
			type: "POST",
			url: "<?php echo site_url(); ?>"+"/Master/addasrama",
			data: form_data,
			cache: false,
			processData: false,
			contentType: false,
			success: function(response){
				console.log(response);
				var message = JSON.parse(response);
				if (message["message"] == 1){
					$('#modalsuccessbody').html('Sukses menambah data asrama!');
					$('#modalsuccess').show();
					setTimeout(function(){
						window.location.reload();
					},1500);
				}
				else if (message["message"] == 2){
					message["asrama"] = " Asrama Dengan lantai dan kamar tersebut sudah ada!&nbsp";
					message["lantai"] = " Asrama Dengan lantai dan kamar tersebut sudah ada!&nbsp";
					message["kamar"] = " Asrama Dengan lantai dan kamar tersebut sudah ada!&nbsp";
				}
				raiseErrors(message);
			}, error: function(xhr, status, error) {
				console.log(xhr.responseText);
			},
		});
	}

	function raiseErrors(errors){
		console.log(errors);
		//bagian add & edit
		$("#error-asrama").html("");
		$("#error-lantai").html("");
		$("#error-kamar").html("");
		$("#error-tanggal").html("");
		$("#error-kapasitas").html("");

		$("#error-asrama").html(errors["asrama"]).css("opacity", 1);
		$("#error-lantai").html(errors["lantai"]).css("opacity", 1);
		$("#error-kamar").html(errors["kamar"]).css("opacity", 1);
		$("#error-tanggal").html(errors["tanggal"]).css("opacity", 1);
		$("#error-kapasitas").html(errors["kapasitas"]).css("opacity", 1);
		//


		//bagian perbaikan
		$("#error-tanggal-perbaikan").html("");
		$("#error-kronologi-perbaikan").html("");
		$("#error-kondisi-perbaikan").html("");
		$("#error-action-perbaikan").html("");
		$("#error-rab-perbaikan").html("");
		
		$("#error-tanggal-perbaikan").html(errors["tanggalrepair"]).css("opacity", 1);
		$("#error-kronologi-perbaikan").html(errors["kronologirepair"]).css("opacity", 1);
		$("#error-kondisi-perbaikan").html(errors["kondisirepair"]).css("opacity", 1);
		$("#error-action-perbaikan").html(errors["actionrepair"]).css("opacity", 1);
		$("#error-rab-perbaikan").html(errors["rabrepair"]).css("opacity", 1);
		//


		//bagian delete
		$("#error-tanggal-delete").html("");
		$("#error-alasan-delete").html("");

		$("#error-tanggal-delete").html(errors["tanggaldelete"]).css("opacity", 1);
		$("#error-alasan-delete").html(errors["alasandelete"]).css("opacity", 1);
		//
	}

	$(".btn-edit").click(function(){
		resetInput();

		let kode = $(this).attr('value');
		$('#btnsave').attr('onClick', 'editData()');
		$('#btnsave').html('Save Changes');
		$("#modaltitle").html("Edit Aset");
		$("#asrama").prop('disabled', true);
		$("#lantai").prop('disabled', true);
		$("#kamar").prop('disabled', true);
		$.ajax({
			type: "POST",
			url: "<?php echo site_url(); ?>"+"/Master/detailAsset",
			data: {key: kode},
			cache: false,
			success: function(response){

				//mengambil data dari asset tsb
				let data = JSON.parse(response);
				//console.log(data);
				$("#kode").val(data["asset"][0].KODE_ASSET);
				$("#asrama").val(data["asset"][0].NAMA_ASSET);
				$("#lantai").val(data["asset"][0].INFO_1);
				$("#kamar").val(data["asset"][0].INFO_2);
				$("#kapasitas").val(data["asset"][0].INFO_3);
				$("#tanggal").val(data["asset"][0].TGL_PENGADAAN);
				//

				//mengambil data fasilitas dari asset tsb
				for (let i = 0; i < data["fasilitas"].length; i++) {
					addFasilitas();
					$($("#listnamafasilitas").find(".form__field")[1]).val(data["fasilitas"][i].NAMA);
					$($("#listjumlahfasilitas").find(".d-flex").find(".form__field")[1]).val(data["fasilitas"][i].JUMLAH);
				}
				//

				//
			}, error: function(){
				alert("Error when loading asset!")
			}
		});
	});

	function editData(){
		let form_data = new FormData();

		let listnama = [];
		$('input[name="namafas[]"]').each( function() {
			listnama.push(this.value);
		});

		let listjumlah = [];
		$('input[name="jumlahfas[]"]').each( function() {
			listjumlah.push(this.value);
		});

		form_data.append("asrama", $("#asrama").val());
		form_data.append("kodelama", $("#kode").val());
		form_data.append("lantai", $("#lantai").val());
		form_data.append("kamar", $("#kamar").val());
		form_data.append("tanggal", $("#tanggal").val());
		form_data.append("kapasitas", $("#kapasitas").val());
		form_data.append("namafasilitas", listnama);
		form_data.append("jumlahfasilitas", listjumlah);
		
		$.ajax({
			type: "POST",
			url: "<?php echo site_url(); ?>"+"/Master/editasrama",
			data: form_data,
			cache: false,
			processData: false,
			contentType: false,
			success: function(response){
				console.log(response);
				var message = JSON.parse(response);
				if (message["message"] == 1){
					$('#modalsuccessbody').html('Sukses mengubah data asrama!');
					$('#modalsuccess').show();
					setTimeout(function(){
						window.location.reload();
					},1500);
				}
				else if (message["message"] == 2){
					message["asrama"] = " Asrama Dengan lantai dan kamar tersebut sudah ada!&nbsp";
					message["lantai"] = " Asrama Dengan lantai dan kamar tersebut sudah ada!&nbsp";
					message["kamar"] = " Asrama Dengan lantai dan kamar tersebut sudah ada!&nbsp";
				}
				raiseErrors(message);
			}, error: function(xhr, status, error) {
				console.log(xhr.responseText);
			},
		});
	}

	$(".btn-repair").click(function(){
		resetInput();
		let kode = $(this).attr('value');
		let today = now.getFullYear()+"-"+(month)+"-"+(day);
		$('#tanggalrepair').val(today);
		$('#koderepair').val(kode);
	});

	$("#btnfix").click(function(){
		let form_data = new FormData();
        form_data.append("gambar", $('#imageperbaikan').prop('files')[0]);
		form_data.append("kodeaset", $("#koderepair").val());
		form_data.append("tanggalrepair", $("#tanggalrepair").val());
		form_data.append("kronologirepair", $("#kronologirepair").val());
		form_data.append("kondisirepair", $("#kondisirepair").val());
		form_data.append("actionrepair", $("#actionrepair").val());
		form_data.append("rabrepair", $("#rabrepair").val());
		
		$.ajax({
			type: "POST",
			url: "<?php echo site_url(); ?>"+"/Master/fixasset",
			data: form_data,
			cache: false,
			processData: false,
			contentType: false,
			success: function(response){
				console.log(response);
				var message = JSON.parse(response);
				if (message["message"] == 1){
					$('#modalsuccessbody').html('Sukses menambah data perbaikan asrama!');
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
	});

	function readURLperbaikan(input){
		if (input.files && input.files[0]) {
			var fileExtension = ['jpeg', 'jpg', 'png', 'pdf', 'doc', 'docx'];
			var ext1 = ['jpeg', 'jpg', 'png'];
			var ext2 = ['pdf', 'doc', 'docx'];
			if ($.inArray($(input).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
				alert("Only formats are allowed : "+fileExtension.join(', '));
			}
			else{
				$(".file-upload-input").hide();
				$(".image-upload-wrap-perbaikan").hide();
				
				var reader = new FileReader();

				reader.onload = function(e) {
					if ($.inArray($(input).val().split('.').pop().toLowerCase(), ext2) == -1) {
						$("#image-upload-wrapper-perbaikan").append(
							"<div class='file-upload-wrapper-perbaikan mx-1 mb-1 d-flex align-items-center' onclick='removeImagePerbaikan(this)'>" + 
								"<img class='file-upload-image' src='" + e.target.result + "'>" +
								'<div class="file-upload-remove-perbaikan cursor-pointer d-flex align-items-center justify-content-center">' +
									"<img src='<?php echo base_url(); ?>assets/img/icons/remove.png'" + "' width=24px>" +
								'</div>' + 
							"</div>"
						);
					}
					else{
						$("#image-upload-wrapper-perbaikan").append(
							"<div class='file-upload-wrapper-perbaikan mx-1 mb-1' d-flex align-items-center justify-content-center onclick='removeImagePerbaikan(this)'>" + 
								"<img class='file-upload-image p-4' src='<?php echo base_url();?>assets/img/icons/document.png' height=80%>" +
								"<div>" + input.files[0].name + "</div>" +
								'<div class="file-upload-remove-perbaikan cursor-pointer d-flex align-items-center justify-content-center">' +
									"<img src='<?php echo base_url(); ?>assets/img/icons/remove.png'" + "' width=24px>" +
								'</div>' + 
							"</div>"
						);
					}

					$('.image-title').html(input.files[0].name);
				};

				reader.readAsDataURL(input.files[0]);
			}
		}
	}

	function removeImagePerbaikan(image){
		//menghapus element image
		let index = $(image).index();
		$(image).remove();
		//

		$(".image-upload-wrap-perbaikan").html(
			'<input class="file-upload-input" type="file" id="imageperbaikan" onchange="readURLperbaikan(this);" accept="file/*" />' +
			'<div class="drag-text">' +
				'<h3>Drag and drop or select a File</h3>' +
			'</div>'
		);
		
		$(".image-upload-wrap-perbaikan").show();
	}

	$(".btn-remove").click(function(){
		resetInput();
		let kode = $(this).attr('value');
		let today = now.getFullYear()+"-"+(month)+"-"+(day);
		$('#tanggaldelete').val(today);
		$('#kodedelete').val(kode);
		console.log($('#kodedelete').val());
	});

	$("#btndelete").click(function(){
		let form_data = new FormData();

		form_data.append("kodeaset", $("#kodedelete").val());
		form_data.append("tanggaldelete", $("#tanggaldelete").val());
		form_data.append("alasandelete", $("#alasandelete").val());
		
		$.ajax({
			type: "POST",
			url: "<?php echo site_url(); ?>"+"/Master/deleteasset",
			data: form_data,
			cache: false,
			processData: false,
			contentType: false,
			success: function(response){
				console.log(response);
				var message = JSON.parse(response);
				if (message["message"] == 1){
					$('#modalsuccessbody').html('Sukses menghapus data asrama!');
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
	});
</script>
