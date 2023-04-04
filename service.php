<?php

@include 'config.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>service</title>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">

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

<!-- section of the service that the page preduce  -->

<section class="service">

    <div class="flex">

        <div class="image">

            <img src="images/img1.jpg" alt="">

        </div>

        <div class="content">

            <h3 style="margin-top: 1rem;">why choose us?</h3>
            <p>It only takes a few clicks for a job offers to land on a particular job. It takes a little more time for a candidates’ resume to land in a mailbox (there is no geographical limitation).The possibility to edit the job ad in real time – these are just a few reasons why online job applications are so beneficial and time-saving.</p>
            <a href="jobs.php" class="btn" style="text-decoration: none;">see jobs now</a>

        </div>

    </div>

    <div class="flex">

        <div class="content">

            <h3>what we prodvide?</h3>
            <p>Nowadays, more and more digital tools are created to search for employees who might add value to the company. From the employer’s point of view, this undoubtedly facilitates the organization of recruitment processes. It also allows employers to save time and money.</p>
            <a href="contact.php" class="btn" style="text-decoration: none;">contact us</a>

        </div>
        
        <div class="image">

            <img src="images/img2.jpg" alt="">

        </div>

    </div>

    <div class="flex">

        <div class="image">

            <img src="images/homeCover2.jpg" alt="">

        </div>

        <div class="content">

            <h3>who we are?</h3>
            <p>We are a website that helps people to find job opportunities in an easy and fast way until the problem of unemployment is eliminated.</p>
            <a href="#reviews" class="btn" style="text-decoration: none;">clients reviews</a>

        </div>

    </div>

</section>


<section class="reviews" id="reviews">

    <h1 class="title">client's reviews</h1>

    <div class="box-container">

        <?php

            $select_review = mysqli_query($conn, "SELECT * FROM `review`") or die('query failed');
            if(mysqli_num_rows($select_review) > 0){

                while($fetch_review = mysqli_fetch_assoc($select_review)){
        ?>
        <form action="" method="post">

            <div class="box">

            <img src="users_img/<?php echo $fetch_review['user_image']; ?>" alt="" class="image">
                <p><?php echo $fetch_review['user_feedback']; ?></p>
                <div class="stars">

                    <?php

                        $start = 1;
                        while($start <= 5){
                            if($fetch_review['stars'] < $start){
                                ?>
                                <i class="fa-regular fa-star"></i>
                                <?php
                            }else{
                                ?>
                                <i class="fas fa-star"></i>
                                <?php
                            }
                            $start++;
                        }
                        ?>

                    


                </div>

                <h3><?php echo $fetch_review['user_name']; ?></h3>

            </div>

        </form>

        <?php
        
            }

        }else{
            echo '<p class="empty" style="font-size: 1.5rem; color: red; text-align: center; margin-bottom: 2rem;">no reviews yet!</p>';
        }
        ?>
    
    </div>

</section>


<?php @include 'footer.php'; ?>




<script src="script.js"></script>

    
</body>
</html>