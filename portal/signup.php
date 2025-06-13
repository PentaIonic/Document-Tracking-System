<?php

session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$errors = [
    'signup' => $_SESSION['signup_error'] ?? '',
    'password' => $_SESSION['password_mismatch'] ?? ''
];

session_unset();

function showError($error)
{
    return !empty($error) ? "<p class='error-message'>$error</p>" : '';
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
    <link rel="stylesheet" href="../src/styles/pages/portal/signup.css">
    <link rel="stylesheet" href="../src/styles/components/footer/footer.css">

    <!-- Web Page Information -->
    <title>Sign Up | Doctrax</title>
    <link rel="icon" href="../assets/images/Santa_Elena_Camarines_Norte.png" type="image/x-icon" />
</head>

<body>
    <div class="container">
        <nav class="navbar-container"><?php include '../src/components/nav/navPortal.php' ?></nav>
        <main>
            <div class="page-container">
                <div class="panel-header">
                    <h1>Santa Elena DOCTRAX</h1>
                    <p>The Document tracking system of Santa Elena Municipalty</p>
                </div>
                <form action="../src/scripts/pages/portal/portal.php" method="post">
                    <span>Register</span>
                    <div class="form-frame">
                        <div class="section-left">
                            <div class="input-group">
                                <label for="firstName">First Name</label>
                                <input type="text" name="firstName" placeholder="First Name" required>
                            </div>
                            <div class="input-group">
                                <label for="middleName">Middle Name</label>
                                <input type="text" name="middleName" placeholder="Middle Name">
                            </div>
                            <div class="input-group">
                                <label for="lastName">Last Name</label>
                                <input type="text" name="lastName" placeholder="Last Name" required>
                            </div>
                            <div class="input-group">
                                <label for="suffixName">Suffix</label>
                                <select name="suffixName">
                                    <option value="">N/A</option>
                                    <option value="Sr.">Sr.</option>
                                    <option value="Jr.">Jr.</option>
                                    <option value="I">I</option>
                                    <option value="II">II</option>
                                    <option value="III">III</option>
                                    <option value="IV">IV</option>
                                    <option value="V">V</option>
                                    <option value="VI">VI</option>
                                    <option value="VII">VII</option>
                                </select>
                            </div>
                        </div>
                        <div class="section-right">
                            <div class="input-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" placeholder="Email" required>
                            </div>
                            <div class="input-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="signupPassword" placeholder="Password"
                                    required>
                            </div>
                            <div class="input-group">
                                <label for="password">Confirm Password</label>
                                <input type="password" name="confirmPassword" id="confirmPassword"
                                    placeholder="Confirm Password" required>
                            </div>
                        </div>
                    </div>
                    <?= showError($errors['signup']); ?>
                    <?= showError($errors['password']); ?>
                    <button type="submit" name="signup">Sign Up</button>
                </form>
                <div class="panel-footer">
                    <p>Already have an account? <a href="./login.php">Click here</a></p>
                </div>
            </div>
        </main>
        <footer class="footer-container"><?php include '../src/components/footer/footerNoLogo.html' ?></footer>
    </div>
</body>

</html>