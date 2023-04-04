<?php
@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login.php');
};

$message[] = 'Note: salary will decrease 5% ..... if you send the message then you accept the terms';

if(isset($_POST['send'])){

    if(isset($_GET['pid'])){
        $pid = $_GET['pid'];
        $select_job = mysqli_query($conn, "SELECT * FROM `job` WHERE id = '$pid'") or die('query failed');

        $fetch_job = mysqli_fetch_assoc($select_job);

        $user_id = $fetch_job['user_id'];

        $user_email = $fetch_job['user_email'];

        $id = $_SESSION['user_id'];

        $name = $_SESSION['user_name'];

        $email = $_SESSION['user_email'];

        $number = $_SESSION['user_number'];

        $image = $_SESSION['user_image'];

        $age = $_SESSION['user_age'];

        $state = $_SESSION['user_state'];

        $country = $_SESSION['user_country'];

        $experience = $_SESSION['user_experience'];

        $cv = $_SESSION['user_cv'];

        $sender_details = $_SESSION['user_details'];

        $sender_job_type = $_SESSION['user_job_type'];

        $realtime = mysqli_real_escape_string($conn, $_POST['realtime']);
        
        $details = mysqli_real_escape_string($conn, $_POST['details']);

        $select_jobs = mysqli_query($conn, "SELECT * FROM `chat` WHERE details = '$details' AND sender_email = '$email'") or die('query failed');


        if(mysqli_num_rows($select_jobs) > 0){
            $message[] = 'already posted';
        }else{

            $insert_job = mysqli_query($conn, "INSERT INTO `chat`(user_id, user_email, sender_id, sender_name, sender_email, sender_number, sender_image, sender_job_type, sender_age, sender_state, sender_country, sender_experience, sender_cv, sender_details, details, realtime) VALUES('$user_id', '$user_email', '$id', '$name', '$email', '$number', '$image', '$sender_job_type', '$age', '$state', '$country', '$experience', '$cv', '$sender_details', '$details', '$realtime')") or die('query failed');
                
                
            if($insert_job){
                $message[] = 'message send successfully';
            }            
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
    <title>apply job page</title>

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

<!-- section of applying to job -->

<section class="apply-job">

    <h3>prove to him why he can choose you</h3>

    <!-- <h3 class="note"><span>* </span> Note: salary will decrease 5% if you send the message then you accept the terms</h3> -->

    <form action="" enctype="multipart/form-data" method="post">

        <div class="form-group">

            <!-- <p>Your name: </p>
            <input type="text" placeholder="enter your name" name="name" id="name" class="output"> -->

        </div>

        <input type="hidden" name="realtime" value="<?php echo $date = date('Y-m-d H:i:s'); ?>" readonly>

        <div class="form-group">

            <p>Make him believe in you</p><br>
            <textarea name="details" class="input" placeholder="" id="details" cols="30" rows="10"></textarea>

        </div>

        <div class="post-btn">

            <input type="submit" class="btn" id="send" name="send" value="submit">

        </div>

    </form>

</section>

    
</body>
</html>