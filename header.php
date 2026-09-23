<script type="text/javascript">
function myFunction1(){
document.querySelector('#myDropdown1').style.display = '';
document.getElementById("myDropdown1").classList.toggle("show");
}

function myFunction1b(){
document.querySelector('#myDropdown1b').style.display = '';
document.getElementById("myDropdown1b").classList.toggle("show");
}

function pwd(){
$('#dialog-formpswd').dialog('open').dialog('setTitle','');
$('#myDropdown1b').hide();
document.getElementById('pswd').value = '';
document.getElementById('cnfrm').value = '';
}

function cancel2c(){
$('#dialog-formpswd').dialog('close');
$('#formpswd').form('reset');
$("#eror1").hide();
$("#eror2").hide();
$("#eror3").hide();
$("#eror4").hide();
$("#eror5").hide();
}

function changepswd(){
var lowerCaseLetters = /[a-z]/g;
var upperCaseLetters = /[A-Z]/g;
var numbers = /[0-9]/g;
var myInput = document.getElementById("pswd");
//var lgn = $("#lgn").val();
var password = $("#pswd").val();
var confirmPassword = $("#cnfrm").val();
var ppswd = document.getElementById('ppswd').value;
var lgn = document.getElementById('lgn').value;
if (ppswd!=lgn) {
$('#eror5').show();
}
else if (password != confirmPassword){
if (password==''){ $("#eror2").show(); }
else { $("#eror2").hide(); }

if (confirmPassword==''){ $("#eror3").show(); }
else { $("#eror3").hide(); }

if (!lowerCaseLetters || !upperCaseLetters || !numbers || myInput.value.length < 8 ){ $("#eror1").show(); }
else { $("#eror1").hide(); }
$("#eror4").show();
} else {
$('#eror5').hide();
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
url	 : "action/simpan.php?x=pswd&cnfrm="+ encodeURIComponent(cnfrm),
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
//$('#dialog-formok').dialog('open').dialog('setTitle','');
}
}
}
}
          
function cfrm(){
$('#dialog-formok').dialog('close');
$('#dialog-formpswd').dialog('close');
}

function verify(){
var ppswd = document.getElementById('ppswd').value;
var lgn = document.getElementById('lgn').value;
if (ppswd==lgn){
document.getElementById("pswd").disabled = false;
document.getElementById("cnfrm").disabled = false;
document.getElementById("lgn").disabled = true;
} else {
$.messager.alert('Warning','Old password is wrong!!','warning');
}
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

function showpswd3(){
const togglePassword = document.querySelector("#togglePassword3");
const password = document.querySelector("#lgn");

togglePassword.addEventListener("click", function(){
// toggle the type attribute
const type = password.getAttribute("type") === "password" ? "text" : "password";
password.setAttribute("type", type);
// toggle the icon
this.classList.toggle("bi-eye");
});
}

function list(){
var spv = document.getElementById("spv").value;
if(spv==1){
/*url = "?hal=qty&ord="+row.ordpk;
window.open(url);*/
window.location.href="?hal=list";
} else {
$.messager.alert('Warning','User cannot be access','warning');
}
}

function log(){
window.location.href="?hal=log";
}

function sum(){
window.location.href="?hal=sum";
}

function dford(){
window.location.href="?hal=dford";
}

function dfpo(){
window.location.href="?hal=dfpo";
}
</script>
<div id="header" onclick="
/*$('#menu').fadeOut();
$('#dg').datagrid('clearSelections');
$('#dg2').datagrid('clearSelections');
$('#dg3a').datagrid('clearSelections');
$('#dg3b').datagrid('clearSelections');
$('#dg').edatagrid('cancelRow');*/" style="height:56px;">
<div id="frame1">
<div id="img"><img src="css/images/morich.png" width="24px" height="24px" onclick=""></div>
<div id="font-header">Garment Information System</div>
</div>
<div style="margin-right:10%;">
<?php
$stylem="color: #000000;"; 
if($_SESSION['gusernm']=="fu"){
?>
<a href="?hal=lpb" class="link" style="border:none; font-weight:700; <?php if($_GET['hal']=="lpb" || $_GET['hal']=="lpb2"){ echo $stylem;} ?>">
Home
</a>
<a href="?hal=order" class="link" style="border:none; font-weight:700; <?php if($_GET['hal']=="order" || $_GET['hal']=="sum" || $_GET['hal']=="list" || $_GET['ord']>0){ echo $stylem;} ?>">
Orders
</a>
<a href="?hal=proses&x=1" class="link" style="border:none; font-weight:700; 
<?php 
if($_GET['hal']=="detpopur"){ 
if($_GET['ord']==""){
echo $stylem;
}
}
else if($_GET['hal']=="proses" || $_GET['hal']=="proses2" || $_GET['hal']=="detpomd" || $_GET['hal']=="shipdet_detpomd" || $_GET['hal']=="assign" || $_GET['hal']=="assign2"){ echo $stylem;} ?>">
Purchases
</a>
<?php } 
if($_SESSION['gusernm']=="wh1" || $_SESSION['gusernm']=="admin" || $_SESSION['gusernm']=="leader" || $_SESSION['gusernm']=="pur2"){ 
// $stylem="color: #000000;";    
?>
<a href="?hal=dflpb" class="link" style="border:none; font-weight:700; <?php if($_GET['hal']=="dflpb"){ echo $stylem;} ?>">
Home
</a>
<a href="?hal=dford" class="link" style="border:none; font-weight:700; <?php if($_GET['hal']=="dford" || $_GET['hal']=="sum" || $_GET['hal']=="list" || $_GET['hal']=="list" || $_GET['ord']>0){ echo $stylem;} ?>">
Orders
</a>
<a href="?hal=dfpo" class="link" style="border:none; font-weight:700; <?php if($_GET['hal']=="dfpo" || $_GET['hal']=="dtpo" || $_GET['hal']=="shipdet_dtpo"){ echo $stylem;} ?>">
Purchase orders
</a>
<?php } 
if($_SESSION['gusernm'] == "purchasing"){ 
?>
<a href="?hal=ordp" class="link" style="border:none; font-weight:700; <?php if($_GET['hal']=="ordp" || $_GET['hal']=="new" || $_GET['hal']=="wait" || $_GET['hal']=="pur2"){ echo $stylem;} ?>">
Material purchasing
</a>
<a href="?hal=ppic" class="link" style="border:none; font-weight:700; <?php if($_GET['hal']=="ppic"){ echo $stylem;} ?>">
Material tracking (PPIC)
</a>
<?php } ?>
</div>
<?php
//echo $_SESSION['spv'];
//echo $_SESSION['fu'];
if($_SESSION['gusernm']=="fu"){
if($_SESSION['spv']==1){ $and=""; }
else { $and="and ord.userpk='$_SESSION[user]'"; }

$tot2c1 = mysqli_num_rows(mysqli_query($koneksi,"select * FROM memo
left outer join rkb on rkb.rkbpk=memo.rkbpk
left outer join ord on ord.ordpk=rkb.ordpk
where memo.fupk='$_SESSION[fu]' and memo.cek='1' and rkb.status='3' $and"));
//echo $tot2c1;
if($tot2c1>0){
?>
<div id="notif">
<input type="image" src="css/images/notif2.jpeg" width="30px" height="30px" alt="Submit button" onclick="myFunction1();">
</div>
<?php } else { ?>
<div id="notif">
<input type="image" src="css/images/notif.jpeg" width="30px" height="30px" alt="Submit button">
</div>
<?php } 
}
if($_SESSION['gusernm']=="purchasing"){
if($_SESSION['mat']==1) { $and3="and rpo.kelnm='CUTTING'"; }
else { $and3="and rpo.kelnm<>'CUTTING'"; $and3b="and rpo.kelnm like '%sewing%'"; }
$tot2c1b = mysqli_num_rows(mysqli_query($koneksi,"SELECT *FROM po
LEFT OUTER JOIN podt ON podt.popk=po.popk 
LEFT OUTER JOIN rpo ON rpo.rpopk=podt.rpopk
LEFT OUTER JOIN ord ON ord.ordpk=rpo.ordpk
LEFT OUTER JOIN byr ON byr.byrpk=ord.byrpk
LEFT OUTER JOIN fu ON fu.fupk=ord.fupk
WHERE po.tpo2='1' $and3 $and3b
GROUP BY po.popk
ORDER BY po.dateupdt DESC LIMIT 5"));
//echo $tot2c1;
if($tot2c1b>0){
?>
<div id="notif">
<input type="image" src="css/images/notif2.jpeg" width="30px" height="30px" alt="Submit button" onclick="myFunction1();">
</div>
<?php } else { ?>
<div id="notif">
<input type="image" src="css/images/notif.jpeg" width="30px" height="30px" alt="Submit button">
</div>
<?php } 
}?>
<div id="frame2">
<div id="user">
<a href="javascript:void(0)" onmouseenter="myFunction1b();" style="text-decoration:none; color:#000000;"><?php echo $_SESSION['login']; ?></a>
</div>
<div id="panah">
<div class="dropdown" style="float:right;">    
<input type="image" src="css/images/Polygon.png" width="12px" height="12px" style="filter:brightness(0%);" alt="Submit button" onmouseenter="myFunction1b();">
</div>
</div>
</div>

<!--logout-->
<?php if($_SESSION['gusernm']=="fu"){ 
if($_SESSION['spv']==1){
?>
<div id="myDropdown1b" class="dropdown-content" style="margin-top:150px;margin-right:25px; text-align:left;">
<a href="javascript:void(0);" style="text-decoration: none;" onclick="list();">Order Assignment</a>
<a href="javascript:void(0);" style="text-decoration: none;" onclick="pwd();">Password</a>
<a href="action/logout" style="text-decoration: none;">Logout</a>
<?php } else { ?> 
<div id="myDropdown1b" class="dropdown-content" style="margin-top:105px;margin-right:25px; text-align:left;">
<a href="javascript:void(0);" style="text-decoration: none;" onclick="pwd();">Password</a>
<a href="action/logout" style="text-decoration: none;">Logout</a>
<?php }
} else if($_SESSION['gusernm']=="admin"){ ?> 
<div id="myDropdown1b" class="dropdown-content" style="margin-top:200px;margin-right:25px; text-align:left;">
<!-- <a href="javascript:void(0);" style="text-decoration: none;" onclick="dford();">Order list</a> -->
<!-- <a href="javascript:void(0);" style="text-decoration: none;" onclick="dfpo();">Purchase orders</a> -->
<a href="javascript:void(0);" style="text-decoration: none;" onclick="sum();">Order Summary</a>
<a href="javascript:void(0);" style="text-decoration: none;" onclick="log();">Log Activity</a>
<a href="javascript:void(0);" style="text-decoration: none;" onclick="pwd();">Password</a>
<a href="action/logout" style="text-decoration: none;">Logout</a>
<?php } else if($_SESSION['gusernm']=="wh1" || $_SESSION['gusernm']=="ppic" || $_SESSION['gusernm']=="pur2"){ ?> 
<div id="myDropdown1b" class="dropdown-content" style="margin-top:105px;margin-right:25px; text-align:left;">
<a href="javascript:void(0);" style="text-decoration: none;" onclick="dford();">Order list</a>
<!-- <a href="javascript:void(0);" style="text-decoration: none;" onclick="dfpo();">Purchase orders</a> -->
<a href="action/logout" style="text-decoration: none;">Logout</a>
<?php } else { ?>
<div id="myDropdown1b" class="dropdown-content" style="margin-top:105px;margin-right:25px; text-align:left;">
<a href="javascript:void(0);" style="text-decoration: none;" onclick="pwd();">Password</a>
<a href="action/logout" style="text-decoration: none;">Logout</a>
<?php } ?>
</div>

<?php
$sql=mysqli_query($koneksi,"select * from user where userpk=$_SESSION[user]");
$usr=mysqli_fetch_array($sql);
?>
<div id="dialog-formpswd" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons" data-options="border:false,resizable:false,modal:true,closable:false,title:false"
style="width:425px;height:450px;padding:5px 5px;display:none;top:20px;border-radius:8px;">
<form id="formpswd" method="post">
<input type="hidden" name="userpk" id="userpk" size="8" value="<?php echo $usr['userpk'];  ?>">
<input type="hidden" name="usernm" id="usernm" size="8" value="<?php echo $usr['username'];  ?>">
<input type="hidden" name="ppswd" id="ppswd" size="8" value="<?php echo $usr['password'];  ?>">
<!-- <div class="modal-dialog" style="height:425px;"> -->
<div class="modal-content">
<div class="border-modal" style="border:none;">
<div style="padding:5px; margin-top:-90px;font-size:17px;">
<br><div style="font-style: normal;font-weight: 700;font-size: 18px;line-height: 24px;">
Updating Password
</div>
<!--<div style="text-align:justify; margin-top:10px; font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;">
For security reasons, please renew your password. Password renewal is required every 6 months.
</div>-->
<!-- <input type="password" name="pswd" autocomplete="current-password" required="" id="pswd">-->
<br>
<div style="margin-left:-8px; padding:8px;  font-style: normal;font-weight: 700;font-size: 14px;line-height: 18px;">Current Password</div>
<input type="password" name="lgn" id="lgn" class="easyui-validatebox" style="width: 244px;height: 34px;" required="true">
<i class="bi bi-eye-slash" id="togglePassword3" style="margin-left: -30px; cursor: pointer;" onmouseover="showpswd3();" onmouseout="showpswd3();"></i>
<div style="margin-left:-8px; padding:8px;  font-style: normal;font-weight: 700;font-size: 14px;line-height: 18px;">New password</div>
<input type="password" name="pswd" id="pswd" class="easyui-validatebox" style="width: 244px;height: 34px;">
<i class="bi bi-eye-slash" id="togglePassword" style="margin-left: -30px; cursor: pointer;" onmouseover="showpswd();" onmouseout="showpswd();"></i>
<div style="margin-left:-8px; padding:8px;  font-style: normal;font-weight: 700;font-size: 14px;line-height: 18px;">Confirm new password</div>
<input type="password" name="cnfrm" id="cnfrm" class="easyui-validatebox" style="width: 244px;height: 34px;">
<i class="bi bi-eye-slash" id="togglePassword2" style="margin-left: -30px; cursor: pointer;" onmouseover="showpswd2();" onmouseout="showpswd2();"></i>
</div>
<br>
<div style="margin-top:-20px;margin-left:2px">
<div id="eror1" style="text-align:justify;  font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px; color:red;display:none;">
<li>Password must be at least 8 characters and contain upper case, lowercase, numbers, and special characters.</li>
<!--<li>Password confirmation does not match.</li>-->
</div>
<div id="eror2" style="text-align:justify;  font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px; color:red;display:none;">
<li>New password is required.</li>
</div>
<div id="eror3" style="text-align:justify;  font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px; color:red;display:none;">
<li>Confirm new password is required.</li>
</div>
<div id="eror4" style="text-align:justify;  font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px; color:red;display:none;">
<li>Password confirmation does not match.</li>
</div>
<div id="eror5" style="text-align:justify;  font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px; color:red;display:none;">
<li>Your current password is incorrect, please try again or contact IT.</li>
</div>
</div>
</div>
<!--<div class="font-excel-template"><a href="action/file_RKB_new.xlsx" target="_blank" style="text-decoration:none;"> Download excel template </a></div>-->
<a style="text-decoration:none; left:150px; top:375px;" href="javascript:void(0);" class="button-cancel" onclick="cancel2c();">Cancel</a>
<a style="text-decoration:none; left:220px; top:375px;" href="javascript:void(0);" class="button-submit" onclick="changepswd();">Submit</a>
<!-- <input type="submit" id="submit" name="submit" value="Submit" class="button-submit">-->
</div>
<!-- </div> -->
</form>
</div>

<div id="dialog-formok" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons" data-options="border:false,resizable:true,modal:true,closable:false,title:false"
style="width:425px;height:250px;padding:5px 5px;display:none;top:20px;border-radius:8px;">
<!-- <div class="modal-dialog" style="height:225px;"> -->
<div class="modal-content">
<div style="font-style: normal;font-weight: 400;font-size: 16px;line-height: 20px;margin-top:50px;margin-left: 90px;">
<img src="css/images/centang.png" width="30" height="30" style="margin-left:100px;"><br></br>
Password successfully updated.
</div>
<div style="padding:5px; margin-top:-85px;font-size: 17px;">
<a style="text-decoration:none; left:125px; top:150px;" href="javascript:void(0)" class="button-submit" onclick="cfrm();">Continue</a>
</div>
</div>
<!-- </div> -->
</div>