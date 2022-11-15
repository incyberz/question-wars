<div id="blok_skill_bahasa" class="blok">
	<div class="content_list">

		<div class="db_var">
			skillba_ep <input id="db_skillba_ep" value="<?=$skillba_ep?>">
			<br>skillba_ec <input id="db_skillba_ec" value="<?=$skillba_ec?>">
			<br>skillba_ba <input id="db_skillba_ba" value="<?=$skillba_ba?>">
			<br>skillba_ps <input id="db_skillba_ps" value="<?=$skillba_ps?>">
			<br>skillba_mc <input id="db_skillba_mc" value="<?=$skillba_mc?>">
		</div>

		<p>Masukan Level Skill dengan angka antara 0 s.d 100 !</p>

		<table class="table table-hover">
			<tr>
				<td width="25%"><b>English Passive</b></td>
				<td>
					<input type="number" min="0" max="100" id="skillba_ep" class="form-control input_text" value="<?=$skillba_ep ?>">
				</td>
			</tr>
			<tr>
				<td width="25%"><b>English Conversation</b></td>
				<td>
					<input type="number" min="0" max="100" id="skillba_ec" class="form-control input_text" value="<?=$skillba_ec ?>">
				</td>
			</tr>
			<tr>
				<td width="25%"><b>Bahasa Asing Lainnya</b></td>
				<td>
					<input type="number" min="0" max="100" id="skillba_ba" class="form-control input_text" value="<?=$skillba_ba ?>">
				</td>
			</tr>
			<tr>
				<td width="25%"><b>Public Speaking / Pidato</b></td>
				<td>
					<input type="number" min="0" max="100" id="skillba_ps" class="form-control input_text" value="<?=$skillba_ps ?>">
				</td>
			</tr>
			<tr>
				<td width="25%"><b>MC / Pembawa Acara</b></td>
				<td>
					<input type="number" min="0" max="100" id="skillba_mc" class="form-control input_text" value="<?=$skillba_mc ?>">
				</td>
			</tr>
		</table>

	</div>
</div>
