function loadSearchPanel() {
  const xhr = new XMLHttpRequest();
  xhr.onload = function () {
    if (xhr.status === 200) {
      document.getElementById("container").innerHTML = xhr.responseText;
    } else {
      console.error("Failed to load navigation bar:", xhr.status);
    }
  };
  xhr.open("GET", "../modules/search-panel.html", true);
  xhr.send();
}