<?php
//include "action/sinkron2.php";
/*include "email/rev1.php";*/
//include "email/po.php";
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
top: 58px;
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
</style>
<script type="text/javascript">
var url;

/*$(function(){
var dg = $('#dg');
//dg.datagrid({...});
var dc = dg.data('datagrid').dc;
var body = dc.body1.add(dc.body2);
body.unbind('click').bind('click',function(e){
	var tr = $(e.target).closest('tr.datagrid-row');
	var index = parseInt(tr.attr('datagrid-row-index'));
	if (!e.ctrlKey){
		dg.datagrid('clearSelections').datagrid('selectRow',index);
	} else {
		if (tr.hasClass('datagrid-row-selected')){
			dg.datagrid('unselectRow',index);
		} else {
			dg.datagrid('selectRow',index);
		}
	}
});
});*/

/*$(function(){
var tg = $('#dg');
//tg.treegrid({...});  // create treegrid
var panel = tg.treegrid('getPanel');
var body1 = panel.find('div.datagrid-view1 div.datagrid-body-inner');
var body2 = panel.find('div.datagrid-view2 div.datagrid-body');
var body = body1.add(body2);  // the body container
body.unbind('click').bind('click',function(e){
	var tr = $(e.target).closest('tr.datagrid-row');
	var id = tr.attr('node-id');
	if (!e.ctrlKey){
		tg.treegrid('clearSelections').treegrid('selectRow',id);
	} else {
		if (tr.hasClass('datagrid-row-selected')){
			tg.treegrid('unselectRow',id);
		} else {
			tg.treegrid('selectRow',id);
		}
	}
});
});*/

/*menu*/
function menu(){
	var row = $('#dg').datagrid('getSelected');
	if(row){
		$('#myHeader').show();
  count_row();
	} else {
	$('#myHeader').hide();
	$('#dg').datagrid('clearSelections');
	}
}

function menu2(){
$('#myHeader').hide();	
}

/*search*/
function Search(){
$('#dg').datagrid('load',{
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari5: $('#cari5').val(),
cari6: $('#cari6').val(),
cari7: $('#cari7').val(),
supp0: $('#filtera0').val(),
supp1: $('#filtera1').val(),
col0: $('#filterb0').val(),
col1: $('#filterb1').val(),
spec0: $('#filterc0').val(),
spec1: $('#filterc1').val()
});
$('#dg').datagrid('clearChecked');
srcsupp();
srccolor();
srcspecb();
}

function Searcha(){
$('#dg').datagrid('load',{
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari5: $('#cari5').val(),
cari6: $('#cari6').val(),
cari7: $('#cari7').val(),
cari3: $('#cari3').val(),
supp0: $('#filtera0').val(),
supp1: $('#filtera1').val(),
col0: $('#filterb0').val(),
col1: $('#filterb1').val(),
spec0: $('#filterc0').val(),
spec1: $('#filterc1').val()
});
$('#newest').show();
$('#oldest').hide();
 }

function Searchb(){
$('#dg').datagrid('load',{
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari5: $('#cari5').val(),
cari6: $('#cari6').val(),
cari7: $('#cari7').val(),
cari4: $('#cari4').val(),
supp0: $('#filtera0').val(),
supp1: $('#filtera1').val(),
col0: $('#filterb0').val(),
col1: $('#filterb1').val(),
spec0: $('#filterc0').val(),
spec1: $('#filterc1').val()
});
$('#newest').hide();
$('#oldest').show();
}

function Search4(){
    $('#kolom1').datagrid('load',{
    cari6: $('#cari6').val()
    });
}

function Searchc(){
  $('#dg2').datagrid('load',{
    cari9: $('#cari9').val(),
    cari10: $('#cari10').val(),
    cari11: $('#cari11').val()
    });
}

function Search5(){
    $('#color').datagrid('load',{
    carispl: $('#carispl').val()
				/*cari2: $('#cari2').val(),
				cari5: $('#cari5').val(),
				cari6: $('#cari6').val()*/
    });
				 $('#supp').datagrid('load',{
    carispl: $('#carispl').val()
    });
					$('#specb').datagrid('load',{
    carispl: $('#carispl').val()
    });
}

$(function(){
 Search();
 srcsupp();
srccolor();
srcspecb();
});

$(function(){
    $('#supp').datagrid({
        onCheck: function(index,row,value){
								$('#tabel1').css("margin-top","50px");
				    var ckk=$('#supp').datagrid('getRows')[index].supnm;
				    document.getElementById("filtera"+index).value = ckk;
								document.getElementById("idxa"+index).value = index;
								document.getElementById("talla"+index).value = 1;
								$('#filtera'+index).show();
								$('#crossa'+index).show();
								$('#dg').datagrid('load',{
supp0: $('#filtera0').val(),
supp1: $('#filtera1').val(),
col0: $('#filterb0').val(),
col1: $('#filterb1').val(),
spec0: $('#filterc0').val(),
spec1: $('#filterc1').val(),
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari5: $('#cari5').val(),
cari6: $('#cari6').val(),
cari7: $('#cari7').val()
				});
				tall();
				var counta= JSON.stringify($('#dg').datagrid('getData').total);
    document.getElementById("fltr2").innerHTML = counta+" result";
								$('#fltr1').show();
								$('#fltr2').show();
								$('#fltr3').show();
    },
        onUncheck: function(index,row,value){
									var total = document.getElementById("total").value;
									if (total==1) {
									reset();
									} else{
									 document.getElementById("carispl").value = "";
										Search5();
        document.getElementById("filtera"+index).value ="";
								$('#filtera'+index).hide();
								$('#crossa'+index).hide();
								$('#dg').datagrid('load',{
supp0: $('#filtera0').val(),
supp1: $('#filtera1').val(),
col0: $('#filterb0').val(),
col1: $('#filterb1').val(),
spec0: $('#filterc0').val(),
spec1: $('#filterc1').val(),
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari5: $('#cari5').val(),
cari6: $('#cari6').val(),
cari7: $('#cari7').val()
				});
				document.getElementById("talla"+index).value = 0;
				tall();
				var counta= JSON.stringify($('#dg').datagrid('getData').total);
    document.getElementById("fltr2").innerHTML = counta+" result";
								$('#fltr1').show();
								$('#fltr2').show();
								$('#fltr3').show();
					}
			}
  });
});

function unceka(cross){
var total = document.getElementById("total").value;
if (total==1) {
					reset();
} else {
var c = cross;
//alert(c);
var ca=document.getElementById("idxa"+c).value;
$('#supp').datagrid('unselectRow',ca);
document.getElementById("carispl").value = "";
Search5();
document.getElementById("filtera"+c).value ="";
document.getElementById("talla"+c).value = 0;
$('#filtera'+c).hide();
$('#crossa'+c).hide();
$('#dg').datagrid('load',{
supp0: $('#filtera0').val(),
supp1: $('#filtera1').val(),
col0: $('#filterb0').val(),
col1: $('#filterb1').val(),
spec0: $('#filterc0').val(),
spec1: $('#filterc1').val(),
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari5: $('#cari5').val(),
cari6: $('#cari6').val(),
cari7: $('#cari7').val()
				});
document.getElementById("idxa"+c).value="";
}
}

$(function(){
    $('#color').datagrid({
        onCheck: function(index,row,value){
								$('#tabel1').css("margin-top","50px");
				    var ckk=$('#color').datagrid('getRows')[index].colname;
				    document.getElementById("filterb"+index).value = ckk;
								$('#filterb'+index).show();
								$('#filterb'+index).show();
								$('#crossb'+index).show();
								$('#fltr1').show();
								$('#fltr2').show();
								$('#fltr3').show();
								document.getElementById("idxb"+index).value = index;
								document.getElementById("tallb"+index).value = 1;
								tall();
								$('#dg').datagrid('load',{
supp0: $('#filtera0').val(),
supp1: $('#filtera1').val(),
col0: $('#filterb0').val(),
col1: $('#filterb1').val(),
spec0: $('#filterc0').val(),
spec1: $('#filterc1').val(),
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari5: $('#cari5').val(),
cari6: $('#cari6').val(),
cari7: $('#cari7').val()
				});
				var counta= JSON.stringify($('#dg').datagrid('getData').total);
    document.getElementById("fltr2").innerHTML = counta+" result";
    },
        onUncheck: function(index,row,value){
									var total = document.getElementById("total").value;
									if (total==1) {
									reset();
									} else{
									 document.getElementById("carispl").value = "";
										Search5();
        document.getElementById("filterb"+index).value ="";
								$('#filterb'+index).hide();
								$('#crossb'+index).hide();
								$('#dg').datagrid('load',{
supp0: $('#filtera0').val(),
supp1: $('#filtera1').val(),
col0: $('#filterb0').val(),
col1: $('#filterb1').val(),
spec0: $('#filterc0').val(),
spec1: $('#filterc1').val(),
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari5: $('#cari5').val(),
cari6: $('#cari6').val(),
cari7: $('#cari7').val()
				});
				document.getElementById("tallb"+index).value = 0;
				tall();
				var counta= JSON.stringify($('#dg').datagrid('getData').total);
    document.getElementById("fltr2").innerHTML = counta+" result";
								$('#fltr1').show();
								$('#fltr2').show();
								$('#fltr3').show();
					}
			}
  });
});

function uncekb(cross){
var total = document.getElementById("total").value;
if (total==1) {
					reset();
} else {
var c = cross;
//alert(c);
var ca=document.getElementById("idxb"+c).value;
$('#color').datagrid('unselectRow',ca);
document.getElementById("carispl").value = "";
Search5();
document.getElementById("filterb"+c).value ="";
document.getElementById("tallb"+c).value = 0;
$('#filterb'+c).hide();
$('#crossb'+c).hide();
$('#dg').datagrid('load',{
supp0: $('#filtera0').val(),
supp1: $('#filtera1').val(),
col0: $('#filterb0').val(),
col1: $('#filterb1').val(),
spec0: $('#filterc0').val(),
spec1: $('#filterc1').val(),
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari5: $('#cari5').val(),
cari6: $('#cari6').val(),
cari7: $('#cari7').val()
				});
document.getElementById("idxb"+c).value="";
}
}

$(function(){
    $('#specb').datagrid({
        onCheck: function(index,row,value){
								$('#tabel1').css("margin-top","50px");
				    var ckk=$('#specb').datagrid('getRows')[index].spec;
				    document.getElementById("filterc"+index).value = ckk;
								$('#filterc'+index).show();
								$('#filterc'+index).show();
								$('#crossc'+index).show();
								$('#fltr1').show();
								$('#fltr2').show();
								$('#fltr3').show();
								document.getElementById("idxc"+index).value = index;
								document.getElementById("tallc"+index).value = 1;
								tall();
								$('#dg').datagrid('load',{
supp0: $('#filtera0').val(),
supp1: $('#filtera1').val(),
col0: $('#filterb0').val(),
col1: $('#filterb1').val(),
spec0: $('#filterc0').val(),
spec1: $('#filterc1').val(),
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari5: $('#cari5').val(),
cari6: $('#cari6').val(),
cari7: $('#cari7').val()
				});
				var counta= JSON.stringify($('#dg').datagrid('getData').total);
    document.getElementById("fltr2").innerHTML = counta+" result";
    },
        onUncheck: function(index,row,value){
									var total = document.getElementById("total").value;
									if (total==1) {
									reset();
									} else{
									 document.getElementById("carispl").value = "";
										Search5();
        document.getElementById("filterc"+index).value ="";
								$('#filterc'+index).hide();
								$('#crossc'+index).hide();
								$('#dg').datagrid('load',{
supp0: $('#filtera0').val(),
supp1: $('#filtera1').val(),
col0: $('#filterb0').val(),
col1: $('#filterb1').val(),
spec0: $('#filterc0').val(),
spec1: $('#filterc1').val(),
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari5: $('#cari5').val(),
cari6: $('#cari6').val(),
cari7: $('#cari7').val()
				});
				document.getElementById("tallc"+index).value = 0;
				tall();
				var counta= JSON.stringify($('#dg').datagrid('getData').total);
    document.getElementById("fltr2").innerHTML = counta+" result";
								$('#fltr1').show();
								$('#fltr2').show();
								$('#fltr3').show();
					}
			}
  });
});

function uncekc(cross){
var total = document.getElementById("total").value;
if (total==1) {
					reset();
} else {
var c = cross;
//alert(c);
var ca=document.getElementById("idxc"+c).value;
$('#specb').datagrid('unselectRow',ca);
document.getElementById("carispl").value = "";
Search5();
document.getElementById("filterc"+c).value ="";
document.getElementById("tallc"+c).value = 0;
$('#filterc'+c).hide();
$('#crossc'+c).hide();
$('#dg').datagrid('load',{
supp0: $('#filtera0').val(),
supp1: $('#filtera1').val(),
col0: $('#filterb0').val(),
col1: $('#filterb1').val(),
spec0: $('#filterc0').val(),
spec1: $('#filterc1').val(),
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari5: $('#cari5').val(),
cari6: $('#cari6').val(),
cari7: $('#cari7').val()
				});
document.getElementById("idxc"+c).value="";
}
}
/* end function search baru */

/*
function ceksup(){
$('#tabel1').css("margin-top","50px");
var ck = $('#supp').datagrid('getChecked');
for(var i=0; i<=1; i++){
var row = $('#supp').datagrid('getRows')[i];
if ($.inArray(row,ck) >= 0){
    document.getElementById("filtera"+i).value = ck[i].supnm;
				$('#filtera'+i).show();
				$('#crossa'+i).show();
document.getElementById("talla"+i).value = 1;
}
if ($.inArray(row,ck) < 0){
    document.getElementById("filtera"+i).value ="";
				$('#filtera'+i).hide();
				$('#crossa'+i).hide();
document.getElementById("talla"+i).value = 0;
}
}
tall();
$('#dg').datagrid('load',{
supp0: $('#filtera0').val(),
supp1: $('#filtera1').val(),
col0: $('#filterb0').val(),
col1: $('#filterb1').val(),
spec0: $('#filterc0').val(),
spec1: $('#filterc1').val()
});
var total = document.getElementById("total").value;
if(total==0){
$('#tabel1').css("margin-top","");
$('#fltr1').hide();
$('#fltr2').hide();
$('#fltr3').hide();
} else {
var counta= JSON.stringify($('#dg').datagrid('getData').total);
document.getElementById("fltr2").innerHTML = counta+" result";
$('#fltr1').show();
$('#fltr2').show();
$('#fltr3').show();	
}
}

function cekcol(){
$('#tabel1').css("margin-top","50px");
var ck = $('#color').datagrid('getChecked');
for(var i=0; i<=1; i++){
var row = $('#color').datagrid('getRows')[i];
if ($.inArray(row,ck) >= 0){
    document.getElementById("filterb"+i).value = ck[i].colname;
				$('#filterb'+i).show();
				$('#crossb'+i).show();
document.getElementById("tallb"+i).value = 1;
}
if ($.inArray(row,ck) < 0){
    document.getElementById("filterb"+i).value ="";
				$('#filterb'+i).hide();
				$('#crossb'+i).hide();
document.getElementById("tallb"+i).value = 0;
}
}
tall();
$('#dg').datagrid('load',{
supp0: $('#filtera0').val(),
supp1: $('#filtera1').val(),
col0: $('#filterb0').val(),
col1: $('#filterb1').val(),
spec0: $('#filterc0').val(),
spec1: $('#filterc1').val()
});
var total = document.getElementById("total").value;
if(total==0){
$('#tabel1').css("margin-top","");
$('#fltr1').hide();
$('#fltr2').hide();
$('#fltr3').hide();
} else {
var counta= JSON.stringify($('#dg').datagrid('getData').total);
document.getElementById("fltr2").innerHTML = counta+" result";
$('#fltr1').show();
$('#fltr2').show();
$('#fltr3').show();	
}
}

function cekspec(){
$('#tabel1').css("margin-top","50px");
var ck = $('#specb').datagrid('getChecked');
for(var i=0; i<=1; i++){
var row = $('#specb').datagrid('getRows')[i];
if ($.inArray(row,ck) >= 0){
    document.getElementById("filterc"+i).value = ck[i].spec;
				$('#filterc'+i).show();
				$('#crossc'+i).show();
document.getElementById("tallc"+i).value = 1;
}
if ($.inArray(row,ck) < 0){
    document.getElementById("filterc"+i).value ="";
				$('#filterc'+i).hide();
				$('#crossc'+i).hide();
document.getElementById("tallc"+i).value = 0;
}
}
tall();
$('#dg').datagrid('load',{
supp0: $('#filtera0').val(),
supp1: $('#filtera1').val(),
col0: $('#filterb0').val(),
col1: $('#filterb1').val(),
spec0: $('#filterc0').val(),
spec1: $('#filterc1').val()
});
var total = document.getElementById("total").value;
if(total==0){
$('#tabel1').css("margin-top","");
$('#fltr1').hide();
$('#fltr2').hide();
$('#fltr3').hide();
} else {
var counta= JSON.stringify($('#dg').datagrid('getData').total);
document.getElementById("fltr2").innerHTML = counta+" result";
$('#fltr1').show();
$('#fltr2').show();
$('#fltr3').show();	
}
}
  
function unceka(cross){
var total = document.getElementById("total").value;
if (total==1) {
reset();
} else {
var c = cross;
$('#supp').datagrid('unselectRow',c);

document.getElementById("filtera"+c).value ="";
$('#filtera'+c).hide();
$('#crossa'+c).hide();
document.getElementById("talla"+c).value = 0;

tall();
$('#dg').datagrid('load',{
supp0: $('#filtera0').val(),
supp1: $('#filtera1').val(),
col0: $('#filterb0').val(),
col1: $('#filterb1').val(),
spec0: $('#filterc0').val(),
spec1: $('#filterc1').val()
});
var counta= JSON.stringify($('#dg').datagrid('getData').total);
document.getElementById("fltr2").innerHTML = counta+" result";
$('#fltr1').show();
$('#fltr2').show();
$('#fltr3').show();
}
}

function uncekb(cross){
var total = document.getElementById("total").value;
if (total==1) {
reset();
} else {
var c = cross;
$('#color').datagrid('unselectRow',c);

document.getElementById("filterb"+c).value ="";
$('#filterb'+c).hide();
$('#crossb'+c).hide();
document.getElementById("tallb"+c).value = 0;

tall();
$('#dg').datagrid('load',{
supp0: $('#filtera0').val(),
supp1: $('#filtera1').val(),
col0: $('#filterb0').val(),
col1: $('#filterb1').val(),
spec0: $('#filterc0').val(),
spec1: $('#filterc1').val()
});
var counta= JSON.stringify($('#dg').datagrid('getData').total);
document.getElementById("fltr2").innerHTML = counta+" result";
$('#fltr1').show();
$('#fltr2').show();
$('#fltr3').show();
}
}

function uncekc(cross){
var total = document.getElementById("total").value;
if (total==1) {
reset();	
} else {
var c = cross;
$('#specb').datagrid('unselectRow',c);

document.getElementById("filterc"+c).value ="";
$('#filterc'+c).hide();
$('#crossc'+c).hide();
document.getElementById("tallc"+c).value = 0;

tall();
$('#dg').datagrid('load',{
supp0: $('#filtera0').val(),
supp1: $('#filtera1').val(),
col0: $('#filterb0').val(),
col1: $('#filterb1').val(),
spec0: $('#filterc0').val(),
spec1: $('#filterc1').val()
});
var counta= JSON.stringify($('#dg').datagrid('getData').total);
document.getElementById("fltr2").innerHTML = counta+" result";
$('#fltr1').show();
$('#fltr2').show();
$('#fltr3').show();
}
}*/

function totrec() {
var tcount= JSON.stringify($('#dg').datagrid('getData').total);
document.getElementById("fltr2").innerHTML = tcount+" result";
}

/*function myFunc(total, num) {
return total - num;
}*/

function tall(){
/*for(var i=0; i<=5; i++){
const ck = [document.getElementById('tall'+i).value];
var tall = ck;
var tall = ck.reduce(myFunc);
alert(ck);
document.getElementById('tall').innerHTML = +ck;
document.getElementById('fltr1').innerHTML = "Search filters("+ck.reduce(myFunc)+")";
}*/
var cka0 = document.getElementById("talla0").value;
var cka1 = document.getElementById("talla1").value;
var ckb0 = document.getElementById("tallb0").value;
var ckb1 = document.getElementById("tallb1").value;
var ckc0 = document.getElementById("tallc0").value;
var ckc1 = document.getElementById("tallc1").value;
var tall = parseInt(cka0)+parseInt(cka1)+parseInt(ckb0)+parseInt(ckb1)+parseInt(ckc0)+parseInt(ckc1);
//alert(tall);
if(tall>=1){
document.getElementById('total').value = tall;
document.getElementById('fltr1').innerHTML = "Search filters("+tall+")";
}
else {
document.getElementById('total').value = tall;
document.getElementById('fltr1').innerHTML = "Search filters(0)";
}
}

function reset(){
//var total = document.getElementById("total").value;
document.getElementById("carispl").value = "";
Search5();
document.getElementById('total').value = 0;
$('#supp').datagrid('clearSelections');
$('#color').datagrid('clearSelections');
$('#specb').datagrid('clearSelections');
$('#tabel1').css("margin-top","");
$(".dropdown2-content").slideUp("fast");
$('#fltr1').hide();
$('#fltr2').hide();
$('#fltr3').hide();
for(var i=0; i<=2; i++){
$('#filtera'+i).hide();
$('#crossa'+i).hide();
document.getElementById('filtera'+i).value = '';
document.getElementById('talla'+i).value = 0;

$('#filterb'+i).hide();
$('#crossb'+i).hide();
document.getElementById('filterb'+i).value = '';
document.getElementById('tallb'+i).value = 0;

$('#filterc'+i).hide();
$('#crossc'+i).hide();
document.getElementById('filterc'+i).value = '';
document.getElementById('tallc'+i).value = 0;

$('#dg').datagrid('load',{
supp0: $('#filtera0').val(),
supp1: $('#filtera1').val(),
col0: $('#filterb0').val(),
col1: $('#filterb1').val(),
spec0: $('#filterc0').val(),
spec1: $('#filterc1').val(),
cari1: $('#cari1').val(),
cari2: $('#cari2').val(),
cari5: $('#cari5').val(),
cari6: $('#cari6').val(),
cari7: $('#cari7').val()
});
}
}

function testku(){
var dg = $('#color');
var dg2= $('#supp');
var dg3= $('#specb');
dg.datagrid();
dg2.datagrid();
dg3.datagrid();
dg.datagrid('getPanel').find('div.datagrid-header').css('display','none');
dg2.datagrid('getPanel').find('div.datagrid-header').css('display','none');
dg3.datagrid('getPanel').find('div.datagrid-header').css('display','none');
$('#supp').datagrid('getPanel').addClass('lines-no');
$('#color').datagrid('getPanel').addClass('lines-no');
$('#specb').datagrid('getPanel').addClass('lines-no');
$('#supp').datagrid('getPanel').addClass('lines-no2');
$('#color').datagrid('getPanel').addClass('lines-no2');
$('#specb').datagrid('getPanel').addClass('lines-no2');
$('#supp').datagrid('getPanel').addClass('col');
$('#color').datagrid('getPanel').addClass('col');
$('#specb').datagrid('getPanel').addClass('col');
}

$.extend($.fn.datagrid.methods, {
    lockColumn: function(jq, field){
        return jq.each(function(){
            var p = $('#kolom1').datagrid('getPanel');    // get the panel
            var cell = p.find('div.datagrid-header td[field=' + field + '] > div.datagrid-cell'); // get the cell
												cell.resizable({disabled:true}); // disable resize
        });
    }
});

function testku2() {
$('#kolom1').datagrid('getPanel').addClass('col');
$('#kolom1').datagrid('getPanel').addClass('lines-no');
$('#kolom1').datagrid('getPanel').addClass('lines-no2');
$('#kolom1').datagrid('lockColumn', 'kolomnm');
$('#kolom1').datagrid('lockColumn', 'ck');
//$('#kolom1').datagrid('getPanel').find('div.datagrid-header input[type=checkbox]').css('outline','2px solid deeppink');
}

function expand() {
const togglePassword2a = document.querySelector("#togglePassword2a");
const togglePassword2b = document.querySelector("#togglePassword2b");
const togglePassword2c = document.querySelector("#togglePassword2c");

     togglePassword2a.addEventListener("click", function () {
					test1 = $('#test1').val();
						test2 = $('#test2').val();
				if (test1=="" && test2=="") {
      $('.tabela').hide();
						document.getElementById('test1').value=1;
						$(".prodesa").css("margin-top","-10px");
						$(".tabelb").css("margin-top","-90px");
						$(".tabelc").css("margin-top","15px");
    } else if (test1==1 && test2==1) {
									$(".tabelb").css("margin-top","-45px");
       $(".tabelc").css("margin-top","20px");
							$('.tabela').show();
								$(".prodesa").css("margin-top","60px");
								document.getElementById('test1').value="";
    }else if (test1=="" && test2==1) {
							$('.tabela').hide();
							$(".prodesa").css("margin-top","-15px");
							$(".tabelb").css("margin-top","-70px");
							document.getElementById('test1').value=1;
							 $(".tabelc").css("margin-top","-45px");
    }else if (test1==1 && test2=="") {
							$('.tabela').show();
							$(".byr").css("margin-top","20px");
							$(".prodesa").css("margin-top","60px");
							$(".seasona").css("margin-top","55px");
							$(".tabelb").css("margin-top","-20px");
							document.getElementById('test1').value="";
							 $(".tabelc").css("margin-top","90px");
    }
				else {
					 $('.tabela').show();
						document.getElementById('test1').value="";
						$(".prodesa").css("margin-top","25px");
						$(".tabelb").css("margin-top","-40px");
						$(".tabelc").css("margin-top","55px");
				}
				this.classList.toggle("bi-eye2");
				});
					
					togglePassword2b.addEventListener("click", function () {
						test1 = $('#test1').val();
						test2 = $('#test2').val();
     if (test1=="" && test2=="") {
      $('.tabelb').hide();
						document.getElementById('test2').value=1;
						$(".seasona").css("margin-top","-10px");
						$(".tabelc").css("margin-top","25px");
    } else if (test1==1 && test2==1) {
       $(".tabelc").css("margin-top","30px");
							$('.tabelb').show();
								$(".seasona").css("margin-top","65px");
								document.getElementById('test2').value="";
    }else if (test1==1 && test2=="") {
     $(".tabelb").css("margin-top","-85px");
							$('.tabelb').hide();
							$(".seasona").css("margin-top","-15px");
							document.getElementById('test2').value=1;
							 $(".tabelc").css("margin-top","-55px");
    }else if (test1=="" && test2==1) {
     $(".prodesa").css("margin-top","60px");
     $(".tabelb").css("margin-top","-20px");
							$('.tabelb').show();
							$(".seasona").css("margin-top","55px");
							document.getElementById('test2').value="";
							 $(".tabelc").css("margin-top","95px");
    }
				else {
					 $('.tabelb').show();
						document.getElementById('test2').value="";
						$(".seasona").css("margin-top","30px");
						$(".tabelc").css("margin-top","55px");
				}
				this.classList.toggle("bi-eye2");
        });
									 togglePassword2c.addEventListener("click", function () {
            $('.tabelc').toggle();
            this.classList.toggle("bi-eye2");
        });
}

function insert(){
 var ids = [];
	var row = $('#dg').datagrid('getSelected');
 var rows = $('#dg').datagrid('getChecked');
	if(row){
  $('#dialog-form2').dialog('open').dialog('setTitle','');
		$('#form2').form('load',row);
  document.getElementById("cari9").value= row.suppk;
  document.getElementById("cari10").value = row.item;
  /*document.getElementById("cari12").value = row.poreqdel;*/
  document.getElementById("speca").innerHTML = row.item;
  $('#dg2').datagrid('load',{
    cari9: $('#cari9').val(),
    cari10: $('#cari10').val(),
    cari11: $('#cari11').val()
    });

	for(var i=0; i<rows.length; i++){
	ids.push(rows[i].rkbpk);
	}
	$.each(ids, function (index, value){
	$.post('action/simpan.php?x=insert&count='+i,{id:value},
function(result){
if (result.success){
	/*$.messager.show({
	title:'',
	msg:result.msg, 
	timeout:3000,
	showType:'slide',
	icon:'info',
	width:252,
	height:55,
	style:{
	left:0,
	right:'',
	bottom:''
	}
	});*/
 document.getElementById("tot").value= i;
 /*$('#dg').datagrid('reload');*/
 } else {
	$.messager.show({
	title:'',
	msg:result.msg, 
	timeout:3000,
	showType:'slide',
	icon:'info',
	width:252,
	height:55,
		style:{
     left:0,
     right:'',
     top:'',
     bottom:-document.body.scrollTop-document.documentElement.scrollTop
     }
	});
 $('#dg').datagrid('reload');
 }
	},'json')
	});
	} else {
		$.messager.alert('Warning','No request data selected','warning');
	}
}

/*count*/
function count_row(){
	$('#myHeader').show();
    var count = $('#dg').datagrid('getChecked').length;
    if (count) {
        document.getElementById("countp").innerHTML = count +" items selected";
    } else {
		document.getElementById("countp").innerHTML = 0 +" items selected";
		}
	}
    
 /*function tot1() {
	var totmat = JSON.stringify($('#dg').datagrid('getData').total);
	if (totmat) {
	document.getElementById("tot1").innerHTML = "New requests ("+totmat+")";
	}
}*/

/*view*/
function view(){
/*var ids = [];
var rows = $('#dg').datagrid('getChecked');*/
var rows = $('#dg').datagrid('getSelected');
	if(rows){
 /*for(var i=0; i<rows.length; i++){
	ids.push(rows[i].rkbpk);
	}
	$.each(ids, function (index, value){
	$.post('pdf/pdf_mat2.php',{id:value});
	cari = $('#cari2').val();*/
 pur = $('#pur').val();
	cari5 = $('#cari5').val();
	cari6 = $('#cari6').val();
 /*alert(value);*/
	url = "pdf/pdf_mat2?cari="+rows.fupk+"&pur="+pur+"&cari5="+cari5+"&cari6="+cari6+"&rkb="+rows.rkbpk;
 window.open(url);
	/*window.location.href="pdf/pdf_rkb.php&cari=breakdown&ord=" +row.ordpk;*/
	/*});*/
 } else {
		$.messager.alert('Warning','No requests data selected','warning');
	}
}

/*revisi*/
function revisi2(){
	cari = $('#cari2').val();
 document.getElementById("fu").value = +cari;
 login = $('#pur').val();
	document.getElementById("userpur").value = login;
 if(cari){
 //url = "pdf/pdf_mat2.php?cari="+cari;
 //window.open(url);
 $('#dialog-form').dialog('open').dialog('setTitle','');
 //$('#form').form('reset');
 } else {
 $.messager.alert('Warning','Handle must be selected','warning'); 
 }
}

function revisi3(){
	//cari = $('#cari2').val();
    var ids = [];
    var rows = $('#dg').datagrid('getSelections');
    var row = $('#dg').datagrid('getSelected');
    if (row) {
        var aaa = row.fupk;
    }
    for(var i=0; i<rows.length; i++){
    ids.push(rows[i].fupk);
       if (ids[i]!= aaa) {
         $.messager.alert('Warning','Handle must be same','warning');
         $('#dg').datagrid('clearChecked');
       } else {

       }
    }
}

function revisi3b(){
	//cari = $('#cari2').val();
    var ids = [];
    var rows = $('#dg').datagrid('getSelections');
    var row = $('#dg').datagrid('getSelected');
    if (row) {
        var aaa = row.supnm;
    }
    for(var i=0; i<rows.length; i++){
    ids.push(rows[i].supnm);
       if (ids[i]!= aaa) {
         $.messager.alert('Warning','Supplier must be same','warning');
         $('#dg').datagrid('clearChecked');
       } else {

       }
    }
}

function revisi(){
var ids = [];
var rows = $('#dg').datagrid('getChecked');
	if(rows){
 cari = $('#cari2').val();
 document.getElementById("fu").value = +cari;
 login = $('#pur').val();
	document.getElementById("userpur").value = login;
 //if(cari){
	//alert(i);
	//document.getElementById("rkb2").value = ids;
	for(var i=0; i<rows.length; i++){
	ids.push(rows[i].rkbpk);
	}
	$.each(ids, function (index, value){
	$.post('action/simpan.php?x=revisi&fu='+cari+'&user='+login,{id:value},function(result){
if (result.success){
	/*$.messager.show({
	title:'',
	msg:result.msg, 
	timeout:3000,
	showType:'slide',
	icon:'info',
	width:430,
	height:55,
	style:{
	left:0,
	right:'',
	bottom:''
	}
	});*/
	$('#dg').datagrid('reload');
	$('#dialog-form').dialog('open').dialog('setTitle','');
 } else {
	$.messager.show({
	title:'',
	msg:result.msg, 
	timeout:3000,
	showType:'slide',
	icon:'info',
	width:430,
	height:55,
		style:{
     left:0,
     right:'',
     top:'',
     bottom:-document.body.scrollTop-document.documentElement.scrollTop
     }
	});
	/*$('#dialog-formc').dialog('close');*/
 }
	},'json')
	});
// } else {
 //$.messager.alert('Warning','Handle must be selected','warning'); 
// }
 } else {
	$.messager.alert('Warning','No requests data selected','warning');
	}
}

/*save*/
function save(){
		var string = $("#form").serialize();
	 $('#form').form('submit',{
  type	: "POST",
		url	: "action/simpan.php?x=revisi2",
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
					width:430,
					height:55,
		style:{
     left:0,
     right:'',
     top:'',
     bottom:-document.body.scrollTop-document.documentElement.scrollTop
     }
					});
			$('#dialog-form').dialog('close');
   $('#form').form('reset');
   $('#dg').datagrid('clearSelections');
   $('#dg').datagrid('clearChecked');
			/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
			$('#dg').datagrid('reload');
		}
	 });
}

function cancel(){
		var string = $("#form").serialize();
	 $('#form').form('submit',{
  type	: "POST",
		url	: "action/simpan.php?x=cancelrev",
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
					width:252,
					height:55,
		style:{
     left:0,
     right:'',
     top:'',
     bottom:-document.body.scrollTop-document.documentElement.scrollTop
     }
					});
			$('#dialog-form').dialog('close');
			/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
   $('#dg').datagrid('clearSelections');
			$('#dg').datagrid('reload');
		}
	 });
}

/*po*/
function new1(){
var s = '<span class="tree-loading" style="padding:8px;display:inline-block;width:16px;height:24px;vertical-align:middle"></span><span style="font-weight:bold;padding:8px;display:inline-block;line-height:24px;vertical-align:middle;"> Processing, please wait...</span>';
var dlg =	$.messager.progress({
 title:'',
 border:'thin',
 msg:s,
 width:275,
	height:72,
 });
$.messager.progress('bar').hide();
dlg.dialog('resize');
 /*var win = $.messager.show({
	title:'',
	msg:s,
	showType:'fade',
	//timeout:0,
 width:252,
	height:55,
	style:{
		right:'',
		bottom:''
	}
});*/
pur = $('#pur').val();
var row = $('#dg').datagrid('getSelected');
//$.post('action/simpan.php?x=po1&pur='+pur+'&rkb='+row.rkbpk);
/*var count = $('#dg').datagrid('getChecked').length;*/
$.ajax({
		   type:"POST",
		   url:"action/simpan.php?x=po1&pur="+pur,
		   data:"rkb="+row.rkbpk,
/*onSubmit: function(){
var isValid = $(this).form('validate');
if(!isValid){
$.messager.progress('close');	// hide progress bar while the form is invalid
}
return isValid;	// return false will stop the form submission
},*/
/*onProgress: function(percent){
$.messager.progress();
},*/
			  success:function(data){
					document.getElementById('popk2b').value=data;
					//var popk = document.getElementById('popk2b').value;
								   },
		   });
var popk = document.getElementById("popk2b").value;

var ids = [];
var rows = $('#dg').datagrid('getChecked');
	//if(rows){
	for(var i=0; i<rows.length; i++){
	ids.push(rows[i].rkbpk);
	}
	$.each(ids, function (index, value){
	$.post('action/simpan.php?x=po1b&popk='+popk+'&rkb='+row.rkbpk+'&pur='+pur+'&sup='+row.suppk+'&item='+row.item+'&count='+i,{id:value},
function(result){
//$.messager.progress('bar').progressbar('setValue', result.progress);
/*var win = $.messager.show({
	title:'',
	msg:s,
	showType:'fade',
	//timeout:0,
 width:252,
	height:55,
	style:{
		right:'',
		bottom:''
	}
});*/
if (result.success){
	$.messager.show({
	title:'',
	msg:result.msg, 
	timeout:3000,
	showType:'slide',
	icon:'info',
	width:252,
	height:55,
		style:{
     left:0,
     right:'',
     top:'',
     bottom:-document.body.scrollTop-document.documentElement.scrollTop
     }
	});
 $('#dg').datagrid('clearSelections');
 $('#dg').datagrid('clearChecked');
	$('#dg').datagrid('reload');
 $.messager.progress('close');
 //win.window('close');
  /*$.ajax({
		   type:"POST",
		   url:"action/simpan.php?x=po1c&pur="+pur,
		   data:"rkb="+row.rkbpk,
			  success:function(data){
					document.getElementById('popk2b').value=data;
					//var popk = document.getElementById('popk2b').value;
					},
		   });*/
  /*var cari1=document.getElementById('cari1').value;
  var cari2=document.getElementById('cari2').value;
  var cari5=document.getElementById('cari5').value;
  var cari6=document.getElementById('cari6').value;
  var cari7=document.getElementById('cari7').value;
 window.location.href="?hal=new&sts=1&cari1="+cari1+"&cari2="+cari2+"&cari5="+cari5+"&cari6="+cari6+"&cari7="+cari7;*/
 //window.location.href="?hal=wait&sts=1";
 /*url = "?hal=wait";
 window.open(url);*/
 } else {
	$.messager.show({
	title:'',
	msg:result.msg, 
	timeout:3000,
	showType:'slide',
	icon:'info',
	width:252,
	height:55,
		style:{
     left:0,
     right:'',
     top:'',
     bottom:-document.body.scrollTop-document.documentElement.scrollTop
     }
	});
 $('#dg').datagrid('reload');
 }
	},'json')
	});
 /*} else {
	$.messager.alert('Warning','No requests data selected','warning');
	}*/
						   //},
		   //});
}

function new2(){
var s = '<span class="tree-loading" style="padding:8px;display:inline-block;width:16px;height:24px;vertical-align:middle"></span><span style="font-weight:bold;padding:8px;display:inline-block;line-height:24px;vertical-align:middle;"> Processing, please wait...</span>';
var dlg =	$.messager.progress({
 title:'',
 border:'thin',
 msg:s,
 width:275,
	height:72,
 });
$.messager.progress('bar').hide();
dlg.dialog('resize');
//var pur = document.getElementById("pur").value;
pur = $('#pur').val();
var row = $('#dg').datagrid('getSelected');
//$.post('action/simpan.php?x=po2&pur='+pur+'&rkb='+row.rkbpk);
$.ajax({
		   type:"POST",
		   url:"action/simpan.php?x=po2&pur="+pur,
		   data:"rkb="+row.rkbpk,
/*onSubmit: function(){
var isValid = $(this).form('validate');
if(!isValid){
$.messager.progress('close');	// hide progress bar while the form is invalid
}
return isValid;	// return false will stop the form submission
},*/
/*onProgress: function(percent){
$.messager.progress();
},*/
			  success:function(data){
					document.getElementById('popk2b').value=data;
					//var popk = document.getElementById('popk2b').value;	
			   },
		   });
//var popk = document.getElementById('popk2b').value;
//alert(popk);
/*var count = $('#dg').datagrid('getChecked').length;*/
var ids = [];
var rows = $('#dg').datagrid('getSelections');
//if(rows){
	for(var i=0; i<rows.length; i++){
	ids.push(rows[i].rkbpk);
	}
	//alert(ids);
/*alert(pur);
alert(row.suppk);
alert(row.item);*/
$.each(ids, function (index, value){
$.post('action/simpan.php?x=po2b&rkb='+row.rkbpk+'&pur='+pur+'&sup='+row.suppk+'&item='+row.item+'&count='+i,{id:value},
//$.post('action/simpan.php?x=po2b&pur='+pur+'&sup='+row.suppk+'&item='+row.item+'&count='+i+'&rkb='+ids,

//$.messager.progress(),
function(result){
if (result.success){
	$.messager.show({
	title:'',
	msg:result.msg, 
	timeout:3000,
	showType:'slide',
	icon:'info',
	width:252,
	height:55,
		style:{
     left:0,
     right:'',
     top:'',
     bottom:-document.body.scrollTop-document.documentElement.scrollTop
     }
	});
 $('#dg').datagrid('clearSelections');
 $('#dg').datagrid('clearChecked');
	$('#dg').datagrid('reload');
 $.messager.progress('close');
 /*$.ajax({
		   type:"POST",
		   url:"action/simpan.php?x=po2c&pur="+pur,
		   data:"rkb="+row.rkbpk,
			  success:function(data){
					document.getElementById('popk2b').value=data;
					//var popk = document.getElementById('popk2b').value;
					},
		   });*/
 //window.location.href="?hal=wait&sts=2";
 /*url = "?hal=wait";
 window.open(url);*/
 } else {
	$.messager.show({
	title:'',
	msg:result.msg, 
	timeout:3000,
	showType:'slide',
	icon:'info',
	width:252,
	height:55,
		style:{
     left:0,
     right:'',
     top:'',
     bottom:-document.body.scrollTop-document.documentElement.scrollTop
     }
	});
 }
	},'json')
});
 /*}
else {
	$.messager.alert('Warning','No requests data selected','warning');
	}*/
					   //},
		   //});
}

function select(){
var row = $('#dg2').datagrid('getSelected');

var string = $("#form2").serialize();
	 $('#form2').form('submit',{
  type	: "POST",
		url	: "action/simpan.php?x=insert2&popk="+row.popk,
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
					width:252,
					height:55,
		style:{
     left:0,
     right:'',
     top:'',
     bottom:-document.body.scrollTop-document.documentElement.scrollTop
     }
					});
			$('#dialog-form2').dialog('close');
   $('#form2').form('reset');
			/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
   $('#dg').datagrid('clearSelections');
   $('#dg').datagrid('clearChecked');
			$('#dg').datagrid('reload');
		}
	 });
}

function cancel2(){
var string = $("#form2").serialize();
	 $('#form2').form('submit',{
  type	: "POST",
		url	: "action/simpan.php?x=caninsert",
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
					width:252,
					height:55,
		style:{
     left:0,
     right:'',
     top:'',
     bottom:-document.body.scrollTop-document.documentElement.scrollTop
     }
					});
			$('#dialog-form2').dialog('close');
   $('#form2').form('reset');
			/*$('#dialog-progress').dialog('open').dialog('setTitle','');*/
   $('#dg').datagrid('clearSelections');
   $('#dg').datagrid('clearChecked');
			$('#dg').datagrid('reload');
		}
	 });
}

//DROPDOWN 
function toggle(source){
   checkboxes = document.getElementsByName('cki');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}

function cheka1(){               
			var c1 = document.getElementById("chek1");
				if (c1.checked) {
        $('#dg').datagrid('showColumn', 'funm');
			}else {
											$('#dg').datagrid('hideColumn', 'funm');
			}
				}
				
			 function cheka2(){               
			var c2 = document.getElementById("chek2");
				if (c2.checked) {
        $('#dg').datagrid('showColumn', 'item');
			}else {
											$('#dg').datagrid('hideColumn', 'item');
			}
				}
				
				function cheka3(){               
			var c3 = document.getElementById("chek3");
				if (c3.checked) {
        $('#dg').datagrid('showColumn', 'supnm');
			}else {
											$('#dg').datagrid('hideColumn', 'supnm');
			}
				}
				
				function cheka4(){               
			var c4 = document.getElementById("chek4");
				if (c4.checked) {
        $('#dg').datagrid('showColumn', 'byrnm');
			}else {
											$('#dg').datagrid('hideColumn', 'byrnm');
			}
				}
				
				function cheka5(){               
			var c5 = document.getElementById("chek5");
				if (c5.checked) {
        $('#dg').datagrid('showColumn', 'unit');
			}else {
											$('#dg').datagrid('hideColumn', 'unit');
			}
				}
				
				function cheka6(){               
			var c6 = document.getElementById("chek6");
				if (c6.checked) {
        $('#dg').datagrid('showColumn', 'colname');
			}else {
											$('#dg').datagrid('hideColumn', 'colname');
			}
				}
    
    function cheka6b(){               
			var c6b = document.getElementById("chek6b");
				if (c6b.checked) {
        $('#dg').datagrid('showColumn', 'colcode');
			}else {
											$('#dg').datagrid('hideColumn', 'colcode');
			}
				}
				
				function cheka7(){               
			var c7 = document.getElementById("chek7");
				if (c7.checked) {
        $('#dg').datagrid('showColumn', 'price');
			}else {
											$('#dg').datagrid('hideColumn', 'price');
			}
				}
				
				function cheka8(){               
			var c8 = document.getElementById("chek8");
				if (c8.checked) {
        $('#dg').datagrid('showColumn', 'tgljam2');
			}else {
											$('#dg').datagrid('hideColumn', 'tgljam2');
			}
				}
    function cheka9(){               
			var c9 = document.getElementById("chek9");
				if (c9.checked) {
        $('#dg').datagrid('showColumn', 'poreqdel2');
			}else {
											$('#dg').datagrid('hideColumn', 'poreqdel2');
			}
				}
    function cheka10(){               
			var c10 = document.getElementById("chek10");
				if (c10.checked) {
        $('#dg').datagrid('showColumn', 'spec');
			}else {
											$('#dg').datagrid('hideColumn', 'spec');
			}
				}
			function cheka11(){               
			var c11 = document.getElementById("chek11");
				if (c11.checked) {
        $('#dg').datagrid('showColumn', 'sizegar');
			}else {
											$('#dg').datagrid('hideColumn', 'sizegar');
			}
				}
				
			function cheka12(){               
			var c12 = document.getElementById("chek12");
				if (c12.checked) {
        $('#dg').datagrid('showColumn', 'ordno');
			}else {
											$('#dg').datagrid('hideColumn', 'ordno');
			}
				}
				
			function cheka13(){               
			var c13 = document.getElementById("chek13");
				if (c13.checked) {
        $('#dg').datagrid('showColumn', 'pocons');
			}else {
											$('#dg').datagrid('hideColumn', 'pocons');
			}
				}
				
/*$.fn.combobox.defaults.onLoadSuccess = function(items){
	if (items.length){
		var opts = $(this).combobox('options');
		$(this).combobox('select', items[0][opts.valueField]);
	}
}*/

function tnew(){
var tcount= JSON.stringify($('#dg').datagrid('getData').total);
document.getElementById("tnew").innerHTML = "("+tcount+")";
$('#tnew').show();
$('#tnew1').hide();

if(tcount>0){
$("#ntnew").show();
} else {
$("#ntnew").hide(); 
}
}

function filterFunction(){
  var input, filter, ul, li, a, i;
  input = document.getElementById("cari6a");
  filter = input.value.toUpperCase();
  div = document.getElementById("myDropdown2");
  a = div.getElementsByTagName("a");
  for (i = 0; i < a.length; i++) {
    txtValue = a[i].textContent || a[i].innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      a[i].style.display = "";
    } else {
      a[i].style.display = "none";
    }
  }
}

function wrap(){
      var item = $(this).datagrid('getColumnOption', 'item');
      $('.' + item.cellClass).each(function(){
         var style2 = $(this).attr('style');
        $(this).attr('style',style2+' white-space: pre-wrap;white-space: -moz-pre-wrap;');
      });
       var spec = $(this).datagrid('getColumnOption', 'spec');
      $('.' + spec.cellClass).each(function(){
         var style3 = $(this).attr('style');
        $(this).attr('style',style3+' white-space: pre-wrap;white-space: -moz-pre-wrap;');
      });
      var sizegar = $(this).datagrid('getColumnOption', 'sizegar');
      $('.' + sizegar.cellClass).each(function(){
         var style4 = $(this).attr('style');
        $(this).attr('style',style4+' white-space: pre-wrap;white-space: -moz-pre-wrap;');
      });
      var colname = $(this).datagrid('getColumnOption', 'colname');
      $('.' + colname.cellClass).each(function(){
         var style5 = $(this).attr('style');
        $(this).attr('style',style5+' white-space: pre-wrap;white-space: -moz-pre-wrap;');
      });
      var supnm2 = $(this).datagrid('getColumnOption', 'supnm2');
      $('.' + supnm2.cellClass).each(function(){
         var style6 = $(this).attr('style');
        $(this).attr('style',style6+' white-space: pre-wrap;white-space: -moz-pre-wrap;');
      });
       var byrnm = $(this).datagrid('getColumnOption', 'byrnm');
      $('.' + byrnm.cellClass).each(function(){
         var style7 = $(this).attr('style');
        $(this).attr('style',style7+' white-space: pre-wrap;white-space: -moz-pre-wrap;');
      });
      var tgljam2 = $(this).datagrid('getColumnOption', 'tgljam2');
      $('.' + tgljam2.cellClass).each(function(){
         var style8 = $(this).attr('style');
        $(this).attr('style',style8+' white-space: pre-wrap;white-space: -moz-pre-wrap;');
      });
}

function assign(){
var cari2 = $('#cari2').val();
var cari7 = $('#cari7').val();
if(cari2==""){
$('#dialog-formhd').dialog('open').dialog('setTitle',''); 
} else {
window.location.href="action/simpan?x=prosespo3&user=<?php echo $_SESSION['user']; ?>&thn=<?php echo $thn2; ?>&cari2="+cari2+"&cari7="+cari7;
}
}

function srcsupp(){
	var thn=$('#cari6').val();
	var kelnm=$('#cari7').val();
	$('#supp').datagrid('load', 'view/get_data2.php?dt=supp&thn='+thn+"&kelnm="+kelnm);
  }

  function srccolor(){
	var thn=$('#cari6').val();
	var kelnm=$('#cari7').val();
	$('#color').datagrid('load', 'view/get_data2.php?dt=color&thn='+thn+"&kelnm="+kelnm);
  }

  function srcspecb(){
	var thn=$('#cari6').val();
	var kelnm=$('#cari7').val();
	$('#specb').datagrid('load', 'view/get_data2.php?dt=specb&thn='+thn+"&kelnm="+kelnm);
  }
</script>
<input type="hidden" name="pur" id="pur" value="<?php echo $_SESSION['login']; ?>" size="8">
<input type="hidden" name="popk2b" id="popk2b" size="8">
<input type="hidden" name="test1" id="test1" size="5">
<input type="hidden" name="test2" id="test2" size="5">
<input type="hidden" name="total" id="total"  value="0" size="5">
<?php //$ord=$_GET['ord']; ?>

<div class="contenta">
<?php if($_SESSION['mat']==2){ ?>
<div id="frame-utama-cari" style="width:910px;">
<?php } else { ?>
<div id="frame-utama-cari" style="width:755px;">
<?php } ?>
<div id="container-cari">
<div id="frame-cari">
<img src="css/images/Shape.png" plain="true" width="18px" height="18px">
<input id="cari1" placeholder="Search... " class="input" onkeyup="Search();">
</div>
</div>
<input style="margin-top:-2px; width: auto;" type="button" name="submit" value="Auto assign all PO" class="button-submit-add" onclick="assign();">
<?php if($_SESSION['mat']==2){ ?>
<select class="easyui-combobox" id="cari7"
data-options="editable:false,prompt:'',panelHeight:'auto',onChange:Search" style="width:150px;" >
<?php if($_GET['cari7']<>""){
?>
<option value="<?php echo $_GET['cari7']; ?>"><?php echo $_GET['cari7']; ?></option>
<?php } ?>
<option value="SEWING">SEWING</option>
<option value="FINISHING/PACKING">FINISHING/PACKING</option>
</select>
<?php } ?>
<?php
if($_SESSION['mat']==1){ $fdt="fu1"; }
else { $fdt="fu2"; }
?>
<!--<input style="width:140px; height:28px;" id="cari2" name="cari2" class="easyui-combobox"-->
<!--data-options="valueField:'fupk',textField:'funm',url:'view/get_data.php?dt=fu',prompt:'Handle',onChange:Search,-->
<!--limitToList:'true'">-->
<select class="easyui-combobox" id="cari2"
data-options="editable:false,prompt:'Handle',limitToList:'true',onChange:Search" style="width:140px;" >
<?php
$sqla=mysqli_query($koneksi,"select * FROM fu where aktif='0' and fupk='$_GET[cari2]' order by funm asc");
$dta=mysqli_fetch_array($sqla)
?>
<option value="<?php echo $dta['fupk']; ?>"><?php echo $dta['funm']; ?></option>
<option value="">ALL HANDLE</option>
<?php
$sql=mysqli_query($koneksi,"select * FROM fu where aktif='0' order by funm asc");
while($dt=mysqli_fetch_array($sql)){
?>
<option value="<?php echo $dt['fupk']; ?>"><?php echo $dt['funm']; ?></option>
<?php } ?>
</select>
<!--
select:'fupk'
<select style="width:140px; height:28px;" id="cari2" name="cari2" class="easyui-combobox"
data-options="onChange:Search,panelHeight:'auto',limitToList:'true'">
<?php
/*$rs = mysqli_query($koneksi,"SELECT * FROM rpo
LEFT OUTER JOIN ord ON ord.ordpk=rpo.ordpk
LEFT OUTER JOIN fu ON fu.fupk=ord.fupk
LEFT OUTER JOIN sup ON sup.suppk=rpo.suppk
LEFT OUTER JOIN cur ON  cur.curpk=rpo.curpk
WHERE rpo.stspk='1' and ord.fupk<>'' and rpo.rkbpk<>'' and rpo.item<>'' $and
group by fu.fupk
ORDER BY fu.funm asc");
while($data=mysqli_fetch_array($rs)){
?>
<option value="<?php echo $data['fupk']; ?>"><?php echo $data['funm']; ?></option>
<?php } */?>
</select>
-->
<select class="easyui-combobox" id="cari5"
data-options="editable:false,prompt:'Month',limitToList:'true',onChange:Search" style="width:150px;" >
<?php
$bln=array(1=>"January","February","March","April","May",
"June","July","August","September","October",
"November","Desember");
$bln1=date('m');
if($bln1<=9){
$bln2 = substr($bln1,1,1);
}
?>
<option value="<?php //echo $bln1; ?>"><?php //echo $bln[$bln2]; ?></option>
<?php
for($bulan=1; $bulan<=12; $bulan++){
?>
<option value="<?php echo $bulan; ?>"><?php echo $bln[$bulan]; ?></option>
<?php } ?>
</select>
<select class="easyui-combobox" id="cari6"
data-options="editable:false, panelHeight:'auto',onChange:Search" style="width:100px;" >
<?php
for ($i=date('Y'); $i>=date('Y')-2 ; $i-=1){
?>
<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
<?php } ?>
</select>
<a href="javascript:void(0);" title="Reload table" class="easyui-tooltip" onclick="$('#dg').datagrid('reload');">
<img src="css/images/reload1.png" width="20px" height="20px">
</a>
</div>
<div id="frame-filter" style="margin-left:-3%;">
<div id="frame-filter-fields">    
<div class="fields"><a href="javascript:void(0)" style="text-decoration:none; color: #AFAFAF;" onclick="myFunction1c(); testku2();">Fields</a></div>
<div class="all"><a href="javascript:void(0)" style="text-decoration:none; color: #000000;" onclick="myFunction1c(); testku2();">All</a></div>
<div id="panah2">
<div class="dropdown1">
  <input onclick="myFunction1c(); testku2();" type="image" src="css/images/Polygon.png" class="dropbtn1" style="filter:brightness(0%);" alt="Submit button" width="10px" height="10px">
  <!--<button onclick="myFunction()" class="dropbtn"></button>-->
  <div id="myDropdown2" class="dropdown1-content" name="dropdown1-content" style="height:520px;">
			<div class="content-search2">
				<div id="frame-cari2">
			 <img src="css/images/Shape.png" width="15px" height="15px" alt="Submit button" >
    <input id="cari6a" placeholder="Search..." class="input" onkeyup="filterFunction();">
				</div>
				</div>
			<div style="margin-top:50px;margin-left:-5px;display: inline-block; text-align: left;">
						<a href="Javascript:void(0);" style="padding: 5px 16px;"><div><b>Select All</b></div><div class="ck2" style="margin-left: 150px;margin-top: -19px;">
						<input type="checkbox" name="all" value="all" id="chek0" onclick="toggle(this); cheka1(); cheka2(); cheka3(); cheka4(); cheka5(); cheka6(); cheka6b(); cheka7(); cheka8(); cheka9(); cheka10(); cheka11(); cheka12(); cheka13();" checked></div></a>
						<a href="Javascript:void(0);" style="padding: 5px 16px;"><div>From</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox"  name="cki"  id="chek1" onclick="cheka1();" checked></div></a>
						<a href="Javascript:void(0);" style="padding: 5px 16px;"><div>Order no</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="cki" id="chek12" onclick="cheka12();" checked></div></a>
						<a href="Javascript:void(0);" style="padding: 5px 16px;"><div>Buyer</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="cki" id="chek4" onclick="cheka4();" checked></div></a>
      <a href="Javascript:void(0);" style="padding: 5px 16px;"><div>Item</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="cki" id="chek2" onclick="cheka2();" checked></div></a>
						<a href="Javascript:void(0);" style="padding: 5px 16px;"><div>Supplier</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="cki" id="chek3" onclick="cheka3();" checked></div></a>
						<a href="Javascript:void(0);" style="padding: 5px 16px;"><div>Size</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="cki" id="chek11" onclick="cheka11();" checked></div></a>
						<a href="Javascript:void(0);" style="padding: 5px 16px;"><div>Total PO</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="cki" id="chek13" onclick="cheka13();" checked></div></a>
						<a href="Javascript:void(0);" style="padding: 5px 16px;"><div>Units</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="cki" id="chek5" onclick="cheka5();" checked></div></a>
						<a href="Javascript:void(0);" style="padding: 5px 16px;"><div>Color</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox"  name="cki" id="chek6" onclick="cheka6();" checked></div></a>
						<a href="Javascript:void(0);" style="padding: 5px 16px;"><div>Col Code</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox"  name="cki" id="chek6b" onclick="cheka6b();" checked></div></a>
      <a href="Javascript:void(0);" style="padding: 5px 16px;"><div>Price</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="cki" id="chek7" onclick="cheka7();" checked></div></a>
	     <a href="Javascript:void(0);" style="padding: 5px 16px;"><div>Req Date</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="cki" id="chek8" onclick="cheka8();" checked></div></a>			
			   <a href="Javascript:void(0);" style="padding: 5px 16px;"><div>Req Del</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="cki" id="chek9" onclick="cheka9();" checked></></div></a>
			   <a href="Javascript:void(0);" style="padding: 5px 16px;"><div>Specification</div><div class="ck2" style="margin-left: 150px;margin-top: -19px;"><input type="checkbox" name="cki" id="chek10" onclick="cheka10();" checked></></div></a>
	</div>
			<!--<div id="tabel" style="width:200px;height:300px;border:0px solid;margin-top:-150px;margin-left:-20px;">
			<table id="kolom1" class="easyui-datagrid" title="" style="width:100%;height:auto;" align="center"
				url="view/get_data.php?dt=kolom3" toolbar="#tb" striped="false"
				rownumbers="false"  multiple="true" collapsible="false" fitColumns="false" method="post" data-options="resizable:false,border:false,loadMsg:''">
			<thead>
			<tr>
			<th field="kolomnm" width="140" sortable="false" >Select All</th>
			<th field="ck" width="60"><input type="checkbox" name="chekk" onclick="toggle(this); cheka19(); cheka20(); cheka21(); cheka22(); cheka23(); cheka24(); cheka25(); cheka26(); cheka27(); cheka28();" id="chekk"></th>
			</tr>
			</thead>
			</table>
			</div>-->
  </div>
</div>
</div>
</div>
<div id="frame-filter-newest">
<div class="dropdwn">	
<input onclick="myFunction()" type="image" class="imgsort" src="css/images/sort.jpg" alt="Submit button" class="dropbtn">
<div id="myDropdown" class="dropdwn-content">
<input type="hidden" id="cari3" value="1" name="cari3">
<div class="new-entry"><a href="javascript:void(0)" plain="true" onclick="Searcha();">Newest entry</a></div>
<input type="hidden" id="cari4" value="1" name="cari4">
<div class="old-entry"><a href="javascript:void(0)" plain="true" onclick="Searchb();">Oldest entry</a></div>
</div>
</div>
<a href="javascript:void(0);" style="text-decoration:none; color: #000000;">
<div id="newest" class="newest" onclick="myFunction()">Newest</div>
<div id="oldest" class="newest" onclick="myFunction()" style="display:none;">Oldest</div>
</a>
</div>
<div id="frame-filter2">
<div id="dropdown2">
<input onclick="myFunction1d(); testku();" type="image" class="imgfilter" src="css/images/filter.png" width="14px" height="12.83px" alt="Submit button">
<div class="filter"><a href="javascript:void(0);" style="text-decoration:none; color: #000000;" onclick="myFunction1d(); testku();">Filter</a></div>
<div id="myDropdown3" class=dropdown2-content style="width:220px;height:395px;margin-right:-3px;">
				<div class="content-search2">
				<div id="frame-cari2">
			 <img src="css/images/Shape.png" width="15px" height="15px" alt="Submit button">
    <input id="carispl" placeholder="Search..." class="input" onkeyup="Search5();">
				</div>
				</div>
				
     <div id="byr1a" class="byra" style="margin-top:50px;margin-left:15px;">
						Supplier
						<div style="text-align:right;margin-top:-17px;margin-right:25px;" id="img1">
						<i class="bi bi-eye-slash-fill" id="togglePassword2a" style="cursor: pointer;" onmouseover="expand();" onmouseout="expand();"></i>
						</div>
						</div>				
				<div id="tabel" class="tabela" onmousemove="totrec();" style="width:200px;height:auto;border:0px solid;margin-top:-120px;margin-left:-20px;">
				<table id="supp" class="easyui-datagrid" title="" style="width:100%;height:auto;" align="center" idField="rpopk"
				toolbar="#tb" striped="false" multiple="true" collapsible="true" fitColumns="false" method="post"
				data-options="border:false,loadMsg:''">
			<thead>
			<tr>
			<th field="supnm" width="160" sortable="false"></th>
			<th field="ck" checkbox="true" width="50"></th>
			</tr>
			</thead>
			</table>
			</div>
				
						<div id="byr1a" class="prodesa" style="margin-top:60px;margin-left:15px;">
						<hr style="height:1px; width:185px; background-color:#D9D9D9; color:#D9D9D9; border:none;">
					Color
						<div style="text-align:right;margin-top:-17px;margin-right:25px;" id="img2">
						<i class="bi bi-eye-slash-fill" id="togglePassword2b" style="cursor: pointer;" onmouseover="expand();" onmouseout="expand();"></i></div>
						</div>  
				<div id="tabel" class="tabelb" onmousemove="totrec();" style="width:200px;height:auto;margin-top:-20px;margin-left:-20px;">
			 <table id="color" class="easyui-datagrid" title="" style="width:100%;height:auto;" align="center" idField="rpopk"
				 toolbar="#tb" striped="false" multiple="true" collapsible="true" fitColumns="false" method="post"
				data-options="border:false,loadMsg:''">
			<thead>
			<tr>
			<th field="colname" width="160" sortable="false"></th>
			<th field="ck" checkbox="true" width="50"></th>
			</tr>
			</thead>
			</table>
			</div>
				
				<div id="byr1a"  class="seasona"  style="margin-top:55px;margin-left:15px;">
				<hr style="height:1px; width:185px; background-color:#D9D9D9; color:#D9D9D9; border:none;">
				Specification
									<div style="text-align:right;margin-top:-17px;margin-right:25px;" id="img3">
											<i class="bi bi-eye-slash-fill" id="togglePassword2c" style="cursor: pointer;" onmouseover="expand();" onmouseout="expand();"></i></div>
									</div>
			<div id="tabel" class="tabelc" onmousemove="totrec();" style="width:200px;height:auto;margin-top:90px;margin-left:-20px;">
			 <table id="specb" class="easyui-datagrid" title="" style="width:100%;height:auto;" align="center" idField="rpopk"
			  toolbar="#tb" striped="false" multiple="true" collapsible="true" fitColumns="false" method="post"
				data-options="border:false,loadMsg:''">
			<thead>
			<tr>
			<th field="spec" width="160" sortable="false"></th>
			<th field="ck" checkbox="true" width="40"></th>
			</tr>
			</thead>
			</table>
			</div>
</div>
</div>
</div>
</div>
<div id="frame-fltrchk" align="left" onmousemove="totrec();" style="width:95%;">
<div id="fltr1" style="margin-top:-35px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"></div>
<div id="fltr2" style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;"></div>
<div id="fltr3" style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;display:none;" onclick="reset();">
<a href="javascript:void(0)" style="text-decoration:none; color: #359DD9;">Reset All</a></div>
<div style="margin-left:150px;margin-top:-20px;">
<!--<div style="width:20px; height:auto;" id="cross" class="cross" value="<?php //echo $i; ?>" onclick="uncek(<?php //echo $i; ?>);">
&nbsp;&#215;&nbsp;
</div>-->
<!--A-->
<?php for($i=0; $i<=1; $i++){ ?>
<input type="button" id="filtera<?php echo $i; ?>" class="filterchek" alt="Submit button" readonly>
<input type="hidden" id="idxa<?php echo $i; ?>" size="5">
<a href="javascript:void(0)" id="crossa<?php echo $i; ?>" class="cross" onclick="unceka(<?php echo $i; ?>);">&nbsp;&#215;&nbsp;</a>
<input type="hidden" name="tall" id="talla<?php echo $i; ?>" value="0" size="5">
<?php } ?>
<!--B-->
<?php for($j=0; $j<=1; $j++){ ?>
<input type="button" id="filterb<?php echo $j; ?>" class="filterchek" alt="Submit button" readonly>
<input type="hidden" id="idxb<?php echo $j; ?>" size="5">
<a href="javascript:void(0)" id="crossb<?php echo $j; ?>" class="cross" onclick="uncekb(<?php echo $j; ?>);">&nbsp;&#215;&nbsp;</a>
<input type="hidden" name="tall" id="tallb<?php echo $j; ?>" value="0" size="5">
<?php } ?>
<!--C-->
<?php for($k=0; $k<=1; $k++){ ?>
<input type="button" id="filterc<?php echo $k; ?>" class="filterchek" alt="Submit button" readonly>
<input type="hidden" id="idxc<?php echo $k; ?>" size="5">
<a href="javascript:void(0)" id="crossc<?php echo $k; ?>" class="cross" onclick="uncekc(<?php echo $k; ?>);">&nbsp;&#215;&nbsp;</a>
<input type="hidden" name="tall" id="tallc<?php echo $k; ?>" value="0" size="5">
<?php } ?>
<!--<input type="button" id="filter1" class="filterchek" alt="Submit button" style="" readonly>
<a href="javascript:void(0)" id="cross1" class="cross" onclick="UnSearchsupp(); tall(); tutup();">&nbsp;&#215;&nbsp;</a>
<input type="button" id="filter2" class="filterchek" alt="Submit button" style="" readonly>
<a href="javascript:void(0)" id="cross2" class="cross" onclick="UnSearchcolor(); tall(); tutup();">&nbsp;&#215;&nbsp;</a>
<input type="button" id="filter3" class="filterchek" alt="Submit button" style="" readonly>
<a href="javascript:void(0)" id="cross3" class="cross" onclick="UnSearchspec(); tall(); tutup();">&nbsp;&#215;&nbsp;</a>-->

</div>
</div>
<div id="tabel1" onclick="menu();" onmousemove="revisi3(); revisi3b();"" style="">
<table id="dg" class="easyui-datagrid" title="" style="width:100%;height:460px;" align="center"
url="view/get_new.php" idField="rpopk" toolbar="#tb" striped="true" sortable="true"
pagination="false" rownumbers="false"  multiple="true" collapsible="true" fitColumns="false" method="post"
data-options="onCheckAll:function(){menu();},onUncheckAll:function(){menu2();},ctrlSelect:true,checkOnSelect:true,multiSort:true,remoteSort:false">
<thead>
<tr>
<th data-options="field:'ck',checkbox:true"></th>
<!--<th field="no" width="50" sortable="false">No</th>-->
<th field="funm" width="80" sortable="true">From</th>
<th field="ordno" width="90" sortable="true">Order no</th>
<th field="byrnm" width="90" sortable="true">Buyer</th>
<th field="item" width="110" sortable="true">Item</th>
<th field="spec" width="140" sortable="true">Specification</th>
<th field="supnm2" width="110" sortable="true">Supplier</th>
<th field="sizegar" width="90" sortable="true">Size</th>
<th field="pocons" width="90" sortable="true">Total PO</th>
<th field="unit" width="70" sortable="true">Units</th>
<th field="colname" width="80" sortable="true">Color</th>
<th field="colcode" width="80" sortable="true">Col Code</th>
<th field="price" width="90" sortable="true">Price</th>
<th field="tgljam2" width="100" sortable="true">Req Date</th>
<th field="poreqdel2" width="90" sortable="true">Req Del</th>
</tr>
</thead>
</table>
<br>
</div>
</div>

<div class="header" id="myHeader" onclick=""  style="display:none;">
<div id="countp" style="margin-right:30%;"></div>
<!--<div class="delete"><a href="javascript:void(0)" plain="true" onclick="edit2();" style="color: #FFFFFF; text-decoration: none;"> Edit </a></div>-->
<div class="detail"><a href="javascript:void(0)" plain="true" onclick="view();" style="color: #FFFFFF; text-decoration: none;"> View PDF </a></div>
<div class="detail"><a href="javascript:void(0)" plain="true" onclick="new1();" style="color: #FFFFFF; text-decoration: none;"> New local </a></div>
<div class="detail"><a href="javascript:void(0)" plain="true" onclick="new2();" style="color: #FFFFFF; text-decoration: none;"> New import </a></div>
<div class="detail"><a href="javascript:void(0)" plain="true" onclick="insert();" style="color: #FFFFFF; text-decoration: none;"> Insert PO </a></div>
<div class="detail"><a href="javascript:void(0)" plain="true" onclick="revisi();" style="color: #FFFFFF; text-decoration: none;"> Need revision </a></div>
<div class="delete" style="width:auto;"><a href="javascript:void(0)" plain="true" onclick="$('#myHeader').hide(); $('#dg').datagrid('clearSelections'); $('#dg').datagrid('clearChecked');" style="color: #FFFFFF; text-decoration: none;"> Close menu </a></div>
</div>

<div id="dialog-form" class="easyui-dialog" closed="true" buttons="#dialog-buttons" data-options="border:false,title:false,resizable:false,modal:true,closable:false"
style="width:425px;height:310px;padding:5px 5px;display:none;top:15px;border-radius:8px;">
<form id="form" method="post">
	<input type="hidden" name="user" id="userpur" size="8">
 	<input type="hidden" name="fu" id="fu" size="8">
    <!-- <div class="modal-dialog"> -->
        <div class="modal-content">
        	<!-- Modal Header -->
            <div class="modal-header">
            <div class="modal-title">Attach a memo?
												</div>
            </div>
            <!-- Modal body -->
            <div class="border-modal" style="border:none;">
            <div style="padding:5px;">
             <textarea placeholder="Beri memo untuk MD" name="memo" id="memo" class="easyui-validatebox" style="width:100%; height:100px;"></textarea>
													</div>
             </div>
        <!--<div class="font-excel-template"><a href="action/file_RKB_new.xlsx" target="_blank" style="text-decoration:none;"> Download excel template </a></div>-->
        <a style="text-decoration:none; left: 129px; top: 228px;" href="javascript:void(0)" class="button-cancel" onclick="cancel();">Cancel</a>
        <a style="text-decoration:none; left: 206px; top: 228px;" href="javascript:void(0)" class="button-submit" onclick="save();">Submit</a>
								<!-- <input type="submit" id="submit" name="submit" value="Submit" class="button-submit">-->
        </div>
</form>
<!-- </div> -->
</div>

<div id="dialog-form2" class="easyui-dialog" closed="true" buttons="#dialog-buttons" data-options="border:false,title:false,resizable:false,modal:true,closable:false"
style="width:884px;height:610px;padding:5px 5px;display:none;top:15px;border-radius:8px;">
<!-- <div class="modal-dialog2" style="width:98%; height:96%;"> -->
<form id="form2" method="post">
<input type="hidden" name="suppk" id="cari9" size="8">
<input type="hidden" name="item" id="cari10">
<!--<input type="hidden" name="poreqdel" id="cari12" size="8">-->
<input type="hidden" name="tot" id="tot" size="8">
     <div class="modal-content">
        	<!-- Modal Header -->
            <div class="modal-header">
            <div class="modal-title2">
            <div style="font-weight:bold;">Choose which PO to input the following item in
            </div>
           <div style="margin-top:-5px;">
												<a href="javascript:void(0)" style="text-decoration:none; color:#000; font-size:28px; margin-left:800px;" onclick="cancel2();"> X</a>
												</div>
            <div style="color:rgba(0, 0, 0, 0.38);">Item</div>
            <div id="speca"></div>
    <div class="content-search4">
				<div id="frame-cari4">
			 <img src="css/images/Shape.png" width="15px" height="15px" alt="Submit button" >
    <input id="cari11" placeholder="Search..." class="input" onkeyup="Searchc();">
				</div>
				</div>
				</div>
    </div>
    <!-- Modal body -->
    <div class="border-modal2" style="border:none;">
    <div style="padding:5px;">
    <div id="tabel2b" onclick="select();" style="">
    <table id="dg2" class="easyui-datagrid" title="" style="width:100%;height:425px;" align="center"
    url="view/get_data.php?dt=insert" toolbar="#tb" striped="true"
    pageSize="100" pageList="[100,200,300,500]" pagination="true" pagination="true" rownumbers="false"  singleSelect="true" collapsible="true" fitColumns="false" method="post">
    <thead>
    <tr>
    <th field="act" width="100" sortable="false">Action</th>
    <th field="pono" width="150" sortable="true">PO no.</th>
    <th field="supnm" width="150" sortable="true">Supplier</th>
    <th field="brg" width="408" sortable="true">Item description</th>
    </tr>
    </thead>
    </table>
    </div>
				</div>
    </form>
    </div>
    </div>
<!-- </div> -->
</div>

<div id="dialog-formhd" class="easyui-dialog" closed="true" buttons="#dialog-buttons" data-options="border:false,title:false,closable:false,resizable:false,modal:true,border:false"
style="width:325px;height:175px;border-radius:8px;padding:5px 5px;display:none;top:200px;border-radius:8px;">
<form id="formhd" method="post">
 <input type="hidden" id="popk" name="popk">
  <div class="modal-content">
  <!-- Modal Header -->
  <div class="modal-header">
  <div class="modal-title" style="width:auto;">Select a Handle in filter
	</div>
  </div>
  <div style="margin-left:20px;width:275px;height:54px;margin-top:50px; font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;">
   In order to use auto group, you must select a specific handle to process.
  </div>
  <!--<a style="text-decoration:none; width: 88px; height: 34px; left: 125px; top: 145px;" href="javascript:void(0)" class="button-cancel" onclick="$('#dialog-form1b').dialog('close');$('#form1b').form('reset');">Cancel</a>-->
  <a style="text-decoration:none; width: 88px; height: 34px; left: 200px; top: 125px;" href="javascript:void(0)" class="button-submit" onclick="$('#dialog-formhd').dialog('close');$('#formhd').form('reset');">OK</a>
	<!-- <input type="submit" id="submit" name="submit" value="Submit" class="button-submit">-->
  </div>
</form>
</div>

<script type="text/javascript">
window.onscroll = function(){ myFunctiona(); };
var header = document.getElementById("myHeader");
var sticky = header.offsetTop;
function myFunctiona(){
  if (window.pageYOffset > sticky){
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}
</script>