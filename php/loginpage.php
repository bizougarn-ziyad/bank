<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..\styles\style.css">
    <title>Login</title>
</head>
<body>
    <form action="checkuser.php" method="post">
        <h1>Login</h1>
        <?php if (isset($_GET['error'])) { ?>
            <p style="color: red;"><?php echo $_GET['error']; ?></p>
        <?php } ?>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" ><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" ><br>

        <input type="submit" id="submit-button" value="Login">
    </form>
    
</body>
</html>