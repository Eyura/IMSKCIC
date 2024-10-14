<?php 
session_start();
if(!isset($_SESSION['user'])) header('location: login_pages.php');

$user = $_SESSION['user'];
?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Dashboard - Inventory Management</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
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
                <div class="dashboard_content_main">
                    <form action="" class="appForm">
                        <div>
                            <label for="first_name">First Name</label>
                            <input type="text" id="first_name" name="first_name" class="appFormInput"/>
                        </div>
                        <div>
                            <label for="last_name">Last Name</label>
                            <input type="text" id="last_name" name="last_name" class="appFormInput"/>
                        </div>
                        <div>
                            <label for="email">Email</label>
                            <input type="text" id="email" name="email" class="appFormInput"/>
                        </div>
                        <div>
                            <label for="password">Password</label>
                            <input type="text" id="password" name="password" class="appFormInput"/>
                        </div>
                        <div class="button-container">
                            <button type="submit"><i class="fa fa-plus"></i> Add User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        var sideBarIsOpen = true;


        toggleBtn.addEventListener( 'click', (event) => {
            event.preventDefault();


            if(sideBarIsOpen){
            dashboard_sidebar.style.transition = '0.9s all';
            dashboard_sidebar.style.width = '10%';
            dashboard_content_container.style.width = '90%';
            dashboard_logo.style.fontSize= '50px';
            userImage.style.width = '45px';

            menuIcons = document.getElementsByClassName('menuText');
            for(var i=0; i < menuIcons.length;i++){
                menuIcons[i].style.display = 'none';
            }

            document.getElementsByClassName('dashboard_menu_lists') [0].style.textAlign = 'center';
            sideBarIsOpen = false;
            }   else{
                dashboard_sidebar.style.width = '20%';
                dashboard_content_container.style.width = '80%';
                dashboard_logo.style.fontSize= '80px';
                userImage.style.width = '60px';

                menuIcons = document.getElementsByClassName('menuText');
                for(var i=0; i < menuIcons.length;i++){
                menuIcons[i].style.display = 'inline';
                }

                document.getElementsByClassName('dashboard_menu_lists') [0].style.textAlign = 'left';
                sideBarIsOpen = true;
                }   
                
        } );
    </script>
 </body>
 </html>