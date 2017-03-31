<!DOCTYPE html>
<html>
    <head>
    <title>transfering vehicle</title>
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
            #edit2{
                margin-left: 2em;
            }
             body{
                background-color: beige;
            }
        
        
        </style>
    
    </head>
    
    <body>
       
        <?php session_start();
        include_once("database.php");
        include_once("header.php");
        
         if(!isset($_SESSION['member_id']))
             {die("ERROR");}
        
        ?> <h1>TRASFERING VEHICLE TO OTHER MEMBER</h1> </br><?php
        $flag=0;
        
        $sql_search="select MEMBER_ID,FIRST_NAME,LAST_NAME from info";
        $result = $con->query($sql_search);
        $memid=$_SESSION['member_id'];
         $sql_vehicle = "SELECT vl_id, v_id, c_id, v_number from vehicle_info where member_id = '$memid'";
        $res_vehicle = $con->query($sql_vehicle);
        
        /*Transfering vehicle one member id to another member id using vehilce id from vehicle_info using memberid from info table */
        
        if(isset($_POST['vehicle_id']) && !empty($_POST['vehicle_id']) && isset($_POST['t_id']) && !empty($_POST['t_id']) && $_POST['t_id']!="null" && $_POST['vehicle_id']!="null" && isset($_POST['pass']) && !empty($_POST['pass'])){
            
            $pass=md5(htmlentities($_POST['pass']));
            $u_id=$_SESSION['u_id'];
            
            $sql= "SELECT * from login where user_id='$u_id' and pass='$pass'";
                 $result_search = $con->query($sql);
              //echo "user v_id in ".$result->num_rows."<br>";
          if($result_search -> num_rows > 0){
             
                     $tan_id=$_POST['t_id'];
                     $v_id=$_POST['vehicle_id'];
                     $sql_change="update vehicle_info set member_id='$tan_id' where vl_id='$v_id'";
                     if($con->query($sql_change)==true){
                
                      $date=date("Y-m-d");
            
                     $sql_insert="insert into owner_list (vl_id,member_id,date) values('$v_id','$tan_id','$date')";
            
                    if($con->query($sql_insert)==true){
                          ;
                     }
                
                     $flag=1;
                  }
                  else
                     $flag=0; 
            
               }
            
           }
        if(isset($_POST['sub']) &&  $flag==0){
        ?> <h3> INCORRECT DATA</h3></br>
        <?php
        }
        
        if($flag==0){
            
        
        ?>
        
        
        
        
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-11">
                <form action="transfer.php" method="post">
                 <ul>
                     <li><label>YOUR VEHICLE ID:</label>
                         
                         <select name = 'vehicle_id' class='design' >
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
                      <li><label>TRANSFER TO( MEMBER ID and NAME ) :</label>
                       <select name='t_id' class="design">
                        <option value="null">  </option>
                  <?php 
                        while($row=$result->fetch_assoc()){
                            $t_id=$row['MEMBER_ID'];
                            $name=$row['FIRST_NAME']." ".$row['LAST_NAME'];
                            if($_SESSION['member_id']==$t_id)
                                continue;
                            
                     ?>
                        <option value="<?php echo $t_id;?>"> <?php echo $t_id."-".$name;?> </option>
                      
                          
                 <?php 
                        }
                 ?>
                      </select>       
                    </li>
                     <li>
                        <li><label>PASSWORD : </label><input type='password' class="design" name='pass' required/>
                     </li>
             </div>
            <div class="row">
              <div class="col-lg-5"></div>
                <div class="col-lg-6">
                <input type="submit" class="btn btn-info" id="sdesign" name='sub' value="submit" onclick=" return confirmation()"/>
                   
                </div>
            </div>
        </form>
    </div>
                
            <?php
        }
        else if($flag==1){
            
            
            ?>
                <h1>SUCCESSFULLY TRANSFERRED.</h1></br>
    <?php
        }
     ?>
     <script>
      function confirmation(){
          var r = confirm("ARE YOU SURE TO DO THIS OPERATION?");      //using javascript for confirmation message when delete button press
          return r ;
        }
    </script>   
    
    </body>

</html>