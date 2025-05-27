// Handle login
document.getElementById("loginForm")?.addEventListener("submit", function (e) {
  e.preventDefault();

  const username = document.getElementById("accountID").value.trim();

  const user = mockUsers.find((u) => u.username === username);

  if (user) {
    localStorage.setItem("loggedIn", "true");
    localStorage.setItem("username", username);
    localStorage.setItem("displayName", user.displayName);
    window.location.href = "../../../home.html";
    console.log("Login button clicked");
  } else {
    document.getElementById("error").innerText = "Invalid account ID";
  }
});

// Check session
function checkLogin() {
  if (localStorage.getItem("loggedIn") !== "true") {
    window.location.href = "../../../index.html";
  }
}

// Logout
function logout() {
  localStorage.removeItem("loggedIn");
  localStorage.removeItem("username");
  localStorage.removeItem("displayName");
  window.location.href = "../../../index.html";
}
