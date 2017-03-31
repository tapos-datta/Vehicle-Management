<?php session_start();
 include_once("header.php");
?>
<!DOCTYPE html>
<html>
<head>
   <link rel="stylesheet" href="bootstrap.min.css">
    <style>
        
         table{
             margin-left: .5em;
             margin-top: 2.5em;
             margin-right: .5em;
              border: 1px solid black;
              table-layout: fixed;
               width: 11em;
              -webkit-border-radius: 5px;
                 -moz-border-radius: 5px;
                  border-radius: 5px;
            }

        th, td {
            text-align: center;
              border: 1px solid black;
              font-size: 1.15em;
              overflow: hidden;
              width: 11.75em;
             -webkit-border-radius: 5px;
                 -moz-border-radius: 5px;
                  border-radius: 5px;
          }
        #lastbox{
            height: 3em;
        }
          
      
        

    </style>
      <?php 
          include_once("database.php");
          
       ?>
    
    
    </head>
    <body>
         <?php 

             $name=$email=$phone=$pic="";
             $member_id=0;
             $rowNumber=0;
             if(isset($_SESSION['u_id'])){
                  $u_id=$_SESSION['u_id'];
                 
                 $sql_search = " select * from info where user_id = '$u_id'";
                 
                 $result = $con->query($sql_search);
                 
               if($result->num_rows > 0){
                   $row=$result->fetch_assoc();
                   $name=$row['FIRST_NAME']." ".$row['LAST_NAME'];
                   $email=$row['EMAIL'];
                   $phone=$row['PHONE_NO'];
                   $pic=$row['PICTURE_PATH'];
                   $_SESSION['member_id']=$member_id=$row['MEMBER_ID'];
               }
             
             }
            else
                {
                    die("ERROR.<br> NO USER IS FOUND");
                }
        
           
           ?>

       
        
        <div classw="row" id="box2">
            <div class="col-lg-2">            
            </div>
            <div class="col-lg-2" id="box2">
                <img width="200" height="200" src="<?php echo $pic;?>"/>    
            </div>
             <div class="col-lg-1">
            </div>
            
            <div class="col-lg-7">
                <label class="pro">MEMBER ID :  <?php echo $member_id; ?> </label></br>
                <label class="pro">PROFILE NAME :  <?php echo $name; ?> </label></br>
               <label class="pro">EMAIL :  <?php echo $email; ?> </label></br>
             <label class="pro">PHONE NUMBER :  <?php echo $phone; ?> </label></br>
                
            </div>
        </div>

          <?php 
               $sql_search="select * from vehicle_info where member_id='$member_id'";
               $result = $con->query($sql_search);
               
          ?>
    
        <div  class="row"> 
         <div class="col-lg-12">
             <table >
            
                 <tr>
                     <th>VEHICLE ID</th>
                    <th> VEHICLE NAME</th>
                    <th>COMPANY NAME</th>
                    <th>MODEL NAME</th>
                    <th>VEHICLE NUMBER</th>
                    <th>STATUS</th>
                     <th>IMAGE</th>
                 </tr>
            
              
                   <?php
                       if($result->num_rows>0){
            
                       while($row=$result->fetch_assoc()){  
                           //show database data in  html table 
                           $vl_id=$row['vl_id'];
                           $v=$row['v_id'];
                           $c=$row['c_id'];
                           $m=$row['m_id'];
                           $v_num=$row['v_number'];
                           $s=$row['v_status'];
                           $image=$row['v_path'];
                           $sql_search="select v_name from vehicle_name where V_id='$v'";
                           $result1 = $con->query($sql_search);
                           if($result1->num_rows>0){
                              
                           $row2=$result1->fetch_assoc();
                           $v_name=$row2['v_name'];
                           }
                           
                           $sql_search="select c_name from company_name where c_id='$c'";
                           $result1 = $con->query($sql_search);
                           if($result1->num_rows>0){
                           $row2=$result1->fetch_assoc();
                           $c_name=$row2['c_name'];
                           }
                           
                           $sql_search="select m_name from model where m_id='$m'";
                           $result1 = $con->query($sql_search);
                           if($result1->num_rows>0){
                           $row2=$result1->fetch_assoc();
                           $m_name=$row2['m_name'];
                           }
                           
                 ?>
                 <tr>
                     <td><?php echo $vl_id; ?></td>
                     <td><?php echo $v_name;?></td>
                     <td><?php echo $c_name;?></td>
                     <td><?php echo $m_name;?></td>
                     <td><?php echo $v_num;?></td>
                     <td><?php echo $s;?></td>
                     <td><img width="200" height="200" src="<?php echo $image;?>"/></td>
                     
                     
                </tr>
                 <?php
                       
                       }
                    }
                 $con->close(); 
                    ?>
            
             </table>
             
            </div>
            

    </div>
    <div class="row" id="lastbox">
     </div>

<script>
      function confirmation(){
          var r = confirm("ARE YOU WANT TO DELETE THIS DATA? Warning: if there is one vehicle and you want to delete,it will delete your account");      //using javascript for confirmation message when delete button press
          return r ;
        }
    </script>

      
    </body>    
</html>