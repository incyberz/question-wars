<?php 
$sdn = " style='display:none '";


# =================================================
# SKILLS
# =================================================
$skillba_ep_view = $skillba_ep==0 ? $sdn : '';
$skillba_ec_view = $skillba_ec==0 ? $sdn : '';
$skillba_ba_view = $skillba_ba==0 ? $sdn : '';
$skillba_ps_view = $skillba_ps==0 ? $sdn : '';
$skillba_mc_view = $skillba_mc==0 ? $sdn : '';

$skillko_of_view = $skillko_of==0 ? $sdn : '';
$skillko_pr_view = $skillko_pr==0 ? $sdn : '';
$skillko_dg_view = $skillko_dg==0 ? $sdn : '';
$skillko_mm_view = $skillko_mm==0 ? $sdn : '';
$skillko_nt_view = $skillko_nt==0 ? $sdn : '';

$skilla1_view = $skilla1==0 ? $sdn : '';
$skilla2_view = $skilla2==0 ? $sdn : '';
$skilla3_view = $skilla3==0 ? $sdn : '';
$skilla4_view = $skilla4==0 ? $sdn : '';
$skilla5_view = $skilla5==0 ? $sdn : '';

$li_skillba = ($skillba_ep==0 and $skillba_ec==0 and $skillba_ba==0 and $skillba_ps==0 and $skillba_mc==0) ? "<li>$ns</li>" :'';
$li_skillko = ($skillko_of==0 and $skillko_pr==0 and $skillko_dg==0 and $skillko_mm==0 and $skillko_nt==0) ? "<li>$ns</li>" :'';
$li_skilla = ($skilla1==0 and $skilla2==0 and $skilla3==0 and $skilla4==0 and $skilla5==0) ? "<li>$ns</li>" :'';







# =================================================
# HOBBY CITA
# =================================================
$hobby1_view = $hobby1=="" ? $sdn : '';
$hobby2_view = $hobby2=="" ? $sdn : '';
$hobby3_view = $hobby3=="" ? $sdn : '';
$hobby4_view = $hobby4=="" ? $sdn : '';
$hobby5_view = $hobby5=="" ? $sdn : '';

$tr_hobby = ($hobby1=="" and $hobby2=="" and $hobby3=="" and $hobby4=="" and $hobby5=="") ? "<tr><td><img src='../assets/img/icons/heart.png' width='20px' height='20px'></td><td>$ns</td></tr>" :'';

$cita1_view = $cita1=="" ? $sdn : '';
$cita2_view = $cita2=="" ? $sdn : '';
$cita3_view = $cita3=="" ? $sdn : '';

$tr_cita = ($cita1=="" and $cita2=="" and $cita3=="") ? "<tr><td><img src='../assets/img/icons/trophy.png' width='20px' height='20px'></td><td>$ns</td></tr>" :'';





# =================================================
# RIWAYAT
# =================================================
$riwayat_pendidikan1_view = ($rriwayat_pendidikan1[0]==""||$rriwayat_pendidikan1[1]==""||$rriwayat_pendidikan1[2]==""||$rriwayat_pendidikan1[3]=="") ? $sdn : '';
$riwayat_pendidikan2_view = ($rriwayat_pendidikan2[0]==""||$rriwayat_pendidikan2[1]==""||$rriwayat_pendidikan2[2]==""||$rriwayat_pendidikan2[3]=="") ? $sdn : '';
$riwayat_pendidikan3_view = ($rriwayat_pendidikan3[0]==""||$rriwayat_pendidikan3[1]==""||$rriwayat_pendidikan3[2]==""||$rriwayat_pendidikan3[3]=="") ? $sdn : '';
$riwayat_pendidikan4_view = ($rriwayat_pendidikan4[0]==""||$rriwayat_pendidikan4[1]==""||$rriwayat_pendidikan4[2]==""||$rriwayat_pendidikan4[3]=="") ? $sdn : '';
$riwayat_pendidikan5_view = ($rriwayat_pendidikan5[0]==""||$rriwayat_pendidikan5[1]==""||$rriwayat_pendidikan5[2]==""||$rriwayat_pendidikan5[3]=="") ? $sdn : '';

$riwayat_pekerjaan1_view = ($rriwayat_pekerjaan1[0]==""||$rriwayat_pekerjaan1[1]==""||$rriwayat_pekerjaan1[2]==""||$rriwayat_pekerjaan1[3]=="") ? $sdn : '';
$riwayat_pekerjaan2_view = ($rriwayat_pekerjaan2[0]==""||$rriwayat_pekerjaan2[1]==""||$rriwayat_pekerjaan2[2]==""||$rriwayat_pekerjaan2[3]=="") ? $sdn : '';
$riwayat_pekerjaan3_view = ($rriwayat_pekerjaan3[0]==""||$rriwayat_pekerjaan3[1]==""||$rriwayat_pekerjaan3[2]==""||$rriwayat_pekerjaan3[3]=="") ? $sdn : '';
$riwayat_pekerjaan4_view = ($rriwayat_pekerjaan4[0]==""||$rriwayat_pekerjaan4[1]==""||$rriwayat_pekerjaan4[2]==""||$rriwayat_pekerjaan4[3]=="") ? $sdn : '';
$riwayat_pekerjaan5_view = ($rriwayat_pekerjaan5[0]==""||$rriwayat_pekerjaan5[1]==""||$rriwayat_pekerjaan5[2]==""||$rriwayat_pekerjaan5[3]=="") ? $sdn : '';

$riwayat_organisasi1_view = ($rriwayat_organisasi1[0]==""||$rriwayat_organisasi1[1]==""||$rriwayat_organisasi1[2]==""||$rriwayat_organisasi1[3]=="") ? $sdn : '';
$riwayat_organisasi2_view = ($rriwayat_organisasi2[0]==""||$rriwayat_organisasi2[1]==""||$rriwayat_organisasi2[2]==""||$rriwayat_organisasi2[3]=="") ? $sdn : '';
$riwayat_organisasi3_view = ($rriwayat_organisasi3[0]==""||$rriwayat_organisasi3[1]==""||$rriwayat_organisasi3[2]==""||$rriwayat_organisasi3[3]=="") ? $sdn : '';
$riwayat_organisasi4_view = ($rriwayat_organisasi4[0]==""||$rriwayat_organisasi4[1]==""||$rriwayat_organisasi4[2]==""||$rriwayat_organisasi4[3]=="") ? $sdn : '';
$riwayat_organisasi5_view = ($rriwayat_organisasi5[0]==""||$rriwayat_organisasi5[1]==""||$rriwayat_organisasi5[2]==""||$rriwayat_organisasi5[3]=="") ? $sdn : '';

$riwayat_sertifikasi1_view = ($rriwayat_sertifikasi1[0]==""||$rriwayat_sertifikasi1[1]==""||$rriwayat_sertifikasi1[2]==""||$rriwayat_sertifikasi1[3]=="") ? $sdn : '';
$riwayat_sertifikasi2_view = ($rriwayat_sertifikasi2[0]==""||$rriwayat_sertifikasi2[1]==""||$rriwayat_sertifikasi2[2]==""||$rriwayat_sertifikasi2[3]=="") ? $sdn : '';
$riwayat_sertifikasi3_view = ($rriwayat_sertifikasi3[0]==""||$rriwayat_sertifikasi3[1]==""||$rriwayat_sertifikasi3[2]==""||$rriwayat_sertifikasi3[3]=="") ? $sdn : '';
$riwayat_sertifikasi4_view = ($rriwayat_sertifikasi4[0]==""||$rriwayat_sertifikasi4[1]==""||$rriwayat_sertifikasi4[2]==""||$rriwayat_sertifikasi4[3]=="") ? $sdn : '';
$riwayat_sertifikasi5_view = ($rriwayat_sertifikasi5[0]==""||$rriwayat_sertifikasi5[1]==""||$rriwayat_sertifikasi5[2]==""||$rriwayat_sertifikasi5[3]=="") ? $sdn : '';





?>

