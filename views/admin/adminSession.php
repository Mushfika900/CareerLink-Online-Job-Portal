<?php

if (session_status() === PHP_SESSION_NONE)
{
    session_start();
}

if (!isset($_SESSION["user_id"]) ||!isset($_SESSION["role"]) ||$_SESSION["role"] != "admin")
{
    header("Location: /CareerLink-Online-Job-Portal/views/login.php");
    exit();
}

?>