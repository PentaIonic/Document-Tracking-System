<?php

session_start();
include '../../components/database/connection.php';

if (isset($_POST['register'])) {
    // Get form inputs
    $lastName = $_POST['lastName'];
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $suffixName = $_POST['suffixName'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $barangay = $_POST['barangay'] ?? '';
    $address = $_POST['address'];
    $documentDate = $_POST['documentDate'];
    $sector = $_POST['sector'];
    $documentType = $_POST['transactionType'];
    $documentTitle = $_POST['documentTitle'];

    // Handle file upload
    $targetDirectory = "../../../uploads/";
    $fileName = basename($_FILES["documentFile"]["name"]);
    $filePath = $targetDirectory . uniqid() . "_" . $fileName;

    if (move_uploaded_file($_FILES["documentFile"]["tmp_name"], $filePath)) {
        // Save to database
        $stmt = $conn->prepare("INSERT INTO document_records (document_registered, last_name, first_name, middle_name, suffix_name, age, sex, barangay, address, sector, document_type, document_title, document_url, document_status, document_code, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Prepare parameters for binding
        $documentRegistered = date('Y-m-d H:i:s');
        $documentStatus = 'Pending';
        $documentCode = generateDocumentCode($sector);
        $userId = $_SESSION['user_id'] ?? null;

        $stmt->bind_param(
            "ssssisssssssssss",
            $documentRegistered,
            $lastName,
            $firstName,
            $middleName,
            $suffixName,
            $age,
            $sex,
            $barangay,
            $address,
            $sector,
            $documentType,
            $documentTitle,
            $filePath,
            $documentStatus,
            $documentCode,
            $userId
        );

        if ($stmt->execute()) {
            exit();
        } else {
            echo "Error saving to database: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "File upload failed.";
    }

    $qrCode = ['depCode' => $documentCode];

    $conn->close();
}

  function generateDocumentCode($department) {
    $year = date("Y");
    $month = date("m");
    $day = date("d");

    $depCode = "";
    switch ($department) {
      case "health-office":
        $depCode = "HO";
        break;
      case "civil-registrar-office":
        $depCode = "CRO";
        break;
      case "gen-service-office":
        $depCode = "GSO";
        break;
      case "agricultural-office":
        $depCode = "AGO";
        break;
      case "accounting-office":
        $depCode = "ACO";
        break;
    }

    $endCode = str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
    return `$depCode-$year$month$day-$endCode`;
  }

?>