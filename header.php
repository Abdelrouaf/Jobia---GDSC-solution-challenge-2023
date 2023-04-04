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


<header class="header">

    <div class="flex">

        <a href="home.php" class="logo" style="margin-right: 7rem;"><i class="fa-solid fa-user-tie"></i>jobia</a>

        <nav class="navbar">

            <ul>

                <li><a href="home.php">home</a></li>
                <li><a href="#">pages +</a>
            
                    <ul>

                        <li><a href="service.php">Service</a></li>
                        <li><a href="contact.php">contact us</a></li>

                    </ul>
                
                </li>

                <li><a href="#">jobs +</a>
            
                    <ul>

                        <li><a href="jobs.php">all jobs</a></li>
                        <li><a href="need_jobs.php">need jobs</a></li>

                    </ul>
                
                </li>

                <li><a href="#">account +</a>
            
                    <ul>

                    <li><a href="login.php">login</a></li>
                    <li><a href="SignUp.php">register</a></li>

                    </ul>
            
                </li>

            </ul>

        </nav>

        <div class="post-btn">

            <a href="login.php" class="btn">searching a job</a>

            <a href="login.php" class="btn">Post a job</a>

        </div>

        <div class="icons">

            <div id="menu-btn" class="fas fa-bars-staggered"></div>

        </div>


        
    </div>


</header>