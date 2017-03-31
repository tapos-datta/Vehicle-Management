<?php include_once("headersub.php");?>
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
               width: 15em;
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
            body{
                 background-color: beige;
            }
        
        </style>
    </head>
    <body>
        <?php
        session_start();
        include_once("database.php");
         //echo $_SESSION['v_type'].$_SESSION['v_type']
    
         /* show all vehicle company,model which vehicle name is given.from vehicle_name table find first vehicle id that is v_id and search in to find company id thats c_id then find model id from model table and  .print data using table  */
          
          if(!empty($_SESSION['v_type'])){
              
              $v_type=$_SESSION['v_type'];
              unset($_SESSION['v_type']);
              
              $sql="select v_id from vehicle_name where v_name='$v_type'";
              $result = $con -> query($sql);
              $row= $result -> fetch_assoc();
              $v_id=$row['v_id'];
              ?>
            <h2>SEARCHED RESULT:</h2>
           <div class='row'>
              <div class="col-lg-3"></div>
                <div class="col-lg-5">
                  <table>
                    <tr>
                    <th> VEHICLE TYPE</th>
                     <th> VEHILCE COMPANY</th>
                     <th> VEHILCE MODEL </th>
                                    
                   </tr>
               
        <?php
              
              $sql_company_name = " SELECT * from company_name where v_id='$v_id' ";
		$result_company_name = $con->query($sql_company_name);

		if($result_company_name->num_rows > 0) {

			 while($row_company_name = $result_company_name->fetch_assoc() ) {
				
				$c_id = $row_company_name['c_id'];
				$c_name = $row_company_name['c_name'];
				//showing outputs
              

				$sql_model = " SELECT * from model where c_id = '$c_id' ";
				$result_model = $con->query( $sql_model );

				if($result_model->num_rows > 0) {
						while($row_model = $result_model->fetch_assoc() ) {
							# code...
							$m_id = $row_model['m_id'];
							$m_name = $row_model['m_name'];
                            ?>
                     <tr>
                         <td>
                             <h4><?php echo $v_type;?></h4> 
                        </td>
                         <td>
                             <h4><?php echo $c_name;?></h4>
                        </td>
                        <td>
                                <h4><?php echo $m_name;?></h4>
                        </td>   
                     </tr>
                      
    
                            
                            
                   <?php
							//showing outputs
							//echo ' <strong>Model Name:</strong>  ->  '.$m_name.'<br>';
				    }
				}

		    }

		}
              
            ?>
            </table>
             </div>
              <div class="col-lg-3"></div>
           </div>
      <?php
              
              
              
              
        }
               /* show all vehicle model which company name is given.from company table find first company id that is c_id and search in  model table and find m_name .print data using table  */
        
        else if(!empty($_SESSION['v_company'])){
            
            
             $c_name=$_SESSION['v_company'];
            unset($_SESSION['v_company']);
             $sql_company_name = "SELECT * from company_name where c_name='$c_name'";
		$result_company_name = $con->query($sql_company_name);

		if($result_company_name->num_rows > 0) {

			 $row_company_name = $result_company_name->fetch_assoc();
            
				
				$c_id = $row_company_name['c_id'];
				//$c_name = $row_company_name['c_name'];
				//showing outputs
                 ?>
    
            <h2>SEARCHED RESULT:</h2>
               <div class='row'>
                   <div class="col-lg-3"></div>
                      <div class="col-lg-5">
                     <table>
                     <tr>
                  
                     <th> VEHILCE COMPANY</th>
                     <th> VEHILCE MODEL </th>
                                    
                    </tr>
                 
                   
             <?php

				$sql_model = " SELECT * from model where c_id = '$c_id' ";
				$result_model = $con->query( $sql_model );

				if($result_model->num_rows > 0) {
						while($row_model = $result_model->fetch_assoc() ) {
							# code...
							$m_id = $row_model['m_id'];
							$m_name = $row_model['m_name'];
                            ?>
                     <tr>
                         
                         <td>
                             <h4><?php echo $c_name;?></h4>
                        </td>
                        <td>
                                <h4><?php echo $m_name;?></h4>
                        </td>   
                     </tr>
                      
    
                            
                            
                   <?php
							//showing outputs
							//echo ' <strong>Model Name:</strong>  ->  '.$m_name.'<br>';
				    }
				}


		}
         ?>
            </table>
             </div>
              <div class="col-lg-3"></div>
           </div>
          <?php  
    
        }
        
        /* show all vehicle number which model name is given.from model table find first model id that is m_id and search in vehicle info table and find v_number thats the number of vehicle .print data using table  */
        else if(!empty($_SESSION['v_model'])){
            
            
             $m_name=$_SESSION['v_model'];
            unset($_SESSION['v_model']);
             $sql_model_name = "SELECT * from model where m_name='$m_name'";
		$result_model_name = $con->query($sql_model_name);

		if($result_model_name->num_rows > 0) {

			 $row_model_name = $result_model_name->fetch_assoc();
            
				
				$m_id = $row_model_name['m_id'];
				//$c_name = $row_company_name['c_name'];
				//showing outputs
                 ?>
    
            <h2>SEARCHED RESULT:</h2>
               <div class='row'>
                   <div class="col-lg-3"></div>
                      <div class="col-lg-5">
                     <table>
                     <tr>
                  
                     <th> VEHILCE MODEL</th>
                     <th> VEHILCE NUMBER </th>
                                    
                    </tr>
                 
                   
             <?php

				$sql_number = " SELECT vl_id,v_number from vehicle_info where m_id = '$m_id' ";
				$result_number = $con->query( $sql_number );

				if($result_number->num_rows > 0) {
						while($row_number = $result_number->fetch_assoc() ) {
							# code...
							//$v_id = $row_model['m_id'];
							$v_number = $row_number['v_number'];
                            ?>
                     <tr>
                         
                         <td>
                             <h4><?php echo $m_name;?></h4>
                        </td>
                        <td>
                                <h4><?php
                            
                                    $strlen=strlen($v_number);
                            
                                    for($i=0;$i<$strlen;$i++){
                                         $char='*';
                                      if($i==0 || $i==$strlen-1){
                                            $char=substr($v_number,$i,1);
                                         }
                                        echo $char;
                                      }
                            
                             ?></h4>
                        </td>   
                     </tr>
                      
    
                            
                            
                   <?php
							//showing outputs
							//echo ' <strong>Model Name:</strong>  ->  '.$m_name.'<br>';
				    }
				}


		}
         ?>
            </table>
             </div>
              <div class="col-lg-3"></div>
           </div>
          <?php  
    
        }
 
     ?>
            
      
        
        
    
    </body>

</html>
