<?php
session_start();
$fu=$_SESSION['fu'];
include "../config/koneksi.php";
include "../config/koneksi11a.php";
include "../config/koneksi103a.php";
require "../config/vendor/autoload.php";
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
//use PhpOffice\PhpSpreadsheet\Reader\Xls;

$ordpk  = $_POST['ordpk'];
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
for($i = 2;$i < count($sheetData);$i++){
$data1 = $sheetData[$i]['0'];
$data2 = $sheetData[$i]['1'];
$data3 = $sheetData[$i]['2'];
$data4 = $sheetData[$i]['3'];
$data5 = $sheetData[$i]['4'];
$data6 = $sheetData[$i]['5'];
$data7 = $sheetData[$i]['6'];
$data8 = $sheetData[$i]['7'];
$ddp   = $sheetData[$i]['8'];
$data9 = $sheetData[$i]['9'];
$secsz = $sheetData[$i]['10'];
$data10 = $sheetData[$i]['11'];
$data11 = $sheetData[$i]['12'];
$data12 = $sheetData[$i]['13'];
$data13 = $sheetData[$i]['14'];
$data14 = $sheetData[$i]['15'];
$data15 = $sheetData[$i]['16'];
$data16 = $sheetData[$i]['17'];
$data17 = $sheetData[$i]['18'];
$data18 = $sheetData[$i]['19'];
$data19 = $sheetData[$i]['20'];
$data20 = $sheetData[$i]['21'];
$data21 = $sheetData[$i]['22'];
$data22 = $sheetData[$i]['23'];
$data23 = $sheetData[$i]['24'];
$data24 = $sheetData[$i]['25'];
$data25 = $sheetData[$i]['26'];
$data26 = $sheetData[$i]['27'];
$data27 = $sheetData[$i]['28'];
$data28 = $sheetData[$i]['29'];
$data29 = $sheetData[$i]['30'];
$data30 = $sheetData[$i]['31'];
$data31 = $sheetData[$i]['32'];
$data32 = $sheetData[$i]['33'];
$data33 = $sheetData[$i]['34'];
$data34 = $sheetData[$i]['35'];
$data35 = $sheetData[$i]['36'];
$data36 = $sheetData[$i]['37'];
$data37 = $sheetData[$i]['38'];
$data38 = $sheetData[$i]['39'];
$data39 = $sheetData[$i]['40'];
$data40 = $sheetData[$i]['41'];
$data41 = $sheetData[$i]['42'];
$data42 = $sheetData[$i]['43'];
$data43 = $sheetData[$i]['44'];
$data44 = $sheetData[$i]['45'];
$data45 = $sheetData[$i]['46'];
$data46 = $sheetData[$i]['47'];
$data47 = $sheetData[$i]['48'];
$data48 = $sheetData[$i]['49'];
$data49 = $sheetData[$i]['50'];
$data50 = $sheetData[$i]['51'];

$GAC=date('Y-m-d', strtotime($data7));
$total=$data10+$data11+$data12+$data13+$data14+$data15+$data16+$data17+$data18+$data19+$data20+
        $data21+$data22+$data23+$data24+$data25+$data26+$data27+$data28+$data29+$data30+
        $data31+$data32+$data33+$data34+$data35+$data36+$data37+$data38+$data39+$data40+
        $data41+$data42+$data43+$data44+$data45+$data46+$data47+$data48+$data49+$data50;
$i2=$i-1;
//ordpk
if($ordpk==""){
$cr=mysqli_query($koneksi,"select * from ord where ordno='$data5'");
$dt=mysqli_fetch_array($cr);
$ordpk2=$dt['ordpk'];
$ordno=$dt['ordno'];
} else {
$cr2=mysqli_query($koneksi,"select * from ord where ordpk='$ordpk'");
$dt2=mysqli_fetch_array($cr2);
$ordpk2=$ordpk;   
$ordno=$dt2['ordno'];  
}
//bdownpk
$cr2=mysqli_query($koneksi,"select * from bdown order by bdownpk desc limit 1");
$dt2=mysqli_fetch_array($cr2);
$bdownpk=$dt2['bdownpk']+1;
//dataord
$query1a=mysqli_query($koneksi,"select * from ord
left outer join byr on byr.byrpk=ord.byrpk
left outer join fu on fu.fupk=ord.fupk
where ord.ordpk='$ordpk2' and fu.fupk='$fu'");
$data1a=mysqli_fetch_array($query1a);
$byrnm=addslashes($data1a['byrnm']);
$srno=$data1a['srno'];
$prodes=$data1a['prodes'];
$season=addslashes($data1a['season']);
//userpk
$query3b=mysqli_query($koneksi11a,"select userpk from user where fupk='$fu'");
$data3b=mysqli_fetch_array($query3b);
$userpk=$data3b['userpk'];
//opno
if($data5<>""){
$OP=str_replace(' ', '', $data5);
} else {
$OP=$ordno;       
}
//color&country
$country=addslashes($data2);
$poref=addslashes($data3);
$pono=addslashes($data4);
$style=addslashes($data6);
$color1=TRIM($data7);
$color=addslashes($color1);


if($data1=="HEADER"){
$query =mysqli_query($koneksi,"insert into bdown set
bdownpk='$bdownpk',
ordpk='$ordpk2',
nour='$i2',
jenis='$data1',
country='$country',
s1='$data10',
s2='$data11',
s3='$data12',
s4='$data13',
s5='$data14',
s6='$data15',
s7='$data16',
s8='$data17',
s9='$data18',
s10='$data19',
s11='$data20',
s12='$data21',
s13='$data22',
s14='$data23',
s15='$data24',
s16='$data25',
s17='$data26',
s18='$data27',
s19='$data28',
s20='$data29',
s21='$data30',
s22='$data31',
s23='$data32',
s24='$data33',
s25='$data34',
s26='$data35',
s27='$data36',
s28='$data37',
s29='$data38',
s30='$data39',
s31='$data40',
s32='$data41',
s33='$data41',
s34='$data43',
s35='$data44',
s36='$data45',
s37='$data46',
s38='$data47',
s39='$data48',
s40='$data49'");
} else {
if($data1=="DETAIL"){
$query=mysqli_query($koneksi,"insert into bdown set
bdownpk='$bdownpk',
ordpk='$ordpk2',
nour='$i2',
jenis='$data1',
country='$country',
poref='$poref',
pono='$pono',
opno='$OP',
style='$style',
color='$color',
FOB='$data8',
gac='$data9',
DDP='$ddp',
secsz='$secsz',
s1='$data10',
s2='$data11',
s3='$data12',
s4='$data13',
s5='$data14',
s6='$data15',
s7='$data16',
s8='$data17',
s9='$data18',
s10='$data19',
s11='$data20',
s12='$data21',
s13='$data22',
s14='$data23',
s15='$data24',
s16='$data25',
s17='$data26',
s18='$data27',
s19='$data28',
s20='$data29',
s21='$data30',
s22='$data31',
s23='$data32',
s24='$data33',
s25='$data34',
s26='$data35',
s27='$data36',
s28='$data37',
s29='$data38',
s30='$data39',
s31='$data40',
s32='$data41',
s33='$data41',
s34='$data43',
s35='$data44',
s36='$data45',
s37='$data46',
s38='$data47',
s39='$data48',
s40='$data49',
tot='$total'");
//sizebdown
$cr3=mysqli_query($koneksi,"select * from bdown where ordpk='$ordpk2' and jenis='HEADER' order by bdownpk desc limit 1");
$dt3=mysqli_fetch_array($cr3);
//andon11
$sql1b=mysqli_query($koneksi11a,"insert into po set
ordpk='$ordpk2',
bdownpk='$bdownpk',
OP='$OP',
buyer='$byrnm',
style='$style',
SR='$srno',
POno='$data4',
silhouette='$prodes',
season='$season',
mif='2',
qty='$total',
material='$color',
GAC='$data9',
customer='$country',
secsz='$secsz',
qty1='$data10',
qty2='$data11',
qty3='$data12',
qty4='$data13',
qty5='$data14',
qty6='$data15',
qty7='$data16',
qty8='$data17',
qty9='$data18',
qty10='$data19',
qty11='$data20',
qty12='$data21',
qty13='$data22',
qty14='$data23',
qty15='$data24',
qty16='$data25',
qty17='$data26',
qty18='$data27',
qty19='$data28',
qty20='$data29',
qty21='$data30',
qty22='$data31',
qty23='$data32',
qty24='$data33',
qty25='$data34',
qty26='$data35',
qty27='$data36',
qty28='$data37',
qty29='$data38',
qty30='$data39',
qty31='$data40',
qty32='$data41',
qty33='$data42',
qty34='$data43',
qty35='$data44',
qty36='$data45',
qty37='$data46',
qty38='$data47',
qty39='$data48',
qty40='$data49',
userpk='$userpk',
sts='0'");
//andon103
$sql1c=mysqli_query($koneksi103a,"insert into po set
ordpk='$ordpk2',
bdownpk='$bdownpk',
OP='$OP',
buyer='$byrnm',
style='$style',
SR='$srno',
POno='$data4',
silhouette='$prodes',
season='$season',
mif='1',
qty='$total',
material='$color',
GAC='$data9',
customer='$country',
secsz='$secsz',
qty1='$data10',
qty2='$data11',
qty3='$data12',
qty4='$data13',
qty5='$data14',
qty6='$data15',
qty7='$data16',
qty8='$data17',
qty9='$data18',
qty10='$data19',
qty11='$data20',
qty12='$data21',
qty13='$data22',
qty14='$data23',
qty15='$data24',
qty16='$data25',
qty17='$data26',
qty18='$data27',
qty19='$data28',
qty20='$data29',
qty21='$data30',
qty22='$data31',
qty23='$data32',
qty24='$data33',
qty25='$data34',
qty26='$data35',
qty27='$data36',
qty28='$data37',
qty29='$data38',
qty30='$data39',
qty31='$data40',
qty32='$data41',
qty33='$data42',
qty34='$data43',
qty35='$data44',
qty36='$data45',
qty37='$data46',
qty38='$data47',
qty39='$data48',
qty40='$data49',
userpk='$userpk',
sts='0'");
//sizeandon11
$sql2=mysqli_query($koneksi11a,"update po set
size1='$dt3[s1]',
size2='$dt3[s2]',
size3='$dt3[s3]',
size4='$dt3[s4]',
size5='$dt3[s5]',
size6='$dt3[s6]',
size7='$dt3[s7]',
size8='$dt3[s8]',
size9='$dt3[s9]',
size10='$dt3[s10]',
size11='$dt3[s11]',
size12='$dt3[s12]',
size13='$dt3[s13]',
size14='$dt3[s14]',
size15='$dt3[s15]',
size16='$dt3[s16]',
size17='$dt3[s17]',
size18='$dt3[s18]',
size19='$dt3[s19]',
size20='$dt3[s20]',
size21='$dt3[s21]',
size22='$dt3[s22]',
size23='$dt3[s23]',
size24='$dt3[s24]',
size25='$dt3[s25]',
size26='$dt3[s26]',
size27='$dt3[s27]',
size28='$dt3[s28]',
size29='$dt3[s29]',
size30='$dt3[s30]',
size31='$dt3[s31]',
size32='$dt3[s32]',
size33='$dt3[s33]',
size34='$dt3[s34]',
size35='$dt3[s35]',
size36='$dt3[s36]',
size37='$dt3[s37]',
size38='$dt3[s38]',
size39='$dt3[s39]',
size40='$dt3[s40]' where ordpk='$ordpk2'");
//sizeandon103
$sql2b=mysqli_query($koneksi103a,"update po set
size1='$dt3[s1]',
size2='$dt3[s2]',
size3='$dt3[s3]',
size4='$dt3[s4]',
size5='$dt3[s5]',
size6='$dt3[s6]',
size7='$dt3[s7]',
size8='$dt3[s8]',
size9='$dt3[s9]',
size10='$dt3[s10]',
size11='$dt3[s11]',
size12='$dt3[s12]',
size13='$dt3[s13]',
size14='$dt3[s14]',
size15='$dt3[s15]',
size16='$dt3[s16]',
size17='$dt3[s17]',
size18='$dt3[s18]',
size19='$dt3[s19]',
size20='$dt3[s20]',
size21='$dt3[s21]',
size22='$dt3[s22]',
size23='$dt3[s23]',
size24='$dt3[s24]',
size25='$dt3[s25]',
size26='$dt3[s26]',
size27='$dt3[s27]',
size28='$dt3[s28]',
size29='$dt3[s29]',
size30='$dt3[s30]',
size31='$dt3[s31]',
size32='$dt3[s32]',
size33='$dt3[s33]',
size34='$dt3[s34]',
size35='$dt3[s35]',
size36='$dt3[s36]',
size37='$dt3[s37]',
size38='$dt3[s38]',
size39='$dt3[s39]',
size40='$dt3[s40]' where ordpk='$ordpk2'");
}
}
if ($query) $sukses++;
$text=mysqli_query($koneksi,"update ord set filenm='$filenm' where ordpk='$ordpk2'");
}
if($sukses>0){
echo "<div class='text-infohijau' style='width:285px;'>$sukses Data Imported Successfully &nbsp; &#10004;</div>";
} else {
echo "<div class='text-infomerah' style='width:285px;'>Data Imported Error &nbsp; &#x2573;</div>";        
}
} else {
echo "<div class='text-infomerah' style='width:285px;'>Only .csv or .xlsx file allowed &nbsp; &#x2573;</div>";        
}
?>