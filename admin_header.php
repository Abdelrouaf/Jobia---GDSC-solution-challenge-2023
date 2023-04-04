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

    <a href="admin_page.php" class="logo"><i class="fa-solid fa-user-tie"></i>Admin <span>Panel</span></a>

    <nav class="navbar">

        <ul>

            <li><a href="admin_page.php">home</a></li>

            <li><a href="#">jobs +</a>
            
                <ul>

                    <li><a href="admin_jobs.php">all jobs</a></li>
                    <li><a href="admin_need_jobs.php">need jobs</a></li>

                </ul>
        
            </li>
            
            <li><a href="admin_users.php">users</a></li>

            <li><a href="#">mesages +</a>

                <ul>

                    <li><a href="admin_contacts.php">contact</a></li>
                    <li><a href="admin_supports.php">support</a></li>

                </ul>

            </li>

        </ul>

    </nav>

    <div class="icons">
        <div id="menu-btn" class="fas fa-bars-staggered"></div>
    </div>

    <div class="card">

            <div class="content">

                <div class="imgBox">

                    <img src="users_img/<?php echo $_SESSION['admin_image']; ?>" alt="" class="image">


                </div>

                <h3><?php echo $_SESSION['admin_name']; ?></h3>

            </div>

            <div class="toggle">

                <i id="user-btn" class="fa-solid fa-caret-down"></i>

            </div>

        </div>    

        <ul class="navigation">

            <li>

                <a href="view_admin_profile.php?pid=<?php echo $fetch_job['id']; ?>"><i class="fa-regular fa-user"></i>view profile</a>

            </li>

            <li>

                <a href="home.php"><i class="fa-solid fa-arrow-right-from-bracket"></i>logout</a>

            </li>

        </ul>

</div>

</header>