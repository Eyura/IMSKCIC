<?php
session_start();
include('connection.php');  // Database connection

// Check if asset ID is provided
if (isset($_POST['asset_id'])) {
    $asset_id = $_POST['asset_id'];
    
    // Fetch asset data
    $stmt = $conn->prepare("SELECT * FROM assets WHERE id = ?");
    $stmt->execute([$asset_id]);
    $asset = $stmt->fetch(PDO::FETCH_ASSOC);

    // If asset doesn't exist, redirect
    if (!$asset) {
        $_SESSION['message'] = "Asset not found!";
        $_SESSION['msg_type'] = "error";
        header("location: asset-view.php");
        exit;
    }
} else {
    // Redirect if no asset ID provided
    header("location: asset-view.php");
    exit;
}

// Handle form submission to update asset
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_asset'])) {
    $asset_name = $_POST['asset_name'];
    $asset_type = $_POST['asset_type'];
    $description = $_POST['description'];
    
    // Handle image upload
    if (!empty($_FILES['img']['name'])) {
        $img_name = time() . '_' . $_FILES['img']['name'];
        move_uploaded_file($_FILES['img']['tmp_name'], 'uploads/products/' . $img_name);
        $query = "UPDATE assets SET asset_name = ?, asset_type = ?, description = ?, img = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$asset_name, $asset_type, $description, $img_name, $asset_id]);
    } else {
        $query = "UPDATE assets SET asset_name = ?, asset_type = ?, description = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$asset_name, $asset_type, $description, $asset_id]);
    }

    $_SESSION['message'] = "Asset updated successfully!";
    $_SESSION['msg_type'] = "success";
    header('location: asset-view.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Asset - Inventory Management</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

<div id="editAssetContainer">
    <h1>Edit Asset</h1>
    <form action="asset-edit.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="asset_id" value="<?= $asset['id'] ?>">
        
        <label for="asset_name">Asset Name:</label>
        <input type="text" name="asset_name" value="<?= $asset['asset_name'] ?>" required>
        
        <label for="asset_type">Asset Type:</label>
        <input type="text" name="asset_type" value="<?= $asset['asset_type'] ?>" required>
        
        <label for="description">Description:</label>
        <textarea name="description" required><?= $asset['description'] ?></textarea>
        
        <label for="img">Image:</label>
        <input type="file" name="img">
        <p>Current Image: <img src="uploads/products/<?= $asset['img'] ?>" width="100"></p>
        
        <button type="submit" name="update_asset">Save Changes</button>
    </form>
</div>

</body>
</html>
