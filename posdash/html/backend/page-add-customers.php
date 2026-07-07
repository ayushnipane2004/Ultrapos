<?php
include 'db.php';

$result = mysqli_query($conn, "SELECT MAX(id) AS lastid FROM customer");
$row = mysqli_fetch_assoc($result);

$next_id = $row['lastid'] + 1;
$customer_code = "CUS" . str_pad($next_id, 4, "0", STR_PAD_LEFT);


if (isset($_POST['save'])) {

    $customer_code     = $_POST['customer_code'];
    $customer_name     = $_POST['customer_name'];
    $email             = $_POST['email'];
    $phone             = $_POST['phone'];
    $opening_balance   = $_POST['opening_balance'];
    $credit_limit      = $_POST['credit_limit'];
    $notes             = $_POST['notes'];
    $status            = $_POST['status'];

    $address           = $_POST['address'];
    $state             = $_POST['state'];
    $city              = $_POST['city'];
    $pincode           = $_POST['pincode'];

    $bank_name         = $_POST['bank_name'];
    $branch_name       = $_POST['branch_name'];
    $account_holder    = $_POST['account_holder'];
    $account_number    = $_POST['account_number'];
    $ifsc_code         = $_POST['ifsc_code'];

    $gst_no            = $_POST['gst_no'];
    $pan_no            = $_POST['pan_no'];

    $sql = "INSERT INTO customer
    (
        customer_code,
        customer_name,
        email,
        phone,
        opening_balance,
        credit_limit,
        notes,
        status,
        address,
        state,
        city,
        pincode,
        bank_name,
        branch_name,
        account_holder,
        account_number,
        ifsc_code,
        gst_no,
        pan_no
    )
    VALUES
    (
        '$customer_code',
        '$customer_name',
        '$email',
        '$phone',
        '$opening_balance',
        '$credit_limit',
        '$notes',
        '$status',
        '$address',
        '$state',
        '$city',
        '$pincode',
        '$bank_name',
        '$branch_name',
        '$account_holder',
        '$account_number',
        '$ifsc_code',
        '$gst_no',
        '$pan_no'
    )";

    if (mysqli_query($conn, $sql)) {

        echo "<script>
            alert('Customer Added Successfully');
            window.location='customer_show.php';
        </script>";
    }
}
?>
<!doctype html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>POS Dash | Responsive Bootstrap 4 Admin Dashboard Template</title>
      
      <!-- Favicon -->
      <link rel="shortcut icon" href="https://templates.iqonic.design/posdash/html/assets/images/favicon.ico" />
      <link rel="stylesheet" href="../assets/css/backend-plugin.min.css">
      <link rel="stylesheet" href="../assets/css/backende209.css?v=1.0.0">
      <link rel="stylesheet" href="../assets/vendor/%40fortawesome/fontawesome-free/css/all.min.css">
      <link rel="stylesheet" href="../assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css">
      <link rel="stylesheet" href="../assets/vendor/remixicon/fonts/remixicon.css">  </head>
  <body class="  ">
    <!-- loader Start -->
    <div id="loading">
          <div id="loading-center">
          </div>
    </div>
    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper">
     
      
      <?php include 'header.php' ?>
      
      
      
      <div class="content-page">
     <div class="container-fluid add-form-list">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Add Customers</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post">
                             <div class="row">

                            <!-- Customer Code -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Customer Code <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control"
                                        name="customer_code"
                                        value="<?php echo $customer_code; ?>"
                                        readonly>
                                </div>
                            </div>

                            <!-- Customer Name -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Customer Name <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control"
                                        name="customer_name"
                                        placeholder="Enter Customer Name"
                                        required>
                                </div>
                            </div>

                            <!-- Mobile -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Mobile Number <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control"
                                        name="phone"
                                        maxlength="10"
                                        placeholder="Enter Mobile Number"
                                        required>
                                </div>
                            </div>

                        </div>

                        <div class="row mt-3">

                            <!-- Email -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email"
                                        class="form-control"
                                        name="email"
                                        placeholder="Enter Email">
                                </div>
                            </div>

                            <!-- GST -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>GST Number</label>
                                    <input type="text"
                                        class="form-control"
                                        name="gst_no"
                                        maxlength="15"
                                        placeholder="Enter GST Number">
                                </div>
                            </div>

                            <!-- PAN -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>PAN Number</label>
                                    <input type="text"
                                        class="form-control"
                                        name="pan_no"
                                        maxlength="10"
                                        placeholder="Enter PAN Number">
                                </div>
                            </div>

                        </div>
                        <hr>


                            <h4 class="mb-3">Bank Details</h4>

                            <div class="row">

                                <!-- Opening Balance -->
                                <div class="col-lg-3">
        
      
        
                                    <div class="form-group">
                                        <label>Bank Name</label>
                                        <input type="text"
                                            class="form-control"
                                            name="bank_name"
                                            placeholder="Enter Bank Name"
                                            >
                                    </div>
                                </div>

                                <!-- Credit Limit -->
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Branch Name</label>
                                        <input type="number"
                                            class="form-control"
                                            name="branch_name"
                                            placeholder="Enter Branch Name"
                                            >
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Account Holder Name</label>
                                        <input type="number"
                                            class="form-control"
                                            name="account_holder"
                                            placeholder="Enter Account Holder Name"
                                            >
                                    </div>
                                </div>

                                <!-- Customer Type (New Field) -->
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Account Number</label>
                                        <input type="number"
                                            class="form-control"
                                            name="account_number"
                                            placeholder="Enter Account Number"
                                            >
                                    </div>
                                </div>

                            </div>

                            <div class="row mt-3">

                                <!-- Notes -->
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>IFSC code</label>
                                        <input type="number"
                                            class="form-control"
                                            name="ifsc_code"
                                            placeholder="Enter IFSC Code"
                                            >
                                    </div>
                                </div>

                            </div><hr>
                        <h4 class="mb-3">Financial Details</h4>

                        <div class="row">

                            <!-- Opening Balance -->
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Opening Balance</label>
                                    <input type="number"
                                        class="form-control"
                                        name="opening_balance"
                                        step="0.01"
                                        value="0">
                                </div>
                            </div>

                            <!-- Credit Limit -->
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Credit Limit</label>
                                    <input type="number"
                                        class="form-control"
                                        name="credit_limit"
                                        step="0.01"
                                        value="0">
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="status">
                                        <option value="Active" selected>Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Customer Type (New Field) -->
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Customer Type</label>
                                    <select class="form-control" name="customer_type">
                                        <option value="">Select Type</option>
                                        <option value="Retail">Retail</option>
                                        <option value="Wholesale">Wholesale</option>
                                        <option value="Dealer">Dealer</option>
                                        <option value="Distributor">Distributor</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="row mt-3">

                            <!-- Notes -->
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Notes</label>
                                    <textarea class="form-control"
                                            name="notes"
                                            rows="4"
                                            placeholder="Enter Remarks / Notes"></textarea>
                                </div>
                            </div>

                        </div>
                        <hr>

                        <h4 class="mb-3">Address Details</h4>

                        <div class="row">

                            <!-- Billing Address -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Billing Address <span class="text-danger">*</span></label>
                                    <textarea class="form-control"
                                            name="address"
                                            rows="4"
                                            placeholder="Enter Billing Address"
                                            required></textarea>
                                </div>
                            </div>

                            <!-- Shipping Address -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Shipping Address</label>
                                    <textarea class="form-control"
                                            name="shipping_address"
                                            rows="4"
                                            placeholder="Enter Shipping Address"></textarea>
                                </div>
                            </div>

                        </div>

                        <div class="row mt-3">

                            <!-- State -->
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>State</label>
                                    <input type="text"
                                        class="form-control"
                                        name="state"
                                        placeholder="Enter State">
                                </div>
                            </div>

                            <!-- City -->
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>City</label>
                                    <input type="text"
                                        class="form-control"
                                        name="city"
                                        placeholder="Enter City">
                                </div>
                            </div>

                            <!-- Pincode -->
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Pincode</label>
                                    <input type="text"
                                        class="form-control"
                                        name="pincode"
                                        maxlength="6"
                                        placeholder="Enter Pincode">
                                </div>
                            </div>

                            <!-- Country -->
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Country</label>
                                    <input type="text"
                                        class="form-control"
                                        name="country"
                                        value="India">
                                </div>
                            </div>

                        </div>                         
                                                    <button type="submit" class="btn btn-primary mr-2" name="save">Add Sale</button>
                                                    <button type="reset" class="btn btn-danger">Reset</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Page end  -->
                            </div>
                            </div>
                            </div>
    <!-- Wrapper End-->
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
                            <span class="mr-1"><script type="bf8f22e01dafcc407e5d5919-text/javascript">document.write(new Date().getFullYear())</script>©</span> <a href="#" class="">POS Dash</a>.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Backend Bundle JavaScript -->
    <script src="../assets/js/backend-bundle.min.js" type="bf8f22e01dafcc407e5d5919-text/javascript"></script>
    
    <!-- Table Treeview JavaScript -->
    <script src="../assets/js/table-treeview.js" type="bf8f22e01dafcc407e5d5919-text/javascript"></script>
    
    <!-- Chart Custom JavaScript -->
    <script src="../assets/js/customizer.js" type="bf8f22e01dafcc407e5d5919-text/javascript"></script>
    
    <!-- Chart Custom JavaScript -->
    <script async src="../assets/js/chart-custom.js" type="bf8f22e01dafcc407e5d5919-text/javascript"></script>
    
    <!-- app JavaScript -->
    <script src="../assets/js/app.js" type="bf8f22e01dafcc407e5d5919-text/javascript"></script>
  <script src="../../../cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="bf8f22e01dafcc407e5d5919-|49" defer></script><script defer src="https://static.cloudflareinsights.com/beacon.min.js/v833ccba57c9e4d2798f2e76cebdd09a11778172276447" integrity="sha512-57MDmcccJXYtNnH+ZiBwzC4jb2rvgVCEokYN+L/nLlmO8rfYT/gIpW2A569iJ/3b+0UEasghjuZH/ma3wIs/EQ==" data-cf-beacon='{"version":"2024.11.0","token":"41ccecab40284244aa0b52f56036ee92","r":1,"server_timing":{"name":{"cfCacheStatus":true,"cfEdge":true,"cfExtPri":true,"cfL4":true,"cfOrigin":true,"cfSpeedBrain":true},"location_startswith":null}}' crossorigin="anonymous"></script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'a1340e589e5ecdfa',t:'MTc4MjcyNjkzMQ=='};var a=document.createElement('script');a.src='../../../cdn-cgi/challenge-platform/h/b/scripts/jsd/25e6c66701a0/maind41d.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>

<!-- Mirrored from templates.iqonic.design/posdash/html/backend/page-add-sale.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 29 Jun 2026 09:56:40 GMT -->
</html>