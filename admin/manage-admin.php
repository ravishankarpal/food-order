<?php include ('partials/menu.php')?>
    <!--Main Content Section Starts-->
    <div class="main-section">
        <div class="wrapper">
            <h1>Manage Admin</h1>
            <br>
            <?php
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];    //display session msg
                    unset($_SESSION['add']);   //removing session msg
                }

                if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];    //display session msg
                    unset($_SESSION['delete']);   //removing session msg
                }

                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];    //display session msg
                    unset($_SESSION['update']);   //removing session msg
                }

                if(isset($_SESSION['user-not-found'])){
                    echo $_SESSION['user-not-found'];    //display session msg
                    unset($_SESSION['user-not-found']);   //removing session msg
                }

                if(isset($_SESSION['pwd-not-match'])){
                    echo $_SESSION['pwd-not-match'];    //display session msg
                    unset($_SESSION['pwd-not-match']);   //removing session msg
                }

                if(isset($_SESSION['change-pwd'])){
                    echo $_SESSION['change-pwd'];    //display session msg
                    unset($_SESSION['change-pwd']);   //removing session msg
                }

            ?>
            <br> <br><br>

            <!-- button for add admin -->
            <a class="btn-primary" href="add-admin.php">Add Admin</a>

            <br><br>
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <?php
                //query to get all admin
                $sql="SELECT * FROM tbl_admin";
                //execute the query
                $res=mysqli_query($conn,$sql);

                //check if the query is executed
                if($res==TRUE)
                {
                    //COUNT THE ROW TO CHECK WHETHER the database is here or not
                    $count=mysqli_num_rows($res);

                    $sn=1; //create a variable
                    if($count>0){
                        //we have data in database
                        while($rows=mysqli_fetch_assoc($res))
                        {
                            $id=$rows['id'];
                            $full_name=$rows['full_name'];
                            $username=$rows['username'];

                 //display the value in our table           
            ?>
            <tr>
                    <td><?php echo $sn++?></td>
                    <td><?php echo $full_name?></td>
                    <td><?php echo $username?></td>
                    <td>
                    <a class="btn-primary" href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id;?>">Change Password</a>
                        <a class="btn-secondary" href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id;?>">Update Admin</a>
                        <a class="btn-danger" href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id;?>">Delete Admin</a>
                    </td>
                </tr>
             <?php
                            
                        }
                    }
                    else{
                        //we dont have any data
                    }
                }
            ?>


               
            </table>
        

            <div class="clearfix"></div>

        </div>
    </div>
    <!--Main Content Section Ends-->

    <?php include ('partials/footer.php');?>