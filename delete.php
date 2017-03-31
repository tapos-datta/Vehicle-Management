<?php
session_start();

include_once("database.php");

    if(isset($_SESSION['u_id'])){
              $u_id=$_SESSION['u_id'];
                  $member_id=0;
                 $path="";
          if(isset($_POST['r_id']) && !empty($_POST['r_id'])){
              
       
              $value=$_POST['r_id'];
              $sql_query="delete from vehicle_info where vl_id='$value'";
       
              if($con->query($sql_query)==true){
            
              //find one of vehicle existing for the user
          
                 
                $sql_search = "select MEMBER_ID,PICTURE_PATH from info where user_id='$u_id'";
            
               $result = $con->query($sql_search);
                 
               if($result->num_rows > 0){
                   $row=$result->fetch_assoc();
                  
                   $member_id=$row['MEMBER_ID'];
                   $path=$row['PICTURE_PATH'];
               }
            
               $sql_search="select vl_id from vehicle_info where member_id='$member_id'";
               $result = $con->query($sql_search);
            
                if($result->num_rows > 0)
                 {
                   header("location: http://localhost/project/user.php?'$u_id'");
                 }
                  else
                  {
                    
                   $sql_query="delete from info where MEMBER_ID='$member_id'";    //delete user info
                   if($con->query($sql_query)==true){
                       
                     $sql_query="delete from login where user_id='$u_id'";   //delete login info
                       
                       if (file_exists($path)) {
                          unlink($path);                 //elete profile picture also
                         }
                       
                       if($con->query($sql_query)==true){
                           
                           $_SESSION['logout']=1;
                            header("location: http://localhost/project/login.php");
                           
                       }
                       
                   } 
                    
                }
           }
       }
       
   }else{
        header("location: http://localhost/project/login.php");
    }
             