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
    if((isset($_POST['save_job']) && !isset($_SESSION['user_id'])) || (isset($_POST['save']) && !isset($_SESSION['user_id']))){
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
    <title>home page</title>

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

<!-- section of home page -->

<section class="home">

    <div class="content">

        <h3>Find your job & make sure goal.</h3>
        <p>your dream job is waiting for you</p> 

        <a href="search_page.php" class="btn">search job</a>
        <a href="review.php" class="btn">your feedback</a>

    </div>

</section>



<!-- section of about page diplaying in home page -->

<?php 
@include 'about.php';
?>

<!-- section of categories -->

<section class="category">

    <h1 class="heading">job categories</h1>

    <div class="box-container">

        <div class="box">

            <i class="fa-solid fa-user-shield"></i>
            <div>

                <h3>Security guard</h3>

            </div>

        </div>

        <div class="box">

            <i class="fas fa-car"></i>

            <div>

                <h3>Driver</h3>

            </div>

        </div>

        <div class="box">

            <i class="bx bx-dish"></i>

            <div>

                <h3>Chef</h3>

            </div>

        </div>

        <div class="box">

            <i class="bx bx-clipboard"></i>

            <div>

                <h3>Waiter</h3>

            </div>

        </div>

        <div class="box">

            <i class="fas fa-house"></i>
            
            <div>

                <h3>Maid</h3>

            </div>

        </div>

        <div class="box">

            <i class="fas fa-camera"></i>
            <div>

                <h3>photographer</h3>

            </div>

        </div>

    </div>

</section>

<!-- section of lasted jobs offered a job -->

<section class="jobs-container">

    <h1 class="heading">jobs you interested in</h1>

    <div class="box-container">

        <?php

        $select_job = mysqli_query($conn, "SELECT * FROM `job` LIMIT 6") or die('query failed');
        if(mysqli_num_rows($select_job) > 0){

            while($fetch_job = mysqli_fetch_assoc($select_job)){
        ?>
        <form action="" method="post" class="box">

            <div class="company">

                <a href="view_company.php?pid=<?php echo $fetch_job['user_id']; ?>" id="company" name="company" class="company"><img src="uploaded_img/<?php echo $fetch_job['image']; ?>" alt="" class="image"></a>
                <div> 
                    
                    <a href="view_company.php?pid=<?php echo $fetch_job['user_id']; ?>" id="company" name="company" class="company"><?php echo $fetch_job['company']; ?></a>
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

                <a href="view_job.php?pid=<?php echo $fetch_job['id']; ?>" class="btn">view details</a>
                <div class="save_btn">

                    <i class="fa-regular fa-bookmark"></i>
                    <input type="submit" value="save_job" name="save_job" id="save_job" class="btn">

                </div>


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
        <?php
        
            }

        }else{
            echo '<p class="empty" style="font-size: 1.5rem; color: red; text-align: center; margin-bottom: 2rem;">no job added yet!</p>';
        }
        ?>

    </div>

    <div class="view_btn" style="text-align: center; margin-top: 2rem;">

        <a href="jobs.php" class="btn" style="text-decoration: none; padding: 1rem 3rem;">view all</a>

    </div>

</section>

<!-- section of lasted jobs who's need job -->

<section class="jobs-container">

    <h1 class="heading">searching for a job</h1>

    <div class="box-container">

        <?php

        $select_job = mysqli_query($conn, "SELECT * FROM `need_job` limit 3") or die('query failed');
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

                <p><span><?php echo $fetch_job['user_job_type']; ?></span></p>

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
            echo '<p class="empty" style="font-size: 1.5rem; color: red; text-align: center; margin-bottom: 2rem;">no job added yet!</p>';
        }
        ?>

    </div>

    <div class="view_btn" style="text-align: center; margin-top: 2rem;">

        <a href="need_jobs.php" class="btn" style="text-decoration: none; margin-bottom: 2rem; padding: 1rem 3rem;">view all</a>

    </div>

</section>

<?php
@include 'footer.php';
?>
    
</body>
</html>