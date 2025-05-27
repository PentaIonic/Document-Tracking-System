function loadHome() {
  const xhr = new XMLHttpRequest();
  xhr.onload = function () {
    if (xhr.status === 200) {
      document.getElementById("mainContainer").innerHTML = xhr.responseText;
    } else {
      console.error("Failed to load home content:", xhr.status);
    }
  };
  xhr.open("GET", "../src/components/modules/home/home.html", true);
  xhr.send();
}