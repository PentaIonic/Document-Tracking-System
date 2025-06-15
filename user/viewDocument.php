<?php

session_start();

include '../src/scripts/components/database/connection.php';
$userName = (!isset($_SESSION['user_id']) || $_SESSION['user_id'] == null) ? "No Account" : $_SESSION['user_name'];
$role = (!isset($_SESSION['user_role']) || $_SESSION['user_role'] == null) ? "No Role" : $_SESSION['user_role'];

$code = $_GET['code'] ?? null;

if ($code === null) {
    header("Location: ./results.php");
    exit();
}

$userId = $_SESSION['user_id'];
$sqlQueryDocument = "SELECT * FROM document_records WHERE document_code = ? AND user_id = ?";
$stmt = $conn->prepare($sqlQueryDocument);
$stmt->bind_param("ii", $code, $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: ./results.php");
}

$document = $result->fetch_assoc();
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
    <link rel="stylesheet" href="../src/styles/components/nav/navUser.css" />
    <link rel="stylesheet" href="../src/styles/components/footer/footer.css" />
    <link rel="stylesheet" href="../src/styles/components/frame.css" />
    <link rel="stylesheet" href="../src/styles/pages/search/viewDocument.css" />

    <!-- Web Page Information -->
    <title>Tracking | Doctrax</title>
    <link rel="icon" href="../assets/images/Santa_Elena_Camarines_Norte.png" type="image/x-icon" />
</head>

<body>
    <div class="container">
        <nav class="navbar-container"><?php include '../src/components/nav/navUser.php' ?></nav>
        <main>
            <div class="page-container">
                <section class="document-wrapper">
                    <h1 class="document-title">DOCUMENT</h1>

                    <!-- Document Details Panel -->
                    <section class="document-panel">
                        <table class="document-table">
                            <tr>
                                <th>Reference Number</th>
                                <td><span id="docCode"><?= htmlspecialchars($document['document_code']) ?></span></td>
                            </tr>
                            <tr>
                                <th>Personal Information</th>
                                <td>
                                    <div class="info-stack">
                                        <strong>Name: <span
                                                id="fullName"><?= htmlspecialchars($document['last_name']) . "," . htmlspecialchars($document['first_name']) . " " . htmlspecialchars($document['middle_name']) . " " . htmlspecialchars($document['suffix_name']) ?></span></strong>
                                        <strong>Age: <span
                                                id="age"><?= htmlspecialchars($document['age']) ?></span></strong>
                                        <strong>Sex: <span
                                                id="sex"><?= htmlspecialchars($document['sex']) ?></span></strong>
                                        <strong>Address: <span
                                                id="address"><?= htmlspecialchars($document['address']) . ", " . htmlspecialchars($document['barangay']) ?></span></strong>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Date of Appeal/Appointment</th>
                                <td><span
                                        id="documentDate"><?= htmlspecialchars($document['document_registered']) ?></span>
                                </td>
                            </tr>
                            <tr>
                                <th>Date of Validation</th>
                                <td><span
                                        id="documentDateValidation"><?= !empty($document['document_validation']) ? htmlspecialchars($document['document_validation']) : "Not Yet Processed" ?></span>
                                </td>
                            </tr>
                            <tr>
                                <th>Department</th>
                                <td><span id="sector">
                                        <?php
                                        switch ($document['sector']) {
                                            case "health-office":
                                                echo "Health Office";
                                                break;
                                            case "civil-registrar-office":
                                                echo "Civil Registrar Office";
                                                break;
                                            case "gen-service-office":
                                                echo "General Services Office";
                                                break;
                                            case "agricultural-office":
                                                echo "Agricultural Office";
                                                break;
                                            case "accounting-office":
                                                echo "Accounting Office";
                                                break;
                                        }
                                        ?>
                                    </span></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td><span
                                        id="documentStatus"><?= htmlspecialchars($document['document_status']) ?></span>
                                </td>
                            </tr>
                            <tr>
                                <th>Action</th>
                                <td>
                                    <?php if (!empty($document['document_url'])): ?>
                                        <a href="<?= $filePath ?>" target="_blank" class="view-button">View Uploaded
                                            Document</a>
                                    <?php else: ?>
                                        <span>No file uploaded.</span>
                                    <?php endif; ?>
                                </td>
                            </tr>

                            <tr>
                                <th>QR CODE</th>
                                <td>
                                    <div class="qr-box" id="qr-box"></div>
                                </td>
                            </tr>
                        </table>
                    </section>
            </div>
        </main>
        <footer class="footer-container"><?php include '../src/components/footer/footerNoLogo.html' ?></footer>
    </div>
    <script type="text/javascript" src="https://unpkg.com/qr-code-styling@1.5.0/lib/qr-code-styling.js"></script>
    <script src="../src/scripts/pages/search/viewDocument.js"></script>
    <script src="../src/scripts/components/nav.js"></script>
</body>

</html>