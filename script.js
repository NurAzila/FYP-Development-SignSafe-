function showLogin() {
  var login = document.getElementById("login");
  login.classList.remove("hiddenanchor");
  var register = document.getElementById("register");
  register.classList.add("hiddenanchor");
}

function validateRegistration() {
  var password = document.forms["register"]["password"].value;
  var confirm_password = document.forms["register"]["confirm_password"].value;
  if (password !== confirm_password) {
    alert("Passwords do not match");
    return false;
  }
  return true;
}

function validateLogin() {
  // validate email and password
}