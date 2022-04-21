
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


<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<meta name="msapplication-TileImage" content="<?php echo base_url('assets/img/favicons/mstile-150x150.png') ?>">
<meta name="theme-color" content="#ffffff">

<style>
	.modal-xl{
		min-width: 80% !important;
	}

	.modal-lg{
		min-width: 60% !important;
	}
	
	.nav-link .nav-item{
		color: white !important;
		transition: 0.2s;
	}

	.nav-link:hover .nav-item{
		color: white !important;
		font-weight: 1000;
		transition: 0.2s;
	}

	section{
		padding-top: 5.75rem;
	}
</style>

<nav class="navbar navbar-expand-lg navbar-light fixed-top py-3 d-block shadow" style="background-color: #2F375F;">
	<div class="container"><a class="navbar-brand" href="<?php echo site_url('Master/index') ?>"><img src="<?php echo base_url('assets/img/ubs.png') ?>" height="50" alt="..." /></a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"> </span></button>
		<div class="collapse navbar-collapse border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
			<ul class="navbar-nav ms-auto pt-2 pt-lg-0 font-base">
				<a class="nav-link link-list-rumah" href="<?php echo site_url('Master/listrumah') ?>"><li class="nav-item px-2" data-anchor="data-anchor">Rumah Dinas</li></a>
				<a class="nav-link link-list-gedung" href="<?php echo site_url('Master/listgedung') ?>"><li class="nav-item px-2" data-anchor="data-anchor">Gedung</li></a>
				<a class="nav-link link-list-kendaraan" href="<?php echo site_url('Master/listkendaraan') ?>"><li class="nav-item px-2" data-anchor="data-anchor">Kendaraan</li></a>
				<a class="nav-link link-list-asrama" href="<?php echo site_url('Master/listasrama') ?>"><li class="nav-item px-2" data-anchor="data-anchor">Asrama</li></a>
				<a class="nav-link link-list-fasilitas" href="<?php echo site_url('Master/listfasilitas') ?>"><li class="nav-item px-2" data-anchor="data-anchor">Fasilitas</li></a>
				<a class="nav-link link-admin" href="<?php echo site_url('Master/master') ?>"><li class="nav-item px-2" data-anchor="data-anchor">Admin</li></a>
			</ul>
		</div>
	</div>
</nav>
