<?php
    require 'User.php';
    session_start();
    $user = $_SESSION['user'];


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $amount = $_POST["amount"];
        if ($amount > 0 && $amount <= $user->getSolde()) {
            $valid="Retrait effectuer";
            $user->setSolde($user->getSolde() - $amount);
            header("Location: dashboard.php?success=$valid");
            exit();
        } else {
            $error="Solde insuffisant";
            header("Location: dashboard.php?error=$error");
            exit();
        }
    }
?>