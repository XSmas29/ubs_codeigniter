<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Asset | Asrama</title>
</head>

<body>
	<main class="main" id="top">
		<?php require_once(APPPATH . 'views\template\header.php') ?>

		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.bundle.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css"/>

		<section id="home">
			<div class="bg-holder" style="background-image:url(<?php echo base_url(); ?>assets/img/gallery/hero.png);background-position:center;background-size:cover;">
			</div>

			<div class="container">
				<div class="row align-items-start">
					<div>
						<h3 class="text-light">Database Asrama</h3>
					</div>
				</div>
				<div class="bg-light min-vh-50 min-vh-sm-75 p-4 rounded-3">
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
									?>
										<tr>
										<td><?= $listAsrama[$i]->NAMA_ASSET?></td>
										<td><?= $listAsrama[$i]->INFO_1?></td>
										<td><?= $listAsrama[$i]->INFO_2?></td>
										<td><?= $listAsrama[$i]->INFO_3?></td>
										<td><?= $listAsrama[$i]->INFO_4?></td>
										<td>
											<?php 
											if ($listAsrama[$i]->STATUS == 0){
												echo "<button disabled class='btn btn-sm btn-success'>Available</button>";
											}
											else if ($listAsrama[$i]->STATUS == 1){
												echo "<button disabled class='btn btn-sm btn-warning'>In Use</button>";
											}
											else{
												echo "<button disabled class='btn btn-sm btn-danger'>Deleted</button>";
											}
											?>
										</td>
										<td><a class="btn btn-primary btn-sm" data-bs-toggle="modal" href="#exampleModalToggle" role="button">View</a></td>
											</tr>
										</tr>
									<?php
										}
									?>
							</tbody>
						</table>
					</div>
			</div>
		</section>
	</main>
	<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
		<div class="modal-dialog modal-dialog-centered modal-xl">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-header py-0 mb-4 border-bottom-0">
					<div class="row text-center w-100">
						<div class="col-6 py-3 border-bottom border-2 border-dark">
							<a class="text-dark fw-bold" style="text-decoration: none" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal" role="button">
								Details
							</a>
						</div>
						<div class="col-6 py-3">
							<a class="text-dark" style="text-decoration: none" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal" role="button">
								History
							</a>
						</div>
					</div>
				</div>
				<div class="modal-body pt-0 min-vh-25 min-vh-sm-50">
				
					<div class="row">
						<div class="col-6">
							<div class="card border" style="border-radius: 20px">
								<h5 class="text-center mt-3">Daftar Penghuni</h5>
								<div class="card-body mx-3">
									<table id="" class="table text-center">
										<thead>
											<tr>
												<th class="bg-dark text-white">NIK</th>
												<th class="bg-dark text-white">NAMA</th>
												<th class="bg-dark text-white">DEPARTEMEN</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>003540</td>
												<td>Sun</td>
												<td>FC</td>
											</tr>
											<tr>
												<td>015890</td>
												<td>Emi</td>
												<td>Hollow</td>
											</tr>
											<!-- FOREACH -->
										</tbody>
									</table>
								</div>

							</div>
						</div>

						<div class="col-6">
							<div class="card border" style="border-radius: 20px">
								<h5 class="text-center mt-3">Fasilitas</h5>
								<div class="card-body mx-3">
									<table id="" class="table text-center">
										<thead>
											<tr>
												<th class="bg-dark text-white">NAMA BARANG</th>
												<th class="bg-dark text-white">JUMLAH</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>Lemari</td>
												<td>3</td>
											</tr>
											<tr>
												<td>Kasur</td>
												<td>6</td>
											</tr>
											<tr>
												<td>Meja Kayu</td>
												<td>2</td>
											</tr>
											<!-- FOREACH -->
										</tbody>
									</table>
								</div>

							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
		<div class="modal-dialog modal-dialog-centered modal-xl">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-header py-0 mb-4 border-bottom-0">
					<div class="row text-center w-100">
						<div class="col-6 py-3">
							<a class="text-dark" style="text-decoration: none" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal" role="button">
								Details
							</a>
						</div>
						<div class="col-6 py-3 border-bottom border-2 border-dark">
							<a class="text-dark fw-bold" style="text-decoration: none" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal" role="button">
								History
							</a>
						</div>
					</div>
				</div>
				<div class="modal-body pt-0 min-vh-25 min-vh-sm-50">

					<!-- tabel history start-->
					<table id="tabelhistory" class="table table-striped table-bordered rounded text-center">
						<thead>
							<tr>
								<th>No</th>
								<th>Tanggal</th>
								<th>Kegiatan</th>
								<th>User</th>
								<th>Keterangan</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>3 Maret 2022</td>
								<td>Pengadaan</td>
								<td>SYSTEM ADMIN</td>
								<td></td>
							</tr>
						</tbody>
					</table>
					<!-- tabel history end -->
					
				</div>
				<div class="modal-footer">
					
				</div>
			</div>
		</div>
	</div>
</body>

</html>
<script type="text/javascript">
	$(document).ready( function () {
		$('#myTable').DataTable();
	} );
</script>
