<?php session_start();
    include_once("headersub.php");

       if(isset($_POST['sub3']) || isset($_SESSION['logout']))
          {
             $_SESSION['u_id']=0;
              session_unset();
              $_SESSION['logout']=0;
              $_SESSION['login']=0;
          }
     if(isset($_SESSION['login']) && isset($_SESSION['u_id'])){
         if($_SESSION['login']==1 && $_SESSION['u_id']!=0){
         //echo $is=$_SESSION['login']." ".$is=$_SESSION['u_id'];
            $is=$_SESSION['login']=1;
            $id=$_SESSION['u_id'];
          header("location: http://localhost/project/user.php?'$id'");
         }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>User-log-in</title>
        <link rel="stylesheet" href="bootstrap.min.css">
        <style>
          
            h2{
                text-align: center;
                font-size: 40px;
                
            }
            h3{
                font-size: 20px;
               
                text-align: center;
            }
            .form1{
                text-align: center;
                font-size: 20px;
                
            }
            .design{
                font-size: 16px;
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
            label{
               
                width: 6em;
                margin-right: .1em;
               
            }
            #subbtn{
                margin-left: 7em;
            }
           
            #pass{
                margin-bottom: .5em;
            }
            #box1{
            display: flex;
            background-color:green;
            height:5em;
        }
      
    
        .btn1{
            float: left;
            margin-left: 5em;
            height: 5em;
            width :50em;
        }
        #edit{
            
            margin-top: 1.5em;
            margin-left: 1.5em;
            float: left;
        }
        
      
        #box2{
            height:15em;
            background-color: blanchedalmond;
          }
         
          body{
                background-color: beige;
            }
             
            
            
         
        </style>
        
        <?php include_once("database.php");
            
        ?>
           
    </head>
    <body >
         
        
       
        
        <h2>MEMBER LOGIN</h2>
           
        
          <?php
          
         
          
        
           $flag=0;
          if($flag==0 && isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password']) )
          {
              
              
              $u_id=htmlentities($_POST['username']);
              $pass=md5(htmlentities($_POST['password']));
              if($u_id && $pass)
               {
              
               $sql= "SELECT user_id from login where user_name='$u_id' and pass='$pass'";
                 $result = $con->query($sql);
              //echo "user v_id in ".$result->num_rows."<br>";
               if($result->num_rows > 0){      
                   $row=$result->fetch_assoc();
                           //executed query
                  $id = $_SESSION['u_id'] = $row['user_id'];
                   $_SESSION['login']=1;
                
                   header("location: http://localhost/project/user.php?'$id'");
                   
                  ?>
        
                     <h1>SUCCESSFULLY LOGGED IN .</h1><br>
                    <h1> HELLO <?php echo $row['FIRST_NAME'].' '.$row['LAST_NAME']?> !</h1>
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
                ?><h3>INCORRECT INFORMATION...</h3><?php echo "<br>";
            }
            
                if($flag==0){
                      //data collecet from a html form
                    
            ?> 
        
        <div class="row">
            <div class="col-md-offset-0" >
                <form class="form1" action="login.php" method='post'>
                  
                      <label id="user" for="user">Username:</label><input type='text' class='design' name='username' required/></br>
                <label id="pass" for="password">Password:</label><input type='password' class="design"  name='password' required/><br>
                   <input type="submit" class='btn btn-success' id='subbtn' name='sub' value="submit" />
                   <a  href="http://localhost/project/recovery.php" target="_new">
                       <button type='button' class="btn btn-info" >Forgot password?</button></a>
                    
            
                 
                
            </form>
            
            
            </div>
            
        </div>
       
     
    
         <?php
                }
        
        
        $con->close();
        
        ?>
    </body>

</html>