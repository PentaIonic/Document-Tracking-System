<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$userName = $_SESSION['user_name'] ?? 'No Account';
$accountCode = $_SESSION['user_code'] ?? null;

$notifications = [];

if ($accountCode) {
    if (!isset($conn)) {
        include __DIR__ . '/../../scripts/components/database/connection.php';
    }

    $sql = "SELECT document_code, document_title, document_status, document_registered
            FROM document_records
            WHERE account_code = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $accountCode);
    $stmt->execute();
    $result = $stmt->get_result();
    $notification = $result;

    $today = new DateTime();

    while ($row = $notification->fetch_assoc()) {
        $status = strtolower($row['document_status'] ?? '');
        $title = htmlspecialchars($row['document_title'] ?? 'Untitled');
        $code = htmlspecialchars($row['document_code'] ?? '');
        $dateRaw = $row['document_registered'] ?? '';
        $date = htmlspecialchars($dateRaw);

        // Compute days between today and registration date
        $docDate = new DateTime($dateRaw);
        $daysOld = $docDate->diff($today)->days;

        // If status is due, approved, rejected OR the date is 2+ days old = "due"
        if (in_array($status, ['approved', 'rejected']) || $daysOld >= 2) {
            $notifications[] = [
                'title' => $title,
                'code' => $code,
                'date' => $date,
                'status' => $status === '' && $daysOld >= 2 ? 'due' : $status
            ];
        }
    }
}
?>

<div class="notification-container" id="notificationList">
    <?php if (!empty($notifications)): ?>
        <?php foreach ($notifications as $note): ?>
            <div class="notification-item">
                <strong><?= $note['title'] ?></strong><br>
                Status: <span style="text-transform: capitalize;"><?= $note['status'] ?></span><br>
                Code: <?= $note['code'] ?><br>
                Date: <?= $note['date'] ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="notification-item" style="width: 100%; text-align: center">
            <span>Nothing follows...</span>
        </div>
    <?php endif; ?>
</div>