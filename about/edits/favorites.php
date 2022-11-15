<div id="blok_favorites" class="blok">
	<div class="content_list">

		<div class="db_var">
			makanan_favorit <input id="db_makanan_favorit" value="<?=$makanan_favorit?>">
			<br>minuman_favorit <input id="db_minuman_favorit" value="<?=$minuman_favorit?>">
			<br>warna_favorit <input id="db_warna_favorit" value="<?=$warna_favorit?>">

			<?php 
			$makanan_favorit = ";$makanan_favorit";
			$makanan_favorit = explode("__", $makanan_favorit);
			if(!isset($makanan_favorit[1])) $makanan_favorit[1] = '';
			if(!isset($makanan_favorit[2])) $makanan_favorit[2] = '';
			if(!isset($makanan_favorit[3])) $makanan_favorit[3] = '';

			$minuman_favorit = ";$minuman_favorit";
			$minuman_favorit = explode("__", $minuman_favorit);
			if(!isset($minuman_favorit[1])) $minuman_favorit[1] = '';
			if(!isset($minuman_favorit[2])) $minuman_favorit[2] = '';
			if(!isset($minuman_favorit[3])) $minuman_favorit[3] = '';

			$warna_favorit = ";$warna_favorit";
			$warna_favorit = explode("__", $warna_favorit);
			if(!isset($warna_favorit[1])) $warna_favorit[1] = '';
			if(!isset($warna_favorit[2])) $warna_favorit[2] = '';
			if(!isset($warna_favorit[3])) $warna_favorit[3] = '';

			?>
		</div>

		<p><b>Apa yang menjadi Favorit Kamu ?</b></p>

		<table class="table table-hover">
			<tr>
				<td width="25%"><b>Makanan Favorit</b></td>
				<td>
					<input type="text" maxlength="30" id="makanan_favorit1" class="form-control input_text" value="<?=$makanan_favorit[1] ?>">
					<input type="text" maxlength="30" id="makanan_favorit2" class="form-control input_text" value="<?=$makanan_favorit[2] ?>">
					<input type="text" maxlength="30" id="makanan_favorit3" class="form-control input_text" value="<?=$makanan_favorit[3] ?>">
				</td>
				<td>
					<select class="form-control visibility" id="visibility_makanan_favorit">
						<option value="0" class="set_only_me">Only Me</option>
						<option value="2" class="set_public">Public</option>
						<option value="1" selected="" class="set_fo">Friends Only</option>
					</select>
				</td>
			</tr>
			<tr>
				<td width="25%"><b>Minuman Favorit</b></td>
				<td>
					<input type="text" maxlength="30" id="minuman_favorit1" class="form-control input_text" value="<?=$minuman_favorit[1] ?>">
					<input type="text" maxlength="30" id="minuman_favorit2" class="form-control input_text" value="<?=$minuman_favorit[2] ?>">
					<input type="text" maxlength="30" id="minuman_favorit3" class="form-control input_text" value="<?=$minuman_favorit[3] ?>">
				</td>
				<td>
					<select class="form-control visibility" id="visibility_minuman_favorit">
						<option value="0" class="set_only_me">Only Me</option>
						<option value="2" class="set_public">Public</option>
						<option value="1" selected="" class="set_fo">Friends Only</option>
					</select>
				</td>
			</tr>
			<tr>
				<td width="25%"><b>Warna Favorit</b></td>
				<td>
					<input type="text" maxlength="30" id="warna_favorit1" class="form-control input_text" value="<?=$warna_favorit[1] ?>">
					<input type="text" maxlength="30" id="warna_favorit2" class="form-control input_text" value="<?=$warna_favorit[2] ?>">
					<input type="text" maxlength="30" id="warna_favorit3" class="form-control input_text" value="<?=$warna_favorit[3] ?>">
				</td>
				<td>
					<select class="form-control visibility" id="visibility_warna_favorit">
						<option value="0" class="set_only_me">Only Me</option>
						<option value="2" class="set_public">Public</option>
						<option value="1" selected="" class="set_fo">Friends Only</option>
					</select>
				</td>
			</tr>
		</table>

	</div>
</div>
