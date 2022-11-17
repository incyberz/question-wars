<div class="wadah"> 
    <div style="margin-bottom:10px">Challenge ini telah dilaksanakan oleh:</div>


    <style type="text/css">.beater_row {font-size: 10pt;padding: 15px; margin: 0; border: solid 1px #ccc;}</style>
			<style type="text/css">.beater_col td{padding: 6px; text-align: center; vertical-align: middle;}</style>

			<?php
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

			$s .= "	limit $limit_from, 10";
			// die($s);
			$q = mysqli_query($cn, $s) or die("Error @chal_details#2. ".mysqli_error($cn));

			// echo "<hr><pre>";
			// echo var_dump($cadmin_level);
			// echo "</pre><hr>";

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
			            $nama_beater = "$nickname_beater - $nama_beater";
			        }


			        $date_approved = date("d-m-y", strtotime($date_approved));
			        $date_beaten = date("d-m-y H:i", strtotime($date_beaten));

			        $sty_tr = '';
			        if ($beaten_by==$cnickname) {
			            $sty_tr = " style='background-color:green; padding:15px 0px' ";
			        }

			        $scores = "<span id='score_for_player__$id_chal_beatenby'>$score_for_player</span> LP<br><span class='badge badge-info'>Unclaimed</span>";
			        if ($is_claimed==1) {
			            $scores = "<span id='score_for_player__$id_chal_beatenby'>$score_for_player</span> LP<br><span class='badge badge-success'>Claimed</span>";
			        }

			        # =========================================================
			        # BUTTON CLAIM OWN REWARD
			        # =========================================================
			        if ($beaten_by==$cnickname and $score_for_player>0 and $is_claimed==0) {
			            $scores = "<span id='score_for_player__$id_chal_beatenby'>$score_for_player</span> LP<br><button class='btn btn-primary btn-sm btn-block btn_claim_rewards' id='btn_claim_rewards__$id_chal_beatenby'>Claim Challenge Rewards</button>";
			        }
			        # =========================================================


			        $approved = "<span class='badge badge-success' id='approved_by__$id_chal_beatenby'>Approved by: $approved_by_name</span> <small>at $date_approved</small>";
			        if ($approved_by=="") {
			            $approved = "<span class='badge badge-info' id='approved_by__$id_chal_beatenby'>Belum diperiksa</span>";
			            // $scores .= "<span class='badge badge-warning' id='score_for_player__$id_chal_beatenby'>Unknown</span>";
			        }

			        if ($cadmin_level==2 or $cadmin_level==9) {
			            $btn_disabled = '';
			            if ($approved_by!="") {
			                $btn_disabled = "disabled";
			            }
			            $scores.= " | <button id='btn_set__$id_chal_beatenby' class='btn_set_reject btn btn-primary btn-sm' $btn_disabled>Set</button>";
			            $scores.= "  <button id='btn_reject__$id_chal_beatenby' class='btn_set_reject btn btn-danger btn-sm' $btn_disabled>Reject</button>";
			        }


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
			        if ($gm_comment!="") {
			            $scores .= "<br><small>$gm_comment</small>";
			        }

			        echo "
					<div class='row beater_row' $sty_tr>
						<div class='col-lg-3 beater_col'>
							<span style='font-size:12pt;color:yellow'><a href='about/?nickname=$nickname_beater'>$foto_profil $nama_beater</a></span> <small>at $date_beaten</small>
						</div>
						<div class='col-lg-3 beater_col'>Bukti: 
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