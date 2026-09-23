<?php
session_start();
include "../config/koneksi.php";
$srpk = $_POST['srpk'];

// Fetch the last status from the database
$lastStatusQuery = mysqli_query($koneksi, "SELECT * FROM ord ORDER BY ordpk DESC LIMIT 1");
$lastStatus = mysqli_fetch_assoc($lastStatusQuery);

// Check if status exists for the given srpk
$statusQuery = mysqli_query($koneksi, "SELECT * FROM ord WHERE ordpk = '$srpk'");
$status = mysqli_fetch_assoc($statusQuery);

// $lastStatusPK = intval($lastStatus['ordpk']) + 1;

if($status){
    $lastStatusPK = intval($status['ordpk']);
} else {
    $lastStatusPK = intval($lastStatus['ordpk']) + 1;
}

// Define upload directory
$uploadDir = '../foto/';

if (!empty($status)) {
    // If status exists, check for image uploads and update the status

    // Handling first image
    if (isset($_FILES['imageFile1']) && $_FILES['imageFile1']['error'] == UPLOAD_ERR_OK) {
        $imageFile1 = $_FILES['imageFile1'];
        $imageExtension1 = pathinfo($imageFile1['name'], PATHINFO_EXTENSION);
        $imageOriginalName1 = pathinfo($imageFile1['name'], PATHINFO_FILENAME);
        $imageFilename1 = $lastStatusPK . "_" . $imageOriginalName1 . "." . $imageExtension1;

        // Move the uploaded file to the destination folder
        move_uploaded_file($imageFile1['tmp_name'], $uploadDir . $imageFilename1);

        // Update the database with the new filename
        mysqli_query($koneksi, "UPDATE ord SET foto = '$imageFilename1', stsfoto='1' WHERE ordpk = " . $status['ordpk']);
    }

    // Handling second image
    if (isset($_FILES['imageFile2']) && $_FILES['imageFile2']['error'] == UPLOAD_ERR_OK) {
        $imageFile2 = $_FILES['imageFile2'];
        $imageExtension2 = pathinfo($imageFile2['name'], PATHINFO_EXTENSION);
        $imageOriginalName2 = pathinfo($imageFile2['name'], PATHINFO_FILENAME);
        $imageFilename2 = $lastStatusPK . "_" . $imageOriginalName2 . "." . $imageExtension2;

        // Move the uploaded file to the destination folder
        move_uploaded_file($imageFile2['tmp_name'], $uploadDir . $imageFilename2);

        // Update the database with the new filename
        mysqli_query($koneksi, "UPDATE ord SET foto2 = '$imageFilename2', stsfoto='1' WHERE ordpk = " . $status['ordpk']);
    }
        // Return the current statuspk
        $currentStatusPK = $status['ordpk'];
} else {
    // If status does not exist, handle new image uploads and insert a new record

    // Handling first image
    if (isset($_FILES['imageFile1']) && $_FILES['imageFile1']['error'] == UPLOAD_ERR_OK) {
        $imageFile1 = $_FILES['imageFile1'];
        $imageExtension1 = pathinfo($imageFile1['name'], PATHINFO_EXTENSION);
        $imageOriginalName1 = pathinfo($imageFile1['name'], PATHINFO_FILENAME);
        $imageFilename1 = $lastStatusPK . "_" . $imageOriginalName1 . "." . $imageExtension1;

        // Move the uploaded file to the destination folder
        move_uploaded_file($imageFile1['tmp_name'], $uploadDir . $imageFilename1);
    }

    // Handling second image
    if (isset($_FILES['imageFile2']) && $_FILES['imageFile2']['error'] == UPLOAD_ERR_OK) {
        $imageFile2 = $_FILES['imageFile2'];
        $imageExtension2 = pathinfo($imageFile2['name'], PATHINFO_EXTENSION);
        $imageOriginalName2 = pathinfo($imageFile2['name'], PATHINFO_FILENAME);
        $imageFilename2 = $lastStatusPK . "_" . $imageOriginalName2 . "." . $imageExtension2;

        // Move the uploaded file to the destination folder
        move_uploaded_file($imageFile2['tmp_name'], $uploadDir . $imageFilename2);
    }
    $OP="OP".$lastStatusPK;
    // Insert the new status with the uploaded images
    mysqli_query($koneksi, "INSERT INTO ord (ordpk, ordno, foto, foto2, stsfoto) VALUES ('$lastStatusPK', '$OP', '$imageFilename1', '$imageFilename2', '1')");

    // Return the new statuspk
    $currentStatusPK = $lastStatusPK;
}

// Return a success response with the statuspk
$response = [
    'success' => true,
    'message' => "<div class='text-infohijau' style='width:285px;'>image successfully uploaded &nbsp; &#10004; </div>",
    'statuspk' => $currentStatusPK // Add statuspk to the response
];
echo json_encode($response);
?>