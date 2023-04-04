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

}else{
    if((isset($_POST['save_job']) && !isset($_SESSION['user_id']))){
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
    <title>all jobs page</title>

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

<!-- section of all jobs posted -->

<section class="jobs-container">

    <h1 class="heading">all jobs you interested in</h1>

    <div class="box-container">

        <?php

        $select_job = mysqli_query($conn, "SELECT * FROM `job`") or die('query failed');
        if(mysqli_num_rows($select_job) > 0){

            while($fetch_job = mysqli_fetch_assoc($select_job)){
        ?>
        <form action="" method="post" class="box">

            <div class="company">

            <a href="view_company.php?pid=<?php echo $fetch_job['user_id']; ?>" name="company" id="company" class="company"><img src="uploaded_img/<?php echo $fetch_job['image']; ?>" alt="" class="image"></a>
                <div> 
                    
                    <a href="view_company.php?pid=<?php echo $fetch_job['user_id']; ?>" name="company" id="company" class="company"><?php echo $fetch_job['company']; ?></a>
                    <p><span>posted in <?php  echo $fetch_job['realtime'] ?></span></p>

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
                    <input type="submit" value="save" name="save_job" class="btn">

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