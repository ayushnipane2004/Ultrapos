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
</head>

<body class="  ">
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>
    <!-- loader END -->
    <?php
    include 'db.php';

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
        

        if($password != $confirm_password)
        {
            echo "<script>
            alert('Password does not match');
            window.history.back();
            </script>";
            exit;
        }

        $check = mysqli_query($conn,"SELECT * FROM company_master WHERE email='$email'");

        if(mysqli_num_rows($check)>0)
        {
            echo "<script>
            alert('Company Email Already Exists');
            window.history.back();
            </script>";
            exit;
        }

        $checkUser = mysqli_query($conn,"SELECT * FROM users WHERE username='$username'");

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
        INSERT INTO company_master
        (
            company_name,
            company_logo,
            mobile,
            email,
            gst_no,
            city,
            state,
            country,
            address,
            currency,
            financial_year,
            status,
            businesstype,
            ownername,
            contactpersonname,
            contactmob,
            alternatemob,
            contactpersonemail,
            website,
            username,
            company_ownerimg
        )
        VALUES
        (
            '$company_name',
            '$logo',
            '$mobile',
            '$email',
            '$gst_no',
            '$city',
            '$state',
            '$country',
            '$address',
            '$currency',
            '$financial_year',
            '$status',
            '$businesstype',
            '$ownername',
            '$contactpersonname',
            '$contactmobno',
            '$alternatemob',
            '$contactpersonemail',
            '$website',
            '$username',
            '$ownerimg'
        )");

        if($company) {
        
    $company_id = mysqli_insert_id($conn);
            $hash_password = password_hash($password,PASSWORD_DEFAULT);
           mysqli_query($conn,"
                INSERT INTO users
                (
                full_name,
                mobile,
                alternate_mobile,
                email,
                username,
                profile_photo,
                gender,
                date_of_birth,
                address,
                city,
                state,
                country,
                pincode,
                company_id,
                role_id,
                password,
                status
                )
                VALUES
                (
                '$ownername',
                '$contactmobno',
                '$alternatemob',
                '$email',
                '$username',
                '$ownerimg',
                '$gender',
                '$date_of_birth',
                '$address',
                '$city',
                '$state',
                '$country',
                '$pincode',
                '$company_id',
                1,
                '$hash_password',
                'Active'
                )");
            echo "<script>
            alert('Company Registered Successfully');
            window.location='super-dashboard.php';
            </script>";
        }
        else
        {
            echo "<script>
            alert('Registration Failed');
            </script>";
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
                        <h4 class="card-title">Add Company</h4>
                    </div>
                </div>
            </div>

            <div class="card">
                <form method="post" enctype="multipart/form-data" id="wizardForm">

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
                                                <input type="text" class="form-control" name="company_name" placeholder="Enter Company Name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>GST Number <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="gst_no" placeholder="Enter GST Number" pattern="^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email <span class="text-danger">*</span></label>
                                                <input type="email" class="form-control" name="email" placeholder="Enter Email" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Mobile Number <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="mobile" placeholder="Enter Mobile Number" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Business Type</label>
                                                <input type="text" class="form-control" name="businesstype" placeholder="Enter Business Type">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Website</label>
                                                <input type="text" class="form-control" name="website" placeholder="https://example.com">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Status *</label>
                                                <select class="form-control" name="status">
                                                    <option value="Active">Active</option>
                                                    <option value="Inactive">Inactive</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Company Logo</label>
                                                <input type="file" class="form-control" name="company_logo" accept=".jpg,.jpeg,.png">
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
                                                <textarea class="form-control" rows="3" name="address" placeholder="Enter Full Address" required></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>City <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="city" placeholder="Enter City" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>State <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="state" placeholder="Enter State" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Country <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="country" placeholder="Enter Country" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Pincode <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="pincode" placeholder="Enter Pincode" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Currency</label>
                                                <select class="form-control" name="currency">
                                                    <option value="INR">INR</option>
                                                    <option value="USD">USD</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Financial Year</label>
                                                <input type="text" class="form-control" name="financial_year" placeholder="2026-2027">
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
                                                <input type="text" class="form-control" name="ownername" placeholder="Enter Owner Name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Contact Person Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="contactpersonname" placeholder="Enter Contact Person Name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Mobile Number <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="contactmob" placeholder="Enter Mobile Number" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Alternate Mobile</label>
                                                <input type="text" class="form-control" name="alternatemob" placeholder="Enter Alternate Mobile">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Contact Email</label>
                                                <input type="email" class="form-control" name="contactpersonemail" placeholder="Enter Contact Email">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Gender</label>
                                                <select class="form-control" name="gender">
                                                    <option value="">Select Gender</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Date of Birth</label>
                                                <input type="date" class="form-control" name="date_of_birth">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Owner Image</label>
                                                <input type="file" class="form-control" name="company_ownerimg" accept=".jpg,.jpeg,.png">
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
                                                <input type="text" class="form-control" name="username" placeholder="Enter Username" required>
                                            </div>
                                        </div>



                                     <div class="col-md-4">
    <div class="form-group">
        <label>Password <span class="text-danger">*</span></label>
        <input type="password"
               class="form-control"
               id="password"
               name="password"
               placeholder="Enter Password"
               required>
    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label>Confirm Password <span class="text-danger">*</span></label>
        <input type="password"
               class="form-control"
               id="confirm_password"
               name="confirm_password"
               placeholder="Confirm Password"
               required>

        <small id="password_message" class="font-weight-bold"></small>
    </div>
</div>


                                    </div>
                                </div>
                            </div>

                            <!-- Submit Buttons (inside final step) -->
                            <div class="card mt-3">
                                <div class="card-body text-center">
                                    <button type="submit" name="register" class="btn btn-primary mr-2">
                                        <i class="ri-save-line"></i> Add Company
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

    <!-- ===== WIZARD JAVASCRIPT (fixed version with validation) ===== -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const sections = document.querySelectorAll('.wizard-section');
        const stepItems = document.querySelectorAll('.step-item');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const progressBar = document.getElementById('wizardProgressBar');
        let currentStep = 1;
        const totalSteps = sections.length;

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
                nextBtn.textContent = 'Submit';
                nextBtn.classList.add('btn-success');
                nextBtn.classList.remove('btn-primary');
            } else {
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

        // -------- VALIDATE CURRENT STEP --------
        function validateCurrentStep() {
            const currentSection = document.querySelector('.wizard-section.active');
            if (!currentSection) return true;

            const requiredFields = currentSection.querySelectorAll('[required]');
            let isValid = true;

            for (let field of requiredFields) {
                if (field.offsetParent === null) continue;
                if (!field.checkValidity()) {
                    field.reportValidity();
                    field.focus();
                    isValid = false;
                    break;
                }
            }
            return isValid;
        }

        function nextStep() {
            if (!validateCurrentStep()) {
                return;
            }

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

        updateWizard();
    });
    </script>


        <script>

            const password = document.getElementById("password");
const confirmPassword = document.getElementById("confirm_password");
const message = document.getElementById("password_message");

function checkPassword() {

    if (confirmPassword.value === "") {
        message.innerHTML = "";
        return;
    }

    if (password.value === confirmPassword.value) {

        message.innerHTML = "✓ Password Matched";
        message.style.color = "green";
        confirmPassword.style.borderColor = "green";

    } else {

        message.innerHTML = "✗ Password Not Matched";
        message.style.color = "red";
        confirmPassword.style.borderColor = "red";

    }
}

password.addEventListener("keyup", checkPassword);
confirmPassword.addEventListener("keyup", checkPassword);




        </script>

</body>
</html>