let sidebarMoved = false;

// Toggle the sidebar
function moveSidebar() {
  const container = document.querySelector(".container");
  if (!container) return;

  container.style.transition = "grid-template-columns 0.3s linear";

  if (!sidebarMoved) {
    setSidebarWidth("16em");
  } else {
    setSidebarWidth("0");
  }

  sidebarMoved = !sidebarMoved;
}

// Set CSS variable --sidebar-width
function setSidebarWidth(width) {
  document.documentElement.style.setProperty('--sidebar-width', width);
}

// Load sidebar content for portal page
function loadSidebarIndex() {
  const xhr = new XMLHttpRequest();
  xhr.onload = function () {
    if (xhr.status === 200) {
      document.getElementById("sidebarPanel").innerHTML = xhr.responseText;
    } else {
      console.error("Failed to load sidebar:", xhr.status);
    }
  };
  xhr.open("GET", "./components/sidebar.html", true);
  xhr.send();
}

// Load sidebar content for content pages
function loadSidebarPageContent() {
  const xhr = new XMLHttpRequest();
  xhr.onload = function () {
    if (xhr.status === 200) {
      document.getElementById("sidebarPanel").innerHTML = xhr.responseText;
    } else {
      console.error("Failed to load sidebar:", xhr.status);
    }
  };
  xhr.open("GET", "../src/components/sidebar.html", true);
  xhr.send();
}
