<?php
session_start();

include 'db.php';


if(!isset($_SESSION['user_id']))
{

    header("Location: ../../../index.php");
    exit();
    
}

$user_id    = $_SESSION['user_id'];
$company_id = $_SESSION['company_id'];
$branch_id  = $_SESSION['branch_id'];

$role_id    = $_SESSION['role_id'];

$full_name  = $_SESSION['full_name'];



$user_name  = $_SESSION['user_name'];
$email      = $_SESSION['email'];

$created_by = $_SESSION['user_id'];

$modified_by =  $_SESSION['user_id'];

$company_logo = $_SESSION['company_logo'];




$getUser = mysqli_query($conn,"
SELECT * FROM users
WHERE id='$user_id'
");

$user = mysqli_fetch_assoc($getUser);

$photo = $user['profile_photo'];
?>