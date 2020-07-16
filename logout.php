<?php
session_start();
session_destroy(); // on détruit la session user et redirige vers page de co
header('location:login.php');
exit;
?>