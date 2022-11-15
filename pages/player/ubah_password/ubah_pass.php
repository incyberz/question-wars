<section id="ubah_pass" class="player">
  <div class="container">

  	

  	<h2 class='rekom'>Change Password</h2>

  	<?php
  	$err_upas = ''; 
  	$pass_lama = ''; 
  	$pass_baru = ''; 
  	$pass_baru2 = ''; 
  	$pass_hint = ''; 
  	if(isset($_POST['btn_ubah_pass'])){
  		$pass_lama = $_POST['pass_lama'];
  		$pass_baru = $_POST['pass_baru'];
  		$pass_baru2 = $_POST['pass_baru2'];
  		$pass_hint = $_POST['pass_hint'];


  		$sql_hint = $pass_hint!='' ? '' : ",pass_hint='$pass_hint' ";

  		# ===========================================================
  		# VALIDASI UBAH PASSWORD
  		# ===========================================================
  		if($pass_lama!=$cpassword) {$err_upas = "Password lama tidak sama dengan database.";}
  		elseif($pass_baru!=$pass_baru2) {$err_upas = "Password baru tidak sama.";}
  		elseif(strlen($pass_baru)<6 or strlen($pass_baru)>20) 
  			$err_upas = "Panjang password harus antara 6 s.d 20 karakter!";

  		# ===========================================================
  		# QUERY UBAH PASSWORD
  		# ===========================================================
  		if($err_upas==''){
  			$s = "UPDATE tb_player SET password='$pass_baru' $sql_hint WHERE nickname='$cnickname'";
  			$q = mysqli_query($cn,$s) or die("gagal mengubah password. ".mysqli_error($cn));

  			echo "
  			<div class='alert alert-success'>
  			  <h2>Ubah password berhasil !</h2><hr>Harap dicatat agar tidak lupa.<hr>Hint: $pass_hint<hr>
  			  <a href='index.php' class='btn btn-primary'>OK</a>
  			</div>
  			";
  			exit();
  		}else{
  			echo "<div class='alert alert-danger'>$err_upas</div>";
  		}
  	}else{
  		if($password_sama)
  		echo '<div class="alert alert-danger">Nickname dan password kamu masih sama dan kamu wajib mengubahnya.<hr>Password lama: NIM kamu, Password baru: terserah kamu.</div>';
  	}
  	?>

  	<form method="post">

  		<div class="form-group">
  			<label>Password Lama</label>
  			<input type="password" required="" minlength="3" maxlength="20" name="pass_lama" class="form-control" value="<?=$pass_lama?>">
  		</div>

  		<div class="form-group">
  			<label>Password Baru</label>
  			<input type="password" required="" minlength="6" maxlength="20" name="pass_baru" class="form-control" value="<?=$pass_baru?>">
  		</div>

  		<div class="form-group">
  			<label>Konfirmasi Password</label>
  			<input type="password" required="" minlength="6" maxlength="20" name="pass_baru2" class="form-control" value="<?=$pass_baru2?>">
  		</div>

  		<div class="form-group hideit">
  			<label>Hint Password (opsional)</label>
  			<input type="text" minlength="3" maxlength="50" name="pass_hint" class="form-control" value="<?=$pass_hint?>">
  			<small>Untuk membantu mengingat saat kamu lupa password. Contoh:
  				<br>~ tanggal lahir dibalik!
  				<br>~ makanan favoritku?
  				<br>~ someone that I love!
  			</small>
  		</div>

  		<div class="form-group">
  			<button class="btn btn-primary" name="btn_ubah_pass">Ubah Password</button>
  		</div>
  	</form>
  </div>
</section>
