<?php
session_start();
include('table_columns.php');
include('connection.php'); // Ensure connection to the database is included

// Redirect if the user is not authenticated
if (!isset($_SESSION['user'])) {
    header('location: login_pages.php');
    exit();
}

$table_name = $_SESSION['table'];
$columns = $table_columns_mapping[$table_name];
$db_arr = [];

// Loop through table columns to populate data
foreach ($columns as $column) {
    if (in_array($column, ['created_at'])) {
        $value = date('Y-m-d');
    } elseif ($column == 'updated_at') {
        $value = date('Y-m-d');
    } elseif ($column == 'created_by') {
        $value = $_SESSION['user']['id']; // Assuming user ID is stored in the session
    } elseif ($column == 'password') {
        $value = password_hash($_POST[$column], PASSWORD_DEFAULT);
    } elseif ($column == 'asset_type') {
        $value = isset($_POST['asset_type']) ? $_POST['asset_type'] : null;
    } elseif ($column == 'img') {
        $target_dir = "uploads/products/";
        $file_data = $_FILES[$column];

        $file_name = $file_data['name'];
        $check = getimagesize($file_data['tmp_name']);
        if ($check) {
            if (move_uploaded_file($file_data['tmp_name'], $target_dir . $file_name)) {
                $value = $file_name;
            }
        } else {
            // Handle image upload error if needed
        }
    } else {
        $value = isset($_POST[$column]) ? trim($_POST[$column]) : '';
    }

    $db_arr[$column] = $value;
}

// Required fields validation (commented out in your original code)
// $required_fields = ['first_name', 'last_name', 'email', 'password'];
// foreach ($required_fields as $field) {
//     if (empty($db_arr[$field])) {
//         $_SESSION['message'] = "All fields are required!";
//         $_SESSION['msg_type'] = "error";
//         header('location: users-add.php'); // Redirect to the form page
//         exit();
//     }
// }

// Check if email already exists (commented out in your original code)
// $email_check_sql = "SELECT * FROM users WHERE email = :email";
// $stmt = $conn->prepare($email_check_sql);
// $stmt->execute(['email' => $db_arr['email']]);
// if ($stmt->rowCount() > 0) {
//     $_SESSION['message'] = "Email is already in use!";
//     $_SESSION['msg_type'] = "error";
//     header('location: users-add.php'); // Redirect to the form page
//     exit();
// }

$table_properties = implode(", ", array_keys($db_arr));
$table_values  = ":" . implode(", :", array_keys($db_arr));

try {
    // Insert data
    $sql = "INSERT INTO $table_name ($table_properties) VALUES ($table_values)";
    $stmt = $conn->prepare($sql);
    $stmt->execute($db_arr);

    // Generate QR code data
    $qr_data = json_encode([
        'asset_name' => $db_arr['asset_name'], // Assuming 'asset_name' is one of your columns
        'description' => $db_arr['description'], // Assuming 'description' is one of your columns
        'asset_type' => $db_arr['asset_type'], // Assuming 'asset_type' is one of your columns
    ]);

    // Create QR code URL using the API
    $qr_api_url = 'https://api.qrserver.com/v1/create-qr-code/';
    $qr_code_url = $qr_api_url . '?' . http_build_query([
        'data' => $qr_data,
        'size' => '100x100 ',
        'format' => 'png'
    ]);

    // Store QR code URL in session message for display after redirect
    $_SESSION['message'] = "Successfully added to system! ";
    // QR Code: <img src='$qr_code_url' alt='QR Code' />
    $_SESSION['msg_type'] = "success";

} catch (PDOException $e) {
    $_SESSION['message'] = "Error: " . $e->getMessage();
    $_SESSION['msg_type'] = "error";
}

header('location: ' . $_SESSION['redirect_to']); // Redirect to the specified page
exit();
?>
