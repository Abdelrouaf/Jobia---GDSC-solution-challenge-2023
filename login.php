<?php

@include "config.php";

session_start();

if (isset($_POST['submit'])) {

    $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $email = mysqli_real_escape_string($conn, $filter_email);

    $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
    $pass = mysqli_real_escape_string($conn, $filter_pass);

    $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

    if (mysqli_num_rows($select_users) > 0){

        $row = mysqli_fetch_assoc($select_users);

        if ($row['user_type'] == 'admin') {

            $_SESSION['admin_id'] = $row['id'];
            $_SESSION['admin_name'] = $row['name'];
            $_SESSION['admin_email'] = $row['email'];
            $_SESSION['admin_password'] = $row['password'];
            $_SESSION['admin_number'] = $row['number'];
            $_SESSION['admin_state'] = $row['state'];
            $_SESSION['admin_country'] = $row['country'];
            $_SESSION['admin_image'] = $row['image'];
            $_SESSION['admin_age'] = $row['age'];
            $_SESSION['admin_details'] = $row['details'];
            $_SESSION['admin_job_type'] = $row['job_type'];
            header('location:admin_page.php');

        } elseif ($row['user_type'] == 'user') {

            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_password'] = $row['password'];
            $_SESSION['user_number'] = $row['number'];
            $_SESSION['user_state'] = $row['state'];
            $_SESSION['user_country'] = $row['country'];
            $_SESSION['user_image'] = $row['image'];
            $_SESSION['user_age'] = $row['age'];
            $_SESSION['user_details'] = $row['details'];
            $_SESSION['user_experience'] = $row['experience'];
            $_SESSION['user_cv'] = $row['cv'];
            $_SESSION['user_job_type'] = $row['job_type'];
            header('location:home.php');

        }

    } else {
        $message[] = 'Your email or password incorrect!';

    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign in page</title>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

</head>
<body>

<?php
@include 'header.php';
?>

<!-- section of login form -->

<section class="login">

    <form action="" method="post">

        <h2>login now</h2>

        <div class="form-group">

            <label for="email">Email</label>
            <input type="email" name="email" placeholder="enter your email" class="box" required>

        </div>

        <div class="form-group">

            <label for="password">Password</label>
            <input type="password" name="pass" id="pass" class="box" placeholder="enter your password" required>

        </div>

        <div class="have-account" style="font-size: 1.2rem;">
            
            <p>don't have any account? <a href="SignUp.php">Register now</a></p>

        </div>

    

        <div class="btns">

            <a href="home.php" class="btn_back" type="button" >Back</a>

            <input type="submit" class="btn_done" id="submit" name="submit" value="Done">

        </div>

    </form>

</section>



<?php
@include 'footer.php';
?>
    
</body>
</html>