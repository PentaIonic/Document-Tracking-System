let sidebarMoved = false;

window.addEventListener("DOMContentLoaded", () => {
  if (window.innerWidth < 768) {
    setSidebarWidth("0");
    setSidebarOpacity("0");
    sidebarMoved = true;
  } else {
    setSidebarWidth("16em");
    setSidebarOpacity("1");
    sidebarMoved = false;
  }
  /*
  const toggleSidebar = document.getElementById("toggleSidebar");
  if (toggleSidebar) {
    toggleSidebar.addEventListener("click", moveSidebar);
  }
    */
  // Do not warn if not found; it's expected on some pages.
});

// Don't attach toggleSidebar event here! It's injected later.

function moveSidebar() {
  const container = document.getElementById("container");
  if (!container) return;

  container.style.transition = "grid-template-columns 0.3s linear";

  if (!sidebarMoved) {
    setSidebarWidth("16em");
    setSidebarOpacity("1");
  } else {
    setSidebarWidth("0");
    setSidebarOpacity("0");
  }

  console.log(
    "Sidebar moved:",
    sidebarMoved,
    "Width:",
    getComputedStyle(document.documentElement).getPropertyValue(
      "--sidebar-width"
    )
  );

  sidebarMoved = !sidebarMoved;
}

function setSidebarWidth(width) {
  document.documentElement.style.setProperty("--sidebar-width", width);
}

function setSidebarOpacity(opacity) {
  document.documentElement.style.setProperty("--sidebar-opacity", opacity);
}
