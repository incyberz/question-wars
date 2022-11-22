<?php

# ================================================
# USER VAR VERSI 2.0
# ================================================





# ================================================
# TOTAL PRESENSI SAAT INI
# ================================================
$s = "SELECT 1 from tb_room_subject where id_room='$cid_room' and date_open<='".date("Y-m-d")."'";
$q = mysqli_query($cn, $s) or die("error @room_var_update. Tidak bisa menghitung total_presensi_saat_ini. ".mysqli_error($cn));
$total_presensi_saat_ini = mysqli_num_rows($q);


# ================================================
# SESSION SECURITY
# ================================================
$cnickname = isset($_SESSION['nickname']) ? $_SESSION['nickname'] : die("session nickname belum terdefinisi.");
$cadmin_level = isset($_SESSION['admin_level']) ? $_SESSION['admin_level'] : die("session admin_level belum terdefinisi.");

if ($cid_room=='' or $cid_room<1) {
    die("Error @user_var. cid_room belum terdefinisi.");
}
if ($cnickname=='') {
    die("Error @user_var. cnickname belum terdefinisi.");
}
if ($cadmin_level==0) {
    session_destroy();
    die("Error @user_var. cadmin_level tidak boleh nol.");
}



# ================================================
# INITIALIZING MY DATA
# ================================================
$rank_player = 0;
$rank_player_in_kelas = 0;
$rank_player_in_prodi = 0;







# ================================================
# GET DATA PLAYER + PROFIL
# ================================================
$s = "SELECT * FROM tb_player	WHERE nickname = '$cnickname'";
$q = mysqli_query($cn, $s) or die("Error @user_var. Tidak mengakses data player. cnickname: $cnickname".mysqli_error($cn));
if (mysqli_num_rows($q)!=1) {
    die("Error @user_var. Row harus satu baris. cnickname: $cnickname");
}

$d = mysqli_fetch_assoc($q);

// $nama_player  = $d['nama_player'];
$folder_uploads  = $d['folder_uploads'];
$cnama_player = ucwords(strtolower($d['nama_player']));
$cjenis_user = $cadmin_level==2 ? 'GM' : 'Player';

$path_folder = "uploads/$folder_uploads";
$path_profile = "$path_folder/_profile.jpg";
$punya_profil = file_exists($path_profile) ? 1 : 0;




# ================================================
# FOLDER UPLOADS HANDLER
# ================================================
$kelas = '';
$prodi = '';
if ($folder_uploads=='') {
    $folder_uploads = $cnickname.'_'.date('ymdHis');
    $path_folder = "uploads/$folder_uploads";

    if (!mkdir($path_folder)) {
        die("folder_uploads empty. Tidak dapat membuat new path_folder: $path_folder ");
    }

    $s = "UPDATE tb_player SET folder_uploads='$folder_uploads' where nickname='$cnickname'";
    $q = mysqli_query($cn, $s) or die(mysqli_error($cn));
} elseif (!file_exists($path_folder)) {
    if (!mkdir($path_folder)) {
        die("folder_uploads not exits. Tidak dapat membuat new path_folder: $path_folder ");
    }
}





# ================================================
# GET DATA KELAS + PRODI
# ================================================
if ($cadmin_level == 1) {
    $s = "SELECT b.kelas, c.prodi, d.nama_prodi   

	FROM tb_player a 
	JOIN tb_kelas_det b ON a.nickname=b.nickname 
	JOIN tb_kelas c ON b.kelas=c.kelas 
	JOIN tb_prodi d ON c.prodi=d.prodi 
	WHERE a.nickname = '$cnickname' 
	";
    $q = mysqli_query($cn, $s) or die("Error @user_var Can't get data player. <hr>".mysqli_error($cn));
    $jumlah_baris = mysqli_num_rows($q);
    if ($jumlah_baris>1) {
        die("Error @user_var. Nickname: $cnickname terdapat di dua grup-kelas. Segera lapor GM!");
    } elseif ($jumlah_baris==1) {
        $d = mysqli_fetch_assoc($q);
        $kelas  = $d['kelas'];
        $prodi  = $d['prodi'];
    }
} elseif ($cadmin_level == 2) {
    $kelas  = "Kelas GM";
    $prodi  = "Prodi GM";
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
$q = mysqli_query($cn, $s) or die("Error @user_var: AVAILABLE ROOMS FOR THIS PLAYER<hr>".mysqli_error($cn));

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
if (isset($cid_room) and $cid_room>0) {
    for ($i=0; $i < count($my_available_id_rooms) ; $i++) {
        if ($cid_room==$my_available_id_rooms[$i]) {
            continue;
        }
        $manage_room_headers.= "<li><a href='?change_room&id_room=$my_available_id_rooms[$i]'>$my_available_nama_rooms[$i]</a></li>";
        $room_options_for_change_room.="<option value='$my_available_id_rooms[$i]'>$my_available_nama_rooms[$i]</option>";
    }
}









# ================================================
# LAST LOGIN
# ================================================
// $s = "SELECT date_login FROM tb_login where nickname='$cnickname' order by date_login limit 2";
// $q = mysqli_query($cn, $s) or die("Error @user_var. Tidak bisa mengakses data login.");
// while ($d=mysqli_fetch_assoc($q)) {
//     $last_login = $d['date_login'];
// }







# ================================================
# NILAI UTS/UAS
# ================================================
$uts_baak = 0;
$uas_baak = 0;

$s = "SELECT * from tb_dpnu where nickname='$cnickname' and id_room='$cid_room'";
$q = mysqli_query($cn, $s) or die("Error @user_var. Tidak bisa mengambil data nilai UTS/UAS.");
while ($d = mysqli_fetch_assoc($q)) {
    $uts_baak = $d['uts_baak'];
    $uas_baak = $d['uas_baak'];
}





# ================================================
# MY RANK GLOBAL
# ================================================
$s = "SELECT a.nickname, b.nama_player, a.room_player_point from tb_room_player a 
join tb_player b ON a.nickname = b.nickname 
WHERE b.status_aktif = 1 
and a.id_room = $cid_room 
and b.admin_level = 1 
ORDER BY a.room_player_point DESC, b.nama_player 
";

$q = mysqli_query($cn, $s) or die("Error #room_var1 Can't get room data");
while ($d = mysqli_fetch_assoc($q)) {
    $rank_player++;
    if (strtoupper($d['nickname'])==strtoupper($cnickname)) {
        break;
    }
}





# ================================================
# LIST FOR MY RANK GLOBAL
# ================================================
$i = 0;
$q = mysqli_query($cn, $s) or die("Error #room_var2 Can't get room data");
while ($d = mysqli_fetch_assoc($q)) {
    $i++;
    $list_player[$i] = ucwords(strtolower($d['nama_player'])) ;
    $list_point[$i] = $d['room_player_point'];
    if ($i==10 and $cadmin_level==1) {
        break;
    } //show only 10 for player
}









# ================================================
# GET TMP USER VAR
# ================================================
$s = "SELECT * FROM tmp_user_var WHERE nickname = '$cnickname' and id_room=$cid_room";
$q = mysqli_query($cn, $s) or die("Error @user_var. Tidak mengakses tmp_user_var. ".mysqli_error($cn));
if (mysqli_num_rows($q)==1) {
    $d = mysqli_fetch_assoc($q);

    $selisih_detik = strtotime(date('Y-m-d H:i:s')) - strtotime($d['last_update']);

    if ($selisih_detik>3600) {
        include 'user_var_updated.php';
    } else {
        $rank_player = $d['rank_player'];
        $rank_player_in_kelas = $d['rank_player_in_kelas'];
        $rank_player_in_prodi = $d['rank_player_in_prodi'];
        $my_presensi = $d['my_presensi'];
        $my_soal_total = $d['my_soal_total'];
        $my_soal_publish = $d['my_soal_publish'];
        $my_soal_banned = $d['my_soal_banned'];
        $my_soal_suspend = $d['my_soal_suspend'];
        $my_soal_new = $d['my_soal_new'];
        $my_chal_count = $d['my_chal_count'];
        $my_chal_count_claimed = $d['my_chal_count_claimed'];
        $my_chal_count_unclaim = $d['my_chal_count_unclaim'];
        $my_chal_count_unver = $d['my_chal_count_unver'];
        $my_chal_point_sum = $d['my_chal_point_sum'];
        $my_play_count = $d['my_play_count'];
        $my_play_count_timed_out = $d['my_play_count_timed_out'];
        $my_play_count_benar = $d['my_play_count_benar'];
        $my_play_count_salah = $d['my_play_count_salah'];
        $my_reject_count = $d['my_reject_count'];
        $my_daily_login_count = $d['my_daily_login_count'];
    }
} else {
    include 'user_var_updated.php';
}
