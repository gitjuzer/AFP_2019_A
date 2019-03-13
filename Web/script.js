function toRegisterPage() {
  location.href = "Register.html";
}
function toHomepage() {
  location.href = "Homepage.html";
}
function validateRegister() {
  var actualUsername = $("#username").val();
  var actualPasswd = $("#password").val();
  var actualPasswd1x = $("#password1x").val();
  var registerState = $("#registerState");
  if (actualUsername.length < 6) {
    registerState.css("color", "red");
    registerState.html("A beírt név nem lehet 6 karakternél rövidebb.");
  } else if (actualPasswd.length < 6 || actualPasswd1x.length < 6) {
    registerState.css("color", "red");
    registerState.html("A beírt jelszó nem lehet 6 karakternél rövidebb.");
  } else if (actualPasswd != actualPasswd1x) {
    registerState.css("color", "red");
    registerState.html("A beírt jelszó nem egyezik.");
  } else {
    registerState.css("color", "green");
    registerState.html("Regisztráció sikeres.");
  }
}
function validateLogin() {
  var loginUsername = $("#loginUsername").val();
  var loginPasswd = $("#loginPasswd").val();
  var loginState = $("#loginState");
  if (loginUsername == "" || loginPasswd == "") {
    loginState.css("color", "red");
    loginState.html("Hiányzó felhasználónév vagy jelszó!");
  } else if (loginUsername.length < 6 || loginPasswd.length < 6) {
    loginState.css("color", "red");
    loginState.html("Rövid felhasználónév vagy jelszó!");
  } else {
    Login();
  }
}
function Login() {
  location.href = "GameScreen.html";
}
