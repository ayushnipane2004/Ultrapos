<?php

include 'db.php';

/*==========================================
CHECK BRANCH ID
==========================================*/

if(!isset($_GET['id']) || empty($_GET['id']))
{
    header("Location: page-list-branch.php");
    exit();
}

$id = intval($_GET['id']);

/*==========================================
GET BRANCH DETAILS
==========================================*/

$branch = mysqli_query($conn,"
SELECT *
FROM branch_master
WHERE id='$id'
AND delete_flag='1'
");

if(mysqli_num_rows($branch)==0)
{
    header("Location: page-list-branch.php");
    exit();
}

$branchRow = mysqli_fetch_assoc($branch);

/*==========================================
GET BRANCH MANAGER
==========================================*/

/*
Change role_id=3
to your Branch Manager Role ID
*/

$manager = mysqli_query($conn,"
SELECT *
FROM users
WHERE branch_id='$id'
AND role_id=(
    SELECT id
    FROM role
    WHERE role_name='Branch_manager'
)
AND delete_flag='1'
LIMIT 1
");

$managerRow = mysqli_fetch_assoc($manager);

/*==========================================
TOTAL EMPLOYEE
==========================================*/

$totalEmployee = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(id) total
FROM users
WHERE branch_id='$id'
AND delete_flag='1'
"));

/*==========================================
ACTIVE EMPLOYEE
==========================================*/

$activeEmployee = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(id) total
FROM users
WHERE branch_id='$id'
AND status='Active'
AND delete_flag='1'
"));

/*==========================================
MALE EMPLOYEE
==========================================*/

$maleEmployee = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(id) total
FROM users
WHERE branch_id='$id'
AND gender='Male'
AND delete_flag='1'
"));

/*==========================================
FEMALE EMPLOYEE
==========================================*/

$femaleEmployee = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(id) total
FROM users
WHERE branch_id='$id'
AND gender='Female'
AND delete_flag='1'
"));

?>



<!doctype html>

<html lang="en">

<head>

<meta charset="utf-8">

<meta name="viewport"
content="width=device-width, initial-scale=1">

<title>

View Branch

</title>

<link rel="stylesheet"
href="../assets/css/backend-plugin.min.css">

<link rel="stylesheet"
href="../assets/css/backende209.css?v=1.0.0">

<link rel="stylesheet"
href="../assets/vendor/remixicon/fonts/remixicon.css">

</head>

<body>

<div class="wrapper">


<?php include 'header.php'; ?>




<div class="content-page">

<div class="container-fluid">


<div class="row">

<div class="col-lg-4">

<div class="card">

<div class="card-body text-center">

<img
src="../assets/documents/1783423691_Ultrapos_logo.png"
class="img-fluid rounded mb-3"
style="width:130px;height:130px;">

<h4>

<?php echo $branchRow['branch_name']; ?>

</h4>

<?php

if($branchRow['status']=="Active")
{

echo "<span class='badge badge-success'>Active</span>";

}
else
{

echo "<span class='badge badge-danger'>Inactive</span>";

}

?>

<hr>

<p>

<strong>

Branch Code :

</strong>

<?php echo $branchRow['branch_code']; ?>

</p>

<p>

<strong>

Branch Type :

</strong>

<?php echo $branchRow['branch_type']; ?>

</p>

<p>

<strong>

Business Type :

</strong>

<?php echo $branchRow['business_type']; ?>

</p>

<p>

<strong>

GST No :

</strong>

<?php echo $branchRow['gst_no']; ?>

</p>

<p>

<strong>

Currency :

</strong>

<?php echo $branchRow['currency']; ?>

</p>

<p>

<strong>

Financial Year :

</strong>

<?php echo $branchRow['financial_year']; ?>

</p>

</div>

</div>


<div class="card">

<div class="card-header">

<h5>

Branch Summary

</h5>

</div>

<div class="card-body">

<div class="row text-center">

<div class="col-6 mb-3">

<h2 class="text-primary">

<?php echo $totalEmployee['total']; ?>

</h2>

<p>Total Employees</p>

</div>

<div class="col-6 mb-3">

<h2 class="text-success">

<?php echo $activeEmployee['total']; ?>

</h2>

<p>Active</p>

</div>

<div class="col-6">

<h2 class="text-info">

<?php echo $maleEmployee['total']; ?>

</h2>

<p>Male</p>

</div>

<div class="col-6">

<h2 class="text-danger">

<?php echo $femaleEmployee['total']; ?>

</h2>

<p>Female</p>

</div>

</div>

</div>

</div>

</div>


<div class="col-lg-8">

<div class="card">

<div class="card-header">

<h4 class="card-title">

<i class="ri-building-2-line"></i>

Branch Information

</h4>

</div>

<div class="card-body">

<div class="row">

<div class="col-md-6 mb-3">

<label><strong>Branch Name</strong></label>

<p><?php echo $branchRow['branch_name']; ?></p>

</div>

<div class="col-md-6 mb-3">

<label><strong>Branch Code</strong></label>

<p><?php echo $branchRow['branch_code']; ?></p>

</div>

<div class="col-md-6 mb-3">

<label><strong>Branch Type</strong></label>

<p><?php echo $branchRow['branch_type']; ?></p>

</div>

<div class="col-md-6 mb-3">

<label><strong>Business Type</strong></label>

<p><?php echo $branchRow['business_type']; ?></p>

</div>

<div class="col-md-6 mb-3">

<label><strong>Email</strong></label>

<p><?php echo $branchRow['branch_email']; ?></p>

</div>

<div class="col-md-6 mb-3">

<label><strong>Mobile</strong></label>

<p><?php echo $branchRow['branch_mobile']; ?></p>

</div>

<div class="col-md-6 mb-3">

<label><strong>Currency</strong></label>

<p><?php echo $branchRow['currency']; ?></p>

</div>

<div class="col-md-6 mb-3">

<label><strong>Financial Year</strong></label>

<p><?php echo $branchRow['financial_year']; ?></p>

</div>

<div class="col-md-6 mb-3">

<label><strong>GST Number</strong></label>

<p><?php echo $branchRow['gst_no']; ?></p>

</div>

<div class="col-md-6 mb-3">

<label><strong>Opening Date</strong></label>

<p>

<?php

if(!empty($branchRow['opening_date']))
echo date("d-m-Y",strtotime($branchRow['opening_date']));
else
echo "-";

?>

</p>

</div>

<div class="col-md-6 mb-3">

<label><strong>Status</strong></label>

<p>

<?php

if($branchRow['status']=="Active")
{

echo "<span class='badge badge-success'>Active</span>";

}
else
{

echo "<span class='badge badge-danger'>Inactive</span>";

}

?>

</p>

</div>

<div class="col-md-6 mb-3">

<label><strong>Created Date</strong></label>

<p>

<?php echo date("d M Y",strtotime($branchRow['created_at']));?>

</p>

</div>

<div class="col-md-12">

<label><strong>Description</strong></label>

<p>

<?php

echo !empty($branchRow['description'])
? nl2br($branchRow['description'])
: "-";

?>

</p>

</div>

</div>

</div>

</div>

</div>

</div>



<div class="row">

<div class="col-lg-4">

<div class="card">

<div class="card-body text-center">

<?php

if(!empty($managerRow['profile_photo']))
{

?>

<img
src="../assets/user-photo/<?php echo $managerRow['profile_photo'];?>"
class="rounded-circle mb-3"
style="width:150px;height:150px;object-fit:cover;">

<?php

}
else
{

?>

<img
src="../assets/images/user/1.png"
class="rounded-circle mb-3"
style="width:150px;height:150px;object-fit:cover;">

<?php

}

?>

<h4>

<?php

echo !empty($managerRow['full_name'])
?$managerRow['full_name']
:"Branch Manager Not Assigned";

?>

</h4>

<span class="badge badge-primary">

Branch Manager

</span>

<hr>

<p>

<strong>Employee ID :</strong>

<?php echo $managerRow['employee_id'];?>

</p>

<p>

<strong>Work Shift :</strong>

<?php echo $managerRow['work_shift'];?>

</p>

<p>

<strong>Status :</strong>

<?php echo $managerRow['status'];?>

</p>

<p>

<strong>Experience :</strong>

<?php echo $managerRow['experience'];?> Years

</p>

</div>

</div>

</div>




<div class="col-lg-8">

<div class="card">

<div class="card-header">

<h4 class="card-title">

<i class="ri-user-star-line"></i>

Branch Manager Information

</h4>

</div>

<div class="card-body">

<div class="row">

<div class="col-md-6 mb-3">

<label><strong>Full Name</strong></label>

<p><?php echo $managerRow['full_name']; ?></p>

</div>

<div class="col-md-6 mb-3">

<label><strong>Username</strong></label>

<p><?php echo $managerRow['username']; ?></p>

</div>

<div class="col-md-6 mb-3">

<label><strong>Email</strong></label>

<p><?php echo $managerRow['email']; ?></p>

</div>

<div class="col-md-6 mb-3">

<label><strong>Mobile</strong></label>

<p><?php echo $managerRow['mobile']; ?></p>

</div>

<div class="col-md-6 mb-3">

<label><strong>Gender</strong></label>

<p><?php echo $managerRow['gender']; ?></p>

</div>

<div class="col-md-6 mb-3">

<label><strong>Date Of Birth</strong></label>

<p><?php echo date("d-m-Y",strtotime($managerRow['date_of_birth']));?></p>

</div>

<div class="col-md-6 mb-3">

<label><strong>Qualification</strong></label>

<p><?php echo $managerRow['qualification']; ?></p>

</div>

<div class="col-md-6 mb-3">

<label><strong>Employment Type</strong></label>

<p><?php echo $managerRow['employment_type']; ?></p>

</div>

<div class="col-md-6 mb-3">

<label><strong>Joining Date</strong></label>

<p><?php echo date("d-m-Y",strtotime($managerRow['joining_date']));?></p>

</div>

<div class="col-md-6 mb-3">

<label><strong>Work Location</strong></label>

<p><?php echo $managerRow['work_location']; ?></p>

</div>

<div class="col-md-6 mb-3">

<label><strong>Employee Status</strong></label>

<p><?php echo $managerRow['employee_status']; ?></p>

</div>

<div class="col-md-6 mb-3">

<label><strong>Experience</strong></label>

<p><?php echo $managerRow['experience']; ?> Years</p>

</div>

</div>

</div>

</div>

</div>

</div>



<div class="row">

<div class="col-lg-6">

<div class="card">

<div class="card-header">

<h4 class="card-title">

<i class="ri-map-pin-line"></i>

Address Information

</h4>

</div>

<div class="card-body">

<div class="row">

<div class="col-md-12 mb-3">

<label><strong>Address</strong></label>

<p><?php echo nl2br($branchRow['address']); ?></p>

</div>

<div class="col-md-6 mb-3">

<label><strong>Area</strong></label>

<p><?php echo $branchRow['area']; ?></p>

</div>

<div class="col-md-6 mb-3">

<label><strong>City</strong></label>

<p><?php echo $branchRow['city']; ?></p>

</div>

<div class="col-md-6 mb-3">

<label><strong>District</strong></label>

<p><?php echo $branchRow['district']; ?></p>

</div>

<div class="col-md-6 mb-3">

<label><strong>State</strong></label>

<p><?php echo $branchRow['state']; ?></p>

</div>

<div class="col-md-6 mb-3">

<label><strong>Country</strong></label>

<p><?php echo $branchRow['country']; ?></p>

</div>

<div class="col-md-6 mb-3">

<label><strong>Pincode</strong></label>

<p><?php echo $branchRow['pincode']; ?></p>

</div>

</div>

</div>

</div>

</div>


<div class="col-lg-6">

<div class="card">

<div class="card-header">

<h4 class="card-title">

<i class="ri-contacts-book-line"></i>

Contact Person Information

</h4>

</div>

<div class="card-body">

<div class="row">

<div class="col-md-12 mb-3">

<label><strong>Contact Person</strong></label>

<p><?php echo $branchRow['contact_person_name']; ?></p>

</div>

<div class="col-md-6 mb-3">

<label><strong>Email</strong></label>

<p><?php echo $branchRow['contact_person_email']; ?></p>

</div>

<div class="col-md-6 mb-3">

<label><strong>Mobile</strong></label>

<p><?php echo $branchRow['contact_person_mobile']; ?></p>

</div>

</div>

</div>

</div>

</div>

</div>



<div class="row">

<div class="col-lg-12">

<div class="card">

<div class="card-header">

<h4 class="card-title">

<i class="ri-briefcase-4-line"></i>

Business Information

</h4>

</div>

<div class="card-body">

<div class="row">

<div class="col-md-3 text-center">

<h6 class="text-muted">

Business Type

</h6>

<h5>

<?php echo $branchRow['business_type']; ?>

</h5>

</div>

<div class="col-md-3 text-center">

<h6 class="text-muted">

Branch Type

</h6>

<h5>

<?php echo $branchRow['branch_type']; ?>

</h5>

</div>

<div class="col-md-3 text-center">

<h6 class="text-muted">

Currency

</h6>

<h5>

<?php echo $branchRow['currency']; ?>

</h5>

</div>

<div class="col-md-3 text-center">

<h6 class="text-muted">

Financial Year

</h6>

<h5>

<?php echo $branchRow['financial_year']; ?>

</h5>

</div>

</div>

</div>

</div>

</div>

</div>


<div class="row">

<div class="col-lg-12">

<div class="card">

<div class="card-header">

<h4 class="card-title">

<i class="ri-bar-chart-box-line"></i>

Branch Summary

</h4>

</div>

<div class="card-body">

<div class="row text-center">

<div class="col-md-3">

<h2 class="text-primary">

<?php echo $totalEmployee['total']; ?>

</h2>

<p>Total Employees</p>

</div>

<div class="col-md-3">

<h2 class="text-success">

<?php echo $activeEmployee['total']; ?>

</h2>

<p>Active Employees</p>

</div>

<div class="col-md-3">

<h2 class="text-info">

<?php echo $maleEmployee['total']; ?>

</h2>

<p>Male Employees</p>

</div>

<div class="col-md-3">

<h2 class="text-danger">

<?php echo $femaleEmployee['total']; ?>

</h2>

<p>Female Employees</p>

</div>

</div>

</div>

</div>

</div>

</div>




<div class="row">

<div class="col-lg-12 text-center mb-4">

<a href="page-list-branch.php"
class="btn btn-secondary mr-2">

<i class="ri-arrow-left-line"></i>

Back

</a>

<button
onclick="window.print();"
class="btn btn-success">

<i class="ri-printer-line"></i>

Print

</button>

</div>

</div>



</div>

</div>

</div>

<script src="../assets/js/backend-bundle.min.js"></script>

<script src="../assets/js/table-treeview.js"></script>

<script src="../assets/js/customizer.js"></script>

<script src="../assets/js/chart-custom.js"></script>

<script src="../assets/js/app.js"></script>

</body>

</html>



