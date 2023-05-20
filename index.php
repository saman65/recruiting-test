<?php ob_start(); ?>

<!DOCTYPE html>
<html>
<head>
  <title>Hello World!</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="col-md-4 offset-md-4">
    <h1>Hello World!</h1>
    <p id="server-time"></p>
    <p id="client-ip"></p>
  </div>
  <?php
    if(isset($_GET['message']) && $_GET['message']=='success'){
      $message="<h4 class='bg-success text-center'>Your comment was sent</h4>";
      echo $message;
    }
  ?>
  <div class="well col-md-4 offset-md-4">
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
  <!-- ... -->

  <script src="js/script.js"></script>
</body>
</html>
