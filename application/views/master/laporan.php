<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Master | Laporan Aset</title>
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
                                                        <option value="" selected></option>
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
                                                        <option value="" selected></option>
                                                        <option value="Pengadaan">Pengadaan</option>
                                                        <option value="Perubahan">Perubahan</option>
                                                        <option value="Perbaikan">Perbaikan</option>
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="d-flex justify-content">
                                                <button type="button" class="btn btn-primary px-5 btn-submit" id="btnsearch">SEARCH</button>
                                            </div>
                                            <div>
                                                <table id="myTable" class="table table-striped table-bordered rounded text-center">
                                                    <thead>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Kategori</th>
                                                            <th>Aktivitas</th>
                                                            <th>Asset Name</th>
                                                            <th>Location</th>
                                                            <th>Keterangan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                            <?php 
                                                                for ($i=0; $i < count($listDataAktivitas); $i++) {
                                                            ?>
                                                                    
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
					</div>
				</div>
			</div>
		</section>
	</main>
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
	});

    $('#btnsearch').click(function(){
		
	});
</script>