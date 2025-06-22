document.addEventListener("DOMContentLoaded", () => {
  const toggleMenu = document.getElementById("toggleMenu"); // Menu Button
  const menu = document.getElementById("menu"); // Menu Frame
  

  if (toggleMenu && menu) {
    // If clicked, it will set and unset the menu id with open class.
    toggleMenu.addEventListener("click", () => {
      menu.classList.toggle("open");
    });
  }

  const toggleNotification = document.getElementById("toggleNotification");
  const notificationWindow = document.getElementById("notificationWindow");

  if (toggleNotification && notificationWindow) {
    toggleNotification.addEventListener("click", () => {
      notificationWindow.classList.toggle("open");
    });
  }
});
