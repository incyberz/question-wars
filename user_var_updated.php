<?php


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
# MY RANK KELAS
# ================================================
if ($kelas=='') {
    die('Error @user_var_updated. Player belum dimasukan ke grup-kelas.');
} else {
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
# MY RANK PRODI
# ================================================
if ($prodi=='') {
    die('Error @user_var_updated. Player belum dimasukan ke grup-prodi.');
} else {
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
}






# ================================================
# GET RANK GM :: THIS ROOM
# ================================================
$gm_rank = 1; //zzz
$gm_rank_th = 'st'; //zzz
$jumlah_gm = 1; //zzz







# ================================================
# MY PRESENSI
# ================================================
$s = "SELECT 1 from tb_presensi a 
join tb_room_subject b on a.id_room_subject=b.id_room_subject 
join tb_room c on b.id_room=c.id_room 
WHERE a.nickname = '$cnickname' 
AND c.id_room = '$cid_room'
";
$q = mysqli_query($cn, $s) or die("error @room_var_update. Tidak bisa menghitung jumlah_presensi. ".mysqli_error($cn));
$my_presensi = mysqli_num_rows($q);











# ================================================
# MY TOTAL SOAL | PUBLISH | BANNED | NEW | SUSPEND
# ================================================
$s = "SELECT 1 from tb_soal a 
JOIN tb_room_subject b on a.id_room_subject=b.id_room_subject 
JOIN tb_room c on b.id_room=c.id_room 
WHERE a.soal_creator='$cnickname' 
and c.id_room='$cid_room'
";
$q = mysqli_query($cn, $s) or die("Error @room_var_update. Tidak bisa menghitung my_soal_total. ".mysqli_error($cn));
$my_soal_total = mysqli_num_rows($q);


$s2 = "$s and visibility_soal=1";
$q = mysqli_query($cn, $s2) or die("Error @room_var_update. Tidak bisa menghitung jumlah_soal_publish. ".mysqli_error($cn));
$my_soal_publish = mysqli_num_rows($q);

$s2 = "$s and visibility_soal=-1";
$q = mysqli_query($cn, $s2) or die("Error @room_var_update. Tidak bisa menghitung jumlah_soal_banned. ".mysqli_error($cn));
$my_soal_banned = mysqli_num_rows($q);

$s2 = "$s and visibility_soal=0";
$q = mysqli_query($cn, $s2) or die("Error @room_var_update. Tidak bisa menghitung jumlah_soal_suspend. ".mysqli_error($cn));
$my_soal_suspend = mysqli_num_rows($q);

$s2 = "$s and visibility_soal is null";
$q = mysqli_query($cn, $s2) or die("Error @room_var_update. Tidak bisa menghitung jumlah_soal_new. ".mysqli_error($cn));
$my_soal_new = mysqli_num_rows($q);




# ================================================
# MY CHAL
# ================================================
$s = "SELECT 1 from tb_chal_beatenby a 
join tb_chal b on a.id_chal=b.id_chal 
WHERE b.id_room='$cid_room' 
and b.chal_visibility=1 
and a.beaten_by='$cnickname' 
";
$q = mysqli_query($cn, $s) or die("Error @room_var_update. Tidak bisa menghitung jumlah_chal. ".mysqli_error($cn));
$my_chal_count = mysqli_num_rows($q);





# ================================================
# MY CHAL POINT | CLAIMED | UNCLAIM | UNVER
# ================================================
$s = "SELECT count(1) as my_chal_count from tb_chal_beatenby a 
join tb_chal b on a.id_chal=b.id_chal 
WHERE b.id_room='$cid_room' 
and b.chal_visibility=1 
and a.beaten_by = '$cnickname' 
";

$q = mysqli_query($cn, $s) or die("Error @room_var_update. Tidak bisa menghitung my_chal_count. ".mysqli_error($cn));
if (mysqli_num_rows($q)!=1) {
    die("Error @room_var_update: menghitung my_chal_count");
}
$d=mysqli_fetch_assoc($q);
$my_chal_count = $d['my_chal_count']=='' ? 0 : $d['my_chal_count'];




$s2 = "$s and a.approved_by is not null and a.is_claimed=1";
$q = mysqli_query($cn, $s2) or die("Error @room_var_update. Tidak bisa menghitung my_chal_count_claimed. ".mysqli_error($cn));
if (mysqli_num_rows($q)!=1) {
    die("Error @room_var_update: menghitung my_chal_count_claimed");
}
$d=mysqli_fetch_assoc($q);
$my_chal_count_claimed = $d['my_chal_count']=='' ? 0 : $d['my_chal_count'];


$s2 = "$s and a.approved_by is not null and a.is_claimed=0";
$q = mysqli_query($cn, $s2) or die("Error @room_var_update. Tidak bisa menghitung my_chal_count_unclaim. ".mysqli_error($cn));
if (mysqli_num_rows($q)!=1) {
    die("Error @room_var_update: menghitung my_chal_count_unclaim");
}
$d=mysqli_fetch_assoc($q);
$my_chal_count_unclaim = $d['my_chal_count']=='' ? 0 : $d['my_chal_count'];

$s2 = "$s and a.approved_by is null";
$q = mysqli_query($cn, $s2) or die("Error @room_var_update. Tidak bisa menghitung my_chal_count_unver. ".mysqli_error($cn));
if (mysqli_num_rows($q)!=1) {
    die("Error @room_var_update: menghitung my_chal_count_unver");
}
$d=mysqli_fetch_assoc($q);
$my_chal_count_unver = $d['my_chal_count']=='' ? 0 : $d['my_chal_count'];





# ================================================
# SUM MY CHALLENGE POINT
# ================================================
$s = "SELECT sum(score_for_player) as my_chal_point_sum from tb_chal_beatenby a 
    join tb_chal b on a.id_chal=b.id_chal 
    WHERE b.id_room='$cid_room' 
    and b.chal_visibility=1 
    and a.beaten_by='$cnickname'";
$q = mysqli_query($cn, $s) or die("Error @user_var. Tidak bisa menghitung my_chal_point_sum.");
$d = mysqli_fetch_assoc($q);
$my_chal_point_sum = $d['my_chal_point_sum'];







# ================================================
# MY PLAY COUNT | TIMED OUT | BENAR | SALAH
# ================================================
$s = "SELECT 1 from tb_soal_playedby a 
JOIN tb_soal b on a.id_soal=b.id_soal 
JOIN tb_room_subject c on b.id_room_subject=c.id_room_subject 
JOIN tb_room d on c.id_room=d.id_room 
WHERE d.id_room='$cid_room' 
and a.nickname='$cnickname' 
";
$q = mysqli_query($cn, $s) or die("Error @room_var_update. Tidak bisa menghitung my_play_count. ".mysqli_error($cn));
$my_play_count = mysqli_num_rows($q);

$s2 = "$s and a.jawaban is null ";
$q = mysqli_query($cn, $s2) or die("Error @room_var_update. Tidak bisa menghitung my_play_count_timed_out. ".mysqli_error($cn));
$my_play_count_timed_out = mysqli_num_rows($q);

$s2 = "$s and a.dijawab_benar = 1 ";
$q = mysqli_query($cn, $s2) or die("Error @room_var_update. Tidak bisa menghitung my_play_count_benar. ".mysqli_error($cn));
$my_play_count_benar = mysqli_num_rows($q);

$s2 = "$s and a.dijawab_benar = 0 ";
$q = mysqli_query($cn, $s2) or die("Error @room_var_update. Tidak bisa menghitung my_play_count_salah. ".mysqli_error($cn));
$my_play_count_salah = mysqli_num_rows($q);











# ================================================
# MY REJECT COUNT
# ================================================
$s = "SELECT 1 from tb_soal_rejectby a 
JOIN tb_soal b on a.id_soal=b.id_soal 
JOIN tb_room_subject c on b.id_room_subject=c.id_room_subject 
JOIN tb_room d on c.id_room=d.id_room 
WHERE d.id_room='$cid_room' 
and a.nickname='$cnickname' 
";
$q = mysqli_query($cn, $s) or die("Error @room_var_update. Tidak bisa menghitung my_reject_count. ".mysqli_error($cn));
$my_reject_count = mysqli_num_rows($q);






# ================================================
# MY DAILY LOGIN COUNT
# ================================================
$s = "SELECT 1 from tb_daily_login a 
JOIN tb_login b on a.id_login=b.id_login 
WHERE b.nickname='$cnickname' 
";
$q = mysqli_query($cn, $s) or die("Error @room_var_update. Tidak bisa menghitung my_daily_login_count. ".mysqli_error($cn));
$my_daily_login_count = mysqli_num_rows($q);












# ================================================
# SAVE user_var_update
# ================================================
$id_user_var = $cid_room."_$cnickname";
$s = "INSERT INTO tmp_user_var (
id_user_var,
nickname,
id_room,
last_update,
rank_player,
rank_player_in_kelas,
rank_player_in_prodi,
my_presensi,
my_soal_total,
my_soal_publish,
my_soal_banned,
my_soal_suspend,
my_soal_new,
my_chal_count,
my_chal_count_claimed,
my_chal_count_unclaim,
my_chal_count_unver,
my_chal_point_sum,
my_play_count,
my_play_count_timed_out,
my_play_count_benar,
my_play_count_salah,
my_reject_count,
my_daily_login_count


) VALUES (

'$id_user_var',
'$cnickname',
'$cid_room',
CURRENT_TIMESTAMP,
'$rank_player',
'$rank_player_in_kelas',
'$rank_player_in_prodi',
'$my_presensi',
'$my_soal_total',
'$my_soal_publish',
'$my_soal_banned',
'$my_soal_suspend',
'$my_soal_new',
'$my_chal_count',
'$my_chal_count_claimed',
'$my_chal_count_unclaim',
'$my_chal_count_unver',
'$my_chal_point_sum',
'$my_play_count',
'$my_play_count_timed_out',
'$my_play_count_benar',
'$my_play_count_salah',
'$my_reject_count',
'$my_daily_login_count'



) ON DUPLICATE KEY UPDATE

last_update=CURRENT_TIMESTAMP,
rank_player='$rank_player',
rank_player_in_kelas='$rank_player_in_kelas',
rank_player_in_prodi='$rank_player_in_prodi',
my_presensi='$my_presensi',
my_soal_total='$my_soal_total',
my_soal_publish='$my_soal_publish',
my_soal_banned='$my_soal_banned',
my_soal_suspend='$my_soal_suspend',
my_soal_new='$my_soal_new',
my_chal_count='$my_chal_count',
my_chal_count_claimed='$my_chal_count_claimed',
my_chal_count_unclaim='$my_chal_count_unclaim',
my_chal_count_unver='$my_chal_count_unver',
my_chal_point_sum='$my_chal_point_sum',
my_play_count='$my_play_count',
my_play_count_timed_out='$my_play_count_timed_out',
my_play_count_benar='$my_play_count_benar',
my_play_count_salah='$my_play_count_salah',
my_reject_count='$my_reject_count',
my_daily_login_count='$my_daily_login_count'



";
$q = mysqli_query($cn, $s) or die("Error @user_var_update_update. Tidak bisa menyimpan setingan baru. ".mysqli_error($cn));
echo "<h1>User Vars Update Success. Please wait system will auto refresh!</h1>";
echo '<script>location.reload()</script>';
