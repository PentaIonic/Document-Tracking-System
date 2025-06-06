// Handle login
document.getElementById("loginForm")?.addEventListener("submit", function (e) {
  e.preventDefault();

  const username = document.getElementById("accountID").value.trim();
  const password = document.getElementById("password").value.trim();

  const user = mockUsers.find(
    (u) => u.username === username && u.password === password
  );

  if (user) {
    localStorage.setItem("loggedIn", "true");
    localStorage.setItem("username", username);
    localStorage.setItem("displayName", user.displayName);
    localStorage.setItem("role", user.role);
    window.location.href = "../../../home.html";
    console.log("Login button clicked");
  } else {
    document.getElementById("errorLogin").innerText =
      "Invalid account ID or password";
    document.getElementById("accountID").value = "";
    document.getElementById("password").value = "";
  }
});

// Check session
function checkLogin() {
  if (localStorage.getItem("loggedIn") !== "true") {
    window.location.href = "../../../index.html";
  }
}

function redirectHome() {
  if (localStorage.getItem("loggedIn") === "true") {
    window.location.href = "../../../home.html";
  }
}

// Logout
function logout() {
  localStorage.removeItem("loggedIn");
  localStorage.removeItem("username");
  localStorage.removeItem("displayName");
  window.location.href = "../../../index.html";
}
