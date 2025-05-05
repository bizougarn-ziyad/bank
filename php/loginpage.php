<?php 
    session_start();
    if(isset($_SESSION["login"]) && $_SESSION["login"]=="true"){
        header("Location: dashboard.php");
        exit();
    }
    $_SESSION["login"]="false";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/stylelogin.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Login</title>
</head>
<body>
    <form action="checkuser.php" method="post" id="login-form">
        <img id="icon-banque" src="..\imgs\icon-protection.png" alt="">
        <h1 id="login-title">Customer Login</h1>
        <p id="login-subtitle">Secure access to your bank account</p>
        <?php if (isset($_GET['error'])) { ?>
            <p style="color: red;"><?php echo $_GET['error']; ?></p>
        <?php } ?>
        
        <div class="form-group">
            <input type="text" name="username" id="username" placeholder="Username" autocomplete="off">
        </div>

        <div class="form-group">
            <input type="password" name="password" id="password" placeholder="Password">
        </div>

        <div class="sign-up">
            <p id="sign-up-message">Don't have an account? &nbsp;<a href="signuppage.php">Sign up</a></p>
        </div>

        <input type="submit" id="submit-button" value="Login">
    </form>
</body>
</html>