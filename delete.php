<?php
session_start();
include "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$id = $_GET["id"];
$conn->query("DELETE FROM posts WHERE id = $id");
header("Location: index.php");
?>
