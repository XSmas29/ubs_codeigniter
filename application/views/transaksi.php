<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Master | Peminjaman Aset</title>
</head>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/master-asset.css">
<style>
	.link-admin-laporan{
		font-weight: bold;
		font-size: 21px;
		transition: 0.2s;
	}

	.link-master-transaksi{
		font-weight: bold;
		font-size: 20px;
		transition: 0.2s;
	}
</style>
<body>
	<main class="main" id="top">
		<?php require_once(APPPATH . 'views\template\header.php') ?>
		<script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>
		<script src="https://unpkg.com/jspdf-autotable@3.5.23/dist/jspdf.plugin.autotable.js"></script>

		<section id="home">
			<div class="bg-holder" style="background-image:url(<?php echo base_url(); ?>assets/img/gallery/hero.png);background-position:center;background-size:cover;">
			</div>
			<?php require_once(APPPATH . 'views\template\navbar.php') ?>
			<div class="container-fluid">
				<div class="row">
					<div class="bg-light min-vh-50 min-vh-sm-75 p-4 rounded-3 fs-5" style="box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;">
						<div class="row align-items-start">
							<div>
								<h3 class="text-dark">Daftar Pengguna Aset</h3>
							</div>
						</div>
						
						<div class="pt-0 min-vh-25 min-vh-sm-50 mt-2">
							<div class="row">
								<div class="col-6">
									<div class="row">
										<div class="col-2"></div>
										<div class="col-9"><div class="col-11"><small class="form-error" id="error-pengguna-nik"></small></div></div>
									</div>
								</div>
								<div class="col-6">
									<div class="row">
										<div class="col-6"></div>
										<div class="col-5 d-flex justify-content-end">
											<button type="button" class="btn btn-sm btn-primary my-2" data-bs-toggle="modal" href="#modalpeminjaman" role="button" id="btnadd">+ TAMBAH</button>
										</div>
									</div>
								</div>
								
							</div>
							<div class="row mt-1">
								<div class="col-6">
									<!-- <input type="text" name="koderepair" id="koderepair" hidden/> -->
									<div class="row">
										<div class="col-2 d-flex align-items-center">
											<label>NIK</label>
										</div>
										<div class="col-9">
											<div class="form-group field mb-3">
												<input type="text" class="form-control" name="penggunanik" id="penggunanik"/>
											</div>
										</div>
									</div>
									<div class="row">
										<small class="form-error" id="error-pengguna-nama"></small>
										<div class="col-2 d-flex align-items-center">
											<label>Nama</label>
										</div>
										<div class="col-9">
											<div class="form-group field mb-3">
												<input type="text" class="form-control" name="penggunanama" id="penggunanama" disabled/>
											</div>
										</div>
									</div>
								</div>
								<div class="col-6">
									<div class="row">
										<small class="form-error" id="error-pengguna-kategori"></small>
										<div class="col-2 d-flex align-items-center">
											<label>Kategori</label>
										</div>
										<div class="col-9">
											<div class="form-group field mb-3">
												<select class="form-control" name="penggunakategori" id="penggunakategori" placeholder="Kategori">
													<option value="" selected>All</option>
													<?php 
														for ($i=0; $i < count($listDataKategori); $i++) {
													?>
														<option value='<?= $listDataKategori[$i]->KODE_KATEGORI ?>'> <?= $listDataKategori[$i]->NAMA_KATEGORI ?></option>
													<?php
														}
													?>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<small class="form-error" id="error-pengguna-aset"></small>
										<div class="col-2 d-flex align-items-center">
											<label>Nama aset</label>
										</div>
										<div class="col-9">
											<div class="form-group field mb-3">
												<input type="text" class="form-control" name="penggunaaset" id="penggunaaset"/>
											</div>
										</div>
									</div>
								</div>
								<div class="d-flex justify-content mb-4">
									<button type="button" class="btn btn-primary mt-4 px-5 btn-submit" id="btnsearch" onclick="searchPenggunaAset()">SEARCH</button>
									<button type="button" class="btn btn-success mt-4 mx-2 btn-submit" id="btndownload" onclick="generateLaporan()" hidden>Download Laporan</button>
								</div>
								<hr>
								<div>
									<table id="tabelpeminjaman" class="table table-striped table-bordered rounded text-center" hidden>
										<thead>
											<tr>
												<th>NIK</th>
												<th>Nama</th>
												<th>Departemen</th>
												<th>Kategori</th>
												<th>Nama Aset</th>
												<th>Kode Aset</th>
												<th>Lokasi</th>
												<th>File</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody id="bodypeminjaman">
												
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
	
	<div class="modal fade" id="modalpeminjaman" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
		<div class="modal-dialog modal-dialog-centered modal-xl">
			<div class="modal-content">
				<div class="modal-header">
				<h4 class="modal-title">Peminjaman Aset</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body pt-0 min-vh-25 min-vh-sm-50">
					<div class="row text-center">
						<div class="col-4">
							<div class="form__group field mb-5">
								<select class="form__field" name="kategoripeminjaman" id="kategoripeminjaman" placeholder="Kategori">
									<option value="" selected></option>
									<?php 
										for ($i=0; $i < count($listDataKategori); $i++) {
									?>
										<option value='<?= $listDataKategori[$i]->KODE_KATEGORI ?>'> <?= $listDataKategori[$i]->NAMA_KATEGORI ?></option>
									<?php
										}
									?>
								</select>
								<label class="form__label">Kategori<small class="form-error" id="error-kategoripeminjaman"></small></label>
							</div>
							
							<div class="form__group field mb-5">
								<select class="form__field" name="kodepeminjaman" id="kodepeminjaman" placeholder="Kode aset" disabled>
								</select>
								<label class="form__label">Kode aset<small class="form-error" id="error-kode-peminjaman"></small></label>
							</div>
							<div class="form__group field mb-5">
								<input type="text" class="form__field" name="asetpeminjaman" id="asetpeminjaman" placeholder="Nama aset" disabled/>
								<label class="form__label">Nama aset<small class="form-error" id="error-aset-peminjaman"></small></label>
							</div>
							<div class="form__group field mb-5">
								<input type="text" class="form__field" name="lokasipeminjaman" id="lokasipeminjaman" placeholder="Lokasi" disabled/>
								<label class="form__label">Lokasi<small class="form-error" id="error-lokasi-peminjaman"></small></label>
							</div>
						</div>
						<div class="col-4">
							<div class="form__group field mb-5">
								<input type="text" class="form__field" name="nikpeminjaman" id="nikpeminjaman" placeholder="NIK"/>
								<label class="form__label">NIK<small class="form-error" id="error-nik-peminjaman"></small></label>
							</div>
							<div class="form__group field mb-5">
								<input type="text" class="form__field" name="namapeminjaman" id="namapeminjaman" placeholder="Nama" disabled/>
								<label class="form__label">Nama<small class="form-error" id="error-nama-peminjaman"></small></label>
							</div>
							<div class="form__group field mb-5">
								<input type="text" class="form__field" name="departemenpeminjaman" id="departemenpeminjaman" placeholder="Departemen" disabled/>
								<label class="form__label">Departemen<small class="form-error" id="error-departemen-peminjaman"></small></label>
							</div>
							<div class="form__group field mb-5">
								<input type="date" class="form__field" name="tanggalpeminjaman" id="tanggalpeminjaman" placeholder="Tanggal peminjaman"/>
								<label class="form__label">Tanggal peminjaman<small class="form-error" id="error-tanggal-peminjaman"></small></label>
							</div>
						</div>
						<div class="col-4">
							<h3 class="my-4">Upload File Serah Terima</h3>
							<small class="form-error" id="error-image-peminjaman"></small>
							<div class="d-flex flex-wrap justify-content-center" id="image-upload-wrapper-peminjaman">
								<div class="image-upload-wrap-perbaikan mx-1">
									<input class="file-upload-input" type='file' id='imagepeminjaman' onchange="readURLpeminjaman(this);" accept="file/*" />
									<div class="drag-text">
										<h3>Drag and drop or select a File</h3>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-dark px-5 me-3" onclick="resetInput()">Reset</button>
					<button type="button" class="btn btn-dark px-5 btn-submit" id="btnsubmit" onclick="addPeminjaman()">Add</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal" tabindex="-1" id="modalsuccess">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header justify-content-center">
					<h5 class="modal-title">Success</h5>
				</div>
				<div class="modal-body text-center">
					<p id="modalsuccessbody"></p>
				</div>
				<div class="modal-footer">
				</div>
			</div>
		</div>
	</div>

	<div class="modal" tabindex="-1" id="modalconfirm">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Konfirmasi</h5>
					<input type="hidden" name="kodepengembalian" id="kodepengembalian">
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<p>Yakin ingin mengembalikan aset ini?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-primary" onclick="PengembalianAset()">Confirm</button>
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
	var today;
	var datalaporan = [];
	var headerlaporan = ['No', 'Tanggal Pinjam', 'Kategori', 'Nama Aset', 'Kode Aset', 'Lokasi'];

	function format_date(date){
		let dateval = new Date(date);
		let year = new Intl.DateTimeFormat('en', { year: 'numeric' }).format(dateval);
		let month = new Intl.DateTimeFormat('en', { month: 'short' }).format(dateval);
		let day = new Intl.DateTimeFormat('en', { day: 'numeric' }).format(dateval);
		let formatted_date = day + " " + month + " " + year;
		return formatted_date;
	}

	const addFooters = laporan => {
		let marginfooter = 3;
		let footerline = laporan.internal.pageSize.getHeight() - 26;
		const pageCount = laporan.internal.getNumberOfPages()
		for (var i = 1; i <= pageCount; i++) {
			laporan.setPage(i)
			laporan.setFontSize(12);
			laporan.line(marginfooter, footerline, laporan.internal.pageSize.getWidth() - marginfooter, footerline);
			laporan.text('Page ' + String(i) + ' of ' + String(pageCount), laporan.internal.pageSize.width / 2, laporan.internal.pageSize.getHeight() - 12, {
				align: 'center'
			})
		}
	}

	const addHeaders = laporan => {
		let marginheader = 3;
		let headerline = 26;
		const pageCount = laporan.internal.getNumberOfPages()
		for (var i = 1; i <= pageCount; i++) {
			laporan.setPage(i)
			laporan.addImage('<?php echo base_url(); ?>assets/img/ubs-2.png', 'png', marginheader, marginheader, 30, 20, 'logo', 'NONE', 0);
			laporan.line(marginheader, headerline, laporan.internal.pageSize.getWidth() - marginheader, headerline);
			laporan.setFontSize(22);
			laporan.setFont('helvetica', 'none', '1000')
			laporan.text('PT. Untung Bersama Sejahtera', laporan.internal.pageSize.getWidth() / 2, 10, { align: 'center'} );
			laporan.setFontSize(11);
			laporan.text('Alamat: Jl. Kenjeran No.395-399, Surabaya, Jawa Timur 60134', laporan.internal.pageSize.getWidth() / 2, 16, { align: 'center'} );
			laporan.text('Telp: (031) 3818432', laporan.internal.pageSize.getWidth() / 2, 21, { align: 'center'} );
		}
	}

	function generateLaporan(){
		let laporan = new jsPDF();
		let margincontent = 6;

		laporan.setFontSize(14);
		laporan.text('Laporan Penggunaan Aset PT. UBS', laporan.internal.pageSize.getWidth() / 2, 33, { align: 'center'} );
		laporan.text("Per " + format_date(today), laporan.internal.pageSize.getWidth() / 2, 39, { align: 'center'});

		laporan.setFontSize(11);
		laporan.text('NIK User: ' + $("#penggunanik").val(), margincontent, 46);
		laporan.text('Nama User: ' + $("#penggunanama").val(), margincontent, 51);

		laporan.autoTable(headerlaporan, datalaporan, {
			styles: { fontSize: 10 },
			avoidPageSplit: true,
			margin: { left: margincontent, right: margincontent, top: 55, bottom: 30},
			didDrawPage: function (data)
			{
                data.settings.margin.top = 35;
			}
		});
		addFooters(laporan);
		addHeaders(laporan);

		laporan.save("Laporan pengguna aset - " + $("#penggunanama").val() + ".pdf");
	}

	$(document).ready( function (){
		window.jsPDF = window.jspdf.jsPDF;
		$('#myTable').DataTable( 
			{
				responsive: true
			} 
		);
		today = now.getFullYear()+"-"+(month)+"-"+(day);
	});
	$("#penggunanik").focusout(function(){
		searchUser();
	});

	function searchUser(){
		$("#error-pengguna-nik").html("").css("opacity", 0);
		let form_data = new FormData();
		form_data.append("key", $("#penggunanik").val());

		$.ajax({
			type: "POST",
			url: "<?php echo site_url(); ?>"+"/Master/detailUser",
			data: form_data,
			cache: false,
			processData: false,
			contentType: false,
			dataType: 'json',
			success: function(response){
				let message = response;
				$("#error-pengguna-nik").html("");
				if (message["user"].length == 0){
					$("#error-pengguna-nik").html("&nbspUser tidak ditemukan!&nbsp").css("opacity", 1);
					$("#penggunanik").val("");
					$("#penggunanama").val("");
				}
				else{
					$("#penggunanama").val(message["user"][0].NAMA);
				}
				
			}, error: function(xhr, status, error) {
				console.log(xhr.responseText);
			},
		});
	}

	function searchUserPeminjaman(){
		let form_data = new FormData();
		form_data.append("key", $("#nikpeminjaman").val());

		$.ajax({
			type: "POST",
			url: "<?php echo site_url(); ?>"+"/Master/detailUser",
			data: form_data,
			cache: false,
			processData: false,
			contentType: false,
			dataType: 'json',
			success: function(response){
				let message = response;
				$("#error-nik-peminjaman").html("");
				if (message["user"].length == 0){
					$("#error-nik-peminjaman").html("&nbspUser tidak ditemukan!&nbsp").css("opacity", 1);
					$("#nikpeminjaman").val("");
					$("#namapeminjaman").val("");
					$("#departemenpeminjaman").val("");
				}
				else{
					$("#namapeminjaman").val(message["user"][0].NAMA);
					$("#departemenpeminjaman").val(message["user"][0].DEPARTEMEN);
				}
				
			}, error: function(xhr, status, error) {
				console.log(xhr.responseText);
			},
		});
	}

	function searchAsetPeminjaman(){
		$('#kodepeminjaman').html('');
		let form_data = new FormData();
		form_data.append("kategori", $("#kategoripeminjaman").val());
		form_data.append("nama", $("#asetpeminjaman").val());
		form_data.append("lokasi", $("#lokasipeminjaman").val());
		$.ajax({
			type: "POST",
			url: "<?php echo site_url(); ?>"+"/Master/searchAssetPeminjaman",
			data: form_data,
			cache: false,
			processData: false,
			contentType: false,
			dataType: 'json',
			success: function(response){
				let message = response;
				$("#error-kode-peminjaman").html("");
				$("#kodepeminjaman").append("<option value='' selected></option>");
				
				for (i = 0; i < message["aset"].length; i++){
					$("#kodepeminjaman").append($("<option></option>").attr("value", message["aset"][i].KODE_ASSET).text(message["aset"][i].KODE_ASSET)); 
				}
			}, error: function(xhr, status, error) {
				console.log(xhr.responseText);
			},
		});
	}

	function addPeminjaman(){
		let form_data = new FormData();
		form_data.append("kode", $("#kodepeminjaman").val());
		form_data.append("nik", $("#nikpeminjaman").val());
		form_data.append("tanggal", $("#tanggalpeminjaman").val());
		form_data.append("kategori", $("#kategoripeminjaman").val());
		form_data.append("file", $('#imagepeminjaman').prop('files')[0]);

		$.ajax({
			type: "POST",
			url: "<?php echo site_url(); ?>"+"/Transaksi/addPeminjaman",
			data: form_data,
			cache: false,
			processData: false,
			contentType: false,
			dataType: 'json',
			success: function(response){
				let message = response;
				console.log(message);
				if (message["message"] == 1){
					$("#modalsuccessbody").html("Sukses meminjamkan aset!");
					$('#modalsuccess').show();
					setTimeout(function(){
						window.location.reload();
					},1000);
				}
				
				raiseErrors(message);
			}, error: function(xhr, status, error) {
				console.log(xhr.responseText);
			},
		});
	}

	$("#nikpeminjaman").focusout(function(){
		searchUserPeminjaman();
	});

	$('#kategoripeminjaman').on('change', function() {
		$("#error-kategoripeminjaman").html("");
		resetAset();
		if ($('#kategoripeminjaman').val() != ""){
			$('#kodepeminjaman').prop('disabled', false);
			$('#asetpeminjaman').prop('disabled', false);
			$('#lokasipeminjaman').prop('disabled', false);
			let form_data = new FormData();
			form_data.append("kategori", this.value);
			$.ajax({
				type: "POST",
				url: "<?php echo site_url(); ?>"+"/Transaksi/CekHakAkses",
				data: form_data,
				cache: false,
				processData: false,
				contentType: false,
				dataType: 'json',
				success: function(response){
					$('#kodepeminjaman').html('');
					let message = response;
					console.log(message);
					if (message["message"] == -1){
						$("#error-kategoripeminjaman").html("");
						$("#error-kategoripeminjaman").html("&nbspAkses ditolak!&nbsp").css("opacity", 1);
						$('#kategoripeminjaman').val("");
					}
					else{
						searchAsetPeminjaman();
					}
				}, error: function(xhr, status, error) {
					console.log(xhr.responseText);
				},
			});
		}
		else{
			$('#kodepeminjaman').prop('disabled', true);
			$('#kodepeminjaman').html('');
			$('#asetpeminjaman').prop('disabled', true);
			$('#lokasipeminjaman').prop('disabled', true);
		}
	});

	function readURLpeminjaman(input){
		if (input.files && input.files[0]) {
			var fileExtension = ['jpeg', 'jpg', 'png', 'pdf', 'doc', 'docx'];
			var ext1 = ['jpeg', 'jpg', 'png'];
			var ext2 = ['pdf', 'doc', 'docx'];
			if ($.inArray($(input).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
				alert("Only formats are allowed : "+fileExtension.join(', '));
			}
			else{
				$(".file-upload-input").hide();
				$(".image-upload-wrap-perbaikan").hide();
				
				var reader = new FileReader();

				reader.onload = function(e) {
					if ($.inArray($(input).val().split('.').pop().toLowerCase(), ext2) == -1) {
						$("#image-upload-wrapper-peminjaman").append(
							"<div class='file-upload-wrapper-perbaikan mx-1 mb-1 d-flex align-items-center' onclick='removeImagePeminjaman(this)'>" + 
								"<img class='file-upload-image' src='" + e.target.result + "'>" +
								'<div class="file-upload-remove-perbaikan cursor-pointer d-flex align-items-center justify-content-center">' +
									"<img src='<?php echo base_url(); ?>assets/img/icons/remove.png'" + "' width=24px>" +
								'</div>' + 
							"</div>"
						);
					}
					else{
						$("#image-upload-wrapper-peminjaman").append(
							"<div class='file-upload-wrapper-perbaikan mx-1 mb-1' d-flex align-items-center justify-content-center onclick='removeImagePeminjaman(this)'>" + 
								"<img class='file-upload-image p-4' src='<?php echo base_url();?>assets/img/icons/document.png' height=80%>" +
								"<div>" + input.files[0].name + "</div>" +
								'<div class="file-upload-remove-perbaikan cursor-pointer d-flex align-items-center justify-content-center">' +
									"<img src='<?php echo base_url(); ?>assets/img/icons/remove.png'" + "' width=24px>" +
								'</div>' + 
							"</div>"
						);
					}

					$('.image-title').html(input.files[0].name);
				};

				reader.readAsDataURL(input.files[0]);
			}
		}
	}

	function removeImagePeminjaman(image){
		//menghapus element image
		let index = $(image).index();
		$(image).remove();
		//

		$(".image-upload-wrap-perbaikan").html(
			'<input class="file-upload-input" type="file" id="imagepeminjaman" onchange="readURLpeminjaman(this);" accept="file/*" />' +
			'<div class="drag-text">' +
				'<h3>Drag and drop or select a File</h3>' +
			'</div>'
		);
		
		$(".image-upload-wrap-perbaikan").show();
	}

	function resetAset(){
		$('#kodepeminjaman').html('');
		$('#asetpeminjaman').val("");
		$('#lokasipeminjaman').val("");
		$("#error-kode-peminjaman").html("");
	}

	function resetInput(){
		resetAset();
		$("#error-kode-peminjaman").html("");
		$("#error-nik-peminjaman").html("");
		$("#error-tanggal-peminjaman").html('');
		$("#error-image-peminjaman").html('');

		$("#image-upload-wrapper-peminjaman").html(
			'<div class="image-upload-wrap-perbaikan mx-1">' + 
				'<input class="file-upload-input" type="file" id="imagepeminjaman" onchange="readURLpeminjaman(this);" accept="file/*" />' + 
				'<div class="drag-text">' + 
					'<h3>Drag and drop or select a File</h3>' + 
				'</div>' + 
			'</div>'
		);

		$("#kategoripeminjaman").val("");
		$("#nikpeminjaman").val("");
		$("#namapeminjaman").val("");
		$("#departemenpeminjaman").val("");
		$("#tanggalpeminjaman").val("");
	}

	function raiseErrors(errors){
		$("#error-kode-peminjaman").html("");
		$("#error-nik-peminjaman").html("");
		$("#error-tanggal-peminjaman").html('');
		$("#error-image-peminjaman").html('');

		$("#error-kode-peminjaman").html(errors["kode"]).css("opacity", 1);
		$("#error-nik-peminjaman").html(errors["nik"]).css("opacity", 1);
		$("#error-tanggal-peminjaman").html(errors["tanggal"]).css("opacity", 1);
		$("#error-image-peminjaman").html(errors["hiddenfile"]).css("opacity", 1);
	}

	$("#btnadd").click(function(){
		resetInput();
		$('#kodepeminjaman').prop('disabled', true);
		$('#kodepeminjaman').html('');
		$('#asetpeminjaman').prop('disabled', true);
		$('#lokasipeminjaman').prop('disabled', true);
	});

	function searchPenggunaAset(){
		if ($("#penggunanik").val() == ""){
			$("#error-pengguna-nik").html("&nbspUser harus diisi!&nbsp").css("opacity", 1);
		}
		else{
			$("#btndownload").removeAttr('hidden');
			$("#tabelpeminjaman").removeAttr('hidden');
			$('#tabelpeminjaman').DataTable().clear().destroy();
			let form_data = new FormData();
			form_data.append("nik", $("#penggunanik").val());
			form_data.append("kategori", $("#penggunakategori").val());
			form_data.append("aset", $("#penggunaaset").val());

			$.ajax({
				type: "POST",
				url: "<?php echo site_url(); ?>"+"/Master/searchPenggunaAset",
				data: form_data,
				cache: false,
				processData: false,
				contentType: false,
				dataType: 'json',
				success: function(response){
					let message = response;
					console.log(message);
					datapeminjaman = [];
					$("#bodypeminjaman").html("");
					let idxlaporan = 1;
					response.peminjaman.forEach(element => {
						kategori = "";
						if (element['FK_KATEGORI'] == 1){
							kategori = "Rumah Dinas";
						}
						else if (element['FK_KATEGORI'] == 2){
							kategori = "Gedung";
						}
						else if (element['FK_KATEGORI'] == 3){
							kategori = "Kendaraan";
						}
						else if (element['FK_KATEGORI'] == 4){
							kategori = "Asrama";
						}
						else if (element['FK_KATEGORI'] == 5){
							kategori = "Fasilitas";
						}
						const date = new Date(element['TGL_TRANSAKSI']);
						const formattedDate = date.toLocaleDateString('en-GB', {
						day: '2-digit', month: 'short', year: 'numeric'
						}).replace(/ /g, ' ');
						let tr = `<tr>
							<td> ${element['NIK']} </td>
							<td> ${element['NAMA']} </td>
							<td> ${element['DEPARTEMEN']} </td>
							<td> ${kategori} </td>
							<td> ${element['NAMA_ASSET']} </td>
							<td> ${element['KODE_ASSET']} </td>
							<td> ${element['INFO_1']} </td>
							<td><a href='<?php echo base_url(); ?>assets/files/peminjaman/${element['KETERANGAN_3']}'><img src='<?php echo base_url(); ?>assets/img/icons/document.png' width=50></a></td>
							<td><button data-bs-toggle="modal" href="#modalconfirm" class="btn btn-outline-dark" onclick="setKodePengembalian(this)" value="${element['KODE_TRANSAKSI']}">Kembalikan</button></td>
						</tr>`;
						$("#bodypeminjaman").append(tr);
						let row = [element['NIK'], element['NAMA'], element['DEPARTEMEN'], kategori, element['NAMA_ASSET'], element['KODE_ASSET'], element['INFO_1'], element['KETERANGAN_3']];
						datapeminjaman.push(row);
						let rowlaporan = [idxlaporan, formattedDate, kategori, element['NAMA_ASSET'], element['KODE_ASSET'], element['INFO_1']];
						datalaporan.push(rowlaporan);
						idxlaporan++;
					});
					
					$('#tabelpeminjaman').DataTable( 
						{
							responsive: false
						} 
					);
					raiseErrors(message);
				}, error: function(xhr, status, error) {
					console.log(xhr.responseText);
				},
			});
		}
	}

	function setKodePengembalian(btn){
		let kode = $(btn).attr('value');
		$('#kodepengembalian').val(kode);
	}

	function PengembalianAset(){
		let form_data = new FormData();
		form_data.append("kodetrans", $("#kodepengembalian").val());

		$.ajax({
			type: "POST",
			url: "<?php echo site_url(); ?>"+"/Transaksi/PengembalianAset",
			data: form_data,
			cache: false,
			processData: false,
			contentType: false,
			dataType: 'json',
			success: function(response){
				let message = response;
				console.log(message);
				if (message["message"] == 1){
					$("#modalsuccessbody").html("Sukses mengembalikan aset!");
					$('#modalsuccess').show();
					setTimeout(function(){
						window.location.reload();
					},1000);
				}
				
				raiseErrors(message);
			}, error: function(xhr, status, error) {
				console.log(xhr.responseText);
			},
		});
	}

	$("#asetpeminjaman").focusout(function(){
		searchAsetPeminjaman();
	});

	$("#lokasipeminjaman").focusout(function(){
		searchAsetPeminjaman();
	});

	$("#kodepeminjaman").on("change", function(){
		selectAsetPeminjaman();
	})

	function selectAsetPeminjaman(){
		let form_data = new FormData();
		form_data.append("kode", $("#kodepeminjaman").val());
		$.ajax({
			type: "POST",
			url: "<?php echo site_url(); ?>"+"/Master/selectAssetPeminjaman",
			data: form_data,
			cache: false,
			processData: false,
			contentType: false,
			dataType: 'json',
			success: function(response){
				let message = response;
				$("#error-kode-peminjaman").html("");
				if (message["aset"][0].STATUS == 0){
					$("#kodepeminjaman").val(message["aset"][0].KODE_ASSET);
					$("#asetpeminjaman").val(message["aset"][0].NAMA_ASSET);
					$("#lokasipeminjaman").val(message["aset"][0].INFO_1);
				}
				else{
					$("#error-kode-peminjaman").html("&nbsp" + $("#kategoripeminjaman option:selected").text() + " sedang tidak tersedia!&nbsp").css("opacity", 1);
					$("#kodepeminjaman").val("");
				}
			}, error: function(xhr, status, error) {
				console.log(xhr.responseText);
			},
		});
		
	}
</script>
