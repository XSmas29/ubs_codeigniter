<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Asset | Asrama</title>
</head>
<style>
	.link-list-asrama .nav-item{
		color: white !important;
		font-weight: bold;
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
										<td><a class="btn btn-primary btn-sm btn-detail" data-bs-toggle="modal" href="#exampleModalToggle" role="button" value='<?= $listAsrama[$i]->KODE_ASSET?>'>View</a></td>
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
									<table id="tabeluser" class="table text-center">
										<thead>
											<tr>
												<th class="bg-dark text-white">NIK</th>
												<th class="bg-dark text-white">NAMA</th>
												<th class="bg-dark text-white">DEPARTEMEN</th>
											</tr>
										</thead>
										<tbody id="bodyuser">
											
										</tbody>
									</table>
								</div>

							</div>
						</div>

						<div class="col-6">
							<div class="card border" style="border-radius: 20px">
								<h5 class="text-center mt-3">Fasilitas</h5>
								<div class="card-body mx-3">
									<table id="tabelfasilitas" class="table text-center">
										<thead>
											<tr>
												<th class="bg-dark text-white">NAMA BARANG</th>
												<th class="bg-dark text-white">JUMLAH</th>
											</tr>
										</thead>
										<tbody id="bodyfasilitas">
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
						<tbody id='bodyhistory'>
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

	$('.btn-detail').click(function(){
			
			let kode = $(this).attr('value');
			$.ajax({
				type: "POST",
				url: "<?php echo site_url(); ?>"+"/Master/detailAsset",
				data: {key: kode},
				cache: false,
				success: function(response){
					let data = JSON.parse(response);
					console.log(data);

					$("#bodyfasilitas").html("");
					data["fasilitas"].forEach(function(item){
						$("#bodyfasilitas").append(
						"<tr>" +
							"<td>" + item.NAMA + "</td>" +
							"<td>" + item.JUMLAH + "</td>" +
						"</tr>"
						);
					});

					$("#bodyuser").html("");
					data["user"].forEach(function(item){
						$("#bodyuser").append(
						"<tr>" +
							"<td>" + item.NIK + "</td>" +
							"<td>" + item.NAMA + "</td>" +
							"<td>" + item.DEPARTEMEN + "</td>" +
						"</tr>"
						);
					});

					$('#tabelhistory').DataTable().clear().destroy();
					
					$("#bodyhistory").html("");
					let ctr = 1;
					data["transaksi"].forEach(function(item){
						$("#bodyhistory").append(
						"<tr>" +
							"<td>" + ctr + "</td>" +
							"<td>" + item.TGL_TRANSAKSI + "</td>" +
							"<td>" + item.AKTIVITAS_TRANSAKSI + "</td>" +
							"<td>" + item.USER_TRANSAKSI + "</td>" +
							"<td>" + item.KETERANGAN_1 + "</td>" +
						"</tr>"
						);
						ctr += 1;
					});
				
					$("#listgambar").html("");
					$("#indicator").html("");
					if (data["gambar"].length > 0){
						let i = 0;

						data["gambar"].forEach(function(item){
							$("#listgambar").append(
								'<div class="carousel-item">' +
									'<img src="<?php echo base_url(); ?>assets/img/asset/' + item.KODE_GAMBAR + '" class="d-block w-100" alt="...">' +
								'</div>'
							);
							$("#indicator").append(
								'<button type="button" class="" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="' + i + '" aria-current="true" aria-label="Slide ' + i + '"></button>'
							);

							i += 1;
						});
						$('#listgambar div:first-child').addClass('active');
						$('#indicator button:first-child').addClass('active');
					}
					else{
						console.log("asd");
						$("#listgambar").append(
							'<div class="carousel-item active">' +
								'<img src="<?php echo base_url(); ?>assets/img/placeholder.jpg" class="d-block w-100" alt="...">' +
							'</div>'
						);
					}
					
					$('#tabelhistory').DataTable( 
						{
							responsive: false
						} 
					);
				}, error: function(){
					console.log("Error when loading asset!")
				}
			});
		});
</script>
