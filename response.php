<?php
@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login.php');
};


if(isset($_POST['send'])){

    if(isset($_GET['response'])){
        $pid = $_GET['response'];
        $select_job = mysqli_query($conn, "SELECT * FROM `chat` WHERE id = '$pid'") or die('query failed');

        $fetch_job = mysqli_fetch_assoc($select_job);

        $user_id = $fetch_job['sender_id'];

        $user_email = $fetch_job['sender_email'];

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

        $realtime = mysqli_real_escape_string($conn, $_POST['realtime']);
        
        $details = mysqli_real_escape_string($conn, $_POST['details']);

        $select_jobs = mysqli_query($conn, "SELECT * FROM `chat` WHERE details = '$details' AND sender_email = '$email'") or die('query failed');


        if(mysqli_num_rows($select_jobs) > 0){
            $message[] = 'already posted';
        }else{

            $insert_job = mysqli_query($conn, "INSERT INTO `chat`(user_id, user_email, sender_id, sender_name, sender_email, sender_number, sender_image, sender_age, sender_state, sender_country, sender_experience, sender_cv, sender_details, details, realtime) VALUES('$user_id', '$user_email', '$id', '$name', '$email', '$number', '$image', '$age', '$state', '$country', '$experience', '$cv', '$sender_details', '$details', '$realtime')") or die('query failed');
                
                
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
    <title>response page</title>

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

<!-- section of respones about user offer -->

<section class="apply-job">

    <h3>your response</h3>

    <form action="" enctype="multipart/form-data" method="post">

        <div class="form-group">

            <p>Your name: </p>
            <input type="text" placeholder="enter your name" name="name" id="name" class="output">

        </div>

        <input type="hidden" name="realtime" value="<?php echo $date = date('Y-m-d H:i:s'); ?>" readonly>

        <div class="form-group">

            <p>response</p><br>
            <textarea name="details" class="input" placeholder="" id="details" cols="30" rows="10"></textarea>

        </div>

        <div class="post-btn">

            <input type="submit" class="btn" id="send" name="send" value="send">

        </div>

    </form>

</section>

    
</body>
</html>