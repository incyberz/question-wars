<?php
# ================================================
# SESSION SECURITY
# ================================================
session_start();
function erjx($a){return "Error @ajax. Index($a) belum terdefinisi.";}

if(!isset($_SESSION['nickname'])) die(erjx(1));
if(!isset($_SESSION['admin_level'])) die(erjx(2));
if(!isset($_SESSION['id_room'])) die(erjx(3));

$nickname = $_SESSION['nickname'];
$admin_level = $_SESSION['admin_level'];
$id_room = $_SESSION['id_room'];

// if($_SESSION['admin_level']<2) die("Error @ajax. Maaf Anda Belum login sebagai Game Master.");


# ================================================
# GET VARIABLES
# ================================================
// die("1");   
$dm = 0;

if(!isset($_GET['id_soal'])) die("ajax_var#2 belum terdefinisi");
if(!isset($_GET['jawaban_terpilih'])) die("ajax_var#4 belum terdefinisi");
if(!isset($_GET['sisa_waktu'])) die("ajax_var#5 belum terdefinisi");
if(!isset($_GET['rows_point'])) die("ajax_var#6 belum terdefinisi");


$id_soal = $_GET['id_soal'];
$jawaban_terpilih = $_GET['jawaban_terpilih'];
$sisa_waktu = $_GET['sisa_waktu'];
$rows_point = $_GET['rows_point'];


if($id_soal=="") die("ajax_var#2 tidak boleh kosong");
if($jawaban_terpilih=="") die("ajax_var#4 tidak boleh kosong");
if($sisa_waktu=="") die("ajax_var#5 tidak boleh kosong");
if($rows_point=="") die("ajax_var#6 tidak boleh kosong");

$a = explode("_", $id_soal);
$nickname_creator = $a[0];

# =====================================================
# VARIABEL AWAL / KONFIGURASI
# =====================================================
$basic_point_jawab_benar_pg = 100;
$basic_point_jawab_benar_tf = 28;
$basic_point_jawab_benar_isian = 33;
$basic_point_jawab_salah_pg = 20;
$basic_point_jawab_salah_tf = 6;
$basic_point_jawab_salah_isian = 7;
$point_creator_jawab_benar = 5;
$point_creator_jawab_salah = 12;
$percent_levelup_soal = 10; //10 percent
$rows_point_multiplier = 4; 



# =====================================================
# ADMIN LEVEL PARAMETER
# =====================================================
include "../config.php";

if ($admin_level==9 or $admin_level==2) {
	$basic_point_jawab_benar_pg = 5;
	$basic_point_jawab_benar_tf = 5;
	$basic_point_jawab_benar_isian = 5;
	$basic_point_jawab_salah_pg = 5;
	$basic_point_jawab_salah_tf = 5;
	$basic_point_jawab_salah_isian = 5;
	$point_creator_jawab_benar = 0;
	$point_creator_jawab_salah = 0;
	$percent_levelup_soal = 0; //10 percent
	$rows_point_multiplier = 0; 
}

# =====================================================
# GET DATA SOAL OF CREATOR AND CREATOR DATA
# =====================================================
$s = "SELECT 

a.*,
b.*,
c.global_point,
d.room_player_point,
f.room_active_points 

from tb_soal a 
join tb_room_subject b on a.id_room_subject=b.id_room_subject 
join tb_player c on a.soal_creator=c.nickname 
join tb_room_player d on c.nickname=d.nickname  
join tb_room f on f.id_room=b.id_room 
where a.id_soal='$id_soal' 
and d.id_room='$id_room'";
// die($s);
$q = mysqli_query($cn,$s) or die("Tidak dapat mengakses data soal join");

if(mysqli_num_rows($q)!=1) die("SQL Query sukses tetapi rows != 1");
$d = mysqli_fetch_assoc($q);

$is_banned = $d['is_banned'];
if($is_banned) die("Maaf. Soal ini telah dibanned.");

$id_room = $d['id_room'];
$soal_creator = $d['soal_creator'];
$tipe_soal = $d['tipe_soal'];
if($tipe_soal=="") die("Tipe soal pada database tidak boleh kosong");
$level_soal = $d['level_soal'];

$jawaban_pg = $d['jawaban_pg'];
$jawaban_tf = $d['jawaban_tf'];
$jawaban_isian = $d['jawaban_isian'];

$benar_count = $d['benar_count'];
$salah_count = $d['salah_count'];
$earned_points = $d['earned_points'];
$last_answered = date("Y-m-d H:i:s");

$my_point_creator = $d['global_point'];
$room_player_point_creator = $d['room_player_point'];
$room_active_points = $d['room_active_points'];


# =====================================================
# GET ID PLAYED BY
# =====================================================
$s = "SELECT id_playedby from tb_soal_playedby where nickname='$nickname' and id_soal='$id_soal'";
$q = mysqli_query($cn,$s) or die("Tidak dapat mengakses data playedby");
if(mysqli_num_rows($q)!=1) die("SQL Query id_playedby sukses tetapi rows != 1");
$d = mysqli_fetch_assoc($q);

$id_playedby = $d['id_playedby'];


# =====================================================
# GET DATA PLAYER
# =====================================================
$s = "SELECT 

a.play_count,
a.last_play,
a.global_point,
b.room_player_point 

from tb_player a 
join tb_room_player b on a.nickname=b.nickname  
where a.nickname='$nickname' and b.id_room = '$id_room'";
// die($s);
if($dm){$q = mysqli_query($cn,$s) or die("Error #ajax submit jawaban::get data player; SQL: $s");}
else{$q = mysqli_query($cn,$s) or die("Error #ajax submit jawaban::get data player");}
$d = mysqli_fetch_assoc($q);

$play_count = $d['play_count'];
$last_play = $d['last_play'];
$global_point = $d['global_point'];
$room_player_point = $d['room_player_point'];











# =====================================================
# GET ANSWER FROM DB
# =====================================================
$dijawab_benar = 0;
if($tipe_soal==1 and strtolower($jawaban_pg)==strtolower($jawaban_terpilih)) $dijawab_benar=1;
if($tipe_soal==2 and strtolower($jawaban_tf)==strtolower($jawaban_terpilih)) $dijawab_benar=1;
if($tipe_soal==3 and strtolower($jawaban_isian)==strtolower($jawaban_terpilih)) $dijawab_benar=1;

switch ($tipe_soal) {
	case 1: 
	$jawaban_db=$jawaban_pg;
	$basic_point_jawab_benar=$basic_point_jawab_benar_pg;
	$basic_point_jawab_salah=$basic_point_jawab_salah_pg;
	break;
	
	case 2: 
	$jawaban_db=$jawaban_tf;
	$basic_point_jawab_benar=$basic_point_jawab_benar_tf;
	$basic_point_jawab_salah=$basic_point_jawab_salah_tf;
	break;

	case 3: 
	$jawaban_db=$jawaban_isian;
	$basic_point_jawab_benar=$basic_point_jawab_benar_isian;
	$basic_point_jawab_salah=$basic_point_jawab_salah_isian;
	break;

	default: die("Tidak ada nilai default untuk tipe_soal: $tipe_soal");

}

if($dijawab_benar){
	$basic_point = $basic_point_jawab_benar;
	$point_creator = $point_creator_jawab_benar;
	if($rows_point<5) $rows_point++;
	$new_level_soal = 100-($level_soal-$percent_levelup_soal/100*$level_soal);
	$benar_count++;

}else{

	# =====================================================
	# 1. BASIC POINT
	$basic_point = $basic_point_jawab_salah;
	if($jawaban_terpilih=="-") $basic_point = 0;
	$point_creator = $point_creator_jawab_salah;

	# =====================================================
	# 2. ROWS POINT
	$rows_point = 0;

	# =====================================================
	# 3. NEW LEVEL SOAL
	$new_level_soal = $level_soal-$percent_levelup_soal/100*$level_soal;

	# =====================================================
	# 4. SALAH COUNT
	$salah_count++;
}

# =====================================================
# LEVEL SOAL POINT
$level_soal_point = 0;
if($level_soal>50) $level_soal_point = $level_soal - 50;

# =====================================================
# ROOM ACTIVE POINT
$new_room_active_point = $room_active_points + 2;


# =====================================================
# SOAL EARNED POINT
$new_earned_point = $earned_points + $point_creator;

# =====================================================
# ROWS ADDED POINT
$rows_added_point = $rows_point*$rows_point_multiplier;

# =====================================================
# PLAY COUNT INCREMENT
$play_count++;

# =====================================================
# LUCKY POINT
$lucky_point = 0; //zzzzzzzzzzzz

# =====================================================
# TIME BONUS POINT
$time_bonus_point = 0; //zzzzzzzzzz

# =====================================================
# DURASI JAWAB
$date_load = 0; //ZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZZ
$date_now = 0;
$durasi_jawab = $date_load - $date_now;



# =====================================================
# TOTAL POINT PLAYER AND  CREATOR
# =====================================================
$player_point = $basic_point + $level_soal_point + $rows_added_point + $lucky_point;
$creator_point = $point_creator + $level_soal_point;

$new_my_point = $global_point + $player_point;
$new_my_point_creator = $my_point_creator + $creator_point;


# =====================================================
# NEW ROOM PLAYER POINT
$new_room_player_point = $room_player_point + $player_point;
$new_room_player_point_creator = $room_player_point_creator + $creator_point;




if($admin_level==9) die("1,
$dijawab_benar,
$jawaban_db,
$player_point,
$creator_point,
$rows_point,
$new_room_player_point,
$new_my_point
");




# =====================================================
# UPDATE DATA
# =====================================================
# 1. DATA PLAYER
# 2. DATA CREATOR
# 3. DATA SOAL
# 4. DATA SOAL PLAYEDBY
# 5. DATA ROOM
# 6. DATA ROOM_POINT PLAYER
# 7. DATA ROOM_POINT CREATOR
# 8. LEVEL SOAL
# 9. DISABLED SOAL (-2)



# =====================================================
# 1. UPDATE PLAYER:
$s = "UPDATE tb_player set 
play_count = '$play_count',
last_play = CURRENT_TIMESTAMP,
global_point = '$new_my_point' 
where nickname = '$nickname'";
if($dm){$q = mysqli_query($cn,$s) or die("Error #ajax submit jawaban::update #1; SQL: $s");}
else{$q = mysqli_query($cn,$s) or die("Error #ajax submit jawaban::update #1");}

# =====================================================
# 2. UPDATE CREATOR:
$s = "UPDATE tb_player set 
global_point = '$new_my_point_creator' 
where nickname = '$nickname_creator'";
if($dm){$q = mysqli_query($cn,$s) or die("Error #ajax submit jawaban::update #2; SQL: $s");}
else{$q = mysqli_query($cn,$s) or die("Error #ajax submit jawaban::update #2");}

# =====================================================
# 3. DATA SOAL
$s = "UPDATE tb_soal set 
benar_count = '$benar_count', 
salah_count = '$salah_count', 
earned_points = '$new_earned_point', 
last_answered = CURRENT_TIMESTAMP 
where id_soal = '$id_soal'";
if($dm){$q = mysqli_query($cn,$s) or die("Error #ajax submit jawaban::update #3; SQL: $s");}
else{$q = mysqli_query($cn,$s) or die("Error #ajax submit jawaban::update #3");}

# =====================================================
# 4. DATA SOAL PLAYEDBY
$s = "UPDATE tb_soal_playedby set 
dijawab_benar = '$dijawab_benar', 
durasi_jawab = '$durasi_jawab', 
player_point = '$player_point', 
creator_point = '$creator_point',
jawaban = '$jawaban_terpilih'
where id_playedby = '$id_playedby'";
$q = mysqli_query($cn,$s) or die("Error #ajax submit jawaban::update #4");
// if(!mysqli_affected_rows($cn)) die("Not affected rows. $s");
// die("Affected rows OK. $s");

# =====================================================
# 5. DATA ROOM
$s = "UPDATE tb_room set 
room_active_points = '$new_room_active_point' 
where id_room = '$id_room'";
if($dm){$q = mysqli_query($cn,$s) or die("Error #ajax submit jawaban::update #5; SQL: $s");}
else{$q = mysqli_query($cn,$s) or die("Error #ajax submit jawaban::update #5");}

# =====================================================
# 6. DATA ROOM POINT >> PLAYER
$s = "UPDATE tb_room_player set 
room_player_point = '$new_room_player_point' 
where nickname = '$nickname' and id_room='$id_room'";
if($dm){$q = mysqli_query($cn,$s) or die("Error #ajax submit jawaban::update #6; SQL: $s");}
else{$q = mysqli_query($cn,$s) or die("Error #ajax submit jawaban::update #6");}

# =====================================================
# 7. DATA ROOM POINT >> CREATOR
$s = "UPDATE tb_room_player set 
room_player_point = '$new_room_player_point_creator' 
where nickname = '$nickname_creator' and id_room='$id_room'";
if($dm){$q = mysqli_query($cn,$s) or die("Error #ajax submit jawaban::update #7; SQL: $s");}
else{$q = mysqli_query($cn,$s) or die("Error #ajax submit jawaban::update #7");}

# =====================================================
# 8. UPDATE LEVEL SOAL
$s = "UPDATE tb_soal set 
level_soal = '$new_level_soal' 
where id_soal = '$id_soal'";
if($dm){$q = mysqli_query($cn,$s) or die("Error #ajax submit jawaban::update #8; SQL: $s");}
else{$q = mysqli_query($cn,$s) or die("Error #ajax submit jawaban::update #8");}

# =====================================================
# 9. DISABLED SOAL
$bs_ratio = ($benar_count+2) / ($benar_count+2+$salah_count+2) * 100;
if($bs_ratio>85){
	$s = "UPDATE tb_soal set 
	is_approved_by_gm = -2 
	where id_soal = '$id_soal'";
	if($dm){$q = mysqli_query($cn,$s) or die("Error #ajax submit jawaban::update #9; SQL: $s");}
	else{$q = mysqli_query($cn,$s) or die("Error #ajax submit jawaban::update #9");}
}

if($dm) echo "1string
\n -------
\n dijawab_benar:$dijawab_benar
\n durasi_jawab:$durasi_jawab
\n -------
\n nickname: $nickname
\n nickname_creator: $nickname_creator
\n id_soal: $id_soal
\n global_point: $global_point
\n new_my_point: $new_my_point
\n my_point_creator: $my_point_creator
\n new_my_point_creator: $new_my_point_creator
\n new_level_soal: $new_level_soal
\n -------
\n soal earned_points: $earned_points
\n soal new_earned_point: $new_earned_point
\n -------
\n room_active_points: $room_active_points
\n new_room_active_point: $new_room_active_point
\n room_player_point: $room_player_point
\n new_room_player_point: $new_room_player_point
\n room_player_point_creator: $room_player_point_creator
\n new_room_player_point_creator: $new_room_player_point_creator
";

echo "
1,
$dijawab_benar,
$jawaban_db,
$player_point,
$creator_point,
$rows_point,
$new_room_player_point,
$new_my_point
";

?>