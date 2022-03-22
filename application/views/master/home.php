<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Master | Home</title>
</head>

<body>
	<main class="main" id="top">
		<?php require_once(APPPATH . 'views\template\header.php') ?>

		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.bundle.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css"/>

		<section id="home">
			<div class="bg-holder" style="background-image:url(<?php echo base_url(); ?>assets/img/gallery/hero.png);background-position:center;background-size:cover;">
			</div>

			<div class="container-fluid">
				<div class="row">
					<div class="col-1"></div>
					<div class="col-10">
						<h3 class="text-light">Master Data</h3>
						<div class="bg-light min-vh-50 min-vh-sm-75 p-4 rounded-3 fs-5">
							<div class="row">
								<div class="col-2">
									<?php require_once(APPPATH . 'views\template\navbar.php') ?>
								</div>
								<div class="col-10">
									<h2 class="d-flex justify-content-center align-self-center">
										Welcome, Admin
									</h2>
								</div>
							</div>
							
						</div>
						
					</div>
						
					<div class="col-1"></div>
				</div>
				
			</div>
		</section>
	</main>
</body>

</html>
<script type="text/javascript">
</script>
