<?php
session_start();
include "dbFunctions.php";

$userId = $_SESSION['userId'];
$sessionUsername = $_SESSION['username'];

$query = "SELECT * FROM users WHERE userId=$userId";
$result = mysqli_query($link, $query) or die (mysqli_error($link));
$row = mysqli_fetch_array($result);
if (!empty($row)){
    $userId = $row['userId'];
    $username = $row['username'];
    $name = $row['name'];
    $address = $row['address'];
    $email = $row['email'];
}

?>
<html>
    <head>
        <title>Edit User Information</title>
        <!--  Include reference to CSS stylesheet here -->
        <link rel="stylesheet" type="text/css" href="stylesheets/style_login.css"/>
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
        <?php
                if(isset($_SESSION['userId'])) {
         ?>
                <h4>Welcome <?php echo $_SESSION['username'] ?>!</h4>
        <?php } ?>
        <?php if (!empty($userId)) { ?>
            <form id="form" action="doEditUser.php" method="post">
                <h1 font-weight="bold">Edit User Account</h1>
                <input type ="hidden" name="userId" value="<?php echo $userId ?>"/>
                Username: <input id="idUsername" type="text" name="username" value="<?php echo $username; ?>"/>
                <br/>
                Name:<input id="idName" type="text" name="name" value="<?php echo $name; ?>"/>
                <br/>
                Address: <input id="idName" type="text" name="address" value="<?php echo $address; ?>"/>
                <br/>
                Email: <input id="idName" type="text" name="email" value="<?php echo $email; ?>"/>
                <br><br/>
                <input id="submit" type="submit" value="Update"/>
                <br><br/>               
            </form>
                <br><br/>
                <form id="form" action="doDeleteUser.php" method="post">
                        <h1 font-weight="bold">Delete User Account</h1>
                <input type ="hidden" name="userId" value="<?php echo $userId ?>"/>
                    <a class="required-field"></a>
                    <input type="checkbox" name="agree" value="Agree" id="agree" required>
                    <label for="agree">If you wish to delete your account, please check the checkbox</label>
                    <br><br/>
                    <input id="submit" type="submit" value="Delete"/>
                    <br><br/>
                </form>
            <center><a href="homepage.php">Back</a> to the homepage!
        <?php } ?>
    </body>
</html>
