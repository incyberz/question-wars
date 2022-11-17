<?php
$id_skill_level = isset($_GET['id_skill_level']) ? $_GET['id_skill_level'] : die("id_skill_level not set.");
$proof_link = isset($_POST['proof_link']) ? $_POST['proof_link'] : '';

$s = "SELECT * from tb_chal a 
join tb_chal_skill_level b on a.id_chal=b.id_chal 
where b.id_skill_level=$id_skill_level";
$q = mysqli_query($cn, $s) or die("Tidak bisa mengakses data challenge. id_chal:$id_chal");
$d = mysqli_fetch_assoc($q);

$id_chal = $d['id_chal'];
$chal_name = $d['chal_name'];
$chal_level = $d['chal_level'];
$chal_desc = $d['chal_desc'];
$min_point = $d['min_point'];
$max_point = $d['max_point'];

// $speed_point = $d['speed_point'];
// $ontime_in_days = $d['ontime_in_days'];
// $deadline_in_days = $d['deadline_in_days'];

$chal_created = $d['chal_created'];
$chal_creator = $d['chal_creator'];

$sifat_chal = $d['sifat_chal'];
$input_harus_mengandung = $d['input_harus_mengandung'];
$input_tidak_mengandung = $d['input_tidak_mengandung'];




# ===================================================
# JUDUL PAGE
# ===================================================
$judul_page = "<p>$link_back | Submit Hasil Challenge!</p>
			<h4 style='color:#7ff'>$d[chal_name]</h4>
			<p>Silahkan kamu masukan link Youtube/Google Drive atau link lainnya sebagai bukti bahwa kamu telah melaksanakan challenge tersebut. Harap bersabar karena verifikasi challenge praktikum dilakukan secara manual oleh GM. Kamu boleh mengklaim reward setelah link bukti diverifikasi oleh GM.</p>
			<p>Jika kamu belum membaca aturan challenge dengan seksama silahkan <a href='javascript:history.go(-1)'>baca dahulu petunjuknya</a>.</p>
      ";





function get_point_now($batas_ontime, $deadline_in_days, $speed_point)
{
    return intval((strtotime(date('Y-m-d H:i:s', strtotime($batas_ontime.' + 7 days'))) - strtotime(date('Y-m-d H:i:s'))) / ($deadline_in_days * 24 * 60 * 60) *$speed_point);
}


# ===================================================
# TOTAL POINT CALCULATION
# ===================================================
$speed_point = $d['speed_point'];
$batas_ontime = $d['batas_ontime']!='' ? $d['batas_ontime'] : die('Batas ontime belum ditentukan.');

$selisih = strtotime(date('Y-m-d H:i:s')) - strtotime($batas_ontime);


if ($selisih<0) {
    $speed_point_now = $speed_point;
    $sudah_deadline = 'Kamu masih bisa upload bukti challenge secara ontime.';
} else {
    if ($selisih < (($d['deadline_in_days']) * 24 * 60 * 60)) {
        $speed_point_now = get_point_now($batas_ontime, $d['deadline_in_days'], $d['speed_point']);
        $sudah_deadline = 'Kamu melebihi batas ontime dan kamu masih berhak mendapatkan speed point.';
    } else {
        $speed_point_now = 0;
        $sudah_deadline = 'Maaf, kamu sudah melebihi deadline dan tidak mendapatkan speed point.';
    }
}
$total_point = $d['poin_skill_level'] + $speed_point_now;

$poin_skill_level_show = number_format($d['poin_skill_level'], 0);
$speed_point_now_show = number_format($speed_point_now, 0);
$total_point_show = number_format($total_point, 0);


$total_point_show = "<div class=wadah><h5>Total Points Reward</h5>
<ul><li>Batas ontime: $batas_ontime</li><li>$sudah_deadline</li></ul>
<p>Point calculation:</p>
<table class=table>
  <tr>
    <td>
      Skill Point <code>::</code> $d[nama_skill_level]
      <div><span class='badge badge-success'>Syarat: </span>&nbsp;<small> $d[syarat_skill_level]</small></div>
    </td>
    <td align=right>$poin_skill_level_show LP</td>
  </tr>
  <tr>
    <td>Speed Point</td>
    <td align=right>$speed_point_now_show LP</td>
  </tr>
  <tr>
    <td>GM Point</td>
    <td align=right>? LP</td>
  </tr>
  <tr>
    <td align=right>Estimasi Poin yang kamu dapatkan:</td>
    <td align=right><h5>~$total_point_show LP</h5></td>
  </tr>
</table>
</div>
";





# ===================================================
# INPUT WAJIB MENGANDUNG
# ===================================================
if ($input_harus_mengandung!='') {
    $arr = explode(';;', $input_harus_mengandung);
    $input_harus_mengandung = '<div class=wadah><h5>Link Submit wajib mengandung salah satu kata berikut:</h5><ol>';
    for ($i=0;$i<count($arr);$i++) {
        $input_harus_mengandung .= "<li><code>$arr[$i]</code></li>";
    }
    $input_harus_mengandung .= '</ol></div>';
}

# ===================================================
# TIDAK BOLEH MENGANDUNG
# ===================================================
if ($input_tidak_mengandung!='') {
    $arr = explode(';;', $input_tidak_mengandung);
    $input_tidak_mengandung = '<div class=wadah><h5>Link Submit tidak boleh mengandung salah satu kata berikut:</h5><ol>';
    for ($i=0;$i<count($arr);$i++) {
        $input_tidak_mengandung .= "<li><code>$arr[$i]</code></li>";
    }
    $input_tidak_mengandung .= '</ol></div>';
}

# =======================================================
# CEK JIKA PLAYER SUDAH BEAT
# =======================================================
$s = "SELECT 1 from tb_chal_beatenby where id_chal=$d[id_chal] and beaten_by='$cnickname'";
$q = mysqli_query($cn, $s) or die("Tidak bisa mengecek is_exist beatenby. id_chal:$id_chal");
if (mysqli_num_rows($q)==1) {
    $btn_beat = "<div class='row'><div class='col-lg-4 offset-lg-4'><button class='btn btn-danger btn-block' style='margin-top:15px' disabled>Kamu sudah melaksanakannya.</button></div></div>";
} else {
    $btn_beat = "<div class='row'><div class='col-lg-4 offset-lg-4'><a href='?chalbeat&id_chal=$d[id_chal]' class='btn btn-primary btn-block' style='margin-top:15px'>Submit Hasil Challenge!</a></div></div>";
}


$chal_details = "
<h4 style='color:#7ff'>$chal_name</h4>
~ Level : $chal_level
<br>~ Range Points : $min_point - $max_point LP
<br>~ Created by : $chal_creator <small>at $chal_created</small>
<div class='wadah' style='margin:10px 0'><small>$chal_desc</small></div>
";

$pesan = '';


# =======================================================
# FORM PROCESSOR
# =======================================================
if (isset($_POST['btn_submit_proof'])) {
    $id_chal = strip_tags($_POST['id_chal']);
    $id_skill_level = strip_tags($_POST['id_skill_level']);
    $proof_link = strip_tags($_POST['proof_link']);

    $id_chal_beatenby = $id_chal."_$cnickname";

    $s = "INSERT INTO tb_chal_beatenby (
	
	id_chal_beatenbys, id_chal, beaten_by, proof_link
	) values (
	'$id_chal_beatenby', '$id_chal', '$cnickname', '$proof_link')";


    if (mysqli_query($cn, $s)) {
        $pesan= "<div class='alert alert-success'>
		  Sukses submit bukti challenge. <br><br>Tunggu hingga GM memverifikasi bukti yang kamu kirim. Terimakasih.<hr>
		<a href='?chal' class='btn btn-primary btn-sm'>Back to Challenge List</a> 
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

<style>.wadah{ margin:15px 0 } code { font-size:100%}</style>
<section id="beat_chal" class="gm">
	<div class="container">
		<?=$pesan?>
		<?php
    if ($pesan=="") {
        echo "$judul_page $total_point_show $input_harus_mengandung $input_tidak_mengandung";
        ?>


			<form method="post" action="?chalbeat&id_chal=<?=$id_chal?>">
				<input type="hiddena" name="id_chal" value="<?=$id_chal?>">
				<input type="hiddena" name="id_skill_level" value="<?=$id_skill_level?>">


				<div class="form-group">
					<label>Paste Link Bukti Pengerjaan kamu disini !!</label>
					<input type="text" class="form-control" name="proof_link" required minlength="15" maxlength="200" value="<?=$proof_link?>">

					<div>&nbsp;</div>
          <div><span class='badge badge-danger'>Perhatian! Bukti akan di-Banned jika tidak sesuai dengan persyaratan.</span></div>

				</div>

				<div class="form-group">
					<button class="btn btn-primary btn-block" name="btn_submit_proof">Submit Bukti Challenge</button>
				</div>
			</form>

		<?php } ?>
		

	</div>
</section>