<section id="detail_kelas" class="gm">
	<div class="container">

		<?php 

		$kelas = isset($_GET['kelas']) ? $_GET['kelas'] : die('Index kelas masih kosong.<hr>$btn_back');

		?>

		<h3>Detail Kelas</h3>
		<p>Peserta kelas untuk kelas <?=$kelas?></p>


	</div>
</section>