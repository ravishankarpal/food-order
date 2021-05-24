<?php include ('../config/constants.php');?>
<html>
    <head>
        <title>Login-food order</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        <div class="login">
            <h1 class="text-center">Log In</h1>
            <br><br>

            <?php 
                if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];    //display session msg
                    unset($_SESSION['login']);   //removing session msg
                }
            ?>
                        <?php 
                if(isset($_SESSION['no-login-message'])){
                    echo $_SESSION['no-login-message'];    //display session msg
                    unset($_SESSION['no-login-message']);   //removing session msg
                }
            ?>
            <br>

            <!-- Login form start -->
            <form action="" method="POST" class="text-center">
            User Name: 
            <input type="text" name="username" placeholder="Enter the Username"><br><br>
            Password:
            <input type="password" name="password" placeholder="Enter password"><br><br> 

            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br><br>
            </form> 
            <!--Login form Ends  -->
            
            <p class="text-center">Created By- <a href="#"> Abhinav Arya</a></p>
        </div>

    </body>
</html>

<?php

    if(isset($_POST['submit']))
    {
        //process for login
        //1. get the data from the login form
        $username=$_POST['username'];
        $password=md5($_POST['password']);

        //2. sql query to check whether the username & password is exist or not
        $sql="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        //3. execute the query
        $res=mysqli_query($conn,$sql);

        //4. count whether user exists or not
        $count=mysqli_num_rows($res);
        if($count==1){
            //user exist
            $_SESSION['login']="<div class='success'>Login Successful</div>";
            $_SESSION['user']=$username; //To check whether user logged in or not and logut will unset it.

            header('location:'.SITEURL.'admin/');
        }
        else{
            //user doesn't exist
            $_SESSION['login']="<div class='error text-center'>Username Or Password did not Exist.</div>";
            header('location:'.SITEURL.'admin/login.php');
        }

    }
?>