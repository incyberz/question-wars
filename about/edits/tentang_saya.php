<div id="blok_tentang_saya" class="blok">

	<div class="content_list">

		<div class="db_var">
			tentang_saya <input id="db_tentang_saya" value="<?=$tentang_saya?>">
			<br>motto_hidup <input id="db_motto_hidup" value="<?=$motto_hidup?>">
			<br>motto_belajar <input id="db_motto_belajar" value="<?=$motto_belajar?>">
		</div>

		<table class="table table-hover">
			<tr>
				<td width="25%"><b>Tentang Saya</b></td>
				<td>
					<textarea rows="5" class="form-control input_text" id="tentang_saya"><?=$tentang_saya ?></textarea>
				</td>
			</tr>
			<tr>
				<td><b>Motto Hidup</b></td>
				<td>
					<input type="text" id="motto_hidup" class="form-control input_text" value="<?=$motto_hidup ?>">
				</td>
			</tr>
			<tr>
				<td><b>Motto Belajar</b></td>
				<td>
					<input type="text" id="motto_belajar" class="form-control input_text" value="<?=$motto_belajar ?>">
				</td>
			</tr>
		</table>

	</div>
</div>
