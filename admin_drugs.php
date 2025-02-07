<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Drugs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Manage Generic Drugs</h2>
        <form method="post" action="save_drug.php">
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label">Generic Name</label>
                    <input type="text" class="form-control" name="generic_name" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Category</label>
                    <input type="text" class="form-control" name="category">
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Add Drug</button>
        </form>

        <h3 class="mt-5">Existing Drugs</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Generic Name</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conn->query("SELECT * FROM drugs");
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['generic_name']}</td>
                        <td>{$row['category']}</td>
                        <td>
                            <a href='edit_drug.php?id={$row['id']}' class='btn btn-sm btn-warning'>Edit</a>
                            <a href='delete_drug.php?id={$row['id']}' class='btn btn-sm btn-danger'>Delete</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
