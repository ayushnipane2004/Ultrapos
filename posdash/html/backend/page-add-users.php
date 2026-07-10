
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>User Registration | POS Dash</title>
    <link rel="shortcut icon" href="https://templates.iqonic.design/posdash/html/assets/images/favicon.ico" />
    <link rel="stylesheet" href="../assets/css/backend-plugin.min.css">
    <link rel="stylesheet" href="../assets/css/backende209.css?v=1.0.0">
    <link rel="stylesheet" href="../assets/vendor/%40fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css">
    <link rel="stylesheet" href="../assets/vendor/remixicon/fonts/remixicon.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="  ">
    <div id="loading">
        <div id="loading-center"></div>
    </div>

    <?php include 'header.php'; ?>




<?php
include 'db.php';








$msg = "";
$error = "";

// Fetch dropdown data
$company = mysqli_query($conn, "SELECT id, company_name FROM company_master WHERE delete_flag='1' ORDER BY company_name");
$branch = mysqli_query($conn, "SELECT id, branch_name FROM branch_master WHERE delete_flag='1' ORDER BY branch_name");
$role = mysqli_query($conn, "SELECT id, role_name FROM role WHERE role_name != 'owner' && delete_flag='1' ORDER BY role_name");
$manager = mysqli_query($conn, "SELECT id, full_name FROM users WHERE delete_flag='1' AND status='Active' ORDER BY full_name");

// Handle form submission
if (isset($_POST['register'])) {
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    $alternate_mobile = mysqli_real_escape_string($conn, $_POST['alternate_mobile']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $date_of_birth = mysqli_real_escape_string($conn, $_POST['date_of_birth']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $pincode = mysqli_real_escape_string($conn, $_POST['pincode']);
    $branch_id = mysqli_real_escape_string($conn, $_POST['branch_id']);
    $warehouse_id = mysqli_real_escape_string($conn, $_POST['warehouse_id']);
    $department_id = mysqli_real_escape_string($conn, $_POST['department_id']);
    $designation_id = mysqli_real_escape_string($conn, $_POST['designation_id']);
    $role_id = mysqli_real_escape_string($conn, $_POST['role_id']);
    $reporting_manager_id = mysqli_real_escape_string($conn, $_POST['reporting_manager_id']);
    $work_shift = mysqli_real_escape_string($conn, $_POST['shift']);
    $employee_id = mysqli_real_escape_string($conn, $_POST['employee_id']);
    $joining_date = mysqli_real_escape_string($conn, $_POST['joining_date']);
    $employment_type = mysqli_real_escape_string($conn, $_POST['employment_type']);
    $employee_status = mysqli_real_escape_string($conn, $_POST['employee_status']);
    $salary = mysqli_real_escape_string($conn, $_POST['salary']);
    $experience = mysqli_real_escape_string($conn, $_POST['experience']);
    $qualification = mysqli_real_escape_string($conn, $_POST['qualification']);
    $work_location = mysqli_real_escape_string($conn, $_POST['work_location']);
    $aadhaar_no = mysqli_real_escape_string($conn, $_POST['aadhaar_no']);
    $pan_no = mysqli_real_escape_string($conn, $_POST['pan_no']);
    $bank_name = mysqli_real_escape_string($conn, $_POST['bank_name']);
    $account_holder_name = mysqli_real_escape_string($conn, $_POST['account_holder_name']);
    $account_number = mysqli_real_escape_string($conn, $_POST['account_number']);
    $ifsc_code = mysqli_real_escape_string($conn, $_POST['ifsc_code']);
    $bank_branch = mysqli_real_escape_string($conn, $_POST['bank_branch']);
    $account_type = mysqli_real_escape_string($conn, $_POST['account_type']);
    $upi_id = mysqli_real_escape_string($conn, $_POST['upi_id']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    // ===== SERVER-SIDE DUPLICATE CHECKS =====
    $duplicate_errors = [];

    // Check Mobile
    $check = mysqli_query($conn, "SELECT id FROM users WHERE mobile='$mobile' AND delete_flag='1'");
    if (mysqli_num_rows($check) > 0) {
        $duplicate_errors[] = "Mobile Number already exists.";
    }

    // Check Email
    $check = mysqli_query($conn, "SELECT id FROM users WHERE email='$email' AND delete_flag='1'");
    if (mysqli_num_rows($check) > 0) {
        $duplicate_errors[] = "Email already exists.";
    }

    // Check Username
    $check = mysqli_query($conn, "SELECT id FROM users WHERE username='$username' AND delete_flag='1'");
    if (mysqli_num_rows($check) > 0) {
        $duplicate_errors[] = "Username already exists.";
    }

    // Check Employee ID
    $check = mysqli_query($conn, "SELECT id FROM users WHERE employee_id='$employee_id' AND delete_flag='1'");
    if (mysqli_num_rows($check) > 0) {
        $duplicate_errors[] = "Employee ID already exists.";
    }

    // Check Aadhaar
    $check = mysqli_query($conn, "SELECT id FROM users WHERE aadhaar_no='$aadhaar_no' AND delete_flag='1'");
    if (mysqli_num_rows($check) > 0) {
        $duplicate_errors[] = "Aadhaar Number already exists.";
    }

    // Check PAN
    $check = mysqli_query($conn, "SELECT id FROM users WHERE pan_no='$pan_no' AND delete_flag='1'");
    if (mysqli_num_rows($check) > 0) {
        $duplicate_errors[] = "PAN Number already exists.";
    }

    if (!empty($duplicate_errors)) {
        $error = implode("<br>", $duplicate_errors);
    }

    // ===== PASSWORD VALIDATION =====
    if (empty($error)) {
        if ($password !== $confirm_password) {
            $error = "Password and Confirm Password do not match.";
        }
    }

    // ===== PASSWORD STRENGTH VALIDATION =====
    if (empty($error)) {
        if (strlen($password) < 8 || strlen($password) > 20) {
            $error = "Password must be between 8 and 20 characters.";
        } elseif (!preg_match("/[A-Z]/", $password)) {
            $error = "Password must contain at least one uppercase letter.";
        } elseif (!preg_match("/[a-z]/", $password)) {
            $error = "Password must contain at least one lowercase letter.";
        } elseif (!preg_match("/[0-9]/", $password)) {
            $error = "Password must contain at least one number.";
        } elseif (!preg_match("/[!@#$%^&*()_+\-=\[\]{};:'\",.<>?\\/]/", $password)) {
            $error = "Password must contain at least one special character.";
        }
    }

    // ===== PAN VALIDATION =====
    if (empty($error)) {
        if (!preg_match("/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/", strtoupper($pan_no))) {
            $error = "Please enter a valid PAN number (e.g., ABCDE1234F).";
        }
    }

    // ===== IFSC VALIDATION =====
    if (empty($error)) {
        if (!preg_match("/^[A-Z]{4}0[A-Z0-9]{6}$/", strtoupper($ifsc_code))) {
            $error = "Please enter a valid IFSC code (e.g., SBIN0001234).";
        }
    }

    // ===== STATUS FIX: Convert to proper case =====
    if ($status == 'active') {
        $status = 'Active';
    } elseif ($status == 'inactive') {
        $status = 'Inactive';
    }

    // ===== FILE VALIDATION =====
    if (empty($error)) {
        // Profile Photo Validation
        if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['name'] != "") {
            $ext = strtolower(pathinfo($_FILES['profile_photo']['name'], PATHINFO_EXTENSION));
            $allow = array("jpg", "jpeg", "png");
            if (!in_array($ext, $allow)) {
                $error = "Profile photo must be JPG, JPEG, or PNG format.";
            } elseif ($_FILES['profile_photo']['size'] > 2 * 1024 * 1024) {
                $error = "Profile photo size must not exceed 2 MB.";
            }
        }

        // Bank Document Validation
        if (empty($error) && isset($_FILES['bank_document']) && $_FILES['bank_document']['name'] != "") {
            $ext = strtolower(pathinfo($_FILES['bank_document']['name'], PATHINFO_EXTENSION));
            $allow = array("jpg", "jpeg", "png", "pdf");
            if (!in_array($ext, $allow)) {
                $error = "Bank document must be JPG, JPEG, PNG, or PDF format.";
            } elseif ($_FILES['bank_document']['size'] > 2 * 1024 * 1024) {
                $error = "Bank document size must not exceed 2 MB.";
            }
        }
    }

    // ===== PROCESS INSERT =====
    if (empty($error)) {
        $hash_password = password_hash($password, PASSWORD_DEFAULT);
        $profile_photo = "";
        $bank_document = "";

        // Handle Profile Photo Upload
        if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['name'] != "") {
            $folder = "../assets/user-photo/";
            if (!is_dir($folder)) {
                mkdir($folder, 0777, true);
            }
            $ext = strtolower(pathinfo($_FILES['profile_photo']['name'], PATHINFO_EXTENSION));
            $photo_name = time() . "_" . rand(1000, 9999) . "." . $ext;
            $destination = $folder . $photo_name;
            if (move_uploaded_file($_FILES['profile_photo']['tmp_name'], $destination)) {
                $profile_photo = $destination;
            }
        }

        // Handle Bank Document Upload
        if (isset($_FILES['bank_document']) && $_FILES['bank_document']['name'] != "") {
            $folder = "../assets/bankimg/";
            if (!is_dir($folder)) {
                mkdir($folder, 0777, true);
            }
            $ext = strtolower(pathinfo($_FILES['bank_document']['name'], PATHINFO_EXTENSION));
            $file_name = time() . "_" . rand(1000, 9999) . "." . $ext;
            $destination = $folder . $file_name;
            if (move_uploaded_file($_FILES['bank_document']['tmp_name'], $destination)) {
                $bank_document = $destination;
            }
        }

        // Insert query (unchanged)
        $insert = mysqli_query($conn, "
            INSERT INTO users (
                full_name, mobile, alternate_mobile, email, username, profile_photo,
                gender, date_of_birth, address, city, state, country, pincode,
                company_id, branch_id, warehouse_id, department_id, designation_id,
                role_id, reporting_manager_id, work_shift,
                employee_id, joining_date, employment_type, employee_status,
                salary, experience, qualification, work_location,
                aadhaar_no, pan_no,
                bank_name, account_holder_name, account_number,
                ifsc_code, bank_branch, account_type, upi_id, bank_document,
                password, status
            ) VALUES (
                '$full_name', '$mobile', '$alternate_mobile', '$email', '$username', '$profile_photo',
                '$gender', '$date_of_birth', '$address', '$city', '$state', '$country', '$pincode',
                '$company_id', '$branch_id', '$warehouse_id', '$department_id', '$designation_id',
                '$role_id', '$reporting_manager_id', '$work_shift',
                '$employee_id', '$joining_date', '$employment_type', '$employee_status',
                '$salary', '$experience', '$qualification', '$work_location',
                '$aadhaar_no', '$pan_no',
                '$bank_name', '$account_holder_name', '$account_number',
                '$ifsc_code', '$bank_branch', '$account_type', '$upi_id', '$bank_document',
                '$hash_password', '$status'
            )
        ");

        if ($insert) {
            echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'User Registered Successfully',
                    confirmButtonColor: '#32bdea',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = 'page-list-users.php';
                    }
                });
            </script>
            ";
            $_POST = array();
        } else {
            $error = mysqli_error($conn);
        }
    }
}
?>













    <div class="wrapper">
        <div class="content-page" style="margin-top:0px">
            <div class="container-fluid add-form-list">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Sign up</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <?php if (!empty($msg)): ?>
                                <div class="alert alert-success alert-dismissible fade show">
                                    <?php echo $msg; ?>
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                </div>
                                <?php endif; ?>
                                <?php if (!empty($error)): ?>
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <?php echo $error; ?>
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                </div>
                                <?php endif; ?>

                                <form method="post" enctype="multipart/form-data" id="wizardForm">
                                    <!-- ===== WIZARD STEPS ===== -->
                                    <div class="wizard-steps-wrapper">
                                        <ul class="nav nav-pills nav-justified wizard-nav" id="wizardNav">
                                            <li class="nav-item step-item active" data-step="1">
                                                <a class="nav-link" href="#">
                                                    <span class="step-circle">1</span>
                                                    <span class="step-label">Personal Info</span>
                                                </a>
                                            </li>
                                            <li class="nav-item step-item" data-step="2">
                                                <a class="nav-link" href="#">
                                                    <span class="step-circle">2</span>
                                                    <span class="step-label">Company</span>
                                                </a>
                                            </li>
                                            <li class="nav-item step-item" data-step="3">
                                                <a class="nav-link" href="#">
                                                    <span class="step-circle">3</span>
                                                    <span class="step-label">Employee</span>
                                                </a>
                                            </li>
                                            <li class="nav-item step-item" data-step="4">
                                                <a class="nav-link" href="#">
                                                    <span class="step-circle">4</span>
                                                    <span class="step-label">Bank</span>
                                                </a>
                                            </li>
                                            <li class="nav-item step-item" data-step="5">
                                                <a class="nav-link" href="#">
                                                    <span class="step-circle">5</span>
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
                                        <!-- STEP 1: Personal Information -->
                                        <div class="wizard-section active" data-step="1">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">Personal Information</h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Full Name <span class="text-danger">*</span></label>
                                                                <input type="text" name="full_name" placeholder="Full Name" class="form-control" 
                                                                       pattern="[A-Za-z\s]+" title="Only alphabets and spaces allowed"
                                                                       value="<?php echo isset($_POST['full_name']) ? htmlspecialchars($_POST['full_name']) : ''; ?>" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Mobile Number <span class="text-danger">*</span></label>
                                                                <input type="text" name="mobile" class="form-control"
                                                                       placeholder="Enter Mobile Number"
                                                                       value="<?php echo isset($_POST['mobile']) ? htmlspecialchars($_POST['mobile']) : ''; ?>"
                                                                       inputmode="numeric" maxlength="10" pattern="[0-9]{10}"
                                                                       oninput="this.value=this.value.replace(/[^0-9]/g,'')" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Alternate Mobile Number</label>
                                                                <input type="text" name="alternate_mobile" class="form-control"
                                                                       placeholder="Enter Alternate Mobile Number"
                                                                       value="<?php echo isset($_POST['alternate_mobile']) ? htmlspecialchars($_POST['alternate_mobile']) : ''; ?>"
                                                                       inputmode="numeric" maxlength="10" pattern="[0-9]{10}"
                                                                       oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Email Address <span class="text-danger">*</span></label>
                                                                <input type="email" name="email" class="form-control" 
                                                                       placeholder="Enter Email Address"
                                                                       autocomplete="off"
                                                                       
                                                                       value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Profile Photo</label>
                                                                <input type="file" id="profile_photo" name="profile_photo"
                                                                       class="form-control" accept=".jpg,.jpeg,.png">
                                                                <small id="photo_error" class="text-danger"></small>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Gender <span class="text-danger">*</span></label>
                                                                <select name="gender" class="form-control" required>
                                                                    <option value="Male" <?php if(isset($_POST['gender']) && $_POST['gender']=="Male") echo "selected"; ?>>Male</option>
                                                                    <option value="Female" <?php if(isset($_POST['gender']) && $_POST['gender']=="Female") echo "selected"; ?>>Female</option>
                                                                    <option value="Other" <?php if(isset($_POST['gender']) && $_POST['gender']=="Other") echo "selected"; ?>>Other</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Date of Birth <span class="text-danger">*</span></label>
                                                                <input type="date" name="date_of_birth" 
                                                                       max="<?php echo date('Y-m-d'); ?>"
                                                                       value="<?php echo isset($_POST['date_of_birth']) ? $_POST['date_of_birth'] : ''; ?>" 
                                                                       class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Address <span class="text-danger">*</span></label>
                                                                <textarea name="address" class="form-control" required><?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : ''; ?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>Country <span class="text-danger">*</span></label>
                                                                <input type="text" name="country" class="form-control" 
                                                                       placeholder="Enter Country" pattern="[A-Za-z\s]+"
                                                                       title="Only alphabets and spaces allowed"
                                                                       value="<?php echo isset($_POST['country']) ? htmlspecialchars($_POST['country']) : ''; ?>" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>State <span class="text-danger">*</span></label>
                                                                <input type="text" name="state" class="form-control" 
                                                                       placeholder="Enter State" pattern="[A-Za-z\s]+"
                                                                       title="Only alphabets and spaces allowed"
                                                                       value="<?php echo isset($_POST['state']) ? htmlspecialchars($_POST['state']) : ''; ?>" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>City <span class="text-danger">*</span></label>
                                                                <input type="text" name="city" class="form-control" 
                                                                       placeholder="Enter City" pattern="[A-Za-z\s]+"
                                                                       title="Only alphabets and spaces allowed"
                                                                       value="<?php echo isset($_POST['city']) ? htmlspecialchars($_POST['city']) : ''; ?>" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>PIN Code <span class="text-danger">*</span></label>
                                                                <input type="text" name="pincode" class="form-control"
                                                                       placeholder="Enter PIN Code"
                                                                       value="<?php echo isset($_POST['pincode']) ? htmlspecialchars($_POST['pincode']) : ''; ?>"
                                                                       inputmode="numeric" maxlength="6" pattern="[0-9]{6}"
                                                                       oninput="this.value=this.value.replace(/[^0-9]/g,'')" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- STEP 2: Company Information -->
                                        <div class="wizard-section" data-step="2">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">Company Information</h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Branch</label>
                                                                <select name="branch_id" class="form-control">
                                                                    <option value="">Select Branch</option>
                                                                    <?php while($row = mysqli_fetch_assoc($branch)) { ?>
                                                                        <option value="<?php echo $row['id']; ?>"
                                                                            <?php if(isset($_POST['branch_id']) && $_POST['branch_id'] == $row['id']) echo "selected"; ?>>
                                                                            <?php echo $row['branch_name']; ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Warehouse</label>
                                                                <select name="warehouse_id" class="form-control">
                                                                    <option value="">Select Warehouse</option>
                                                                    <option value="None" <?php if(isset($_POST['warehouse_id']) && $_POST['warehouse_id']=="0") echo "selected"; ?>>None</option>
                                                                    <option value="Main Warehouse" <?php if(isset($_POST['warehouse_id']) && $_POST['warehouse_id']=="1") echo "selected"; ?>>Main Warehouse</option>
                                                                    <option value="Warehouse 2" <?php if(isset($_POST['warehouse_id']) && $_POST['warehouse_id']=="2") echo "selected"; ?>>Warehouse 2</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Department</label>
                                                                <select name="department_id" class="form-control">
                                                                    <option value="">Select Department</option>
                                                                    <option value="Administration" <?php if(isset($_POST['department_id']) && $_POST['department_id']=="Administration") echo "selected"; ?>>Administration</option>
                                                                    <option value="Accounts" <?php if(isset($_POST['department_id']) && $_POST['department_id']=="Accounts") echo "selected"; ?>>Accounts</option>
                                                                    <option value="Sales" <?php if(isset($_POST['department_id']) && $_POST['department_id']=="Sales") echo "selected"; ?>>Sales</option>
                                                                    <option value="Purchase" <?php if(isset($_POST['department_id']) && $_POST['department_id']=="Purchase") echo "selected"; ?>>Purchase</option>
                                                                    <option value="Inventory" <?php if(isset($_POST['department_id']) && $_POST['department_id']=="Inventory") echo "selected"; ?>>Inventory</option>
                                                                    <option value="HR" <?php if(isset($_POST['department_id']) && $_POST['department_id']=="HR") echo "selected"; ?>>HR</option>
                                                                    <option value="IT" <?php if(isset($_POST['department_id']) && $_POST['department_id']=="IT") echo "selected"; ?>>IT</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Designation</label>
                                                                <select name="designation_id" class="form-control">
                                                                    <option value="">Select Designation</option>
                                                                    <?php while($row = mysqli_fetch_assoc($role)) { ?>
                                                                        <option value="<?php echo $row['id']; ?>" 
                                                                            <?php if(isset($_POST['role_id']) && $_POST['role_id'] == $row['id']) echo "selected"; ?>>
                                                                            <?php echo $row['role_name']; ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <?php mysqli_data_seek($role, 0); ?>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Role</label>
                                                                <select name="role_id" class="form-control">
                                                                    <option value="">Select Role</option>
                                                                    <?php while($row = mysqli_fetch_assoc($role)) { ?>
                                                                        <option value="<?php echo $row['id']; ?>" 
                                                                            <?php if(isset($_POST['role_id']) && $_POST['role_id'] == $row['id']) echo "selected"; ?>>
                                                                            <?php echo $row['role_name']; ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Reporting Manager</label>
                                                                <select name="reporting_manager_id" class="form-control">
                                                                    <option value="">Select Reporting Manager</option>
                                                                    <?php
                                                                    mysqli_data_seek($manager, 0);
                                                                    while($row = mysqli_fetch_assoc($manager)) { ?>
                                                                        <option value="<?php echo $row['id']; ?>"
                                                                            <?php if(isset($_POST['reporting_manager_id']) && $_POST['reporting_manager_id'] == $row['id']) echo "selected"; ?>>
                                                                            <?php echo $row['full_name']; ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Work Shift</label>
                                                                <select name="shift" class="form-control">
                                                                    <option value="">Select Shift</option>
                                                                    <option value="Morning" <?php if(isset($_POST['shift']) && $_POST['shift']=="Morning") echo "selected"; ?>>Morning</option>
                                                                    <option value="General" <?php if(isset($_POST['shift']) && $_POST['shift']=="General") echo "selected"; ?>>General</option>
                                                                    <option value="Evening" <?php if(isset($_POST['shift']) && $_POST['shift']=="Evening") echo "selected"; ?>>Evening</option>
                                                                    <option value="Night" <?php if(isset($_POST['shift']) && $_POST['shift']=="Night") echo "selected"; ?>>Night</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- STEP 3: Employee Information -->
                                        <div class="wizard-section" data-step="3">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">Employee Information</h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Employee ID <span class="text-danger">*</span></label>
                                                                <input type="text" name="employee_id" class="form-control" 
                                                                       placeholder="Enter Employee ID" maxlength="20"
                                                                       value="<?php echo isset($_POST['employee_id']) ? htmlspecialchars($_POST['employee_id']) : ''; ?>" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Joining Date</label>
                                                                <input type="date" name="joining_date" 
                                                                       max="<?php echo date('Y-m-d'); ?>"
                                                                       class="form-control" 
                                                                       value="<?php echo isset($_POST['joining_date']) ? $_POST['joining_date'] : ''; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Employment Type</label>
                                                                <select name="employment_type" class="form-control">
                                                                    <option value="">Select Employment Type</option>
                                                                    <option value="Permanent" <?php if(isset($_POST['employment_type']) && $_POST['employment_type']=="Permanent") echo "selected"; ?>>Permanent</option>
                                                                    <option value="Contract" <?php if(isset($_POST['employment_type']) && $_POST['employment_type']=="Contract") echo "selected"; ?>>Contract</option>
                                                                    <option value="Temporary" <?php if(isset($_POST['employment_type']) && $_POST['employment_type']=="Temporary") echo "selected"; ?>>Temporary</option>
                                                                    <option value="Intern" <?php if(isset($_POST['employment_type']) && $_POST['employment_type']=="Intern") echo "selected"; ?>>Intern</option>
                                                                    <option value="Part Time" <?php if(isset($_POST['employment_type']) && $_POST['employment_type']=="Part Time") echo "selected"; ?>>Part Time</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Employee Status <span class="text-danger">*</span></label>
                                                                <select name="employee_status" class="form-control" required>
                                                                    <option value="Active" <?php if(isset($_POST['employee_status']) && $_POST['employee_status']=="Active") echo "selected"; ?>>Active</option>
                                                                    <option value="Inactive" <?php if(isset($_POST['employee_status']) && $_POST['employee_status']=="Inactive") echo "selected"; ?>>Inactive</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Salary</label>
                                                                <input type="number" name="salary" class="form-control" 
                                                                       placeholder="Enter Salary" min="0"
                                                                       value="<?php echo isset($_POST['salary']) ? htmlspecialchars($_POST['salary']) : ''; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Experience (Years)</label>
                                                                <input type="number" name="experience" class="form-control" 
                                                                       placeholder="Enter Experience" min="0" max="50"
                                                                       value="<?php echo isset($_POST['experience']) ? htmlspecialchars($_POST['experience']) : ''; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Qualification</label>
                                                                <input type="text" name="qualification" class="form-control" 
                                                                       value="<?php echo isset($_POST['qualification']) ? htmlspecialchars($_POST['qualification']) : ''; ?>" 
                                                                       placeholder="Enter Qualification">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Work Location</label>
                                                                <input type="text" name="work_location" class="form-control" 
                                                                       value="<?php echo isset($_POST['work_location']) ? htmlspecialchars($_POST['work_location']) : ''; ?>" 
                                                                       placeholder="Enter Work Location">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Aadhaar Number <span class="text-danger">*</span></label>
                                                                <input type="text" name="aadhaar_no" class="form-control"
                                                                       placeholder="Enter Aadhaar Number"
                                                                       value="<?php echo isset($_POST['aadhaar_no']) ? htmlspecialchars($_POST['aadhaar_no']) : ''; ?>"
                                                                       inputmode="numeric" maxlength="12" pattern="[0-9]{12}"
                                                                       oninput="this.value=this.value.replace(/[^0-9]/g,'')" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>PAN Number <span class="text-danger">*</span></label>
                                                                <input type="text" name="pan_no" class="form-control" 
                                                                       placeholder="Enter PAN Number" maxlength="10"
                                                                       value="<?php echo isset($_POST['pan_no']) ? htmlspecialchars(strtoupper($_POST['pan_no'])) : ''; ?>" 
                                                                       style="text-transform:uppercase;" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- STEP 4: Bank Information -->
                                        <div class="wizard-section" data-step="4">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">Bank Information</h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Bank Name <span class="text-danger">*</span></label>
                                                                <input type="text" name="bank_name" class="form-control"
                                                                       placeholder="Enter Bank Name"
                                                                       value="<?php echo isset($_POST['bank_name']) ? htmlspecialchars($_POST['bank_name']) : ''; ?>"
                                                                       maxlength="100" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Account Holder Name <span class="text-danger">*</span></label>
                                                                <input type="text" name="account_holder_name" class="form-control"
                                                                       placeholder="Enter Account Holder Name"
                                                                       value="<?php echo isset($_POST['account_holder_name']) ? htmlspecialchars($_POST['account_holder_name']) : ''; ?>"
                                                                       maxlength="100" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Account Number <span class="text-danger">*</span></label>
                                                                <input type="text" id="account_number" name="account_number" class="form-control"
                                                                       placeholder="Enter Account Number"
                                                                       value="<?php echo isset($_POST['account_number']) ? htmlspecialchars($_POST['account_number']) : ''; ?>"
                                                                       inputmode="numeric" pattern="[0-9]{9,18}" maxlength="18"
                                                                       oninput="this.value=this.value.replace(/[^0-9]/g,'')" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Confirm Account Number <span class="text-danger">*</span></label>
                                                                <input type="text" id="confirm_account_number" name="confirm_account_number" class="form-control"
                                                                       placeholder="Confirm Account Number"
                                                                       value="<?php echo isset($_POST['confirm_account_number']) ? htmlspecialchars($_POST['confirm_account_number']) : ''; ?>"
                                                                       inputmode="numeric" pattern="[0-9]{9,18}" maxlength="18"
                                                                       oninput="this.value=this.value.replace(/[^0-9]/g,'')" required>
                                                                <small id="account_message"></small>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>IFSC Code <span class="text-danger">*</span></label>
                                                                <input type="text" name="ifsc_code" class="form-control"
                                                                       placeholder="Enter IFSC Code"
                                                                       value="<?php echo isset($_POST['ifsc_code']) ? htmlspecialchars(strtoupper($_POST['ifsc_code'])) : ''; ?>"
                                                                       maxlength="11" style="text-transform:uppercase;"
                                                                       oninput="this.value=this.value.toUpperCase().replace(/[^A-Z0-9]/g,'')"
                                                                       pattern="[A-Z]{4}0[A-Z0-9]{6}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Branch Name <span class="text-danger">*</span></label>
                                                                <input type="text" name="bank_branch" class="form-control"
                                                                       placeholder="Enter Branch Name"
                                                                       value="<?php echo isset($_POST['bank_branch']) ? htmlspecialchars($_POST['bank_branch']) : ''; ?>"
                                                                       maxlength="100" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Account Type</label>
                                                                <select name="account_type" class="form-control">
                                                                    <option value="">Select Account Type</option>
                                                                    <option value="Saving" <?php if(isset($_POST['account_type']) && $_POST['account_type']=="Saving") echo "selected"; ?>>Saving Account</option>
                                                                    <option value="Current" <?php if(isset($_POST['account_type']) && $_POST['account_type']=="Current") echo "selected"; ?>>Current Account</option>
                                                                    <option value="Salary" <?php if(isset($_POST['account_type']) && $_POST['account_type']=="Salary") echo "selected"; ?>>Salary Account</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>UPI ID</label>
                                                                <input type="text" name="upi_id" class="form-control"
                                                                       placeholder="Enter UPI ID"
                                                                       value="<?php echo isset($_POST['upi_id']) ? htmlspecialchars($_POST['upi_id']) : ''; ?>"
                                                                       maxlength="100">
                                                                <small class="text-muted">Example: pratik123@ybl</small>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Upload Passbook / Cancelled Cheque</label>
                                                                <input type="file" id="bank_document" name="bank_document"
                                                                       class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                                                                <small id="file_error" class="text-danger"></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- STEP 5: Login Information -->
                                        <div class="wizard-section" data-step="5">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">Login Information</h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Login Username <span class="text-danger">*</span></label>
                                                                <input type="text" name="username" class="form-control"
                                                                       placeholder="Enter Login Username"
                                                                              autocomplete="off"

                                                                       minlength="4" maxlength="30"
                                                                       pattern="[A-Za-z0-9_]+"
                                                                       title="Username can contain only letters, numbers and underscore."
                                                                       value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" required>
                                                            </div>
                                                        </div>


                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Password <span class="text-danger">*</span></label>
                                                                <div class="input-group">
                                                                    <input type="password" id="password" name="password"
                                                                           autocomplete="new-password"
                                                                                    value="<?php echo isset($_POST['password']) ? htmlspecialchars($_POST['password']) : ''; ?>" 

                                                                           class="form-control" placeholder="Enter Password"
                                                                           minlength="8" maxlength="20" required>
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text" id="togglePassword" style="cursor:pointer;">
                                                                            <i class="fas fa-eye"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <small class="text-muted">Password must be 8-20 characters with uppercase, lowercase, number, and special character.</small>
                                                            </div>
                                                        </div>




                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Confirm Password <span class="text-danger">*</span></label>
                                                                <div class="input-group">
                                                                    <input type="password" id="confirm_password" name="confirm_password"
                                                                           class="form-control" placeholder="Confirm Password"
                                                 value="<?php echo isset($_POST['confirm_password']) ? htmlspecialchars($_POST['confirm_password']) : ''; ?>" 
                                                                           minlength="8" maxlength="20" required>
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text" id="toggleConfirmPassword" style="cursor:pointer;">
                                                                            <i class="fas fa-eye"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <small id="password_message"></small>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Status <span class="text-danger">*</span></label>
                                                                <select name="status" class="form-control" required>
                                                                    <option value="">Select Status</option>
                                                                    <option value="Active" <?php if(isset($_POST['status']) && $_POST['status']=="Active") echo "selected"; ?>>Active</option>
                                                                    <option value="Inactive" <?php if(isset($_POST['status']) && $_POST['status']=="Inactive") echo "selected"; ?>>Inactive</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="text-right">
                                                        <button type="reset" class="btn btn-secondary mr-2">Reset</button>
                                                        <button type="submit" name="register" class="btn btn-primary">Register User</button>
                                                        <div class="text-center mt-3">
                                                            <p class="mb-0">
                                                                Already have an account?
                                                                <a href="../../../index.php" class="text-primary font-weight-bold">Login Here</a>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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
                            <span class="mr-1"><script>document.write(new Date().getFullYear())</script> ©</span>
                            <a href="#">POS Dash</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="../assets/js/backend-bundle.min.js"></script>
    <script src="../assets/js/table-treeview.js"></script>
    <script src="../assets/js/customizer.js"></script>
    <script src="../assets/js/chart-custom.js"></script>
    <script src="../assets/js/app.js"></script>

    <script>
    // Profile Photo Validation
    const profilePhoto = document.getElementById("profile_photo");
    const photoError = document.getElementById("photo_error");

    profilePhoto.addEventListener("change", function() {
        photoError.innerHTML = "";
        if (this.files.length === 0) return;
        const file = this.files[0];
        const allowedTypes = ["image/jpeg", "image/jpg", "image/png"];
        if (!allowedTypes.includes(file.type)) {
            photoError.innerHTML = "Only JPG, JPEG and PNG files are allowed.";
            this.value = "";
            return;
        }
        if (file.size > 2 * 1024 * 1024) {
            photoError.innerHTML = "Profile photo size must not exceed 2 MB.";
            this.value = "";
            return;
        }
    });

    // Bank Document Validation
    const fileInput = document.getElementById("bank_document");
    const fileError = document.getElementById("file_error");

    fileInput.addEventListener("change", function() {
        fileError.innerHTML = "";
        if (this.files.length === 0) return;
        const file = this.files[0];
        const allowedTypes = ["image/jpeg", "image/png", "application/pdf"];
        if (!allowedTypes.includes(file.type)) {
            fileError.innerHTML = "Only JPG, PNG and PDF files are allowed.";
            this.value = "";
            return;
        }
        if (file.size > 2 * 1024 * 1024) {
            fileError.innerHTML = "File size must not exceed 2 MB.";
            this.value = "";
            return;
        }
    });

    // Password Toggle
    const togglePassword = document.getElementById("togglePassword");
    const passwordField = document.getElementById("password");

    togglePassword.addEventListener("click", function() {
        const type = passwordField.type === "password" ? "text" : "password";
        passwordField.type = type;
        this.querySelector("i").classList.toggle("fa-eye");
        this.querySelector("i").classList.toggle("fa-eye-slash");
    });

    const toggleConfirmPassword = document.getElementById("toggleConfirmPassword");
    const confirmPasswordField = document.getElementById("confirm_password");

    toggleConfirmPassword.addEventListener("click", function() {
        const type = confirmPasswordField.type === "password" ? "text" : "password";
        confirmPasswordField.type = type;
        this.querySelector("i").classList.toggle("fa-eye");
        this.querySelector("i").classList.toggle("fa-eye-slash");
    });

    // Password Match Check
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("confirm_password");
    const message = document.getElementById("password_message");

    function checkPassword() {
        if (confirmPassword.value == "") {
            message.innerHTML = "";
            return;
        }
        if (password.value === confirmPassword.value) {
            message.style.color = "green";
            message.innerHTML = "✓ Password Matched";
            confirmPassword.style.borderColor = "green";
        } else {
            message.style.color = "red";
            message.innerHTML = "✗ Password Not Matched";
            confirmPassword.style.borderColor = "red";
        }
    }

    if (password && confirmPassword) {
        password.addEventListener("keyup", checkPassword);
        confirmPassword.addEventListener("keyup", checkPassword);
    }

    // Account Number Match Check
    const account = document.getElementById("account_number");
    const confirmAccount = document.getElementById("confirm_account_number");
    const accountMessage = document.getElementById("account_message");

    function checkAccountNumber() {
        if (confirmAccount.value === "") {
            accountMessage.innerHTML = "";
            confirmAccount.style.borderColor = "";
            return;
        }
        if (account.value === confirmAccount.value) {
            accountMessage.innerHTML = "✓ Account Number Matched";
            accountMessage.style.color = "green";
            confirmAccount.style.borderColor = "green";
        } else {
            accountMessage.innerHTML = "✗ Account Number Not Matched";
            accountMessage.style.color = "red";
            confirmAccount.style.borderColor = "red";
        }
    }

    if (account && confirmAccount) {
        account.addEventListener("keyup", checkAccountNumber);
        confirmAccount.addEventListener("keyup", checkAccountNumber);
    }

    // ==================================================
    // WIZARD JAVASCRIPT - FIXED VERSION
    // Validates ONLY current step, disables step clicks
    // ==================================================

    document.addEventListener('DOMContentLoaded', function() {
        const sections = document.querySelectorAll('.wizard-section');
        const stepItems = document.querySelectorAll('.step-item');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const progressBar = document.getElementById('wizardProgressBar');
        const submitBtn = document.querySelector('[name="register"]');
        let currentStep = 1;
        const totalSteps = sections.length;

        // -------- UPDATE WIZARD UI --------
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

        // -------- GO TO STEP --------
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

            // Check password match on step 5
            if (currentStep === 5) {
                const pwd = document.getElementById('password');
                const confirmPwd = document.getElementById('confirm_password');
                if (pwd && confirmPwd && pwd.value !== confirmPwd.value) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        text: 'Password and Confirm Password do not match.',
                        confirmButtonColor: '#dc3545'
                    });
                    confirmPwd.focus();
                    return false;
                }
            }

            // Check account number match on step 4
            if (currentStep === 4) {
                const acc = document.getElementById('account_number');
                const confirmAcc = document.getElementById('confirm_account_number');
                if (acc && confirmAcc && acc.value !== confirmAcc.value) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        text: 'Account Number and Confirm Account Number do not match.',
                        confirmButtonColor: '#dc3545'
                    });
                    confirmAcc.focus();
                    return false;
                }
            }

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

        // -------- AJAX DUPLICATE CHECK --------
        function checkDuplicate(field, value, callback) {
            if (!value || value.trim() === '') {
                callback(true);
                return;
            }

            const formData = new FormData();
            formData.append('field', field);
            formData.append('value', value);

            fetch('ajax/check-user-duplicate.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'error') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Duplicate Record',
                        text: data.message,
                        confirmButtonColor: '#32bdea',
                        confirmButtonText: 'OK',
                        allowOutsideClick: false
                    });
                    callback(false);
                } else {
                    callback(true);
                }
            })
            .catch(() => {
                callback(true);
            });
        }

        // -------- NEXT STEP --------
        function nextStep() {
            // Validate current step
            if (!validateCurrentStep()) {
                return;
            }

            // Step 1: Check Mobile and Email duplicates
            if (currentStep === 1) {
                const mobile = document.querySelector('[name="mobile"]').value;
                const email = document.querySelector('[name="email"]').value;
                let checksCompleted = 0;
                let proceed = true;

                function checkAllDone() {
                    checksCompleted++;
                    if (checksCompleted === 2 && proceed) {
                        goToStep(currentStep + 1);
                    }
                }

                // Check Mobile
                if (mobile && mobile.length === 10) {
                    checkDuplicate('mobile', mobile, function(result) {
                        if (!result) proceed = false;
                        checkAllDone();
                    });
                } else {
                    checkAllDone();
                }

                // Check Email
                if (email) {
                    checkDuplicate('email', email, function(result) {
                        if (!result) proceed = false;
                        checkAllDone();
                    });
                } else {
                    checkAllDone();
                }
                return;
            }

            // Step 3: Check Employee ID, Aadhaar, PAN
            if (currentStep === 3) {
                const employeeId = document.querySelector('[name="employee_id"]').value;
                const aadhaar = document.querySelector('[name="aadhaar_no"]').value;
                const pan = document.querySelector('[name="pan_no"]').value;
                let checksCompleted = 0;
                let proceed = true;

                // PAN format validation
                const panRegex = /^[A-Z]{5}[0-9]{4}[A-Z]{1}$/;
                if (pan && !panRegex.test(pan.toUpperCase())) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        text: 'Please enter a valid PAN number (e.g., ABCDE1234F).',
                        confirmButtonColor: '#dc3545'
                    });
                    document.querySelector('[name="pan_no"]').focus();
                    return;
                }

                function checkAllDone() {
                    checksCompleted++;
                    if (checksCompleted === 3 && proceed) {
                        goToStep(currentStep + 1);
                    }
                }

                if (employeeId) {
                    checkDuplicate('employee_id', employeeId, function(result) {
                        if (!result) proceed = false;
                        checkAllDone();
                    });
                } else {
                    checkAllDone();
                }

                if (aadhaar && aadhaar.length === 12) {
                    checkDuplicate('aadhaar_no', aadhaar, function(result) {
                        if (!result) proceed = false;
                        checkAllDone();
                    });
                } else {
                    checkAllDone();
                }

                if (pan && pan.length === 10) {
                    checkDuplicate('pan_no', pan, function(result) {
                        if (!result) proceed = false;
                        checkAllDone();
                    });
                } else {
                    checkAllDone();
                }
                return;
            }

            // Step 5: Check Username
            if (currentStep === 5) {
                const username = document.querySelector('[name="username"]').value;
                const email = document.querySelector('[name="email"]').value;
                let checksCompleted = 0;
                let proceed = true;

                function checkAllDone() {
                    checksCompleted++;
                    if (checksCompleted === 2 && proceed) {
                        document.getElementById('wizardForm').submit();
                    }
                }

                if (username) {
                    checkDuplicate('username', username, function(result) {
                        if (!result) proceed = false;
                        checkAllDone();
                    });
                } else {
                    checkAllDone();
                }

                if (email) {
                    checkDuplicate('email', email, function(result) {
                        if (!result) proceed = false;
                        checkAllDone();
                    });
                } else {
                    checkAllDone();
                }
                return;
            }

            // Other steps: Just move forward
            if (currentStep < totalSteps) {
                goToStep(currentStep + 1);
            } else {
                document.getElementById('wizardForm').submit();
            }
        }

        // -------- PREVIOUS STEP --------
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

        // -------- INITIALIZE --------
        updateWizard();
    });
    </script>

    <style>
    /* Wizard Progress Bar & Steps */
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