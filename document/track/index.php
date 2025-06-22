<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../index.php");
    exit();
}

include '../../src/scripts/components/database/connection.php';

$userName = $_SESSION['user_name'] ?? "No Account";
$role = $_SESSION['user_role'] ?? "No Role";

$docCode = $_GET['code'] ?? null;
$docDetails = null;
$processLog = null;

if ($docCode) {
    $sqlTrackQuery = "SELECT * FROM document_records WHERE document_code = ?";
    $stmt = $conn->prepare($sqlTrackQuery);
    $stmt->bind_param("s", $docCode);
    $stmt->execute();
    $result = $stmt->get_result();
    $docDetails = $result->fetch_assoc(); // Get the document record
}

if ($docCode) {
    $sqlProcessLogQuery = "SELECT * FROM process_logs WHERE document_code = ? ORDER BY document_validation DESC LIMIT 1";
    $stmt = $conn->prepare($sqlProcessLogQuery);
    $stmt->bind_param("s", $docCode);
    $stmt->execute();
    $result = $stmt->get_result();
    $processLog = $result->fetch_assoc();
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
        href="https://fonts.googleapis.com/css2?family=Mate:ital@0;1&family=Montagu+Slab:opsz,wght@16..144,100..700&family=Rambla:ital,wght@0,400;0,700;1,400;1,700&family=Source+Serif+4:ital,opsz,wght@0,8..60,200..900;1,8..60,200..900&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet" />

    <!-- Local Styles -->
    <link rel="stylesheet" href="../../src/styles/pages/document/track.css" />
    <link rel="stylesheet" href="../../src/styles/components/nav/navAdmin.css" />
    <link rel="stylesheet" href="../../src/styles/components/footer/footer.css" />
    <link rel="stylesheet" href="../../src/styles/components/sidebar.css" />
    <link rel="stylesheet" href="../../src/styles/components/frame-with-sidebar.css" />

    <!-- Web Page Information -->
    <title>Track | Doctrax</title>
    <link rel="icon" href="../../assets/images/Santa_Elena_Camarines_Norte.png" type="image/x-icon" />
</head>

<body>
    <div class="popup-remark" id="remarkView">
        <div class="popup-container-remark">
            <div class="close-section">
                <a onclick="closePrompt()">&times;</a>
            </div>
            <span>Reference Number:</span><br />
            <span
                id="referenceNumValidRemark"><?= htmlspecialchars($processLog['reference_num'] ?? 'N/A') ?></span><br /><br />
            <span>Evaluator</span><br />
            <span id="officerNameRemark"><?= htmlspecialchars($processLog['user'] ?? 'N/A') ?></span><br /><br />
            <span>Remarks</span><br />
            <span
                id="documentRemarksRemark"><?= htmlspecialchars($processLog['document_remarks'] ?? 'N/A') ?></span><br /><br />
            <span>Details</span><br />
            <span
                id="remarkDescriptionRemark"><?= htmlspecialchars($processLog['remark_description'] ?? 'N/A') ?></span>
        </div>
    </div>
    <div class="popup-process-document" id="processFormBox">
        <div class="popup-container-process-document">
            <div class="close-section">
                <a onclick="closePrompt()">&times;</a>
            </div>
            <form id="processLog" action="../../src/scripts/pages/document/trackDocument.php" method="post">
                <div class="process-form-container">
                    <label for="referenceNumValid">Reference Number:</label>
                    <input type="text" id="referenceNumValid" readonly value="" />
                    <label for="officerName">Evaluator</label>
                    <input type="text" id="officerName" required readonly value="<?= $userName ?>" />
                    <label for="setStatus">Status</label>
                    <select name="setStatus" id="setStatus" required>
                        <option value="" disabled selected>-- Select Status --</option>
                        <option value="Pending">Pending</option>
                        <option value="Approved">Approved</option>
                        <option value="Received">Received</option>
                        <option value="On Schedule">On Schedule</option>
                        <option value="For Processing">For Processing</option>
                        <option value="On Hold">On Hold</option>
                        <option value="Released">Released</option>
                        <option value="Rejected">Rejected</option>
                    </select>
                    <label for="documentRemarks">Remarks</label>
                    <input type="text" id="documentRemarks" name="documentRemarks" required />
                    <label for="remarkDescription">Remarks Description</label>
                    <textarea name="remarkDescription" id="remarkDescription"></textarea>
                    <input type="hidden" name="code" value="<?= htmlspecialchars($docCode) ?>">
                    <input type="hidden" name="sector" value="<?php echo htmlspecialchars($docDetails['sector']) ?>">
                    <button type="submit" name="log" id="processRequest">Process</button>
                </div>
            </form>
        </div>
    </div>
    <div class="popup-cancel-document" id="cancelFormBox">
        <div class="popup-container-cancel-document">
            <div class="close-section">
                <div class="close-section">
                    <a onclick="closePrompt()">&times;</a>
                </div>
            </div>
            <div class="popup-text">
                <span>Cancelling this request will result in the termination of your
                    document. Are you sure you want to proceed?</span>
            </div>
            <div class="popup-action">
                <form action="../../src/scripts/pages/document/trackDocument.php" method="post">
                    <button type="submit" name="delete" class="yes" id="deleteRecord" value="<?= htmlspecialchars($docCode) ?>">
                        <span>Yes</span>
                    </button>
                    <button class="no" onclick="closePrompt()"><span>No</span></button>
                </form>
            </div>
        </div>
    </div>
    <div class="container" id="container">
        <aside class="left-sidebar" id="sidebarPanel"><?php include '../../src/components/sidebar/sidebarDocument.php' ?>
        </aside>
        <nav class="navbar-container"><?php include '../../src/components/nav/navDocument.php' ?></nav>
        <main>
            <div class="page-container">
                <section class="document-wrapper">
                    <h1 class="document-title">DOCUMENT</h1>

                    <!-- Document Details Panel -->
                    <section class="document-panel">
                        <table class="document-table">
                            <tr>
                                <th>Reference Number</th>
                                <td><span
                                        id="docCode"><?= htmlspecialchars($docDetails['document_code'] ?? 'Not found', ENT_QUOTES) ?></span>
                                </td>
                            </tr>
                            <tr>
                                <th>Personal Information</th>
                                <td>
                                    <div class="info-stack">
                                        <strong>Name: <span id="fullName">
                                                <?php
                                                if ($docDetails) {
                                                    $lastName = $docDetails['last_name'] ?? '';
                                                    $firstName = $docDetails['first_name'] ?? '';
                                                    $middleName = $docDetails['middle_name'] ?? '';
                                                    $suffixName = $docDetails['suffix_name'] ?? '';
                                                    echo htmlspecialchars(trim($lastName . ", " . $firstName . " " . $middleName . " " . $suffixName), ENT_QUOTES);
                                                } else {
                                                    echo 'Not found';
                                                }
                                                ?>
                                            </span></strong>
                                        <strong>Age: <span
                                                id="age"><?= htmlspecialchars($docDetails['age'] ?? 'N/A') ?></span></strong>
                                        <strong>Sex: <span
                                                id="sex"><?= htmlspecialchars($docDetails['sex'] ?? 'N/A') ?></span></strong>
                                        <strong>Address: <span id="address">
                                                <?php
                                                if ($docDetails) {
                                                    $address = $docDetails['address'] ?? '';
                                                    $barangay = $docDetails['barangay'] ?? '';
                                                    $municipal = $docDetails['municipal'] ?? '';
                                                    $province = $docDetails['province'] ?? '';
                                                    echo htmlspecialchars(trim($address . " " . $barangay . ", " . $municipal . ", " . $province), ENT_QUOTES);
                                                } else {
                                                    echo 'Not found';
                                                }
                                                ?>
                                            </span></strong>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Date of Appeal/Appointment</th>
                                <td><span
                                        id="documentDate"><?= htmlspecialchars($docDetails['document_registered'] ?? 'N/A') ?></span>
                                </td>
                            </tr>
                            <tr>
                                <th>Date of Validation</th>
                                <td><span
                                        id="documentDateValidation"><?= htmlspecialchars($docDetails['document_validation'] ?? 'N/A') ?></span>
                                </td>
                            </tr>
                            <tr>
                                <th>Department</th>
                                <td><span id="sector"><?= htmlspecialchars($docDetails['sector'] ?? 'N/A') ?></span>
                                </td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td><span
                                        id="documentStatus"><?= htmlspecialchars($docDetails['document_status'] ?? 'N/A') ?></span>
                                </td>
                            </tr>
                            <tr>
                                <th>Action</th>
                                <td class="action-buttons">
                                    <button id="viewRemarks">
                                        <span class="material-icons-round">visibility</span> Remarks
                                    </button>
                                    <button id="processDocument">
                                        <span class="material-icons-round"> post_add </span>Process
                                        Document
                                    </button>
                                    <button id="cancelDocument">
                                        <span class="material-icons-round">cancel</span> Cancel
                                        Application
                                    </button>
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
                </section>
            </div>
        </main>
        <footer class="footer-container"><?php include '../../src/components/footer/footerNoLogo.html' ?></footer>
    </div>
    <script type="text/javascript" src="https://unpkg.com/qr-code-styling@1.5.0/lib/qr-code-styling.js"></script>
    <script>
        const qrData = <?= json_encode("https://{$_SERVER['HTTP_HOST']}/Document-Tracking-System/document/track/index.php?code=" . urlencode($docCode)) ?>;
    </script>
    <script src="../../src/scripts/pages/document/trackDocument.js"></script>
    <script src="../../src/scripts/components/nav.js"></script>
    <script src="../../src/scripts/components/sidebar.js"></script>
</body>

</html>