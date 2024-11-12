<?php
include('connection.php');

$sql = "SELECT asset_name AS colAssets, stock AS colStocks FROM assets";
$stmt = $conn->query($sql);

if (!$stmt) {
    die("Query Error: " . $conn->errorInfo()[2]);
}

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check for a 'json' query parameter to decide whether to output JSON
if (isset($_GET['json'])) {
    echo json_encode($data);
}
