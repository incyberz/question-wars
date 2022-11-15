<?php 
$rkj1 = explode("__",$riwayat_pekerjaan1);
$rkj1[1] = isset($rkj1[1]) ? $rkj1[1] : '';
$rkj1[2] = isset($rkj1[2]) ? $rkj1[2] : '';
$rkj1[3] = isset($rkj1[3]) ? $rkj1[3] : '';

$rkj2 = explode("__",$riwayat_pekerjaan2);
$rkj2[1] = isset($rkj2[1]) ? $rkj2[1] : '';
$rkj2[2] = isset($rkj2[2]) ? $rkj2[2] : '';
$rkj2[3] = isset($rkj2[3]) ? $rkj2[3] : '';

$rkj3 = explode("__",$riwayat_pekerjaan3);
$rkj3[1] = isset($rkj3[1]) ? $rkj3[1] : '';
$rkj3[2] = isset($rkj3[2]) ? $rkj3[2] : '';
$rkj3[3] = isset($rkj3[3]) ? $rkj3[3] : '';

$rkj4 = explode("__",$riwayat_pekerjaan4);
$rkj4[1] = isset($rkj4[1]) ? $rkj4[1] : '';
$rkj4[2] = isset($rkj4[2]) ? $rkj4[2] : '';
$rkj4[3] = isset($rkj4[3]) ? $rkj4[3] : '';

$rkj5 = explode("__",$riwayat_pekerjaan5);
$rkj5[1] = isset($rkj5[1]) ? $rkj5[1] : '';
$rkj5[2] = isset($rkj5[2]) ? $rkj5[2] : '';
$rkj5[3] = isset($rkj5[3]) ? $rkj5[3] : '';

?>

<div id="blok_riwayat_pekerjaan" class="blok">
	<div class="content_list">

		<div class="db_var">
			riwayat_pekerjaan1 <input id="db_riwayat_pekerjaan1" value="<?=$riwayat_pekerjaan1?>">
			<br>riwayat_pekerjaan2 <input id="db_riwayat_pekerjaan2" value="<?=$riwayat_pekerjaan2?>">
			<br>riwayat_pekerjaan3 <input id="db_riwayat_pekerjaan3" value="<?=$riwayat_pekerjaan3?>">
			<br>riwayat_pekerjaan4 <input id="db_riwayat_pekerjaan4" value="<?=$riwayat_pekerjaan4?>">
			<br>riwayat_pekerjaan5 <input id="db_riwayat_pekerjaan5" value="<?=$riwayat_pekerjaan5?>">
		</div>

		<p>Masukan Riwayat Pekerjaan secara lengkap agar dapat ditampilkan!!</p>

		<table class="table table-hover">
			<thead>
				<th colspan="3">Periode</th>
				<th>Sebagai</th>
				<th>Instansi</th>
			</thead>

			<tr>
				<td width="10%">
					<b>
						<input type="text" maxlength="4" minlength="4" id="riwayat_pekerjaan11" class="form-control input_text" value="<?=$rkj1[0] ?>">
					</b>
				</td>
				<td align="center">s.d</td>
				<td width="10%">
					<b>
						<input type="text" maxlength="4" minlength="4" id="riwayat_pekerjaan12" class="form-control input_text" value="<?=$rkj1[1] ?>">
					</b>
				</td>
				<td>
					<input type="text" maxlength="50" minlength="4" id="riwayat_pekerjaan13" class="form-control input_text" value="<?=$rkj1[2] ?>">
				</td>
				<td>
					<input type="text" maxlength="50" minlength="4" id="riwayat_pekerjaan14" class="form-control input_text" value="<?=$rkj1[3] ?>">
				</td>
			</tr>

			<tr>
				<td width="10%">
					<b>
						<input type="text" maxlength="4" minlength="4" id="riwayat_pekerjaan21" class="form-control input_text" value="<?=$rkj2[0] ?>">
					</b>
				</td>
				<td align="center">s.d</td>
				<td width="10%">
					<b>
						<input type="text" maxlength="4" minlength="4" id="riwayat_pekerjaan22" class="form-control input_text" value="<?=$rkj2[1] ?>">
					</b>
				</td>
				<td>
					<input type="text" maxlength="50" minlength="4" id="riwayat_pekerjaan23" class="form-control input_text" value="<?=$rkj2[2] ?>">
				</td>
				<td>
					<input type="text" maxlength="50" minlength="4" id="riwayat_pekerjaan24" class="form-control input_text" value="<?=$rkj2[3] ?>">
				</td>
			</tr>


			<tr>
				<td width="10%">
					<b>
						<input type="text" maxlength="4" minlength="4" id="riwayat_pekerjaan31" class="form-control input_text" value="<?=$rkj3[0] ?>">
					</b>
				</td>
				<td align="center">s.d</td>
				<td width="10%">
					<b>
						<input type="text" maxlength="4" minlength="4" id="riwayat_pekerjaan32" class="form-control input_text" value="<?=$rkj3[1] ?>">
					</b>
				</td>
				<td>
					<input type="text" maxlength="50" minlength="4" id="riwayat_pekerjaan33" class="form-control input_text" value="<?=$rkj3[2] ?>">
				</td>
				<td>
					<input type="text" maxlength="50" minlength="4" id="riwayat_pekerjaan34" class="form-control input_text" value="<?=$rkj3[3] ?>">
				</td>
			</tr>


			<tr>
				<td width="10%">
					<b>
						<input type="text" maxlength="4" minlength="4" id="riwayat_pekerjaan41" class="form-control input_text" value="<?=$rkj4[0] ?>">
					</b>
				</td>
				<td align="center">s.d</td>
				<td width="10%">
					<b>
						<input type="text" maxlength="4" minlength="4" id="riwayat_pekerjaan42" class="form-control input_text" value="<?=$rkj4[1] ?>">
					</b>
				</td>
				<td>
					<input type="text" maxlength="50" minlength="4" id="riwayat_pekerjaan43" class="form-control input_text" value="<?=$rkj4[2] ?>">
				</td>
				<td>
					<input type="text" maxlength="50" minlength="4" id="riwayat_pekerjaan44" class="form-control input_text" value="<?=$rkj4[3] ?>">
				</td>
			</tr>


			<tr>
				<td width="10%">
					<b>
						<input type="text" maxlength="4" minlength="4" id="riwayat_pekerjaan51" class="form-control input_text" value="<?=$rkj5[0] ?>">
					</b>
				</td>
				<td align="center">s.d</td>
				<td width="10%">
					<b>
						<input type="text" maxlength="4" minlength="4" id="riwayat_pekerjaan52" class="form-control input_text" value="<?=$rkj5[1] ?>">
					</b>
				</td>
				<td>
					<input type="text" maxlength="50" minlength="4" id="riwayat_pekerjaan53" class="form-control input_text" value="<?=$rkj5[2] ?>">
				</td>
				<td>
					<input type="text" maxlength="50" minlength="4" id="riwayat_pekerjaan54" class="form-control input_text" value="<?=$rkj5[3] ?>">
				</td>
			</tr>

		</table>

	</div>
</div>
