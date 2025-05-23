// Function for Portal Page Navigation Bar
function loadPortalIndex() {
  const xhr = new XMLHttpRequest();
  xhr.onload = function () {
    if (xhr.status === 200) {
      document.getElementById("mainContainer").innerHTML = xhr.responseText;
    } else {
      console.error("Failed to load portal:", xhr.status);
    }
  };
  xhr.open("GET", "./index-pages/login.html", true);
  xhr.send();
}
