<?php 
if($id_room_subject<0 or !isset($id_room_subject)) die('Error get_paket_soal. id_room_subject undefined.');
# ================================================
# GET PAKET SOAL
# ================================================
$s = "SELECT 

a.id_soal,
a.kalimat_soal,
a.opsi_pg1 as opsi_a,
a.opsi_pg2 as opsi_b,
a.opsi_pg3 as opsi_c,
a.opsi_pg4 as opsi_d,
a.durasi_jawab,
a.soal_creator,
a.status_soal,
c.nama_subject, 
(SELECT nama_player FROM tb_player WHERE nickname=a.soal_creator) as nama_creator,
(SELECT folder_uploads FROM tb_player WHERE nickname=a.soal_creator) as folder_uploads_creator,
(SELECT COUNT(1) FROM tb_soal_rejectby WHERE id_soal=a.id_soal) as jumlah_rejecter,
(SELECT COUNT(1) FROM tb_soal_playedby WHERE id_soal=a.id_soal and dijawab_benar=1) as jumlah_dijawab_benar,
(SELECT COUNT(1) FROM tb_soal_playedby WHERE id_soal=a.id_soal and dijawab_benar!=1) as jumlah_dijawab_salah 


from tb_soal a 
join tb_room_subject c on a.id_room_subject = c.id_room_subject 

left join tb_soal_playedby b 
on a.id_soal = b.id_soal and b.nickname = '$cnickname' 

WHERE c.id_room = '$cid_room' 
and a.soal_creator != '$cnickname' 
and b.id_soal is null 
and a.status_soal != -1 
and a.visibility_soal = 1 
and c.id_room_subject = '$id_room_subject' 

ORDER BY rand() 
LIMIT 20";

// die($s);

$q = mysqli_query($cn,$s) or die("error get_paket_kuis. ".mysqli_error($cn));

$jumlah_paket = mysqli_num_rows($q);
if($jumlah_paket<20){
	echo "<script>
	alert('Soal kurang dari 20.');
	location.replace('?kuis');
	</script>";
	exit();
}

$nama_subject = '';
$profiles = '';

$id_soals = '<span id="id_soals">';
$kalimat_soals = '<span id="kalimat_soals">';
$opsi_as = '<span id="opsi_as">';
$opsi_bs = '<span id="opsi_bs">';
$opsi_cs = '<span id="opsi_cs">';
$opsi_ds = '<span id="opsi_ds">';
$durasi_jawabs = '<span id="durasi_jawabs">';
$soal_creators = '<span id="soal_creators">';
$nama_creators = '<span id="nama_creators">';
$jumlah_rejecters = '<span id="jumlah_rejecters">';
$jumlah_dijawab_benars = '<span id="jumlah_dijawab_benars">';
$jumlah_dijawab_salahs = '<span id="jumlah_dijawab_salahs">';
$status_soals = '<span id="status_soals">';

$chat_kills = '';

while ($d = mysqli_fetch_assoc($q)) {
	$nama_subject = $d['nama_subject'];

	$id_soals .= $d['id_soal'].'____';
	$kalimat_soals .= $d['kalimat_soal'].'____';
	$opsi_as .= $d['opsi_a'].'____';
	$opsi_bs .= $d['opsi_b'].'____';
	$opsi_cs .= $d['opsi_c'].'____';
	$opsi_ds .= $d['opsi_d'].'____';
	$durasi_jawabs .= $d['durasi_jawab'].'____';
	$soal_creators .= $d['soal_creator'].'____';
	$nama_creators .= $d['nama_creator'].'____';
	$jumlah_rejecters .= $d['jumlah_rejecter'].'____';
	$jumlah_dijawab_benars .= $d['jumlah_dijawab_benar'].'____';
	$jumlah_dijawab_salahs .= $d['jumlah_dijawab_salah'].'____';
	$status_soals .= $d['status_soal'].'____';

	// $path_public_profile = 'uploads/'.$d['folder_uploads_creator'].'/_profile.jpg'; //zzz tmp debug
	$path_public_profile = 'uploads/'.$d['folder_uploads_creator'].'/_publik_profil.jpg';
	if(!file_exists($path_public_profile)) $path_public_profile = 'uploads/_public_profile_na.png';
	$id_soal = $d['id_soal'];
	$profiles .= "<img class='profil_soal_creator hideit' src='$path_public_profile' id='profil__$id_soal'>";

	$wp_no = (rand() % 12) + 1;

	$chat_kills .= "
	<div class='ck_row' id='ck_row__$d[id_soal]'>
		<span class='player_name player_left' id='player_left__$d[id_soal]'>You</span>
		<img class='img_weapon' src='assets/img/guns/wp$wp_no.png'>
		<span class='player_name player_right' id='player_right__$d[id_soal]'>$d[nama_creator]</span>
	</div>
	";
}

$id_soals .= '</span>';
$kalimat_soals .= '</span>';
$opsi_as .= '</span>';
$opsi_bs .= '</span>';
$opsi_cs .= '</span>';
$opsi_ds .= '</span>';
$durasi_jawabs .= '</span>';
$soal_creators .= '</span>';
$nama_creators .= '</span>';
$jumlah_rejecters .= '</span>';
$jumlah_dijawab_benars .= '</span>';
$jumlah_dijawab_salahs .= '</span>';
$status_soals .= '</span>';
?>

<div class="debug hideit">
	<?php 
	echo "
	$id_soals 
	$kalimat_soals 
	$opsi_as 
	$opsi_bs 
	$opsi_cs 
	$opsi_ds 
	$durasi_jawabs 
	$soal_creators 
	$nama_creators 
	$jumlah_rejecters 
	$jumlah_dijawab_benars 
	$jumlah_dijawab_salahs 
	$status_soals 
	";
	?>
</div>