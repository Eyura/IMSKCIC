<?php 
session_start();
if(!isset($_SESSION['user'])) header('location: login_pages.php');
$_SESSION['table'] = 'users';
$_SESSION['redirect_to'] = 'users-add.php';
$user = $_SESSION['user'];
$users = include('show-users.php');
?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
    <title> Add Users - Inventory Management</title>
    <?php include('partials/app-header-scripts.php'); ?>

 </head>
 <body>
    
    <div id="dashboardMainContainer">
        <?php include ('partials/app-sidebar.php') ?>

        <div class="dashboard_content_container" id="dashboard_content_container">
            <?php include ('partials/app-topnav.php') ?>

            <div class="dashboard_content">
            <div class="addContainer">
                <div class="userAddFormContainer" id="userAddFormContainer">
                    <h1 class="section_header"><i class="fa fa-plus"></i> Add Asset</h1>
                    <form action="add.php" method="POST" class="appForm">
                        <div>
                            <label for="first_name">First Name</label>
                            <input type="text" id="first_name" name="first_name" required class="appFormInput"/>
                        </div>
                        <div>
                            <label for="last_name">Last Name</label>
                            <input type="text" id="last_name" name="last_name" required class="appFormInput"/>
                        </div>
                        <div>
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" required class="appFormInput"/>
                        </div>
                        <div>
                            <label for="password">Password</label>
                            <input type="text" id="password" name="password" required class="appFormInput"/>
                        </div>
                        <input type="hidden" name="table" value="users"/>
                        <div class="button-container">
                            <button type="submit"><i class="fa fa-plus"></i> Add User</button>
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