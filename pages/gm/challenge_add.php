<?php
if ($cadmin_level==0 or $cadmin_level==1) {
    die("Maaf, fitur ini khusus untuk GM");
}
$chal_name = '';
$chal_desc = '';
$pesan = '';

if (isset($_POST['btn_add_challenge'])) {
    $chal_name = $_POST['chal_name'];
    $chal_level = $_POST['chal_level'];
    $chal_desc = $_POST['chal_desc'];
    // DEBUG DANGER ZONE
    $min_point = intval($_POST['min_point']);
    $max_point = intval($_POST['max_point']);

    if ($max_point<$min_point) {
        die("max_point lebih kecil dari min_point");
    }
    if ($max_point<2000) {
        die("max_point kurang dari 2000 LP");
    }
    if ($min_point<1000) {
        die("min_point kurang dari 1000 LP");
    }

    $s = "INSERT INTO tb_chal (
	
	id_room, chal_level, chal_creator, chal_name, chal_desc, min_point, max_point
	) values (
	
	'$cid_room', '$chal_level', '$cnickname', '$chal_name', '$chal_desc', '$min_point', '$max_point'

	)";

    // die($s);

    if (mysqli_query($cn, $s)) {
        $pesan= "<div class='alert alert-success'>
		Sukses menyimpan challenge baru.<hr>
		<a href='?chal' class='btn btn-primary btn-sm'>Back to Challenge List</a> 
		<a href='?addchal' class='btn btn-success btn-sm'>Add New Challenge</a> 
		</div>";
    } else {
        $pesan= "<div class='alert alert-danger'>
		Gagal menyimpan challenge baru. Silahkan cek kembali input yang Anda masukan. ".mysqli_error($cn)."
		</div>";

        // $pesan .= "$s. ". mysqli_error($cn); //debug
    }

    $pesan.="<hr>";
}
?>

<section id="add_chal" class="gm">
	<div class="container">
		<?=$pesan?>
		<?php if ($pesan=="") { ?>
			<h3>Add Challenge</h3>
			<p><a href="?managechal">Manage Chal</a> | Challenge digunakan untuk mengukur keaktifan player di bidang praktikum, kerja kelompok, atau praktik lapangan. Silahkan Anda buat challenge sesuai dengan materi pada Room <?=$nama_room?>.</p>

			<form method="post" action="?addchal">
				<div class="form-group">
					<label>Nama Challenge</label>
					<input type="text" class="form-control" name="chal_name" required minlength="10" maxlength="100" value="<?=$chal_name?>">
					<small>Length: 10 s.d 100; Contoh: Membuat aplikasi kalkulator dengan HTML5</small>
				</div>

				<div class="form-group">
					<label>Challenge Level</label>
					<select class="form-control" name="chal_level">
						<?php
                        $s = "SELECT * from tb_chal_level order by rank_level";
		    $q = mysqli_query($cn, $s) or die("Tidak bisa mengakses data challenge level");
		    while ($d=mysqli_fetch_assoc($q)) {
		        $chal_level = ucwords($d['chal_level']);
		        echo "<option>$chal_level</option>";
		    }
		    ?>
					</select>
					<small>Sesuaikan antara level challenge dengan range point yang ditawarkan!</small>
				</div>


				<div class="form-group">
					<label>Range Point</label>
					<table width="100%">
						<tr>
							<td>
								<input type="number" class="form-control" name="min_point" required min="1000" max="1000000" value="1000" value="<?=$min_point?>">			
							</td>
							<td align="center">s.d</td>
							<td>
								<input type="number" class="form-control" name="max_point" required min="2000" max="10000000" value="2000" value="<?=$max_point?>">			
							</td>
						</tr>
					</table>

					<small>Contoh: 1000 s.d 2000 LP</small>
				</div>

				<div class="form-group">
					<label>Descriptions / Petunjuk Pengerjaan</label>
					<textarea class="form-control" rows="5" name="chal_desc" id="chal_desc" required minlength="30" maxlength="5000"><?=$chal_desc?></textarea>
					<small>Length: 30 s.d 5000; Contoh: Untuk membuat kalkulator dengan HTML5, kamu boleh membuatnya pake teks editor apa saja. Cara pengumpulan yaitu dengan membuat video rekaman hasil testing kalkulator pada browser. Video diunggah di youtube dan link videonya di posting di QWars Challenge!</small>
				</div>



				<div class="form-group">
					<button class="btn btn-primary btn-block" name="btn_add_challenge" id="btn_add_challenge">Add Challenge</button>
				</div>
			</form>

		<?php } ?>
		

	</div>
</section>