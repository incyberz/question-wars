<div class="blok_hasil_kuis hideit">
	<div>
		<div>Quiz Accuracy: </div>
		 <div class="progress">
		  <div class="progress-bar" role="progressbar" aria-valuenow="70"
		  aria-valuemin="0" aria-valuemax="100" style="width:10%" id="akurasi_kuis">
		    10%
		  </div>
		</div> 
	</div>
	<div class="blok_poin_akurasi">
		<div class="row">
			<div class="col-8 text-centera">Poin akurasi: <span id="poin_akurasi">1375</span> LP</div>
			<div class="col-4"><button class="btn btn-primary btn-block btn-sm" id="btn_claim_poin_akurasi">Claim</button></div>
		</div>
	</div>
	<div class="chat_kill">
		<?=$chat_kills?>
	</div>
</div>



<!-- ========================================== -->
<!-- HASIL KUIS 2 -->
<!-- ========================================== -->
<div class="blok_hasil_kuis2 hideit">
	<style type="text/css">
		.ml1 {
		  font-weight: 900;
		  font-size: 3.5em;
		  text-align: center;
		  margin-bottom: 15px;
		  margin-top: 30px;
		}

		.ml1 .letter {
		  display: inline-block;
		  line-height: 1em;
		}

		.ml1 .text-wrapper {
		  position: relative;
		  display: inline-block;
		  padding-top: 0.1em;
		  padding-right: 0.05em;
		  padding-bottom: 0.15em;
		}

		.ml1 .line {
		  opacity: 0;
		  position: absolute;
		  left: 0;
		  height: 3px;
		  width: 100%;
		  background-color: #fff;
		  transform-origin: 0 0;
		}

		.ml1 .line1 { top: 0; }
		.ml1 .line2 { bottom: 0; }
	</style>
	<h1 class="ml1">
	  <span class="text-wrapper">
	    <span class="line line1"></span>
	    <span class="letters">THANK YOU!</span>
	    <span class="line line2"></span>
	  </span>
	</h1>

	<div class="text-center">
		<a href="?kuis" class="btn btn-success btn-sm">Play Again</a>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
	<script type="text/javascript">
		// Wrap every letter in a span
		var textWrapper = document.querySelector('.ml1 .letters');
		textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

		anime.timeline({loop: true})
		  .add({
		    targets: '.ml1 .letter',
		    scale: [0.3,1],
		    opacity: [0,1],
		    translateZ: 0,
		    easing: "easeOutExpo",
		    duration: 600,
		    delay: (el, i) => 70 * (i+1)
		  }).add({
		    targets: '.ml1 .line',
		    scaleX: [0,1],
		    opacity: [0.5,1],
		    easing: "easeOutExpo",
		    duration: 700,
		    offset: '-=875',
		    delay: (el, i, l) => 80 * (l - i)
		  }).add({
		    targets: '.ml1',
		    opacity: 0,
		    duration: 1000,
		    easing: "easeOutExpo",
		    delay: 1000
		  });
	</script>
</div>




















<!-- ========================================== -->
<!-- SCRIPT -->
<!-- ========================================== -->
<script>
	$(document).ready(function(){
		$('#btn_claim_poin_akurasi').click(function(){

			let cnickname = $('#cnickname').val();
			let poin_akurasi = parseInt($('#poin_akurasi').text());
			let values = `'${id_soals}','${cnickname}','${poin_akurasi}'`
			let pair_updates = `nickname='${cnickname}'`;

			let link_ajax = `jx/jx_claim_poin_akurasi.php
			?table=tb_paket_soal
			&fields=id_soals,nickname,poin_akurasi
			&values=${values}
			&pair_updates=${pair_updates}
			&poin_akurasi=${poin_akurasi}
			`;

			// alert(link_ajax);

			$.ajax({
				url:link_ajax,
				success:function(a){
					if(a.trim()=='sukses'){
						// alert(a);
						let room_player_point_atheader = parseInt($('#room_player_point_atheader').text());
						room_player_point_atheader += poin_akurasi;
						$('#room_player_point_atheader').text(room_player_point_atheader);

						$('.blok_hasil_kuis').slideUp();
						$('.blok_hasil_kuis2').slideDown();

						let audio = new Audio('assets/audio/applause.mp3');
						audio.play();

						// alert(`Claim Akurasi Poin ${poin_akurasi} LP sukses.`);

					}else{
						alert(a);
					}
				}
			})
		})
	})
</script>