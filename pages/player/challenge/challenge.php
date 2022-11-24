<section id="challenge" class="player">
	<div class="container">
		<h3>Challenges for You!</h3>
		<p>Challenge adalah quest khusus dari GM di bidang praktikum komputer, kerja kelompok, atau praktik lapangan. Challenge menghasilkan learning point yang besar sesuai dengan tingkat kesulitan dan kedalaman materi.</p>
		
		<?php if ($cadmin_level==2 or $cadmin_level==9) {
		    echo "<div class='text-right mb-2'><a href='?managechal' class='btn btn-primary btn-sm'>Manage Chal</a> <a href='?addchal' class='btn btn-success btn-sm'>Add Challenge</a></div>";
		} ?>
		
		<style type="text/css">
			#chal_list ol{padding: 0 0 0 20px;}
			#chal_list li{margin-top: 20px;}
		</style>
		<div class="wadah" id="chal_list" id="blok_filter">
			<div class="wadah" style="margin-bottom:10px">
				<div class="row">
					<div class="col-lg-3">
						Level
						<select id="chal_level_filter" class="filter form-control">
							<option value="all">--All--</option>
							<?php
		                    $s = "SELECT * from tb_chal_level order by rank_level";
		$q = mysqli_query($cn, $s) or die("Tidak bisa mengakses data challenge level");
		while ($d=mysqli_fetch_assoc($q)) {
		    $chal_level = ucwords($d['chal_level']);
		    echo "<option>$chal_level</option>";
		}
		?>
						</select>

					</div>
					<div class="col-lg-3">
						Filter
						<input class="form-control" type="text" size="8" maxlength="10" id="chal_name_filter"> 
					</div>
					<div class="col-lg-3">
						Beaten
						<select id="status_beaten_filter" class="filter form-control">
							<option value="all">--All--</option>
							<option value="claimed">Claimed</option>
							<option value="unclaimed">Unclaimed</option>
							<option value="unverified">Unverified</option>
						</select>
					</div>
					<div class="col-lg-3">
						Order by 
						<select id="order_by_filter" class="filter form-control">
							<option value="chal_created desc">Terbaru</option>
							<option value="chal_created ">Terdahulu</option>
							<option value="max_point desc">Poin Terbesar</option>
							<option value="max_point ">Poin Terkecil</option>
							<option value="chal_name">Nama Challenge</option>
						</select>
						
					</div>
				</div>
			</div>
			<div id="hasil_ajax"></div>
		</div>

	</div>
</section>












<script type="text/javascript">
	$(document).ready(function(){

		$("#chal_name_filter").keyup(function(){
			$(".filter").change();
		})
		$(".filter").change(function(){

			var chal_level_filter = $("#chal_level_filter").val();
			var chal_name_filter = $("#chal_name_filter").val();
			var status_beaten_filter = $("#status_beaten_filter").val();
			var order_by_filter = $("#order_by_filter").val();

			if(chal_name_filter.length<3) chal_name_filter = '';

			var link_ajax = "ajax/ajax_challenge_list.php"
			+"?chal_level_filter="+chal_level_filter
			+"&chal_name_filter="+chal_name_filter
			+"&status_beaten_filter="+status_beaten_filter
			+"&order_by_filter="+order_by_filter
			+'';

			$.ajax({
				url:link_ajax,
				success:function(a){
					$("#hasil_ajax").html(a)
				}
			})
		})


		$("#chal_level_filter").change();
		
	})


</script>