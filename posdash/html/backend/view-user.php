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

    $full_name = mysqli_real_escape_string($conn,$_POST['full_name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $phone = mysqli_real_escape_string($conn,$_POST['phone']);
    $role_id = mysqli_real_escape_string($conn,$_POST['role_id']);
    $gender = mysqli_real_escape_string($conn,$_POST['gender']);

    $address = mysqli_real_escape_string($conn,$_POST['address']);
    $state = mysqli_real_escape_string($conn,$_POST['state']);
    $city = mysqli_real_escape_string($conn,$_POST['city']);
    $country = mysqli_real_escape_string($conn,$_POST['country']);

    $bank_name = mysqli_real_escape_string($conn,$_POST['bank_name']);
    $branch_name = mysqli_real_escape_string($conn,$_POST['bank_branch']);
    $account_holder = mysqli_real_escape_string($conn,$_POST['account_holder_name']);
    $account_number = mysqli_real_escape_string($conn,$_POST['account_number']);
    $ifsc_code = mysqli_real_escape_string($conn,$_POST['ifsc_code']);

    $experience = mysqli_real_escape_string($conn,$_POST['experience']);
    $qualification = mysqli_real_escape_string($conn,$_POST['qualification']);
    $work_location = mysqli_real_escape_string($conn,$_POST['work_location']);
    $employee_id = mysqli_real_escape_string($conn,$_POST['employee_id']);
    $employment_type = mysqli_real_escape_string($conn,$_POST['employment_type']);
    $joining_date = mysqli_real_escape_string($conn,$_POST['joining_date']);
    
    $salary = mysqli_real_escape_string($conn,$_POST['salary']);


   mysqli_query($conn,"
UPDATE users SET

full_name='$full_name',
email='$email',
mobile='$phone',
gender='$gender',
role_id='$role_id',

address='$address',
city='$city',
state='$state',
country='$country',

bank_name='$bank_name',
bank_branch='$branch_name',
account_holder_name='$account_holder',
account_number='$account_number',
ifsc_code='$ifsc_code',

experience='$experience',
qualification='$qualification',
work_location='$work_location',
employee_id='$employee_id',
employment_type='$employment_type',
joining_date='$joining_date',
salary='$salary'

WHERE id='$id'
");

    echo "<script>

    alert('Customer Updated Successfully');

    window.location='view-user.php?id=$id';

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


            <h3><?php echo $row['full_name']; ?></h3>

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

                            <label>Company Code</label>


                            <input type="text" name="company_id" class="form-control" id="product_image"  value="<?php echo $row['company_id']; ?>" readonly>

                            </div>

                            </div>

                            <div class="col-md-4">

                            <div class="info-box">

                            <label>Name</label>

                                        <input type="text" name="full_name" class="form-control" value="<?php echo $row['full_name']; ?>">

                            </div>

                            </div>

                            <div class="col-md-4">

                            <div class="info-box">

                            <label>Mobile</label>

                                <input type="text"
                                    id="phone"
                                    name="phone"
                                    class="form-control"
                                    value="<?php echo $row['mobile']; ?>">

                                <small id="phone_error" class="text-danger"></small>
                                
                            </div>

                            </div>

                            <div class="col-md-4">

                            <div class="info-box">

                            <label>Email</label>

                                <input type="email"
                                    id="email"
                                    name="email"
                                    class="form-control"
                                    value="<?php echo $row['email']; ?>">

                                <small id="email_error" class="text-danger"></small>

                            </div>

                            </div>

                            <div class="col-md-4">

                            <div class="info-box">

                        <label>Gender</label>

                                   <input type="text"
                                    id="gst_no"
                                    name="gender"
                                    class="form-control"
                                    value="<?php echo $row['gender']; ?>">

                                    <small id="gst_error" class="text-danger"></small>
                        </div>

                        </div>

                        <div class="col-md-4">

                        <div class="info-box">

                        <label>Role</label>

                                    <input type="text" name="role_id" class="form-control"
                id="pan_no"  value="<?php echo $row['role_id']; ?>">

                        </div>

                        </div>

                        </div>

                        <!-- Address -->

                        <div class="section-title">

                        <i class="ri-map-pin-line"></i>

                        Address Details

                        </div>

                        <div class="row">
                            <div class="col-md-4">

                        <div class="info-box">

                        <label>City</label>

                                    <input type="text" name="city" class="form-control"
                                     id="pan_no"  value="<?php echo $row['city']; ?>">

                        </div>

                        </div>

                            <div class="col-md-4">

                        <div class="info-box">

                        <label>State</label>

                                    <input type="text" name="state" class="form-control"
                                     id="pan_no"  value="<?php echo $row['state']; ?>">

                        </div>

                        </div>

                      
                            <div class="col-md-4">

                        <div class="info-box">

                        <label>Country</label>

                                    <input type="text" name="country" class="form-control"
                                     id="country"  value="<?php echo $row['country']; ?>">

                        </div>

                        </div>

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

                                    <input type="text" name="bank_branch" class="form-control"
                id="product_image"  value="<?php echo $row['bank_branch']; ?>">

                        </div>

                        </div>

                        <div class="col-md-4">

                        <div class="info-box">

                        <label>Account Holder</label>

                                    <input type="text" name="account_holder_name" class="form-control"
                id="product_image"  value="<?php echo $row['account_holder_name']; ?>">

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


                         <!-- Notes -->

                        <div class="section-title">

                        <i class="ri-file-text-line"></i>

                        Employment And Educational Details

                        </div>
                        <div class="row">
                        <div class="col-md-4">

                        <div class="info-box">

                        <label>Experience</label>

                                    <input type="text" name="experience" class="form-control"
                id="product_image"  value="<?php echo $row['experience']; ?>">

                        </div>

                        </div>

                        <div class="col-md-4">

                        <div class="info-box">

                        <label>Qualification</label>

                                    <input type="text" name="qualification" class="form-control"
                id="product_image"  value="<?php echo $row['qualification']; ?>">

                        </div>

                        </div>

                        <div class="col-md-4">

                        <div class="info-box">

                        <label>Work Location</label>

                                    <input type="text" name="work_location" class="form-control"
                id="product_image"  value="<?php echo $row['work_location']; ?>">

                        </div>

                        </div>

                        <div class="col-md-4">

                        <div class="info-box">

                        <label>Employee Id</label>

                                    <input type="text" name="employee_id" class="form-control"
                id="product_image"  value="<?php echo $row['employee_id']; ?>">

                        </div>

                        </div>

                        <div class="col-md-4">

                        <div class="info-box">

                        <label>Employee Type</label>

                                    <input type="text" name="employment_type" class="form-control"
                id="product_image"  value="<?php echo $row['employment_type']; ?>">

                        </div>

                        </div>

                        <div class="col-md-4">

                        <div class="info-box">

                        <label>Joining Date</label>

                                    <input type="text" name="joining_date" class="form-control"
                id="product_image"  value="<?php echo $row['joining_date']; ?>">

                        </div>

                        </div>

                </div>

                        <!-- Financial -->

                        <div class="section-title">

                        <i class="ri-wallet-3-line"></i>

                        Financial Details

                        </div>

                        <div class="row">

                        <div class="col-md-4">

                        <div class="info-box">

                        <label>Opening Balance</label>

                                    <input type="text" name="salary" class="form-control"
                id="product_image"  value="₹ <?php echo $row['salary']; ?>">

                        </div>

                        </div>

                        
                        </div>

                       

                        <div class="text-right mt-4">

                        <a href="page-list-users.php"
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

    <script>

        const phone=document.getElementById("phone");
        const phoneError=document.getElementById("phone_error");

        phone.addEventListener("keyup",function(){

        if(!/^[0-9]{10}$/.test(phone.value))
        {
        phoneError.innerHTML="Enter valid 10 digit mobile number";
        }
        else
        {
        phoneError.innerHTML="";
        }

        });

        const email=document.getElementById("email");
        const emailError=document.getElementById("email_error");

        email.addEventListener("keyup",function(){

        let pattern=/^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if(!pattern.test(email.value))
        {
        emailError.innerHTML="Enter valid email";
        }
        else
        {
        emailError.innerHTML="";
        }

        });

        const pan=document.getElementById("pan_no");
        const panError=document.getElementById("pan_error");

        pan.addEventListener("keyup",function(){

        let pattern=/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/;

        if(!pattern.test(pan.value.toUpperCase()))
        {
        panError.innerHTML="Invalid PAN Number";
        }
        else
        {
        panError.innerHTML="";
        }

        });


        const ifsc=document.getElementById("ifsc_code");
        const ifscError=document.getElementById("ifsc_error");

        ifsc.addEventListener("keyup",function(){

        let pattern=/^[A-Z]{4}0[A-Z0-9]{6}$/;

        if(!pattern.test(ifsc.value.toUpperCase()))
        {
        ifscError.innerHTML="Invalid IFSC Code";
        }
        else
        {
        ifscError.innerHTML="";
        }

        });


        document.querySelector("form").addEventListener("submit",function(e){

        if(phoneError.innerHTML!="" ||
        emailError.innerHTML!="" ||
        gstError.innerHTML!="" ||
        panError.innerHTML!="" ||
        ifscError.innerHTML!="")
        {
        e.preventDefault();
        alert("Please correct all validation errors.");
        }

        });


    </script>


</body>
</html>