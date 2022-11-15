<?php 
# ================================================
# INDEX OF PDF
# ================================================
session_start(); 
# ================================================
# SESSION SECURITY
# ================================================
function erjx($a){return "Error @ajax. Index($a) belum terdefinisi.";}

$nickname = isset($_SESSION['nickname']) ? $_SESSION['nickname'] : die(erjx('nickname'));
$admin_level = isset($_SESSION['admin_level']) ? $_SESSION['admin_level'] : die(erjx('admin_level'));
$id_room = isset($_SESSION['id_room']) ? $_SESSION['id_room'] : die(erjx('id_room'));

if($admin_level<1) die("Error @ajax. Maaf Anda Belum login!");

# ================================================
# GET VARIABLES
# ================================================
$last_id_room_subject = isset($_POST['last_id_room_subject']) ? $_POST['last_id_room_subject'] : die(erjx('last_id_room_subject'));


$location = "Cirebon"; //zzz
$link_dosen = "https://siakad.ikmi.ac.id/dosen/?insho"; //zzz
$img_check = "<img src='assets/img/icons/check_green.png' width='18px' />";
$namapdf = "report_card-$nickname-$.pdf";





include "../config.php";
# ================================================
# GET Player NAME
# ================================================
$s = "SELECT nama_player from tb_player where nickname='$nickname'";
$q = mysqli_query($cn,$s) or die("Tidak bisa mengakses data Player. nickname:$nickname");
if(mysqli_num_rows($q)!=1) die("Data Player harus unik, cek kembali SQL room subject!");
$d = mysqli_fetch_assoc($q);
$nama_player = $d['nama_player'];

# ================================================
# GET ROOM DATA
# ================================================
$semester = "3 (Ganjil)"; //zzz
// $namapdf = "$kelas---$singkatan_room-P$sesi_ke.pdf";

$nama_room = 'Web Dasarszzz'; //zzz
$sesi_ke = 8; //zzz
$nama_subject = 'P09 PHP'; //zzz
$nama_room = 'Web Dasarszzz'; //zzz
$hari_tgl = 'Hari Tglzzz'; //zzz
$kelas = 'KIP-MI-P1-szzz'; //zzz












# ================================================
# START CREATE PDF
# ================================================
require('fpdf.php');

class PDF extends FPDF {
    function Header(){
        $this->Image('kop.png',10,6,190);

        $this->SetFont('Arial','B',14);
        $this->Ln(20);
        $this->Cell(0,10,'Kartu Laporan Studi',0,0,'C');
        $this->Ln(10);
        $this->SetFont('Arial','',10);



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