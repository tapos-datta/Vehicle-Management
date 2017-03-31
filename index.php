<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
         <link rel="stylesheet" href="bootstrap.min.css">
        <title>vehicle management</title>
        <style>
            h1{
                font-size: 3em;
            }
            #sbox{
                margin-left: 4em;
            }
            #box{
                background-color:beige;
            }
            #box1{
                height: 8em;
            }
            p{
                font-size: 1.5em;
                line-height: 1.25em;
                margin-right: 2em;
            }
            #button1{
                  margin-left: 2.5em;
                 height: 2.5em;
                  width: 7em;
                 font-size: 20px;
                
                 -webkit-border-radius: 5px;
                 -moz-border-radius: 5px;
                  border-radius: 5px;
            }
            #button2{
                margin-top: 1em;
                 height:2.5em;
                margin-left: 2.5em;
                width: 7em;
                 font-size: 20px;
               
                 -webkit-border-radius: 5px;
                 -moz-border-radius: 5px;
                  border-radius: 5px;
            }
            #button3{
                margin-top: 1em;
                margin-left: 5em;
                 background-color:darkkhaki;
                 font-size: 20px;
                -webkit-border-radius: 5px;
                 -moz-border-radius: 5px;
                  border-radius: 5px;
                  margin-bottom: 2em;
            }
            #para{
                margin-left: 1em;
                font-size: 1.25em;
            }
            #para2{
                text-align: center;
                font-size: 2em;
            }
            .design{
                width: 10em;
                height: 3em;
                font-size: 10px;
                margin-left: 20px;
                margin-bottom: 20px;
                -webkit-border-radius: 5px;
                 -moz-border-radius: 5px;
                  border-radius: 5px;
            }
           
            #search{
                margin-left: 10em;
                height: 2.5em;
                width : 15em;
                font-size: 1.2em;
                 margin-top: 1.5em; 
                 padding-left: 20px;
                 -webkit-border-radius: 5px;
                 -moz-border-radius: 5px;
                  border-radius: 5px;
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
            body{
                background-color: beige;
            }
        
        </style>
    </head>
    <body>
        <div class="row" id="box">
          <div class="col-lg-5">
              
            </div>
            <div class="col-lg-4">
                <h1>VEHICLE</h1>
            </div>
            <div class="col-lg-3"></div>
        </div>
        
          <div class="row" id="box">
          <div class="col-lg-4">
            </div>
            <div class="col-lg-4" id='sbox'>
                <h1>MANAGEMENT</h1>
            </div>
            <div class="col-lg-4"></div>
        </div>
        <div class="row" id="box1">
          <div class="col-lg-3">
            </div>
            <div class="col-lg-7">
               <p> Vehicle Management is service related to the information about every type of vehicles in our modern life. Vehicle owners keep the information about their vehicles.It is very useful to know the status of the vehicle e.g. if a vehicle stolen then it can be marked as 'stolen'.If someone wants to sell vehicle and the buyer search here with related information of its,he can understand to see the status who is the real owner of that vehicle .Vehicle Management can play vital role in our modern life and make easier to know information about a vehicle.</p>
             </div>
            </div>
        </div>
        
        <div class="row" id="box">
          <div class="col-lg-3" >
               <a  href="http://localhost/project/login.php" target="_self">
                   <button type='button' class="btn btn-primary" id="button1">LOG-IN</button></a>
              </br>
               <a  href="http://localhost/project/signup.php" target="_self">
                   <button type='button' class="btn btn-primary" id="button2">REGISTER</button></a>
            </br></br>
               <p id="para">Don't have an account? <b>Register<b></p> 
            </div>
            <div class="col-lg-9">
                 <p id='para2'>search here...</p>
                  <form action="search1.php" method="post">
                      
                     <input type="text" name="v_type" id="search"  placeholder="Vehicle type ( car,... )"/>
                     <input type="text" name="v_company" id="search"  placeholder="Vehicle company..."/>
                      </br>
                      <input type="text" name="v_model" id="search"  placeholder="Vehicle Model..."/>
                      <input type="text" name="v_number" id="search"  placeholder="Vehicle number..."/>
               </div>
         </div>
          <div class="row" id="box">
              <div class="col-lg-6"></div>
              <div class="col-lg-6">
                  <button type="submit" class="btn" name="sub" id="button3">SEARCH</button>
               </div>    
         </div>
          </form>
    
    </body>

</html>