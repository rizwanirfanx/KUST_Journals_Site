<?php
include_once("./../connection/connection.php");

$email = $_POST['email'];
$checkQuery = "SELECT `id` FROM `registration` WHERE `email` = ?";
$stmt = $conn->prepare($checkQuery);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
  $response = array(
    "success" => false,
    "message" => "Email already taken"
  );
} else {
  $username = $_POST['userName'];
  $password = $_POST['password'];
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  $insertQuery = "INSERT INTO `registration` (`email`, `username`, `password`) VALUES (?, ?, ?)";
  $stmt = $conn->prepare($insertQuery);
  $stmt->bind_param("sss", $email, $username, $hashedPassword);
  
  if ($stmt->execute()) {
    $response = array(
      "success" => true,
      "message" => "Record stored successfully"
    );
  } else {
    $response = array(
      "success" => false,
      "message" => "Failed to store record"
    );
  }
}

echo json_encode($response);
$stmt->close();
$conn->close();
?>
