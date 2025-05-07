<?php
require_once 'dbh.php';

function getUserTransactions($account_number) {
    global $pdo;
    $query = "SELECT * FROM usersoperations WHERE user_number = :account_number ORDER BY operation_date DESC";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':account_number' , $account_number);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>