function loadSearchResult() {
  const xhr = new XMLHttpRequest();
  xhr.onload = function () {
    if (xhr.status === 200) {
      document.getElementById("container").innerHTML = xhr.responseText;
    } else {
      console.error("Failed to load results:", xhr.status);
    }
  };
  xhr.open("GET", "../src/modules/search/search-result.html", true);
  xhr.send();
}
