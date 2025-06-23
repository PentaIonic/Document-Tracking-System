<?php

session_start();
include '../../components/database/connection.php';

$docCode = $_POST['docCode'] ?? null;
$uploadedFileName = null;

if ($docCode) {
  $stmt = $conn->prepare("SELECT document_title, document_url FROM document_records WHERE document_code = ?");
  $stmt->bind_param("s", $docCode);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($row = $result->fetch_assoc()) {
    $uploadedFileName = basename($row['document_url']);
  }
}

if (isset($_POST['register'])) {
  // Get form inputs
  $lastName = $_POST['lastName'];
  $firstName = $_POST['firstName'];
  $middleName = $_POST['middleName'];
  $suffixName = $_POST['suffixName'];
  $age = $_POST['age'];
  $sex = $_POST['sex'];
  $address = $_POST['address'];
  $barangay = $_POST['barangay']; // fixed name mismatch
  $province = $_POST['province'];
  $municipal = $_POST['municipal'];
  $documentDate = $_POST['documentDate'];
  $sector = $_POST['sector'];
  $documentType = $_POST['transactionType'];
  $documentTitle = $_POST['documentTitle'];

  if (!validateAge($age)) {
    die("Invalid age provided.");
  }

  // File upload handling
// File upload handling
  $targetDirectory = "../../../../uploads/";
  $targetBackupDirectory = "../../../../backup/";
  $originalFileName = basename($_FILES["documentFile"]["name"]);
  $uniqueFileName = uniqid() . "_" . preg_replace("/[^a-zA-Z0-9\._-]/", "_", $originalFileName);
  $filePath = $targetDirectory . $uniqueFileName;

  // File type validation
  $allowedTypes = [
    'application/pdf',
    'application/msword',
    'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
  ];
  if (!in_array($_FILES["documentFile"]["type"], $allowedTypes)) {
    die("Invalid file type. Only PDF and DOC/DOCX are allowed.");
  }

  if (move_uploaded_file($_FILES["documentFile"]["tmp_name"], $filePath)) {
    // Backup file
    copy($filePath, $targetBackupDirectory . $uniqueFileName);

    // Save to DB
    $stmt = $conn->prepare("INSERT INTO document_records (
            document_registered,
            last_name,
            first_name,
            middle_name,
            suffix_name,
            age,
            sex,
            barangay,
            address,
            municipal,
            province,
            sector,
            document_type,
            document_title,
            document_url,
            document_status,
            document_code,
            account_code
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $documentRegistered = date('Y-m-d H:i:s');
    $documentStatus = 'Pending';
    $documentCode = generateDocumentCode($sector);
    $accountCode = $_SESSION['user_code'] ?? null;
    $storedFilePath = 'uploads/' . $uniqueFileName; // relative path

    $stmt->bind_param(
      "sssssisssssssssssi",
      $documentRegistered,
      $lastName,
      $firstName,
      $middleName,
      $suffixName,
      $age,
      $sex,
      $barangay,
      $address,
      $municipal,
      $province,
      $sector,
      $documentType,
      $documentTitle,
      $storedFilePath,
      $documentStatus,
      $documentCode,
      $accountCode
    );

    if ($stmt->execute()) {
      header("Location: ../../../../document/register/index.php?code=" . urlencode($documentCode) . "&success=1");
      exit();
    } else {
      echo "Error saving to database: " . $stmt->error;
    }

    $stmt->close();
  } else {
    echo "File upload failed. Error Code: " . $_FILES["documentFile"]["error"];
  }

  $conn->close();
}

function validateAge($age)
{
  return ($age > 0 && $age <= 150);
}

function generateDocumentCode($department)
{
  $year = date("Y");
  $month = date("m");
  $day = date("d");

  $depCode = match ($department) {
    "Municipal Health Office" => "HO",
    "Civil Registrar Office" => "CRO",
    "General Services Office" => "GSO",
    "Agriculture Office" => "AGO",
    "Accounting Office" => "ACO",
    default => "UNK"
  };

  $endCode = str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
  return "{$depCode}-{$year}{$month}{$day}-{$endCode}";
}

?>