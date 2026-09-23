<?php if($_SESSION['gusernm']=="wh1" || $_SESSION['gusernm']=="ppic" || $_SESSION['gusernm']=="pur2"){
$h=1;
} 
?>
<style>
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
/* Blue */
background: #359DD9;
/* W - Drop Shadow */
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
</style>
<script type="text/javascript">
var url;

function myformatter(date){
/*var y = date.getFullYear("yy");
var m = date.getMonth("M")+1;
var d = date.getDate("dd");
//return y+'-'+(m<10?('0'+m):m)+'-'+(d<10?('0'+d):d);
return (d<10?('0'+d):d)+'/'+(m<10?('0'+m):m)+'/'+y;
//return d+'/'+m+'/'+y;*/
var d = new Date(date || Date.now()),
month = '' + (d.getMonth() + 1),
day = '' + d.getDate(),
year = d.getFullYear();
if (month.length < 2) month = '0' + month;
if (day.length < 2) day = '0' + day;
return [day, month, year].join('/');
}
function myparser(s){
if (!s) return new Date();
//var ss = (s.split('-'));
var ss = (s.split('/'));
var y = parseInt(ss[0],10);
var m = parseInt(ss[1],10);
var d = parseInt(ss[2],10);
if (!isNaN(y) && !isNaN(m) && !isNaN(d)){
//return new Date(y,m-1,d);
return new Date(d,m-1,y);
} else {
return new Date();
//return new Date(date).format("dd/mm/yy");
}
}

/*search*/
function Search(){
$('#dg').datagrid('load',{
cari1: $('#cari1').val()
});
}

function Search2(){
$('#tabel1').css("margin-top","60px");
$('#frame-utama-cari2').show();
$('#frame-utama-cari1').hide();
$('#dg').datagrid('load',{
cari3: $('#place').val(),
cari4: $('#color').val(),
cari5: $('#secsz').val()
});
cari3 = $('#place').val();
//alert(cari3);
const myArray = cari3.split(",");
var dt1 = $('#place').combobox('getData').length;
for (i=0 ; i<=dt1 ; i++) {
document.getElementById("ceka"+i).value = myArray[i];
document.getElementById("cekaa"+i).value = myArray[i];
var dt= $('#ceka'+i).val();
if (dt=="undefined" || dt=="") {
$('#ceka'+i).hide();
$('#crossa'+i).hide();
document.getElementById("talla"+i).value = 0;
tutup2();
}else{
$('#ceka'+i).show();
$('#crossa'+i).show();
document.getElementById("talla"+i).value = 1;
}
}
$('#fltr3').show();
totrec();
}

/*function unSearch2(cross){
var c = cross;
var cmb = document.getElementById("ceka"+c).value;
//alert(cmb);
$('#place').combobox('unselect', cmb);
document.getElementById("ceka"+c).value ="test";
$('#ceka'+c).hide();
$('#crossa'+c).hide();
document.getElementById("talla"+c).value = 0;
$('#dg').datagrid('load',{
cari3: $('#place').val(),
cari4: $('#color').val()
});
//tutup2();
}*/

function unSearch2(cross){
var c = cross;
document.getElementById("talla"+c).value = 0;
document.getElementById("ceka"+c).value ="";
var cmb = document.getElementById("cekaa"+c).value;
$('#place').combobox('unselect', cmb);
//$('#ceka'+c).hide();
//$('#crossa'+c).hide();
//alert(cmb);
$('#dg').datagrid('load',{
cari3: $('#place').val(),
cari4: $('#color').val(),
cari5: $('#secsz').val()
});
tutup2();
totrec();
}

function Search2b(){
$('#tabel1').css("margin-top","60px");
$('#frame-utama-cari2').show();
$('#frame-utama-cari1').hide();
$('#dg').datagrid('load',{
cari3: $('#place').val(),
cari4: $('#color').val(),
cari5: $('#secsz').val()
});
cari4 = $('#color').val();
//alert(cari3);
const myArrayb = cari4.split(",");
var dt1b = $('#color').combobox('getData').length;
var dt1ab= dt1b - 1;
for (j=0 ; j<=dt1ab ; j++) {
document.getElementById("cekb"+j).value = myArrayb[j];
document.getElementById("cekbb"+j).value = myArrayb[j];
var dtb= $('#cekb'+j).val();
if (dtb=="undefined" || dtb=="") {
$('#cekb'+j).hide();
$('#crossb'+j).hide();
document.getElementById("tallb"+j).value = 0;
tutup2();
}else{
$('#cekb'+j).show();
$('#crossb'+j).show();
document.getElementById("tallb"+j).value = 1;
}
}
$('#fltr3').show();
totrec();
}

function unSearch2b(crossb){
var cb = crossb;
document.getElementById("tallb"+j).value = 0;
document.getElementById("cekb"+cb).value ="";
var cmbb = document.getElementById("cekbb"+cb).value;
$('#color').combobox('unselect', cmbb);
//$('#cekb'+cb).hide();
//$('#crossb'+cb).hide();
//alert(bc);
$('#dg').datagrid('load',{
cari3: $('#place').val(),
cari4: $('#color').val(),
cari5: $('#secsz').val()
});
tutup2();
totrec();
}

function Search2c(){
$('#tabel1').css("margin-top","60px");
$('#frame-utama-cari2').show();
$('#frame-utama-cari1').hide();
$('#dg').datagrid('load',{
cari3: $('#place').val(),
cari4: $('#color').val(),
cari5: $('#secsz').val()
});
cari5 = $('#secsz').val();
//alert(cari3);
const myArrayc = cari5.split(",");
var dt1c = $('#secsz').combobox('getData').length;
var dt1ac= dt1c - 1;
for (j=0 ; j<=dt1ac ; j++) {
document.getElementById("cekc"+j).value = myArrayc[j];
document.getElementById("cekcc"+j).value = myArrayc[j];
var dtc= $('#cekc'+j).val();
if (dtc=="undefined" || dtc=="") {
$('#cekc'+j).hide();
$('#crossc'+j).hide();
document.getElementById("tallc"+j).value = 0;
tutup2();
}else{
$('#cekc'+j).show();
$('#crossc'+j).show();
document.getElementById("tallc"+j).value = 1;
}
}
$('#fltr3').show();
totrec();
}

function unSearch2c(crossc){
var cc = crossc;
document.getElementById("tallc"+j).value = 0;
document.getElementById("cekc"+cb).value ="";
var cmcc = document.getElementById("cekcc"+cc).value;
$('#secsz').combobox('unselect', cmcc);
//$('#cekb'+cb).hide();
//$('#crossb'+cb).hide();
//alert(bc);
$('#dg').datagrid('load',{
cari3: $('#place').val(),
cari4: $('#color').val(),
cari5: $('#secsz').val()
});
tutup2();
totrec();
}

function reset() {
//$('#tabel1').css("margin-top","");
//$('#color').combobox('setValue', color);
// $('#place').combobox('setValue', place);
$('#dg').datagrid('load',{
cari3: '',
cari4: '',
cari5: ''
});
$('#tabel1').css("margin-top","");
$('#fltr3').hide();
$('#frame-fltrchk2').hide();
$('#frame-utama-cari2').hide();
$('#frame-utama-cari1').show();
totrec();
}

function tutup2(){
		var cka1= document.getElementById("talla0").value;
		var cka2= document.getElementById("talla1").value;
		var cka3= document.getElementById("talla2").value;
		var cka4= document.getElementById("talla3").value;
		var cka5= document.getElementById("talla4").value;
		var cka6= document.getElementById("talla5").value;
		var cka7= document.getElementById("talla6").value;
		var cka8= document.getElementById("talla7").value;
		var cka9= document.getElementById("talla8").value;
		var cka10= document.getElementById("talla9").value;
		var cka11= document.getElementById("talla10").value;

		var ckb1= document.getElementById("tallb0").value;
		var ckb2= document.getElementById("tallb1").value;
		var ckb3= document.getElementById("tallb2").value;
		var ckb4= document.getElementById("tallb3").value;
		var ckb5= document.getElementById("tallb4").value;
		var ckb6= document.getElementById("tallb5").value;
		var ckb7= document.getElementById("tallb6").value;
		var ckb8= document.getElementById("tallb7").value;
		var ckb9= document.getElementById("tallb8").value;
		var ckb10= document.getElementById("tallb9").value;
		var ckb11= document.getElementById("tallb10").value;

		var ckc1= document.getElementById("tallc0").value;
		var ckc2= document.getElementById("tallc1").value;
		var ckc3= document.getElementById("tallc2").value;
		var ckc4= document.getElementById("tallc3").value;
		var ckc5= document.getElementById("tallc4").value;
		var ckc6= document.getElementById("tallc5").value;
		var ckc7= document.getElementById("tallc6").value;
		var ckc8= document.getElementById("tallc7").value;
		var ckc9= document.getElementById("tallc8").value;
		var ckc10= document.getElementById("tallc9").value;
		var ckc11= document.getElementById("tallc10").value;

var tallt=parseInt(cka1)+parseInt(cka2)+parseInt(cka3)+parseInt(cka4)+parseInt(cka5)+parseInt(cka6)+
parseInt(cka7)+parseInt(cka8)+parseInt(cka9)+parseInt(cka10)+parseInt(cka11)+
parseInt(ckb1)+parseInt(ckb2)+parseInt(ckb3)+parseInt(ckb4)+parseInt(ckb5)+parseInt(ckb6)+parseInt(ckb7)+parseInt(ckb8)+
parseInt(ckb9)+parseInt(ckb10)+parseInt(ckb11)+
parseInt(ckc1)+parseInt(ckc2)+parseInt(ckc3)+parseInt(ckc4)+parseInt(ckc5)+parseInt(ckc6)+parseInt(ckc7)+parseInt(ckc8)+
parseInt(ckc9)+parseInt(ckc10)+parseInt(ckc11);
//alert(tallt);
if (tallt==0) {
    reset();
    $('#frame-fltrchk2').hide();
    $('#frame-utama-cari2').hide();
		$('#frame-utama-cari1').show();
}
totrec();
}

function totrec() {
   var tcount= JSON.stringify($('#dg').datagrid('getData').total);
	document.getElementById("fltr2").innerHTML = "Selected Filter <br>"+tcount+" result";
}

/*cetak*/
function exp() {
      document.getElementById("ordpkexp").value = <?php echo $ord; ?>;
			$.ajax({
				type: "POST",
				url: "view/get_ordno.php",
				data: "ord=<?php echo $ord; ?>",
				success: function (data) {
					let text = data;
        const arr = text.split(",");
        var ordno = arr[0];
        var filenm = arr[1];
					document.getElementById('ordnoexp').innerHTML = ordno;
				},
			});
			$('#dialog-formb').dialog('open').dialog('setTitle', '');
		}

    function canexp() {
			$('#dialog-form').dialog('close');
			$('#form').form('reset');

			$('#dialog-formb').dialog('close');
			$('#formb').form('reset');
		}
    
function cetak(){
cari = $('#place').val();
cari2 = $('#color').val();
cari3 = $('#secsz').val();
// url = "pdf/pdf_qty2?ord=<?php //echo $ord; ?>&cari="+cari+"&cari2="+cari2;
// window.open(url); 
var cek = $('input[name="cek"]:checked').attr("value");
var ord = $('#ordpkexp').val();
			// alert(cek);
			if (cek == 1) {
				url = "pdf/pdf_qty2?h=<?php echo $h; ?>&ord="+ord+"&cari="+cari+"&cari2="+cari2+"&cari3="+cari3;
				window.open(url);
			} else {
				// url = "excel/excel_qty?ord="+ord+"&cari="+cari+"&cari2="+cari2+"&cari3="+cari3;
				url = "excel/excel_qty2?h=<?php echo $h; ?>&ord=" + ord + "&cari=" + cari + "&cari2=" + cari2 + "&cari3=" + cari3;
				window.open(url);
			}
}

//combobox dengan chekbox
$(function() {
		$('#dg').datagrid({
			onLoadSuccess: function(data) {
				var rows = $('#dg').datagrid('getPanel').find('div.datagrid-footer tr');

				rows.each(function() {
					var secszText = $(this).find('td[field="secsz"]').text().trim();
					console.log("nilai kolom seczs:", secszText);

					if (secszText === "By Color" || secszText === "By Place" || secszText === "By Sec. Size") {
						$(this).css({
							"background-color": "#D3D3D3",
							"font-weight": "bold"
						});
					}
				});
			}
		});

$('#place').combobox({
  formatter:function(row){
    var opts = $(this).combobox('options');
    return '<input type="checkbox" id="combochek" class="combobox-checkbox">' + row[opts.textField];
  },
  onLoadSuccess:function(){
    var opts = $(this).combobox('options');
    var target = this;
    var values = $(target).combobox('getValues');
    $.map(values, function(value){
      var el = opts.finder.getEl(target, value);
      el.find('input.combobox-checkbox')._propAttr('checked', true);
    });
  },
  onSelect:function(row){
    console.log(row);
    var opts = $(this).combobox('options');
    var el = opts.finder.getEl(this, row[opts.valueField]);
    el.find('input.combobox-checkbox')._propAttr('checked', true);
    $('#frame-fltrchk2').show();
    totrec();
  },
  onUnselect:function(row){
    var opts = $(this).combobox('options');
    var el = opts.finder.getEl(this, row[opts.valueField]);
    el.find('input.combobox-checkbox')._propAttr('checked', false);
  }
});

$('#color').combobox({
  formatter:function(row){
    var opts = $(this).combobox('options');
    return "<input type='checkbox' class='combobox-checkbox' value=''>" + row[opts.textField];
  },
  onLoadSuccess:function(){
    var opts = $(this).combobox('options');
    var target = this;
    var values = $(target).combobox('getValues');
    $.map(values, function(value){
      var el = opts.finder.getEl(target, value);
      el.find('input.combobox-checkbox')._propAttr('checked', true);
    });
  },
  onSelect:function(row){
    console.log(row);
    var opts = $(this).combobox('options');
    var el = opts.finder.getEl(this, row[opts.valueField]);
    el.find('input.combobox-checkbox')._propAttr('checked', true);
    $('#frame-fltrchk2').show();
    totrec();
  },
  onUnselect:function(row){
    var opts = $(this).combobox('options');
    var el = opts.finder.getEl(this, row[opts.valueField]);
    el.find('input.combobox-checkbox')._propAttr('checked', false);
  }
});

$('#secsz').combobox({
  formatter:function(row){
    var opts = $(this).combobox('options');
    return "<input type='checkbox' class='combobox-checkbox' value=''>" + row[opts.textField];
  },
  onLoadSuccess:function(){
    var opts = $(this).combobox('options');
    var target = this;
    var values = $(target).combobox('getValues');
    $.map(values, function(value){
      var el = opts.finder.getEl(target, value);
      el.find('input.combobox-checkbox')._propAttr('checked', true);
    });
  },
  onSelect:function(row){
    console.log(row);
    var opts = $(this).combobox('options');
    var el = opts.finder.getEl(this, row[opts.valueField]);
    el.find('input.combobox-checkbox')._propAttr('checked', true);
    $('#frame-fltrchk2').show();
    totrec();
  },
  onUnselect:function(row){
    var opts = $(this).combobox('options');
    var el = opts.finder.getEl(this, row[opts.valueField]);
    el.find('input.combobox-checkbox')._propAttr('checked', false);
  }
});
});

function scrollToBottom() {
  const scrollingElement = document.scrollingElement || document.body;
  scrollingElement.scrollTop = scrollingElement.scrollHeight;
}

function formatter1(value,row){
  if(value>0){
    return '$'+value;
  }else{
    return '';
  }
}

	function log() {
		$('#dialog-formhistory').dialog('open').dialog('setTitle', '');
		$('#dg2c').datagrid('load', 'view/get_log_qty.php?ordpk=<?php echo $_GET['ord']; ?>');
		var dg = $('#dg2c');
		dg.datagrid();
		dg.datagrid('getPanel').addClass('lines-no2');
		dg.datagrid('getPanel').addClass('col');
		$('#dg2c').datagrid('getPanel').addClass('lines-no3');
		$('#dg2c').datagrid('getPanel').css('border', 'none');
	}

	function styler1(index, row) {
		if (row.jenis == "HEADER") {
			return 'font-weight:bold';
		} else {
			return '';
		}
	}
</script>

<?php
$ord=$_GET['ord'];
$crh=mysqli_query($koneksi,"select * from bdown where ordpk='$ord' and jenis='HEADER' order by bdownpk desc limit 1");
$dth=mysqli_fetch_array($crh);
if($dth['bdownpk']>0){
if($dth['s1']<>"" || !empty($dth['s1'])){ $sz1=1; } else { $sz1=0; $hidden1="hidden"; }
if($dth['s2']<>"" || !empty($dth['s2'])){ $sz2=1; } else { $sz2=0; $hidden2="hidden"; }
if($dth['s3']<>"" || !empty($dth['s3'])){ $sz3=1; } else { $sz3=0; $hidden3="hidden"; }
if($dth['s4']<>"" || !empty($dth['s4'])){ $sz4=1; } else { $sz4=0; $hidden4="hidden"; }
if($dth['s5']<>"" || !empty($dth['s5'])){ $sz5=1; } else { $sz5=0; $hidden5="hidden"; }
if($dth['s6']<>"" || !empty($dth['s6'])){ $sz6=1; } else { $sz6=0; $hidden6="hidden"; }
if($dth['s7']<>"" || !empty($dth['s7'])){ $sz7=1; } else { $sz7=0; $hidden7="hidden"; }
if($dth['s8']<>"" || !empty($dth['s8'])){ $sz8=1; } else { $sz8=0; $hidden8="hidden"; }
if($dth['s9']<>"" || !empty($dth['s9'])){ $sz9=1; } else { $sz9=0; $hidden9="hidden"; }
if($dth['s10']<>"" || !empty($dth['s10'])){ $sz10=1; } else { $sz10=0; $hidden10="hidden"; }
if($dth['s11']<>"" || !empty($dth['s11'])){ $sz11=1; } else { $sz11=0; $hidden11="hidden"; }
if($dth['s12']<>"" || !empty($dth['s12'])){ $sz12=1; } else { $sz12=0; $hidden12="hidden"; }
if($dth['s13']<>"" || !empty($dth['s13'])){ $sz13=1; } else { $sz13=0; $hidden13="hidden"; }
if($dth['s14']<>"" || !empty($dth['s14'])){ $sz14=1; } else { $sz14=0; $hidden14="hidden"; }
if($dth['s15']<>"" || !empty($dth['s15'])){ $sz15=1; } else { $sz15=0; $hidden15="hidden"; }
if($dth['s16']<>"" || !empty($dth['s16'])){ $sz16=1; } else { $sz16=0; $hidden16="hidden"; }
if($dth['s17']<>"" || !empty($dth['s17'])){ $sz17=1; } else { $sz17=0; $hidden17="hidden"; }
if($dth['s18']<>"" || !empty($dth['s18'])){ $sz18=1; } else { $sz18=0; $hidden18="hidden"; }
if($dth['s19']<>"" || !empty($dth['s19'])){ $sz19=1; } else { $sz19=0; $hidden19="hidden"; }
if($dth['s20']<>"" || !empty($dth['s20'])){ $sz20=1; } else { $sz20=0; $hidden20="hidden"; }
// if($dth['s21']<>"" || !empty($dth['s21'])){ $sz21=1; } else { $sz21=0; $hidden21="hidden"; }
// if($dth['s22']<>"" || !empty($dth['s22'])){ $sz22=1; } else { $sz22=0; $hidden22="hidden"; }
// if($dth['s23']<>"" || !empty($dth['s23'])){ $sz23=1; } else { $sz23=0; $hidden23="hidden"; }
// if($dth['s24']<>"" || !empty($dth['s24'])){ $sz24=1; } else { $sz24=0; $hidden24="hidden"; }
// if($dth['s25']<>"" || !empty($dth['s25'])){ $sz25=1; } else { $sz25=0; $hidden25="hidden"; }
// if($dth['s26']<>"" || !empty($dth['s26'])){ $sz26=1; } else { $sz26=0; $hidden26="hidden"; }
// if($dth['s27']<>"" || !empty($dth['s27'])){ $sz27=1; } else { $sz27=0; $hidden27="hidden"; }
// if($dth['s28']<>"" || !empty($dth['s28'])){ $sz28=1; } else { $sz28=0; $hidden28="hidden"; }
// if($dth['s29']<>"" || !empty($dth['s29'])){ $sz29=1; } else { $sz29=0; $hidden29="hidden"; }
// if($dth['s30']<>"" || !empty($dth['s30'])){ $sz30=1; } else { $sz30=0; $hidden30="hidden"; }
// if($dth['s31']<>"" || !empty($dth['s31'])){ $sz31=1; } else { $sz31=0; $hidden31="hidden"; }
// if($dth['s32']<>"" || !empty($dth['s32'])){ $sz32=1; } else { $sz32=0; $hidden32="hidden"; }
// if($dth['s33']<>"" || !empty($dth['s33'])){ $sz33=1; } else { $sz33=0; $hidden33="hidden"; }
// if($dth['s34']<>"" || !empty($dth['s34'])){ $sz34=1; } else { $sz34=0; $hidden34="hidden"; }
// if($dth['s35']<>"" || !empty($dth['s35'])){ $sz35=1; } else { $sz35=0; $hidden35="hidden"; }
// if($dth['s36']<>"" || !empty($dth['s36'])){ $sz36=1; } else { $sz36=0; $hidden36="hidden"; }
// if($dth['s37']<>"" || !empty($dth['s37'])){ $sz37=1; } else { $sz37=0; $hidden37="hidden"; }
// if($dth['s38']<>"" || !empty($dth['s38'])){ $sz38=1; } else { $sz38=0; $hidden38="hidden"; }
// if($dth['s39']<>"" || !empty($dth['s39'])){ $sz39=1; } else { $sz39=0; $hidden39="hidden"; }
// if($dth['s40']<>"" || !empty($dth['s40'])){ $sz40=1; } else { $sz40=0; $hidden40="hidden"; }
$cjml=$sz1+$sz2+$sz3+$sz4+$sz5+$sz6+$sz7+$sz8+$sz9+$sz10
+$sz11+$sz12+$sz13+$sz14+$sz15+$sz16+$sz17+$sz18+$sz19+$sz20
+$sz21+$sz22+$sz23+$sz24+$sz25+$sz26+$sz27+$sz28+$sz29+$sz30
+$sz31+$sz32+$sz33+$sz34+$sz35+$sz36+$sz37+$sz38+$sz39+$sz40;
}

$tot = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM bdown WHERE ordpk='$ord' GROUP BY ordpk"));
if($tot>0){
?>

<div class="contenta">
<div id="frame-utama-cari" style="width:800px;">
<div id="container-cari">
<div id="frame-cari">
<img src="css/images/Shape.png" plain="true" width="18px" height="18px" onclick="">
<input id="cari1" placeholder="Search..." class="input" plain="true" onkeyup="Search();">
</div>
</div>
<input style="width:119px;" type="button" name="submit" value="Print breakdown" class="button-submit-add" plain="true" 
href="javascript:void(0);" onclick="exp()">
<input style="width:150px; height:28px;" id="place" name="place" class="easyui-combobox"
data-options="prompt:'Place',onChange:Search2,panelHeight:'auto',limitToList:'true',multiple:true,
url:'view/get_data.php?dt=qtyb&ord=<?php echo $ord; ?>',valueField:'country',textField:'country',"/>

<input style="width:150px; height:28px;" id="color" name="color" class="easyui-combobox"
data-options="prompt:'Color',onChange:Search2b,panelHeight:'auto',limitToList:'true',multiple:true,
url:'view/get_data.php?dt=qty2b&ord=<?php echo $ord; ?>',valueField:'color',textField:'color',"/>

<input style="width:150px; height:28px;" id="secsz" name="secsz" class="easyui-combobox"
data-options="prompt:'Sec.Size',onChange:Search2c,panelHeight:'auto',limitToList:'true',multiple:true,
url:'view/get_data.php?dt=qty3b&ord=<?php echo $ord; ?>',valueField:'secsz',textField:'secsz',"/>
<input type="hidden" name="test" id="test" size="5">
<a href="javascript:void(0);" title="Reload table" class="easyui-tooltip" onclick="$('#dg').datagrid('reload');">
<img src="css/images/reload1.png" width="20px" height="20px">
</a>
</div>
<div id="frame-fltrchk2" align="left" onmousemove="totrec();" style="margin-top:60px;display:none;">
<div id="fltr1" style="margin-top:5px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"></div>
<div id="fltr2" style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"></div>
<div style="margin-left:150px;margin-top:-25px;">
<?php for($a=0; $a<=10; $a++) { ?>
<input type="button" id="ceka<?php echo $a; ?>" class="filterchek" alt="Submit button" style="" readonly>
<input type="hidden" id="cekaa<?php echo $a; ?>">
<input type="hidden" name="talla" id="talla<?php echo $a; ?>" value="0" size="5">
<a href="javascript:void(0);" id="crossa<?php echo $a; ?>" class="cross" onclick="unSearch2(<?php echo $a; ?>);">&nbsp;&#215;&nbsp;</a>

<input type="button" id="cekb<?php echo $a; ?>" class="filterchek" alt="Submit button" style="" readonly>
<input type="hidden" id="cekbb<?php echo $a; ?>">
<input type="hidden" name="tallb" id="tallb<?php echo $a; ?>" value="0" size="5">
<a href="javascript:void(0);" id="crossb<?php echo $a; ?>" class="cross" onclick="unSearch2b(<?php echo $a; ?>);">&nbsp;&#215;&nbsp;</a>

<input type="button" id="cekc<?php echo $a; ?>" class="filterchek" alt="Submit button" style="" readonly>
<input type="hidden" id="cekcc<?php echo $a; ?>">
<input type="hidden" name="tallc" id="tallc<?php echo $a; ?>" value="0" size="5">
<a href="javascript:void(0);" id="crossc<?php echo $a; ?>" class="cross" onclick="unSearch2c(<?php echo $a; ?>);">&nbsp;&#215;&nbsp;</a>
<?php } ?>
</div>
<div id="fltr3" style=" margin-left:90%;margin-top:-25px;display:none;"><a href="javascript:void(0);" style="text-decoration:none; color: #359DD9;" onclick="reset();" >Reset All</a></div>
</div>

	<?php
	$dtu = mysqli_fetch_array(mysqli_query($koneksi, "select * from logtran where ordpk='$ord' and lognote like '%qty%' 
	order by logdtime desc limit 1"));
	$dtord = mysqli_fetch_array(mysqli_query($koneksi, "SELECT stsprod, dateprod FROM ord WHERE ordpk='$ord'"));
	?>
	<div id="frame-utama-cari1" style="width:auto;text-align:left;margin-left:20px;margin-top:60px;font-size:12px;line-height:16px;font-weight:400;">
		<?php
		if ($dtord['stsprod'] == 1) {
			if (!empty($dtord['dateprod'])) { ?>
				<span style="color:rgba(0, 0, 0, 0.38);text-align:left;">
					Released : <span style="color:#000000;"><?php echo tglu($dtord['dateprod']); ?></span></span> |
		<?php }
		} ?>
		<span style="color:rgba(0, 0, 0, 0.38);text-align:left;">
			Last updated : <span style="color:#000000;"><?php echo tglu($dtu['logdtime']); ?></span></span>
		<a href="javascript:void(0)" id="log" plain="true" onclick="log();" style="color:#359DD9;text-decoration:none;">History Log</a>
	</div>

				<?php
				$sizes = [];
				$hiddens = [];
				$cjml = 0;

				if (!empty($dth) && $dth['bdownpk'] > 0) {
					for ($i = 1; $i <= 25; $i++) {
						$field = "s{$i}";
						if (isset($dth[$field]) && $dth[$field] !== '') {   // pakai array akses
							$sizes[$i] = 1;
						} else {
							$sizes[$i] = 0;
							$hiddens[$i] = "hidden";
						}
						$cjml += $sizes[$i];
					}
				}
			?>

	<div id="frame-utama-cari2" style="display:none;width:auto;text-align:left;margin-left:20px;margin-top:10px;font-size:12px;line-height:16px;font-weight:400;">
		<?php
		if ($dtord['stsprod'] == 1) {
			if (!empty($dtord['dateprod'])) { ?>
				<span style="color:rgba(0, 0, 0, 0.38);text-align:left;">
					Released : <span style="color:#000000;"><?php echo tglu($dtord['dateprod']); ?></span></span> |
		<?php }
		} ?>
		<span style="color:rgba(0, 0, 0, 0.38);text-align:left;">
			Last updated : <span style="color:#000000;"><?php echo tglu($dtu['logdtime']); ?></span></span>
		<a href="javascript:void(0)" id="log" plain="true" onclick="log();" style="color:#359DD9;text-decoration:none;">History Log</a>
	</div>

<div id="tabel1" onclick="" ondblclick="" style="top:220px;">
<table id="dg" class="easyui-datagrid" title="" style="width:100%;height:auto;" align="center"
url="view/get_detord.php?ord=<?php echo $ord; ?>" idField="bdownpk" toolbar="#tb" striped="true" showFooter="true"
pagination="false" rownumbers="false"  singleSelect="true" collapsible="true" fitColumns="false"
data-options="multiSort:true,remoteSort:false">
<thead>
<tr>
<th field="country" width="150" sortable="true" rowspan="2" styler="styler1">Place</th>
<th field="poref" width="150" sortable="true" rowspan="2" styler="styler1">License<br>PO Ref</th>
<th field="pono" width="94" sortable="true" rowspan="2" styler="styler1">PO no.</th>
<th field="opno" width="95" sortable="false"  styler="styler1" rowspan="2" styler="styler1">OP no.</th>
<th field="style" width="95" sortable="true" rowspan="2" styler="styler1">Style</th>
<th field="color" width="95" sortable="true" rowspan="2" styler="styler1">Color</th>
<th field="fob" width="95" sortable="true" formatter="formatter1" rowspan="2" styler="styler1"
<?php if($_SESSION['gusernm']=="wh1" || $_SESSION['gusernm']=="ppic" || $_SESSION['gusernm']=="pur2"){ ?>
hidden="true"
<?php } ?>
>FOB</th>
<th field="ddp" width="95" sortable="true" formatter="formatter1" rowspan="2" styler="styler1"
<?php if($_SESSION['gusernm']=="wh1" || $_SESSION['gusernm']=="ppic" || $_SESSION['gusernm']=="pur2"){ ?>
hidden="true"
<?php } ?>
>DDP</th>
<th field="gac2" width="92" sortable="true" rowspan="2" styler="styler1">PCD</th>
<th field="pcd2" width="92" sortable="true" rowspan="2" styler="styler1">Ex Factory</th>
<th field="secsz" width="92" sortable="true" rowspan="2" styler="styler1">Sec.Size</th>
<?php if($dth['bdownpk']>0){ ?>
<th colspan="<?php echo $cjml; ?>" width="1800"><b>Quantity / Size</b></th>
<?php } else { ?>
<th colspan="40" width="1800"><b>Quantity / Size</b></th>
<?php } ?>
<th field="tot" width="85" sortable="false" rowspan="2">Total</th>
</tr>
<tr>
<?php 
for($i = 1; $i <= 25; $i++) {
?>
<th field="s<?php echo $i; ?>" width="60" styler="styler1" sortable="false" <?php echo $hiddens[$i]; ?>> </th>
<?php } ?>
</tr>
</thead>
</table>
<br>
</div>
</div>

	<!--export excel-->
	<div id="dialog-formb" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
		data-options="border:false,title:false,resizable:true,modal:true,closable:false"
		style="width:425px;height:200px;padding:5px 5px;display:none;top:50px;border-radius:8px;">
		<form id="formb" method="post" enctype="multipart/form-data">
			<input type="hidden" name="ordpk" id="ordpkexp" size="8">
			<!-- <div class="modal-dialog" style="height:175px;"> -->
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<div class="modal-title" style="width:auto;font-size:18px;line-height:20px;">
						Print Breakdown Order no. <span id="ordnoexp"></span> <br>
					</div>
				</div>
				<!-- Modal body -->
				<div style="padding:5px; margin-top:60px; margin-left:25px;">
					<span id="cek1"><input type="radio" name="cek" id="cek" value="1" checked>PDF</span>
					<span id="cek2"><input type="radio" name="cek" id="cek" value="2">Excel</span>
				</div>
				<!--<div class="font-excel-template"><a href="action/file_RKB_new.xlsx" target="_blank" style="text-decoration:none;"> Download excel template </a></div>-->
				<a style="text-decoration:none; left: 169px; top: 100px;" href="javascript:void(0)"
					class="button-cancel" onclick="canexp();">Cancel</a>
				<a style="text-decoration:none; width:100px; left: 246px; top: 100px;" href="javascript:void(0)"
					class="button-submit" onclick="cetak();">Export</a>
				<!--<input type="submit" id="submit" name="submit" value="Submit" class="button-submit">-->
				<!-- </div> -->
		</form>
	</div>

  <div id="dialog-formhistory" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons" data-options="border:false,title:false,resizable:false,modal:true,closable:false"
	style="width:750px;height:450px;padding:5px 5px;display:none;top:15%;border-radius:8px;">
	<div id="close" style="margin-top:0px; margin-left:700px;">
		<a id="close" href="javascript:void(0)" style="font-weight:normal; text-decoration:none; color:#00000099;; font-size:35px;"
			onclick="$('#dialog-formhistory').dialog('close');">&#215;</a>
	</div>
	<div style="margin-left: 15px;margin-top: -20px;font-style: normal;font-weight: 700;font-size: 16px;line-height: 20px;">
		Order Breakdown History Log</div>
	<style>
		.lines-no3 .datagrid-body td {
			border-right: 2px solid #FFFFFF;
			border-bottom: 2px solid #FFFFFF;
		}
	</style>
	<div style="margin-top: 15px;margin-left:15px;">
		<table id="dg2c" class="easyui-datagrid" title="" style="width:98%;height:350px;" align="center" border="none" striped="false"
			data-options="singleSelect:true,pagination:false,collapsible:true,rownumbers:false,border:true,autoRowHeight:true">
			<thead>
				<tr>
					<th field="datelog" width="200" style="border:none;">Date of edit</th>
					<th field="action" width="500">Action</th>
				</tr>
			</thead>
		</table>
	</div>
</div>
<script type="text/javascript">
window.onscroll = function(){ myFunction(); };
var header = document.getElementById("myHeader");
var sticky = header.offsetTop;
function myFunction(){
if (window.pageYOffset > sticky){
header.classList.add("sticky");
} else {
header.classList.remove("sticky");
}
}
</script>
<?php } else {?>
  <!-- <div class="contenta" style="text-align:left;">
  <div id="frame-utama-cari" style="width:720px;text-align:left;margin-left:-31%;">

<div style="font-size:14px;font-weight:400;color:#d3d3d3;text-align:left;margin-top:10%;">No data available. Please check in again later.</div>
</div>
</div> -->
<div id="frame-utama-cari" style="width:auto;text-align:left;top:180px;">
<span style="font-size:14px;font-weight:400;color:#d3d3d3;text-align:left;">No data available. Please check in again later.</span>
</div>
</div>
<?php } ?>