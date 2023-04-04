<?php
@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login.php');
};


if(isset($_POST['submit'])){

    $id = $_SESSION['user_id'];

    $name = $_SESSION['user_name'];
    
    $user_image = $_SESSION['user_image'];

    $stars = mysqli_real_escape_string($conn, $_POST['stars']);
    
    $feedback = mysqli_real_escape_string($conn, $_POST['feedback']);

    $select_jobs = mysqli_query($conn, "SELECT * FROM `review` WHERE user_id = '$id' AND user_feedback = '$feedback'") or die('query failed');

    if(mysqli_num_rows($select_jobs) > 0){
        $message[] = 'already posted';
    }else{

        $insert_job = mysqli_query($conn, "INSERT INTO `review`(user_id, user_name, user_image, user_feedback, stars) VALUES('$id','$name', '$user_image', '$feedback', '$stars')") or die('query failed');
            
        if($insert_job){
                $message[] = 'review posted succesfully!';
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
    <title>review page</title>

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

<!-- section of user feedback -->

<section class="need-job">

    <h3>tell us about your feedback</h3>

    <form action="" enctype="multipart/form-data" method="post">

        <p>your comment</p>
        <textarea name="feedback" class="input" placeholder="description of the your feedback" id="feedback" cols="30" rows="10"></textarea>

        <p>your rate</p>
        <input type="number" id="stars" name="stars" class="box" max="5">

        <div class="post-btn">

            <input type="submit" class="btn" id="submit" name="submit" value="Post">

        </div>

    </form>

</section>

</body>
</html>