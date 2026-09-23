<?php
include"../config/koneksi.php";
session_start();
$hari=date("Y-m-d");
$username=$_POST['username'];
$password=$_POST['pswd'];
?>
<head>
<link rel="shortcut icon" href="../css/images/morich.gif"/>	
<title>Morich Indo Fashion</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" type="text/css" media="screen" href="../css/styleku.css">
<link rel="stylesheet" type="text/css" href="../media/jquery-easyui-1.9.15/themes/gray/easyui.css">
<!-- <link rel="stylesheet" type="text/css" href="media/jquery-easyui-1.9.15/themes/default/easyui.css"> -->
<link rel="stylesheet" type="text/css" href="../media/jquery-easyui-1.9.15/themes/icon.css">
<link rel="stylesheet" type="text/css" href="../media/jquery-easyui-1.9.15/themes/color.css">
<!--<link rel="stylesheet" type="text/css" href="media/jquery-easyui-1.9.15/demo/demo.css">-->
<script type="text/javascript" src="../media/jquery-easyui-1.9.15/jquery.min.js"></script>
<!--<script type="text/javascript" src="media/jquery-easyui-1.9.15/jquery-1.9.1.min.js"></script>-->
<script type="text/javascript" src="../media/jquery-easyui-1.9.15/jquery.easyui.min.js"></script>
<script type="text/javascript" src="../media/jquery-easyui-1.9.15/jquery.edatagrid.js"></script>
<!--<link rel="stylesheet" type="text/css" href="media/DataTables/Bootstrap-3.3.7/css/bootstrap.min.css" />
<script type="text/javascript" src="media/DataTables/Bootstrap-3.3.7/js/bootstrap.min.js"></script>-->
<script type="text/javascript">
function changepswd(){
var lowerCaseLetters = /[a-z]/g;
var upperCaseLetters = /[A-Z]/g;
var numbers = /[0-9]/g;
var myInput = document.getElementById("pswd");
//var lgn = $("#lgn").val();
var password = $("#pswd").val();
var confirmPassword = $("#cnfrm").val();
if (password != confirmPassword){
if (password==''){ $("#eror2").show(); }
else { $("#eror2").hide(); }

if (confirmPassword==''){ $("#eror3").show(); }
else { $("#eror3").hide(); }

if (!lowerCaseLetters || !upperCaseLetters || !numbers || myInput.value.length < 8 ){ $("#eror1").show(); }
else { $("#eror1").hide(); }
$("#eror4").show();
} else {
$("#eror4").hide();
if (password==''){ $("#eror2").show(); }
else { $("#eror2").hide(); }

if (confirmPassword==''){ $("#eror3").show(); }
else { $("#eror3").hide(); }

if (!lowerCaseLetters || !upperCaseLetters || !numbers || myInput.value.length < 8 ){ $("#eror1").show(); }
else {
$("#eror1").hide();
var usrpk = $('#userpk').val();
var cnfrm = $('#cnfrm').val();
if (confirmPassword){
$.ajax({
type	: "POST",
url	 : "../action/simpan.php?x=pswd&cnfrm="+ encodeURIComponent(cnfrm),
data	: 'usrpk='+usrpk,
success	: function(data){
$.messager.show({
title:'',
msg:data, 
timeout:3000,
showType:'slide',
icon:'info',
width:300,
height:55,
style:{
left:0,
right:'',
top:'',
bottom:-document.body.scrollTop-document.documentElement.scrollTop
}
});
}
});
$('#dialog-formpswd').dialog('close');
$('#dialog-formok').dialog('open').dialog('setTitle','');
}
}
}
}
          
function cfrm(){
//var fu = $("#fupk").val();
var guser = $("#guser").val();
if(guser==2){
window.location.href="../admin?hal=order";
} else {
window.location.href="../admin?hal=new";
}
$('#dialog-formok').dialog('close');
//$('#dialog-formpswd').dialog('close');
}

function back(){
window.location.href="../index";
}

function showpswd(){
const togglePassword = document.querySelector("#togglePassword");
const password = document.querySelector("#pswd");

togglePassword.addEventListener("click", function(){
// toggle the type attribute
const type = password.getAttribute("type") === "password" ? "text" : "password";
password.setAttribute("type", type);
// toggle the icon
this.classList.toggle("bi-eye");
});
}

function showpswd2(){
const togglePassword = document.querySelector("#togglePassword2");
const password = document.querySelector("#cnfrm");

togglePassword.addEventListener("click", function(){
// toggle the type attribute
const type = password.getAttribute("type") === "password" ? "text" : "password";
password.setAttribute("type", type);
// toggle the icon
this.classList.toggle("bi-eye");
});
}
</script>
</head>
<?php
/*if($username==""||$password==""){
header("location:../index.php");
exit();
} else {*/
  $query=mysqli_query($koneksi,"SELECT * FROM user
  left outer join guser on guser.guserpk=user.guserpk
  left outer join fu on fu.fupk=user.fupk
  WHERE user.username='$username'AND user.password='$password' and user.guserpk in ('1','2','3','6','9','12','13','14','15')");
  $cek=mysqli_num_rows($query);
  if($cek==1){
  $data=mysqli_fetch_array($query);
  $_SESSION['user']     = $data['userpk'];
  $_SESSION['guser']    = $data['guserpk'];
  $_SESSION['gusernm']  = $data['gusernm'];
  $_SESSION['fu']       = $data['fupk'];
  $_SESSION['funm']     = $data['funm'];
  $_SESSION['mat']      = $data['material'];
  $_SESSION['login']    = $data['login'];
  $_SESSION['mif']      = $data['mif'];
  $_SESSION['mat']      = $data['material'];
  $_SESSION['usernm']   = $data['username'];
  $_SESSION['pswd']     = $data['password'];
  $_SESSION['dc']       = $data['datechange'];
  $_SESSION['spv']      = $data['spv'];
  $_SESSION['leader']   = $data['leader'];
  // $_SESSION['team']     = $data['team'];
  
  if($data['gusernm']=="admin"){
  header("location:../admin?hal=dford");
  exit();
  } else if($data['gusernm']=="wh1" || $data['gusernm']=="ppic" || $data['gusernm']=="pur2" || $data['gusernm']=="exim" || $data['gusernm']=="finance"){
  header("location:../admin?hal=dford");
  exit();
  } else {
  if($data['datechange']<1){
  ?>
  <script type="text/javascript">
  $(function(){
  $('#dialog-formpswd').dialog('open').dialog('setTitle','');
  //$('#dialog-formok').dialog('open').dialog('setTitle','');
  $('#myDropdown1b').hide();
  document.getElementById('pswd').value = '';
  document.getElementById('cnfrm').value = '';
  });
  </script>
  <?php
  } else if($data['datechange']<=$hari){
  ?>
  <script type="text/javascript">
  $(function(){
  $('#dialog-formpswd').dialog('open').dialog('setTitle','');
  $('#myDropdown1b').hide();
  document.getElementById('pswd').value = '';
  document.getElementById('cnfrm').value = '';
  });
  </script>
  <?php
  } else {
  if($data['gusernm']=="leader"){	
  // $_SESSION['judul']="Order List";
  header("location:../admin?hal=dford");
  exit();
  } else if($data['gusernm']=="fu"){	
  // $_SESSION['judul']="Order List";
  header("location:../admin?hal=order");
  exit();
  } else if($data['gusernm']=="purchasing"){	
  if($data['material']>0){
  // $_SESSION['judul']="PO Requests";
  header("location:../admin?hal=new");
  exit();
  } else {
  header("location:../view/frmlogin?er=1");
  exit();
  }
  // } else if($data['gusernm']=="pur2"){	
  // $_SESSION['judul']="Order List";
  // header("location:../admin?hal=dford");
  // exit();
  } else {
  header("location:../view/frmlogin?er=1");
  exit();
  }
  }
  }
  ?>
<div id="dialog-formpswd" class="easyui-dialog" closed="true" buttons="#dialog-buttons" data-options="border:false,resizable:false,modal:true,closable:false,title:false"
style="width:425px;height:450px;padding:5px 5px;display:none;top:20px;border-radius:8px;">
<form id="formpswd" method="post">
	<input type="hidden" name="userpk" id="userpk" size="8" value="<?php echo $data['userpk']; ?>">
	<input type="hidden" name="fupk" id="fupk" size="8" value="<?php echo $data['fupk']; ?>">
	<input type="hidden" name="guser" id="guser" size="8" value="<?php echo $data['guserpk']; ?>">
    <!-- <div class="modal-dialog" style="height:425px;"> -->
        <div class="modal-content">
           <div class="border-modal" style="border:none;">
           <div style="padding:5px; margin-top:-85px;font-size:17px;">
           <!--<center>Enter Old Password</center>
           <input placeholder="Enter login password..." type="password" name="lgn" id="lgn" class="easyui-validatebox" onchange="verify();" style="width:100%; height:25px;">
			        <i class="bi bi-eye-slash" id="togglePassword3" style="margin-left: -30px; cursor: pointer;" onmouseover="showpswd3();" onmouseout="showpswd3();"></i>-->
           <br><div style="font-family: 'Arial';font-style: normal;font-weight: 700;font-size: 18px;line-height: 24px;">
           Renew your password
           </div>
           <div style="text-align:justify; margin-top:10px; font-family: 'Arial';font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;">
           For security reasons, please renew your password. Password renewal is required every 6 months.
           </div>
           <!-- <input type="password" name="pswd" autocomplete="current-password" required="" id="pswd">-->
           <br>
           <div style="margin-bottom:5px; font-family:'Arial'; font-style: normal;font-weight: 700;font-size: 14px;line-height: 18px;">New password</div>
           <input type="password" name="pswd" id="pswd" class="easyui-validatebox" style="width: 244px;height: 34px;">
           <i class="bi bi-eye-slash" id="togglePassword" style="margin-left: -30px; cursor: pointer;" onmouseover="showpswd();" onmouseout="showpswd();"></i>
           <div style="margin-bottom:5px; margin-top:10px; font-family:'Arial'; font-style: normal;font-weight: 700;font-size: 14px;line-height: 18px;">Confirm new password</div>
           <input type="password" name="cnfrm" id="cnfrm" class="easyui-validatebox" style="width: 244px;height: 34px;">
			        <i class="bi bi-eye-slash" id="togglePassword2" style="margin-left: -30px; cursor: pointer;" onmouseover="showpswd2();" onmouseout="showpswd2();"></i>
           </div>
           <br>
           <div id="eror1" style="text-align:justify; margin-left:15px; font-family:'Arial'; font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px; color:red;display:none;">
           <li>Password must be at least 8 characters and contain upper case, lowercase, numbers, and special characters.</li>
           <!--<li>Password confirmation does not match.</li>-->
           </div>
           <div id="eror2" style="text-align:justify; margin-left:15px; font-family:'Arial'; font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px; color:red;display:none;">
           <li>New password is required.</li>
           </div>
           <div id="eror3" style="text-align:justify; margin-left:15px; font-family:'Arial'; font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px; color:red;display:none;">
           <li>Confirm new password is required.</li>
           </div>
           <div id="eror4" style="text-align:justify; margin-left:15px; font-family:'Arial'; font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px; color:red;display:none;">
           <li>Password confirmation does not match.</li>
           </div>
           </div>
        <!--<div class="font-excel-template"><a href="action/file_RKB_new.xlsx" target="_blank" style="text-decoration:none;"> Download excel template </a></div>-->
        <a style="text-decoration:none; left:150px; top:375px;" href="javascript:void(0);" class="button-cancel" onclick="back();">Cancel</a>
        <a style="text-decoration:none; left:220px; top:375px;" href="javascript:void(0);" class="button-submit" onclick="changepswd();">Submit</a>
				<!-- <input type="submit" id="submit" name="submit" value="Submit" class="button-submit">-->
        </div>
<!-- </div> -->
</form>
</div>

<div id="dialog-formok" class="easyui-dialog" closed="true" buttons="#dialog-buttons" data-options="border:false,resizable:false,modal:true,closable:false,title:false"
style="width:425px;height:250px;padding:5px 5px;display:none;top:20px;border-radius:8px;">
    <!-- <div class="modal-dialog" style="height:225px;"> -->
        <div class="modal-content">
        <div style="font-family: 'Arial';font-style: normal;font-weight: 400;font-size: 16px;line-height: 20px;margin-top:50px;margin-left: 90px;">
        <img src="../css/images/centang.png" width="30" height="30" style="margin-left:100px;"><br></br>
        Password successfully updated.
        </div>
        <div style="padding:5px; margin-top:-85px;font-size: 17px;">
        <a style="text-decoration:none; left:125px; top:150px;" href="javascript:void(0)" class="button-submit" onclick="cfrm();">Continue</a>
        </div>
</div>
<!-- </div> -->
</div>
<?php } else {
header("location:../view/frmlogin?er=1");
exit();
}
//}
?>