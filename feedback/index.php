<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include __DIR__ . '/../src/scripts/components/database/connection.php';

    $rating = isset($_POST['rating']) ? intval($_POST['rating']) : null;
    $serviceFeedback = $_POST['service-feedback'] ?? '';
    $serviceSuggestion = $_POST['service-suggestion'] ?? '';
    $recommend = $_POST['recommend'] ?? '';

    if ($rating !== null && in_array($recommend, ['yes', 'no'])) {
        try {
            $stmt = $conn->prepare("
                INSERT INTO feedback_data 
                (rating, service_feedback, service_suggestion, recommendation) 
                VALUES (?, ?, ?, ?)
            ");
            $stmt->bind_param("isss", $rating, $serviceFeedback, $serviceSuggestion, $recommend);
            $stmt->execute();
            $stmt->close();

            // ✅ Now this works — no output before this
            header("Location: ../user/");
            exit();
        } catch (Exception $e) {
            die("MySQL Error: " . $e->getMessage());
        }
    }
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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet" />

    <!-- Local Styles -->
    <link rel="stylesheet" href="../src/styles/components/frame.css" />
    <link rel="stylesheet" href="../src/styles/components/nav/navIndex.css">
    <link rel="stylesheet" href="./style.css" />
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
                <div class="form-box">
                    <span class="close-btn" onclick="closeForm()">✕</span>

                    <div class="header">
                        <img src="../assets/images/vhslogo.png" alt="logo">
                        <h3>Feedback Form</h3>
                    </div>

                    <form class="feedback-form" action="index.php" method="post">
                        <label>How satisfied are you with our services?</label>
                        <div class="rating">
                            <input type="radio" name="rating" id="5" value="5" required><label for="5"></label>
                            <input type="radio" name="rating" id="4" value="4"><label for="4"></label>
                            <input type="radio" name="rating" id="3" value="3"><label for="3"></label>
                            <input type="radio" name="rating" id="2" value="2"><label for="2"></label>
                            <input type="radio" name="rating" id="1" value="1"><label for="1"></label>
                        </div>


                        <label for="like">What did you like about our service?</label>
                        <textarea name="service-feedback" id="like" rows="3"></textarea>

                        <label for="improve">What can we improve?</label>
                        <textarea name="service-suggestion" id="improve" rows="3"></textarea>

                        <label>Would you recommend us to others?</label>
                        <div class="radio-group">
                            <label><input type="radio" name="recommend" value="yes"> Yes</label>
                            <label><input type="radio" name="recommend" value="no"> No</label>
                        </div>

                        <button type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </main>
        <footer class="footer-container"><?php include '../src/components/footer/footerNoLogo.html' ?></footer>
    </div>
    <script src="./script.js"></script>
    <script src="../src/scripts/components/nav.js"></script>
</body>

</html>