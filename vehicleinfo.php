<!DOCTYPE html>
<html>
    <head>
        <title>vehicle_info</title>
        <link rel="stylesheet" href="bootstrap.min.css">
        <style>
            h1{
                text-align: center;
            }
            .design{
                width: 350px;
                height: 25px;
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
              #sdesign{
                margin-left: 2em;
                height: 2em;
                width: 10em;
                font-size: 20px;
                -webkit-border-radius: 5px;
                 -moz-border-radius: 5px;
                  border-radius: 5px;
                
            }
            label{
                font-size: 20px;
                text-align: right;
                display: block;
                float: left;
                width: 20em;
                margin-right: 0.5em;
               
            }
             #edit{
                margin-left: 2em;
            }
             body{
                background-color: beige;
            }
        
        </style>
    </head>
    <body>
        <?php
        session_start();
        include_once("database.php");
        $flag=0;
         include_once("header.php"); 
         
        if(!isset($_SESSION['member_id']))
            die("ERROR");
        
        /* add new vehicle under a user .first collect vehicle name ,company,model and number then find their id from vehicle_name,company_name,model then insert all data into vehicle_info with member_id
        */
        
        if(isset($_POST['VehicleType']) && !empty($_POST['VehicleType']) && isset($_POST['VehicleCompany']) && !empty($_POST['VehicleCompany']) && isset($_POST['VehicleModel']) && !empty($_POST['VehicleModel']) && isset($_POST['VehicleNumber']) && !empty($_POST['VehicleNumber'])){
            
              $vehicleType= strtoupper(htmlentities($_POST['VehicleType']));
              $vehicleModel= strtoupper(htmlentities($_POST['VehicleModel']));
              $vehicleCompany= strtoupper(htmlentities($_POST['VehicleCompany']));
              $vehicleNumber= strtoupper(htmlentities($_POST['VehicleNumber']));
              $vehicle_id=0;
              $company_id=0;
              $model_id=0;
              $vl_id=0;
              
            
             /* searching  to find vehicle type  */
               // is exits in vehicle type
            
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
            
            $member_id=$_SESSION['member_id'];
            
            
                  $target_dir ="vehicle/";
                     $path="";
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
                if(strcmp($path,"")==0)
                    $path="vehicle/default.jpg";
            
            
            
            
            
            
            $sql_insert="INSERT INTO vehicle_info (member_id,v_id,c_id,m_id,v_number,v_path) values('$member_id','$vehicle_id','$company_id','$model_id','$vehicleNumber','$path')";
            
            if($con->query($sql_insert)==true){
                
                $sql_search="select vl_id from vehicle_info where member_id='$member_id' and v_number='$vehicleNumber'";
                 $result1 = $con->query($sql_search);
                      
                      if($result1->num_rows > 0)
                      {
                           $row=$result1->fetch_assoc();
                             $vl_id=$row['vl_id'];
                      }
                  
               $date=date("Y-m-d");
            
            $sql_insert="insert into owner_list (vl_id,member_id,date) values('$vl_id','$member_id','$date')";
            
            if($con->query($sql_insert)==true){
                ;
            }
            
                
        ?> <h1> SUCCESSFULLY ADDED VEHICLE </h1></br>

          <?php
                $flag=1;
                
                
            }
            
             
            
        }
        if(isset($_POST['sub']) && $flag==0){
            ?><h1> ERROR </h1><?php 
        }
        
        
        if($flag==0){
        
        ?>
    <h1> ADD VEHICLE INFORMATION</h1></br>
        
      <form  action="vehicleinfo.php" method="post" enctype="multipart/form-data">
        <div  class="row">
            <div class="col-lg-1" ></div>
            <div class="col-lg-9">
                <ul>
                    <li><label>VEHICLE TYPE:</label><input type='text' class="design" name='VehicleType'required/>
                    </li>
                     <li><label>VEHICLE COMPANY:</label><input type='text' class="design" name='VehicleCompany' required/>
                    </li>
                    <li><label>VEHICLE MODEL:</label><input type='text' class="design" name='VehicleModel' required/>
                    </li>
                     <li><label>VEHICLE NUMBER:</label><input type='text' class="design" name='VehicleNumber' required />
                    </li> 
                    <li><label for="file">VEHICLE PICTURE:  </label><input type="file" name="file" id="file" class="design" />
                    </li>
                </ul>
             </div>
          </div>
          <div class="row">
          <div class="col-lg-5"></div>
              <div class="col-lg-7">
              <input type="submit" class="btn btn-info" id="sdesign" name='sub' value="submit"/>
              </div>
          </div>
              </form>
            
            
        </div>

    <?php
        }
    ?>
        
    </body>

</html>