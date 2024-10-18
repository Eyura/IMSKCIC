<div class="dashboard_sidebar" id="dashboard_sidebar">
        <h3 class="dashboard_logo" id="dashboard_logo">IMS</h3>
        <div class="dashboard_sidebar_user">
            <img src="assets/user-regular.svg" alt="user image" id="userImage">
            <span class="dashboard_name"><?= $user['first_name'] . ' ' .  $user['last_name'] ?></span>

        </div>
        <div class="dashboard_sidebar_menus">
            <ul class="dashboard_menu_lists">

                <!-- class="menuActive"  -->
                <li>
                    <a href="./dashboard.php" > <i class="fa fa-dashboard"></i> <span class="menuText"> Dashboard </span> </a>
                </li>
                <li>
                    <a href="./users-add.php"> <i class="fa fa-dashboard"></i> <span class="menuText"> Add User </span>  </a>
                </li>
                <li>
                    <a href="./add-asset.php"> <i class="fa fa-dashboard"></i> <span class="menuText"> Add asset </span>  </a>
                </li>
                <li>
                    <a href="./Report.php"> <i class="fa fa-dashboard"></i> <span class="menuText"> Report </span>  </a>
                </li>
                
            </ul>
        </div>
    </div>