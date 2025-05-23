// Function for Portal Page Navigation Bar
function loadNavbarIndex() {
  const xhr = new XMLHttpRequest();
  xhr.onload = function () {
    if (xhr.status === 200) {
      document.getElementById("navbar").innerHTML = xhr.responseText;
    } else {
      console.error("Failed to load navigation bar:", xhr.status);
    }
  };
  xhr.open("GET", "./components/navbarIndex.html", true);
  xhr.send();
}

// Function for loading Navigation bar without tabs in Content Pages
function loadNavbarUser() {
  const xhr = new XMLHttpRequest();
  xhr.onload = function () {
    if (xhr.status === 200) {
      document.getElementById("navbar").innerHTML = xhr.responseText;
    } else {
      console.error("Failed to load navigation bar:", xhr.status);
    }
  };
  xhr.open("GET", "../components/navbarIndex.html", true);
  xhr.send();
}

// Function for Content Page Navigation Bar
function loadNavbarPageContent() {
  const xhr = new XMLHttpRequest();
  xhr.onload = function () {
    if (xhr.status === 200) {
      document.getElementById("navbar").innerHTML = xhr.responseText;
    } else {
      console.error("Failed to load navigation bar:", xhr.status);
    }
  };
  xhr.open("GET", "../components/navbar.html", true);
  xhr.send();
}
