<?php
require_once '../config/init.php';
header('Content-Type: application/json');
// $json_data = file_get_contents("php://input");
// $data = json_decode($json_data, true);

$status = 0;
$message = 0;
// $success = 0;

$action = isset($_POST['action']) ? $_POST['action'] : '';
$response = array();

if ($action == "insertRecord") {
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $designation = $_POST['designation'];

    // Check if a file was uploaded
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $file = $_FILES['profile_picture'];

        $_id = $SubDB->generateUniqueID();

        // Define the target directory and file name
        $targetDir = "../uploads/"; // Make sure this directory exists
        $upload_path = "uploads/". $_id . basename($file['name']);
        $targetFile = $targetDir. $_id . basename($file['name']);

        // Validate file type
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $validExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($imageFileType, $validExtensions)) {
            // Move the file to the target directory
            if (move_uploaded_file($file['tmp_name'], $targetFile)) {

                // ! Save the data to the database
                $userData = array(
                    "_id" => $_id,
                    "name" => $name,
                    "mobile" => $contact,
                    "email" => $email,
                    "profilePicture" => $upload_path,
                    "designation" => $designation,
                );
                $where = array();

                $SubDB->performCRUD("tblrecord", "i", $userData, $where);
                
                $message = "Data inserted successfully.";
                $status = 1;
            } else {
                $message = "Failed to move uploaded file";
            }
        } else {
            $message = "Invalid file type";
        }
    } else {
        $message = "No file uploaded or upload error";
    }
}
else if ($action == "updateRecord") {
    $recordId = isset($_POST['recordId']) ? $_POST['recordId'] : '';
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $contact = isset($_POST['contact']) ? $_POST['contact'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $designation = isset($_POST['designation']) ? $_POST['designation'] : '';
     
    $filePath = '';
 
    // Check if a new file was uploaded
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $file = $_FILES['profile_picture'];

        // Define the target directory and file name
        $targetDir = "../uploads/"; // Make sure this directory exists
        $upload_path = "uploads/". $recordId . basename($file['name']);
        $targetFile = $targetDir. $recordId . basename($file['name']);

        // Validate file type
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $validExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($imageFileType, $validExtensions)) {
            // Move the file to the target directory
            if (move_uploaded_file($file['tmp_name'], $targetFile)) {
                //  $filePath = $targetFile; // Update the file path

                $userData = array(
                    "name" => $name,
                    "mobile" => $contact,
                    "email" => $email,
                    "profilePicture" => $upload_path,
                    "designation" => $designation,
                );
                $where = array(
                    "_id" => $recordId
                );
        
                $SubDB->performCRUD("tblrecord", "u", $userData, $where);
            
                $message = "Data updated successfully.";
                $status = 1;
            } else {
                $message = "Failed to move uploaded file";
            }
        } else {
            $message = "Invalid file type";
        }
    } else {
        // No new file uploaded,
    }
}

$response['message'] = $message;
$response['status'] = $status;

echo json_encode($response);
?>