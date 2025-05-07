<?php
    require 'User.php';
    require 'dbh.php';
    session_start();
    $user = $_SESSION['user'];


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $amount = $_POST["amount"];
        if ($amount > 0 && $amount <= $user->getSolde() && $amount <= 1000) {
            $valid="Retrait effectuer";
            $query = "UPDATE users SET solde = solde - :amount WHERE username = :username";
            $stmt = $pdo->prepare($query);
            $username = $user->getUsername();
            $stmt->bindParam(":amount", $amount);
            $stmt->bindParam(":username", $username);
            $stmt->execute();
            $user->setSolde($user->getSolde() - $amount);
            $type="retrait";
            $montant = $amount;
            $account_number = $user->getAccountNumber();
            $newquery="INSERT INTO usersoperations (operation_type, user_number, operation_amount) VALUES(:type, :account_number, :montant)";
            $newstmt = $pdo->prepare($newquery);
            $newstmt->bindParam(":type", $type);
            $newstmt->bindParam(":account_number", $account_number);
            $newstmt->bindParam(":montant", $montant);
            $newstmt->execute();
            header("Location: dashboard.php?success=$valid");
            exit();
        } else {
            $error="Solde insuffisant";
            header("Location: dashboard.php?error=$error");
            exit();
        }
    }
?>