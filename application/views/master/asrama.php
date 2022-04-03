<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Master | Asrama</title>
</head>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/master-asset.css">
<body>
	<main class="main" id="top">
		<?php require_once(APPPATH . 'views\template\header.php') ?>

		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.bundle.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css"/>

		<section id="home">
			<div class="bg-holder" style="background-image:url(<?php echo base_url(); ?>assets/img/gallery/hero.png);background-position:center;background-size:cover;">
			</div>

			<div class="container-fluid">
				<div class="row mx-5">
					<div class="col-12">
						<h3 class="text-light">Master Data</h3>
						<div class="bg-light min-vh-50 min-vh-sm-75 p-4 rounded-3 fs-5">
							<div class="row">
								<div class="col-2">
									<?php require_once(APPPATH . 'views\template\navbar.php') ?>
								</div>
								<div class="col-10">
								<div class="row align-items-start">
										<div>
											<h3 class="text-dark">Asrama</h3>
										</div>
									</div>
									<div class="d-flex justify-content-end">
										<button type="button" class="btn btn-sm btn-primary my-2" data-bs-toggle="modal" href="#modaladdasrama" role="button" id="btnadd">+ NEW ASSET</button>
									</div>
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
													<td>
														<button type="button" class="btn btn-sm btn-info">
															<img src="<?php echo base_url(); ?>assets/img/icons/edit.png" width="16" height="16">
														</button>
														<button type="button" class="btn btn-sm btn-secondary">
															<img src="<?php echo base_url(); ?>assets/img/icons/repair.png" width="16" height="16">
														</button>
														<button type="button" class="btn btn-sm btn-danger">
															<img src="<?php echo base_url(); ?>assets/img/icons/delete.png" width="16" height="16">
														</button>
													</td>
												</tr>
												<?php
													}
												?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>

	<div class="modal fade" id="modaladdasrama" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">
				<div class="modal-header">
				<h4 class="modal-title" id="modaltitle"></h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body pt-0 min-vh-25 min-vh-sm-50">
					<div class="row text-center">
						<div class="col-6">
							<div class="form__group field mb-5">
								<input type="text" class="form__field" name="asrama" id="asrama" placeholder="Asrama"/>
								<label class="form__label">Asrama<small class="form-error" id="error-asrama"></small></label>
							</div>
							<div class="form__group field mb-5">
								<input type="text" class="form__field" name="lantai" id="lantai" placeholder="Lantai"/>
								<label class="form__label">Lantai<small class="form-error" id="error-lantai"></small></label>
							</div>
							<div class="form__group field mb-5">
								<input type="text" class="form__field" name="kamar" id="kamar" placeholder="Kamar"/>
								<label class="form__label">Kamar<small class="form-error" id="error-kamar"></small></label>
							</div>
							<div class="form__group field mb-5">
								<input type="date" class="form__field" name="tanggal" id="tanggal" placeholder="Tanggal pengadaan" disabled/>
								<label class="form__label">Tanggal Pengadaan<small class="form-error" id="error-tanggal"></small></label>
							</div>
							<div class="form__group field mb-5">
								<input type="text" class="form__field" name="kapasitas" id="kapasitas" placeholder="Maksimal penghuni"/>
								<label class="form__label">Maksimal penghuni<small class="form-error" id="error-kapasitas"></small></label>
							</div>
						</div>
						<div class="col-6">
							<div class="row" id="rowfasilitas">
								<div class="col-7">
									<div class="form__group field mb-5" id="listnamafasilitas">
										<label class="form__label">Fasilitas</label>
										<input type="text" class="form__field" name="namafas[]" id="fasilitas" placeholder="Fasilitas"/>
										
									</div>
								</div>
								<div class="col-5">
									<div class="form__group mb-5" id="listjumlahfasilitas">
										<label class="form__label">Jumlah</label>
										<div class="d-flex justify-content-start align-items-center">
											<input type="text" class="form__field form__field2" name="jumlahfas[]" id="fasilitas" placeholder="Jumlah"/>
											<button type="button" class="btn btn-dark ms-3" onclick="addFasilitas()"><strong>+</strong></button>
										</div>
									</div>
								</div>
							</div>
							
						</div>
						<div class="d-flex justify-content-end">
							<button type="button" class="btn btn-outline-dark px-5 me-3" onclick="resetInput()">Reset</button>
							<button type="button" class="btn btn-dark px-5 btn-submit" id="btnsave">Save</button>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					
				</div>
			</div>
		</div>
	</div>
</body>

</html>
<script type="text/javascript">

	var now = new Date();
	var day = ("0" + now.getDate()).slice(-2);
	var month = ("0" + (now.getMonth() + 1)).slice(-2);

	$(document).ready( function () 
	{
		$('#myTable').DataTable( 
			{
				responsive: true
			} 
		);
	});

	function resetInput(){
		
		$(".form-error").text('');
		$("#asrama").val('');
		$("#lantai").val('');
		$("#kamar").val('');
		$("#kapasitas").val('');

		$("#rowfasilitas").html(
			'<div class="row">' + 
				'<div class="col-7">' + 
					'<div class="form__group field mb-5" id="listnamafasilitas">' + 
						'<label class="form__label">Fasilitas</label>' + 
						'<input type="text" class="form__field" name="namafas[]" id="fasilitas" placeholder="Fasilitas">	' + 					
					'</div>' + 
				'</div>' + 
				'<div class="col-5">' + 
					'<div class="form__group mb-5" id="listjumlahfasilitas">' + 
						'<label class="form__label">Jumlah</label>' + 
						'<div class="d-flex justify-content-start align-items-center">' + 
							'<input type="text" class="form__field form__field2" name="jumlahfas[]" id="fasilitas" placeholder="Jumlah">' + 
							'<button type="button" class="btn btn-dark ms-3" onclick="addFasilitas()"><strong>+</strong></button>' + 
						'</div>' + 
					'</div>' + 
				'</div>' + 
			'</div>'
		);
	}

	function addFasilitas(){
		//menambah field nama fasilitas di paling atas
		$("#listnamafasilitas").find('.form__label').remove();
		$("#listnamafasilitas").prepend(
			'<label class="form__label">Fasilitas</label>' + 
			'<input type="text" class="form__field mb-2" name="namafas[]" id="fasilitas" placeholder="Fasilitas"/>'
		);

		//menambah field jumlah & button add fasilitas di paling atas
		$("#listjumlahfasilitas").prepend(
			'<div class="d-flex justify-content-start align-items-center mb-2">' + 
				'<input type="text" class="form__field form__field2" name="jumlahfas[]" id="fasilitas" placeholder="Jumlah"/>' +
				'<button type="button" class="btn btn-dark ms-3" onclick="addFasilitas()"><strong>+</strong></button>' + 
			'</div>'
		);

		//replace button add dgn button remove
		$($("#listjumlahfasilitas").find('.d-flex')[1]).children().last().remove();
		$($("#listjumlahfasilitas").find('.d-flex')[1]).append('<button type="button" class="btn btn-danger ms-3 btn-delete" onclick="removeFasilitas(this)"><strong>x</strong></button>');
	}

	function removeFasilitas(element){
		//menghapus fasilitas di index tsb
		let index = $(".btn-delete").index(element);
		console.log(index);
		$("#listnamafasilitas").find('.form__field')[index + 1].remove();
		$("#listjumlahfasilitas").find('.d-flex')[index + 1].remove();
	}

	$('#btnadd').click(function(){
		resetInput();
		$('#btnsave').attr('onClick', 'addData()');
		$("#modaltitle").html("Form Pengadaan Aset");
		$('#btnsave').html('Save');

		let today = now.getFullYear()+"-"+(month)+"-"+(day);
		$('#tanggal').val(today);
	});

	function addData(){
		let form_data = new FormData();

		let listnama = [];
		$('input[name="namafas[]"]').each( function() {
			listnama.push(this.value);
		});

		let listjumlah = [];
		$('input[name="jumlahfas[]"]').each( function() {
			listjumlah.push(this.value);
		});

		form_data.append("asrama", $("#asrama").val());
		form_data.append("lantai", $("#lantai").val());
		form_data.append("kamar", $("#kamar").val());
		form_data.append("tanggal", $("#tanggal").val());
		form_data.append("kapasitas", $("#kapasitas").val());
		form_data.append("namafasilitas", listnama);
		form_data.append("jumlahfasilitas", listjumlah);
		
		$.ajax({
			type: "POST",
			url: "<?php echo site_url(); ?>"+"/Master/addasrama",
			data: form_data,
			cache: false,
			processData: false,
			contentType: false,
			success: function(response){
				console.log(response);
				var message = JSON.parse(response);
				if (message["message"] == 1){
					$('#modalsuccessbody').html('Sukses menambah data asrama!');
					$('#modalsuccess').show();
					setTimeout(function(){
						window.location.reload();
					},1500);
				}
				raiseErrors(message);
			}, error: function(xhr, status, error) {
				console.log(xhr.responseText);
			},
		});
	}

	function raiseErrors(errors){
		console.log(errors);
		//bagian add & edit
		$("#error-asrama").html("");
		$("#error-lantai").html("");
		$("#error-kamar").html("");
		$("#error-tanggal").html("");
		$("#error-kapasitas").html("");

		$("#error-asrama").html(errors["asrama"]).css("opacity", 1);
		$("#error-lantai").html(errors["lantai"]).css("opacity", 1);
		$("#error-kamar").html(errors["kamar"]).css("opacity", 1);
		$("#error-tanggal").html(errors["tanggal"]).css("opacity", 1);
		$("#error-kapasitas").html(errors["kapasitas"]).css("opacity", 1);
		//


		//bagian perbaikan
		$("#error-tanggal-perbaikan").html("");
		$("#error-kronologi-perbaikan").html("");
		$("#error-kondisi-perbaikan").html("");
		$("#error-action-perbaikan").html("");
		$("#error-rab-perbaikan").html("");
		
		$("#error-tanggal-perbaikan").html(errors["tanggalrepair"]).css("opacity", 1);
		$("#error-kronologi-perbaikan").html(errors["kronologirepair"]).css("opacity", 1);
		$("#error-kondisi-perbaikan").html(errors["kondisirepair"]).css("opacity", 1);
		$("#error-action-perbaikan").html(errors["actionrepair"]).css("opacity", 1);
		$("#error-rab-perbaikan").html(errors["rabrepair"]).css("opacity", 1);
		//


		//bagian delete
		$("#error-tanggal-delete").html("");
		$("#error-alasan-delete").html("");

		$("#error-tanggal-delete").html(errors["tanggaldelete"]).css("opacity", 1);
		$("#error-alasan-delete").html(errors["alasandelete"]).css("opacity", 1);
		//

	}
</script>
