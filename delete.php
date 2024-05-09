<?php
include("connection.php");

if(isset($_GET['studID'])){
    $studID = $_GET['studID'];
}


$delete_accounts = mysqli_query($con, "DELETE FROM tblaccounts WHERE studID = $studID");

if(!$delete_accounts){
    die(mysqli_error($con));
}


$delete_student = mysqli_query($con, "DELETE FROM tblstudents WHERE studID = $studID");

if(!$delete_student){
    die(mysqli_error($con));
}else{
    header("location: dashboard.php");
}

include("closeconnection.php");
?>
