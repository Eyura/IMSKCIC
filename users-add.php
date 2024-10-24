<?php 
session_start();
if(!isset($_SESSION['user'])) header('location: login_pages.php');
$_SESSION['table'] = 'users';
$user = $_SESSION['user'];
$users = include('show-users.php');
?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Dashboard - Inventory Management</title>
	<link rel="stylesheet" type="text/css" href="css/login.css?v=?= time(); ?>">
    <script src="https://use.fontawesome.com/0c7a3095b5.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css"> -->

 </head>
 <body>
    
    <div id="dashboardMainContainer">
        <?php include ('partials/app-sidebar.php') ?>

        <div class="dashboard_content_container" id="dashboard_content_container">
            <?php include ('partials/app-topnav.php') ?>

            <div class="dashboard_content">
                <div class="row">
                    <div class="column column-5">
                        <h1 class="section_header"> <i class="fa fa-plus"></i> Create User</h1>
                    <div id="userAddFormContainer">

                    </div>
                    <div class="dashboard_content_main">
                    <form action="user-add.php" method="POST" class="appForm">
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
                    <div class="column column-7">
                        <h1 class="section_header"> <i class="fa fa-list"></i> List of Users</h1>
                    <div class="section_content">
                        <div class="users">
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Created At</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($users as $index => $user){ ?>
                                        <tr>
                                            <td><?= $user['id'] ?></td>
                                            <td><?= $user['first_name'] ?></td>
                                            <td><?= $user['last_name'] ?></td>
                                            <td><?= $user['email'] ?></td>
                                            <td><?= date('M d, Y', strtotime($user['created_at'])) ?></td>
                                            <td>
                    
                                                <form id="deleteForm" action="delete-user.php" method="POST" onsubmit="return confirm('Are you sure to delete' + ' <?php echo $user['first_name']; ?> <?php echo $user['last_name']; ?> ?');">

                                                    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                                    <button type="submit" class="delete-button">  <i class= "fa fa-trash"> </i> Delete</button>
                                                </form>

                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <p class="userCount"><?= count($users) ?> users</p>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/script.js?v=?= time(); ?>"> </script>
    <script src="js/jquery.min.js></script>
    
 </body>
 </html>