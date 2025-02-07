<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Formulations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Manage Formulations</h2>
        <form method="post" action="save_formulation.php">
            <div class="mb-3">
                <label class="form-label">Brand</label>
                <select class="form-select" name="brand_id" required>
                    <?php
                    $result = $conn->query("SELECT b.id, b.brand_name, d.generic_name 
                                          FROM brands b JOIN drugs d ON b.drug_id = d.id");
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="'.$row['id'].'">'.$row['brand_name'].' ('.$row['generic_name'].')</option>';
                    }
                    ?>
                </select>
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <label class="form-label">Form</label>
                    <select class="form-select" name="form" required>
                        <option value="syrup">Syrup</option>
                        <option value="tablet">Tablet</option>
                        <option value="drops">Drops</option>
                        <option value="nebulization">Nebulization</option>
                    </select>
                </div>
                
                <div class="col-md-4">
                    <label class="form-label">Strength</label>
                    <input type="text" class="form-control" name="strength" 
                           placeholder="e.g., 250mg/5ml" required>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-3">
                    <label class="form-label">Dosage (mg/kg)</label>
                    <input type="number" step="0.01" class="form-control" 
                           name="dosage_per_kg" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Max Daily Dose (mg/kg)</label>
                    <input type="number" step="0.01" class="form-control" 
                           name="dosage_per_kg_max">
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Save Formulation</button>
        </form>

        <h3 class="mt-5">Existing Formulations</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Brand</th>
                    <th>Form</th>
                    <th>Strength</th>
                    <th>Dosage</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conn->query("
                    SELECT f.*, b.brand_name 
                    FROM formulations f
                    JOIN brands b ON f.brand_id = b.id
                ");
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['brand_name']}</td>
                        <td>{$row['form']}</td>
                        <td>{$row['strength']}</td>
                        <td>{$row['dosage_per_kg']} mg/kg</td>
                        <td>
                            <a href='edit_formulation.php?id={$row['id']}' class='btn btn-sm btn-warning'>Edit</a>
                            <a href='delete_formulation.php?id={$row['id']}' class='btn btn-sm btn-danger'>Delete</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
