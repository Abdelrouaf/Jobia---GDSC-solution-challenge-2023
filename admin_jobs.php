<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:login.php');
};

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `job` WHERE id = '$delete_id'") or die('query failed');
    $message[] = 'job delete successfully!';
};


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>all jobs posted</title>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="admin_style.css">
    <script src="admin_script.js" defer></script>

</head>
<body>

<?php @include 'admin_header.php'; ?>

<!-- display all jobs posted -->

<section class="show-jobs">

    <h1 class="heading">all jobs</h1>

    <div class="box-container">

        <?php

        $select_job = mysqli_query($conn, "SELECT * FROM `job`") or die('query failed');
        if(mysqli_num_rows($select_job) > 0){

            while($fetch_job = mysqli_fetch_assoc($select_job)){
        ?>
        <form action="" method="post" class="box">

            <div class="company">

            <a href="view_company.php?pid=<?php echo $fetch_job['id']; ?>" name="company" id="company" class="company"><img src="uploaded_img/<?php echo $fetch_job['image']; ?>" alt="" class="image"></a>
                <div> 
                    
                    <a href="view_company.php?pid=<?php echo $fetch_job['id']; ?>" name="company" id="company" class="company"><?php echo $fetch_job['company']; ?></a>
                    <p><span>posted in <?php echo $fetch_job['realtime'];?></span></p>

                </div>

            </div>
        
            <div class="title"><?php echo $fetch_job['title']; ?></div>
            <p class="location"><i class="fas fa-map-marker-alt"></i> <span><?php echo $fetch_job['city']; ?>, <?php echo $fetch_job['country']; ?></span></p>
            
            <div class="tags">

                <p><i class="fa-solid fa-dollar-sign"></i> <span><?php echo $fetch_job['salary']; ?></span></p>
                <p><i class="fas fa-clock"></i> <span><?php echo $fetch_job['job_type']; ?></span></p>

            </div>

            <div class="flex-btn">

                <a href="admin_view_job.php?pid=<?php echo $fetch_job['id']; ?>" class="btn">view details</a>
                <a href="admin_jobs.php?delete=<?php echo $fetch_message['id']; ?>" onclick="return confirm('delete this job?');" class="delete-btn">delete</a>

            </div>

        </form>
        <?php
        
            }

        }else{
            echo '<p class="empty">no prooducts added yet!</p>';
        }
        ?>
        

    </div>

</section>


<script src="admin_script.js"></script>

</body>
</html>