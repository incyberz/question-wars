<?php 
session_start();

$cnickname = isset($_SESSION['nickname']) ? $_SESSION['nickname'] : die("Silahkan Login dahulu.<hr><a href='../'>Login QWars</a>");
$cadmin_level = isset($_SESSION['admin_level']) ? $_SESSION['admin_level'] : die("Silahkan Login dahulu.");

include "about_var.php";

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Player Edit</title>
	<link rel="stylesheet" type="text/css" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
	<script src="../assets/vendor/jquery/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="edit.css">
	<style type="text/css">
		.db_var{
			display: none;
		}
	</style>
</head>
<body>
	<div class="container">

		<div class="row">
			<div class="col-lg-3 cv_left text-center">
				<!-- <a href="about_player.php" onclick="return confirm('Go back to About Page?')"> -->
				<a href="index.php">
					<img id="preview_btn" src="../assets/img/icons/btn_preview.png" height="30px">
				</a>
			</div>
			<div class="col-lg-9">
				<p id="top_header"><span id="judul">Edit Mode</span> :: CV <?=$cnama_player ?></p>
			</div>

			<div class="col-lg-3 cv_left">
				<p class="link_menu" id="profil_upload">Foto Profil</p>
				<p class="link_menu" id="tentang_saya">Tentang Saya</p>
				<p class="link_menu" id="data_pribadi">Data Pribadi</p>
				<p class="link_menu" id="kontak">Kontak</p>
				<p class="link_menu" id="skill_bahasa">Skill Bahasa</p>
				<p class="link_menu" id="skill_komputer">Skill Komputer</p>
				<p class="link_menu" id="skill_lainnya">Skill Lainnya</p>
				<p class="link_menu" id="hobbies">Hobbies</p>
				<p class="link_menu" id="cita-cita">Cita-cita</p>
				<p class="link_menu" id="riwayat_pendidikan">Riwayat Pendidikan</p>
				<p class="link_menu" id="riwayat_pekerjaan">Riwayat Pekerjaan</p>
				<p class="link_menu" id="riwayat_organisasi">Riwayat Organisasi</p>
				<p class="link_menu" id="riwayat_sertifikasi">Sertifikasi</p>
				<p class="link_menu" id="favorites">Favorit</p>
				<p class="link_menu" id="gallery">Gallery</p>
				<p class="link_menu" id="testimony">Testimony</p>
				<div class="text-center"><button id="btn_show_menu" class="btn btn-success btn-sm">Show Menu</button></div>
			</div>
			<div class="col-lg-9">


				<!-- ===================================================== -->
				<!-- INCLUDE EDITS PAGE -->
				<!-- ===================================================== -->
				<?php 
				include "edits/profil_upload.php";

				include "edits/tentang_saya.php";
				include "edits/data_pribadi.php";
				include "edits/kontak.php";
				include "edits/skill_bahasa.php";
				include "edits/skill_komputer.php";
				include "edits/skill_lainnya.php";
				include "edits/hobbies.php";
				include "edits/cita-cita.php";

				include "edits/riwayat_pendidikan.php";
				include "edits/riwayat_pekerjaan.php";
				include "edits/riwayat_organisasi.php";
				include "edits/riwayat_sertifikasi.php";

				include "edits/favorites.php";
				include "edits/gallery_upload.php";
				include "edits/testimony_manager.php";
				?>
			</div>
		</div>

		
	</div>


</body>
</html>









































<script type="text/javascript">
	$(document).ready(function(){
		$(".link_menu").click(function(){
			// $(".link_menu").removeClass("active_menu");
			// $(this).addClass("active_menu");

			let id = $(this).prop("id");
			$(".blok").hide();
			$("#blok_"+id).fadeIn();

			$(".link_menu").hide();
			// $(this).fadeIn();
			$("#judul").text($(this).text());
			$("#btn_show_menu").fadeIn();

			document.cookie = "selected_menu="+id;

			// alert(document.cookie);

		})

		$("#btn_show_menu").click(function(){
			$(this).hide();
			$(".link_menu").fadeIn();
		})

		$(".visibility").click(function(){
			$(this).removeClass();
			switch($(this).val()){
				case "0": $(this).addClass("form-control set_only_me"); break;
				case "1": $(this).addClass("form-control set_fo"); break;
				case "2": $(this).addClass("form-control set_public"); break;
			}
		})



		$(".input_text").focusout(function(){
			let id = $(this).prop("id");
			let val = $(this).val().trim();
			let db_val = $("#db_"+id).val();

			if(val==db_val) return;
			if(id=="jumlah_saudara"){
				let anak_ke = parseInt($("#anak_ke").val());
				if(anak_ke>parseInt(val)){
					alert("anak_ke > jumlah_saudara \n\nSilahkan coba lagi!");
					$(this).val(anak_ke);
					return;
				}
			}

			// riwayat_pendidikan 
			// 0123456789012345678
			// makanan_favorit

			if(id.substring(0,18)=="riwayat_pendidikan"){
				let x = id.substring(18,19);
				val = $("#riwayat_pendidikan"+x+"1").val()+"__" 
							+$("#riwayat_pendidikan"+x+"2").val()+"__" 
							+$("#riwayat_pendidikan"+x+"3").val()+"__" 
							+$("#riwayat_pendidikan"+x+"4").val();
				id = "riwayat_pendidikan"+x;
			}

			if(id.substring(0,17)=="riwayat_pekerjaan"){
				let x = id.substring(17,18);
				val = $("#riwayat_pekerjaan"+x+"1").val()+"__" 
							+$("#riwayat_pekerjaan"+x+"2").val()+"__" 
							+$("#riwayat_pekerjaan"+x+"3").val()+"__" 
							+$("#riwayat_pekerjaan"+x+"4").val();
				id = "riwayat_pekerjaan"+x;
			}

			if(id.substring(0,18)=="riwayat_organisasi"){
				let x = id.substring(18,19);
				val = $("#riwayat_organisasi"+x+"1").val()+"__" 
							+$("#riwayat_organisasi"+x+"2").val()+"__" 
							+$("#riwayat_organisasi"+x+"3").val()+"__" 
							+$("#riwayat_organisasi"+x+"4").val();
				id = "riwayat_organisasi"+x;
			}

			if(id.substring(0,19)=="riwayat_sertifikasi"){
				let x = id.substring(19,20);
				val = $("#riwayat_sertifikasi"+x+"1").val()+"__" 
							+$("#riwayat_sertifikasi"+x+"2").val()+"__" 
							+$("#riwayat_sertifikasi"+x+"3").val()+"__" 
							+$("#riwayat_sertifikasi"+x+"4").val();
				id = "riwayat_sertifikasi"+x;
			}

			if(id.substring(0,15)=="makanan_favorit"){
				val = $("#makanan_favorit1").val()+"__" 
							+$("#makanan_favorit2").val()+"__" 
							+$("#makanan_favorit3").val();
				id = "makanan_favorit";
			}

			if(id.substring(0,15)=="minuman_favorit"){
				val = $("#minuman_favorit1").val()+"__" 
							+$("#minuman_favorit2").val()+"__" 
							+$("#minuman_favorit3").val();
				id = "minuman_favorit";
			}

			if(id.substring(0,13)=="warna_favorit"){
				val = $("#warna_favorit1").val()+"__" 
							+$("#warna_favorit2").val()+"__" 
							+$("#warna_favorit3").val();
				id = "warna_favorit";
			}





			let lz = "ajax_about/ajax_update_biodata.php?field="+id+"&isi="+val+'';
			// alert(lz); return;

			$.ajax({
				url:lz,
				success:function(h){
					if(h=="1__"){
						$("#db_"+id).val(val);
					}else{
						alert(h);
					}
				}
			})
		})


		$(".input_radio").click(function(){
			let id = $(this).prop("name");
			let val = $(this).val().trim();
			let db_val = $("#db_"+id).val();

			if(val=="" || val==db_val) return;

			let lz = "ajax_about/ajax_update_biodata.php?field="+id+"&isi="+val+'';
			// alert(lz); return;

			$.ajax({
				url:lz,
				success:function(h){
					if(h=="1__"){
						$("#db_"+id).val(val);
					}else{
						alert(h);
					}
				}
			})
		})


		$(".input_file").change(function(){
			let id = $(this).prop("name");
			let val = $(this).val().trim();

			if(val=="") return;
			$("#btn_upload_"+id).prop("disabled",false);

		})



		function update_avatar(avatar_id){
			let lz = "ajax_about/ajax_update_avatar.php?isi="+avatar_id;
			$.ajax({
				url:lz,
				success:function(h){
					if(h=="1__"){
						// alert("Avatar: "+avatar_id+" has been set. Silahkan refresh untuk melihat peruhaban.");
					}else{
						alert(h);
					}
				}
			})
		}

		$(".avatar").click(function(){
			$(".avatar").removeClass("active_avatar");
			$(this).addClass("active_avatar");

			update_avatar($(this).prop("id"));
		})

		$("#avatar_toggle").click(function(){
			let x = $(this).prop("checked");

			if(x){
				$("#blok_avatars").slideDown();
				alert("Silahkan klik salah satu avatar!");
			}else{
				$("#blok_avatars").slideUp();
				update_avatar("");
			}
		})

		// tampilan pertama


		let s = document.cookie.split(";");
		s.forEach(i => cek_cookie(i))
		function cek_cookie(i){
			if(i.substring(0,14)=="selected_menu="){
				let j = i.split("=");
				$("#blok_"+j[1]).show();
			}
		}

		
		$(".visibility").prop("disabled", true);
	})
</script>
