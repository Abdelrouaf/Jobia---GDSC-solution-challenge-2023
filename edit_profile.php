<?php
@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
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

    $details = mysqli_real_escape_string($conn, $_POST['details']);

    $experience = mysqli_real_escape_string($conn, $_POST['experience']);

    $job_type = mysqli_real_escape_string($conn, $_POST['job_type']);

    $cv = $_FILES["cv"]["name"];
    $src = $_FILES["cv"]["tmp_name"];
    $cvName = uniqid().$cv;

    $target = "uploaded_cv/".$cvName;

    move_uploaded_file($src, $target);

    $file_pointer = "uploaded_cv/".$_SESSION['user_cv'];
  
    // Use unlink() function to delete a file
    if (!unlink($file_pointer)) {
        echo ("$file_pointer cannot be deleted due to an error");
    }
    else {
        echo ("$file_pointer has been deleted");
    }

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
                $insert_job = mysqli_query($conn, "UPDATE `users` SET number = '$number', password = '$pass', state = '$state', age = '$age', experience = '$experience', cv = '$cv', details = '$details', job_type = '$job_type'  WHERE id = $user_id") or die('query failed');
                if($insert_job){
                        move_uploaded_file($src, $target);
                        header('location:view_profile.php');
                        $message[] = 'profile updated successfully!';
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

    $select_users = mysqli_query($conn, "SELECT * FROM `users`WHERE id = '$user_id'") or die('query failed');
    $row = mysqli_fetch_assoc($select_users);
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['user_name'] = $row['name'];
    $_SESSION['user_email'] = $row['email'];
    $_SESSION['user_password'] = $row['password'];
    $_SESSION['user_number'] = $row['number'];
    $_SESSION['user_state'] = $row['state'];
    $_SESSION['user_country'] = $row['country'];
    $_SESSION['user_image'] = $row['image'];
    $_SESSION['user_age'] = $row['age'];
    $_SESSION['user_details'] = $row['details'];
    $_SESSION['user_experience'] = $row['experience'];
    $_SESSION['user_cv'] = $row['cv'];
    $_SESSION['user_job_type'] = $row['job_type'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user edit profile page</title>

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

<!-- section of edit user profile -->

<section class="profile">

    <h3 class="title">edit profile</h3>

    <div class="box-container">        

        <form action="" method="post" enctype="multipart/form-data">

            <div class="form-group">

                <h3 class="name"><?php echo $_SESSION['user_name']; ?></h3>

            </div>

            <div class="edit">

                <div class="form-group">

                    <label for="phone_number">change phone number: </label>
                    <input type="number" name="number" id="number" class="box" value="<?php echo $_SESSION['user_number']; ?>">
                    <br>

                </div>

                <div class="form-group">

                    <label for="password"><span style="color: red;">* </span> change Password: </label>
                    <input type="password" name="pass" id="pass" class="box" placeholder="change your password" required>
                    <br>

                </div>

                <div class="form-group">

                    <label for="cpass"><span style="color: red;">* </span>Confirm password: </label>
                    <input type="password" name="cpass" id="cpass" class="box" placeholder="confirm your password" required>
                    <br>

                </div>

                <div class="form-group">

                    <label for="age">update your age: </label>
                    <input type="number" id="age" placeholder="update your age" name="age" class="box" value="<?php echo $_SESSION['user_age']; ?>" >
                    <br>

                </div>

                <div class="form-group">

                    <label for="state">change state: </label>
                    <input type="text" id="state" placeholder="change to your current state" name="state" class="box" value="<?php echo $_SESSION['user_state']; ?>" >
                    <br>

                </div>

                <div class="form-group">

                    <div class="dropdown">

                        <label for="details">change your current job: </label>
                        <input type="text" readonly name="job_type" id="job_type" value="<?php echo $_SESSION['user_job_type'] ?>" maxlength="20" class="output" style="background: beige;">

                        <div class="lists">

                            <p class="items">Security Guard</p>
                            <p class="items">Driver</p>
                            <p class="items">Chef</p>
                            <p class="items">Waiter</p>
                            <p class="items">Maid</p>
                            <p class="items">Photographer</p>

                        </div>

                    </div>
                    <br>

                </div>

                <div class="form-group">

                    <label for="age">update your total work: </label>
                    <input type="number" id="experience" placeholder="update your total experience" name="experience" class="box" value="<?php echo $_SESSION['user_experience']; ?>" >
                    <br>

                </div>

                <div class="form-group">

                    <label for="details">update your CV</label>
                    <input type="file" name="cv" id="cv" class="box" value="attch a file">
                    <br>

                </div>

                <div class="form-group">

                    <label for="details">update your skills: </label>
                    <input name="details" id="details" class="box"  cols="20" rows="15" value="<?php echo $_SESSION['user_details']  ?>"></input>
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

<script>

function myFunction() {
  var x = document.getElementById("pass");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

function myFunction() {
  var x = document.getElementById("cpass");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

	jQuery(document).on("click",".fa-regular.fa-eye-slash",function(){
		jQuery(this).toggleClass("active");
		var input=jQuery(this).parent().find("input");
		if(input.attr("type")=="text")
			input.attr("type","password");
		else
			input.attr("type","text");
	});

</script>

</body>
</html>