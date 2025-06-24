<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../index.php");
    exit();
}

$docCode = $_GET['code'] ?? null;
$success = $_GET['success'] ?? null;

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
    <link rel="stylesheet" href="../../src/styles/pages/document/register.css" />
    <link rel="stylesheet" href="../../src/styles/components/nav/navAdmin.css" />
    <link rel="stylesheet" href="../../src/styles/components/footer/footer.css" />
    <link rel="stylesheet" href="../../src/styles/components/sidebar.css" />
    <link rel="stylesheet" href="../../src/styles/components/frame-with-sidebar.css" />

    <!-- Web Page Information -->
    <title>Register | Doctrax</title>
    <link rel="icon" href="../../assets/images/Santa_Elena_Camarines_Norte.png" type="image/x-icon" />
</head>

<body>
    <div class="container" id="container">
        <!-- Popup Success -->
        <div class="popup-success" id="success">
            <div class="popup-container-success">
                <div class="close-section">
                    <a onclick="gotoHome()">&times;</a>
                </div>
                <div class="text-section">
                    <h1>Success!</h1>
                    <span>How's our service? You can scan the QR code to access updates to your request.</span>
                </div>
                <div class="actions-section">
                    <button onclick="window.location.href='../../feedback/index.php'">
                        <span>Feedback</span>
                    </button>
                    <span>OR</span>
                    <div class="qr-generated-code">
                        <span>Scan QR Code</span>
                        <div class="qr-document" id="qrDocument"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Popup Confirmations -->
        <div class="popup-confirmation-submit" id="confirmSubmit">
            <div class="popup-container-confirmation-submit">
                <div class="close-section">
                    <div class="close-section">
                        <a onclick="closePrompt()">&times;</a>
                    </div>
                    <div class="popup-text">
                        <span>Are you sure you want to submit this form?</span>
                    </div>
                    <div class="popup-action">
                        <button type="submit" class="yes" id="submitData">
                            <span>Yes</span>
                        </button>
                        <button class="no" onclick="closePrompt()"><span>No</span></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="popup-confirmation-exit" id="confirmCancel">
            <div class="popup-container-confirmation-exit">
                <div class="close-section">
                    <a onclick="closePrompt()">&times;</a>
                </div>
                <div class="popup-text">
                    <span>This action will cancel your application. Do you want to
                        continue?</span>
                </div>
                <div class="popup-action">
                    <button class="yes" onclick="gotoHome()"><span>Yes</span></button>
                    <button class="no" onclick="closePrompt()"><span>No</span></button>
                </div>
            </div>
        </div>
        <aside class="left-sidebar" id="sidebarPanel">
            <?php include '../../src/components/sidebar/sidebarDocument.php' ?>
        </aside>
        <nav class="navbar-container"><?php include '../../src/components/nav/navDocument.php' ?></nav>
        <main>
            <div class="page-container">
                <div class="form-wrapper">
                    <form class="registration-form" id="recordForm" method="POST" enctype="multipart/form-data"
                        action="../../src/scripts/pages/document/registerDocument.php">

                        <h1 class="form-title">REGISTRATION FORM</h1>

                        <h3 class="info-title">Personal Information:</h3>

                        <div class="form-grid">
                            <!-- Left Column -->
                            <div class="form-group left">
                                <label class="label-normal">Account Code<span style="color: red">*</span></label><input
                                    type="text" name="accountCode" id="accountCode" required />
                                <label class="label-normal">Last Name <span style="color: red">*</span></label><input
                                    type="text" name="lastName" id="lastName" required />
                                <label class="label-normal">First Name <span style="color: red">*</span></label><input
                                    type="text" name="firstName" id="firstName" required />
                                <label class="label-normal">Middle Name <span style="color: red">*</span></label><input
                                    type="text" name="middleName" id="middleName" required />
                                <label class="label-normal">Suffix <span class="italic-text">(If
                                        applicable)</span></label>
                                <input type="text" name="suffixName" id="suffixName" />

                                <label class="label-bold">Age <span style="color: red">*</span></label><input
                                    type="number" name="age" id="age" required />
                                <label class="label-bold">Sex <span style="color: red">*</span></label>
                                <div class="radio-group">
                                    <label class="label-bold"><input type="radio" name="sex" value="Male" required />
                                        Male</label>
                                    <label class="label-bold"><input type="radio" name="sex" value="Female" />
                                        Female</label>
                                </div>
                                <label class="label-bold">Address <span style="color: red">*</span></label><textarea
                                    name="address" id="address" rows="1" class="address-box" required></textarea>

                                <label class="label-bold">Barangay <span style="color: red">*</span></label><textarea
                                    name="barangay" id="barangay" rows="1" class="brgy-box" required></textarea>

                                <label class="label-bold">Municipal <span style="color: red">*</span></label><textarea
                                    name="municipal" id="country" rows="1" class="country-box" required></textarea>

                                <label class="label-bold">Province <span style="color: red">*</span></label><textarea
                                    name="province" id="province" rows="1" class="province-box" required></textarea>

                            </div>

                            <!-- Right Column -->
                            <div class="form-group right">
                                <label style="font-weight: bold">Date of Appeal/Appointment
                                    <span style="color: red">*</span></label>
                                <input type="date" name="documentDate" required />
                                <label style="font-weight: bold">Department <span style="color: red">*</span></label>
                                <input type="text" name="sector" id="sector" required readonly />

                                <label style="font-weight: bold">Type of Document <span
                                        style="color: red">*</span></label>
                                <select name="transactionType" id="transactionType" required></select>

                                <label style="font-weight: bold">Title of Document <span
                                        style="color: red">*</span></label>
                                <input type="text" name="documentTitle" id="documentTitle" required />

                                <label style="font-weight: bold">Upload Document <span
                                        style="color: red">*</span></label>
                                <div class="upload-box" id="uploadBox">
                                    <span class="material-icons-round">cloud_upload</span>
                                    <strong>Browse Files</strong>
                                    <p class="drag-text">Drag & Drop files here</p>
                                    <input type="file" name="documentFile" id="documentFile"
                                        accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" onchange="handleSingleFile(this)" />
                                </div>
                                <div class="uploadList" id="uploadList">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="register" value="1">
                        <div class="form-buttons">
                            <button type="button" class="submit-btn" onclick="popSubmitConfirm()">
                                <span class="material-icons-round">login</span> Submit
                            </button>
                            <button type="button" class="cancel-btn" onclick="popCancelConfirm()">
                                Cancel Application
                            </button>
                        </div>
                        <input type="hidden" name="docCode" value="<?php echo htmlspecialchars($docCode); ?>">
                    </form>
                </div>
            </div>
        </main>
        <footer class="footer-container"><?php include '../../src/components/footer/footerNoLogo.html' ?></footer>
    </div>
    <script>
        const uploadedFileName = <?php echo json_encode($uploadedFileName ?? null); ?>;

        if (uploadedFileName) {
            const preview = document.createElement("div");
            preview.innerHTML = `<img src="../../assets/icons/document-minus.svg" alt=""><span>${uploadedFileName}</span>`;
            document.getElementById("uploadList").appendChild(preview);
        }

    </script>
    <script src="../../src/scripts/pages/document/registerPage.js" defer></script>
    <script>
        window.submissionSuccess = <?php echo json_encode($_GET['success'] ?? null); ?>;
        window.docCode = <?php echo json_encode($_GET['code'] ?? null); ?>;
    </script>
    <script type="text/javascript" src="https://unpkg.com/qr-code-styling@1.5.0/lib/qr-code-styling.js"></script>
    <script src="../../src/scripts/components/nav.js"></script>
    <script src="../../src/scripts/components/sidebar.js"></script>
</body>

</html>