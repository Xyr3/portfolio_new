<?php

session_start();

/* =====================================================
   WAJIB LOGIN
===================================================== */

if (
    !isset($_SESSION["logged_in"]) ||
    $_SESSION["logged_in"] !== true
) {
    header("Location: login.php");
    exit;
}

$username =
    $_SESSION["username"] ?? "XYR";

?>