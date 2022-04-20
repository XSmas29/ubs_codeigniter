<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Master | Gedung</title>
</head>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/master-asset.css">
<style>
	.link-admin-gedung{
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
									<h3 class="text-dark">Gedung</h3>
								</div>
							</div>
							<div class="d-flex justify-content-end">
								<button data-bs-toggle="modal" href="#modaladdgedung" class="btn btn-sm btn-primary my-2" id="btnadd">+ NEW ASSET</button>
							</div>
							<table id="myTable" class="table table-striped table-bordered rounded text-center">
								<thead>
									<tr>
										<th>Gedung</th>
										<th>Nama Aset</th>
										<th>Kode Aset</th>
										<th>No IMB</th>
										<th>Peruntukan</th>
										<th>Lokasi</th>
										<th>Date</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
										<?php 
											for ($i=0; $i < count($listgedung); $i++) {
												$status = '';
												if ($listgedung[$i]->IS_DELETED == 1) $status = "disabled";
										?>
												<tr>
													<td><?= $listgedung[$i]->INFO_4?></td>
													<td><?= $listgedung[$i]->NAMA_ASSET?></td>
													<td><?= $listgedung[$i]->KODE_ASSET?></td>
													<td><?= $listgedung[$i]->INFO_5?></td>
													<td><?= $listgedung[$i]->INFO_1?></td>
													<td><?= $listgedung[$i]->INFO_3?></td>
													<td><?= date('d F Y', strtotime($listgedung[$i]->TGL_PENGADAAN))?></td>
													<td>
														<?php 
														if ($listgedung[$i]->IS_DELETED == 1){
															echo "<button disabled class='btn btn-sm btn-danger'>Deleted</button>";
														}
														else{
															if ($listgedung[$i]->STATUS == 0){
																echo "<button disabled class='btn btn-sm btn-success'>Available</button>";
															}
															else if ($listgedung[$i]->STATUS == 1){
																echo "<button disabled class='btn btn-sm btn-warning'>In Use</button>";
															}
														}
														?>
													</td>
													<td>
														<button data-bs-toggle="modal" href="#modaladdgedung" role="button" class="btn btn-sm btn-info btn-edit" value='<?= $listgedung[$i]->KODE_ASSET ?>' <?php echo $status?>>
															<img src="<?php echo base_url(); ?>assets/img/icons/edit.png" width="16" height="16">
														</button>
														<button data-bs-toggle="modal" href="#modalperbaikan" role="button" class="btn btn-sm btn-secondary btn-repair" value='<?= $listgedung[$i]->KODE_ASSET ?>' <?php echo $status?>>
															<img src="<?php echo base_url(); ?>assets/img/icons/repair.png" width="16" height="16">
														</button>
														<button data-bs-toggle="modal" href="#modaldelete" role="button" class="btn btn-sm btn-danger btn-remove" value='<?= $listgedung[$i]->KODE_ASSET ?>' <?php echo $status?>>
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

	<div class="modal fade" id="modaladdgedung" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">
				<div class="modal-header">
				<h4 class="modal-title" id="modaltitle"></h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body pt-0 min-vh-25 min-vh-sm-50">
					<div class="row text-center">
						<div class="col-6">
							<div class="form__group field mb-5">
								<input type="text" class="form__field" name="gedung" id="gedung" placeholder="Gedung"/>
								<label class="form__label">Gedung<small class="form-error" id="error-gedung"></small></label>
							</div>
							<div class="form__group field mb-5">
								<input type="text" id="kodeaset" class="form__field" name="kode" id="kode" placeholder="Kode Aset" disabled/>
								<label class="form__label">Kode Aset<small class="form-error" id="error-kode"></small></label>
							</div>
							<div class="form__group field mb-5">
								<input type="text" class="form__field" name="imb" id="imb" placeholder="No IMB"/>
								<label class="form__label">No IMB<small class="form-error" id="error-imb"></small></label>
							</div>
							<div class="form__group field mb-5">
								<input type="text" class="form__field" name="nama" id="nama" placeholder="Nama Aset"/>
								<label class="form__label">Nama Aset<small class="form-error" id="error-nama"></small></label>
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
						</div>
						<div class="col-6">
							<div class="form__group field mb-5">
								<input type="text" class="form__field" name="lokasi" id="lokasi" placeholder="Lokasi"/>
								<label class="form__label">Lokasi<small class="form-error" id="error-lokasi"></small></label>
							</div>
							<div class="form__group field mb-5">
								<input type="text" class="form__field" name="peruntukkan" id="peruntukkan" placeholder="Peruntukkan"/>
								<label class="form__label">Peruntukkan<small class="form-error" id="error-peruntukkan"></small></label>
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

	$(document).ready( function () 
	{
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
			data: {key: 2},
			cache: false,
			success: function(response){
				let data = JSON.parse(response);

				let jumlah = data["count"][0].jumlah;

				let today = (day)+"/"+(month)+"/"+now.getFullYear();
				let next = (parseInt(jumlah) + 1).toString();
				kode = today + "/G/UBS/" + next.padStart(3, "0");
				$("#kodeaset").val(kode);
				//console.log(kode);
			}, error: function(){
				console.log("Error when counting asset!")
			}
		});
	});

	function addData(){
		let form_data = new FormData();

		form_data.append("gedung", $("#gedung").val());
		form_data.append("kodeaset", $("#kodeaset").val());
		form_data.append("imb", $("#imb").val());
		form_data.append("nama", $("#nama").val());
		form_data.append("jenis", $("#jenis").val());
		form_data.append("lokasi", $("#lokasi").val());
		form_data.append("tanggal", $("#tanggal").val());
		form_data.append("peruntukkan", $("#peruntukkan").val());
		
		$.ajax({
			type: "POST",
			url: "<?php echo site_url(); ?>"+"/Master/addgedung",
			data: form_data,
			cache: false,
			processData: false,
			contentType: false,
			success: function(response){
				console.log(response);
				var message = JSON.parse(response);
				if (message["message"] == 1){
					$('#modalsuccessbody').html('Sukses menambah data gedung!');
					$('#modalsuccess').show();
					setTimeout(function(){
						window.location.reload();
					},1500);
				}
				raiseErrors(message);
			}, error: function(xhr, status, error) {
				console.log(xhr.responseText);
			},
		});
	};

	$(".btn-edit").click(function(){
		resetInput();
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
				$("#gedung").val(data["asset"][0].INFO_4);
				$("#kodeaset").val(data["asset"][0].KODE_ASSET);
				$("#imb").val(data["asset"][0].INFO_5);
				$("#nama").val(data["asset"][0].NAMA_ASSET);
				$("#jenis").val(data["asset"][0].INFO_2);
				$("#lokasi").val(data["asset"][0].INFO_1);
				$("#tanggal").val(data["asset"][0].TGL_PENGADAAN);
				$("#peruntukkan").val(data["asset"][0].INFO_3);
				//

			}, error: function(){
				alert("Error when loading asset!")
			}
		});
	});

	function editData(){
		let form_data = new FormData();

		form_data.append("gedung", $("#gedung").val());
		form_data.append("kodeaset", $("#kodeaset").val());
		form_data.append("imb", $("#imb").val());
		form_data.append("nama", $("#nama").val());
		form_data.append("jenis", $("#jenis").val());
		form_data.append("lokasi", $("#lokasi").val());
		form_data.append("tanggal", $("#tanggal").val());
		form_data.append("peruntukkan", $("#peruntukkan").val());
		
		$.ajax({
			type: "POST",
			url: "<?php echo site_url(); ?>"+"/Master/editgedung",
			data: form_data,
			cache: false,
			processData: false,
			contentType: false,
			success: function(response){
				console.log(response);
				var message = JSON.parse(response);
				if (message["message"] == 1){
					$('#modalsuccessbody').html('Sukses mengubah data gedung!');
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
					$('#modalsuccessbody').html('Sukses menambah data perbaikan gedung!');
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
					$('#modalsuccessbody').html('Sukses menghapus data gedung!');
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

	function resetInput(){
		//bagian add & edit
		$(".form-error").text('');
		$("#gedung").val('');
		$("#imb").val('');
		$("#nama").val('');
		$("#jenis").val('');
		$("#lokasi").val('');
		$("#peruntukkan").val('');
		
		//bagian perbaikan
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

		//bagian delete
		$("#alasandelete").val('');
	}

	function raiseErrors(errors){
		console.log(errors);
		//bagian add & edit
		$("#error-gedung").html('');
		$("#error-kode").html('');
		$("#error-imb").html('');
		$("#error-nama").html('');
		$("#error-jenis").html('');
		$("#error-lokasi").html('');
		$("#error-tanggal").html('');
		$("#error-peruntukkan").html('');

		$("#error-gedung").html(errors["gedung"]).css("opacity", 1);
		$("#error-kode").html(errors["kode"]).css("opacity", 1);
		$("#error-imb").html(errors["imb"]).css("opacity", 1);
		$("#error-nama").html(errors["nama"]).css("opacity", 1);
		$("#error-jenis").html(errors["jenis"]).css("opacity", 1);
		$("#error-lokasi").html(errors["lokasi"]).css("opacity", 1);
		$("#error-tanggal").html(errors["tanggal"]).css("opacity", 1);
		$("#error-peruntukkan").html(errors["peruntukkan"]).css("opacity", 1);
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
</script>
