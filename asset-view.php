<?php 
session_start();
if(!isset($_SESSION['user'])) header('location: login_pages.php');
$_SESSION['table'] = 'assets';
$assets = include('asset-show.php')

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
                
                    <div class="column column-7">
                        <h1 class="section_header"> <i class="fa fa-list"></i> List of Users</h1>
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
                                        <th>Created By</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($assets as $index => $asset){ ?>
                                        <tr>
                                            <td><?= $asset['id'] ?></td>
                                            <td><?= $asset['asset_name'] ?></td>
                                            <td><?= $asset['asset_type'] ?></td>
                                            <td><?= $asset['description'] ?></td>
                                            <td>
                                            <img class="productImg" src="uploads/products/<?= $asset['img'] ?> " alt="">
                                            </td>
                                            <td><?= $asset['created_by'] ?></td>
                                            <td><?= date('M d, Y', strtotime($asset['created_at'])) ?></td>
                                            <td><?= date('M d, Y', strtotime($asset['updated_at'])) ?></td>
                                            <td>
                                            <form action="edit-asset.php" method="POST" onsubmit="return confirm('Are you sure to edit ' + '<?= $asset['asset_name'] ?> ?');">
                                                <input type="hidden" name="asset_id" value="<?= $asset['id'] ?>">
                                                <button type="submit" class="edit-button"><i class="fa fa-edit"></i> Edit</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form id="deleteForm" action="delete-asset.php" method="POST" onsubmit="return confirm('Are you sure to delete ' + '<?= $asset['asset_name'] ?> ?');">
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
    </div>

    <!-- <script src="js/script.js?v=?= time(); ?>"> </script>
    <script src="js/jquery.min.js></script> -->
    <?php include('partials/app-scripts.php'); ?>

    
 </body>
 </html>