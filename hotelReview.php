<?php
session_start();
include "dbFunctions.php"; 

$GethotelId = $_GET['hotelId'];

$hotelQuery = "SELECT hotelName, hotelId FROM hotels WHERE hotelId=$GethotelId";
$query = "SELECT *
            FROM reviews r
            INNER JOIN users u ON r.userId = u.userId
            INNER JOIN hotels h ON r.hotelId = h.hotelId";


$result = mysqli_query($link, $query) or die(mysqli_error($link));
$hotelInfo = mysqli_fetch_assoc(mysqli_query($link, $hotelQuery)) or die(mysqli_error($link));

while ($row = mysqli_fetch_array($result)) {
    $arrContent[] = $row; 
}
?>

<html>
    <head>
        <title>Hotel Reivews</title>
        <!--  Include reference to CSS stylesheet here -->
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
        <center>
        <?php
        $hotelName = $hotelInfo['hotelName'];
        $hotelId = $hotelInfo['hotelId'];
        ?>
        <h1>Hotel Review for <?php echo $hotelName ?></h1>
        <center><a href="addReview.php?hotelId=<?php echo $hotelId; ?>">Add new Reivew</a></center>
        <table border="1" cellpadding="10" cellspacing="5">
            <tr>
                <th>Review</th>
                <th>Rating</th>
                <th>Date Posted</th>
                <th>Username</th>
                <th>Edit</th>
                <th>Delete</th>
            
            </tr>
        <?php
        for ($i = 0; $i < count($arrContent); $i++) {
            $reviewId = $arrContent[$i]['reviewId'];
            $hotelId = $arrContent[$i]['hotelId'];
            $userId = $arrContent[$i]['userId'];
            $username = $arrContent[$i]['username'];
            $review = $arrContent[$i]['review'];
            $rating = $arrContent[$i]['rating'];
            $datePosted = $arrContent[$i]['datePosted'];
        
            if ($GethotelId == $hotelId){
        ?>
            <tr>
                <td><?php echo $review; ?></td>
                <td><?php echo $rating; ?></td>
                <td><?php echo $datePosted; ?></td>
                <td><?php echo $username; ?></td>
                <?php
                    if($_SESSION['userId'] == $userId){
                ?>
                <td><a href="editReview.php?reviewId=<?php echo $reviewId; ?>">Edit</a></td>
                <td><a href="deleteReview.php?reviewId=<?php echo $reviewId; ?>">Delete</a></td>
                    <?php } ?>
            </tr>
            <?php
        }
        }
        ?>
            </table>
        <a href="homepage.php">Back</a> to hotel list page!
        </center>
    </body>
</html>
