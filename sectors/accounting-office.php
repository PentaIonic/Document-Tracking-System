<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

include '../src/scripts/components/database/connection.php';

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
    <link rel="stylesheet" href="../src/styles/pages/sectors/accounting-office.css" />
    <link rel="stylesheet" href="../src/styles/components/nav/navSector.css" />
    <link rel="stylesheet" href="../src/styles/components/footer/footer.css" />
    <link rel="stylesheet" href="../src/styles/components/sidebar.css" />
    <link rel="stylesheet" href="../src/styles/components/frame-with-sidebar.css" />

    <!-- Web Page Information -->
    <title>Accounting Office | Doctrax</title>
    <link rel="icon" href="../assets/images/Santa_Elena_Camarines_Norte.png" type="image/x-icon" />
</head>

<body>
    <div class="container" id="container">
        <aside class="left-sidebar" id="sidebarPanel"><?php include '../src/components/sidebar/sidebarAdmin.php' ?>
        </aside>
        <nav class="navbar-container"><?php include '../src/components/nav/navSector.php' ?></nav>
        <main>
            <div class="page-container">
                <div class="page-actions">
                    <a class="back-button" href="./">
                        <span class="material-icons-round"> chevron_left </span> Back to Home
                    </a>
                </div>
                <div class="sub-container">
                    <div class="sector-header">
                        <div class="sector-logo">
                            <img src="../assets/images/health.png" alt="" />
                        </div>
                        <div class="sector-plate">
                            <span>Accounting Office</span>
                        </div>
                    </div>
                    <div class="sector-overview">
                        <h1>Overview</h1>
                            Handles all financial transactions of the municipality, including
                            budgeting, fund disbursement, and financial reporting to ensure
                            transparency and compliance.
                    </div>
                    <hr style="width: 100%; box-sizing: border-box" />
                    <div class="transaction-type">
                        <div class="transaction-type-header">
                            <h1>Type of Transactions</h1>
                        </div>
                        <div class="content-wrapper">
                <div class="image-container">
                    <img src="../assets/images/aco.jpg" alt="Accounting Office" />
                </div>
                        <div class="transaction-options">
                            <div class="transaction">
                                <span>Disbursement Voucher</span>
                            </div>
                            <div class="transaction">
                                <span>Liquidation Report Submission</span>
                            </div>
                            <div class="transaction">
                                <span>Obligation Request & Status</span>
                            </div>
                            <div class="transaction">
                                <span>Payroll Certification Request</span>
                            </div>
                            <div class="transaction">
                                <span>Budget Utilization Request</span>
                            </div>
                        </div>
                    </div>
                    <div class="frame-10">
                    <img src="../assets/images/Frame 10.png" alt="Frame" />
                        </div>
                    <div class="action-button">
                        <button id="autoFillForm" onclick="redirectDepartmentCode('accounting-office')">
                            <div class="proceed">
                                <span>Proceed</span>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </main>
        <footer class="footer-container"><?php include '../src/components/footer/footerNoLogo.html' ?></footer>
    </div>
    <script src="../src/scripts/components/nav.js"></script>
    <script src="../src/scripts/components/sidebar.js"></script>
    <script src="../src/scripts/pages/sectors/sectors.js"></script>
</body>

</html>