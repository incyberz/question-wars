<div id="blok_hobbies" class="blok">
	<div class="content_list">

		<div class="db_var">
			hobby1 <input id="db_hobby1" value="<?=$hobby1?>">
			<br>hobby2 <input id="db_hobby2" value="<?=$hobby2?>">
			<br>hobby3 <input id="db_hobby3" value="<?=$hobby3?>">
			<br>hobby4 <input id="db_hobby4" value="<?=$hobby4?>">
			<br>hobby5 <input id="db_hobby5" value="<?=$hobby5?>">
		</div>

		<style type="text/css">
			#hobby_banner{
				height: 200px;
				background-image: url('img/sehobby.jpg');
				background-repeat: no-repeat;
				background-size: cover;
				background-position: center;
				position: relative;
				margin-bottom: 15px;
				opacity: 75%;
				border-radius: 15px;
			}
		</style>
		<div id="hobby_banner">
			
		</div>
		<p>Masukan Maksimal 5 hobby favorit kamu!!</p>

		<table class="table table-hover">
			<tr>
				<td width="25%"><b> Hobby #1</b></td>
				<td>
					<input type="text" maxlength="30" id="hobby1" class="form-control input_text" value="<?=$hobby1 ?>">
				</td>
			</tr>
			<tr>
				<td width="25%"><b> Hobby #2</b></td>
				<td>
					<input type="text" maxlength="30" id="hobby2" class="form-control input_text" value="<?=$hobby2 ?>">
				</td>
			</tr>
			<tr>
				<td width="25%"><b> Hobby #3</b></td>
				<td>
					<input type="text" maxlength="30" id="hobby3" class="form-control input_text" value="<?=$hobby3 ?>">
				</td>
			</tr>
			<tr>
				<td width="25%"><b> Hobby #4</b></td>
				<td>
					<input type="text" maxlength="30" id="hobby4" class="form-control input_text" value="<?=$hobby4 ?>">
				</td>
			</tr>
			<tr>
				<td width="25%"><b> Hobby #5</b></td>
				<td>
					<input type="text" maxlength="30" id="hobby5" class="form-control input_text" value="<?=$hobby5 ?>">
				</td>
			</tr>
		</table>

	</div>
</div>
