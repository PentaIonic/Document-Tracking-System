document.addEventListener("DOMContentLoaded", () => {
  const toggleBtn = document.getElementById("toggleMenu"); // Menu Button
  const menu = document.getElementById("menu"); // Menu Frame

  if (toggleBtn && menu) {
    // If clicked, it will set and unset the menu id with open class.
    toggleBtn.addEventListener("click", () => {
      menu.classList.toggle("open");
    });
  }
});
