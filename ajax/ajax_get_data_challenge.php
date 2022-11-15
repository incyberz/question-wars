<?php 
$dm = 0;

$id_room = $_GET['id_room'];
$nickname = $_GET['nickname'];
// $id_playedby = "$id_soal"."_by_$nickname";

include "../config.php";


// $q = mysqli_query($cn,$s);
// if(!$q){
// 	$s = "UPDATE tb_soal_playedby set date_load=CURRENT_TIMESTAMP WHERE id_playedby = '$id_playedby'";
// 	$q = mysqli_query($cn,$s) or die("Error @ajax get data soal :: Can't insert or update");
// }



# ===============================================
# GET ALL DATA WITH NO LIMIT
# ===============================================
// $s = "SELECT 
// a.id_chal,
// a.tahun_chal,
// a.id_prodi,
// b.singkatan_prodi,
// a.nim,
// a.nama_mhs,
// a.tahun_lulus  
// FROM tb_chal a 
// JOIN tb_prodi b on a.id_prodi = b.id_prodi 
// $sql_where_nama 
// $sql_and_tahun_tracer 
// $sql_and_lulusan 
// $sql_and_prodi 
// $sql_order_by 
// ";

// $q = mysqli_query($cn,$s) or die("Error #ajax get data table :: Failed to execute SQL.");
// $jumlah_chal = mysqli_num_rows($q);







# ===============================================
# GET DATA TCS WITH LIMIT
# ===============================================
// $s = "SELECT 
// a.id_chal,
// a.tahun_chal,
// a.id_prodi,
// b.singkatan_prodi,
// a.nim,
// a.nama_mhs,
// a.tahun_lulus  
// FROM tb_chal a 
// JOIN tb_prodi b on a.id_prodi = b.id_prodi 
// $sql_where_nama 
// $sql_and_tahun_tracer 
// $sql_and_lulusan 
// $sql_and_prodi 
// $sql_order_by 
// limit $limit, $jml_data_pp 
// ";
// //die($s);
// $q = mysqli_query($cn,$s) or die("Error #ajax get data table :: Failed to execute SQL.");

// $jumlah_page = intval($jumlah_chal/$jml_data_pp);
// if($jumlah_page*$jml_data_pp!=$jumlah_chal) $jumlah_page++;

// $i = ($chal_page-1)*$jml_data_pp;
$s = "SELECT * FROM tb_chal where id_room = $id_room and chal_creator != '$nickname'";
$q = mysqli_query($cn,$s) or die("Error @ajax get data challenges");

$x = "
<table width='100%' class='table-hover table-bordered' id='chal_list'>
	<thead>
		<th>NO</th>
		<th>CHALLENGES</th>
	</thead>
";
$i=0;
while ($d = mysqli_fetch_assoc($q)) {
	$i++;
	$id_chal = $d['id_chal'];
	$chal_creator = $d['chal_creator'];
	$chal_name = $d['chal_name'];
	$chal_created = $d['chal_created'];
	$chal_desc = $d['chal_desc'];
	$chal_point = $d['chal_point'];
	if($chal_desc!="") $chal_desc.= "<br>";

	$key = md5("__$id_chal");

	$x.= "
	<tr>
		<td class='tdcenter'>$i</td>
		<td class=''>
			<a href='detail_challenge.php?id_room=$id_room&key=$key' target='_blank'><b>$chal_name</b></a>
			<br>Max Point: <span style='font-size:30px; color:pink'>$chal_point</span> LP
			<br>
			<small>
				$chal_desc
				Status: Not Beaten!
			</small>
		</td>
	</tr>
	";

}
// $debug = "
// jumlah_chal:$jumlah_chal jml_data_pp:$jml_data_pp jumlah_page:$jumlah_page
// ";
echo "$x</table>__1__2__3";


?>