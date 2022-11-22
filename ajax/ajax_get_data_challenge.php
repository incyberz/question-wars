<?php

$dm = 0;

$id_room = $_GET['id_room'];
$nickname = $_GET['nickname'];

include "../config.php";

$s = "SELECT * FROM tb_chal where id_room = $id_room and chal_creator != '$nickname'";
$q = mysqli_query($cn, $s) or die("Error @ajax get data challenges");

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
    if ($chal_desc!="") {
        $chal_desc.= "<br>";
    }

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
echo "$x</table>__1__2__3";
