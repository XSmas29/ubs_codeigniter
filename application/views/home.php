<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>UBS Asset Management</title>
</head>

<body>

	<!-- ===============================================-->
	<!--    Main Content-->
	<!-- ===============================================-->
	<main class="main" id="top">
		<?php require_once(APPPATH . 'views\template\header.php') ?>
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css"/>
		<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css"/>
		<section id="home">
			<div class="bg-holder" style="background-image:url(<?php echo base_url(); ?>assets/img/gallery/hero.png);background-position:center;background-size:cover;">
			</div>
			<!--/.bg-holder-->

			<div class="container">
				<div class="row align-items-start min-vh-50 min-vh-sm-75">
					<div class="text-center">
						<h1 class="text-light fs-md-5 fs-lg-6 mt-4">UBS Asset Management</h1>
					</div>
					<div class="text-center">
						<img class="w-50" src="<?php echo base_url('assets/img/illustrations/hero-header.png'); ?>" alt="..." />
					</div>
				</div>

			</div>
		</section>


		<!-- ============================================-->
		<!-- <section> begin ============================-->
		<section class="pt-6" id="menuTable">

			<div class="container">
				<div class="row h-100">
					<div class="col-sm-6 col-xl-3 mb-3">
						<a style="text-decoration: none;" href="<?php echo site_url('Master/listrumah') ?>">
							<div class="rounded-3 shadow py-2 h-100 border-top border-4" style="border-color: #A1B0FC !important; border-radius: 0.6rem !important;">
								<div class="card-body">
									<div class="text-center">
										<img class="w-50" src="<?php echo base_url("assets/img/rumah.png") ?> ">
										<h5 class="my-3">Rumah Dinas</h5>
									</div>
								</div>
								<div class="border-top bg-white text-center pt-3 pb-0">
									<div class="justify-content-center">
										<h5 class="fw-normal">Total Aktif: <?= $jumlahrumah["active"]?></h5>
										<h5 class="fw-normal">Jumlah Tersedia : <?= $jumlahrumah["available"]?></h5>
										<h5 class="fw-normal">Jumlah Terhapus : <?= $jumlahrumah["deleted"]?></h5>
									</div>
								</div>
							</div>
						</a>
					</div>
					<div class="col-sm-6 col-xl-3 mb-3">
						<a style="text-decoration: none;" href="<?php echo site_url('Master/listgedung') ?>">
							<div class="rounded-3 shadow py-2 h-100 border-top border-4" style="border-color: #A1B0FC !important; border-radius: 0.6rem !important;">
								<div class="card-body">
									<div class="text-center">
										<img class="w-50" src="<?php echo base_url("assets/img/gedung.png") ?> ">
										<h5 class="my-3">Gedung</h5>
									</div>
								</div>
								<div class="border-top bg-white text-center pt-3 pb-0">
									<div class="justify-content-center">
										<h5 class="fw-normal">Total Aktif: <?= $jumlahgedung["active"]?></h5>
										<h5 class="fw-normal">Jumlah Tersedia : <?= $jumlahgedung["available"]?></h5>
										<h5 class="fw-normal">Jumlah Terhapus : <?= $jumlahgedung["deleted"]?></h5>
									</div>
								</div>
							</div>
						</a>
					</div>
					<div class="col-sm-6 col-xl-3 mb-3">
						<a style="text-decoration: none;" href="<?php echo site_url('Master/listkendaraan') ?>">
							<div class="rounded-3 shadow py-2 h-100 border-top border-4" style="border-color: #A1B0FC !important; border-radius: 0.6rem !important;">
								<div class="card-body">
									<div class="text-center">
										<img class="w-50" src="<?php echo base_url("assets/img/kendaraan.png") ?> ">
										<h5 class="my-3">Kendaraan</h5>
									</div>
								</div>
								<div class="border-top bg-white text-center pt-3 pb-0">
									<div class="justify-content-center">
										<h5 class="fw-normal">Total Aktif: <?= $jumlahkendaraan["active"]?></h5>
										<h5 class="fw-normal">Jumlah Tersedia : <?= $jumlahkendaraan["available"]?></h5>
										<h5 class="fw-normal">Jumlah Terhapus : <?= $jumlahkendaraan["deleted"]?></h5>
									</div>
								</div>
							</div>
						</a>
					</div>
					<div class="col-sm-6 col-xl-3 mb-3">
						<a style="text-decoration: none;" href="<?php echo site_url('Master/listasrama') ?>">
							<div class="rounded-3 shadow py-2 h-100 border-top border-4" style="border-color: #A1B0FC !important; border-radius: 0.6rem !important;">
								<div class="card-body">
									<div class="text-center">
										<img class="w-50" src="<?php echo base_url("assets/img/asrama.png") ?> ">
										<h5 class="my-3">Asrama</h5>
									</div>
								</div>
								<div class="border-top bg-white text-center pt-3 pb-0">
									<div class="justify-content-center">
										<h5 class="fw-normal">Total Aktif: <?= $jumlahasrama["active"]?></h5>
										<h5 class="fw-normal">Jumlah Tersedia : <?= $jumlahasrama["available"]?></h5>
										<h5 class="fw-normal">Jumlah Terhapus : <?= $jumlahasrama["deleted"]?></h5>
									</div>
								</div>
							</div>
						</a>
					</div>
					<div class="col-sm-6 col-xl-3 mb-3">
						<a style="text-decoration: none;" href="<?php echo site_url('Master/listfasilitas') ?>">
							<div class="rounded-3 shadow py-2 h-100 border-top border-4" style="border-color: #A1B0FC !important; border-radius: 0.6rem !important;">
								<div class="card-body">
									<div class="text-center">
										<img class="w-50" src="<?php echo base_url("assets/img/fasilitas.png") ?> ">
										<h5 class="my-3">Fasilitas</h5>
									</div>
								</div>
								<div class="border-top bg-white text-center pt-3 pb-0">
									<div class="justify-content-center">
										<h5 class="fw-normal">Total Aktif: <?= $jumlahfasilitas["active"]?></h5>
										<h5 class="fw-normal">Jumlah Tersedia : <?= $jumlahfasilitas["available"]?></h5>
										<h5 class="fw-normal">Jumlah Terhapus : <?= $jumlahfasilitas["deleted"]?></h5>
									</div>
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>
			<!-- end of .container-->

		</section>
		<!-- <section> close ============================-->
		<!-- ============================================-->


		<section class="" id="help">
			<div class="bg-holder" style="background-image:url(<?php echo base_url(); ?>assets/img/gallery/hero-footer.png);background-position:center;background-size:cover;">
			</div>
			<!--/.bg-holder-->

		</section>
	</main>
	<!-- ===============================================-->
	<!--    End of Main Content-->
	<!-- ===============================================-->
</body>

</html>
