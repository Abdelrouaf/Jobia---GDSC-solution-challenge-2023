<?php

@include 'config.php';

session_start();

$user_email = $_SESSION['user_email'];

if(!isset($user_email)){
    header('location:login.php');
};

if(isset($_POST['send'])){

    $mesage = mysqli_real_escape_string($conn, $_POST['message']);


    $select_message = mysqli_query($conn, "SELECT * FROM `support` WHERE user_email = '$user_email' AND message = '$mesage'") or die('query failed');

    if(mysqli_num_rows($select_message) > 0){
        $message[] = 'message send already';
    }else{
        mysqli_query($conn, "INSERT INTO `support`(user_email, message) VALUES('$user_email', '$mesage')") or die('query failed');
        $message[] = 'message send successfully';
    }


}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>support page</title>

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

<!-- section of the support page -->

<section class="contact">

    <form action="" method="post">

        <h3>how can we help you?</h3>

        <textarea name="message" id="message" class="box" placeholder="enter your message" required cols="30" rows="10"></textarea>
        <input type="submit" value="send message" name="send" class="btn">

    </form>

</section>



<?php
@include 'footer.php';
?>
    
</body>
</html>