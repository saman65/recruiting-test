<?php
ob_start();
require_once "db.php";

if(isset($_POST['submit'])){
// Retrieving form field values
$username = $_POST['username'];
$beername = $_POST['beername'];
$comment = $_POST['comment'];
$trimmedComment = trim($comment);
  if (empty($trimmedComment)) {
    echo "Comment is empty or contains only spaces.";
  }else{
    // Inserting the data into the comments table in the database
    $query = "INSERT INTO comments (username, beername, comment) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sss', $username, $beername, $comment);
    $stmt->execute();

    echo "Comment submitted successfully!";

  $conn = null;
  header("location: index.php?message=success");
  }
}
?>
