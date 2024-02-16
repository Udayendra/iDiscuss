<?php 
session_start();

echo '<nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
<div class="container-fluid">
    <a class="navbar-brand" href="index.php">iDiscuss</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="about.php">About</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Catogery
                </a>
                <ul class="dropdown-menu">';

                $sql="SELECT category_name, category_id FROM `categories`";
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($result)){
                    echo'
                        <li><a class="dropdown-item" href="threadlist.php?catid=' . $row["category_id"] . '">'.$row["category_name"].'</a></li>
                        ';
                }
                
                echo'
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href = "contact.php">Contact</a>
            </li>
        </ul>

        <form class="d-flex" role="search" action="search.php" method="get">
            <input class="form-control me-2 rounded-5 ms-2" type="search" placeholder="Search" aria-label="Search" name="search">
            <button class="btn btn-light rounded-5 me-2" type="submit">Search</button>
        </form>';

        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
            echo
                '<div class="d-flex justify-content-center">
                    <p class="text-light text-center" style="padding:5px; height:20px;">Welcome '.$_SESSION['username'].'</p>
                    <a href="partials/_logout.php" class="btn btn-outline-light ms-2 rounded-3">Logout</a>
                </div>';
        }
        else{
            echo '
            <div class="d-grid gap-2 d-lg-block">
                <button class="btn btn-outline-light ms-2  mt-sm-2 mt-lg-0 rounded-3" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                <button class="btn btn-outline-light ms-2 rounded-3" data-bs-toggle="modal" data-bs-target="#signupModal">Signup</button>
            </div>';
        }
        echo'
    </div>
</div>
</nav>';

include 'partials/_loginModal.php';
include 'partials/_signupModal.php';
if(isset($_GET['signupsuccess'])&&$_GET['signupsuccess']=="true"){
    echo '
    <div class="alert alert-success alert-dismissible fade show my-0 rounded-0" role="alert">
    <strong>Success</strong> You have successfully signed up.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    ';
}
if(isset($_GET['signupsuccess'])&&$_GET['signupsuccess']=="false"){
    $error = $_GET['error'];
    echo '
            <div class="alert alert-danger alert-dismissible fade show my-0 rounded-0" role="alert">
                <strong>Error! </strong>'.$error.'.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
         ';
}



if(isset($_GET['loginsuccess'])&&$_GET['loginsuccess']=="true"){
    echo '
    <div class="alert alert-success alert-dismissible fade show my-0 rounded-0" role="alert">
    <strong>Success</strong> You have successfully logged in.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    ';
}
if(isset($_GET['loginsuccess'])&&$_GET['loginsuccess']=="false"){
    $error = $_GET['error'];
    echo '
            <div class="alert alert-danger alert-dismissible fade show my-0 rounded-0" role="alert">
                <strong>Error! </strong>'.$error.'.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
         ';
}


?>