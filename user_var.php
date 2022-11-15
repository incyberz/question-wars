<?php 
// echo "<pre>";
// echo var_dump($_SESSION);
// echo "</pre>";
$cnickname = isset($_SESSION['nickname']) ? $_SESSION['nickname'] : die("session nickname belum terdefinisi.");
$cadmin_level = isset($_SESSION['admin_level']) ? $_SESSION['admin_level'] : die("session admin_level belum terdefinisi.");


if (!isset($cnickname) or $cnickname=="") die("Error @user_var #ec3. cnickname belum terdefinisi.");
if($cadmin_level==0) {
	session_destroy();
	die("Error @user_var. cadmin_level tidak boleh nol.");
}


# ================================================
# GET DATA PLAYER + PRODI
# ================================================
$kelas = '';
$prodi = '';

$s = "SELECT * FROM tb_player	WHERE nickname = '$cnickname'";
$q = mysqli_query($cn, $s) or die("Error user_var. Tidak mengakses data player. cnickname: $cnickname".mysqli_error($cn));
if (mysqli_num_rows($q)!=1) die("Error user_var. Row harus satu baris. cnickname: $cnickname");

$d = mysqli_fetch_assoc($q);

// $admin_level  = $d['admin_level'];
$nama_player  = $d['nama_player'];
// $play_count  = $d['play_count'];
// $last_play  = $d['last_play'];
// $global_point  = $d['global_point'];
// $status_aktif  = $d['status_aktif'];
// $pass_hint  = $d['pass_hint'];
$folder_uploads  = $d['folder_uploads'];

$cnama_player = ucwords(strtolower($nama_player));
$cjenis_user = $cadmin_level==2 ? 'GM' : 'Player';

$path_folder = "uploads/$folder_uploads";
$path_profile = "$path_folder/_profile.jpg";
$punya_profil = file_exists($path_profile) ? 1 : 0;


if($folder_uploads==''){

	// die('zzz');
	$folder_uploads = $cnickname.'_'.date('ymdHis');

	$path_folder = "uploads/$folder_uploads";

	if(!mkdir($path_folder)) die("folder_uploads empty. Tidak dapat membuat new path_folder: $path_folder ");

	$s = "UPDATE tb_player SET folder_uploads='$folder_uploads' where nickname='$cnickname'";
	$q = mysqli_query($cn,$s) or die(mysqli_error($cn));

}elseif(!file_exists($path_folder)){
	if(!mkdir($path_folder)) die("folder_uploads not exits. Tidak dapat membuat new path_folder: $path_folder ");
}

if($cadmin_level == 1){
	$s = "SELECT b.kelas, c.prodi, d.nama_prodi   

	FROM tb_player a 
	JOIN tb_kelas_det b ON a.nickname=b.nickname 
	JOIN tb_kelas c ON b.kelas=c.kelas 
	JOIN tb_prodi d ON c.prodi=d.prodi 
	WHERE a.nickname = '$cnickname' 
	";
	$q = mysqli_query($cn, $s) or die("Error user_var Can't get data player. <hr>".mysqli_error($cn));
	$jumlah_baris = mysqli_num_rows($q);
	if ($jumlah_baris){
		$d = mysqli_fetch_assoc($q);
		$kelas  = $d['kelas'];
		$prodi  = $d['prodi'];
		$nama_prodi  = $d['nama_prodi'];
	}
}elseif($cadmin_level == 2){
	$kelas  = "Kelas GM";
	$prodi  = "Prodi GM";
	$nama_prodi  = "Nama Prodi GM";
}





# ================================================
# AVAILABLE ROOMS FOR THIS PLAYER
# ================================================
$my_available_id_rooms = [];
$my_available_nama_rooms = [];
$my_available_room_creator = [];
$my_available_room_creator_folder_uploads = [];

$s = "SELECT 

a.id_room,
b.nama_room,
c.nama_player as room_creator,
c.folder_uploads as room_creator_folder_uploads 

from tb_room_player a 
join tb_room b on a.id_room=b.id_room 
join tb_player c on b.room_creator=c.nickname 
where a.nickname = '$cnickname' 
and b.status_room = 1
";
$q = mysqli_query($cn,$s) or die("Error user_var: AVAILABLE ROOMS FOR THIS PLAYER<hr>".mysqli_error($cn));

$i=0;
while ($d = mysqli_fetch_assoc($q)) {
	$my_available_id_rooms[$i] = $d['id_room'];
	$my_available_nama_rooms[$i] = $d['nama_room'];
	$my_available_room_creator[$i] = $d['room_creator'];
	$my_available_room_creator_folder_uploads[$i] = $d['room_creator_folder_uploads'];
	$i++;
}



# ================================================
# GET change ROOMs EXCEPT this ROOM
# ================================================
$room_options_for_change_room = '';
$manage_room_headers = '';
if(isset($cid_room) and $cid_room>0){
	for ($i=0; $i < count($my_available_id_rooms) ; $i++) { 
		if($cid_room==$my_available_id_rooms[$i]) continue;
		$manage_room_headers.= "<li><a href='?change_room&id_room=$my_available_id_rooms[$i]'>$my_available_nama_rooms[$i]</a></li>";
		$room_options_for_change_room.="<option value='$my_available_id_rooms[$i]'>$my_available_nama_rooms[$i]</option>";
	}
}







# ================================================
# GLOBAL RANK :: ALL ROOM
# ================================================
$s = "SELECT * from tb_player WHERE status_aktif = 1 ";
$so = " ORDER BY global_point DESC";
$sp = "$s and admin_level=1 $so";
$sg = "$s and (admin_level=2 or admin_level=9) $so";
$qp = mysqli_query($cn,$sp) or die("Error #user_var. Can't get room data player");
$qg = mysqli_query($cn,$sg) or die("Error #user_var. Can't get room data GM");
if(mysqli_num_rows($qp)==0) die("Error @user_var. Peserta tidak boleh kosong.");
if(mysqli_num_rows($qg)==0) die("Error @user_var. GM tidak boleh kosong.");
$jumlah_player_global = mysqli_num_rows($qp);
$jumlah_gm_global = mysqli_num_rows($qg);

$player_global_rank = 0;
while ($d = mysqli_fetch_assoc($qp)) {
	$player_global_rank++;
	if (strtoupper($d['nickname'])==strtoupper($cnickname)) break;
}

$player_global_rank_cap = "th";
if($player_global_rank % 10 == 1) $player_global_rank_cap = "st";
if($player_global_rank % 10 == 2) $player_global_rank_cap = "nd";
if($player_global_rank % 10 == 3) $player_global_rank_cap = "rd";


$gm_global_rank = 0;
while ($d = mysqli_fetch_assoc($qg)) {
	$gm_global_rank++;
	if (strtoupper($d['nickname'])==strtoupper($cnickname)) break;
}

$gm_global_rank_cap = "th";
if($gm_global_rank % 10 == 1) $gm_global_rank_cap = "st";
if($gm_global_rank % 10 == 2) $gm_global_rank_cap = "nd";
if($gm_global_rank % 10 == 3) $gm_global_rank_cap = "rd";


# ================================================
# LAST LOGIN
# ================================================
$s = "SELECT date_login FROM tb_login where nickname='$cnickname' order by date_login limit 2";
$q = mysqli_query($cn,$s) or die("Error @user_var. Tidak bisa mengakses data login.");
while($d=mysqli_fetch_assoc($q)){
	$last_login = $d['date_login'];
}




# ================================================
# TOTAL CHALLENGE POINT
# ================================================
$s = "SELECT sum(score_for_player) as my_chal_point from tb_chal_beatenby a 
join tb_chal b on a.id_chal=b.id_chal 
WHERE b.id_room='$cid_room' 
and b.chal_status=1 
and a.beaten_by='$cnickname'";
$q = mysqli_query($cn,$s) or die("Error @user_var. Tidak bisa menghitung my_chal_point.");
$d = mysqli_fetch_assoc($q);
$my_chal_point = $d['my_chal_point'];




# ================================================
# NILAI UTS/UAS
# ================================================
$uts_baak = 0;
$uas_baak = 0;

$s = "SELECT * from tb_dpnu where nickname='$cnickname' and id_room='$cid_room'";
$q = mysqli_query($cn,$s) or die("Error @user_var. Tidak bisa mengambil data nilai UTS/UAS.");
while ($d = mysqli_fetch_assoc($q)) {
	$uts_baak = $d['uts_baak'];
	$uas_baak = $d['uas_baak'];
}

?>
