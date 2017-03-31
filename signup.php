
<?php include_once("headersub.php");?>
<!DOCTYPE html>
<html>
    <head>
        <title>Registration</title>
        <link rel="stylesheet" href="bootstrap.min.css">
        <style>
            h1{
                font-size: 45px;
                
                text-align: center;
            }
            h3{
                font-size: 20px;
               
                margin-left: 120px;
            }
            .design{
                width: 21em;
                height: 2em;
                font-size: 16px;
                margin-left: 20px;
                margin-bottom: 20px;
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
            #sdesign{
              margin-left: 355px;
                height: 40px;
                width: 100px;
                font-size: 20px;
                -webkit-border-radius: 5px;
                 -moz-border-radius: 5px;
                  border-radius: 5px;
                
            }
            #button4{
                
                 height: 50px;
                 font-size: 20px;
                margin-left: 585px;
                 -webkit-border-radius: 5px;
                 -moz-border-radius: 5px;
                  border-radius: 5px;
            }
            body{
                 background-color: beige;
            }
            
            
        </style>
        
        <?php
          include_once("database.php");
            
        $flag=0;
        global $page;
        $page=0;
    ?>
    </head>
    <body >
        <h1>SIGN UP</h1>
        
        
        <?php
            
        //check all field is occupied
            
        
        
           
          if($flag==0 && isset($_POST['firstname']) && !empty($_POST['firstname']) && isset($_POST['lastname']) && !empty($_POST['lastname']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['phnNo']) && !empty($_POST['phnNo']) &&  isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['cpassword']) && !empty($_POST['cpassword']) && $_POST['password']==$_POST['cpassword'])
          {
              
              $fname= strtoupper(htmlentities($_POST['firstname']));
              $lname= strtoupper(htmlentities($_POST['lastname']));
              $mail= strtoupper(htmlentities($_POST['email']));
              $phnNo=htmlentities($_POST['phnNo']);
             /*
              $vehicleType= strtoupper(htmlentities($_POST['VehicleType']));
              $vehicleModel= strtoupper(htmlentities($_POST['VehicleModel']));
              $vehicleCompany= strtoupper(htmlentities($_POST['VehicleCompany']));
              $vehicleNumber= strtoupper(htmlentities($_POST['VehicleNumber']));
              */
              $u_id=htmlentities($_POST['username']);
              $pass=md5(htmlentities($_POST['password']));
              $user_id=0;
           //   echo "name ".$fname." ".$lname." ".$mail." ".$phnNo." ".$vehicleType." ".$vehicleModel." ".$vehicleCompany." ".$vehicleNumber." ".$u_id." ".$pass;
              /* store user name and pass to data base login table */
              
              $vehicle_id=0;
              $company_id=0;
              $model_id=0;
              $member_id=0;
              
                   $sql_insert="INSERT INTO login (user_name,pass) values('$u_id','$pass')";
                   if($con->query($sql_insert)==true){
                  //search user id
                     $sql_search= "select user_id from login where user_name='$u_id' and pass='$pass'";
                     $result = $con->query($sql_search);
                     // echo "user log in ".$result->num_rows;
                      if($result->num_rows > 0)
                      {
                           $row=$result->fetch_assoc();
                             $user_id=$row['user_id'];
                       }
                  }
              
              
              /* searching  to find vehicle type  */
               // is exits in vehicle type
               /*
               $sql_search= "select v_id from vehicle_name where v_name='$vehicleType'";
                $result = $con->query($sql_search);
              //echo "user v_id in ".$result->num_rows."<br>";
               if($result->num_rows > 0){
                   $row=$result->fetch_assoc();
                   $vehicle_id=$row['v_id'];
               }
              else{
                  //insert vehicle id to database 
                  
                   $sql_insert="INSERT INTO vehicle_name (v_name) values('$vehicleType')";
                   if($con->query($sql_insert)==true){
                  //search vehicle id
                      // echo "successfull";
                     $sql_search= "select v_id from vehicle_name where v_name='$vehicleType'";
                     $result = $con->query($sql_search);
                      
                      if($result->num_rows > 0)
                      {
                           $row=$result->fetch_assoc();
                             $vehicle_id=$row['v_id'];
                       }
                  }
                 // else{ echo "unsuccessfull<br>";}
              }
              /* searching end to find vehicle type  */
              /* searching  to find vehicle company  */
             
              /*
              $sql_search= "select c_id from company_name where c_name='$vehicleCompany'";
                $result = $con->query($sql_search);
               if($result->num_rows > 0){
                   $row=$result->fetch_assoc();
                   $company_id=$row['c_id'];
               }
              else{
                  //insert company name to database 
                  
                   $sql_insert="INSERT INTO company_name (c_name,v_id) values('$vehicleCompany','$vehicle_id')";
                   if($con->query($sql_insert)==true){
                  //search Company id
                      // echo "successfull";
                     $sql_search= "select c_id from company_name where c_name='$vehicleCompany'";
                     $result = $con->query($sql_search);
                      
                      if($result->num_rows > 0)
                      {
                           $row=$result->fetch_assoc();
                             $company_id=$row['c_id'];
                       }
                  }
              }
              
              /* searching end to find comapny name ,id  */
              
               /* searching  to find vehicle model */
             /*
              $sql_search= "select m_id from model where m_name='$vehicleModel'";
                $result = $con->query($sql_search);
               if($result->num_rows > 0){
                   $row=$result->fetch_assoc();
                   $model_id=$row['m_id'];
               }
              else{
                  //insert company name to database 
                  
                   $sql_insert="INSERT INTO model (m_name,c_id) values('$vehicleModel','$company_id')";
                   if($con->query($sql_insert)==true){
                  //search Company id
//echo "successfull";
                     $sql_search= "select m_id from model where m_name='$vehicleModel'";
                     $result = $con->query($sql_search);
                      
                      if($result->num_rows > 0)
                      {
                           $row=$result->fetch_assoc();
                             $model_id=$row['m_id'];
                       }
                  }
              }
              
              /* searching end to find comapny name ,id  */
              /*picture handle */
           
              //echo "first round";
                      $path;
                      $target_dir ="upload/";
                 //echo  $_FILES["file1"]["tmp_name"];
                    if(!empty($_FILES["file"]["tmp_name"])){
                     // echo  $_FILES["file"]["tmp_name"];  
                      $temp = explode(".", $_FILES["file"]["name"]);
                        
                      $new_name=round(microtime(true)).".".end($temp);
                      $target_file=$target_dir.basename($_FILES["file"]["name"]);
            
                      $uploadOk=1;
                      $imageFileType =pathinfo($target_file,PATHINFO_EXTENSION);
                     //check if image file is a actual image or face image
        
            
                     
                     $check =getimagesize($_FILES["file"]["tmp_name"]);
                
                     if($check!=false){
                             //echo " FILE IS AN IMAGE-".$check['mime'].".";
                             $uploadOk=1;
                    }
                    else{
                            // echo "FILE IS NOT AN IMAGE.";
                         $uploadOk=0;
                    }
         
                         // Check if file already exists
                    if (file_exists($target_file)) {
                         // echo "Sorry, file already exists.";
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
                            
        
                    //Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                                 // echo "Sorry, your file was not uploaded.";
                            // if everything is ok, try to upload file
                    } else {
                          if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir.$new_name)) {
                               // echo "The file ". basename( $_FILES["file"]["name"]). " has been    uploaded.";
                              $path=$target_dir.$new_name;
                          } else {
                              // echo "Sorry, there was an error uploading your file.";
                         }
                      }
                    }
                      else{
                         $path=$target_dir."default_user.jpg"; 
                      }
              
               // echo "name ".$fname." ".$lname." ".$mail." ".$phnNo."  ".$u_id." ".$pass;
              
              if($user_id!=0 && !filter_var($mail, FILTER_VALIDATE_EMAIL) === false){
               $sql_insert= "INSERT INTO info (first_name,last_name,email,phone_no,picture_path,user_id) VALUES('$fname','$lname','$mail','$phnNo','$path','$user_id')";
              
               if($con->query($sql_insert)==true){//executed query 
                  
                  /*
                   $sql_search = "select MEMBER_ID from info where user_id='$user_id'";
                   
                   $result = $con->query($sql_search);
                      
                      if($result->num_rows > 0)
                      {
                           $row=$result->fetch_assoc();
                             $member_id=$row['MEMBER_ID'];
                        //  echo $member_id;
                      }
               }
                   
               $sql_insert="insert into vehicle_info (member_id,v_id,c_id,m_id,v_number)
               values('$member_id','$vehicle_id','$company_id','$model_id','$vehicleNumber')";
              
                    if($con->query($sql_insert)==true){
                    */
              ?>
                     <h1>SUCCESSFULLY REGISTERED. </h1>   
                <div>
                   <a  href="http://localhost/project/index.php" target="_self">
                    <button type='button' id="button4">BACK TO HOME</button>
            
               </div>
                    
                <?php echo "<br>";                                
                            $flag=1;
                    }
                  else{
                              $flag=0;
                    }
               }
          }
            
            if(!empty($_POST['sub']) && $flag==0){
                ?><div class="row">
                    <div class="col-md-offset-3">
                        <h3>FILL UP ALL FIELD WITH CORRECT DATA</h3> 
                    
                    </div>
                    
                    </div>
                    <?php echo "<br>";
            }
            
                if($flag==0){
                      //data collecet from a html form
            ?>
        
        <div class="row">
            <div class="col-lg-1"></div>
            <form class="form-style"  action="signup.php" method="post" enctype="multipart/form-data">
                <div class="col-lg-8"> 
                <ul>
                    <li><label>FIRST NAME:</label><input type='text' class="design" name='firstname' required/>
                    </li>
                     <li><label>LAST NAME:</label><input type='text' class="design" name='lastname' required/>
                    </li>
                    <li><label>E-MAIL:</label><input type='text' class="design" name='email' required/>
                    </li>
                     <li><label>PHONE NO:</label><input type='text' class="design" name='phnNo'/>
                    </li>
                     <li><label>USERNAME:</label><input type='text' class="design" name='username' required/>
                    </li>
                     <li><label>PASSWORD:</label><input type='password' class="design" name='password' required/>
                    </li>
                     <li><label>CONFIRM PASSWORD:</label><input type='password' class="design" name='cpassword' required/>
                    </li>
                    <li><label for="file">UPLOAD PICTURE:  </label><input type="file" name="file" id="file" class="design" />
                    </li>
                </ul>
                
                </div>
                    
                <div class="row">
                    <div class="col-lg-offset-3" style="margin-bottom:3em">
                    <input type="submit" class="btn btn-success" id="sdesign" name='sub' value="submit"/>
                    </div>
                </div>
             </form>
        </div>
        
        
        
        <?php
                }
        $con->close();
        
        ?>
    </body>

</html>