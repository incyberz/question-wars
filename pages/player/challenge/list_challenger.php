<div class="wadah"> 
    <div style="margin-bottom:10px">Challenge ini telah dilaksanakan oleh:</div>


    <style>
	.beater_row {font-size: 10pt;padding: 15px; margin: 0; border: solid 1px #ccc;}
	.beater_col td{padding: 6px; text-align: center; vertical-align: middle;}
	</style>

	<?php
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
	$limit_from = ($page-1)*10;


	$s = "SELECT 1 from tb_chal_beatenby where id_chal = $id_chal and approved_by is null";
	$q = mysqli_query($cn, $s) or die("Error @chal_details#0. ".mysqli_error($cn));
	$jumlah_chal_unver = mysqli_num_rows($q);

	$o_by = $cadmin_level>=2 ? "approved_by " : " a.score_for_player desc ";

	$s = "SELECT a.*,b.nickname,b.nama_player,b.folder_uploads,
			(select nama_player from tb_player WHERE nickname=approved_by) as approved_by_name, 
			(SELECT count(1) FROM tb_chal_beatenby where id_chal=$id_chal AND nickname='$cnickname') as punyaku 
			from tb_chal_beatenby a 
			join tb_player b on a.beaten_by=b.nickname 
			where a.id_chal = $id_chal 
			order by punyaku desc, $o_by 
			";
	// die($s);
	$q = mysqli_query($cn, $s) or die("Error @chal_details#1. ".mysqli_error($cn));
	$jumlah_rows = mysqli_num_rows($q);

	$limit_for_gm = $jumlah_chal_unver<10 ? 10 : $jumlah_chal_unver;
	$limit = $cadmin_level==1 ? "	limit $limit_from, 10" : "	limit $limit_from, $limit_for_gm";
	$s .= $limit;
	// die($s);
	$q = mysqli_query($cn, $s) or die("Error @chal_details#2. ".mysqli_error($cn));

	if (mysqli_num_rows($q)==0) {
	    echo "<tr><td colspan=5>Belum ada yang mengerjakan</td></tr>";
	} else {
	    $i = 0;
	    // $isi_csv .= "\"date_beaten\",\"nickname_beater\",\"nama_beater\",\"score_for_player\",\"proof_link\"\n";
	    while ($d=mysqli_fetch_assoc($q)) {
	        $i++;
	        $id_chal_beatenby = $d['id_chal_beatenby'];
	        $beaten_by = $d['beaten_by'];
	        $nickname_beater = $d['nickname'];
	        $nama_beater = ucwords(strtolower($d['nama_player']));
	        $date_beaten = $d['date_beaten'];
	        $date_approved = $d['date_approved'];
	        $score_for_player = $d['score_for_player'];
	        $approved_by = $d['approved_by'];
	        $approved_by_name = $d['approved_by_name'];
	        $is_claimed = $d['is_claimed'];
	        $proof_link = $d['proof_link'];
	        $gm_comment = $d['gm_comment'];
	        $folder_uploads = $d['folder_uploads'];
	        $pesan_untuk_gm_show = $d['pesan_untuk_gm']=='' ? '' : '<small>pesan: '.$d['pesan_untuk_gm'].'</small>';

	        $id_skill_level = $d['id_skill_level'];
	        $estimasi_poin = $d['estimasi_poin'];

	        # ===========================================
	        # PUBLIC PROFILE BEATER
	        # ===========================================
	        $foto_profil = '';
	        $path_public_profile = "uploads/$folder_uploads/_public_profile.jpg";
	        if (file_exists($path_public_profile)) {
	            $foto_profil = "<div><img class='foto_profil' src='$path_public_profile'></div>";
	        }


	        # ===========================================
	        # PRIVATE PROFILE FOR GM
	        # ===========================================
	        if ($cadmin_level==2) {
	            $path_profile = "uploads/$folder_uploads/_profile.jpg";
	            if (file_exists($path_profile)) {
	                $foto_profil = "<div><img class='foto_profil' src='$path_profile'></div>";
	            }
	        }

	        # ===========================================
	        # FOR GM
	        # ===========================================
	        if ($cadmin_level>=2) {
	            // $isi_csv .= "\"$date_beaten\",\"$nickname_beater\",\"$nama_beater\",\"$score_for_player\",\"$proof_link\"\n";
	            $nama_beater = "$nickname_beater - <span id='nama_beater__$id_chal_beatenby'>$nama_beater</span>";
	        }


	        $date_approved = date("d-m-y", strtotime($date_approved));
	        $date_beaten = date("d-m-y H:i", strtotime($date_beaten));

	        $sty_tr = '';
	        if ($beaten_by==$cnickname) {
	            $sty_tr = " style='background-color:green; padding:15px 0px' ";
	        }

	        $estimasi_poin_show = $estimasi_poin>0 ? "<div>Estimasi poin: ".number_format($estimasi_poin, 0)."</div>" : '';
	        $estimasi_poin_show .= "<span id='estimasi_poin__$id_chal_beatenby' class='hideit'>$estimasi_poin</span>";

	        $score_for_player_show = $score_for_player==0 ? '<i>(belum ada)</i>' : number_format($score_for_player, 0).' LP';
	        $scores = "<span id='score_for_player__$beaten_by"."__$id_chal_beatenby'>$score_for_player_show</span>$estimasi_poin_show";
	        if ($is_claimed==1) {
	            $scores .= "<span class='badge badge-success'>Claimed</span>";
	        }

	        # =========================================================
	        # BUTTON CLAIM OWN REWARD
	        # =========================================================
	        if ($beaten_by==$cnickname and $score_for_player>0 and $is_claimed==0) {
	            $scores .= "<div><button class='btn btn-primary btn-sm btn-block btn_claim_rewards' id='btn_claim_rewards__$id_chal_beatenby'>Claim Challenge Rewards</button></div>";
	        }
	        # =========================================================


	        $approved = "<span class='badge badge-success' id='approved_by__$id_chal_beatenby'>Approved by: $approved_by_name</span> <small>at $date_approved</small>";
	        if ($approved_by=="") {
	            $approved = "<span class='badge badge-info' id='approved_by__$id_chal_beatenby'>Belum diperiksa</span>";
	            // $scores .= "<span class='badge badge-warning' id='score_for_player__$beaten_by"."__$id_chal_beatenby'>Unknown</span>";
	        }



	        # =========================================================
	        # GM ONLY :: APPROVE | SET | REJECT | UNDO
	        # =========================================================
	        if ($cadmin_level==2 or $cadmin_level==9) {
	            $hide_btn = ['hideit','hideit','hideit','hideit'];
	            if ($approved_by=="") {
	                # =========================================================
	                # BELUM DI APPROVE
	                # =========================================================
	                if ($id_skill_level!='' and $estimasi_poin>0) {
	                    $hide_btn[0] = '';
	                }
	                $hide_btn[1] = '';
	                $hide_btn[2] = '';
	            } else {
	                # =========================================================
	                # SUDAH APPROVE
	                # =========================================================
	                $hide_btn[3] = '';
	            }
	            $scores.= '<div>';
	            $scores.= "<button id='btn_approve__$beaten_by"."__$id_chal_beatenby' class='$hide_btn[0] btn_set_reject mr-1 mt-1 btn btn-success btn-sm'>Approve</button>";
	            $scores.= "<button id='btn_set__$beaten_by"."__$id_chal_beatenby' class='$hide_btn[1] btn_set_reject mr-1 mt-1 btn btn-primary btn-sm'>Set</button>";
	            $scores.= "<button id='btn_reject__$beaten_by"."__$id_chal_beatenby' class='$hide_btn[2] btn_set_reject mr-1 mt-1 btn btn-danger btn-sm'>Reject</button>";
	            $scores.= "<button id='btn_undo__$beaten_by"."__$id_chal_beatenby' class='$hide_btn[3] btn_set_reject mr-1 mt-1 btn btn-warning btn-sm btn-block'>Undo Approve</button>";
	            $scores.= '</div>';
	        }




	        # =========================================================
	        # LINK | LIKE | DISLIKE
	        # =========================================================
	        $img_proof = "<img src='icon yt drive zzz' width='20px' height='20px'>";
	        $img_like = "<img src='like zzz' width='20px' height='20px'>";
	        $img_dislike = "<img src='dislike zzz' width='20px' height='20px'>";

	        $img_proof = "Link"; //zzz
	        $img_like = '';
	        $img_dislike = '';

	        # =========================================================
	        # HAPUS OWN LINK
	        # =========================================================
	        $btn_hapus = '';
	        if ($beaten_by==$cnickname and $is_claimed==0) {
	            $btn_hapus .= "<br><button class='btn btn-danger btn-sm btn_hapus_link' id='btn_hapus_link__$id_chal_beatenby'>Hapus Link</button>";
	        }
	        # =========================================================


	        # =========================================================
	        # GM COMMENT
	        # =========================================================
	        if ($gm_comment=='') {
	            $gm_comment = 'no comment';
	        }

	        if ($cadmin_level>1) {
	            $scores .= "<div class='gm_comment' id='gm_comment__$beaten_by"."__$id_chal_beatenby'>$gm_comment</div>";
	        }


	        # =========================================================
	        # NAMA DAN SYARAT SKILL LEVEL
	        # =========================================================
	        $nama_skill_level_show = '';
	        $syarat_skill_level_show = '';
	        if ($id_skill_level!='') {
	            $s2 = "SELECT * from tb_chal_skill_level WHERE id_skill_level=$id_skill_level";
	            $q2 = mysqli_query($cn, $s2) or die(mysqli_error($cn));
	            if (mysqli_num_rows($q2)!=1) {
	                die("Data skill level tidak ditemukan. id_skill_level:$id_skill_level");
	            }
	            $d2 = mysqli_fetch_assoc($q2);
	            $nama_skill_level = $d2['nama_skill_level'];
	            $syarat_skill_level = $d2['syarat_skill_level'];

	            $nama_skill_level_show = "<div><b>$nama_skill_level</b></div>";
	            $syarat_skill_level_show = "<div>$syarat_skill_level</div>";
	        }


	        # =========================================================
	        # FINAL OUTPUT
	        # =========================================================
	        echo "
					<div class='row beater_row' $sty_tr>
						<div class='col-lg-3 beater_col'>
							<span style='font-size:12pt;color:yellow'><a href='about/?nickname=$nickname_beater'>$foto_profil $nama_beater</a></span> <small>at $date_beaten</small>
						</div>
						<div class='col-lg-3 beater_col'>
							$nama_skill_level_show 
							$syarat_skill_level_show 
							Bukti: 
							<a href='$proof_link' target='_blank'>
								$img_proof
							</a> 
							<a href='#' class='not_ready'>
								$img_like
							</a> 
							<a href='#' class='not_ready'>
								$img_dislike
							</a> 
							$btn_hapus
						</div>
						<div class='col-lg-3 beater_col'>
							$approved
							<div class='mt-2'>$pesan_untuk_gm_show</div>
						</div>
						<div class='col-lg-3 beater_col'>
							Rewards: $scores
						</div>
					</div>
					";
	    }
	}


	# ====================================
	# NAVIGASI PAGE
	# ====================================
	for ($i=1; $i < ($jumlah_rows/10)+1 ; $i++) {
	    if ($i==$page) {
	        echo " [ $i ] | ";
	    } else {
	        echo "<a href='?chaldet&id_chal=$id_chal&page=$i'>$i</a> | ";
	    }
	}


	# ====================================
	# OUTPUT CSV FOR GM
	# ====================================
	if ($cadmin_level>=2) {
	    $beater_list = "beater_list.csv";

	    // echo "<hr>
	    // <a href='$beater_list' class='btn btn-success btn-sm'>Download Beater List</a>
	    // <button class='btn btn-primary btn-sm' id='set_all_unverified'>Set All Unverified</button>
	    // ";

	    echo "<hr>
				<button class='btn btn-primary btn-sm' id='set_all_unverified'>Set All Unverified</button> 
				";

	    // $myfile = fopen($beater_list, "w+") or die("Tidak bisa mengakses file: $file_name");
	    // fwrite($myfile, $isi_csv);
	    // fclose($myfile);
	}
	?>
</div>










<script type="text/javascript">
	$(document).ready(function(){
		let gm_auto_comment = 'Your skill level has been approved.';

		$(".btn_set_reject").click(function(){
			let id = $(this).prop("id");
			let rid = id.split("__");
			let tipe_btn = rid[0];
			let nickname = rid[1];
			let id_chal_beatenby = rid[2];

			let score_for_player = 0;
			let gm_comment = '';

			let estimasi_poin = parseInt($('#estimasi_poin__'+id_chal_beatenby).text());
			let nama_beater = $('#nama_beater__'+id_chal_beatenby).text();

			if(tipe_btn=="btn_reject"){
				let x = confirm("Yakin untuk mereject Submit Challenge ini?\n\nid: "+id_chal_beatenby+"\n\n\nTekan OK untuk memberikan alasan reject!"); if(!x) return;

				gm_comment = prompt("Alasan reject dari Anda?", "Tidak sesuai dengan petunjuk Challenge");
				if(gm_comment.length==20) {alert("Reject dibatalkan karena kurang dari 20 huruf."); return;}
			}else if(tipe_btn=="btn_set"){
				let min_point = $("#min_point").text();
				let max_point = $("#max_point").text();
				let new_score = prompt("Silahkan masukan score antara "+min_point+" s.d "+max_point+":",min_point);
				if(!new_score) return;
				new_score = parseInt(new_score);
				score_for_player = new_score;

				if(new_score<min_point || new_score>max_point){
					let z = confirm("Score dari Anda: "+new_score+", tidak dalam range point.\n\nRange point: "+min_point+" s.d "+max_point+"\n\n\nAnda ingin memberikan score diluar Range Point?");
					if(!z) return;
				}

				let apresiasi = prompt("Silahkan Anda apresiasi hasil karya Player ini!\n\nBerikan komentar dan motivasi Anda:", "Selamat kamu berhasil melaksanakan Challenge!");
				if(!apresiasi) return;
				gm_comment = apresiasi;

			}else if(tipe_btn=="btn_approve"){
				// let x = confirm(`Yakin untuk approve ${estimasi_poin} LP untuk ${nama_beater}?`); 
				// if(!x) return;
				score_for_player = estimasi_poin;
				gm_comment = gm_auto_comment;
			}else if(tipe_btn=="btn_undo"){
				let x = confirm(`Yakin undo approve bukti challenge milik ${nama_beater}?`); 
				if(!x) return;
			}


			let link_ajax = "ajax/ajax_set_reject_challenge.php"
			+"?id_chal_beatenby="+id_chal_beatenby
			+"&tipe_btn="+tipe_btn
			+"&score_for_player="+score_for_player
			+"&gm_comment="+gm_comment
			+'';
			$.ajax({
				url:link_ajax,
				success:function(a){
					let ra = a.split("__");
					if(ra[0]=='sukses'){
						if(tipe_btn!="btn_undo"){
							$("#btn_approve__"+nickname+"__"+id_chal_beatenby).hide();
							$("#btn_set__"+nickname+"__"+id_chal_beatenby).hide();
							$("#btn_reject__"+nickname+"__"+id_chal_beatenby).hide();
							$("#btn_undo__"+nickname+"__"+id_chal_beatenby).fadeIn();
							$("#score_for_player__"+nickname+"__"+id_chal_beatenby).text(ra[2]);
							$("#gm_comment__"+nickname).text(gm_comment);
							$("#approved_by__"+id_chal_beatenby).hide();
						}else{
							if(estimasi_poin>0){
								$("#btn_approve__"+nickname+"__"+id_chal_beatenby).fadeIn();
							}else{
								alert('estimasi_poin:'+estimasi_poin);
							}
							$("#btn_set__"+nickname+"__"+id_chal_beatenby).fadeIn();
							$("#btn_reject__"+nickname+"__"+id_chal_beatenby).fadeIn();
							$("#btn_undo__"+nickname+"__"+id_chal_beatenby).hide();
							$("#score_for_player__"+nickname+"__"+id_chal_beatenby).html('<i>(belum ada)</i>');
							$("#gm_comment__"+nickname).text('not approved');
							$("#btn_claim_rewards__"+id_chal_beatenby).hide();
						}
					}else{
						alert(a)
					}
				}
			})
		})

		

		$(".btn_claim_rewards").click(function(){
			let id = $(this).prop("id");
			let rid = id.split("__");
			let id_chal_beatenby = rid[1];

			let link_ajax = "ajax/ajax_claim_challenge_rewards.php"
			+"?id_chal_beatenby="+id_chal_beatenby
			+'';
			$.ajax({
				url:link_ajax,
				success:function(a){

					let ra = a.split("__");
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
			let x = confirm("Yakin untuk menghapus Bukti Link yang sudah kamu Submit?"); if(!x) return;
			let id = $(this).prop("id");
			let rid = id.split("__");
			let id_chal_beatenby = rid[1];

			let link_ajax = "ajax/ajax_hapus_bukti_challenge.php"
			+"?id_chal_beatenby="+id_chal_beatenby
			+'';
			$.ajax({
				url:link_ajax,
				success:function(a){
					let ra = a.split("__");
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


			let score_for_player = 0;
			let gm_comment = '';


			let min_point = $("#min_point").text();
			let max_point = $("#max_point").text();
			let new_score = prompt("Silahkan masukan score antara "+min_point+" s.d "+max_point+":",min_point);
			if(!new_score) return;
			new_score = parseInt(new_score);
			score_for_player = new_score;

			if(new_score<min_point || new_score>max_point){
				let z = confirm("Score dari Anda: "+new_score+", tidak dalam range point.\n\nRange point: "+min_point+" s.d "+max_point+"\n\n\nAnda ingin memberikan score diluar Range Point?");
				if(!z) return;

			}


			let apresiasi = prompt("Silahkan Anda apresiasi hasil karya Player ini!\n\nBerikan komentar dan motivasi Anda:", "Autoverified by system.");
			if(!apresiasi) return;
			gm_comment = apresiasi;

			let id_chal = $('#id_chal').text();

			let link_ajax = "ajax/ajax_set_all_challenge.php"
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

		$(".gm_comment").click(function(){
			let gm_comment = $(this).text();
			let tid = $(this).prop("id");
			let rid = tid.split("__");
			let nickname = rid[1];
			let id_chal_beatenby = rid[2];

			let new_comment = prompt('Komentar baru:',gm_comment);
			if(!new_comment || new_comment.trim()==gm_comment.trim()){
				return;
			}

			let link_ajax = "ajax/ajax_update_gm_comment.php"
			+"?id_chal_beatenby="+id_chal_beatenby
			+"&nickname="+nickname
			+"&new_comment="+new_comment
			+'';
			$.ajax({
				url:link_ajax,
				success:function(a){
					if(a.trim()=='sukses'){
						$("#"+tid).text(new_comment);
					}else{
						alert(a)
					}
				}
			})
		})

	})
</script>