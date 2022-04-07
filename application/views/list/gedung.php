<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Asset | Gedung</title>
</head>
<style>
	.link-list-gedung .nav-item{
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
		<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

		<section id="home">
			<div class="bg-holder" style="background-image:url(<?php echo base_url(); ?>assets/img/gallery/hero.png);background-position:center;background-size:cover;">
			</div>

			<div class="container">
				<div class="row align-items-start">
					<div>
						<h3 class="text-light">Database Gedung</h3>
					</div>
				</div>
				<div class="bg-light min-vh-50 min-vh-sm-75 p-4 rounded-3">
						<table id="myTable" class="table table-striped table-bordered rounded text-center">
							<thead>
								<tr>
									<th>Nama Aset</th>
									<th>Kode Aset</th>
									<th>No IMB</th>
									<th>Peruntukan</th>
									<th>Lokasi</th>
									<th>Tanggal Pengadaan</th>
									<th>Status</th>
									<th>History</th>
								</tr>
							</thead>
							<tbody>
									<?php 
										for ($i=0; $i < count($listgedung); $i++) {
									?>
									    	<tr>
												<td><?= $listgedung[$i]->NAMA_ASSET?></td>
												<td><?= $listgedung[$i]->KODE_ASSET?></td>
												<td><?= $listgedung[$i]->INFO_5?></td>
												<td><?= $listgedung[$i]->INFO_1?></td>
												<td><?= $listgedung[$i]->INFO_3?></td>
												<td><?= date('d F Y', strtotime($listgedung[$i]->TGL_PENGADAAN))?></td>
												<td>
												<?php 
													if ($listgedung[$i]->IS_DELETED == 1){
														echo "<button disabled class='btn btn-sm btn-danger'>Deleted</button>";
													}
													else{
														if ($listgedung[$i]->STATUS == 0){
															echo "<button disabled class='btn btn-sm btn-success'>Available</button>";
														}
														else if ($listgedung[$i]->STATUS == 1){
															echo "<button disabled class='btn btn-sm btn-warning'>In Use</button>";
														}
													}
													?>
												</td>
												<td><a class="btn btn-primary btn-sm btn-history" data-bs-toggle="modal" href="#exampleModalToggle" role="button" value='<?= $listgedung[$i]->KODE_ASSET?>'>View</a></td>
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
						<div class="py-3 border-bottom border-2 border-dark">
							<div class="text-dark" style="text-decoration: none">
								<b>History</b>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-body pt-0 min-vh-25 min-vh-sm-50">
				
					<div class="row">
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
					</div>
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
		$('#myTable').DataTable(
			{
				responsive:true
			}
		);
	} );

	$('.btn-history').click(function(){
			
		let kode = $(this).attr('value');
		$.ajax({
			type: "POST",
			url: "<?php echo site_url(); ?>"+"/Master/detailAsset",
			data: {key: kode},
			cache: false,
			success: function(response){
				let data = JSON.parse(response);

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
