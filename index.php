<?php ob_start(); ?>

<!DOCTYPE html>
<html>
<head>
  <title>Hello World!</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="flex-center">
    <h1>Hello World!</h1>
  </div>
  <div class="flex-center">
    <p id="server-time"></p>
  </div>
  <div class="flex-center">
    <p id="client-ip"></p>
  </div>
  <!-- ... -->
  <div class="comments">
    <?php
    require_once "db.php";
    require_once "functions.php";
    if(isset($_GET['message']) && $_GET['message']=='success'){

      $message="<div class='col-md-12'><h4 class='bg-success text-center'>Your comment was sent</h4></div>";
      echo $message;
    }
    
    try {

      $sql = "SELECT username, beername, comment FROM comments";
      $stmt = $conn->query($sql);

      // Iterate over the comments and generate HTML markup
      while ($row = $stmt->fetch_assoc()) {
        $username = $row['username'];
        $beername = $row['beername'];
        $comment = $row['comment'];
        $punkAPIInfo = getPunkAPIInfo($beername); // Implement this function to retrieve Punk API info

        echo '<div class="comment" data-username="' . $username . '" data-beer="' . $beername . '">';
        if(isset($punkAPIInfo['imageUrl'])){
          echo '<img src="' . $punkAPIInfo['imageUrl'] . '" alt="' . $beername . '">';
        }
        echo '<p style="align-self: flex-start">' . $beername . '</p>';
        echo '<p><b>' . $comment . '</b></p>';
        echo '<p><em>' . $username . '</em></p>';
        echo '</div>';
      }
    } catch(Exception $e) {
      echo "Error: " . $e->getMessage();
    }

    $conn = null;
    ?>

  </div>
  <!-- ... -->
  <div class="flex-center">
    <div class="well col-md-4">
      <form action="submit.php" method="POST" onsubmit="return validateForm()">
        <label for="username" class="form-label">Username:</label>
        <div class="mb-2 mt-1">
          <input type="text" id="username" class="form-control" name="username" placeholder="Enter Username" required">
        </div>

        <label for="beername" class="form-label">Beer Name:</label>
        <div class="mb-2 mt-1">
          <input type="text" id="beername" class="form-control" name="beername" placeholder="Enter Beername" required>
        </div>

        <label for="comment" class="form-label">Comment:</label>
        <div class="mb-2 mt-1">
          <textarea id="comment" class="form-control" name="comment" rows="5" placeholder="Enter Comment" required></textarea>
        </div>

        <button class="btn btn-primary" type="submit" name="submit">Submit</button>
      </form>
    </div>
  </div>
  <!-- ... -->

  <script src="js/script.js"></script>
</body>
</html>
<?php ob_end_flush() ?>