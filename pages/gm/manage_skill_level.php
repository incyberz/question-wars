<?php
$id_chal = isset($_GET['id_chal']) ? $_GET['id_chal'] : die('Index id_chal belum terdefinisi.');
$id_chal = 47; //zzz
$row = '';
$bm = '<b style=color:red>*</b>';
$btn_publish = '';

$s = "SELECT * from tb_chal where id_chal=$id_chal";
$q = mysqli_query($cn, $s) or die(mysqli_error($cn));
if (mysqli_num_rows($q)!=1) {
    die("Data challenge tidak ditemukan. id_chal:$id_chal");
}
$dt = mysqli_fetch_array($q);


$s = "SELECT * from tb_chal_skill_level where id_chal=$id_chal";
$q = mysqli_query($cn, $s) or die(mysqli_error($cn));
$i=0;
while ($d=mysqli_fetch_assoc($q)) {
    $i++;
    $row .= "
        <tr>
            <td>$i</td>
            <td class=editable>$d[nama_skill_level]</td>
            <td class=editable>$d[poin_skill_level]</td>
            <td class=editable>$d[syarat_skill_level]</td>
            <td>Del</td>
        </tr>
    ";
}
if ($row=='') {
    $row = "<tr><td style='background:#ff000033' colspan=5>No Data. Silahkan tambahkan Skill Level!</td></tr>";
}


?>

<style>th{color:yellow} #edit_challenge .link_btn{color:white !important} code{font-size:100%}</style>
<section id="edit_challenge" class="gm">
	<div class="container">
        <h3>Manage Skill Level</h3>
        <p>Challenge: <code><?=$dt['chal_name']?></code></p>
        <p><?=$link_back?> | Halo GM! Silahkan Anda tentukan berapa banyak Skill Level untuk Challenge ini!</p>
        <table class="table">
            <thead>
                <th>No</th>
                <th>Skill Level</th>
                <th>Point</th>
                <th>Syarat</th>
                <th>Aksi</th>
            </thead>
            <?=$row?>

        </table>
    </div>
</section>

<script>
    $(function(){
        
    })
</script>