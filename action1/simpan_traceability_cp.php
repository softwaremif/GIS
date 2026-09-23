<?php
include "../config/koneksi.php";
require "../config/vendor/autoload.php";
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

?>

<?php
if ($_GET["x"] == "insertform") {
  $ord = isset($_POST['ord']) ? $_POST['ord'] : '';

  $queryData = mysqli_query($koneksi, "SELECT *, YEAR(datecreate) AS tahun FROM ord WHERE ordpk = '$ord'");
  $data = mysqli_fetch_array($queryData);

  $fupk = $data['fupk'];
  $byrpk = $data['byrpk'];
  $artno = $data['artno'];
  $periode = $data['tahun'];

  // Treport
  $treportpkT1 = isset($_POST['treportpk']) ? $_POST['treportpk'] : '';
  if ($treportpkT1 > 0) {
    $queryTreport = mysqli_query($koneksi, "UPDATE treport SET periode = '$periode' WHERE treportpk = '$treportpkT1'");
    $treportpk = $treportpkT1;
    echo " Berhasil Update Treport";
 
  } else {
    $queryTreport = mysqli_query($koneksi, "INSERT INTO treport (fupk, byrpk, artno, periode) VALUES ('$fupk', '$byrpk', '$artno', '$periode')");
    $treportpk = mysqli_insert_id($koneksi);
    echo " Berhasil Insert Treport";
  }

  // Report T1 ----------------------------------------------------------------//
  $reportpkT1 = isset($_POST['reportpk1']) ? $_POST['reportpk1'] : '';

  $nameT1 = isset($_POST['nameT1']) ? $_POST['nameT1'] : '';
  $alamatT1 = isset($_POST['alamatT1']) ? $_POST['alamatT1'] : '';
  $stageT1 = isset($_POST['stageT1']) ? $_POST['stageT1'] : '';

  $namaSupplier1 = addslashes($nameT1);
  $alamatSupplier1 = addslashes($alamatT1);

  if ($reportpkT1 > 0) {
    $queryReportT1 = mysqli_query($koneksi, "UPDATE report1 SET stage = '$stageT1', supnm = '$namaSupplier1', alamat = '$alamatSupplier1' WHERE reportpk = '$reportpkT1'");
    $reportpk1 = $reportpkT1;
    echo "Berhasil Update Report1";
    
  } else {
    $queryReportT1 = mysqli_query($koneksi, "INSERT INTO report1 (treportpk, stage, supnm, alamat) VALUES ('$treportpk','$stageT1','$namaSupplier1','$alamatSupplier1')");
    $reportpk1 = mysqli_insert_id($koneksi);
    echo "Berhasil Insert Report1";
  }
  
  // File1 T1 ----------------------------------------------------------------//
  $maxFileSize = 2 * 1024 * 1024;
  $allowedExtensions = array('png', 'jpeg', 'jpg');

  for ($i = 1; $i <= 5; $i++) {
    $filepkT1 = isset($_POST['filepkT1_' . $i]) ? $_POST['filepkT1_' . $i] : '';
    $filenmT1 = isset($_POST['filenmT1_' . $i]) ? $_POST['filenmT1_' . $i] : '';
    $sblpoT1 = isset($_POST['poT1_' . $i]) ? $_POST['poT1_' . $i] : '';
    $poT1 = trim($sblpoT1);

    // Periksa file ada atau ngga
    $fileUploaded = isset($_FILES['fileT1_' . $i]) && $_FILES['fileT1_' . $i]['error'] == UPLOAD_ERR_OK;

    // Pengecekan ukuran file
    $fileSize = $_FILES['fileT1_' . $i]['size'];
    if ($fileUploaded && $fileSize > $maxFileSize) {
        http_response_code(400);
        echo "Ukuran file terlalu besar. Maksimum 2MB.";
        exit;
    }

    // Pengecekan tipe file
    $fileExtension = strtolower(pathinfo($_FILES['fileT1_' . $i]['name'], PATHINFO_EXTENSION));
    if ($fileUploaded && !in_array($fileExtension, $allowedExtensions)) {
        http_response_code(400);
        echo "Format file tidak didukung. Hanya file gambar (png, jpeg, jpg) yang diperbolehkan.";
        exit;
    }

    // Pengecekan apakah file adalah gambar
    if ($fileUploaded && !exif_imagetype($_FILES['fileT1_' . $i]['tmp_name'])) {
        http_response_code(400);
        echo "File yang diunggah bukan gambar.";
        exit;
    }

    // Jika file ada, dapat detailnya
    if ($fileUploaded) {
        $fileTmpPath = $_FILES['fileT1_' . $i]['tmp_name'];
        $fileType = $_FILES['fileT1_' . $i]['type'];
        $fileBaseName = basename(trim($_FILES['fileT1_' . $i]['name']));
        $namaTambahan = $filepkT1 . "_";
        $fileName = $namaTambahan . $fileBaseName;
        $uploadDir = '../Traceability/File1/';
        $filePath = $uploadDir . $fileName;
        echo " FILE CUKUP YAH : " . $fileSize;

        if (move_uploaded_file($fileTmpPath, $filePath)) {
            if ($filepkT1 > 0) {
                $queryFile1 = mysqli_query($koneksi, "UPDATE file1 SET filenm = '$filenmT1', pono = '$poT1', file = '$filePath' WHERE filepk = '$filepkT1'");
            } else {
                $queryFile1 = mysqli_query($koneksi, "INSERT INTO file1 (reportpk, treportpk, filenm, pono, file) VALUES ('$reportpk1', '$treportpk', '$filenmT1', '$poT1', '$filePath')");
            }
        } else {
            http_response_code(500);
            echo "Gagal mengunggah file.";
            exit;
        }
    } else {
        if ($filepkT1 > 0) {
            $queryFile1 = mysqli_query($koneksi, "UPDATE file1 SET filenm = '$filenmT1', pono = '$poT1' WHERE filepk = '$filepkT1'");
        } else {
            $queryFile1 = mysqli_query($koneksi, "INSERT INTO file1 (reportpk, treportpk, filenm, pono) VALUES ('$reportpk1', '$treportpk', '$filenmT1', '$poT1')");
        }
    }
  }



  // Report T2 ----------------------------------------------------------------//
  $reportpkT2 = isset($_POST['reportpk2']) ? $_POST['reportpk2'] : '';
  $nameT2 = isset($_POST['nameT2']) ? $_POST['nameT2'] : '';
  $alamatT2 = isset($_POST['alamatT2']) ? $_POST['alamatT2'] : '';
  $stageT2 = isset($_POST['stageT2']) ? $_POST['stageT2'] : '';

  $reportpkT2_a = isset($_POST['reportpk2_a']) ? $_POST['reportpk2_a'] : '';
  $nameT2_a = isset($_POST['nameT2_a']) ? $_POST['nameT2_a'] : '';
  $alamatT2_a = isset($_POST['alamatT2_a']) ? $_POST['alamatT2_a'] : '';
  $stageT2_a = isset($_POST['stageT2_a']) ? $_POST['stageT2_a'] : '';

  $namaSupplier2 = addslashes($nameT2);
  $alamatSupplier2 = addslashes($alamatT2);

  $alamatTrader = addslashes($alamatT2_a);
  $namaTrader = addslashes($nameT2_a);

// Supplier
  if ($reportpkT2 > 0) {
    $queryReportT2 = mysqli_query($koneksi, "UPDATE report2 SET stage = '$stageT2', supnm = '$namaSupplier2', alamat = '$alamatSupplier2' WHERE reportpk = '$reportpkT2'");
    $reportpk2 = $reportpkT2;
    echo "Berhasil Update Report2";
    
  } else {
    $queryReportT2 = mysqli_query($koneksi, "INSERT INTO report2 (treportpk, stage, supnm, alamat, trader) VALUES ('$treportpk','$stageT2','$namaSupplier2','$alamatSupplier2','0')");
    $reportpk2 = mysqli_insert_id($koneksi);
    echo "Berhasil Insert Report2";
  }
// Trader
  if ($reportpkT2_a > 0) {
    $queryReportT2_a = mysqli_query($koneksi, "UPDATE report2 SET stage = '$stageT2_a', supnm = '$nameT2_a', alamat = '$alamatTrader' WHERE reportpk = '$reportpkT2_a'");
    $reportpk2_a = $reportpkT2_a;
    echo "Berhasil Update Report2";
    
  } else {
    $queryReportT2_a = mysqli_query($koneksi, "INSERT INTO report2 (treportpk, stage, supnm, alamat, trader) VALUES ('$treportpk','$stageT2_a','$namaTrader','$alamatTrader','1')");
    $reportpk2_a = mysqli_insert_id($koneksi);
    echo "Berhasil Insert Report2";
  }
  
  // File2 T2 ----------------------------------------------------------------//
  $maxFileSize = 2 * 1024 * 1024;
  $allowedExtensions = array('png', 'jpeg', 'jpg');

  for ($i = 1; $i <= 5; $i++) {
    $filepkT2 = isset($_POST['filepkT2_' . $i]) ? $_POST['filepkT2_' . $i] : '';
    $filenmT2 = isset($_POST['filenmT2_' . $i]) ? $_POST['filenmT2_' . $i] : '';
    $poT2 = isset($_POST['poT2_' . $i]) ? $_POST['poT2_' . $i] : '';

    $sblpoT2 = isset($_POST['poT2_' . $i]) ? $_POST['poT2_' . $i] : '';
    $poT2 = trim($sblpoT2);

    $filepkT2_a = isset($_POST['filepkT2_a_' . $i]) ? $_POST['filepkT2_a_' . $i] : '';
    $filenmT2_a = isset($_POST['filenmT2_a_' . $i]) ? $_POST['filenmT2_a_' . $i] : '';
    $poT2_a = isset($_POST['poT2_a_' . $i]) ? $_POST['poT2_a_' . $i] : '';

    $sblpoT2_a = isset($_POST['poT2_a_' . $i]) ? $_POST['poT2_a_' . $i] : '';
    $poT2_a = trim($sblpoT2_a);

    // Periksa file ada atau ngga
    $fileUploaded = isset($_FILES['fileT2_' . $i]) && $_FILES['fileT2_' . $i]['error'] == UPLOAD_ERR_OK;

    $fileUploaded_a = isset($_FILES['file2T2_a' . $i]) && $_FILES['file2T2_a' . $i]['error'] == UPLOAD_ERR_OK;

    // Pengecekan ukuran file
    $fileSize = $_FILES['fileT2_' . $i]['size'];
    if ($fileUploaded && $fileSize > $maxFileSize) {
        http_response_code(400);
        echo "Ukuran file terlalu besar. Maksimum 2MB.";
        exit;
    }

    $fileSize_a = $_FILES['file2T2_a' . $i]['size'];
    if ($fileUploaded_a && $fileSize_a > $maxFileSize) {
        http_response_code(400);
        echo "Ukuran file terlalu besar. Maksimum 2MB.";
        exit;
    }

    // Pengecekan tipe file
    $fileExtension = strtolower(pathinfo($_FILES['fileT2_' . $i]['name'], PATHINFO_EXTENSION));
    if ($fileUploaded && !in_array($fileExtension, $allowedExtensions)) {
        http_response_code(400);
        echo "Format file tidak didukung. Hanya file gambar (png, jpeg, jpg) yang diperbolehkan.";
        exit;
    }

    $fileExtension_a = strtolower(pathinfo($_FILES['file2T2_a' . $i]['name'], PATHINFO_EXTENSION));
    if ($fileUploaded_a && !in_array($fileExtension_a, $allowedExtensions)) {
        http_response_code(400);
        echo "Format file tidak didukung. Hanya file gambar (png, jpeg, jpg) yang diperbolehkan.";
        exit;
    }

    // Pengecekan apakah file adalah gambar
    if ($fileUploaded && !exif_imagetype($_FILES['fileT2_' . $i]['tmp_name'])) {
        http_response_code(400);
        echo "File yang diunggah bukan gambar.";
        exit;
    }

    if ($fileUploaded_a && !exif_imagetype($_FILES['file2T2_a' . $i]['tmp_name'])) {
        http_response_code(400);
        echo "File yang diunggah bukan gambar.";
        exit;
    }

    // Jika file ada, dapat detailnya
    if ($fileUploaded) {
        $fileTmpPath = $_FILES['fileT2_' . $i]['tmp_name'];
        $fileType = $_FILES['fileT2_' . $i]['type'];
        $fileBaseName = basename(trim($_FILES['fileT2_' . $i]['name']));
        $namaTambahan = $filepkT2 . "_";
        $fileName = $namaTambahan . $fileBaseName;
        $uploadDir = '../Traceability/File2/';
        $filePath = $uploadDir . $fileName;
        echo " FILE CUKUP YAH : " . $fileSize;

        if (move_uploaded_file($fileTmpPath, $filePath)) {
            if ($filepkT2 > 0) {
                $queryFile2 = mysqli_query($koneksi, "UPDATE file2 SET filenm = '$filenmT2', pono = '$poT2', file = '$filePath' WHERE filepk = '$filepkT2'");
            } else {
                $queryFile2 = mysqli_query($koneksi, "INSERT INTO file2 (reportpk, treportpk, filenm, pono, file) VALUES ('$reportpk2', '$treportpk', '$filenmT2', '$poT2', '$filePath')");
            }
        } else {
            http_response_code(500);
            echo "Gagal mengunggah file.";
            exit;
        }
    } else {
        if ($filepkT2 > 0) {
            $queryFile2 = mysqli_query($koneksi, "UPDATE file2 SET filenm = '$filenmT2', pono = '$poT2' WHERE filepk = '$filepkT2'");
        } else {
            $queryFile2 = mysqli_query($koneksi, "INSERT INTO file2 (reportpk, treportpk, filenm, pono) VALUES ('$reportpk2', '$treportpk', '$filenmT2', '$poT2')");
        }
    }

    
    if ($fileUploaded_a) {
        $fileTmpPath = $_FILES['file2T2_a' . $i]['tmp_name'];
        $fileType = $_FILES['file2T2_a' . $i]['type'];
        $fileBaseName = basename(trim($_FILES['file2T2_a' . $i]['name']));
        $namaTambahan = $filepkT2_a . "_";
        $fileName = $namaTambahan . $fileBaseName;
        $uploadDir = '../Traceability/File2/';
        $filePath = $uploadDir . $fileName;
        echo " FILE CUKUP YAH : " . $fileSize;

        if (move_uploaded_file($fileTmpPath, $filePath)) {
            if ($filepkT2_a > 0) {
                $queryFile2 = mysqli_query($koneksi, "UPDATE file2 SET filenm = '$filenmT2_a', pono = '$poT2_a', file = '$filePath' WHERE filepk = '$filepkT2_a'");
            } else {
                $queryFile2 = mysqli_query($koneksi, "INSERT INTO file2 (reportpk, treportpk, filenm, pono, file) VALUES ('$reportpk2_a', '$treportpk', '$filenmT2_a', '$poT2_a', '$filePath')");
            }
        } else {
            http_response_code(500);
            echo "Gagal mengunggah file.";
            exit;
        }
    } else {
        if ($filepkT2_a > 0) {
            $queryFile2 = mysqli_query($koneksi, "UPDATE file2 SET filenm = '$filenmT2_a', pono = '$poT2_a' WHERE filepk = '$filepkT2_a'");
        } else {
            $queryFile2 = mysqli_query($koneksi, "INSERT INTO file2 (reportpk, treportpk, filenm, pono) VALUES ('$reportpk2_a', '$treportpk', '$filenmT2_a', '$poT2_a')");
        }
    }
  }





  // Report T3 ----------------------------------------------------------------//
  $reportpkT3 = isset($_POST['reportpk3']) ? $_POST['reportpk3'] : '';

  $nameT3 = isset($_POST['nameT3']) ? $_POST['nameT3'] : '';
  $alamatT3 = isset($_POST['alamatT3']) ? $_POST['alamatT3'] : '';
  $stageT3 = isset($_POST['stageT3']) ? $_POST['stageT3'] : '';

  $namaSupplier3 = addslashes($nameT3);
  $alamatSupplier3 = addslashes($alamatT3);

  if ($reportpkT3 > 0) {
    $queryReportT3 = mysqli_query($koneksi, "UPDATE report3 SET stage = '$stageT3', supnm = '$namaSupplier3', alamat = '$alamatSupplier3' WHERE reportpk = '$reportpkT3'");
    $reportpk3 = $reportpkT3;
    echo "Berhasil Update Report3";
    
  } else {
    $queryReportT3 = mysqli_query($koneksi, "INSERT INTO report3 (treportpk, stage, supnm, alamat) VALUES ('$treportpk','$stageT3','$namaSupplier3','$alamatSupplier3')");
    $reportpk3 = mysqli_insert_id($koneksi);
    echo "Berhasil Insert Report3";
  }
  
  // File3 T3 ----------------------------------------------------------------//
  $maxFileSize = 2 * 1024 * 1024;
  $allowedExtensions = array('png', 'jpeg', 'jpg');

  for ($i = 1; $i <= 5; $i++) {
    $filepkT3 = isset($_POST['filepkT3_' . $i]) ? $_POST['filepkT3_' . $i] : '';
    $filenmT3 = isset($_POST['filenmT3_' . $i]) ? $_POST['filenmT3_' . $i] : '';
    $poT3 = isset($_POST['poT3_' . $i]) ? $_POST['poT3_' . $i] : '';
    
    $sblpoT3 = isset($_POST['poT3_' . $i]) ? $_POST['poT3_' . $i] : '';
    $poT3 = trim($sblpoT3);

    // Periksa file ada atau ngga
    $fileUploaded = isset($_FILES['fileT3_' . $i]) && $_FILES['fileT3_' . $i]['error'] == UPLOAD_ERR_OK;

    // Pengecekan ukuran file
    $fileSize = $_FILES['fileT3_' . $i]['size'];
    if ($fileUploaded && $fileSize > $maxFileSize) {
        http_response_code(400);
        echo "Ukuran file terlalu besar. Maksimum 2MB.";
        exit;
    }

    // Pengecekan tipe file
    $fileExtension = strtolower(pathinfo($_FILES['fileT3_' . $i]['name'], PATHINFO_EXTENSION));
    if ($fileUploaded && !in_array($fileExtension, $allowedExtensions)) {
        http_response_code(400);
        echo "Format file tidak didukung. Hanya file gambar (png, jpeg, jpg) yang diperbolehkan.";
        exit;
    }

    // Pengecekan apakah file adalah gambar
    if ($fileUploaded && !exif_imagetype($_FILES['fileT3_' . $i]['tmp_name'])) {
        http_response_code(400);
        echo "File yang diunggah bukan gambar.";
        exit;
    }

    // Jika file ada, dapat detailnya
    if ($fileUploaded) {
        $fileTmpPath = $_FILES['fileT3_' . $i]['tmp_name'];
        $fileType = $_FILES['fileT3_' . $i]['type'];
        $fileBaseName = basename(trim($_FILES['fileT3_' . $i]['name']));
        $namaTambahan = $filepkT3 . "_";
        $fileName = $namaTambahan . $fileBaseName;
        $uploadDir = '../Traceability/File3/';
        $filePath = $uploadDir . $fileName;
        echo " FILE CUKUP YAH : " . $fileSize;

        if (move_uploaded_file($fileTmpPath, $filePath)) {
            if ($filepkT3 > 0) {
                $queryFile3 = mysqli_query($koneksi, "UPDATE file3 SET filenm = '$filenmT3', pono = '$poT3', file = '$filePath' WHERE filepk = '$filepkT3'");
            } else {
                $queryFile3 = mysqli_query($koneksi, "INSERT INTO file3 (reportpk, treportpk, filenm, pono, file) VALUES ('$reportpk3', '$treportpk', '$filenmT3', '$poT3', '$filePath')");
            }
        } else {
            http_response_code(500);
            echo "Gagal mengunggah file.";
            exit;
        }
    } else {
        if ($filepkT3 > 0) {
            $queryFile3 = mysqli_query($koneksi, "UPDATE file3 SET filenm = '$filenmT3', pono = '$poT3' WHERE filepk = '$filepkT3'");
        } else {
            $queryFile3 = mysqli_query($koneksi, "INSERT INTO file3 (reportpk, treportpk, filenm, pono) VALUES ('$reportpk3', '$treportpk', '$filenmT3', '$poT3')");
        }
    }
  }


  // Report T4 ----------------------------------------------------------------//
  $reportpkT4 = isset($_POST['reportpk4']) ? $_POST['reportpk4'] : '';

  $nameT4 = isset($_POST['nameT4']) ? $_POST['nameT4'] : '';
  $alamatT4 = isset($_POST['alamatT4']) ? $_POST['alamatT4'] : '';
  $stageT4 = isset($_POST['stageT4']) ? $_POST['stageT4'] : '';

  $namaSupplier4 = addslashes($nameT4);
  $alamatSupplier4 = addslashes($alamatT4);

  if ($reportpkT4 > 0) {
    $queryReportT4 = mysqli_query($koneksi, "UPDATE report4 SET item = '$stageT4', supnm = '$namaSupplier4', alamat = '$alamatSupplier4' WHERE reportpk = '$reportpkT4'");
    $reportpk4 = $reportpkT4;
    echo "Berhasil Update Report4";
    
  } else {
    $queryReportT4 = mysqli_query($koneksi, "INSERT INTO report4 (treportpk, item, supnm, alamat) VALUES ('$treportpk','$stageT4','$namaSupplier4','$alamatSupplier4')");
    $reportpk4 = mysqli_insert_id($koneksi);
    echo "Berhasil Insert Report4";
  }
  
  // File4 T4 ----------------------------------------------------------------//
  $maxFileSize = 2 * 1024 * 1024;
  $allowedExtensions = array('png', 'jpeg', 'jpg');

  for ($i = 1; $i <= 5; $i++) {
    $filepkT4 = isset($_POST['filepkT4_' . $i]) ? $_POST['filepkT4_' . $i] : '';
    $filenmT4 = isset($_POST['filenmT4_' . $i]) ? $_POST['filenmT4_' . $i] : '';
    $poT4 = isset($_POST['poT4_' . $i]) ? $_POST['poT4_' . $i] : '';

    $sblpoT4 = isset($_POST['poT4_' . $i]) ? $_POST['poT4_' . $i] : '';
    $poT4 = trim($sblpoT4);

    // Periksa file ada atau ngga
    $fileUploaded = isset($_FILES['fileT4_' . $i]) && $_FILES['fileT4_' . $i]['error'] == UPLOAD_ERR_OK;

    // Pengecekan ukuran file
    $fileSize = $_FILES['fileT4_' . $i]['size'];
    if ($fileUploaded && $fileSize > $maxFileSize) {
        http_response_code(400);
        echo "Ukuran file terlalu besar. Maksimum 2MB.";
        exit;
    }

    // Pengecekan tipe file
    $fileExtension = strtolower(pathinfo($_FILES['fileT4_' . $i]['name'], PATHINFO_EXTENSION));
    if ($fileUploaded && !in_array($fileExtension, $allowedExtensions)) {
        http_response_code(400);
        echo "Format file tidak didukung. Hanya file gambar (png, jpeg, jpg) yang diperbolehkan.";
        exit;
    }

    // Pengecekan apakah file adalah gambar
    if ($fileUploaded && !exif_imagetype($_FILES['fileT4_' . $i]['tmp_name'])) {
        http_response_code(400);
        echo "File yang diunggah bukan gambar.";
        exit;
    }

    // Jika file ada, dapat detailnya
    if ($fileUploaded) {
        $fileTmpPath = $_FILES['fileT4_' . $i]['tmp_name'];
        $fileType = $_FILES['fileT4_' . $i]['type'];
        $fileBaseName = basename(trim($_FILES['fileT4_' . $i]['name']));
        $namaTambahan = $filepkT4 . "_";
        $fileName = $namaTambahan . $fileBaseName;
        $uploadDir = '../Traceability/File4/';
        $filePath = $uploadDir . $fileName;
        echo " FILE CUKUP YAH : " . $fileSize;

        if (move_uploaded_file($fileTmpPath, $filePath)) {
            if ($filepkT4 > 0) {
                $queryFile4 = mysqli_query($koneksi, "UPDATE file4 SET filenm = '$filenmT4', pono = '$poT4', file = '$filePath' WHERE filepk = '$filepkT4'");
            } else {
                $queryFile4 = mysqli_query($koneksi, "INSERT INTO file4 (reportpk, treportpk, filenm, pono, file) VALUES ('$reportpk4', '$treportpk', '$filenmT4', '$poT4', '$filePath')");
            }
        } else {
            http_response_code(500);
            echo "Gagal mengunggah file.";
            exit;
        }
    } else {
        if ($filepkT4 > 0) {
            $queryFile4 = mysqli_query($koneksi, "UPDATE file4 SET filenm = '$filenmT4', pono = '$poT4' WHERE filepk = '$filepkT4'");
        } else {
            $queryFile4 = mysqli_query($koneksi, "INSERT INTO file4 (reportpk, treportpk, filenm, pono) VALUES ('$reportpk4', '$treportpk', '$filenmT4', '$poT4')");
        }
    }
  }
}
?>
