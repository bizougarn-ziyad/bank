<?php
class FormValidator {
    private $errors = [];
    private $data = [];
    private $files = [];

    public function __construct($postData, $files = []) {
        $this->data = $postData;
        $this->files = $files;
    }

    public function validateSignup() {
        $this->validateRequired();
        $this->validatePassword();
        $this->validateUsername();
        $this->validateImage();
        return $this->errors;
    }

    private function validateRequired() {
        $required = ['nom', 'prenom', 'username', 'password', 'confirme_password'];
        foreach ($required as $field) {
            if (empty($this->data[$field])) {
                $this->errors[$field] = ucfirst($field) . " is required";
            }
        }

        $requiredFiles = ['image'];
        foreach ($requiredFiles as $file) {
            if (empty($this->files[$file]['name'])) {
                $this->errors[$file] = ucfirst($file) . " is required";
            }
        }
    }

    private function validatePassword() {
        if (!empty($this->data['password'])) {
            $password = $this->data['password'];
            $confirm = $this->data['confirme_password'];

            if ($password !== $confirm) {
                $this->errors['confirme_password'] = "Passwords do not match";
            } else if (strlen($password) < 8) {
                $this->errors['password'] = "Password must be at least 8 characters long";
            } else if (!preg_match("/^(?=.*[@#$%^&+=])(?=.*\d).{5,}$/", $password)) {
                $this->errors['password'] = "Password must contain at least one special character and one number";
            }
        }
    }

    private function validateUsername() {
        if (!empty($this->data['username'])) {
            try {
                $conn = new PDO("mysql:host=localhost;dbname=operations", "root", "");
                $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
                $stmt->execute([$this->data['username']]);
                if ($stmt->fetch()) {
                    $this->errors['username'] = "Username already taken";
                }
            } catch (PDOException $e) {
                $this->errors['database'] = "Database connection error";
            }
        }
    }

    private function validateImage() {
        if (empty($this->files['image']['name'])) {
            $this->errors['image'] = "Image is required";
            return;
        }
        $file_size = $this->files['image']['size'];
        $file_type = $this->files['image']['type'];
        
        // Maximum file size (5MB)
        $max_size = 5 * 1024 * 1024;
        $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
        
        if ($file_size > $max_size) {
            $this->errors['image'] = "Image size must be less than 5MB";
        }
        
        if (!in_array($file_type, $allowed_types)) {
            $this->errors['image'] = "Only JPG, JPEG & PNG files are allowed";
        }

    }

    public function hasErrors() {
        return !empty($this->errors);
    }
}