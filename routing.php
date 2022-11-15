<?php 

switch ($parameter) {
  case '': 
  case 'dashboard': include "pages/player/dashboard/player_dashboard.php"; break;
  case 'beatq': include "pages/player/kuis_play.php"; break;
  case 'kuis': include "pages/player/play_kuis/pre_kuis.php"; break;
  case 'play_kuis': include "pages/player/play_kuis/kuis.php"; break;
  case 'delsoal': include "pages/player/hapus_soal.php"; break;
  case 'chal': include "pages/player/challenge.php"; break;
  case 'chalbeat': include "pages/player/challenge_beat_upload.php"; break;
  case 'chaldet': include "pages/player/challenge_detail.php"; break;
  case 'change_room': include "pages/player/change_room.php"; break;
  case 'myq': include "pages/player/player_question/player_question.php";break;
  case 'playedby': include "pages/player/soal_playedby.php"; break;
  case 'presensi': include "pages/player/presensi.php"; break;
  case 'konversi_nilai': include "pages/player/konversi_nilai/konversi_nilai.php"; break;
  case 'ubah_pass': include "pages/player/ubah_password/ubah_pass.php"; break;
  case 'tugas': include "pages/player/tugas_harian/tugas_harian.php"; break;

  case 'rank_kelas': include "pages/player/player_info/player_info_rank_kelas.php"; break;
  case 'rank_prodi': include "pages/player/player_info/player_info_rank_prodi.php"; break;
  case 'rank_global': include "pages/player/player_info/player_info_rank_global.php"; break;

  case 'paling_rajin': include "pages/player/player_info/player_info_paling_rajin.php"; break;
  case 'investor_soal': include "pages/player/player_info/player_info_investor_soal.php"; break;
  case 'best_chal': include "pages/player/player_info/player_info_best_challenger.php"; break;

  case 'help': include "pages/player/player_info/player_info_bantuan.php"; break;
  // case 'resetpass': include "pages/player/login_system/reset_password.php"; break;


  default: 

  if($cadmin_level==2 or $cadmin_level==9){
    # =================================================
    # KHUSUS GM
    # =================================================
    switch ($parameter) {
      case '': include "pages/gm/gm_dashboard.php"; break;
      case 'dashboard': include "pages/gm/gm_dashboard.php"; break;
      case 'change_room': include "pages/player/change_room.php"; break;
      case 'addroom': include "pages/gm/room_add.php"; break;
      case 'addchal': include "pages/gm/challenge_add.php"; break;
      case 'managekelas': include "pages/gm/manage_kelas.php"; break;
      case 'detail_kelas': include "pages/gm/detail_kelas.php"; break;
      case 'manageplayers': include "pages/gm/manage_players.php"; break;
      case 'manageroom': include "pages/gm/room_details.php"; break;
      case 'playerqs': include "pages/gm/manage_player_questions.php"; break;
      case 'fpresensi': include "pages/gm/gm_presensi_feedback.php"; break;
      case 'rpresensi': include "pages/gm/presensi_rekap.php"; break;
      case 'manage_peserta_kelas': include "pages/gm/manage_kelas/manage_peserta_kelas.php"; break;
      case 'listplayers': include "pages/gm/manage_players/list_players.php"; break;
      case 'lap_na': include "pages/gm/laporan_nilai_akhir/laporan_nilai_akhir.php"; break;
      case 'logas': include "pages/gm/login_as/login_as.php"; break;
      default: include "na.php"; break;
    }
  }else{
    include "na.php"; 
  }

  break;
}
?>