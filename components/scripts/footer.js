// Function for Portal Page Footer
function loadFooterIndex() {
  const xhr = new XMLHttpRequest();
  xhr.onload = function () {
    if (xhr.status === 200) {
      document.getElementById("footer").innerHTML = xhr.responseText;
    } else {
      console.error("Failed to load footer:", xhr.status);
    }
  };
  xhr.open("GET", "./components/footer.html", true);
  xhr.send();
}

// Function for Content Page Footer
function loadFooterPageContent() {
  const xhr = new XMLHttpRequest();
  xhr.onload = function () {
    if (xhr.status === 200) {
      document.getElementById("footer").innerHTML = xhr.responseText;
    } else {
      console.error("Failed to load footer:", xhr.status);
    }
  };
  xhr.open("GET", "../components/footer.html", true);
  xhr.send();
}
