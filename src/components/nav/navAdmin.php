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
        <?php include __DIR__ . '/../../modules/notifications/notification.php'; ?>
    </div>
</div>