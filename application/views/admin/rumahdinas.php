<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Asset | Rumah Dinas</title>
</head>

<body>
	<main class="main" id="top">
		<?php require_once(APPPATH . 'views\template\header.php') ?>
		
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.bundle.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css"/>
		<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css"/>

		<section id="home">
			<div class="bg-holder" style="background-image:url(<?php echo base_url(); ?>assets/img/gallery/hero.png);background-position:center;background-size:cover;">
			</div>

			<div class="container">
				<div class="row align-items-start">
					<div>
						<h3 class="text-light">Database Rumah Dinas</h3>
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
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
									<?php 
										for ($i=0; $i < count($listrumah); $i++) {
									?>
									    	<tr>
											<td><?= $listrumah[$i]->NAMA_ASSET?></td>
											<td><?= $listrumah[$i]->KODE_ASSET?></td>
											<td><?= $listrumah[$i]->INFO_1?></td>
											<td><?= $listrumah[$i]->TGL_PENGADAAN?></td>
											<td><!-- JIKA ADA YG PINJAM, AMBIL NAMA USER --></td>
											<td><!-- JIKA ADA YG PINJAM, AMBIL DEPARTEMEN USER --></td>
											<td>
												<?php 
												if ($listrumah[$i]->STATUS == 0){
													echo "<button disabled class='btn btn-sm btn-success'>Available</button>";
												}
												else if ($listrumah[$i]->STATUS == 1){
													echo "<button disabled class='btn btn-sm btn-warning'>In Use</button>";
												}
												else{
													echo "<button disabled class='btn btn-sm btn-danger'>Deleted</button>";
												}
												?>
											</td>
											<td><a class="btn btn-primary btn-sm btn-detail" data-bs-toggle="modal" href="#exampleModalToggle" role="button" value='<?= $listrumah[$i]->KODE_ASSET?>'>View</a></td>
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

							<!-- carousel start -->
							<div class="card border" style="border-radius: 20px">
								<div class="card-body">
									<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
										<div class="carousel-indicators">
											<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
											<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
											<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
										</div>
										
										<div class="carousel-inner">
											<div class="carousel-item active">
												<img src="<?php echo base_url(); ?>assets/img/gallery/hero.png" class="d-block w-100" alt="...">
											</div>
											<div class="carousel-item">
												<img src="<?php echo base_url(); ?>assets/img/gallery/hero.png" class="d-block w-100" alt="...">
											</div>
											<div class="carousel-item">
												<img src="<?php echo base_url(); ?>assets/img/gallery/hero.png" class="d-block w-100" alt="...">
											</div>
										</div>
										<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
											<span class="carousel-control-prev-icon" aria-hidden="true"></span>
											<span class="visually-hidden">Previous</span>
										</button>
										<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
											<span class="carousel-control-next-icon" aria-hidden="true"></span>
											<span class="visually-hidden">Next</span>
										</button>
									</div>
								</div>
							</div>
							
							<!-- carousel end -->

						</div>
						<div class="col-6">
						<div class="card border" style="border-radius: 20px">
						
							<h5 class="card-header text-center fw-bold bg-dark text-light py-4" style="border-radius: 20px 20px 0 0" id="nama_asset"></h5>
							<div class="card-body mx-3">
								<div class="row mb-4">
									<div class="col-4">
										Kode Aset
										<div class="fw-bold" id="kode_asset"></div>
									</div>
									<div class="col-4">
										Jenis Aset
										<div class="fw-bold" id="jenis_asset"></div>
									</div>
									<div class="col-4">
										Kamar Tidur
										<div class="fw-bold" id="jumlah_kamar"></div>
									</div>
								</div>
								<div class="row mb-4">
									<div class="col-4">
										Lokasi
										<div class="fw-bold" id="lokasi_asset"></div>
									</div>
									<div class="col-4">
										Kondisi Awal
										<div class="fw-bold" id="kondisi_asset"></div>
									</div>
									<div class="col-4">
										Kamar Mandi
										<div class="fw-bold" id="jumlah_toilet"></div>
									</div>
								</div>
								<div class="row mb-4">
									<div class="col-4">
										Tanggal Pengadaan
										<div class="fw-bold" id="tgl_pengadaan"></div>
									</div>
									<div class="col-4">
										Carport
										<div class="fw-bold" id="carport"></div>
									</div>
									<div class="col-4">
										Fasilitas
										<div class="fw-bold" id="fasilitas"></div>
									</div>
								</div>
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
						<tbody id="bodyhistory">
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
	$(document).ready( function () 
	{
		$('#myTable').DataTable( 
			{
				responsive: true
			} 
		);
		$('#carouselExampleIndicators').carousel();

		$('.btn-detail').click(function(){
			
			let kode = $(this).attr('value');
			$.ajax({
				type: "POST",
				url: "<?php echo site_url(); ?>"+"/Master/detailAsset",
				data: {key: kode},
				cache: false,
				success: function(response){
					let data = JSON.parse(response);
					$("#kode_asset").text(data["asset"][0].KODE_ASSET);
					$("#nama_asset").text(data["asset"][0].NAMA_ASSET);
					$("#lokasi_asset").text(data["asset"][0].INFO_1);
					$("#jenis_asset").text(data["asset"][0].INFO_2);
					$("#kondisi_asset").text(data["asset"][0].INFO_3);
					$("#jumlah_kamar").text(data["asset"][0].INFO_4);
					$("#jumlah_toilet").text(data["asset"][0].INFO_5);
					$("#carport").text(data["asset"][0].INFO_6);
					$("#tgl_pengadaan").text(data["asset"][0].TGL_PENGADAAN);

					let arrfasilitas = [];
					for (let i = 0; i < data["fasilitas"].length; i++) {
						arrfasilitas.push(data["fasilitas"][i].NAMA);
					}
					$("#fasilitas").text(arrfasilitas.join(", "));

					$('#tabelhistory').DataTable().clear().destroy();
					
					$("#bodyhistory").html("");
					data["transaksi"].forEach(function(item){
						$("#bodyhistory").append(
						"<tr>" +
							"<td>" + item.KODE_TRANSAKSI + "</td>" +
							"<td>" + item.TGL_TRANSAKSI + "</td>" +
							"<td>" + item.AKTIVITAS_TRANSAKSI + "</td>" +
							"<td>" + item.USER_TRANSAKSI + "</td>" +
							"<td>" + item.KETERANGAN_TRANSAKSI + "</td>" +
						"</tr>"
						);
					});
					
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
	});
</script>
