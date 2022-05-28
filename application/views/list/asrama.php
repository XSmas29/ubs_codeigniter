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
		font-weight: 1000;
		transition: 0.2s;
	}

	.carousel-control-next-icon, .carousel-control-prev-icon {
  		background-color: gray;
		border-radius: 50%;
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
						<h3 class="text-light">Database Asrama</h3>
					</div>
				</div>
				<div class="bg-light min-vh-50 min-vh-sm-75 p-4 rounded-3" style="box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;">
						<table id="myTable" class="table table-striped table-bordered table-light text-center">
							<thead>
								<tr>
									<th>Asrama</th>
									<th>Lantai</th>
									<th>No Kamar</th>
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
							"<td><button class='btn btn-sm btn-dark' data-bs-target='#exampleModalToggle3' data-bs-toggle='modal' data-bs-dismiss='modal' role='button' value='" + item.KODE_TRANSAKSI + "' onclick='getDetailHistory(this.value)'>Details</button></td>" +
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
					var fileExt = data["gambar"][0].KODE_GAMBAR.split('.').pop();
					if (fileExt == "pdf" || fileExt == "docx" || fileExt == "doc"){
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
									"<a class='text-center' href='<?php echo base_url();?>assets/files/repair/" + data["gambar"][0].KODE_GAMBAR + "'><img src='<?php echo base_url(); ?>assets/img/icons/document.png' width='50%'></a>" + 
								"</div>" +
							"</div>"
						);
					}
					else{
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
									"<img src='<?php echo base_url(); ?>assets/files/repair/" + data["gambar"][0].KODE_GAMBAR + "' width='100%'>" + 
								"</div>" +
							"</div>"
						);
					}
				}
				else if(data["transaksi"][0].AKTIVITAS_TRANSAKSI.toLowerCase() == "penghapusan"){
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
				else if(data["transaksi"][0].AKTIVITAS_TRANSAKSI.toLowerCase() == "pengadaan"){
					$("#detailtitle").html("Detail Pengadaan");
					$("#bodymodaldetail").html(
						"<div class='row my-2'>" +
							"<div class='col-5'>" +
								"<div class='fw-bold fs-5 mt-3'>Tanggal Pengadaan</div>" +
								"<div class='fw-bold fs-5 mt-3'>Keterangan</div>" +
							"</div>" +
							"<div class='col-7'>" +
								"<div class='fs-5 mt-3'>" + data["transaksi"][0].TGL_TRANSAKSI + "</div>" +
								"<div class='fs-5 mt-3'>" + data["transaksi"][0].KETERANGAN_1 + "</div>" +
							"</div>" +
						"</div>"
					);
				}
				else if(data["transaksi"][0].AKTIVITAS_TRANSAKSI.toLowerCase() == "perubahan"){
					$("#detailtitle").html("Detail Perubahan");
					$("#bodymodaldetail").html(
						"<div class='row my-2'>" +
							"<div class='col-5'>" +
								"<div class='fw-bold fs-5 mt-3'>Tanggal Perubahan</div>" +
								"<div class='fw-bold fs-5 mt-3'>Keterangan</div>" +
							"</div>" +
							"<div class='col-7'>" +
								"<div class='fs-5 mt-3'>" + data["transaksi"][0].TGL_TRANSAKSI + "</div>" +
								"<div class='fs-5 mt-3'>" + data["transaksi"][0].KETERANGAN_1 + "</div>" +
							"</div>" +
						"</div>"
					);
				}
				else if(data["transaksi"][0].AKTIVITAS_TRANSAKSI.toLowerCase() == "peminjaman"){
					let status = "";
					let tglkembali = "";
					if (data["transaksi"][0].TGL_KEMBALI == null){
						status = "Sedang dipinjam";
						tglkembali = "-";
					}
					else{
						status = "Sudah dikembalikan";
						tglkembali = data["transaksi"][0].TGL_KEMBALI;
					}
					$("#detailtitle").html("Detail Peminjaman");
					$("#bodymodaldetail").html(
						"<div class='row my-2'>" +
							"<div class='col-5'>" +
								"<div class='fw-bold fs-5 mt-3'>Tanggal Peminjaman</div>" +
								"<div class='fw-bold fs-5 mt-3'>Status Peminjaman</div>" +
								"<div class='fw-bold fs-5 mt-3'>Tanggal Kembali</div>" +
								"<div class='fw-bold fs-5 mt-3'>Keterangan</div>" +
							"</div>" +
							"<div class='col-7'>" +
								"<div class='fs-5 mt-3'>" + data["transaksi"][0].TGL_TRANSAKSI + "</div>" +
								"<div class='fs-5 mt-3'>" + status + "</div>" +
								"<div class='fs-5 mt-3'>" + tglkembali + "</div>" +
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
