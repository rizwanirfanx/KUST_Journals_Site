<?php
    session_start();
    include_once("./../connection/connection.php");
    if(isset($_GET['action']) && $_GET['action']=='fetchBoxData'){
        $sql = "SELECT `id`, `image`, `title`, `author`, `topic`, `description`, `date` FROM `journals`";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->bind_result($id, $image, $title, $author, $topic, $description, $date);
        $results = array();
        while ($stmt->fetch()) {
            $result = array(
                'id' => $id,
                'image' => $image,
                'title' => $title,
                'author' => $author,
                'topic' => $topic,
                'description' => $description,
                'date' => $date
            );
            $results[] = $result;
        }
        $stmt->close();
        $conn->close();
        $jsonResponse = json_encode($results);
        echo $jsonResponse;
    }
    if (isset($_GET['action']) && $_GET['action'] == 'getCount') {
        if (isset($_SESSION['id'])) {
          $userId = $_SESSION['id'];
          
          $sql = "SELECT COUNT(*) AS remarkCount FROM `remark_table` WHERE `user_id` = ?";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param('i', $userId);
          
          if ($stmt->execute()) {
            $stmt->bind_result($remarkCount);
            $stmt->fetch();
            
            $response = array($remarkCount);
          } else {
            $response = array('success' => false, 'message' => 'Failed to get the remark count.');
          }
          
          $stmt->close();
          
          header('Content-Type: application/json');
          echo json_encode($response);
          exit();
        }
      }

      if (isset($_GET['action']) && $_GET['action'] == "GetRemarkDetailsForUser") {
        if (isset($_SESSION['id'])) {
          $userId = $_SESSION['id'];
          
          $sql = "SELECT rt.RemarkId, dt.topic, dt.title, rt.message, rt.date 
                  FROM remark_table AS rt
                  JOIN doc_table AS dt ON rt.post_id = dt.id
                  WHERE rt.user_id = ?";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param('i', $userId);
          
          if ($stmt->execute()) {
            $result = $stmt->get_result();
            $remarks = array();
            
            while ($row = $result->fetch_assoc()) {
              $remarks[] = $row;
            }
            
            $response = $remarks;
          } else {
            $response = array('success' => false, 'message' => 'Failed to retrieve remarks for the user.');
          }
          
          $stmt->close();
          
          header('Content-Type: application/json');
          echo json_encode($response);
          exit();
        }
      }
?>
