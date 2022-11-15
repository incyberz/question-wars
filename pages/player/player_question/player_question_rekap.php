<style>
	#toggle_ket_jumlah_soal { cursor: pointer; color: aquamarine; transition: .2s; }
	#toggle_ket_jumlah_soal:hover { font-weight: bold; letter-spacing: 1px; }
	.ket_jumlah_soal { 
		border: solid 1px #ccc; 
		padding: 10px; 
		border-radius: 5px; 
		margin: 15px 0; 
		background: linear-gradient(#005500aa, #550055aa); 
		font-size: small;
		cursor: pointer;
		display: none;
	}
	.ket_jumlah_soal td{ padding: 0; color: white; }
</style>

<div id="toggle_ket_jumlah_soal">Room: <?=$nama_room?></div>
<div class="ket_jumlah_soal">
	<div class="row">
		<div class="col-lg-4">
			<h3>Rekap per Sesi</h3>
			<table class="table">
				<?php 
				for ($i=0; $i < (count($rsesi_mks)-1) ; $i++){
					echo "
					<tr>
						<td>$rsesi_mks[$i]</td>
						<td>$rjspss[$i]</td>
					</tr>";
				} 
				?>
			</table>
		</div>
		<div class="col-lg-4">
			<h3>Rekap per Status</h3>
			<table class="table">
				<?php 
				for ($i=0; $i < (count($rnama_status)-1) ; $i++){
					echo "
					<tr>
						<td>$rstatus_soal[$i]</td>
						<td>$rnama_status[$i]</td>
						<td>$rrekap_status[$i]</td>
					</tr>";
				} 
				?>
			</table>
		</div>
		<div class="col-lg-4">
			<h3>Rekap per Visibility</h3>
			<table class="table">
				<?php 
				for ($i=0; $i < (count($rnama_visibility)-1) ; $i++){
					echo "
					<tr>
						<td>$rvisibility_soal[$i]</td>
						<td>$rnama_visibility[$i]</td>
						<td>$rrekap_visibility[$i]</td>
					</tr>";
				} 
				?>
			</table>
		</div>
	</div>
</div>