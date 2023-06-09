<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="admin_style.css">
    <script src="admin_script.js" defer></script>

</head>
<body>

    
<?php @include 'admin_header.php'; ?>

<!-- display all details in database -->

<section class="dashboard">

<h1 class="title">dashboard</h1>

<div class="box-container">

    <div class="box">

        <?php
        $select_products = mysqli_query($conn, "SELECT * FROM `job`") or die('query failed');
        $number_of_products = mysqli_num_rows($select_products);
        ?>
        <h3><?php echo $number_of_products; ?></h3>
        <p>jobs added</p>

    </div>

    <div class="box">

        <?php
        $select_products = mysqli_query($conn, "SELECT * FROM `need_job`") or die('query failed');
        $number_of_products = mysqli_num_rows($select_products);
        ?>
        <h3><?php echo $number_of_products; ?></h3>
        <p>more jobs added</p>

    </div>

    <div class="box">

        <?php
            $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'user'") or die('query failed');
        $number_of_users = mysqli_num_rows($select_users);
        ?>
        <h3><?php echo $number_of_users; ?></h3>
        <p>normal users</p>

    </div>

    <div class="box">

        <?php
        $select_admin = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'admin'") or die('query failed');
        $number_of_admin = mysqli_num_rows($select_admin);
        ?>
        <h3><?php echo $number_of_admin; ?></h3>
        <p>admin users</p>

    </div>

    <div class="box">

        <?php
        $select_account = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
        $number_of_account = mysqli_num_rows($select_account);
        ?>
        <h3><?php echo $number_of_account; ?></h3>
        <p>total accounts</p>

    </div>

    <div class="box">

        <?php
        $select_messages = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
        $number_of_messages = mysqli_num_rows($select_messages);
        ?>
        <h3><?php echo $number_of_messages; ?></h3>
        <p>new messages</p>

    </div>

    <div class="box">

        <?php
        $select_messages = mysqli_query($conn, "SELECT * FROM `support`") or die('query failed');
        $number_of_messages = mysqli_num_rows($select_messages);
        ?>
        <h3><?php echo $number_of_messages; ?></h3>
        <p>new messages from support</p>

    </div>

</div>

</section>





<script src="admin_script.js"></script>

</body>
</html>