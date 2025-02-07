<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pediatric_dose";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Security functions
function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

function validateNumber($value, $min = 0) {
    return is_numeric($value) && $value >= $min;
}
?>
