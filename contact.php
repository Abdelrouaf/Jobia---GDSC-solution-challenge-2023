<?php

@include 'config.php';

session_start();

if(isset($_SESSION['user_id'])){

    $user_id = $_SESSION['user_id'];

    if(isset($_POST['send'])){

        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $number = mysqli_real_escape_string($conn, $_POST['number']);
        $mesage = mysqli_real_escape_string($conn, $_POST['message']);
    
    
        $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$mesage'") or die('query failed');
    
        if(mysqli_num_rows($select_message) > 0){
            $message[] = 'message send already';
        }else{
            mysqli_query($conn, "INSERT INTO `message`(user_id, name, email, number, message) VALUES('$user_id', '$name', '$email', '$number', '$mesage')") or die('query failed');
            $message[] = 'message send successfully';
        }
    
    
    }
    
}else{
    if(isset($_POST['send'])){

        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $number = mysqli_real_escape_string($conn, $_POST['number']);
        $mesage = mysqli_real_escape_string($conn, $_POST['message']);
    
    
        $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$mesage'") or die('query failed');
    
        if(mysqli_num_rows($select_message) > 0){
            $message[] = 'message send already';
        }else{
            mysqli_query($conn, "INSERT INTO `message`(name, email, number, message) VALUES('$name', '$email', '$number', '$mesage')") or die('query failed');
            $message[] = 'message send successfully';
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
    <title>contact page</title>

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

<section class="contact">

<!-- section of contact -->

    <form action="" method="post">

        <h3>ask something?</h3>

        <input type="text" name="name" placeholder="enter your name" class="box" required>
        <input type="email" name="email" placeholder="enter your email" class="box" required>
        <input type="number" name="number" placeholder="enter your number" class="box" required>
        <textarea name="message" class="box" placeholder="enter your message" required cols="30" rows="10"></textarea>
        <input type="submit" value="send message" name="send" class="btn">

    </form>

</section>



<?php
@include 'footer.php';
?>
    
</body>
</html>