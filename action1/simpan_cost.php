<?php
include"../config/koneksi.php";
require "../config/vendor/autoload.php";
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
//use PhpOffice\PhpSpreadsheet\Reader\Xls;

// $ordpk  = $_POST['ordpk'];
$filenm = $_FILES['uploadfile']['name'];
$file = $_FILES['uploadfile']['tmp_name'];
  
$file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv',
'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel',
'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
 
if(isset($_FILES['uploadfile']['name']) && in_array($_FILES['uploadfile']['type'], $file_mimes)){
 
$arr_file = explode('.', $_FILES['uploadfile']['name']);
$extension = end($arr_file);
 
if('csv' == $extension){
$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
} else {
$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
}
$reader->setReadDataOnly(true); 
$spreadsheet = $reader->load($_FILES['uploadfile']['tmp_name']);
$sheetData = $spreadsheet->getActiveSheet()->toArray();
for($i = 1;$i < count($sheetData);$i++){
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

$i2=$i-1;

if($data8<>""){
$cr=mysqli_query($koneksi,"select * from costing where ordpk='$data2'");
$dt=mysqli_fetch_array($cr);
if($dt['costpk']>0){
$query =mysqli_query($koneksi,"update costing set
ordpk='$data2',
CM='$data8',
materials='$data9',
others='$data10',
dateupdt=NOW() where costpk='$dt[costpk]'");
} else {
$query =mysqli_query($koneksi,"insert into costing set
ordpk='$data2',
CM='$data8',
materials='$data9',
others='$data10',
dateupdt=NOW()");
}
} 
if ($query) $sukses++;
// $text=mysqli_query($koneksi,"update ord set filenm='$filenm' where ordpk='$ordpk2'");
}
if($sukses>0){
echo "<div class='text-infohijau' style='width:300px;'>Costing information updated  &nbsp; &#10004;</div>";
} else {
echo "<div class='text-infomerah' style='width:300px;'>Data mismatch, please try again &nbsp; &#x2573;</div>";        
}
} else {
echo "<div class='text-infomerah' style='width:300px;'>An error occured, please try again &nbsp; &#x2573;</div>";        
}
?>