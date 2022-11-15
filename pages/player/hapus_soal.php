<?php 
// die("ga dipake"); //zzz
 ?>
<section id="hapus_soal" class="player">
	<div class="container">

		<h3>Hapus Soal</h3>

		<?php 

		if(!isset($_GET['id_soal'])) die("Soal id belum ditentukan. Silahkan Anda menuju <a href='?myq'>My Questions</a>");
		$id_soal = $_GET['id_soal'];


		# ==========================================================
		# REJECTER COUNT
		# ==========================================================
		$s = "SELECT a.*,b.nama_player from tb_soal_rejectby a 
		join tb_player b on a.nickname=b.nickname 
		where a.id_soal='$id_soal'";
		$q = mysqli_query($cn,$s) or die("Tidak bisa mengakses data rejecter");
		$jumlah_rejecter = mysqli_num_rows($q);
		if($jumlah_rejecter==0){ ?>
			<p>No Rejecter</p>
			<?php
		}else{
			echo "Soal telah di-REJECT oleh $jumlah_rejecter players:";
			while($d=mysqli_fetch_assoc($q)){
				$znickname = $d['nickname'];
				$alasan_reject = $d['alasan_reject'];
				$znama_player = ucwords(strtolower($d['nama_player']));

				echo "<br>~ $znama_player; alasan: $alasan_reject";
			}
		}

		echo "<hr>";



		# ==========================================================
		# PENJAWAB COUNT
		# ==========================================================
		$s = "SELECT a.*,b.nama_player from tb_soal_playedby a 
		join tb_player b on a.nickname=b.nickname 
		where a.id_soal='$id_soal'";
		$q = mysqli_query($cn,$s) or die("Tidak bisa mengakses data soal_playedby");
		$jumlah_penjawab = mysqli_num_rows($q);
		if($jumlah_penjawab==0){ ?>
			<form action="?delsoal&id_soal=<?=$id_soal ?>" method="post">
				<label>id soal: <?=$id_soal?></label>
				<input type="hidden" name="id_soal" value="<?=$id_soal?>">
				<button class="btn btn-danger btn-sm">Hapus Soal</button>
			</form>
			<?php
		}else{
			echo "Soal telah dimainkan oleh $jumlah_penjawab players:";
			while($d=mysqli_fetch_assoc($q)){
				$znickname = $d['nickname'];
				$znama_player = ucwords(strtolower($d['nama_player']));

				echo "<br>~ $znama_player";
			}
		}



		?>

	</div>
</section>