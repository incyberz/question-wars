<?php 
$rp1 = explode("__",$riwayat_pendidikan1);
$rp1[1] = isset($rp1[1]) ? $rp1[1] : '';
$rp1[2] = isset($rp1[2]) ? $rp1[2] : '';
$rp1[3] = isset($rp1[3]) ? $rp1[3] : '';

$rp2 = explode("__",$riwayat_pendidikan2);
$rp2[1] = isset($rp2[1]) ? $rp2[1] : '';
$rp2[2] = isset($rp2[2]) ? $rp2[2] : '';
$rp2[3] = isset($rp2[3]) ? $rp2[3] : '';

$rp3 = explode("__",$riwayat_pendidikan3);
$rp3[1] = isset($rp3[1]) ? $rp3[1] : '';
$rp3[2] = isset($rp3[2]) ? $rp3[2] : '';
$rp3[3] = isset($rp3[3]) ? $rp3[3] : '';

$rp4 = explode("__",$riwayat_pendidikan4);
$rp4[1] = isset($rp4[1]) ? $rp4[1] : '';
$rp4[2] = isset($rp4[2]) ? $rp4[2] : '';
$rp4[3] = isset($rp4[3]) ? $rp4[3] : '';

$rp5 = explode("__",$riwayat_pendidikan5);
$rp5[1] = isset($rp5[1]) ? $rp5[1] : '';
$rp5[2] = isset($rp5[2]) ? $rp5[2] : '';
$rp5[3] = isset($rp5[3]) ? $rp5[3] : '';

?>

<div id="blok_riwayat_pendidikan" class="blok">
	<div class="content_list">

		<div class="db_var">
			riwayat_pendidikan1 <input id="db_riwayat_pendidikan1" value="<?=$riwayat_pendidikan1?>">
			<br>riwayat_pendidikan2 <input id="db_riwayat_pendidikan2" value="<?=$riwayat_pendidikan2?>">
			<br>riwayat_pendidikan3 <input id="db_riwayat_pendidikan3" value="<?=$riwayat_pendidikan3?>">
			<br>riwayat_pendidikan4 <input id="db_riwayat_pendidikan4" value="<?=$riwayat_pendidikan4?>">
			<br>riwayat_pendidikan5 <input id="db_riwayat_pendidikan5" value="<?=$riwayat_pendidikan5?>">
		</div>

		<p>Masukan Riwayat Pendidikan secara lengkap agar dapat ditampilkan!!</p>

		<table class="table table-hover">
			<thead>
				<th colspan="3">Periode</th>
				<th>Jurusan</th>
				<th>Sekolah</th>
			</thead>

			<tr>
				<td width="10%">
					<b>
						<input type="text" maxlength="4" minlength="4" id="riwayat_pendidikan11" class="form-control input_text" value="<?=$rp1[0] ?>">
					</b>
				</td>
				<td align="center">s.d</td>
				<td width="10%">
					<b>
						<input type="text" maxlength="4" minlength="4" id="riwayat_pendidikan12" class="form-control input_text" value="<?=$rp1[1] ?>">
					</b>
				</td>
				<td>
					<input type="text" maxlength="50" minlength="4" id="riwayat_pendidikan13" class="form-control input_text" value="<?=$rp1[2] ?>">
				</td>
				<td>
					<input type="text" maxlength="50" minlength="4" id="riwayat_pendidikan14" class="form-control input_text" value="<?=$rp1[3] ?>">
				</td>
			</tr>

			<tr>
				<td width="10%">
					<b>
						<input type="text" maxlength="4" minlength="4" id="riwayat_pendidikan21" class="form-control input_text" value="<?=$rp2[0] ?>">
					</b>
				</td>
				<td align="center">s.d</td>
				<td width="10%">
					<b>
						<input type="text" maxlength="4" minlength="4" id="riwayat_pendidikan22" class="form-control input_text" value="<?=$rp2[1] ?>">
					</b>
				</td>
				<td>
					<input type="text" maxlength="50" minlength="4" id="riwayat_pendidikan23" class="form-control input_text" value="<?=$rp2[2] ?>">
				</td>
				<td>
					<input type="text" maxlength="50" minlength="4" id="riwayat_pendidikan24" class="form-control input_text" value="<?=$rp2[3] ?>">
				</td>
			</tr>


			<tr>
				<td width="10%">
					<b>
						<input type="text" maxlength="4" minlength="4" id="riwayat_pendidikan31" class="form-control input_text" value="<?=$rp3[0] ?>">
					</b>
				</td>
				<td align="center">s.d</td>
				<td width="10%">
					<b>
						<input type="text" maxlength="4" minlength="4" id="riwayat_pendidikan32" class="form-control input_text" value="<?=$rp3[1] ?>">
					</b>
				</td>
				<td>
					<input type="text" maxlength="50" minlength="4" id="riwayat_pendidikan33" class="form-control input_text" value="<?=$rp3[2] ?>">
				</td>
				<td>
					<input type="text" maxlength="50" minlength="4" id="riwayat_pendidikan34" class="form-control input_text" value="<?=$rp3[3] ?>">
				</td>
			</tr>


			<tr>
				<td width="10%">
					<b>
						<input type="text" maxlength="4" minlength="4" id="riwayat_pendidikan41" class="form-control input_text" value="<?=$rp4[0] ?>">
					</b>
				</td>
				<td align="center">s.d</td>
				<td width="10%">
					<b>
						<input type="text" maxlength="4" minlength="4" id="riwayat_pendidikan42" class="form-control input_text" value="<?=$rp4[1] ?>">
					</b>
				</td>
				<td>
					<input type="text" maxlength="50" minlength="4" id="riwayat_pendidikan43" class="form-control input_text" value="<?=$rp4[2] ?>">
				</td>
				<td>
					<input type="text" maxlength="50" minlength="4" id="riwayat_pendidikan44" class="form-control input_text" value="<?=$rp4[3] ?>">
				</td>
			</tr>


			<tr>
				<td width="10%">
					<b>
						<input type="text" maxlength="4" minlength="4" id="riwayat_pendidikan51" class="form-control input_text" value="<?=$rp5[0] ?>">
					</b>
				</td>
				<td align="center">s.d</td>
				<td width="10%">
					<b>
						<input type="text" maxlength="4" minlength="4" id="riwayat_pendidikan52" class="form-control input_text" value="<?=$rp5[1] ?>">
					</b>
				</td>
				<td>
					<input type="text" maxlength="50" minlength="4" id="riwayat_pendidikan53" class="form-control input_text" value="<?=$rp5[2] ?>">
				</td>
				<td>
					<input type="text" maxlength="50" minlength="4" id="riwayat_pendidikan54" class="form-control input_text" value="<?=$rp5[3] ?>">
				</td>
			</tr>

		</table>

	</div>
</div>
