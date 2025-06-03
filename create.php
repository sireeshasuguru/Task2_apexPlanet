<?php
session_start();
include "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $content = $_POST["content"];
    $user_id = $_SESSION["user_id"];

    $stmt = $conn->prepare("INSERT INTO posts (title, content, user_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $title, $content, $user_id);
    $stmt->execute();
    header("Location: index.php");
}
?>

<h2>Create New Post</h2>
<form method="POST">
    Title: <input type="text" name="title" required><br><br>
    Content:<br>
    <textarea name="content" rows="5" cols="50" required></textarea><br><br>
    <button type="submit">Create</button>
</form>
