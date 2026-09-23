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
top: 58px;

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

.dropbtn1x {
			background-color: #3498DB;
			color: white;
			padding: 16px;
			font-size: 16px;
			/* margin-left: -400px; */
			border: none;
			cursor: pointer;
		}

		.dropbtn1x:hover,
		.dropbtn1x:focus {
			background-color: #2980B9;
		}

		.dropdown1x {
			position: relative;
			display: inline-block;
		}

		.dropdown-content1x {
    display: none;
    position: absolute;
    background-color: #FFFFFF;
    min-width: 200px;
    overflow: auto;
    margin-left: -125px;
    margin-top: 15px;
    text-align: left;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
  }

  .dropdown-content1x a {
    color: black;
    padding: 7px 12px;
    text-decoration: none;
    display: block;
  }

		.dropdown1x a:hover {
			background-color: #ddd;
		}

		.show {
			display: block;
		}

    .dropdown-toggle-custom {
			border-style: none !important;
		}

		.dropdown-toggle-custom:active {
			border-style: none !important;
		}

		.dropdown-menu {
			box-shadow: 0px 0px 16px -4px rgba(0, 0, 0, 0.12);
			border-radius: 0px;
			border-style: none !important;
		}

		.dropdown-item {
			border-style: none !important;
			/* font-family: Arial; */
			font-style: normal;
			font-weight: 400;
			font-size: 14px;
			line-height: 18px;
			color: #359DD9;
		}

		.dropdown-item:hover {
			background-color: transparent;
			border-style: none !important;
			color: #359DD9;

		}

		.dropdown-item:active {
			background-color: transparent;
			border-style: none !important;

		}
</style>
<script type="text/javascript">
var url;
function myFunction1x() {
			document.getElementById("myDropdown1x").classList.toggle("show");
		}

		window.onclick = function (event) {
			if (!event.target.matches('.dropbtn1x')) {
				var dropdowns = document.getElementsByClassName("dropdown-content1x");
				var i;
				for (i = 0; i < dropdowns.length; i++) {
					var openDropdown = dropdowns[i];
					if (openDropdown.classList.contains('show')) {
						openDropdown.classList.remove('show');
					}
				}
			}
		}

/*menu*/
function menu(){
	var row = $('#dg').datagrid('getSelected');
	if(row){
    test = $('#test').val();
    if(test==1){
	$('#myHeader').show();
    $('#edit').hide();
	$('#save2').hide();
    $('#save').hide();
    } else {
    $('#myHeader').show();
    $('#edit').hide();
    $('#save').hide();
	$('#save2').hide();
    }
	} else {
	$('#myHeader').hide();
	$('#dg').datagrid('clearSelections');
	}
}

function menu2(){
	var row = $('#dg').datagrid('getSelected');
	if(row){
	$('#myHeader').show();
    $('#edit').hide();
    $('#save').hide();
	$('#save2').hide();
	} else {
	$('#myHeader').hide();
	$('#dg').datagrid('clearSelections');
	}
}

function edit(){
    test = 1;
    document.getElementById("test").value = test;
    $('#dg').edatagrid('addRow2');
    $('#myHeader').show();
    $('#edit').hide();
    $('#save').hide();
	$('#save2').hide();
	var dg = $('#dg');
	var hd = dg.datagrid('getPanel').find('div.datagrid-header td');
	hd.css('border','0.3px solid #b2b2b2');
	var td = dg.datagrid('getPanel').find('div.datagrid-body td[field="country"]');
	var td1 = dg.datagrid('getPanel').find('div.datagrid-body td[field="pono"]');
  var td2 = dg.datagrid('getPanel').find('div.datagrid-body td[field="opno"]');
  var td3 = dg.datagrid('getPanel').find('div.datagrid-body td[field="style"]');
	var td4 = dg.datagrid('getPanel').find('div.datagrid-body td[field="color"]');
  var td4b = dg.datagrid('getPanel').find('div.datagrid-body td[field="fob"]');
	var td5 = dg.datagrid('getPanel').find('div.datagrid-body td[field="gac2"]');
	var td6 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s1"]');
	var td7 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s2"]');
	var td8 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s3"]');
	var td9 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s4"]');
	var td10 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s5"]');
	var td11 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s6"]');
	var td12 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s7"]');
	var td13 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s8"]');
	var td14 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s9"]');
	var td15 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s10"]');
	var td16 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s11"]');
	var td17 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s12"]');
	var td18 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s13"]');
	var td19 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s14"]');
	var td20 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s15"]');
  var td21 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s16"]');
  var td22 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s17"]');
  var td23 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s18"]');
  var td24 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s19"]');
  var td25 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s20"]');
  var td26 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s21"]');
  var td27 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s22"]');
  var td28 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s23"]');
  var td29 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s24"]');
  var td30 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s25"]');
  var td31 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s26"]');
  var td32 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s27"]');
  var td33 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s28"]');
  var td34 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s29"]');
  var td35 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s30"]');
  var td36 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s31"]');
  var td37 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s32"]');
  var td38 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s33"]');
  var td39 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s34"]');
  var td40 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s35"]');
  var td41 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s36"]');
  var td42 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s37"]');
  var td43 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s38"]');
  var td44 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s39"]');
  var td45 = dg.datagrid('getPanel').find('div.datagrid-body td[field="s40"]');
	td.css('border-style','ridge');
	td.css('border','1px solid #b2b2b2');
  td.css('border-radius','7px');
  td.css('background-color','#ffffff');
	td1.css('border','1px solid #b2b2b2');
  td1.css('border-radius','7px');
  td1.css('background-color','#ffffff');
  td2.css('border','1px solid #b2b2b2');
  td2.css('border-radius','7px');
  td2.css('background-color','#ffffff');
  td3.css('border','1px solid #b2b2b2');
  td3.css('border-radius','7px');
  td3.css('background-color','#ffffff');
	td4.css('border','1px solid #b2b2b2');
  td4.css('border-radius','7px');
  td4.css('background-color','#ffffff');
  td4b.css('border','1px solid #b2b2b2');
  td4b.css('border-radius','7px');
  td4b.css('background-color','#ffffff');
	td5.css('border','1px solid #b2b2b2');
  td5.css('border-radius','7px');
  td5.css('background-color','#ffffff');
	td6.css('border','1px solid #b2b2b2');
  td6.css('border-radius','7px');
  td6.css('background-color','#ffffff');
	td7.css('border','1px solid #b2b2b2');
  td7.css('border-radius','7px');
  td7.css('background-color','#ffffff');
	td8.css('border','1px solid #b2b2b2');
  td8.css('border-radius','7px');
  td8.css('background-color','#ffffff');
	td9.css('border','1px solid #b2b2b2');
  td9.css('border-radius','7px');
  td9.css('background-color','#ffffff');
	td10.css('border','1px solid #b2b2b2');
  td10.css('border-radius','7px');
  td10.css('background-color','#ffffff');
	td11.css('border','1px solid #b2b2b2');
  td11.css('border-radius','7px');
  td11.css('background-color','#ffffff');
	td12.css('border','1px solid #b2b2b2');
  td12.css('border-radius','7px');
  td12.css('background-color','#ffffff');
	td13.css('border','1px solid #b2b2b2');
  td13.css('border-radius','7px');
  td13.css('background-color','#ffffff');
	td14.css('border','1px solid #b2b2b2');
  td14.css('border-radius','7px');
  td14.css('background-color','#ffffff');
	td15.css('border','1px solid #b2b2b2');
  td15.css('border-radius','7px');
  td15.css('background-color','#ffffff');
	td16.css('border','1px solid #b2b2b2');
  td16.css('border-radius','7px');
  td16.css('background-color','#ffffff');
	td17.css('border','1px solid #b2b2b2');
  td17.css('border-radius','7px');
  td17.css('background-color','#ffffff');
	td18.css('border','1px solid #b2b2b2');
  td18.css('border-radius','7px');
  td18.css('background-color','#ffffff');
	td19.css('border','1px solid #b2b2b2');
  td19.css('border-radius','7px');
  td19.css('background-color','#ffffff');
	td20.css('border','1px solid #b2b2b2');
  td20.css('border-radius','7px');
  td20.css('background-color','#ffffff');
  td21.css('border','1px solid #b2b2b2');
  td21.css('border-radius','7px');
  td21.css('background-color','#ffffff');
  td22.css('border','1px solid #b2b2b2');
  td22.css('border-radius','7px');
  td22.css('background-color','#ffffff');
  td23.css('border','1px solid #b2b2b2');
  td23.css('border-radius','7px');
  td23.css('background-color','#ffffff');
  td24.css('border','1px solid #b2b2b2');
  td24.css('border-radius','7px');
  td24.css('background-color','#ffffff');
  td25.css('border','1px solid #b2b2b2');
  td25.css('border-radius','7px');
  td25.css('background-color','#ffffff');
  td26.css('border','1px solid #b2b2b2');
  td26.css('border-radius','7px');
  td26.css('background-color','#ffffff');
  td27.css('border','1px solid #b2b2b2');
  td27.css('border-radius','7px');
  td27.css('background-color','#ffffff');
  td28.css('border','1px solid #b2b2b2');
  td28.css('border-radius','7px');
  td28.css('background-color','#ffffff');
  td29.css('border','1px solid #b2b2b2');
  td29.css('border-radius','7px');
  td29.css('background-color','#ffffff');
  td30.css('border','1px solid #b2b2b2');
  td30.css('border-radius','7px');
  td30.css('background-color','#ffffff');
  td31.css('border','1px solid #b2b2b2');
  td31.css('border-radius','7px');
  td31.css('background-color','#ffffff');
  td32.css('border','1px solid #b2b2b2');
  td32.css('border-radius','7px');
  td32.css('background-color','#ffffff');
  td33.css('border','1px solid #b2b2b2');
  td33.css('border-radius','7px');
  td33.css('background-color','#ffffff');
  td34.css('border','1px solid #b2b2b2');
  td34.css('border-radius','7px');
  td34.css('background-color','#ffffff');
  td35.css('border','1px solid #b2b2b2');
  td35.css('border-radius','7px');
  td35.css('background-color','#ffffff');
  td36.css('border','1px solid #b2b2b2');
  td36.css('border-radius','7px');
  td36.css('background-color','#ffffff');
  td37.css('border','1px solid #b2b2b2');
  td37.css('border-radius','7px');
  td37.css('background-color','#ffffff');
  td38.css('border','1px solid #b2b2b2');
  td38.css('border-radius','7px');
  td38.css('background-color','#ffffff');
  td39.css('border','1px solid #b2b2b2');
  td39.css('border-radius','7px');
  td39.css('background-color','#ffffff');
  td40.css('border','1px solid #b2b2b2');
  td40.css('border-radius','7px');
  td40.css('background-color','#ffffff');
  td41.css('border','1px solid #b2b2b2');
  td41.css('border-radius','7px');
  td41.css('background-color','#ffffff');
  td42.css('border','1px solid #b2b2b2');
  td42.css('border-radius','7px');
  td42.css('background-color','#ffffff');
  td43.css('border','1px solid #b2b2b2');
  td43.css('border-radius','7px');
  td43.css('background-color','#ffffff');
  td44.css('border','1px solid #b2b2b2');
  td44.css('border-radius','7px');
  td44.css('background-color','#ffffff');
  td45.css('border','1px solid #b2b2b2');
  td45.css('border-radius','7px');
  td45.css('background-color','#ffffff');
}

function tambahrow(){
  $('#dg').edatagrid('addRow');
	var index = $('#dg').edatagrid('getRows').length-1;  // the editing row index
	var ed = $('#dg').edatagrid('getEditors', index)[0];  // get the first editor
	$(ed.target).focus();
	$('#myHeader').show();
	$('#edit').hide();
	$('#save').show();
	$('#save2').hide();
}

function cancel(){
test = "";
document.getElementById("test").value = test;
$('#dg').edatagrid('cancelRow');
$('#dg').datagrid('reload');
$('#myHeader').hide();
$('#dg').datagrid('clearSelections');
var dg = $('#dg');
var hd = dg.datagrid('getPanel').find('div.datagrid-header td');
hd.css('border','');
//save();
}

function save(){
test = "";
document.getElementById("test").value = test;
$('#dg').edatagrid('saveRow');
$('#myHeader').hide();
$('#dg').datagrid('clearSelections');
$('#dg').datagrid('reload');
}

function save2(){
test = "";
document.getElementById("test").value = test;
$('#dg').edatagrid('saveRow');
$('#myHeader').fadeOut();
$('#dg').datagrid('clearSelections');
$('#dg').datagrid('reload');
}

function delqty(){
//var spv = document.getElementById("spv").value;
//if(spv==1){
$('#dg').edatagrid('destroyRow');
//} else {
//$.messager.alert('Warning','You are not allowed to delete this order breakdown, please contact your supervisor','warning');	  
//}
}

/*edatagrid*/
$(function(){
  $('#dg').edatagrid({
	saveUrl: 'action/simpan.php?x=qty2&ord=<?php echo $ord; ?>',
  updateUrl:'action/simpan.php?x=qty&ord=<?php echo $ord; ?>',
	destroyUrl: 'action/delete.php?x=qty',
  onSuccess: function(index,row){
	$.messager.show({
	title:'',
	msg:row.msg, 
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
  $('#dg').datagrid('reload');
	save();
	var dg = $('#dg');
	var hd = dg.datagrid('getPanel').find('div.datagrid-header td');
	hd.css('border','');
  $('#myHeader').hide();
	},
  onDestroy: function(index,row){
	$.messager.show({
	title:'',
	msg:row.msg, 
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
  $('#dg').datagrid('reload');
  $('#myHeader').hide();
	}
});
});

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
}
totrec();
}

function totrec() {
   var tcount= JSON.stringify($('#dg').datagrid('getData').total);
	document.getElementById("fltr2").innerHTML = "Selected Filter <br>"+tcount+" result";
}

/*function Search2(){
$('#tabel1').css("margin-top","60px");
$('#cek1').show();
$('#cross1').show();
$('#fltr1').show();
$('#fltr2').show();
$('#fltr3').show();
$('#dg').datagrid('load',{
cari3: $('#place').val(),
cari4: $('#color').val()
});
cari3 = $('#place').val();
document.getElementById("cek1").value = cari3;
}
function unSearch2(){
$('#place').combobox('setValue', place);
$('#cek1').hide();
$('#cross1').hide();
$('#dg').datagrid('load',{
cari3: $('#place').val(),
cari4: $('#color').val(),
});
document.getElementById("cek1").value = '';
}
function Search2b(){
$('#tabel1').css("margin-top","60px");
$('#cek2').show();
$('#cross2').show();
$('#fltr1').show();
$('#fltr2').show();
$('#fltr3').show();
$('#dg').datagrid('load',{
cari3: $('#place').val(),
cari4: $('#color').val()
});
cari4 = $('#color').val();
document.getElementById("cek2").value = cari4;
}
function unSearch2b(){
$('#color').combobox('setValue', color);
$('#cek2').hide();
$('#cross2').hide();
$('#dg').datagrid('load',{
cari3: $('#place').val(),
cari4: $('#color').val()
});
document.getElementById("cek2").value = '';
}

function totrec() {
   var tcount= JSON.stringify($('#dg').datagrid('getData').total);
	document.getElementById("fltr2").innerHTML = "Selected Filter <br>"+tcount+" result";
}

function reset() {
//$('#tabel1').css("margin-top","");
$('#color').combobox('setValue', color);
$('#place').combobox('setValue', place);
$('#cek1').hide();
$('#cek2').hide();
$('#fltr1').hide();
$('#fltr2').hide();
$('#fltr3').hide();
$('#cross1').hide();
$('#cross2').hide();
document.getElementById('cek1').value = '';
document.getElementById('cek2').value = '';
$('#dg').datagrid('load',{
cari3: '',
cari4: ''
});
$('#tabel1').css("margin-top","");
}

function tutup() {
   	var cktype1= $('#cek1').val();
	if (cktype1) {
       var ttype1=1;
    } else { var ttype1=0; }
				
	var ckspec1= $('#cek2').val();
		if (ckspec1) {
       var tspec1=1;
    }  else { var tspec1=0; }
				
    var tall1=ttype1+tspec1;
if (tall1==0) {
$('#color').combobox('setValue', color);
$('#place').combobox('setValue', place);
$('#cek1').hide();
$('#cek2').hide();
$('#fltr1').hide();
$('#fltr2').hide();
$('#fltr3').hide();
$('#cross1').hide();
$('#cross2').hide();
document.getElementById('cek1').value = '';
document.getElementById('cek2').value = '';
$('#dg').datagrid('load',{
cari3: '',
cari4: ''
});
$('#tabel1').css("margin-top","");
}
}*/

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
				url = "pdf/pdf_qty2?ord="+ord+"&cari="+cari+"&cari2="+cari2+"&cari3="+cari3;
				window.open(url);
			} else {
				url = "excel/excel_qty?ord="+ord+"&cari="+cari+"&cari2="+cari2+"&cari3="+cari3;
				window.open(url);
			}
}

//combobox dengan chekbox
$(function() {
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

function styler1(index, row){
        if (row.jenis=="HEADER") {
            return 'font-weight:bold';
        }else{
            return '';
        }
    }

    function upload() {
      document.getElementById("ordpkexp2").value = <?php echo $ord; ?>;
			$.ajax({
				type: "POST",
				url: "view/get_ordno.php",
				data: "ord=<?php echo $ord; ?>",
				success: function (data) {
        let text = data;
        const arr = text.split(",");
        var ordno = arr[0];
        var filenm = arr[1];
					document.getElementById('ordnoexp2').innerHTML = ordno;
          document.getElementById('filenm').innerHTML = filenm;
				},
			});
			$('#dialog-form').dialog('open').dialog('setTitle', '');
		}

		function cancelupload() {
			$('#dialog-form').dialog('close');
		}

		function saveupload() {
			$.messager.progress({
				title: '',
				msg: 'Upload in progress...',
				border: 'thin'
			});
			var string = $("#form").serialize();
			$('#form').form('submit', {
				type: "POST",
				url: "action/simpan_bqty.php",
				data: string,
				onSubmit: function () {
					var isValid = $(this).form('validate');
					if (!isValid) {
						$.messager.progress('close');	// hide progress bar while the form is invalid
					}
					return isValid;	// return false will stop the form submission
				},
				onProgress: function (percent) {
					$.messager.progress();
				},
				success: function (data) {
					$.messager.progress('close');
					$('#form').form('clear');
					$('#dialog-form').dialog('close');
					$.messager.show({
						title: '',
						msg: data,
						timeout: 3000,
						showType: 'slide',
						icon: 'info',
						width: 300,
						height: 55,
						style: {
							left: 0,
							right: '',
							top: '',
							bottom: -document.body.scrollTop - document.documentElement.scrollTop
						}
					});
					/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
					$('#dg').datagrid('reload');
				}
			});
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
?>
<!--<div id="menu" onclick="" style="display:none;">
<div class="delete">
<a href="javascript:void(0)" id="edit"  plain="true" onclick="edit();" style="color: #FFFFFF; text-decoration: none;"> Edit </a>
<a href="javascript:void(0)" id="save" plain="true" onclick="save();" style="color: #FFFFFF; text-decoration: none;"> Save </a>
<a href="javascript:void(0)" id="save2" plain="true" onclick="save2();" style="color: #FFFFFF; text-decoration: none;"> Save </a>
</div>
<div class="delete"><a href="javascript:void(0)" plain="true" onclick="cancel();" style="color: #FFFFFF; text-decoration: none;"> Cancel </a></div>
<div class="delete"><a href="javascript:void(0)" plain="true" onclick="javascript:$('#dg').edatagrid('destroyRow')" style="color: #FFFFFF; text-decoration: none;">Delete </a></div>-->
<!--</div>-->
<div class="contenta">
<div id="frame-utama-cari" style="width:835px;">
<div id="container-cari">
<div id="frame-cari">
<img src="css/images/Shape.png" plain="true" width="18px" height="18px" onclick="tutup2();">
<input id="cari1" placeholder="Search..." class="input" plain="true" onkeyup="Search();">
</div>
</div>
<!-- <input style="width:119px;" type="button" name="submit" value="Print breakdown" class="button-submit-add" plain="true" 
href="javascript:void(0);" onclick="exp()"> -->
<div class="dropdown1x" style="left:0px;">
<button class="dropbtn1x" id="act" onclick="myFunction1x()"
style="padding:5px;color:#FFFFFF;background-color:#000000;border-radius:8px;cursor:pointer">Action &#9660;</button>
<div id="myDropdown1x" class="dropdown-content1x">
<a href="javascript:void(0);" onclick="upload();">Upload breakdown</a>
<hr style="border:1px solid #E0E0E0" class="dropdown-divider mt-1 mb-1">
<a href="javascript:void(0);" onclick="exp();">Print breakdown</a>
</div>
</div>

<input style="width:150px; height:28px;" id="place" name="place" class="easyui-combobox"
data-options="prompt:'Place',onChange:Search2,panelHeight:'auto',limitToList:'true',multiple:true,
url:'view/get_data.php?dt=qty&ord=<?php echo $ord; ?>',valueField:'country',textField:'country',"/>

<input style="width:150px; height:28px;" id="color" name="color" class="easyui-combobox"
data-options="prompt:'Color',onChange:Search2b,panelHeight:'auto',limitToList:'true',multiple:true,
url:'view/get_data.php?dt=qty2&ord=<?php echo $ord; ?>',valueField:'color',textField:'color',"/>

<input style="width:150px; height:28px;" id="secsz" name="secsz" class="easyui-combobox"
data-options="prompt:'Sec.Size',onChange:Search2c,panelHeight:'auto',limitToList:'true',multiple:true,
url:'view/get_data.php?dt=qty3&ord=<?php echo $ord; ?>',valueField:'secsz',textField:'secsz',"/>
<?php //if($cjml>0){ ?>
<a href="javascript:void(0);" style="text-decoration:none;" onclick="tambahrow(); scrollToBottom();">
<span style="font-style: normal;font-weight: 700;font-size: 14px;line-height: 18px;color: #359DD9;">Add order</span></a>
<?php  //} ?>
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
$dtu=mysqli_fetch_array(mysqli_query($koneksi,"select * from logtran where ordpk='$ord' and lognote like '%data qty%' 
order by logdtime desc limit 1"));
?>
<div id="frame-utama-cari" style="width:auto;text-align:left;top:190px;">
<span style="font-size:14px;font-weight:400;color:rgba(0, 0, 0, 0.38);text-align:left;">
Last updated orders <?php echo tglu($dtu['logdate']);?> <?php echo $dtu['logtime']; ?>
</span>
</div>

<div id="tabel1" onclick="menu();" ondblclick="menu2();" style="top:220px;">
<table id="dg" class="easyui-datagrid" title="" style="width:100%;height:auto;" align="center"
url="view/get_detord.php?ord=<?php echo $ord; ?>" idField="bdownpk" toolbar="#tb" striped="true" showFooter="true"
pagination="false" rownumbers="false" singleSelect="true" collapsible="true" fitColumns="false"
data-options="multiSort:true,remoteSort:false">
<!--data-options="rowStyler: function(index,row){
            if (row.jenis == 'FOOTER'){
            return 'background-color:#d8d8d8;color:#000000;';
            }
			else if (row.jenis == 'HEADER'){
            return 'background-color:#ff0000;color:#fff;';
            }
            }"-->
<thead>
<tr>
<th field="country" width="95" sortable="true" rowspan="2" styler="styler1" editor="{type:'validatebox',options:{}}">Place</th>
<th field="poref" width="94" sortable="true" rowspan="2" styler="styler1" editor="{type:'validatebox',options:{}}">License<br>PO Ref</th>
<th field="pono" width="94" sortable="true" rowspan="2" styler="styler1" editor="{type:'validatebox',options:{}}">PO no.</th>
<th field="opno" width="95" sortable="false" rowspan="2" styler="styler1" editor="{type:'validatebox',options:{}}">OP no.</th>
<th field="style" width="95" sortable="true" rowspan="2" styler="styler1" editor="{type:'validatebox',options:{}}">Style</th>
<th field="color" width="95" sortable="true" rowspan="2" styler="styler1" editor="{type:'validatebox',options:{}}">Color</th>
<th field="fob" width="80" sortable="true" rowspan="2" styler="styler1" formatter="formatter1" editor="{type:'validatebox',options:{}}">FOB</th>
<th field="ddp" width="80" sortable="true" rowspan="2" styler="styler1" formatter="formatter1" editor="{type:'validatebox',options:{}}">DDP</th>
<th styler="styler1" data-options="field:'gac2',width:92,sortable:'true',editor:{type:'datebox',
options:{formatter:myformatter,parser:myparser}}" rowspan="2">Ex Factory</th>
<th field="secsz" width="95" sortable="true" rowspan="2" styler="styler1" editor="{type:'validatebox',options:{}}">Sec.Size</th>
<?php if($dth['bdownpk']>0){ ?>
<th colspan="<?php echo $cjml; ?>" width="1800"><b>Quantity / Size</b></th>
<?php } else { ?>
<th colspan="40" width="1800"><b>Quantity / Size</b></th>
<?php } ?>
<th field="tot" width="100" sortable="false" rowspan="2">Total</th>
</tr>
<tr>
<th field="s1" width="60" sortable="false" styler="styler1" editor="{type:'validatebox',options:{}}" <?php echo $hidden1; ?>></th>
<th field="s2"  width="60" sortable="false" styler="styler1" editor="{type:'validatebox',options:{}}" <?php echo $hidden2; ?>></th>
<th field="s3"  width="60" sortable="false" styler="styler1" editor="{type:'validatebox',options:{}}" <?php echo $hidden3; ?>></th>
<th field="s4"  width="60" sortable="false" styler="styler1" editor="{type:'validatebox',options:{}}" <?php echo $hidden4; ?>></th>
<th field="s5"  width="60" sortable="false" styler="styler1" editor="{type:'validatebox',options:{}}" <?php echo $hidden5; ?>></th>
<th field="s6"  width="60" sortable="false" styler="styler1" editor="{type:'validatebox',options:{}}" <?php echo $hidden6; ?>></th>
<th field="s7"  width="60" sortable="false" styler="styler1" editor="{type:'validatebox',options:{}}" <?php echo $hidden7; ?>></th>
<th field="s8"  width="60" sortable="false" styler="styler1" editor="{type:'validatebox',options:{}}" <?php echo $hidden8; ?>></th>
<th field="s9"  width="60" sortable="false" styler="styler1" editor="{type:'validatebox',options:{}}" <?php echo $hidden9; ?>></th>
<th field="s10"  width="60" sortable="false" styler="styler1" editor="{type:'validatebox',options:{}}" <?php echo $hidden10; ?>></th>
<th field="s11"  width="60" sortable="false" styler="styler1" editor="{type:'validatebox',options:{}}" <?php echo $hidden11; ?>></th>
<th field="s12"  width="60" sortable="false" styler="styler1" editor="{type:'validatebox',options:{}}" <?php echo $hidden12; ?>></th>
<th field="s13"  width="60" sortable="false" styler="styler1" editor="{type:'validatebox',options:{}}" <?php echo $hidden13; ?>></th>
<th field="s14"  width="60" sortable="false" styler="styler1" editor="{type:'validatebox',options:{}}" <?php echo $hidden14; ?>></th>
<th field="s15"  width="60" sortable="false" styler="styler1" editor="{type:'validatebox',options:{}}" <?php echo $hidden15; ?>></th>
<th field="s16"  width="60" sortable="false" styler="styler1" editor="{type:'validatebox',options:{}}" <?php echo $hidden16; ?>></th>
<th field="s17"  width="60" sortable="false" styler="styler1" editor="{type:'validatebox',options:{}}" <?php echo $hidden17; ?>></th>
<th field="s18"  width="60" sortable="false" styler="styler1" editor="{type:'validatebox',options:{}}" <?php echo $hidden18; ?>></th>
<th field="s19"  width="60" sortable="false" styler="styler1" editor="{type:'validatebox',options:{}}" <?php echo $hidden19; ?>></th>
<th field="s20"  width="60" sortable="false" styler="styler1" editor="{type:'validatebox',options:{}}" <?php echo $hidden20; ?>></th>
<th field="s21"  width="60" sortable="false" styler="styler1" editor="{type:'validatebox',options:{}}" <?php echo $hidden21; ?>></th>
<th field="s22"  width="60" sortable="false" styler="styler1" editor="{type:'validatebox',options:{}}" <?php echo $hidden22; ?>></th>
<th field="s23"  width="60" sortable="false" styler="styler1" editor="{type:'validatebox',options:{}}" <?php echo $hidden23; ?>></th>
<th field="s24"  width="60" sortable="false" styler="styler1" editor="{type:'validatebox',options:{}}" <?php echo $hidden24; ?>></th>
<th field="s25"  width="60" sortable="false" styler="styler1" editor="{type:'validatebox',options:{}}" <?php echo $hidden25; ?>></th>
<th field="s26"  width="60" sortable="false" styler="styler1" editor="{type:'validatebox',options:{}}" <?php echo $hidden26; ?>></th>
<th field="s27"  width="60" sortable="false" styler="styler1" editor="{type:'validatebox',options:{}}" <?php echo $hidden27; ?>></th>
<th field="s28"  width="60" sortable="false" styler="styler1" editor="{type:'validatebox',options:{}}" <?php echo $hidden28; ?>></th>
<th field="s29"  width="60" sortable="false" styler="styler1" editor="{type:'validatebox',options:{}}" <?php echo $hidden29; ?>></th>
<th field="s30"  width="60" sortable="false" styler="styler1" editor="{type:'validatebox',options:{}}" <?php echo $hidden30; ?>></th>
<th field="s31"  width="60" sortable="false" styler="styler1" editor="{type:'validatebox',options:{}}" <?php echo $hidden31; ?>></th>
<th field="s32"  width="60" sortable="false" styler="styler1" editor="{type:'validatebox',options:{}}" <?php echo $hidden32; ?>></th>
<th field="s33"  width="60" sortable="false" styler="styler1" editor="{type:'validatebox',options:{}}" <?php echo $hidden33; ?>></th>
<th field="s34"  width="60" sortable="false" styler="styler1" editor="{type:'validatebox',options:{}}" <?php echo $hidden34; ?>></th>
<th field="s35"  width="60" sortable="false" styler="styler1" editor="{type:'validatebox',options:{}}" <?php echo $hidden35; ?>></th>
<th field="s36"  width="60" sortable="false" styler="styler1" editor="{type:'validatebox',options:{}}" <?php echo $hidden36; ?>></th>
<th field="s37"  width="60" sortable="false" styler="styler1" editor="{type:'validatebox',options:{}}" <?php echo $hidden37; ?>></th>
<th field="s38"  width="60" sortable="false" styler="styler1" editor="{type:'validatebox',options:{}}" <?php echo $hidden38; ?>></th>
<th field="s39"  width="60" sortable="false" styler="styler1" editor="{type:'validatebox',options:{}}" <?php echo $hidden39; ?>></th>
<th field="s40"  width="60" sortable="false" styler="styler1" editor="{type:'validatebox',options:{}}" <?php echo $hidden40; ?>></th>
</tr>
</thead>
</table>
</div>
</div>
<div class="header" id="myHeader" onclick="" style="display:none;">
<div class="delete">
<a href="javascript:void(0)" id="edit"  plain="true" onclick="edit();" style="color: #FFFFFF; text-decoration: none;"> Edit </a>
<a href="javascript:void(0)" id="save" plain="true" onclick="save();" style="color: #FFFFFF; text-decoration: none;"> Save </a>
<a href="javascript:void(0)" id="save2" plain="true" onclick="save2();" style="color: #FFFFFF; text-decoration: none;"> Save </a>
</div>
<div class="delete" style="width:auto;"><a href="javascript:void(0)" plain="true" onclick="cancel();" style="color: #FFFFFF; text-decoration: none;display:none;"> Cancel </a></div>
<div class="delete" style="width:auto;"><a href="javascript:void(0)" plain="true" onclick="delqty();" style="color: #FFFFFF; text-decoration: none;">Delete Row</a></div>
<div class="delete" style="width:auto;"><a href="javascript:void(0)" plain="true" onclick="$('#myHeader').hide(); $('#dg').datagrid('clearSelections'); $('#dg').edatagrid('cancelRow');" style="color: #FFFFFF; text-decoration: none;"> Close menu </a></div>
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

  <!--upload1-->
	<div id="dialog-form" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons"
		data-options="border:false,title:false,resizable:false,modal:true,closable:false"
		style="width:425px;height:310px;padding:5px 5px;display:none;top:15px;border-radius:8px;">
		<form id="form" method="post" enctype="multipart/form-data">
    <input type="hidden" name="ordpk" id="ordpkexp2" size="8">
			<!-- <div class="modal-dialog" style="width:98%; height:96%;"> -->
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<div class="modal-title">Add order breakdown
          <span id="ordnoexp2"></span>
					</div>
				</div>
				<!-- Modal body -->
				<div class="border-modal">
					<div style="padding:5px;">
						<input name="uploadfile" id="uploadfile" class="easyui-filebox" style="width:100%;"
							data-options="
	buttonText:'Upload order excel file',
	buttonAlign:'left',
  label:'',
  labelPosition: '',
  labelWidth:'',
	required:'true',
  validType:''">
					</div>
					<div align="center" style="padding:10px;">
						<img src="css/images/xls.png" style="width:18px; height:18px;">
						<!-- <input name="filenm" id="filenm" style="border:none;" readonly> -->
             <span id="filenm"></span>
					</div>
				</div>
				<div class="font-excel-template" style="width: auto;"><a href="excel/excel_bqty?ord=<?php echo $ord; ?>"
						target="_blank" style="text-decoration:none;"> Download order breakdown template </a>
					<!-- <br><span style="color:red; font-style: italic;">Update excel template coloumn DDP & Sec.Size</span> -->
				</div>
				<a style="text-decoration:none; left: 129px; top: 245px;" href="javascript:void(0)"
					class="button-cancel" onclick="cancelupload();">Cancel</a>
				<a style="text-decoration:none; left: 206px; top: 245px;" href="javascript:void(0)"
					class="button-submit" onclick="saveupload();">Submit</a>
				<!-- <input type="submit" id="submit" name="submit" value="Submit" class="button-submit">-->
				<!-- </div> -->
		</form>
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
