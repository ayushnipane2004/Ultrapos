
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>UltraPOS</title>
    
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

    <?php include 'header.php' ?>


<?php
$id = $_GET['id'];

$edit = mysqli_query($conn,"
SELECT *
FROM branch_master
WHERE id='$id'
AND company_id='$company_id'
");

$row = mysqli_fetch_assoc($edit);


?>



    <?php
    $role = mysqli_query($conn,"
    SELECT id, role_name
    FROM role
    WHERE company_id='$company_id'
    AND delete_flag='1' and role_name != 'owner'
    ORDER BY role_name
    ");

    if(!$role)
    {
        die(mysqli_error($conn));
    }

    if(isset($_POST['update_branch']))
    {
        $branch_name            = mysqli_real_escape_string($conn,$_POST['branch_name']);
        $branch_code            = mysqli_real_escape_string($conn,$_POST['branch_code']);
        $branch_type            = mysqli_real_escape_string($conn,$_POST['branch_type']);
        $business_type            = mysqli_real_escape_string($conn,$_POST['business_type']);


        $gst_no                 = mysqli_real_escape_string($conn,$_POST['gst_no']);
        $branch_email           = mysqli_real_escape_string($conn,$_POST['branch_email']);
        $branch_mobile          = mysqli_real_escape_string($conn,$_POST['branch_mobile']);
        $address                = mysqli_real_escape_string($conn,$_POST['address']);
        $area                   = mysqli_real_escape_string($conn,$_POST['area']);
        $city                   = mysqli_real_escape_string($conn,$_POST['city']);
        $district               = mysqli_real_escape_string($conn,$_POST['district']);
        $state                  = mysqli_real_escape_string($conn,$_POST['state']);
        $country                = mysqli_real_escape_string($conn,$_POST['country']);
        $pincode                = mysqli_real_escape_string($conn,$_POST['pincode']);
        $contact_person_name    = mysqli_real_escape_string($conn,$_POST['contact_person_name']);
        $contact_person_email   = mysqli_real_escape_string($conn,$_POST['contact_person_email']);
        $contact_person_mobile  = mysqli_real_escape_string($conn,$_POST['contact_person_mobile']);
        $role_id                = mysqli_real_escape_string($conn,$_POST['role_id']);
        $opening_date           = mysqli_real_escape_string($conn,$_POST['opening_date']);


        $currency = mysqli_real_escape_string($conn,$_POST['currency']);
$financial_year = mysqli_real_escape_string($conn,$_POST['financial_year']);


        $timezone               = mysqli_real_escape_string($conn,$_POST['timezone']);

        $description            = mysqli_real_escape_string($conn,$_POST['description']);
        $status                 = mysqli_real_escape_string($conn,$_POST['status']);

        $check = mysqli_query($conn,"
        SELECT id
        FROM branch_master
       WHERE company_id='$company_id'
AND branch_email='$branch_email'
AND id!='$id'
AND delete_flag='1'
        ");

        if(mysqli_num_rows($check)>0)
        {
                          echo "
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>

<script>
Swal.fire({
    icon: 'success',
    title: 'Success!',
    text: 'Email already exists',
    confirmButtonColor: '#32bdea',
    confirmButtonText: 'OK'
}).then((result) => {
    if(result.isConfirmed){
        window.location='page-list-branch.php';
    }
});
</script>
";
        }
        else
        {
            mysqli_query($conn,"
            UPDATE branch_master
SET
branch_name='$branch_name',
branch_code='$branch_code',
branch_type='$branch_type',
business_type='$business_type',
gst_no='$gst_no',
branch_email='$branch_email',
branch_mobile='$branch_mobile',
address='$address',
area='$area',
city='$city',
district='$district',
state='$state',
country='$country',
pincode='$pincode',
currency='$currency',
financial_year='$financial_year',
contact_person_name='$contact_person_name',
contact_person_email='$contact_person_email',
contact_person_mobile='$contact_person_mobile',
role_id='$role_id',
opening_date='$opening_date',
description='$description',
status='$status',
modified_by='$modified_by'
WHERE id='$id'
AND company_id='$company_id'
            ");

              echo "
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>

<script>
Swal.fire({
    icon: 'success',
    title: 'Success!',
    text: 'Branch update Successfully',
    confirmButtonColor: '#32bdea',
    confirmButtonText: 'OK'
}).then((result) => {
    if(result.isConfirmed){
        window.location='page-list-branch.php';
    }
});
</script>
";
        }
    }
    ?>

    <div class="wrapper">
        <div class="content-page">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                     
                         <div class="header-title">
                          <a href="page-list-branch.php"
class="btn btn-secondary mr-2">

<i class="ri-arrow-left-line"></i>

Back

</a>
                        </div>

   <div class="header-title">
                            <h4 class="card-title">Update Branch</h4>
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
                                        <span class="step-label">Branch Info</span>
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
                                        <span class="step-label">Contact</span>
                                    </a>
                                </li>
                                <li class="nav-item step-item" data-step="4">
                                    <a class="nav-link" href="#">
                                        <span class="step-circle">4</span>
                                        <span class="step-label">Other</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="wizard-progress">
                                <div class="progress-bar" id="wizardProgressBar" style="width: 20%;"></div>
                            </div>
                        </div>

                        <!-- ===== WIZARD SECTIONS ===== -->
                        <div class="wizard-sections">

                            <!-- STEP 1: Branch Information -->
                            <div class="wizard-section active" data-step="1">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Branch Information</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Branch Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="branch_name" 
                                                           placeholder="Enter Branch Name" 
                                                           pattern="[A-Za-z0-9\s]{2,100}" 
                                                           title="2-100 characters, letters, numbers, spaces"
                                                           value="<?php echo isset($_POST['branch_name']) ? htmlspecialchars($_POST['branch_name']) : htmlspecialchars($row['branch_name']); ?>" required>
                                                    <div class="invalid-feedback">Branch name is required (2-100 chars, letters, numbers, spaces).</div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Branch Code <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="branch_code" 
                                                           placeholder="Branch Code" 
                                                           pattern="[A-Za-z0-9]{1,20}" 
                                                           title="Letters and numbers only, max 20 characters"
                                                           value="<?php echo isset($_POST['branch_code']) ? htmlspecialchars($_POST['branch_code']) : htmlspecialchars($row['branch_code']); ?>" required>
                                                    <div class="invalid-feedback">Branch code must contain only letters and numbers.</div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>GST Number <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="gst_no" 
                                                           placeholder="Enter GST Number" 
                                                           pattern="^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$"
                                                           title="Enter valid Indian GST number"
                                                           value="<?php echo isset($_POST['gst_no']) ? htmlspecialchars($_POST['gst_no']) : htmlspecialchars($row['gst_no']); ?>" required>
                                                    <div class="invalid-feedback">Please enter a valid Indian GST number.</div>
                                                </div>
                                            </div>



<div class="col-md-6">
    <div class="form-group">
        <label>Branch Type <span class="text-danger">*</span></label>

        <select name="branch_type" class="form-control" required>

            <option value="">Select Branch Type</option>

            <option value="head office"
                <?php
                if(
                    (isset($_POST['branch_type']) && $_POST['branch_type'] == 'head office')
                    ||
                    (!isset($_POST['branch_type']) && $row['branch_type'] == 'head office')
                ){
                    echo "selected";
                }
                ?>>
                Head Office
            </option>

            <option value="branch"
                <?php
                if(
                    (isset($_POST['branch_type']) && $_POST['branch_type'] == 'branch')
                    ||
                    (!isset($_POST['branch_type']) && $row['branch_type'] == 'branch')
                ){
                    echo "selected";
                }
                ?>>
                Branch
            </option>

        </select>

        <div class="invalid-feedback">
            Please select branch type.
        </div>
    </div>
</div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Branch Email <span class="text-danger">*</span></label>
                                                    <input type="email" class="form-control" name="branch_email" 
                                                           placeholder="Enter Email" 
                                                           value="<?php echo isset($_POST['branch_email']) ? htmlspecialchars($_POST['branch_email']) : htmlspecialchars($row['branch_email']); ?>" required>
                                                    <div class="invalid-feedback">Please enter a valid email address.</div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Branch Mobile <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="branch_mobile" 
                                                           placeholder="Enter Mobile Number" 
                                                           pattern="[0-9]{10}" maxlength="10"
                                                           title="Exactly 10 digits"
                                                           value="<?php echo isset($_POST['branch_mobile']) ? htmlspecialchars($_POST['branch_mobile']) : htmlspecialchars($row['branch_mobile']); ?>" required>
                                                    <div class="invalid-feedback">Mobile number must be exactly 10 digits.</div>
                                                </div>
                                            </div>




                                           

                                <div class="col-md-6">
    <div class="form-group">
        <label>Business Type <span class="text-danger">*</span></label>

        <select class="form-control" name="business_type" required>

            <option value="">Select Business Type</option>

       <option value="Retail Store"
<?php if((isset($_POST['business_type']) && $_POST['business_type']=="Retail Store") || (!isset($_POST['business_type']) && $row['business_type']=="Retail Store")) echo "selected"; ?>>
Retail Store
</option>

<option value="Wholesale"
<?php if((isset($_POST['business_type']) && $_POST['business_type']=="Wholesale") || (!isset($_POST['business_type']) && $row['business_type']=="Wholesale")) echo "selected"; ?>>
Wholesale
</option>

<option value="Supermarket"
<?php if((isset($_POST['business_type']) && $_POST['business_type']=="Supermarket") || (!isset($_POST['business_type']) && $row['business_type']=="Supermarket")) echo "selected"; ?>>
Supermarket
</option>

<option value="Restaurant"
<?php if((isset($_POST['business_type']) && $_POST['business_type']=="Restaurant") || (!isset($_POST['business_type']) && $row['business_type']=="Restaurant")) echo "selected"; ?>>
Restaurant
</option>

<option value="Cafe"
<?php if((isset($_POST['business_type']) && $_POST['business_type']=="Cafe") || (!isset($_POST['business_type']) && $row['business_type']=="Cafe")) echo "selected"; ?>>
Cafe
</option>

<option value="Medical Store"
<?php if((isset($_POST['business_type']) && $_POST['business_type']=="Medical Store") || (!isset($_POST['business_type']) && $row['business_type']=="Medical Store")) echo "selected"; ?>>
Medical Store
</option>

<option value="Electronics"
<?php if((isset($_POST['business_type']) && $_POST['business_type']=="Electronics") || (!isset($_POST['business_type']) && $row['business_type']=="Electronics")) echo "selected"; ?>>
Electronics
</option>

<option value="Clothing & Fashion"
<?php if((isset($_POST['business_type']) && $_POST['business_type']=="Clothing & Fashion") || (!isset($_POST['business_type']) && $row['business_type']=="Clothing & Fashion")) echo "selected"; ?>>
Clothing & Fashion
</option>

<option value="Hardware"
<?php if((isset($_POST['business_type']) && $_POST['business_type']=="Hardware") || (!isset($_POST['business_type']) && $row['business_type']=="Hardware")) echo "selected"; ?>>
Hardware
</option>

<option value="Distributor"
<?php if((isset($_POST['business_type']) && $_POST['business_type']=="Distributor") || (!isset($_POST['business_type']) && $row['business_type']=="Distributor")) echo "selected"; ?>>
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
                                                    <label>Status <span class="text-danger">*</span></label>
                                                    <select class="form-control" name="status" required>
                                                       <option value="Active"
<?php if((isset($_POST['status']) && $_POST['status']=="Active") || (!isset($_POST['status']) && $row['status']=="Active")) echo "selected"; ?>>
Active
</option>

<option value="Inactive"
<?php if((isset($_POST['status']) && $_POST['status']=="Inactive") || (!isset($_POST['status']) && $row['status']=="Inactive")) echo "selected"; ?>>
Inactive
</option>  </select>
                                                    <div class="invalid-feedback">Please select status.</div>
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
                                                    <textarea class="form-control" rows="3" name="address" 
                                                              placeholder="Enter Full Address" 
                                                              maxlength="255" required><?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : htmlspecialchars($row['address']); ?></textarea>
                                                    <div class="invalid-feedback">Address is required (max 255 characters).</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>City <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="city" 
                                                           placeholder="Enter City"
                                                           pattern="[A-Za-z\s]+" title="Only alphabets and spaces allowed"
                                                           value="<?php echo isset($_POST['city']) ? htmlspecialchars($_POST['city']) : htmlspecialchars($row['city']); ?>" required>
                                                    <div class="invalid-feedback">City must contain only alphabets and spaces.</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>District <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="district" 
                                                           placeholder="Enter District"
                                                           pattern="[A-Za-z\s]+" title="Only alphabets and spaces allowed"
                                                           value="<?php echo isset($_POST['district']) ? htmlspecialchars($_POST['district']) : htmlspecialchars($row['district']); ?>" required>
                                                    <div class="invalid-feedback">District must contain only alphabets and spaces.</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>State <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="state" 
                                                           placeholder="Enter State"
                                                           pattern="[A-Za-z\s]+" title="Only alphabets and spaces allowed"
                                                           value="<?php echo isset($_POST['state']) ? htmlspecialchars($_POST['state']) : htmlspecialchars($row['state']); ?>" required>
                                                    <div class="invalid-feedback">State must contain only alphabets and spaces.</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Country <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="country" 
                                                           placeholder="Enter Country"
                                                           pattern="[A-Za-z\s]+" title="Only alphabets and spaces allowed"
                                                           value="<?php echo isset($_POST['country']) ? htmlspecialchars($_POST['country']) : htmlspecialchars($row['country']); ?>" required>
                                                    <div class="invalid-feedback">Country must contain only alphabets and spaces.</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Area <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="area" 
                                                           placeholder="Enter Area"
                                                           pattern="[A-Za-z0-9\s]+" title="Letters, numbers and spaces allowed"
                                                           value="<?php echo isset($_POST['area']) ? htmlspecialchars($_POST['area']) : htmlspecialchars($row['area']); ?>" required>
                                                    <div class="invalid-feedback">Area must contain only letters, numbers and spaces.</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Pincode <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="pincode" 
                                                           placeholder="Enter Pincode"
                                                           pattern="[0-9]{6}" maxlength="6" title="Exactly 6 digits"
                                                           value="<?php echo isset($_POST['pincode']) ? htmlspecialchars($_POST['pincode']) : htmlspecialchars($row['pincode']); ?>" required>
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

                            <!-- STEP 3: Contact Information -->
                            <div class="wizard-section" data-step="3">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Contact Information</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Contact Person Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="contact_person_name" 
                                                           placeholder="Enter Person Name"
                                                           pattern="[A-Za-z\s]+" title="Only alphabets and spaces allowed"
                                                           value="<?php echo isset($_POST['contact_person_name']) ? htmlspecialchars($_POST['contact_person_name']) : htmlspecialchars($row['contact_person_name']); ?>" required>
                                                    <div class="invalid-feedback">Contact person name must contain only alphabets and spaces.</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Contact Person Email <span class="text-danger">*</span></label>
                                                    <input type="email" class="form-control" name="contact_person_email" 
                                                           placeholder="Email"
                                                           value="<?php echo isset($_POST['contact_person_email']) ? htmlspecialchars($_POST['contact_person_email']) : htmlspecialchars($row['contact_person_email']); ?>" required>
                                                    <div class="invalid-feedback">Please enter a valid email address.</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Contact Person Phone <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="contact_person_mobile" 
                                                           placeholder="Enter Phone"
                                                           pattern="[0-9]{10}" maxlength="10" title="Exactly 10 digits"
                                                           value="<?php echo isset($_POST['contact_person_mobile']) ? htmlspecialchars($_POST['contact_person_mobile']) : htmlspecialchars($row['contact_person_mobile']); ?>" required>
                                                    <div class="invalid-feedback">Phone number must be exactly 10 digits.</div>
                                                </div>
                                            </div>


<div class="col-md-6">
    <div class="form-group">
        <label>Role <span class="text-danger">*</span></label>

        <select class="form-control" name="role_id" required>

            <option value="">Select Role</option>

            <?php
            mysqli_data_seek($role, 0);

            while($roleRow = mysqli_fetch_assoc($role))
            {
            ?>

            <option value="<?php echo $roleRow['id']; ?>"
            <?php
            if(
                (isset($_POST['role_id']) && $_POST['role_id'] == $roleRow['id'])
                ||
                (!isset($_POST['role_id']) && $row['role_id'] == $roleRow['id'])
            )
            {
                echo "selected";
            }
            ?>>

                <?php echo $roleRow['role_name']; ?>

            </option>

            <?php
            }
            ?>

        </select>

        <div class="invalid-feedback">
            Please select a role.
        </div>

    </div>
</div>





                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- STEP 4: Other Information + Submit -->
                            <div class="wizard-section" data-step="4">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Other Information</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">


                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Opening Date</label>
                                                    <input type="date" class="form-control" name="opening_date" 
                                                           max="<?php echo date('Y-m-d'); ?>"
                                                           value="<?php echo isset($_POST['opening_date']) ? $_POST['opening_date'] : htmlspecialchars($row['opening_date']); ?>">
                                                    <div class="invalid-feedback">Opening date cannot be a future date.</div>
                                                </div>
                                            </div>



                                          <div class="col-md-12">
    <div class="form-group">
        <label>Description</label>

        <textarea class="form-control"
                  rows="3"
                  name="description"
                  placeholder="Description"
                  maxlength="500"
                  required><?php
echo isset($_POST['description'])
    ? htmlspecialchars($_POST['description'])
    : htmlspecialchars($row['description']);
?></textarea>

        <div class="invalid-feedback">
            Description is required (max 500 characters).
        </div>

    </div>
</div>



                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Buttons (inside final step) -->
                                <div class="card mt-3">
                                    <div class="card-body text-center">
                                        <button type="submit" name="update_branch" class="btn btn-primary mr-2">
                                            <i class="ri-save-line"></i> Update Branch
                                        </button>
                                        <button type="reset" class="btn btn-danger">
                                            <i class="ri-refresh-line"></i> Reset
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div><!-- /.wizard-sections -->

                        <!-- ===== WIZARD NAVIGATION ===== -->
                        <div class="wizard-navigation mt-4">
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
            padding:34px;
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

        /* Validation styling */
        .wizard-section .form-control.is-invalid {
            border-color: #e08db4;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='none' stroke='%23e08db4' viewBox='0 0 12 12'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23e08db4' stroke='none'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }
        .wizard-section .form-control.is-valid {
            border-color: #78c091;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8' viewBox='0 0 8 8'%3e%3cpath fill='%2378C091' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }
        .wizard-section .invalid-feedback {
            display: none;
            font-size: 80%;
            color: #e08db4;
        }
        .wizard-section .form-control.is-invalid ~ .invalid-feedback {
            display: block;
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

        // ---- Helper: trim spaces, prevent multiple spaces ----
        function sanitizeInput(field) {
            if (!field) return;
            // Trim leading/trailing spaces
            field.value = field.value.trim();
            // Prevent multiple consecutive spaces
            field.value = field.value.replace(/\s{2,}/g, ' ');
        }

        // ---- Validation per field ----
        function validateField(field) {
            if (field.offsetParent === null) return true;

            // Trim first
            sanitizeInput(field);

            // Required
            if (field.hasAttribute('required') && !field.value.trim()) {
                return false;
            }

            // Pattern
            if (field.getAttribute('pattern')) {
                const pattern = new RegExp(field.getAttribute('pattern'));
                if (field.value && !pattern.test(field.value)) {
                    return false;
                }
            }

            // Min/Max for date
            if (field.type === 'date') {
                const max = field.getAttribute('max');
                if (field.value && max && field.value > max) {
                    return false;
                }
            }

            // Email
            if (field.type === 'email' && field.value) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(field.value)) return false;
            }

            // Mobile: only numbers (already handled by pattern)
            if (field.name === 'branch_mobile' || field.name === 'contact_person_mobile') {
                if (field.value && !/^[0-9]{10}$/.test(field.value)) {
                    return false;
                }
            }

            // Pincode: only numbers (already handled by pattern)
            if (field.name === 'pincode') {
                if (field.value && !/^[0-9]{6}$/.test(field.value)) {
                    return false;
                }
            }

            // GST: uppercase conversion
            if (field.name === 'gst_no') {
                field.value = field.value.toUpperCase();
            }

            // Branch Code: uppercase conversion
            if (field.name === 'branch_code') {
                field.value = field.value.toUpperCase();
            }

            return true;
        }

        function validateCurrentStep() {
            const currentSection = document.querySelector('.wizard-section.active');
            if (!currentSection) return true;

            const fields = currentSection.querySelectorAll('input, select, textarea');
            let isValid = true;
            let firstInvalid = null;

            fields.forEach(f => f.classList.remove('is-invalid', 'is-valid'));

            fields.forEach(function(field) {
                if (field.offsetParent === null) return;
                
                // Skip readonly fields
                if (field.hasAttribute('readonly')) return;

                const isFieldValid = validateField(field);
                if (!isFieldValid) {
                    field.classList.add('is-invalid');
                    isValid = false;
                    if (!firstInvalid) firstInvalid = field;
                } else if (field.value && field.hasAttribute('required')) {
                    field.classList.add('is-valid');
                }
            });

            // Special: Description - no only spaces
            const descField = currentSection.querySelector('[name="description"]');
            if (descField && descField.value && !descField.value.trim()) {
                descField.classList.add('is-invalid');
                isValid = false;
                if (!firstInvalid) firstInvalid = descField;
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
            if (currentStep === totalSteps) {
                // Hide Next button on last step since submit button is inside the step
                nextBtn.style.display = 'none';
            } else {
                nextBtn.style.display = 'inline-block';
                nextBtn.textContent = 'Next';
                nextBtn.classList.remove('btn-success');
                nextBtn.classList.add('btn-primary');
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

            if (currentStep < totalSteps) {
                goToStep(currentStep + 1);
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
                if (currentStep < totalSteps) nextStep();
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

        // -------- REAL-TIME VALIDATION --------
        document.querySelectorAll('input, select, textarea').forEach(function(field) {
            field.addEventListener('blur', function() {
                const section = this.closest('.wizard-section');
                if (section && section.classList.contains('active')) {
                    this.classList.remove('is-invalid', 'is-valid');
                    if (this.value && !validateField(this)) {
                        this.classList.add('is-invalid');
                    } else if (this.value && this.hasAttribute('required')) {
                        this.classList.add('is-valid');
                    }
                }
            });
            field.addEventListener('focus', function() {
                this.classList.remove('is-invalid', 'is-valid');
            });
            // Auto-uppercase for GST and Branch Code
            if (field.name === 'gst_no' || field.name === 'branch_code') {
                field.addEventListener('input', function() {
                    this.value = this.value.toUpperCase();
                });
            }
            // Only allow numbers for mobile and pincode
            if (field.name === 'branch_mobile' || field.name === 'contact_person_mobile' || field.name === 'pincode') {
                field.addEventListener('input', function() {
                    this.value = this.value.replace(/[^0-9]/g, '');
                });
            }
        });

        // -------- INITIALIZE --------
        updateWizard();
    });
    </script>

</body>
</html>