<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Asset | Rumah Dinas</title>
</head>
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
				<div class="row align-items-start">
					<div>
						<h3 class="text-light">Database Rumah Dinas</h3>
					</div>
				</div>
				<div class="bg-light min-vh-50 min-vh-sm-75 p-4 rounded-3" style="box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;">
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
											<td><?= date('d F Y', strtotime($listrumah[$i]->TGL_PENGADAAN))?></td>
											<td><!-- JIKA ADA YG PINJAM, AMBIL NAMA USER --></td>
											<td><!-- JIKA ADA YG PINJAM, AMBIL DEPARTEMEN USER --></td>
											<td>
												<?php 
												if ($listrumah[$i]->IS_DELETED == 1){
													echo "<button disabled class='btn btn-sm btn-danger'>Deleted</button>";
												}
												else{
													if ($listrumah[$i]->STATUS == 0){
														echo "<button disabled class='btn btn-sm btn-success'>Available</button>";
													}
													else if ($listrumah[$i]->STATUS == 1){
														echo "<button disabled class='btn btn-sm btn-warning'>In Use</button>";
													}
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
										<div class="carousel-indicators" id="indicator">
											<!-- <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
											<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
											<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button> -->
										</div>
										
										<div class="carousel-inner" id="listgambar">
											<!-- <div class="carousel-item active">
												<img src="assets/img/gallery/hero.png" class="d-block w-100" alt="...">
											</div>
											<div class="carousel-item">
												<img src="assets/img/gallery/hero.png" class="d-block w-100" alt="...">
											</div>
											<div class="carousel-item">
												<img src="assets/img/gallery/hero.png" class="d-block w-100" alt="...">
											</div> -->
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
										<ul class="fw-bold" id="fasilitas"></ul>
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

	<div class="modal fade" id="exampleModalToggle3" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="detailtitle"></h4>
					<button type="button" class="btn-close" data-bs-target='#exampleModalToggle2' data-bs-toggle="modal" data-bs-dismiss="modal" role="button" aria-label="Close"></button>
				</div>
				<div class="modal-body pt-0" id="bodymodaldetail">
					
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
					
					$("#fasilitas").html('');
					let arrfasilitas = [];
					
					for (let i = 0; i < data["fasilitas"].length; i++) {
						$("#fasilitas").append("<li>" + data["fasilitas"][i].NAMA + " (" + data["fasilitas"][i].JUMLAH + ")</li>");
					}
					

					$('#tabelhistory').DataTable().clear().destroy();
					
					$("#bodyhistory").html("");
					let ctr = 1;
					data["transaksi"].forEach(function(item){
						if (item.AKTIVITAS_TRANSAKSI.toLowerCase() == "perbaikan" || item.AKTIVITAS_TRANSAKSI.toLowerCase() == "penghapusan"){
							$("#bodyhistory").append(
							"<tr>" +
								"<td>" + ctr + "</td>" +
								"<td>" + item.TGL_TRANSAKSI + "</td>" +
								"<td>" + item.AKTIVITAS_TRANSAKSI + "</td>" +
								"<td>" + item.USER_TRANSAKSI + "</td>" +
								"<td><button class='btn btn-sm btn-dark' data-bs-target='#exampleModalToggle3' data-bs-toggle='modal' data-bs-dismiss='modal' role='button' value='" + item.KODE_TRANSAKSI + "' onclick='getDetailHistory(this.value)'>Details</button></td>" +
							"</tr>"
							);
						}
						else{
							$("#bodyhistory").append(
							"<tr>" +
								"<td>" + ctr + "</td>" +
								"<td>" + item.TGL_TRANSAKSI + "</td>" +
								"<td>" + item.AKTIVITAS_TRANSAKSI + "</td>" +
								"<td>" + item.USER_TRANSAKSI + "</td>" +
								"<td>" + item.KETERANGAN_1 + "</td>" +
							"</tr>"
							);
						}
						
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
	});

	function getDetailHistory(key){
		console.log(key);
		$.ajax({
			type: "POST",
			url: "<?php echo site_url(); ?>"+"/Master/detailhistory",
			data: {key: key},
			cache: false,
			success: function(response){
				let data = JSON.parse(response);
				console.log(data);
				if (data["transaksi"][0].AKTIVITAS_TRANSAKSI.toLowerCase() == "perbaikan"){
					$("#detailtitle").html("Detail Perbaikan");
					$("#bodymodaldetail").html(
						"<div class='row mt-2'>" +
							"<div class='col-7'>" +
								"<div class='row'>" +
									"<div class='col-6'>" +
										"<div class='fw-bold fs-5 mt-3'>Tanggal Kejadian</div>" +
									"</div>" +
									"<div class='col-6'>" +
										"<div class='fs-5 mt-3'>" + data["transaksi"][0].TGL_TRANSAKSI + "</div>" +
									"</div>" +
								"</div>" +
								"<div class='row'>" +
									"<div class='col-6'>" +
										"<div class='fw-bold fs-5 mt-3'>Kronologi</div>" +
									"</div>" +
									"<div class='col-6'>" +
										"<div class='fs-5 mt-3'>" + data["transaksi"][0].KETERANGAN_1 + "</div>" +
									"</div>" +
								"</div>" +
								"<div class='row'>" +
									"<div class='col-6'>" +
										"<div class='fw-bold fs-5 mt-3'>Kondisi Aset</div>" +
									"</div>" +
									"<div class='col-6'>" +
										"<div class='fs-5 mt-3'>" + data["transaksi"][0].KETERANGAN_2 + "</div>" +
									"</div>" +
								"</div>" +
								"<div class='row'>" +
									"<div class='col-6'>" +
										"<div class='fw-bold fs-5 mt-3'>Action Plan</div>" +
									"</div>" +
									"<div class='col-6'>" +
										"<div class='fs-5 mt-3'>" + data["transaksi"][0].KETERANGAN_3 + "</div>" +
									"</div>" +
								"</div>" +
								"<div class='row'>" +
									"<div class='col-6'>" +
										"<div class='fw-bold fs-5 mt-3'>RAB</div>" +
									"</div>" +
									"<div class='col-6'>" +
										"<div class='fs-5 mt-3 mb-3'>" + data["transaksi"][0].KETERANGAN_4 + "</div>" +
									"</div>" +
								"</div>" +
							"</div>" +
							"<div class='col-5 d-flex align-items-center'>" +
								"<img src='<?php echo base_url(); ?>assets/img/repair/" + data["gambar"][0].KODE_GAMBAR + "' width='100%'>" + 
							"</div>" +
						"</div>"
						
					);
				}
				else{
					$("#detailtitle").html("Detail Penghapusan");
					$("#bodymodaldetail").html(
						"<div class='row my-2'>" +
							"<div class='col-5'>" +
								"<div class='fw-bold fs-5 mt-3'>Tanggal Kejadian</div>" +
								"<div class='fw-bold fs-5 mt-3'>Alasan dihapus</div>" +
							"</div>" +
							"<div class='col-7'>" +
								"<div class='fs-5 mt-3'>" + data["transaksi"][0].TGL_TRANSAKSI + "</div>" +
								"<div class='fs-5 mt-3'>" + data["transaksi"][0].KETERANGAN_1 + "</div>" +
							"</div>" +
						"</div>"
					);
				}
			}, error: function(){
				console.log("Error when getting details!");
			}
		});
	};
</script>
