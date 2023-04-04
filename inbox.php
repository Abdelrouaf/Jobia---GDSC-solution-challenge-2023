<?php
@include 'config.php';


if(isset($_GET['delete'])){

    $delete_id = $_GET['delete'];

    mysqli_query($conn, "DELETE FROM `chat` WHERE id = '$delete_id'") or die('query failed');

    $message[] ='you rejected the offer';
}

if(isset($_GET['accept'])){

    $delete_id = $_GET['accept'];

    mysqli_query($conn, "DELETE FROM `chat` WHERE id = '$delete_id'") or die('query failed');

    $message[] ='you accept the offer';
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inbox page</title>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

</head>
<body>

<?php
session_start();

@include 'header2.php';

?>

<!-- section of the user offers -->

<section class="jobs-container">

    <h1 class="heading">your offers</h1>

    <div class="box-container">

        <?php

        $id = $_SESSION['user_id'];

        $select_job = mysqli_query($conn, "SELECT * FROM `chat` WHERE sender_id = $id") or die('query failed');
        
        if(mysqli_num_rows($select_job) > 0){

            while($fetch_job = mysqli_fetch_assoc($select_job)){
        ?>
        <form action="" method="post" class="box">

        <div class="company">

            <a href="user_view_profile.php?pid=<?php echo $fetch_job['sender_id']; ?>"><img src="users_img/<?php echo $fetch_job['sender_image']; ?>" alt="" class="image"></a>
            <div> 
                
                <a href="user_view_profile.php?pid=<?php echo $fetch_job['sender_id']; ?>"><?php echo $fetch_job['sender_name']; ?></a>

                <p><span>posted in <?php  echo $fetch_job['realtime'] ?></span></p>

            </div>

        </div>

            <h3 class="details"><?php echo $fetch_job['details']; ?></h3>
            <div class="tags"><p><i class="fa-sharp fa-solid fa-square-phone"></i> <span><?php echo $fetch_job['sender_number']; ?></span></p></div>

        <div class="flex-btn">

            <a href="inbox.php?delete=<?php echo $fetch_job['id']; ?>"  id="delete" class="delete-btn" style="margin: 1rem 4rem;">cancel</a>

        </div>

        </form>
        <?php
        
            }

        }else{
            echo '<p class="empty" style="font-size: 1.5rem; color: red; text-align: center; margin-bottom: 2rem;">there is no requested added!</p>';
        }
        ?>

    </div>

</section>

<!-- section of requested from your offer -->

<section class="jobs-container">

    <h1 class="heading">requested the job</h1>

    <div class="box-container">

        <?php

        $id = $_SESSION['user_id'];

        $select_job = mysqli_query($conn, "SELECT * FROM `chat` WHERE user_id = $id") or die('query failed');
        
        if(mysqli_num_rows($select_job) > 0){

            while($fetch_job = mysqli_fetch_assoc($select_job)){
        ?>
        <form action="" method="post" class="box">

        <div class="company">

            <a href="user_view_profile.php?pid=<?php echo $fetch_job['sender_id']; ?>"><img src="users_img/<?php echo $fetch_job['sender_image']; ?>" alt="" class="image"></a>
            <div> 
                
                <a href="user_view_profile.php?pid=<?php echo $fetch_job['sender_id']; ?>"><?php echo $fetch_job['sender_name']; ?></a>

                <p><span>posted in <?php  echo $fetch_job['realtime'] ?></span></p>

            </div>

        </div>

            <h3 class="details"><?php echo $fetch_job['details']; ?></h3>
            <div class="tags"><p><i class="fa-sharp fa-solid fa-square-phone"></i> <span><?php echo $fetch_job['sender_number']; ?></span></p></div>

        <div class="flex-btn">

            <a href="inbox.php?delete=<?php echo $fetch_job['id']; ?>"  id="delete" class="delete-btn">reject</a>

            <a href="inbox.php?accept=<?php echo $fetch_job['id']; ?>"  id="accept" class="accept-btn">accept</a>

            <a href="response.php?response=<?php echo $fetch_job['id']; ?>"  id="respose" class="respose-btn" style="margin: 1rem 4rem; text-align: center; align-items: center;">response</a>

        </div>

        </form>
        <?php
        
            }

        }else{
            echo '<p class="empty" style="font-size: 1.5rem; color: red; text-align: center; margin-bottom: 2rem;">there is no requested added!</p>';
        }
        ?>

    </div>

</section>



<?php
@include 'footer.php';
?>


</body>
</html>