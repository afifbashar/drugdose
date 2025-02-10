<?php
// admin/index.php
require_once '../config.php';

// Check that the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Retrieve all drug records
$stmt = $pdo->query("SELECT * FROM drugs ORDER BY created_at DESC");
$drugs = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - Manage Drugs</title>
</head>
<body>
    <h2>Admin Panel - Manage Drugs</h2>
    <p><a href="add_drug.php">Add New Drug</a> | <a href="logout.php">Logout</a></p>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Brand</th>
            <th>Generic</th>
            <th>Formulation</th>
            <th>Strength</th>
            <th>Dose</th>
            <th>Notes</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($drugs as $drug) { ?>
        <tr>
            <td><?php echo htmlspecialchars($drug['id']); ?></td>
            <td><?php echo htmlspecialchars($drug['brand']); ?></td>
            <td><?php echo htmlspecialchars($drug['generic']); ?></td>
            <td><?php echo htmlspecialchars($drug['formulation']); ?></td>
            <td><?php echo htmlspecialchars($drug['strength']); ?></td>
            <td><?php echo htmlspecialchars($drug['dose']); ?></td>
            <td><?php echo htmlspecialchars($drug['notes']); ?></td>
            <td>
                <a href="edit_drug.php?id=<?php echo $drug['id']; ?>">Edit</a> | 
                <a href="delete_drug.php?id=<?php echo $drug['id']; ?>" onclick="return confirm('Are you sure you want to delete this drug?');">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
