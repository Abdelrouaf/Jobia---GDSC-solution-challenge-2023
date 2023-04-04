<?php 
// logout from user account
session_start();

$user_id = $_SESSION['user_id'];

if(isset($user_id)){
    
    session_destroy();

    echo "<script>location.href='home.php'</script>";

}else{

    echo "<script>location.href='jobs.php'</script>";

}

?>