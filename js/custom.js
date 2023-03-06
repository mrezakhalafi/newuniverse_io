/** 
* REDIRECT
**/

function pindah(url) {
	window.location.href = url;
}

/**
* CAPTCHA
**/

var code;

function createCaptcha() {
  //clear the contents of captcha div first 
  document.getElementById('captcha_image').innerHTML = "";
  var charsArray =
  "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@!#$%^&*";
  var lengthOtp = 6;
  var captcha = [];

  for (var i = 0; i < lengthOtp; i++) {
    //below code will not allow Repetition of Characters
    var index = Math.floor(Math.random() * charsArray.length + 1); //get the next character from the array
    if (captcha.indexOf(charsArray[index]) == -1)
      captcha.push(charsArray[index]);
    else i--;
  }

  var canv = document.createElement("canvas");
  canv.id = "captcha";
  canv.width = 100;
  canv.height = 50;
  var ctx = canv.getContext("2d");
  ctx.font = "25px Georgia";
  ctx.strokeText(captcha.join(""), 0, 30);
  //storing captcha so that can validate you can save it somewhere else according to your specific requirements
  code = captcha.join("");
  document.getElementById("captcha_image").appendChild(canv); // adds the canvas to the body element
}

function validateCaptcha() {
  event.preventDefault();
  debugger
  if (document.getElementById("captcha").value == code) {
  	pindah('name.php');
  }else{
    alert("Invalid Captcha. try Again");
    createCaptcha();
  }
}


/**
* Show / Hide Input Type Password
**/
function showhide() {
    var $pwd = $("#passwordTF");
    if ($pwd.attr('type') === 'password') {
        $pwd.attr('type', 'text');
        $('#showhide').removeClass('fa-eye-slash');
        $('#showhide').addClass('fa-eye');
    } else {
        $pwd.attr('type', 'password');
        $('#showhide').removeClass('fa-eye');
        $('#showhide').addClass('fa-eye-slash');
    }
}

/**
* Show / Hide Input Type Confirm Password
**/
function showhide2() {
  var $pwd = $("#passwordTFconfirm");
  if ($pwd.attr('type') === 'password') {
    $pwd.attr('type', 'text');
    $('#showhide2').removeClass('fa-eye-slash');
    $('#showhide2').addClass('fa-eye');
  } else {
    $pwd.attr('type', 'password');
    $('#showhide2').removeClass('fa-eye');
    $('#showhide2').addClass('fa-eye-slash');
  }
}

// fungsi untuk mengecek kekuatan password
function passwordStrength(p){
 var status = document.getElementById('status');

 var regex = new Array();
 regex.push("[A-Z]");
 regex.push("[a-z]");
 regex.push("[0-9]");
 regex.push("[!@#$%^&*]");

 var passed = 0;
  for(var x = 0; x < regex.length;x++){
  if(new RegExp(regex[x]).test(p)){
   console.log(passed++);
  }
 }

 var strength = null;
 var color = null;

 switch(passed){
  case 0:
  case 1:
  case 2:
   strength = "Weak";
   color = "#FF3232";
  break;
  case 3:
   strength = "Medium";
   color = "#E1D441";
  break;
  case 4:
   strength = "Strong";
   color = "#27D644";
 }

 status.innerHTML = strength;
 status.style.color = color;
}