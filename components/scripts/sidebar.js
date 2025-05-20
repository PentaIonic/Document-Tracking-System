let sidebarMoved = false;

// Call Function for using sidebar
function moveSidebar()  {
    const sidebar = document.getElementById("sidebarBody");
    sidebar.style.transition = "0.3s ease-in-out";

    if (!sidebarMoved) {
        sidebar.style.right = "0em";
    }
    else {
        sidebar.style.right = "-20em";
    }

    sidebarMoved = !sidebarMoved;
}

// Function for Portal Page Sidebar
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

// Function for Content Page Sidebar
function loadSidebarPageContent() {
  const xhr = new XMLHttpRequest();
  xhr.onload = function () {
    if (xhr.status === 200) {
      document.getElementById("sidebarPanel").innerHTML = xhr.responseText;
    } else {
      console.error("Failed to load sidebar:", xhr.status);
    }
  };
  xhr.open("GET", "../components/sidebar.html", true);
  xhr.send();
}