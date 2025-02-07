<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Brands</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Manage Brand Names</h2>
        <form method="post" action="save_brand.php">
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label">Select Generic Drug</label>
                    <select class="form-select" name="drug_id" required>
                        <?php
                        $result = $conn->query("SELECT * FROM drugs");
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='{$row['id']}'>{$row['generic_name']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Brand Name</label>
                    <input type="text" class="form-control" name="brand_name" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Add Brand</button>
        </form>

        <h3 class="mt-5">Existing Brands</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Generic Drug</th>
                    <th>Brand Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conn->query("
                    SELECT b.*, d.generic_name 
                    FROM brands b 
                    JOIN drugs d ON b.drug_id = d.id
                ");
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['generic_name']}</td>
                        <td>{$row['brand_name']}</td>
                        <td>
                            <a href='edit_brand.php?id={$row['id']}' class='btn btn-sm btn-warning'>Edit</a>
                            <a href='delete_brand.php?id={$row['id']}' class='btn btn-sm btn-danger'>Delete</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
