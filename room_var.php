<?php

if ($cid_room>0) {
    # ================================================
    # ROOM_VARS
    # ================================================

    # ================================================
    # ROOM PROPERTIES
    $total_player = 0;
    $jumlah_player_in_kelas = 0;
    $jumlah_player_in_prodi = 0;



    # ================================================
    # ROOM_VARS :: PRESENSI
    $total_presensi = 0;

    # ================================================
    # ROOM_VARS :: SOAL

    # ================================================
    # ROOM_VARS :: CHALLENGES
    $total_chal = 0;
    $sum_chal_point = 0;

    # ================================================
    # ROOM_VARS :: CHALLENGE TUGAS
    $jumlah_tugas = 0;
    $total_tugas = 0;
    $total_aktif_player = 0;

    # ================================================
    # OUTPUT PERSEN




























    # ================================================
    # GET DATA ROOM
    # ================================================
    $s = "SELECT * from tb_room a 
	where a.id_room = '$cid_room'";
    $q = mysqli_query($cn, $s) or die("Error @room_var. Can't get data room");
    $d = mysqli_fetch_assoc($q);

    $nama_room  = ucwords(strtolower($d['nama_room']));
    $room_created  = $d['room_created'];
    $senin_p1  = $d['senin_p1'];
    $senin_p9  = $d['senin_p9'];
    $room_active_points  = $d['room_active_points'];


    # ================================================
    # SUBJECTS OF ROOM
    # ================================================
    $nama_subject_options = '';
    $s = "SELECT * from tb_room_subject a 
	join tb_room b on a.id_room = b.id_room  
	where b.id_room = '$cid_room'";
    $q = mysqli_query($cn, $s) or die("Error room_var2 Can't get data room".mysqli_error($cn));

    if (mysqli_num_rows($q)>0) {
        while ($d2 = mysqli_fetch_assoc($q)) {
            $nama_subject = $d2['nama_subject'];
            $id_room_subject = $d2['id_room_subject'];
            $nama_subject_options .= "<option value='$id_room_subject'>$nama_subject</option>";
        }
    } else {
        $s = "INSERT INTO tb_room_subject (id_room,nama_subject) values ($cid_room,'MATERI UMUM $nama_room')";
        if ($dm) {
            $q = mysqli_query($cn, $s) or die("Error room_var3 Insert new room subjects <hr>SQL: $s<hr> ".mysqli_error($cn));
        } else {
            $q = mysqli_query($cn, $s) or die("Error room_var3 Insert new room subjects");
        }

        if ($q) {
            $s = "SELECT * from tb_room_subject a 
			join tb_room b on a.id_room = b.id_room  
			where b.id_room = '$cid_room'";
            $q = mysqli_query($cn, $s) or die("Error room_var4 Can't get data room");

            $d2 = mysqli_fetch_assoc($q);
            $nama_subject = $d2['nama_subject'];
            $id_room_subject = $d2['id_room_subject'];
            $nama_subject_options .= "<option value='$id_room_subject'>$nama_subject</option>";
        }
    }


    # ================================================
    # GET TMP ROOM VAR
    # ================================================
    $id_room_var = $cid_room.'_'.date('ymd');
    $s = "SELECT * from tmp_room_var where id_room_var = '$id_room_var'";
    $q = mysqli_query($cn, $s) or die("Error @room_var. Can't get tmp room var");
    if (mysqli_num_rows($q)) {
        $need_update_room_var = 0;
        $d = mysqli_fetch_assoc($q);

        $tanggal_update = $d['tanggal_update'];
        $total_player = $d['total_player'];
        $total_aktif_player = $d['total_aktif_player'];
        $total_presensi_saat_ini = $d['total_presensi_saat_ini'];
        $total_presensi = $d['total_presensi'];
        $total_soal = $d['total_soal'];
        $total_chal = $d['total_chal'];
        $sum_chal_point = $d['sum_chal_point'];
        $play_kuis_count = $d['play_kuis_count'];
        $max_chal_point = $d['max_chal_point'];
    } else {
        $need_update_room_var = 1;
        include 'room_var_update.php';
    }

    // echo "tanggal_update: $tanggal_update need_update_room_var: $need_update_room_var ";
}
