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
    var data = JSON.parse({"username" : actualUsername,"password": actualPasswd,"email":""});
    $.ajax({
      type: "POST",
      url: "localhost/afp/index.php",
      data: data,
      success: function() { registerState.css("color", "green");
                            registerState.html("Regisztráció sikeres.");},
      dataType: "json"
    });
    
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

//Ez így majdnem jó csak mégse, de átkonvertálja
    
    //loginState.html(calc(loginPasswd));

    //Login();
  }
}
function Login() {
  location.href = "GameScreen.html";
}
function calc(msg)
{
  var loginState = $("#loginState");
	var strTxt = msg;
	if( strTxt.length == 0 )
	{
		document.getElementById('loginPasswd').value = "";
		return;
	}
	
		if( strTxt.search("\r")>0 ) strTxt=replaceAll( "\r", "", strTxt );
		var strHash = hex_sha256( strTxt );
		strHash = strHash.toUpperCase();
  
    //Ez itt kiírja passwordboxba a generált kódot, de a loginState nem megy
    //document.getElementById('loginPasswd').value = strHash;
    loginState.html(strHash);
	
}


function dropdownMenu() {
  document.getElementById("myDropdown").classList.toggle("show");
}

window.onclick = function (event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

function Logout() {
  location.href = "Homepage.html";
}

function toGameScreen() {
  location.href = "GameScreen.html";
}

function toTopList() {
  location.href = "TopList.html";
}

function AAnswer() {

}

function BAnswer() {

}

function CAnswer() {

}

function DAnswer() {

}

function toAdminPage(){
  location.href = "Admin.html";
}

function toPasswordChange() {
  location.href = "PasswordChange.html";
}

function toAddQuestionPage() {
  location.href = "AddQuestion.html";
}

function toSendMessage() {
  location.href = "SendMessage.html";
}

function passwordChange() {
  var oldPassword = $("#oldPassword").val();
  var newPassword = $("#newPassword").val();
  var newPasswordAgain = $("#newPasswordAgain").val();
  var registerState = $("#passwordChangeState");

  if (newPassword.length < 6 || newPasswordAgain.length < 6) {
    registerState.css("color", "red");
    registerState.html("A beírt jelszó nem lehet 6 karakternél rövidebb.");
  } else if (newPassword != newPasswordAgain) {
    registerState.css("color", "red");
    registerState.html("A beírt jelszó nem egyezik.");
  }
  else {
    toGameScreen();
  }
}
