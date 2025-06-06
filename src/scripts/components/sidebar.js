let sidebarMoved = false;

// Toggle the sidebar
function moveSidebar() {
  const container = document.querySelector(".container");
  if (!container) return;

  container.style.transition = "grid-template-columns 0.3s linear";

  if (!sidebarMoved) {
    setSidebarWidth("24em");
  } else {
    setSidebarWidth("0");
  }

  sidebarMoved = !sidebarMoved;
}

// Set CSS variable --sidebar-width
function setSidebarWidth(width) {
  document.documentElement.style.setProperty("--sidebar-width", width);
}

// Load sidebar content for content pages
function loadSidebarAdmin() {
  const xhr = new XMLHttpRequest();
  xhr.onload = function () {
    if (xhr.status === 200) {
      document.getElementById("sidebarPanel").innerHTML = xhr.responseText;
      insertDisplayName();
      insertRole();
    } else {
      console.error("Failed to load sidebar:", xhr.status);
    }
  };
  xhr.open("GET", "../src/components/sidebar.html", true);
  xhr.send();
}

// Toggle menu & notification visibility
function setupMenuToggle() {
  const toggleMenu = document.getElementById("toggleMenu");
  const menu = document.getElementById("menu");
  const notificationWindow = document.getElementById("notificationWindow");

  if (!toggleMenu || !menu) return;

  toggleMenu.addEventListener("click", function (e) {
    e.stopPropagation();
    menu.classList.toggle("open");
    notificationWindow.classList.remove("open");
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
