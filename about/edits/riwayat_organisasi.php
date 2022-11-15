<?php 
$rog1 = explode("__",$riwayat_organisasi1);
$rog1[1] = isset($rog1[1]) ? $rog1[1] : '';
$rog1[2] = isset($rog1[2]) ? $rog1[2] : '';
$rog1[3] = isset($rog1[3]) ? $rog1[3] : '';

$rog2 = explode("__",$riwayat_organisasi2);
$rog2[1] = isset($rog2[1]) ? $rog2[1] : '';
$rog2[2] = isset($rog2[2]) ? $rog2[2] : '';
$rog2[3] = isset($rog2[3]) ? $rog2[3] : '';

$rog3 = explode("__",$riwayat_organisasi3);
$rog3[1] = isset($rog3[1]) ? $rog3[1] : '';
$rog3[2] = isset($rog3[2]) ? $rog3[2] : '';
$rog3[3] = isset($rog3[3]) ? $rog3[3] : '';

$rog4 = explode("__",$riwayat_organisasi4);
$rog4[1] = isset($rog4[1]) ? $rog4[1] : '';
$rog4[2] = isset($rog4[2]) ? $rog4[2] : '';
$rog4[3] = isset($rog4[3]) ? $rog4[3] : '';

$rog5 = explode("__",$riwayat_organisasi5);
$rog5[1] = isset($rog5[1]) ? $rog5[1] : '';
$rog5[2] = isset($rog5[2]) ? $rog5[2] : '';
$rog5[3] = isset($rog5[3]) ? $rog5[3] : '';

?>

<div id="blok_riwayat_organisasi" class="blok">
	<div class="content_list">

		<div class="db_var">
			riwayat_organisasi1 <input id="db_riwayat_organisasi1" value="<?=$riwayat_organisasi1?>">
			<br>riwayat_organisasi2 <input id="db_riwayat_organisasi2" value="<?=$riwayat_organisasi2?>">
			<br>riwayat_organisasi3 <input id="db_riwayat_organisasi3" value="<?=$riwayat_organisasi3?>">
			<br>riwayat_organisasi4 <input id="db_riwayat_organisasi4" value="<?=$riwayat_organisasi4?>">
			<br>riwayat_organisasi5 <input id="db_riwayat_organisasi5" value="<?=$riwayat_organisasi5?>">
		</div>

		<p>Silahkan Masukan Riwayat Organisasi Anda!!</p>

		<table class="table table-hover">
			<thead>
				<th colspan="3">Periode</th>
				<th>Organisasi</th>
				<th>Jabatan</th>
			</thead>

			<tr>
				<td width="10%">
					<b>
						<input type="text" maxlength="4" minlength="4" id="riwayat_organisasi11" class="form-control input_text" value="<?=$rog1[0] ?>">
					</b>
				</td>
				<td align="center">s.d</td>
				<td width="10%">
					<b>
						<input type="text" maxlength="4" minlength="4" id="riwayat_organisasi12" class="form-control input_text" value="<?=$rog1[1] ?>">
					</b>
				</td>
				<td>
					<input type="text" maxlength="50" minlength="4" id="riwayat_organisasi13" class="form-control input_text" value="<?=$rog1[2] ?>">
				</td>
				<td>
					<input type="text" maxlength="50" minlength="4" id="riwayat_organisasi14" class="form-control input_text" value="<?=$rog1[3] ?>">
				</td>
			</tr>

			<tr>
				<td width="10%">
					<b>
						<input type="text" maxlength="4" minlength="4" id="riwayat_organisasi21" class="form-control input_text" value="<?=$rog2[0] ?>">
					</b>
				</td>
				<td align="center">s.d</td>
				<td width="10%">
					<b>
						<input type="text" maxlength="4" minlength="4" id="riwayat_organisasi22" class="form-control input_text" value="<?=$rog2[1] ?>">
					</b>
				</td>
				<td>
					<input type="text" maxlength="50" minlength="4" id="riwayat_organisasi23" class="form-control input_text" value="<?=$rog2[2] ?>">
				</td>
				<td>
					<input type="text" maxlength="50" minlength="4" id="riwayat_organisasi24" class="form-control input_text" value="<?=$rog2[3] ?>">
				</td>
			</tr>


			<tr>
				<td width="10%">
					<b>
						<input type="text" maxlength="4" minlength="4" id="riwayat_organisasi31" class="form-control input_text" value="<?=$rog3[0] ?>">
					</b>
				</td>
				<td align="center">s.d</td>
				<td width="10%">
					<b>
						<input type="text" maxlength="4" minlength="4" id="riwayat_organisasi32" class="form-control input_text" value="<?=$rog3[1] ?>">
					</b>
				</td>
				<td>
					<input type="text" maxlength="50" minlength="4" id="riwayat_organisasi33" class="form-control input_text" value="<?=$rog3[2] ?>">
				</td>
				<td>
					<input type="text" maxlength="50" minlength="4" id="riwayat_organisasi34" class="form-control input_text" value="<?=$rog3[3] ?>">
				</td>
			</tr>


			<tr>
				<td width="10%">
					<b>
						<input type="text" maxlength="4" minlength="4" id="riwayat_organisasi41" class="form-control input_text" value="<?=$rog4[0] ?>">
					</b>
				</td>
				<td align="center">s.d</td>
				<td width="10%">
					<b>
						<input type="text" maxlength="4" minlength="4" id="riwayat_organisasi42" class="form-control input_text" value="<?=$rog4[1] ?>">
					</b>
				</td>
				<td>
					<input type="text" maxlength="50" minlength="4" id="riwayat_organisasi43" class="form-control input_text" value="<?=$rog4[2] ?>">
				</td>
				<td>
					<input type="text" maxlength="50" minlength="4" id="riwayat_organisasi44" class="form-control input_text" value="<?=$rog4[3] ?>">
				</td>
			</tr>


			<tr>
				<td width="10%">
					<b>
						<input type="text" maxlength="4" minlength="4" id="riwayat_organisasi51" class="form-control input_text" value="<?=$rog5[0] ?>">
					</b>
				</td>
				<td align="center">s.d</td>
				<td width="10%">
					<b>
						<input type="text" maxlength="4" minlength="4" id="riwayat_organisasi52" class="form-control input_text" value="<?=$rog5[1] ?>">
					</b>
				</td>
				<td>
					<input type="text" maxlength="50" minlength="4" id="riwayat_organisasi53" class="form-control input_text" value="<?=$rog5[2] ?>">
				</td>
				<td>
					<input type="text" maxlength="50" minlength="4" id="riwayat_organisasi54" class="form-control input_text" value="<?=$rog5[3] ?>">
				</td>
			</tr>

		</table>

	</div>
</div>
