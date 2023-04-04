<?php
@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:login.php');
};

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `need_job` WHERE id = '$delete_id'") or die('query failed');
    $message[] = 'job delete successfully!';
};


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>all needed jobs page</title>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="admin_style.css">
    <script src="admin_script.js" defer></script>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

</head>
<body>

<?php @include 'admin_header.php'; ?>

<!-- display all jobs posted -->

<section class="jobs-container">

    <h1 class="heading">latest needed jobs</h1>

    <div class="box-container">

        <?php

        $select_job = mysqli_query($conn, "SELECT * FROM `need_job`") or die('query failed');
        if(mysqli_num_rows($select_job) > 0){

            while($fetch_job = mysqli_fetch_assoc($select_job)){
        ?>
        <form action="" method="post" class="box">

            <div class="company">

                <img src="users_img/<?php echo $fetch_job['user_image']; ?>" alt="" class="image">
                <h3><?php echo $fetch_job['user_name']; ?></h3>

            </div>
           
            <div class="title"><?php echo $fetch_job['user_description']; ?></div>
            <p class="location"><i class="fas fa-map-marker-alt"></i> <span><?php echo $fetch_job['user_state']; ?>, <?php echo $fetch_job['user_country']; ?></span></p>
            
            <div class="tags">

                <p><i class="fas fa-clock"></i> <span><?php echo $fetch_job['user_job_type']; ?></span></p>

            </div>

            <div class="flex-btn">

                <a href="admin_view_user_profile_home.php?id=<?php echo $fetch_job['id']; ?>" class="btn">view details</a>
                <a href="admin_need_jobs.php?delete=<?php echo $fetch_job['id']; ?>" onclick="return confirm('delete this job?');" class="delete-btn">delete</a>


            </div>

        </form>
        <?php
        
            }

        }else{
            echo '<p class="empty">no job added yet!</p>';
        }
        ?>

    </div>

</section>


<?php
@include 'footer.php';
?>

</body>
</html>