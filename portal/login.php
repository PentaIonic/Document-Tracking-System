<?php

session_start();

$errors = [
    'login' => $_SESSION['login_error'] ?? '',
    'password' => $_SESSION['password_mismatch'] ?? ''

];

$success = [
    'success' => $_SESSION['success_register'] ?? ''
];

session_unset();

function showError($prompt)
{
    return !empty($prompt) ? "<p class='error-message'>$prompt</p>" : '';
}

function showSuccess($prompt)
{
    return !empty($prompt) ? "<p class='prompt-message'>$prompt</p>" : '';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Web Page Information & Responsive Tags -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Font Styles & Links -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Mate:ital@0;1&family=Rambla:ital,wght@0,400;0,700;1,400;1,700&family=Source+Serif+4:ital,opsz,wght@0,8..60,200..900;1,8..60,200..900&display=swap"
        rel="stylesheet" />

    <!-- Local Styles -->
    <link rel="stylesheet" href="../src/styles/components/frame.css" />
    <link rel="stylesheet" href="../src/styles/components/nav/navPortal.css">
    <link rel="stylesheet" href="../src/styles/pages/portal/login.css">
    <link rel="stylesheet" href="../src/styles/components/footer/footer.css">

    <!-- Web Page Information -->
    <title>Log In | Doctrax</title>
    <link rel="icon" href="../assets/images/Santa_Elena_Camarines_Norte.png" type="image/x-icon" />
</head>

<body>
    <div class="container">
        <nav class="navbar-container"><?php include '../src/components/nav/navPortal.php' ?>
        </nav>
        <main>
            <div class="page-container">
                <div class="panel-header">
                    <h1>Santa Elena DOCTRAX</h1>
                    <p>The Document tracking system of Santa Elena Municipalty</p>
                </div>
                <form action="../src/scripts/pages/portal/portal.php" method="post">
                    <span>Login</span>
                    <div class="form-frame">
                        <div class="input-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" placeholder="Email" required>
                        </div>
                        <div class="input-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="signupPassword" placeholder="Password" required>
                        </div>
                        <div class="input-group">
                            <a class="forgot-pass" href="#">Forgot Password?</a>
                        </div>
                    </div>
                    <?= showError($errors['login']); ?>
                    <?= showError($errors['password']); ?>
                    <?= showSuccess($success['success']); ?>
                    <button type="submit" name="login">Log In</button>
                </form>
                <div class="panel-footer">
                    <p>Don't have an account? <a href="./signup.php">Click here</a></p>
                </div>
            </div>
        </main>
        <footer class="footer-container"><?php include '../src/components/footer/footerNoLogo.html' ?></footer>
    </div>
    <script src="../src/scripts/components/nav.js"></script>
</body>

</html>