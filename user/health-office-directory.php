<?php

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
        href="https://fonts.googleapis.com/css2?family=Mate:ital@0;1&family=Rambla:ital,wght@0,400;0,700;1,400;1,700&family=Source+Serif+4:ital,opsz,wght@0,8..60,200..900;1,8..60,200..900&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet" />

    <!-- Local Styles -->
    <link rel="stylesheet" href="../src/styles/components/frame.css" />
    <link rel="stylesheet" href="../src/styles/components/nav/navIndex.css">
    <link rel="stylesheet" href="../src/styles/pages/search/directory.css" />
    <link rel="stylesheet" href="../src/styles/components/footer/footer.css">

    <!-- Web Page Information -->
    <title>Services | Doctrax</title>
    <link rel="icon" href="../assets/images/Santa_Elena_Camarines_Norte.png" type="image/x-icon" />
</head>

<body>
    <div class="container">
        <nav class="navbar-container"><?php include '../src/components/nav/navServices.php' ?></nav>
        <main>
            <div class="page-container">
                <aside class="sidebar">
                    <div class="departments">DEPARTMENTS</div>
                    <ul>
                        <li class="active"><a href="./health-office-directory.php">🏥 Municipal Health Office</a></li>
                        <li><a href="./civil-registrar-office-directory.php">📜 Civil Registrar Office</a></li>
                        <li><a href="./agricultural-office-directory.php">🌾 Agricultural Office</a></li>
                        <li><a href="./general-services-office-directory.php">🛠️ General Services Office</a></li>
                        <li><a href="./accounting-office-directory.php">💼 Accounting Office</a></li>
                    </ul>
                </aside>

                <section class="document-directory">
                    <h2>DOCUMENT SERVICES DIRECTORY</h2>
                    <h3>Municipal Health Office</h3>

                    <table>
                        <thead>
                            <tr>
                                <th>Document Type</th>
                                <th>Requirements</th>
                                <th>Processing Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Health Certificate</td>
                                <td>1 Valid ID, Medical Check-up, Barangay Clearance</td>
                                <td>1–2 Working Days</td>
                            </tr>
                            <tr>
                                <td>Medical Certificate</td>
                                <td>1 Valid ID, Doctor's Check-up, Application Form</td>
                                <td>1–2 Working Days</td>
                            </tr>
                            <tr>
                                <td>Sanitary Permit</td>
                                <td>1 Valid ID, Filled Sanitary Form, Inspection Approval</td>
                                <td>3–5 Working Days</td>
                            </tr>
                            <tr>
                                <td>Immunization Record</td>
                                <td>Valid ID, Immunization Card, Consent Form (for minors)</td>
                                <td>Same Day</td>
                            </tr>
                            <tr>
                                <td>Pre-Natal Record</td>
                                <td>Valid ID, Initial Check-up Result, Maternity Booklet</td>
                                <td>1–2 Working Days</td>
                            </tr>
                            <tr>
                                <td>Hospital Referral Form</td>
                                <td>Valid ID, Referral Slip, Medical Summary</td>
                                <td>Same Day</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="process-flow">
                        <h2>HOW TO PROCESS YOUR DOCUMENT</h2>
                        <div class="steps">
                            <div class="step"><span>1</span><br>Select Transaction</div>
                            <div class="step"><span>2</span><br>Fill out Form</div>
                            <div class="step"><span>3</span><br>Upload Requirements</div>
                            <div class="step"><span>4</span><br>Wait for Approval</div>
                        </div>
                    </div>
                </section>
            </div>
        </main>
        <footer class="footer-container"><?php include '../src/components/footer/footerNoLogo.html' ?></footer>
    </div>
    <script src="../src/scripts/components/nav.js"></script>
</body>

</html>