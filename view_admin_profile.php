<?php
@include 'config.php';

session_start();



$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:home.php');
};



if(isset($_POST['submit'])){

    $user_id = $_SESSION['admin_id'];

    $image = $_FILES["fileImage"]["name"];
    $src = $_FILES["fileImage"]["tmp_name"];
    $imageName = uniqid().$image;

    $target = "users_img/".$imageName;

    move_uploaded_file($src, $target);

    $file_pointer = "users_img/".$_SESSION['admin_image'];
  
    // Use unlink() function to delete a file
    if (!unlink($file_pointer)) {
        echo ("$file_pointer cannot be deleted due to an error");
    }
    else {
        echo ("$file_pointer has been deleted");
    }

    $query = mysqli_query($conn, "UPDATE `users` SET image = '$imageName' WHERE id = $user_id") or die('query failed');
    $select_users = mysqli_query($conn, "SELECT * FROM `users`WHERE id = '$user_id'") or die('query failed');
    $row = mysqli_fetch_assoc($select_users);
    $_SESSION['admin_id'] = $row['id'];
    $_SESSION['admin_name'] = $row['name'];
    $_SESSION['admin_email'] = $row['email'];
    $_SESSION['admin_password'] = $row['password'];
    $_SESSION['admin_number'] = $row['number'];
    $_SESSION['admin_state'] = $row['state'];
    $_SESSION['admin_country'] = $row['country'];
    $_SESSION['admin_image'] = $row['image'];
    $_SESSION['admin_age'] = $row['age'];
    $_SESSION['admin_details'] = $row['details'];
    $_SESSION['admin_experience'] = $row['experience'];
    $_SESSION['admin_cv'] = $row['cv'];
    $_SESSION['admin_job_type'] = $row['job_type'];
    header('location:view_admin_profile.php');
};


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin page</title>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="admin_style.css">
    <script src="admin_script.js" defer></script>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

</head>
<body>

<?php
@include 'admin_header.php';

?>

<!-- section of view admin profile  -->

<section class="profile">

    <h3 class="title">view profile</h3>

    <div class="box-container">        

        <form action="" method="post" enctype="multipart/form-data">

        <div class="upload">

            <img src="users_img/<?php echo $_SESSION['admin_image']; ?>" alt="" id="image" name="image" class="image">

            <div class="rightRound" id="upload">

                <input type="file" accept=".png, .jpg, .jpeg"  id="fileImage" name="fileImage">
                <i class="fa fa-camera"></i>

            </div>

            <div class="leftRound" id="cancel" style="display: none;">

                <i class="fa fa-times"></i>

            </div>

            <div class="rightRound" id="confirm" style="display: none;">

                <input type="submit" name="submit" id="submit" class="btn_done" value="submit">

                <i class="fa fa-check"></i>

            </div>

        </div>

            <div class="form-group">

                <h3 class="name"><?php echo $_SESSION['admin_name']; ?></h3>

            </div>

            <div class="box">

                <div class="form-group">

                    <label for="age">age</label>
                    <h3><?php echo $_SESSION['admin_age']; ?></h3>

                </div>

                <div class="form-group">

                    <label for="state">state</label>
                    <h3><?php echo $_SESSION['admin_state']; ?></h3>

                </div>

                <div class="form-group">

                        <label for="country">Country</label>
                        <h3><?php echo $_SESSION['admin_country']; ?></h3>    
    
                </div>

            </div>

            <div class="flex-btn">

                <a href="edit_admin_profile.php" class="btn">edit profile</a>

            </div>

        </form>

    </div>


</section>


<?php
@include 'footer.php';
?>


<script>

document.getElementById("fileImage").onchange = function(){
    document.getElementById("image").src = URL.createObjectURL(fileImage.files[0]);

    document.getElementById("cancel").style.display = "block";
    document.getElementById("confirm").style.display = "block";

    document.getElementById("upload").style.display = "none";

}

var userImage = document.getElementById('image').src;

document.getElementById("cancel").onclick = function(){
    document.getElementById("image").src = userImage;

    document.getElementById("cancel").style.display = "none";
    document.getElementById("confirm").style.display = "none";

    document.getElementById("upload").style.display = "block";

}

</script>
    
</body>
</html>