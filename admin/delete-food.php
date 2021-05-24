<?php 
    include('../config/constants.php');
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
       //get the value and delete
      //echo "get value and deleted.";
      $id=$_GET['id'];
      $image_name=$_GET['image_name'];
      
      //remove the physical image file 
      if($image_name!="")
        {
        //image is available
        $path="../images/food/".$image_name;
        //remove the image
        $remove=unlink($path);

        if($remove==false)
            {
            //set the session msg
            $_SESSION['upload']="<div class='error'>Failed To Remove Image.</div>";
            //redirect to manage category page
            header('location:'.SITEURL.'admin/manage-food.php');
            //stop the process
            die();
             }

        }
      //delete food from the database
      $sql="DELETE FROM tbl_food WHERE id=$id";
      $res=mysqli_query($conn,$sql);
      if($res==true)
        {
            //set success msg and redirect
            $_SESSION['delete']="<div class='success'>Food Deleted Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            //set fail msg and redirect
            $_SESSION['delete']="<div class='error'>Failed to Delete Food.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');

        }


      //redirect to manage category page with msg

    }
    else
    {   
        $_SESSION['unauthorized']="<div class='error'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }

?>