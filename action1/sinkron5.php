<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
$hari=date("Y-m-d");
/*cek guser user login selain admin*/
if($_SESSION['guser']<>1){
/*datechange kosong/null*/
if($_SESSION['dc']<1){
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
/*datechange kurang dari hari*/
} if($_SESSION['dc']<=$hari){
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
}
}
?>