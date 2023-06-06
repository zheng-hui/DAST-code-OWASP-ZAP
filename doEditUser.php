<?php
session_start();
include"dbFunctions.php";
$theUserId = $_POST['userId'];
$newUsername = $_POST['username'];
$newName = $_POST['name'];
$newAddress = $_POST['address'];
$newEmail = $_POST['email'];


$edit = true;
$query = "UPDATE users SET username='$newUsername', name='$newName', address='$newAddress', email='$newEmail' WHERE userId = $theUserId";
$result = mysqli_query($link, $query) or die(mysqli_error($link));

if ($result) {
    $edit = true;
}
else {
    $edit = false;
}
?>
<html>
    <head>
        <title>Edit Hotel Review</title>
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
        <?php if($edit ==true){ ?>
    <center>
        <form id='form' name='doEditUser' method='post'>
            <h1 font-weight="bold">User Successfully Edited!</h1>
                <a href="logout.php">Re-login</a> to see the changes made!
                </form>
            <?php
        } else { ?>
            <center>
                <form id='form' name='doEditUserFail' method='post'>
                <h1 font-weight="bold">Failed to Edit User Information</h1>
                </form>
        <?php } ?>
    </center>
    </body>
</html>
