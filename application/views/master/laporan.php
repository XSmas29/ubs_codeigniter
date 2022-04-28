<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Master | Laporan Aset</title>
</head>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/master-asset.css">
<style>
	.link-admin-laporan{
		font-weight: bold;
		font-size: 21px;
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
								<h3 class="text-dark">Laporan Aset</h3>
							</div>
						</div>
						
						<div class="modal-body pt-0 min-vh-25 min-vh-sm-50">
							<div class="row text-center">
								<div class="col-6">
									<!-- <input type="text" name="koderepair" id="koderepair" hidden/> -->
									<div class="form__group field mb-5">
										<input type="date" class="form__field" name="dateFrom" id="dateFrom" placeholder="Date From"/>
										<label class="form__label">Date From<small class="form-error" id="error-dateFrom"></small></label>
									</div>
									<div class="form__group field mb-5">
										<input type="date" class="form__field" name="dateTo" id="dateTo" placeholder="Date To"/>
										<label class="form__label">Date To<small class="form-error" id="error-dateTo"></small></label>
									</div>
								</div>
								<div class="col-6">
									<div class="form__group field mb-5">
										<label class="form__label">Kategori<small class="form-error" id="error-kategori"></small></label>
										<select class="form__field" name="kategori" id="kategori" placeholder="Kategori">
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
									<div class="form__group field mb-5">
										<label class="form__label">Aktivitas<small class="form-error" id="error-aktivitas"></small></label>
										<select class="form__field" name="aktivitas" id="aktivitas" placeholder="Aktivitas">
											<option value="" selected>All</option>
											<option value="Pengadaan">Pengadaan</option>
											<option value="Perubahan">Perubahan</option>
											<option value="Perbaikan">Perbaikan</option>
											<option value="Peminjaman">Peminjaman</option>
										</select>
									</div>
								</div>
								<div class="d-flex justify-content mb-4">
									<button type="button" class="btn btn-primary px-5 btn-submit" id="btnsearch" onclick="searchData()">SEARCH</button>
									<button type="button" class="btn btn-success mx-2 btn-submit" id="btndownload" onclick="generateLaporan()" hidden>Download Laporan</button>
								</div>
								<hr>
								<div>
									<table id="tabellaporan" class="table table-striped table-bordered rounded text-center" hidden>
										<thead>
											<tr>
												<th>Tanggal</th>
												<th>Kategori</th>
												<th>Aktivitas</th>
												<th>Nama Aset</th>
												<th>Lokasi</th>
												<th>Keterangan</th>
											</tr>
										</thead>
										<tbody id="bodyLaporan">
												
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
</body>

</html>

<script type="text/javascript">
	var datalaporan = [];
	var headerlaporan = ['Tanggal', 'Kategori', 'Aktivitas', 'Nama Aset', 'Lokasi', 'Keterangan'];
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
		laporan.text('Laporan Aset PT. UBS', laporan.internal.pageSize.getWidth() / 2, 33, { align: 'center'} );
		laporan.text(format_date($("#dateFrom").val()) + " - " + format_date($("#dateTo").val()), laporan.internal.pageSize.getWidth() / 2, 39, { align: 'center'});

		laporan.setFontSize(11);
		laporan.text('Jenis Aset: ' + $("#kategori option:selected").text(), margincontent, 46);
		laporan.text('Kegiatan: ' + $("#aktivitas option:selected").text(), margincontent, 51);

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

		laporan.save("laporan_aset.pdf");
	}

	$(document).ready( function () 
	{
		window.jsPDF = window.jspdf.jsPDF;
		var now = new Date();
		var day = ("0" + now.getDate()).slice(-2);
		var month = ("0" + (now.getMonth() + 1)).slice(-2);
		let today = now.getFullYear()+"-"+(month)+"-"+(day);
		$('#dateFrom').val(today);
		$('#dateTo').val(today);
	});

    function searchData(){
		$("#tabellaporan").removeAttr('hidden');
		$("#btndownload").removeAttr('hidden');
        // console.log("LOL");
        let form_data = new FormData();
        form_data.append("dateFrom", $("#dateFrom").val());
		form_data.append("dateTo", $("#dateTo").val());
        form_data.append("kategori", $("#kategori").val());
        form_data.append("aktivitas", $("#aktivitas").val());

		$('#tabellaporan').DataTable().clear().destroy();
        $.ajax({
			type: "POST",
			url: "<?php echo site_url(); ?>"+"/Master/searchDataAsset",
			data: form_data,
			cache: false,
			processData: false,
			contentType: false,
            dataType: 'json',
			success: function(response){
                let message = response;
				console.log(message);
				datalaporan = [];
                $("#bodyLaporan").html("");
                response.message.forEach(element => {
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
                        <td> ${formattedDate} </td>
                        <td> ${kategori} </td>
                        <td> ${element['AKTIVITAS_TRANSAKSI']} </td>
                        <td> ${element['NAMA_ASSET']} </td>
                        <td> ${element['INFO_1']} </td>
                        <td> ${element['KETERANGAN_1']} </td>
                    </tr>`;
					let row = [formattedDate, kategori, element['AKTIVITAS_TRANSAKSI'], element['NAMA_ASSET'], element['INFO_1'], element['KETERANGAN_1']];
					datalaporan.push(row);
                    $("#bodyLaporan").append(tr);
                });
				
				$('#tabellaporan').DataTable( 
					{
						responsive: false
					} 
				);
			}, error: function(xhr, status, error) {
				console.log(xhr.responseText);
			},
		});
    }
</script>
