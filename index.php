<?php
session_start();
include "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$result = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
?>

<h2>Welcome, <?php echo $_SESSION["username"]; ?>!</h2>
<a href="create.php">+ New Post</a> |
<a href="logout.php">Logout</a>

<hr>

<?php while ($row = $result->fetch_assoc()): ?>
    <h3><?php echo $row["title"]; ?></h3>
    <p><?php echo $row["content"]; ?></p>
    <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a> |
    <a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
    <hr>
<?php endwhile; ?>
