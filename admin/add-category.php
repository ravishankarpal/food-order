<?php include('partials/menu.php');?>
    
    <div class="main-section">
        <div class="wrapper">
            <h1>Add Category</h1>

            <br><br>
        <?php
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }  

        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }  
        ?>

        <br>
        <!-- Add category form start -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                    <input type="text" name="title" namespace="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                    <input type="radio" name="featured" value="Yes">Yes

                    <input type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                    <input type="radio" name="active" value="Yes">Yes
                    <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
         <!-- Add category form end -->

         <?php 
            if(isset($_POST['submit']))
            {
                //1. Get the input from category form
                $title=$_POST['title'];

                //for button input, we need to check whether the button is selected or not
                if(isset($_POST['featured']))
                {
                    $featured=$_POST['featured'];
                }
                else
                {
                    $featured="No";
                }

                if(isset($_POST['active']))
                {
                    $active=$_POST['active'];
                }
                else
                {
                    $active="No";
                }

                //check the image is selected or not
                //print_r($_FILES['image']);
 
                //die();  //break the code

                if(isset($_FILES['image']['name']))
                {
                    //upload the image
                    //to upload the image we need image, source path and destination path
                    $image_name=$_FILES['image']['name'];


                   if($image_name!="")
                   {

                    //auto rename our image
                    $ext=end(explode('.',$image_name));
                    //rename the image
                    $image_name="Food_category_".rand(000,999).'.'.$ext;

                    $source_path=$_FILES['image']['tmp_name'];

                     
                    $destination_path="../images/category/".$image_name;

                    //finally upload the image
                    $upload=move_uploaded_file($source_path,$destination_path);

                    //check whether image is uploadeed or not
                    if($upload==false)
                    {
                        $_SESSION['upload']="<div class='error'>Failed to Upload Image</div>";

                        //redirect to add category page
                        header('location:'.SITEURL.'admin/add-category.php');
                        die();
                        //STOP the process
                    }
                }

                }
                else
                {
                    $image_name="";
                }

                //2. create sql query to insert database
                $sql="INSERT INTO tbl_category SET
                title='$title',
                image_name='$image_name',
                featured='$featured',
                active='$active'
                ";

                //3. Execute the query
                $res=mysqli_query($conn,$sql);

                //4.check the query executed or not
                if($res==true)
                {
                    $_SESSION['add']= "<div class='success'>Category Added Successfully</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    $_SESSION['add']= "<div class='error'>Failed to Add Category</div>";
                    header('location:'.SITEURL.'admin/add-category.php');
                }
            }

         ?>
        </div>
    </div>

<?php include('partials/footer.php');?>