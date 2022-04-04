<style>
	.link-admin .nav-item{
		color: white !important;
		font-weight: bold;
		transition: 0.2s;
	}
	.link-admin:hover a{
		font-weight: bold;
		font-size: 21px;
		transition: 0.2s;
	}
</style>
<ul class="navbar-nav ms-auto pt-2 pt-lg-0">
	<li class="mb-3 link-admin"><a class='link-admin-rumah' href='<?php echo site_url("Master/masterrumah"); ?>' style="text-decoration: none; color: black">Rumah Dinas</a></li>
	<li class="mb-3 link-admin"><a class='link-admin-gedung' href='<?php echo site_url("Master/mastergedung"); ?>' style="text-decoration: none; color: black">Gedung UBS</a></li>
	<li class="mb-3 link-admin"><a class='link-admin-kendaraan' href='<?php echo site_url("Master/masterkendaraan"); ?>' style="text-decoration: none; color: black">Kendaraan</a></li>
	<li class="mb-3 link-admin"><a class='link-admin-asrama' href='<?php echo site_url("Master/masterasrama"); ?>' style="text-decoration: none; color: black">Asrama UBS</a></li>
	<li class="mb-3 link-admin"><a class='link-admin-fasilitas' href='<?php echo site_url("Master/masterfasilitas"); ?>' style="text-decoration: none; color: black">Fasilitas</a></li>
	<li class="mb-3 link-admin"><a class='link-admin-laporan' href='<?php echo site_url("Master/masterlaporan"); ?>' style="text-decoration: none; color: black">Laporan Aset</a></li>
</ul>





