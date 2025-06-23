<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

$userName = (!isset($_SESSION['user_id']) || $_SESSION['user_id'] == null) ? "No Account" : $_SESSION['user_name'];
$role = (!isset($_SESSION['user_role']) || $_SESSION['user_role'] == null) ? "No Role" : $_SESSION['user_role'];
$accountCode = (!isset($_SESSION['user_code']) || $_SESSION['user_code'] == null) ? "No Code" : $_SESSION['user_code'];

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
        href="https://fonts.googleapis.com/css2?family=Mate:ital@0;1&family=Montagu+Slab:opsz,wght@16..144,100..700&family=Rambla:ital,wght@0,400;0,700;1,400;1,700&family=Source+Serif+4:ital,opsz,wght@0,8..60,200..900;1,8..60,200..900&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet" />

    <!-- Local Styles -->
    <link rel="stylesheet" href="../src/styles/pages/home/homeAdmin.css" />
    <link rel="stylesheet" href="../src/styles/components/nav/navAdmin.css" />
    <link rel="stylesheet" href="../src/styles/components/footer/footer.css" />
    <link rel="stylesheet" href="../src/styles/components/sidebar.css" />
    <link rel="stylesheet" href="../src/styles/components/frame-with-sidebar.css" />

    <!-- Web Page Information -->
    <title>Home | Doctrax</title>
    <link rel="icon" href="../assets/images/Santa_Elena_Camarines_Norte.png" type="image/x-icon" />
</head>

<body>
    <div class="container" id="container">
        <aside class="left-sidebar" id="sidebarPanel"><?php include '../src/components/sidebar/sidebarAdmin.php' ?>
        </aside>
        <nav class="navbar-container"><?php include '../src/components/nav/navAdmin.php' ?></nav>
        <main>
            <div class="sub-container">
                <!-- Page Header -->
                <div class="home-header">
                    <div class="logo">
                        <img src="../assets/images/Santa_Elena_Camarines_Norte.png" alt="Municipal Logo" />
                    </div>
                    <div class="page-name">
                        <span>Santa Elena</span>
                        <span>Document Tracking System</span>
                    </div>
                    <div class="search-bar">
                        <input type="search" name="searchDocument" id="searchDocument"
                            onkeypress="if(event.key === 'Enter'){ clickSearch(); }" />
                        <button onclick="clickSearch()">
                            <div class="search-icon">
                                <span class="material-icons-round"> search </span>
                            </div>
                        </button>
                    </div>
                </div>
                <hr style="width: 100%; box-sizing: border-box" />
                <p>
                    Welcome to Santa Elena Municipal Document Tracking System! Select a
                    department below to track, request, or manage your documents.
                </p>
                <!-- Sector Selection -->
                <div class="home-options">
                    <div class="option-layer">
                        <a href="../sectors/health-office.php">
                            <div class="sector">
                                <img src="../assets/images/health.png" alt="" />
                                <span>Municipal Health Office</span>
                            </div>
                        </a>
                        <a href="../sectors/civil-registrar-office.php">
                            <div class="sector">
                                <img src="../assets/images/civil-reg.png" alt="" />
                                <span>Civil Registrar Office</span>
                            </div>
                        </a>
                        <a href="../sectors/general-services-office.php">
                            <div class="sector">
                                <img src="../assets/images/gen-service.png" alt="" />
                                <span>General Services Office</span>
                            </div>
                        </a>
                        <a href="../sectors/agricultural-office.php">
                            <div class="sector">
                                <img src="../assets/images/agri.png" alt="" />
                                <span>Agricultural Office</span>
                            </div>
                        </a>
                        <a href="../sectors/accounting-office.php">
                            <div class="sector">
                                <img src="../assets/images/accounting.png" alt="" />
                                <span>Accounting Office</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </main>
        <footer class="footer-container"><?php include '../src/components/footer/footerNoLogo.html' ?></footer>
    </div>
    <script src="../src/scripts/components/nav.js"></script>
    <script src="../src/scripts/components/sidebar.js"></script>
</body>

</html>