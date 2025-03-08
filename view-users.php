<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('location: login_pages.php');
}
$_SESSION['table'] = 'users';
$user = $_SESSION['user'];
$users = include('show-users.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title> View Users - Inventory Management</title>
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="stylesheet" type="text/css" href="css/modal.css">
    <?php include('partials/app-header-scripts.php'); ?>
</head>

<body>

    <div id="dashboardMainContainer">
        <?php include('partials/app-sidebar.php') ?>

        <div class="dashboard_content_container" id="dashboard_content_container">
            <?php include('partials/app-topnav.php') ?>

            <div class="dashboard_content">
                <div class="assetViewCont">
                    <div class="section_content">
                        <div class="users">
                            <table>
                                <thead>
                                    <tr>
                                        <th colspan="12" class="table-header">
                                            <h1 class="section_header"><i class="fa fa-list"></i> List of Users</h1>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Created At</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $index => $user) { ?>
                                        <tr>
                                            <td><?= $user['id'] ?></td>
                                            <td><?= $user['first_name'] ?></td>
                                            <td><?= $user['last_name'] ?></td>
                                            <td><?= $user['email'] ?></td>
                                            <td><?= $user['role'] ?></td>
                                            <td><?= date('M d, Y', strtotime($user['created_at'])) ?></td>
                                            <td>
                                                <button type="button" class="edit-button"
                                                    onclick="openEditModal(<?= htmlspecialchars(json_encode($user)) ?>)">
                                                    <i class="fa fa-edit"></i> Edit
                                                </button>
                                            </td>
                                            <td>
                                                <form id="deleteForm" action="delete-user.php" method="POST"
                                                    onsubmit="return confirm('Are you sure to delete' + ' <?php echo $user['first_name']; ?> <?php echo $user['last_name']; ?> ?');">
                                                    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                                    <button type="submit" class="delete-button">
                                                        <i class="fa fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <p class="userCount"><?= count($users) ?> users</p>

                            <?php
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

    <!-- Edit User Modal -->
    <div id="editUserModal" class="modal-overlay">
        <div class="modal-content appForm">
            <span id="closeModalButton" class="close-button">&times;</span>
            <h1>Edit User</h1>
            <form id="editUserForm" method="POST" action="users-update.php">
                <input type="hidden" name="user_id" id="user_id">

                <div>
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" id="first_name" required class="appFormInput" />
                </div>

                <div>
                    <label for="last_name">Last Name</label>
                    <input type="text" name="last_name" id="last_name" required class="appFormInput" />
                </div>

                <div>
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required class="appFormInput" />
                </div>

                <div>
                    <label for="role">Role</label>
                    <select name="role" id="role" required class="appFormInput">
                        <option value="admin">Admin</option>
                        <option value="staff">Staff</option>
                        <option value="user">User</option>
                    </select>
                </div>

                <div class="button-container">
                    <button type="submit" name="update_user"><i class="fa fa-save"></i> Save Changes</button>
                </div>
            </form>
        </div>
    </div>



    <script>
        // Function to open and populate the Edit User modal
        function openEditModal(userData) {
            document.getElementById('user_id').value = userData.id;
            document.getElementById('first_name').value = userData.first_name;
            document.getElementById('last_name').value = userData.last_name;
            document.getElementById('email').value = userData.email;
            document.getElementById('role').value = userData.role;

            // Show the modal
            document.getElementById('editUserModal').style.display = 'flex';
        }

        // Close the modal when clicking the close button or outside the modal
        document.getElementById('closeModalButton').onclick = function () {
            document.getElementById('editUserModal').style.display = 'none';
        };

        window.onclick = function (event) {
            if (event.target == document.getElementById('editUserModal')) {
                document.getElementById('editUserModal').style.display = 'none';
            }
        }

    </script>

    <?php include('partials/app-scripts.php'); ?>

</body>

</html>