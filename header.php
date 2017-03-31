<!DOCTYPE html>
<html>
    <head>
        
        <link rel="stylesheet" href="bootstrap.min.css">
    <style>
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
            
            margin-left: 1.5em;
            float: left;
        }
        .btn{
            margin-top: 2em;
            margin-left: .25em;
            float: left;
        }
        .pro{
            margin-top: 0.8em;
            font-size: 1.15em;
            
        }
        #box2{
            height:15em;
            background-color: blanchedalmond;
          }
         
          body{
                background-color: beige;
            }
      
        

    </style>
        
    </head>
    <body>
        
        <div class="row" id="box1">
           <div class="col-lg-2">
             
           </div>
           <div class="col-lg-3" >
             
           </div>

           
           <div class="col-lg-7" >
                <div class="btn1">
                    <a  href="http://localhost/project/user.php" target="_self">
                       <button type='button' class="btn" id="edit" >PROFILE</button></a>
                     <a  href="http://localhost/project/edit.php" target="_self">
                       <button type='button' class="btn"  >EDIT</button></a>
                    <a  href="http://localhost/project/vehicleinfo.php" target="_top">
                        <button type='button' class="btn"  >ADD VEHICLE</button></a>
                    <a  href="http://localhost/project/transfer.php" target="_self">
                        <button type='button' class="btn"  >TRANSFER VEHICLE</button></a>
                     <a  href="http://localhost/project/status.php" target="_self">
                       <button type='button' class="btn"  >VEHICLE STATUS</button></a>
                  <form action="login.php" method="post"> 
                   <a  href="http://localhost/project/login.php" target="_self">
                       
                       <button type='submit' class="btn" name='sub3' value="LOGOUT" >LOGOUT</button></a>
                       
                    </form>
               </div> 
           </div>
           
        </div> 
    
    </body>

</html>
