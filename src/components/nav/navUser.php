<div class="logo-area">
    <img src="../assets/images/Santa_Elena_Camarines_Norte.png" alt="Logo" />
    <a href="../index.php">Santa Elena Doctrax</a>
</div>
<div class="nav-action-buttons">
    <div style="display: flex; flex-direction: row; gap: 10px">
        <span><?php echo "Welcome! " . $userName; ?></span>
        <img src="../assets/icons/material-design-icons/account_circle_36dp_000000.svg" alt="Account" />
    </div>
    <button type="button" id="toggleNotification">
        <img src="../assets/icons/material-design-icons/notifications_24dp_000000.svg" alt="Notification" />
    </button>
    <div class="notification-window" id="notificationWindow">
        <?php include __DIR__ . '/../../modules/notifications/notification.php'; ?>
    </div>
    <button type="button" id="toggleMenu">
        <img src="../assets/icons/menu-hamburger.svg" alt="Menu" />
    </button>
    <div class="menu-window" id="menu">
        <div class="menu">
            <div class="menu-header">
                <div class="hero-menu">
                    <img src="../assets/icons/material-design-icons/account_circle_36dp_000000.svg" alt="" />
                </div>
                <div class="info-menu">
                    <span><?php echo $userName; ?></span>
                    <span><?php echo $role; ?></span>
                </div>
            </div>
            <div class="menu-options">
                <?php
                switch ($role) {
                    case 'Super Admin':
                        echo '                
                            <button type="button" class="option-button" onclick="location.href=\'../admin/\'">
                            <img src="../assets/icons/material-design-icons/dashboard_24dp_000000.svg" alt="" />
                            <span>Dashboard</span>
                            </button>';
                        break;
                    default:
                        echo '';
                        break;
                }
                ?>
                <button type="button" class="option-button" onclick="window.location.href='../user'">
                    <img src="../assets/icons/material-design-icons/home_24dp_000000.svg" alt="" />
                    <span>Home</span>
                </button>
                <button type="button" class="option-button" onclick="">
                    <img src="../assets/icons/material-design-icons/support_agent_24dp_000000.svg" alt="" />
                    <span>Technical Support</span>
                </button>
                <button type="button" class="option-button"
                    onclick="window.location.href=' ../src/scripts/components/actions/logout.php'">
                    <img src="../assets/icons/material-design-icons/logout_24dp_000000.svg" alt="" />
                    <span>Logout</span>
                </button>
            </div>
        </div>
    </div>
</div>