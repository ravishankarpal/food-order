<?php 

    //Authorization - Access Control
    //check whether the user logged in or not
    if(!isset($_SESSION['user']))
    {
        //redirect to login page with message
        $_SESSION['no-login-message']="<div class='error'>Please Login To Access Admin Panel</div>";
        header('location:'.SITEURL.'admin/login.php');
    }

?>