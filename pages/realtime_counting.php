<?php


$s = "SELECT count(1) from tb_soal_playedby";
$q = mysqli_query($cn, $s) or die("Tidak bisa menghitung soal playedby");
$d = mysqli_fetch_assoc($q);
$jumlah_played_questions = $d['count(1)'];

$s = "SELECT count(1) from tb_soal_rejectby";
$q = mysqli_query($cn, $s) or die("Tidak bisa menghitung jumlah rejecter");
$d = mysqli_fetch_assoc($q);
$jumlah_rejecter = $d['count(1)'];

$s = "SELECT count(1) from tb_soal";
$q = mysqli_query($cn, $s) or die("Tidak bisa menghitung total soal");
$d = mysqli_fetch_assoc($q);
$jumlah_created_questions = $d['count(1)'];

$s = "SELECT count(1) from tb_player where admin_level=1 and status_aktif=1";
$q = mysqli_query($cn, $s) or die("Tidak bisa menghitung total player");
$d = mysqli_fetch_assoc($q);
$jumlah_active_players = $d['count(1)'];

$s = "SELECT count(1) from tb_player where (admin_level=2 or admin_level=9) and status_aktif=1";
$q = mysqli_query($cn, $s) or die("Tidak bisa menghitung total gm");
$d = mysqli_fetch_assoc($q);
$jumlah_active_gm = $d['count(1)'];

$s = "SELECT count(1) from tb_room where status_room=1";
$q = mysqli_query($cn, $s) or die("Tidak bisa menghitung total room");
$d = mysqli_fetch_assoc($q);
$jumlah_active_rooms = $d['count(1)'];

$s = "SELECT count(1) from tb_chal";
$q = mysqli_query($cn, $s) or die("Tidak bisa menghitung total challenge");
$d = mysqli_fetch_assoc($q);
$my_chal_countlenges = $d['count(1)'];

$jumlah_wars_activity = $jumlah_played_questions + $jumlah_rejecter + $jumlah_created_questions;
