<?php include_once("headersub.php");?>
<!DOCTYPE html>
<html>
<head>
     <link rel="stylesheet" href="bootstrap.min.css">
    <style>
        #box{
            margin-left:2em;
            margin-bottom: 2em;
            border-style: outset;
            
        }
           label{
                font-size: 20px;
                text-align: left;
                display: block;
                float: left;
                width: 20em;
                margin-right: 0.5em;
               margin-left: 1em;
               margin-top: .25em;
               
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
    //echo $_SESSION['v_type'].$_SESSION['v_company']. $_SESSION['v_model']. $_SESSION['v_number'];
      
      //find existing all data according with input data
      
     if(isset($_SESSION['v_type']) && isset($_SESSION['v_company']) && isset($_SESSION['v_model']) && isset($_SESSION['v_number'])){
         
         $name=$_SESSION['v_type'];
         $company=$_SESSION['v_company'];
         $model=$_SESSION['v_model'];
         $number=$_SESSION['v_number'];
         
          
         $sql_search="select vl_id,member_id,v_id,c_id,m_id,v_status,v_number,v_path from vehicle_info where v_id=(select v_id from vehicle_name where v_name='$name') and c_id=(select c_id from company_name where c_name='$company') and m_id=(select m_id from model where m_name='$model') and v_number='$number' ";
         
        $result = $con->query( $sql_search );
         //if data found
        if($result->num_rows > 0 ) {
            
		      $row_vehicle_info = $result->fetch_assoc();
		
		       $vl_id = $row_vehicle_info['vl_id'];
          
		      $cur_member_id = $row_vehicle_info['member_id'];

		        $v_id = $row_vehicle_info['v_id'];
		        $c_id = $row_vehicle_info['c_id'];
		        $m_id = $row_vehicle_info['m_id'];
		        $v_number = $row_vehicle_info['v_number'];
		        $v_status = $row_vehicle_info['v_status'];
                $image =$row_vehicle_info['v_path'];
            
            ?>
              <h1>searched result:</br></h1>
              <div class="row">
               <div class="col-lg-2"> </div>
                <div class="col-lg-6">
                    
                    <label> VEHICLE TYPE : <?php echo $name?></label></br>
                   <label> VEHICLE COMPANY : <?php echo $company?></label></br>
                   <label> VEHICLE MODEL : <?php echo $model?></label></br>
                   <label> VEHICLE NUMBER : <?php echo $number?></label></br>
                   <label> VEHICLE STATUS : <?php echo $v_status?></label></br>
                   <label> OWNER OF VEHICLE : </label></br> 
                  </div>
                <div class="col-lg-2">
                    <img width="200" height="200" src="<?php echo $image; ?>" />
                 </div>
            </div>
     <?php
                
                 $sql_owner_list = "SELECT * from owner_list where vl_id = '$vl_id' ";
		          $result_owner_list = $con->query( $sql_owner_list );
            
                  	if( $result_owner_list->num_rows > 0 ) {
			          $own=1;
			         while ( $row_owner_list = $result_owner_list->fetch_assoc() ) 
			        {
				     # code...
				       $member_id = $row_owner_list['member_id'];
				       $date = $row_owner_list[ 'date' ];


				//pore add hobe
				         $sql_info = "SELECT * from info where MEMBER_ID='$member_id' ";
				         $result_info = $con->query( $sql_info );

				       if( $result_info->num_rows > 0 ) 
                       {

					      $row_info = $result_info->fetch_assoc();

					       $FIRST_NAME = $row_info['FIRST_NAME'];
					       $LAST_NAME = $row_info['LAST_NAME'];
					        $EMAIL = $row_info['EMAIL'];
					        $PHONE_NO = $row_info['PHONE_NO'];
					        $PICTURE_PATH = $row_info['PICTURE_PATH'];
					      
                           //print user information 
					?> 
                         <div class="row" >
                             <div class="col-lg-2"></div>
                                <div class="col-lg-2" id="box">
                                    <img width="200" height="200" src="<?php echo $PICTURE_PATH; ?>" />
                               </div>
                                   <div class="col-lg-7" id="box">
                                       <label> OWNER NO : <?php echo $own++?></label></br>
                                     <label> DATE OF ISSUE : <?php echo $date?></label></br>
                                      <label> NAME : <?php echo $FIRST_NAME.' '.$LAST_NAME?></label></br>
                                 <?php 
                                  if($member_id == $cur_member_id){ ?>
                                      <label> EMAIL : <?php echo $EMAIL?></label></br>
                                     <label> PHONE : <?php echo $PHONE_NO?></label></br>
                                 <?php } ?>
                                   </div>
                          </div>
                  <div class="row" >
                      <div class="col-lg-2"></div>
                      <div class='col-lg-10' id="box"></div>
                  </div>
<?php

			   }
			}	   
	    }

            
              
             
         }
         else{
             ?> 
             <h3>NO RECORD FOUND</h3>
             <?php
         }
         
         unset($_SESSION['v_type']);
         unset($_SESSION['v_company']);
         unset($_SESSION['v_model']);
         unset($_SESSION['v_number']);
     }
      else
      {
        ?> 
             <h3>NO RECORD FOUND</h3>
        <?php  
      }
?>
</body>
    <html>


