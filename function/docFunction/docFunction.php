<?php
include_once("./../connection/connection.php");
session_start();
$userId = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['Description'];
    $topic = $_POST['Topic'];
    $targetDir = "./../../admin/assets/upload/";
    $filename = basename($_FILES["image"]["name"]);
    $themeImage = basename($_FILES['themeImage']['name']);
    $targetFilePath = $targetDir . $filename;
    $themeFilePath = $targetDir . $themeImage;
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
    $themeFileType = strtolower(pathinfo($themeFilePath, PATHINFO_EXTENSION));

    // Validate the file types
    $allowedFileTypes = array('pdf', 'doc', 'docx');
    $allowedThemeFileTypes = array('png', 'gif', 'jpeg', 'jpg');
    if (!in_array($fileType, $allowedFileTypes) || !in_array($themeFileType, $allowedThemeFileTypes)) {
        $response = array('success' => false, 'message' => 'Invalid file type. Only PDF and DOC files for the document and PNG, GIF, JPEG, or JPG files for the  image are allowed.');
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    // Move the uploaded files to the target directory
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath) && move_uploaded_file($_FILES["themeImage"]["tmp_name"], $themeFilePath)) {
        try {
            $sql = "SELECT `email`, `username` FROM `registration` WHERE `id` = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $userId);
            if ($stmt->execute()) {
                $stmt->store_result();
                $stmt->bind_result($email, $username);
                $stmt->fetch();
                $stmt->close();

                $sql_insertDoc = "INSERT INTO `doc_table`(`user_id`, `user_email`, `docName`, `title`, `description`, `image`, `topic`, `status`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt_insertDoc = $conn->prepare($sql_insertDoc);
                $status = "pending";
                $stmt_insertDoc->bind_param("isssssss", $userId, $email, $filename, $title, $description, $themeImage, $topic, $status);
                if ($stmt_insertDoc->execute()) {
                    $response = array('success' => true, 'message' => 'Thank you! You will be informed by the admin shortly.');
                } else {
                    $response = array('success' => false, 'message' => 'Failed to insert document into the database.');
                }

                $stmt_insertDoc->close();
            } else {
                $response = array('success' => false, 'message' => 'Failed to retrieve user information from the database.');
            }
        } catch (\Exception $e) {
            $response = array('success' => false, 'error' => $e->getMessage());
        }
    } else {
        $response = array('success' => false, 'message' => 'Failed to move the uploaded files.');
    }

    $conn->close();
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    http_response_code(405);
    exit();
}
?>
