function toRegisterPage() {
  location.href = "Register.html";
}
function toLoginPage() {
  location.href = "Login.html";
}
function toHomepage() {
  location.href = "Homepage.html";
}
function toQuestionSelect(){
  location.href = "QuestionSelect.html";
}
function validateRegister() {
  var actualUsername = $("#username").val();
  var actualPasswd = $("#password").val();
  var actualPasswd1x = $("#password1x").val();
  var actualEmail =$("#email").val();
  var registerState = $("#registerState");
  var tanarRoll = $("#tanar");
  var diakRoll = $("#diak");
  var szölüRoll = $("#szülö");
  registerState.html("");
  if (actualUsername.length < 6) {
    registerState.css("color", "red");
    registerState.html("A beírt név nem lehet 6 karakternél rövidebb.");
    return false;
  } else if (actualPasswd.length < 6 || actualPasswd1x.length < 6) {
    registerState.css("color", "red");
    registerState.html("A beírt jelszó nem lehet 6 karakternél rövidebb.");
    return false;
  } else if (actualPasswd != actualPasswd1x) {
    registerState.css("color", "red");
    registerState.html("A beírt jelszó nem egyezik.");
    return false;
  } else {
    
    //var shaPass = hex_sha256(actualPasswd).toLowerCase();
    var userRegister = { user: actualUsername, password: actualPasswd, email: actualEmail };
  
//   var xmlhttp = new XMLHttpRequest();   // new HttpRequest instance 
//   xmlhttp.open("PUT", "http://www.afp2019a.nhely.hu/public/register");
//   xmlhttp.setRequestHeader("Content-Type", "application/json");
//   xmlhttp.send(userRegister);
  $.ajax({
    type: "PUT",
    url: 'http://www.afp2019a.nhely.hu/public/register',
    data : userRegister,
    success : function(data) {

      if (data["status"] == 1) {
        registerState.css("color", "green");
        registerState.html(data["status_message"]);
        return true;
      }
      else {
        registerState.css("color", "red");
        registerState.html(data["status_message"]);
        return false;
        }
      }
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
    return false;
  } else if (loginUsername.length < 6 || loginPasswd.length < 6) {
    loginState.css("color", "red");
    loginState.html("Rövid felhasználónév vagy jelszó!");
    return false;
  } else {

    //Ez így majdnem jó csak mégse, de átkonvertálja
    tryLogin(loginUsername, loginPasswd)
    //loginState.html(calc(loginPasswd));

    //Login();
  }
}
function AdminLogin() {
  location.href = "AdminLogin.html";
}
function Login() {
  location.href = "QuestionSelect.html";
}
function tryLogin(username, password) {
  var loginState = $("#loginState");
 // var shaPass = hex_sha256(password).toLowerCase();
  var userLogin = { user: username, password: password };
  $.post('http://www.afp2019a.nhely.hu/public/login',
    userLogin
    ,
    function (data) {
     
      if (data["status"] == 1) {
        Login();
        var token = data["token"];
        return true;
      }
      else {
        loginState.css("color", "red");
        loginState.html(data["status_message"]);
        return false;
      }
    }
  );
}
function calc(msg) {
  var loginState = $("#loginState");
  var strTxt = msg;
  if (strTxt.length == 0) {
    document.getElementById('loginPasswd').value = "";
    return;
  }

  if (strTxt.search("\r") > 0) strTxt = replaceAll("\r", "", strTxt);
  var strHash = hex_sha256(strTxt);
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

function toStudentNotes() {
  location.href = "StudentNotes.html";
}

function toUserPage() {
  location.href = "Users.html";
}

function toAdminPage() {
  location.href = "Admin.html";
}

function toPasswordChange() {
  location.href = "PasswordChange.html";
}

function toForgottenPassword() {
  location.href = "ForgottenPassword.html";
}

function toUserNameChange() {
  location.href = "UserNameChange.html";
}

function toAddQuestionPage() {
  location.href = "AddQuestion.html";
}

function toSendMessage() {
  location.href = "SendMessage.html";
}



//timer

var time =30;
var fill = 100;

function countDown(secs,elem) {
    
    var element = document.getElementById(elem);
    //var pbelem  = $("#pb");
    //var sbb = document.getElementById(progressbarStyle.value);
    
     
    element.innerHTML = "Idő:"+secs;
    
    if(secs < 1) {
        
        
        clearTimeout(timer);
        
        element.innerHTML = '<h2></h2>';
        
        element.innerHTML += '<a href="#">Lejárt az idő</a>';
        
    }
    secs--;
    fill-=3.33;
    //pbelem.style.css()
    window.setInterval(function(){
            // Add 10% for each iteration of the function (should be 10 iterations in total)
            fill ;
              if(fill === 1){
                clearInterval();
            }
            else{
                document.getElementById("pb_one").style.width = fill + "%";
            }
 }, 50);
    
    var timer = setTimeout('countDown('+secs+',"'+elem+'")',1000);
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
  } else if (newPassword == oldPassword) {
    registerState.css("color", "red");
    registerState.html("Az új jelszó nem egyezhet meg a régivel!");
  }
  else {
    toGameScreen();
  }
}

function forgottenPassword() {
  var email = $("#email").val();
  var newPassword = $("#newPassword").val();
  var newPasswordAgain = $("#newPasswordAgain").val();
  var registerState = $("#forgottenChangeState");

  if (newPassword.length < 6 || newPasswordAgain.length < 6) {
    registerState.css("color", "red");
    registerState.html("A beírt jelszó nem lehet 6 karakternél rövidebb.");
  } else if (newPassword != newPasswordAgain) {
    registerState.css("color", "red");
    registerState.html("A beírt jelszó nem egyezik.");
  } else if (email == null) {
    registerState.css("color", "red");
    registerState.html("Az E-mail nem lehet üres!");
  }
  else {
    toLoginPage();
  }
}

function userNameChange() {
  var oldUserName = $("#oldUserName").val();
  var newUserName = $("#newUserName").val();
  var registerState = $("#UserNameChangeState");

  if (newUserName.length < 4 || newPasswordAgain.length < 12) {
    registerState.css("color", "red");
    registerState.html("A beírt felhasználónak 4 és 12 karakter között kell lennie!");
  } else if (newUserName == oldUserName) {
    registerState.css("color", "red");
    registerState.html("Az új felhasználónév nem egyezhet meg a régivel!");
  }
  else {
    toGameScreen();
  }
}

function validateNewQuestion() {
  var question = $("#QuestionInput").val();
  var answer1 = $("#Answer1Input").val();
  var answer2 = $("#Answer2Input").val();
  var answer3 = $("#Answer3Input").val();
  var answer4 = $("#Answer4Input").val();

  if (question == "") {
    alert("Nem írt kérdést!");
  } else if (!question.includes("?")) {
    alert("Ez nem kérdés! Használjon ? jelet!");
  }

  if (answer1 == "") {
    alert("Az 1. válasz üres!");
  }
  if (answer2 == "") {
    alert("A 2. válasz üres!");
  }
  if (answer3 == "") {
    alert("A 3. válasz üres!");
  }
  if (answer4 == "") {
    alert("A 4. válasz üres!");
  }

  var r1 = $("#radiobutton1");
  var r2 = $("#radiobutton2");
  var r3 = $("#radiobutton3");
  var r4 = $("#radiobutton4");

  if (!r1.checked && !r2.checked && !r3.checked && !r4.checked) {
    alert("Nincs kiválasztva a helyes válasz!");
  }
}
function GetAllQuizByType(id){
  $.get(
    'http://www.afp2019a.nhely.hu/public/quiz/'+id,
    function(data) {
      var szoveg = "";
      for(var i = 0;i < data.length;i++){
        szoveg += data[i]["question"];
        for(var j = 0; j < data[i]["answers"].length;j++){
          szoveg += "<p>"+ data[i]["answers"][j]["text"]+"</p>";
          
        }
           
        $("#labelid").html(szoveg);
          
        }
      
     
    }
  );
}