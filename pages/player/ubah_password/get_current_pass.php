<?php 
$s = "SELECT password FROM tb_player WHERE nickname='$cnickname'";
$q = mysqli_query($cn,$s) or die("Check password gagal. ".mysqli_error($cn));
if(mysqli_num_rows($q)==0) die("get_current_pass: Check password return NULL.");
$d = mysqli_fetch_assoc($q);
$cpassword = $d['password'];
?>