<?php
// admin/add_drug.php
require_once '../config.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $brand = $_POST['brand'];
    $generic = $_POST['generic'];
    $formulation = $_POST['formulation'];
    $strength = $_POST['strength'];
    $dose = $_POST['dose'];
    $notes = $_POST['notes'];
    
    $stmt = $pdo->prepare("INSERT INTO drugs (brand, generic, formulation, strength, dose, notes) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$brand, $generic, $formulation, $strength, $dose, $notes]);
    
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add New Drug</title>
</head>
<body>
    <h2>Add New Drug</h2>
    <form method="post" action="add_drug.php">
        <label for="brand">Brand Name:</label>
        <input type="text" name="brand" id="brand" required>
        <br><br>
        <label for="generic">Generic Name:</label>
        <input type="text" name="generic" id="generic" required>
        <br><br>
        <label for="formulation">Formulation (e.g., tablet, syrup, drop):</label>
        <input type="text" name="formulation" id="formulation" required>
        <br><br>
        <label for="strength">Strength (e.g., 120mg/5ml):</label>
        <input type="text" name="strength" id="strength" required>
        <br><br>
        <label for="dose">Dose Information:</label>
        <textarea name="dose" id="dose" rows="4" cols="50"></textarea>
        <br><br>
        <label for="notes">Notes:</label>
        <textarea name="notes" id="notes" rows="4" cols="50"></textarea>
        <br><br>
        <input type="submit" value="Add Drug">
    </form>
    <p><a href="index.php">Back to Admin Panel</a></p>
</body>
</html>
