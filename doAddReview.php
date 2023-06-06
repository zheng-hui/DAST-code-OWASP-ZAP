<?php
session_start();
include "dbFunctions.php";

$userId = $_SESSION['userId'];
$hotelId = $_POST['hotelId'];
$review = $_POST['review'];
$rating = $_POST['rating'];


$add = true;
$query = "INSERT INTO reviews (hotelId, userId, review, rating)
          VALUES ('$hotelId','$userId','$review','$rating')";
$result = mysqli_query($link, $query) or die(mysqli_error($link));

if ($result) {
    $add = true;
}
else {
    $add = false;
}
?>
<html>
    <head>
        <title>Add Hotel Review</title>
        <link rel="stylesheet" type="text/css" href="stylesheets/style_hotelreview.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    </head>
    <style>
        .fa-solid {
            background-color:#35CBDF;
            border-radius: 50%;
            color: #fff;
            font-size: 30px;
            height: 60px;
            line-height: 60px;
            text-align: center;
            width: 60px;
        }
    </style>
    <body>
                <nav class="navbar navbar-expand-sm p-3 mb-2 navbar-custom">
            <div>
                <i class="fa fa-solid fa-hotel"  aria-hidden="true"></i>
            </div>
            <div class="container-fluid">

                <a class="navbar-brand" href="#"><span class="text-white">Hotel Review</a></span>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="homepage.php"><span class="text-white">Hotels</a></span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="editUser.php"><span class="text-white">Edit User Information</a></span>
                        </li>
                        <div class="justify-content-right">
                        <li class="nav-item">
                        <?php
                        if(isset($_SESSION['userId'])) {
                        ?>
                            <a class="nav-link" href="logout.php"><span class="text-white">Logout</a></span>
                        <?php } else { ?>
                            <a class="nav-link" href="login.php"><span class="text-white">Login/Register</a></span>
                        <?php } ?>
                        </li></div>  
                    </ul>
                </div>
            </div>
        </nav>
        <?php
                if(isset($_SESSION['userId'])) {
         ?>
                <h4>Welcome <?php echo $_SESSION['username'] ?>!</h4>
        <?php } ?>
        <?php if($add ==true){ ?>
    <center>
        <form id='form' name='doAddReview' method='post'>
            <h1 font-weight="bold">Review Successfully Added!</h1>
                <a href="hotelReview.php?hotelId=<?php echo $hotelId; ?>">Back</a> to review page!
                </form>
            <?php
        } else { ?>
            Review failed to be added
        <?php } ?>
    </body>
</html>
