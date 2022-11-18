<?php

if (!isset($_SESSION['admin_level']) || ($_SESSION['admin_level']!='2'  && $_SESSION['admin_level']!=9)) {
    die("Error @ajax_session_security_gm_only. Maaf, fitur ini hanya boleh diakses oleh GM.");
}
