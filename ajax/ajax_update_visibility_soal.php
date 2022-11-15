<?php 
# ================================================
# SESSION SECURITY
# ================================================
session_start();
function erjx($a){return "Error @ajax. Index($a) belum terdefinisi.";}

$nickname = isset($_SESSION['nickname']) ? $_SESSION['nickname'] : die(erjx('nickname'));
$admin_level = isset($_SESSION['admin_level']) ? $_SESSION['admin_level'] : die(erjx('admin_level'));
$id_room = isset($_SESSION['id_room']) ? $_SESSION['id_room'] : die(erjx('id_room'));



# ================================================
# GET VARIABLES
# ================================================
$id_soal = isset($_GET['id_soal']) ? $_GET['id_soal'] : die(erjx('id_soal'));
$visibility_soal = isset($_GET['visibility_soal']) ? $_GET['visibility_soal'] : die(erjx('visibility_soal'));

include "../config.php";
# ================================================
# SOAL PROPERTI
# ================================================
$s = "SELECT a.*, b.nama_subject, 
(SELECT tags FROM tb_kelengkapan_presensi where id_room_subject=b.id_room_subject) as tags 

FROM tb_soal a 
join tb_room_subject b on a.id_room_subject=b.id_room_subject 
WHERE a.id_soal='$id_soal'";
$q = mysqli_query($cn,$s) or die(mysqli_error($cn));
if(mysqli_num_rows($q)==0) die("Data id_soal:$id_soal tidak ditemukan.");
$d = mysqli_fetch_assoc($q);


if($d['status_soal'] < 0) die('Maaf, tidak dapat mengakses soal yang terkena Banned.');

$tags_soal = '__';

if($visibility_soal==1){

	# ================================================
	# LOGIC SYSTEM :: SYARAT PUBLISH SOAL
	# ================================================
	# - TIDAK KENA BANNED
	# - KALIMAT SOAL > 50
	# - OPSI-1 > 3
	# - OPSI-2 > 3
	# - OPSI-3 > 3
	# - OPSI-4 > 3
	# - KJ PG IS NOT NULL
	# - MENGANDUNG SATU TAGS WAJIB
	# ================================================

	$kalimat_soal = strlen($d['kalimat_soal'])>=50 ? $d['kalimat_soal'] : die('Untuk kalimat_soal minimal 50 karakter');
	$opsi_pg1 = strlen($d['opsi_pg1'])>=3 ? $d['opsi_pg1'] : die('Untuk opsi_pg1 minimal 3 karakter');
	$opsi_pg2 = strlen($d['opsi_pg2'])>=3 ? $d['opsi_pg2'] : die('Untuk opsi_pg2 minimal 3 karakter');
	$opsi_pg3 = strlen($d['opsi_pg3'])>=3 ? $d['opsi_pg3'] : die('Untuk opsi_pg3 minimal 3 karakter');
	$opsi_pg4 = strlen($d['opsi_pg4'])>=3 ? $d['opsi_pg4'] : die('Untuk opsi_pg4 minimal 3 karakter');
	$jawaban_pg = strlen($d['jawaban_pg'])==1 ? $d['jawaban_pg'] : die('Silahkan pilih dahulu Kunci Jawaban!');

	# ================================================
	# - MENGANDUNG SATU TAGS WAJIB
	# ================================================
	$tags = strtolower($d['tags']);
	if($tags == ''){
		die("Maaf, belum bisa publish soal karena dosen belum menentukan tag pada sesi $d[nama_subject]. \n\nSilahkan hubungi dosen agar segera mengisi tags nya!");
	}else{


		$all_kalimat = " $d[kalimat_soal] $d[opsi_pg1] $d[opsi_pg2] $d[opsi_pg3] $d[opsi_pg4] ";
		$all_kalimat = strtolower($all_kalimat);

		$rtags = explode(',', strtolower($tags));
		$tag_exist = 0;
		for ($i=0; $i < count($rtags); $i++) { 
			$rtags[$i] = trim($rtags[$i]);
			if($rtags[$i]=='') continue;
			if(strpos($all_kalimat, $rtags[$i])){
				$tags_soal .= ','.$rtags[$i];

				$tag_exist = 1;
				// break;
			}
		}

		if(!$tag_exist) die("Maaf, pada kalimat soal ataupun opsi-opsinya tidak ditemukan satupun tag. Silahkan update kalimat atau opsi-opsi dengan kata yang mengandung pilihan tag berikut:\n\n$tags");
	}

	$tags_soal = str_replace('__,', '', $tags_soal);

}







# ================================================
# UPDATE VISIBILITY :: PUBLISH SOAL
# ================================================
$tags_soal = $tags_soal=='__' ? 'NULL' : "'$tags_soal'";

$sql_tag_soal = $visibility_soal==1 ? " ,tags_soal=$tags_soal " : '';


$s = "UPDATE tb_soal SET visibility_soal=$visibility_soal $sql_tag_soal WHERE id_soal='$id_soal'";
$q = mysqli_query($cn,$s) or die("Error @ajax. ".mysqli_error($cn));

echo "sukses";

?>