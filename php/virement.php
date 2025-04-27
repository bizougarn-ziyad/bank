<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Virement</title>
</head>
<body>
    <h1>Retrait</h1>
    <form action="doVirement.php" method="post">
        <label for="amount">Montant à envoyer:</label>
        <input type="number" name="amount" id="amount" required><br>
        <label for="username">Username du destinataire:</label>
        <input type="text" name="username" id="username"></label><br>
        <input type="submit" value="Retirer">
    </form>

   
</body>
</html>