<?php 
# ================================================
# INDEX OF PDF
# ================================================
session_start(); 
# ================================================
# SESSION SECURITY
# ================================================
function erjx($a){return "Error @ajax. Index($a) belum terdefinisi.";}

if(!isset($_SESSION['nickname'])) die(erjx(1));
if(!isset($_SESSION['id_room'])) die(erjx(2));
if($_SESSION['admin_level']<2) die("Error @ajax. Maaf Anda Belum login sebagai Game Master.");

$nickname = $_SESSION['nickname'];
$admin_level = $_SESSION['admin_level'];
$id_room = $_SESSION['id_room'];


# ================================================
# GET VARIABLES
# ================================================
if(!isset($_POST['prodi'])) die(erjx(3)); $prodi = $_POST['prodi'];
if(trim($prodi)=="") die("Error @ajax. SQL Values Data is empty.");

if(!isset($_POST['id_room_kelas'])) die(erjx(4)); $id_room_kelas = $_POST['id_room_kelas'];
if(trim($id_room_kelas)=="") die("Error @ajax. SQL Values Data is empty.");

if(!isset($_POST['id_room_subject_filter'])) die(erjx(5)); $id_room_subject_filter = $_POST['id_room_subject_filter'];
if(trim($id_room_subject_filter)=="") die("Error @ajax. SQL Values Data is empty.");

if(!isset($_POST['sesi_ke'])) die(erjx(6)); $sesi_ke = $_POST['sesi_ke'];
if(trim($sesi_ke)=="") die("Error @ajax. SQL Values Data is empty.");


// $last_kelas = "";
// $kelas_before = "";
$location = "Cirebon"; //zzz
$link_dosen = "https://siakad.ikmi.ac.id/dosen/?insho"; //zzz
$img_check = "<img src='assets/img/icons/check_green.png' width='18px' />";
$namapdf = "doc.pdf";

// $prodi = "all";
// $id_room_kelas = "9_KA-2020-KIP-A";
// $id_room_subject_filter = 24;
// $sesi_ke = 1;




# ================================================
# SQL FILTERING
# ================================================
$sql_kelas = " 1 ";
$sql_prodi = " 1 ";

if($id_room_kelas=="0") die("<div class='wadah'>Silahkan pilih kelas!</div>");
if($id_room_kelas!="0" and $id_room_kelas!="all") $sql_kelas = " a.id_room_kelas='$id_room_kelas' ";

if($prodi!="all") $sql_prodi = " b.prodi='$prodi' ";




include "../config.php";
// include "../room_var.php";
// include "../pages/player/presensi_var.php";
# ================================================
# GET GM NAME
# ================================================
$s = "SELECT nama_player from tb_player where nickname='$nickname'";
$q = mysqli_query($cn,$s) or die("Tidak bisa mengakses data GM. nickname:$nickname");
if(mysqli_num_rows($q)!=1) die("Data GM harus unik, cek kembali SQL room subject!");
$d = mysqli_fetch_assoc($q);
$nama_player = $d['nama_player'];

# ================================================
# GET ROOM DATA
# ================================================
$semester = "3 (Ganjil)"; //zzz






# ================================================
# PRESENSI PER KELAS
# ================================================
# ================================================
# GET SUBJECT ROOM DATA :: DATE OPEN
# ================================================
$s = "SELECT a.*,b.nama_room,b.singkatan_room from tb_room_subject a 
join tb_room b on a.id_room=b.id_room 
where a.id_room_subject='$id_room_subject_filter'";
// die($s);
$q = mysqli_query($cn,$s) or die("Tidak bisa mengakses room subject. id_room_subject_filter:$id_room_subject_filter");
if(mysqli_num_rows($q)!=1) die("Data room subject harus unik, cek kembali SQL room subject!");

$d = mysqli_fetch_assoc($q);

// $kelengkapan_presensi_gm = $d['kelengkapan_presensi_gm'];
// if(!$kelengkapan_presensi_gm) die("Dosen belum melengkapi kelengkapan presensi (RPS, link bahan ajar, dll)");

$nama_subject = $d['nama_subject'];
$nama_room = $d['nama_room'];
$singkatan_room = $d['singkatan_room'];
$sesi_ke = $d['no_subject'];
$hari_tgl = date("d F Y", strtotime($d['date_jadwal']));
$waktu = date("H:i", strtotime($d['date_jadwal']));
$nama_room = trim(str_replace("2021","",$nama_room));



$s = "SELECT a.* from tb_room_kelas a 
join tb_kelas b on a.kelas=b.kelas  
where a.id_room='$id_room'  
and $sql_kelas 
and $sql_prodi 
";

// die($s);
$q = mysqli_query($cn,$s) or die("Tidak bisa mengakses data room id_room_kelas");
if(mysqli_num_rows($q)==0) die("<div class='alert alert-danger'>No Data. Silahkan Filtering kembali!<small> <br>~ id_room_kelas: $id_room_kelas <br>~ prodi: $prodi</small></div>");

while($d=mysqli_fetch_assoc($q)){

    $id_room_kelas = $d['id_room_kelas'];
    $kelas = $d['kelas'];

    $namapdf = "$kelas---$singkatan_room-P$sesi_ke.pdf";










































    require('fpdf.php');

    class PDF extends FPDF {
        function Header(){
            $this->Image('kop.png',10,6,190);

            $this->SetFont('Arial','B',14);
            $this->Ln(20);
            $this->Cell(0,10,'Daftar Hadir dan Nilai Keaktifan',0,0,'C');
            $this->Ln(10);
            $this->SetFont('Arial','',10);

            // $this->Cell(30,5,'MATA KULIAH',0,0);
            // $this->Cell(5,5,':',0,0);
            // $this->Cell(60,5,$nama_room,0,0);

            // $this->Cell(30,5,'PERTEMUAN KE',0,0);
            // $this->Cell(5,5,':',0,0);
            // $this->Cell(60,5,"P$sesi_ke - $nama_subject",0,1);


            // $this->Cell(30,5,'SEMESTER',0,0);
            // $this->Cell(5,5,':',0,0);
            // $this->Cell(60,5,$semester,0,0);

            // $this->Cell(30,5,'HARI/TANGGAL ',0,0);
            // $this->Cell(5,5,':',0,0);
            // $this->Cell(60,5,$hari_tgl,0,1);


            // $this->Cell(30,5,'KELAS',0,0);
            // $this->Cell(5,5,':',0,0);
            // $this->Cell(60,5,$kelas,0,0);

            // $this->Cell(30,5,'Waktu',0,0);
            // $this->Cell(5,5,':',0,0);
            // $this->Cell(60,5,'08.00 s.d 10.30',0,1);

            // $this->Cell(0,2,'',0,1);

            // $this->SetFillColor(0,255,255);

            // $this->Cell(7,8,'NO',1,0,'C',1);
            // $this->Cell(20,8,'NIM',1,0,'C',1);
            // $this->Cell(38,8,'NAMA MAHASISWA',1,0,'C',1);
            // $this->Cell(10,8,'JK',1,0,'C',1);
            // $this->Cell(10,8,'ST',1,0,'C',1);
            // $this->Cell(25,8,'KEHADIRAN',1,0,'C',1);
            // $this->Cell(24,8,'PROGRES',1,0,'C',1);
            // $this->Cell(20,8,'D.LOGINS',1,0,'C',1);
            // $this->Cell(18,8,'POINTS',1,0,'C',1);
            // $this->Cell(18,8,'RANK',1,1,'C',1);


        }

        function Footer(){
            $this->SetY(-15);

            $this->SetFont('Arial','I',8);
            $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
        }
    }

    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();



    $pdf->Cell(30,5,'MATA KULIAH',0,0);
    $pdf->Cell(5,5,':',0,0);
    $pdf->Cell(60,5,$nama_room,0,0);

    $pdf->Cell(30,5,'PERTEMUAN KE',0,0);
    $pdf->Cell(5,5,':',0,0);
    $pdf->Cell(60,5,"P$sesi_ke - $nama_subject",0,1);


    $pdf->Cell(30,5,'SEMESTER',0,0);
    $pdf->Cell(5,5,':',0,0);
    $pdf->Cell(60,5,$semester,0,0);

    $pdf->Cell(30,5,'HARI/TANGGAL ',0,0);
    $pdf->Cell(5,5,':',0,0);
    $pdf->Cell(60,5,$hari_tgl,0,1);


    $pdf->Cell(30,5,'KELAS',0,0);
    $pdf->Cell(5,5,':',0,0);
    $pdf->Cell(60,5,$kelas,0,0);

    $pdf->Cell(30,5,'Waktu',0,0);
    $pdf->Cell(5,5,':',0,0);
    $pdf->Cell(60,5,'08.00 s.d 10.30',0,1);

    $pdf->Cell(0,2,'',0,1);

    $pdf->SetFillColor(0,255,255);

    $pdf->Cell(7,8,'NO',1,0,'C',1);
    $pdf->Cell(20,8,'NIM',1,0,'C',1);
    $pdf->Cell(38,8,'NAMA MAHASISWA',1,0,'C',1);
    $pdf->Cell(10,8,'JK',1,0,'C',1);
    $pdf->Cell(10,8,'ST',1,0,'C',1);
    $pdf->Cell(25,8,'KEHADIRAN',1,0,'C',1);
    $pdf->Cell(24,8,'PROGRES',1,0,'C',1);
    $pdf->Cell(20,8,'D.LOGINS',1,0,'C',1);
    $pdf->Cell(18,8,'POINTS',1,0,'C',1);
    $pdf->Cell(18,8,'RANK',1,1,'C',1);




    # ======================================================
    # BEGIN LOOPING DATA
    # ======================================================
    $pdf->SetFont('Arial','',9);
    $pdf->SetDrawColor(100,100,100);

















































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


            $sss0 = "SELECT id_room_subject,nama_subject from tb_room_subject  
            where id_room='$id_room' 
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

                $sz = "SELECT * from tb_presensi where id_room_subject='".$ddd['id_room_subject']."' and  nickname='$znickname'";
                $qz = mysqli_query($cn,$sz) or die("here 78d87d88s. ".mysqli_error($cn));
                $jabsen+=mysqli_num_rows($qz);

                if($id_room_subject_filter==$ddd['id_room_subject']) break;
            }


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
            $status_in_class = "";
            # ============================================================
            # OUTPUT TABLE
            # ============================================================
            // echo "
            // <tr>
            // <td>$i</td>
            // <td>$znickname</td>
            // <td style='text-align:left'>$znama_player</td>
            // <td>$jk</td>
            // <td>$zstatus_in_class</td>
            // <td>$kehadiran &nbsp; $btn_wa</td>
            // <td>$jabsen of $sesi_ke ($persen_progres%)</td>
            // <td>$count_daily_login</td>
            // <td>$poin_saat_ini_show</td>
            // <td>$rank_saat_ini_show</td>
            // </tr>
            // ";

            if($i % 2 == 0){
                $pdf->SetFillColor(255,255,255);
            }else{
                $pdf->SetFillColor(240,240,240);
            }


            $pdf->Cell(7,5,$i,1,0,'C',1);
            $pdf->Cell(20,5,$znickname,1,0,'C',1);
            $pdf->Cell(38,5,$znama_player,1,0,'',1);
            $pdf->Cell(10,5,'-',1,0,'C',1);
            $pdf->Cell(10,5,$zstatus_in_class,1,0,'C',1);
            $pdf->Cell(25,5,$is_hadir,1,0,'C',1);
            $pdf->Cell(24,5,"$jabsen of $sesi_ke ($persen_progres%)",1,0,'C',1);
            $pdf->Cell(20,5,$count_daily_login,1,0,'C',1);
            $pdf->Cell(18,5,$poin_saat_ini_show,1,0,'C',1);
            $pdf->Cell(18,5,$rank_saat_ini_show,1,1,'C',1);
        }
    }
}



    // Cell 1  2  3    4       5   6      7     8
    //      w  h  txt  border  ln  align  fill  link
$pdf->Cell(0,5,'',0,1,'');
// $pdf->Cell(0,5,'Cirebon, 11 September 2021',1,1,'');
$pdf->Cell(106,8,'Dosen Pengampu:',0,0,''); 

$pdf->SetFont('Arial','i',7);
$pdf->Cell(84,8,'Verified by:',0,1,'');

$pdf->SetFont('Arial','b',9);
$pdf->Cell(106,5,'Iin, M.Kom',0,0,''); 

$pdf->SetFont('Arial','ib',9);
$pdf->Cell(84,5,'Academic Information System of STMIK IKMI Cirebon',0,1,'');

$pdf->SetFont('Arial','',9);
$pdf->Cell(106,5,'NIDN: 0411068706',0,0,'');

$pdf->SetFont('Arial','i',7);
$pdf->Cell(84,5,'Printed at: '.$location.', '.date("F d, Y H:i:s"),0,1,'');

$pdf->Image('qr.png',null,null,30);


$pdf->Output('D',$namapdf);
?>