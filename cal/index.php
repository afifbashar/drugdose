<?php
// calculator.php
require 'config.php';

$step = isset($_GET['step']) ? intval($_GET['step']) : 1;

if ($step == 1) {
    // Step 1: Enter age and brand/generic search
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Pediatric Doses Calculator - Step 1</title>
    </head>
    <body>
        <h2>Pediatric Doses Calculator - Step 1</h2>
        <form method="get" action="calculator.php">
            <input type="hidden" name="step" value="2">
            <label for="age">Child's Age (in years):</label>
            <input type="number" name="age" id="age" required>
            <br><br>
            <label for="search">Brand/Generic Name:</label>
            <input type="text" name="search" id="search" required>
            <br><br>
            <input type="submit" value="Next">
        </form>
    </body>
    </html>
    <?php
} elseif ($step == 2) {
    // Step 2: Select formulation based on search term
    $age = $_GET['age'];
    $search = $_GET['search'];
    $stmt = $pdo->prepare("SELECT DISTINCT formulation FROM drugs WHERE brand LIKE ? OR generic LIKE ?");
    $likeSearch = "%$search%";
    $stmt->execute([$likeSearch, $likeSearch]);
    $formulations = $stmt->fetchAll();
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Pediatric Doses Calculator - Step 2</title>
    </head>
    <body>
        <h2>Pediatric Doses Calculator - Step 2: Select Formulation</h2>
        <form method="get" action="calculator.php">
            <input type="hidden" name="step" value="3">
            <input type="hidden" name="age" value="<?php echo htmlspecialchars($age); ?>">
            <input type="hidden" name="search" value="<?php echo htmlspecialchars($search); ?>">
            <label for="formulation">Formulation:</label>
            <select name="formulation" id="formulation" required>
                <?php foreach ($formulations as $row) { ?>
                    <option value="<?php echo htmlspecialchars($row['formulation']); ?>">
                        <?php echo htmlspecialchars($row['formulation']); ?>
                    </option>
                <?php } ?>
            </select>
            <br><br>
            <input type="submit" value="Next">
        </form>
    </body>
    </html>
    <?php
} elseif ($step == 3) {
    // Step 3: Select strength
    $age = $_GET['age'];
    $search = $_GET['search'];
    $formulation = $_GET['formulation'];
    $stmt = $pdo->prepare("SELECT DISTINCT strength FROM drugs WHERE (brand LIKE ? OR generic LIKE ?) AND formulation = ?");
    $likeSearch = "%$search%";
    $stmt->execute([$likeSearch, $likeSearch, $formulation]);
    $strengths = $stmt->fetchAll();
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Pediatric Doses Calculator - Step 3</title>
    </head>
    <body>
        <h2>Pediatric Doses Calculator - Step 3: Select Strength</h2>
        <form method="get" action="calculator.php">
            <input type="hidden" name="step" value="4">
            <input type="hidden" name="age" value="<?php echo htmlspecialchars($age); ?>">
            <input type="hidden" name="search" value="<?php echo htmlspecialchars($search); ?>">
            <input type="hidden" name="formulation" value="<?php echo htmlspecialchars($formulation); ?>">
            <label for="strength">Strength:</label>
            <select name="strength" id="strength" required>
                <?php foreach ($strengths as $row) { ?>
                    <option value="<?php echo htmlspecialchars($row['strength']); ?>">
                        <?php echo htmlspecialchars($row['strength']); ?>
                    </option>
                <?php } ?>
            </select>
            <br><br>
            <input type="submit" value="Get Dose">
        </form>
    </body>
    </html>
    <?php
} elseif ($step == 4) {
    // Step 4: Display the drug record (dose and notes)
    $age = $_GET['age'];
    $search = $_GET['search'];
    $formulation = $_GET['formulation'];
    $strength = $_GET['strength'];
    $stmt = $pdo->prepare("SELECT * FROM drugs WHERE (brand LIKE ? OR generic LIKE ?) AND formulation = ? AND strength = ? LIMIT 1");
    $likeSearch = "%$search%";
    $stmt->execute([$likeSearch, $likeSearch, $formulation, $strength]);
    $drug = $stmt->fetch();
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Pediatric Doses Calculator - Result</title>
    </head>
    <body>
        <h2>Pediatric Doses Calculator - Result</h2>
        <?php if ($drug) { ?>
            <p><strong>Child's Age:</strong> <?php echo htmlspecialchars($age); ?> years</p>
            <p><strong>Drug Brand:</strong> <?php echo htmlspecialchars($drug['brand']); ?></p>
            <p><strong>Drug Generic:</strong> <?php echo htmlspecialchars($drug['generic']); ?></p>
            <p><strong>Formulation:</strong> <?php echo htmlspecialchars($drug['formulation']); ?></p>
            <p><strong>Strength:</strong> <?php echo htmlspecialchars($drug['strength']); ?></p>
            <p><strong>Recommended Dose:</strong><br>
               <?php echo nl2br(htmlspecialchars($drug['dose'])); ?>
            </p>
            <p><strong>Notes:</strong><br>
               <?php echo nl2br(htmlspecialchars($drug['notes'])); ?>
            </p>
        <?php } else { ?>
            <p style="color:red;">No matching drug found.</p>
        <?php } ?>
        <br>
        <a href="calculator.php">Start Over</a>
    </body>
    </html>
    <?php
}
?>
