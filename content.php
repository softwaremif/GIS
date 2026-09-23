<script type="text/javascript">
  function onReturnBack1() {
    // history.back();
    var returnBack = true;
    localStorage.setItem('returnBack', returnBack);
    window.location.href = "?hal=order&c1=<?php echo $_GET['c1']; ?>&c2=<?php echo $_GET['c2']; ?>&c3=<?php echo $_GET['c3']; ?>&c7=<?php echo $_GET['c7']; ?>&c8=<?php echo $_GET['c8']; ?>";
  }

  function onReturnBack2() {
    // history.back();
    var returnBack = true;
    localStorage.setItem('returnBack', returnBack);
    window.location.href = "?hal=dford&c1=<?php echo $_GET['c1']; ?>&c2=<?php echo $_GET['c2']; ?>&c3=<?php echo $_GET['c3']; ?>&c7=<?php echo $_GET['c7']; ?>&c8=<?php echo $_GET['c8']; ?>";
  }

  // function getQueryParam(param) {
  //   var urlParams = new URLSearchParams(window.location.search);
  //   return urlParams.get(param);
  // }

  // Dapatkan elemen tombol
  // var backButton = document.getElementById("backButton");

  // // Cek nilai "hal" di URL
  // if (getQueryParam("hal") === "qty") {
  //   backButton.setAttribute("onclick", "BackToOrder()");
  // } else {
  //   backButton.setAttribute("onclick", "onReturnBack1()");
  // }

  function linkmaterials() {
    var ord = "<?php echo $_GET['ord']; ?>";
    var c1 = "<?php echo $_GET['c1']; ?>";
    var c2 = "<?php echo $_GET['c2']; ?>";
    var c3 = "<?php echo $_GET['c3']; ?>";
    var c7 = "<?php echo $_GET['c7']; ?>";
    var c8 = "<?php echo $_GET['c8']; ?>";

    var url = `?hal=mat&ord=${ord}&c1=${c1}&c2=${c2}&c3=${c3}&c7=${c7}&c8=${c8}`;
    window.location.href = url;
  }

  function linkcosting() {
    var ord = "<?php echo $_GET['ord']; ?>";
    var c1 = "<?php echo $_GET['c1']; ?>";
    var c2 = "<?php echo $_GET['c2']; ?>";
    var c3 = "<?php echo $_GET['c3']; ?>";
    var c7 = "<?php echo $_GET['c7']; ?>";
    var c8 = "<?php echo $_GET['c8']; ?>";

    var url = `?hal=cost&ord=${ord}&c1=${c1}&c2=${c2}&c3=${c3}&c7=${c7}&c8=${c8}`;
    window.location.href = url;
  }
</script>
<?php
//include "action/sinkron5.php";
?>
<!-- Detail -->
<div id="atas" onmousemove="" onclick="
<?php //if ($_GET['hal'] <> "qty") { 
?>
/*$('#menu').hide();
$('#dg').datagrid('clearSelections');
$('#dg2').datagrid('clearSelections');
$('#dg3a').datagrid('clearSelections');
$('#dg3b').datagrid('clearSelections');*/
<?php //} 
?>
/*$('#dg').edatagrid('cancelRow');
$('#dg').datagrid('reload');*/">
  <?php
  $style = "border-bottom:  3px solid #000000;color: #000000;";
  $ord = $_GET['ord'];
  $po = $_GET['po'];
  $spv = $_SESSION['spv'];
  $lead = $_SESSION['leader'];
  $thn2 = date("Y");
  $bln2 = date("m");
  $today = DATE('Y-m-d');

  $result = mysqli_fetch_array(mysqli_query($koneksi4, "select * FROM dtg order by tglinput desc limit 1"));
  $result2 = mysqli_fetch_array(mysqli_query($koneksi4, "select * FROM dtg where tglinput='$result[tglinput]' order by jamposting desc limit 1"));
  if ($result2['jamposting'] > 0) {
    $day = date('l', strtotime($result['tglinput']));
    $hasil = $day . "," . " " . tgl($result['tglinput']) . " " . $result2['jamposting'];
  } else {
    $hasil = date('l, d/M/Y  H:i:s');
  }
  // echo $hasil;
  ?>
  <input type="hidden" name="spv" id="spv" value="<?php echo $spv; ?>" size="5">
  <input type="hidden" name="lead" id="lead" value="<?php echo $lead; ?>" size="5">
  <?php
  if ($_SESSION['gusernm'] == "fu") {
    if ($_GET['hal'] == "order") {
  ?>
      <div id="judul">
        Order list
        <a style="text-decoration:none; left:145px; top: -5px;width: 200px;" href="?hal=sum" class="button-request-po" onclick="">View order summary report</a>
      </div>
    <?php } else if ($_GET['hal'] == "sum") { ?>
      <div id="frame-utama-judul">
        <div class="frame-arrow">
          <a href="javascript:void(0);" onclick="onReturnBack1();"><input type="image" src="css/images/Vector2.png" class="panah-samping" style="margin-left:0px;"></a>
        </div>
        <div class="frame-judul" align="left" style="margin-left:-20px;">
          <div class="font-judul-atas" style="top:10px;right:0px; font-weight:normal; font-size:16px;"><a href="?hal=order" style="text-decoration:none;color:#000000;">Back</a></div>
          <div class="font-judul-bawah" style="top:35px;right:30px;width:auto;font-style: normal;font-weight: 700;font-size: 20px;line-height: 24px;">
            Order summary report
          </div>
          <div class="font-judul-bawah" style="top:45px;right:30px;width:auto;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;">
            Quick summary report of orders that have been shipped in a certain period
          </div>
        </div>
      </div>
    <?php } else if ($_GET['hal'] == "list") { ?>
      <div id="frame-utama-judul" style="top:75px;">
        <div class="frame-arrow">
          <a href="?hal=order"><input type="image" src="css/images/Vector2.png" class="panah-samping" style="margin-left:0px;"> </a>
        </div>
        <div class="frame-judul" align="left" style="margin-left:-20px;">
          <div class="font-judul-atas" style="top:10px;right:0px; font-weight:normal; font-size:16px;"><a href="?hal=order" style="text-decoration:none;color:#000000;">Back</a></div>
          <div class="font-judul-bawah" style="top:35px;right:30px;width:auto;font-style: normal;font-weight: 700;font-size: 20px;line-height: 24px;">
            Order list assignment
          </div>
          <div class="font-judul-bawah" style="top:65px;right:30px;width:auto;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;">
            Below are list of orders that have been created by you or your team members. <br>
            You can adjust the assignments to see which person can access which order.
          </div>
        </div>
      </div>
    <?php } else if ($_GET['hal'] == "lpb" || $_GET['hal'] == "lpb2") { ?>
      <div id="frame-utama-judul" style="width:100%;">
        <div class="frame-judul" align="left" style="width:100%;">
          <div class="font-judul-bawah" style="left:30px;width:auto;font-style: normal;font-weight: 700;font-size: 20px;line-height: 24px;">
            Minus kelengkapan material
          </div>
          <div class="font-judul-bawah" style="color:rgba(0,0,0,0.60);left:68%;width:auto;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;">
            Last updated: &nbsp; <span id="last1"><?php echo $hasil; ?></span>
          </div>

          <div class="font-judul-bawah" style="left:30px;width:auto;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;">
            Orders shown are orders that already scheduled in production
          </div>
        </div>
      </div>
      <?php } else {
      if ($_GET['hal'] == "proses") {
      } else if ($_GET['hal'] == "assign") {
      } else if ($_GET['hal'] == "assign2") {
      } else if ($_GET['hal'] == "proses2") {
      } else if ($_GET['hal'] == "lpb") {
      } else if ($_GET['hal'] == "detpomd") {
      } else if ($_GET['hal'] == "shipdet_detpomd") {
      } else if ($_GET['hal'] == "detpopur") {
      } else if ($_GET['hal'] == "shipdet_detpopur") {
      } else {
        $cari = mysqli_query($koneksi, "SELECT ordschedlc2.ordschedpk, ordschedlc2.cutdate AS cut, ordschedlc2.startdate2 AS ssew, ordschedlc2.packingdate AS fsew, lin.linnm, lin.linpk
        FROM ordschedlc2
        LEFT OUTER JOIN ord ON ord.ordpk=ordschedlc2.ordpk
        LEFT OUTER JOIN schedlc ON schedlc.schedlcpk=ordschedlc2.schedlcpk
        LEFT OUTER JOIN lin ON lin.linpk=schedlc.linpk
        WHERE ordschedlc2.ordpk='$ord' ORDER BY ordschedlc2.ordschedpk ASC LIMIT 1");
        $dt = mysqli_fetch_array($cari);

        $cari2 = mysqli_query($koneksi, "select byr.byrnm, fu.funm, ord.srno, ord.ordpk, ord.ordno, ord.mif,
              ord.artno, ord.prodes, ord.season, ord.buymonth, ord.deldate, ord.codate, ord.ordpk, ord.stsprod
              FROM ord
              left outer join byr on byr.byrpk=ord.byrpk
              left outer join fu on fu.fupk=ord.fupk
              where ord.ordpk='$ord'");
        $dt2 = mysqli_fetch_array($cari2);

        if ($dt['linpk'] > 0) {
          // if ($dt['cut'] <= $today) {
            if ($dt['ssew'] <= $today) {
              // $stsprod = '<div style="width:83px;height:20px;display: inline-flex;padding: 2px 4px;justify-content: center;align-items: flex-start;border-radius: 4px;background:#19B715;color:#FFFFFF;font-size: 12px;font-style: normal;font-weight: 700;line-height: 16px;">Complete</div>';
            // } else {
              // if ($today >= $dt['fsew'] && $dt['fsew'] <> '') {
              //   // $status = "<span style='background-color:#FE6600;padding:5px;color:#FFFFFF;font-size:12px;border-radius:5px;'>FINISHING</span>";
              //   $stsprod = '<div style="width:83px;height:20px;display: inline-flex;padding: 2px 4px;justify-content: center;align-items: flex-start;border-radius: 4px;background-color:#FE6600;color:#FFFFFF;font-size: 12px;font-style: normal;font-weight: 700;line-height: 16px;">FINISHING</div>';
              // } else if ($today >= $dt['ssew'] && $dt['ssew'] <> '') {
              //   // $status = "<span style='background-color:#19B715;padding:5px;color:#FFFFFF;font-size:12px;border-radius:5px;'>SEWING</span>";
              //   $stsprod = '<div style="width:83px;height:20px;display: inline-flex;padding: 2px 4px;justify-content: center;align-items: flex-start;border-radius: 4px;background-color:#19B715;color:#FFFFFF;font-size: 12px;font-style: normal;font-weight: 700;line-height: 16px;">SEWING</div>';
              // } else if ($today >= $dt['cut'] && $dt['cut'] <> '') {
              //   // $status = "<span style='background-color:#0B89D2;padding:5px;color:#FFFFFF;font-size:12px;border-radius:5px;'>CUTTING</span>";
              //   $stsprod = '<div style="width:83px;height:20px;display: inline-flex;padding: 2px 4px;justify-content: center;align-items: flex-start;border-radius: 4px;background-color:#0B89D2;color:#FFFFFF;font-size: 12px;font-style: normal;font-weight: 700;line-height: 16px;">CUTTING</div>';
              // } else {
              $stsprod = '<div style="width:83px;height:20px;display: inline-flex;padding: 2px 4px;justify-content: center;align-items: flex-start;border-radius: 4px;background:#0B89D2;color:#FFFFFF;font-size: 12px;font-style: normal;font-weight: 700;line-height: 16px;">Production</div>';
              // }
            // }
          } else {
            $stsprod = '<div style="width:83px;height:20px;display: inline-flex;padding: 2px 4px;justify-content: center;align-items: flex-start;border-radius: 4px;background:#FF6B00;color:#FFFFFF;font-size: 12px;font-style: normal;font-weight: 700;line-height: 16px;">Scheduled</div>';
          }
        } else if ($dt['stsprod'] == 1) {
          $stsprod = '<div style="width:83px;height:20px;display: inline-flex;padding: 2px 4px;justify-content: center;align-items: flex-start;border-radius: 4px;background:#858585;color:#FFFFFF;font-size: 12px;font-style: normal;font-weight: 700;line-height: 16px;">No Schedule</div>';
        } else {
          $stsprod = '<div style="width:83px;height:20px;display: inline-flex;padding: 2px 4px;justify-content: center;align-items: flex-start;border-radius: 4px;background:#BDBDBD;color:#FFFFFF;font-size: 12px;font-style: normal;font-weight: 700;line-height: 16px;">Draft</div>';
        }

        $tot1 = mysqli_num_rows(mysqli_query($koneksi, "select * FROM rkb
              left outer join ord on ord.ordpk=rkb.ordpk
              where rkb.spec<>'' and ord.fupk='$_SESSION[fu]' and ord.ordpk='$ord'"));

        $tot1b = mysqli_num_rows(mysqli_query($koneksi, "select * FROM rkb
              left outer join ord on ord.ordpk=rkb.ordpk
              where rkb.spec<>'' and ord.fupk='$_SESSION[fu]' and ord.ordpk='$ord' and rkb.stspk is null and rkb.status<='3'"));

        $tot3 = mysqli_num_rows(mysqli_query($koneksi, "select * FROM rkb
              left outer join rpo on rpo.rkbpk=rkb.rkbpk
              left outer join podt on podt.rkbpk=rkb.rkbpk
              left outer join po on po.popk=podt.popk
              left outer join ord on ord.ordpk=rkb.ordpk
              left outer join sup on sup.suppk=rkb.suppk
              left outer join cur on  cur.curpk=rkb.curpk
              where rkb.spec<>'' and ord.fupk='$_SESSION[fu]' and ord.ordpk='$ord' and rkb.status>='3'
              group by rkb.rkbpk"));

        $tot3b = mysqli_num_rows(mysqli_query($koneksi, "select * FROM rkb
              left outer join ord on ord.ordpk=rkb.ordpk
              where rkb.spec<>'' and ord.fupk='$_SESSION[fu]' and ord.ordpk='$ord' and rkb.status='6'"));

        $tot2a = mysqli_num_rows(mysqli_query($koneksi, "select * FROM rkb
            left outer join ord on ord.ordpk=rkb.ordpk
            where rkb.spec<>'' and ord.ordpk='$ord' and rkb.status='1' and rkb.stspk is null"));

        $tot2b = mysqli_num_rows(mysqli_query($koneksi, "select * FROM rkb
            left outer join ord on ord.ordpk=rkb.ordpk
            where rkb.spec<>'' and ord.ordpk='$ord' and rkb.status='2' and rkb.stspk is null"));

        $tot2c = mysqli_num_rows(mysqli_query($koneksi, "select * FROM rkb
            left outer join ord on ord.ordpk=rkb.ordpk
            where rkb.spec<>'' and ord.ordpk='$ord' and rkb.status='3' and rkb.stspk is null"));
      ?>
        <div id="frame-utama-judul">
          <div class="frame-arrow">
            <a href="javascript:void(0);" id="backButton" onclick="(new URLSearchParams(window.location.search).get('hal') === 'qty') ? BackToOrder() : onReturnBack1();"><input type="image" src="css/images/Vector2.png" class="panah-samping"></a>
          </div>
          <div class="frame-judul" style="width:225px;">
            <div class="font-judul-atas">Order
              <?php
               if($dt2['mif'] == 1){
                $mif = "(MIF 1)";
               }else if($dt2['mif'] == 2){
                $mif = "(MIF 2)";
               }else if($dt2['mif'] == 3){
                $mif = "(MIF 1 & 2)";
               }else{
                $mif = "";
               }
              ?>
              <a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor: default;" title="<?php echo TRIM($dt2['ordno']); ?>" class="easyui-tooltip">
                &nbsp;<?php echo truncate(TRIM($dt2['ordno']), 10);?>
                <!-- <span style="font-size:12px;"><?php //echo $mif; ?></span> -->
              </a>
            </div>
            <div class="font-judul-bawah" style="width:300px;">
              <a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor: default;" title="<?php echo TRIM($dt2['byrnm']); ?>" class="easyui-tooltip">
                <?php echo truncate(TRIM($dt2['byrnm']), 10); ?>
              </a>
              , Season
              <a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor: default;" title=" <?php echo TRIM($dt2['season']); ?>" class="easyui-tooltip">
                &nbsp;<?php echo truncate(TRIM($dt2['season']), 5); ?>
              </a>
            </div>
          </div>
          <table width="auto" height="50px" border="0px" style="margin-left:-4%;">
            <tr>
              <th width="100px" align="left" style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: rgba(0, 0, 0, 0.38);">
                Status
              </th>
              <th width="100px" align="left" style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: rgba(0, 0, 0, 0.38);">
                MD
              </th>
              <th width="100px" align="left" style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: rgba(0, 0, 0, 0.38);">
                Article
              </th>
              <th width="100px" align="left" style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: rgba(0, 0, 0, 0.38);">
                SR No.
              </th>
              <th width="300px" align="left" style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: rgba(0, 0, 0, 0.38);">
                Product
              </th>
            </tr>
            <tr>
              <td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: rgba(0, 0, 0, 0.87);">
                <?php echo $stsprod; ?>
              </td>
              <td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: rgba(0, 0, 0, 0.87);">
                <?php echo $dt2['funm']; ?>
              </td>
              <td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: rgba(0, 0, 0, 0.87);">
                <a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor: default;" title="<?php echo TRIM($dt['artno']); ?>" class="easyui-tooltip">
                  <?php echo truncate(TRIM($dt2['artno']), 10); ?>
                </a>
              </td>
              <td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: rgba(0, 0, 0, 0.87);">
                <a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor: default;">
                  <?php echo $dt2['srno']; ?>
                </a>
              </td>
              <td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: rgba(0, 0, 0, 0.87);">
                <a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor: default;" title="<?php echo TRIM($dt2['prodes']); ?>" class="easyui-tooltip">
                  <?php echo truncate(TRIM($dt2['prodes']), 30); ?>
                </a>
              </td>
            </tr>
          </table>
          <!--<div class="frame-utama-md">
<font class="md">MD</font>
<font class="nm-md"><?php //echo $dt['funm']; ?></font>
</div>
<div class="frame-utama-article">
<font class="article">Article</font>
<font class="article-number">
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;" title="<?php //echo TRIM($dt['artno']); ?>" class="easyui-tooltip">
<?php //echo truncate(TRIM($dt['artno']),8); 
?>
</a>
</font>
</div>
<div class="frame-utama-Product">
<font class="product">Product</font>
<font class="dt-product">
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;" title="<?php //echo TRIM($dt['prodes']); ?>" class="easyui-tooltip">
<?php //echo truncate(TRIM($dt['prodes']),15); 
?>
</a>
</font>
</div>-->
        </div>
        <div id="frame-menu-detail" style="left:77%;width:100%;height:auto;">
          <!--breakdwownqty-->
          <a href="?hal=qty&ord=<?php echo $ord; ?>&c1=<?php echo $_GET['c1']; ?>&c2=<?php echo $_GET['c2']; ?>&c3=<?php echo $_GET['c3']; ?>&c7=<?php echo $_GET['c7']; ?>&c8=<?php echo $_GET['c8']; ?>"
            class="link" style="<?php if ($_GET['hal'] == "qty") { echo $style; } ?>">Order breakdown</a>
          <!--allmaterial-->
          <!-- <a href="?hal=mat&ord=<?php echo $ord; ?>" class="link" style="<?php //if ($_GET['hal'] == "mat") {echo $style;} ?>">
          <?php //if ($_GET['hal'] == "mat") { 
          ?> All materials <span id="tmat1">(<?php //echo $tot1; ?>)</span> <span id="tmat" style="display:none;"></span>
          <?php //} else { 
          ?> All materials (<?php //echo $tot1; ?>) <?php //} ?> </a> -->
          <!-- <a href="?hal=mat&ord=<?php //echo $ord; ?>&c1=<?php //echo $_GET['c1']; ?>&c2=<?php //echo $_GET['c2']; ?>&c3=<?php //echo $_GET['c3']; ?>&c7=<?php // echo $_GET['c7']; ?>&c8=<?php //echo $_GET['c8']; ?>" class="link" style="
          <?php
          // if ($_GET['hal'] == "mat" || $_GET['hal'] == "detmat" || $_GET['hal'] == "pur") {
          //   echo $style;
          // } 
          ?>
          "> -->
          <a href="javascript:void(0)" onclick="(new URLSearchParams(window.location.search).get('hal') === 'qty') ? ToMaterials() : linkmaterials();" class="link" style="
          <?php if ($_GET['hal'] == "mat" || $_GET['hal'] == "detmat" || $_GET['hal'] == "pur") {
            echo $style;
          } ?>">
            Materials
          </a>
          <!--workedon-->
          <!-- <a href="?hal=detmat&dt=1&ord=<?php //echo $ord; ?>" class="link2" style="<?php //if ($_GET['hal'] == "detmat") {echo $style;} ?>">
          Worked on (<?php //echo $tot1b; ?>)
          <?php //if ($_GET['dt'] > 1) { 
          ?>
          <span id="ntwork" style="display:none;"><img src="css/images/notiff.png" width="8px" height="8px"></span>
          <?php //} else {
          //if ($tot2b > 0 || $tot2c > 0) {
          ?>
          <img src="css/images/notiff.png" width="8px" height="8px">
          <?php //}
          //} 
          ?>
          </a> -->
          <!--purchasing-->
          <!-- <a href="?hal=pur&ord=<?php //echo $ord; ?>" class="link" style="<?php //if ($_GET['hal'] == "pur") {echo $style;} ?>">
          <?php //if ($_GET['hal'] == "pur") { 
          ?> Purchasing <span id="tpur1">(<?php //echo $tot3; ?>)</span> <span id="tpur" style="display:none;"></span>
          <?php //} else { 
          ?> Purchasing (<?php //echo $tot3; ?>) <?php //} ?> </a> -->
          <!--costing-->
          <?php if ($spv == 1) { ?>
            <!-- <a href="?hal=cost&ord=<?php //echo $ord; ?>&c1=<?php //echo $_GET['c1']; ?>&c2=<?php //echo $_GET['c2']; ?>&c3=<?php //echo $_GET['c3']; ?>&c7=<?php //echo $_GET['c7']; ?>&c8=<?php //echo $_GET['c8']; ?>" 
             class="link" style="<?php //if ($_GET['hal'] == "cost") { echo $style;} ?>"> -->
            <!-- Costing
            </a> -->
            <a href="javascript:void(0)" onclick="(new URLSearchParams(window.location.search).get('hal') === 'qty') ? ToCosting() : linkcosting();" class="link" style="<?php if ($_GET['hal'] == "cost") { echo $style; } ?>">
              Costing
            </a>
          <?php } ?>
          <!--end-->
        </div>
        <?php
        if ($_GET['hal'] == "mat" || $_GET['hal'] == "detmat" || $_GET['hal'] == "pur") {
        ?>
          <div id="frame-menu-detail" style="margin-left:-55%; margin-top:52px; width:100%; height:auto;">
            <!--allmaterial-->
            <a href="?hal=mat&ord=<?php echo $ord; ?>&c1=<?php echo $_GET['c1']; ?>&c2=<?php echo $_GET['c2']; ?>&c3=<?php echo $_GET['c3']; ?>&c7=<?php echo $_GET['c7']; ?>&c8=<?php echo $_GET['c8']; ?>"
              class="link" style="<?php if ($_GET['hal'] == "mat") { echo $style; } ?>">
              <?php if ($_GET['hal'] == "mat") { ?> All materials <span id="tmat1">(<?php echo $tot1; ?>)</span> <span id="tmat" style="display:none;"></span>
              <?php } else { ?> All materials (<?php echo $tot1; ?>) <?php } ?>
            </a>
            <!--readyforpo-->
            <a href="?hal=detmat&dt=1&ord=<?php echo $ord; ?>&c1=<?php echo $_GET['c1']; ?>&c2=<?php echo $_GET['c2']; ?>&c3=<?php echo $_GET['c3']; ?>&c7=<?php echo $_GET['c7']; ?>&c8=<?php echo $_GET['c8']; ?>"
              class="link" style="<?php if ($_GET['hal'] == "detmat") { echo $style; } ?>">
              Worked on (<?php echo $tot1b; ?>)
              <?php if ($_GET['dt'] > 1) { ?>
                <span id="ntwork" style="display:none;"><img src="css/images/notiff.png" width="8px" height="8px"></span>
                <?php } else {
                if ($tot2b > 0 || $tot2c > 0) {
                ?>
                  <img src="css/images/notiff.png" width="8px" height="8px">
              <?php }
              } ?>
            </a>
            <!--needrevision-->
            <a href="?hal=pur&ord=<?php echo $ord; ?>&c1=<?php echo $_GET['c1']; ?>&c2=<?php echo $_GET['c2']; ?>&c3=<?php echo $_GET['c3']; ?>&c7=<?php echo $_GET['c7']; ?>&c8=<?php echo $_GET['c8']; ?>"
              class="link" style="<?php if ($_GET['hal'] == "pur") { echo $style; } ?>">
              <?php if ($_GET['hal'] == "pur") { ?> Purchasing <span id="tpur1">(<?php echo $tot3; ?>)</span> <span id="tpur" style="display:none;"></span>
              <?php } else { ?> Purchasing (<?php echo $tot3; ?>) <?php } ?>
            </a>
            <!--tab2-->
          </div>
        <?php
        }
        if ($_GET['hal'] == "detmat") { ?>
          <div id="frame-menu-detail" style="margin-left:-55%; margin-top:90px; width:100%; height:auto;">
            <!--inprogress-->
            <a href="?hal=detmat&dt=1&ord=<?php echo $ord; ?>&c1=<?php echo $_GET['c1']; ?>&c2=<?php echo $_GET['c2']; ?>&c3=<?php echo $_GET['c3']; ?>&c7=<?php echo $_GET['c7']; ?>&c8=<?php echo $_GET['c8']; ?>"
              class="link2" style="<?php if ($_GET['dt'] == "1") { echo $style; } ?>">
              <?php if ($_GET['dt'] == 1) { ?> IN PROGRESS <span id="tprogress1">(<?php echo $tot2a; ?>)</span> <span id="tprogress" style="display:none;"></span>
              <?php } else { ?> IN PROGRESS (<?php echo $tot2a; ?>) <?php } ?>
            </a>
            <!--readyforpo-->
            <a href="?hal=detmat&dt=2&ord=<?php echo $ord; ?>&c1=<?php echo $_GET['c1']; ?>&c2=<?php echo $_GET['c2']; ?>&c3=<?php echo $_GET['c3']; ?>&c7=<?php echo $_GET['c7']; ?>&c8=<?php echo $_GET['c8']; ?>"
              class="link2" style="<?php if ($_GET['dt'] == "2") { echo $style; } ?>">
              <?php if ($_GET['dt'] == 2) { ?> READY FOR PO <span id="tready1">(<?php echo $tot2b; ?>)</span> <span id="tready" style="display:none;"></span>
              <?php } else { ?> READY FOR PO (<?php echo $tot2b; ?>) <?php } ?>
            </a>
            <!--needrevision-->
            <?php if ($tot2c > 0) { ?>
              <a href="?hal=detmat&dt=3&ord=<?php echo $ord; ?>&c1=<?php echo $_GET['c1']; ?>&c2=<?php echo $_GET['c2']; ?>&c3=<?php echo $_GET['c3']; ?>&c7=<?php echo $_GET['c7']; ?>&c8=<?php echo $_GET['c8']; ?>"
                class="link2" style="<?php if ($_GET['dt'] == "3") { echo $style; } ?>">
                <?php if ($_GET['dt'] == 3) { ?> NEED REVISION <span id="trevisi1">(<?php echo $tot2c; ?>)</span> <span id="trevisi" style="display:none;"></span>
                <?php } else { ?> NEED REVISION (<?php echo $tot2c; ?>) <?php } ?>
              </a>
            <?php } ?>
            <!--tab2-->
          </div>
    <?php
        }
      }
    }
  } else if ($_SESSION['gusernm'] == "purchasing") {
    if ($_SESSION['mat'] == 1) {
      $and3 = "and rpo.kelnm='CUTTING'";
    } else {
      $and3 = "and rpo.kelnm<>'CUTTING'";
      $and3b = "and rpo.kelnm like '%sewing%'";
    }

    $tot1 = mysqli_num_rows(mysqli_query($koneksi, "SELECT *  FROM rpo
          LEFT OUTER JOIN ord ON ord.ordpk=rpo.ordpk
          LEFT OUTER JOIN fu ON fu.fupk=ord.fupk
          LEFT OUTER JOIN sup ON sup.suppk=rpo.suppk
          LEFT OUTER JOIN cur ON  cur.curpk=rpo.curpk
          WHERE rpo.stspk='1' and rpo.popros='0' and rpo.popk='0' and ord.fupk<>'' and rpo.rkbpk<>'' and rpo.item<>'' and YEAR(rpo.tgl)='$thn2' $and3 $and3b"));

    /*
$tot4= mysqli_num_rows(mysqli_query($koneksi,"SELECT * FROM rpo
left outer join ord on ord.ordpk=rpo.ordpk
WHERE rpo.stspk='7' and ord.fupk<>'' and rpo.rkbpk<>'' and rpo.item<>'' and YEAR(rpo.tgl)='$thn2' and MONTH(rpo.tgl)='$bln2' $and3"));
*/

    $tot2 = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM po
          left outer join sup on sup.suppk=po.suppk
          left outer join podt on podt.popk=po.popk
          left outer join cur on cur.curpk=podt.curpk
          left outer join ord on ord.ordpk=podt.ordpk
          left outer join fu on fu.fupk=ord.fupk
          left outer join rkb on rkb.rkbpk=podt.rkbpk
          left outer join rpo on rpo.rpopk=podt.rpopk
          WHERE po.pur='$_SESSION[login]' and po.postatpk between '1' and '3' and rkb.status between '3' and '6' and YEAR(po.tglpo)='$thn2'
          group by po.popk"));

    $tot2b = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM po
          left outer join sup on sup.suppk=po.suppk
          left outer join podt on podt.popk=po.popk
          left outer join cur on cur.curpk=podt.curpk
          left outer join ord on ord.ordpk=podt.ordpk
          left outer join fu on fu.fupk=ord.fupk
          left outer join rkb on rkb.rkbpk=podt.rkbpk
          left outer join rpo on rpo.rpopk=podt.rpopk
          WHERE po.pur='$_SESSION[login]' and po.postatpk between '1' and '3' and rkb.status between '3' and '6' and YEAR(po.tglpo)='$thn2'
          and po.tpo1='1'
          group by po.popk"));

    $tot3b = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM po
          left outer join sup on sup.suppk=po.suppk
          left outer join podt on podt.popk=po.popk
          left outer join cur on cur.curpk=podt.curpk
          left outer join ord on ord.ordpk=podt.ordpk
          left outer join fu on fu.fupk=ord.fupk
          left outer join rkb on rkb.rkbpk=podt.rkbpk
          left outer join rpo on rpo.rpopk=podt.rpopk
          WHERE po.pur='$_SESSION[login]'and po.postatpk='4' and rkb.status='6' and YEAR(po.tglpo)='$thn2'
          and po.tpo1='1'
          group by po.popk"));

    $tot3 = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM po
          left outer join sup on sup.suppk=po.suppk
          left outer join podt on podt.popk=po.popk
          left outer join cur on cur.curpk=podt.curpk
          left outer join ord on ord.ordpk=podt.ordpk
          left outer join fu on fu.fupk=ord.fupk
          left outer join rkb on rkb.rkbpk=podt.rkbpk
          left outer join rpo on rpo.rpopk=podt.rpopk
          WHERE po.pur='$_SESSION[login]' and po.postatpk='4' and rkb.status='6' and YEAR(po.tglpo)='$thn2'
          group by po.popk"));
    
    $tot4b = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM po
          LEFT OUTER JOIN podt ON podt.popk=po.popk 
          LEFT OUTER JOIN ord ON ord.ordpk=podt.ordpk
          LEFT OUTER JOIN byr ON byr.byrpk=ord.byrpk
          LEFT OUTER JOIN fu ON fu.fupk=ord.fupk
          WHERE po.pur='$_SESSION[login]' and po.stsrev='1' and po.dateupdt BETWEEN DATE_SUB(NOW(), INTERVAL 3 MONTH) AND NOW()
          GROUP BY po.popk"));

    $tot4 = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM po
          LEFT OUTER JOIN podt ON podt.popk=po.popk 
          LEFT OUTER JOIN ord ON ord.ordpk=podt.ordpk
          LEFT OUTER JOIN byr ON byr.byrpk=ord.byrpk
          LEFT OUTER JOIN fu ON fu.fupk=ord.fupk
          WHERE po.pur='$_SESSION[login]' and po.stsrev='1' and po.dateupdt BETWEEN DATE_SUB(NOW(), INTERVAL 3 MONTH) AND NOW()
          GROUP BY po.popk"));
    ?>
    <!-- Detail -->
    <?php
    if ($_GET['hal'] == "detpo" || $_GET['hal'] == "detpoedt" || $_GET['hal'] == "shipdet_detpo") {
    } else {
      if ($_GET['hal'] == "new") { ?>
        <div id="judul">PO requests</div>
      <?php } else if ($_GET['hal'] == "assign3") { ?>
        <div id="judul"></div>
      <?php } else if ($_GET['hal'] == "ordp") { ?>
        <div id="judul">Orders' material</div>
      <?php } else if ($_GET['hal'] == "ppic") { ?>
        <div id="judul">PPIC monitoring</div>
      <?php } else if ($_GET['hal'] == "rev") { ?>
        <div id="judul">Revision from MD</div>
      <?php } else { ?>
        <div id="judul">Purchase orders</div>
      <?php } ?>
      <!--tab-->
      <?php if ($_GET['hal'] == "assign3" || $_GET['hal'] == "ppic") {
      } else { ?>
        <div id="frame-menu-detail" style="width:100%;height:auto;left:48%;">
          <!--orderp-->
          <a href="?hal=ordp" class="link" style="<?php if ($_GET['hal'] == "ordp") { echo $style; } ?>">
            Orders
          </a>
          <!--new-->
          <a href="?hal=new" class="link" style="<?php if ($_GET['hal'] == "new") { echo $style; } ?>">
            <?php if ($_GET['hal'] == "new") { ?> New requests <span id="tnew1">(<?php echo $tot1; ?>)
                <?php if ($tot1 > 0) { ?>
                  <img src="css/images/notiff.png" width="8px" height="8px">
                <?php
                }
                ?>
              </span>
              <span id="tnew" style="display:none;"></span>
              <span id="ntnew" style="display:none;"><img src="css/images/notiff.png" width="8px" height="8px"></span>
            <?php
            } else { ?> New requests (<?php echo $tot1; ?>)
              <?php if ($tot1 > 0) { ?>
                <img src="css/images/notiff.png" width="8px" height="8px">
            <?php
              }
            }
            ?>
          </a>
          <!--cancel-->
          <!--<a href="?hal=cancel" class="link" style="<?php //if($_GET['hal']=="cancel"){ echo $style; } ?>">
<?php //if($_GET['hal']=="cancel"){ 
?> Cancel PO (<span id="tcancel"></span>)
<?php //} else { 
?> Cancel PO (<?php //echo $tot4; ?>) <?php //} ?></a>-->

          <!--awaiting-->
          <a href="action/simpan.php?x=mempo2&pur=<?php echo $_SESSION['login']; ?>" class="link" style="<?php if ($_GET['hal'] == "wait") { echo $style; } ?>">
            <?php
            if ($_GET['hal'] == "wait") { ?> Awaiting PI <span id="twait1">(<?php echo $tot2; ?>)
                <?php if ($tot2b > 0) { ?>
                  <img src="css/images/notiff.png" width="8px" height="8px">
                <?php
                }
                ?>
              </span>
              <span id="twait" style="display:none;"></span>
              <span id="ntwait" style="display:none;"></span>
            <?php
            } else { ?> Awaiting PI (<?php echo $tot2; ?>)
              <?php if ($tot2b > 0) { ?>
                <img src="css/images/notiff.png" width="8px" height="8px">
            <?php
              }
            }
            ?>
          </a>
          <!--purchased-->
          <a href="?hal=pur2" class="link" style="<?php if ($_GET['hal'] == "pur2") { echo $style; } ?>">
            <?php if ($_GET['hal'] == "pur2") { ?>Purchased <span id="tpay1">(<?php echo $tot3; ?>)
              <?php if ($tot3b > 0) { ?>
                <img src="css/images/notiff.png" width="8px" height="8px">
              <?php
              }
              ?>
            </span>
            <span id="tpay" style="display:none;"></span>
            <span id="ntpay" style="display:none;"></span>
          <?php } else { ?> Purchased (<?php echo $tot3; ?>)
            <?php if ($tot3b > 0) { ?>
              <img src="css/images/notiff.png" width="8px" height="8px">
          <?php
              }
            }
          ?>
          </a>
          <!--revision-->
          <a href="?hal=rev" class="link" style="<?php if ($_GET['hal'] == "rev") { echo $style; } ?>">
            <?php if ($_GET['hal'] == "rev") { ?>Revision <span id="tpay1">(<?php echo $tot4; ?>)
              <?php if ($tot4b > 0) { ?>
                <img src="css/images/notiff.png" width="8px" height="8px">
              <?php
              }
              ?>
            </span>
            <span id="tpay" style="display:none;"></span>
            <span id="ntpay" style="display:none;"></span>
          <?php } else { ?> Revision (<?php echo $tot4; ?>)
            <?php if ($tot4b > 0) { ?>
              <img src="css/images/notiff.png" width="8px" height="8px">
          <?php
              }
            }
          ?>
          </a>
          <!--end-->
        </div>
      <?php }
    }
  } else {
    if ($_GET['hal'] == "dtpo" || $_GET['hal'] == "shipdet_dtpo") {
    } else if ($_GET['hal'] == "dford") {
      ?>
      <div id="judul">
        Order list
      </div>
    <?php } else if ($_GET['hal'] == "dfqty" || $_GET['hal'] == "dfmat" || $_GET['hal'] == "cost" || $_GET['hal'] == "report") {
        $cari = mysqli_query($koneksi, "SELECT ordschedlc2.ordschedpk, ordschedlc2.cutdate AS cut, ordschedlc2.startdate2 AS ssew, ordschedlc2.packingdate AS fsew, lin.linnm, lin.linpk
        FROM ordschedlc2
        LEFT OUTER JOIN ord ON ord.ordpk=ordschedlc2.ordpk
        LEFT OUTER JOIN schedlc ON schedlc.schedlcpk=ordschedlc2.schedlcpk
        LEFT OUTER JOIN lin ON lin.linpk=schedlc.linpk
        WHERE ordschedlc2.ordpk='$ord' ORDER BY ordschedlc2.ordschedpk ASC LIMIT 1");
        $dt = mysqli_fetch_array($cari);

        $cari2 = mysqli_query($koneksi, "select byr.byrnm, fu.funm, ord.srno, ord.ordpk, ord.ordno, ord.mif,
              ord.artno, ord.prodes, ord.season, ord.buymonth, ord.deldate, ord.codate, ord.ordpk, ord.stsprod
              FROM ord
              left outer join byr on byr.byrpk=ord.byrpk
              left outer join fu on fu.fupk=ord.fupk
              where ord.ordpk='$ord'");
        $dt2 = mysqli_fetch_array($cari2);

      $tot1 = mysqli_num_rows(mysqli_query($koneksi, "select * FROM rkb
left outer join ord on ord.ordpk=rkb.ordpk
where rkb.spec<>'' and ord.ordpk='$ord'"));

      // $tot1b= mysqli_num_rows(mysqli_query($koneksi,"select * FROM rkb
      // left outer join ord on ord.ordpk=rkb.ordpk
      // where rkb.spec<>'' and ord.ordpk='$ord' and rkb.stspk is null and rkb.status<='3'"));

      // $tot3= mysqli_num_rows(mysqli_query($koneksi,"select * FROM rkb
      // left outer join rpo on rpo.rkbpk=rkb.rkbpk
      // left outer join podt on podt.rkbpk=rkb.rkbpk
      // left outer join po on po.popk=podt.popk
      // left outer join ord on ord.ordpk=rkb.ordpk
      // left outer join sup on sup.suppk=rkb.suppk
      // left outer join cur on  cur.curpk=rkb.curpk
      // where rkb.spec<>'' and ord.ordpk='$ord' and rkb.status>='3'
      // group by rkb.rkbpk"));

      // $tot3b= mysqli_num_rows(mysqli_query($koneksi,"select * FROM rkb
      // left outer join ord on ord.ordpk=rkb.ordpk
      // where rkb.spec<>'' and ord.ordpk='$ord' and rkb.status='6'"));

      // $tot2a = mysqli_num_rows(mysqli_query($koneksi,"select * FROM rkb
      // left outer join ord on ord.ordpk=rkb.ordpk
      // where rkb.spec<>'' and ord.ordpk='$ord' and rkb.status='1' and rkb.stspk is null"));

      // $tot2b = mysqli_num_rows(mysqli_query($koneksi,"select * FROM rkb
      // left outer join ord on ord.ordpk=rkb.ordpk
      // where rkb.spec<>'' and rkb.status='2' and rkb.stspk is null"));

      // $tot2c = mysqli_num_rows(mysqli_query($koneksi,"select * FROM rkb
      // left outer join ord on ord.ordpk=rkb.ordpk
      // where rkb.spec<>'' and rkb.status='3' and rkb.stspk is null"));

        if ($dt['linpk'] > 0) {
          // if ($dt['cut'] <= $today) {
            if ($dt['ssew'] <= $today) {
              // $stsprod = '<div style="width:83px;height:20px;display: inline-flex;padding: 2px 4px;justify-content: center;align-items: flex-start;border-radius: 4px;background:#19B715;color:#FFFFFF;font-size: 12px;font-style: normal;font-weight: 700;line-height: 16px;">Complete</div>';
            // } else {
              // if ($today >= $dt['fsew'] && $dt['fsew'] <> '') {
              //   // $status = "<span style='background-color:#FE6600;padding:5px;color:#FFFFFF;font-size:12px;border-radius:5px;'>FINISHING</span>";
              //   $stsprod = '<div style="width:83px;height:20px;display: inline-flex;padding: 2px 4px;justify-content: center;align-items: flex-start;border-radius: 4px;background-color:#FE6600;color:#FFFFFF;font-size: 12px;font-style: normal;font-weight: 700;line-height: 16px;">FINISHING</div>';
              // } else if ($today >= $dt['ssew'] && $dt['ssew'] <> '') {
              //   // $status = "<span style='background-color:#19B715;padding:5px;color:#FFFFFF;font-size:12px;border-radius:5px;'>SEWING</span>";
              //   $stsprod = '<div style="width:83px;height:20px;display: inline-flex;padding: 2px 4px;justify-content: center;align-items: flex-start;border-radius: 4px;background-color:#19B715;color:#FFFFFF;font-size: 12px;font-style: normal;font-weight: 700;line-height: 16px;">SEWING</div>';
              // } else if ($today >= $dt['cut'] && $dt['cut'] <> '') {
              //   // $status = "<span style='background-color:#0B89D2;padding:5px;color:#FFFFFF;font-size:12px;border-radius:5px;'>CUTTING</span>";
              //   $stsprod = '<div style="width:83px;height:20px;display: inline-flex;padding: 2px 4px;justify-content: center;align-items: flex-start;border-radius: 4px;background-color:#0B89D2;color:#FFFFFF;font-size: 12px;font-style: normal;font-weight: 700;line-height: 16px;">CUTTING</div>';
              // } else {
              $stsprod = '<div style="width:83px;height:20px;display: inline-flex;padding: 2px 4px;justify-content: center;align-items: flex-start;border-radius: 4px;background:#0B89D2;color:#FFFFFF;font-size: 12px;font-style: normal;font-weight: 700;line-height: 16px;">Production</div>';
              // }
            // }
          } else {
            $stsprod = '<div style="width:83px;height:20px;display: inline-flex;padding: 2px 4px;justify-content: center;align-items: flex-start;border-radius: 4px;background:#FF6B00;color:#FFFFFF;font-size: 12px;font-style: normal;font-weight: 700;line-height: 16px;">Scheduled</div>';
          }
        } else if ($dt['stsprod'] == 1) {
          $stsprod = '<div style="width:83px;height:20px;display: inline-flex;padding: 2px 4px;justify-content: center;align-items: flex-start;border-radius: 4px;background:#858585;color:#FFFFFF;font-size: 12px;font-style: normal;font-weight: 700;line-height: 16px;">No Schedule</div>';
        } else {
          $stsprod = '<div style="width:83px;height:20px;display: inline-flex;padding: 2px 4px;justify-content: center;align-items: flex-start;border-radius: 4px;background:#BDBDBD;color:#FFFFFF;font-size: 12px;font-style: normal;font-weight: 700;line-height: 16px;">Draft</div>';
        }
    ?>
      <div id="frame-utama-judul">
        <div class="frame-arrow">
          <a href="javascript:void(0);" onclick="onReturnBack2();"><input type="image" src="css/images/Vector2.png" class="panah-samping"></a>
        </div>
        <div class="frame-judul" style="width:200px;">
          <div class="font-judul-atas">Order
            <a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor: default;" title="<?php echo TRIM($dt2['ordno']); ?>" class="easyui-tooltip">
              &nbsp;<?php echo truncate(TRIM($dt2['ordno']), 10) ?>
            </a>
          </div>
          <div class="font-judul-bawah" style="width:300px;">
            <a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor: default;" title="<?php echo TRIM($dt2['byrnm']); ?>" class="easyui-tooltip">
              <?php echo truncate(TRIM($dt2['byrnm']), 11); ?>
            </a>
            , Season
            <a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor: default;" title=" <?php echo TRIM($dt2['season']); ?>" class="easyui-tooltip">
              &nbsp;<?php echo truncate(TRIM($dt2['season']), 5); ?>
            </a>
          </div>
        </div>
        <table width="auto" height="50px" border="0px" style="margin-left:-4%;">
          <tr>
            <th width="100px" align="left" style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: rgba(0, 0, 0, 0.38);">
              Status
            </th>
            <th width="100px" align="left" style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: rgba(0, 0, 0, 0.38);">
              MD
            </th>
            <th width="100px" align="left" style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: rgba(0, 0, 0, 0.38);">
              Article
            </th>
            <th width="100px" align="left" style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: rgba(0, 0, 0, 0.38);">
              SR No.
            </th>
            <th width="300px" align="left" style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: rgba(0, 0, 0, 0.38);">
              Product
            </th>
          </tr>
          <tr>
            <td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: rgba(0, 0, 0, 0.87);">
              <?php echo $stsprod; ?>
            </td>
            <td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: rgba(0, 0, 0, 0.87);">
              <?php echo $dt2['funm']; ?>
            </td>
            <td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: rgba(0, 0, 0, 0.87);">
              <a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor: default;" title="<?php echo TRIM($dt2['artno']); ?>" class="easyui-tooltip">
                <?php echo truncate(TRIM($dt2['artno']), 10); ?>
              </a>
            </td>
            <td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: rgba(0, 0, 0, 0.87);">
              <a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor: default;">
                <?php echo $dt2['srno']; ?>
              </a>
            </td>
            <td style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;color: rgba(0, 0, 0, 0.87);">
              <a href="javascript:void(0)" style="text-decoration:none; color:#000000;cursor: default;" title="<?php echo TRIM($dt2['prodes']); ?>" class="easyui-tooltip">
                <?php echo truncate(TRIM($dt2['prodes']), 30); ?>
              </a>
            </td>
          </tr>
        </table>
<!--<div class="frame-utama-md">
<font class="md">MD</font>
<font class="nm-md"><?php //echo $dt['funm']; ?></font>
</div>
<div class="frame-utama-article">
<font class="article">Article</font>
<font class="article-number">
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;" title="<?php //echo TRIM($dt['artno']); ?>" class="easyui-tooltip">
<?php //echo truncate(TRIM($dt['artno']),8); 
?>
</a>
</font>
</div>
<div class="frame-utama-Product">
<font class="product">Product</font>
<font class="dt-product">
<a href="javascript:void(0)" style="text-decoration:none; color:#000000;" title="<?php //echo TRIM($dt['prodes']);  ?>" class="easyui-tooltip">
<?php //echo truncate(TRIM($dt['prodes']),15); 
?>
</a>
</font>
</div>-->
      </div>
      <?php
      if ($_GET['hal'] == "report") {
      } else {
      ?>
        <div id="frame-menu-detail" style="left:72%;width:100%;height:auto;">
          <!--breakdwownqty-->
          <a href="?hal=dfqty&ord=<?php echo $ord; ?>&c1=<?php echo $_GET['c1']; ?>&c2=<?php echo $_GET['c2']; ?>&c3=<?php echo $_GET['c3']; ?>&c7=<?php echo $_GET['c7']; ?>&c8=<?php echo $_GET['c8']; ?>"
          class="link" style="<?php if ($_GET['hal'] == "dfqty") { echo $style; } ?>">Order breakdown</a>
          <!--allmaterial-->
          <a href="?hal=dfmat&ord=<?php echo $ord; ?>&c1=<?php echo $_GET['c1']; ?>&c2=<?php echo $_GET['c2']; ?>&c3=<?php echo $_GET['c3']; ?>&c7=<?php echo $_GET['c7']; ?>&c8=<?php echo $_GET['c8']; ?>"
          class="link" style="<?php if ($_GET['hal'] == "dfmat") { echo $style; } ?>">
          <?php if ($_GET['hal'] == "dfmat") { ?> All materials <span id="tmat1">(<?php echo $tot1; ?>)</span> <span id="tmat" style="display:none;"></span>
          <?php } else { ?> All materials (<?php echo $tot1; ?>) <?php } ?> </a>
            <!-- <a href="?hal=cost&ord=<?php //echo $ord; ?>&c1=<?php //echo $_GET['c1']; ?>&c2=<?php //echo $_GET['c2'];  ?>&c3=<?php //echo $_GET['c3']; ?>&c7=<?php //echo $_GET['c7']; ?>&c8=<?php //echo $_GET['c8']; ?>"
            class="link" style="<?php //if ($_GET['hal'] == "cost") { //echo $style; //  } ?>">
            Costing
            </a> -->
            <?php if ($_SESSION['leader'] > 0) { ?>
            <a href="javascript:void(0)" onclick="linkcosting();" class="link" style="<?php if ($_GET['hal'] == "cost") { echo $style; } ?>">
            Costing
            </a>
          <?php } ?>
        </div>
      <?php } ?>
    <?php } else if ($_GET['hal'] == "dfpo") { ?>
      <div id="judul">Purchase orders</div>
    <?php } else if ($_GET['hal'] == "sum") { ?>
      <div id="frame-utama-judul">
        <div class="frame-arrow">
        </div>
        <div class="frame-judul">
          <div class="font-judul-bawah" style="top:20px;left:-55px;width:auto;font-style: normal;font-weight: 700;font-size: 20px;line-height: 24px;">
            Order summary report
          </div>
          <div class="font-judul-bawah" style="top:25px;left:-55px;width:auto;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;">
            Quick summary report of orders that have been shipped in a certain period
          </div>
        </div>
      </div>
    <?php } else if ($_GET['hal'] == "log") { ?>
      <div id="frame-utama-judul">
        <div class="frame-arrow">
        </div>
        <div class="frame-judul">
          <div class="font-judul-bawah" style="top:20px;left:-55px;width:auto;font-style: normal;font-weight: 700;font-size: 20px;line-height: 24px;">
            Log activity user
          </div>
        </div>
      </div>
    <?php } else if ($_GET['hal'] == "dflpb") { ?>
      <div id="frame-utama-judul" style="top:75px; width:100%;">
        <div class="frame-judul" align="left" style="width:100%;">
          <div class="font-judul-bawah" style="top:35px;left:30px;width:auto;font-style: normal;font-weight: 700;font-size: 20px;line-height: 24px;">
            Minus kelengkapan material
          </div>
          <div class="font-judul-bawah" style="color:rgba(0,0,0,0.60);top:18px;left:68%;width:auto;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;">
            Last updated: &nbsp; <span id="last2"> </span>
          </div>

          <div class="font-judul-bawah" style="top:30px;left:30px;width:auto;font-style: normal;font-weight: 400;font-size: 14px;line-height: 18px;">
            Orders shown are orders that already scheduled in production
          </div>
        </div>
      </div>
  <?php }
  }
  ?>
</div>
<script type="text/javascript">
  //DROPDOWN
  /*function tutup(){
  document.getElementById("myDropdown1").classList.toggle("");
  document.querySelector('#myDropdown1').style.display = 'none';
  }*/
  // Close the dropdown if the user clicks outside of it
  $(document).on("click", function(event) {
    var $trigger = $("#notif");
    if ($trigger !== event.target && !$trigger.has(event.target).length) {
      $(".dropdwn-content1").slideUp("fast");
    }
  });

  function myFunction2() {
    document.querySelector('#myDropdown2b').style.display = '';
    document.getElementById("myDropdown2b").classList.toggle("show");
  }
  $(document).on("click", function(event) {
    var $trigger = $("#viewmemo");
    if ($trigger !== event.target && !$trigger.has(event.target).length) {
      $(".dropdwn-content2").slideUp("fast");
    }
  });

  //DROPDOWN
  function myFunction() {
    document.querySelector('#myDropdown').style.display = '';
    document.getElementById("myDropdown").classList.toggle("show");
  }
  $(document).on("click", function(event) {
    var $trigger = $("#frame-filter-newest");
    if ($trigger !== event.target && !$trigger.has(event.target).length) {
      $(".dropdwn-content").slideUp("fast");
    }
  });

  function myFunction1c() {
    document.querySelector('#myDropdown2').style.display = '';
    document.getElementById("myDropdown2").classList.toggle("show");
    $('#kolom1').datagrid('load');
  }
  $(document).on("click", function(event) {
    var $trigger = $("#frame-filter-fields");
    if ($trigger !== event.target && !$trigger.has(event.target).length) {
      $(".dropdown1-content").slideUp("fast");
    }
  });

  function myFunction1d() {
    document.querySelector('#myDropdown3').style.display = '';
    document.getElementById("myDropdown3").classList.toggle("show");
    $('#spl').datagrid('load');
    $('#byr2').datagrid('load');
    var total = document.getElementById("total").value;
    if (total >= 1) {
      $('#fltr2').show();
    } else {
      $('#fltr2').hide();
    }
  }
  /*$(document).on("click", function(event){
   var $trigger = $("#frame-filter2");
   if($trigger !== event.target && !$trigger.has(event.target).length){
     $(".dropdown2-content").slideUp("fast");							
     }            
});*/

  $(document).on("click", function(event) {
    var $trigger = $("#tabel");
    if ($trigger !== event.target && !$trigger.has(event.target).length) {
      //$('#menu').fadeOut();
      //$('#dg').datagrid('clearSelections');
      //$('#dg2').datagrid('clearSelections');
      //$('#dg3a').datagrid('clearSelections');
      //$('#dg3b').datagrid('clearSelections');
    }
  });
</script>
<?php
/*MD*/
if ($_GET['hal'] == "order") {
  include "view/ord.php";
}
/*if($_GET['hal'] == "detord"){ include "view/detord2.php"; }
if($_GET['hal'] == "ord2"){ include "view/ord2.php"; }
if	($_GET['hal'] == "mat"){ include "view/material.php"; }*/
if ($_GET['hal'] == "qty") {
  include "view/qty.php";
}
if ($_GET['hal'] == "mat") {
  include "view/material.php";
}
if ($_GET['hal'] == "detmat") {
  include "view/material2.php";
}
if ($_GET['hal'] == "pur") {
  include "view/purchasing.php";
}
if ($_GET['hal'] == "proses") {
  include "view/proses.php";
}
if ($_GET['hal'] == "proses2") {
  include "view/proses2.php";
}
if ($_GET['hal'] == "assign") {
  include "view/assign.php";
}
if ($_GET['hal'] == "assign2") {
  include "view/assign2.php";
}
if ($_GET['hal'] == "detpomd") {
  include "view/detpomd.php";
}
if ($_GET['hal'] == "shipdet_detpomd") {
  include "view/shipdet_detpomd.php";
}
if ($_GET['hal'] == "detpopur") {
  include "view/detpopur.php";
}
if ($_GET['hal'] == "shipdet_detpopur") {
  include "view/shipdet_detpopur.php";
}
if ($_GET['hal'] == "cost") {
  include "view/cost.php";
}

/*Purchasing*/
if ($_GET['hal'] == "ppic") {
  include "view/ppic.php";
}
if ($_GET['hal'] == "ordp") {
  include "view/ordp.php";
}
if ($_GET['hal'] == "new") {
  include "view/new.php";
}
if ($_GET['hal'] == "assign3") {
  include "view/assign3.php";
}
if ($_GET['hal'] == "cancel") {
  include "view/cancel.php";
}
if ($_GET['hal'] == "wait") {
  include "view/waiting.php";
}
if ($_GET['hal'] == "detpo") {
  include "view/detpo.php";
}
if ($_GET['hal'] == "detpoedt") {
  include "view/detpoedt.php";
}
if ($_GET['hal'] == "shipdet_detpo") {
  include "view/shipdet_detpo.php";
}
if ($_GET['hal'] == "pur2") {
  include "view/purchased.php";
}
if ($_GET['hal'] == "rev") {
  include "view/rev.php";
}

/*user*/
if ($_GET['hal'] == "dford") {
  include "view/dford.php";
}
if ($_GET['hal'] == "dfqty") {
  include "view/dfqty.php";
}
if ($_GET['hal'] == "dfmat") {
  include "view/dfmat.php";
}
if ($_GET['hal'] == "dfpo") {
  include "view/dfpo.php";
}
if ($_GET['hal'] == "dtpo") {
  include "view/dtpo.php";
}
if ($_GET['hal'] == "shipdet_dtpo") {
  include "view/shipdet_dtpo.php";
}
if ($_GET['hal'] == "report") {
  include "view/report.php";
}

/*dashboard*/
if ($_GET['hal'] == "sum") {
  include "view/sum.php";
}
if ($_GET['hal'] == "list") {
  include "view/list.php";
}
if ($_GET['hal'] == "log") {
  include "view/log.php";
}
if ($_GET['hal'] == "lpb") {
  include "view/lpb.php";
}
if ($_GET['hal'] == "lpb2") {
  include "view/lpb2.php";
}
if ($_GET['hal'] == "dflpb") {
  include "view/dflpb.php";
}
?>