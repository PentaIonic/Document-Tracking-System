// Function for Portal Page Navigation Bar
function loadPortalIndex() {
  const xhr = new XMLHttpRequest();
  xhr.onload = function () {
    if (xhr.status === 200) {
      document.getElementById("portalContainer").innerHTML = xhr.responseText;
    } else {
      console.error("Failed to load portal:", xhr.status);
    }
  };
  xhr.open("GET", "./portal-pages/login.html", true);
  xhr.send();
}
