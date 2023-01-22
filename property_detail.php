<?php
    session_start();
    require_once "includes/database_connect.php";
    if(isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $user_name = $_SESSION['user_name'];
    }

    if (isset($_GET['property_id'])) {
        $property_id = $_GET['property_id'];

        $property = mysqli_query($conn, "SELECT * FROM properties WHERE id = $property_id");
        $property_info = mysqli_fetch_assoc($property);

        $amenities_types = mysqli_query($conn, "SELECT type FROM amenities JOIN properties_amenities ON amenities.id = properties_amenities.amenity_id WHERE property_id = $property_id");
        $amenities_types_list = array();
        while($amenities_type = mysqli_fetch_assoc($amenities_types)) {
            array_push($amenities_types_list, $amenities_type['type']);
        }
        $amenities_types_list = array_unique($amenities_types_list);
        $amenities_name_list = array();
        $amenities_icon_list = array();
        foreach($amenities_types_list as $amenity_type) {
            $amenities = mysqli_query($conn, "SELECT name, icon FROM amenities JOIN properties_amenities ON amenities.id = properties_amenities.amenity_id WHERE property_id = $property_id AND type = '$amenity_type'");
            $amenities_list = array();
            while($amenity = mysqli_fetch_assoc($amenities)) {
                array_push($amenities_list, $amenity['name']);
                $amenities_icon_list[$amenity['name']] = $amenity['icon'];
            }

            $amenities_name_list[$amenity_type] = $amenities_list;
        }

        $testimonials = mysqli_query($conn, "SELECT * FROM testimonials WHERE property_id = $property_id");
        $testimonials_info = mysqli_fetch_all($testimonials, MYSQLI_ASSOC);

        $interested_users = mysqli_query($conn, "SELECT * FROM interested_users_properties WHERE property_id = $property_id");
        $interested_users_count = mysqli_num_rows($interested_users);
        $interested_users_info = mysqli_fetch_assoc($interested_users);
        
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
        require_once "includes\head_link.php"
    ?>

    <link href="css/property_detail.css" rel="stylesheet" />
</head>

<body style="display: flex; flex-direction: column; min-height: 100vh">
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="img/logo.png" alt="" width="100" height="40">
            </a>
            <?php
                if(isset($_SESSION['user_id'])) {
                    require_once "includes\header2.php";
                }
                else {
                    require_once "includes\header1.php";
                }
            ?>
        </div>
    </nav>

    <!-- Modal -->
    <?php
        require_once "includes/login_modal.php";
        require_once "includes/signup_modal.php";
    ?>

    <div class="bg-light">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb py-1 px-3">
                <li class="breadcrumb-item">
                    <a href="index.php">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="property_list.php?city=<?= $_SESSION['city_name'] ?>"><?= $_SESSION['city_name'] ?></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <?= $property_info['name'] ?>
                </li>
            </ol>
        </nav>
    </div>

    <div id="property-images" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#property-images" data-slide-to="0" class="active"></li>
            <li data-target="#property-images" data-slide-to="1" class=""></li>
            <li data-target="#property-images" data-slide-to="2" class=""></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="img/properties/1/1d4f0757fdb86d5f.jpg" alt="slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="img/properties/1/46ebbb537aa9fb0a.jpg" alt="slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="img/properties/1/eace7b9114fd6046.jpg" alt="slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#property-images" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#property-images" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="property-summary page-container">
        <div class="row no-gutters justify-content-between">
            <div class="star-container" title="<?= $total_rating ?>">
                <?php
                $total_rating = ($property_info['rating_clean'] + $property_info['rating_food'] + $property_info['rating_safety']) / 3;
                $rating = round($total_rating, 1);
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
            <!-- <div class="star-container" title="4.8">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div> -->
            <div class="interested-container">
                <i class="is-interested-image far fa-heart"></i>
                <div class="interested-text">
                    <span class="interested-user-count"><?= $interested_users_count ?></span> interested
                </div>
            </div>
        </div>
        <div class="detail-container">
            <div class="property-name"><?= $property_info['name'] ?></div>
            <div class="property-address"><?= $property_info['address'] ?></div>
            <div class="property-gender">
                <img src="img/<?= $property_info['gender'] ?>.png" />
            </div>
        </div>
        <div class="row no-gutters">
            <div class="rent-container col-6">
                <div class="rent">Rs <?= $property_info['rent'] ?>/-</div>
                <div class="rent-unit">per month</div>
            </div>
            <div class="button-container col-6">
                <a href="tel:+0000000000" class="btn btn-primary">Book Now</a>
            </div>
        </div>
    </div>

    <div class="property-amenities">
        <div class="page-container">
            <h1>Amenities</h1>
            <div class="row justify-content-between">
                <?php
                    foreach ($amenities_name_list as $amenities_type => $amenity_list) {
                        echo '<div class="col-md-auto">';
                        echo "<h1>$amenities_type</h1>";
                        foreach ($amenity_list as $amenity) {
                            echo "<div class='amenity-container'>
                                <img src='img/amenities/$amenities_icon_list[$amenity].svg'>
                                <span>$amenity</span>
                            </div>";
                        }
                        echo "</div>";
                    }
                ?>

                <!-- <div class="col-md-auto">
                    <h5>Building</h5>
                    <div class="amenity-container">
                        <img src="img/amenities/powerbackup.svg">
                        <span>Power backup</span>
                    </div>
                    <div class="amenity-container">
                        <img src="img/amenities/lift.svg">
                        <span>Lift</span>
                    </div>
                </div>

                <div class="col-md-auto">
                    <h5>Common Area</h5>
                    <div class="amenity-container">
                        <img src="img/amenities/wifi.svg">
                        <span>Wifi</span>
                    </div>
                    <div class="amenity-container">
                        <img src="img/amenities/tv.svg">
                        <span>TV</span>
                    </div>
                    <div class="amenity-container">
                        <img src="img/amenities/rowater.svg">
                        <span>Water Purifier</span>
                    </div>
                    <div class="amenity-container">
                        <img src="img/amenities/dining.svg">
                        <span>Dining</span>
                    </div>
                    <div class="amenity-container">
                        <img src="img/amenities/washingmachine.svg">
                        <span>Washing Machine</span>
                    </div>
                </div>

                <div class="col-md-auto">
                    <h5>Bedroom</h5>
                    <div class="amenity-container">
                        <img src="img/amenities/bed.svg">
                        <span>Bed with Matress</span>
                    </div>
                    <div class="amenity-container">
                        <img src="img/amenities/ac.svg">
                        <span>Air Conditioner</span>
                    </div>
                </div>

                <div class="col-md-auto">
                    <h5>Washroom</h5>
                    <div class="amenity-container">
                        <img src="img/amenities/geyser.svg">
                        <span>Geyser</span>
                    </div>
                </div> -->
            </div>
        </div>
    </div>

    <div class="property-about page-container">
        <h1>About the Property</h1>
        <p><?= $property_info['description'] ?></p>
    </div>

    <div class="property-rating">
        <div class="page-container">
            <h1>Property Rating</h1>
            <div class="row align-items-center justify-content-between">
                <div class="col-md-6">
                    <div class="rating-criteria row">
                        <div class="col-6">
                            <i class="rating-criteria-icon fas fa-broom"></i>
                            <span class="rating-criteria-text">Cleanliness</span>
                        </div>
                        <div class="rating-criteria-star-container" title="<?= $total_rating ?>">
                            <?php
                            $rating = $property_info['rating_clean'];
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
                        <!-- <div class="rating-criteria-star-container col-6" title="4.3">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div> -->
                    </div>

                    <div class="rating-criteria row">
                        <div class="col-6">
                            <i class="rating-criteria-icon fas fa-utensils"></i>
                            <span class="rating-criteria-text">Food Quality</span>
                        </div>
                        <div class="rating-criteria-star-container" title="<?= $total_rating ?>">
                            <?php
                            $rating = $property_info['rating_food'];
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
                        <!-- <div class="rating-criteria-star-container col-6" title="3.4">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <i class="far fa-star"></i>
                        </div> -->
                    </div>

                    <div class="rating-criteria row">
                        <div class="col-6">
                            <i class="rating-criteria-icon fa fa-lock"></i>
                            <span class="rating-criteria-text">Safety</span>
                        </div>
                        <div class="rating-criteria-star-container" title="<?= $total_rating ?>">
                            <?php
                            $rating = $property_info['rating_safety'];
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
                        <!-- <div class="rating-criteria-star-container col-6" title="4.8">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div> -->
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="rating-circle">
                        <div class="total-rating">4.2</div>
                        <div class="star-container" title="<?= $total_rating ?>">
                            <?php
                            $total_rating = ($property_info['rating_clean'] + $property_info['rating_food'] + $property_info['rating_safety']) / 3;
                            $rating = round($total_rating, 1);
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
                        <!-- <div class="rating-circle-star-container">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="property-testimonials page-container">
        <h1>What people say</h1>
        <?php
            foreach($testimonials_info as $testimonial){
                echo '<div class="testimonial-block">
                        <div class="testimonial-image-container">
                            <img class="testimonial-img" src="img/man.png">
                        </div>
                        <div class="testimonial-text">
                            <i class="fa fa-quote-left" aria-hidden="true"></i>
                            <p>'.$testimonial['content'].'</p>
                        </div>
                        <div class="testimonial-name">- '.$testimonial['user_name'].'</div>
                    </div>';
            }
        ?>
        
        <!-- <div class="testimonial-block">
            <div class="testimonial-image-container">
                <img class="testimonial-img" src="img/man.png">
            </div>
            <div class="testimonial-text">
                <i class="fa fa-quote-left" aria-hidden="true"></i>
                <p>You just have to arrive at the place, it's fully furnished and stocked with all basic amenities and services and even your friends are welcome.</p>
            </div>
            <div class="testimonial-name">- Ashutosh Gowariker</div>
        </div>
        <div class="testimonial-block">
            <div class="testimonial-image-container">
                <img class="testimonial-img" src="img/man.png">
            </div>
            <div class="testimonial-text">
                <i class="fa fa-quote-left" aria-hidden="true"></i>
                <p>You just have to arrive at the place, it's fully furnished and stocked with all basic amenities and services and even your friends are welcome.</p>
            </div>
            <div class="testimonial-name">- Karan Johar</div>
        </div> -->
    </div>

    <!-- <div class="modal fade" id="signup-modal" tabindex="-1" role="dialog" aria-labelledby="signup-heading" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="signup-heading">Signup with PGLife</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="signup-form" class="form" role="form">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-user"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" name="full_name" placeholder="Full Name" maxlength="30" required>
                        </div>

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-phone-alt"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" name="phone" placeholder="Phone Number" maxlength="10" minlength="10" required>
                        </div>

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-envelope"></i>
                                </span>
                            </div>
                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                        </div>

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </span>
                            </div>
                            <input type="password" class="form-control" name="password" placeholder="Password" minlength="6" required>
                        </div>

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-university"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" name="college_name" placeholder="College Name" maxlength="150" required>
                        </div>

                        <div class="form-group">
                            <span>I'm a</span>
                            <input type="radio" class="ml-3" id="gender-male" name="gender" value="male" /> Male
                            <label for="gender-male">
                            </label>
                            <input type="radio" class="ml-3" id="gender-female" name="gender" value="female" />
                            <label for="gender-female">
                                Female
                            </label>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-primary">Create Account</button>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <span>Already have an account?
                        <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#login-modal">Login</a>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="login-heading" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="login-heading">Login with PGLife</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="login-form" class="form" role="form">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-user"></i>
                                </span>
                            </div>
                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                        </div>

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </span>
                            </div>
                            <input type="password" class="form-control" name="password" placeholder="Password" minlength="6" required>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-primary">Login</button>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <span>
                        <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#signup-modal">Click here</a>
                        to register a new account
                    </span>
                </div>
            </div>
        </div>
    </div> -->
    <?php
        
    ?>

    <!-- <script type="text/javascript" src="js/jquery.js"></script> -->
    <script type="text/javascript" src="js/bootstrap5.min.js"></script>
</body>

</html>
