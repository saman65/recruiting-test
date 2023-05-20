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

  <div class="well col-md-4 offset-md-4">
    <form action="submit.php" method="POST">
      <label for="username" class="form-label">Username:</label>
      <div class="mb-2 mt-1">
        <input type="text" id="username" class="form-control" name="username" placeholder="Enter Username" required pattern="[a-zA-Z0-9]+">
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

</body>
</html>
