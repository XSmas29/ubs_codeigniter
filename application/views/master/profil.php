<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Asset | Rumah Dinas</title>
</head>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/master-asset.css">
<style>
	.link-list-rumah .nav-item{
		color: white !important;
		font-weight: 1000;
		transition: 0.2s;
	}
</style>
<body>
	<main class="main" id="top">
		<?php require_once(APPPATH . 'views\template\header.php') ?>
		
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css"/>
		<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css"/>

		<section id="home" class="mt-3">
			<div class="bg-holder" style="background-image:url(<?php echo base_url(); ?>assets/img/gallery/hero.png);background-position:center;background-size:cover;">
			</div>

			<div class="container">
				<div class="row">
					<div class="col-3"></div>
					<div class="col-6">
						<h3 class="text-light text-center">Profil User</h3>
					</div>
					<div class="col-3">
				</div>
				<div class="row mt-2">
					<div class="col-3"></div>
					<div class="bg-light min-vh-50 min-vh-sm-75 p-4 rounded-3 col-6" style="box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;">
						<div class="form-group field mb-3">
							<label class="form-label">NIK<small class="form-nik" id="error-nik"></small></label>
							<input type="text" class="form-control" name="nik" id="nik" disabled value='<?= $login->NIK ?>'/>
						</div>
						<div class="form-group field mb-3">
							<label class="form-label">Nama<small class="form-nama" id="error-nama"></small></label>
							<input type="text" class="form-control" name="nama" id="nama" disabled value='<?= $login->NAMA ?>'/>
						</div>
						<div class="form-group field mb-5">
							<label class="form-label">Departemen<small class="form-departemen" id="error-departemen"></small></label>
							<input type="text" class="form-control" name="departemen" id="departemen" disabled value='<?= $login->DEPARTEMEN ?>'/>
						</div>
						<div class="form-label fs-5 mb-3 fw-bold text-center">Ubah Password</div>
						<div class="form-group field mb-3">
							<label class="form-label">Password lama<small class="form-error" id="error-passlama"></small></label>
							<input type="password" class="form-control" name="passlama" id="passlama"/>
						</div>
						<div class="form-group field mb-3">
							<label class="form-label">Password baru<small class="form-error" id="error-passbaru"></small></label>
							<input type="password" class="form-control" name="passbaru" id="passbaru"/>
						</div>
						<div class="form-group field">
							<label class="form-label">Konfirmasi password baru<small class="form-error" id="error-konfirmasi"></small></label>
							<input type="password" class="form-control" name="konfirmasi" id="konfirmasi"/>
						</div>
						<div class="d-grid gap-2">
							<button type="button" class="btn mt-4 fw-bold text-light py-2" style="background-color: #6237FF;" id="btnsubmit" onclick="changePassword()">Ubah Password</button>
						</div>
					</div>
					<div class="col-3">
				</div>
			</div>
			
		</section>
	</main>
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
	function changePassword(){
		let form_data = new FormData();
        form_data.append("passlama", $("#passlama").val());
		form_data.append("passbaru", $("#passbaru").val());
		form_data.append("konfirmasi", $("#konfirmasi").val());

		$.ajax({
			type: "POST",
			url: "<?php echo site_url(); ?>"+"/Master/ubahpassword",
			data: form_data,
			cache: false,
			processData: false,
			contentType: false,
            dataType: 'json',
			success: function(response){
                let message = response;
				raiseErrors(message);
				if (message["message"] == 1){
					$('#modalsuccessbody').html('Sukses mengubah password!');
					$('#modalsuccess').show();
					setTimeout(function(){
						window.location.reload();
					},1500);
				}
			}, error: function(xhr, status, error) {
				console.log(xhr.responseText);
			},
		});
	}

	function raiseErrors(errors){
		$("#error-passlama").html("");
		$("#error-passbaru").html("");
		$("#error-konfirmasi").html("");

		$("#error-passlama").html(errors["passlama"]).css("opacity", 1);
		$("#error-passbaru").html(errors["passbaru"]).css("opacity", 1);
		$("#error-konfirmasi").html(errors["konfirmasi"]).css("opacity", 1);
	}
</script>
