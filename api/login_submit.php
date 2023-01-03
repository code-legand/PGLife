<?php
    require_once "../includes/database_connect.php";

    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = sha1($password);

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        $_SESSION['message']="Something went wrong!";
        exit;
    }

    $row_count = mysqli_num_rows($result);
    if ($row_count != 0) {
        $_SESSION['message']="You have logged in successfully!";
        header("Location: dashboard.php");
        exit;
    }
    else {
        $_SESSION['message']="Incorrect email or password";
        header("Location: index.html");
        exit;
    }

?>

