<?php
session_start();
include("./includes/config.php");
 if (!isset($_SESSION['Employee_id']) ) {
 require ('./includes/login_functions.inc.php');
  redirect_user(); // pagnarollback
}
else{
    include "includes/config.php";

    mysqli_query($conn,'START TRANSACTION');
    $sql = 'INSERT INTO consultation(Employee_id, Pet_id, Date_of_Consultation, Disease_Injuries, Price, Comments) VALUES (?, ?, ?, ?, ?, ?)';
    $flag = true;
    
    if ($_POST['submit'] ==  "Save"){
    $Employee_id  = $_POST['Employee_id'];
    $Pet_id = $_POST['Pet_id'];
    $Date_of_Consultation = $_POST['Date_of_Consultation'];
    $Disease_Injuries = $_POST['Disease_Injuries'];
    $Price = $_POST['Price'];
    $Comments = $_POST['Comments'];

    $consult = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($consult, 'iissis', $Employee_id, $Pet_id,$Date_of_Consultation, $Disease_Injuries, $Price, $Comments);
    mysqli_stmt_execute($consult);


      if( (mysqli_stmt_affected_rows($consult) > 0)){
      if($flag == true){
        mysqli_commit($conn);
        header('Location: consultationz.php');
       }
       }
       else {
        mysqli_rollback($conn);
        echo "Fail";
        //echo "<td align='center'><a href='index.php' role='button'> <font color='brightgreek'><h2>Go Back</h2></font></a></td>";
       }
    }
  }
