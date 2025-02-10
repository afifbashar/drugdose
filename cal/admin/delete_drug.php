<?php
// admin/delete_drug.php
require_once '../config.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    die("No drug ID specified.");
}

$id = $_GET['id'];

// Delete the record from the database
$stmt = $pdo->prepare("DELETE FROM drugs WHERE id = ?");
$stmt->execute([$id]);

header("Location: index.php");
exit;
?>
