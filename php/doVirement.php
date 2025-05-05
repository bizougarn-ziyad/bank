<?php
require 'User.php';
require 'operation.php';
require 'dbh.php';
session_start();
$user = $_SESSION['user'];

function checkUsernameExists($pdo, $usernamedest) {
    $query = "SELECT * FROM users WHERE username = :username";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['username' => $usernamedest]);
    return $stmt->fetchColumn() > 0;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $amount = $_POST["amount"];
    $usernamedest = $_POST['username'];
    if (!checkUsernameExists($pdo, $usernamedest)) {
        $error="Username does not exist";
        header("Location: dashboard.php?error=$error");
        exit();
    }
    if ($amount > 0 && $amount <= $user->getSolde() && $amount <= 1000) {
        $valid="Retrait effectuer";
        $query = "UPDATE users SET solde = solde - :amount WHERE username = :username";
        $stmt = $pdo->prepare($query);
        $username = $user->getUsername();
        $stmt->bindParam(":amount", $amount);
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        $user->setSolde($user->getSolde() - $amount);


        $query = "UPDATE users SET solde = solde + :amount WHERE username = :username";
        $stmt = $pdo->prepare($query);
        $username = $user->getUsername();
        $stmt->bindParam(":amount", $amount);
        $stmt->bindParam(":username", $usernamedest);
        $stmt->execute();

        $montant = $amount;
        $type="Virement";
        $account_number = $user->getAccountNumber();
        $newquery="INSERT INTO usersoperations (operation_type, user_number, operation_amount,dest_username) VALUES(:type, :account_number, :montant,:usernamedest)";
        $newstmt = $pdo->prepare($newquery);
        $newstmt->bindParam(":type", $type);
        $newstmt->bindParam(":account_number", $account_number);
        $newstmt->bindParam(":montant", $montant);
        $newstmt->bindParam(":usernamedest", $usernamedest);
        $newstmt->execute();
        header("Location: dashboard.php?success=$valid");
        exit();
    } else {
        $error="Solde insuffisant";
        header("Location: dashboard.php?error=$error");
        exit();
    }
}


fclose($myFile);