<script src="<?php echo base_url('vendors/@popperjs/popper.min.js') ?>"></script>
<script src="<?php echo base_url('vendors/bootstrap/bootstrap.min.js') ?>"></script>
<script src="<?php echo base_url('vendors/is/is.min.js') ?>"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
<script src="<?php echo base_url('vendors/fontawesome/all.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/theme.js') ?>"></script>
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url('assets/img/favicons/apple-touch-icon.png') ?>">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url('assets/img/favicons/favicon-32x32.png') ?>">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('assets/img/favicons/favicon-16x16.png') ?>">
<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('assets/img/favicons/favicon.ico') ?>">
<link rel="manifest" href="<?php echo base_url('assets/img/favicons/manifest.json') ?>">

<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;600;700;800&amp;display=swap" rel="stylesheet">

<link href="<?php echo base_url('assets/css/theme.css') ?>" rel="stylesheet" />

<!-- link datatables -->
<script src="<?php echo base_url('assets/js/jquery-3.6.0.js') ?>"></script>
<script src="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"></script>
<script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/r-2.2.9/datatables.min.js"></script>
<script src="https://kit.fontawesome.com/cd18499543.js" crossorigin="anonymous"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css"/>

<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>UBS Asset Management</title>
</head>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/master-asset.css">
<style>
	.form-error{
		opacity: 1;
	}
</style>
<script type="text/javascript">
	let session = "<?php echo $this->session->flashdata('msg'); unset($_SESSION['msg'])?>";
	$(document).ready( function (){
		if (session != ""){
			$('#modal').modal('show');
			if (session == 1){
				$("#modaltitle").html("Login berhasil!");
				$("#modalbody").html("Berhasil login!");
				setTimeout(function(){
					window.location.replace("<?php echo site_url(); ?>/master");
				},1000);
			}
			else{
				$("#modaltitle").html("Login gagal!");
				$("#modalbody").html(session);
			}
		}
	});
</script>
<body>

	<!-- ===============================================-->
	<!--    Main Content-->
	<!-- ===============================================-->
	<main class="main" id="top">
		<section id="home" style="padding-top: 5rem;">
			<div class="bg-holder min-vh-100" style="background-image:url(<?php echo base_url(); ?>assets/img/gallery/hero.png);background-position:center;background-size:cover;">
			</div>
			<!--/.bg-holder-->

			<div class="container">
				<div class="text-center mb-5">
					<img src="<?php echo base_url(); ?>assets/img/logo.png" width="140px" height="140px">
				</div>
				<div class="row">
					<div class="col-4"></div>
					<div class="col-4 mb-3">
						<div class="rounded-3 p-4 py-2 h-100 border-top border-5 bg-light" style="border-color: #A1B0FC !important; border-radius: 0.6rem !important;box-shadow: rgba(0, 0, 0, 0.07) 0px 1px 2px, rgba(0, 0, 0, 0.07) 0px 2px 4px, rgba(0, 0, 0, 0.07) 0px 4px 8px, rgba(0, 0, 0, 0.07) 0px 8px 16px, rgba(0, 0, 0, 0.07) 0px 16px 32px, rgba(0, 0, 0, 0.07) 0px 32px 64px;">
							<div class="card-body">
								<h1 class="mt-4 fs-md-4 fs-lg-5 text-center">Login</h1>
							</div>	
							<?php echo form_open('Auth/login'); ?>
								<div class="form__group field mb-4">
									<?php echo form_input(array(
										'type'		      => 'text',
										'class'           => 'form__field',
										'name'            => 'nik',
										'id'              => 'nik',
										'placeholder'     => 'NIK',
										'value'           => set_value('nik')
									));
									?>
									<label class="form__label">NIK<?php echo form_error('nik'); ?></label>
								</div>
								<div class="form__group field mb-4">
									<?php echo form_input(array(
										'type'		      => 'password',
										'class'           => 'form__field',
										'name'            => 'password',
										'id'              => 'password',
										'placeholder'     => 'Password',
									));
									?>
									<label class="form__label">Password<?php echo form_error('password'); ?></label>
								</div>
								<div class="form-check mt-4">
									<?php echo form_checkbox(array(
										'class'           => 'form-check-input',
										'name'            => 'rememberme',
										'id'              => 'rememberme',
										'value'              => 'rememberme',
									));
									?>
									<label class="form-check-label" for="flexCheckDefault">
										Remember me
									</label>
								</div>
								<div class="d-grid gap-2">
								<?php echo form_button(array(
									'id'            => 'btnsubmit',
									'type'          => 'submit',
									'class'         => 'btn mt-4 fw-bold text-light py-2',
									'content'       => 'Login',
									'style'         => 'background-color: #6237FF;'
								));?>
								</div>
						</div>
						
					</div>
					<div class="col-4"></div>
				</div>
				
			</div>
		</section>

		<section class="py-0 py-xxl-6" id="help">
			<div class="bg-holder" style="background-image:url(<?php echo base_url(); ?>assets/img/gallery/footer-bg.png);background-position:center;background-size:cover;">
			</div>
			<!--/.bg-holder-->

		</section>
	</main>
	<!-- ===============================================-->
	<!--    End of Main Content-->
	<!-- ===============================================-->

	<div class="modal" tabindex="-1" id="modal">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modaltitle">Modal title</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
			<div class="modal-body" id="modalbody">
				<p>Modal body text goes here.</p>
			</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</body>

</html>
