<?php
require_once('head.php');
unset($_SESSION['user_id']);
header("Location:index.php");
?>