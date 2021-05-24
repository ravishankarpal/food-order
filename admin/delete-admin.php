<?php
    include ('../config/constants.php');

    //1.Get the id of admin to be deleted.
    $id=$_GET['id'];

    //2.Create SQL query to delete admin
    $sql="DELETE FROM tbl_admin WHERE id=$id";

    //Execute the query
    $res=mysqli_query($conn,$sql);

    //Check wheteher the query is successfully executed or not
    if($res==TRUE){
        //echo "Admin deleted";
        $_SESSION['delete']="<div class='success'>Admin Deleted Successfully</div)";
        //view message in manage admin page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else{
        echo "not deleted";
        $_SESSION['delete']="<div class='error'>Failed To Delete Admin.</div>";
        header('localhost:'.SITEURL.'admin/manage-admin.php');
    }

   //3.Redirect to manage admin page with msg(success/error).

?>