<?php session_start();
   include_once("headersub.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Recovery Password</title>
        <link rel="stylesheet" href="bootstrap.min.css">
        <style>
            body{
                background-color: lightgray;
            }
            h2,h3{
                text-align: center;
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
                width: 25em;
                margin-right: 0.5em;
                
            }
            .design{
                width: 20em;
                height: auto;
                font-size: 16px;
                margin-left: 20px;
                margin-bottom: 20px;
                -webkit-border-radius: 5px;
                 -moz-border-radius: 5px;
                  border-radius: 5px;
            }
            .design1{
                font-size: 16px;
                -webkit-border-radius: 5px;
                 -moz-border-radius: 5px;
                  border-radius: 5px;
            }
            #sdesign{
                 margin-left: 5em;
                 height: 40px;
                 width: 100px;
                 font-size: 20px;
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
         
        ?>
    </head>
    
    <body>
       <h2>RECOVER PASSWORD</h2>
        
        <?php
        $flag=0;

         $_SESSION['flag']=0;
        
        
        if(isset($_POST['sub1'])){
            $_SESSION['flag']=0;
        }
        else if(isset($_POST['sub2'])){
            $_SESSION['flag']=1;
        }
          
        
            //email, phone, vehicle number check and find user id
            if($_SESSION['flag']==0 && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['phnNo']) && !empty($_POST['phnNo']))
            {
                $email=strtoupper(htmlentities($_POST['email']));
                $phn=strtoupper(htmlentities($_POST['phnNo']));
               
                
                $sql_search = "select member_id, user_id from info where EMAIL='$email' and PHONE_NO ='$phn' ";
                // and v_number='$v_no'"
                
                $result = $con->query($sql_search);
              //echo "user v_id in ".$result->num_rows."<br>";
                  if($result->num_rows > 0){
                       $row=$result->fetch_assoc();
                      $_SESSION['_u_id'] = $row['user_id'];
                       $user =  $row['user_id'];

                      $member_id = $row['member_id'];
                      
                      //sending recovery code in email
                      //define the receiver of the email
                        //pin code generated and send email
                      $randvalue=rand(100000,999999);
                      $_SESSION['code']=$randvalue;
                     $to = strtolower($email);
        
                     //define the subject of the email
                     $subject = 'RECOVER PASSWORD'; 
                      //define the message to be sent. Each line should be separated with \n
                     $message = "Hello Member!\r\nYou are requested for changing password of your account. Here a pin code this will be needed for changing password\r\n Pin Code = ".$randvalue."\r\n This pin code is workable for 10 minute"; 
                    //define the headers we want passed. Note that they are separated with \r\n
                    $headers = "From: taposstarboy@gmail.com"."\r\n";
                    //send the email
                    $mail_sent = @mail($to, $subject,$message,$headers);
                      $_SESSION['timeout']=time();
                    //if the message is sent successfully print "Mail sent". Otherwise print "Mail failed"         
                      
                    $_SESSION['flag']=1;
                      /*
                      $sql_search2 = "select v_number from vehicle_info where member_id= '$member_id' " ;
                    $result2 = $con -> query( $sql_search2 );
                      if( $result2 -> num_rows > 0  ) {

                         while( $row = $result2->fetch_assoc() ) {

                                if($v_no = $row['v_number'] ) {
                                        $_SESSION[ '_u_id' ] = $user ;
                                        $_SESSION['flag'] = 1;
                                }
                         } 
                      }
                      */
                
            }
                else{
                    $flag=0;
                    ?><h3>INCORRECT DATA</h3><?php echo "<br>";
                }
        }
        //set new password for user
         if($_SESSION['flag'] ==1 && isset($_POST['npass']) && !empty($_POST['npass']) && isset($_POST['cnpass']) && !empty($_POST['cnpass']) && isset($_POST['pin']) && !empty($_POST['pin'])){
             
             
             $pin=htmlentities($_POST['pin']);
             $value=$_SESSION['code'];
             
                    // calculate the session's "time to live"
                $sessionTTL = time() - $_SESSION["timeout"];
             if ($sessionTTL < 600) {
                           
                  //pin code match
                 if(($_POST['npass'] == $_POST['cnpass']) && $value==$pin){
             
                      $pass=md5(htmlentities($_POST['npass']));
                       $u_id=$_SESSION['_u_id'];
            
                    $sql_update="update login set pass='$pass' where user_id='$u_id' ";
            
            
                 if ($con->query($sql_update) === TRUE) {
                        ?> <h3>successfully recovered password.</h3>
                        
            <?php
                   $_SESSION['flag']=2;
                   
            } 
             else 
              {
                     die(" SOMETING ERROR ");
             }
           }
        }
             else{
                 unset($_SESSION['timeout']);
                 unset($_SESSION['code']);
                 $_SESSION['flag']=0;
                 
             }
             
            
            
        }
          
        
        if($_SESSION['flag'] ==0){
            ?>
        
        <form action="recovery.php" method="post">
            <div class="row" >
                <div class="col-md-12" id='box'>
                  <ul>
                    <li><label>E-MAIL :</label><input type='text' class="design" name='email' required/>
                    </li>
                     <li><label>PHONE NUMBER :</label><input type='text' class="design" name='phnNo' required/>
                    </li>
                   
                 </ul>
             </div>
           </div>
           <div class="row">
               <div class="col-md-offset-5">
                   <input type="submit" class="btn btn-info" id="sdesign" name='sub1' value="submit"/>
                    </div>
               </div>
            
            </div>
          </form>
    
    <?php 
        }
                
        if($_SESSION['flag']==1){
           
        ?>
            <h3>One pin code is sent to email, using this code to proceed.</h3>
            
         <form action="recovery.php" method="post">
            <div class="row" >
                <div class="col-md-12">
                  <ul>
                        <li><label>PIN CODE :</label><input type='text' class="design" name='pin' required/>
                    </li>
                    <li><label>NEW PASSWORD :</label><input type='password' class="design" name='npass' required/>
                    </li>
                     <li><label>CONFIRM PASSWORD :</label><input type='password' class="design" name='cnpass' required/>
                    </li>
                     
                 </ul>
             </div>
           </div>
           <div class="row">
               <div class="col-md-offset-5">
                   <input type="submit" class="btn btn-info" id="sdesign" name='sub2' value="submit" />
                   
                    </div>
               </div>
            
            </div>
          </form>
    
            
       <?php        
        }
        //if recovery is done 
        if($_SESSION['flag']==2){
           session_destroy();
        }
            $con->close();                                        //data base close
        ?>
        
    
    </body>

</html>