<?php include ('partials/menu.php');?>

<div class="main-section">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br>
        <?php
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];    //display session msg
                    unset($_SESSION['add']);   //removing session msg
                }
            ?>

        <form  method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Your Name">
                    </td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" placeholder="Your Username" required>
                    </td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="Your Password" >
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include ('partials/footer.php');?>

<?php
 //process the data from the form and save it
//check whether submit button is clicked or not

if(isset($_POST['submit']))
{
    //echo "button clicked";

    //Get the data from user form
   $full_name=$_POST['full_name'];
   $username=$_POST['username'];
   $password=md5($_POST['password']);

   //SQL Query to save the data into database
   $sql="INSERT INTO tbl_admin SET
   full_name='$full_name',
   username='$username',
   password='$password'
   ";
    //3. executing query and saving data into database
    $res=mysqli_query($conn,$sql) or die(mysqli_error());

    //4. check whether the data is inserted or not
    if($res==TRUE)
    {
        //echo "data inserted";
        //create a session variable to display message
        $_SESSION['add']="Admin Added Successfully";

        //redirect page to manage admin
        header("location:".SITEURL.'admin/manage-admin.php');
    }
    else{
       // echo "failed to insert";
       //create a session variable to display message
       $_SESSION['add']="failed to add Admin";

       //redirect page to add admin
       header("location".SITEURL.'admin/add-admin.php');
    }

}

?>