<?php
require 'User.php';
session_start();
$user = $_SESSION['user'];


$usernamedest = $_POST['username'];

$myFile = fopen("..\client.csv", "r");
while (($data = fgetcsv($myFile, 0, ',', '"', '\\')) !== FALSE) {
    if($data[0] == $usernamedest){
        $userDes = new User($data[0], $data[1], $data[2], $data[3], $data[4]);
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $amount = $_POST["amount"];
            if ($amount > 0 && $amount <= $user->getSolde()) {
                $user->setSolde($user->getSolde() - $amount);
                $userDes->setSolde($userDes->getSolde() + $amount);
                $success="Virement effectuer";
                header("Location: dashboard.php?success=$success");
                exit();
            } else {
                $error="Solde insuffisant";
                header("Location: dashboard.php?error=$error");
                exit();
            }
        }
    }
}
fclose($myFile);