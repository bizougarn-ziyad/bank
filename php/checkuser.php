<?php
    include 'dbh.php';
    include 'User.php';
    session_start();

    $loginUsername = $_POST['username'];
    $loginPassword = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $loginUsername]);

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch();
        if(password_verify($loginPassword, $row['pwd'])){
            $user = new User($row['username'], $row['nom'], $row['prenom'], $row['pwd'], $row['solde'], $row['image'], $row['account_number']);
            $_SESSION['user'] = $user;
            $_SESSION["login"]="true";
            header("Location: dashboard.php");
            exit();
        } 
        else {
        $error= "Invalid username or password";
        header("Location: loginpage.php?error=$error");
        }   
    }

    $pdo = null;
?>