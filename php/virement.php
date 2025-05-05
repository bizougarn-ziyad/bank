<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..\styles\stylevirement.css">
    <title>Virement</title>
</head>
<body>
    <h1>Virement</h1>
    <form action="doVirement.php" method="post">
        <input type="number" name="amount" id="amount" placeholder="Montant à envoyer" required><br>
        <input type="text" name="username" id="username" placeholder="Username du destinateur" required><br>
        <input type="submit" value="Retirer">
    </form>

   
</body>
</html>