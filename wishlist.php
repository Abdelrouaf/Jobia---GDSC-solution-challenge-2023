<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login.php');
};

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `save_job` WHERE id = '$delete_id'") or die('query failed');
    $message[] = 'job deleted from wishlist successfully';
};

if(isset($_GET['delete_all'])){
    mysqli_query($conn, "DELETE FROM `save_job` WHERE user_id = '$user_id'") or die('query failed');
    $message[] = 'all jobs deleted from wishlist successfully';
};

if(isset($_GET['delete_job'])){
    $delete_id = $_GET['delete_job'];
    mysqli_query($conn, "DELETE FROM `save` WHERE id = '$delete_id'") or die('query failed');
    $message[] = 'job deleted from wishlist successfully';
};

if(isset($_GET['delete_all_more_jobs'])){
    mysqli_query($conn, "DELETE FROM `save` WHERE user_id = '$user_id'") or die('query failed');
    $message[] = 'all jobs deleted from wishlist successfully';
};



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>wishlist</title>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">

</head>
<body>

<?php @include 'header2.php'; ?>

<!-- display all jobs in wishlist -->

<section class="jobs-container">

    <h1 class="heading">jobs added</h1>

    <div class="box-container">

        <?php

        $select_save = mysqli_query($conn, "SELECT * FROM `save_job` WHERE user_id = '$user_id'") or die('query failed');

        if(mysqli_num_rows($select_save) > 0){
            while($fetch_save = mysqli_fetch_assoc($select_save)){
        ?>
        <form action="" method="post" class="box">

            <a href="wishlist.php?delete=<?php echo $fetch_save['id']; ?>" class="fas fa-times" onclick="return confirm('delete this from wishlist?');"></a>
            <div class="company">

                <a href="view_company.php?pid=<?php echo $fetch_save['posted_id']; ?>" id="company" name="company" class="company"><img src="uploaded_img/<?php echo $fetch_save['company_image']; ?>" alt="" class="image"></a>
                <div> 
                    
                    <a href="view_company.php?pid=<?php echo $fetch_save['posted_id']; ?>" id="company" name="company" class="company"><?php echo $fetch_save['company_name']; ?></a>
                    <p><span>posted in <?php echo $fetch_save['realtime'];?></span></p>

                </div>

            </div>
           
            <div class="title"><?php echo $fetch_save['title']; ?></div>
            <p class="location"><i class="fas fa-map-marker-alt"></i> <span><?php echo $fetch_save['city']; ?>, <?php echo $fetch_save['country']; ?></span></p>
            
            <div class="tags">

                <p><i class="fa-solid fa-dollar-sign"></i> <span><?php echo $fetch_save['salary']; ?></span></p>
                <p><i class="fas fa-clock"></i> <span><?php echo $fetch_save['job_type']; ?></span></p>

            </div>

            <div class="flex-btn">

                <a href="view_job.php?pid=<?php echo $fetch_save['company_id']; ?>" class="btn">view details</a>

            </div>

            <input type="hidden" name="id" id="id" value="<?php echo $fetch_job['id']; ?>">
            <input type="hidden" name="title" id="title" value="<?php echo $fetch_job['title']; ?>">
            <input type="hidden" name="company" id="company" value="<?php echo $fetch_job['company']; ?>">
            <input type="hidden" name="city" id="city" value="<?php echo $fetch_job['city']; ?>">
            <input type="hidden" name="country" id="country" value="<?php echo $fetch_job['country']; ?>">
            <input type="hidden" name="salary" id="salary" value="<?php echo $fetch_job['salary']; ?>">
            <input type="hidden" name="image" id="image" value="<?php echo $fetch_job['image']; ?>">
            <input type="hidden" name="job_type" id="job_type" value="<?php echo $fetch_job['job_type']; ?>">
            <input type="hidden" name="realtime" id="realtime" value="<?php echo $fetch_job['realtime']; ?>">

        </form>
        <?php
            }
        }else{
            echo '<p class="empty" style="font-size: 1.5rem; color: red; text-align: center; margin-bottom: 2rem;">your wishlist is empty</p>';
        }
        ?>

    </div> 
    
    <div class="wishlist-btn">

        <a href="wishlist.php?delete_all" class="btn" onclick="return confirm('delete all from wishlist?');">delete all</a>

    </div>

</section>

<!-- display all more jobs in wishlist -->

<section class="jobs-container">

    <h1 class="heading">more jobs added</h1>

    <div class="box-container">

        <?php

        $select_save = mysqli_query($conn, "SELECT * FROM `save` WHERE user_id = '$user_id'") or die('query failed');

        if(mysqli_num_rows($select_save) > 0){
            while($fetch_save = mysqli_fetch_assoc($select_save)){
        ?>
        <form action="" method="post" class="box">

        <a href="wishlist.php?delete_job=<?php echo $fetch_save['id']; ?>" class="fas fa-times" onclick="return confirm('delete this from wishlist?');"></a>

        <div class="company">

            <a href="user_view_profile_home.php?id=<?php echo $fetch_save['posted_id']; ?>"><img src="users_img/<?php echo $fetch_save['user_image']; ?>" alt="" class="image"></a>
            
            <div>

                <h3><?php echo $fetch_save['user_name']; ?></h3>

                <p><span>posted in <?php  echo $fetch_save['realtime'] ?></span></p>

            </div>

        </div>

        <div class="title"><?php echo $fetch_save['user_description']; ?></div>
        <p class="location"><i class="fas fa-map-marker-alt"></i> <span><?php echo $fetch_save['user_state']; ?>, <?php echo $fetch_save['user_country']; ?></span></p>

        <div class="tags">

            <p> <span><?php echo $fetch_save['user_job_type']; ?></span></p>

        </div>

        <div class="flex-btn">

            <a href="user_view_profile_home.php?id=<?php echo $fetch_save['posted_id']; ?>">view details</a>

        </div>

        <input type="hidden" name="id" id="id" value="<?php echo $fetch_save['id']; ?>">
        <input type="hidden" name="user_id" id="user_id" value="<?php echo $fetch_save['user_id']; ?>">
        <input type="hidden" name="user_name" id="user_name" value="<?php echo $fetch_save['user_name']; ?>">
        <input type="hidden" name="user_image" id="user_image" value="<?php echo $fetch_save['user_image']; ?>">
        <input type="hidden" name="user_job_type" id="user_job_type" value="<?php echo $fetch_save['user_job_type']; ?>">
        <input type="hidden" name="user_state" id="user_state" value="<?php echo $fetch_save['user_state']; ?>">
        <input type="hidden" name="user_country" id="user_country" value="<?php echo $fetch_save['user_country']; ?>">
        <input type="hidden" name="user_description" id="user_description" value="<?php echo $fetch_save['user_description']; ?>">
        <input type="hidden" name="realtime" id="realtime" value="<?php echo $fetch_save['realtime']; ?>">

        </form>
        <?php
            }
        }else{
            echo '<p class="empty" style="font-size: 1.5rem; color: red; text-align: center; margin-bottom: 2rem;">your wishlist is empty</p>';
        }
        ?>

    </div> 
    
    <div class="wishlist-btn">

        <a href="wishlist.php?delete_all_more_jobs" class="btn" onclick="return confirm('delete all from wishlist?');">delete all</a>

    </div>

</section>







<?php @include 'footer.php'; ?>




<script src="script.js"></script>

    
</body>
</html>