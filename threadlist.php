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
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE category_id=$id;";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $catname = $row['category_name'];
        $catdesc = $row['category_description'];
    }
    ?>
    <?php
    $showAlert=false;
    $method=$_SERVER['REQUEST_METHOD'];
    if($method == 'POST'){
        $showAlert=true;
        // Insert thread in bd
        $th_title=$_POST['title'];
        $th_desc=$_POST['desc'];
        $sno = $_POST['sno'];
        $sql="INSERT INTO `thread` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestemp`) VALUES ( '$th_title', '$th_desc', '$id', '$sno', current_timestamp())";
        $result=mysqli_query($conn, $sql);
        if($showAlert){
            echo    '
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success</strong> Your qestion is successfully uploaded.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    ';
        }
    }
    ?>

    <div class="p-5 mb-4 bg-body-tertiary rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">Welcome to <?php echo $catname; ?> forum</h1>
            <p class="col-md-8 fs-4"><?php echo $catdesc; ?></p>
            <button class="btn btn-outline-secondary btn-lg" type="button">Example button</button>
        </div>
    </div>

    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    echo '
    <div class="container my-3">
        <h1>Start a discussion</h1>
        <form action="'.$_SERVER["REQUEST_URI"].'" method="post">
            <div class="mb-3">
                <label for="title" class="form-label">Problem title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">Keep your title as short and crisp as possible</div>
                <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">
                
            </div>
            <div class="mb-3">
                <label for="desc" class="form-label">Elaborate your concern</label>
                <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-secondary">Submit</button>
        </form>
    </div>';
    }
    else{
        echo'
        
        <div class="container">
            <h1>Start a discussion</h1>
            <p>You are not logged in. Please login to be able to start discussion.</p>
        </div>';
    }
    ?>

    <div class="container">
        <h3 class="pb-4 ">Browse questions</h3>
        <?php
        $sql = "SELECT * FROM `thread` WHERE thread_cat_id=$id;";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $id = $row['thread_id'];
            $thname = $row['thread_title'];
            $thdesc = $row['thread_desc'];
            $time = $row['timestemp'];
            $thread_user_id = $row['thread_user_id'];
            $sql2 = "SELECT `user_name` FROM `users` WHERE `sno`='$thread_user_id'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);

            echo '
                    <div class=" card mb-3 my-3">
                        <div class="row g-0">
                            <div class="col-md-1">
                                <img src="img/userimg.png" class="img-fluid rounded-start" width="130px" alt="...">
                            </div>
                            <div class="col-md-8 ps-2">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="thread.php?threadid=' . $id . '" class="text-title"> ' . $thname . '</a></h5>
                                    <p class="card-text">' . $thdesc . '</p>
                                    <p class="card-title fw-bold">'.$row2["user_name"].'<small class="text-body-secondary"> at '.$time.'</small></p>
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