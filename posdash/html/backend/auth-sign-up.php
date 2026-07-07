
<!doctype html>
<html lang="en">
  
<!-- Mirrored from templates.iqonic.design/posdash/html/backend/page-add-customers.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 29 Jun 2026 09:56:41 GMT -->
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
    <!-- Wrapper Start -->






<?php
session_start();
include 'db.php';

$msg = "";
$error = "";

$company = mysqli_query($conn,"SELECT id,company_name FROM company_master WHERE delete_flag='1' ORDER BY company_name");





$branch = mysqli_query($conn,"SELECT id,branch_name FROM branch_master WHERE delete_flag='1' ORDER BY branch_name");

// $warehouse = mysqli_query($conn,"SELECT id,warehouse_name FROM warehouse_master WHERE delete_flag='1' ORDER BY warehouse_name");

// $department = mysqli_query($conn,"SELECT id,department_name FROM department_master WHERE delete_flag='1' ORDER BY department_name");

// $designation = mysqli_query($conn,"SELECT id,designation_name FROM designation_master WHERE delete_flag='1' ORDER BY designation_name");

$role = mysqli_query($conn,"SELECT id,role_name FROM role WHERE role_name != 'owner' && delete_flag='1' ORDER BY role_name");

$manager = mysqli_query($conn,"
SELECT id,full_name
FROM users
WHERE delete_flag='1'
AND status='Active'
ORDER BY full_name
");

if(isset($_POST['register']))
{

    $full_name            = mysqli_real_escape_string($conn,$_POST['full_name']);
    $mobile               = mysqli_real_escape_string($conn,$_POST['mobile']);
    $alternate_mobile     = mysqli_real_escape_string($conn,$_POST['alternate_mobile']);
    $email                = mysqli_real_escape_string($conn,$_POST['email']);
    $username             = mysqli_real_escape_string($conn,$_POST['username']);
    $gender               = mysqli_real_escape_string($conn,$_POST['gender']);
    $date_of_birth        = mysqli_real_escape_string($conn,$_POST['date_of_birth']);
    $address              = mysqli_real_escape_string($conn,$_POST['address']);
    $city                 = mysqli_real_escape_string($conn,$_POST['city']);
    $state                = mysqli_real_escape_string($conn,$_POST['state']);
    $country              = mysqli_real_escape_string($conn,$_POST['country']);
    $pincode              = mysqli_real_escape_string($conn,$_POST['pincode']);

    $company_id           = mysqli_real_escape_string($conn,$_POST['company_id']);
    $branch_id            = mysqli_real_escape_string($conn,$_POST['branch_id']);
    $warehouse_id         = mysqli_real_escape_string($conn,$_POST['warehouse_id']);


    $department_id        = mysqli_real_escape_string($conn,$_POST['department_id']);
    $designation_id       = mysqli_real_escape_string($conn,$_POST['designation_id']);


    $role_id              = mysqli_real_escape_string($conn,$_POST['role_id']);
    $reporting_manager_id = mysqli_real_escape_string($conn,$_POST['reporting_manager_id']);
    $work_shift           = mysqli_real_escape_string($conn,$_POST['shift']);

    $employee_id          = mysqli_real_escape_string($conn,$_POST['employee_id']);
    $joining_date         = mysqli_real_escape_string($conn,$_POST['joining_date']);
    $employment_type      = mysqli_real_escape_string($conn,$_POST['employment_type']);
    $employee_status      = mysqli_real_escape_string($conn,$_POST['employee_status']);
    $salary               = mysqli_real_escape_string($conn,$_POST['salary']);
    $experience           = mysqli_real_escape_string($conn,$_POST['experience']);
    $qualification        = mysqli_real_escape_string($conn,$_POST['qualification']);
    $work_location        = mysqli_real_escape_string($conn,$_POST['work_location']);
    $aadhaar_no           = mysqli_real_escape_string($conn,$_POST['aadhaar_no']);
    $pan_no               = mysqli_real_escape_string($conn,$_POST['pan_no']);

    $bank_name            = mysqli_real_escape_string($conn,$_POST['bank_name']);
    $account_holder_name  = mysqli_real_escape_string($conn,$_POST['account_holder_name']);
    $account_number       = mysqli_real_escape_string($conn,$_POST['account_number']);
    $ifsc_code            = mysqli_real_escape_string($conn,$_POST['ifsc_code']);
    $bank_branch          = mysqli_real_escape_string($conn,$_POST['bank_branch']);
    $account_type         = mysqli_real_escape_string($conn,$_POST['account_type']);
    $upi_id               = mysqli_real_escape_string($conn,$_POST['upi_id']);

    $password             = $_POST['password'];
    $confirm_password     = $_POST['confirm_password'];
    $status               = mysqli_real_escape_string($conn,$_POST['status']);

    $checkEmail=mysqli_query($conn,"
    SELECT id
    FROM users
    WHERE email='$email'
    AND delete_flag='1'
    ");

    if(mysqli_num_rows($checkEmail)>0)
    {
        $error="Email already exists.";
    }

    else
    {

        $checkUser=mysqli_query($conn,"
        SELECT id
        FROM users
        WHERE username='$username'
        AND delete_flag='1'
        ");

        if(mysqli_num_rows($checkUser)>0)
        {
            $error="Username already exists.";
        }

    }


if(empty($error))
{
    if($password!=$confirm_password)
    {
        $error="Password and Confirm Password do not match.";
    }
}

if(empty($error))
{

    $hash_password=password_hash($password,PASSWORD_DEFAULT);

   

    $profile_photo="";

    if(isset($_FILES['profile_photo']) && $_FILES['profile_photo']['name']!="")
    {

        $folder="../assets/user-photo/";

        if(!is_dir($folder))
        {
            mkdir($folder,0777,true);
        }

        $ext=strtolower(pathinfo($_FILES['profile_photo']['name'],PATHINFO_EXTENSION));

        $allow=array("jpg","jpeg","png");

        if(in_array($ext,$allow))
        {

            $photo_name=time()."_".rand(1000,9999).".".$ext;

            $destination=$folder.$photo_name;

            if(move_uploaded_file($_FILES['profile_photo']['tmp_name'],$destination))
            {
                $profile_photo=$destination;
            }

        }

    }





    $bank_document="";

    if(isset($_FILES['bank_document']) && $_FILES['bank_document']['name']!="")
    {

        $folder="../assets/bankimg/";

        if(!is_dir($folder))
        {
            mkdir($folder,0777,true);
        }

        $ext=strtolower(pathinfo($_FILES['bank_document']['name'],PATHINFO_EXTENSION));

        $allow=array("jpg","jpeg","png","pdf");

        if(in_array($ext,$allow))
        {

            $file_name=time()."_".rand(1000,9999).".".$ext;

            $destination=$folder.$file_name;

            if(move_uploaded_file($_FILES['bank_document']['tmp_name'],$destination))
            {
                $bank_document=$destination;
            }

        }

    }




    $insert=mysqli_query($conn,"
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
    branch_id,
    warehouse_id,
    department_id,
    designation_id,
    role_id,
    reporting_manager_id,
    work_shift,

    employee_id,
    joining_date,
    employment_type,
    employee_status,
    salary,
    experience,
    qualification,
    work_location,
    aadhaar_no,
    pan_no,

    bank_name,
    account_holder_name,
    account_number,
    ifsc_code,
    bank_branch,
    account_type,
    upi_id,
    bank_document,

    password,
    status

    )

    VALUES
    (

    '$full_name',
    '$mobile',
    '$alternate_mobile',
    '$email',
    '$username',
    '$profile_photo',
    '$gender',
    '$date_of_birth',
    '$address',
    '$city',
    '$state',
    '$country',
    '$pincode',

    '$company_id',
    '$branch_id',
    '$warehouse_id',
    '$department_id',
    '$designation_id',
    '$role_id',
    '$reporting_manager_id',
    '$work_shift',

    '$employee_id',
    '$joining_date',
    '$employment_type',
    '$employee_status',
    '$salary',
    '$experience',
    '$qualification',
    '$work_location',
    '$aadhaar_no',
    '$pan_no',

    '$bank_name',
    '$account_holder_name',
    '$account_number',
    '$ifsc_code',
    '$bank_branch',
    '$account_type',
    '$upi_id',
    '$bank_document',

    '$hash_password',
    '$status'

    )");



    if($insert)
    {

        $msg="User Registered Successfully.";

        $_POST=array();

    }
    else
    {

        $error=mysqli_error($conn);

    }

}
}
?>
    <div class="wrapper">
      
   
      
      
      
      
      <div class="content-page" style="margin-top:-69px">
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












<?php
if(!empty($msg))
{
?>
<div class="alert alert-success alert-dismissible fade show">
    <?php echo $msg; ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
</div>
<?php
}

if(!empty($error))
{
?>
<div class="alert alert-danger alert-dismissible fade show">
    <?php echo $error; ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
</div>
<?php
}
?>











<form method="post" enctype="multipart/form-data">

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Personal Information</h4>
    </div>

    <div class="card-body">
        <div class="row">

            <!-- Full Name -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Full Name <span class="text-danger">*</span></label>
                  <input type="text"
                name="full_name"
                class="form-control"
                    value="<?php echo isset($_POST['full_name']) ? htmlspecialchars($_POST['full_name']) : ''; ?>">


                </div>
            </div>

            <!-- Mobile -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Mobile Number <span class="text-danger">*</span></label>
                    <input type="tel"
                           name="mobile"
                           class="form-control"
                           placeholder="Enter Mobile Number"
                           pattern="[0-9]{10}"
                           maxlength="10"
                           value="<?php echo isset($_POST['mobile']) ? htmlspecialchars($_POST['mobile']) : ''; ?>"
                           required>
                </div>
            </div>

            <!-- Alternate Mobile -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Alternate Mobile Number</label>
                    <input type="tel"
                           name="alternate_mobile"
                           class="form-control"
                           placeholder="Enter Alternate Mobile Number"
                           value="<?php echo isset($_POST['alternate_mobile']) ? htmlspecialchars($_POST['alternate_mobile']) : ''; ?>"
                           pattern="[0-9]{10}"
                           maxlength="10">
                </div>
            </div>

            <!-- Email -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Email Address <span class="text-danger">*</span></label>
                    <input type="email"
                           name="email"
                           class="form-control"
                           placeholder="Enter Email Address"
                           value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"
                           required>
                </div>
            </div>

        

            <!-- Profile Photo -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Profile Photo</label>
                    <input type="file"
                           name="profile_photo"
                           class="form-control"
                           accept=".jpg,.jpeg,.png">
                </div>
            </div>

            <!-- Gender -->
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

            <!-- DOB -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Date of Birth <span class="text-danger">*</span></label>
                    <input type="date"
                           name="date_of_birth"
                           value="<?php echo isset($_POST['date_of_birth']) ? $_POST['date_of_birth'] : ''; ?>"
                           class="form-control"
                           required>
                </div>
            </div>

            <!-- Address -->
            <div class="col-md-12">
                <div class="form-group">
                    <label>Address <span class="text-danger">*</span></label>
                   <textarea
                    name="address"
                    class="form-control">
                    <?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : ''; ?>
                
                    </textarea>
                </div>
            </div>

            <!-- City -->
            <div class="col-md-3">
                <div class="form-group">
                    <label>City <span class="text-danger">*</span></label>
                    <input type="text"
                           name="city"
                           class="form-control"
                           placeholder="Enter City"
                           value="<?php echo isset($_POST['city']) ? htmlspecialchars($_POST['city']) : ''; ?>"
                           required>
                </div>
            </div>

            <!-- State -->
            <div class="col-md-3">
                <div class="form-group">
                    <label>State <span class="text-danger">*</span></label>
                    <input type="text"
                           name="state"
                           class="form-control"
                           placeholder="Enter State"
                           value="<?php echo isset($_POST['state']) ? htmlspecialchars($_POST['state']) : ''; ?>"
                           required>
                </div>
            </div>

            <!-- Country -->
            <div class="col-md-3">
                <div class="form-group">
                    <label>Country <span class="text-danger">*</span></label>
                    <input type="text"
                           name="country"
                           class="form-control"
                           placeholder="Enter Country"
                           value="<?php echo isset($_POST['country']) ? htmlspecialchars($_POST['country']) : ''; ?>"
                           required>
                </div>
            </div>

            <!-- PIN Code -->
            <div class="col-md-3">
                <div class="form-group">
                    <label>PIN Code <span class="text-danger">*</span></label>
                    <input type="text"
                           name="pincode"
                           class="form-control"
                           placeholder="Enter PIN Code"
                           value="<?php echo isset($_POST['pincode']) ? htmlspecialchars($_POST['pincode']) : ''; ?>"
                           pattern="[0-9]{6}"
                           maxlength="6"
                           required>
                </div>
            </div>

        </div>
    </div>
</div>



<!-- ================= Company Information ================= -->

<div class="card mt-4">
    <div class="card-header">
        <h4 class="card-title">Company Information</h4>
    </div>

    <div class="card-body">
        <div class="row">

            <!-- Company Name -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Company Name <span class="text-danger">*</span></label>
                  <select name="company_id" class="form-control" required>

    <option value="" >Select Company</option>

    <?php
    while($row = mysqli_fetch_assoc($company))
    {
    ?>

    <option value="<?php echo $row['id'];?>"

    <?php
    if(isset($_POST['company_id']) && $_POST['company_id'] == $row['id'])
    {
        echo "selected";
    }
    ?>

    >
    <?php echo $row['company_name'];?>
    </option>

    <?php
    }
    ?>

</select>
                </div>
            </div>

            <!-- Branch -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Branch <span class="text-danger">*</span></label>
                      <select name="branch_id" class="form-control" required>

    <option value="">Select Branch</option>

    <?php
    while($row = mysqli_fetch_assoc($branch))
    {
    ?>

    <option value="<?php echo $row['id'];?>"

    <?php
    if(isset($_POST['branch_id']) && $_POST['branch_id'] == $row['id'])
    {
        echo "selected";
    }
    ?>

    >
    <?php echo $row['branch_name'];?>
    </option>

    <?php
    }
    ?>

</select>
                </div>
            </div>




            <!-- Warehouse -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Warehouse</label>
                    <select name="warehouse_id" class="form-control" >
                        <option value="">Select Warehouse</option>
                         <option value="1">None</option>
                        <option value="1">Main Warehouse</option>
                        <option value="2">Warehouse 2</option>
                    </select>
                </div>
            </div>



            <!-- Department -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Department</label>
                    <select name="department_id" class="form-control">
                        <option value="">Select Department</option>
                        <option>Administration</option>
                        <option>Accounts</option>
                        <option>Sales</option>
                        <option>Purchase</option>
                        <option>Inventory</option>
                        <option>HR</option>
                        <option>IT</option>
                    </select>
                </div>
            </div>

            <!-- Designation -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Designation</label>
                    <select name="designation_id" class="form-control">
                        <option value="">Select Designation</option>
                        <option>Owner</option>
                        <option>Branch Manager</option>
                        <option>Employee</option>
                      
                    </select>
                </div>
            </div>

            

            <!-- Role -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Role <span class="text-danger">*</span></label>
                 <select name="role_id" class="form-control" required>

    <option value="">Select Role</option>

    <?php
    while($row = mysqli_fetch_assoc($role))
    {
    ?>

    <option value="<?php echo $row['id'];?>"

    <?php
    if(isset($_POST['role_id']) && $_POST['role_id'] == $row['id'])
    {
        echo "selected";
    }
    ?>

    >
        <?php echo $row['role_name'];?>
    </option>

    <?php
    }
    ?>

</select>
                </div>
            </div>




    <div class="col-md-6">
    <div class="form-group">
        <label>Reporting Manager</label>

        <select name="reporting_manager_id" class="form-control">

            <option value="">Select Reporting Manager</option>

            <?php
            mysqli_data_seek($role,0);

            while($row=mysqli_fetch_assoc($role))

            {
            ?>

            <option value="<?php echo $row['id'];?>"

            <?php
            if(isset($_POST['reporting_manager_id']) && $_POST['reporting_manager_id']==$row['id'])
            {
                echo "selected";
            }
            ?>

            >
                <?php echo $row['role_name'];?>
            </option>

            <?php
            }
            ?>

        </select>

    </div>
</div>

            <!-- Work Shift -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Work Shift</label>
                    <select name="shift" class="form-control" >
                        <option value="">Select Shift</option>
                        <option>Morning</option>
                        <option>General</option>
                        <option>Evening</option>
                        <option>Night</option>
                    </select>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- ================= Employee Information ================= -->

<div class="card mt-4">
    <div class="card-header">
        <h4 class="card-title">Employee Information</h4>
    </div>

    <div class="card-body">
        <div class="row">

            <!-- Employee ID -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Employee ID <span class="text-danger">*</span></label>
                    <input type="text"
                           name="employee_id"
                           class="form-control"
                           placeholder="Enter Employee ID"
                           maxlength="20"
                           value="<?php echo isset($_POST['employee_id']) ? htmlspecialchars($_POST['employee_id']) : ''; ?>"
                           required>
                </div>
            </div>

            <!-- Joining Date -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Joining Date <span class="text-danger">*</span></label>
                    <input type="date"
                           name="joining_date"
                           class="form-control"
                           value="<?php echo isset($_POST['joining_date']) ? $_POST['joining_date'] : ''; ?>"
                           required>
                </div>
            </div>

            <!-- Employment Type -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Employment Type <span class="text-danger">*</span></label>
                    <select name="employment_type"
                            class="form-control"
                            required>
                        <option value="">Select Employment Type</option>
                        <option value="Permanent">Permanent</option>
                        <option value="Contract">Contract</option>
                        <option value="Temporary">Temporary</option>
                        <option value="Intern">Intern</option>
                        <option value="Part Time">Part Time</option>
                    </select>
                </div>
            </div>

            <!-- Employee Status -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Employee Status <span class="text-danger">*</span></label>
                    <select name="employee_status"
                            class="form-control"
                            required>
                      <option value="Active"
                        <?php
                        if(isset($_POST['status']) && $_POST['status']=="Active")
                    echo "selected";
                    ?>
                    >
                Active
                    </option>

                <option value="Inactive"
                        <?php
                if(isset($_POST['status']) && $_POST['status']=="Inactive")
                    echo "selected";
                ?>
                >
                Inactive
                </option>
                    </select>
                </div>
            </div>

            <!-- Salary -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Salary</label>
                    <input type="number"
                           name="salary"
                           class="form-control"
                           placeholder="Enter Salary"
                           value="<?php echo isset($_POST['salary']) ? htmlspecialchars($_POST['salary']) : ''; ?>"
                           min="0">
                </div>
            </div>

            <!-- Experience -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Experience (Years)</label>
                    <input type="number"
                           name="experience"
                           class="form-control"
                           placeholder="Enter Experience"
                           value="<?php echo isset($_POST['experience']) ? htmlspecialchars($_POST['experience']) : ''; ?>"
                           min="0"
                           max="50">
                </div>
            </div>

            <!-- Qualification -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Qualification</label>
                    <input type="text"
                           name="qualification"
                           class="form-control"
                           value="<?php echo isset($_POST['qualification']) ? htmlspecialchars($_POST['qualification']) : ''; ?>"
                           placeholder="Enter Qualification">
                </div>
            </div>

            <!-- Work Location -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Work Location</label>
                    <input type="text"
                           name="work_location"
                           class="form-control"
                           value="<?php echo isset($_POST['work_location']) ? htmlspecialchars($_POST['work_location']) : ''; ?>"
                           placeholder="Enter Work Location">
                </div>
            </div>

            <!-- Aadhaar Number -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Aadhaar Number<span class="text-danger">*</span></label>
                    <input type="text"
                           name="aadhaar_no"
                           class="form-control"
                           placeholder="Enter Aadhaar Number"
                           value="<?php echo isset($_POST['aadhaar_no']) ? htmlspecialchars($_POST['aadhaar_no']) : ''; ?>"
                           maxlength="12"
                           pattern="[0-9]{12}" required>
                </div>
            </div>

            <!-- PAN Number -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>PAN Number<span class="text-danger">*</span></label>
                    <input type="text"
                           name="pan_no"
                           class="form-control"
                           placeholder="Enter PAN Number"
                           maxlength="10"
         value="<?php echo isset($_POST['pan_no']) ? htmlspecialchars($_POST['pan_no']) : ''; ?>"

                           style="text-transform:uppercase;" required>
                </div>
            </div>

        </div>
    </div>
</div>


<!-- ================= Bank Information ================= -->

<div class="card mt-4">
    <div class="card-header">
        <h4 class="card-title">Bank Information</h4>
    </div>

    <div class="card-body">
        <div class="row">

            <!-- Bank Name -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Bank Name <span class="text-danger">*</span></label>
                    <input type="text"
                           name="bank_name"
                           class="form-control"
                           value="<?php echo isset($_POST['bank_name']) ? htmlspecialchars($_POST['bank_name']) : ''; ?>"
                           placeholder="Enter Bank Name"
                           maxlength="100"
                           required>
                </div>
            </div>

            <!-- Account Holder Name -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Account Holder Name <span class="text-danger">*</span></label>
                    <input type="text"
                           name="account_holder_name"
                           class="form-control"
                           placeholder="Enter Account Holder Name"
                           value="<?php echo isset($_POST['account_holder_name']) ? htmlspecialchars($_POST['account_holder_name']) : ''; ?>"
                           maxlength="100"
                           required>
                </div>
            </div>

            <!-- Account Number -->
            <div class="col-md-6">
              <div class="form-group">
                 <label>Account Number <span class="text-danger">*</span></label>
             <input type="text"
           id="account_number"
           name="account_number"
           class="form-control"
                            value="<?php echo isset($_POST['account_number']) ? htmlspecialchars($_POST['account_number']) : ''; ?>"
          
           placeholder="Enter Account Number"
           required>
            </div>
            </div>

            <!-- Confirm Account Number -->
            <div class="col-md-6">

              <div class="form-group">
                 <label>Confirm Account Number <span class="text-danger">*</span></label>
                <input type="text"
           id="confirm_account_number"
           name="confirm_account_number"
    value="<?php echo isset($_POST['confirm_account_number']) ? htmlspecialchars($_POST['confirm_account_number']) : ''; ?>"

           class="form-control"
           placeholder="Confirm Account Number"
            pattern="[0-9]{9,18}"
                           maxlength="18"
           required>

    <small id="account_message"></small>
</div>

                
            </div>

            <!-- IFSC Code -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>IFSC Code <span class="text-danger">*</span></label>
                    <input type="text"
                           name="ifsc_code"
                           class="form-control"
                           placeholder="Enter IFSC Code"
                           style="text-transform:uppercase;"
                           maxlength="11"
                           value="<?php echo isset($_POST['ifsc_code']) ? htmlspecialchars($_POST['ifsc_code']) : ''; ?>"
                           pattern="[A-Z]{4}0[A-Z0-9]{6}"
                           required>
                </div>
            </div>

            <!-- Branch Name -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Branch Name <span class="text-danger">*</span></label>
                    <input type="text"
                           name="bank_branch"
                           class="form-control"
                           placeholder="Enter Branch Name"
                           value="<?php echo isset($_POST['bank_branch']) ? htmlspecialchars($_POST['bank_branch']) : ''; ?>"
                           maxlength="100"
                           required>
                </div>
            </div>

            <!-- Account Type -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Account Type <span class="text-danger">*</span></label>
                    <select name="account_type"
                            class="form-control"
                            required>
                        <option value="">Select Account Type</option>
                        <option value="Saving">Saving Account</option>
                        <option value="Current">Current Account</option>
                        <option value="Salary">Salary Account</option>
                    </select>
                </div>
            </div>

            <!-- UPI ID -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>UPI ID</label>
                    <input type="text"
                           name="upi_id"
                           class="form-control"
                           value="<?php echo isset($_POST['upi_id']) ? htmlspecialchars($_POST['upi_id']) : ''; ?>"
                           placeholder="Enter UPI ID (Optional)">
                </div>
            </div>

            <!-- Bank Passbook / Cancelled Cheque -->
            <div class="col-md-12">
                <div class="form-group">
                    <label>Upload Passbook / Cancelled Cheque</label>
                    <input type="file"
                           name="bank_document"
                           class="form-control"
                           accept=".jpg,.jpeg,.png,.pdf">
                </div>
            </div>

        </div>
    </div>
</div>


<!-- ================= Login Information ================= -->

<div class="card mt-4">
    <div class="card-header">
        <h4 class="card-title">Login Information</h4>
    </div>

    <div class="card-body">
        <div class="row">

            <!-- Login Username -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Login Username <span class="text-danger">*</span></label>
                    <input type="text"
                           name="username"
                           class="form-control"
                           placeholder="Enter Login Username"
                           minlength="4"
                           maxlength="30"
                           required>
                </div>
            </div>

            <!-- Login Email -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Login Email <span class="text-danger">*</span></label>
                    <input type="email"
                           name="login_email"
                           class="form-control"
                           placeholder="Enter Login Email"
                           required>
                </div>
            </div>

            <!-- Password -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Password <span class="text-danger">*</span></label>
                    <input type="password"
                           id="password"
                           name="password"
                           class="form-control"
                           placeholder="Enter Password"
                           minlength="8"
                           required>
                </div>
            </div>

            <!-- Confirm Password -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Confirm Password <span class="text-danger">*</span></label>
                    <input type="password"
                           id="confirm_password"
                           name="confirm_password"
                           class="form-control"
                           placeholder="Confirm Password"
                           minlength="8"
                           required>
                    <small id="password_message"></small>
                </div>
            </div>

            <!-- Status -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Status <span class="text-danger">*</span></label>
                    <select name="status"
                            class="form-control"
                            required>
                        <option value="">Select Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>

           

        </div>

        <hr>

        <div class="text-right">

            <button type="reset" class="btn btn-secondary mr-2">
                Reset
            </button>

          <button type="submit"
        name="register"
        class="btn btn-primary">
Register User
</button>
            <div class="text-center mt-3">
    <p class="mb-0">
        Already have an account?
        <a href="../../../index.php" class="text-primary font-weight-bold">
            Login Here
        </a>
    </p>
</div>

        </div>

    </div>
</div>







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
                            <span class="mr-1"><script type="18f15093d757eff03139b950-text/javascript">document.write(new Date().getFullYear())</script>©</span> <a href="#" class="">POS Dash</a>.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Backend Bundle JavaScript -->
    <script src="../assets/js/backend-bundle.min.js" type="18f15093d757eff03139b950-text/javascript"></script>
    
    <!-- Table Treeview JavaScript -->
    <script src="../assets/js/table-treeview.js" type="18f15093d757eff03139b950-text/javascript"></script>
    
    <!-- Chart Custom JavaScript -->
    <script src="../assets/js/customizer.js" type="18f15093d757eff03139b950-text/javascript"></script>
    
    <!-- Chart Custom JavaScript -->
    <script async src="../assets/js/chart-custom.js" type="18f15093d757eff03139b950-text/javascript"></script>
    
    <!-- app JavaScript -->
    <script src="../assets/js/app.js" type="18f15093d757eff03139b950-text/javascript"></script>
  <script src="../../../cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="18f15093d757eff03139b950-|49" defer></script><script defer src="https://static.cloudflareinsights.com/beacon.min.js/v833ccba57c9e4d2798f2e76cebdd09a11778172276447" integrity="sha512-57MDmcccJXYtNnH+ZiBwzC4jb2rvgVCEokYN+L/nLlmO8rfYT/gIpW2A569iJ/3b+0UEasghjuZH/ma3wIs/EQ==" data-cf-beacon='{"version":"2024.11.0","token":"41ccecab40284244aa0b52f56036ee92","r":1,"server_timing":{"name":{"cfCacheStatus":true,"cfEdge":true,"cfExtPri":true,"cfL4":true,"cfOrigin":true,"cfSpeedBrain":true},"location_startswith":null}}' crossorigin="anonymous"></script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'a1340e6d390acdfa',t:'MTc4MjcyNjkzNA=='};var a=document.createElement('script');a.src='../../../cdn-cgi/challenge-platform/h/b/scripts/jsd/25e6c66701a0/maind41d.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>



<script>
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
        message.innerHTML = "Password Matched";

    } else {

        message.style.color = "red";
        message.innerHTML = "Password Not Matched";

    }
}

password.addEventListener("keyup", checkPassword);
confirmPassword.addEventListener("keyup", checkPassword);








</script>


<script>
const accountNumber = document.getElementById("account_number");
const confirmAccountNumber = document.getElementById("confirm_account_number");
const accountMessage = document.getElementById("account_message");

function checkAccountNumber()
{
    if(confirmAccountNumber.value == "")
    {
        accountMessage.innerHTML = "";
        return;
    }

    if(accountNumber.value === confirmAccountNumber.value)
    {
        accountMessage.style.color = "green";
        accountMessage.innerHTML = "Account Number Matched";
    }
    else
    {
        accountMessage.style.color = "red";
        accountMessage.innerHTML = "Account Number Not Matched";
    }
}

accountNumber.addEventListener("keyup", checkAccountNumber);
confirmAccountNumber.addEventListener("keyup", checkAccountNumber);
</script>

</html>