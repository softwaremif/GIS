<?php
include "../config/koneksi.php";
include "./config/koneksi11s.php";
$sql=mysqli_query($koneksi,"SELECT * from ord where ordpk='$_GET[ord]'");
$dtsql=mysqli_fetch_array($sql);
$style=$dtsql['artno'];
?>
<?php 
$ordpk = $_GET['ord'] ?? '';

$data_ord = null;
$dt_request = null;
$dtstyle = null;
$smvDisplay = 0;
// --- DATABASE UTAMA (SIG) ---
    $sql_ord = "SELECT 
                byr.byrpk, byr.byrnm, 
                fu.fupk, fu.funm, 
                ord.ordpk, ord.ordno, ord.srno, ord.artno, 
                ord.prodes, ord.gseason, ord.season, 
                ord.stsprod, ord.smv, ord.statuspk 
            FROM ord 
            LEFT JOIN byr ON byr.byrpk = ord.byrpk 
            LEFT JOIN fu ON fu.fupk = ord.fupk 
            WHERE ord.ordpk = '$ordpk' 
            LIMIT 1";

    $res_ord = mysqli_query($koneksi, $sql_ord);
    $data_ord = mysqli_fetch_assoc($res_ord);

    $sql_sched = "SELECT smv FROM ordschedlc2 
              WHERE ordpk = '$ordpk' 
              AND smv > 0 
              ORDER BY ordschedpk DESC 
              LIMIT 1";

    $res_sched = mysqli_query($koneksi, $sql_sched);
    $row_sched = mysqli_fetch_assoc($res_sched);
    $validSmvSched = ($row_sched) ? $row_sched['smv'] : 0;
    $lastSched = $validSmvSched;

    // --- DATABASE SAMPLE ---
    if (!empty($data_ord['srno'])) {
        
        $srno = $data_ord['srno'];
        // Ambil data Request
        $sql_req = "SELECT * FROM request WHERE srno = '$srno' LIMIT 1";
        $res_req = mysqli_query($koneksi11s, $sql_req);
        $dt_request = mysqli_fetch_assoc($res_req);

        if ($dt_request) {
            $srpk = $dt_request['srpk'];

            // 1. Ambil data STAGE & SAMPLE terbaru (Sesuai logic Laravel: Ambil yang terbaru dulu)
            $sql_style = "SELECT s.*, st.stagenm 
                        FROM status s
                        LEFT JOIN stage st ON st.stagepk = s.stagepk
                        WHERE s.srpk = '$srpk' 
                        AND s.stagepk IS NOT NULL 
                        AND s.stagepk != '' 
                        ORDER BY s.statuspk DESC LIMIT 1";
            
            $res_style = mysqli_query($koneksi11s, $sql_style);
            $dtstyle = mysqli_fetch_assoc($res_style);

            // 2. Logic Tambahan Laravel (PENTING): 
            // Jika data_ord punya statuspk, timpa $dtstyle dengan data yang spesifik
            if ($data_ord['statuspk'] > 0) {
                $spec_statuspk = $data_ord['statuspk'];
                $sql_spec = "SELECT s.*, st.stagenm 
                            FROM status s
                            LEFT JOIN stage st ON st.stagepk = s.stagepk
                            WHERE s.statuspk = '$spec_statuspk' LIMIT 1";
                
                $res_spec = mysqli_query($koneksi11s, $sql_spec);
                $check_spec = mysqli_fetch_assoc($res_spec);
            }

            // --- Sisanya sama (SMV Logic) ---
            $sql_valid_smv = "SELECT d.totsmv 
                            FROM status s
                            JOIN dsmv d ON d.statuspk = s.statuspk
                            WHERE s.srpk = '$srpk' 
                            AND d.totsmv > 0
                            ORDER BY s.statuspk DESC LIMIT 1";
            
            $res_smv = mysqli_query($koneksi11s, $sql_valid_smv);
            $row_smv = mysqli_fetch_assoc($res_smv);
            $validSmv = $row_smv['totsmv'] ?? 0;

            $smvDisplay = $validSmv ?: ($data_ord['smv'] ?: ($data_ord['ordschedsmv'] ?: 0));
        }
    }
?>
<script>
    // console.log("%c NATIVE RECONSTRUCTION SUCCESS ", "background: #064e3b; color: #34d399; font-weight: bold; padding: 4px;");
    // console.log("SRNO: <?php echo $data_ord['srno'] ?? 'N/A'; ?>");
    // console.log("Stage: <?php echo $dtstyle['stagenm'] ?? 'N/A'; ?>");
    // console.log("SMV Final: <?php echo $smvDisplay; ?>");
    
    // Tampilkan table data jika diperlukan
    const debugStatus = <?php echo json_encode($dtstyle); ?>;
    if(debugStatus) console.table(debugStatus);
</script>
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

function sync() {
	$('#dialog-sync').dialog('open').dialog('setTitle','');
}

function cansync() {
	$('#dialog-sync').dialog('close');
}

function savesync(){
	var string = $("#formsync").serialize();
	$('#formsync').form('submit',{
 	type	: "POST",
	url	  	: "action/simpan.php?x=syncfob",
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
     width:330,
	 height:55,
	 style:{
     left:0,
     right:'',
     top:'',
     bottom:-document.body.scrollTop-document.documentElement.scrollTop
     }
	 });
     $('#dialog-sync').dialog('close');
     $('#formsync').form('reset');
	 }
	 });
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
	// $("#hijau").delay(3200).fadeOut(300);
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
			console.log(arr);
			var currencyName = "USD";
			//alert(data);
			var a=arr[0];
			var totqty = new Intl.NumberFormat('en-US').format(a); 
			// document.getElementById('totqty1').innerHTML=totqty;
			document.querySelectorAll('.totqty1').forEach(el => { el.innerHTML = totqty;});
			var b=arr[1];
			var cm1 = new Intl.NumberFormat('en-US',{style:'currency',currency:'USD'}).format(b); 
			document.getElementById('cm1').innerHTML=cm1;
			var c=arr[2];
			var mat1 = new Intl.NumberFormat('en-US',{style:'currency',currency:'USD'}).format(c); 
			// document.getElementById('mat1').innerHTML=mat1;
			document.querySelectorAll('.mat1').forEach(el => {el.innerHTML = mat1;});
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
			var o=arr[5];
			var fobsales = new Intl.NumberFormat('en-US',{style:'currency',currency:'USD'}).format(o);
			document.getElementById('fobsales').innerHTML=fobsales;
			var j=arr[6];
			var bulkmat2 = new Intl.NumberFormat('en-US',{style:'currency',currency:'USD'}).format(j);
			document.getElementById('bulkmat2').innerHTML=bulkmat2;
			var k=arr[7];
			var bulkcm2 = new Intl.NumberFormat('en-US',{style:'currency',currency:'USD'}).format(k);
			document.getElementById('bulkcm2').innerHTML=bulkcm2;
			document.getElementById('cmcost').innerHTML="-"+bulkcm2;
			var m=arr[8];
			var tot1 = new Intl.NumberFormat('en-US',{style:'currency',currency:'USD'}).format(m);
			document.getElementById('tot1').innerHTML=tot1;
			var n=arr[9];
			var tot2 = new Intl.NumberFormat('en-US',{style:'currency',currency:'USD'}).format(n);
			document.getElementById('tot2').innerHTML=tot2;
			var q=arr[10];
			var est = new Intl.NumberFormat('en-US',{style:'currency',currency:'USD'}).format(q);
			// var r=arr[11];
			// var samplecost = new Intl.NumberFormat('en-US',{style:'currency',currency:'USD'}).format(r);
			// document.getElementById('samplecost').innerHTML="-"+samplecost ;
			document.getElementById('tglupdt').innerHTML=arr[12];
			// document.getElementById('qtysample').innerHTML=arr[13];
			var p=arr[14];
            var actmat = new Intl.NumberFormat('en-US',{style:'currency',currency:currencyName}).format(p);
			// document.getElementById('actmat').innerHTML="-"+actmat;
			document.querySelectorAll('.actmat').forEach(el => {
					el.innerHTML = actmat + " " + currencyName;
			});
			var actmat1 = new Intl.NumberFormat('en-US',{style:'currency',currency:currencyName}).format(p);
			document.querySelectorAll('.actmat1').forEach(el => {
					el.innerHTML = actmat1;
			});
			var l=arr[15];
			var bulkother2 = new Intl.NumberFormat('en-US',{style:'currency',currency:'USD'}).format(l);
			document.getElementById('bulkother2').innerHTML=bulkother2;
			var perpo=arr[16];
			document.getElementById('perpo').innerHTML="<span style='color:rgba(0, 0, 0, 0.38);'>("+perpo+"%)<span>";
			var percm=arr[17];
			document.getElementById('percm').innerHTML="<span style='color:rgba(0, 0, 0, 0.38);'>("+percm+"%)<span>";
			var perest=arr[18];
			console.log("persest="+perest);
			if (q>0) {
				document.getElementById('est').innerHTML="<span style='color:#19B715;font-weight: bold;'>+"+est+"<span>";
				document.getElementById('perest').innerHTML="<span style='color:#19B715;'>(+"+perest+"%)<span>";
      		} else {
			    document.getElementById('est').innerHTML="<span style='color:red;font-weight: bold;'>-"+est+"<span>";
				document.getElementById('perest').innerHTML="<span style='color:red;'>(-"+perest+"%)<span>";
			}

            var rawPerUnitPo = arr[19]; 
			var formattedPerUnitPo = new Intl.NumberFormat('en-US', {style: 'currency',currency: currencyName}).format(rawPerUnitPo);

			document.querySelectorAll('.per_unit_po').forEach(el => {
					el.innerHTML = (rawPerUnitPo > 0) ? (formattedPerUnitPo + " " + currencyName) : 'N/A';
			});

            // HITUNG BUDGET (Qty * Material)
			var totalBudgetRaw = a * c;
			var formattedBudget = new Intl.NumberFormat('en-US', {style:'currency', currency:currencyName}).format(totalBudgetRaw);
			document.querySelectorAll('.budget').forEach(el => {
					el.innerHTML = formattedBudget + " " + currencyName;
			});

            // Hitung Cost Balance (Budget - Actual)
			var balanceRaw = totalBudgetRaw - p;
            let cleanDiffBalance = parseFloat(balanceRaw.toFixed(3));
            var formattedBalance = new Intl.NumberFormat('en-US', {
                style: 'currency', 
                currency: currencyName
            }).format(Math.abs(cleanDiffBalance));

            document.querySelectorAll('.cost_balance').forEach(el => {
                el.innerHTML = (cleanDiffBalance >= 0 ? "+" : "-") + formattedBalance + " " + currencyName;

                if (cleanDiffBalance >= 0) {
                    el.style.color = "#19B715"; 
                } else {
                    el.style.color = "red";     
                }
            });

            var perunitRkb = parseFloat(arr[21]);
			var formattedPerunitRkb = new Intl.NumberFormat('en-US', {style: 'currency', currency: currencyName}).format(perunitRkb);
			document.querySelectorAll('.total_perunit_rkb').forEach(el => {
					el.innerHTML = formattedPerunitRkb + " " + currencyName;
			});

            var totalMatRkb = parseFloat(arr[21]);

			var rawRkb = parseFloat(arr[21]) * a;
			var formattedRkb = new Intl.NumberFormat('en-US', {style: 'currency', currency: currencyName}).format(rawRkb);
			document.querySelectorAll('.total_rkb').forEach(el => {
					el.innerHTML = formattedRkb + " " + currencyName;
			});

			var perunitRkb = parseFloat(arr[21]);
			var formattedPerunitRkb = new Intl.NumberFormat('en-US', {style: 'currency', currency: currencyName}).format(perunitRkb);
			document.querySelectorAll('.total_perunit_rkb').forEach(el => {
					el.innerHTML = formattedPerunitRkb + " " + currencyName;
			});

            var diffRkbPo = rawRkb - p; 
            let cleanDiff = parseFloat(diffRkbPo.toFixed(3));
            var formattedDiffRkb = new Intl.NumberFormat('en-US', {
                style: 'currency', 
                currency: currencyName
            }).format(Math.abs(cleanDiff)); 

            document.querySelectorAll('.difference_rkb_po').forEach(el => {
                el.innerHTML = (cleanDiff >= 0 ? "+" : "-") + formattedDiffRkb + " " + currencyName;
                
                if (cleanDiff >= 0) {
                    el.style.color = "#19B715";
                } else {
                    el.style.color = "red";
                }
            });

			console.log("datae :"+e);
			if(e>0){ $('#sync').show(); }
		},
	});
}



</script>
<div class="contenta">
<div id="container-cari" style="margin-top:13%;margin-left:5%;text-align:left;width:auto;background: #FFFFFF;">
<!-- <table border="0">
	<tr align="left" style="font-size: 16px;font-weight: 700;line-height: 20px;color:#00000099;">
		<th colspan="3">Costing Summary</th>
		<th colspan="3">FOB breakdown 
			<span id="edit" style="font-size: 14px;color:#359DD9;cursor:pointer;font-weight:400;" onclick="cost();">&nbsp;Edit</span>
			<span id="history" style="font-size: 14px;color:#359DD9;cursor:pointer;font-weight:400;" onclick="history();">&nbsp;&nbsp;History log</span>
		</th>
	</tr>
	<tr align="left" style="font-size: 14px;font-weight: normal;line-height: 18px;color: #000000;">
		<td width="125">Basic FOB</td>
		<td width="125">Order Qty</td>
		<td width="225">Total sales</td>
		<td width="125">CM</td>
		<td width="125">Material</td>
		<td width="125">Other</td>
	</tr>
	<tr style="font-size: 16px;font-weight: 700;line-height: 20px;color: #000000;">
		<td><span id="fob1"></span> 
		<span id="sync" style="font-size: 14px;color:#359DD9;cursor:pointer;font-weight:400;display:none;" onclick="sync();">&nbsp;Sync</span>
		</td>
		<td><span id="totqty1"></span></td>
		<td><span id="sales1"></span></td>
		<td><span id="cm1"></span></td>
		<td><span id="mat1"></span></td>
		<td><span id="other1"></span></td>
	</tr>
</table> -->
<div style="display: flex; flex-wrap: wrap; gap: 24px; border-bottom: 2px solid #dee2e6; padding-bottom: 8px; width: 100%;">
    
    <div style="flex: 1; min-width: 250px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
            <span style="font-size: 16px; font-weight: 700; color: #000000;">Costing Summary</span>
        </div>
        <div style="display: flex; gap: 8px;">
            <div style="flex: 1;">
                <small style="display: block; color: #212529;">Basic FOB</small>
                <span id="fob1" style="font-weight: 700; color: #212529;"></span>
								<span id="sync" style="font-size: 14px;color:#359DD9;cursor:pointer;font-weight:400;display:none;color: #359DD9;" onclick="sync();">&nbsp;Sync</span>
            </div>
            <div style="flex: 1;">
                <small style="display: block; color: #212529;">Order Qty</small>
                <span class="totqty1" style="font-weight: 700; color: #212529;"></span>
            </div>
            <div style="flex: 1;">
                <small style="display: block; color: #212529;">Total Sales</small>
                <span id="sales1" style="font-weight: 700; color: #212529;"></span>
            </div>
        </div>
    </div>

    <div style="flex: 1; min-width: 250px;">
        <div style="display: flex; align-items: center; margin-bottom: 8px; gap: 8px;">
            <span style="font-size: 16px; font-weight: 700; color: #000000;">FOB Breakdown</span>
            <div style="display: flex; gap: 8px;">
								 <span id="edit" style="font-size: 14px;color:#359DD9;cursor:pointer;font-weight:400;" onclick="cost();">&nbsp;Edit</span>
								 <span id="history" style="font-size: 14px;color:#359DD9;cursor:pointer;font-weight:400;color: #359DD9;" onclick="history();">&nbsp;&nbsp;History log</span>
            </div>
        </div>
        <div style="display: flex; gap: 8px;">
            <div style="flex: 1;">
                <small style="display: block; color: #212529;">CM</small>
                <span id="cm1" style="font-weight: 700; color: #212529;"></span>
            </div>
            <div style="flex: 1;">
                <small style="display: block; color: #212529;">Material</small>
                <span class="mat1" style="font-weight: 700; color: #212529;"></span>
            </div>
            <div style="flex: 1;">
                <small style="display: block; color: #212529;">Other</small>
                <span id="other1" style="font-weight: 700; color: #212529;"></span>
            </div>
        </div>
    </div>

    <div style="flex: 2; min-width: 300px;">
        <div style="margin-bottom: 8px;">
            <span style="font-size: 16px; font-weight: 700; color: #000000;">Costing SMV</span>
        </div>
        <div style="padding: 4px 0;">
						<small style="display: block; color: #212529; margin-bottom: 4px;">
								Based on SR <?php echo $data_ord['srno'] ?? '-'; ?> - <?php echo $dtstyle['samplenm'] ?? $dtstyle['stagenm'] ?? ''; ?>
						</small>
						<span style="font-weight: 700; color: #212529;" class="smv-value">
								<?php echo $smvDisplay; ?> mins | SMV Production <?php echo $lastSched; ?> mins
						</span>
				</div>
    </div>
</div>
<div style="display: flex; flex-direction: row; justify-content: space-between; gap: 1 rem; margin-top: 1.5rem; width: 100%;">
    <div style="flex: 1 1 auto;">
        <span style="font-size: 16px;font-weight: 700;line-height: 20px;color: #000000;">Garment Revenue Breakdown</span>
        <table border="0">
            <thead>
                <tr align="left" style="font-size: 12px;font-weight: 700;line-height: 16px;color: #00000099;">
                    <th colspan="2" width="100">Per Garment Estimation</th>
                    <th width="30"></th>
                    <th colspan="2" width="100">Bulk Estimation</th>
                </tr>
            </thead>
            <tbody>
                <tr align="left">
                    <td width="50" style="font-size: 14px;font-weight: 400;line-height: 18px;color: #00000099;">Materials</td>
                    <td width="100" style="text-align:right;font-size: 14px;font-weight: 400;line-height: 18px;"><span id="mat2"></span></td>
                    <td></td>
                    <td width="50" style="font-size: 14px;font-weight: 400;line-height: 18px;color: #00000099;">Materials</td>
                    <td width="100" style="text-align:right;font-size: 14px;font-weight: 400;line-height: 18px;"><span id="bulkmat2"></span></td>
                </tr>
                <tr align="left">
                    <td width="50" style="font-size: 14px;font-weight: 400;line-height: 18px;color: #00000099;">CM</td>
                    <td width="100" style="text-align:right;font-size: 14px;font-weight: 400;line-height: 18px;"><span id="cm2"></span></td>
                    <td></td>
                    <td width="50" style="font-size: 14px;font-weight: 400;line-height: 18px;color: #00000099;">CM</td>
                    <td width="100" style="text-align:right;font-size: 14px;font-weight: 400;line-height: 18px;"><span id="bulkcm2"></span></td>
                </tr>
                <tr align="left">
                    <td width="50" style="font-size: 14px;font-weight: 400;line-height: 18px;color: #00000099;">Other</td>
                    <td width="100" style="text-align:right;font-size: 14px;font-weight: 400;line-height: 18px;"><span id="other2"></span></td>
                    <td></td>
                    <td width="50" style="font-size: 14px;font-weight: 400;line-height: 18px;color: #00000099;">Other</td>
                    <td width="100" style="text-align:right;font-size: 14px;font-weight: 400;line-height: 18px;"><span id="bulkother2"></span></td>
                </tr>
                <tr align="left">
                    <td width="50" style="font-size: 14px;font-weight: bold;line-height: 18px;color: #000000;">Total</td>
                    <td width="100" style="text-align:right;font-size: 14px;font-weight: 400;line-height: 18px;"><span id="tot1"></span></td>
                    <td></td>
                    <td width="50" style="font-size: 14px;font-weight: bold;line-height: 18px;color: #000000;">Total</td>
                    <td width="100" style="text-align:right;font-size: 14px;font-weight: 400;line-height: 18px;"><span id="tot2"></span></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div style="flex: 1 1 auto;">
        <span style="font-size: 16px;font-weight: 700;line-height: 20px;color: #000000;">Material Cost Control</span>
        <table border="0" style="border-collapse: collapse;">
            <tbody>
                <tr align="left">
                    <td width="200" style="font-size: 14px;font-weight: 400;line-height: 18px;color: #000000;">OP Materials cost / garment</td>
                    <td width="150" style="text-align:right;font-size: 14px;font-weight: 400;line-height: 18px;"><span class="per_unit_po"></span></td>
                </tr>
                <tr align="left">
                    <td style="font-size: 14px;font-weight: 400;line-height: 18px;color: #000000;border-bottom: 2px solid #dee2e6;padding-bottom: 8px;">Order QTY</td>
                    <td style="text-align:right;font-size: 14px;font-weight: 400;line-height: 18px; border-bottom: 2px solid #dee2e6;padding-bottom: 8px;"><span class="totqty1"></span> PCS</td>
                </tr>
                <tr align="left">
                    <td style="font-size: 14px;font-weight: 400;line-height: 18px;color: #000000;padding-top: 8px;">Total material PO cost</td>
                    <td style="text-align:right;font-size: 14px;font-weight: 400;line-height: 18px;padding-top: 8px;"><span class="actmat"></span></td>
                </tr>
                <tr align="left">
                    <td style="font-size: 14px;font-weight: 400;line-height: 18px;color: #000000;border-bottom: 2px solid #dee2e6;padding-bottom: 8px;">Total material Budget</td>
                    <td style="text-align:right;font-size: 14px;font-weight: 400;line-height: 18px; border-bottom: 2px solid #dee2e6;padding-bottom: 8px;"><span class="budget"></span></td>
                </tr>
                <tr align="left">
                    <td style="font-size: 14px;font-weight: 400;line-height: 18px;color: #000000;">Material cost balance</td>
                    <td style="text-align:right;font-size: 14px;font-weight: 400;line-height: 18px;"><span class="cost_balance"></span></td>
                </tr>
            </tbody>
        </table>
    </div>

	<div style="flex: 1 1 auto;">
        <span style="font-size: 16px;font-weight: 700;line-height: 20px;color: #000000;">RKB vs Purchasing Control</span>
        <table border="0"  style="border-collapse: collapse;">
            <tbody>
                <tr align="left">
                    <td width="180" style="font-size: 14px;font-weight: 400;line-height: 18px;color: #000000;">RKB cost / garment</td>
                    <td width="150" style="text-align:right;font-size: 14px;font-weight: 400;line-height: 18px;"><span class="total_perunit_rkb"></span></td>
                </tr>
                <tr align="left">
                    <td style="font-size: 14px;font-weight: 400;line-height: 18px;color: #000000;border-bottom: 2px solid #dee2e6;padding-bottom: 8px;">Order QTY</td>
                    <td style="text-align:right;font-size: 14px;font-weight: 400;line-height: 18px; border-bottom: 2px solid #dee2e6;padding-bottom: 8px;"><span class="totqty1"></span> PCS</td>
                </tr>
                <tr align="left">
                    <td style="font-size: 14px;font-weight: 400;line-height: 18px;color: #000000;padding-top: 8px;">Total RKB material cost</td>
                    <td style="text-align:right;font-size: 14px;font-weight: 400;line-height: 18px;padding-top: 8px;"><span class="total_rkb"></span></td>
                </tr>
                <tr align="left">
                    <td width="280" style="font-size: 14px;font-weight: 400;line-height: 18px;color: #000000;border-bottom: 2px solid #dee2e6;padding-bottom: 8px;">Actual total material PO cost</td>
                    <td style="text-align:right;font-size: 14px;font-weight: 400;line-height: 18px; border-bottom: 2px solid #dee2e6;padding-bottom: 8px;"><span class="actmat"></span></td>
                </tr>
                <tr align="left">
                    <td style="font-size: 14px;font-weight: 400;line-height: 18px;color: #000000;">Difference</td>
                    <td style="text-align:right;font-size: 14px;font-weight: 400;line-height: 18px;"><span class="difference_rkb_po"></span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</br>
<!-- Estimate profit breakdown  -->
<table border="0" height="100px">
	<tr align="left">
		<th colspan="2" style="font-size: 12px;font-weight: 700;line-height: 16px;color: #00000099;">Estimate profit breakdown 
		&nbsp;<span style="font-size:10px;">last updated <span id="tglupdt"><span></span></th>
	</tr>
	<tr align="left">
		<td width="150" style="font-size: 14px;font-weight: 400;line-height: 18px;color: #00000099;">FOB Sales</td>
		<td width="150" style="text-align:right;font-size: 14px;font-weight: 400;line-height: 18px;"><span id="fobsales"></span></td>
		<td></td>
	</tr>
	<tr align="left">
		<td style="font-size: 14px;font-weight: 400;line-height: 18px;color: #00000099;">Actual material cost</td>
		<td style="text-align:right;font-size: 14px;font-weight: 400;line-height: 18px;"><span class="actmat1"></span></td>
		<td style="font-size: 14px;font-weight: 400;line-height: 18px;"><span id="perpo"></span></td>
	</tr>
	<tr align="left">
		<td style="font-size: 14px;font-weight: 400;line-height: 18px;color: #00000099;">CM cost</td>
		<td style="text-align:right;font-size: 14px;font-weight: 400;line-height: 18px;"><span id="cmcost"></span></td>
		<td style="font-size: 14px;font-weight: 400;line-height: 18px;"><span id="percm"></span></td>
	</tr>
	<!-- <tr align="left">
		<td style="font-size: 14px;font-weight: 400;line-height: 18px;color: #00000099;">Samples cost* (Qty <span id="qtysample"></span>)</td>
		<td style="font-size: 14px;font-weight: 400;line-height: 18px;"><span id="samplecost"></span></td>
	</tr> -->
	<!-- <tr align="left">
		<td style="font-size: 14px;font-weight: 400;line-height: 18px;color: #00000099;">Courier cost*</td>
		<td style="font-size: 14px;font-weight: 400;line-height: 18px;"><span id="kurir"></span></td>
	</tr> -->
	<tr align="left" height="35px">
		<td style="font-size: 14px;font-weight: bold;line-height: 18px;color: #000000;">Estimate</td>
		<td style="text-align:right;font-size: 14px;font-weight: 400;line-height: 18px;"><span id="est"></span></td>
		<td style="font-size: 14px;font-weight: 400;line-height: 18px;"><span id="perest"></span></td>
	</tr>
</table>
</div>
</div>

<div id="dialog-formcost" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons" 
data-options="border:false,title:false,resizable:false,modal:true,closable:false"
style="width:400px;height:250px;padding:5px 5px;display:none;border-radius:8px;top:20%;">
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

<div id="dialog-formhistory" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons" data-options="border:false,title:false,resizable:false,modal:true,closable:false"
style="width:750px;height:400px;padding:5px 5px;display:none;top:150px;border-radius:8px;top:20%;">
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
<table id="dg2c" class="easyui-datagrid" title="" style="width:98%;" align="center" border="none" striped="false" 
data-options="singleSelect:true,pagination:false,collapsible:true,rownumbers:false,border:true,autoRowHeight:true">
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

<!-- konfirmasi sync -->
<div id="dialog-sync" class="easyui-dialog sticky" closed="true" buttons="#dialog-buttons" data-options="border:false,title:false,resizable:false,modal:true,closable:false"
style="width:373px;height:179px;padding:5px;gap:20px;display:none;top:150px;border-radius:8px;top:20%;">
<form id="formsync" method="post">
<input type="hidden" id="ordpks" name="ordpks" value="<?php echo $_GET['ord']; ?>">
<div style="padding: 10px;font-style: normal;font-weight: 700;font-size: 18px;line-height: 24px;">Konfirmasi sync ke order</div>
<div style="padding: 10px;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;">
Costing FOB ini akan diterapkan ke semua purchase order di list order breakdown. <br> Apakah anda mau lanjut?	
</div>
<a style="text-decoration:none; left: 180px; top: 130px;" href="javascript:void(0)"
class="button-cancel" onclick="cansync();">Cancel</a>
<a style="text-decoration:none; left: 250px; top: 130px;width:100px;" href="javascript:void(0)"
class="button-submit" onclick="savesync();">Confirm</a>
</form>
</div>

<!-- <div id="hijau" class='text-infohijau sticky' style='width:250px;margin-top:600px;margin-left:25px;display:none;'>Costing information saved. &nbsp; &#10004;</div> -->
 <!-- <script>
    console.log("%c NATIVE RECONSTRUCTION SUCCESS ", "background: #064e3b; color: #34d399; font-weight: bold; padding: 4px;");
    console.log("SRNO: <?php echo $data_ord['srno'] ?? 'N/A'; ?>");
    console.log("Stage: <?php echo $dtstyle['stagenm'] ?? 'N/A'; ?>");
    console.log("SMV Final: <?php echo $smvDisplay; ?>");
    
    // Tampilkan table data jika diperlukan
    const debugStatus = <?php echo json_encode($dtstyle); ?>;
    if(debugStatus) console.table(debugStatus);
</script>

<script>
    console.log("%c DEBUG DATA NATIVE ", "background: #1e293b; color: #38bdf8; font-weight: bold; padding: 4px;");
    
    // Log Data Order
    const dataOrd = <?php echo json_encode($data_ord); ?>;
    console.log("1. Data Order (SIG):");
    if (dataOrd) {
        console.table(dataOrd);
    } else {
        console.warn("Order dengan ORDPK <?php echo $ordpk; ?> tidak ditemukan.");
    }

    // Log Data Request
    const dataReq = <?php echo json_encode($dt_request); ?>;
    console.log("2. Data Request (Sample):");
    if (dataReq) {
        console.table(dataReq);
    } else {
        console.warn("SRNO <?php echo $srno ?? 'N/A'; ?> tidak terdaftar di DB Sample.");
    }
</script> -->