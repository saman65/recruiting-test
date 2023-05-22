<?php
class CommentPage {
    private $per_page;
    private $page;
    private $page_1;
    private $count;
    private $conn;

    public function __construct($conn, $per_page = 10) {
        $this->conn = $conn;
        $this->per_page = $per_page;

        if(isset($_GET['page'])){
            $this->page = $_GET['page'];
        }else{
            $this->page = "";
        }
    }

    public function getPageNumber() {
        return $this->page;
    }

    public function calculateStartingId() {
        if($this->page == "" || $this->page == 1){
            $this->page_1 = 0;
        }else{
            $this->page_1 = ($this->page * $this->per_page) - $this->per_page;
        }
    }

    public function calculatePageCount() {
        $comment_query_count = "SELECT * FROM comments ORDER BY id DESC";
        $find_count = $this->conn->query($comment_query_count);
        $this->count = $find_count->num_rows;
        $this->count = ceil($this->count / $this->per_page);
    }

    public function getComments() {
        $query = "SELECT * FROM comments ORDER BY id DESC LIMIT ?, ? ";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('ii', $this->page_1, $this->per_page);
        $stmt->execute();
        $select_all_comments_query = $stmt->get_result();

        $comments = array();
        while ($row = $select_all_comments_query->fetch_assoc()) {
            $username = $row['username'];
            $beername = $row['beername'];
            $comment = $row['comment'];
            $punkAPIInfo = getPunkAPIInfo($beername); // Implement this function to retrieve Punk API info
            $anonymizedUsername = anonymizeUsername($username); // Implement this function to anonymize usernames

            $commentData = array(
                'username' => $username,
                'beername' => $beername,
                'comment' => $comment,
                'punkAPIInfo' => $punkAPIInfo,
                'anonymizedUsername' => $anonymizedUsername
            );

            $comments[] = $commentData;
        }

        return $comments;
    }

    public function generateCommentMarkup($comments) {
        foreach ($comments as $comment) {
            $username = $comment['username'];
            $beername = $comment['beername'];
            $commentText = $comment['comment'];
            $punkAPIInfo = $comment['punkAPIInfo'];
            $anonymizedUsername = $comment['anonymizedUsername'];

            echo '<div class="comment" data-username="' . $username . '" data-beer="' . $beername . '">';
            if(isset($punkAPIInfo['imageUrl'])){
                echo '<img src="' . $punkAPIInfo['imageUrl'] . '" alt="' . $beername . '">';
            }
            echo '<p style="align-self: flex-start">' . $beername . '</p>';
            echo '<p><b>' . $commentText . '</b></p>';
            echo '<p><em>' . $anonymizedUsername . '</em></p>';
            echo '</div>';
        }
    }

    public function generatePageNumbers() {
        if(!$this->page){
            $this->page = 1;
        }
        for($i = $this->page; $i <= ((int)$this->page + 9) && $i <= $this->count; $i++){
            if($i == $this->page && $i > 1 && $i < $this->page + 9 && $i <= $this->count && $i !== null){
                if($i > 10){
                    echo "<li><a href='index.php?page=".($i-10)."'>"."<<"."</a></li>";
                }
                echo "<li><a href='index.php?page=".($i-1)."'>"."<"."</a></li>";
                echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";
            }elseif($i == $this->page && ($i == 1 || $this->page == null)){
                $i = 1;
                echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";
            }elseif($i !== $this->page && $i > (int)$this->page + 8 && $i <= $this->count && $i !== null){
                echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
                echo "<li><a href='index.php?page=".($i+1)."'>".">"."</a></li>";
                if($i < $this->count - 10){
                    echo "<li><a href='index.php?page=".($i+10)."'>".">>"."</a></li>";
                }
            }else{
                echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
            }
        }
    }

    public function closeConnection() {
        $this->conn = null;
    }
}
?>