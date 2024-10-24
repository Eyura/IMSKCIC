<div class="dashboard_sidebar" id="dashboard_sidebar">
    <h3 class="dashboard_logo" id="dashboard_logo">IMS</h3>
    <div class="dashboard_sidebar_user">
        <img src="assets/user-regular.svg" alt="user image" id="userImage">
        <span class="dashboard_name"><?= $user['first_name'] . ' ' .  $user['last_name'] ?></span>

    </div>
    <div class="dashboard_sidebar_menus">
        <ul class="dashboard_menu_lists">

            <!-- class="menuActive"  -->
            <li class="liMainMenu">
                <a href="./dashboard.php" > <i class="fa fa-dashboard"></i> <span class="menuText"> Dashboard </span> </a>
            </li>
            <li class="liMainMenu">
                <a href="./Report.php"> <i class="fa fa-dashboard"></i> <span class="menuText"> Report </span>  </a>
            </li>
            <li class="liMainMenu">
                <a href=""> <i class="fa fa-dashboard"></i> <span class="menuText"> Assets Management </span>  </a>
            </li>
            <li class="liMainMenu showHideSubMenu">
                <a href="javascript:void(0);" class="showHideSubMenu" onclick="toggleSubMenu(this)">
                    <i class="fa fa-user-plus showHideSubMenu"></i>
                    <span class="menuText showHideSubMenu">User Management</span>
                    <i class="fa fa-angle-left iconArrow showHideSubMenu"></i>
                </a>
                <ul class="subMenus">
                    <li class="subMenuContainer">
                        <a class="subMenuLink" href="#"><i class="fa fa-circle-o"></i>View Users</a>
                    </li>
                    <li class="subMenuContainer">
                        <a class="subMenuLink" href="./users-add.php"><i class="fa fa-circle-o"></i>Add User</a>
                    </li>
                </ul>
            </li>
        
        </ul>
    </div>
</div>


