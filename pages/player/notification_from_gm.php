<?php 
$notif_hingga = "2021-09-13";
$gm_nickname = "abi";
$nama_gm = "Iin Sholihin, S.T., M.Kom<br>NIDN: 0411068706";

if(strtotime(date("Y-m-d")) <= strtotime($notif_hingga)){
	?>


	<div class='alert alert-success' id="gm_notification">
		<div style="margin-bottom:10px">GM Notification</div>

		<div class="row">
			<div class="col-lg-2 text-centera">
				<img src="assets/img/gm/abi.jpg" class="rounded-circle" width="100px"><br>
				<small><?=$nama_gm ?></small>
				
			</div>
			<div class="col-lg-10">
				Update fitur terbaru:
				<ol>
					<li>GM Notification. Notifikasi ini akan hilang di esok hari.</li>
					<li>Claim Challenge Rewards. Silahkan claim reward challenge kamu!</li>
					<li>Hapus Bukti Link Challenge (jika belum claim)</li>
				</ol>
				Ongoing fitur saat ini adalah penambahan link bahan ajar dan video pembelajaran... happy learning :) 
			</div>
			
		</div>
		<div class="text-right"><button class="btn btn-primary btn-sm" id="btn_faham_gm_notif" style="margin-top:10px">OK. Saya faham</button></div>
	</div>


	<?php } ?>


	<script type="text/javascript">
		$(document).ready(function(){
			$("#btn_faham_gm_notif").click(function(){
				$("#gm_notification").fadeOut();
			})
		})
	</script>