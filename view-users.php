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
    <title> View Users - Inventory Management</title>
    <?php include('partials/app-header-scripts.php'); ?>
 </head>
 <body>
    
    <div id="dashboardMainContainer">
        <?php include ('partials/app-sidebar.php') ?>

        <div class="dashboard_content_container" id="dashboard_content_container">
            <?php include ('partials/app-topnav.php') ?>

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

    <!-- <script src="js/script.js?v=?= time(); ?>"> </script>
    <script src="js/jquery.min.js></script> -->
    <?php include('partials/app-scripts.php'); ?>

    
 </body>
 </html>