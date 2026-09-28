<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
 session_start();
}
if (!isset($_SESSION["admin_id"])) {
 header("Location: login.php");
 exit;
}

