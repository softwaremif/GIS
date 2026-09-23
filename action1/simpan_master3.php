 <?php
 include "../config/koneksi.php";
 include "../config/PHPExcel-1.8.1/Classes/PHPExcel.php";
 $ordpk  = $_POST['ordpk'];
 $filenm = $_FILES['uploadfile']['name'];
  //$filenm = "ABCDE";
 $file = $_FILES['uploadfile']['tmp_name'];
 $text=mysqli_query($koneksi,"update ord set filenm='$filenm' where ordpk='$ordpk'");
 
    $random = "file_upload_".rand(11111,99999);
    $target_file = $random.basename($_FILES["uploadfile"]["name"]);
    $uploadOk = 1;
 
    if (move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $target_file)) {
 
        ini_set('memory_limit', '-1');
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
 
        $inputFileType = 'Excel2007';
        $sheetIndex = 0;
        $inputFileName = $target_file;
 
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $sheetnames = $objReader->listWorksheetNames($inputFileName);
        $objReader->setLoadSheetsOnly($sheetnames[$sheetIndex]);
     
        try {
        $objPHPExcel = $objReader->load($inputFileName);
        } catch(Exception $e) {
        die('Error loading file :' . $e->getMessage());
        }
 
        $worksheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
        $numRows = count($worksheet);
 
        //portaequipajes bagi setiap baris excel
        for ($i=3; $i <= $numRows ; $i++) {
            /*$sql = "INSERT INTO bdown set (nama_provinsi)
            VALUES ('".$worksheet[$i]['A']."')";*/
      $sql = 'INSERT INTO bdown SET';
      $sql = 'ordpk="'.$ordpk.'",';
      $sql = 'nour="'.$i2.'",';
      $sql .= 'jenis="'.$worksheet[$i]['A'].'",';
      $sql .= 'country="'.$worksheet[$i]['B'].'",';
      $sql .= 'pono="'.$worksheet[$i]['C'].'",';
      $sql .= 'opno="'.$worksheet[$i]['D'].'",';
      $sql .= 'style="'.$worksheet[$i]['E'].'",';
      $sql .= 'color="'.$worksheet[$i]['F'].'",';
      $sql .= 'gac="'.$GAC.'"';
 
            if (mysqli_query($koneksi, $sql)) {
                $pesan= "Sukses Simpan Data!";
            } else {
                $pesan= "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
 
        }
 
         unlink($target_file);
 
        $pesan ='Import Excel Success!';
        echo json_encode(array('st'=>1,'pesan'=>$pesan));
    } else {
        $pesan="Sorry, there was an error uploading your file.";
        echo json_encode(array('st'=>0,'pesan'=>$pesan));
    }
?>