<section id="player_questions" class="player">
	<div class="container">

		<table width="100%">
			<tr>
				<td>
					<h3>Manage Player Questions :: <?=$nama_room?></h3>
					<p>
						<div>Manage:
							<a href="#">Actions</a> | 
							<a href="#">Banned</a> | 
							<a href="#">Suspend</a> | 
							<a href="#">Verified</a> | 
							<a href="#">Promoted</a>

						</div>
						<hr>
						Filter	<input type="text" id="keywords" size="10"> 
						<span style="padding: 6px; border: solid 1px #555; border-radius:8px">
							include: 
							<label><input type="checkbox" id="include_banned" class="filter">  <span class="badge badge-danger">banned</span></label>
							<label><input type="checkbox" id="include_suspend" class="filter">  <span class="badge badge-warning">suspend</span></label>
							<label><input type="checkbox" id="include_verified" class="filter">  <span class="badge badge-primary">verified</span></label>
							<label><input type="checkbox" id="include_promoted" class="filter">  <span class="badge badge-success">promoted</span></label>
						</span>
						<span style="padding: 6px; border: solid 1px #555; border-radius:8px">
							level: 
							<label><input type="checkbox" id="include_mudah" class="filter" checked="">  <span class="badge badge-success">mudah</span></label>
							<label><input type="checkbox" id="include_sedang" class="filter" checked="">  <span class="badge badge-primary">sedang</span></label>
							<label><input type="checkbox" id="include_sulit" class="filter" checked="">  <span class="badge badge-warning">sulit</span></label>
							<label><input type="checkbox" id="include_menjebak" class="filter" checked="">  <span class="badge badge-danger">menjebak</span></label>
						</span> &nbsp;&nbsp;&nbsp;
							<a href="#" class="btn btn-success btn-sm">Create CSV</a>

					</p>
				</td>
			</tr>
		</table>
		<style type="text/css">
		#list_questions th{color: white;text-align: center;background: linear-gradient(#4a4,#222);}
		#list_questions td{color: white;font-size: 10pt;padding: 8px;}
		#list_questions ol{padding: 0 0 0 15px;}
		#list_questions .jawaban_benar{color: #6f6;font-weight: bold;}
		#list_questions .kalimat_soal{color: #6f6;}
		#list_questions .banned{background-color: darkred;}
		#list_questions .mudah{background-color: darkgreen;}
		#list_questions .sulit{background-color: purple;}
		#list_questions .besar{font-size: 16px;}


		</style>
		<div id="list_questions"></div>
	</div>
</section>

<script type="text/javascript">
	$(document).ready(function(){
		$(".filter").click(function(){
			$("#keywords").keyup();			
		})


		$("#keywords").keyup(function(){
			var keywords = $("#keywords").val();

			var include_banned = $("#include_banned").prop("checked");
			var include_suspend = $("#include_suspend").prop("checked");
			var include_verified = $("#include_verified").prop("checked");
			var include_promoted = $("#include_promoted").prop("checked");

			var include_mudah = $("#include_mudah").prop("checked");
			var include_sedang = $("#include_sedang").prop("checked");
			var include_sulit = $("#include_sulit").prop("checked");
			var include_menjebak = $("#include_menjebak").prop("checked");

			link_ajax = "ajax/ajax_manage_player_questions.php"
			+"?keywords="+keywords
			+"&include_suspend="+include_suspend
			+"&include_banned="+include_banned
			+"&include_verified="+include_verified
			+"&include_promoted="+include_promoted

			+"&include_mudah="+include_mudah
			+"&include_sedang="+include_sedang
			+"&include_sulit="+include_sulit
			+"&include_menjebak="+include_menjebak
			;

			$.ajax({
				url:link_ajax,
				success:function(a){
					$("#list_questions").html(a);
				}
			})
		});

		$("#keywords").keyup();
		$("#include_banned").change(function(){$("#keywords").keyup()});
	})

	$(document).on("click",".btn_aksi",function(){
		var id = $(this).prop("id");
		var rid = id.split("__");
		var jenis_btn = rid[0];
		var id_soal = rid[1];

		var link_ajax = "ajax/ajax_set_soal_players.php"
		+"?id_soal="+id_soal
		+"&jenis_btn="+jenis_btn
		;

		$.ajax({
			url:link_ajax,
			success:function(a){
				var ra = a.split("__");
				if(parseInt(ra[0])==1){
					// alert("Action Sukses.")
					$("#baris_"+id_soal).fadeOut();
				}else{
					alert("AJAX Error. "+a)
				}
			}
		})



		// $("#baris_"+id_soal).fadeOut();
	})

</script>