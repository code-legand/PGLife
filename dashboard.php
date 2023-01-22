<?php
    session_start();
    require_once "includes/database_connect.php";

    if(!isset($_SESSION["user_id"])){
        $_SESSION["message"]="You need to login first!";
        header("Location: index.php");
        return;
    }
    $user_id = $_SESSION['user_id'];
    $sql_1 = "SELECT * FROM users WHERE id = $user_id";
    $result_1 = mysqli_query($conn, $sql_1);
    if (!$result_1) {
        $_SESSION["message"]= "Something went wrong!";
        return;
    }
    $user = mysqli_fetch_assoc($result_1);
    if (!$user) {
        $_SESSION["message"]= "Something went wrong!";
        return;
    }

    $sql_2 = "SELECT * 
                FROM interested_users_properties iup
                INNER JOIN properties p ON iup.property_id = p.id
                WHERE iup.user_id = $user_id";
    $result_2 = mysqli_query($conn, $sql_2);
    if (!$result_2) {
        $_SESSION["message"]= "Something went wrong!";
        return;
    }
    $interested_properties = mysqli_fetch_all($result_2, MYSQLI_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php
        require_once "includes\head_link.php"
    ?>

    <link rel="stylesheet" href="css/dashboard.css">
    <title>Dashboard | PG Life</title>
</head>

<body style="display: flex; flex-direction: column; min-height: 100vh">
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
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </nav>
    </div>

    <main style="flex-grow: 1;">
        <div class="container">
            <h3 class="h3 fw-normal w-100 p-3 mt-5 mb-3">My Profile</h3>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-2 my-md-auto my-2">
                        <i class="fas fa-user profile-image"></i>
                    </div>
                    <div class="col-10 col-md-8">
                        <div>
                            <b><?= $user['full_name'] ?></b><br>
                            <?= $user['email'] ?><br>
                            <?= $user['phone'] ?><br>
                            <?= $user['college_name'] ?><br>
                        </div>
                    </div>
                    <div class="col-2 d-flex align-items-center">
                        <a href="#">Edit Profile</a>
                    </div>
                </div>
            </div>
        </div>

        <?php
        if (count($interested_properties) > 0) {
        ?>
            <div class="container">
                <h3 class="h3 fw-normal w-100 p-3 mt-5 mb-3">My Interested Properties</h3>
                <?php
                    foreach ($interested_properties as $property) {
                        $property_images = glob("img/properties/" . $property['id'] . "/*");
                ?>
                    <div class="container-fluid border shadow box-shadow">
                        <div class="row mr-0 py-3 property-id-<?= $property['id'] ?>">
                            <div class="col-12 col-md-4 justify-content-center pb-3">
                                <img src="<?= $property_images[0] ?>" alt="Property-image" class="mw-100 mh-100">
                            </div>
                            <div class="col-12 col-md-8 px-4">
                                <div class="container-fluid">
                                    <div class="row">
                                        <?php
                                            $total_rating = ($property['rating_clean'] + $property['rating_food'] + $property['rating_safety']) / 3;
                                            $total_rating = round($total_rating, 1);
                                        ?>
                                        <div class="col-12 px-0">
                                            <div class="d-flex w-100 justify-content-between text-danger">
                                                <div class="star-container" title="<?= $total_rating ?>">
                                                    <!-- <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i> -->
                                                    <?php
                                                        $rating = $total_rating;
                                                        for ($i = 0; $i < 5; $i++) {
                                                            if ($rating >= $i + 0.8) {
                                                    ?>
                                                    <i class="fas fa-star"></i>
                                                    <?php
                                                        } elseif ($rating >= $i + 0.3) {
                                                    ?>
                                                    <i class="fas fa-star-half-alt"></i>
                                                    <?php
                                                        } else {
                                                    ?>
                                                    <i class="far fa-star"></i>
                                                    <?php
                                                            }
                                                        }
                                                    ?>
                                                </div>
                                                <div class="interested-container">
                                                    <i class="is-interested-image fas fa-heart" property_id="<?= $property['id'] ?>"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 px-0">
                                            <h4 class="h4 fw-normal w-100 mt-3 mb-1 mx-0 property-name"><?= $property['name'] ?></h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 p-0 property-address">
                                            <?= $property['address'] ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="property-gender">
                                            <?php
                                            if ($property['gender'] == "male") {
                                            ?>
                                                <img src="img/male.png" alt="male-img" style="max-width: 75px; max-height: 75px;">
                                            <?php
                                            } elseif ($property['gender'] == "female") {
                                            ?>
                                                <img src="img/female.png" alt="female-img" style="max-width: 75px; max-height: 75px;">
                                            <?php
                                            } else {
                                            ?>
                                                <img src="img/unisex.png" alt="unisex-img" style="max-width: 75px; max-height: 75px;">
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8 p-0 d-flex">
                                            <div class="fs-4 fw-bolder rent">₹ <?= number_format($property['rent']) ?>/-</div>
                                            <div class="rent-unit my-auto pl-2" style="text-indent: 1em;">per month</div>    
                                        </div>
                                        <div class="col-4 p-0">
                                            <a href="property_detail.php?property_id=<?= $property['id'] ?>" class="btn btn-success w-100">View</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                    }
                ?>
            </div>
        <?php
            }
        ?>

    </main>
        <?php
        require_once "includes/footer.php"
    ?>
    <!-- <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script> -->
    <script src="js/bootstrap5.min.js"></script>
</body>

</html>
