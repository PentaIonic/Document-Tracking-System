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

// Load Home Navigation Bar
function loadNavHome() {
  const xhr = new XMLHttpRequest();
  xhr.onload = function () {
    if (xhr.status === 200) {
      document.getElementById("navbar").innerHTML = xhr.responseText;
      setupSidebarToggle();
      insertDisplayName();
      insertRole();
    } else {
      console.error("Failed to load navigation bar:", xhr.status);
    }
  };
  xhr.open("GET", "../src/components/nav/navHome.html", true);
  xhr.send();
}

// Load Sector Navigation Bar
function loadNavSector() {
  const xhr = new XMLHttpRequest();
  xhr.onload = function () {
    if (xhr.status === 200) {
      document.getElementById("navbar").innerHTML = xhr.responseText;
      setupSidebarToggle();
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
    const nameSpanSidebar = document.getElementById("accountNameSidebar");
    if (nameSpan) {
      nameSpan.innerText = name;
      nameSpanSidebar.innerText = name;
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

// Toggle sidebar visibility
function setupSidebarToggle() {
  const toggleSidebar = document.getElementById("toggleSidebar");
  const sidebar = document.getElementById("sidebar");

  if (!toggleSidebar || !sidebar) return;

  toggleSidebar.addEventListener("click", function (e) {
    e.stopPropagation();
    sidebar.classList.toggle("open");
  });

  document.addEventListener("click", function (e) {
    if (
      sidebar.classList.contains("open") &&
      !sidebar.contains(e.target) &&
      !toggleSidebar.contains(e.target)
    ) {
      sidebar.classList.remove("open");
    }
  });
}
