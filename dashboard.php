<?php 
session_start();
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


 </head>
 <body>
    
    <div id="dashboardMainContainer">
    <div class="dashboard_sidebar" id="dashboard_sidebar">
        <h3 class="dashboard_logo" id="dashboard_logo">IMS</h3>
        <div class="dashboard_sidebar_user">
            <img src="assets/user-regular.svg" alt="user image" id="userImage">
            <span class="dashboard_name"><?= $user['first_name'] . ' ' .  $user['last_name'] ?></span>

        </div>
        <div class="dashboard_sidebar_menus">
            <ul class="dashboard_menu_lists">
                <li class="menuActive" >
                    <a href=" " > <i class="fa fa-dashboard"></i> <span class="menuText"> Dashboard </span> </a>
                </li>
                <li>
                    <a href=" "> <i class="fa fa-dashboard"></i> <span class="menuText"> Reports </span>  </a>
                </li>
                <li>
                    <a href=" "> <i class="fa fa-dashboard"></i> <span class="menuText"> Products </span>  </a>
                </li>
                <li>
                    <a href=" "> <i class="fa fa-dashboard"></i> <span class="menuText"> Supplier </span>  </a>
                </li>
                <li>
                    <a href=" "> <i class="fa fa-dashboard"></i> <span class="menuText"> Order </span>  </a>
                </li>
                <li>
                    <a href=" "> <i class="fa fa-dashboard"></i><span class="menuText"> User </span>  </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="dashboard_content_container" id="dashboard_content_container">
        <div class="dashboard_topNav">
            <a href=" " id="toggleBtn"> <i class="fa fa-navicon"></i> </a>
            <a href=" " id="logoutBtn"> <i class="fa fa-power-off"></i> Logout </a>
        </div>

        <div class="dashboard_content">
            <div class="dashboard_content_main">

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