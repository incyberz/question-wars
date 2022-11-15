<div id="blok_data_pribadi" class="blok">
	<div class="content_list">

		<div class="db_var">
			<br>tempat_lahir <input id="db_tempat_lahir" value="<?=$tempat_lahir?>">
			<br>tanggal_lahir <input id="db_tanggal_lahir" value="<?=$tanggal_lahir?>">
			<br>gender <input id="db_gender" value="<?=$gender?>">
			<br>agama <input id="db_agama" value="<?=$agama?>">
			<br>status_menikah <input id="db_status_menikah" value="<?=$status_menikah?>">
			<br>warga_negara <input id="db_warga_negara" value="<?=$warga_negara?>">
			<br>anak_ke <input id="db_anak_ke" value="<?=$anak_ke?>">
			<br>jumlah_saudara <input id="db_jumlah_saudara" value="<?=$jumlah_saudara?>">
			<br>tinggal_bersama <input id="db_tinggal_bersama" value="<?=$tinggal_bersama?>">
			<br>jenis_kendaraan <input id="db_jenis_kendaraan" value="<?=$jenis_kendaraan?>">
			<br>jenis_rumah <input id="db_jenis_rumah" value="<?=$jenis_rumah?>">

			<?php 
			$ch_gender_L = $gender=="L" ? "checked" : '';
			$ch_gender_P = $gender=="P" ? "checked" : '';

			$ch_agama_1 = $agama=="1" ? "checked" : '';
			$ch_agama_2 = $agama=="2" ? "checked" : '';
			$ch_agama_3 = $agama=="3" ? "checked" : '';
			$ch_agama_4 = $agama=="4" ? "checked" : '';
			$ch_agama_5 = $agama=="5" ? "checked" : '';
			$ch_agama_6 = $agama=="6" ? "checked" : '';

			$ch_status_menikah_1 = $status_menikah=="1" ? "checked" : '';
			$ch_status_menikah_2 = $status_menikah=="2" ? "checked" : '';
			$ch_status_menikah_3 = $status_menikah=="3" ? "checked" : '';

			$ch_warga_negara_1 = $warga_negara=="1" ? "checked" : '';
			$ch_warga_negara_2 = $warga_negara=="2" ? "checked" : '';

			$ch_tinggal_bersama_1 = $tinggal_bersama=="1" ? "checked" : '';
			$ch_tinggal_bersama_2 = $tinggal_bersama=="2" ? "checked" : '';
			$ch_tinggal_bersama_3 = $tinggal_bersama=="3" ? "checked" : '';
			$ch_tinggal_bersama_4 = $tinggal_bersama=="4" ? "checked" : '';
			$ch_tinggal_bersama_5 = $tinggal_bersama=="5" ? "checked" : '';
			$ch_tinggal_bersama_6 = $tinggal_bersama=="6" ? "checked" : '';

			$ch_jenis_kendaraan_1 = $jenis_kendaraan=="1" ? "checked" : '';
			$ch_jenis_kendaraan_2 = $jenis_kendaraan=="2" ? "checked" : '';
			$ch_jenis_kendaraan_3 = $jenis_kendaraan=="3" ? "checked" : '';
			$ch_jenis_kendaraan_4 = $jenis_kendaraan=="4" ? "checked" : '';
			$ch_jenis_kendaraan_5 = $jenis_kendaraan=="5" ? "checked" : '';

			$ch_jenis_rumah_1 = $jenis_rumah=="1" ? "checked" : '';
			$ch_jenis_rumah_2 = $jenis_rumah=="2" ? "checked" : '';
			$ch_jenis_rumah_3 = $jenis_rumah=="3" ? "checked" : '';

			?>

		</div>

		<table class="table table-hover">
			<tr>
				<td width="25%"><b>Alamat Blok/RT/RW/Desa</b></td>
				<td>
					<textarea class="form-control input_text" id="alamat_blok" ><?=$alamat_blok ?></textarea>
				</td>
				<td>
					<select class="form-control visibility" id="visibility_alamat_blok">
						<option value="0" selected="" class="set_only_me">Only Me</option>
						<option value="2" class="set_public">Public</option>
						<option value="1" class="set_fo">Friends Only</option>
					</select>
				</td>
			</tr>
			<tr>
				<td width="25%"><b>Kecamatan / Kabupaten</b></td>
				<td>
					<input type="text" class="form-control input_text" id="alamat_kec" value="<?=$alamat_kec ?>">
				</td>
				<td>
					<select class="form-control visibility" id="visibility_alamat_kec">
						<option value="0" class="set_only_me">Only Me</option>
						<option value="2" selected="" class="set_public">Public</option>
						<option value="1" class="set_fo">Friends Only</option>
					</select>
				</td>
			</tr>

			<tr>
				<td width="25%"><b>Tempat Lahir</b></td>
				<td>
					<input type="text" class="form-control input_text" id="tempat_lahir" value="<?=$tempat_lahir ?>">
				</td>
				<td>
					<select class="form-control visibility" id="visibility_tempat_lahir">
						<option value="0" class="set_only_me">Only Me</option>
						<option value="2" selected="" class="set_public">Public</option>
						<option value="1" class="set_fo">Friends Only</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><b>Tanggal Lahir</b></td>
				<td>
					<input type="date" class="form-control input_text" id="tanggal_lahir" value="<?=$tanggal_lahir ?>">
				</td>
				<td>
					<select class="form-control visibility" id="visibility_tanggal_lahir">
						<option value="0" class="set_only_me">Only Me</option>
						<option value="2" selected="" class="set_public">Public</option>
						<option value="1" class="set_fo">Friends Only</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><b>Gender</b></td>
				<td>
					<label><input type="radio" name="gender" value="L" class="input_radio" <?=$ch_gender_L?>> Laki-laki</label><br> 
					<label><input type="radio" name="gender" value="P" class="input_radio" <?=$ch_gender_P?>> Perempuan</label><br> 
				</td>
				<td>
					<select class="form-control visibility" id="visibility_gender">
						<option value="0" class="set_only_me">Only Me</option>
						<option value="2" selected="" class="set_public">Public</option>
						<option value="1" class="set_fo">Friends Only</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><b>Agama</b></td>
				<td>
					<label><input type="radio" name="agama" value="1" class="input_radio" <?=$ch_agama_1?>> Islam</label><br> 
					<label><input type="radio" name="agama" value="2" class="input_radio" <?=$ch_agama_2?>> Katolik</label><br> 
					<label><input type="radio" name="agama" value="3" class="input_radio" <?=$ch_agama_3?>> Protestan</label><br> 
					<label><input type="radio" name="agama" value="4" class="input_radio" <?=$ch_agama_4?>> Hindu</label><br> 
					<label><input type="radio" name="agama" value="5" class="input_radio" <?=$ch_agama_5?>> Budha</label><br> 
					<label><input type="radio" name="agama" value="6" class="input_radio" <?=$ch_agama_6?>> Lainnya</label><br> 
				</td>
				<td>
					<select class="form-control visibility" id="visibility_agama">
						<option value="0" class="set_only_me">Only Me</option>
						<option value="2" selected="" class="set_public">Public</option>
						<option value="1" class="set_fo">Friends Only</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><b>Status Menikah</b></td>
				<td>
					<label><input type="radio" name="status_menikah" value="1" class="input_radio" <?=$ch_status_menikah_1?>> Belum Menikah</label><br> 
					<label><input type="radio" name="status_menikah" value="2" class="input_radio" <?=$ch_status_menikah_2?>> Menikah</label><br> 
					<label><input type="radio" name="status_menikah" value="3" class="input_radio" <?=$ch_status_menikah_3?>> Janda/Duda</label><br> 
				</td>
				<td>
					<select class="form-control visibility" id="visibility_status_menikah">
						<option value="0" class="set_only_me">Only Me</option>
						<option value="2" selected="" class="set_public">Public</option>
						<option value="1" class="set_fo">Friends Only</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><b>Warga Negara</b></td>
				<td>
					<label><input type="radio" name="warga_negara" value="1" class="input_radio" <?=$ch_warga_negara_1?>> Indonesia</label><br> 
					<label><input type="radio" name="warga_negara" value="2" class="input_radio" <?=$ch_warga_negara_2?>> Asing</label><br> 
				</td>
				<td>
					<select class="form-control visibility" id="visibility_warga_negara">
						<option value="0" class="set_only_me">Only Me</option>
						<option value="2" selected="" class="set_public">Public</option>
						<option value="1" class="set_fo">Friends Only</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><b>Anak Ke</b></td>
				<td>
					<input type="number" min="1" max="15" class="form-control input_text" id="anak_ke" value="<?=$anak_ke ?>">
				</td>
				<td>
					<select class="form-control visibility" id="visibility_anak_ke">
						<option value="0" selected="" class="set_only_me">Only Me</option>
						<option value="2" class="set_public">Public</option>
						<option value="1" class="set_fo">Friends Only</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><b>Jumlah Saudara</b></td>
				<td>
					<input type="number" min="1" max="15" class="form-control input_text" id="jumlah_saudara" value="<?=$jumlah_saudara ?>">
				</td>
				<td>
					<select class="form-control visibility" id="visibility_jumlah_saudara">
						<option value="0" selected="" class="set_only_me">Only Me</option>
						<option value="2" class="set_public">Public</option>
						<option value="1" class="set_fo">Friends Only</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><b>Tinggal Bersama</b></td>
				<td>
					<label><input type="radio" name="tinggal_bersama" value="1" class="input_radio"> Ayah-Ibu</label><br> 
					<label><input type="radio" name="tinggal_bersama" value="2" class="input_radio"> Sendiri (Kost)</label><br> 
					<label><input type="radio" name="tinggal_bersama" value="3" class="input_radio"> Saudara</label><br> 
					<label><input type="radio" name="tinggal_bersama" value="4" class="input_radio"> Keluarga (pasangan)</label><br> 
					<label><input type="radio" name="tinggal_bersama" value="5" class="input_radio"> Ayah (cerai)</label><br> 
					<label><input type="radio" name="tinggal_bersama" value="6" class="input_radio"> Ibu (cerai)</label><br> 
				</td>
				<td>
					<select class="form-control visibility" id="visibility_tinggal_bersama">
						<option value="0" selected="" class="set_only_me">Only Me</option>
						<option value="2" class="set_public">Public</option>
						<option value="1" class="set_fo">Friends Only</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><b>Jenis Kendaraan</b></td>
				<td>
					<label><input type="radio" name="jenis_kendaraan" value="1" class="input_radio"> Jalan Kaki</label><br> 
					<label><input type="radio" name="jenis_kendaraan" value="2" class="input_radio"> Angkutan Umum</label><br> 
					<label><input type="radio" name="jenis_kendaraan" value="3" class="input_radio"> Diantar Keluarga/Saudara</label><br> 
					<label><input type="radio" name="jenis_kendaraan" value="4" class="input_radio"> Motor Pribadi</label><br> 
					<label><input type="radio" name="jenis_kendaraan" value="5" class="input_radio"> Mobil Pribadi</label><br> 
				</td>
				<td>
					<select class="form-control visibility" id="visibility_jenis_kendaraan">
						<option value="0" selected="" class="set_only_me">Only Me</option>
						<option value="2" class="set_public">Public</option>
						<option value="1" class="set_fo">Friends Only</option>
					</select>
				</td>
			</tr>

			<tr>
				<td><b>Jenis Rumah</b></td>
				<td>
					<label><input type="radio" name="jenis_rumah" value="1" class="input_radio"> Rumah Orang Tua</label><br> 
					<label><input type="radio" name="jenis_rumah" value="2" class="input_radio"> Rumah Sendiri (Cicilan/KPR)</label><br> 
					<label><input type="radio" name="jenis_rumah" value="3" class="input_radio"> Rumah Sendiri (Lunas)</label><br> 
				</td>
				<td>
					<select class="form-control visibility" id="visibility_jenis_kendaraan">
						<option value="0" selected="" class="set_only_me">Only Me</option>
						<option value="2" class="set_public">Public</option>
						<option value="1" class="set_fo">Friends Only</option>
					</select>
				</td>
			</tr>

		</table>

	</div>
</div>