<?php
    session_start();
    include 'User.php';

if (!empty($_POST)){
    $loginUsername = $_POST['username'];
    $loginPassword = $_POST['password'];

    $myFile = fopen("..\client.csv", "r");
    $error="Username or password is incorrect";
    while (($data = fgetcsv($myFile, 0, ',', '"', '\\')) !== FALSE) {

        if($data[0] == $loginUsername && $data[3] == $loginPassword){
          
            $user = new User($data[0], $data[1], $data[2], $data[3], $data[4]);
            $_SESSION['user'] = $user;
            header("Location: dashboard.php");
            exit();
        }
    }
    fclose($myFile);
    header("Location: loginpage.php?error=$error");
    exit();
}