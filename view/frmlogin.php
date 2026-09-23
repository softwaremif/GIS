<head>
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="../css/images/morich.gif"/>	
<title>Morich Indo Fashion</title>
<link href="../css/style_login.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="../media/jquery/jquery-3.5.1.js"></script>
<script type="text/javascript" src="../media/jquery/jquery.validate.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$("#form").validate({
rules:{
username:"required",
pswd:"required"
},
messages:{ 
username:{required:''},
pswd:{required:''}
},
success: function(label){
label.text('').addClass('valid');}
});
});

/*function showpswd3() {
  var x = document.getElementById("pswd");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}*/
function showpswd3(){
var togglePassword = document.querySelector("#togglePassword");
var password = document.querySelector("#pswd");
togglePassword.addEventListener("click", function(){
// toggle the type attribute
var type = password.getAttribute("type") === "password" ? "text" : "password";
password.setAttribute("type", type);
// toggle the icon
this.classList.toggle("bi-eye");
});
}

function ceklogin(){
var pswd     = $("#pswd").val();
var username = $("#username").val();
if(pswd=="" || username==""){
$('#eror').show();    
} else {
$('#eror').hide();
window.location.href="action/login.php?pswd="+pswd+"&username="+username;
}
}
</script>

<style type="text/css">
.fitem {
margin-bottom: 5px;
}
.fitem label {
display: inline-block;
width:150px;
}
.fitem label.error {
width:5px;
display: inline-block;
text-indent:0px;
color:red;
}
.fitem label.valid {
width:0px;
display: inline-block;
text-indent:0px;
color:#0000ff;
}
</style>
</head>
<body>
<!--<div id ="kotak" style ="margin: 0 auto;">
<div style = "width: 100px; height: 100px; background-color: red; margin: 0 auto;"></div>
</div>-->

<div id="kotak" style="margin: 0 auto;">
<div style="margin-top:80px; margin-left:182px">
<br></br>
<img src="../css/images/morich.gif" width="100px" height="100px" style="margin-top:20px;">
</div>
<div class="font-besar-login" style="width:100%; text-align:center; margin-top:10px;">
Garment Information System
</div>
<div class="font-kecil-login" style="width:100%; text-align:center; margin-top:45px;">
Login into your account
</div>
<form name="form" id="form" method="post" action="../action/login">
<!--<form name="form" id="form" method="post">-->
<div class="fitem" style="margin-left:110px; margin-top:5px;">
<input type="text" name="username" id="username" placeholder="Enter Username" class="input" autofocus>
</div>
<div class="fitem" style="margin-left:110px; margin-top:8px;">
<input type="password" name="pswd" id="pswd" placeholder="Enter Password" class="input">
<i class="bi bi-eye-slash-fill" id="togglePassword" style="margin-left:-30px; cursor: pointer;" onmouseover="showpswd3();" onmouseout="showpswd3();"></i>
</div>
<?php if(isset($_GET['er'])){ ?>
<div id="eror" class="font-gagal-login" style="width:100%; text-align:center;">
Informasi salah, silahkan coba lagi
</div>
<?php } ?>
<div style="margin-left:150px; margin-top:30px;">
<input type="submit" name="login" id="login" value="Masuk" class="button"></input>
<!--<a href="javascript:void(0);" style="text-decoration:none;" name="login" id="login" value="Masuk" class="button" onclick="ceklogin();">Masuk</a>-->
</div>
</form>
</div>
</body>