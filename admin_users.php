<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:login.php');
}

if(isset($_GET['delete'])){

    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `users` WHERE id = '$delete_id'") or die('query failed');
    $message[] = 'user account deleted successfully!';

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>users accounts</title>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="admin_style.css">
    <script src="admin_script.js" defer></script>

</head>
<body>

    
<?php @include 'admin_header.php'; ?>

<!-- display all users account -->

<section class="users">

    <h1 class="title">users account</h1>

    <div class="box-container">

    <?php

    $select_users = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');

    if(mysqli_num_rows($select_users) > 0){
        while($fetch_usres = mysqli_fetch_assoc($select_users)){
    ?>
    <div class="box">

        <p>user id: <span><?php echo $fetch_usres['id']; ?></span></p>
        <p>username: <span><?php echo $fetch_usres['name']; ?></span></p>
        <p>email: <span><?php echo $fetch_usres['email']; ?></span></p>
        <p>user type: <span style="color:<?php if ($fetch_usres['user_type'] == 'admin') {echo 'red';}; ?>"><?php echo $fetch_usres['user_type'] ?></span></p>

        <a href="admin_users.php?delete=<?php echo $fetch_usres['id']; ?>" onclick="return confirm('delete this user?');" class="delete-btn">delete</a>

    </div>

    <?php

        }
    }

    ?>

    </div>

</section>




<script src="admin_script.js"></script>

</body>
</html>