<?php 

session_start();
// if(!isset($_SESSION['user'])) header('location: dashboard.php'); 


$error_message ='';
if($_POST){
    include('connection.php');
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = 'SELECT * FROM users WHERE users.email="' . $username . '" AND users.password="' . $password . '"';

    $stmt = $conn->prepare($query);
    $stmt->execute();

    if($stmt->rowCount() > 0){
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $user = $stmt->fetchAll()[0];
        $_SESSION['user'] = $user;
        
        header('Location: dashboard.php');
    } else $error_message = 'Please make sure that username and password are correct';
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/ims.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
</head>

<body id='loginBody'>
    
    <div class="wrapper">
        <div class="container">
            <div class="left-section">
                <img src="assets/bg1.jpeg" alt="Building Image">
            </div>
            <div class="right-section">
                <div class="login-box">
                    <h2>Inventory Management System <span class="brand"> KCIC</span></h2>

                    <form action="login_pages.php" method="POST">
                        <div class="input-box">
                            
                            <input type="text" name="username" placeholder="Username">
                        </div>

                        <div class="input-box">
                            <input type="password" name="password" placeholder="Password">
                        </div>

                    

                        <div class="buttons">
                            <button type="submit" class="btn-login">Login</button>

                        </div>

                    <?php
                        if(!empty($error_message)) { ?>
                        <div id="errorMessage">
                            <p>  Error:  <?= $error_message ?> </p>
                        </div>
                    <?php } ?>
                    </form>

                </div>
            </div>
        </div>
    </div>
</body>
</html>