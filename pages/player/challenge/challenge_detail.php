<?php
$id_chal = isset($_GET['id_chal']) ? $_GET['id_chal'] : die("Challenge id not set.");
// $isi_csv = '';

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit_from = ($page-1)*10;

$s = "SELECT a.*,(select count(1) from tb_chal_skill_level where id_chal=a.id_chal ) as jumlah_skill_level from tb_chal a where a.id_chal=$id_chal";
$q = mysqli_query($cn, $s) or die("Tidak bisa mengakses data challenge. id_chal:$id_chal");
$d = mysqli_fetch_assoc($q);

$chal_name = $d['chal_name'];
$chal_level = $d['chal_level'];
$chal_desc = $d['chal_desc'];
$min_point = $d['min_point'];
$max_point = $d['max_point'];

$speed_point = $d['speed_point'];
$ontime_in_days = $d['ontime_in_days'];
$deadline_in_days = $d['deadline_in_days'];

$chal_created = $d['chal_created'];
$chal_creator = $d['chal_creator'];

$sifat_chal = $d['sifat_chal'];
$input_harus_mengandung = $d['input_harus_mengandung'];
$input_tidak_mengandung = $d['input_tidak_mengandung'];

$jumlah_skill_level = $d['jumlah_skill_level'];









# ===================================================
# SPEED POINT CALCULATION
# ===================================================

$speed_point_show = '<div class=wadah><h5>Speed Points Reward</h5><ul><li><i>(none)</i></li></ul></div>';
if ($speed_point>0) {
    $speed_point_show = '<div class=wadah><h5>Speed Points Reward</h5><ul>';
    $speed_point_show .= "<li>Speed Point: <code>$speed_point</code> LP</li>";
    $speed_point_show .= "<li>Ontime dalam <code>$ontime_in_days</code> hari</li>";
    $speed_point_show .= "<li>Deadline dalam <code>$deadline_in_days</code> hari setelah batas ontime</li>";
    $speed_point_show .= "</ul>";

    if ($speed_point>0) {
        $speed_point_show .= "<p>Speed point maksimal yaitu $speed_point LP jika dikerjakan secara ontime dalam $ontime_in_days hari setelah jadwal perkuliahan! Lebih dari itu maka speed-point akan terus berkurang hingga 0 dalam waktu $deadline_in_days hari.</p>";
    }
    $speed_point_show .= '</div>';
}




# ===================================================
# INPUT WAJIB MENGANDUNG
# ===================================================
if ($input_harus_mengandung!='') {
    $arr = explode(';;', $input_harus_mengandung);
    $input_harus_mengandung = '<div class=wadah><h5>Link Submit wajib mengandung salah satu kata berikut:</h5><ol>';
    for ($i=0;$i<count($arr);$i++) {
        $input_harus_mengandung .= "<li><code>$arr[$i]</code></li>";
    }
    $input_harus_mengandung .= '</ol></div>';
}

# ===================================================
# TIDAK BOLEH MENGANDUNG
# ===================================================
if ($input_tidak_mengandung!='') {
    $arr = explode(';;', $input_tidak_mengandung);
    $input_tidak_mengandung = '<div class=wadah><h5>Link Submit tidak boleh mengandung salah satu kata berikut:</h5><ol>';
    for ($i=0;$i<count($arr);$i++) {
        $input_tidak_mengandung .= "<li><code>$arr[$i]</code></li>";
    }
    $input_tidak_mengandung .= '</ol></div>';
}

# =======================================================
# CEK JIKA PLAYER SUDAH BEAT
# =======================================================
$s = "SELECT 1 from tb_chal_beatenby where id_chal='$id_chal' and beaten_by='$cnickname'";
$q = mysqli_query($cn, $s) or die("Tidak bisa mengecek is_exist beatenby. id_chal:$id_chal");
if (mysqli_num_rows($q)==1) {
    $sudah_beat = 1;
    $btn_beat = "<div class='row'><div class='col-lg-4 offset-lg-4'><button class='btn btn-danger btn-block' style='margin-top:15px' disabled>Kamu sudah melaksanakannya.</button></div></div>";
} else {
    $sudah_beat = 0;
    $btn_beat = "<div class='row'><div class='col-lg-4 offset-lg-4'><a href='?chalbeat&id_chal=$id_chal' class='btn btn-primary btn-block' style='margin-top:15px'>Submit Hasil Challenge!</a></div></div>";
}




# ===================================================
# JUMLAH SKILL POINT
# ===================================================
if ($sudah_beat) {
    $opsi_skill_levels = '';
} else {
    $opsi_skill_levels = '<div class=wadah><h5>Skill Levels Options</h5><ul><li><i>(none)</i></li></ul></div>';
    if ($jumlah_skill_level>0) {
        $btn_beat = '';
        $s = "SELECT * from tb_chal_skill_level where id_chal='$id_chal'";
        $q = mysqli_query($cn, $s) or die('Tidak bisa mengakses data skill level.');
        $opsi_skill_levels = '<div class=wadah><h5>Skill Levels Options</h5>
		<p>Silahkan pilih skill point reward yang ingin kalian raih. Jika kamu sibuk bekerja dan tidak ada waktu luang boleh boleh memilih challenge termudah. Dan jika kamu orangnya kreatif dan banyak waktu luang silahkan pilih challenge yang paling menantang!</p>
		<table class="table table-hover table-striped">';
        $i=0;
        while ($d=mysqli_fetch_assoc($q)) {
            $i++;
            $opsi_skill_levels .= "<tr>
				<td>$i</td>
				<td>$d[nama_skill_level]</td>
				<td>$d[poin_skill_level] LP</td>
				<td>Syarat: $d[syarat_skill_level]</td>
				<td>
					<a href='?chalbeat2&id_skill_level=$d[id_skill_level]' class='btn btn-primary btn-block'>Submit</a>
				</td>
				</tr>";
        }
        $opsi_skill_levels .= '</table></div>';
    }
}



$chal_details = "
<h4 style='color:#7ff' id='chal_name'>$chal_name</h4>
~ Level : <span id='chal_level'>$chal_level</span>
<br>~ Range Points : <span id='min_point'>$min_point</span> - <span id='max_point'>$max_point</span> LP
<br>~ Created by : <span id='chal_creator'>$chal_creator</span> <small>at $chal_created</small>
<div class='wadah' style='margin:10px 0'>
	$chal_desc 
	$speed_point_show
	$input_harus_mengandung 
	$input_tidak_mengandung 
	$opsi_skill_levels
			$btn_beat
</div>
<hr>

";
?>

<style>.wadah{ margin:15px 0 } code { font-size:100%}</style>
<section id="chal_details" class="gm">
	<div class="container">

		<p><?=$link_back?> | Challenge Details</p> Chal-id: <span id="id_chal"><?=$id_chal?></span>


		<?=$chal_details?>

		<?php include "challenge_detail_top_challenger.php"; ?>
		<?php include "list_challenger.php"; ?>

		
	</div>
</section>























<script type="text/javascript">
	$(document).ready(function(){
		$(".btn_set_reject").click(function(){
			var id = $(this).prop("id");
			var rid = id.split("__");
			var tipe_btn = rid[0];
			var id_chal_beatenby = rid[1];

			var score_for_player = 0;
			var gm_comment = '';

			if(tipe_btn=="btn_reject"){
				var x = confirm("Yakin untuk mereject Submit Challenge ini?\n\nid: "+id_chal_beatenby+"\n\n\nTekan OK untuk memberikan alasan reject!"); if(!x) return;

				gm_comment = prompt("Alasan reject dari Anda?", "Tidak sesuai dengan petunjuk Challenge");
				if(gm_comment.length==20) {alert("Reject dibatalkan karena kurang dari 20 huruf."); return;}
			}else{
				var min_point = $("#min_point").text();
				var max_point = $("#max_point").text();
				var new_score = prompt("Silahkan masukan score antara "+min_point+" s.d "+max_point+":",min_point);
				if(!new_score) return;
				new_score = parseInt(new_score);
				score_for_player = new_score;

				if(new_score<min_point || new_score>max_point){
					var z = confirm("Score dari Anda: "+new_score+", tidak dalam range point.\n\nRange point: "+min_point+" s.d "+max_point+"\n\n\nAnda ingin memberikan score diluar Range Point?");
					if(!z) return;

				}


				var apresiasi = prompt("Silahkan Anda apresiasi hasil karya Player ini!\n\nBerikan komentar dan motivasi Anda:", "Selamat kamu berhasil melaksanakan Challenge!");
				if(!apresiasi) return;
				gm_comment = apresiasi;

			}


			var link_ajax = "ajax/ajax_set_reject_challenge.php"
			+"?id_chal_beatenby="+id_chal_beatenby
			+"&tipe_btn="+tipe_btn
			+"&score_for_player="+score_for_player
			+"&gm_comment="+gm_comment
			+'';
			$.ajax({
				url:link_ajax,
				success:function(a){
					var ra = a.split("__");
					if(parseInt(ra[0])==1){
						$("#btn_set__"+id_chal_beatenby).fadeOut();
						$("#btn_reject__"+id_chal_beatenby).fadeOut();
						$("#score_for_player__"+id_chal_beatenby).text(ra[2]);
					}else{
						alert(a)
					}
				}
			})
		})

		

		$(".btn_claim_rewards").click(function(){
			var id = $(this).prop("id");
			var rid = id.split("__");
			var id_chal_beatenby = rid[1];

			var link_ajax = "ajax/ajax_claim_challenge_rewards.php"
			+"?id_chal_beatenby="+id_chal_beatenby
			+'';
			$.ajax({
				url:link_ajax,
				success:function(a){

					var ra = a.split("__");
					if(parseInt(ra[0])==1){
						$("#btn_claim_rewards__"+id_chal_beatenby).prop("disabled",true);
						$("#btn_hapus_link__"+id_chal_beatenby).prop("disabled",true);
						$("#btn_claim_rewards__"+id_chal_beatenby).text("Claimed");
						alert("Claim Sukses!!\n\n"+ra[1]+" LP berhasil ditambahkan untuk Point kamu.");

					}else{
						alert(a)
					}
				}
			})
		})

		$(".btn_hapus_link").click(function(){
			var x = confirm("Yakin untuk menghapus Bukti Link yang sudah kamu Submit?"); if(!x) return;
			var id = $(this).prop("id");
			var rid = id.split("__");
			var id_chal_beatenby = rid[1];

			var link_ajax = "ajax/ajax_hapus_bukti_challenge.php"
			+"?id_chal_beatenby="+id_chal_beatenby
			+'';
			$.ajax({
				url:link_ajax,
				success:function(a){
					var ra = a.split("__");
					if(parseInt(ra[0])==1){
						alert("Hapus Sukses!!\n\n"+ra[1]+" Silahkan kamu boleh Submit ulang link bukti Challenge!.");
						location.reload();

					}else{
						alert(a)
					}
				}
			})
		})

		// set_all_unverified
		$("#set_all_unverified").click(function(){

			let ok = prompt("Perhatian!! \n\nPastikan Anda sudah melihat semua hasil Submit Challenge karena akan dilakukan auto-verifikasi dengan nilai yang sama untuk seluruh unverified Submit Challenge. \n\nJika Anda yakin silahkan ketik OK");
			if(ok.trim().toLowerCase() != 'ok') return;


			var score_for_player = 0;
			var gm_comment = '';


			var min_point = $("#min_point").text();
			var max_point = $("#max_point").text();
			var new_score = prompt("Silahkan masukan score antara "+min_point+" s.d "+max_point+":",min_point);
			if(!new_score) return;
			new_score = parseInt(new_score);
			score_for_player = new_score;

			if(new_score<min_point || new_score>max_point){
				var z = confirm("Score dari Anda: "+new_score+", tidak dalam range point.\n\nRange point: "+min_point+" s.d "+max_point+"\n\n\nAnda ingin memberikan score diluar Range Point?");
				if(!z) return;

			}


			var apresiasi = prompt("Silahkan Anda apresiasi hasil karya Player ini!\n\nBerikan komentar dan motivasi Anda:", "Autoverified by system.");
			if(!apresiasi) return;
			gm_comment = apresiasi;

			let id_chal = $('#id_chal').text();

			var link_ajax = "ajax/ajax_set_all_challenge.php"
			+"?score_for_player="+score_for_player
			+"&gm_comment="+gm_comment
			+"&id_chal="+id_chal
			+'';

			// alert(link_ajax); return;

			$.ajax({
				url:link_ajax,
				success:function(a){
					alert(a);
					if(a.trim()=='sukses')location.reload();
				}
			})




		})
	})
</script>