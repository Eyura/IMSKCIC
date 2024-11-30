<?php 
session_start();
if (!isset($_SESSION['user'])) header('location: login_pages.php');
$_SESSION['table'] = 'assets';
$assets = include('asset-show.php');
include('connection.php'); // Database connection

$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
$msg_type = isset($_SESSION['msg_type']) ? $_SESSION['msg_type'] : '';
unset($_SESSION['message'], $_SESSION['msg_type']); // Clear message after display
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Assets - Inventory Management</title>
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="stylesheet" type="text/css" href="css/modal.css">
    
    <?php include('partials/app-header-scripts.php'); ?>
</head>
<body>

<div id="dashboardMainContainer">
    <?php include('partials/app-sidebar.php'); ?>

    <div class="dashboard_content_container" id="dashboard_content_container">
        <?php include('partials/app-topnav.php'); ?>

        <div class="dashboard_content">
    <div class="assetViewCont">
        <div class="section_content">
            <div class="users">
                <table>
                    <thead>
                        <tr>
                            <th colspan="12" class="table-header">
                                <h1 class="section_header"><i class="fa fa-list"></i> List of Assets</h1>
                            </th>
                            
                        </tr>
                        <tr>
                            <th>NO</th>
                            <th>Asset Name</th>
                            <th>Image</th>
                            <th>Asset Type</th>
                            <th>Description</th>
                            <th>Stock</th>
                            <th>Barcode</th>
                            <th>Created By</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($assets as $asset) { ?>
                            <tr>
                                <td><?= $asset['id'] ?></td>
                                <td><?= $asset['asset_name'] ?></td>
                                <td><img class="productImg" src="uploads/products/<?= $asset['img'] ?>" alt=""></td>
                                <td><?= $asset['asset_type'] ?></td>
                                <td><?= $asset['description'] ?></td>
                                <td class="stock"><?= $asset['stock'] ?></td>
                                <td><img src='<?= $asset['qr_code_url'] ?>' alt="QR Code"></td>
                                <td>
                                    <?php
                                        $stmt = $conn->prepare("SELECT first_name, last_name FROM users WHERE id = ?");
                                        $stmt->execute([$asset['created_by']]);
                                        $creator = $stmt->fetch(PDO::FETCH_ASSOC);
                                        echo $creator ? $creator['first_name'] . ' ' . $creator['last_name'] : 'Unknown';
                                    ?>
                                </td>
                                <td><?= date('M d, Y', strtotime($asset['created_at'])) ?></td>
                                <td><?= date('M d, Y H:i:s', strtotime($asset['updated_at'])) ?></td>
                                <td>
                                    <button type="button" class="edit-button" onclick="openEditModal(<?= htmlspecialchars(json_encode($asset)) ?>)">
                                        <i class="fa fa-edit"></i> Edit
                                    </button>
                                </td>
                                <td>
                                    <form action="asset-delete.php" method="POST" onsubmit="return confirm('Are you sure to delete <?= $asset['asset_name'] ?>?');">
                                        <input type="hidden" name="asset_id" value="<?= $asset['id'] ?>">
                                        <button type="submit" class="delete-button"><i class="fa fa-trash"></i> Delete</button>
                                    </form>
                                </td>
                                
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <p class="userCount"><?= count($assets) ?> assets</p>
            </div>
        </div>
    </div>
</div>
    </div>
</div>

<!-- Edit Asset Modal -->
<div id="editAssetModal" class="modal-overlay">
    <div class="modal-content appForm">
        <span id="closeModalButton" class="close-button">&times;</span>
        <h1>Edit Asset</h1>
        <form id="editAssetForm" action="asset-edit.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="asset_id" id="editAssetId">

            <div>
                <label for="editAssetName">Asset Name</label>
                <input type="text" id="editAssetName" name="asset_name" required class="appFormInput"/>
            </div>

            <div>
                <label for="editAssetType">Asset Type</label>
                <select id="editAssetType" name="asset_type" required class="appFormInput">
                    <option value="">Select Asset Type</option>
                    <option value="fast moving">Fast Moving</option>
                    <option value="slow moving">Slow Moving</option>
                </select>
            </div>

            <div>
                <label for="quantity_add">Quantity to Add</label>
                <input type="number" class="appFormInput" id="quantity_add" name="quantity_add" value="0" />
            </div>

            <div>
                <label for="quantity_rmv">Remove Quantity</label>
                <input type="number" class="appFormInput" id="quantity_rmv" name="quantity_rmv" value="0"/>
            </div>

            <div>
                <label for="editAssetDescription">Description</label>
                <textarea id="editAssetDescription" name="description" required class="appFormInput"></textarea>
            </div>

            <div>
                <label for="editAssetImage">Current Image</label>
                <p><img id="editAssetImage" src="" width="100"></p>
                <input type="file" id="img" name="img" class="appFormInput"/>
            </div>

            <div class="button-container">
                <button type="submit" name="update_asset"><i class="fa fa-save"></i> Save Changes</button>
            </div>
        </form>
    </div>
</div>


<script>
    // Open and populate Edit Modal
    function openEditModal(asset) {
        document.getElementById('editAssetId').value = asset.id;
        document.getElementById('editAssetName').value = asset.asset_name;
        document.getElementById('editAssetType').value = asset.asset_type;
        document.getElementById('editAssetDescription').value = asset.description;
        document.getElementById('editAssetImage').src = 'uploads/products/' + asset.img;

        document.getElementById('editAssetModal').style.display = 'flex';
    }

    // Close Edit Modal
    document.getElementById('closeModalButton').onclick = function() {
        document.getElementById('editAssetModal').style.display = 'none';
    };
    window.onclick = function(event) {
        if (event.target == document.getElementById('editAssetModal')) {
            document.getElementById('editAssetModal').style.display = 'none';
        }
    };
</script>

<?php include('partials/app-scripts.php'); ?>

</body>
</html>
