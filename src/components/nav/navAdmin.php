<button type="button" id="toggleSidebar" onclick="moveSidebar()">
    <img src="../assets/icons/menu-hamburger.svg" alt="Menu" />
</button>
<div class="nav-action-buttons">
    <div style="display: flex; flex-direction: row; gap: 10px">
        <span id="accountName"><?php echo "Welcome! " . $userName; ?></span>
        <img src="../assets/icons/material-design-icons/account_circle_36dp_000000.svg" alt="Account" />
    </div>
    <button type="button" id="toggleNotification">
        <img src="../assets/icons/material-design-icons/notifications_24dp_000000.svg" alt="Notification" />
    </button>
    <div class="notification-window" id="notificationWindow">
        <div class="notification-container" id="notificationList">
            <div class="notification-container" id="notificationList">
                <?php
                // Reuse $result from your previous query
                $hasNotification = false;

                // Loop through results again or fetch if not already done
                $stmt->execute();
                $result = $stmt->get_result();

                while ($row = $result->fetch_assoc()) {
                    $status = strtolower($row['document_status'] ?? ''); // Safe fallback
                    $title = htmlspecialchars($row['document_title'] ?? 'Untitled');
                    $code = htmlspecialchars($row['document_code'] ?? '');
                    $date = htmlspecialchars($row['document_registered'] ?? '');

                    if (in_array($status, ['due', 'approved', 'rejected'])) {
                        $hasNotification = true;
                        echo "
        <div class='notification-item'>
            <strong>{$title}</strong><br>
            Status: <span style='text-transform: capitalize;'>{$status}</span><br>
            Code: {$code}<br>
            Date: {$date}
        </div>
        ";
                    }
                }


                if (!$hasNotification) {
                    echo "
        <div class='notification-item' style='width: 100%; text-align: center'>
            <span>Nothing follows...</span>
        </div>
        ";
                }
                ?>
            </div>
        </div>
    </div>
</div>