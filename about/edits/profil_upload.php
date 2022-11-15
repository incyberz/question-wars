<?php 
$pesan_upload_profil = '';

// echo "<pre>";
// echo "$folder_uploads\n";
// echo "$avatar_id\n";
// echo var_dump($_FILES);
// echo "</pre>";

$upload_path = "../uploads/$folder_uploads";
if(!file_exists($upload_path)){
	if(mkdir($upload_path)){
		echo "<div class='alert alert-success'>Direktori baru telah dibuat: $upload_path</div>";
	}else{
		die("<div class='alert alert-danger'>Tidak dapat membuat direktori upload: $upload_path</div>");
	}
}

$profil_na = "../uploads/_profile_na.png";
$profil_utama = "$upload_path/_profile.jpg";
$profil_publik = "$upload_path/_publik_profile.jpg";

if(isset($_FILES['profil_utama']) or isset($_FILES['profil_publik'])){
	
	$img = '';
	$s = "INSERT INTO tb_upload_tmp (nickname,filename) VALUES ('$cnickname', ";
	$pesan_exist = "Previous upload not exist.";


	# =================================================
	# PROFIL UTAMA
	# =================================================
	if(isset($_FILES['profil_utama'])){
		$img = $_FILES['profil_utama'];
		$target = $profil_utama;
		if(file_exists($profil_utama)){
			$profil_utama_tmp = "$upload_path/_tmp".date("ymdHis")."_profile.jpg";
			rename($profil_utama, $profil_utama_tmp);
			$s.="'$profil_utama_tmp')";
			$pesan_exist = "Previous profile upload will be replaced.";
		}else{ $s = '';}
	}

	# =================================================
	# PROFIL PUBLIK
	# =================================================
	if(isset($_FILES['profil_publik'])){
		$img = $_FILES['profil_publik'];
		$target = $profil_publik;
		if(file_exists($profil_publik)){
			$profil_publik_tmp = "$upload_path/_tmp".date("ymdHis")."_public_profile.jpg";
			rename($profil_publik, $profil_publik_tmp);
			$s.="'$profil_publik_tmp')";
			$pesan_exist = "Previous public_profile upload will be replaced.";
		}else{ $s = '';}
	}



	# =================================================
	# TMP SAVED
	# =================================================
	// echo "<hr>$s<hr>";
	if($s==""){
		$pesan_save_tmp = "Tmp-saved... skipped";
	}else{
		if(mysqli_query($cn,$s)){
			$pesan_save_tmp = "Tmp-saved... OK";
		}else{
			$pesan_save_tmp = "<span style='color:red'>Tmp-saved error:</span> ".mysqli_error($cn);
		}
	}



	# =============================================
	# Check Size and Extention 
	# =============================================
	$tmp_name = $img['tmp_name'];
	$image_size = round($img['size']/1000,0);


	# =============================================
	# Check Image Dimension 
	# =============================================
	$image_info = getimagesize($tmp_name);
	$image_width = $image_info[0];
	$image_height = $image_info[1];
	$image_ratio = round($image_height/$image_width,2);

	$err_ratio = '';
	$p = '';
	$image_height_show = "$image_height pixel";

	if($image_ratio>1.5){
		$err_ratio = "Unfit Rasio. Gambar Anda terlalu tinggi. Silahkan Crop height nya!";
		$image_height_show = "<span style='color:red'>$image_height pixel</span>";
	}else if($image_ratio<1){
		$err_ratio = "Unfit Rasio. Gambar Anda Landscape. Silahkan cari gambar yang berdiri!";
	}else if(move_uploaded_file($tmp_name, $target)){
		$p = "<span style='color:green'>Upload Success.</span>";
	}else{
		$p = "<span style='color:red'>Cannot move to target file.</span>";
	}

	$err_ratio_show = $err_ratio!="" ? "<span style='color:red'>- $err_ratio</span>" : "<span style='color:green'>- Ratio OK</span>";

	# =============================================
	# Upload Process Output 
	# =============================================
	echo "<div class='alert alert-success'>
		Upload processing...
		<small><i>
		<br>~ Size: $image_size kb
		<br>~ Width: $image_width pixel
		<br>~ Height: $image_height_show
		<br>~ Image Ratio H/W = $image_ratio $err_ratio_show 
		<br>~ folder_uploads: $folder_uploads
		<br>~ $pesan_exist
		<br>~ $pesan_save_tmp
		</i></small>
		<hr>
		<div>$p</div>
	</div>
	";



}


if(!file_exists($profil_utama)) $profil_utama = $profil_na;
if(!file_exists($profil_publik)) $profil_publik = $profil_na;


?>

<div id="blok_profil_upload" class="blok">
	<div class="content_list">

		<h4>Profile Upload</h4>

		<?=$pesan_upload_profil?>

		<style type="text/css">
			#tb_upload_profil td{
				padding: 15px;
			}

			.img_profil_upload{
				object-fit: cover;
				/*width: 50px;*/
				/*height: 50px;*/
				border-radius: 75px;
				border: solid 5px white;
				box-shadow: 0px 0px 5px gray;
				transition: .2s;
			}

			.img_profil_upload:hover{
				transform: scale(1.2);
			}
		</style>


		<table class="table table-hover" id="tb_upload_profil">
			<tr>
				<td align="center">
					<img class="img_profil_upload" src="<?=$profil_utama ?>" width="150px" height="150px">

				</td>
				<td>
					<form method="post" enctype="multipart/form-data">
						<div><p><b>Private Profile</b></p></div>
						<input type="file" class=" form-control input_file" name="profil_utama" id="profil_utama" accept="image/jpeg">
						<script type="text/javascript">
							let f = document.getElementById("profil_utama");
							f.onchange = function() {
								if(this.files[0].size < 50000 || this.files[0].size > 206000){
								  alert("Ukuran File terlalu besar/kecil. Silahkan Anda cari ukuran 50 s.d 200kb.");
								  this.value = '';
								}
							};
						</script>
						<small>Foto ini bersifat private (tidak ditampilkan ke publik). Mohon pakai foto yang jelas dan sopan! Ukuran 50 s.d 200kb.</small>
						<div style="margin-top:5px">
							<button class="btn btn-primary btn-sm" disabled="" id="btn_upload_profil_utama">Upload</button>
						</div>
					</form>
				</td>
			</tr>
			<tr>
				<td align="center">
					<img class="img_profil_upload" src="<?=$profil_publik ?>" width="150px" height="150px">

				</td>
				<td>
					<form method="post" enctype="multipart/form-data">
						<div><p><b>Profil untuk Publik</b></p></div>
						<input type="file" class="form-control input_file" name="profil_publik" id="profil_publik" accept="image/jpeg">
						<script type="text/javascript">
							let g = document.getElementById("profil_publik");
							g.onchange = function() {
								if(this.files[0].size < 10000 || this.files[0].size > 306000){
								  alert("Ukuran File terlalu besar/kecil. Silahkan Anda cari ukuran 10 s.d 300kb.");
								  this.value = '';
								}
							};
						</script>
						<small><i>Foto ini hanya akan ditampilkan secara publik. Kamu boleh pakai foto pose bebas! Size 10 s.d 300kb</i></small>
						<div style="margin-top:5px">
							<button class="btn btn-primary btn-sm" disabled="" id="btn_upload_profil_publik">Upload</button>
						</div>
					</form>
				</td>
			</tr>

			<tr>
				<td align="center"><b>Opsi Avatar</b></td>
				<td>

					<?php $ch_type = $avatar_id=="" ? "" : "checked"; ?>
					<?php $display_type = $avatar_id=="" ? "none" : ''; ?>

					<label><input type="checkbox" id="avatar_toggle" <?=$ch_type ?>> Gunakan Avatar untuk Publik</label>

					<style type="text/css">
						#blok_avatars{
							display: flex; 
							margin: 15px 0;
							border: solid 1px #ccc;
							padding: 10px;
							border-radius: 5px;
							flex-wrap: wrap;
						}

						.avatar{
							margin: 5px 5px 5px 0;
							cursor: pointer;
							transition: .2s;
							border-radius: 25px;
							opacity: 75%;
						}

						.active_avatar{
							border: solid 2px blue;
							opacity: 100%;
						} 

						.avatar:hover{
							transform: scale(1.2);
							border: solid 3px red;
							opacity: 100%;
						}
					</style>

					<div id="blok_avatars" style="display: <?=$display_type?>;">
						<?php for ($i=1; $i <= 12 ; $i++){

							$g = strtolower($gender);
							$class_av = $avatar_id=="avatar-$g$i" ? "active_avatar" : '';
							echo "
							  <img class='avatar $class_av' id='avatar-$g$i' src='../avatars/$g/avatar-$g$i.png' width='50px' height='50px'>
							";
						}
						?>
					</div>
				</td>
			</tr>

		</table>

	</div>
</div>




