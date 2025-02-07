<?php
include 'config.php';

if (!isset($_GET['id'])) die("Invalid request");
$id = sanitizeInput($_GET['id']);

// Fetch existing data
$stmt = $conn->prepare("SELECT * FROM formulations WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$formulation = $stmt->get_result()->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process update similar to save_formulation.php
    // ... (implementation omitted for brevity) ...
}
?>
<!-- Similar form to admin_formulations.php but pre-filled -->
