<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..\styles\style.css">
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
            <input type="text" name="username" id="username" placeholder="Username">
        </div>

        <div class="form-group">
            <input type="password" name="password" id="password" placeholder="Password">
        </div>

        <input type="submit" id="submit-button" value="Login">
    </form>
</body>
</html>