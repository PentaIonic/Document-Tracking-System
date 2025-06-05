// Load Document's Navigation Bar
function loadNavDocument() {
  const xhr = new XMLHttpRequest();
  xhr.onload = function () {
    if (xhr.status === 200) {
      document.getElementById("navbar").innerHTML = xhr.responseText;
      setupMenuToggle();
      setupNotificationWindow();
      insertDisplayName();
      insertRole();
    } else {
      console.error("Failed to load navigation bar:", xhr.status);
    }
  };
  xhr.open("GET", "../src/components/nav/navDocument.html", true);
  xhr.send();
}


// Function for loading page's Navigation Bar
function loadNavIndex() {
  const xhr = new XMLHttpRequest();
  xhr.onload = function () {
    if (xhr.status === 200) {
      document.getElementById("navbar").innerHTML = xhr.responseText;
      setupSidebarToggle();
    } else {
      console.error("Failed to load navigation bar:", xhr.status);
    }
  };
  xhr.open("GET", "../src/components/nav/navIndex.html", true);
  xhr.send();
}

// Load Home's Navigation Bar
function loadNavHome() {
  const xhr = new XMLHttpRequest();
  xhr.onload = function () {
    if (xhr.status === 200) {
      document.getElementById("navbar").innerHTML = xhr.responseText;
      setupMenuToggle();
      setupNotificationWindow();
      insertDisplayName();
      insertRole();
    } else {
      console.error("Failed to load navigation bar:", xhr.status);
    }
  };
  xhr.open("GET", "../src/components/nav/navHome.html", true);
  xhr.send();
}

// Load Sectors' Navigation Bar
function loadNavSector() {
  const xhr = new XMLHttpRequest();
  xhr.onload = function () {
    if (xhr.status === 200) {
      document.getElementById("navbar").innerHTML = xhr.responseText;
      setupMenuToggle();
      setupNotificationWindow();
      insertDisplayName();
      insertRole();
    } else {
      console.error("Failed to load navigation bar:", xhr.status);
    }
  };
  xhr.open("GET", "../src/components/nav/navSectors.html", true);
  xhr.send();
}

// Load Sector Navigation Bar
function loadNavSearch() {
  const xhr = new XMLHttpRequest();
  xhr.onload = function () {
    if (xhr.status === 200) {
      document.getElementById("navbar").innerHTML = xhr.responseText;
      setupSidebarToggle();
    } else {
      console.error("Failed to load navigation bar:", xhr.status);
    }
  };
  xhr.open("GET", "../src/components/nav/navSearch.html", true);
  xhr.send();
}

// Get account's display name
function insertDisplayName() {
  const name = localStorage.getItem("displayName");
  if (name) {
    const nameSpan = document.getElementById("accountName");
    const nameSpanMenu = document.getElementById("accountNameMenu");
    if (nameSpan) {
      nameSpan.innerText = name;
      nameSpanMenu.innerText = name;
    }
  }
}

function insertRole() {
  const role = localStorage.getItem("role");
  if (role) {
    const roleSpan = document.getElementById("accountRole");
    if (roleSpan) {
      roleSpan.innerText = role;
    }
  }
}

// Toggle menu & notification visibility
function setupMenuToggle() {
  const toggleMenu = document.getElementById("toggleMenu");
  const menu = document.getElementById("menu");

  if (!toggleMenu || !menu) return;

  toggleMenu.addEventListener("click", function (e) {
    e.stopPropagation();
    menu.classList.toggle("open");
  });

  document.addEventListener("click", function (e) {
    if (
      menu.classList.contains("open") &&
      !menu.contains(e.target) &&
      !toggleMenu.contains(e.target)
    ) {
      menu.classList.remove("open");
    }
  });
}

function setupNotificationWindow() {
  const toggleNotification = document.getElementById("toggleNotification");
  const notificationWindow = document.getElementById("notificationWindow");

  if (!toggleNotification || !notificationWindow) return;

  toggleNotification.addEventListener("click", function (e) {
    e.stopPropagation();
    notificationWindow.classList.toggle("open")
  });

  document.addEventListener("click", function (e) {
    if (
      notificationWindow.classList.contains("open") &&
      !notificationWindow.contains(e.target) &&
      !toggleNotification.contains(e.target)
    ) {
      notificationWindow.classList.remove("open");
    }
  });
}

function gotoHome() {
  window.location.href = "../index.html";
}