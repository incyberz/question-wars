<?php 
require_once "../config.php";
$debug_note = '';

# =====================================================
# INITIAL URL NICKNAME VARIABLES
# =====================================================
$cnickname = isset($_SESSION['nickname']) ? $_SESSION['nickname'] : '';
$gnickname = isset($_GET['nickname']) ? $_GET['nickname'] : '';
$is_mine = ($cnickname==$gnickname OR $gnickname=="") ? 1 : 0;


$acuan_nickname = $gnickname!='' ? $gnickname : $cnickname;

$debug_note.= "<br>acuan_nickname:$acuan_nickname";


$s = "SELECT a.*, b.folder_uploads, b.avatar_id, b.nama_player  
from tb_biodata a 
JOIN tb_player b on a.nickname=b.nickname 
WHERE a.nickname='$acuan_nickname'";

$debug_note.= "<br>s:$s";

$q = mysqli_query($cn,$s) or die(mysqli_error($cn));
if(mysqli_num_rows($q)==0){
	$s2 = "INSERT INTO tb_biodata (nickname) VALUES ('$acuan_nickname')";
	$q2 = mysqli_query($cn,$s2) or die(mysqli_error($cn));

	$q = mysqli_query($cn,$s) or die(mysqli_error($cn));
}

$d = mysqli_fetch_assoc($q);

$avatar_id = $d['avatar_id'];
$nama_player = $d['nama_player'];

$tentang_saya = $d['tentang_saya'];
$motto_hidup = $d['motto_hidup'];
$motto_belajar = $d['motto_belajar'];

$alamat_blok = $d['alamat_blok'];
$alamat_kec = $d['alamat_kec'];
$tempat_lahir = $d['tempat_lahir'];
$tanggal_lahir = $d['tanggal_lahir'];
$gender = $d['gender']; 
$agama = $d['agama']; 
$status_menikah = $d['status_menikah'];
$warga_negara = $d['warga_negara'];
$anak_ke = $d['anak_ke'];
$jumlah_saudara = $d['jumlah_saudara'];
$tinggal_bersama = $d['tinggal_bersama'];
$jenis_kendaraan = $d['jenis_kendaraan'];
$jenis_rumah = $d['jenis_rumah'];

$no_wa = $d['no_wa'];
$no_wa_ayah = $d['no_wa_ayah'];
$no_wa_ibu = $d['no_wa_ibu'];
$no_hp = $d['no_hp'];
$email = $d['email'];
$website = $d['website'];
$facebook = $d['facebook'];
$twitter = $d['twitter'];
$instagram = $d['instagram'];
$youtube = $d['youtube'];
$linkedin = $d['linkedin'];

$skillba_ep = $d['skillba_ep'];
$skillba_ec = $d['skillba_ec'];
$skillba_ba = $d['skillba_ba'];
$skillba_ps = $d['skillba_ps'];
$skillba_mc = $d['skillba_mc'];

$skillko_of = $d['skillko_of'];
$skillko_pr = $d['skillko_pr'];
$skillko_dg = $d['skillko_dg'];
$skillko_mm = $d['skillko_mm'];
$skillko_nt = $d['skillko_nt'];

$skilla1 = $d['skilla1'];
$skilla2 = $d['skilla2'];
$skilla3 = $d['skilla3'];
$skilla4 = $d['skilla4'];
$skilla5 = $d['skilla5'];

$hobby1 = $d['hobby1'];
$hobby2 = $d['hobby2'];
$hobby3 = $d['hobby3'];
$hobby4 = $d['hobby4'];
$hobby5 = $d['hobby5'];

$cita1 = $d['cita1'];
$cita2 = $d['cita2'];
$cita3 = $d['cita3'];

$riwayat_pendidikan1 = $d['riwayat_pendidikan1'];
$riwayat_pendidikan2 = $d['riwayat_pendidikan2'];
$riwayat_pendidikan3 = $d['riwayat_pendidikan3'];
$riwayat_pendidikan4 = $d['riwayat_pendidikan4'];
$riwayat_pendidikan5 = $d['riwayat_pendidikan5'];

$riwayat_pekerjaan1 = $d['riwayat_pekerjaan1'];
$riwayat_pekerjaan2 = $d['riwayat_pekerjaan2'];
$riwayat_pekerjaan3 = $d['riwayat_pekerjaan3'];
$riwayat_pekerjaan4 = $d['riwayat_pekerjaan4'];
$riwayat_pekerjaan5 = $d['riwayat_pekerjaan5'];

$riwayat_organisasi1 = $d['riwayat_organisasi1'];
$riwayat_organisasi2 = $d['riwayat_organisasi2'];
$riwayat_organisasi3 = $d['riwayat_organisasi3'];
$riwayat_organisasi4 = $d['riwayat_organisasi4'];
$riwayat_organisasi5 = $d['riwayat_organisasi5'];

$riwayat_sertifikasi1 = $d['riwayat_sertifikasi1'];
$riwayat_sertifikasi2 = $d['riwayat_sertifikasi2'];
$riwayat_sertifikasi3 = $d['riwayat_sertifikasi3'];
$riwayat_sertifikasi4 = $d['riwayat_sertifikasi4'];
$riwayat_sertifikasi5 = $d['riwayat_sertifikasi5'];

$makanan_favorit = $d['makanan_favorit'];
$minuman_favorit = $d['minuman_favorit'];
$warna_favorit = $d['warna_favorit'];







# ==================================================
# FOLDER UPLOADS
# ==================================================
$folder_uploads = $d['folder_uploads'];
if(trim($folder_uploads=="")){
	$a = "_".microtime(); 
	$a = str_replace("0.", "_", $a);
	$a = str_replace("0,", "_", $a);
	$a = str_replace(" ", "_", $a);
	$a = str_replace("__", "_", $a);
	$folder_uploads = $a;

	$s = "UPDATE tb_player set folder_uploads='$folder_uploads' where nickname='$cnickname'";
	$q = mysqli_query($cn,$s) or die(mysqli_error($cn));
}



# ==================================================
# PHOTO PROFIL SHOW
# ==================================================
$upload_path = "../uploads/$folder_uploads";
$profil_na = "../uploads/_profile_na.png";
$profil_utama = "$upload_path/_profile.jpg";
$profil_publik = "$upload_path/_publik_profile.jpg";


if(!file_exists($profil_utama)) $profil_utama = $profil_na;
if(!file_exists($profil_publik)) $profil_publik = $profil_na;

if($cadmin_level==2 or $is_mine){
	$profil_show = $profil_utama;
}else{
	$profil_show = $profil_publik;
}

$profil_show = ($profil_utama==$profil_na) ? $profil_publik : $profil_publik;
$profil_show = ($cadmin_level==2 or $is_mine) ? $profil_utama : $profil_publik;

$debug_note .= "
<br>upload_path:$upload_path
<br>profil_na:$profil_na
<br>profil_utama:$profil_utama
<br>profil_publik:$profil_publik
<br>profil_show:$profil_show
<br>
<br>cnickname:$cnickname
<br>gnickname:$gnickname
";



# ==================================================
# VARIABLE SHOWS
# ==================================================
$ns = "<span class='not_set' style='color:red'><i>Not set.</i></span>";
$rgender = ["L" => "Laki-laki", "P" => "Perempuan"];
$ragama = ["","Islam","Katolik","Protestan","Hindu","Budha","Lainnya"];
$rstatus_menikah = ["","Belum Menikah","Menikah","Janda/Duda"];
$rwarga_negara = ["","WNI","WNA"];




$tentang_saya_show = $tentang_saya=="" ? $ns : $tentang_saya;

$tempat_lahir_show = $tempat_lahir=="" ? $ns : ucwords(strtolower($tempat_lahir)) ;
$tanggal_lahir_show = $tanggal_lahir=="" ? $ns : date("d F Y",strtotime($tanggal_lahir));
$gender_show = $gender==""?$ns: $rgender[$gender];
$agama_show = $agama==""?$ns: $ragama[$agama];
$status_menikah_show = $status_menikah==""?$ns: $rstatus_menikah[$status_menikah];
$warga_negara_show = $warga_negara==""?$ns: $rwarga_negara[$warga_negara];

$no_wa_show = $no_wa==""?$ns: $no_wa;
$email_show = $email==""?$ns: $email;
$alamat_blok_show = $alamat_blok==""?$ns: $alamat_blok;
$no_wa_show = $no_wa==""?$ns: $no_wa;


$hobby1_show = $hobby1==""?$ns: $hobby1;
$hobby2_show = $hobby2==""?$ns: $hobby2;
$hobby3_show = $hobby3==""?$ns: $hobby3;
$hobby4_show = $hobby4==""?$ns: $hobby4;
$hobby5_show = $hobby5==""?$ns: $hobby5;


$cita1_show = $cita1==""?$ns: $cita1;
$cita2_show = $cita2==""?$ns: $cita2;
$cita3_show = $cita3==""?$ns: $cita3;

$rriwayat_pendidikan1 = explode("__", $riwayat_pendidikan1."________");
$rriwayat_pendidikan2 = explode("__", $riwayat_pendidikan2."________");
$rriwayat_pendidikan3 = explode("__", $riwayat_pendidikan3."________");
$rriwayat_pendidikan4 = explode("__", $riwayat_pendidikan4."________");
$rriwayat_pendidikan5 = explode("__", $riwayat_pendidikan5."________");

$rriwayat_pekerjaan1 = explode("__", $riwayat_pekerjaan1."________");
$rriwayat_pekerjaan2 = explode("__", $riwayat_pekerjaan2."________");
$rriwayat_pekerjaan3 = explode("__", $riwayat_pekerjaan3."________");
$rriwayat_pekerjaan4 = explode("__", $riwayat_pekerjaan4."________");
$rriwayat_pekerjaan5 = explode("__", $riwayat_pekerjaan5."________");

$rriwayat_organisasi1 = explode("__", $riwayat_organisasi1."________");
$rriwayat_organisasi2 = explode("__", $riwayat_organisasi2."________");
$rriwayat_organisasi3 = explode("__", $riwayat_organisasi3."________");
$rriwayat_organisasi4 = explode("__", $riwayat_organisasi4."________");
$rriwayat_organisasi5 = explode("__", $riwayat_organisasi5."________");

$rriwayat_sertifikasi1 = explode("__", $riwayat_sertifikasi1."________");
$rriwayat_sertifikasi2 = explode("__", $riwayat_sertifikasi2."________");
$rriwayat_sertifikasi3 = explode("__", $riwayat_sertifikasi3."________");
$rriwayat_sertifikasi4 = explode("__", $riwayat_sertifikasi4."________");
$rriwayat_sertifikasi5 = explode("__", $riwayat_sertifikasi5."________");











?>

