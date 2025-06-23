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
    <link rel="stylesheet" href="../src/styles/pages/about/faq.css" />
    <link rel="stylesheet" href="../src/styles/components/footer/footer.css">

    <!-- Web Page Information -->
    <title>FAQs | Doctrax</title>
    <link rel="icon" href="../assets/images/Santa_Elena_Camarines_Norte.png" type="image/x-icon" />
</head>

<body>
    <div class="container">
        <nav class="navbar-container"><?php include '../src/components/nav/navServices.php' ?></nav>
        <main>
            <div class="page-container">
                <h1>Frequently Asked Questions</h1>
                <section class="faq-container">
                    <div class="faq-item">
                        <button class="faq-question active"><span class="icon">+</span>
                            How do I submit documents?
                        </button>
                        <div class="faq-answer hide">
                            <div class="faq-yellow-box">
                                <span> To submit your documents properly as a client or Non-Admin user:</span>
                                <ol>
                                    <li>Create an account &dash; Sign up and provide the required credentials.</li>
                                    <li>
                                        Log in to the DTS portal using your account.
                                        <ul>
                                            <li>Alternatively, click Track Doc to enter your Document ID or upload files
                                                anonymously.</li>
                                            <li>However, we recommend account creation to categorize your submission
                                                correctly.</li>
                                        </ul>
                                    </li>
                                    <li>Submit your documents &dash; Once logged in, use the submission feature.</li>
                                    <li>Fill in registration details &dash; You&rsquo;ll be redirected to complete
                                        required
                                        information.</li>
                                    <li>
                                        Confirmation pop-up &dash; After submission:
                                        <ul>
                                            <li>Download your submitted file, or</li>
                                            <li>Scan a QR code to access the file in real time.</li>
                                        </ul>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question"><span class="icon">+</span>
                            How long does it take to process documents?
                        </button>
                        <div class="faq-answer">
                            <p>Each department has a standard processing time, usually ranging from <strong>1 to 10
                                    working days</strong>,
                                depending on the document type and completeness of requirements.
                                </br>
                                </br>
                                Delays may occur due to incomplete requirements or verification procedures so make sure
                                everything is complete,
                                clear, and correct before submitting your documents.
                            </p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="faq-question"><span class="icon">+</span>How do I use the document tracker?
                        </button>
                        <div class="faq-answer">
                            <p>
                            <ol>
                                <li>Go to the Document Tracking System portal. This is possible after logging into your
                                    account or clicking the Track Doc button.
                                </li>
                                <br>
                                <li>Enter your Document ID in the search field or if you haven&rsquo;t submitted your
                                    document yet, upload your file/s in the tracking portal.</li>
                                <br>
                                <li>After being redirected to the tracking portal you&rsquo;ll be able to see and check
                                    the status of your document or cancel the application.</li>
                                <br>
                                <li>Click “Remarks” to view the current status.</li>
                                <br>
                                <li>You&rsquo;ll see the reference number, the evaluator handling your request,
                                    and the remarks regarding the document you submitted.</li>
                                <br>
                                <li>You&rsquo;ll also get notifications regarding updates and reminders, then an option
                                    to contact technical support in the tracking portal.</li>
                            </ol>
                            </p>
                        </div>
                    </div>
                </section>
            </div>
        </main>
        <footer class="footer-container"><?php include '../src/components/footer/footerNoLogo.html' ?></footer>
    </div>
    <script>
        document.querySelectorAll(".faq-question").forEach((btn) => {
            btn.addEventListener("click", () => {
                const isOpen = btn.classList.contains("active");

                // Close all
                document.querySelectorAll(".faq-question").forEach((b) => {
                    b.classList.remove("active");
                    b.querySelector(".icon").textContent = "+";
                });

                document.querySelectorAll(".faq-answer").forEach((ans) =>
                    ans.classList.remove("show")
                );

                // Open current if not already open
                if (!isOpen) {
                    btn.classList.add("active");
                    btn.querySelector(".icon").textContent = "−";
                    btn.nextElementSibling.classList.add("show");
                }
            });
        });
    </script>
    <script src="../src/scripts/components/nav.js"></script>
</body>

</html>