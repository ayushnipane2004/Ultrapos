

<?php
include 'super-session.php';
?>
    <?php
    include 'db.php';
?>



<?php
$id = $_GET['id'];

$company = mysqli_query($conn,"
SELECT *
FROM company_master
WHERE id='$id'
");

$row = mysqli_fetch_assoc($company);

$user = mysqli_query($conn,"
SELECT *
FROM users
WHERE company_id='$id'
");

$userRow = mysqli_fetch_assoc($user);




?>





<?php
if(isset($_POST['check_duplicate']))
{
    $mobile = mysqli_real_escape_string($conn,$_POST['mobile']);
    $gst_no = mysqli_real_escape_string($conn,$_POST['gst_no']);
$email = mysqli_real_escape_string($conn, $_POST['email']);



$mobileCheck = mysqli_query($conn,"
SELECT id
FROM company_master
WHERE mobile='$mobile'
AND id!='$id'
");



    if(mysqli_num_rows($mobileCheck)>0)
    {
        echo json_encode([
            "status"=>"error",
            "message"=>"Mobile Number Already Exists"
        ]);
        exit;
    }





$gstCheck = mysqli_query($conn,"
SELECT id
FROM company_master
WHERE gst_no='$gst_no'
AND id!='$id'
");
    if(mysqli_num_rows($gstCheck)>0)
    {
        echo json_encode([
            "status"=>"error",
            "message"=>"GST Number Already Exists"
        ]);
        exit;
    }



$emailCheck = mysqli_query($conn,"
SELECT id FROM company_master
WHERE email='$email' and id != '$id';
");


if(mysqli_num_rows($emailCheck)>0)
{
    echo json_encode([
        "status"=>"error",
        "message"=>"Company Email Already Exists"
    ]);
    exit;
}







    echo json_encode([
        "status"=>"success"
    ]);
    exit;
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
    <link rel="stylesheet" href="../assets/vendor/remixicon/fonts/remixicon.css">  
    
   
</head>

<body class="  ">
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>
    <!-- loader END -->





<?php

    if(isset($_POST['register']))
    {
        $company_name   = mysqli_real_escape_string($conn, $_POST['company_name']);
        $mobile         = mysqli_real_escape_string($conn, $_POST['mobile']);
        $email          = mysqli_real_escape_string($conn, $_POST['email']);
        $gst_no         = mysqli_real_escape_string($conn, $_POST['gst_no']);
        $city         = mysqli_real_escape_string($conn, $_POST['city']);
        $state         = mysqli_real_escape_string($conn, $_POST['state']);
        $country         = mysqli_real_escape_string($conn, $_POST['country']);
        $address        = mysqli_real_escape_string($conn, $_POST['address']);
        $currency       = mysqli_real_escape_string($conn, $_POST['currency']);
        $financial_year = mysqli_real_escape_string($conn, $_POST['financial_year']);
        $status         = mysqli_real_escape_string($conn, $_POST['status']);
        $businesstype   = mysqli_real_escape_string($conn, $_POST['businesstype']);
        $ownername   = mysqli_real_escape_string($conn, $_POST['ownername']);
        $contactpersonname   = mysqli_real_escape_string($conn, $_POST['contactpersonname']);
        $contactmobno       = mysqli_real_escape_string($conn, $_POST['contactmob']);
        $alternatemob       = mysqli_real_escape_string($conn, $_POST['alternatemob']);
        $contactpersonemail       = mysqli_real_escape_string($conn, $_POST['contactpersonemail']);
        $website       = mysqli_real_escape_string($conn, $_POST['website']);
        $pincode       = mysqli_real_escape_string($conn, $_POST['pincode']);
        $date_of_birth = mysqli_real_escape_string($conn,$_POST['date_of_birth']);
        $gender = mysqli_real_escape_string($conn,$_POST['gender']);
        $username       = mysqli_real_escape_string($conn, $_POST['username']);
        $password       = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        

 





$checkUser = mysqli_query($conn,"
SELECT id
FROM users
WHERE username='$username'
AND company_id!='$id'
");


        if(mysqli_num_rows($checkUser)>0)
        {
            echo "<script>
            alert('Username Already Exists');
            window.history.back();
            </script>";
            exit;
        }






        $logo="";

        if($_FILES['company_logo']['name']!="")
        {
            $logo=time()."_".$_FILES['company_logo']['name'];

            move_uploaded_file(
                $_FILES['company_logo']['tmp_name'],
                "../assets/documents/".$logo
            );
        }
        $ownerimg="";

        if($_FILES['company_ownerimg']['name']!="")
        {
            $ownerimg=time()."_".$_FILES['company_ownerimg']['name'];

            move_uploaded_file(
                $_FILES['company_ownerimg']['tmp_name'],
                 "../assets/ownerimage/".$ownerimg
            );
        }
    
        $company = mysqli_query($conn,"
        UPDATE company_master
SET
company_name='$company_name',
mobile='$mobile',
email='$email',
gst_no='$gst_no',
city='$city',
state='$state',
country='$country',
address='$address',
currency='$currency',
financial_year='$financial_year',
status='$status',
businesstype='$businesstype',
ownername='$ownername',
contactpersonname='$contactpersonname',
contactmob='$contactmobno',
alternatemob='$alternatemob',
contactpersonemail='$contactpersonemail',
website='$website'
WHERE id='$id'");

        if($company) {
        
    $company_id = mysqli_insert_id($conn);
            $hash_password = password_hash($password,PASSWORD_DEFAULT);
           mysqli_query($conn,"
                UPDATE users
SET
full_name='$ownername',
mobile='$contactmobno',
alternate_mobile='$alternatemob',
email='$email',
username='$username',
gender='$gender',
date_of_birth='$date_of_birth',
address='$address',
city='$city',
state='$state',
country='$country',
pincode='$pincode'
WHERE company_id='$id'");




           echo "
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>

<script>
Swal.fire({
    icon: 'success',
    title: 'Success!',
    text: 'Company Updated Successfully',
    confirmButtonColor: '#32bdea',
    confirmButtonText: 'OK'
}).then((result) => {
    if(result.isConfirmed){
        window.location='super-dashboard.php';
    }
});
</script>
";



        }
        else
        {
           echo "
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>

<script>
Swal.fire({
    icon: 'error',
    title: 'Registration Failed!',
    text: 'Unable to register the company. Please try again.',
    confirmButtonColor: '#dc3545',
    confirmButtonText: 'OK'
}).then(() => {
    window.history.back();
});
</script>
";
        }
    }
    ?>






    <!-- Wrapper Start -->
    <div class="wrapper">
    <?php include 'super-header.php' ?>

    <div class="content-page">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex justify-content-between">


  <div class="header-title">
                          <a href="page-list-company.php"
class="btn btn-secondary mr-2">

<i class="ri-arrow-left-line"></i>

Back

</a>
                        </div>


                    <div class="header-title">
                        <h4 class="card-title">Add Company</h4>
                    </div>



                    
                </div>
            </div>

            <div class="card">
                <form method="post" enctype="multipart/form-data" id="wizardForm" novalidate>

                    <!-- ===== WIZARD STEPS ===== -->
                    <div class="wizard-steps-wrapper">
                        <ul class="nav nav-pills nav-justified wizard-nav" id="wizardNav">
                            <li class="nav-item step-item active" data-step="1">
                                <a class="nav-link" href="#">
                                    <span class="step-circle">1</span>
                                    <span class="step-label">Company Info</span>
                                </a>
                            </li>
                            <li class="nav-item step-item" data-step="2">
                                <a class="nav-link" href="#">
                                    <span class="step-circle">2</span>
                                    <span class="step-label">Address</span>
                                </a>
                            </li>
                            <li class="nav-item step-item" data-step="3">
                                <a class="nav-link" href="#">
                                    <span class="step-circle">3</span>
                                    <span class="step-label">Owner</span>
                                </a>
                            </li>
                            <li class="nav-item step-item" data-step="4">
                                <a class="nav-link" href="#">
                                    <span class="step-circle">4</span>
                                    <span class="step-label">Login</span>
                                </a>
                            </li>
                        </ul>
                        <div class="wizard-progress">
                            <div class="progress-bar" id="wizardProgressBar" style="width: 20%;"></div>
                        </div>
                    </div>

                    <!-- ===== WIZARD SECTIONS ===== -->
                    <div class="wizard-sections">

                        <!-- STEP 1: Company Information -->
                        <div class="wizard-section active" data-step="1">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Company Information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Company Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="company_name" placeholder="Enter Company Name" 
                                                       pattern="[A-Za-z0-9&\-. ]{3,100}" 
                                                       title="Only letters, numbers, &, ., -, spaces. 3-100 characters."
                                                       value="<?php echo isset($_POST['company_name']) ? htmlspecialchars($_POST['company_name']) : htmlspecialchars($row['company_name']); ?>" required>

                                                <div class="invalid-feedback">Company name is required (3-100 chars, letters, numbers, &, ., -, spaces).</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>GST Number <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="gst_no" placeholder="Enter GST Number" 
                                                       pattern="^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$"
                                                       title="Enter valid Indian GST number"

                                                       value="<?php echo isset($_POST['gst_no']) ? strtoupper(htmlspecialchars($_POST['gst_no'])) : htmlspecialchars($row['gst_no']); ?>" required>


                                                <div class="invalid-feedback">Please enter a valid Indian GST number.</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email <span class="text-danger">*</span></label>
                                                <input type="email" class="form-control" name="email" placeholder="Enter Email" 
                                                       value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : htmlspecialchars($row['email']); ?>" required>
                                                <div class="invalid-feedback">Please enter a valid email address.</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Mobile Number <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="mobile" placeholder="Enter Mobile Number" 
                                                       pattern="[0-9]{10}" maxlength="10"
                                                       title="Enter exactly 10 digits"
                                                       value="<?php echo isset($_POST['mobile']) ? htmlspecialchars($_POST['mobile']) : htmlspecialchars($row['mobile']); ?>" required>
                                                <div class="invalid-feedback">Mobile number must be exactly 10 digits.</div>
                                            </div>
                                        </div>



<div class="col-md-6">
    <div class="form-group">
        <label>Business Type <span class="text-danger">*</span></label>

        <select class="form-control" name="businesstype" required>

            <option value="">Select Business Type</option>

            <option value="Retail Store"
                <?php if((isset($_POST['businesstype']) && $_POST['businesstype']=="Retail Store") || (!isset($_POST['businesstype']) && $row['businesstype']=="Retail Store")) echo "selected"; ?>>
                Retail Store
            </option>

            <option value="Wholesale"
                <?php if((isset($_POST['businesstype']) && $_POST['businesstype']=="Wholesale") || (!isset($_POST['businesstype']) && $row['businesstype']=="Wholesale")) echo "selected"; ?>>
                Wholesale
            </option>

            <option value="Supermarket"
                <?php if((isset($_POST['businesstype']) && $_POST['businesstype']=="Supermarket") || (!isset($_POST['businesstype']) && $row['businesstype']=="Supermarket")) echo "selected"; ?>>
                Supermarket
            </option>

            <option value="Restaurant"
                <?php if((isset($_POST['businesstype']) && $_POST['businesstype']=="Restaurant") || (!isset($_POST['businesstype']) && $row['businesstype']=="Restaurant")) echo "selected"; ?>>
                Restaurant
            </option>

            <option value="Cafe"
                <?php if((isset($_POST['businesstype']) && $_POST['businesstype']=="Cafe") || (!isset($_POST['businesstype']) && $row['businesstype']=="Cafe")) echo "selected"; ?>>
                Cafe
            </option>

            <option value="Medical Store"
                <?php if((isset($_POST['businesstype']) && $_POST['businesstype']=="Medical Store") || (!isset($_POST['businesstype']) && $row['businesstype']=="Medical Store")) echo "selected"; ?>>
                Medical Store
            </option>

            <option value="Electronics"
                <?php if((isset($_POST['businesstype']) && $_POST['businesstype']=="Electronics") || (!isset($_POST['businesstype']) && $row['businesstype']=="Electronics")) echo "selected"; ?>>
                Electronics
            </option>

            <option value="Clothing & Fashion"
                <?php if((isset($_POST['businesstype']) && $_POST['businesstype']=="Clothing & Fashion") || (!isset($_POST['businesstype']) && $row['businesstype']=="Clothing & Fashion")) echo "selected"; ?>>
                Clothing & Fashion
            </option>

            <option value="Hardware"
                <?php if((isset($_POST['businesstype']) && $_POST['businesstype']=="Hardware") || (!isset($_POST['businesstype']) && $row['businesstype']=="Hardware")) echo "selected"; ?>>
                Hardware
            </option>

            <option value="Distributor"
                <?php if((isset($_POST['businesstype']) && $_POST['businesstype']=="Distributor") || (!isset($_POST['businesstype']) && $row['businesstype']=="Distributor")) echo "selected"; ?>>
                Distributor
            </option>

        </select>

        <div class="invalid-feedback">
            Please select a business type.
        </div>
    </div>
</div>




                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Website</label>
                                                <input type="url" class="form-control" name="website" placeholder="https://example.com"
                                                       value="<?php echo isset($_POST['website']) ? htmlspecialchars($_POST['website']) : htmlspecialchars($row['website']); ?>">
                                                <div class="invalid-feedback">Please enter a valid URL.</div>
                                            </div>
                                        </div>





                                   <div class="col-md-6">
    <div class="form-group">
        <label>Status <span class="text-danger">*</span></label>

        <select class="form-control" name="status" required>

            <option value="Active"
                <?php
                if(
                    (isset($_POST['status']) && $_POST['status']=="Active") ||
                    (!isset($_POST['status']) && $row['status']=="Active")
                ) echo "selected";
                ?>>
                Active
            </option>

            <option value="Inactive"
                <?php
                if(
                    (isset($_POST['status']) && $_POST['status']=="Inactive") ||
                    (!isset($_POST['status']) && $row['status']=="Inactive")
                ) echo "selected";
                ?>>
                Inactive
            </option>

        </select>

        <div class="invalid-feedback">
            Please select a status.
        </div>
    </div>
</div>



                       
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- STEP 2: Address Information -->
                        <div class="wizard-section" data-step="2">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Address Information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Address <span class="text-danger">*</span></label>
                                                <textarea class="form-control" rows="3" name="address" placeholder="Enter Full Address" 
                                                          maxlength="255" required><?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : htmlspecialchars($row['address']); ?></textarea>
                                                <div class="invalid-feedback">Address is required (max 255 characters).</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Country <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="country" placeholder="Enter Country"
                                                       pattern="[A-Za-z\s]+" title="Only alphabets and spaces allowed"
                                                       value="<?php echo isset($_POST['country']) ? htmlspecialchars($_POST['country']) : htmlspecialchars($row['country']); ?>" required>
                                                <div class="invalid-feedback">Country must contain only alphabets and spaces.</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>State <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="state" placeholder="Enter State"
                                                       pattern="[A-Za-z\s]+" title="Only alphabets and spaces allowed"
                                                       value="<?php echo isset($_POST['state']) ? htmlspecialchars($_POST['state']) : htmlspecialchars($row['state']); ?>" required>
                                                <div class="invalid-feedback">State must contain only alphabets and spaces.</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>City <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="city" placeholder="Enter City"
                                                       pattern="[A-Za-z\s]+" title="Only alphabets and spaces allowed"
                                                       value="<?php echo isset($_POST['city']) ? htmlspecialchars($_POST['city']) : htmlspecialchars($row['city']); ?>" required>
                                                <div class="invalid-feedback">City must contain only alphabets and spaces.</div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Pincode <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="pincode" placeholder="Enter Pincode"
                                                       pattern="[0-9]{6}" maxlength="6" title="Exactly 6 digits"
                                                       value="<?php echo isset($_POST['pincode']) ? htmlspecialchars($_POST['pincode']) : htmlspecialchars($userRow['pincode']); ?>" required>
                                                <div class="invalid-feedback">Pincode must be exactly 6 digits.</div>
                                            </div>
                                        </div>



                                    <div class="col-md-4">
    <div class="form-group">
        <label>Currency <span class="text-danger">*</span></label>

        <select class="form-control" name="currency" required>

            <option value="">Select Currency</option>

            <option value="INR"
                <?php if((isset($_POST['currency']) && $_POST['currency']=="INR") || (!isset($_POST['currency']) && $row['currency']=="INR")) echo "selected"; ?>>
                INR - Indian Rupee
            </option>

            <option value="USD"
                <?php if((isset($_POST['currency']) && $_POST['currency']=="USD") || (!isset($_POST['currency']) && $row['currency']=="USD")) echo "selected"; ?>>
                USD - US Dollar
            </option>

            <option value="EUR"
                <?php if((isset($_POST['currency']) && $_POST['currency']=="EUR") || (!isset($_POST['currency']) && $row['currency']=="EUR")) echo "selected"; ?>>
                EUR - Euro
            </option>

            <option value="GBP"
                <?php if((isset($_POST['currency']) && $_POST['currency']=="GBP") || (!isset($_POST['currency']) && $row['currency']=="GBP")) echo "selected"; ?>>
                GBP - British Pound
            </option>

            <option value="AED"
                <?php if((isset($_POST['currency']) && $_POST['currency']=="AED") || (!isset($_POST['currency']) && $row['currency']=="AED")) echo "selected"; ?>>
                AED - UAE Dirham
            </option>

            <option value="SAR"
                <?php if((isset($_POST['currency']) && $_POST['currency']=="SAR") || (!isset($_POST['currency']) && $row['currency']=="SAR")) echo "selected"; ?>>
                SAR - Saudi Riyal
            </option>

            <option value="JPY"
                <?php if((isset($_POST['currency']) && $_POST['currency']=="JPY") || (!isset($_POST['currency']) && $row['currency']=="JPY")) echo "selected"; ?>>
                JPY - Japanese Yen
            </option>

            <option value="AUD"
                <?php if((isset($_POST['currency']) && $_POST['currency']=="AUD") || (!isset($_POST['currency']) && $row['currency']=="AUD")) echo "selected"; ?>>
                AUD - Australian Dollar
            </option>

            <option value="CAD"
                <?php if((isset($_POST['currency']) && $_POST['currency']=="CAD") || (!isset($_POST['currency']) && $row['currency']=="CAD")) echo "selected"; ?>>
                CAD - Canadian Dollar
            </option>

            <option value="SGD"
                <?php if((isset($_POST['currency']) && $_POST['currency']=="SGD") || (!isset($_POST['currency']) && $row['currency']=="SGD")) echo "selected"; ?>>
                SGD - Singapore Dollar
            </option>

        </select>

        <div class="invalid-feedback">
            Please select a currency.
        </div>
    </div>
</div>


                                       <div class="col-md-4">
    <div class="form-group">
        <label>Financial Year <span class="text-danger">*</span></label>

        <select class="form-control" name="financial_year" required>

            <option value="">Select Financial Year</option>

            <option value="2023-2024"
                <?php if((isset($_POST['financial_year']) && $_POST['financial_year']=="2023-2024") || (!isset($_POST['financial_year']) && $row['financial_year']=="2023-2024")) echo "selected"; ?>>
                2023-2024
            </option>

            <option value="2024-2025"
                <?php if((isset($_POST['financial_year']) && $_POST['financial_year']=="2024-2025") || (!isset($_POST['financial_year']) && $row['financial_year']=="2024-2025")) echo "selected"; ?>>
                2024-2025
            </option>

            <option value="2025-2026"
                <?php if((isset($_POST['financial_year']) && $_POST['financial_year']=="2025-2026") || (!isset($_POST['financial_year']) && $row['financial_year']=="2025-2026")) echo "selected"; ?>>
                2025-2026
            </option>

            <option value="2026-2027"
                <?php if((isset($_POST['financial_year']) && $_POST['financial_year']=="2026-2027") || (!isset($_POST['financial_year']) && $row['financial_year']=="2026-2027")) echo "selected"; ?>>
                2026-2027
            </option>

            <option value="2027-2028"
                <?php if((isset($_POST['financial_year']) && $_POST['financial_year']=="2027-2028") || (!isset($_POST['financial_year']) && $row['financial_year']=="2027-2028")) echo "selected"; ?>>
                2027-2028
            </option>

            <option value="2028-2029"
                <?php if((isset($_POST['financial_year']) && $_POST['financial_year']=="2028-2029") || (!isset($_POST['financial_year']) && $row['financial_year']=="2028-2029")) echo "selected"; ?>>
                2028-2029
            </option>

            <option value="2029-2030"
                <?php if((isset($_POST['financial_year']) && $_POST['financial_year']=="2029-2030") || (!isset($_POST['financial_year']) && $row['financial_year']=="2029-2030")) echo "selected"; ?>>
                2029-2030
            </option>

        </select>

        <div class="invalid-feedback">
            Please select a financial year.
        </div>
    </div>
</div>







                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- STEP 3: Owner Information -->
                        <div class="wizard-section" data-step="3">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Owner Information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Owner Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="ownername" placeholder="Enter Owner Name"
                                                       pattern="[A-Za-z\s]+" title="Only alphabets and spaces allowed"
                                                       value="<?php echo isset($_POST['ownername']) ? htmlspecialchars($_POST['ownername']) : htmlspecialchars($row['ownername']); ?>" required>
                                                <div class="invalid-feedback">Owner name must contain only alphabets and spaces.</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Contact Person Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="contactpersonname" placeholder="Enter Contact Person Name"
                                                       pattern="[A-Za-z\s]+" title="Only alphabets and spaces allowed"
                                                       value="<?php echo isset($_POST['contactpersonname']) ? htmlspecialchars($_POST['contactpersonname']) : htmlspecialchars($row['contactpersonname']); ?>" required>
                                                <div class="invalid-feedback">Contact person name must contain only alphabets and spaces.</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Mobile Number <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="contactmob" placeholder="Enter Mobile Number"
                                                       pattern="[0-9]{10}" maxlength="10" title="Exactly 10 digits"
                                                       value="<?php echo isset($_POST['contactmob']) ? htmlspecialchars($_POST['contactmob']) : htmlspecialchars($row['contactmob']); ?>" required>
                                                <div class="invalid-feedback">Mobile number must be exactly 10 digits.</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Alternate Mobile</label>
                                                <input type="text" class="form-control" name="alternatemob" placeholder="Enter Alternate Mobile"
                                                       pattern="[0-9]{10}" maxlength="10" title="Exactly 10 digits"
                                                       value="<?php echo isset($_POST['alternatemob']) ? htmlspecialchars($_POST['alternatemob']) : htmlspecialchars($row['alternatemob']); ?>">
                                                <div class="invalid-feedback">Alternate mobile must be exactly 10 digits.</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Contact Email</label>
                                                <input type="email" class="form-control" name="contactpersonemail" placeholder="Enter Contact Email"
                                                       value="<?php echo isset($_POST['contactpersonemail']) ? htmlspecialchars($_POST['contactpersonemail']) : htmlspecialchars($row['contactpersonemail']); ?>">
                                                <div class="invalid-feedback">Please enter a valid email address.</div>
                                            </div>
                                        </div>



<div class="col-md-3">
    <div class="form-group">
        <label>Gender <span class="text-danger">*</span></label>

        <select class="form-control" name="gender" required>

            <option value="">Select Gender</option>

            <option value="Male"
                <?php
                if(
                    (isset($_POST['gender']) && $_POST['gender']=="Male") ||
                    (!isset($_POST['gender']) && $userRow['gender']=="Male")
                ) echo "selected";
                ?>>
                Male
            </option>

            <option value="Female"
                <?php
                if(
                    (isset($_POST['gender']) && $_POST['gender']=="Female") ||
                    (!isset($_POST['gender']) && $userRow['gender']=="Female")
                ) echo "selected";
                ?>>
                Female
            </option>

            <option value="Other"
                <?php
                if(
                    (isset($_POST['gender']) && $_POST['gender']=="Other") ||
                    (!isset($_POST['gender']) && $userRow['gender']=="Other")
                ) echo "selected";
                ?>>
                Other
            </option>

        </select>

        <div class="invalid-feedback">
            Please select a gender.
        </div>
    </div>
</div>



                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Date of Birth <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control" name="date_of_birth" id="date_of_birth"
                                                       max="<?php echo date('Y-m-d'); ?>" 
                                                       value="<?php echo isset($_POST['date_of_birth']) ? $_POST['date_of_birth'] : htmlspecialchars($userRow['date_of_birth']); ?>" required>
                                                <div class="invalid-feedback">Please select a valid date of birth (cannot be future date).</div>
                                            </div>
                                        </div>


                                      


                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- STEP 4: Login Information + Submit -->


                        <div class="wizard-section" data-step="4">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Login Information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Username <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="username" placeholder="Enter Username"
                                                       pattern="[A-Za-z0-9_]{4,30}" minlength="4" maxlength="30"
                                                       title="4-30 characters, letters, numbers, underscore only"
                                                       value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : htmlspecialchars($row['username']); ?>" required>
                                                <div class="invalid-feedback">Username must be 4-30 characters (letters, numbers, underscore only).</div>
                                            </div>
                                        </div>

                                    





                                



                                    </div>
                                </div>
                            </div>

                            <!-- Submit Buttons (inside final step) -->
                            <div class="card mt-3">
                                <div class="card-body text-center">
                                    <button type="submit" name="register" class="btn btn-primary mr-2" id="submitBtn">
                                        <i class="ri-save-line"></i> Edit Company
                                    </button>
                                    <button type="reset" class="btn btn-danger">
                                        <i class="ri-refresh-line"></i> Reset
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div><!-- /.wizard-sections -->

                    <!-- ===== WIZARD NAVIGATION ===== -->
                    <div class="wizard-navigation mt-4" style="margin:43px">
                        <button type="button" class="btn btn-secondary" id="prevBtn" disabled>Previous</button>
                        <button type="button" class="btn btn-primary" id="nextBtn">Next</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    </div>

    <!-- Wrapper End -->

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
                            <span class="mr-1"><script>document.write(new Date().getFullYear())</script> ©</span>
                            <a href="#">POS Dash</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Backend Bundle JavaScript -->
    <script src="../assets/js/backend-bundle.min.js"></script>
    <script src="../assets/js/table-treeview.js"></script>
    <script src="../assets/js/customizer.js"></script>
    <script src="../assets/js/chart-custom.js"></script>
    <script src="../assets/js/app.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- ===== ENHANCED WIZARD JAVASCRIPT ===== -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const sections = document.querySelectorAll('.wizard-section');
        const stepItems = document.querySelectorAll('.step-item');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const progressBar = document.getElementById('wizardProgressBar');
        let currentStep = 1;
        const totalSteps = sections.length;

        // ---- Enhanced validation per field ----
        function validateField(field) {
            // Skip hidden fields
            if (field.offsetParent === null) return true;
            
            // Required validation
            if (field.hasAttribute('required') && !field.value.trim()) {
                return false;
            }

            // Pattern validation
            if (field.getAttribute('pattern')) {
                const pattern = new RegExp(field.getAttribute('pattern'));
                if (field.value && !pattern.test(field.value)) {
                    return false;
                }
            }

            // Min/Max for number/date
            if (field.type === 'number' || field.type === 'date') {
                const min = field.getAttribute('min');
                const max = field.getAttribute('max');
                if (field.value) {
                    if (min && field.value < min) return false;
                    if (max && field.value > max) return false;
                }
            }

            // Email validation
            if (field.type === 'email' && field.value) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(field.value)) return false;
            }

            // URL validation
            if (field.type === 'url' && field.value) {
                try {
                    new URL(field.value);
                } catch {
                    return false;
                }
            }

            return true;
        }





        function validateCurrentStep() {
            const currentSection = document.querySelector('.wizard-section.active');
            if (!currentSection) return true;

            const fields = currentSection.querySelectorAll('input, select, textarea');
            let isValid = true;
            let firstInvalid = null;

            // Clear previous validation states
            fields.forEach(f => f.classList.remove('is-invalid'));

            // Validate all fields in current step
            fields.forEach(function(field) {
                if (field.offsetParent === null) return;
                
                const isFieldValid = validateField(field);
                if (!isFieldValid) {
                    field.classList.add('is-invalid');
                    isValid = false;
                    if (!firstInvalid) firstInvalid = field;
                }
            });

            // Special: Password strength validation (on step 4 only)
            const passwordField = currentSection.querySelector('#password');
            const confirmField = currentSection.querySelector('#confirm_password');
            if (passwordField && confirmField) {
                const pwd = passwordField.value;
                const hasUpper = /[A-Z]/.test(pwd);
                const hasLower = /[a-z]/.test(pwd);
                const hasNumber = /[0-9]/.test(pwd);
                const hasSpecial = /[!@#$%^&*()_+\-=\[\]{};:'",.<>?\\/]/.test(pwd);
                const isValidPwd = pwd.length >= 8 && pwd.length <= 20 && hasUpper && hasLower && hasNumber && hasSpecial;
                
                if (pwd && !isValidPwd) {
                    passwordField.classList.add('is-invalid');
                    isValid = false;
                    if (!firstInvalid) firstInvalid = passwordField;
                }
                
                // Confirm password match
                if (confirmField.value && pwd !== confirmField.value) {
                    confirmField.classList.add('is-invalid');
                    isValid = false;
                    if (!firstInvalid) firstInvalid = confirmField;
                }
            }

            // Special: File validation
            const logoInput = currentSection.querySelector('#company_logo');
            if (logoInput && logoInput.files && logoInput.files.length > 0) {
                const file = logoInput.files[0];
                const validTypes = ['image/jpeg', 'image/png'];
                const errorEl = document.getElementById('logoError');
                if (!validTypes.includes(file.type)) {
                    logoInput.classList.add('is-invalid');
                    if (errorEl) { errorEl.style.display = 'block'; errorEl.textContent = 'Only JPG, JPEG, PNG allowed.'; }
                    isValid = false;
                    if (!firstInvalid) firstInvalid = logoInput;
                } else if (file.size > 2 * 1024 * 1024) {
                    logoInput.classList.add('is-invalid');
                    if (errorEl) { errorEl.style.display = 'block'; errorEl.textContent = 'File size must be less than 1 MB.'; }
                    isValid = false;
                    if (!firstInvalid) firstInvalid = logoInput;
                } else {
                    if (errorEl) { errorEl.style.display = 'none'; }
                }
            }

            const ownerImgInput = currentSection.querySelector('#owner_image');
            if (ownerImgInput && ownerImgInput.files && ownerImgInput.files.length > 0) {
                const file = ownerImgInput.files[0];
                const validTypes = ['image/jpeg', 'image/png'];
                const errorEl = document.getElementById('ownerImageError');
                if (!validTypes.includes(file.type)) {
                    ownerImgInput.classList.add('is-invalid');
                    if (errorEl) { errorEl.style.display = 'block'; errorEl.textContent = 'Only JPG, JPEG, PNG allowed.'; }
                    isValid = false;
                    if (!firstInvalid) firstInvalid = ownerImgInput;
                } else if (file.size > 2 * 1024 * 1024) {
                    ownerImgInput.classList.add('is-invalid');
                    if (errorEl) { errorEl.style.display = 'block'; errorEl.textContent = 'File size must be less than 1 MB.'; }
                    isValid = false;
                    if (!firstInvalid) firstInvalid = ownerImgInput;
                } else {
                    if (errorEl) { errorEl.style.display = 'none'; }
                }
            }

            // Special: GST uppercase conversion
            const gstField = currentSection.querySelector('[name="gst_no"]');
            if (gstField && gstField.value) {
                gstField.value = gstField.value.toUpperCase();
            }

            if (!isValid && firstInvalid) {
                firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                firstInvalid.focus();
            }

            return isValid;
        }





        function updateWizard() {
            sections.forEach((section) => {
                const stepNum = parseInt(section.dataset.step);
                section.classList.toggle('active', stepNum === currentStep);
            });

            stepItems.forEach((item) => {
                const stepNum = parseInt(item.dataset.step);
                item.classList.remove('active', 'completed');
                if (stepNum === currentStep) {
                    item.classList.add('active');
                } else if (stepNum < currentStep) {
                    item.classList.add('completed');
                }
            });

            const progress = ((currentStep - 1) / (totalSteps - 1)) * 100;
            progressBar.style.width = progress + '%';

            prevBtn.disabled = (currentStep === 1);

        const submitBtn = document.getElementById("submitBtn");

if (currentStep === totalSteps) {

    nextBtn.style.display = "none";

    if (submitBtn) {
        submitBtn.style.display = "inline-block";
    }

} else {

    nextBtn.style.display = "inline-block";
    nextBtn.textContent = "Next";
    nextBtn.classList.remove("btn-success");
    nextBtn.classList.add("btn-primary");

    if (submitBtn) {
        submitBtn.style.display = "none";
    }
}




            const wrapper = document.querySelector('.wizard-steps-wrapper');
            if (wrapper) {
                wrapper.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }

        function goToStep(step) {
            if (step < 1) step = 1;
            if (step > totalSteps) step = totalSteps;
            currentStep = step;
            updateWizard();
        }






function nextStep() {

    if (!validateCurrentStep()) {
        return;
    }

    // STEP-1 Duplicate Check
    if(currentStep == 1){

        let formData = new FormData();

        formData.append("check_duplicate",1);
        formData.append("mobile",document.querySelector("[name='mobile']").value);
        formData.append("gst_no",document.querySelector("[name='gst_no']").value);
formData.append("email",document.querySelector("[name='email']").value);


fetch(window.location.href,{
    method:"POST",
    body:formData
})
.then(response => response.text())
.then(data => {

    console.log(data);   

    data = JSON.parse(data);

    if(data.status == "error"){

    Swal.fire({
        icon: "error",
        title: "Duplicate Record",
        text: data.message,
        confirmButtonColor: "#32bdea",
        confirmButtonText: "OK",
        allowOutsideClick: false
    });

    return;
}

    goToStep(currentStep+1);

});

        return;
    }














    // Other Steps
    if (currentStep < totalSteps) {
        goToStep(currentStep + 1);
    } else {
        document.getElementById('wizardForm').submit();
    }
}





        function prevStep() {
            if (currentStep > 1) {
                goToStep(currentStep - 1);
            }
        }

        // -------- DISABLE STEP CIRCLE CLICKS --------
        stepItems.forEach((item) => {
            item.style.cursor = 'default';
            const link = item.querySelector('.nav-link');
            if (link) {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    return false;
                });
            }
        });

        // -------- BUTTON EVENTS --------
        nextBtn.addEventListener('click', nextStep);
        prevBtn.addEventListener('click', prevStep);

        // -------- KEYBOARD NAVIGATION --------
        document.addEventListener('keydown', function(e) {
            const tag = e.target.tagName.toLowerCase();
            if (tag === 'input' || tag === 'textarea' || tag === 'select') return;

            if (e.key === 'ArrowRight' || e.key === 'ArrowDown') {
                e.preventDefault();
                nextStep();
            } else if (e.key === 'ArrowLeft' || e.key === 'ArrowUp') {
                e.preventDefault();
                prevStep();
            }
        });

        // -------- ENTER KEY ON FORM FIELDS --------
        document.querySelectorAll('input, select, textarea').forEach(function(field) {
            field.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    if (currentStep === totalSteps) {
                        if (validateCurrentStep()) {
                            document.getElementById('wizardForm').submit();
                        }
                    } else {
                        nextStep();
                    }
                }
            });
        });

        // -------- REAL-TIME VALIDATION ON BLUR --------
        document.querySelectorAll('input, select, textarea').forEach(function(field) {
            field.addEventListener('blur', function() {
                // Only validate if the field is in the current visible section
                const section = this.closest('.wizard-section');
                if (section && section.classList.contains('active')) {
                    if (this.value && !validateField(this)) {
                        this.classList.add('is-invalid');
                    } else {
                        this.classList.remove('is-invalid');
                    }
                }
            });
            // Remove invalid class on focus to allow correction
            field.addEventListener('focus', function() {
                this.classList.remove('is-invalid');
            });
        });

        // -------- PASSWORD TOGGLE --------
        const togglePassword = document.getElementById('togglePassword');
        const passwordField = document.getElementById('password');
        if (togglePassword && passwordField) {
            togglePassword.addEventListener('click', function() {
                const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordField.setAttribute('type', type);
                this.classList.toggle('ri-eye-line');
                this.classList.toggle('ri-eye-off-line');
            });
        }

        const toggleConfirm = document.getElementById('toggleConfirmPassword');
        const confirmField = document.getElementById('confirm_password');
        if (toggleConfirm && confirmField) {
            toggleConfirm.addEventListener('click', function() {
                const type = confirmField.getAttribute('type') === 'password' ? 'text' : 'password';
                confirmField.setAttribute('type', type);
                this.classList.toggle('ri-eye-line');
                this.classList.toggle('ri-eye-off-line');
            });
        }

        // -------- PASSWORD MATCH CHECK --------
        const password = document.getElementById("password");
        const confirmPassword = document.getElementById("confirm_password");
        const message = document.getElementById("password_message");

        function checkPassword() {
            if (confirmPassword.value === "") {
                message.innerHTML = "";
                message.style.color = "";
                return;
            }

            if (password.value === confirmPassword.value) {
                message.innerHTML = "✓ Password Matched";
                message.style.color = "green";
                confirmPassword.classList.remove('is-invalid');
            } else {
                message.innerHTML = "✗ Password Not Matched";
                message.style.color = "red";
                confirmPassword.classList.add('is-invalid');
            }
        }

        if (password && confirmPassword) {
            password.addEventListener("keyup", checkPassword);
            confirmPassword.addEventListener("keyup", checkPassword);
        }

        // -------- GST UPPERCASE --------
        const gstInput = document.querySelector('[name="gst_no"]');
        if (gstInput) {
            gstInput.addEventListener('input', function() {
                this.value = this.value.toUpperCase();
            });
        }

        // -------- INITIALIZE --------
        updateWizard();
    });
    </script>


 <style>
        /* ===== Wizard Styles (same as User Registration Wizard) ===== */
        .wizard-steps-wrapper {
            margin-bottom: 30px;
            position: relative;
        }
        .wizard-nav {
            display: flex;
            justify-content: space-between;
            padding: 0;
            margin: 0 0 10px 0;
            list-style: none;
            position: relative;
        }
        .wizard-nav .step-item {
            flex: 1;
            text-align: center;
            position: relative;
            cursor: default;
        }
        .wizard-nav .step-item .nav-link {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 8px 0;
            background: transparent !important;
            border: none !important;
            color: #9aa5b5;
            transition: all 0.3s ease;
            position: relative;
            cursor: default;
            pointer-events: none;
        }
        .wizard-nav .step-item .step-circle {
            width: 40px;
            height: 40px;
            line-height: 40px;
            border-radius: 50%;
            background: #e9ecef;
            color: #6c757d;
            font-weight: 700;
            font-size: 16px;
            display: inline-block;
            margin-bottom: 6px;
            transition: all 0.3s ease;
            border: 3px solid transparent;
        }
        .wizard-nav .step-item .step-label {
            font-size: 13px;
            font-weight: 600;
            color: #6c757d;
            transition: all 0.3s ease;
        }
        .wizard-nav .step-item.active .step-circle {
            background: #32bdea;
            color: #fff;
            border-color: #32bdea;
            box-shadow: 0 0 0 4px rgba(50, 189, 234, 0.25);
        }
        .wizard-nav .step-item.active .step-label {
            color: #32bdea;
        }
        .wizard-nav .step-item.completed .step-circle {
            background: #78c091;
            color: #fff;
            border-color: #78c091;
        }
        .wizard-nav .step-item.completed .step-label {
            color: #78c091;
        }
        .wizard-nav .step-item:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 20px;
            left: calc(50% + 25px);
            right: calc(-50% + 25px);
            height: 3px;
            background: #e9ecef;
            z-index: 0;
        }
        .wizard-nav .step-item.completed:not(:last-child)::after {
            background: #78c091;
        }
        .wizard-nav .step-item.active:not(:last-child)::after {
            background: #e9ecef;
        }

        .wizard-progress {
            height: 6px;
            background: #e9ecef;
            border-radius: 4px;
            margin: 10px 0 0 0;
            overflow: hidden;
            position: relative;
        }
        .wizard-progress .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #32bdea, #158df7);
            border-radius: 4px;
            transition: width 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            width: 20%;
        }

        .wizard-section {
            display: none;
            animation: fadeSlide 0.4s ease forwards;
        }
        .wizard-section.active {
            display: block;
        }
        @keyframes fadeSlide {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        .wizard-navigation {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #dcdfe8;
        }
        .wizard-navigation .btn {
            min-width: 120px;
            padding: 10px 25px;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .wizard-navigation .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
        .wizard-navigation .btn-primary {
            background: linear-gradient(135deg, #32bdea, #158df7);
            border: none;
            color: #fff;
        }
        .wizard-navigation .btn-primary:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(50, 189, 234, 0.35);
        }
        .wizard-navigation .btn-success {
            background: linear-gradient(135deg, #78c091, #55b075);
            border: none;
            color: #fff;
        }
        .wizard-navigation .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(120, 192, 145, 0.35);
        }

        /* Validation error styling */
        .wizard-section .form-control.is-invalid {
            border-color: #e08db4;
        }
        .wizard-section .invalid-feedback {
            display: none;
            font-size: 80%;
            color: #e08db4;
        }
        .wizard-section .form-control.is-invalid ~ .invalid-feedback {
            display: block;
        }

        /* Password toggle icon */
        .password-toggle {
            position: relative;
        }
        .password-toggle .toggle-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
            z-index: 10;
        }
        .password-toggle .toggle-icon:hover {
            color: #32bdea;
        }

        @media (max-width: 768px) {
            .wizard-nav .step-item .step-label {
                font-size: 11px;
            }
            .wizard-nav .step-item .step-circle {
                width: 32px;
                height: 32px;
                line-height: 32px;
                font-size: 13px;
            }
            .wizard-nav .step-item:not(:last-child)::after {
                top: 16px;
                left: calc(50% + 18px);
                right: calc(-50% + 18px);
            }
            .wizard-navigation {
                flex-direction: column;
                gap: 10px;
            }
            .wizard-navigation .btn {
                width: 100%;
                min-width: unset;
            }
        }
        @media (max-width: 480px) {
            .wizard-nav .step-item .step-label {
                font-size: 9px;
            }
            .wizard-nav .step-item .step-circle {
                width: 26px;
                height: 26px;
                line-height: 26px;
                font-size: 11px;
                margin-bottom: 3px;
            }
            .wizard-nav .step-item:not(:last-child)::after {
                top: 13px;
                left: calc(50% + 14px);
                right: calc(-50% + 14px);
            }
        }
    </style>

</body>
</html>