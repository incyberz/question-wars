<?php 
$itemz='';
$page = isset($_GET['page']) ? $_GET['page'] : 1;

$zpage = ($page-1)*15;
$limit = "$zpage, 15";

$s = "SELECT a.*, b.room_player_point from tb_player a  
join tb_room_player b on a.nickname=b.nickname 
WHERE status_aktif=1 
and admin_level =1 
and b.id_room='$cid_room' 
";
$q = mysqli_query($cn,$s) or die(mysqli_error($cn));
$total_player = mysqli_num_rows($q);


$link_page = '';
for ($i=1; $i <= (intval($total_player/15)+1); $i++) { 
	if($page==$i){
		$link_page.= "<span class='current_page'>$i</span> | ";
	}else{
		$link_page.= "<a class='link_page' href='?listplayers&page=$i'>$i</a> | ";
	}
}

$s .= " 
order by global_point desc 
LIMIT $limit";
$q = mysqli_query($cn,$s) or die(mysqli_error($cn));
while ($d=mysqli_fetch_assoc($q)) {
	$nickname = $d['nickname'];
	$nama_player = $d['nama_player'];
	$folder_uploads = $d['folder_uploads'];
	$room_player_point = $d['room_player_point'];


	if(strlen($nama_player)>20) $nama_player = substr($nama_player, 0,20);

	$img_reject_profil = "<img class='img_aksi' id='reject_profile__$nickname' src='assets/img/icons/reject.png' />";

	$itemz .= "
	<div class='text-center'>
		<span>$nama_player</span>
		<br>
		<a href='about/?nickname=$nickname'><img src='uploads/$folder_uploads/_profile.jpg' class='big_profil'></a>
		<br>
		<table width=100%>
			<tr>
				<td>
				  <small>$nickname ~ $room_player_point-LP</small>
				</td>
				<td align=right>
				  $img_reject_profil
				</td>
			</tr>
		</table>
		
	</div>";

}
?>

<section id="list_player" class="gm">
	<div class="container">

		<h3>Mahasiswa di Room <?=$nama_room?></h3>

		<style>
			.sort_grid{
				display: grid;
				/* =================== Sort by		By 					Acs/Desc		Others		 */
				grid-template-columns: 60px 			200px				200px				auto;
				grid-gap: 15px;
			}
			.filter_grid{
				display: grid;
				/* =================== No     Nickname 		Nama		Kelas			Gender	 */
				grid-template-columns: 60px 	200px				auto		100px			50px;
				grid-gap: 15px;
			}

			.sort_grid, .filter_grid{
				font-size: small;
			}
			.flexy{
				display: flex;
				flex-wrap: wrap;
			}

			.flexy div {
				margin: 15px;
				border: solid 1px #cfc;
				padding: 10px;
			}

			.big_profil{
			  width: 200px;
			  height: 200px;
			  object-fit: cover;
			  border-radius: 50%;
			  border: solid 5px white;
			  box-shadow: 0px 0px 3px gray;
			  transition: .2s;
			  margin: 10px;
			  /*opacity: 75%;*/
			  cursor: pointer;
			  margin: 20px;
			}

			.big_profil:hover{
			  transform: scale(1.2);
			  -webkit-filter: grayscale(0%);
			  filter: grayscale(0%);
			  opacity: 100%;
			}

			.current_page{
				color: blue;
				background: #cfc;
				padding: 5px;
				border-radius: 5px;
			}
			.link_page { transition: .2s; }
			/*.link_page:hover{ margin: 0 5px; }*/

			.img_aksi{
				height: 30px;
				width: auto;
				transition: .2s;
				cursor: pointer;
			}

			.img_aksi:hover{
				transform: scale(1.2);
			}
		</style>




		<!-- =========================================== -->
		<!-- BLOK FILTER -->
		<!-- =========================================== -->
		<div class="blok_filter wadah hideit">


			<div class="sort_grid ">
				<div>Sort by:</div>
				<div>
					<select class="form-control filter" id="sort_by">
						<option>Nama</option>
						<option>Room Points</option>
						<option>Publish Questions</option>
					</select>
				</div>

				<div>
					<select class="form-control filter" id="sort_type">
						<option>Ascending</option>
						<option>Descending</option>
					</select>
				</div>
			</div>

			<div class="filter_grid">
				<div>No</div>
				<div><input class="form-control filter" id="filter_nim" placeholder="NIM"></div>
				<div><input class="form-control filter" id="filter_nama" placeholder="Nama"></div>
				<div><input class="form-control filter" id="filter_kelas" placeholder="Kelas"></div>
				<div><input class="form-control filter" id="filter_lp" placeholder="L/P"></div>
			</div>

		</div>




		<!-- =========================================== -->
		<!-- ITEMS OUTPUT -->
		<!-- =========================================== -->
		<div><?=$link_page ?></div>

		<div class="wadah flexy text-center">
			<?=$itemz?>
			<!-- <div id="hasil_ajax"></div> -->
		</div>
		<div><?=$link_page ?></div>

		
	</div>
</section>


<script type="text/javascript">
	$(document).ready(function(){
		$('.filter').change(function(){
			alert('filter is ready to code')
		})
	})




	// ============================================
	// REJECT PROFIL
	// ============================================
	$(document).ready(function(){
		$('.img_aksi').click(function(){
			// alert('btn_aksi is ready to code');
			let tid = $(this).prop('id');
			alert(tid);


		})
	})







	$(document).on("click",".addplayer",function(){
		var id = $(this).prop("id");
		var rid = id.split("__");
		var nim = rid[1];

		var x = confirm("Tambah nickname: '"+nim+"' ke dalam room?");
		if(!x) return;

		$("#"+id).prop("disabled",true);

		var link_ajax = "ajax/ajax_assign_player_to_room.php?nim="+nim;

		$.ajax({
			url:link_ajax,
			success:function(a){
				var ra = a.split("__");
				if(parseInt(ra[0])==1){
					alert(ra[1]);
					$("#jumlah_peserta").text(parseInt($("#jumlah_peserta").text())+1);
				}else{
					alert("Error, ajax reply: "+a);
				}
			}
		})
	})


</script>