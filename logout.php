<?php
session_start();
session_destroy();



unset($_SESSION['user_id']);
unset($_SESSION['user_name']);



header("Location: index.php");
exit();
