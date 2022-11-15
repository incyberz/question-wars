<?php
# ================================================
# SESSION SECURITY
# ================================================
include "ajax_session_security.php";

# ================================================
# FUNCTIONS
# ================================================
function clean($string) {
	// return $string;
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
   $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
   return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
}

function sortnclean($str){
	$ck = strtolower(clean($str));
	$rk = explode('-', $ck); 
	sort($rk);
	
	$rkh = []; 

	$j=0;
	for ($i=0; $i < count($rk); $i++){
		if($i!= count($rk)-1) if($rk[$i]==$rk[$i+1]) continue;
		$rkh[$j] = $rk[$i];
		$j++;
	}
	$hasil = ''; 
	for ($i=0; $i < count($rkh); $i++) $hasil .= $rkh[$i].' ';
	return $hasil;
}





# ================================================
# GET VARIABEL
# ================================================
$tags_soal = isset($_GET['tags_soal']) ? $_GET['tags_soal'] : die(erjx('tags_soal'));
$input_kal = isset($_GET['input_kal']) ? $_GET['input_kal'] : die(erjx('input_kal'));
$id_soal = isset($_GET['id_soal']) ? $_GET['id_soal'] : die(erjx('id_soal'));

# ================================================
# SIMILARITY CHECK
# ================================================
$rtags_soal = explode(', ',$tags_soal);
$kalimat_soal_like = '( 0 ';

for ($i=0; $i < count($rtags_soal); $i++) { 
	$kalimat_soal_like .= " OR a.kalimat_soal like '%$rtags_soal[$i]%'";
	$kalimat_soal_like .= " OR a.opsi_pg1 like '%$rtags_soal[$i]%'";
	$kalimat_soal_like .= " OR a.opsi_pg2 like '%$rtags_soal[$i]%'";
	$kalimat_soal_like .= " OR a.opsi_pg3 like '%$rtags_soal[$i]%'";
	$kalimat_soal_like .= " OR a.opsi_pg4 like '%$rtags_soal[$i]%'";
}

$kalimat_soal_like .= ' ) ';


$s = "SELECT a.id_soal,a.kalimat_soal,b.nama_player as pembuat_soal, a.soal_creator, a.tanggal_buat  
from tb_soal a 
join tb_player b on a.soal_creator=b.nickname 
join tb_room_subject c on a.id_room_subject=c.id_room_subject 
where a.id_soal!='$id_soal' 
and $kalimat_soal_like 
and c.id_room='$cid_room'
";

// die($s);
$q = mysqli_query($cn,$s) or die('Error jx_soal_similarity_check. '.mysqli_error($cn));

$rsoal = [];
$i=0;
while ($d=mysqli_fetch_assoc($q)) {
	$id_soal = $d['id_soal'];
	$kalimat_soal = $d['kalimat_soal'];
	$soal_creator = $d['soal_creator'];
	$pembuat_soal = $d['pembuat_soal'];
	$tanggal_buat = $d['tanggal_buat'];

	similar_text(sortnclean($input_kal), sortnclean($kalimat_soal), $persen_similar);
	$persen_similar = round($persen_similar,2);

	$rsoal[$i] = [$persen_similar,$id_soal,$kalimat_soal,$soal_creator,$pembuat_soal,$tanggal_buat]; 
	$i++;
	// echo "<hr><span style='color: $red'>$persen_similar</span> || $kalimat_soal. <br>". sortnclean($kalimat_soal);
}

usort($rsoal, function($a,$b){
	if($a[0]==$b[0]) return 0;
	return $a[0] < $b[0]?1:-1;
});


$z='';
for ($i=0; $i < 3 ; $i++) { 
	$persen_similar = $rsoal[$i][0];
	if($persen_similar>75){

		$id_soal 			= $rsoal[$i][1];
		$kalimat_soal = $rsoal[$i][2];
		$soal_creator = $rsoal[$i][3];
		$pembuat_soal = $rsoal[$i][4];
		$tanggal_buat = $rsoal[$i][5];

		$z.="<hr><b>Similarity: $persen_similar%</b> | <small>$kalimat_soal | by: $pembuat_soal at $tanggal_buat</small>";

	}
}

if($z == '') die('<img src="assets/img/icons/check_green.png" width="25px">');

echo "$z";








?>