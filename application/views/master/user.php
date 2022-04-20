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

		<section id="home">
			<div class="bg-holder" style="background-image:url(<?php echo base_url(); ?>assets/img/gallery/hero.png);background-position:center;background-size:cover;">
			</div>
			<?php require_once(APPPATH . 'views\template\navbar.php') ?>
			<div class="container-fluid">
				<div class="row">
					<div class="bg-light min-vh-50 min-vh-sm-75 p-4 rounded-3 fs-5" style="box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;">
						<div class="row align-items-start">
							<div>
								<h3 class="text-dark">User</h3>
							</div>
						</div>
						<div class="d-flex justify-content-end">
							<button type="button" class="btn btn-sm btn-primary my-2" data-bs-toggle="modal" href="#modaladduser" role="button" id="btnadd" onclick="generateNIK()">+ NEW USER</button>
						</div>
								<table id="myTable" class="table table-striped table-bordered table-light text-center">
							<thead>
								<tr>
									<th>NIK</th>
									<th>Nama User</th>
									<th>Departemen</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
									<?php 
										for ($i=0; $i < count($listuser); $i++) {
											$status = '';
											if ($listuser[$i]->IS_DELETED == 1) $status = "disabled";
									?>
										<tr>
											<td><?= $listuser[$i]->NIK?></td>
											<td><?= $listuser[$i]->NAMA?></td>
											<td><?= $listuser[$i]->DEPARTEMEN?></td>
											<td>
												<?php 
												if ($listuser[$i]->IS_DELETED == 1){
													echo "<button disabled class='btn btn-sm btn-danger'>Inactive</button>";
												}
												else{
													echo "<button disabled class='btn btn-sm btn-success'>Active</button>";
												}
												?>
											</td>
											<td>
												<button data-bs-toggle="modal" href="#modaladduser" role="button" class="btn btn-sm btn-info btn-edit" value='<?= $listuser[$i]->NIK ?>' <?php echo $status?>>
													<img src="<?php echo base_url(); ?>assets/img/icons/edit.png" width="16" height="16">
												</button>
												<button data-bs-toggle="modal" href="#modalban" role="button" class="btn btn-sm btn-danger btn-ban" value='<?= $listuser[$i]->NIK ?>' <?php echo ($listuser[$i]->IS_DELETED == 1) ? 'hidden' : ''; ?>>
													<img src="<?php echo base_url(); ?>assets/img/icons/ban.png" width="16" height="16">
												</button>
												<button data-bs-toggle="modal" href="#modalunban" role="button" class="btn btn-sm btn-success btn-unban" value='<?= $listuser[$i]->NIK ?>' <?php echo ($listuser[$i]->IS_DELETED == 0) ? 'hidden' : ''; ?>>
													<img src="<?php echo base_url(); ?>assets/img/icons/unban.png" width="16" height="16">
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

	<div class="modal fade" id="modaladduser" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">
				<div class="modal-header">
				<h4 class="modal-title" id="modaltitle">Add User</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body pt-0 min-vh-25 min-vh-sm-50">
					<div class="row">
						<div class="col-6">
							<input type="text" class="form__field" name="kode" id="kode" hidden/>
							<div class="form__group field mb-5">
								<input type="text" class="form__field" name="nik" id="nik" placeholder="NIK" disabled/>
								<label class="form__label">NIK<small class="form-error" id="error-nik"></small></label>
							</div>
							<div class="form__group field mb-5">
								<input type="text" class="form__field" name="nama" id="nama" placeholder="Nama"/>
								<label class="form__label">Nama<small class="form-error" id="error-nama"></small></label>
							</div>
							<div class="form__group field mb-5">
								<input type="text" class="form__field" name="departemen" id="departemen" placeholder="Departemen"/>
								<label class="form__label">Departemen<small class="form-error" id="error-departemen"></small></label>
							</div>
							<div class="form__group field mb-5">
								<input type="password" class="form__field" name="password" id="password" placeholder="Password"/>
								<label class="form__label" id="label-password">Password<small class="form-error" id="error-password"></small></label>
							</div>
							<div class="form__group field mb-5">
								<input type="password" class="form__field" name="konfirmasi" id="konfirmasi" placeholder="Konfirmasi password"/>
								<label class="form__label" id="label-konfirmasi">Konfirmasi password<small class="form-error" id="error-konfirmasi"></small></label>
							</div>
						</div>
						<div class="col-6">
							<label class="form_label mt-2 fs-5">Hak Akses</label>
							<ul class="list-group rounded-3">
								<li class="list-group-item">
									<!-- master -->
									<label class="form_label">Master</label>
									<ul class="list-group mb-2">
										<li class="list-group-item">
											<div class="form-check">
												<input class="form-check-input" type="checkbox" value="" id="masterrumah">
												<label class="form-check-label mb-0" for="flexCheckDefault">
													Rumah Dinas
												</label>
											</div>
										</li>
										<li class="list-group-item">
											<div class="form-check">
												<input class="form-check-input" type="checkbox" value="" id="mastergedung">
												<label class="form-check-label mb-0" for="flexCheckDefault">
													Gedung
												</label>
											</div>
										</li>
										<li class="list-group-item">
											<div class="form-check">
												<input class="form-check-input" type="checkbox" value="" id="masterkendaraan">
												<label class="form-check-label mb-0" for="flexCheckDefault">
													Kendaraan
												</label>
											</div>
										</li>
										<li class="list-group-item">
											<div class="form-check">
												<input class="form-check-input" type="checkbox" value="" id="masterasrama">
												<label class="form-check-label mb-0" for="flexCheckDefault">
													Asrama
												</label>
											</div>
										</li>
										<li class="list-group-item">
											<div class="form-check">
												<input class="form-check-input" type="checkbox" value="" id="masterfasilitas">
												<label class="form-check-label mb-0" for="flexCheckDefault">
													Fasilitas
												</label>
											</div>
										</li>
										<li class="list-group-item">
											<div class="form-check">
												<input class="form-check-input" type="checkbox" value="" id="masteruser">
												<label class="form-check-label mb-0" for="flexCheckDefault">
													User
												</label>
											</div>
										</li>
										<li class="list-group-item">
											<div class="form-check">
												<input class="form-check-input" type="checkbox" value="" id="masterlaporan">
												<label class="form-check-label mb-0" for="flexCheckDefault">
													Laporan Aset
												</label>
											</div>
										</li>
									</ul>
								</li>
								<li class="list-group-item">
									<!-- transaksi -->
									<label class="form_label">Transaksi</label>
									<ul class="list-group mb-2">
										<li class="list-group-item">
											<div class="form-check">
												<input class="form-check-input" type="checkbox" value="" id="transaksi">
												<label class="form-check-label mb-0" for="flexCheckDefault">
													Peminjaman & Pengembalian
												</label>
											</div>
										</li>
									</ul>
								</li>
							</ul>	
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

	<div class="modal fade" id="modalban" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
		<div class="modal-dialog modal-dialog-centered modal-md">
			<div class="modal-content">
				<div class="modal-header">
				<h4 class="modal-title">Ban User</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body pt-0">
					<input type="text" name="kodeban" id="kodeban" hidden/>
					<p class="my-4 text-center fs-5">Yakin ingin menonaktifkan user?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-danger px-5 btn-submit" id="btnban">Confirm</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modalunban" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
		<div class="modal-dialog modal-dialog-centered modal-md">
			<div class="modal-content">
				<div class="modal-header">
				<h4 class="modal-title">Unban User</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body pt-0">
					<input type="text" name="kodeunban" id="kodeunban" hidden/>
					<p class="my-4 text-center fs-5">Yakin ingin mengaktifkan user?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-danger px-5 btn-submit" id="btnunban">Confirm</button>
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
	$('#myTable').DataTable( 
		{
			responsive: true
		} 
	);

	function generateNIK(){
		$.ajax({
			type: "POST",
			url: "<?php echo site_url(); ?>"+"/Master/generateNIK",
			cache: false,
			processData: false,
			contentType: false,
			success: function(response){
				var message = JSON.parse(response);
				console.log(message);
				$("#nik").val(message["count"])
			}, error: function(xhr, status, error) {
				console.log(xhr.responseText);
			},
		});
	}

	function resetInput(){
		//add & edit
		$(".form-error").text('');
		$("#nama").val('');
		$("#departemen").val('');
		

		$("#masterrumah").prop('checked', false);
		$("#mastergedung").prop('checked', false);
		$("#masterkendaraan").prop('checked', false);
		$("#masterasrama").prop('checked', false);
		$("#masterfasilitas").prop('checked', false);
		$("#masteruser").prop('checked', false);
		$("#masterlaporan").prop('checked', false);
		$("#transaksi").prop('checked', false);
		//

		$("#kodeban").val("");
		$("#kodeunban").val("");
	}

	$("#btnadd").click(function(){
		resetInput();
		$('#btnsave').attr('onClick', 'addData()');
		$("#password").prop('hidden', false);
		$("#konfirmasi").prop('hidden', false);
		$("#label-password").prop('hidden', false);
		$("#label-konfirmasi").prop('hidden', false);
	});

	$(".btn-edit").click(function(){
		resetInput();

		$("#password").prop('hidden', true);
		$("#konfirmasi").prop('hidden', true);
		$("#label-password").prop('hidden', true);
		$("#label-konfirmasi").prop('hidden', true);

		let kode = $(this).attr('value');
		$('#btnsave').attr('onClick', 'editData()');
		$('#btnsave').html('Save Changes');
		$("#modaltitle").html("Edit Aset");
		$.ajax({
			type: "POST",
			url: "<?php echo site_url(); ?>"+"/Master/detailUser",
			data: {key: kode},
			cache: false,
			success: function(response){
				//mengambil data dari asset tsb
				let data = JSON.parse(response);
				console.log(data);
				$("#nik").val(data["user"][0].NIK);
				$("#nama").val(data["user"][0].NAMA);
				$("#departemen").val(data["user"][0].DEPARTEMEN);
				$("#masterrumah").prop('checked', data["user"][0].MASTER_RUMAH == 1 ? true : false);
				$("#mastergedung").prop('checked',data["user"][0].MASTER_GEDUNG == 1 ? true : false);
				$("#masterkendaraan").prop('checked',data["user"][0].MASTER_KENDARAAN == 1 ? true : false);
				$("#masterasrama").prop('checked',data["user"][0].MASTER_ASRAMA == 1 ? true : false);
				$("#masterfasilitas").prop('checked',data["user"][0].MASTER_FASILITAS == 1 ? true : false);
				$("#masteruser").prop('checked',data["user"][0].MASTER_USER == 1 ? true : false);
				$("#masterlaporan").prop('checked',data["user"][0].MASTER_LAPORAN == 1 ? true : false);
				$("#transaksi").prop('checked',data["user"][0].MASTER_TRANSAKSI == 1 ? true : false);
				//

			}, error: function(){
				alert("Error when loading user!")
			}
		});
	});

	$(".btn-ban").click(function(){
		resetInput();
		
		$("#kodeban").val($(this).val());
	});

	$(".btn-unban").click(function(){
		resetInput();
		
		$("#kodeunban").val($(this).val());
	});

	function addData(){
		let form_data = new FormData();
		form_data.append("nik", $("#nik").val());
		form_data.append("nama", $("#nama").val());
		form_data.append("departemen", $("#departemen").val());
		form_data.append("password", $("#password").val());
		form_data.append("konfirmasi", $("#konfirmasi").val());
		form_data.append("masterrumah", $('#masterrumah').is(':checked') * 1);
		form_data.append("mastergedung", $('#mastergedung').is(':checked') * 1);
		form_data.append("masterkendaraan", $('#masterkendaraan').is(':checked') * 1);
		form_data.append("masterasrama", $('#masterasrama').is(':checked') * 1);
		form_data.append("masterfasilitas", $('#masterfasilitas').is(':checked') * 1);
		form_data.append("masteruser", $('#masteruser').is(':checked') * 1);
		form_data.append("masterlaporan", $('#masterlaporan').is(':checked') * 1);
		form_data.append("transaksi", $('#transaksi').is(':checked') * 1);
		
		$.ajax({
			type: "POST",
			url: "<?php echo site_url(); ?>"+"/Master/adduser",
			data: form_data,
			cache: false,
			processData: false,
			contentType: false,
			success: function(response){
				console.log(response);
				var message = JSON.parse(response);
				if (message["message"] == 1){
					$('#modalsuccessbody').html('Sukses menambah data user!');
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
	}

	function editData(){
		let form_data = new FormData();
		form_data.append("nik", $("#nik").val());
		form_data.append("nama", $("#nama").val());
		form_data.append("departemen", $("#departemen").val());
		form_data.append("password", $("#password").val());
		form_data.append("konfirmasi", $("#konfirmasi").val());
		form_data.append("masterrumah", $('#masterrumah').is(':checked') * 1);
		form_data.append("mastergedung", $('#mastergedung').is(':checked') * 1);
		form_data.append("masterkendaraan", $('#masterkendaraan').is(':checked') * 1);
		form_data.append("masterasrama", $('#masterasrama').is(':checked') * 1);
		form_data.append("masterfasilitas", $('#masterfasilitas').is(':checked') * 1);
		form_data.append("masteruser", $('#masteruser').is(':checked') * 1);
		form_data.append("masterlaporan", $('#masterlaporan').is(':checked') * 1);
		form_data.append("transaksi", $('#transaksi').is(':checked') * 1);
		
		$.ajax({
			type: "POST",
			url: "<?php echo site_url(); ?>"+"/Master/edituser",
			data: form_data,
			cache: false,
			processData: false,
			contentType: false,
			success: function(response){
				console.log(response);
				var message = JSON.parse(response);
				if (message["message"] == 1){
					$('#modalsuccessbody').html('Sukses mengubah data user!');
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
	}

	$("#btnban").click(function(){
		let kode = $("#kodeban").val();
		$.ajax({
			type: "POST",
			url: "<?php echo site_url(); ?>"+"/Master/banuser",
			data: {key: kode},
			cache: false,
			success: function(response){
				console.log(response);
				var message = JSON.parse(response);
				if (message["message"] == 1){
					$('#modalsuccessbody').html('Sukses menonaktifkan user!');
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
	});

	$("#btnunban").click(function(){
		let kode = $("#kodeunban").val();
		$.ajax({
			type: "POST",
			url: "<?php echo site_url(); ?>"+"/Master/unbanuser",
			data: {key: kode},
			cache: false,
			success: function(response){
				console.log(response);
				var message = JSON.parse(response);
				if (message["message"] == 1){
					$('#modalsuccessbody').html('Sukses mengaktifkan user!');
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
	});

	function raiseErrors(errors){
		console.log(errors);
		//bagian add & edit
		$("#error-nik").html('');
		$("#error-nama").html("");
		$("#error-departemen").html("");
		$("#error-password").html('');
		$("#error-konfirmasi").html('');

		$("#error-nik").html(errors["nik"]).css("opacity", 1);
		$("#error-nama").html(errors["nama"]).css("opacity", 1);
		$("#error-departemen").html(errors["departemen"]).css("opacity", 1);
		$("#error-password").html(errors["password"]).css("opacity", 1);
		$("#error-konfirmasi").html(errors["konfirmasi"]).css("opacity", 1);
		//
	}
</script>
