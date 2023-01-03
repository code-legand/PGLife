<?php
    if(!isset($_SESSION["user_id"])){
        $_SESSION["message"]="You need to login first!"
        header("Location: index.php");
        return;
    }
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
        require_once "include\head_link.php"
    ?>

    <link rel="stylesheet" href="css/dashboard.css">
    <title>Dashboard | PG Life</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="img/logo.png" alt="" width="100" height="40">
            </a>
            <?php
                require_once "includes/header2.php"
            ?>
        </div>
    </nav>

    <div class="bg-light">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb py-1 px-3">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </nav>
    </div>

    <div class="container">
        <h3 class="h3 fw-normal w-100 p-3 mt-5 mb-3">My Profile</h3>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-2 my-md-auto my-2">
                    <i class="fas fa-user profile-image"></i>
                </div>
                <div class="col-10 col-md-8">
                    <div>
                        <b>Aditya Sood</b><br>
                        aditya@gmail.com<br>
                        9876543210<br>
                        Internshala<br>
                    </div>
                </div>
                <div class="col-2 d-flex align-items-center">
                    <a href="#">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <h3 class="h3 fw-normal w-100 p-3 mt-5 mb-3">My Interested Properties</h3>
        <div class="container-fluid border shadow box-shadow">
            <div class="row mr-0 py-3">
                <div class="col-12 col-md-4 justify-content-center pb-3">
                    <img src="img/properties/1/eace7b9114fd6046.jpg" alt="Property-image" class="mw-100 mh-100">
                </div>
                <div class="col-12 col-md-8 px-4">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 px-0">
                                <div class="d-flex w-100 justify-content-between text-danger">
                                    <div>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <div>
                                        <i class="fas fa-heart"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 px-0">
                                <h4 class="h4 fw-normal w-100 mt-3 mb-1 mx-0">Ganpati Paying Guest</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 p-0">
                                Police Beat, Sainath Complex, Besides, SV Rd, Daulat Nagar, Borivali East, Mumbai -
                                400066
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 p-0">
                                <img src="img/unisex.png" alt="unisex-img" style="max-width: 75px; max-height: 75px;">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8 p-0 d-flex">
                                <div class="fs-4 fw-bolder">
                                    Rs 8500/-
                                </div>
                                <div class="my-auto pl-2" style="text-indent: 1em;">per month</div>
                            </div>
                            <div class="col-4 p-0">
                                <a href="#" class="btn btn-success w-100">View</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script> -->
    <script src="js/bootstrap5.min.js"></script>
</body>

</html>