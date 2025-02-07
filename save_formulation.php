<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $brand_id = sanitizeInput($_POST['brand_id']);
    $form = sanitizeInput($_POST['form']);
    $strength = sanitizeInput($_POST['strength']);
    $dosage_per_kg = sanitizeInput($_POST['dosage_per_kg']);
    $dosage_per_kg_max = sanitizeInput($_POST['dosage_per_kg_max']);
    
    // Parse strength (e.g., "250mg/5ml" or "100mg/ml")
    preg_match('/(\d+\.?\d*)mg\/(\d+\.?\d*)(ml)/i', $strength, $matches);
    $strength_mg = $matches[1] ?? 0;
    $strength_ml = $matches[2] ?? 1;

    $stmt = $conn->prepare("INSERT INTO formulations 
        (brand_id, form, strength, strength_mg, strength_ml, dosage_per_kg, dosage_per_kg_max)
        VALUES (?, ?, ?, ?, ?, ?, ?)");
    
    $stmt->bind_param("isssddd", 
        $brand_id,
        $form,
        $strength,
        $strength_mg,
        $strength_ml,
        $dosage_per_kg,
        $dosage_per_kg_max
    );
    
    $stmt->execute();
    header("Location: admin_formulations.php");
}
?>
