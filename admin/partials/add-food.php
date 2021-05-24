<?php include ('partials/menu.php');?>
<div class="main-section">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>

        <?php 
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }  
        ?>

        <!-- Add category form start -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                    <input type="text" name="title" namespace=" Title Of The Food">
                    </td>
                </tr>

                <tr>
                    <td>Description:</td>
                    <td>
                    <textarea name="description" id="" cols="30" rows="5" namespace="Description Of The Food"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

                            <?php 
                                //1. Check sql query
                                $sql="SELECT * FROM tbl_category WHERE active='Yes'";
                                $res=mysqli_query($conn,$sql);
                                $count=mysqli_num_rows($res);
                                if($count>0)
                                {
                                    //we have category
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        //get the detail of category
                                        $id=$row['id'];
                                        $title=$row['title'];
                                        ?>
                                        <option value="<?php $id;?>"><?php echo $title;?></option>

                                        <?php
                                    }
                                }
                                else
                                {
                                    //we dont have category
                                    ?>
                                    <option value="0">No Category Found
                                    </option>
                                    <?php
                                }

                                //2. display on dropdown
                            ?>
                        </select>
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
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
         <!-- Add category form end -->
         <?php 

            if(isset($_POST['submit']))
            {
                //add the food in database

                //1. get the data from the form
                $title=$_POST['title'];
                $description=$_POST['description'];
                $price=$_POST['price'];
                $category=$_POST['category'];

                //check whether radio btn clicked or not
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



                //2. upload the image if selected
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
                    $image_name="Food-Name-".rand(0000,9999).".".$ext;

                    $src=$_FILES['image']['tmp_name'];

                     
                    $dst="../images/food/".$image_name;

                    //finally upload the image
                    $upload=move_uploaded_file($src,$dst);

                    //check whether image is uploadeed or not
                    if($upload==false)
                       {
                        $_SESSION['upload']="<div class='error'>Failed to Upload Food</div>";

                        //redirect to add category page
                        header('location:'.SITEURL.'admin/add-food.php');
                        die();
                        //STOP the process
                       }
                    }

                }
                else
                {
                    $image_name="";
                }

                //3. insert into databse
                $sql2="INSERT INTO tbl_food SET
                title='$title',
                description ='$description',
                price=$price,
                image_name='$image_name',
                category_id=$category,
                featured='$featured',
                active='$active'
                ";

                //3. Execute the query
                $res2=mysqli_query($conn,$sql2);

                //4.check the query executed or not
                if($res2 == true)
                {
                    $_SESSION['add']= "<div class='success'>Food Added Successfully</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else
                {
                    $_SESSION['add']= "<div class='error'>Failed to Add Food</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
            }
         ?>
    </div>
</div>

<?php include ('partials/footer.php');?>