<!doctype html>
<html lang="en">
  
<!-- Mirrored from templates.iqonic.design/posdash/html/backend/page-add-category.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 29 Jun 2026 09:56:40 GMT -->
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

<?php include 'session.php' ?>
<?php include 'db.php' ?>

<?php
$user_id = $_SESSION['user_id'];

$image_path;
$getUser = mysqli_query($conn,"
SELECT * FROM users
WHERE id='$user_id'
");

$user = mysqli_fetch_assoc($getUser);


if(isset($_POST['update_profile']))
{
    $full_name = mysqli_real_escape_string($conn,$_POST['full_name']);
    $username  = mysqli_real_escape_string($conn,$_POST['username']);
    $email     = mysqli_real_escape_string($conn,$_POST['email']);
    $mobile    = mysqli_real_escape_string($conn,$_POST['mobile']);
    $gender    = mysqli_real_escape_string($conn,$_POST['gender']);
    $dob       = mysqli_real_escape_string($conn,$_POST['date_of_birth']);
    $address   = mysqli_real_escape_string($conn,$_POST['address']);
    $city      = mysqli_real_escape_string($conn,$_POST['city']);
    $state     = mysqli_real_escape_string($conn,$_POST['state']);
    $pincode   = mysqli_real_escape_string($conn,$_POST['pincode']);
    $about_me  = mysqli_real_escape_string($conn,$_POST['about_me']);

    
    $photo = $user['profile_photo'];
   

    
    if($_FILES['profile_image']['name'] != "")
    {
        $folder = "../assets/user-photo/";

        if(!is_dir($folder))
        {
            mkdir($folder,0777,true);
        }

        $profile = time()."_".$_FILES['profile_image']['name'];

        move_uploaded_file(
            $_FILES['profile_image']['tmp_name'],
            $folder.$profile
        );
    }

    $update = mysqli_query($conn,"
    UPDATE users SET
        full_name='$full_name',
        username='$username',
        email='$email',
        mobile='$mobile',
        gender='$gender',
        date_of_birth='$dob',
        address='$address',
        city='$city',
        state='$state',
        pincode='$pincode',
        about_me='$about_me',
        profile_photo='$photo'
    WHERE id='$user_id'
    ");

    if($update)
    {
        $_SESSION['full_name'] = $full_name;
        $_SESSION['email'] = $email;
        $_SESSION['profile_photo'] = $photo;

        echo "
        <script>
            alert('Profile Updated Successfully');
            window.location='profile.php';
        </script>
        ";
    }
    else
    {
        echo "
        <script>
            alert('".mysqli_error($conn)."');
        </script>
        ";
    }
}   
?>

<?php
$role = mysqli_query($conn,"
    SELECT role_name
    FROM role
    WHERE id='$role_id'
");

if(mysqli_num_rows($role) > 0)
{
    $row = mysqli_fetch_assoc($role);
    $role_name = $row['role_name'];
}
else
{
    $role_name = "Unknown";
}
?>

<body class="  ">
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center"></div>
    </div>
    <!-- loader END -->
    
    <!-- Wrapper Start -->
    <div class="wrapper">
    
    <?php include 'header.php' ?>
    
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">

                <!-- ================= LEFT PROFILE CARD ================= -->
                <div class="col-lg-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body text-center">
                            <div class="position-relative d-inline-block">
                                <?php
                                
                                $image = "../assets/images/user/1.png"; // Default image
                                
                                if(!empty($user['profile_photo'])) {
                                    $image_path = "../assets/ownerimage/".$user['profile_photo'];
                                    
                                    if(file_exists($image_path)) {
                                        $image = $image_path;
                                    }
                                }
                                ?>
                                
                                <img src="<?php echo $image; ?>"
                                    id="previewImage"
                                    class="rounded-circle border shadow"
                                    style="width:180px; height:180px; object-fit:cover;">

                                <!-- Camera icon to trigger file upload -->
                                <div class="position-absolute" 
                                     style="bottom:10px; right:10px; cursor:pointer;" 
                                     onclick="document.getElementById('profile_image').click();">
                                    <i class="ri-camera-line" 
                                       style="background:#007bff; padding:8px; border-radius:50%; color:white;"></i>
                                </div>

                                <input type="file"
                                       id="profile_image"
                                       name="profile_image"
                                       accept="image/*"
                                       hidden
                                       onchange="previewImage(this)">
                            </div>

                            <h3 class="mt-3 mb-1">
                                <?php echo $_SESSION['full_name']; ?>
                            </h3>

                            <span class="badge badge-primary px-3 py-2">
                                <?php echo $role_name ?>
                            </span>

                            <hr>

                            <div class="text-left mt-4">
                                <p>
                                    <i class="ri-user-line text-primary"></i>
                                    <strong>User ID :</strong>
                                    <?php echo $_SESSION['user_id']; ?>
                                </p>
                                <p>
                                    <i class="ri-mail-line text-success"></i>
                                    <strong>Email :</strong>
                                    <?php echo $_SESSION['email']; ?>
                                </p>
                                <p>
                                    <i class="ri-building-line text-warning"></i>
                                    <strong>Company :</strong>
                                    UltraPOS
                                </p>
                                <p>
                                    <i class="ri-git-branch-line text-info"></i>
                                    <strong>Branch :</strong>
                                    Main Branch
                                </p>
                                <p>
                                    <i class="ri-shield-user-line text-danger"></i>
                                    <strong>Role :</strong>
                                    <?php echo $role_name ?>
                                </p>
                                <p>
                                    <i class="ri-time-line"></i>
                                    <strong>Last Login :</strong>
                                    <?php echo date("d M Y h:i A"); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ================= RIGHT PROFILE ================= -->
                <div class="col-lg-8">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white">
                            <h4 class="mb-0">
                                <i class="ri-user-settings-line"></i>
                                Update Profile
                            </h4>
                        </div>
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data">
                                <div class="row">

                                    <!-- ================= Personal Information ================= -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Full Name <span class="text-danger">*</span></label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="full_name"
                                                   placeholder="Enter Full Name"
                                                   value="<?php echo $_SESSION['full_name']; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Username <span class="text-danger">*</span></label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="username"
                                                   placeholder="Enter Username"
                                                   value="<?php echo $user['username']; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email Address</label>
                                            <input type="email"
                                                   class="form-control"
                                                   name="email"
                                                   value="<?php echo $_SESSION['email']; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mobile Number</label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="mobile"
                                                   placeholder="Enter Mobile Number"
                                                   value="<?php echo $user['mobile']; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <select class="form-control" name="gender">
                                                <option value="">Select Gender</option>
                                                <option value="Male" <?php if($user['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                                                <option value="Female" <?php if($user['gender'] == 'Female') echo 'selected'; ?>>Female</option>
                                                <option value="Other" <?php if($user['gender'] == 'Other') echo 'selected'; ?>>Other</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Date Of Birth</label>
                                            <input type="date"
                                                   class="form-control"
                                                   name="dob"
                                                   value="<?php echo $user['date_of_birth']; ?>"
                                                   >
                                        </div>
                                    </div>

                                    <hr class="col-12">

                                    <!-- ================= Company Details ================= -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Company</label>
                                            <input type="text"
                                                   class="form-control"
                                                   value="UltraPOS"
                                                   readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Branch</label>
                                            <input type="text"
                                                   class="form-control"
                                                   value="Main Branch"
                                                   readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Role</label>
                                            <input type="text"
                                                   class="form-control"
                                                   value="<?php echo $role_name ?>"
                                                   readonly>
                                        </div>
                                    </div>

                                    <hr class="col-12">

                                    <!-- ================= Address ================= -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <textarea class="form-control"
                                                      rows="3"
                                                      name="address"
                                                      placeholder="Enter Address"><?php echo $user['address']; ?></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>City</label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="city"
                                                   value="<?php echo $user['city']; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>State</label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="state"
                                                   value="<?php echo $user['state']; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Pincode</label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="pincode"
                                                   value="<?php echo $user['pincode']; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>About Me</label>
                                            <textarea class="form-control"
                                                      rows="4"
                                                      name="about_me"
                                                      placeholder="Write something about yourself..."></textarea>
                                        </div>
                                    </div>

                                    <hr class="col-12">

                                    <!-- ================= Buttons ================= -->
                                    <div class="col-md-12 text-right">
                                        <button type="submit"
                                                class="btn btn-primary px-5"
                                                name="update_profile">
                                            <i class="ri-save-line"></i>
                                            Save Profile
                                        </button>

                                        <button type="reset"
                                                class="btn btn-light border px-5 ml-2">
                                            Reset
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Footer -->
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
                            <span class="mr-1"><script type="text/javascript">document.write(new Date().getFullYear())</script>©</span> <a href="#" class="">POS Dash</a>.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Backend Bundle JavaScript -->
    <script src="../assets/js/backend-bundle.min.js" type="text/javascript"></script>
    
    <!-- Table Treeview JavaScript -->
    <script src="../assets/js/table-treeview.js" type="text/javascript"></script>
    
    <!-- Chart Custom JavaScript -->
    <script src="../assets/js/customizer.js" type="text/javascript"></script>
    
    <!-- Chart Custom JavaScript -->
    <script async src="../assets/js/chart-custom.js" type="text/javascript"></script>
    
    <!-- app JavaScript -->
    <script src="../assets/js/app.js" type="text/javascript"></script>
    
    <!-- Custom JavaScript for Image Preview -->
    <script type="text/javascript">
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewImage').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

</body>
</html>