<?php
if (!isset($_GET['id_chal'])) {
    die("Challenge id not set.");
} $id_chal = $_GET['id_chal'];
$proof_link = '';
if (isset($_POST['proof_link'])) {
    $proof_link = $_POST['proof_link'];
}

$input_harus_mengandung = '';
$input_tidak_mengandung = '';

//zzz debug
$input_harus_mengandung = "
<div class='alert alert-warning'>
<h4>Ketentuan Link</h4>
<div>Input link wajib mengandung kata-kata berikut:</div>
<ul>
	<li>https://</li>

</ul>
</div>
";

$input_tidak_mengandung = "
<div class='alert alert-warning'>
<div>Link tidak boleh mengandung kata-kata berikut:</div>
<ul>
	<li>file://</li>
	<li>localhost</li>
</ul>
</div>
";


$s = "SELECT a.* from tb_chal a where a.id_chal=$id_chal";
$q = mysqli_query($cn, $s) or die("Tidak bisa mengakses data challenge. id_chal:$id_chal");
$d = mysqli_fetch_assoc($q);

$chal_name = $d['chal_name'];
$chal_level = $d['chal_level'];
$chal_desc = $d['chal_desc'];
$min_point = $d['min_point'];
$max_point = $d['max_point'];
$chal_created = $d['chal_created'];
$chal_creator = $d['chal_creator'];

$chal_details = "
<h4 style='color:#7ff'>$chal_name</h4>
~ Level : $chal_level
<br>~ Range Points : $min_point - $max_point LP
<br>~ Created by : $chal_creator <small>at $chal_created</small>
<div class='wadah' style='margin:10px 0'><small>$chal_desc</small></div>
";

$pesan = '';

if (isset($_POST['btn_submit_proof'])) {
    $id_chal = strip_tags($_POST['id_chal']);
    $proof_link = strip_tags($_POST['proof_link']);

    $id_chal_beatenby = $id_chal."_$cnickname";

    $s = "INSERT INTO tb_chal_beatenby (
	
	id_chal_beatenby, id_chal, beaten_by, proof_link
	) values (
	'$id_chal_beatenby', '$id_chal', '$cnickname', '$proof_link')";


    if (mysqli_query($cn, $s)) {
        $pesan= "<div class='alert alert-success'>
		Sukses submit bukti challenge. <br><br>Tunggu hingga GM memverifikasi bukti yang kamu kirim. Terimakasih.<hr>
		<a href='?chaldet&id_chal=$id_chal' class='btn btn-primary btn-sm'>Back to Challenge Detail</a> 
		</div><hr>";
    } else {
        $r = mysqli_error($cn);
        $pesan= "<div class='alert alert-danger'>
		Gagal submit bukti challenge. $r
		<hr>
		<a href='?chaldet&id_chal=$id_chal' class='btn btn-primary btn-sm'>Back to Challenge Details</a>
		</div><hr>";
    }
}

?>

<section id="beat_chal" class="gm">
	<div class="container">
		<?=$pesan?>
		<?php if ($pesan=="") { ?>
			<p><?=$link_back?> | Submit Hasil Challenge!</p>
			<h4 style='color:#7ff'><?=$chal_name?></h4>
			<p>Silahkan kamu masukan link Youtube/Google Drive atau link lainnya sebagai bukti bahwa kamu telah melaksanakan challenge tersebut. Harap bersabar karena verifikasi challenge praktikum dilakukan secara manual oleh GM. Kamu boleh mengklaim reward setelah link bukti diverifikasi oleh GM.</p>
			<p>Jika kamu belum membaca aturan challenge dengan seksama silahkan <a href="javascript:history.go(-1)">baca dahulu petunjuknya</a>.</p>

			<?=$input_harus_mengandung ?>
			<?=$input_tidak_mengandung ?>


			<form method="post" action="?chalbeat&id_chal=<?=$id_chal?>">
				<input type="hidden" name="id_chal" value="<?=$id_chal?>">


				<div class="form-group">
					<label>Paste Link Bukti Pengerjaan kamu disini !!</label>
					<input type="text" class="form-control" name="proof_link" required minlength="15" maxlength="200" value="<?=$proof_link?>">

					<div>Silahkan copas dari alamat browser atau get-link Google Drive yang telah di set public terlebih dahulu!</div>
					<ul>
						<li>misal: <code>https://youtube.com/watch?v=asdf123</code></li>
						<li>misal: <code>https://drive.google.com/file/d/115AhLcUjf</code></li>
					</ul>

				</div>

				<div class="form-group">
					<button class="btn btn-primary btn-block" name="btn_submit_proof">Submit Bukti Challenge</button>
				</div>
			</form>

		<?php } ?>
		

	</div>
</section>