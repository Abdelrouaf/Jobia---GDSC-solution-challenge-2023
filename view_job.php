<?php
@include 'config.php';

session_start();

if(isset($_SESSION['user_id'])){

    $user_id = $_SESSION['user_id'];

    if(isset($_POST['save_job'])){

        $user_id = $_SESSION['user_id'];

        $posted_id = $_POST['useer_id'];

        $company_id = $_POST['id'];

        $company_name = $_POST['company'];

        $company_image = $_POST['image'];

        $realtime = $_POST['realtime'];

        $title = $_POST['title'];

        $city = $_POST['city'];

        $country = $_POST['country'];

        $salary = $_POST['salary'];

        $job_type = $_POST['job_type'];

        $check_save_numbers = mysqli_query($conn, "SELECT * FROM `save_job` WHERE company_id = '$company_id' AND user_id = '$user_id'") or die('query failed');

        if(mysqli_num_rows($check_save_numbers) > 0){
            $message[] = 'already added to your wishlist';
        }else{
            mysqli_query($conn, "INSERT INTO `save_job`(user_id, posted_id, company_id, company_name, company_image, realtime, title, city, country, salary, job_type) VALUES('$user_id', '$posted_id', '$company_id', '$company_name', '$company_image', '$realtime', '$title', '$city', '$country', '$salary', '$job_type')") or die('query failed');
            $message[] = 'job saved';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>job details</title>

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

<!-- section of view jobs details -->

<section class="job-details">

    <h1 class="heading">job details</h1>

    <div class="details">

    <?php
    
        if(isset($_GET['pid'])){
            $pid = $_GET['pid'];
            $select_job = mysqli_query($conn, "SELECT * FROM `job` WHERE id = '$pid'") or die('query failed');
            if(mysqli_num_rows($select_job) > 0){
                while($fetch_job = mysqli_fetch_assoc($select_job)){    
    ?>
    <form action="" method="post" class="box">

        <div class="job-info">

            <a href="view_company.php?pid=<?php echo $fetch_job['user_id']; ?>" name="company" id="company" class="company"><img src="uploaded_img/<?php echo $fetch_job['image']; ?>" alt="" class="image"></a>
            <h3 class="title"><?php echo $fetch_job['title']; ?></h3>
            <a href="view_company.php?pid=<?php echo $fetch_job['user_id']; ?>" name="company" id="company" class="company"><?php echo $fetch_job['company']; ?></a>
            <p class="location"><i class="fas fa-map-marker-alt"></i> <span><?php echo $fetch_job['city']; ?>, <?php echo $fetch_job['country']; ?></span></p>

        </div>

        <div class="basic-details">

            <h3>salary</h3>
            <p><i class="fa-solid fa-dollar-sign"></i> <span><?php echo $fetch_job['salary']; ?></span></p>
            <h3>benefits</h3>
            <p><span><?php echo $fetch_job['benefits']; ?></span></p>
            <h3>job type</h3>
            <p><i class="fas fa-clock"></i> <span><?php echo $fetch_job['job_type']; ?></span></p>

        </div>

        <ul>

            <h3>requirements</h3>
            <li><span><?php echo $fetch_job['requirements']; ?></span></li>

        </ul>

        <ul>

            <h3>qualifications</h3>
            <li><span><?php echo $fetch_job['qualifications']; ?></span></li>

        </ul>

        <ul>

            <h3>skills</h3>
            <li><span><?php echo $fetch_job['skills']; ?></span></li>

        </ul>

        <div class="description">

            <h3>discription of the job</h3>
            <p><span><?php echo $fetch_job['details']; ?></span></p>
            <ul>

                <li><span> posted in <?php echo $fetch_job['realtime']; ?></span></li>

            </ul>

        </div>

        <form action="" class="flex-btn" method="post">

            <a href="apply_job.php?pid=<?php echo $fetch_job['id']; ?>" class="btn">apply now</a>
            <!-- <button type="submit" class="save"><i class="far fa-heart"></i> save job</button> -->
            <div class="save_btn">

                <i class="fa-regular fa-bookmark"></i>
                <input type="submit" value="save_job" name="save_job" id="save_job" class="btn">

            </div>

            <input type="hidden" name="id" id="id" value="<?php echo $fetch_job['id']; ?>">
            <input type="hidden" name="useer_id" id="useer_id" value="<?php echo $fetch_job['user_id']; ?>">
            <input type="hidden" name="title" id="title" value="<?php echo $fetch_job['title']; ?>">
            <input type="hidden" name="company" id="company" value="<?php echo $fetch_job['company']; ?>">
            <input type="hidden" name="city" id="city" value="<?php echo $fetch_job['city']; ?>">
            <input type="hidden" name="country" id="country" value="<?php echo $fetch_job['country']; ?>">
            <input type="hidden" name="salary" id="salary" value="<?php echo $fetch_job['salary']; ?>">
            <input type="hidden" name="image" id="image" value="<?php echo $fetch_job['image']; ?>">
            <input type="hidden" name="job_type" id="job_type" value="<?php echo $fetch_job['job_type']; ?>">
            <input type="hidden" name="realtime" id="realtime" value="<?php echo $fetch_job['realtime']; ?>">


        </form>

    </form>
    <?php
            }

        }else{
        echo '<p class="empty" style="font-size: 1.5rem; color: red; text-align: center; margin-bottom: 2rem;">no jobs details available!</p>';
        }
    }
    
    ?>

    </div>

    <div class="more-btn">

        <a href="home.php" class="btn">go to home page</a>

    </div>

</section>

<?php
@include 'footer.php';
?>
    
</body>
</html>