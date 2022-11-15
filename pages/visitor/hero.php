<style type="text/css">
	
	.awesome {

		/*font-family: futura;*/
		/*font-style: italic;*/

		/*width:100%;*/

		/*margin: 0 auto;*/
		/*text-align: center;*/

		color:#313131;
		font-size:45px;
		font-weight: bold;
		/*position: absolute;*/
		-webkit-animation:colorchange 20s infinite alternate;

		/*-webkit-text-stroke-width: 1px;*/
		/*-webkit-text-stroke-color: white;*/

		text-shadow: 2px 2px 4px #000000;
	}

	.subawesome{
		text-shadow: 1px 1px 2px #000000;
	}

	@-webkit-keyframes colorchange {
		0% { color: blue;}
		10% {color: #8e44ad;}
		20% {color: #1abc9c;}
		30% {color: #d35400;}
		40% {color: pink;}
		50% {color: #34495e; }
		60% {color: yellow;}
		70% {color: #2980b9;}
		80% {color: #f1c40f;}
		90% {color: #2980b9;}
		100% {color: pink;}
	}
</style>

<section id="hero" class="visitor">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-xl-8">
				<h1 class="awesome">Welcome to Perang Soal</h1>
				<h2 class="subawesome">Make learning as fun as playing !</h2>
				<div id="blok_wars_activity">Wars Activity: <span id="jumlah_wars_activity"><?=$jumlah_wars_activity?></span></div>
				<!-- <a href="#" class="venobox play-btn mb-4" data-vbtype="video" data-autoplay="true"></a> -->
				<!-- <a href="#" class="venobox play-btn mb-4 link_header" id="linkhero_login"></a> -->
				<a href="?login">
					<img class="img_play_now" src="assets/img/icons/play-now.png" height="50px" id="img_play_now" style="margin-top:20px">
					<style>
						.img_play_now{
							transition: .5s; opacity: 85%;
						}
						.img_play_now:hover{
							transform: scale(1.2);
							opacity: 100%;
						}
					</style>
				</a>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
	$(document).ready(function(){
		// alert(0)
		$("#img_play_now").hover(function(){
			$(this).prop("src","assets/img/icons/play-now-hover.png");
		})
		$("#img_play_now").mouseout(function(){
			$(this).prop("src","assets/img/icons/play-now.png");
		})
	})
</script>