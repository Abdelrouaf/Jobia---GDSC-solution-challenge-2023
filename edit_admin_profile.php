<?php
@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
    header('location:home.php');
};

if(isset($_POST['done'])){

    $user_id = $_SESSION['user_id'];

    $email = $_SESSION['user_email'];

    $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
    $pass = mysqli_real_escape_string($conn, $filter_pass);

    $filter_cpass = filter_var($_POST['cpass'], FILTER_SANITIZE_STRING);
    $cpass = mysqli_real_escape_string($conn, $filter_cpass);

    $number = mysqli_real_escape_string($conn, $_POST['number']);
    
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    
    $state = mysqli_real_escape_string($conn, $_POST['state']);

        if($pass != $cpass){

            $message[] = 'confirm password not matched!';

        }elseif(!empty($_POST["pass"]) && ($_POST["pass"] == $_POST["cpass"])) {

            $password = test_input($_POST["pass"]);
            $cpassword = test_input($_POST["cpass"]);
            if (strlen($_POST["pass"]) <= '8') {
                $message[] = "Your Password Must Contain At Least 8 Characters!";
            }
            elseif(!preg_match("#[0-9]+#",$password)) {
                $message[] = "Your Password Must Contain At Least 1 Number!";
            }
            elseif(!preg_match("#[A-Z]+#",$password)) {
                $message[] = "Your Password Must Contain At Least 1 Capital Letter!";
            }
            elseif(!preg_match("#[a-z]+#",$password)) {
                $message[] = "Your Password Must Contain At Least 1 Lowercase Letter!";
            } 
            else{
                $insert_job = mysqli_query($conn, "UPDATE `users` SET number = '$number', password = '$pass', state = '$state', age = '$age' WHERE id = $user_id") or die('query failed');
                if($insert_job){
                        header('location:view_profile.php');
                        $message[] = 'error!';

                    } 
                }  
        }
        }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin edit profile page</title>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="admin_style.css">
    <script src="script.js" defer></script>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

</head>
<body>

<?php
@include 'admin_header.php';

?>

<!-- section of edti admin profile -->

<section class="profile">

    <h3 class="title">edit profile</h3>

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

            <div class="edit">

                <div class="form-group">

                    <label for="phone_number">change phone number: </label>
                    <input type="number" name="number" id="number" class="box" value="<?php echo $_SESSION['admin_number']; ?>" >
                    <br>

                </div>

                <div class="form-group">

                    <label for="password">change Password: </label>
                    <input type="password" name="pass" id="pass" class="box" placeholder="change your password">
                    <br>

                </div>

                <div class="form-group">

                    <label for="cpass">Confirm password: </label>
                    <input type="password" name="cpass" id="cpass" class="box" placeholder="confirm your password">
                    <br>

                </div>

                <div class="form-group">

                    <label for="age">update your age: </label>
                    <input type="number" id="age" placeholder="update your age" name="age" class="box" value="<?php echo $_SESSION['admin_age']; ?>" >
                    <br>

                </div>

                <div class="form-group">

                    <label for="state">change state: </label>
                    <input type="text" id="state" placeholder="change to your current state" name="state" class="box" value="<?php echo $_SESSION['admin_state']; ?>" >
                    <br>

                </div>

                <div class="btns">

                    <div class="flex-btn">

                        <a href="view_profile.php" class="btn_cancel">Cancel</a>

                        <input type="submit" class="btn_done" id="done" name="done" value="submit">

                    </div>

                </div> 

            </div>

        </form>

    </div>

</section>



<?php
@include 'footer.php';
?>


</body>
</html>