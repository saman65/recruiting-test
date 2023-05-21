<?php ob_start(); ?>

<!DOCTYPE html>
<html>
<head>
  <title>Hello World!</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6 text-center my-3 border rounded p-3 bg-light">
        <h1>Hello World!</h1>
        <p id="server-time"></p>
        <p id="client-ip"></p>
    </div>
  </div>
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

    $per_page = 10;
    if(isset($_GET['page'])){
      $page = $_GET['page'];
    }else{
        $page = "";
    }
    
    if($page == "" || $page == 1){
        $page_1 = 0;
    }else{
        $page_1 = ($page * $per_page) - $per_page;
    }

    $comment_query_count = "SELECT * FROM comments ORDER by id DESC";
    $find_count = $conn->query($comment_query_count);
    $count = $find_count->num_rows;
    $count = ceil($count / $per_page);

    $query = "SELECT * FROM comments ORDER by id DESC LIMIT ?, ? ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $page_1, $per_page);
    $stmt->execute();
    $select_all_comments_query = $stmt->get_result();

    // Iterate over the comments and generate HTML markup
    while ($row = $select_all_comments_query->fetch_assoc()) {
      $username = $row['username'];
      $beername = $row['beername'];
      $comment = $row['comment'];
      $punkAPIInfo = getPunkAPIInfo($beername); // Implement this function to retrieve Punk API info
      $anonymizedUsername = anonymizeUsername($username); // Implement this function to anonymize usernames


      echo '<div class="comment" data-username="' . $username . '" data-beer="' . $beername . '">';
      if(isset($punkAPIInfo['imageUrl'])){
        echo '<img src="' . $punkAPIInfo['imageUrl'] . '" alt="' . $beername . '">';
      }
      echo '<p style="align-self: flex-start">' . $beername . '</p>';
      echo '<p><b>' . $comment . '</b></p>';
      echo '<p><em>' . $anonymizedUsername . '</em></p>';
      echo '</div>';
    }

    $conn = null;
    ?>
<div class="container">
<ul class='pager'>
  <?php
    if(!$page){$page = 1;}
    for($i = $page; $i <= ((int)$page+9) && $i <= $count; $i++){
        if($i == $page && $i > 1 && $i < $page+9 && $i <= $count && $i !== null){
            if($i>10){
                echo "<li><a href='index.php?page=".($i-10)."'>"."<<"."</a></li>";
            }
        echo "<li><a href='index.php?page=".($i-1)."'>"."<"."</a></li>";
        echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";
        }elseif($i == $page && ($i == 1 || $page == null)){
            $i = 1;
        echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";
        }elseif($i !== $page && $i > (int)$page+8 && $i <= $count && $i !== null){
        echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
        echo "<li><a href='index.php?page=".($i+1)."'>".">"."</a></li>";
            if($i<$count-10){
                echo "<li><a href='index.php?page=".($i+10)."'>".">>"."</a></li>";
            }
        }else{
        echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
        }
    }
  ?>
</ul>
</div>

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