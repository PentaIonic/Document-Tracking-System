let sidebarMoved = false;

window.addEventListener("DOMContentLoaded", () => {
  if (window.innerWidth < 768) {
    setSidebarWidth("0");
    sidebarMoved = true;
  } else {
    setSidebarWidth("24em");
    sidebarMoved = false;
  }
});

// Don't attach toggleSidebar event here! It's injected later.

function moveSidebar() {
  const container = document.getElementById("container");
  if (!container) return;

  container.style.transition = "grid-template-columns 0.3s linear";

  if (!sidebarMoved) {
    setSidebarWidth("24em");
  } else {
    setSidebarWidth("0");
  }

  sidebarMoved = !sidebarMoved;
}

function setSidebarWidth(width) {
  document.documentElement.style.setProperty("--sidebar-width", width);
}

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
