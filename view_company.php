<?php
@include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>company page</title>

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

<!-- section of view company about job -->

<section class="view-company">

    <h1 class="heading">company details</h1>

    <div class="details">

        <?php
        
            if(isset($_GET['pid'])){
                $pid = $_GET['pid'];
                $select_job = mysqli_query($conn, "SELECT * FROM `job` WHERE user_id = '$pid' limit 1") or die('query failed');
                if(mysqli_num_rows($select_job) > 0){
                    while($fetch_job = mysqli_fetch_assoc($select_job)){
        ?>

        <form action="" method="post" class="box">

            <div class="info">

                <img src="uploaded_img/<?php echo $fetch_job['image']; ?>" alt="" class="image">
                
                <h3 class="company"><?php echo $fetch_job['company']; ?></h3>
                
            </div>

            <div class="description">

                <h3>about company</h3>
                
                <p><span><?php echo $fetch_job['details']; ?></span></p>

            </div>

            <ul>

                <li>jobs posted</li>
                <li><span><?php echo $fetch_job['about'] ?></span></li>

            </ul>

        </form>
        <?php
                }

            }else{
            echo '<p class="empty" style="font-size: 1.5rem; color: red; text-align: center; margin-bottom: 2rem;">no job details available!</p>';
            }
        }
            
        ?>    

    </div>

</section>


<section class="jobs-container">

    <h1 class="heading">offers of this company</h1>

    <div class="box-container">

        <div class="box">


        <?php
    
            if(isset($_GET['pid'])){
                $pid = $_GET['pid'];
                $select_job = mysqli_query($conn, "SELECT * FROM `job` WHERE user_id = '$pid'") or die('query failed');
                if(mysqli_num_rows($select_job) > 0){
                    while($fetch_job = mysqli_fetch_assoc($select_job)){
        ?>
        <form action="" method="post" class="box">

            <div class="company">

                <img src="uploaded_img/<?php echo $fetch_job['image']; ?>" alt="" class="image">
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
                <button type="submit" class="far fa-heart" name="save"></button>

            </div>

        </form>
        <?php
                }

            }else{
            echo '<p class="empty" style="font-size: 1.5rem; color: red; text-align: center;">no job details available!</p>';
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