  <?php
            
               $server="localhost";
                $username="root";
               $password="";
               $database="project";
    
              //connection build

              $con = new mysqli($server,$username,$password,$database);
              //check connection
    
            if($con->connect_error){
                       die("Connection Failed: ");
                  }
                  mysql_select_db($database);
            
                  $flag=0;
                 global $page;
                  $page=0;
?>