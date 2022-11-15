<?php 
$rsf1 = explode("__",$riwayat_sertifikasi1);
$rsf1[1] = isset($rsf1[1]) ? $rsf1[1] : '';
$rsf1[2] = isset($rsf1[2]) ? $rsf1[2] : '';
$rsf1[3] = isset($rsf1[3]) ? $rsf1[3] : '';

$rsf2 = explode("__",$riwayat_sertifikasi2);
$rsf2[1] = isset($rsf2[1]) ? $rsf2[1] : '';
$rsf2[2] = isset($rsf2[2]) ? $rsf2[2] : '';
$rsf2[3] = isset($rsf2[3]) ? $rsf2[3] : '';

$rsf3 = explode("__",$riwayat_sertifikasi3);
$rsf3[1] = isset($rsf3[1]) ? $rsf3[1] : '';
$rsf3[2] = isset($rsf3[2]) ? $rsf3[2] : '';
$rsf3[3] = isset($rsf3[3]) ? $rsf3[3] : '';

$rsf4 = explode("__",$riwayat_sertifikasi4);
$rsf4[1] = isset($rsf4[1]) ? $rsf4[1] : '';
$rsf4[2] = isset($rsf4[2]) ? $rsf4[2] : '';
$rsf4[3] = isset($rsf4[3]) ? $rsf4[3] : '';

$rsf5 = explode("__",$riwayat_sertifikasi5);
$rsf5[1] = isset($rsf5[1]) ? $rsf5[1] : '';
$rsf5[2] = isset($rsf5[2]) ? $rsf5[2] : '';
$rsf5[3] = isset($rsf5[3]) ? $rsf5[3] : '';

?>

<div id="blok_riwayat_sertifikasi" class="blok">
	<div class="content_list">

		<div class="db_var">
			riwayat_sertifikasi1 <input id="db_riwayat_sertifikasi1" value="<?=$riwayat_sertifikasi1?>">
			<br>riwayat_sertifikasi2 <input id="db_riwayat_sertifikasi2" value="<?=$riwayat_sertifikasi2?>">
			<br>riwayat_sertifikasi3 <input id="db_riwayat_sertifikasi3" value="<?=$riwayat_sertifikasi3?>">
			<br>riwayat_sertifikasi4 <input id="db_riwayat_sertifikasi4" value="<?=$riwayat_sertifikasi4?>">
			<br>riwayat_sertifikasi5 <input id="db_riwayat_sertifikasi5" value="<?=$riwayat_sertifikasi5?>">
		</div>

		<p>Silahkan Masukan Sertifikat Kursus/Training Anda!!</p>

		<table class="table table-hover">
			<thead>
				<th colspan="3">Periode</th>
				<th>Jenis Sertifikasi</th>
				<th>Lembaga Pelatihan</th>
			</thead>

			<tr>
				<td width="10%">
					<b>
						<input type="text" maxlength="4" minlength="4" id="riwayat_sertifikasi11" class="form-control input_text" value="<?=$rsf1[0] ?>">
					</b>
				</td>
				<td align="center">s.d</td>
				<td width="10%">
					<b>
						<input type="text" maxlength="4" minlength="4" id="riwayat_sertifikasi12" class="form-control input_text" value="<?=$rsf1[1] ?>">
					</b>
				</td>
				<td>
					<input type="text" maxlength="50" minlength="4" id="riwayat_sertifikasi13" class="form-control input_text" value="<?=$rsf1[2] ?>">
				</td>
				<td>
					<input type="text" maxlength="50" minlength="4" id="riwayat_sertifikasi14" class="form-control input_text" value="<?=$rsf1[3] ?>">
				</td>
			</tr>

			<tr>
				<td width="10%">
					<b>
						<input type="text" maxlength="4" minlength="4" id="riwayat_sertifikasi21" class="form-control input_text" value="<?=$rsf2[0] ?>">
					</b>
				</td>
				<td align="center">s.d</td>
				<td width="10%">
					<b>
						<input type="text" maxlength="4" minlength="4" id="riwayat_sertifikasi22" class="form-control input_text" value="<?=$rsf2[1] ?>">
					</b>
				</td>
				<td>
					<input type="text" maxlength="50" minlength="4" id="riwayat_sertifikasi23" class="form-control input_text" value="<?=$rsf2[2] ?>">
				</td>
				<td>
					<input type="text" maxlength="50" minlength="4" id="riwayat_sertifikasi24" class="form-control input_text" value="<?=$rsf2[3] ?>">
				</td>
			</tr>


			<tr>
				<td width="10%">
					<b>
						<input type="text" maxlength="4" minlength="4" id="riwayat_sertifikasi31" class="form-control input_text" value="<?=$rsf3[0] ?>">
					</b>
				</td>
				<td align="center">s.d</td>
				<td width="10%">
					<b>
						<input type="text" maxlength="4" minlength="4" id="riwayat_sertifikasi32" class="form-control input_text" value="<?=$rsf3[1] ?>">
					</b>
				</td>
				<td>
					<input type="text" maxlength="50" minlength="4" id="riwayat_sertifikasi33" class="form-control input_text" value="<?=$rsf3[2] ?>">
				</td>
				<td>
					<input type="text" maxlength="50" minlength="4" id="riwayat_sertifikasi34" class="form-control input_text" value="<?=$rsf3[3] ?>">
				</td>
			</tr>


			<tr>
				<td width="10%">
					<b>
						<input type="text" maxlength="4" minlength="4" id="riwayat_sertifikasi41" class="form-control input_text" value="<?=$rsf4[0] ?>">
					</b>
				</td>
				<td align="center">s.d</td>
				<td width="10%">
					<b>
						<input type="text" maxlength="4" minlength="4" id="riwayat_sertifikasi42" class="form-control input_text" value="<?=$rsf4[1] ?>">
					</b>
				</td>
				<td>
					<input type="text" maxlength="50" minlength="4" id="riwayat_sertifikasi43" class="form-control input_text" value="<?=$rsf4[2] ?>">
				</td>
				<td>
					<input type="text" maxlength="50" minlength="4" id="riwayat_sertifikasi44" class="form-control input_text" value="<?=$rsf4[3] ?>">
				</td>
			</tr>


			<tr>
				<td width="10%">
					<b>
						<input type="text" maxlength="4" minlength="4" id="riwayat_sertifikasi51" class="form-control input_text" value="<?=$rsf5[0] ?>">
					</b>
				</td>
				<td align="center">s.d</td>
				<td width="10%">
					<b>
						<input type="text" maxlength="4" minlength="4" id="riwayat_sertifikasi52" class="form-control input_text" value="<?=$rsf5[1] ?>">
					</b>
				</td>
				<td>
					<input type="text" maxlength="50" minlength="4" id="riwayat_sertifikasi53" class="form-control input_text" value="<?=$rsf5[2] ?>">
				</td>
				<td>
					<input type="text" maxlength="50" minlength="4" id="riwayat_sertifikasi54" class="form-control input_text" value="<?=$rsf5[3] ?>">
				</td>
			</tr>

		</table>

	</div>
</div>
