<?php
$box_profiles='';
$page = isset($_GET['page']) ? $_GET['page'] : 1;

$filter_nama = isset($_POST['filter_nama']) ? $_POST['filter_nama'] : '';
$filter_kelas = isset($_POST['filter_kelas']) ? $_POST['filter_kelas'] : 'all';
$filter_gender = isset($_POST['filter_gender']) ? $_POST['filter_gender'] : 'all';

$max_show = 6;
$zpage = ($page-1)*$max_show;
$limit = "$zpage, $max_show";


$where_nama = $filter_nama=='' ? ' and 1 ' : " and (a.nama_player like '%$filter_nama%' OR a.nickname like '%$filter_nama%') ";
$where_kelas = $filter_kelas=='all' ? ' and 1 ' : " and d.kelas='$filter_kelas' ";
$where_gender = $filter_gender=='all' ? ' and 1 ' : " and gender='$filter_gender' ";

# ==================================================
# FILTER INPUT NAMA
# ==================================================
$nama_filtered = $filter_nama=='' ? '' : 'filtered';
$filter_nama = "<input class='$nama_filtered' name='filter_nama' size=5 value='$filter_nama'>";




# ==================================================
# FILTER SELECT KELAS
# ==================================================
$kelas_filtered = $filter_kelas=='all' ? '' : 'filtered';
$s = "SELECT kelas from tb_room_kelas where id_room=$cid_room order by kelas ";
$q = mysqli_query($cn, $s) or die(mysqli_error($cn));
$select_kelas = "<select class='$kelas_filtered' name=filter_kelas><option>all</option>";
while ($d=mysqli_fetch_assoc($q)) {
    $kelas_selected = $d['kelas']==$filter_kelas ? 'selected' : '';
    $select_kelas.="<option $kelas_selected>$d[kelas]</option>";
}
$select_kelas .= "</select>";


# ==================================================
# FILTER SELECT GENDER
# ==================================================
$gender_filtered = $filter_gender=='all' ? '' : 'filtered';
$select_gender = "<select class='$gender_filtered' name=filter_gender><option>all</option>";
$lp = ['L','P'];
for ($i=0; $i < count($lp); $i++) {
    $gender_selected = $lp[$i]==$filter_gender ? 'selected' : '';
    $select_gender.="<option $gender_selected>$lp[$i]</option>";
}
$select_gender .= "</select>";


$s = "SELECT 
a.nickname,
a.nama_player,
a.gender, 
a.folder_uploads,
a.status_profil,
b.room_player_point,
d.kelas 
from tb_player a  
join tb_room_player b on a.nickname=b.nickname 
join tb_kelas_det c on a.nickname=c.nickname 
join tb_kelas d on c.kelas=d.kelas 
WHERE status_aktif=1 
and admin_level =1 
and b.id_room='$cid_room' 
$where_nama 
$where_kelas  
$where_gender   
";
$q = mysqli_query($cn, $s) or die(mysqli_error($cn));
$total_player = mysqli_num_rows($q);
$total_page = intval($total_player/$max_show)+1;

$link_page = '<div class="link_page">';
for ($i=1; $i <= $total_page; $i++) {
    if ($i>9 and $i<($total_page-2)) {
        $link_page.= " ... | ";
        $i = $total_page-2;
    }
    if ($page==$i) {
        $link_page.= "<span class='current_page'>$i</span> | ";
    } else {
        $link_page.= "<a class='link_page' href='?listplayers&page=$i'>$i</a> | ";
    }
}
$link_page .= '</div>';

$s .= " 
order by b.room_player_point desc 
LIMIT $limit";
$debug_sql =  $s;
$q = mysqli_query($cn, $s) or die(mysqli_error($cn));
while ($d=mysqli_fetch_assoc($q)) {
    $nickname = $d['nickname'];
    $gender = $d['gender'];
    $nama_player = strtolower($d['nama_player']);
    $folder_uploads = $d['folder_uploads'];
    $status_profil = $d['status_profil'];
    $kelas = $d['kelas'];
    $room_player_point = $d['room_player_point'];
    $room_player_point_show = number_format($room_player_point, 0);

    if (strlen($nama_player)>20) {
        $nama_player = str_replace('muhamad', 'm', $nama_player);
        $nama_player = str_replace('muhammad', 'm', $nama_player);
        $nama_player = substr($nama_player, 0, 20);
    }
    $nama_player = ucwords($nama_player);



    # ==================================================
    # BUTTONS
    # ==================================================
    $img_accept_profil = "<img class='img_aksi' id='accept_profile__$nickname' src='assets/img/icons/accept.png' />";
    $img_reject_profil = "<img class='img_aksi' id='reject_profile__$nickname' src='assets/img/icons/reject.png' />";
    $img_delete_player = "<img class='img_aksi' id='delete_player__$nickname' src='assets/img/icons/delete.png' />";
    $img_set_p = "<img class='img_aksi' id='set_p__$nickname' src='assets/img/icons/set_p.png' />";
    $img_set_l = "<img class='img_aksi' id='set_l__$nickname' src='assets/img/icons/set_l.png' />";
    $img_login_as = "<img class='img_aksi' id='login_as__$nickname' src='assets/img/icons/login_as.png' />";

    $img_set_l_or_p = $gender=='' ? "<span id='set_gender__$nickname'>[ $img_set_l or $img_set_p ]</span>" : '';
    $img_set_profil = $status_profil==1 ? $img_reject_profil : $img_accept_profil;


    # ==================================================
    # PLAYER LINKS
    # ==================================================
    $player_links = '';
    $img_yt = '<img class="img_aksi" src="assets/img/icons/youtube.png">';
    $s2 = "SELECT proof_link from tb_chal_beatenby where beaten_by='$nickname' and proof_link like 'http%' and proof_link like '%youtu%' ";
    $q2 = mysqli_query($cn, $s2)or die('Tidak dapat mencari link untuk player ini.'.$s2);
    while ($d2=mysqli_fetch_assoc($q2)) {
        $player_links .= "<a href='$d2[proof_link]' target=_blank>$img_yt</a>";
    }





    $player_links = $player_links=='' ? 'No links' : $player_links;
    $player_links = "<div class='text-center box_aksi'>$player_links</div>";


    # ==================================================
    # FINAL OUTPUT
    # ==================================================
    $box_profiles .= "
	<div class='text-center box_profil'>
		<a href='about/?nickname=$nickname'><img src='uploads/$folder_uploads/_profile.jpg' class='big_profil'></a>
		<br>
		<div><b>$nama_player</b></div>
		<div class='text-center'><small>$nickname ~ $room_player_point_show LP</small></div>
		<div class='text-center'><small>$kelas</small></div>
		<div class='text-center box_aksi'>
			$img_login_as
			$img_set_l_or_p
			$img_set_profil
			$img_delete_player
		</div>
		$player_links
	</div>";
}
?>

<section id="list_player" class="gm">
	<div class="container">
		<?php //echo "<pre>$debug_sql</pre>";?>

		<h3>Mahasiswa di Room <?=$nama_room?></h3>

		<form action="" method="post">
			<div class="blok_filter">
				Filter:
				<?=$select_kelas ?>
				<?=$select_gender ?>
				<?=$filter_nama ?>
				 
				<button type=submit class="btn btn-primary btn-sm">Filter</button>
				<a href="?listplayers" class="btn btn-success btn-sm">Clear</a>
			</div>
		</form>
		<style>
			.sort_grid{
				display: grid;
				/* =================== Sort by By   Acs/Desc Others  */
  				grid-template-columns: 60px  200px  200px  auto;
				grid-gap: 15px;
			}
			.filter_grid{
				display: grid;
				/* =================== No     	Nickname 	Nama	Kelas	Gender	 */
				grid-template-columns: 60px 	200px 		auto	100px	50px;
				grid-gap: 15px;
			}

			.sort_grid, .filter_grid{
				font-size: small;
			}
			.box_flexbox{
				display: flex;
				flex-wrap: wrap;
				justify-content: center;
			}

			.box_profil {
				margin: 15px;
				border: solid 1px #ccc;
				padding: 10px;
				border-radius: 5px;
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

			.link_page{
				margin: 15px 0;
			}

			.blok_filter{
				margin: 10px 0
			}

			.filtered { background: #0f0}

			.box_aksi{
				border-top: solid 1px #ccc;
				padding-top: 5px;
				margin-top: 5px;
			}

			.img_aksi { 
				height:25px;
			}
		</style>





		<!-- =========================================== -->
		<!-- ITEMS OUTPUT -->
		<!-- =========================================== -->

		<div class="wadah box_flexbox text-center">
			<?=$box_profiles?>
			<!-- <div id="hasil_ajax"></div> -->
		</div>
		<div><?=$link_page ?></div>

		
	</div>
</section>


<script type="text/javascript">
	// ============================================
	// REJECT PROFIL
	// ============================================
	$(document).ready(function(){
		$('.img_aksi').click(function(){
			// alert('btn_aksi is ready to code');
			let tid = $(this).prop('id');
			let rid = tid.split('__');
			let aksi = rid[0];
			let nickname = rid[1];
			let link_ajax = `ajax/ajax_update_player.php?nickname=${nickname}`;

			if(aksi=='set_p' || aksi=='set_l'){
				let arr = aksi.split('_');
				let gender = arr[1];
				link_ajax += `&field=gender&isi=${gender}`;
			}else if(aksi=='login_as'){
				let yakin = confirm("Ingin login as "+nickname+"?");
				if(!yakin) return;

				location.replace("?logas&nickname="+nickname);
				// window.open("?logas&nickname="+nickname);
				return;

			}else if(aksi=='accept_profile'){
				let yakin = confirm("Terima profil ini sebagai profil yang layak untuk dijadikan transkrip nilai?");
				if(!yakin) return;
				link_ajax += `&field=status_profil&isi=1`;
			}else if(aksi=='reject_profile'){
				let yakin = confirm("Reject kelayakan profil ini?");
				if(!yakin) return;
				link_ajax += `&field=status_profil&isi=0`;
			}else{
				alert(`belum terdapat handler untuk aksi: ${aksi}`);
				return;
			}

			$.ajax({
				url:link_ajax,
				success:function(a){
					if(a.trim()=='sukses'){
						if(aksi=='set_p'||aksi=='set_l'){
							$('#set_gender__'+nickname).fadeOut();
						}else if(aksi=='accept_profile'){
							$('#accept_profile__'+nickname).fadeOut();
						}else if(aksi=='reject_profile'){
							$('#reject_profile__'+nickname).fadeOut();
						}else{
							alert('AJAX sukses tanpa handler.')
						}
					}else{
						alert('AJAX error: '+a);
					}
				}
			})

		})
	})

</script>