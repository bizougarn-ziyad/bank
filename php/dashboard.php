<?php 
    require 'User.php';
    session_start();
    $user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..\styles\styledash.css">
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome, <?= $user->getUsername() ?>!</h1>
    <?php if (isset($_GET['error'])) { ?>
        <p style="color: red;"><?php echo $_GET['error']; ?></p>
    <?php } ?>
    <?php if (isset($_GET['success'])) { ?>
        <p style="color: green;"><?php echo $_GET['success']; ?></p>
    <?php } ?>
    <div class="data">
        <h2>Votre solde : <span><?= $user->getSolde() ?> $</span></h2>
        <button class="retrait" onclick="location.href='retrait.php'">Faire un retrait</button>
        <button class="virement" onclick="location.href='virement.php'">faire un virement</button>
        <button class="deconnexion" onclick="location.href='deconnexion.php'">Deconnexion</button>
    </div>
</body>
</html>