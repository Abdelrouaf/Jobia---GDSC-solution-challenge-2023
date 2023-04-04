<?php
@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login.php');
};

$message[] = 'Note: salary will decrease 5% ... if you take a job then you accept the terms';

if(isset($_POST['submit'])){


    $image = $_FILES["image"]["name"];
    $image_size = $_FILES["image"]["size"];
    $image_tmp_name = $_FILES["image"]["tmp_name"];
    $image_upload = "uploaded_img/".$image;

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    
    $details = mysqli_real_escape_string($conn, $_POST['details']);

    $about = mysqli_real_escape_string($conn, $_POST['about']);
    
    $company = mysqli_real_escape_string($conn, $_POST['company']);

    $country = mysqli_real_escape_string($conn, $_POST['country']);

    $city = mysqli_real_escape_string($conn, $_POST['city']);

    $salary = mysqli_real_escape_string($conn, $_POST['salary']);

    $realtime = mysqli_real_escape_string($conn, $_POST['realtime']);

    $job_type = mysqli_real_escape_string($conn, $_POST['job_type']);

    $benefits = mysqli_real_escape_string($conn, $_POST['benefits']);

    $requirements = mysqli_real_escape_string($conn, $_POST['requirements']);

    $qualifications = mysqli_real_escape_string($conn, $_POST['qualifications']);

    $skills = mysqli_real_escape_string($conn, $_POST['skills']);


    $select_jobs = mysqli_query($conn, "SELECT * FROM `job` WHERE title = '$title' AND company = '$company' AND details = '$details'") or die('query failed');


    if(mysqli_num_rows($select_jobs) > 0){
        $message[] = 'already posted';
    }else{

        $insert_job = mysqli_query($conn, "INSERT INTO `job`(title, company, city, salary, job_type, benefits, details, country, image, requirements, qualifications, skills, realtime, about) VALUES('$title','$company','$city', '$salary','$job_type', '$benefits', '$details', '$country', '$image', '$requirements', '$qualifications', '$skills', '$realtime', '$about')") or die('query failed');
            
            
        if($insert_job){
            if($image_size > 2000000){
                $message[] = 'image size is too large';
            }else{
                move_uploaded_file($image_tmp_name, $image_upload);
                $message[] = 'job posted successfully!';
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
    <title>post a job page</title>

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

<!-- section of post job -->

<section class="post-job">

    <h3>tell us about your project</h3>

    <!-- <h3 class="note" style="color: red;"><span>* </span> Note: salary will decrease 5% if you post the job then you accept the terms</h3> -->

    <form action="" enctype="multipart/form-data" method="post">

        <div class="form-group">

            <p>title of job</p>
            <input type="text" class="input" placeholder="name of your offer job" name="title" required maxlength="20">
            <p>description of the project</p>
            <textarea name="details" class="input" placeholder="describe your project" id="details" cols="30" rows="10"></textarea>
            <p>about your company</p>
            <textarea name="about" class="input" placeholder="tell us about your company" id="about" cols="30" rows="10"></textarea>

        </div>

        <p>choose a picture for your company or your</p>
        <input type="file" accept="image/jpg, image/jpeg, image/png" class="box" name="image" required>

        <p>name of the company</p>
        <input type="text" class="input" id="company" name="company" placeholder="if there is no write none" required>

        <div class="dropdown-container">

            <div class="dropdown">

                <p>job type</p>
                <input type="text" readonly name="job_type" id="job_type" placeholder="choose what you need" maxlength="20" class="output">

                <div class="lists">

                    <p class="items">Security Guard</p>
                    <p class="items">Driver</p>
                    <p class="items">Chef</p>
                    <p class="items">Waiter</p>
                    <p class="items">Maid</p>
                    <p class="items">Photographer</p>

                </div>

            </div>

        </div>
        
        <p>benefits</p>
        <input type="text" class="input" id="benefits" name="benefits" placeholder="what is the benefits" required>
        
        <p>requirements</p>
        <input type="text" class="input" id="requirements" name="requirements">
        
        <p>qualifications</p>
        <input type="text" class="input" id="qualifications" name="qualifications">
        
        <p>skills</p>
        <input type="text" class="input" id="skills" name="skills">
        
        <p>city or state</p>
        <input type="text" class="input" id="city" name="city" placeholder="where is the city of your job" required>
        
        <p>country</p> 
        <input type="text" class="input" id="country" name="country" placeholder="where is the country of your job" required>
        
        
        <input type="hidden" name="realtime" value="<?php echo $date = date('Y-m-d H:i:s'); ?>" readonly>

            <p>salary</p>
            <input type="number" class="input" id="salary" name="salary">

        <div class="post-btn">

            <input type="submit" class="btn" id="submit" name="submit" value="Post">

        </div>


    </form>

</section>


<script>

    let dropdown = document.querySelectorAll('.post-job form .dropdown-container .dropdown .lists .items')

    dropdown.forEach(items =>{
        items.onclick = () =>{
            items_parent = items.parentElement.parentElement;
            let output = items_parent.querySelector('.output')
            output.value = items.innerText;
        }
    })


</script>
    
</body>
</html>