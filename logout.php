<?php 


session_start();
unset($_SESSION['user_id']);
session_destroy();
session_write_close();
echo$_SESSION['user_id'].'';
header("Location:index.html");



?>