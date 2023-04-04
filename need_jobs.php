<?php
@include 'config.php';

session_start();

if(isset($_SESSION['user_id'])){

    $user_id = $_SESSION['user_id'];

    if(isset($_POST['save'])){

        $user_id = $_SESSION['user_id'];

        $posted_id = $_POST['id'];

        $user_name = $_POST['user_name'];

        $user_image = $_POST['user_image'];

        $user_job_type = $_POST['user_job_type'];

        $user_state = $_POST['user_state'];

        $user_country = $_POST['user_country'];

        $user_description = $_POST['user_description'];

        $realtime = $_POST['realtime'];

        $check_save_numbers = mysqli_query($conn, "SELECT * FROM `save` WHERE posted_id = '$posted_id' AND user_id = '$user_id'") or die('query failed');

        if(mysqli_num_rows($check_save_numbers) > 0){
            $message[] = 'already added to your wishlist';
        }else{
            mysqli_query($conn, "INSERT INTO `save`(posted_id, user_id, user_name, user_image, user_job_type, user_state, user_country, user_description, realtime) VALUES('$posted_id', '$user_id', '$user_name', '$user_image', '$user_job_type', '$user_state', '$user_country', '$user_description', '$realtime')") or die('query failed');
            $message[] = 'job saved';
        }

    }
}else{
    if((isset($_POST['save']) && !isset($_SESSION['user_id']))){
        header('location:login.php');
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jobs needed page</title>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

</head>
<body>

<?php

if(isset($_SESSION['user_id'])){
    @include 'header2.php';
}else{
    @include 'header.php';
}

?>

<!-- section of posted jobs user need -->

<section class="jobs-container">

    <h1 class="heading">searching for a job</h1>

    <div class="box-container">

        <?php

        $select_job = mysqli_query($conn, "SELECT * FROM `need_job`") or die('query failed');
        if(mysqli_num_rows($select_job) > 0){

            while($fetch_job = mysqli_fetch_assoc($select_job)){
        ?>
        <form action="" method="post" class="box">

            <div class="company">

                <a href="user_view_profile_home.php?id=<?php echo $fetch_job['id']; ?>"><img src="users_img/<?php echo $fetch_job['user_image']; ?>" alt="" class="image"></a>
                
                <div>

                    <h3><?php echo $fetch_job['user_name']; ?></h3>

                    <p><span>posted in <?php  echo $fetch_job['realtime'] ?></span></p>

                </div>

            </div>
           
            <div class="title"><?php echo $fetch_job['user_description']; ?></div>
            <p class="location"><i class="fas fa-map-marker-alt"></i> <span><?php echo $fetch_job['user_state']; ?>, <?php echo $fetch_job['user_country']; ?></span></p>
            
            <div class="tags">

                <p>job type: <span><?php echo $fetch_job['user_job_type']; ?></span></p>

            </div>

            <div class="flex-btn">

                <a href="user_view_profile_home.php?id=<?php echo $fetch_job['id']; ?>">view details</a>
                <div class="save_btn">

                    <i class="fa-regular fa-bookmark"></i>
                    <input type="submit" value="save" name="save" class="btn">

                </div>

            </div>

            <input type="hidden" name="id" id="id" value="<?php echo $fetch_job['id']; ?>">
            <input type="hidden" name="user_id" id="user_id" value="<?php echo $fetch_job['user_id']; ?>">
            <input type="hidden" name="user_name" id="user_name" value="<?php echo $fetch_job['user_name']; ?>">
            <input type="hidden" name="user_image" id="user_image" value="<?php echo $fetch_job['user_image']; ?>">
            <input type="hidden" name="user_job_type" id="user_job_type" value="<?php echo $fetch_job['user_job_type']; ?>">
            <input type="hidden" name="user_state" id="user_state" value="<?php echo $fetch_job['user_state']; ?>">
            <input type="hidden" name="user_country" id="user_country" value="<?php echo $fetch_job['user_country']; ?>">
            <input type="hidden" name="user_description" id="user_description" value="<?php echo $fetch_job['user_description']; ?>">
            <input type="hidden" name="realtime" id="realtime" value="<?php echo $fetch_job['realtime']; ?>">

        </form>
        <?php
        
            }

        }else{
            echo '<p class="empty" style="font-size: 1.5rem; color: red; text-align: center; margin-bottom: 2rem;">no jobs added yet!</p>';
        }
        ?>

    </div>

</section>

<?php
@include 'footer.php';
?>
    
</body>
</html>