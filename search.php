<?php
include 'config.php';

$query = $_POST['query'];

$stmt = $conn->prepare("
    SELECT b.id, b.brand_name, d.generic_name 
    FROM brands b
    JOIN drugs d ON b.drug_id = d.id
    WHERE b.brand_name LIKE ? OR d.generic_name LIKE ?
");
$searchTerm = "%$query%";
$stmt->bind_param("ss", $searchTerm, $searchTerm);
$stmt->execute();
$result = $stmt->get_result();

$output = '';
while ($row = $result->fetch_assoc()) {
    $output .= '<a class="list-group-item list-group-item-action" data-brandid="'.$row['id'].'">'
        .$row['brand_name'].' ('.$row['generic_name'].')</a>';
}
echo $output;
?>
