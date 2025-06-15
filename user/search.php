<?php

session_start();

if (!isset($_SESSION['user_id'])) {
  header("Location: ../index.php");
  exit();
}

$userName = (!isset($_SESSION['user_id']) || $_SESSION['user_id'] == null) ? "No Account" : $_SESSION['user_name'];
$role = (!isset($_SESSION['user_role']) || $_SESSION['user_role'] == null) ? "No Role" : $_SESSION['user_role'];

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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet" />

    <!-- Local Styles -->
    <link rel="stylesheet" href="../src/styles/components/frame.css" />
    <link rel="stylesheet" href="../src/styles/components/nav/navUser.css">
    <link rel="stylesheet" href="../src/styles/pages/search/search.css">
    <link rel="stylesheet" href="../src/styles/components/footer/footer.css">

    <!-- Web Page Information -->
    <title>Search | Doctrax</title>
    <link rel="icon" href="../assets/images/Santa_Elena_Camarines_Norte.png" type="image/x-icon" />
</head>

<body>
    <div class="container">
        <nav class="navbar-container"><?php include '../src/components/nav/navUser.php' ?></nav>
        <main>
            <!-- Main Search Panel -->
            <div class="page-container">
                <div class="portal-panel">
                    <!-- Header Section -->
                    <div class="panel-header">
                        <h1>Santa Elena<br /><span class="doctrax">DOCTRAX</span></h1>
                        <p>
                            Know the status of your document by providing a valid Document ID
                        </p>
                    </div>

                    <!-- Search Section -->
                    <div class="panel-body">
                        <form class="search-input-wrapper" action="./results.php" method="get">
                            <div class="input-group">
                                <input type="text" name="search" id="search" placeholder="Search..." required>
                                <button type="submit" style="cursor: pointer"><span
                                        class="material-icons-round">search</span></button>
                            </div>
                        </form>

                        <div class="or-separator" style="display: none">or</div>

                        <button class="upload-btn" style="display: none">
                            <span class="upload-text">Upload File</span>
                            <span class="icon-svg">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M20 15V18C20 19.1046 19.1046 20 18 20H6C4.89543 20 4 19.1046 4 18L4 15M8 11L12 15M12 15L16 11M12 15V3"
                                        stroke="black" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </main>
        <footer class="footer-container"><?php include '../src/components/footer/footerNoLogo.html' ?></footer>
    </div>
    <script src="../src/scripts/components/nav.js"></script>
</body>

</html>