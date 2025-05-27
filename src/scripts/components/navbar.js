// Function for loading page's Navigation Bar
function loadNavIndex() {
  const xhr = new XMLHttpRequest();
  xhr.onload = function () {
    if (xhr.status === 200) {
      document.getElementById("navbar").innerHTML = xhr.responseText;
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
      insertDisplayName();
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
      insertDisplayName();
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
      insertDisplayName();
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
    if (nameSpan) {
      nameSpan.innerText = name;
    }
  }
}
