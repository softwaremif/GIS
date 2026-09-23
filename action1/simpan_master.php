<?php
include "../config/koneksi.php";
require "../config/vendor/autoload.php";
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

if($_FILES["uploadfile"]["name"] != ''){
$ordpk  = $_POST['ordpk'];
$filenm = $_FILES['uploadfile']['name'];
$file = $_FILES['uploadfile']['tmp_name'];

 $allowed_extension = array('xls', 'csv', 'xlsx');
 $file_array = explode(".", $_FILES["uploadfile"]["name"]);
 $file_extension = end($file_array);

 if(in_array($file_extension, $allowed_extension)){
  $file_name = time() . '.' . $file_extension;

  //move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file_name);
  $file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($file_name);
  $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type);

  $spreadsheet = $reader->load($file_name);

  unlink($file_name);

  $sheetdata = $spreadsheet->getActiveSheet()->toArray();

for($i = 3;$i < count($sheetData);$i++){
$data1 = $sheetData[$i]['0'];
$data2 = $sheetData[$i]['1'];
$data3 = $sheetData[$i]['2'];
$data4 = $sheetData[$i]['3'];
$data5 = $sheetData[$i]['4'];
$data6 = $sheetData[$i]['5'];
$data7 = $sheetData[$i]['6'];
$data8 = $sheetData[$i]['7'];
$data9 = $sheetData[$i]['8'];
$data10 = $sheetData[$i]['9'];
$data11 = $sheetData[$i]['10'];
$data12 = $sheetData[$i]['11'];
$data13 = $sheetData[$i]['12'];
$data14 = $sheetData[$i]['13'];
$data15 = $sheetData[$i]['14'];
$data16 = $sheetData[$i]['15'];
$data17 = $sheetData[$i]['16'];
$data18 = $sheetData[$i]['17'];
$data19 = $sheetData[$i]['18'];
$data20 = $sheetData[$i]['19'];
$data21 = $sheetData[$i]['20'];
$data22 = $sheetData[$i]['21'];

$GAC=date('Y-m-d', strtotime($data7));
$total=$data8+$data9+$data10+$data11+$data12+$data13+$data14+$data15+$data16+
        $data17+$data18+$data19+$data20+$data21+$data22;
$i2=$i-2;

$query=mysqli_query($koneksi,"insert into bdown set
ordpk='$ordpk',
nour='$i2',
jenis='$data1',
country='$data2',
pono='$data3',
opno='$data4',
style='$data5',
color='$data6',
gac='$data7',
s1='$data8',
s2='$data9',
s3='$data10',
s4='$data11',
s5='$data12',
s6='$data13',
s7='$data14',
s8='$data15',
s9='$data16',
s10='$data17',
s11='$data18',
s12='$data19',
s13='$data20',
s14='$data21',
s15='$data22',
tot='$total'");
if ($query) $sukses++;
 }
if($sukses>0) {
$text=mysqli_query($koneksi,"update ord set filenm='$filenm' where ordpk='$ordpk'");
echo "<div class='text-infohijau' style='width:285px;'>Data Imported Successfully &nbsp; &#10004;</div>";
} else {
echo "<div class='text-infomerah' style='width:285px;'>Data Imported Error &nbsp; &#x2573;</div>";   
}
} else {
  echo "<div class='text-infomerah' style='width:285px;'>Only .xls .csv or .xlsx file allowed &nbsp; &#x2573;</div>'";
 }
} else {
 echo "<div class='text-infomerah' style='width:285px;'>Please Select File &nbsp; &#x2573;</div>";
}
?>