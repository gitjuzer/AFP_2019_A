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
