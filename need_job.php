<?php
@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login.php');
};

$message[] = 'Note: salary will decrease 5% ... if you take a job then you accept the terms';

if(isset($_POST['submit'])){

    $id = $_SESSION['user_id'];

    $name = $_SESSION['user_name'];

    $email = $_SESSION['user_email'];
    
    $user_image = $_SESSION['user_image'];

    $job_type = mysqli_real_escape_string($conn, $_POST['user_job_type']);

    $user_image = $_SESSION['user_image'];

    $details = $_SESSION['user_details'];

    $state = $_SESSION['user_state'];

    $country = $_SESSION['user_country'];
    
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $user_id = $_SESSION['user_id'];

    $realtime = mysqli_real_escape_string($conn, $_POST['realtime']);


    $select_jobs = mysqli_query($conn, "SELECT * FROM `need_job` WHERE user_email = '$email' AND user_description = '$description'") or die('query failed');

    if(mysqli_num_rows($select_jobs) > 0){
        $message[] = 'already posted';
    }else{

        $insert_job = mysqli_query($conn, "INSERT INTO `need_job`(user_id, user_name, user_email, user_image, user_job_type, user_details, user_state, user_country, user_description, realtime) VALUES('$user_id', '$name', '$email', '$user_image', '$job_type', '$details', '$state', '$country', '$description', '$realtime')") or die('query failed');
            
        if($insert_job){
                    $message[] = 'job posted successfully!';
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
    <title>need a job page</title>

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

<!-- section of post job user need -->

<section class="need-job">

    <h3>tell us about your project</h3>

    <!-- <h3 class="note"><span>* </span> Note: salary will decrease 5% if you take a job then you accept the terms</h3> -->

    <form action="" enctype="multipart/form-data" method="post">

        <div class="upload">

            <img src="users_img/<?php echo $_SESSION['user_image'] ?>" alt="" id="image" name="image" class="image">

        </div>

        <p>job_type</p>
        <input type="text" required  class="input" id="user_job_type" name="user_job_type" value="<?php echo $_SESSION['user_job_type']; ?>">
  
        <!-- <p>skills</p>
        <input type="text"  class="input" id="skills" name="skills" value="<?php echo $_SESSION['user_details']; ?>">
        
        <p>city or state</p>
        <input type="text" class="input" id="city" name="city" value="<?php echo $_SESSION['user_state']; ?>" placeholder="where is the city of your job" required>
        
        <p>country</p> 
        <input type="text" class="input" id="country" name="country" value="<?php echo $_SESSION['user_country']; ?>" placeholder="where is the country of your job" required> -->
        
        
        <input type="hidden" name="realtime" value="<?php echo $date = date('Y-m-d H:i:s'); ?>" readonly>

        <p>description of the job you need</p>
        <textarea name="description" class="input" placeholder="describe your project" id="description" cols="30" rows="10"></textarea>

        <div class="post-btn">

            <input type="submit" class="btn" id="submit" name="submit" value="Post">

        </div>


    </form>

</section>

</body>
</html>