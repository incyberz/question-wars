<?php 
if(0){
# ==============================================================
# DAILY LOGIN
# ==============================================================
$list_login_point = '';

$s = "SELECT a.id_daily_login,a.login_point,b.date_login from tb_daily_login a 
join tb_login b on a.id_login=b.id_login 
where a.login_point>0 and b.nickname='$nickname'"; 

$q = mysqli_query($cn,$s) or die("Error @dashboard. Tidak dapat mengakses daily login");
if(mysqli_num_rows($q)>0){
	$d = mysqli_fetch_assoc($q);
	$id_daily_login = $d['id_daily_login'];
	$login_point = $d['login_point'];
	$date_login = $d['date_login'];
	$list_login_point.= "<li id='list_claim__$id_daily_login'>Login tanggal: $date_login | <span id='nilai_claim__$id_daily_login' style='tebal biru'>$login_point</span> LP | <a href='#blok_daily_login' class='btn btn-success btn-sm btn_claim scrollto' id='btn_claim__$id_daily_login'>Claim Daily Point</a></li>";
	?>

	<div class="alert alert-success" id="blok_daily_login">
		<p style="color:green">Selamat <?=$nama_player?>! Kamu berhak mendapatkan Daily Login Point:</p>
		<ul>
			<?=$list_login_point?>
		</ul>
		<hr>
		<button class="btn btn-primary btn-sm" id="btn_close_daily_login" onclick="$('#blok_daily_login').fadeOut(1000)">Close</button>
	</div>

<?php } ?>


<script type="text/javascript">
	$(document).ready(function(){
		$(".btn_claim").click(function(){
			var id = $(this).prop("id");
			var rid = id.split("__");
			var id_daily_login = rid[1];
			var link_ajax = "ajax/ajax_claim_daily_login.php?id="+id_daily_login;

			$.ajax({
				url:link_ajax,
				success:function(a){
					var ra = a.split("__");
					if(parseInt(ra[0])==1){
						$("#list_claim__"+id_daily_login).text("Claimed. Global points kamu bertambah menjadi "+ra[1]+" LP");
						$("#global_points").text(ra[1]);

					}else{
						alert(a)
					}
				}
			})
		})
	})
</script>

<?php } ?>