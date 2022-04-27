<style>
	.link-admin .nav-item{
		color: white !important;
		font-weight: bold;
		transition: 0.2s;
	}
	.link-admin:hover a{
		font-weight: bold;
		font-size: 21px;
		transition: 0.2s;
	}
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-2 px-sm-2 p-2 shadow" style="position: fixed; background-color: #5B6AB4;">
            <div class="fs-5 d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
				<a class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-light text-decoration-none">
					<span class="fs-4">Menu Admin</span>
				</a>
				<hr>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
					<?php if ($login->AKSES_RUMAH == 1 || $login->AKSES_RUMAH == 3 || $login->AKSES_GEDUNG == 1 || $login->AKSES_GEDUNG == 3 || $login->AKSES_KENDARAAN == 1 || $login->AKSES_KENDARAAN == 3 || $login->AKSES_ASRAMA == 1 || $login->AKSES_ASRAMA == 3 || $login->AKSES_FASILITAS == 1 || $login->AKSES_FASILITAS == 3) { ?>
						<li class="pb-4">
							<a href="#submenu" data-bs-toggle="collapse" class="nav-link px-0 align-middle link-light p-0">
								<i class="fa-solid fa-landmark"></i> <span class="ms-1 d-none d-sm-inline">Master Aset</span>
							</a>
							<ul class="collapse flex-column ms-1 fs-6" id="submenu" data-bs-parent="#menu">
								<?php if ($login->AKSES_RUMAH == 1 || $login->AKSES_RUMAH == 3) {?>
									<li class="w-100 mt-1">
										<a href="<?php echo site_url("master/masterrumah"); ?>" class="nav-link px-0 link-light"> <span class="d-none d-sm-inline">Rumah Dinas</span></a>
									</li>
								<?php } ?>
								<?php if ($login->AKSES_GEDUNG == 1 || $login->AKSES_GEDUNG == 3) {?>
									<li class="w-100 mt-1">
										<a href="<?php echo site_url("master/mastergedung"); ?>" class="nav-link px-0 link-light"> <span class="d-none d-sm-inline">Gedung</span></a>
									</li>
								<?php } ?>
								<?php if ($login->AKSES_KENDARAAN == 1 || $login->AKSES_KENDARAAN == 3) {?>
									<li class="w-100 mt-1">
										<a href="<?php echo site_url("master/masterkendaraan"); ?>" class="nav-link px-0 link-light"> <span class="d-none d-sm-inline">Kendaraan</span></a>
									</li>
								<?php } ?>
								<?php if ($login->AKSES_ASRAMA == 1 || $login->AKSES_ASRAMA == 3) {?>
									<li class="w-100 mt-1">
										<a href="<?php echo site_url("master/masterasrama"); ?>" class="nav-link px-0 link-light"> <span class="d-none d-sm-inline">Asrama</span></a>
									</li>
								<?php } ?>
								<?php if ($login->AKSES_FASILITAS == 1 || $login->AKSES_FASILITAS == 3) {?>
									<li class="w-100 mt-1">
										<a href="<?php echo site_url("master/masterfasilitas"); ?>" class="nav-link px-0 link-light"> <span class="d-none d-sm-inline">Fasilitas</span></a>
									</li>
								<?php } ?>
							</ul>
						</li>
					<?php } ?>
					<?php if ($login->AKSES_USER == 1) {?>
						<li class="nav-item pb-4">
							<a href="<?php echo site_url("master/masteruser"); ?>" class="nav-link align-middle p-0 link-light">
								<i class="fa-solid fa-user-group"></i> <span class="ms-1 d-none d-sm-inline">Master User</span>
							</a>
						</li>
					<?php } ?>
					<?php if ($login->AKSES_RUMAH >= 2 || $login->AKSES_GEDUNG >= 2 || $login->AKSES_KENDARAAN >= 2 || $login->AKSES_ASRAMA >= 2 || $login->AKSES_FASILITAS >= 2) {?>
						<li class="nav-item pb-4">
							<a href="<?php echo site_url("transaksi"); ?>" class="nav-link align-middle p-0 link-light">
								<i class="fa-solid fa-business-time"></i> <span class="ms-1 d-none d-sm-inline">Transaksi</span>
							</a>
						</li>
					<?php } ?>
					<?php if ($login->AKSES_LAPORAN == 1) {?>
						<li class="nav-item pb-4">
							<a href="<?php echo site_url("master/masterlaporan"); ?>" class="nav-link align-middle p-0 link-light">
								<i class="fas fa-clipboard"></i> <span class="ms-1 d-none d-sm-inline">Laporan Aset</span>
							</a>
						</li>
					<?php } ?>
                </ul>
            </div>
        </div>
		<div class="col-2"></div>
        <div class="col-10 py-3">
