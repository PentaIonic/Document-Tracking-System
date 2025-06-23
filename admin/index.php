<?php

session_start();


if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

$userName = (!isset($_SESSION['user_id']) || $_SESSION['user_id'] == null) ? "No Account" : $_SESSION['user_name'];
$role = (!isset($_SESSION['user_role']) || $_SESSION['user_role'] == null) ? "No Role" : $_SESSION['user_role'];

include '../src/scripts/components/database/connection.php';
$countRecord = [];
$sectors = [
    'HO' => ['name' => 'Health Office', 'alias' => 'health_office_count'],
    'CRO' => ['name' => 'Civil Registrar Office', 'alias' => 'civil_registrar_office_count'],
    'GSO' => ['name' => 'General Services Office', 'alias' => 'general_services_office_count'],
    'AGO' => ['name' => 'Agriculture Office', 'alias' => 'agricultural_office_count'],
    'ACO' => ['name' => 'Accounting Office', 'alias' => 'accounting_office_count'],
];

foreach ($sectors as $key => $sector) {
    $sql = "SELECT COUNT(*) as count FROM document_records WHERE sector = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $sector['name']);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $countRecord[$key] = $data['count']; // Store the actual count value
}

$documentRecords = [];
$sqlGetLogs = "
    SELECT 
        dr.last_name, 
        dr.first_name, 
        dr.middle_name, 
        dr.suffix_name, 
        dr.document_type, 
        dr.document_status, 
        pl.user, 
        pl.document_validation
    FROM document_records dr
    LEFT JOIN (
        SELECT pl1.*
        FROM process_logs pl1
        INNER JOIN (
            SELECT document_code, MAX(document_validation) AS max_date
            FROM process_logs
            GROUP BY document_code
        ) pl2 ON pl1.document_code = pl2.document_code AND pl1.document_validation = pl2.max_date
    ) pl ON dr.document_code = pl.document_code
";
$result = $conn->query($sqlGetLogs);
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $documentRecords[] = $row;
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
        href="https://fonts.googleapis.com/css2?family=Mate:ital@0;1&family=Montagu+Slab:opsz,wght@16..144,100..700&family=Rambla:ital,wght@0,400;0,700;1,400;1,700&family=Source+Serif+4:ital,opsz,wght@0,8..60,200..900;1,8..60,200..900&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet" />

    <!-- Local Styles -->
    <link rel="stylesheet" href="../src/styles/pages/admin/admin.css" />
    <link rel="stylesheet" href="../src/styles/components/nav/navAdmin.css" />
    <link rel="stylesheet" href="../src/styles/components/footer/footer.css" />
    <link rel="stylesheet" href="../src/styles/components/sidebar.css" />
    <link rel="stylesheet" href="../src/styles/components/frame-with-sidebar.css" />

    <!-- Web Page Information -->
    <title>Admin | Doctrax</title>
    <link rel="icon" href="../assets/images/Santa_Elena_Camarines_Norte.png" type="image/x-icon" />
</head>

<body>
    <div class="container" id="container">
        <aside class="left-sidebar" id="sidebarPanel"><?php include '../src/components/sidebar/sidebarAdmin.php' ?>
        </aside>
        <nav class="navbar-container"><?php include '../src/components/nav/navAdmin.php' ?></nav>
        <main>
            <!-- Dashboard Section -->
            <div class="dashboard-container">
                <div class="dashboard-header">
                    <div class="overview-upper">
                        <div class="dashboard-title">DASHBOARD</div>
                        <div class="user-profile">
                            <input type="text" class="search-bar" placeholder="Search" />
                            <div class="user-info">
                                <img src="../assets/icons/material-design-icons/account_circle_36dp_000000.svg"
                                    alt="User" />
                                <span id="dashboardLoggedName"><?php echo $userName; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="overview-lower">
                        <div class="dashboard-cards">
                            <div class="dashboard-card">
                                <div class="card-title">Municipal Health Office</div>
                                <span class="card-value"
                                    id="hoRecordValue"><?= htmlspecialchars($countRecord['HO'] ?? 'N/A') ?></span>
                            </div>
                            <div class="dashboard-card">
                                <div class="card-title">Civil Register Office</div>
                                <span class="card-value"
                                    id="croRecordValue"><?= htmlspecialchars($countRecord['CRO'] ?? 'N/A') ?></span>
                            </div>
                            <div class="dashboard-card">
                                <div class="card-title">General Services Office</div>
                                <span class="card-value" id="gsoRecordValue">
                                    <?= htmlspecialchars($countRecord['GSO'] ?? 'N/A') ?></span>
                            </div>
                            <div class="dashboard-card">
                                <div class="card-title">Agricultural Office</div>
                                <span class="card-value"
                                    id="agoRecordValue"><?= htmlspecialchars($countRecord['AGO'] ?? 'N/A') ?></span>
                            </div>
                            <div class="dashboard-card">
                                <div class="card-title">Agricultural Office</div>
                                <span class="card-value"
                                    id="acoRecordValue"><?= htmlspecialchars($countRecord['ACO'] ?? 'N/A') ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Process Documents Table -->
                <div class="documents-section">
                    <h3>Process Documents</h3>
                    <table class="documents-table" id="showLogs">
                        <thead>
                            <tr>
                                <th>PEOPLE</th>
                                <th>REQUEST</th>
                                <th>STATUS</th>
                                <th>HANDLED</th>
                                <th>DATE PROCESSED</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($documentRecords as $record): ?>
                                <tr>
                                    <td>
                                        <?= htmlspecialchars($record['last_name'] . ', ' . $record['first_name'] . ' ' . $record['middle_name'] . ' ' . $record['suffix_name']) ?>
                                    </td>
                                    <td><?= htmlspecialchars($record['document_type']) ?></td>
                                    <td><?= htmlspecialchars($record['document_status']) ?></td>
                                    <td><?= htmlspecialchars($record['user'] ?? '—') ?></td>
                                    <td><?= htmlspecialchars($record['document_validation'] ?? '—') ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if (empty($documentRecords)): ?>
                                <tr>
                                    <td colspan="5" style="text-align:center;">No records found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
        <footer class="footer-container"><?php include '../src/components/footer/footerNoLogo.html' ?></footer>
    </div>
    <script src="../src/scripts/components/nav.js"></script>
    <script src="../src/scripts/components/sidebar.js"></script>
</body>

</html>