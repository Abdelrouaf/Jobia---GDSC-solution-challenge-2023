<?php
@include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>search page</title>

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


if(isset($_SESSION['user_id'])){
    @include 'header2.php';
}else{
    @include 'header.php';
}
?>

<!-- section of the search page -->

<section class="job-filter">

    <h1 class="heading">filter jobs</h1>

    <form action="" method="post">   

        <div class="flex">

            <div class="box">

                <p>job title</p>
                <input type="text" class="input" placeholder="jobs you interested in, category or company" name="title" required maxlength="20">

            </div>

        </div>


        <div class="flex">

            <div class="box">

                <p>job location</p>
                <input type="text" class="input" placeholder="select city, state or country" name="location" required maxlength="50">

            </div>

        </div>

        <div class="dropdown-container">

            <div class="dropdown">

                <input type="text" readonly placeholder="date posted" name="realtime" id="realtime" maxlength="20" class="output">

                <div class="lists">

                    <p class="items">today</p>
                    <p class="items">2 days ago</p>
                    <p class="items">3 days ago</p>
                    <p class="items">4 days ago</p>
                    <p class="items">5 days ago</p>
                    <p class="items">7 days ago</p>
                    <p class="items">10 days ago</p>
                    <p class="items">15 days ago</p>

                </div>

            </div>

            <div class="dropdown">

                <input type="text" readonly name="salary" id="salary" placeholder="estimaed salary" maxlength="20" class="output">

                <div class="lists">

                    <p class="items">50</p>
                    <p class="items">60</p>
                    <p class="items">80</p>
                    <p class="items">100</p>
                    <p class="items">120</p>
                    <p class="items">140</p>
                    <p class="items">160</p>
                    <p class="items">180</p>
                    <p class="items">200</p>

                </div>

            </div>

            <div class="dropdown">

                <input type="text" readonly name="job_type" id="job_type" placeholder="job type" maxlength="20" class="output">

                <div class="lists">

                    <p class="items">part-time</p>
                    <p class="items">full-time</p>
                    <p class="items">temparary job</p>
                    <p class="items">contract job</p>

                </div>

            </div>

        </div>

        <input type="submit" class="btn" value="search job" name="search">

    </form>

</section>

<section class="jobs-container" style="padding-top: 1.5rem;">


    <div class="box-container">

        <?php

        if(isset($_POST['search'])){
            $title = mysqli_real_escape_string($conn, $_POST['title']);
            $salary = mysqli_real_escape_string($conn, $_POST['salary']);
            $location = mysqli_real_escape_string($conn, $_POST['location']);
            $job_type = mysqli_real_escape_string($conn, $_POST['job_type']);
        $select_job = mysqli_query($conn, "SELECT * FROM `job` WHERE title LIKE '%{$title}%' AND job_type LIKE '%{$job_type}%' AND salary LIKE '%{$salary}%' AND (city LIKE '%{$location}%' OR country LIKE '%{$location}%')") or die('query failed');
        if(mysqli_num_rows($select_job) > 0){

            while($fetch_job = mysqli_fetch_assoc($select_job)){
        ?>
        <form action="" method="post" class="box">

            <div class="company">

                <img src="uploaded_img/<?php echo $fetch_job['image']; ?>" alt="" class="image">
                <div> 
                    
                    <a href="view_company.php?pid=<?php echo $fetch_job['company']; ?>" class="company"></a>
                    <div class="company"><?php echo $fetch_job['company']; ?></div>

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
                <button type="submit" class="far fa-heart" name="save"></button>

            </div>

        </form>
        <?php
        
        }

            }else{
                echo '<p class="empty" style="font-size: 1.5rem; color: red; text-align: center; margin: 2.5rem;">no result found!</p>';
            }
        }

        ?>

    </div>

</section>

<?php
@include 'footer.php';
?>
    
</body>
</html>