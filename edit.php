<?php
session_start();
include "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$id = $_GET["id"];
$result = $conn->query("SELECT * FROM posts WHERE id = $id");
$post = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $content = $_POST["content"];
    $stmt = $conn->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?");
    $stmt->bind_param("ssi", $title, $content, $id);
    $stmt->execute();
    header("Location: index.php");
}
?>

<h2>Edit Post</h2>
<form method="POST">
    Title: <input type="text" name="title" value="<?php echo $post['title']; ?>" required><br><br>
    Content:<br>
    <textarea name="content" rows="5" cols="50" required><?php echo $post['content']; ?></textarea><br><br>
    <button type="submit">Update</button>
</form>
