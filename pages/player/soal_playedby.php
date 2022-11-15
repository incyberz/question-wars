<section id="hapus_soal" class="player">
	<div class="container">

		<h3>Soal Playedby</h3>
		<p>Halaman ini berisi keterangan tentang para penjawab dan rejecters dari soal yang kamu buat. | <?=$link_back?></p>

		<?php 

		if(!isset($_GET['id_soal'])) die("Soal id belum ditentukan. Silahkan Anda menuju <a href='?myq'>My Questions</a>");
		$id_soal = $_GET['id_soal'];

		$s = "SELECT is_banned,is_approved_by_gm from tb_soal	where id_soal='$id_soal'";
		$q = mysqli_query($cn,$s) or die("Tidak bisa mengakses data soal");
		$d=mysqli_fetch_assoc($q);

		$is_banned = $d['is_banned'];
		$is_approved_by_gm = $d['is_approved_by_gm'];
		// $is_approved_by_gm = "0";


		$is_suspended_show = "<i>None</i>";
		if($is_approved_by_gm=="0") $is_suspended_show = "<i style='color:#f88'>Yes</i>";

		$is_banned_show = "<i>No</i>";
		if($is_banned=="1") $is_banned_show = "<i style='color:#f88'>Yes</i>";

		$is_approved_by_gm_show = "<i>None</i>";
		if($is_approved_by_gm=="1") $is_approved_by_gm_show = "<i style='color:#8f8'>Yes</i>";


		# ==========================================================
		# REJECTER COUNT
		# ==========================================================
		$s = "SELECT a.*,b.nama_player from tb_soal_rejectby a 
		join tb_player b on a.nickname=b.nickname 
		where a.id_soal='$id_soal'";
		$q = mysqli_query($cn,$s) or die("Tidak bisa mengakses data rejecter");
		$jumlah_rejecter = mysqli_num_rows($q);
		if($jumlah_rejecter==0){ ?>
			<p class="wadah">Soal ini belum pernah direject.</p>
			<?php
		}else{
			echo "<p class='wadah'>Soal telah di-REJECT oleh $jumlah_rejecter players:";
			while($d=mysqli_fetch_assoc($q)){
				$znickname = $d['nickname'];
				$alasan_reject = $d['alasan_reject'];
				$znama_player = ucwords(strtolower($d['nama_player']));

				echo "<br>~ $znama_player; alasan: $alasan_reject";
			}
			echo '</p>';
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
			<p class="wadah">Soal ini belum pernah dijawab.</p>
			<?php
		}else{
			echo "<p class='wadah'>Soal telah dimainkan oleh $jumlah_penjawab players:";
			while($d=mysqli_fetch_assoc($q)){
				$znickname = $d['nickname'];
				$zdijawab_benar = $d['dijawab_benar'];
				$znama_player = ucwords(strtolower($d['nama_player']));

				$is_dijawab_benar_show = "<span style='color:#f5f'>tidak menjawab (waktu habis).</span>";
				if($zdijawab_benar=="1") $is_dijawab_benar_show = "<span style='color:#8f8'>menjawab benar.</span>";
				if($zdijawab_benar=="0") $is_dijawab_benar_show = "<span style='color:#f88'>menjawab salah.</span>";

				echo "<br>~ $znama_player: $is_dijawab_benar_show";
			}
			echo "</p>";
		}

		if(($jumlah_rejecter==0 and $jumlah_penjawab==0) or $is_banned or $is_approved_by_gm=="0" or $jumlah_rejecter>0){

			$is_played_show = "<i>Never</i>";
			if($jumlah_penjawab>0 or $jumlah_rejecter>0) $is_played_show = "<i>Yes</i>";

			$is_rejected_show = "<i>Never</i>";
			if($jumlah_rejecter>0) $is_rejected_show = "<i style='color:#f88'>Yes</i>";


		?>
		<div class="wadah">
			<p>Soal kamu: 
				<br>~ isPlayed : <?=$is_played_show ?>
				<br>~ isRejected : <?=$is_rejected_show ?>
				<br>~ isSuspended : <?=$is_suspended_show ?>
				<br>~ isBanned : <?=$is_banned_show ?>
				<br>~ isApproved : <?=$is_approved_by_gm_show ?>
			</p>
			<p>Anda boleh menghapus soal ini.</p>

			<form action="?delsoal&id_soal=<?=$id_soal?>" method="post">
				<div class="form-group">
					<input type="hidden" name="id_soal" value="<?=$id_soal?>">
				</div>
				<button class="btn btn-danger btn-sm">Hapus Soal</button>
			</form>
		</div>

	<?php }else{ ?>

		<div class="wadah">
			<p>Soal kamu masih aktif dan belum bisa dihapus. <br><br>
			Selamat! Soal kamu akan terus menghasilkan <span class="badge badge-success" style="font-size:10pt">Passive Point</span> saat dijawab!!</p>

		</div>

	<?php } ?>

	<hr>
	<?=$btn_back?>
	</div>
</section>