<?php

# ================================================
# ROOM_VARS UPDATE
# ================================================







# ================================================
# TOTAL PLAYER IN ROOM
# ================================================
$s = "SELECT 1 from tb_room_player a 
    join tb_player b ON a.nickname = b.nickname 
    WHERE b.status_aktif = 1 
    and a.id_room = $cid_room 
    and b.admin_level = 1 
    ";

$q = mysqli_query($cn, $s) or die("Error @room_var_update. Gagal menghitung total_player");
$total_player = mysqli_num_rows($q);




# ================================================
# JUMLAH PLAYER IN KELAS
# ================================================
if ($kelas=='') {
    die('Error @room_var_updated. Player belum dimasukan ke grup-kelas.');
} else {
    $s = "SELECT 1 
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
}





# ================================================
# JUMLAH PLAYER IN PRODI
# ================================================
if ($prodi=='') {
    die('Error @room_var_updated. Player belum dimasukan ke grup-prodi.');
} else {
    $s = "SELECT 1  
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
}









# ================================================
# TOTAL SOAL
# ================================================
$s = "SELECT 1 from tb_soal a 
JOIN tb_room_subject b on a.id_room_subject=b.id_room_subject 
JOIN tb_room c on b.id_room=c.id_room 
WHERE c.id_room='$cid_room'
";
$q = mysqli_query($cn, $s) or die("Error @room_var_update. Tidak bisa menghitung total_soal. ".mysqli_error($cn));
$total_soal = mysqli_num_rows($q);











# ================================================
# TOTAL CHAL
# ================================================
$s = "SELECT 1 from tb_chal WHERE id_room='$cid_room' and chal_visibility=1";
$q = mysqli_query($cn, $s) or die("Error @room_var_update. Tidak bisa menghitung total challenge. ".mysqli_error($cn));
$total_chal = mysqli_num_rows($q);






# ================================================
# SUM CHAL POINT
# ================================================
$s = "SELECT sum(score_for_player) as sum_chal_point from tb_chal_beatenby a 
join tb_chal b on a.id_chal=b.id_chal 
WHERE b.id_room='$cid_room' 
and b.chal_visibility=1 
";
$q = mysqli_query($cn, $s) or die("Error @room_var_update. Tidak bisa menghitung sum_chal_point. ".mysqli_error($cn));
if (mysqli_num_rows($q)!=1) {
    die("Error @room_var_update: menghitung sum_chal_point");
}
$d=mysqli_fetch_assoc($q);
$sum_chal_point = $d['sum_chal_point'];


















# ================================================
# TOTAL AKTIF PLAYER
# ================================================
$s = "SELECT count(1) as total_aktif_player from tb_room_player a 
join tb_player b on a.nickname=b.nickname 
WHERE a.id_room='$cid_room' 
AND room_player_point>0  
AND b.admin_level = 1 
AND b.status_aktif = 1
";
$q = mysqli_query($cn, $s) or die("Error @room_var_update. Tidak bisa menghitung total_aktif_player. ".mysqli_error($cn));
$d = mysqli_fetch_assoc($q);
$total_aktif_player = $d['total_aktif_player'];









# ================================================
# PLAY KUIS COUNT
# ================================================
$s = "SELECT count(1) as play_kuis_count from tb_soal_playedby a 
JOIN tb_soal b on a.id_soal=b.id_soal 
JOIN tb_room_subject c on b.id_room_subject=c.id_room_subject 
JOIN tb_room d on c.id_room=d.id_room 
WHERE d.id_room='$cid_room' 
";
$q = mysqli_query($cn, $s) or die("Error @room_var_update. Tidak bisa menghitung play_kuis_count. ".mysqli_error($cn));
if (mysqli_num_rows($q)>0) {
    $d = mysqli_fetch_assoc($q);
    $play_kuis_count = $d['play_kuis_count'];
}




# ================================================
# MAX CHAL POINT
# ================================================
$max_chal_point=0;
$s = "SELECT (SELECT sum(z.score_for_player) from tb_chal_beatenby z 
JOIN tb_chal y on z.id_chal=y.id_chal 
WHERE z.beaten_by=a.nickname and y.id_room='$cid_room') as max_chal_point
from tb_room_player a JOIN tb_room b on a.id_room=b.id_room 
WHERE b.id_room='$cid_room' order by max_chal_point desc limit 1";
$q = mysqli_query($cn, $s) or die("Error @room_var_update. Tidak bisa menghitung max_chal_point. ".mysqli_error($cn));
$d = mysqli_fetch_assoc($q);
$max_chal_point = $d['max_chal_point'];





# ================================================
# TOTAL PRESENSI
# ================================================
$s = "SELECT 1 from tb_room_subject WHERE id_room='$cid_room' and nama_subject not like '%materi umum%'";
$q = mysqli_query($cn, $s) or die("Error @room_var_update. Tidak bisa menghitung total_presensi. ".mysqli_error($cn));
$total_presensi = mysqli_num_rows($q);



# ================================================
# SAVE room_var_update
# ================================================
$id_room_var = $cid_room.'_'.date('ymd');
$s = "INSERT INTO tmp_room_var (
id_room_var,
id_room,
tanggal_update,
total_player,
total_presensi_saat_ini,
total_presensi,
total_soal,
total_chal,
sum_chal_point,
play_kuis_count,
total_aktif_player,
max_chal_point

) VALUES (

'$id_room_var',
'$cid_room',
CURRENT_TIMESTAMP,
'$total_player',
'$total_presensi_saat_ini',
'$total_presensi',
'$total_soal',
'$total_chal',
'$sum_chal_point',
'$play_kuis_count',
'$total_aktif_player',
'$max_chal_point'


) ON DUPLICATE KEY UPDATE 

tanggal_update=CURRENT_TIMESTAMP,
total_player='$total_player',
total_presensi_saat_ini='$total_presensi_saat_ini',
total_presensi='$total_presensi',
total_soal='$total_soal',
total_chal='$total_chal',
sum_chal_point='$sum_chal_point',
play_kuis_count='$play_kuis_count',
total_aktif_player='$total_aktif_player',
max_chal_point='$max_chal_point'


";
$q = mysqli_query($cn, $s) or die("Error @room_var_update_update. Tidak bisa menyimpan setingan baru. ".mysqli_error($cn));
echo "<h1>Room Update Success</h1>";
echo '<script>location.reload()</script>';
