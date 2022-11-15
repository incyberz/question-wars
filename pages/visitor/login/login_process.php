<?php 
$pesan_login = 'Silahkan Anda login!';
$nickname = '';
$password = '';
// echo "<pre>"; 
// var_dump($_POST);
// echo "</pre>"; 

function filter_inject($a){
	$a = str_replace("'", '', $a);
	$a = str_replace('"', '', $a);
	$a = str_replace('=', '', $a);
	$a = str_replace(' or ', '', $a);
	$a = str_replace(' OR ', '', $a);
	$a = str_replace(' Or ', '', $a);
	$a = str_replace(' oR ', '', $a);
	return $a;
}

if(isset($_POST['btn_login'])){
	$nickname = filter_inject(filter_input(INPUT_POST, 'nickname', FILTER_SANITIZE_STRING));
	$password = filter_inject(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));

	if(strlen($nickname)<=20 and strlen($password)<=20){

		$s = "SELECT 1 FROM tb_player WHERE nickname='$nickname'";
		$q = mysqli_query($cn,$s) or die("SQL: $s. ".mysqli_error($cn));
		if(mysqli_num_rows($q)==0){
			$pesan_login = '<div class="alert alert-danger">Maaf, NIM belum terdaftar. Hubungi BAAK jika belum punya NIM. Untuk NIM baru silahkan hubungi GM dengan menyertakan info NIM, Nama, Jalur daftar, dan Kelas Pagi/Sore</div>';
		}else{
			$s = "SELECT admin_level FROM tb_player WHERE nickname='$nickname' AND password='$password'";
			$q = mysqli_query($cn,$s) or die("SQL: $s. ".mysqli_error($cn));

			if(mysqli_num_rows($q)==1){
				echo "Anda benar";
				$d = mysqli_fetch_assoc($q);
				$admin_level = $d['admin_level'];


				# =====================================================
				# LOGIN HISTORY
				# =====================================================
				$s = "SELECT auto_increment from information_schema.tables where table_schema = '$db_name' and table_name = 'tb_login'";
				$q = mysqli_query($cn,$s) or die("Error @index. Tidak dapat mengakses auto_increment login.");
				$d = mysqli_fetch_assoc($q);
				$id_login = $d['auto_increment'];

				$login_info = strtolower($_SERVER['HTTP_USER_AGENT']);
				if(strpos($login_info,'windows')){
					$tipe_os = 'Windows';
				}elseif(strpos($login_info,'windows')){
					$tipe_os = 'Android';
				}else{
					$tipe_os = 'Other';
				}
				$s = "INSERT INTO tb_login (id_login,login_info,nickname) values ($id_login,'$tipe_os','$nickname')";
				// die($s);
				$q = mysqli_query($cn,$s) or die("Error @index. Tidak dapat mencatat history login. ".mysqli_error($cn));


				# =====================================================
				# DAILY LOGIN
				# =====================================================
				$id_daily_login = date("ymd")."_$nickname";
				$s = "INSERT INTO tb_daily_login (id_daily_login,id_login) values ('$id_daily_login',$id_login)";
				$q = mysqli_query($cn,$s);




				$_SESSION['nickname'] = $nickname;
				$_SESSION['admin_level'] = $admin_level;

				echo "<script>location.replace('index.php')</script>";


			}else{

				$pesan_login = '<div class="alert alert-danger">Maaf, nickname dan password tidak tepat.</div>';

			}
		}
	}
}
?>