<?php
session_start();
if (!isset($_SESSION['user'])) header('location: login_pages.php');

// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'inventory');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Cek apakah semua field diisi
    if (empty($first_name) || empty($last_name) || empty($email) || empty($password)) {
        $_SESSION['message'] = "All fields are required!";
        $_SESSION['msg_type'] = "error";
    } else {
        // Cek apakah email sudah ada
        $email_check_sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($email_check_sql);

        if ($result->num_rows > 0) {
            $_SESSION['message'] = "Email is already in use!";
            $_SESSION['msg_type'] = "error";
        } else {
            // Anda mungkin perlu mengenkripsi password di sini
            $sql = "INSERT INTO users (first_name, last_name, email, password,         created_at, updated_at) 
                    VALUES ('$first_name', '$last_name', '$email', '$password', NOW(), NOW())";
            
            if ($conn->query($sql) === TRUE) {
                $_SESSION['message'] = "User added successfully!";
                $_SESSION['msg_type'] = "success"; // Untuk memberi tahu jenis pesan
            } else {
                $_SESSION['message'] = "Error: " . $conn->error;
                $_SESSION['msg_type'] = "error";
            }
        }
    }

    $conn->close();
    header('location: users-add.php'); // Ganti dengan halaman yang sesuai
    exit();
}
?>
