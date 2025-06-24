<div class="logo-area">
  <img src="./assets/images/Santa_Elena_Camarines_Norte.png" alt="Logo" />
  <a href="./index.php">Santa Elena Doctrax</a>
</div>
<div class="nav-tabs">
  <?php
  if (!isset($_SESSION['user_id'])) {
    echo '
    <a href="./portal/login.php">
    <div class="action-buttons">
      <span>Log In</span>
    </div>
    </a>
    <a href="./portal/signup.php">
    <div class="action-buttons">
      <span>Sign Up</span>
    </div>
    </a>';
  } else {
    echo '
    <a href="./user/">
    <div class="action-buttons">
      <span>Home</span>
    </div>
    </a>
    ';
  }
  ?>
  <a href="./user/faq.php">
    <div class="action-buttons">
      <span>FAQs</span>
    </div>
  </a>
  <a href="./user/health-office-directory.php">
    <div class="action-buttons"><span>Services</span></div>
  </a>
</div>
<div class="nav-action-buttons">
  <a id="toggleMenu">
    <div class="menu-button">
      <img src="./assets/icons/menu-hamburger.svg" alt="Button Menu" />
    </div>
  </a>
  <div class="menu-window" id="menu">
    <?php
    if (!isset($_SESSION['user_id'])) {
      echo '    
      <a href="./portal/login.php"><span>Log In</span></a>
      <a href="./portal/signup.php"><span>Sign Up</span></a>
      ';
    } else {
      echo '
      <a href="./user/"><span>Home</span></a>
    ';
    }
    ?>
    <a href="./user/faq.php"><span>FAQs</span></a>
    <a href="./user/health-office-directory.php"><span>Services</span></a>
  </div>
</div>