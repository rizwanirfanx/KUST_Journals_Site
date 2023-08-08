<?php
include_once("./../connection/connection.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $file = $_FILES['file']; // Get the uploaded file
    $title = $_POST['title']; // Get the 'title' value
    $abstract = $_POST['abstract']; // Get the 'abstract' value
    $keywords = $_POST['keywords']; // Get the 'keywords' value
    $authors = $_POST['authors']; // Get the 'authors' value and decode it from JSON

    // Access the properties of the uploaded file
    $fileName = $file['name'];
    $fileType = $file['type'];
    $fileSize = $file['size'];
    $fileTmpPath = $file['tmp_name'];
    $fileError = $file['error'];

    // Handle the uploaded file as needed
// For example, you can move it to a specific directory
    $destination = './../../resource/manuscript/' . $fileName;
    move_uploaded_file($fileTmpPath, $destination);
    $destination = './../../../resource/manuscript/' . $fileName;

    $sql = "INSERT INTO `manuscript`( `title`, `abstract`, `keywords`, `authors`, `filepath`, `status`) VALUES (?, ?, ?, ?, ?, 0)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $title, $abstract, $keywords, $authors, $destination);
    if ($stmt->execute()) {
        $stmt->close();
        $response = array('success' => true, 'message' => 'Manuscript successfully appended.');
    } else {
        $response = array('success' => false, 'message' => 'Manuscript failed to append');
    }

    $conn->close();
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    http_response_code(405);
    exit();
}
?>