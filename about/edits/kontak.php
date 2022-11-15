<div id="blok_kontak" class="blok">
	<div class="content_list">

		<div class="db_var">
			no_wa <input id="db_no_wa" value="<?=$no_wa?>">
			<br>no_wa_ayah <input id="db_no_wa_ayah" value="<?=$no_wa_ayah?>">
			<br>no_wa_ibu <input id="db_no_wa_ibu" value="<?=$no_wa_ibu?>">
			<br>no_hp <input id="db_no_hp" value="<?=$no_hp?>">
			<br>email <input id="db_email" value="<?=$email?>">
			<br>website <input id="db_website" value="<?=$website?>">
			<br>facebook <input id="db_facebook" value="<?=$facebook?>">
			<br>twitter <input id="db_twitter" value="<?=$twitter?>">
			<br>instagram <input id="db_instagram" value="<?=$instagram?>">
			<br>youtube <input id="db_youtube" value="<?=$youtube?>">
			<br>linkedin <input id="db_linkedin" value="<?=$linkedin?>">
		</div>

		<table class="table table-hover">
			<tr>
				<td width="25%"><b>Nomor WhatsApp</b></td>
				<td>
					<input type="text" class="form-control input_text" id="no_wa" value="<?=$no_wa ?>">
				</td>
				<td>
					<select class="form-control visibility" id="visibility_no_wa">
						<option value="0" class="set_only_me">Only Me</option>
						<option value="2" class="set_public">Public</option>
						<option value="1" selected="" class="set_fo">Friends Only</option>
					</select>
				</td>
			</tr>

			<tr>
				<td width="25%"><b>Nomor WhatsApp Ayah</b></td>
				<td>
					<input type="text" class="form-control input_text" id="no_wa_ayah" value="<?=$no_wa_ayah ?>">
				</td>
				<td>
					<select class="form-control visibility" id="visibility_no_wa_ayah">
						<option value="0" selected="" class="set_only_me">Only Me</option>
						<option value="2" class="set_public">Public</option>
						<option value="1" class="set_fo">Friends Only</option>
					</select>
				</td>
			</tr>

			<tr>
				<td width="25%"><b>Nomor WhatsApp Ibu</b></td>
				<td>
					<input type="text" class="form-control input_text" id="no_wa_ibu" value="<?=$no_wa_ibu ?>">
				</td>
				<td>
					<select class="form-control visibility" id="visibility_no_wa_ibu">
						<option value="0" selected="" class="set_only_me">Only Me</option>
						<option value="2" class="set_public">Public</option>
						<option value="1" class="set_fo">Friends Only</option>
					</select>
				</td>
			</tr>

			<tr>
				<td width="25%"><b>Nomor HP</b></td>
				<td>
					<input type="text" class="form-control input_text" id="no_hp" value="<?=$no_hp ?>">
				</td>
				<td>
					<select class="form-control visibility" id="visibility_no_hp">
						<option value="0" selected="" class="set_only_me">Only Me</option>
						<option value="2" class="set_public">Public</option>
						<option value="1" class="set_fo">Friends Only</option>
					</select>
				</td>
			</tr>

			<tr>
				<td width="25%"><b>Email / GMail</b></td>
				<td>
					<input type="text" class="form-control input_text" id="email" value="<?=$email ?>">
				</td>
				<td>
					<select class="form-control visibility" id="visibility_email">
						<option value="0" class="set_only_me">Only Me</option>
						<option value="2" selected="" class="set_public">Public</option>
						<option value="1" class="set_fo">Friends Only</option>
					</select>
				</td>
			</tr>

			<tr>
				<td width="25%"><b>Website / Homepage</b></td>
				<td>
					<input type="text" class="form-control input_text" id="website" value="<?=$website ?>">
				</td>
				<td>
					<select class="form-control visibility" id="visibility_website">
						<option value="0" class="set_only_me">Only Me</option>
						<option value="2" selected="" class="set_public">Public</option>
						<option value="1" class="set_fo">Friends Only</option>
					</select>
				</td>
			</tr>

			<tr>
				<td width="25%"><b>Link Facebook</b></td>
				<td>
					<input type="text" class="form-control input_text" id="facebook" value="<?=$facebook ?>">
				</td>
				<td>
					<select class="form-control visibility" id="visibility_facebook">
						<option value="0" class="set_only_me">Only Me</option>
						<option value="2" class="set_public">Public</option>
						<option value="1" selected="" class="set_fo">Friends Only</option>
					</select>
				</td>
			</tr>

			<tr>
				<td width="25%"><b>Link Twitter</b></td>
				<td>
					<input type="text" class="form-control input_text" id="twitter" value="<?=$twitter ?>">
				</td>
				<td>
					<select class="form-control visibility" id="visibility_twitter">
						<option value="0" class="set_only_me">Only Me</option>
						<option value="2" class="set_public">Public</option>
						<option value="1" selected="" class="set_fo">Friends Only</option>
					</select>
				</td>
			</tr>

			<tr>
				<td width="25%"><b>Link Instagram</b></td>
				<td>
					<input type="text" class="form-control input_text" id="instagram" value="<?=$instagram ?>">
				</td>
				<td>
					<select class="form-control visibility" id="visibility_instagram">
						<option value="0" class="set_only_me">Only Me</option>
						<option value="2" class="set_public">Public</option>
						<option value="1" selected="" class="set_fo">Friends Only</option>
					</select>
				</td>
			</tr>

			<tr>
				<td width="25%"><b>Channel Youtube</b></td>
				<td>
					<input type="text" class="form-control input_text" id="youtube" value="<?=$youtube ?>">
				</td>
				<td>
					<select class="form-control visibility" id="visibility_youtube">
						<option value="0" class="set_only_me">Only Me</option>
						<option value="2" class="set_public">Public</option>
						<option value="1" selected="" class="set_fo">Friends Only</option>
					</select>
				</td>
			</tr>

			<tr>
				<td width="25%"><b>LinkedIN</b></td>
				<td>
					<input type="text" class="form-control input_text" id="linkedin" value="<?=$linkedin ?>">
				</td>
				<td>
					<select class="form-control visibility" id="visibility_linkedin">
						<option value="0" class="set_only_me">Only Me</option>
						<option value="2" class="set_public">Public</option>
						<option value="1" selected="" class="set_fo">Friends Only</option>
					</select>
				</td>
			</tr>


		</table>

	</div>
</div>