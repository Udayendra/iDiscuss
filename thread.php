<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welocome to iDiscuss - Coding Forum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
</head>

<body>

    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>
    <?php
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `thread` WHERE thread_id=$id;";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $title=$row['thread_title'];
        $desc=$row['thread_desc'];
    }
    ?>

    <?php
    $method=$_SERVER['REQUEST_METHOD'];
    if($method=='POST'){
        $comment = $_POST['comment'];
        $sno = $_POST['sno'];
        
        $sql="INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment', '$id', '$sno', current_timestamp())";
        $result=mysqli_query($conn,$sql);
    }
    
    ?>

    <div class="p-5 mb-4 bg-body-tertiary rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold"><?php echo $title; ?></h1>
            <p class="col-md-8 fs-4"><?php echo $desc; ?></p>
            <button class="btn btn-outline-secondary btn-lg" type="button">Example button</button>
        </div>
    </div>
<?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    echo '
    <div class="container my-3">
        <h1>Post a comment</h1>
        <form action="'.$_SERVER["REQUEST_URI"].'" method="post">
            <div class="mb-3">
                <label for="comment" class="form-label">Type your comment</label>
                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">
            </div>

            <button type="submit" class="btn btn-secondary">Post</button>
        </form>
    </div>';
    }
    else{
        echo'
        
        <div class="container">
            <h1>Post a comment</h1>
            <p>You are not logged in. Please login to be able to post comment.</p>
        </div>';
    }
?>

    <div class="container">
        <h3 class="pb-4 ">Discussion</h3>
        <?php
        $id = $_GET['threadid'];
        $sql = "SELECT * FROM `comments` WHERE thread_id=$id;";
        $result = mysqli_query($conn, $sql);
        $noResult=true;
        while($row = mysqli_fetch_assoc($result)){
            $noResult=false;
            $cid=$row['comment_id'];
            $content=$row['comment_content'];
            $ctime=$row['comment_time'];
            $comment_by = $row['comment_by'];
            $sql2 = "SELECT `user_name` FROM `users` WHERE `sno`='$comment_by'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
        
            echo '
                    <div class=" card mb-3 my-3">
                        <div class="row g-0">
                            <div class="col-md-1 d-flex justify-content-center">
                                <img src="img/userimg.png" class="img-fluid rounded-start" width="130px" alt="...">
                            </div>
                            <div class="col-md-8 ps-2">
                                <div class="card-body">
                                    <p class="card-title fw-bold">'.$row2["user_name"].'<small class="text-body-secondary"> at '.$ctime.'</small></p>
                                    <p class="card-text">'. $content.'</p>
                                </div>
                            </div>
                        </div>
                    </div>
                ';
        }

            if ($noResult) {
                echo    '
                        <div class="col-md-6">
                            <div class="h-100 p-5 bg-body-tertiary border rounded-3">
                                <p class="display-4">No thread found</p>
                                <p>Be the first person to ask question</p>
                                <button class="btn btn-outline-secondary" type="button">Example button</button>
                            </div>
                        </div>
                        ';
            }
        ?>  
        
    </div>

    <?php include 'partials/_footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>