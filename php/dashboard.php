<?php 
    require 'User.php';
    require 'operation.php';
    include_once 'dbh.php';
    session_start();
    if(!isset($_SESSION["login"]) || $_SESSION["login"]=="false"){
        header("Location: loginpage.php");
        exit();
    }
    $user = $_SESSION['user'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..\styles\styledash.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Dashboard</title>
</head>
<body>
    <img src="<?php  
        $query = "SELECT image FROM users WHERE username = :username";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['username' => $user->getUsername()]);
        $image_path = $stmt->fetchColumn();
        echo $image_path;
    ?>" alt="Profile picture" id="profilepicture">
        <h1>Welcome, <?= $user->getUsername() ?>!</h1>
    
    <?php if (isset($_GET['error'])) { ?>
        <p style="color: red;"><?php echo $_GET['error']; ?></p>
    <?php } ?>
    <?php if (isset($_GET['success'])) { ?>
        <p style="color: green;"><?php echo $_GET['success']; ?></p>
    <?php } ?>

    <div class="data">
        <h2>Votre solde : <span><?= $user->getSolde() ?> $</span></h2>
        <div class="dropdown">
            <button class="transactions-btn">Voir les transactions</button>
            <div class="dropdown-content" id="transactionsDropdown">
                <?php
                    require_once 'gettransactions.php';
                    $transactions = getUserTransactions($user->getAccountNumber());
                    
                    if ($transactions) {
                        foreach ($transactions as $transaction) {
                            echo "<div class='transaction-item'>";
                            echo "<p>Date: " . htmlspecialchars($transaction['operation_date']) . "</p>";
                            echo "<p>Type: " . htmlspecialchars($transaction['operation_type']) . "</p>";
                            echo "<p>Montant: " . htmlspecialchars($transaction['operation_amount']) . " $</p>";
                            if($transaction['dest_username'] != NULL){
                                echo "<p>Destinataire: " . htmlspecialchars($transaction['dest_username']) . "</p>";
                            }
                            echo "</div>";
                        }
                    } else {
                        echo "<p>Aucune transaction trouvée</p>";
                    }
                ?>
            </div>
        </div>
        <button class="retrait" onclick="location.href='retrait.php'">Faire un retrait</button>
        <button class="virement" onclick="location.href='virement.php'">faire un virement</button>
        <button class="deconnexion" onclick="location.href='deconnexion.php'">Deconnexion</button>
    </div>

    <script>
    document.querySelector('.transactions-btn').addEventListener('click', function() {
        const dropdownContent = document.querySelector('.dropdown-content');
        dropdownContent.classList.toggle('active');
    });
</script>
</body>
</html>