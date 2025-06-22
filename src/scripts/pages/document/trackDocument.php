<?php
session_start();
include '../../components/database/connection.php';

if (isset($_POST['log'])) {
    $referenceNumber = generateReferenceNumber($_POST['sector']);
    $status = $_POST['setStatus'] ?? '';
    $remarks = $_POST['documentRemarks'] ?? '';
    $description = $_POST['remarkDescription'] ?? '';
    $evaluator = $_SESSION['user_name'] ?? 'Unknown';
    $documentCode = $_POST['code'] ?? '';
    $documentValidated = date('Y-m-d H:i:s');

    if (!$documentCode || !$status) {
        die("Missing required form data.");
    }

    // Use actual column name from your DB: 'document_status' (or change if using 'status')
    $sql = "INSERT INTO process_logs (reference_num, user, document_code, document_status, document_remarks, remark_description) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $referenceNumber, $evaluator, $documentCode, $status, $remarks, $description);

    if ($stmt->execute()) {
        // Optional: update document status in main table
        $updateDoc = $conn->prepare("UPDATE document_records SET document_status = ? WHERE document_code = ?");
        $updateDoc->bind_param("ss", $status, $documentCode);
        $updateDoc->execute();

        $updateDoc = $conn->prepare("UPDATE document_records SET document_validation = ? WHERE document_code = ?");
        $updateDoc->bind_param("ss", $documentValidated, $documentCode);
        $updateDoc->execute();

        header("Location: ../../../../document/track/index.php?code=" . urlencode($documentCode));
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}

if (isset($_POST['delete'])) {
    $documentCode = $_POST['delete'] ?? '';

    $sqlDeleteRecord = "DELETE FROM document_records WHERE document_code = ?";
    $stmt = $conn->prepare($sqlDeleteRecord);
    $stmt->bind_param("s", $documentCode);
    $stmt->execute();
    header("Location: ../../../../document/repository/");
    exit();
}

function generateReferenceNumber($department)
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

    $endCode = str_pad(rand(1, 999999999), 9, '0', STR_PAD_LEFT);
    return "{$depCode}-{$year}{$month}{$day}-{$endCode}";
}
?>