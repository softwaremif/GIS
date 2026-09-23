<?php
include "../config/koneksi.php";
$sql=mysqli_query($koneksi,"SELECT * from ord where ordpk='$_GET[ord]'");
$dtsql=mysqli_fetch_array($sql);
$style=$dtsql['artno'];
?>
<style type="text/css">
.header {
display: flex;
flex-direction: row;
justify-content: flex-end;
align-items: flex-start;
padding: 16px;
gap: 24px;
position: absolute;
width: 100%;
height: 48px;
left: 0px;
top: 68px;
background: #359DD9;
box-shadow: 0px 0px 16px -4px rgba(0, 0, 0, 0.12);
}
.contenta {
  padding: 16px;
}
.sticky {
  position: fixed;
  top: 0;
  width: 100%;
}
.sticky + .contenta {
  padding-top: 102px;
}
.datagrid-cell{
/* font-family: 'Arial'; */
font-style: normal;
font-weight: 400;
font-size: 13px;
line-height: 18px;
white-space: normal;
}
.datagrid-row {
height: auto !important;
white-space: normal !important;
}
</style>
<script type="text/javascript">
var url;

$(function (){
costing();
var spv = document.getElementById("spv").value;
var lead = document.getElementById("lead").value;
if(spv==1 || lead>0){
	$('#edit').show();
	$('#history').show();
}else{
	$('#edit').hide();
	$('#history').show();
}
});

function cost() {
$('#dialog-formcost').dialog('open').dialog('setTitle','');
costing();
}
function history() {
$('#dialog-formhistory').dialog('open').dialog('setTitle','');
$('#dg2c').datagrid('load', 'view/get_log_fob.php?ordpk=<?php echo $_GET['ord']; ?>');
var dg = $('#dg2c');
dg.datagrid();
dg.datagrid('getPanel').addClass('lines-no2');
dg.datagrid('getPanel').addClass('col');
$('#dg2c').datagrid('getPanel').addClass('lines-no3');
$('#dg2c').datagrid('getPanel').css('border', 'none');
}

function totfob() {
    var a=document.getElementById('cm').value;
				var b=document.getElementById('mat').value;
				var c=document.getElementById('other').value;
				
				if (a!=''){aa=a;}else{aa=0;}
				if (b!=''){bb=b;}else{bb=0;}
				if (c!=''){cc=c;}else{cc=0;}
				
				var x=parseFloat(aa)+parseFloat(bb)+parseFloat(cc);
				document.getElementById('totfob').innerHTML= "$"+x;
}

function updtcost(){
	var string = $("#formcost").serialize();
	$('#formcost').form('submit',{
 	type	: "POST",
	url	  : "action/simpan.php?x=costing",
	data	: string,
  onSubmit: function(){
  return $(this).form('validate');
  },
		success	: function(data){
		 $.messager.show({
		 title:'',
		 msg:data, 
		 timeout:3000,
		 showType:'slide',
		 icon:'info',
     width:265,
	   height:55,
		 style:{
     left:0,
     right:'',
     top:'',
     bottom:-document.body.scrollTop-document.documentElement.scrollTop
     }
		});
    //window.location.href="?hal=cost&ord=<?php echo $_GET['ord']; ?>";
     $('#dialog-formcost').dialog('close');
     $('#formcost').form('reset');
     costing();
	//  $('#hijau').show();
	$("#hijau").delay(3200).fadeOut(300);
    // document.getElementById('dta').value=0;
    // $('#edit').show();
    // $('#save').hide();
    // $('#cancel').hide();
    // $('#prsn').css('margin-left','-71%');
    // $('#dg').datagrid('reload');
		}
	 });
}

function costing(){
			$.ajax({
			type:"POST",
			url:"view/get_data.php?dt=costing&style=<?php echo $style; ?>",
			data:"ordpk=<?php echo $_GET['ord']; ?>",
			success:function(data){
			let text = data;
			const arr = text.split(",");
			//alert(data);
			var a=arr[0];
			var totqty = new Intl.NumberFormat('en-US').format(a); 
			document.getElementById('totqty1').innerHTML=totqty;
			var b=arr[1];
			var cm1 = new Intl.NumberFormat('en-US',{style:'currency',currency:'USD'}).format(b); 
			document.getElementById('cm1').innerHTML=cm1;
			var c=arr[2];
			var mat1 = new Intl.NumberFormat('en-US',{style:'currency',currency:'USD'}).format(c); 
			document.getElementById('mat1').innerHTML=mat1;
			var d=arr[3];
			var other1 = new Intl.NumberFormat('en-US',{style:'currency',currency:'USD'}).format(d);
			document.getElementById('other1').innerHTML=other1;
			var e=arr[4];
			var fob1 = new Intl.NumberFormat('en-US',{style:'currency',currency:'USD'}).format(e);
			document.getElementById('fob1').innerHTML=fob1;
			var f=arr[5];
			var sales1 = new Intl.NumberFormat('en-US',{style:'currency',currency:'USD'}).format(f);
			document.getElementById('sales1').innerHTML=sales1;
			
			
			document.getElementById('cm').value=arr[1];
			document.getElementById('cmx').value=arr[1];
			document.getElementById('mat').value=arr[2];
			document.getElementById('matx').value=arr[2];
			document.getElementById('other').value=arr[3];
			document.getElementById('otherx').value=arr[3];
			document.getElementById('totfob').innerHTML=fob1;
			
			var g=arr[1];
			var cm2 = new Intl.NumberFormat('en-US',{style:'currency',currency:'USD'}).format(g);
			document.getElementById('cm2').innerHTML= cm2;
			var h=arr[2];
			var mat2 = new Intl.NumberFormat('en-US',{style:'currency',currency:'USD'}).format(h);
			document.getElementById('mat2').innerHTML=mat2;
			var i=arr[3];
			var other2 = new Intl.NumberFormat('en-US',{style:'currency',currency:'USD'}).format(i);
			document.getElementById('other2').innerHTML=other2;
			var j=arr[6];
			var bulkmat2 = new Intl.NumberFormat('en-US',{style:'currency',currency:'USD'}).format(j);
			document.getElementById('bulkmat2').innerHTML=bulkmat2;
			var k=arr[7];
			var bulkcm2 = new Intl.NumberFormat('en-US',{style:'currency',currency:'USD'}).format(k);
			document.getElementById('bulkcm2').innerHTML=bulkcm2;
			document.getElementById('cmcost').innerHTML="-"+bulkcm2;
			var l=arr[15];
			var bulkother2 = new Intl.NumberFormat('en-US',{style:'currency',currency:'USD'}).format(l);
			document.getElementById('bulkother2').innerHTML=bulkother2;
			var m=arr[8];
			var tot1 = new Intl.NumberFormat('en-US',{style:'currency',currency:'USD'}).format(m);
			document.getElementById('tot1').innerHTML=tot1;
			var n=arr[9];
			var tot2 = new Intl.NumberFormat('en-US',{style:'currency',currency:'USD'}).format(n);
			document.getElementById('tot2').innerHTML=tot2;
			
			document.getElementById('tglupdt').innerHTML=arr[12];
			var o=arr[5];
			var fobsales = new Intl.NumberFormat('en-US',{style:'currency',currency:'USD'}).format(o);
			document.getElementById('fobsales').innerHTML=fobsales;
			var p=arr[14];
			var totmat = new Intl.NumberFormat('en-US',{style:'currency',currency:'USD'}).format(p);
			document.getElementById('totmat').innerHTML="-"+totmat;
			var q=arr[10];
			var est = new Intl.NumberFormat('en-US',{style:'currency',currency:'USD'}).format(q);
			if (q>0) {
					document.getElementById('est').innerHTML="<span style='color:green;'>+"+est+"<span>";
      		}else {
			    document.getElementById('est').innerHTML="<span style='color:red;'>"+est+"<span>";
			}
			var r=arr[11];
			var samplecost = new Intl.NumberFormat('en-US',{style:'currency',currency:'USD'}).format(r);
			document.getElementById('samplecost').innerHTML="-"+samplecost ;

			document.getElementById('qtysample').innerHTML=arr[13];
		},
	});
}

</script>
<div class="contenta">
<div id="container-cari" style="margin-top:13%;margin-left:5%;text-align:left;width:auto;background: #FFFFFF;">
<table border="0">
	<tr align="left" style="font-size: 16px;font-weight: 700;line-height: 20px;color:#00000099;">
		<th colspan="3">Costing Summary</th>
		<th colspan="3">FOB breakdown 
			<span id="edit" style="font-size: 14px;color:#359DD9;cursor:pointer;" onclick="cost();">&nbsp;Edit</span>
			<span id="history" style="font-size: 14px;color:#359DD9;cursor:pointer;" onclick="history();">&nbsp;&nbsp;History log</span>
		</th>
	</tr>
	<tr align="left" style="font-size: 14px;font-weight: normal;line-height: 18px;color: #000000;">
		<td width="125">FOB Price</td>
		<td width="125">Order Qty</td>
		<td width="225">Total sales</td>
		<td width="125">CM</td>
		<td width="125">Material</td>
		<td width="125">Other</td>
	</tr>
	<tr style="font-size: 16px;font-weight: 700;line-height: 20px;color: #000000;">
		<td><span id="fob1"></span></td>
		<td><span id="totqty1"></span></td>
		<td><span id="sales1"></span></td>
		<td><span id="cm1"></span></td>
		<td><span id="mat1"></span></td>
		<td><span id="other1"></span></td>
	</tr>
</table>
</br>
<span style="font-size: 16px;font-weight: 700;line-height: 20px;color: #00000099;">Garment revenue breakdown</span>
<table border="0" height="100px">
	<tr align="left" style="font-size: 12px;font-weight: 700;line-height: 16px;color: #00000099;">
		<th colspan="2">Per garment estimation</th>
		<th colspan="2">Bulk estimation</th>
	</tr>
	<tr align="left">
					<td style="font-size: 14px;font-weight: 400;line-height: 18px;color: #00000099;">CM</td>
					<td style="font-size: 14px;font-weight: 400;line-height: 18px;"><span id="cm2"></span></td>
					<td style="font-size: 14px;font-weight: 400;line-height: 18px;color: #00000099;">CM</td>
					<td style="font-size: 14px;font-weight: 400;line-height: 18px;"><span id="bulkcm2"></span></td>
		</tr>
	<tr align="left">
					<td width="100" style="font-size: 14px;font-weight: 400;line-height: 18px;color: #00000099;">Materials</td>
					<td width="150" style="font-size: 14px;font-weight: 400;line-height: 18px;"><span id="mat2"></span></td>
					<td width="100" style="font-size: 14px;font-weight: 400;line-height: 18px;color: #00000099;">Materials</td>
					<td width="150" style="font-size: 14px;font-weight: 400;line-height: 18px;"><span id="bulkmat2"></span></td>
		</tr>
		<tr align="left">
					<td style="font-size: 14px;font-weight: 400;line-height: 18px;color: #00000099;">Other</td>
					<td style="font-size: 14px;font-weight: 400;line-height: 18px;"><span id="other2"></span></td>
					<td style="font-size: 14px;font-weight: 400;line-height: 18px;color: #00000099;">Other</td>
					<td style="font-size: 14px;font-weight: 400;line-height: 18px;"><span id="bulkother2"></td>
		</tr>
		<tr align="left" height="35px">
					<td style="font-size: 14px;font-weight: bold;line-height: 18px;color: #000000;">Total</td>
					<td style="font-size: 14px;font-weight: 400;line-height: 18px;"><span id="tot1"></td>
					<td style="font-size: 14px;font-weight: bold;line-height: 18px;color: #000000;">Total</td>
					<td style="font-size: 14px;font-weight: 400;line-height: 18px;"><span id="tot2"></td>
		</tr>
</table>
</br>
<!-- Estimate profit breakdown  -->
<table border="0" height="100px">
	<tr align="left">
		<th colspan="2" style="font-size: 12px;font-weight: 700;line-height: 16px;color: #00000099;">Estimate profit breakdown &nbsp;<span style="font-size:10px;">last updated <span id="tglupdt"><span></span></th>
	</tr>
	<tr align="left">
					<td width="150" style="font-size: 14px;font-weight: 400;line-height: 18px;color: #00000099;">FOB Sales</td>
					<td width="150" style="font-size: 14px;font-weight: 400;line-height: 18px;"><span id="fobsales"></span></td>
		</tr>
		<tr align="left">
					<td style="font-size: 14px;font-weight: 400;line-height: 18px;color: #00000099;">Total material cost</td>
					<td style="font-size: 14px;font-weight: 400;line-height: 18px;"><span id="totmat"></span></td>
		</tr>
		<tr align="left">
					<td style="font-size: 14px;font-weight: 400;line-height: 18px;color: #00000099;">CM cost</td>
					<td style="font-size: 14px;font-weight: 400;line-height: 18px;"><span id="cmcost"></span></td>
		</tr>
		<tr align="left">
					<td style="font-size: 14px;font-weight: 400;line-height: 18px;color: #00000099;">Samples cost* (Qty <span id="qtysample"></span>)</td>
					<td style="font-size: 14px;font-weight: 400;line-height: 18px;"><span id="samplecost"></span></td>
		</tr>
		<tr align="left">
					<td style="font-size: 14px;font-weight: 400;line-height: 18px;color: #00000099;">Courier cost*</td>
					<td style="font-size: 14px;font-weight: 400;line-height: 18px;"><span id="kurir"></span></td>
		</tr>
				<tr align="left" height="35px">
					<td style="font-size: 14px;font-weight: bold;line-height: 18px;color: #000000;">Estimate</td>
					<td style="font-size: 14px;font-weight: 400;line-height: 18px;"><span id="est"></span></td>
		</tr>
</table>
</div>
</div>

<div id="dialog-formcost" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons" data-options="title:false,resizable:false,modal:true,closable:false"
style="width:400px;height:250px;padding:5px 5px;display:none;top:200px;">
<form id="formcost" method="post">
<div class="modal-content">
<div id="close" style="margin-top:0px; margin-left:325px;">
<a id="close" href="javascript:void(0)" style="font-weight:normal; text-decoration:none; color:#00000099;; font-size:35px;"
onclick="$('#dialog-formcost').dialog('close'); $('#formcost').form('reset');">&#215;</a>
</div>
<input type="hidden" id="ordpk" name="ordpk" value="<?php echo $_GET['ord']; ?>">
<div style="margin-left: 15px;margin-top: -20px;font-style: normal;font-weight: 700;font-size: 16px;line-height: 20px;">FOB Breakdown</div>
<div style="margin-top:15px;margin-left:15px;">
<table border="0"> 
	<tr align="left" style="font-size:14px;">
			<td width="100">CM</td>
			<td width="100">Materials</td>
			<td width="100">Others</td>
	</tr>
	<tr align="left">
			<td>
				<input type="text" class="easyui-validatebox" id="cm" name="cm" value="" style="width:84px;height:34px;" onkeyup="totfob();">
				<input type="text" class="easyui-validatebox" id="cmx" name="cmx" value="" style="width:84px;height:34px;display:none;">
		   </td>
		   <td>
				<input type="text" class="easyui-validatebox" id="mat" name="mat" value="" style="width:84px;height:34px;" onkeyup="totfob();">
				<input type="text" class="easyui-validatebox" id="matx" name="matx" value="" style="width:84px;height:34px;display:none;">
			</td>
			<td>
				<input type="text" class="easyui-validatebox" id="other" name="other" value="" style="width:84px;height:34px;" onkeyup="totfob();">
				<input type="text" class="easyui-validatebox" id="otherx" name="otherx" value="" style="width:84px;height:34px;display:none;">
			</td>
	</tr>
</table>
<br></br>
<span>Total FOB</span>&nbsp;&nbsp;&nbsp;<span id="totfob" style="font-size: 24px;font-weight: 700;line-height: 28px;color: #000000;"></span>
<a style="margin-left:45px;margin-top:150px;text-decoration:none;" href="javascript:void(0)" class="button-submit-add" onclick="updtcost();">Save costing</a>
</div>
</div>
</form>
</div>

<div id="dialog-formhistory" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons" data-options="title:false,resizable:false,modal:true,closable:false"
style="width:750px;height:400px;padding:5px 5px;display:none;top:150px;">
<input type="hidden" id="ordpkb" name="ordpkb" value="<?php echo $_GET['ord']; ?>">
<div id="close" style="margin-top:0px; margin-left:700px;">
<a id="close" href="javascript:void(0)" style="font-weight:normal; text-decoration:none; color:#00000099;; font-size:35px;"
onclick="$('#dialog-formhistory').dialog('close');">&#215;</a>
</div>
<div style="margin-left: 15px;margin-top: -20px;font-style: normal;font-weight: 700;font-size: 16px;line-height: 20px;">Costing History Log</div>
<style>
.lines-no3 .datagrid-body td {
    border-right: 2px solid #FFFFFF;
    border-bottom: 2px solid #FFFFFF;
}
</style>
<div style="margin-top: 15px;margin-left:15px;">
<table id="dg2c" class="easyui-datagrid" title="" style="width:98%;" align="center" border="none" striped="false" idField="importdtpk" data-options="singleSelect:true,pagination:false,collapsible:true,rownumbers:false,border:true,autoRowHeight:true">
					<thead>
						<tr>
							<th field="datelog" width="200" style="border:none;">Date of edit</th>
							<th field="cm" width="135">CM</th>
							<th field="mat" width="135">Materials</th>
							<th field="other" width="135">Others</th>
						</tr>
					</thead>
</table>
</div>
</div>

<div id="hijau" class='text-infohijau sticky' style='width:250px;margin-top:600px;margin-left:25px;display:none;'>Costing information saved. &nbsp; &#10004;</div>

