<?php

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
    <link rel="stylesheet" href="./src/styles/components/frame.css" />
    <link rel="stylesheet" href="./src/styles/components/nav/navIndex.css">
    <link rel="stylesheet" href="./src/styles/pages/about/about.css">
    <link rel="stylesheet" href="./src/styles/components/footer/footer.css">

    <!-- Web Page Information -->
    <title>Search | Doctrax</title>
    <link rel="icon" href="./assets/images/Santa_Elena_Camarines_Norte.png" type="image/x-icon" />
</head>

<body>
    <div class="container">
        <nav class="navbar-container"><?php include './src/components/nav/navIndex.php' ?></nav>
        <main>
            <div class="section-1">
                <div class="background">
                    <!-- Background -->
                    <div class="ripple-background">
                        <div class="circle xxlarge shade1"></div>
                        <div class="circle xlarge shade2"></div>
                        <div class="circle large shade3"></div>
                        <div class="circle medium shade4"></div>
                        <div class="circle small shade5"></div>
                    </div>
                </div>
                <div class="main-container">
                    <h1>Santa Elena<br />DOCTRAX</h1>
                    <p>
                        Welcome to Santa Elena City, Online Document Tracking System. We
                        provide real time and transparency to all of you.
                    </p>
                </div>
            </div>
        </main>
        <footer class="footer-container"><?php include './src/components/footer/footerNoLogo.html' ?></footer>
    </div>
    <script src="./src/scripts/components/nav.js"></script>
</body>

</html>