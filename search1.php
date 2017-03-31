<?php
session_start();
   include_once("database.php");
          
   // echo $_POST['v_type'].$_POST['v_company'].$_POST['v_model'].$_POST['v_number'];
         
       /* if four search box are occupied and then search for accurate  data */

       if(isset($_POST['v_type']) && !empty($_POST['v_type']) && isset($_POST['v_company']) && !empty($_POST['v_company']) &&
         isset($_POST['v_model']) && !empty($_POST['v_model']) && isset($_POST['v_number']) && !empty($_POST['v_number'])){
           
           $_SESSION['v_type']=strtoupper(htmlentities($_POST['v_type']));
           $_SESSION['v_company']=strtoupper(htmlentities($_POST['v_company']));
           $_SESSION['v_model']=strtoupper(htmlentities($_POST['v_model']));
           $_SESSION['v_number']=strtoupper(htmlentities($_POST['v_number']));
          // echo $_SESSION['v_type'].$_SESSION['v_company']. $_SESSION['v_model']. $_SESSION['v_number'];
          header("location: http://localhost/project/search.php"); 
       }
   
      /* if number is not define and one of three box are occupied then search according input data */
      else if((!empty($_POST['v_type']) || !empty($_POST['v_company']) ||!empty($_POST['v_model']) )&& empty($_POST['v_number'])){
          
          $flag=0;
          
          //if vehicle name is given
          if(isset($_POST['v_type'] ) && !empty($_POST['v_type'] ))
          {
             
             // echo  $_POST['v_type'] ;
              $v_type=strtoupper(htmlentities($_POST['v_type']));
              $sql="select v_id from vehicle_name where v_name='$v_type'";
              $result = $con->query( $sql );
            
                if( $result->num_rows > 0 ){
                  $flag=1;
                  $_SESSION['v_type']=$v_type;
                  header("location: http://localhost/project/search2.php");
              }
              else{
                  header("location: http://localhost/project/search.php");
              }
          }
          //if company name is given
          else if(!empty($_POST['v_company']) &&  $flag==0)
          {
             
              unset($_SESSION['v_type']);
             // echo $_POST['v_company'];
               $v_company=strtoupper(htmlentities($_POST['v_company']));
              $sql="select c_id from company_name where c_name='$v_company'";
              $result = $con->query( $sql );
            
                if( $result->num_rows > 0 ){
                  $flag=1;
                  $_SESSION['v_company']=$v_company;
                  header("location: http://localhost/project/search2.php");
              }
              else{
                  header("location: http://localhost/project/search.php");
              }
          }
          //if model name is given
          else if(!empty($_POST['v_model'])){
              
              unset($_SESSION['v_model']);
              $v_model=strtoupper(htmlentities($_POST['v_model']));
              $sql="select m_id from model where m_name='$v_model'";
              $result = $con->query( $sql );
              
              
               if( $result->num_rows > 0 ){
                  $flag=1;
                  $_SESSION['v_model']=$v_model;
                  header("location: http://localhost/project/search2.php");
              }
              else{
                  header("location: http://localhost/project/search.php");
              }
              
          }
          
          else
          {
             header("location: http://localhost/project/search.php");
          }
             
          
          
      }
          else
          {
              header("location: http://localhost/project/index.php");
          }
          
       
       
       
  
      ?>