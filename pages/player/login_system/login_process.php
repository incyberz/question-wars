<?php 
# =====================================================
# LOGIN PROCESSOR
# =====================================================
$submit_nickname = filter_var(strtolower(trim($_POST['nickname2'])));
$submit_password = filter_var(trim($_POST['password2']));

$s = "SELECT 
a.admin_level,
a.nama_player,
b.* 

from tb_player a 
join tb_admin_level b on a.admin_level=b.admin_level 
where a.nickname = '$submit_nickname' 
and a.password = '$submit_password'";
$q = mysqli_query($cn, $s) or die("Error @index. Tidak dapat mengakses data player. ". mysqli_error($cn));
if(mysqli_num_rows($q)!=1) die("SQL Login error. Harus minimal satu row data. $s");
$d = mysqli_fetch_assoc($q);

$cadmin_level  = $d['admin_level'];
$cnama_player  = ucwords(strtolower($d['nama_player'])) ;
$cjenis_user  = $d['jenis_user'];

# =====================================================
# LOGIN HISTORY
# =====================================================
$s = "SELECT auto_increment from information_schema.tables where table_schema = '$db_name' and table_name = 'tb_login'";
$q = mysqli_query($cn,$s) or die("Error @index. Tidak dapat mengakses auto_increment login.");
$d = mysqli_fetch_assoc($q);
$id_login = $d['auto_increment'];

$login_info = $_SERVER['HTTP_USER_AGENT'];
$s = "INSERT INTO tb_login (id_login,login_info,nickname) values ($id_login,'$login_info','$submit_nickname')";
die($s);
$q = mysqli_query($cn,$s) or die("Error @index. Tidak dapat mencatat history login. ".mysqli_error($cn));


# =====================================================
# DAILY LOGIN
# =====================================================
$id_daily_login = date("ymd")."_$submit_nickname";
$s = "INSERT INTO tb_daily_login (id_daily_login,id_login) values ('$id_daily_login',$id_login)";
$q = mysqli_query($cn,$s);


# =====================================================
# SET LOGIN SESSION
# =====================================================
$_SESSION['nickname'] = $submit_nickname;
$_SESSION['admin_level'] = $cadmin_level;
$is_login = 1;
?>