<?php
    session_start();
    require_once "../includes/database_connect.php";

    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = sha1($password);

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $row_count = mysqli_num_rows($result);
        if ($row_count != 0) {
            $res=mysqli_fetch_assoc($result);
            $_SESSION['user_id']=$res['id'];
            $_SESSION['user_name']=$res['full_name'];
            
            $_SESSION['message']="You have logged in successfully!";
            header("Location: ../dashboard.php");
            exit;
        }
        else{
            $_SESSION['message']="Incorrect email or password";
            header("Location: ../index.php");
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


