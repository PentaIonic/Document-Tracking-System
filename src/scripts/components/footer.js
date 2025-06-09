// Function for No Logo Footer
function loadFooter() {
  const xhr = new XMLHttpRequest();
  xhr.onload = function () {
    if (xhr.status === 200) {
      document.getElementById("footer").innerHTML = xhr.responseText;
    } else {
      console.error("Failed to load footer:", xhr.status);
    }
  };
  xhr.open("GET", "../src/components/footer/footerNoLogo.html", true);
  xhr.send();
}

// Function for No Logo Footer
function loadFooterBasePage() {
  const xhr = new XMLHttpRequest();
  xhr.onload = function () {
    if (xhr.status === 200) {
      document.getElementById("footer").innerHTML = xhr.responseText;
    } else {
      console.error("Failed to load footer:", xhr.status);
    }
  };
  xhr.open("GET", "./src/components/footer/footerNoLogo.html", true);
  xhr.send();
}
