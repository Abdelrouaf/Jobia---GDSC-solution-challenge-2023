<?php 

@include "config.php";

if(isset($_POST['submit'])){

    $filter_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $name = mysqli_real_escape_string($conn, $filter_name);

    $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $email = mysqli_real_escape_string($conn, $filter_email);

    $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
    $pass = mysqli_real_escape_string($conn, $filter_pass);

    $filter_cpass = filter_var($_POST['cpass'], FILTER_SANITIZE_STRING);
    $cpass = mysqli_real_escape_string($conn, $filter_cpass);

    $number = mysqli_real_escape_string($conn, $_POST['number']);
    
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    
    $state = mysqli_real_escape_string($conn, $_POST['state']);

    $details = mysqli_real_escape_string($conn, $_POST['details']);

    $country = mysqli_real_escape_string($conn, $_POST['country']);

    $experience = mysqli_real_escape_string($conn, $_POST['experience']);

    $job_type = mysqli_real_escape_string($conn, $_POST['job_type']);

    $image = $_FILES["image"]["name"];
    $image_size = $_FILES["image"]["size"];
    $image_tmp_name = $_FILES["image"]["tmp_name"];
    $image_upload = "users_img/".$image;

    $dob = mysqli_real_escape_string($conn, $_POST['dob']);

    $gender = mysqli_real_escape_string($conn, $_POST['gender']);

    $cv = $_FILES["cv"]["name"];
    $cv_size = $_FILES["cv"]["size"];
    $cv_tmp_name = $_FILES["cv"]["tmp_name"];
    $cv_upload = "uploaded_cv/".$cv;

    $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');
    if(mysqli_num_rows($select_users) > 0){
        $message[] = 'user already exist';
    }else{
        if($pass != $cpass){
    
            $message[] = 'confirm password not matched!';
    
        }elseif((!empty($_POST["pass"]) && !empty($_POST["cpass"])) && ($_POST["pass"] == $_POST["cpass"])) {
    
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
                $insert_job = mysqli_query($conn, "INSERT INTO `users`(name, email, password, number, age, state, details, country, experience, image, cv, job_type, dob, gender) VALUES('$name','$email','$pass', '$number','$age', '$state', '$details', '$country','$experience', '$image', '$cv', '$job_type', '$dob', '$gender')") or die('query failed');
                if($insert_job){
                    if($image_size > 2000000 || $cv_size > 2000000){
                        $message[] = 'image or cv size is too large';
                    }else if($image_size < 2000000 && $cv_size < 2000000){
                        move_uploaded_file($image_tmp_name, $image_upload);
                        move_uploaded_file($cv_tmp_name, $cv_upload);
                        $message[] = 'register successfully!';
                        header('location:login.php');
                        }else{
                            $message[] = 'error!';
                        }
                    } 
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
    <title>sign up page</title>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

</head>
<body>

<?php

    if(isset($message)){
        foreach($message as $message){
            echo 
            '
                <div class="message">
                    <span>'.$message.'</span>
                    <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
                </div>
            ';
        }
    }

?>

<!-- section of sign up form -->

<div class="wrapper">

    <div id="wrapper" class="header">

        <ul>

            <li class="active form_1_progessbar">

                <div>

                    <p>1</p>

                </div>

            </li>

            <li class="form_2_progessbar">

                <div>

                    <p>2</p>

                </div>

            </li>

            <li class="form_3_progessbar">

                <div>

                    <p>3</p>

                </div>

            </li>

        </ul>

    </div>

    <form action="" method="post" enctype="multipart/form-data">

    <div class="form_wrap">

        <div class="form_1 data_info">

            <h2>Signup Info</h2>

                <div class="register" data-step>

                    <div class="form-group">

                        <label for="Name"><span>* </span>Name</label>
                        <input type="text" name="name" id="name" required>

                    </div>

                    <div class="form-group">
                        <label for="email"><span>* </span>Email</label>
                        <input type="email" name="email" id="email" class="box" required>
                    </div>

                    <div class="form-group">
                        <label for="phone_number"><span>* </span>phone number</label>
                        <input type="number" name="number" id="number" class="box" required>
                    </div>

                    <div class="form-group">

                        <label for="password"><span>* </span>Password</label>
                        <input type="password" name="pass" id="pass" class="box" required>

                    </div>

                    <div class="form-group">

                        <label for="cpass"><span>* </span>Confirm password</label>
                        <input type="password" name="cpass" id="cpass" class="box" required>

                    </div>

                    <div class="have-account">
                        <p>already have an account? <a href="login.php">Login now</a></p>

                    </div>

                </div>

        </div>

        <div class="form_2 data_info" style="display: none;">

            <h2>Personal Info</h2>

                <div class="register" data-step>

                    <div class="form-group">

                        <label for="image"><span>* </span>choose a profile picture</label>
                        <input type="file" accept=".png, .jpg, .jpeg"  id="image" name="image" required>

                    </div>

                    <div class="form-group">

                        <label for="age"><span>* </span>age</label>
                        <input type="number" id="age" placeholder="enter your age" name="age" class="box" required>

                    </div>

                    <div class="form-group" id="selected">

                            <label for="country"><span>* </span>Country</label>    
                            <div class="select">
                                <select id="country" name="country" class="selec-box">
                                <option value="Afghanistan">Afghanistan</option>
                                <option value="Åland Islands">Åland Islands</option>
                                <option value="Albania">Albania</option>
                                <option value="Algeria">Algeria</option>
                                <option value="American Samoa">American Samoa</option>
                                <option value="Andorra">Andorra</option>
                                <option value="Angola">Angola</option>
                                <option value="Anguilla">Anguilla</option>
                                <option value="Antarctica">Antarctica</option>
                                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                <option value="Argentina">Argentina</option>
                                <option value="Armenia">Armenia</option>
                                <option value="Aruba">Aruba</option>
                                <option value="Australia">Australia</option>
                                <option value="Austria">Austria</option>
                                <option value="Azerbaijan">Azerbaijan</option>
                                <option value="Bahamas">Bahamas</option>
                                <option value="Bahrain">Bahrain</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="Barbados">Barbados</option>
                                <option value="Belarus">Belarus</option>
                                <option value="Belgium">Belgium</option>
                                <option value="Belize">Belize</option>
                                <option value="Benin">Benin</option>
                                <option value="Bermuda">Bermuda</option>
                                <option value="Bhutan">Bhutan</option>
                                <option value="Bolivia">Bolivia</option>
                                <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                <option value="Botswana">Botswana</option>
                                <option value="Bouvet Island">Bouvet Island</option>
                                <option value="Brazil">Brazil</option>
                                <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                <option value="Brunei Darussalam">Brunei Darussalam</option>
                                <option value="Bulgaria">Bulgaria</option>
                                <option value="Burkina Faso">Burkina Faso</option>
                                <option value="Burundi">Burundi</option>
                                <option value="Cambodia">Cambodia</option>
                                <option value="Cameroon">Cameroon</option>
                                <option value="Canada">Canada</option>
                                <option value="Cape Verde">Cape Verde</option>
                                <option value="Cayman Islands">Cayman Islands</option>
                                <option value="Central African Republic">Central African Republic</option>
                                <option value="Chad">Chad</option>
                                <option value="Chile">Chile</option>
                                <option value="China">China</option>
                                <option value="Christmas Island">Christmas Island</option>
                                <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                <option value="Colombia">Colombia</option>
                                <option value="Comoros">Comoros</option>
                                <option value="Congo">Congo</option>
                                <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                                <option value="Cook Islands">Cook Islands</option>
                                <option value="Costa Rica">Costa Rica</option>
                                <option value="Cote D'ivoire">Cote D'ivoire</option>
                                <option value="Croatia">Croatia</option>
                                <option value="Cuba">Cuba</option>
                                <option value="Cyprus">Cyprus</option>
                                <option value="Czech Republic">Czech Republic</option>
                                <option value="Denmark">Denmark</option>
                                <option value="Djibouti">Djibouti</option>
                                <option value="Dominica">Dominica</option>
                                <option value="Dominican Republic">Dominican Republic</option>
                                <option value="Ecuador">Ecuador</option>
                                <option value="Egypt">Egypt</option>
                                <option value="El Salvador">El Salvador</option>
                                <option value="Equatorial Guinea">Equatorial Guinea</option>
                                <option value="Eritrea">Eritrea</option>
                                <option value="Estonia">Estonia</option>
                                <option value="Ethiopia">Ethiopia</option>
                                <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                <option value="Faroe Islands">Faroe Islands</option>
                                <option value="Fiji">Fiji</option>
                                <option value="Finland">Finland</option>
                                <option value="France">France</option>
                                <option value="French Guiana">French Guiana</option>
                                <option value="French Polynesia">French Polynesia</option>
                                <option value="French Southern Territories">French Southern Territories</option>
                                <option value="Gabon">Gabon</option>
                                <option value="Gambia">Gambia</option>
                                <option value="Georgia">Georgia</option>
                                <option value="Germany">Germany</option>
                                <option value="Ghana">Ghana</option>
                                <option value="Gibraltar">Gibraltar</option>
                                <option value="Greece">Greece</option>
                                <option value="Greenland">Greenland</option>
                                <option value="Grenada">Grenada</option>
                                <option value="Guadeloupe">Guadeloupe</option>
                                <option value="Guam">Guam</option>
                                <option value="Guatemala">Guatemala</option>
                                <option value="Guernsey">Guernsey</option>
                                <option value="Guinea">Guinea</option>
                                <option value="Guinea-bissau">Guinea-bissau</option>
                                <option value="Guyana">Guyana</option>
                                <option value="Haiti">Haiti</option>
                                <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                                <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                <option value="Honduras">Honduras</option>
                                <option value="Hong Kong">Hong Kong</option>
                                <option value="Hungary">Hungary</option>
                                <option value="Iceland">Iceland</option>
                                <option value="India">India</option>
                                <option value="Indonesia">Indonesia</option>
                                <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                <option value="Iraq">Iraq</option>
                                <option value="Ireland">Ireland</option>
                                <option value="Isle of Man">Isle of Man</option>
                                <option value="Israel">Israel</option>
                                <option value="Italy">Italy</option>
                                <option value="Jamaica">Jamaica</option>
                                <option value="Japan">Japan</option>
                                <option value="Jersey">Jersey</option>
                                <option value="Jordan">Jordan</option>
                                <option value="Kazakhstan">Kazakhstan</option>
                                <option value="Kenya">Kenya</option>
                                <option value="Kiribati">Kiribati</option>
                                <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                                <option value="Korea, Republic of">Korea, Republic of</option>
                                <option value="Kuwait">Kuwait</option>
                                <option value="Kyrgyzstan">Kyrgyzstan</option>
                                <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                <option value="Latvia">Latvia</option>
                                <option value="Lebanon">Lebanon</option>
                                <option value="Lesotho">Lesotho</option>
                                <option value="Liberia">Liberia</option>
                                <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                <option value="Liechtenstein">Liechtenstein</option>
                                <option value="Lithuania">Lithuania</option>
                                <option value="Luxembourg">Luxembourg</option>
                                <option value="Macao">Macao</option>
                                <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                                <option value="Madagascar">Madagascar</option>
                                <option value="Malawi">Malawi</option>
                                <option value="Malaysia">Malaysia</option>
                                <option value="Maldives">Maldives</option>
                                <option value="Mali">Mali</option>
                                <option value="Malta">Malta</option>
                                <option value="Marshall Islands">Marshall Islands</option>
                                <option value="Martinique">Martinique</option>
                                <option value="Mauritania">Mauritania</option>
                                <option value="Mauritius">Mauritius</option>
                                <option value="Mayotte">Mayotte</option>
                                <option value="Mexico">Mexico</option>
                                <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                <option value="Moldova, Republic of">Moldova, Republic of</option>
                                <option value="Monaco">Monaco</option>
                                <option value="Mongolia">Mongolia</option>
                                <option value="Montenegro">Montenegro</option>
                                <option value="Montserrat">Montserrat</option>
                                <option value="Morocco">Morocco</option>
                                <option value="Mozambique">Mozambique</option>
                                <option value="Myanmar">Myanmar</option>
                                <option value="Namibia">Namibia</option>
                                <option value="Nauru">Nauru</option>
                                <option value="Nepal">Nepal</option>
                                <option value="Netherlands">Netherlands</option>
                                <option value="Netherlands Antilles">Netherlands Antilles</option>
                                <option value="New Caledonia">New Caledonia</option>
                                <option value="New Zealand">New Zealand</option>
                                <option value="Nicaragua">Nicaragua</option>
                                <option value="Niger">Niger</option>
                                <option value="Nigeria">Nigeria</option>
                                <option value="Niue">Niue</option>
                                <option value="Norfolk Island">Norfolk Island</option>
                                <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                <option value="Norway">Norway</option>
                                <option value="Oman">Oman</option>
                                <option value="Pakistan">Pakistan</option>
                                <option value="Palau">Palau</option>
                                <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                                <option value="Panama">Panama</option>
                                <option value="Papua New Guinea">Papua New Guinea</option>
                                <option value="Paraguay">Paraguay</option>
                                <option value="Peru">Peru</option>
                                <option value="Philippines">Philippines</option>
                                <option value="Pitcairn">Pitcairn</option>
                                <option value="Poland">Poland</option>
                                <option value="Portugal">Portugal</option>
                                <option value="Puerto Rico">Puerto Rico</option>
                                <option value="Qatar">Qatar</option>
                                <option value="Reunion">Reunion</option>
                                <option value="Romania">Romania</option>
                                <option value="Russian Federation">Russian Federation</option>
                                <option value="Rwanda">Rwanda</option>
                                <option value="Saint Helena">Saint Helena</option>
                                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                <option value="Saint Lucia">Saint Lucia</option>
                                <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                                <option value="Samoa">Samoa</option>
                                <option value="San Marino">San Marino</option>
                                <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                <option value="Saudi Arabia">Saudi Arabia</option>
                                <option value="Senegal">Senegal</option>
                                <option value="Serbia">Serbia</option>
                                <option value="Seychelles">Seychelles</option>
                                <option value="Sierra Leone">Sierra Leone</option>
                                <option value="Singapore">Singapore</option>
                                <option value="Slovakia">Slovakia</option>
                                <option value="Slovenia">Slovenia</option>
                                <option value="Solomon Islands">Solomon Islands</option>
                                <option value="Somalia">Somalia</option>
                                <option value="South Africa">South Africa</option>
                                <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                                <option value="Spain">Spain</option>
                                <option value="Sri Lanka">Sri Lanka</option>
                                <option value="Sudan">Sudan</option>
                                <option value="Suriname">Suriname</option>
                                <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                <option value="Swaziland">Swaziland</option>
                                <option value="Sweden">Sweden</option>
                                <option value="Switzerland">Switzerland</option>
                                <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                <option value="Taiwan">Taiwan</option>
                                <option value="Tajikistan">Tajikistan</option>
                                <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                <option value="Thailand">Thailand</option>
                                <option value="Timor-leste">Timor-leste</option>
                                <option value="Togo">Togo</option>
                                <option value="Tokelau">Tokelau</option>
                                <option value="Tonga">Tonga</option>
                                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                <option value="Tunisia">Tunisia</option>
                                <option value="Turkey">Turkey</option>
                                <option value="Turkmenistan">Turkmenistan</option>
                                <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                <option value="Tuvalu">Tuvalu</option>
                                <option value="Uganda">Uganda</option>
                                <option value="Ukraine">Ukraine</option>
                                <option value="United Arab Emirates">United Arab Emirates</option>
                                <option value="United Kingdom">United Kingdom</option>
                                <option value="United States">United States</option>
                                <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                <option value="Uruguay">Uruguay</option>
                                <option value="Uzbekistan">Uzbekistan</option>
                                <option value="Vanuatu">Vanuatu</option>
                                <option value="Venezuela">Venezuela</option>
                                <option value="Viet Nam">Viet Nam</option>
                                <option value="Virgin Islands, British">Virgin Islands, British</option>
                                <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                <option value="Wallis and Futuna">Wallis and Futuna</option>
                                <option value="Western Sahara">Western Sahara</option>
                                <option value="Yemen">Yemen</option>
                                <option value="Zambia">Zambia</option>
                                <option value="Zimbabwe">Zimbabwe</option>
                            
                            </select>

                            </div>  
                    </div>

                    <div class="form-group">

                        <label for="state"><span>* </span>state</label>
                        <input type="text" id="state" placeholder="your state" name="state" class="box" required>

                    </div>

                    <div class="form-group">

                        <label for="dob"><span>* </span>Date of Birth</label>
                        <input type="date" id="dob" placeholder="your date of birth" name="dob" class="box" required>

                    </div>

                    <div class="gender-field">

                        <label>Gender:</label>
                        <input type="radio" id="gender" name="gender" value="Male"/> Male  
                        <input type="radio" id="gender" name="gender" value="Female"/> Female

                    </div>

                </div>


        </div>

        <div class="form_3 data_info" style="display: none;">

            <h2>Signup Info</h2>

            <div class="form-group">

                <div class="dropdown">

                    <label for="details">your job type</label>
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

            <div class="form-group">

                <label for="details"><span>* </span>total work experience</label>
                <input type="number" name="experience" id="experience" class="box"  placeholder="enter your total work experience" required>

            </div>

            <div class="form-group">

                <label for="details">Drag & drop any images or documents that might be helpful in explaining your brief here</label>
                <input type="file" name="cv" id="cv" class="box" value="attch a file">

            </div>

            <div class="register" data-step>

                <div class="form-group">

                    <label for="details"><span>* </span>What is your skills</label>
                    <textarea name="details" id="details" class="box"  placeholder="enter details" cols="20" rows="15" required></textarea>

                </div>

            </div>

        </div>


    </div>

    <div class="btns_wrap" id="button">

            <div class="btns form_1_btns">

                <a href="home.php" class="btn_cancel">Cancel</a>
                
                <button type="button" class="btn_next">Next</button>

            </div>

            <div class="btns form_2_btns" style="display: none;">

                <button type="button" class="btn_back">Back</button>

                <button type="button" class="btn_next">Next</button>

            </div>

            <div class="btns form_3_btns" style="display: none;">

                <button type="button" class="btn_back">Back</button>

                <input type="submit" class="btn_cancel" name="submit" id="submit" value="Done">

            </div>

    </div>

    </form>

</div>

<script>

    var form_1 = document.querySelector(".form_1")
    var form_2 = document.querySelector(".form_2")
    var form_3 = document.querySelector(".form_3")


    var form_1_btns = document.querySelector(".form_1_btns")
    var form_2_btns = document.querySelector(".form_2_btns")
    var form_3_btns = document.querySelector(".form_3_btns")


    var form_1_next_btn = document.querySelector(".form_1_btns .btn_next")

    var form_2_back_btn = document.querySelector(".form_2_btns .btn_back")
    var form_2_next_btn = document.querySelector(".form_2_btns .btn_next")

    var form_3_back_btn = document.querySelector(".form_3_btns .btn_back")


    var form_2_progessbar = document.querySelector(".form_2_progessbar")
    var form_3_progessbar = document.querySelector(".form_3_progessbar")


    form_1_next_btn.addEventListener("click", function(){
        form_1.style.display = "none";
        form_2.style.display = "block";

        form_1_btns.style.display = "none";
        form_2_btns.style.display = "flex";

        form_2_progessbar.classList.add("active");
    })


    form_2_back_btn.addEventListener("click", function(){
        form_1.style.display = "block";
        form_2.style.display = "none";

        form_1_btns.style.display = "flex";
        form_2_btns.style.display = "none";

        form_2_progessbar.classList.remove("active");
    })


    form_2_next_btn.addEventListener("click", function(){
        form_2.style.display = "none";
        form_3.style.display = "block";

        form_2_btns.style.display = "none";
        form_3_btns.style.display = "flex";

        form_3_progessbar.classList.add("active");
    })


    form_3_back_btn.addEventListener("click", function(){
        form_2.style.display = "block";
        form_3.style.display = "none";

        form_2_btns.style.display = "flex";
        form_3_btns.style.display = "none";

        form_3_progessbar.classList.remove("active");
    })

    let dropdown = document.querySelectorAll('.wrapper form .form_wrap .form-group .dropdown .lists .items')

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