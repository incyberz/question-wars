<?php

# ================================================
# ROOM_VARS UPDATE
# ================================================
# id_room_var = idRoom_yymmdd
# ================================================

# ================================================
# TOTAL PLAYER IN ROOM & GET RANK PLAYER IN THIS ROOM
# ================================================

$s = "SELECT a.nickname, b.nama_player, a.room_player_point from tb_room_player a 
join tb_player b ON a.nickname = b.nickname 
WHERE b.status_aktif = 1 
and a.id_room = $cid_room 
and b.admin_level = 1 
ORDER BY a.room_player_point DESC, b.nama_player 
";

$q = mysqli_query($cn, $s) or die("Error #room_var1 Can't get room data");
$total_player = mysqli_num_rows($q);
// if($total_player==0) die("'zzz' $s");

while ($d = mysqli_fetch_assoc($q)) {
    $rank_player++;
    if (strtoupper($d['nickname'])==strtoupper($cnickname)) {
        break;
    }
}

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

$player_rank_th = "th";
if ($rank_player % 10 == 1) {
    $player_rank_th = "st";
}
if ($rank_player % 10 == 2) {
    $player_rank_th = "nd";
}
if ($rank_player % 10 == 3) {
    $player_rank_th = "rd";
}



# ================================================
# GET RANK PLAYER :: THIS KELAS
# ================================================
if ($kelas!='') {
    $s = "SELECT a.nickname, b.nama_player, a.room_player_point 
	FROM tb_room_player a 
	join tb_player b ON a.nickname = b.nickname 
	JOIN tb_kelas_det c ON b.nickname=c.nickname 
	WHERE b.status_aktif = 1 
	and a.id_room = $cid_room 
	and b.admin_level = 1 
	and c.kelas = '$kelas' 
	ORDER BY a.room_player_point DESC, b.nama_player 
	";

    $q = mysqli_query($cn, $s) or die("Error @player_dashboard_kelas #1 Can't get room data. ".mysqli_error($cn));
    $jumlah_player_in_kelas = mysqli_num_rows($q);

    while ($d = mysqli_fetch_assoc($q)) {
        $rank_player_in_kelas++;
        if (strtoupper($d['nickname'])==strtoupper($cnickname)) {
            break;
        }
    }

    $i = 0;
    $q = mysqli_query($cn, $s) or die("Error @player_dashboard_kelas #2 Can't get room data. <hr>".mysqli_error($cn));
    while ($d = mysqli_fetch_assoc($q)) {
        $i++;
        $list_player_in_class[$i] = ucwords(strtolower($d['nama_player'])) ;
        $list_point_in_class[$i] = $d['room_player_point'];
    }
}





# ================================================
# GET RANK PLAYER :: THIS PRODI
# ================================================
if ($prodi!='') {
    # ================================================
    # GET RANK PLAYER :: THIS ROOM
    # ================================================
    $s = "SELECT a.nickname, b.nama_player, a.room_player_point 
	FROM tb_room_player a 
	join tb_player b ON a.nickname = b.nickname 
	JOIN tb_kelas_det c ON b.nickname=c.nickname 
	JOIN tb_kelas d ON c.kelas=d.kelas 
	WHERE b.status_aktif = 1 
	and a.id_room = $cid_room 
	and b.admin_level = 1 
	and d.prodi = '$prodi' 
	ORDER BY a.room_player_point DESC, b.nama_player 
	";

    $q = mysqli_query($cn, $s) or die("Error @player_dashboard_prodi #1 Can't get room data. ".mysqli_error($cn));
    $jumlah_player_in_prodi = mysqli_num_rows($q);

    while ($d = mysqli_fetch_assoc($q)) {
        $rank_player_in_prodi++;
        if (strtoupper($d['nickname'])==strtoupper($cnickname)) {
            break;
        }
    }

    $i = 0;
    $q = mysqli_query($cn, $s) or die("Error #room_var2 Can't get room data");
    while ($d = mysqli_fetch_assoc($q)) {
        $i++;
        $list_player_in_prodi[$i] = ucwords(strtolower($d['nama_player'])) ;
        $list_point_in_prodi[$i] = $d['room_player_point'];
        if ($i==10 and $admin_level==1) {
            break;
        } //show only 10 for player
    }
} else {
    // die('Prodi is empty.');
}

# ================================================
# GET RANK GM :: THIS ROOM
# ================================================
$gm_rank = 1; //zzz
$gm_rank_th = 'st'; //zzz
$jumlah_gm = 1; //zzz

// $s = "SELECT a.nickname, b.nama_player, a.room_player_point from tb_room_player a
// join tb_player b ON a.nickname = b.nickname
// WHERE b.status_aktif = 1
// and a.id_room = $cid_room
// and (b.admin_level = 2 OR b.admin_level = 9)
// ORDER BY a.room_player_point DESC, b.nama_player
// ";

// $q = mysqli_query($cn,$s) or die("Error #room_var1 Can't get room data");
// $jumlah_gm = mysqli_num_rows($q);

// while ($d = mysqli_fetch_assoc($q)) {
// 	$gm_rank++;
// 	if (strtoupper($d['nickname'])==strtoupper($cnickname)) break;
// }


// $gm_rank_th = "th";
// if($gm_rank % 10 == 1) $gm_rank_th = "st";
// if($gm_rank % 10 == 2) $gm_rank_th = "nd";
// if($gm_rank % 10 == 3) $gm_rank_th = "rd";
































# ================================================
# ROOM_VARS :: PRESENSI
# ================================================
$s = "SELECT 1 from tb_room_subject where id_room='$cid_room' and date_open<='".date("Y-m-d")."'";
$q = mysqli_query($cn, $s) or die("error room_var. Tidak bisa menghitung total_presensi_saat_ini. ".mysqli_error($cn));
$total_presensi_saat_ini = mysqli_num_rows($q);

$s = "SELECT 1 from tb_presensi a 
join tb_room_subject b on a.id_room_subject=b.id_room_subject 
join tb_room c on b.id_room=c.id_room 
WHERE a.nickname = '$cnickname' 
AND c.id_room = '$cid_room'
";
$q = mysqli_query($cn, $s) or die("error room_var. Tidak bisa menghitung jumlah_presensi. ".mysqli_error($cn));
$jumlah_presensi = mysqli_num_rows($q);













# ================================================
# ROOM_VARS :: SOAL
# ================================================
$s = "SELECT 1 from tb_soal a 
JOIN tb_room_subject b on a.id_room_subject=b.id_room_subject 
JOIN tb_room c on b.id_room=c.id_room 
WHERE a.soal_creator='$cnickname' 
and c.id_room='$cid_room'
";
$q = mysqli_query($cn, $s) or die("Error room_var. Tidak bisa menghitung total_soal. ".mysqli_error($cn));
$total_soal = mysqli_num_rows($q);


$s2 = "$s and visibility_soal=1";
$q = mysqli_query($cn, $s2) or die("Error room_var. Tidak bisa menghitung jumlah_soal_publish. ".mysqli_error($cn));
$jumlah_soal_publish = mysqli_num_rows($q);

$s2 = "$s and visibility_soal=-1";
$q = mysqli_query($cn, $s2) or die("Error room_var. Tidak bisa menghitung jumlah_soal_banned. ".mysqli_error($cn));
$jumlah_soal_banned = mysqli_num_rows($q);

$s2 = "$s and visibility_soal=0";
$q = mysqli_query($cn, $s2) or die("Error room_var. Tidak bisa menghitung jumlah_soal_suspend. ".mysqli_error($cn));
$jumlah_soal_suspend = mysqli_num_rows($q);

$s2 = "$s and visibility_soal is null";
$q = mysqli_query($cn, $s2) or die("Error room_var. Tidak bisa menghitung jumlah_soal_new. ".mysqli_error($cn));
$jumlah_soal_new = mysqli_num_rows($q);

















# ================================================
# ROOM_VARS :: CHALLENGES
# ================================================
$s = "SELECT 1 from tb_chal WHERE id_room='$cid_room' and chal_visibility=1";
$q = mysqli_query($cn, $s) or die("Error room_var. Tidak bisa menghitung total challenge. ".mysqli_error($cn));
$total_chal = mysqli_num_rows($q);

$s2 = "$s and id_room_subject is not null";
$q = mysqli_query($cn, $s2) or die("Error room_var. Tidak bisa menghitung total_tugas. ".mysqli_error($cn));
$total_tugas = mysqli_num_rows($q);



# jumlah_chal
# ================================================
$s = "SELECT 1 from tb_chal_beatenby a 
join tb_chal b on a.id_chal=b.id_chal 
WHERE b.id_room='$cid_room' 
and b.chal_visibility=1 
and a.beaten_by='$cnickname' 
";
$q = mysqli_query($cn, $s) or die("Error room_var. Tidak bisa menghitung jumlah_chal. ".mysqli_error($cn));
$jumlah_chal = mysqli_num_rows($q);


# jumlah_chal
# ================================================
$s = "SELECT sum(score_for_player) as total_chal_point from tb_chal_beatenby a 
join tb_chal b on a.id_chal=b.id_chal 
WHERE b.id_room='$cid_room' 
and b.chal_visibility=1 
";
$q = mysqli_query($cn, $s) or die("Error room_var. Tidak bisa menghitung total_chal_point. ".mysqli_error($cn));
if (mysqli_num_rows($q)!=1) {
    die("Error @room_var: menghitung total_chal_point");
}
$d=mysqli_fetch_assoc($q);
$total_chal_point = $d['total_chal_point'];




$s = "SELECT count(1) as total_chal_point from tb_chal_beatenby a 
join tb_chal b on a.id_chal=b.id_chal 
WHERE b.id_room='$cid_room' 
and b.chal_visibility=1 
and a.beaten_by = '$cnickname' 
";


$s2 = "$s and a.approved_by is not null and a.is_claimed=1";
$q = mysqli_query($cn, $s2) or die("Error room_var. Tidak bisa menghitung jumlah_chal_claimed. ".mysqli_error($cn));
if (mysqli_num_rows($q)!=1) {
    die("Error @room_var: menghitung jumlah_chal_claimed");
}
$d=mysqli_fetch_assoc($q);
$jumlah_chal_claimed = $d['total_chal_point']=='' ? 0 : $d['total_chal_point'];


$s2 = "$s and a.approved_by is not null and a.is_claimed=0";
$q = mysqli_query($cn, $s2) or die("Error room_var. Tidak bisa menghitung jumlah_chal_unclaim. ".mysqli_error($cn));
if (mysqli_num_rows($q)!=1) {
    die("Error @room_var: menghitung jumlah_chal_unclaim");
}
$d=mysqli_fetch_assoc($q);
$jumlah_chal_unclaim = $d['total_chal_point']=='' ? 0 : $d['total_chal_point'];

$s2 = "$s and a.approved_by is null";
$q = mysqli_query($cn, $s2) or die("Error room_var. Tidak bisa menghitung jumlah_chal_unver. ".mysqli_error($cn));
if (mysqli_num_rows($q)!=1) {
    die("Error @room_var: menghitung jumlah_chal_unver");
}
$d=mysqli_fetch_assoc($q);
$jumlah_chal_unver = $d['total_chal_point']=='' ? 0 : $d['total_chal_point'];


$s2 = "$s and b.id_room_subject is not null";
$q = mysqli_query($cn, $s2) or die("Error room_var. Tidak bisa menghitung jumlah_tugas. ".mysqli_error($cn));
if (mysqli_num_rows($q)!=1) {
    die("Error @room_var: menghitung jumlah_tugas");
}
$d=mysqli_fetch_assoc($q);
$jumlah_tugas = $d['total_chal_point']=='' ? 0 : $d['total_chal_point'];


// $s2 = str_replace("SELECT 1 ", "SELECT SUM(score_for_player) as jumlah_chal_point ", $s);
// $q = mysqli_query($cn,$s2) or die("Tidak bisa menghitung total jumlah_chal_point");
// $d = mysqli_fetch_assoc($q);
// $jumlah_chal_point = $d['jumlah_chal_point'];














# ================================================
# OTHER ACTIVITY
# ================================================
$s = "SELECT 1 from tb_soal_playedby a 
JOIN tb_soal b on a.id_soal=b.id_soal 
JOIN tb_room_subject c on b.id_room_subject=c.id_room_subject 
JOIN tb_room d on c.id_room=d.id_room 
WHERE d.id_room='$cid_room' 
and a.nickname='$cnickname' 
";
$q = mysqli_query($cn, $s) or die("Error room_var. Tidak bisa menghitung jumlah_play. ".mysqli_error($cn));
$jumlah_play = mysqli_num_rows($q);

$s2 = "$s and a.jawaban is null ";
$q = mysqli_query($cn, $s2) or die("Error room_var. Tidak bisa menghitung jumlah_play_timed_out. ".mysqli_error($cn));
$jumlah_play_timed_out = mysqli_num_rows($q);

$s2 = "$s and a.dijawab_benar = 1 ";
$q = mysqli_query($cn, $s2) or die("Error room_var. Tidak bisa menghitung jumlah_play_benar. ".mysqli_error($cn));
$jumlah_play_benar = mysqli_num_rows($q);

$s2 = "$s and a.dijawab_benar = 0 ";
$q = mysqli_query($cn, $s2) or die("Error room_var. Tidak bisa menghitung jumlah_play_salah. ".mysqli_error($cn));
$jumlah_play_salah = mysqli_num_rows($q);



# total_play_kuis
# ================================================
$s = "SELECT count(1) as total_play_kuis from tb_soal_playedby a 
JOIN tb_soal b on a.id_soal=b.id_soal 
JOIN tb_room_subject c on b.id_room_subject=c.id_room_subject 
JOIN tb_room d on c.id_room=d.id_room 
WHERE d.id_room='$cid_room' 
";
$q = mysqli_query($cn, $s) or die("Error room_var. Tidak bisa menghitung total_play_kuis. ".mysqli_error($cn));
if (mysqli_num_rows($q)>0) {
    $d = mysqli_fetch_assoc($q);
    $total_play_kuis = $d['total_play_kuis'];
}

# total_aktif_player
# ================================================
$s = "SELECT count(1) as total_aktif_player from tb_room_player a 
WHERE a.id_room='$cid_room' 
AND room_player_point>0  
";
$q = mysqli_query($cn, $s) or die("Error room_var. Tidak bisa menghitung total_aktif_player. ".mysqli_error($cn));
if (mysqli_num_rows($q)>0) {
    $d = mysqli_fetch_assoc($q);
    $total_aktif_player = $d['total_aktif_player'];
}







$s = "SELECT 1 from tb_soal_rejectby a 
JOIN tb_soal b on a.id_soal=b.id_soal 
JOIN tb_room_subject c on b.id_room_subject=c.id_room_subject 
JOIN tb_room d on c.id_room=d.id_room 
WHERE d.id_room='$cid_room' 
and a.nickname='$cnickname' 
";
$q = mysqli_query($cn, $s) or die("Error room_var. Tidak bisa menghitung jumlah_reject. ".mysqli_error($cn));
$jumlah_reject = mysqli_num_rows($q);





$s = "SELECT 1 from tb_daily_login a 
JOIN tb_login b on a.id_login=b.id_login 
WHERE b.nickname='$cnickname' 
";
$q = mysqli_query($cn, $s) or die("Error room_var. Tidak bisa menghitung jumlah_daily_login. ".mysqli_error($cn));
$jumlah_daily_login = mysqli_num_rows($q);





# ================================================
# OUTPUT PERSEN
# ================================================
$persen_presensi = $total_presensi_saat_ini==0 ? 0 : round($jumlah_presensi/$total_presensi_saat_ini*100, 0);
$persen_chal = $total_chal==0 ? 0 : round($jumlah_chal/$total_chal*100, 0);
$persen_akurasi = $jumlah_play==0 ? 0 : round($jumlah_play_benar/$jumlah_play*100, 0);



# ================================================
# SAVE ROOM_VAR
# ================================================
$id_room_var = $cid_room.'_'.date('ymd');
$s = "INSERT INTO tb_room_var (
id_room_var,
id_room,
tanggal_update,
total_player,
total_presensi_saat_ini,
total_presensi,
total_soal,
total_chal,
total_chal_point,
total_tugas,
total_play_kuis,
total_aktif_player

) VALUES (

'$id_room_var',
'$cid_room',
CURRENT_TIMESTAMP,
'$total_player',
'$total_presensi_saat_ini',
'$total_presensi',
'$total_soal',
'$total_chal',
'$total_chal_point',
'$total_tugas',
'$total_play_kuis',
'$total_aktif_player'


) ON DUPLICATE KEY UPDATE 

tanggal_update=CURRENT_TIMESTAMP,
total_player='$total_player',
total_presensi_saat_ini='$total_presensi_saat_ini',
total_presensi='$total_presensi',
total_soal='$total_soal',
total_chal='$total_chal',
total_chal_point='$total_chal_point',
total_tugas='$total_tugas',
total_play_kuis='$total_play_kuis',
total_aktif_player='$total_aktif_player'


";
$q = mysqli_query($cn, $s) or die("Error room_var_update. Tidak bisa menyimpan setingan baru. ".mysqli_error($cn));
