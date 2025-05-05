<?php
    session_start();
    $form_data = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];
    $errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..\styles\styleSignup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Sign-Up</title>
</head>
<body>
    
<form action="dosignup.php" method="post" enctype="multipart/form-data">
            <h1>Sign Up</h1>
            <?php if(isset($success)){
                echo '<p class="success-message">' . $success . '</p>';
            }
            ?>
            <div class="form-group">
                <i class="fas fa-user"></i>
                <input type="text" name="nom" id="nom" placeholder="Nom" autocomplete="off" 
                    value="<?php echo isset($form_data['nom']) ? htmlspecialchars($form_data['nom']) : ''; ?>">
                <?php if(isset($errors['nom'])): ?>
                    <span class="error-message"><?php echo htmlspecialchars($errors['nom']); ?></span>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <i class="fas fa-user-tag"></i>
                <input type="text" name="prenom" id="prenom" placeholder="Prenom" autocomplete="off"
                    value="<?php echo isset($form_data['prenom']) ? htmlspecialchars($form_data['prenom']) : ''; ?>">
                <?php if(isset($errors['prenom'])): ?>
                    <span class="error-message"><?php echo htmlspecialchars($errors['prenom']); ?></span>
                <?php endif; ?>
            </div>
            <div class="form-group file-upload">
                <label for="image">
                    <i class="fas fa-image icon"></i>
                    <span class="upload-text">Profile Picture :</span>
                    <span class="file-name" id="file-name">No File Chosen</span>
                </label>
                <input type="file" name="image" id="image" autocomplete="off">
                <?php if(isset($errors['image'])): ?>
                    <span class="error-message"><?php echo htmlspecialchars($errors['image']); ?></span>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <i class="fas fa-at"></i>
                <input type="text" name="username" id="username" placeholder="Username" autocomplete="off"
                    value="<?php echo isset($form_data['username']) ? htmlspecialchars($form_data['username']) : ''; ?>">
                <?php if(isset($errors['username'])): ?>
                    <span class="error-message"><?php echo htmlspecialchars($errors['username']); ?></span>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Password" autocomplete="off">
                <?php if(isset($errors['password'])): ?>
                    <span class="error-message"><?php echo htmlspecialchars($errors['password']); ?></span>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="confirme_password" id="confirme_password" placeholder="Confirme Password" autocomplete="off">
                <?php if(isset($errors['confirme_password'])): ?>
                    <span class="error-message"><?php echo htmlspecialchars($errors['confirme_password']); ?></span>
                <?php endif; ?>
            </div>
            <button type="submit">Sign Up <i class="fas fa-arrow-right"></i></button>
        </form>

        <?php
            unset($_SESSION['errors']);
            unset($_SESSION['form_data']);
        ?>

<script>
document.getElementById('image').addEventListener('change', function(e) {
const fileName = e.target.files[0] ? e.target.files[0].name : 'No file chosen';
document.getElementById('file-name').textContent = fileName;

const label = this.closest('.file-upload').querySelector('label');
label.style.borderColor = fileName !== 'No file chosen' ? 'var(--primary)' : '';
});
</script>
</body>
</html>