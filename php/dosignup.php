<?php
    session_start();
    require 'formvalidator.php';
    
    $_SESSION['form_data'] = $_POST;

    $validator = new FormValidator($_POST, $_FILES);
    $errors = $validator->validateSignup();

    if ($validator->hasErrors()) {
        $_SESSION['errors'] = $errors;
        header("Location: signuppage.php");
        exit();
    } else {
        require_once 'dbh.php';
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $username = $_POST['username'];
        $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $imageData = file_get_contents($_FILES['image']['tmp_name']);
        
        $query = "INSERT INTO users(nom, prenom, username, pwd, image) VALUES (:nom, :prenom, :username, :password, :image)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            'nom' => $nom,
            'prenom' => $prenom,
            'username' => $username,
            'password' => $hashed_password,
            'image' => $imageData
        ]);
        
        $pdo = null;
        $stmt = null;
        $success = "Account created successfully";
        header("Location: loginpage.php?success=$success");
        exit();
    }
?>