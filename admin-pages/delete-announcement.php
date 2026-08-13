<?php
require_once "../includes/admin-auth.php";
?>
<?php
require '../config/connection.php';

$id = $_GET['id'] ?? 0;
$id = (int) $id;

if ($id > 0) {
    $stmt = mysqli_prepare($conn, "DELETE FROM announcements WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
}

header("Location: announcements.php");
exit;
?>