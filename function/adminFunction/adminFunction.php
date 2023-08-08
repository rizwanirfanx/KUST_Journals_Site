<?php
include_once "./../connection/connection.php";

session_start();
if (isset($_GET['action']) && $_GET['action'] == 'loginHandler') {
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT `id`, `userName` FROM `admin` WHERE `userName` = ? AND `password` = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    if (mysqli_stmt_num_rows($stmt) == 1) {
      mysqli_stmt_bind_result($stmt, $id, $userName);
      mysqli_stmt_fetch($stmt);
      // $_SESSION["id"] = $id;
      $_SESSION["userName"] = $userName;
      mysqli_stmt_close($stmt);
      $response = array(
        'status' => true,
        'message' => 'login Succeffully.',
      );

    } else {
      // Close the statement
      mysqli_stmt_close($stmt);

      // Return an error response
      $response = array(
        'status' => false,
        'message' => 'Invalid username or password.',
      );

    }
  }
  echo json_encode($response);
  mysqli_close($conn);
}

if (isset($_GET['action']) && $_GET['action'] == 'uploadJournal') {
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $topic = $_POST['Topic'];
    $description = $_POST['Description'];
    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_type = $_FILES['image']['type'];
    $image_size = $_FILES['image']['size'];
    $allowed_extensions = array('png', 'jpg', 'jpeg', 'gif');
    $file_extension = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
    if (in_array($file_extension, $allowed_extensions)) {
      $target_dir = "./../../admin/assets/upload/";
      $image_unique_name = uniqid('image_') . '.' . $file_extension;
      $target_path = $target_dir . $image_unique_name;
      if (move_uploaded_file($image_tmp, $target_path)) {
        $sql = "INSERT INTO `journals` (title, author, topic, description, image) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssss", $title, $author, $topic, $description, $image_unique_name);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        $response = array(
          'status' => true,
          'message' => 'Data inserted successfully.'
        );
      } else {
        $response = array(
          'status' => false,
          'message' => 'Failed to upload the image.'
        );
      }
    } else {
      $response = array(
        'status' => false,
        'message' => 'Invalid file extension. Only PNG, JPG, JPEG, and GIF files are allowed.'
      );
    }
    echo json_encode($response);
  }
  mysqli_close($conn);
}
if (isset($_GET['action']) && $_GET['action'] == "fetchJournelRequest") {
  $status = "pending";
  $sql = "SELECT `id`, `user_id`, `user_email`, `docName`, `title`, `description`, `image`, `topic`, `status` FROM `doc_table` WHERE `status`=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s', $status);
  if ($stmt->execute()) {
    $stmt->store_result();
    $stmt->bind_result($id, $userId, $userEmail, $docName, $title, $description, $image, $topic, $status);
    $requests = array();
    while ($stmt->fetch()) {
      $sql = "SELECT `username` FROM `registration` WHERE `id`=?";
      $stmt2 = $conn->prepare($sql);
      $stmt2->bind_param('i', $userId);
      if ($stmt2->execute()) {
        $stmt2->bind_result($userName);
        $stmt2->fetch();
        $stmt2->close();

        $request = array(
          'id' => $id,
          'userId' => $userId,
          'userEmail' => $userEmail,
          'docName' => $docName,
          'title' => $title,
          'description' => $description,
          'image' => $image,
          'topic' => $topic,
          'status' => $status,
          'userName' => $userName
        );
        $requests[] = $request;
      }
    }
    $stmt->close();

    header('Content-Type: application/json');
    echo json_encode($requests);
  } else {
    $response = array('success' => false, 'message' => 'Failed to fetch journal requests.');
    header('Content-Type: application/json');
    echo json_encode($response);
  }
}
if (isset($_GET['action']) && $_GET['action'] == "fetchJournelApprove") {
  $status = "approved";
  $sql = "SELECT `id`, `user_id`, `user_email`, `docName`, `title`, `description`, `image`, `topic`, `status` FROM `doc_table` WHERE `status`=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s', $status);
  if ($stmt->execute()) {
    $stmt->store_result();
    $stmt->bind_result($id, $userId, $userEmail, $docName, $title, $description, $image, $topic, $status);
    $requests = array();
    while ($stmt->fetch()) {
      $sql = "SELECT `username` FROM `registration` WHERE `id`=?";
      $stmt2 = $conn->prepare($sql);
      $stmt2->bind_param('i', $userId);
      if ($stmt2->execute()) {
        $stmt2->bind_result($userName);
        $stmt2->fetch();
        $stmt2->close();

        $request = array(
          'id' => $id,
          'userEmail' => $userEmail,
          'docName' => $docName,
          'title' => $title,
          'description' => $description, 'image' => $image,
          'topic' => $topic,
          'status' => $status,
          'userName' => $userName
        );
        $requests[] = $request;
      }
    }
    $stmt->close();

    header('Content-Type: application/json');
    echo json_encode($requests);
  } else {
    $response = array('success' => false, 'message' => 'Failed to fetch journal requests.');
    header('Content-Type: application/json');
    echo json_encode($response);
  }
}
if (isset($_GET['action']) && $_GET['action'] == "deleteJournal") {
  if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM `doc_table` WHERE `id` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
      $response = array('success' => true, 'message' => 'Journal deleted successfully.');
      header('Content-Type: application/json');
      echo json_encode($response);
    } else {
      $response = array('success' => false, 'message' => 'Failed to delete the journal.');
      header('Content-Type: application/json');
      echo json_encode($response);
    }
  }
}

if (isset($_GET['action']) && $_GET['action'] == "ApproveJournel") {
  if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "SELECT `user_id`, `image`, `title`, `topic`, `description`, `status` FROM `doc_table` WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    if ($stmt->execute()) {
      $stmt->store_result();
      $stmt->bind_result($userId, $image, $title, $topic, $description, $status);
      $stmt->fetch();
      $sqlForUserName = "SELECT `userName` FROM `registration` WHERE `id` = ?";
      $stmt2 = $conn->prepare($sqlForUserName);
      $stmt2->bind_param('i', $userId);
      if ($stmt2->execute()) {
        $stmt2->store_result();
        $stmt2->bind_result($userName);
        $stmt2->fetch();
        $insertSql = "INSERT INTO `journals`(`image`, `title`, `author`, `topic`, `description`, `date`) VALUES (?, ?, ?, ?, ?, NOW())";
        $stmt3 = $conn->prepare($insertSql);
        $stmt3->bind_param('sssss', $image, $title, $userName, $topic, $description);
        if ($stmt3->execute()) {
          $stmt3->close();
          $updateSql = "UPDATE `doc_table` SET `status` = 'approved' WHERE id=?";
          $stmt4 = $conn->prepare($updateSql);
          $stmt4->bind_param('i', $id);
          $stmt4->execute();
          $stmt4->close();
          $response = array('success' => true, 'message' => 'Journal approved successfully.');
          header('Content-Type: application/json');
          echo json_encode($response);
        } else {
          $response = array('success' => false, 'message' => 'Failed to insert into journals table.');
          header('Content-Type: application/json');
          echo json_encode($response);
        }
      } else {
        $response = array('success' => false, 'message' => 'Failed to fetch userName.');
        header('Content-Type: application/json');
        echo json_encode($response);
      }
    } else {
      $response = array('success' => false, 'message' => 'Failed to fetch doc_table data.');
      header('Content-Type: application/json');
      echo json_encode($response);
    }
  }
}

if (isset($_GET['action']) && $_GET['action'] == "saveRemark") {
  if (isset($_POST['postId']) && isset($_POST['userId']) && isset($_POST['remark'])) {
    $postId = $_POST['postId'];
    $userId = $_POST['userId'];
    $remark = $_POST['remark'];
    $date = date('Y-m-d');
    $sql = "INSERT INTO `remark_table` (`user_id`, `post_id`, `message`, `date`) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iiss', $userId, $postId, $remark, $date);

    if ($stmt->execute()) {
      $response = array('success' => true, 'message' => 'remark sent Successfully');
    } else {
      $response = array('success' => false, 'message' => 'Failed to save the remark.');
    }

    $stmt->close();
    $conn->close();

    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
  }
}

if (isset($_GET['action']) && $_GET['action'] == "manuscript") {

  $sql = "SELECT * FROM `manuscript`";
  $stmt = $conn->prepare($sql);

  if ($stmt->execute()) {
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    $response = array('success' => true, 'message' => 'Manuscript Approval Successfully', 'data' => $data);
  } else {
    $response = array('success' => false, 'message' => 'Failed to get manuscript request');
  }

  $stmt->close();
  $conn->close();

  header('Content-Type: application/json');
  echo json_encode($response);
  exit();
}

if (isset($_GET['action']) && $_GET['action'] == "approveManuscript") {
  if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "UPDATE `manuscript` SET `status` = 1 WHERE `id` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    if ($stmt->execute()) {
      $response = array('success' => true, 'message' => 'Journal approved successfully.');
      header('Content-Type: application/json');
      echo json_encode($response);
    } else {
      $response = array('success' => false, 'message' => 'Failed to insert into journals table.');
      header('Content-Type: application/json');
      echo json_encode($response);
    }
  }
}

if (isset($_GET['action']) && $_GET['action'] == "deleteManuscript") {
  if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM `manuscript` WHERE `id` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
      $response = array('success' => true, 'message' => 'Journal deleted successfully.');
      header('Content-Type: application/json');
      echo json_encode($response);
    } else {
      $response = array('success' => false, 'message' => 'Failed to delete the journal.');
      header('Content-Type: application/json');
      echo json_encode($response);
    }
  }
}
