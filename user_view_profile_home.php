<?php
@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user page</title>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

</head>
<body>

<?php
@include 'header2.php';

?>

<!-- section of view user profile linked with section of need_job -->

<section class="profile">

    <h3 class="title">view profile</h3>

    <div class="box-container">   
        
        <?php
            if(isset($_GET['id'])){
                $id = $_GET['id'];

                $select_job = mysqli_query($conn, "SELECT * FROM `need_job` WHERE id = '$id'") or die('query failed');
                if(mysqli_num_rows($select_job) > 0){

                    while($fetch_job = mysqli_fetch_assoc($select_job)){
        ?>

        <form action="" method="post" enctype="multipart/form-data">

            <div class="imgBox">

                <img src="users_img/<?php echo $fetch_job['user_image']; ?>" alt="" class="image">

            </div>

            <div class="form-group">

                <h3 class="name"><?php echo $fetch_job['user_name']; ?></h3>

            </div>

            <div class="box">

                <h3 class="title">basics</h3>

                <div class="form-group">

                    <label for="age">age</label>
                    <h3><?php echo $fetch_job['user_age']; ?></h3>

                </div>

                <div class="form-group">

                    <label for="state">state</label>
                    <h3><?php echo $fetch_job['user_state']; ?></h3>

                </div>

                <div class="form-group">

                    <label for="country">Country</label>
                    <h3><?php echo $fetch_job['user_country']; ?></h3>    
    
                </div>

            </div>

            <div class="box">

                <h3 class="title">work experience</h3>

                <div class="form-group">

                    <label for="work">total work</label>
                    <h3><?php echo $fetch_job['user_experience']; ?></h3>

                </div>

                <div class="form-group">

                    <label for="work">job_type</label>
                    <h3><?php echo $_SESSION['user_job_type']; ?></h3>

                </div>

                <div class="form-group">

                    <label for="work">description</label>
                    <h3><?php echo $fetch_job['user_description']; ?></h3>

                </div>

                <div class="form-group">

                    <label for="cv">CV</label><br><br>
                    <?php 
                        if($fetch_job['user_cv']==''){
                    ?>
                    <h3>there is no cv</h3>
                    <?php 
                        } else{
                    ?>
                        <embed src="uploaded_cv/<?php echo $fetch_job['user_cv']; ?>" width="800" height="500" style="margin-left: 10rem;"><br>
                        <?php } ?>      

                </div>

                <div class="form-group">

                    <label for="skills">skills</label>
                    <h3><?php echo $fetch_job['user_details']; ?></h3>    
    
                </div>

            </div>

        </form>

        <?php
        }
        
                }

            }else{
                echo '<p class="empty" style="font-size: 1.5rem; color: red; text-align: center; margin-bottom: 2rem;">no profile details available!</p>';

            }
        ?>


    </div>


</section>


<?php
@include 'footer.php';
?>
    
</body>
</html>