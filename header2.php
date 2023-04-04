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

        <div class="icons">

            <div id="menu-btn" class="fas fa-bars-staggered" style="margin: 0;"></div>

        </div>

        <a href="home.php" class="logo" style="margin-right: 10rem;"><i class="fa-solid fa-user-tie"></i>jobia</a>

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
                
                </ul>

        </nav>

        <div class="post-btn">

            <a href="need_job.php" class="btn">searching a job</a>

            <a href="post_project.php" class="btn">Post a job</a>

        </div>

        <div class="card">

            <div class="content">

                <div class="imgBox">
                
                    <img src="users_img/<?php echo $_SESSION['user_image']; ?>" alt="" class="image">

                </div>

                <h3><?php echo $_SESSION['user_name']; ?></h3>

            </div>

            <div class="toggle">

                <div id="user-btn" class="fa-solid fa-caret-down"></div>

            </div>

        </div>    

        <ul class="navigation">

            <li>

                <a href="view_profile.php?pid=<?php echo $_SESSION['id']; ?>"><i class="fa-regular fa-user"></i>view profile</a>

            </li>

            <li>

                <a href="wishlist.php"><i class="fa-regular fa-heart"></i>wishlist</a>

            </li>

            <li>

                <a href="inbox.php"><i class="fa-regular fa-comment"></i>inbox</a>

            </li>

            <li>

                <a href="support.php"><i class="fa-sharp fa-regular fa-circle-question"></i>support</a>

            </li>

            <li>

                <a href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i>logout</a>

            </li>

        </ul>

    </div>

    <script>

        var navbar = document.querySelector('.header .flex .navbar');
        var userBox = document.querySelector('.header .flex .navigation');

        document.querySelector('#user-btn').onclick = () =>{
            userBox.classList.toggle('active');
            navbar.classList.remove('active');
        }

        document.querySelector('#menu-btn').onclick = () =>{
            navbar.classList.toggle('active');
            userBox.classList.remove('active');
        }

        window.onscroll = () =>{
            navbar.classList.remove('active');
            userBox.classList.remove('active');
        }

        const card = document.querySelector('.header .flex .card');
        const cardToggle = document.querySelector('.header .flex .card .toggle');
        cardToggle.onclick = function(){
            card.classList.toggle('active');
        }

    </script>

</header>