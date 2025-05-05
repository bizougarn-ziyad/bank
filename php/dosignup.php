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
    }else{
        require_once 'dbh.php';
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $image = $_FILES['image']['tmp_name'];


        $upload_dir = 'uploads/';
        $image_name = basename($_FILES['image']['name']);
        $image_path = $upload_dir . $image_name;
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
            echo 'Error uploading image file';
            exit;
        }
        
        $query= "INSERT INTO users(nom, prenom, username, pwd, image) VALUES (:nom, :prenom, :username, :password, :image)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            'nom' => $nom,
            'prenom' => $prenom,
            'username' => $username,
            'password' => $password,
            'image' => $image_path
        ]);
        $pdo=null;
        $stmt = null;
        $success = "Account created successfully";
        header("Location: loginpage.php?success=$success");
        exit();
    }

    

?>