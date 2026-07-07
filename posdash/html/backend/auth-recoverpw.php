<?php
session_start();

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'ultrapos'; 

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../assets/vendor/PHPMailer/src/Exception.php';
require '../assets/vendor/PHPMailer/src/PHPMailer.php';
require '../assets/vendor/PHPMailer/src/SMTP.php';

$showOtp = false;
$showPassword = false;
$hideEmailAndGenerate = false;
$email = '';

if (isset($_POST['generateotp'])) {
    $email = trim($_POST['email']);
    
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    
    if (mysqli_num_rows($check) == 0) {
        echo "<script>alert('Email Not Found');</script>";
    } else {
        $otp = rand(100000, 999999);
        
        $_SESSION['otp'] = $otp;
        $_SESSION['email'] = $email;
        $_SESSION['otp_time'] = time();
        
        $mail = new PHPMailer(true);
        
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'ayushhnipane@gmail.com';
            $mail->Password = 'vzoq jcra glkp fybw';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            
            $mail->setFrom('ayushhnipane@gmail.com', 'POS Dashboard');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = "Password Reset OTP";
            $mail->Body = "
            <h2>Your OTP</h2>
            <h1>$otp</h1>
            <p>This OTP is valid for 5 minutes.</p>
            ";
            
            $mail->send();
            
            $showOtp = true;
            $hideEmailAndGenerate = true;
            echo "<script>alert('OTP Sent Successfully');</script>";
        } catch (Exception $e) {
            echo "<script>alert('" . $mail->ErrorInfo . "');</script>";
        }
    }
}

if (isset($_POST['verifyotp'])) {
    $userotp = trim($_POST['otp']);
    
    if (!isset($_SESSION['otp'])) {
        echo "<script>alert('Please generate OTP first');</script>";
        $showOtp = false;
        $hideEmailAndGenerate = false;
    } else {
        if (time() - $_SESSION['otp_time'] > 300) {
            echo "<script>alert('OTP Expired. Please generate new OTP.');</script>";
            session_destroy();
            session_start(); 
            $showOtp = false;
            $hideEmailAndGenerate = false;
        } else {
            if ($userotp == $_SESSION['otp']) {
                $showPassword = true;
                $showOtp = false;
                $hideEmailAndGenerate = true; 
                echo "<script>alert('OTP Verified Successfully');</script>";
                
                unset($_SESSION['otp']);
            } else {
                $showOtp = true;
                $hideEmailAndGenerate = true;
                echo "<script>alert('Invalid OTP');</script>";
            }
        }
    }
}


if (isset($_POST['updatepassword'])) {

    $new_password = trim($_POST['new_password']);
    

    $confirm_password = trim($_POST['confirm_password']);


    
    if ($new_password != $confirm_password) {
        $showPassword = true;
        $showOtp = false;
        $hideEmailAndGenerate = true;
        echo "<script>alert('Password and Confirm Password do not match');</script>";
    } else {
        $email = $_SESSION['email'];
                    $new_password = password_hash($new_password, PASSWORD_DEFAULT);

        $update = mysqli_query($conn, "UPDATE users SET password='$new_password' WHERE email='$email'");
        
        if ($update) {
            session_destroy();
            echo "<script>
            alert('Password Updated Successfully');
            window.location='../../../index.php';
            </script>";
        } else {
            $showPassword = true;
            $showOtp = false;
            $hideEmailAndGenerate = true;
            echo "<script>alert('Password Update Failed');</script>";
        }
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
    <link rel="stylesheet" href="../assets/vendor/remixicon/fonts/remixicon.css">  
</head>
<body class=" ">
    <div class="wrapper">
        <section class="login-content">
            <div class="container">
                <div class="row align-items-center justify-content-center height-self-center">
                    <div class="col-lg-8">
                        <div class="card auth-card">
                            <div class="card-body p-0">
                                <div class="d-flex align-items-center auth-content">
                                    <div class="col-lg-7 align-self-center">
                                        <div class="p-3">
                                            <h2 class="mb-2">Reset Password</h2>
                                            <p>Enter your email address and we'll send you an email with instructions to reset your password.</p>
                                            
                                            <form method="post">
                                                <!-- Email - Hidden after Generate OTP -->
                                                <div class="row" <?php echo ($hideEmailAndGenerate) ? "style='display:none;'" : ''; ?>>
                                                    <div class="col-lg-12">
                                                        <div class="floating-label form-group">
                                                            <input class="floating-input form-control"
                                                                   type="email"
                                                                   placeholder=" "
                                                                   id="email"
                                                                   name="email"
                                                                   value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>"
                                                                   <?php echo (!$hideEmailAndGenerate) ? 'required' : ''; ?>>
                                                            <label>Email</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- OTP Field - Visible only after Generate OTP -->
                                                <div class="row" id="otpDiv" <?php echo ($showOtp) ? '' : "style='display:none;'"; ?>>
                                                    <div class="col-lg-12">
                                                        <div class="floating-label form-group">
                                                            <input class="floating-input form-control"
                                                                   type="text"
                                                                   placeholder=" "
                                                                   name="otp"
                                                                   <?php echo ($showOtp) ? 'required' : ''; ?>>
                                                            <label>Enter OTP</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Buttons Row -->
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <!-- Generate OTP Button - Hidden after Generate OTP -->
                                                        <button type="submit" 
                                                                name="generateotp" 
                                                                class="btn btn-primary btn-block"
                                                                <?php echo ($hideEmailAndGenerate) ? "style='display:none;'" : ''; ?>>
                                                            Generate OTP
                                                        </button>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <!-- Verify OTP Button - Visible only after Generate OTP -->
                                                        <button type="submit" 
                                                                name="verifyotp" 
                                                                class="btn btn-warning btn-block"
                                                                <?php echo ($showOtp) ? '' : "style='display:none;'"; ?>>
                                                            Verify OTP
                                                        </button>
                                                    </div>
                                                </div>










                                                <!-- Password Fields - Visible only after OTP Verification -->
                                                <div id="passwordDiv" <?php echo ($showPassword) ? '' : "style='display:none;'"; ?>>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="floating-label form-group">
                                                                <input type="password"
                                                                       class="floating-input form-control"
                                                                       placeholder=" "
                                                                       name="new_password"
                                                                       <?php echo ($showPassword) ? 'required' : ''; ?>>
                                                                <label>New Password</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="floating-label form-group">
                                                                <input type="password"
                                                                       class="floating-input form-control"
                                                                       placeholder=" "
                                                                       name="confirm_password"
                                                                       <?php echo ($showPassword) ? 'required' : ''; ?>>
                                                                <label>Confirm Password</label>
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <div class="custom-control custom-checkbox mb-3"> 
                                                        <input type="checkbox" class="custom-control-input" id="customCheck1" required>
                                                         <label class="custom-control-label control-label-1" for="customCheck1">Remember Me</label>
                                                         </div>
                                                    
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <button type="submit" name="updatepassword" class="btn btn-success btn-block">
                                                                Update Password
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 content-right">
                                        <img src="../assets/images/login/01.html" class="img-fluid image-right" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

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
</body>
</html>