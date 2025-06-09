// Handles user authentication and session management
document.getElementById("loginForm")?.addEventListener("submit", function (e) {
  // Prevents the page from reloading on form submission
  e.preventDefault();

  // Gets the user input values from the fields
  const username = document.getElementById("accountID").value.trim();
  const password = document.getElementById("password").value.trim();

  /* Checks to the array of mock users to check if the credentials match. This is just a demonstration of user authentication */
  const user = mockUsers.find(
    (u) => u.username === username && u.password === password
  );

  // If the user inputs passes the check, it sets the current session in localStorage
  if (user) {
    localStorage.setItem("loggedIn", "true");
    localStorage.setItem("username", username);
    localStorage.setItem("displayName", user.displayName);
    localStorage.setItem("role", user.role);
    window.location.href = "./home.html";
    console.log("Login button clicked");
  }
  // Else, it prompts the user with an error message
  else {
    document.getElementById("errorLogin").innerText =
      "Invalid account ID or password";
    document.getElementById("accountID").value = "";
    document.getElementById("password").value = "";
  }
});

// For every page that a guest attempts visit beyond its access, this function checks if the user is logged in.
function checkLogin() {
  if (localStorage.getItem("loggedIn") !== "true") {
    window.location.href = "../index.html";
  }
}

function checkLoginHome() {
  if (localStorage.getItem("loggedIn") !== "true") {
    window.location.href = "./index.html";
  }
}

// If the user is logged in, it redirects the user to the home page.
function redirectHome() {
  if (localStorage.getItem("loggedIn") === "true") {
    window.location.href = "./home.html";
  }
}

// This function removes the current session stored in localStorage.
function logout() {
  localStorage.removeItem("loggedIn");
  localStorage.removeItem("username");
  localStorage.removeItem("displayName");
  window.location.href = "../index.html";
}

function logoutHome() {
  localStorage.removeItem("loggedIn");
  localStorage.removeItem("username");
  localStorage.removeItem("displayName");
  window.location.href = "./index.html";
}
