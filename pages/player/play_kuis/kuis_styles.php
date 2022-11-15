<style type="text/css">

	.blok_kuis,.blok_hasil_kuis{
		max-width: 576px;
		margin: auto;
	}


	.blok_play, {
		width: 100%;
		max-width: 400px;
	}


	/*div { border: solid 1px red; }*/
	.blok_tampil_soal, .blok_hasil_kuis { 
		/*display: grid; */
		/*grid-template-columns: 	50px 50px 50px 50px 50px ; */
		/*											rows 	by:	 ; */
		border: solid 1px #ccc;
		border-radius: 10px;
		background: linear-gradient(#ddf, #afa);
		padding: 15px;
		color: darkblue;
		margin-bottom: 15px;

		/*position: sticky;*/
		/*top: 50px;*/
		/*height: 87vh;*/
	}						

	.header_soal{
		display: grid;
		grid-template-columns: 85px auto;
	}

	.blok_progres_kuis{
		height: 25px;
		background: linear-gradient(to right, #ffe, #eff);
		/*margin-bottom: 10px;*/
		margin: 4px 0;
		border: solid 1px #ccc;
		border-radius: 10px;
		padding: 2px 5px;
		/*box-sizing: border-box;*/
		display: grid;
		grid-template-columns: 5% 5% 5% 5% 5% 5% 5% 5% 5% 5% 5% 5% 5% 5% 5% 5% 5% 5% 5% 5% 5%;
		/* 										 1	2	 3  4  5  6  7  8  9  10 11 12 13 14 15 16 17 18 19 20 */
	}
	.blok_progres_kuis div{
		/*border-right: solid 1px #ccf;*/
		/*border: solid 1px #ccc;*/
		border-radius: 5px;
		margin-right: 3px;
	}
	.filled{ background: linear-gradient(#aaf,#88f); }





	.blok_soal_info{ display: grid; grid-template-columns: 50% 50%; grid-gap: 10px; margin-right: 15px; }
	.blok_badge_soal { text-align: right; }
	.badge_soal { text-align: center; transition: .2s; cursor: pointer; }
	.badge_soal:hover { padding: 3px 8px; }


	.img_icon{
		height: 20px;
		width: auto;
		transition: .2s;
		cursor: pointer;
	}

	.img_icon:hover{ transform: scale(1.1); margin: 0 3px; }


	.profil_soal_creator {
		width: 70px;
		height: 70px;
		border-radius: 50%;
		background: white;
		padding: 3px;
		cursor: pointer;
		box-shadow: 1px 1px 4px gray;
		transition: .2s;
		object-fit: cover;
	}
	.profil_soal_creator:hover { transform: scale(1.1); }



	#status_soal_show{
		border-top: solid 1px #ccc;
		padding-top: 5px;
		margin-top: 15px;
	}

	#kalimat_soal{
		color: darkblue;
	}

	.blok_opsi { 
		display: grid; 
		grid-template-columns: 20px auto;
		cursor: pointer;
		transition: .2s;
		padding: 3px 9px;
		border: dotted 1px #ccc;
		/*margin: 3px 0;*/
		color: darkred;
	}

	.blok_opsi:hover{
		background: linear-gradient(#eef,#ffa);
		border: solid 1px green;
		letter-spacing: .3px;
		color: blue;
		/*font-weight: bold;*/
		/*margin: 3px 0;*/
	}

	.blok_opsi_aktif{
		background: linear-gradient(white,lightyellow);
		border: dashed 1px #ccf;
		color: blue;
	}

	.opsi_benar{
		border: solid 3px blue;
		background: linear-gradient(#efe,#afa);
		color: darkblue;
	}

	.opsi_salah{
		border: solid 3px red;
		background: linear-gradient(#fee,#faa);
		color: darkred;
	}



	#sisa_waktu, #anda_benar, #anda_salah, #anda_timed_out{
		font-size: 40px;
		text-align: center;
		font-family: consolas;
		/*margin-bottom: 15px;*/
		/*border-bottom: solid 1px #ccc;*/
	}
	#sisa_waktu{ color: darkred; }
	#anda_benar{ color: blue; }
	#anda_salah, #anda_timed_out { color: red; }

	.hasil_kuis, .blok_submit, .blok_alasan_reject, .blok_rate_soal,.blok_next_play,.blok_hasil_reject{ display: none; }

	.blok_alasan_reject { color: red; text-align: center; margin: 15px 0;}

	.blok_hasil_reject{
		color: darkred;
		font-family: consolas;
		text-align: center;
		padding: 10px 0;
	}




	.blok_rate_soal { 
		padding: 15px; 
		background: linear-gradient(#f7f, #f0f); 
		margin: 10px 0;
		border-radius: 10px;
		/*border: solid 1px #ccc;*/
		/*opacity: 70%;*/
	}
	
	.img_rate{
		height: 35px;
		width: auto;
		cursor: pointer;
		transition: .2s;
		opacity: 50%;
	}
	.img_rate:hover, .img_rated {
		transform: scale(1.2);
		opacity: 100%;
	}

	.ket_rate { 
		text-align: center; 
		margin-top: 15px; 
		font-family: 'century gothic'; 
		display: none; 
		border-top: solid 1px #ccc;
		padding-top: 10px;
	}

	.blok_next_play{ margin-top: 10px; }

	.kuis_var{
		font-size: 8pt;
		padding: 10px;
		background: red;
		<?php if(!$dm) echo "display: none;"; ?>
	}


	.img_weapon{
		height: 18px;
		width: auto;
		transition: .2s;
		cursor: pointer;
	}
	.img_weapon:hover{
		transform: scale(1.2);
	}

	.player_name { transition: .2s; cursor: pointer; }
	.player_name:hover { letter-spacing: .5pt; }

	.ck_row{
		text-align: center;
		font-size: small;
		font-family: consolas;
		border-top: solid 1px #ccc;
		padding: 1px 0;
	}

	.killed{ background: #ffdada; }
	.suicide{ background: #ff8888; }

	.chat_kill{
		margin: 10px 0;
	}

	.blok_poin_akurasi{
		margin-top: 10px;
		border: solid 1px #ccc;
		font-size: small;
		font-family: consolas;
		padding: 5px;
		padding-left: 10px;
		background: linear-gradient(#ffe,#fef);
		border-radius: 5px;
	}

	#poin_akurasi{
		color: #22f;
		font-size: 16pt;
	}


</style>