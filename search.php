<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>iDocument | Search</title>
    <style>
        .search_container{
            height: 80vh;
        }
    </style>
</head>
<body>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>
    



    
    <div class="container">
        <h1 class="text-center my-3">Search result for "<?php echo $_GET['search']?>"</h1>

        <?php 
        $noresult=true;
        $search = $_GET['search'];
        $sql = "SELECT * FROM `thread` WHERE MATCH (thread_title, thread_desc) AGAINST('$search')";
        $result = mysqli_query($conn, $sql);
        while($row=mysqli_fetch_assoc($result)){
            $noresult=false;
            $title=$row['thread_title'];
            $desc=$row['thread_desc'];
            $id = $row['thread_id'];
            echo '
                <div class="container-fluid">
                    <a href="thread.php?threadid=' . $id . '"> <h3 class="">'.$title.'</h3></a>
                    <p>'.$desc.'</p>
                </div>
                ';
        }

        if($noresult){
            echo'
            <div class="conainer search_container">
                <h3>No result found</h3>
                <ul>
                <h4>Suggestions:</h4>
                <ul>
                    <li>Make sure that all words are spelled correctly.</li>
                    <li>Try different keywords.</li>
                    <li>Try more general keywords.</li>
                </ul>
                </ul>
            </div>
            ';
        }
        ?>
    </div>
    
    <?php include 'partials/_footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>