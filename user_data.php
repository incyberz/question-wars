<?php

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
# AVAILABLE ROOMS FOR THIS PLAYER
# ================================================
$my_available_id_rooms = [];
$my_available_nama_rooms = [];
$my_available_room_creator = [];
$my_available_room_creator_folder_uploads = [];

$s = "SELECT 

a.id_room,
b.nama_room,
b.status_room,
c.nama_player as room_creator,
c.folder_uploads as room_creator_folder_uploads 

from tb_room_player a 
join tb_room b on a.id_room=b.id_room 
join tb_player c on b.room_creator=c.nickname 
where a.nickname = '$cnickname' 
and b.status_room > -2
";
$q = mysqli_query($cn, $s) or die("Error @user_var: AVAILABLE ROOMS FOR THIS PLAYER<hr>".mysqli_error($cn));

$i=0;
while ($d = mysqli_fetch_assoc($q)) {
    $my_available_id_rooms[$i] = $d['id_room'];
    $status_rooms[$i] = $d['status_room'];
    $my_available_nama_rooms[$i] = $d['nama_room'];
    $my_available_room_creator[$i] = $d['room_creator'];
    $my_available_room_creator_folder_uploads[$i] = $d['room_creator_folder_uploads'];
    $i++;
}
