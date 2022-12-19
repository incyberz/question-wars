<?php

# ================================================
# SESSION SECURITY
# ================================================
session_start();
function erjx($a)
{
    return "Error @ajax. Index($a) belum terdefinisi.";
}

if (!isset($_SESSION['nickname'])) {
    die(erjx(1));
}
if (!isset($_SESSION['admin_level'])) {
    die(erjx(2));
}
if (!isset($_SESSION['id_room'])) {
    die(erjx(3));
}

$nickname = $_SESSION['nickname'];
$admin_level = $_SESSION['admin_level'];
$id_room = $_SESSION['id_room'];


# ================================================
# GET VARIABLES
# ================================================
if (!isset($_GET['chal_level_filter'])) {
    die(erjx(4));
} $chal_level_filter = $_GET['chal_level_filter'];
if (trim($chal_level_filter)=="") {
    die("Error @ajax. SQL Values Data #4 is empty.");
}

if (!isset($_GET['chal_name_filter'])) {
    die(erjx(5));
} $chal_name_filter = $_GET['chal_name_filter'];
// if(trim($chal_name_filter)=="") die("Error @ajax. SQL Values Data #5 is empty.");

if (!isset($_GET['status_beaten_filter'])) {
    die(erjx(6));
} $status_beaten_filter = $_GET['status_beaten_filter'];
if (trim($status_beaten_filter)=="") {
    die("Error @ajax. SQL Values Data #6 is empty.");
}

if (!isset($_GET['order_by_filter'])) {
    die(erjx(7));
} $order_by_filter = $_GET['order_by_filter'];
if (trim($order_by_filter)=="") {
    die("Error @ajax. SQL Values Data #7 is empty.");
}


# ================================================
# SQL IF
# ================================================
$sql_level = " 1 ";
$sql_name = " 1 ";
$sql_beaten = " 1 ";

if ($chal_level_filter!="all") {
    $sql_level = " a.chal_level = '$chal_level_filter' ";
}


include "../config.php";
# ================================================
# GET CHALLENGE LIST
# ================================================
$chal_visibility = $admin_level==2 ? ' 1 ' : "a.chal_visibility=1";
$s = "SELECT a.* from tb_chal a 
where $chal_visibility  
and id_room='$id_room' 
and $sql_level 
and a.chal_name like '%$chal_name_filter%'
order by $order_by_filter";
$q = mysqli_query($cn, $s) or die("Tidak bisa mengakses data challenge $s");
if (mysqli_num_rows($q)==0) {
    echo "<div class='alert alert-danger'>No Challenges yet on this Room. Ask GM to make one!</div>";
} else {
    echo "<ol>";
    while ($d=mysqli_fetch_assoc($q)) {
        $id_chal = $d['id_chal'];
        $chal_name = $d['chal_name'];
        $chal_created = date("d M Y H:i", strtotime($d['chal_created']));
        $chal_level = $d['chal_level'];
        $min_point = $d['min_point'];
        $max_point = $d['max_point'];
        $sifat_chal = $d['sifat_chal'];

        if ($sifat_chal!='') {
            if (strtolower($sifat_chal)=='wajib') {
                $sifat_chal_show = '<span class="badge badge-danger">Wajib</span>';
            }
            if (strtolower($sifat_chal)=='spesial') {
                $sifat_chal_show = '<span class="badge badge-info">Spesial</span>';
            }
        } else {
            $sifat_chal_show = '';
        }

        if ($admin_level==1) {
            $status_beaten_show = '';
            $ss = "SELECT * from tb_chal_beatenby where id_chal='$id_chal' and beaten_by='$nickname'";
            $qq = mysqli_query($cn, $ss) or die("Tidak bisa mengakses beaten_by. $ss");
            if (mysqli_num_rows($qq)>1) {
                die("Tidak boleh beaten_by ganda");
            }

            $is_beaten = 0;
            if (mysqli_num_rows($qq)==1) {
                $is_beaten = 1;
                $dd = mysqli_fetch_assoc($qq);
                $approved_by = $dd['approved_by'];
                $is_claimed = $dd['is_claimed'];
                $status_beaten_show = "<span class='badge badge-info'>Unverified</span>";

                $is_approved = 0;
                if ($approved_by!="") {
                    $status_beaten_show = "<span class='badge badge-primary'>Unclaimed</span>";
                    $is_approved = 1;
                }


                if ($is_claimed==1) {
                    $status_beaten_show = "<span class='badge badge-success'>Claimed</span>";
                }
            }

            $output = "<li>$sifat_chal_show <a href='?chaldet&id_chal=$id_chal' style='color:yellow'>$chal_name</a> $status_beaten_show<br><small>$chal_created - $chal_level - $min_point s.d $max_point LP</small></li>";

            if ($status_beaten_filter=="all") {
                echo "$output";
            } elseif ($status_beaten_filter=="unverified" and $is_beaten and !$is_approved and !$is_claimed) {
                echo "$output";
            } elseif ($status_beaten_filter=="unclaimed" and $is_approved and !$is_claimed) {
                echo "$output";
            } elseif ($status_beaten_filter=="claimed" and $is_claimed) {
                echo "$output";
            }
        }

        $jumlah_unverified = 0;
        if ($admin_level==2 or $admin_level==9) {
            $ss = "SELECT 1 from tb_chal_beatenby where id_chal='$id_chal' and approved_by is null";
            $qq = mysqli_query($cn, $ss) or die("Tidak bisa mengakses beaten_by for GM. $ss");
            $jumlah_unverified = mysqli_num_rows($qq);

            $jumlah_unverified_show = '';
            if ($jumlah_unverified>0) {
                $jumlah_unverified_show = "<span class='badge badge-info'>$jumlah_unverified Unverified</span>";
            }

            echo "<li>$sifat_chal_show <a href='?chaldet&id_chal=$id_chal' style='color:yellow'>$chal_name</a> $jumlah_unverified_show
			<br><small>$chal_created - $chal_level - $min_point s.d $max_point LP</small></li>";
        }
    }
    echo "</ol>";
}
