<!-- asset-save-co.php -->
<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('location: login_pages.php');
    exit();
}

include('connection.php'); // Include your database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $asset_ids = $_POST['asset_id'];
    $asset_names = $_POST['asset_name'];
    $quantities = $_POST['quantity'];
    
    // Sample values for additional columns (replace with actual values as needed)
    $checkout_by = $_SESSION['user']; // Assuming user data is stored in session
    $checkout_at = date('Y-m-d H:i:s'); // Current timestamp

    // Prepare the SQL statement for the `checkout` table
    $stmt = $conn->prepare("
        INSERT INTO checkout (asset_name, quantity_received, quantity_ordered, quantity_remaining, checkout_by, checkout_at) 
        VALUES (:asset_name, :quantity_received, :quantity_ordered, :quantity_remaining, :checkout_by, :checkout_at)
    ");

    // Iterate over each asset in the form submission
    for ($i = 0; $i < count($asset_ids); $i++) {
        $asset_name = $asset_names[$i];
        $quantity_ordered = $quantities[$i];
        $quantity_received = $quantity_ordered; 
        $quantity_remaining = $quantity_received;

        // Execute the SQL statement for each asset
        $stmt->execute([
            ':asset_name' => $asset_name,
            ':quantity_received' => $quantity_received,
            ':quantity_ordered' => $quantity_ordered,
            ':quantity_remaining' => $quantity_remaining,
            ':checkout_by' => $checkout_by,
            ':checkout_at' => $checkout_at
        ]);
    }

    $conn = null; // Close the connection

    // Redirect after successful submission
    header('location: asset-checkout.php?status=success');
    exit();
} else {
    // Redirect back to checkout page if not a POST request
    header('location: asset-checkout.php');
    exit();
}
