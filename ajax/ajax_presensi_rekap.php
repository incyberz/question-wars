<?php session_start(); ?>
<style type="text/css">
	#tb_dhkm {width: 100%; margin-top: 15px;}
	#tb_dhkm th, #tb_dhkm td{font-size: 10pt; border: solid 1px #aaa;}
	#tb_dhkm th,#tb_dhkm .td_judul{background-color: #049; text-align: center;padding: 10px;}
	#tb_dhkm td{text-align: center;padding: 5px;}

	.row_presensi:hover{ background-color: #500;

	}
</style>

<?php 
$last_kelas = '';
$kelas_before = '';

$link_dosen = "https://siakad.ikmi.ac.id/dosen/?insho"; //zzz
$img_check = "<img src='assets/img/icons/check_green.png' width='18px' />";
# ================================================
# SESSION SECURITY
# ================================================
function erjx($a){return "Error @ajax. Index($a) belum terdefinisi.";}

if(!isset($_SESSION['nickname'])) die(erjx(1));
if(!isset($_SESSION['id_room'])) die(erjx(2));
if($_SESSION['admin_level']<2) die("Error @ajax. Maaf Anda Belum login sebagai Game Master.");

$cnickname = $_SESSION['nickname'];
$cadmin_level = $_SESSION['admin_level'];
$cid_room = $_SESSION['id_room'];


# ================================================
# GET VARIABLES
# ================================================
if(!isset($_GET['prodi'])) die(erjx(3)); $prodi = $_GET['prodi'];
if(trim($prodi)=="") die("Error @ajax. SQL Values Data is empty.");

if(!isset($_GET['id_room_kelas'])) die(erjx(4)); $id_room_kelas = $_GET['id_room_kelas'];
if(trim($id_room_kelas)=="") die("Error @ajax. SQL Values Data is empty.");

if(!isset($_GET['id_room_subject_filter'])) die(erjx(5)); $id_room_subject_filter = $_GET['id_room_subject_filter'];
if(trim($id_room_subject_filter)=="") die("Error @ajax. SQL Values Data is empty.");

if(!isset($_GET['sesi_ke'])) die(erjx(6)); $sesi_ke = $_GET['sesi_ke'];
if(trim($sesi_ke)=="") die("Error @ajax. SQL Values Data is empty.");

// die("$prodi $id_room_kelas $id_room_subject_filter $sesi_ke");



# ================================================
# SQL FILTERING
# ================================================
$sql_kelas = " 1 ";
$sql_prodi = " 1 ";

if($id_room_kelas=="0") die("<div class='wadah'>Silahkan pilih kelas!</div>");
if($id_room_kelas!="0" and $id_room_kelas!="all") $sql_kelas = " a.id_room_kelas='$id_room_kelas' ";

if($prodi!="all") $sql_prodi = " b.prodi='$prodi' ";




include "../config.php";
include "../room_var.php";
include "../pages/player/presensi_var.php";
# ================================================
# GET GM NAME
# ================================================
$s = "SELECT nama_player from tb_player where nickname='$cnickname'";
$q = mysqli_query($cn,$s) or die("Tidak bisa mengakses data GM. nickname:$cnickname");
if(mysqli_num_rows($q)!=1) die("Data GM harus unik, cek kembali SQL room subject!");
$d = mysqli_fetch_assoc($q);
$nama_player = $d['nama_player'];

# ================================================
# GET ROOM DATA
# ================================================
$semester = "3 (Ganjil)"; //zzz








































# ================================================
# REKAP ALL PERTEMUAN
# ================================================
if ($sesi_ke=="0") {

	$sesi_ke = $total_pertemuan; //hingga saat ini

	$rows = '';

	$s = "SELECT a.* from tb_room_kelas a 
	join tb_kelas b on a.kelas=b.kelas  
	where a.id_room='$cid_room'  
	and $sql_kelas 
	and $sql_prodi 
	";

	// die($s);
	$q = mysqli_query($cn,$s) or die("Tidak bisa mengakses data room id_room_kelas");
	if(mysqli_num_rows($q)==0) die("<div class='alert alert-danger'>No Data. Silahkan Filtering kembali!<small> <br>~ id_room_kelas: $id_room_kelas <br>~ prodi: $prodi</small></div>");

	$isi_csv = "REKAP DAFTAR HADIR DAN KEAKTIFAN MAHASISWA\n\n";
	$isi_csv.= "MATA KULIAH:,$cnama_room\n";
	$isi_csv.= "SEMESTER:,$semester\n\n";

	$i=0;
	$kelas_ke=0;
	while($d=mysqli_fetch_assoc($q)){

		$kelas_ke++;
		$bg_rows_sty = '';
		// if($kelas_ke%2==0)$bg_rows_sty = " style='background-color:#005' ";

		$id_room_kelas = $d['id_room_kelas'];
		$kelas = $d['kelas'];

		$isi_csv.= "\n\nNO,KELAS,NIM,NAMA MAHASISWA,P1,P2,P3,P4,P5,P6,P7,UTS,P9,P10,P11,P12,P13,P14,P15,UAS,RATA-RATA\n";

		$ss = "SELECT a.*,b.nama_player,b.no_wa from tb_kelas_det a 
		join tb_player b on a.nickname=b.nickname 
		where a.kelas='$kelas' 
		order by b.nama_player 
		";
		$qq = mysqli_query($cn,$ss) or die("Tidak bisa mengakses detail id_room_kelas. ".mysqli_error($cn));
		if(mysqli_num_rows($qq)==0){
			echo "
			<tr>
				<td colspan=8>No Data pada id_room_kelas: $id_room_kelas</td>
			</tr>
			";
		}else{
			while ($d=mysqli_fetch_assoc($qq)) {
				$i++;
				$znickname = $d['nickname'];
				$znama_player = ucwords(strtolower($d['nama_player']));
				$zstatus_in_class = $d['status_in_class'];
				$zno_wa = $d['no_wa'];
				if($zstatus_in_class=="") $zstatus_in_class="-";
				$jk = "-"; //zzz

				$img_wa = "wa_disabled";
				$img_class = "img_wa_disabled";
				if($zno_wa!=""){
					$img_wa = "wa"; $img_class = "img_wa";
					$img_class = "img_wa";
					$pesan_wa = urlencode("Hallo $znama_player");
					$img_wa = "<a href='https://api.whatsapp.com/send?phone=62$zno_wa&text=$pesan_wa' target='_blank'><img src='assets/img/icons/$img_wa.png' width='20px' id='img_wa__$znickname' class='$img_class' /></a>";

				}else{
					$img_wa = "<img src='assets/img/icons/$img_wa.png' width='20px' id='img_wa__$znickname' class='$img_class' />";
				}






				// zzz here
				$sss0 = "SELECT id_room_subject,nama_subject from tb_room_subject  
				where id_room='$cid_room' 
				and nama_subject  not like '%materi umum%' 
				order by no_subject 
				"; 
				// die($sss0);
				$qqq = mysqli_query($cn,$sss0) or die("Tidak bisa menghitung jumlah presensi. nickname: $znickname. ".mysqli_error($cn));

				$j=0;
				$jabsen = 0;
				while ($ddd = mysqli_fetch_assoc($qqq)) {
					$j++;

					$id_room_subject_filters[$j] = $ddd['id_room_subject'];
					$nama_subjects_filters[$j] = $ddd['nama_subject'];

					// echo "<hr>".$ddd['nama_subject'];

					$sz = "SELECT * from tb_presensi where id_room_subject='".$ddd['id_room_subject']."' and  nickname='$znickname'";
					$qz = mysqli_query($cn,$sz) or die("here 78d87d88s. ".mysqli_error($cn));
					$jabsen+=mysqli_num_rows($qz);

					if($id_room_subject_filter==$ddd['id_room_subject']) break;
				}
				// $jabsen = mysqli_num_rows($qqq);
				// $jabsen = $jabsen;


				# ============================================================
				# PROGRES KEHADIRAN
				# ============================================================
				$poin_saat_ini_show = "?";
				$rank_saat_ini_show = "?";
				$sss1 = "SELECT poin_saat_ini,rank_saat_ini 
				from tb_presensi where id_room_subject='$id_room_subject_filter' and nickname='$znickname'";
				$qqq = mysqli_query($cn,$sss1) or die("Tidak bisa mengecek presensi pada id_room_subject_filter: $id_room_subject_filter");
				if(mysqli_num_rows($qqq)==1){
					$kehadiran = "<img src='assets/img/icons/check_green.png' width='20px' />";
					$is_hadir = "HADIR";
					$persen_is_hadir = "100%";

					$ddd = mysqli_fetch_assoc($qqq);
					$poin_saat_ini = $ddd['poin_saat_ini'];
					$rank_saat_ini = $ddd['rank_saat_ini'];

					$poin_saat_ini_show = "$poin_saat_ini LP";
					$rank_saat_ini_show = "$rank_saat_ini";

				}else{
					$kehadiran = "<img src='assets/img/icons/reject.png' width='20px' />";
					$is_hadir = "TIDAK HADIR";
					$persen_is_hadir = "0%";
				}
				$persen_progres = intval($jabsen/$sesi_ke*100);

				if($kelas_before!="" and $kelas_before!=$kelas){
					$rows.="<tr><td colspan=26>&nbsp;</tr></tr>";
				}
				$kelas_before = $kelas;

				$rows.="
				<tr $bg_rows_sty class='row_presensi'>
					<td>$i</td>
					<td style='text-align:left'>$kelas</td>
					<td>$znickname</td>
					<td style='text-align:left'>$znama_player</td>
				";
				$isi_csv.="$i,$kelas,$znickname,$znama_player";

				# ============================================================
				# P1 - P7
				# ============================================================
				for ($j=1; $j <= 7 ; $j++) { 
					$sk = "SELECT 1 from tb_presensi a 
					join tb_room_subject b on a.id_room_subject=b.id_room_subject 
					where a.nickname='$znickname' and b.no_subject='$j'";
					$qk = mysqli_query($cn,$sk) or die("Tidak bisa mengecek kehadiran. no_subject:$j, nickname:$nickname");
					if(mysqli_num_rows($qk)==1){
						$rows.= "<td>$img_check</td>";
						$isi_csv.=",v";
					}else{
						$rows.= "<td>-</td>";
						$isi_csv.=",-";
					}
				}


				# ============================================================
				# UTS
				# ============================================================
				$rows.= "<td>-</td>";
				$isi_csv.=",-";

				# ============================================================
				# P9 - P15
				# ============================================================
				for ($j=9; $j <= 15 ; $j++) { 
					$sk = "SELECT 1 from tb_presensi a 
					join tb_room_subject b on a.id_room_subject=b.id_room_subject 
					where a.nickname='$znickname' and b.no_subject='$j'";
					$qk = mysqli_query($cn,$sk) or die("Tidak bisa mengecek kehadiran. no_subject:$j, nickname:$nickname");
					if(mysqli_num_rows($qk)==1){
						$rows.= "<td>$img_check</td>";
						$isi_csv.=",v";
					}else{
						$rows.= "<td>-</td>";
						$isi_csv.=",-";
					}
				}

				# ============================================================
				# UAS
				# ============================================================
				$rows.= "<td>-</td>";
				$isi_csv.=",-";


				# ============================================================
				# PERSEN PROGRES
				# ============================================================
				$persen_progres_rows = "<td style='color: #005; background-color:#afa; text-align:left'>$img_wa $persen_progres%</td>";
				if($persen_progres<75)$persen_progres_rows = "<td style='color: black; background-color:yellow; text-align:left'>$img_wa $persen_progres%</td>";
				if($persen_progres<50)$persen_progres_rows = "<td style='color: black; background-color:#f77; text-align:left'>$img_wa $persen_progres%</td>";
				$rows.= "$persen_progres_rows";
				$rows.= "<td class='editable not_ready'>S01</td>"; //zzz
				$rows.="</tr>";
				$isi_csv.=",$persen_progres%\n";


			}
		}
	}

	echo "
	<div class='wadah'>
		<h3 class='text-center'>REKAP PRESENSI DAN KEAKTIFAN MAHASISWA</h3>

		<table>
			<tr><td width='120px'>ROOM</td><td width='20px'>:</td><td>$cnama_room</td></tr>
			<tr><td>SEMESTER</td><td>:</td><td>$semester</td></tr>
		</table>

		<table id='tb_dhkm'>
			<tr>
				<td class='td_judul' rowspan='2'>NO</td>
				<td class='td_judul' rowspan='2'>KELAS</td>
				<td class='td_judul' rowspan='2'>NIM</td>
				<td class='td_judul' rowspan='2'>NAMA MAHASISWA</td>
				<td class='td_judul' colspan='16'>KEHADIRAN</td>
				<td class='td_judul' rowspan='2'>PROGRES</td>
				<td class='td_judul' rowspan='2'>STATUS</td>
			</tr>
			<tr>
				<td class='td_judul'>1</td>
				<td class='td_judul'>2</td>
				<td class='td_judul'>3</td>
				<td class='td_judul'>4</td>
				<td class='td_judul'>5</td>
				<td class='td_judul'>6</td>
				<td class='td_judul'>7</td>
				<td class='td_judul'>UTS</td>
				<td class='td_judul'>9</td>
				<td class='td_judul'>10</td>
				<td class='td_judul'>11</td>
				<td class='td_judul'>12</td>
				<td class='td_judul'>13</td>
				<td class='td_judul'>14</td>
				<td class='td_judul'>15</td>
				<td class='td_judul'>UAS</td>
			</tr>

			$rows

		</table>

	</div>";

	$isi_csv.= "\n\nDosen,Iin.M.Kom\n";
	$isi_csv.= "NIDN,0411068706\n";
	$isi_csv.= "Data from Question Wars Gamified Systems :: ".date("Y-m-d h:i:s")."\n\n\n";
	$nama_room_csv = str_replace(" ","_",strtolower($cnama_room));
	$nama_subject_csv = str_replace(" ","_",strtolower($nama_subject));
	$kelas_csv = str_replace(" ","_",strtolower($kelas));
	$file_name = "csv/rekap_presensi"."_$nama_room_csv".".csv";


	$myfile = fopen($file_name, "w+") or die("Tidak bisa mengakses File. Mungkin file sedang dibuka oleh Aplikasi lain semisal Ms. Excel!");
	fwrite($myfile, "$isi_csv");
	fclose($myfile);

	echo "<hr><a href='ajax/$file_name'><img src='assets/img/icons/csv.png'></a>"; 


	exit();
}




























# ================================================
# PRESENSI PER KELAS
# ================================================
# ================================================
# GET SUBJECT ROOM DATA :: DATE OPEN
# ================================================
$s = "SELECT a.* from tb_room_subject a where a.id_room_subject='$id_room_subject_filter'";
$q = mysqli_query($cn,$s) or die("Tidak bisa mengakses room subject. id_room_subject_filter:$id_room_subject_filter");
if(mysqli_num_rows($q)!=1) die("Data room subject harus unik, cek kembali SQL room subject!");

$d = mysqli_fetch_assoc($q);

// $kelengkapan_presensi_gm = $d['kelengkapan_presensi_gm'];
// if(!$kelengkapan_presensi_gm) die("Dosen belum melengkapi kelengkapan presensi (RPS, link bahan ajar, dll)");
//zzz

$nama_subject = $d['nama_subject'];
$sesi_ke = $d['no_subject'];
$hari_tgl = date("d F Y", strtotime($d['date_jadwal']));
$waktu = date("H:i", strtotime($d['date_jadwal']));




$s = "SELECT a.* from tb_room_kelas a 
join tb_kelas b on a.kelas=b.kelas  
where a.id_room='$cid_room'  
and $sql_kelas 
and $sql_prodi 
";

// die($s);
$q = mysqli_query($cn,$s) or die("Tidak bisa mengakses data room id_room_kelas");
if(mysqli_num_rows($q)==0) die("<div class='alert alert-danger'>No Data. Silahkan Filtering kembali!<small> <br>~ id_room_kelas: $id_room_kelas <br>~ prodi: $prodi</small></div>");

while($d=mysqli_fetch_assoc($q)){

	$id_room_kelas = $d['id_room_kelas'];
	$kelas = $d['kelas'];

	?>

	<div style="border:solid 1px #666;padding:15px;margin-bottom: 30px;">
		<h3 class="text-center">DAFTAR HADIR DAN KEAKTIFAN MAHASISWA</h3>
		<table width="100%">
			<tr>
				<td>MATA KULIAH</td>
				<td>:</td>
				<td><?=$cnama_room?></td>
				<td>SESI KULIAH</td>
				<td>:</td>
				<td><?=$sesi_ke?> - <?=$nama_subject ?></td>
			</tr>
			<tr>
				<td>SEMESTER</td>
				<td>:</td>
				<td><?=$semester?></td>
				<td>HARI/TANGGAL</td>
				<td>:</td>
				<td><?=$hari_tgl?></td>
			</tr>
			<tr>
				<td>KELAS</td>
				<td>:</td>
				<td><?=$kelas?></td>
				<td>WAKTU</td>
				<td>:</td>
				<td><?=$waktu?></td>
			</tr>
		</table>

		<table id='tb_dhkm'>
			<thead>
				<th>NO</th>
				<th>NIM</th>
				<th>NAMA MAHASISWA</th>
				<th>JK</th>
				<th>STATUS</th>
				<th>KEHADIRAN</th>
				<th>PROGRES</th>
				<th>DAILY LOGIN</th>
				<th>POINT</th>
				<th>RANK<br><small>of <?=$total_player?> mhs</small></th>
			</thead>

			<?php 
			$isi_csv = "DAFTAR HADIR DAN KEAKTIFAN MAHASISWA\n\n";
			$isi_csv.= "MATA KULIAH:,$cnama_room\n";
			$isi_csv.= "KELAS:,$kelas\n";
			$isi_csv.= "PERTEMUAN KE:,$sesi_ke - $nama_subject\n";
			$isi_csv.= "HARI/TANGGAL:,$hari_tgl\n";
			$isi_csv.= "WAKTU:,$waktu\n";
			$isi_csv.= "SEMESTER:,$semester\n\n";
			$isi_csv.= "NO,NIM,NAMA MAHASISWA,JK,STATUS,KEHADIRAN,PROGRES,RATA-RATA\n";

			$ss = "SELECT a.*,b.nama_player from tb_kelas_det a 
			join tb_player b on a.nickname=b.nickname 
			where a.kelas='$kelas' 
			order by b.nama_player 
			";
			$qq = mysqli_query($cn,$ss) or die("Tidak bisa mengakses detail id_room_kelas. ".mysqli_error($cn));
			if(mysqli_num_rows($qq)==0){
				echo "
				<tr>
					<td colspan=8>No Data pada id_room_kelas: $id_room_kelas</td>
				</tr>
				";
			}else{
				$i=0;
				while ($d=mysqli_fetch_assoc($qq)) {
					$i++;
					$znickname = $d['nickname'];
					$znama_player = ucwords(strtolower($d['nama_player']));
					$zstatus_in_class = $d['status_in_class'];
					if($zstatus_in_class=="") $zstatus_in_class="-";
					$jk = "-";




					// zzz here
					$sss0 = "SELECT id_room_subject,nama_subject from tb_room_subject  
					where id_room='$cid_room' 
					and nama_subject  not like '%materi umum%' 
					order by no_subject 
					"; 
					// die($sss0);
					$qqq = mysqli_query($cn,$sss0) or die("Tidak bisa menghitung jumlah presensi. nickname: $znickname. ".mysqli_error($cn));

					$j=0;
					$jabsen = 0;
					while ($ddd = mysqli_fetch_assoc($qqq)) {
						$j++;

						$id_room_subject_filters[$j] = $ddd['id_room_subject'];
						$nama_subjects_filters[$j] = $ddd['nama_subject'];

						// echo "<hr>".$ddd['nama_subject'];

						$sz = "SELECT * from tb_presensi where id_room_subject='".$ddd['id_room_subject']."' and  nickname='$znickname'";
						$qz = mysqli_query($cn,$sz) or die("here 78d87d88s. ".mysqli_error($cn));
						$jabsen+=mysqli_num_rows($qz);

						if($id_room_subject_filter==$ddd['id_room_subject']) break;
					}
					// $jabsen = mysqli_num_rows($qqq);
					// $jabsen = $jabsen;


					# ============================================================
					# PROGRES KEHADIRAN
					# ============================================================
					$poin_saat_ini_show = "?";
					$rank_saat_ini_show = "?";
					$sss1 = "SELECT poin_saat_ini,rank_saat_ini 
					from tb_presensi where id_room_subject='$id_room_subject_filter' and nickname='$znickname'";
					$qqq = mysqli_query($cn,$sss1) or die("Tidak bisa mengecek presensi pada id_room_subject_filter: $id_room_subject_filter");
					if(mysqli_num_rows($qqq)==1){
						$kehadiran = "<img src='assets/img/icons/check_green.png' width='20px' />";
						$is_hadir = "HADIR";
						$persen_is_hadir = "100%";

						$ddd = mysqli_fetch_assoc($qqq);
						$poin_saat_ini = $ddd['poin_saat_ini'];
						$rank_saat_ini = $ddd['rank_saat_ini'];

						$poin_saat_ini_show = "$poin_saat_ini LP";
						$rank_saat_ini_show = "$rank_saat_ini";

					}else{
						$kehadiran = "<img src='assets/img/icons/reject.png' width='20px' />";
						$is_hadir = "TIDAK HADIR";
						$persen_is_hadir = "0%";
					}
					$persen_progres = intval($jabsen/$sesi_ke*100);



					# ============================================================
					# DAILY LOGIN
					# ============================================================
					$sss2 = "SELECT 1 from tb_daily_login a 
					join tb_login b on a.id_login=b.id_login where nickname='$znickname'";
					$qqq = mysqli_query($cn,$sss2) or die("Tidak bisa mengecek daily login. nickname: $znickname");
					$count_daily_login = mysqli_num_rows($qqq);


					# ============================================================
					# DAILY LOGIN
					# ============================================================
					$btn_wa = "<a href='https://api.whatsapp.com' target='_blank'><img src='assets\img\icons\wa.png' width='25px'></a>";

					# ============================================================
					# OUTPUT FOR CSV
					# ============================================================
					$status_in_class = '';
					$isi_csv.= "$i,$znickname,$znama_player,$jk,$status_in_class,$is_hadir,$persen_is_hadir,$persen_progres%\n";
					# ============================================================
					# OUTPUT TABLE
					# ============================================================
					echo "
					<tr>
						<td>$i</td>
						<td>$znickname</td>
						<td style='text-align:left'>$znama_player</td>
						<td>$jk</td>
						<td>$zstatus_in_class</td>
						<td>$kehadiran &nbsp; $btn_wa</td>
						<td>$jabsen of $sesi_ke ($persen_progres%)</td>
						<td>$count_daily_login</td>
						<td>$poin_saat_ini_show</td>
						<td>$rank_saat_ini_show</td>
					</tr>
					";
				}
			}
			?>
		</table>
		<br>
		<table width="100%">
			<tr>
				<td valign="top">
					<?=$lokasi_kampus?>, <?=date("d F Y",strtotime($tanggal_skg))?>
					<br>Dosen Pengampu: <?=$nama_player?>
					<br><small><i><a href="<?=$link_dosen?>"><?=$link_dosen?></a></i></small> 
				</td>
				<td valign="top" align="right">
					<small>Tervalidasi oleh:</small> <strong><?=$nama_si?></strong>
					<br><small>Presention Report, <?=date("D, d M Y H:i:s")?>
						<br><a href="https://siakad.ikmi.ac.id/qwars" target="_blank"><i>https://siakad.ikmi.ac.id/qwars</i></a>
					</small>
				</td>
			</tr>
		</table>


		<?php 
		$isi_csv.= "\n\nDosen,Iin.M.Kom\n";
		$isi_csv.= "NIDN,0411068706\n";
		$isi_csv.= "Data from Question Wars Gamified Systems :: ".date("Y-m-d h:i:s")."\n";
		$nama_room_csv = str_replace(" ","_",strtolower($cnama_room));
		$nama_subject_csv = str_replace(" ","_",strtolower($nama_subject));
		$kelas_csv = str_replace(" ","_",strtolower($kelas));
		$file_name = "csv/csv_room_$cid_room"."_$nama_room_csv"."__$kelas_csv"."__P$sesi_ke"."__$nama_subject_csv".".csv";


		$myfile = fopen($file_name, "w+") or die("Tidak bisa mengakses File. Mungkin file sedang dibuka oleh Aplikasi lain semisal Ms. Excel!");
		fwrite($myfile, "$isi_csv");
		fclose($myfile);

		$zzz = "zzz";

		echo "
		<hr>
		<form method='post' action='pdf/' target='_blank'>
	
			<a href='ajax/$file_name' class='btn btn-success'><img src='assets/img/icons/csv.png' height='40px'> Get CSV</a>

			<input type='hidden' name='prodi' value='$prodi'/>
			<input type='hidden' name='id_room_kelas' value='$id_room_kelas'/>
			<input type='hidden' name='id_room_subject_filter' value='$id_room_subject_filter'/>
			<input type='hidden' name='sesi_ke' value='$sesi_ke'/>
			<button class='btn btn-success'><img src='assets/img/icons/pdf.png' height='40px'> Get PDF</button>
		</form>
		"; 

		?>
	</div>

	<?php

}

?>