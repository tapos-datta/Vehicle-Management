
<!DOCTYPE html>
<html>
    <head>
        <title>statusupdate</title>
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
                  margin-top: -.25em;
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
            #edit2{
                margin-left: 2em;
            }
            #box5{
                height: auto;
            }
        
        </style>
    </head>
    <body>
        
        <?php
            $flag=0;
            session_start();
            include_once("database.php");
            include_once("header.php");
        
             if(!isset($_SESSION['member_id']))
             {die("ERROR");}
           
           ?> <h1>UPDATE STATUS OF EXISTING VEHICLE</h1></br> <?php
        /* updating status of user vehicle using vehicle id from vehicle_info */  
          if(!empty($_SESSION['u_id'])){
                
                $member_id=$_SESSION['member_id'];
                $memid=$_SESSION['member_id'];
             $sql_vehicle = "SELECT vl_id, v_id, c_id, v_number from vehicle_info where member_id = '$memid'";
             $res_vehicle = $con->query($sql_vehicle);   
                
                if(isset($_POST['vl_id']) && !empty($_POST['vl_id']) && isset($_POST['status']) && !empty($_POST['status']) && $_POST['vl_id']!="null")
                {
                    $id=htmlentities($_POST['vl_id']);
                    $st=htmlentities($_POST['status']);
                    
                    $sql_update="update vehicle_info set v_status='$st' where vl_id='$id' and member_id='$member_id'";
                    $con->query($sql_update);
                    $sql_search="select v_status from vehicle_info where vl_id='$id' and member_id='$member_id'";
                    
                    
                      $result = $con->query($sql_search);
              //echo "user v_id in ".$result->num_rows."<br>";
               if($result->num_rows > 0){
                        ?>
                    <h1> successfully updated</h1>
               <?php
                        $flag=1;
                        
                    }
                    
                }
               
                
            }
        if(isset($_POST['sub']) && $flag==0){
                     ?><h1> incurrect data </h1> <?php
                }
           
         if($flag==0){
         ?>
         
         <form action="status.php" method="post">
        
           <div class="row" >
               <div class="col-lg-1"></div>
               <div class="col-lg-11">
               
                  <ul>
                      <li><label>VEHICLE ID NUMBER:</label>
                          
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
                     <li><label>STATUS:</label><input type='text' class="design" name='status' required/>
                   </ul>
               
               </div>
               
               </div>
             
           <div class="row" id="box5">
              <div class="col-lg-5"></div>
              <div class="col-lg-7">
              <input type="submit" class="btn btn-info" id="sdesign" name='sub' value="submit"/>
              </div>
          </div>
        </form>
                         
        <?php
         }
        ?>
    </body>


</html>