<?php include ('partials/menu.php');?>
<div class="main-section">
    <div class="wrapper">
        <h1>Manage Food</h1>
        <br>

            <!-- button for add admin -->
            <a class="btn-primary" href="<?php echo SITEURL;?>admin/add-food.php">Add Food</a>

            <br><br>

        <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            } 

            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            } 

            if(isset($_SESSION['unauthorized'])){
                echo $_SESSION['unauthorized'];
                unset($_SESSION['unauthorized']);
            } 

            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            } 
        
        ?>
            
            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>

                <?php
                //create a sql query
                    $sql="SELECT * FROM tbl_food";
                    $res=mysqli_query($conn,$sql);
                    $count=mysqli_num_rows($res);
                    $sn=1;
                    if($count>0)
                    {
                        //we have food in DB
                        //get the food and display
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $id=$row['id'];
                            $title=$row['title'];
                            $price=$row['price'];
                            $image_name=$row['image_name'];
                            $featured=$row['featured'];
                            $active=$row['active'];
 
                            ?>

                            <tr>
                                <td><?php echo $sn++;?></td>
                                <td><?php echo $title;?></td>
                                <td><?php echo $price;?></td>
                                <td>
                                    <?php 
                                    if($image_name=="")
                                    {
                                        "<div class='error'>Image Not Added.</div>";
                                    }
                                    else
                                    {
                                        ?>
                                        <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>" width="100px">
                                        <?php
                                    }
                                    ?>
                                </td>
                                <td><?php echo $featured;?></td>
                                <td><?php echo $active;?></td>
                                <td>
                                    <a class="btn-secondary" href="<?php echo SITEURL;?>admin/update-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name; ?>">Update Food</a>
                                    <a class="btn-danger" href="<?php echo SITEURL;?>admin/delete-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name; ?>">Delete Food</a>
                                </td>
                            </tr>

                            
                            <?php

                        }

                    }
                    else 
                    {
                        //FOOD NOT ADDED in DB
                        echo "<tr><td colspan='7' class='error'>Food Not Added Yet.</td></tr>";
                    }
                ?>
                
    
            </table>
    </div>
</div>

<?php include ('partials/footer.php');?>