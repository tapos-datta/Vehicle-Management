<!DOCTYPE html>
<html>
    <head>
        <title>edit_info</title>
        <link rel="stylesheet" href="bootstrap.min.css">
        <style>
            h1,h3{
                text-align: center;
            }
            .design{
                width: 25em;
                height: 2em;
                font-size: 16px;
                margin-left: 20px;
                margin-bottom: 20px;
                -webkit-border-radius: 5px;
                 -moz-border-radius: 5px;
                border-radius: 5px;
            }
            #sdesign{
                margin-left: 2em;
                height: 2em;
                width: 10em;
                font-size: 20px;
                margin-bottom: 3em;
                -webkit-border-radius: 5px;
                 -moz-border-radius: 5px;
                  border-radius: 5px;
                
            }
             ul li{
                clear: both;
                list-style-type: none;
                
            }
            label{
                font-size: 20px;
                
                text-align: right;
                display: block;
                float: left;
                width: 20em;
                margin-right: 0.5em;
               
            }
            #box5{
                margin-top: 2em;
                margin-left: 7em;
                
            }#edit{
                
            }
             body{
                background-color: beige;
            }
            #point{
                margin-left: 40%;
            }
        
        </style>
    
    </head>
    <body>
        
        <?php
        session_start();
           include_once("database.php");
            include_once("header.php");
            ?><h1>EDIT INFORMATION</h1></br><?php
           $flag=0;
        //profile editing 
          
             $fname=$lname=$email=$phone=$pic=$path="";
             $member_id=0;
             $rowNumber=0;
             
            if(isset($_SESSION['u_id'])){
                  $u_id=$_SESSION['u_id'];
                 
                 $sql_search = " select MEMBER_ID,PICTURE_PATH from info where user_id = '$u_id'";
                 
                 $result = $con->query($sql_search);
                 
               if($result->num_rows > 0){
                   $row=$result->fetch_assoc();
                   $pic=$row['PICTURE_PATH'];
                   $_SESSION['member_id']=$member_id=$row['MEMBER_ID'];
                }
            }
         
        
            if(isset($_POST['firstname']) && !empty($_POST['firstname']) && isset($_POST['lastname']) && !empty($_POST['lastname']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['phnNo']) && !empty($_POST['phnNo'])){
                
                $fname=strtoupper(htmlentities($_POST['firstname']));
                $lname=strtoupper(htmlentities($_POST['lastname']));
                $email=strtoupper(htmlentities($_POST['email']));
                $phn=htmlentities($_POST['phnNo']);
                
                    $target_dir ="upload/";
                    if(!empty($_FILES["file"]["tmp_name"]))
                    {
                      $temp = explode(".", $_FILES["file"]["name"]);
                        
                      $new_name=round(microtime(true)).".".end($temp);
                      $target_file=$target_dir.basename($_FILES["file"]["name"]);
            
                      $uploadOk=1;
                      $imageFileType =pathinfo($target_file,PATHINFO_EXTENSION);
                     //check if image file is a actual image or face image
        
            
                     
                     $check =getimagesize($_FILES["file"]["tmp_name"]);
                
                     if($check!=false){
                            // echo " FILE IS AN IMAGE-".$check['mime'].".";
                             $uploadOk=1;
                    }
                    else{
                            // echo "FILE IS NOT AN IMAGE.";
                         $uploadOk=0;
                    }
         
                         // Check if file already exists
                    if (file_exists($target_file)) {
                          //echo "Sorry, file already exists.";
                         $uploadOk = 0;
                    }
                       // Check file size
                     if ($_FILES["file"]["size"] > 500000) {
                            // echo "Sorry, your file is too large.";
                          $uploadOk = 0;
                    }
                        // Allow certain file formats
                     if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                         && $imageFileType != "gif" ) {
                             // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                              $uploadOk = 0;
                      }
                            
        
                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                                 // echo "Sorry, your file was not uploaded.";
                            // if everything is ok, try to upload file
                    } else {
                          if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir.$new_name)) {
                               // echo "The file ". basename( $_FILES["file"]["name"]). " has been    uploaded.";                   
                              //echo "uploaded";
                              $path=$target_dir.$new_name;
                          } 
                      }
                    }
                $sql_update="";
                if($path!=""){
                  //  echo "tapos";
                    $sql_update="update info set FIRST_NAME='$fname',LAST_NAME='$lname',EMAIL='$email',PHONE_NO='$phn',PICTURE_PATH='$path' where MEMBER_ID='$member_id'";
                    
                }
                else{
                   // echo "datta";
                      $sql_update="update info set FIRST_NAME='$fname',LAST_NAME='$lname',EMAIL='$email',PHONE_NO='$phn' where MEMBER_ID='$member_id'";
                }
                 $message=0;    //
                if(isset($_POST['vl_id']) && !empty($_POST['vl_id']) && $_POST['vl_id']!="null" && !empty($_FILES["file1"]["tmp_name"])){
                    
                    $target_dir ="vehicle/";
                    
                    
                      $temp = explode(".", $_FILES["file1"]["name"]);
                        
                      $new_name=round(microtime(true)).".".end($temp);
                      $target_file=$target_dir.basename($_FILES["file1"]["name"]);
            
                      $uploadOk=1;
                      $imageFileType =pathinfo($target_file,PATHINFO_EXTENSION);
                     //check if image file is a actual image or face image
        
            
                     
                     $check =getimagesize($_FILES["file1"]["tmp_name"]);
                
                     if($check!=false){
                            // echo " FILE IS AN IMAGE-".$check['mime'].".";
                             $uploadOk=1;
                    }
                    else{
                            // echo "FILE IS NOT AN IMAGE.";
                         $uploadOk=0;
                    }
         
                         // Check if file already exists
                    if (file_exists($target_file)) {
                          //echo "Sorry, file already exists.";
                         $uploadOk = 0;
                    }
                       // Check file size
                     if ($_FILES["file1"]["size"] > 500000) {
                            // echo "Sorry, your file is too large.";
                          $uploadOk = 0;
                    }
                        // Allow certain file formats
                     if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                         && $imageFileType != "gif" ) {
                             // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                              $uploadOk = 0;
                      }
                            
        
                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                                 // echo "Sorry, your file was not uploaded.";
                            // if everything is ok, try to upload file
                    } else {
                          if (move_uploaded_file($_FILES["file1"]["tmp_name"], $target_dir.$new_name)) {
                               // echo "The file ". basename( $_FILES["file"]["name"]). " has been    uploaded.";                   
                             
                              $path=$target_dir.$new_name;
                              $vl_id=htmlentities($_POST['vl_id']);
                              
                              $sql_update="update vehicle_info set v_path='$path' where vl_id='$vl_id'";
                              
                              if($con->query($sql_update)==true){
                                  $messsage=1;
                              }
                          } 
                      }
                    }
                
                
                if($con->query($sql_update)==true)
                {
                    ?>
                      <h1>SUCCESSFULLY UPDATED.</h1>
                    
                   <?php
                    if($message==0)
                     ?>
                       </br> <h3>VEHICLE IMAGE NOT UPDATED.</h3>
                    
                   <?php   
                    $flag=1;
                    echo "<br>";
                }
                
                
            }
        
        
             if(isset($_SESSION['u_id'])){
                  $u_id=$_SESSION['u_id'];
                 
                 $sql_search = " select * from info where user_id = '$u_id'";
                 
                 $result = $con->query($sql_search);
                 
               if($result->num_rows > 0){
                   $row=$result->fetch_assoc();
                   $fname=$row['FIRST_NAME'];
                   $lname=$row['LAST_NAME'];
                   $email=$row['EMAIL'];
                   $phone=$row['PHONE_NO'];
                   $pic=$row['PICTURE_PATH'];
                   $member_id=$row['MEMBER_ID'];
               }
             
             }else{
                 
                 die("ERROR");
             }
    
             $memid=$_SESSION['member_id'];
             $sql_vehicle = "SELECT vl_id, v_id, c_id, v_number from vehicle_info where member_id = '$memid'";
             $res_vehicle = $con->query($sql_vehicle);  
        
        
        
        if($flag==0){
        ?>
        <form action="edit.php" method="post" enctype="multipart/form-data">
         <div class="row">
             <div class="col-lg-1"></div>
             <div class="col-lg-8">
                   <ul>
                      <li><label>FIRST NAME:</label><input type='text' class="design" name='firstname' value="<?php echo $fname;?>"/>
                      </li>
                      <li><label>LAST NAME:</label><input type='text' class="design" name='lastname' value="<?php echo $lname;?>"/>
                      </li>
                      <li><label>E-MAIL:</label><input type='text' class="design" name='email' value="<?php echo $email;?>"/>
                      </li>
                      <li><label>PHONE NO:</label><input type='text' class="design" name='phnNo' value="<?php echo $phone;?>"/>
                      </li>
                      <li><label for="file">UPLOAD PICTURE:  </label><input type="file" name="file" id="file" class="design" />
                    </li>
                       
                       
                        <li><label>UPDATE VEHICLE IMAGE:</br></label></li>
                      <li><label>VEHICLE NUMBER</label>
                          
                           <select name = 'vl_id' class='design' >
                        <option value="null"> </option> 
                            <?php 
                                  while( $row_vehicle = $res_vehicle->fetch_assoc()) 
                                  {
                                    //echo " while e asche <br>";
                                    $vl_id = $row_vehicle['vl_id'];
                                    $v_id = $row_vehicle['v_id'];
                                    $c_id = $row_vehicle['c_id'];
                                    $v_num = $row_vehicle['v_number'];

                                    $sql_vname = "SELECT v_name from vehicle_name where V_id='$v_id' ";
                                    $res_vname = $con->query($sql_vname);
                                    if($res_vname->num_rows > 0 )
                                    {
                                      $row_vname = $res_vname->fetch_assoc();
                                      $v_name = $row_vname['v_name'];
                                    }

                                    //company name to process
                                    /*
                                    $sql_vname = "SELECT c_name from company_name where c_id='$c_id' ";
                                    $res_vname = $con->query($sql_vname);
                                    if($res_vname->num_rows > 0 )
                                    {
                                      $row_vname = $res_vname->fetch_assoc();
                                      $c_name = $row_vname['c_name'];
                                    }
                                    */

                                    ?>

                                    <option value='<?php echo $vl_id; ?>'> <?php echo "$vl_id > $v_name > $v_num" ?> </option>

                                    <?php 
                                  }
                            ?>
                        </select> 
                    </li>
                    <li><label for="file">UPLOAD IMAGE:  </label><input type="file" name="file1" id="file" class="design" />
                    </li> 
                  </ul>
             </div>
        </div>
            <div class="row">
              <div class="col-lg-5"></div>
                <div class="col-lg-6">
                <input type="submit" class="btn btn-info" id="sdesign" name='sub' value="submit"/>
                   
                </div>
            </div>
              </form>
        <?php
          }
        ?>
       
    </body>

</html>