<?php 
    if isset($_SESSION["user_id"]){
        header('Location: dashboard.php');
        return;
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
        require_once "includes\head_link.php"
    ?>
    <link rel="stylesheet" href="css/home.css">
    <title>Home | PG Life</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="img/logo.png" alt="logo" width="100" height="40">
            </a>
            <?php
                require_once "includes/header1.php"
            ?>
        </div>
    </nav>

    <!-- Modal -->
    <?php
        require_once "includes/login_modal.php";
        require_once "includes/signup_modal.php";
    ?>

    <!-- main content -->

    <div class="container-fluid py-3 my-5 px-0 fixed-top" style="z-index: -1;">
        <div id="home-banner" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <!-- <div style="height: 500px; background-color: black; opacity: 0.4;"></div> -->
                    <img src="img/bg.png" class="d-block w-100" alt="home banner">
                </div>
            </div>
        </div>
    </div>

    <div>
        <div style="height: 40vw; background-color: rgba(0, 0, 0, .45)"
            class="d-flex align-content-center justify-content-center flex-wrap mt-5">
            <h3 class="h3 fw-normal text-center w-100 p-3 text-light">Happiness per Square Foot</h3>
            <form class="d-flex w-50 mx-auto" role="search" method="get" action="property_list.php">
                <input class="form-control w-80" type="search" placeholder="Enter your city to search for PG's" aria-label="Search" name="city" id="city">
                <button class="btn btn-dark" type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>
    </div>
    <div style="background-color: white;" class="pt-5">

        <h1 class="h1 fw-normal text-center my-5">Major Cities</h1>
        <div class="container-fluid p-5 mb-5">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3 d-flex justify-content-center">
                    <a href="property_list.php?city=delhi">
                        <div class="btn rounded-circle shadow m-3 d-flex align-items-center justify-content-center"
                            style="width: 200px; height: 200px;"
                            onmouseenter="this.className = this.className.replace('shadow', 'shadow-lg bg-light');"
                            onmouseleave="this.className = this.className.replace('shadow-lg bg-light', 'shadow');">
                            <img src="img/delhi.png" alt="delhi" style="width: 150px; height: 150px;" class="">
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-3 d-flex justify-content-center">
                    <a href="property_list.php?city=mumbai">
                        <div class="rounded-circle shadow m-3 d-flex align-items-center justify-content-center"
                            style="width: 200px; height: 200px;"
                            onmouseenter="this.className = this.className.replace('shadow', 'shadow-lg bg-light');"
                            onmouseleave="this.className = this.className.replace('shadow-lg bg-light', 'shadow');">
                            <img src="img/mumbai.png" alt="mumbai" style="width: 150px; height: 150px;">
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-3 d-flex justify-content-center">
                    <a href="property_list.php?city=bangalore">
                        <div class="rounded-circle shadow m-3 d-flex align-items-center justify-content-center"
                            style="width: 200px; height: 200px;"
                            onmouseenter="this.className = this.className.replace('shadow', 'shadow-lg bg-light');"
                            onmouseleave="this.className = this.className.replace('shadow-lg bg-light', 'shadow');">
                            <img src="img/bangalore.png" alt="bangalore" style="width: 150px; height: 150px;">
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-3 d-flex justify-content-center">
                    <a href="property_list.php?city=hyderabad">
                        <div class="rounded-circle shadow m-3 d-flex align-items-center justify-content-center"
                            style="width: 200px; height: 200px;"
                            onmouseenter="this.className = this.className.replace('shadow', 'shadow-lg bg-light');"
                            onmouseleave="this.className = this.className.replace('shadow-lg bg-light', 'shadow');">
                            <img src="img/hyderabad.png" alt="hyderabad" style="width: 150px; height: 150px;">
                        </div>
                    </a>
                </div>
            </div>
        </div>


        <?php
            require_once "includes/footer.php"
        ?>
    </div>

    <!-- <script src="js/jquery.js"></script> -->
    <script src="js/bootstrap5.min.js"></script>
</body>

</html>