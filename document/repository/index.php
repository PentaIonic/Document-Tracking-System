<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../index.php");
    exit();
}

include '../../src/scripts/components/database/connection.php';
$userName = (!isset($_SESSION['user_id']) || $_SESSION['user_id'] == null) ? "No Account" : $_SESSION['user_name'];
$role = (!isset($_SESSION['user_role']) || $_SESSION['user_role'] == null) ? "No Role" : $_SESSION['user_role'];

$allowedSortFields = ['document_id', 'sector', 'document_status'];
$sort = $_GET['sort'] ?? 'document_id';
$sort = in_array($sort, $allowedSortFields) ? $sort : 'document_id';

$search = $_GET['search'] ?? '';
$userId = $_SESSION['user_id'];

if (!empty($search)) {
    $sqlSearchQuery = "SELECT * FROM document_records 
                       WHERE document_code LIKE ? 
                          OR sector LIKE ? 
                          OR document_status LIKE ?
                       ORDER BY $sort";
    $stmt = $conn->prepare($sqlSearchQuery);

    if ($stmt) {
        $searchTerm = "%{$search}%";
        $stmt->bind_param("sss", $searchTerm, $searchTerm, $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        $result = false;
    }
} else {
    $sqlSearchQuery = "SELECT * FROM document_records ORDER BY $sort";
    $stmt = $conn->prepare($sqlSearchQuery);

    if ($stmt) {
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        $result = false;
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
    <link rel="stylesheet" href="../../src/styles/pages/document/repository.css" />
    <link rel="stylesheet" href="../../src/styles/components/nav/navAdmin.css" />
    <link rel="stylesheet" href="../../src/styles/components/footer/footer.css" />
    <link rel="stylesheet" href="../../src/styles/components/sidebar.css" />
    <link rel="stylesheet" href="../../src/styles/components/frame-with-sidebar.css" />

    <!-- Web Page Information -->
    <title>Repository | Doctrax</title>
    <link rel="icon" href="../../assets/images/Santa_Elena_Camarines_Norte.png" type="image/x-icon" />
</head>

<body>
    <div class="container">
        <aside class="left-sidebar" id="sidebarPanel"><?php include '../../src/components/sidebar/sidebarDocument.php' ?>
        </aside>
        <nav class="navbar-container"><?php include '../../src/components/nav/navDocument.php' ?></nav>
        <main>
            <div class="page-container">
                <div class="results-header">
                    <span>Results</span>
                    <form method="GET" id="searchForm" class="action-header">
                        <div class="search-bar">
                            <input type="search" name="search" id="search"
                                value="<?= htmlspecialchars($_GET['search'] ?? '', ENT_QUOTES) ?>" />
                            <button type="submit">
                                <div class="search-icon">
                                    <span class="material-icons-round"> search </span>
                                </div>
                            </button>
                        </div>
                        <div class="filter-dropdown">
                            <select id="sortCriteria" name="sort">
                                <option value="document_id" <?= ($_GET['sort'] ?? '') === 'document_id' ? 'selected' : '' ?>>Sort by Document ID</option>
                                <option value="sector" <?= ($_GET['sort'] ?? '') === 'sector' ? 'selected' : '' ?>>Sort by
                                    Department</option>
                                <option value="document_status" <?= ($_GET['sort'] ?? '') === 'document_status' ? 'selected' : '' ?>>Sort by Status</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="filters"></div>
                <div class="document-results">
                    <div class="horz-scroll">
                        <table id="documentDatabase" class="document-list">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Document No.</th>
                                    <th>Department</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result && $result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $docId = htmlspecialchars($row['document_id']);
                                        $code = htmlspecialchars($row['document_code'], ENT_QUOTES);
                                        $sector = htmlspecialchars($row['sector']);
                                        $status = htmlspecialchars($row['document_status']);
                                        $urlCode = urlencode($row['document_code']);

                                        echo "<tr>
                                        <td>{$docId}</td>
                                        <td>{$code}</td>
                                        <td>{$sector}</td>
                                        <td>{$status}</td>
                                        <td><input type='button' value='View' onclick='window.location.href=\"../track/index.php?code={$urlCode}\"'></td>
                                        </tr>";
                                    }
                                } else {
                                    echo '<tr><td colspan="5" style="text-align:center;" class="noDataRow"><span>No Data Available</span></td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
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
    <script type="text/javascript" src="https://unpkg.com/qr-code-styling@1.5.0/lib/qr-code-styling.js"></script>
    <script src="../../src/scripts/components/nav.js"></script>
    <script src="../../src/scripts/components/sidebar.js"></script>
</body>

</html>