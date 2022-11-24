<?php if (!isset($_SESSION)) {
    session_start();
} ?>
<link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap/css/bootstrap.min.css">
<script src="assets/vendor/jquery/jquery.min.js"></script>
<style>body{margin: 0; padding: 0; overflow: hidden; background: linear-gradient(#505,#202);}</style>
<div style="margin: 0 auto 0 auto; max-width: 500px; height: 100vh; background: linear-gradient(#cfc, #ccf); padding: 15px;padding-top: 10px;">
	<h1>Reset Password</h1>
	<hr>

	<?php

    if (isset($_GET['confirm'])) {
        $cnickname = isset($_SESSION['nickname']) ? $_SESSION['nickname'] : '';
        $cadmin_level = isset($_SESSION['admin_level']) ? $_SESSION['admin_level'] : 0;

        // echo "<pre>";
        // var_dump($_SESSION);
        // echo "</pre>";


        if ($cnickname!='abi' and $cadmin_level<2) {
            die('Maaf, hanya GM yang berhak mengakses halaman ini.<hr><a href="https://qwars.online" target="_blank">Login</a>');
        }

        include 'config.php';
        $nickname = isset($_GET['nickname']) ? $_GET['nickname'] : '';
        $no_wa = isset($_GET['no_wa']) ? $_GET['no_wa'] : '';
        if ($nickname=='') {
            die('Index nickname masih kosong.');
        }
        if ($no_wa=='') {
            die('Index no_wa masih kosong.');
        }

        $s = "UPDATE tb_player SET password='$nickname',no_wa='$no_wa' where nickname='$nickname'";
        $q = mysqli_query($cn, $s) or die(mysqli_error($cn));

        $saat_ini = date('D, Y-m-d H:i:s');
        echo "$s<hr>Sukses<hr><a href='https://api.whatsapp.com/send?phone=62$no_wa&text=Noreply: password Anda telah berhasil direset ke nim: $nickname [QWars Gamified Systems, $saat_ini]'>Reply</a>";



        exit();
    }



    $wa_dosen = '6287729007318'; //zzz
$nickname = isset($_GET['nickname']) ? $_GET['nickname'] : die('Halaman ini tidak bisa diakses secara langsung.');

$a = (rand() % 10)+1;
$b = (rand() % 11)+1;
$c = $a + $b;

if (isset($_POST['c2'])) {
    $c = $_POST['c'];
    $c2 = $_POST['c2'];
    $nickname = $_POST['nickname'];
    $no_wa = $_POST['no_wa'];

    if ($c!=$c2) {
        die("Capthca tidak sesuai. Silahkan <a href='?resetpass&nickname=$nickname'>coba lagi!</a>");
    }

    ?>

		<div>Tahapan yang harus Anda ikuti:</div>
		<ul>
			<li>Silahkan masukan penyataan bahwa kamu memang benar-benar lupa password.</li>
			<li>Lalu ceklis Checkbox</li>
			<li>Klik "Request Reset Password"</li>
			<li>Maka akan diteruskan ke Whatsapp Dosen</li>
			<li>Tunggulah hingga GM mereset password kamu kembali ke NIM (mungkin saja dosen Off-WA pada saat diluar jam kerja)</li>
		</ul>

		<textarea class="form-control" placeholder="Yth. Bapak/Ibu ... saya Salwa Fatimah menyatakan bahwa saya ..." id="pernyataan"></textarea>

		<p>
			<input type="hidden" name="no_wa" id="no_wa" value="<?=$no_wa?>"> 
			<input type="checkbox" name="cb_nim_saya" id="cb_nim_saya" required="" disabled=""> 
			<label for="cb_nim_saya">Saya menyatakan bahwa NIM <code id="nickname"><?=$nickname?></code> adalah NIM milik saya</label>
		</p>

		<div id="blok_req" style="display: none;">
			<a id="link_wa" class="btn btn-primary btn-block" target="_blank">
				<img src="assets/img/icons/wa.png" height="30px"> 
				Request Reset Password
			</a>
		
		</div>
		
	<?php } else { ?>

			<p>Untuk reset password nim: <code style="color: darkblue;"><?=$nickname ?></code> silahkan masukan no whatsApp dan capthca berikut!</p>
			<form method="post">
				<code>
					<input type="hidden" value="<?=$c?>" name="c">
					<input type="hidden" value="<?=$nickname?>" name="nickname">
					<input type="text" name="no_wa" minlength="10" maxlength="13" required="" class="form-control input-sm">
					<small>Gunakan nomor whatsApp yang aktif agar dapat diproses lebih lanjut</small>
					<hr>
					<?=$a?> + <?=$b?> = <input type="text" minlength="1" maxlength="3" required="" name="c2" size="2"> 
				</code>
				<button class="btn btn-primary btn-sm">Submit</button>
			</form>

	<?php } ?>

</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#cb_nim_saya').click(function(){
			let iscek = $(this).prop('checked');
			if(iscek){
				$('#blok_req').slideDown();
				// alert('slideDown');
			}else{
				$('#blok_req').slideUp();
			}

		})

		$('#pernyataan').keyup(function(){
			let pernyataan = $(this).val();
			let no_wa = $('#no_wa').val();
			if(pernyataan.trim().length<10){
				$('#cb_nim_saya').prop('disabled',true);				
			}else{
				$('#cb_nim_saya').prop('disabled',false);

				let nickname = $('#nickname').text();
				let link_reset = encodeURIComponent(`https://qwars.online/?resetpass&confirm=1&nickname=${nickname}&no_wa=${no_wa}`)

				$('#link_wa').prop('href',`https://api.whatsapp.com/send?phone=6287729007318&text=${pernyataan}%0a%0a${link_reset}`)				

			}

		})
	})
</script>