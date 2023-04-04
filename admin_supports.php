<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:login.php');
};

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `support` WHERE id = '$delete_id'") or die('query failed');
    $message[] = 'message delete successfully!';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Problems</title>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="admin_style.css">
    <script src="admin_script.js" defer></script>

</head>
<body>

    
<?php @include 'admin_header.php'; ?>

<!-- display all problems with users -->

<section class="messages">

    <h1 class="title">Problems</h1>

    <div class="box-container">
    

    <?php
    $select_message = mysqli_query($conn, "SELECT * FROM `support`") or die('query failed');
    if(mysqli_num_rows($select_message) > 0){
        while($fetch_message = mysqli_fetch_assoc($select_message)){
    ?>
    <div class="box">
        <p>user email: <span><?php echo $fetch_message['user_email']; ?></span></p>
        <p>message: <span><?php echo $fetch_message['message']; ?></span></p>
        <a href="admin_contacts.php?delete=<?php echo $fetch_message['id']; ?>" onclick="return confirm('delete this message?');" class="delete-btn">delete</a>
    </div>
    <?php
        }
    }else{
        echo '<p class="empty">you have no messages! :(</p>';
    }
    ?>
</div>

</section>



<script src="admin_script.js"></script>

</body>
</html>