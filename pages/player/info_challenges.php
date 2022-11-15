<style type="text/css">
	#chal_rows th{ 
		background: linear-gradient(rgba(0, 100, 0, 0.4), rgba(0, 50, 0, 0.8));
		padding: 5px;
	}
	#chal_rows td{ 
		background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.8));
		padding: 5px;
	}
	#info_challenges a{
		color: #aaf; 
	}
	#info_challenges a:hover{
		color: yellow; 
	}
	#info_challenges tr{
		color: #ddd; 
	}
	#info_challenges tr:hover{
		color: white; 
	}
	#table_chal_filter td{
		padding: 9px 0
	}
</style>

<section id="info_challenges" class="player hideit">
	<div class="container">

		<h3>Challenge Lists</h3>
		<hr>

		<table width="100%" id="table_chal_filter">
			<tr>
				<td>
					Status: <select style="padding: 2px 5px">
						<option value="9">--All--</option>
						<option value="0">Unbeaten</option>
						<option value="1">Beaten</option>
					</select>
				</td>
				<td align="right">
					<button>Refresh</button>
				</td>
			</tr>
		</table>


		<div class="" id="">

			<div id="chal_rows"></div>

			<small id="chal_rows_found"></small>
			<div class="row" style="margin-top: 10px">
				<div class="col-lg-4">
					<table width="100%">
						<tr>
							<td width="30%">
								<table width="100%">
									<tr>
										<td width="50%" style="padding: 0 0 0 0">
											<button class="btn btn-primary btn-block chal_filter btn_nav" id="chal_btn_nav__first"><<</button>
										</td>
										<td width="50%" style="padding: 0 0 0 2px">
											<button class="btn btn-primary btn-block chal_filter btn_nav" id="chal_btn_nav__prev"><</button>
										</td>
									</tr>
								</table>
							</td>
							<td width="40%" style="padding: 0 15px">
								<select id="chal_page" class="form-control	chal_filter" style="padding-left: 2px">
									<?php 
									for ($i=1; $i <= $jumlah_page ; $i++) { 
										echo "<option value='$i'>Page $i</option>";
									} ?>
								</select>
							</td>
							<td width="30%">
								<table width="100%">
									<tr>
										<td width="50%" style="padding: 0 2px 0 0">
											<button class="btn btn-primary btn-block chal_filter btn_nav" id="chal_btn_nav__next">></button>
										</td>
										<td width="50%" style="padding: 0 0 0 0">
											<button class="btn btn-primary btn-block chal_filter btn_nav" id="chal_btn_nav__last">>></button>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>

	</div>
</section>









<script type="text/javascript">
	

	function fillit(){
		var id_room = $("#id_room").val();
		var nickname = $("#nickname").val();
		// var filter_by_nama = $("#chal_filter_by_nama").val();
		// var filter_by_tahun_tracer = $("#chal_filter_by_tahun_tracer").val();
		// var filter_by_lulusan = $("#chal_filter_by_lulusan").val();
		// var filter_by_prodi = $("#chal_filter_by_prodi").val();
		// var chal_page = $("#chal_page").val();
		// var chal_order_by = $("#chal_order_by").val();
		// var chal_asc_desc = $("#chal_asc_desc").val();
		// var jml_data_pp = $("#chal_jml_data_pp").val();

		var link_ajax = "ajax/ajax_get_data_challenge.php"
		+"?id_room="+id_room
		+"&nickname="+nickname
		// +"&filter_by_tahun_tracer="+filter_by_tahun_tracer
		// +"&filter_by_lulusan="+filter_by_lulusan
		// +"&filter_by_prodi="+filter_by_prodi
		// +"&chal_page="+chal_page
		// +"&chal_order_by="+chal_order_by
		// +"&chal_asc_desc="+chal_asc_desc
		// +"&jml_data_pp="+jml_data_pp
		;

		$.ajax({
			url:link_ajax,
			success:function(a){

				var b = a.split("__");
				$("#chal_rows").html(b[0]);
				var jumlah_page = parseInt(b[1]);
				var jumlah_chal = parseInt(b[2]);

				if(jumlah_page==0) jumlah_page=1;
				$("#chal_rows_found").text(jumlah_chal + " rows found.");
				$("#chal_jumlah_page").val(jumlah_page);
				

				$("#chal_page").empty();
				for (var i = 1; i <= jumlah_page; i++) {
					$("#chal_page").append("<option value='"+i+"''>Page "+i+"</option>");
				}
				$("#chal_page").val(chal_page);
			}
		})

	}

	$(document).ready(function(){

		fillit();

		$(".chal_filter").change(function(){
			if($(this).prop("id")!="chal_page") $("#chal_page").val(1);
			fillit();
		})

		$("#chal_filter_by_nama").keyup(function(){
			fillit();
		})

		$("#chal_filter_by_toggle").click(function(){
			$(this).hide(); $("#chal_tabel_filter").show();
		})

		$("#chal_tabel_filter_toggle").click(function(){
			$("#chal_tabel_filter").hide(); $("#chal_filter_by_toggle").show();
		})

		$(".btn_nav").click(function(){
			var tid = $(this).prop("id");
			var rid = tid.split("__");
			var id = rid[1];
			var current_page = parseInt($("#chal_page").val());
			var last_page = $("#chal_page option").length;
			switch(id){
				case "first": current_page = 1;break;
				case "last": current_page = last_page;break;
				case "next": if(current_page<last_page)current_page++;break;
				case "prev": if(current_page>1)current_page--;break;
			}
			$("#chal_page").val(current_page);
			fillit();
		})

		$(".link_header").click(function(){

			$(".div_subtcs").hide();
			var tid = $(this).prop("id");

			


		})
	})
</script>