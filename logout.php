<?php
// logout.php - Standard PHP Session Logout
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
session_unset();
session_destroy();
header("Location: signin.php?logged_out=1");
exit();
?>
