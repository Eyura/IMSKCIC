<?php 
session_start();
if(!isset($_SESSION['user'])) header('location: login_pages.php');
$_SESSION['table'] = 'assets';
$_SESSION['redirect_to'] = 'asset-add.php';
$user = $_SESSION['user'];
$users = include('show-users.php');
?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
    <title> Add Assets - Inventory Management</title>
    <?php include('partials/app-header-scripts.php'); ?>

 </head>
 <body>
    
    <div id="dashboardMainContainer">
        <?php include ('partials/app-sidebar.php') ?>

        <div class="dashboard_content_container" id="dashboard_content_container">
            <?php include ('partials/app-topnav.php') ?>

            <div class="dashboard_content">
                <div class="row">
                    <div class="column column-12">
                        <h1 class="section_header"> <i class="fa fa-plus"></i> Add Asset</h1>
                    <div id="userAddFormContainer">

                    </div>
                    <div class="dashboard_content_main">
                    <form action="add.php" method="POST" class="appForm">
                        <div>
                            <label for="asset_name">Asset Name</label>
                            <input type="text" id="asset_name" name="asset_name" required class="appFormInput"/>
                        </div>
                        <div>
                            <label for="description">Description</label>
                            <textarea id="description" name="description" class="appFormInput"></textarea>
                            
                        </div>
                        <input type="hidden" name="table" value="users"/>
                        <div class="button-container">
                            <button type="submit"><i class="fa fa-plus"></i> Add Asset</button>
                        </div>
                        </form>
                        <?php
                            
                            if (!isset($_SESSION['user'])) header('location: login_pages.php');

                            $user = $_SESSION['user'];

                            // Tampilkan notifikasi jika ada
                            if (isset($_SESSION['message'])): ?>
                                <div class="responseMessage <?= $_SESSION['msg_type'] ?>">
                                    <p><?= $_SESSION['message'] ?></p>
                                    <?php 
                                    unset($_SESSION['message']); 
                                    unset($_SESSION['msg_type']); 
                                    ?>
                                </div>
                            <?php endif; ?>
                    </div>
                    </div>     
                </div>
            </div>
        </div>
    </div>

    <?php include('partials/app-scripts.php'); ?>

 </body>
 </html>