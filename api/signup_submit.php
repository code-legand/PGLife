<?php
    session_start();
    require_once "../includes/database_connect.php";

    $full_name = $_POST['full_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = sha1($password);
    $college_name = $_POST['college_name'];
    $gender = $_POST['gender'];

    $sql = "SELECT * FROM users WHERE email='$email'";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        $row_count = mysqli_num_rows($result);
        if ($row_count == 0) {
            $sql = "INSERT INTO users (email, password, full_name, phone, gender, college_name) VALUES ('$email', '$password', '$full_name', '$phone', '$gender', '$college_name')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $_SESSION['message']="Your account has been created successfully!";
            }
            else {
                $_SESSION['message']="Something went wrong!";
            }
        }
        else {
            $_SESSION['message']="This email id is already registered with us!";
        }
    }
    else {
        $_SESSION['message']="Something went wrong!";
    }

    echo "<b>".$_SESSION['message']."</b><br>";

?>


Click <a href="../index.php">here</a> to continue.
<?php
    mysqli_close($conn);
?>

