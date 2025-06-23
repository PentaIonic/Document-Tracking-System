<?php

// For Navbar Name Displays
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

include '../src/scripts/components/database/connection.php';
$userName = (!isset($_SESSION['user_id']) || $_SESSION['user_id'] == null) ? "No Account" : $_SESSION['user_name'];
$role = (!isset($_SESSION['user_role']) || $_SESSION['user_role'] == null) ? "No Role" : $_SESSION['user_role'];
$accountCode = (!isset($_SESSION['user_code']) || $_SESSION['user_code'] == null) ? "No Code" : $_SESSION['user_code'];

$search = $_GET['search'] ?? '';
$accountCode = $_SESSION['user_code'];

$sqlSearchQuery = "SELECT document_id, document_title, document_code 
                   FROM document_records 
                   WHERE (document_code LIKE ? OR document_title LIKE ?) 
                   AND account_code = ?";

$searchTerm = "%" . $search . "%";
$stmt = $conn->prepare($sqlSearchQuery);
$stmt->bind_param("sss", $searchTerm, $searchTerm, $accountCode);
$stmt->execute();
$result = $stmt->get_result();


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
    <link rel="stylesheet" href="../src/styles/pages/search/results.css">
    <link rel="stylesheet" href="../src/styles/components/footer/footer.css">

    <!-- Web Page Information -->
    <title>Results | Doctrax</title>
    <link rel="icon" href="../assets/images/Santa_Elena_Camarines_Norte.png" type="image/x-icon" />
</head>

<body>
    <div class="container">
        <nav class="navbar-container"><?php include '../src/components/nav/navUser.php' ?></nav>
        <main>
            <div class="page-container">
                <div class="results-header">
                    <span>Your Requests</span>
                    <form class="search-bar" action="./results.php" method="get">
                        <input type="search" name="search" id="search" />
                        <button type="submit">
                            <div class="search-icon">
                                <span class="material-icons-round"> search </span>
                            </div>
                        </button>
                    </form>
                </div>
                <div class="document-results">
                    <div class="horz-scroll">
                        <table id="documentDatabase" class="document-list">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Document Title</th>
                                    <th>Code</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>
                                            <td>{$row['document_id']}</td>
                                            <td>{$row['document_title']}</td>
                                            <td>{$row['document_code']}</td>
                                            <td><input type='button' name='viewDocument' value='View' onclick='window.location.href=\"./viewDocument.php?code={$row['document_code']}\"'/></td>
                                            </tr>
                                            <tr>
                                            <td></td>
                                            </tr>
                                            ";
                                    }
                                } else {
                                    echo '<tr><td colspan="4" style="text-align:center;" class="noDataRow"><span>No Data Available</span></td></tr>';
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
        <footer class="footer-container"><?php include '../src/components/footer/footerNoLogo.html' ?></footer>
    </div>
    <script src="../src/scripts/components/nav.js"></script>
</body>

</html>