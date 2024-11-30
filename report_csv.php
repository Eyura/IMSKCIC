<?php
$type = $_GET['report'];
$file_name = $type . '.xls';
$mapping_filenames = [
    'asset' => 'Assets Report',
];
$file_name = $mapping_filenames[$type] . '.xls';
header("Content-Disposition: attachment; filename=\"$file_name\"");
header("Content-Type: application/vnd.ms-excel");

// Pull data from database.
include('connection.php');

if ($type === 'asset') {
    $stmt = $conn->prepare("SELECT * FROM assets INNER JOIN users ON assets.created_by = users.id ORDER BY assets.created_at DESC");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $assets = $stmt->fetchAll();

    $is_header = true;

    foreach ($assets as $asset) {
        $asset['created_by'] = $asset['first_name'] . ' ' . $asset['last_name'];
        unset($asset['first_name'], $asset['last_name'], $asset['password'], $asset['email']);

        if ($is_header) {
            $row = array_keys($asset);
            $is_header = false;
            echo implode("\t", $row) . "\n";
        }

        echo implode("\t", $asset) . "\n";
    }
}
?>