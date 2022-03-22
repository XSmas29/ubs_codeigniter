<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Asset | Fasilitas</title>
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
						<h3 class="text-light">Database Fasilitas</h3>
					</div>
				</div>
				<div class="bg-light min-vh-50 min-vh-sm-75 p-4 rounded-3">
						<table id="myTable" class="table table-striped table-bordered rounded text-center">
							<thead>
								<tr>
									<th>Nama Aset</th>
									<th>Kode Aset</th>
									<th>Lokasi</th>
									<th>Tanggal Pengadaan</th>
									<th>User</th>
									<th>Departemen</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
									<?php 
										for ($i=0; $i < count($listFasilitas); $i++) {
									?>
										<tr>
										<td><?= $listFasilitas[$i]->NAMA_ASSET?></td>
										<td><?= $listFasilitas[$i]->KODE_ASSET?></td>
										<td><?= $listFasilitas[$i]->INFO_1?></td>
										<td><?= date('d F Y', strtotime($listFasilitas[$i]->TGL_PENGADAAN)) ?></td>
										<td><?= $listFasilitas[$i]->INFO_2?></td>
										<td><?= $listFasilitas[$i]->INFO_3?></td>
										<td>
											<?php 
											if ($listFasilitas[$i]->STATUS == 0){
												echo "<button disabled class='btn btn-sm btn-success'>Available</button>";
											}
											else if ($listFasilitas[$i]->STATUS == 1){
												echo "<button disabled class='btn btn-sm btn-warning'>In Use</button>";
											}
											else{
												echo "<button disabled class='btn btn-sm btn-danger'>Deleted</button>";
											}
											?>
										</td>
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
</body>

</html>
<script type="text/javascript">
	$(document).ready( function () {
		$('#myTable').DataTable();
	} );
</script>
