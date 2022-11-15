<div id="blok_skill_komputer" class="blok">
	<div class="content_list">

		<div class="db_var">
			skillko_of <input id="db_skillko_of" value="<?=$skillko_of?>">
			<br>skillko_pr <input id="db_skillko_pr" value="<?=$skillko_pr?>">
			<br>skillko_dg <input id="db_skillko_dg" value="<?=$skillko_dg?>">
			<br>skillko_mm <input id="db_skillko_mm" value="<?=$skillko_mm?>">
			<br>skillko_nt <input id="db_skillko_nt" value="<?=$skillko_nt?>">
		</div>

		<p>Masukan Level Skill dengan angka antara 0 s.d 100 !</p>

		<table class="table table-hover">
			<tr>
				<td width="25%"><b> Aplikasi Office</b></td>
				<td>
					<input type="number" min="0" max="100" id="skillko_of" class="form-control input_text" value="<?=$skillko_of ?>">
				</td>
			</tr>
			<tr>
				<td width="25%"><b> Pemrograman</b></td>
				<td>
					<input type="number" min="0" max="100" id="skillko_pr" class="form-control input_text" value="<?=$skillko_pr ?>">
				</td>
			</tr>
			<tr>
				<td width="25%"><b> Desain Grafis</b></td>
				<td>
					<input type="number" min="0" max="100" id="skillko_dg" class="form-control input_text" value="<?=$skillko_dg ?>">
				</td>
			</tr>
			<tr>
				<td width="25%"><b> Multimedia</b></td>
				<td>
					<input type="number" min="0" max="100" id="skillko_mm" class="form-control input_text" value="<?=$skillko_mm ?>">
				</td>
			</tr>
			<tr>
				<td width="25%"><b> Networking</b></td>
				<td>
					<input type="number" min="0" max="100" id="skillko_nt" class="form-control input_text" value="<?=$skillko_nt ?>">
				</td>
			</tr>
		</table>

	</div>
</div>
