<?php
include_once("./../connection/connection.php");

$email = $_POST['email'];
$checkQuery = "SELECT `id`, `userName` FROM `registration` WHERE `email` = ?";
$stmt = $conn->prepare($checkQuery);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
  $stmt->bind_result($id, $userName);
  $stmt->fetch();

  // Store values in session
  session_start();
  $_SESSION['id'] = $id;
  $_SESSION['userName'] = $userName;

  $response = array(
    "success" => true,
    "message" => "Login successful"
  );
} else {
  $response = array(
    "success" => false,
    "message" => "Email not found"
  );
}

echo json_encode($response);
$stmt->close();
$conn->close();
?>
