<?php
include 'db.php';

if(!isset($_GET['id']))
{
    header("Location: customer_show.php");
    exit;
}

$id = intval($_GET['id']);

$result = mysqli_query($conn,"SELECT * FROM users WHERE id='$id'");

if(mysqli_num_rows($result)==0)
{
    die("Customer Not Found");
}

$row = mysqli_fetch_assoc($result);
?>

<?php
if(isset($_POST['update']))
{

    $supplier_name = mysqli_real_escape_string($conn,$_POST['full_name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $phone = mysqli_real_escape_string($conn,$_POST['mobile']);
    $gst_no = mysqli_real_escape_string($conn,$_POST['date_of_birth']);
    $pan_no = mysqli_real_escape_string($conn,$_POST['gender']);

    $address = mysqli_real_escape_string($conn,$_POST['address']);

    $bank_name = mysqli_real_escape_string($conn,$_POST['bank_name']);
    $branch_name = mysqli_real_escape_string($conn,$_POST['branch_name']);
    $account_holder = mysqli_real_escape_string($conn,$_POST['account_holder']);
    $account_number = mysqli_real_escape_string($conn,$_POST['account_number']);
    $ifsc_code = mysqli_real_escape_string($conn,$_POST['ifsc_code']);

    $opening_balance = mysqli_real_escape_string($conn,$_POST['opening_balance']);
    
    $notes = mysqli_real_escape_string($conn,$_POST['notes']);

    mysqli_query($conn,"
    UPDATE supplier SET

    supplier_name='$supplier_name',
    email='$email',
    phone='$phone',
    gst_no='$gst_no',
    pan_no='$pan_no',

    address='$address',

    bank_name='$bank_name',
    branch_name='$branch_name',
    account_holder='$account_holder',
    account_number='$account_number',
    ifsc_code='$ifsc_code',

    opening_balance='$opening_balance',
    
    notes='$notes'

    WHERE id='$id'
    ");

    echo "<script>

    alert('Customer Updated Successfully');

    window.location='view-suppliers.php?id=$id';

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
     
    <div class="wrapper">
        <?php include 'header.php'; ?>
       



     

        <div class="content-page">

            <div class="container-fluid">

            <div class="customer-card">

            <div class="profile-header">


            <h3><?php echo $row['supplier_name']; ?></h3>

                            <span class="badge badge-<?php echo ($row['status']=="Active") ? "success":"danger"; ?>">

                            <?php echo $row['status']; ?>

                            </span>

                            </div>

                            <div class="card-body">

                            <!-- Contact -->

                            <div class="section-title">
                            <i class="ri-phone-line"></i>
                            Contact Information
                            </div>

                            <div class="row">

                            <div class="col-md-4">

                            <div class="info-box">

                <form method="post">

                            <label>Customer Code</label>


                            <input type="text" name="supplier_code" class="form-control" id="product_image"  value="<?php echo $row['supplier_code']; ?>" readonly>

                            </div>

                            </div>

                            <div class="col-md-4">

                            <div class="info-box">

                            <label>Name</label>

                                        <input type="text" name="supplier_name" class="form-control" value="<?php echo $row['supplier_name']; ?>">

                            </div>

                            </div>

                            <div class="col-md-4">

                            <div class="info-box">

                            <label>Mobile</label>

                                        <input type="text" name="phone" class="form-control" id="product_image"  value="<?php echo $row['phone']; ?>">

                            </div>

                            </div>

                            <div class="col-md-4">

                            <div class="info-box">

                            <label>Email</label>

                                        <input type="text" name="email" class="form-control" id="product_image"  value="<?php echo $row['email']; ?>">

                            </div>

                            </div>

                            <div class="col-md-4">

                            <div class="info-box">

                        <label>GST Number</label>

                                    <input type="text" name="gst_no" class="form-control"
                id="product_image"  value="<?php echo $row['gst_no']; ?>">

                        </div>

                        </div>

                        <div class="col-md-4">

                        <div class="info-box">

                        <label>PAN Number</label>

                                    <input type="text" name="pan_no" class="form-control"
                id="product_image"  value="<?php echo $row['pan_no']; ?>">

                        </div>

                        </div>

                        </div>

                        <!-- Address -->

                        <div class="section-title">

                        <i class="ri-map-pin-line"></i>

                        Address Details

                        </div>

                        <div class="row">

                        <div class="col-md-12">

                        <div class="info-box">

                        <label>Address</label>

                                    <input type="text" name="address" class="form-control"
                id="product_image"  value="<?php echo ($row['address']); ?>">

                        </div>

                        </div>

                        </div>

                        <!-- Bank -->

                        <div class="section-title">

                        <i class="ri-bank-line"></i>

                        Bank Details

                        </div>

                        <div class="row">

                        <div class="col-md-4">

                        <div class="info-box">

                        <label>Bank Name</label>

                                    <input type="text" name="bank_name" class="form-control"
                id="product_image"  value="<?php echo $row['bank_name']; ?>">

                        </div>

                        </div>

                        <div class="col-md-4">

                        <div class="info-box">

                        <label>Branch Name</label>

                                    <input type="text" name="barnch_name" class="form-control"
                id="product_image"  value="<?php echo $row['branch_name']; ?>">

                        </div>

                        </div>

                        <div class="col-md-4">

                        <div class="info-box">

                        <label>Account Holder</label>

                                    <input type="text" name="account_holder" class="form-control"
                id="product_image"  value="<?php echo $row['account_holder']; ?>">

                        </div>

                        </div>

                        <div class="col-md-6">

                        <div class="info-box">

                        <label>Account Number</label>

                                    <input type="text" name="account_number" class="form-control"
                id="product_image"  value="<?php echo $row['account_number']; ?>">

                        </div>

                        </div>

                        <div class="col-md-6">

                        <div class="info-box">

                        <label>IFSC Code</label>

                                    <input type="text" name="ifsc_code" class="form-control"
                id="product_image"  value="<?php echo $row['ifsc_code']; ?>">

                        </div>

                        </div>

                        </div>

                        <!-- Financial -->

                        <div class="section-title">

                        <i class="ri-wallet-3-line"></i>

                        Financial Details

                        </div>

                        <div class="row">

                        <div class="col-md-6">

                        <div class="info-box">

                        <label>Opening Balance</label>

                                    <input type="text" name="opening_balance" class="form-control"
                id="product_image"  value="₹ <?php echo number_format($row['opening_balance'],2); ?>">

                        </div>

                        </div>

                        
                        </div>

                        <!-- Notes -->

                        <div class="section-title">

                        <i class="ri-file-text-line"></i>

                        Notes

                        </div>

                        <div class="info-box">

                                    <input type="text" name="notes" class="form-control"
                id="product_image"  value="<?php echo $row['notes']; ?>">

                        </div>

                        <div class="text-right mt-4">

                        <a href="customer_show.php"
                        class="btn btn-secondary">

                        <i class="ri-arrow-left-line"></i>

                        Back

                        </a>

                        <button type="submit"
                        class="btn btn-primary" name="update">

                        <i class="ri-pencil-line"></i>

                        Edit Customer

                        </button>

                        <button onclick="window.print()"
                        class="btn btn-success">

                        <i class="ri-printer-line"></i>

                        Print

                        </button>
            </form>
                        </div>

                        </div>

                        </div>

                </div>

        </div>

        </div>
    <footer class="iq-footer">
            <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item"><a href="privacy-policy.html">Privacy Policy</a></li>
                                <li class="list-inline-item"><a href="terms-of-service.html">Terms of Use</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-6 text-right">
                            <span class="mr-1"><script type="a78d9fab55039608c6770c65-text/javascript">document.write(new Date().getFullYear())</script>©</span> <a href="#" class="">POS Dash</a>.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Backend Bundle JavaScript -->
    <script src="../assets/js/backend-bundle.min.js" type="a78d9fab55039608c6770c65-text/javascript"></script>
    
    <!-- Table Treeview JavaScript -->
    <script src="../assets/js/table-treeview.js" type="a78d9fab55039608c6770c65-text/javascript"></script>
    
    <!-- Chart Custom JavaScript -->
    <script src="../assets/js/customizer.js" type="a78d9fab55039608c6770c65-text/javascript"></script>
    
    <!-- Chart Custom JavaScript -->
    <script async src="../assets/js/chart-custom.js" type="a78d9fab55039608c6770c65-text/javascript"></script>
    
    <!-- app JavaScript -->
    <script src="../assets/js/app.js" type="a78d9fab55039608c6770c65-text/javascript"></script>
  <script src="../../../cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="a78d9fab55039608c6770c65-|49" defer></script><script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'a1340e69af36ce6f',t:'MTc4MjcyNjkzNA=='};var a=document.createElement('script');a.src='../../../cdn-cgi/challenge-platform/h/b/scripts/jsd/25e6c66701a0/maind41d.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script><script defer src="https://static.cloudflareinsights.com/beacon.min.js/v833ccba57c9e4d2798f2e76cebdd09a11778172276447" integrity="sha512-57MDmcccJXYtNnH+ZiBwzC4jb2rvgVCEokYN+L/nLlmO8rfYT/gIpW2A569iJ/3b+0UEasghjuZH/ma3wIs/EQ==" data-cf-beacon='{"version":"2024.11.0","token":"41ccecab40284244aa0b52f56036ee92","r":1,"server_timing":{"name":{"cfCacheStatus":true,"cfEdge":true,"cfExtPri":true,"cfL4":true,"cfOrigin":true,"cfSpeedBrain":true},"location_startswith":null}}' crossorigin="anonymous"></script>
</body>
</html>