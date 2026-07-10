<?php
include 'db.php';




if(!isset($_GET['id']))
{
    header("Location: customer_show.php");
    exit;
}

$id = intval($_GET['id']);

$result = mysqli_query($conn,"SELECT * FROM customer WHERE id='$id'");

if(mysqli_num_rows($result)==0)
{
    die("Customer Not Found");
}

$row = mysqli_fetch_assoc($result);
?>

<?php
if(isset($_POST['update']))
{

    $customer_name = mysqli_real_escape_string($conn,$_POST['customer_name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $phone = mysqli_real_escape_string($conn,$_POST['phone']);
    $gst_no = mysqli_real_escape_string($conn,$_POST['gst_no']);
    $pan_no = mysqli_real_escape_string($conn,$_POST['pan_no']);

    $address = mysqli_real_escape_string($conn,$_POST['address']);
    $city = mysqli_real_escape_string($conn,$_POST['city']);
    $state = mysqli_real_escape_string($conn,$_POST['state']);
    $pincode = mysqli_real_escape_string($conn,$_POST['pincode']);

    $bank_name = mysqli_real_escape_string($conn,$_POST['bank_name']);
    $branch_name = mysqli_real_escape_string($conn,$_POST['branch_name']);
    $account_holder = mysqli_real_escape_string($conn,$_POST['account_holder']);
    $account_number = mysqli_real_escape_string($conn,$_POST['account_number']);
    $ifsc_code = mysqli_real_escape_string($conn,$_POST['ifsc_code']);

    $opening_balance = mysqli_real_escape_string($conn,$_POST['opening_balance']);
    $credit_limit = mysqli_real_escape_string($conn,$_POST['credit_limit']);
    $notes = mysqli_real_escape_string($conn,$_POST['notes']);

    mysqli_query($conn,"
    UPDATE customer SET

    customer_name='$customer_name',
    email='$email',
    phone='$phone',
    gst_no='$gst_no',
    pan_no='$pan_no',

    address='$address',
    city='$city',
    state='$state',
    pincode='$pincode',

    bank_name='$bank_name',
    branch_name='$branch_name',
    account_holder='$account_holder',
    account_number='$account_number',
    ifsc_code='$ifsc_code',

    opening_balance='$opening_balance',
    credit_limit='$credit_limit',
    notes='$notes'

    WHERE id='$id'
    ");

    echo "<script>

    alert('Customer Updated Successfully');

    window.location='customer_view.php?id=$id';

    </script>";

}

?>

<!doctype html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Customer Details</title>

<link rel="stylesheet" href="../assets/css/backend-plugin.min.css">
<link rel="stylesheet" href="../assets/css/backende209.css?v=1.0.0">

<link rel="stylesheet"
href="../assets/vendor/remixicon/fonts/remixicon.css">

<style>

body{
    background:#f4f7fb;
}

.customer-card{

    background:#fff;
    border-radius:15px;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(0,0,0,.08);

}

.profile-header{

    background:linear-gradient(135deg,#32bdea,#158df7);
    color:white;
    padding:35px;
    text-align:center;

}

.profile-header i{

    font-size:70px;
    margin-bottom:15px;

}

.profile-header h3{

    font-weight:bold;
    margin-bottom:5px;

}

.section-title{

    background:#eef8ff;
    border-left:5px solid #32bdea;
    padding:12px 18px;
    font-size:18px;
    font-weight:bold;
    margin-bottom:20px;

}

.info-box{

    border:1px solid #eee;
    border-radius:10px;
    padding:15px;
    margin-bottom:15px;
    background:white;

}

.info-box label{

    font-size:13px;
    color:#777;
    margin-bottom:5px;
    display:block;

}

.info-box p{

    margin:0;
    font-weight:600;
    color:#222;

}

</style>

</head>

<body>
        <body>

<div class="wrapper">

<?php include 'header.php'; ?>

<div class="content-page">

<div class="container-fluid">

<!-- Top Header -->

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h3 class="mb-1 font-weight-bold">

            Customer Details

        </h3>

        <p class="text-muted mb-0">

            View and update customer information.

        </p>

    </div>

    <div>

        <a href="customer_show.php"
        class="btn btn-light border mr-2">

            <i class="ri-arrow-left-line"></i>

            Back

        </a>

        <button onclick="window.print();"
        class="btn btn-success mr-2">

            <i class="ri-printer-line"></i>

            Print

        </button>

        <button form="customerForm"
        type="submit"
        name="update"
        class="btn btn-primary">

            <i class="ri-save-line"></i>

            Update Customer

        </button>

    </div>

</div>



<!-- Customer Profile Card -->

<div class="card shadow-sm border-0 mb-4">

<div class="card-body">

<div class="row align-items-center">

<div class="col-lg-2 text-center">

<div style="width:95px;
height:95px;
background:#0d6efd;
border-radius:50%;
display:flex;
align-items:center;
justify-content:center;
margin:auto;">

<i class="ri-user-3-line text-white"
style="font-size:45px;"></i>

</div>

</div>



<div class="col-lg-7">

<h3 class="mb-2">

<?php echo $row['customer_name']; ?>

</h3>

<div class="mb-2">

<span class="badge badge-primary">

<?php echo $row['customer_code']; ?>

</span>

<span class="badge badge-<?php echo ($row['status']=="Active") ? "success":"danger"; ?> ml-2">

<?php echo $row['status']; ?>

</span>

</div>

<div class="text-muted">

<i class="ri-phone-line"></i>

<?php echo $row['phone']; ?>

&nbsp;&nbsp;&nbsp;

<i class="ri-mail-line"></i>

<?php echo $row['email']; ?>

</div>

</div>



<div class="col-lg-3 text-right">

<h5 class="text-success">

₹ <?php echo number_format($row['opening_balance'],2); ?>

</h5>

<small class="text-muted">

Opening Balance

</small>

<br><br>

<h6 class="text-primary">

₹ <?php echo number_format($row['credit_limit'],2); ?>

</h6>

<small class="text-muted">

Credit Limit

</small>

</div>

</div>

</div>

</div>



<form method="post" id="customerForm">



<!-- Basic Information -->

<div class="card shadow-sm border-0 mb-4">

<div class="card-header bg-white">

<h5 class="mb-0">

<i class="ri-user-settings-line text-primary"></i>

Basic Information

</h5>

</div>

<div class="card-body">

<div class="row"> 
</body>
</html>