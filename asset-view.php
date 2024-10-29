<?php 
session_start();
if(!isset($_SESSION['user'])) header('location: login_pages.php');
$_SESSION['table'] = 'assets';
$assets = include('asset-show.php');

$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
$msg_type = isset($_SESSION['msg_type']) ? $_SESSION['msg_type'] : '';

// Hapus pesan setelah ditampilkan
unset($_SESSION['message']);
unset($_SESSION['msg_type']);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title> View Assets - Inventory Management</title>
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <?php include('partials/app-header-scripts.php'); ?>
</head>
<body>

    <div id="dashboardMainContainer">
        <?php include ('partials/app-sidebar.php') ?>

        <div class="dashboard_content_container" id="dashboard_content_container">
            <?php include ('partials/app-topnav.php') ?>

            <div class="dashboard_content">
                <h1 class="section_header"> <i class="fa fa-list"></i> List of Assets</h1>
                <div class="section_content">
                    <div class="users">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Asset Name</th>
                                    <th>Asset Type</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Barcode</th>
                                    <th>Created By</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($assets as $index => $asset) { ?>
                                    <tr>
                                        <td><?= $asset['id'] ?></td>
                                        <td><?= $asset['asset_name'] ?></td>
                                        <td><?= $asset['asset_type'] ?></td>
                                        <td><?= $asset['description'] ?></td>
                                        <td>
                                            <img class="productImg" src="uploads/products/<?= $asset['img'] ?>" alt="">
                                        </td>
                                        <td>
                                        <img src='$qr_code_url'/>
                                        </td>

                                        <td>
                                            <?php
                                                $pid = $asset['created_by'];
                                                $stmt = $conn->prepare("SELECT * FROM users WHERE id = $pid");
                                                $stmt->execute();
                                                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                                $created_by_name = $row['first_name'] . ' ' . $row['last_name'];
                                                echo $created_by_name;
                                            ?>
                                        </td>
                                        <td><?= date('M d, Y', strtotime($asset['created_at'])) ?></td>
                                        <td><?= date('M d, Y', strtotime($asset['updated_at'])) ?></td>
                                        <td>
                                            <form action="asset-edit.php" method="POST" onsubmit="return confirm('Are you sure to edit ' + '<?= $asset['asset_name'] ?> ?');">
                                                <input type="hidden" name="asset_id" value="<?= $asset['id'] ?>">
                                                <button type="submit" class="edit-button"><i class="fa fa-edit"></i> Edit</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form id="deleteForm" action="asset-delete.php" method="POST" onsubmit="return confirm('Are you sure to delete ' + '<?= $asset['asset_name'] ?> ?');">
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

    <div id="popupOverlay" class="popup-overlay">
        <div id="popupContent" class="popup-content">
            <p id="popupMessage"></p>
            <span id="popupClose" class="popup-close">Close</span>
        </div>
    </div>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        var message = "<?= $message ?>";
        var msgType = "<?= $msg_type ?>";

        if (message) {
            var popupOverlay = document.getElementById("popupOverlay");
            var popupContent = document.getElementById("popupContent");
            var popupMessage = document.getElementById("popupMessage");
            var popupClose = document.getElementById("popupClose");

            popupMessage.textContent = (msgType === 'success' ? 'Success: ' : 'Error: ') + message;
            popupContent.classList.add(msgType); // Add success/error class for styling
            popupOverlay.style.display = "flex"; // Show popup

            // Close popup on click
            popupClose.onclick = function() {
                popupOverlay.style.display = "none";
            };
            // Optional: Auto-close popup after 3 seconds
            setTimeout(function() {
                popupOverlay.style.display = "none";
            }, 3000);
        }
    });
</script>


    <!-- <script src="js/script.js?v=?= time(); ?>"> </script>
    <script src="js/jquery.min.js></script> -->
    <?php include('partials/app-scripts.php'); ?>


<!-- <script>
    function script() {
    this.initialize = function() {
        this.registerEvents();
    },

    this.registerEvents = function() {
        document.addEventListener('click', function(e) {
            targetElement = e.target;
            classList = targetElement.classList;

            if(classList.contains('updateUser')){
                e.preventDefault();
            }
        });
    }
}
</script> -->



    <!-- POP UP NOTIF -->
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        var message = "<?= $message ?>";
        var msgType = "<?= $msg_type ?>";

        if (message) {
            alert((msgType === 'success' ? '' : 'Error: ') + message);
        }
    });
    </script>

    
 </body>
 </html>