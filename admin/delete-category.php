<?php 
    include('../config/constants.php');
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
       //get the value and delete
      //echo "get value and deleted.";
      $id=$_GET['id'];
      $image_name=$_GET['image_name'];
      
      //remove the physucal image file 
      if($image_name!="")
      {
        //image is available
        $path="../images/category/".$image_name;
        //remove the image
        $remove=unlink($path);

        if($remove==false)
        {
            //set the session msg
            $_SESSION['remove']="<div class='error'>Failed To Remove Category Image.</div>";
            //redirect to manage category page
            header('location:'.SITEURL.'admin/manage-category.php');
            //stop the process
            die();

        }

      }
      //delete from the database
      $sql="DELETE FROM tbl_category WHERE ID=$id";
      $res=mysqli_query($conn,$sql);
      if($res==true)
      {
        //set success msg and redirect
        $_SESSION['delete']="<div class='success'>Category Deleted Successfully.</div>";
        header('location:'.SITEURL.'admin/manage-category.php');
       }
      else
      {
        //set fail msg and redirect
        $_SESSION['delete']="<div class='error'>Failed To Delete Category.</div>";
        header('location:'.SITEURL.'admin/manage-category.php');

      }


      //redirect to manage category page with msg

    }
    else
    {
        header('location:'.SITEURL.'admin/manage-category.php');
    }

?>