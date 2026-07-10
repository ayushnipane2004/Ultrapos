<!doctype html> 
<html lang="en"> 
<head> 
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
    <title>UltraPOS</title> 
    <!-- Favicon --> 
    <link rel="stylesheet" href="posdash/html/assets/css/backend-plugin.min.css"> 
    <link rel="stylesheet" href="posdash/html/assets/css/backende209.css?v=1.0.0"> 
    <link rel="stylesheet" href="posdash/html/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css"> 
    <link rel="stylesheet" href="posdash/html/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css"> 
    <link rel="stylesheet" href="posdash/html/assets/vendor/remixicon/fonts/remixicon.css"> 
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">


</head> 
<body class=" "> 

<?php
session_start();

include 'posdash/html/backend/db.php';

if(isset($_POST['login']))
{
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    /* ================= SUPER ADMIN LOGIN ================= */

    if($email == "superadmin@gmail.com")
    {
        if($password == "super@123")
        {
            $_SESSION['superadmin'] = true;

            header("Location: posdash/html/backend/super-dashboard.php");
            exit;
        }
        else
        {
            echo "
            <script>
            Swal.fire({
                icon: 'error',
                title: 'Invalid Password',
                text: 'The password you entered is incorrect.',
                confirmButtonColor: '#32bdea'
            }).then(() => {
                window.location='index.php';
            });
            </script>";
            exit;
        }
    }


    $sql = mysqli_query($conn,"
        SELECT *
        FROM users
        WHERE email='$email'
    ");

    if(mysqli_num_rows($sql) > 0)
    {
        $row = mysqli_fetch_assoc($sql);

        if(password_verify($password, $row['password']))
        {
            $_SESSION['user_id']       = $row['id'];
            $_SESSION['full_name']     = $row['full_name'];
            $_SESSION['user_name']     = $row['username'];
            $_SESSION['email']         = $row['email'];
            $_SESSION['company_id']    = $row['company_id'];
            $_SESSION['role_id']       = $row['role_id'];
            $_SESSION['branch_id']     = $row['branch_id'];
            $_SESSION['profile_photo'] = $row['profile_photo'];

            $user_id      = $row['id'];
            $user_name    = $row['username'];
            $ip_address   = $_SERVER['REMOTE_ADDR'];
            $user_agent   = $_SERVER['HTTP_USER_AGENT'];
            $login_status = "Success";


$company_id = $row['company_id'];

$company = mysqli_query($conn,"
SELECT company_logo
FROM company_master
WHERE id='$company_id'
");


$companyRow = mysqli_fetch_assoc($company);

$_SESSION['company_logo'] = $companyRow['company_logo'];





            mysqli_query($conn,"
                INSERT INTO login
                (
                    user_id,
                    user_name,
                    ip_address,
                    user_agent,
                    login_status,
                    latitude,
                    longitude
                )
                VALUES
                (
                    '$user_id',
                    '$user_name',
                    '$ip_address',
                    '$user_agent',
                    '$login_status',
                    '$latitude',
                    '$longitude'
                )
            ");

echo "
<script>
Swal.fire({
    icon: 'success',
    title: '<span style=\"font-size:28px;color:#28a745;\">Welcome to UltraPOS</span>',
    html: `
        <div style='padding:10px;'>

            <h3 style='margin-bottom:10px;color:#007bff;'>
                👋 Welcome, ".$row['full_name']."
            </h3>

            <p style='font-size:16px;color:#555;margin-bottom:15px;'>
                Login Successful!
            </p>

            <div style='
                background:#f8f9fa;
                border-radius:10px;
                padding:12px;
                border-left:5px solid #32bdea;
                text-align:left;
            '>

                <p style='margin:0;'>
                    <b>🕒 Login Time:</b><br>
                    ".date('d M Y, h:i A')."
                </p>

            </div>

            <br>

            <p style='color:#28a745;font-size:15px;margin:0;'>
                Have a productive day! 🚀
            </p>

        </div>
    `,
    confirmButtonText: 'Continue to Dashboard',
    confirmButtonColor: '#32bdea',
    allowOutsideClick: false,
    allowEscapeKey: false,
    backdrop: 'rgba(0,0,0,0.55)',
    showClass: {
        popup: 'animate__animated animate__zoomIn'
    },
    hideClass: {
        popup: 'animate__animated animate__zoomOut'
    }
}).then(() => {

    window.location='posdash/html/backend/dashboard.php';

});
</script>";
exit;

        }
        else
        {
            echo "
            <script>
            Swal.fire({
                icon: 'error',
                title: 'Invalid Password',
                text: 'The password you entered is incorrect.',
                confirmButtonColor: '#32bdea'
            }).then(() => {
                window.location='index.php';
            });
            </script>";
            exit;
        }
    }
    else
    {
        if(empty($email) && empty($password))
        {
            $title = "Login Required";
            $text  = "Please enter your email and password.";
        }
        elseif(empty($email))
        {
            $title = "Invalid Email";
            $text  = "Please enter your email address.";
        }
        elseif(empty($password))
        {
            $title = "Invalid Password";
            $text  = "Please enter your password.";
        }
        else
        {
            $title = "Invalid Email & Password";
            $text  = "The email and password you entered are incorrect.";
        }

        echo "
        <script>
        Swal.fire({
            icon: 'error',
            title: '$title',
            text: '$text',
            confirmButtonColor: '#32bdea'
        }).then(() => {
            window.location='index.php';
        });
        </script>";
        exit;
    }
}
?>




<div class="wrapper"> 
    <section class="login-content"> 
        <div class="container"> 
            <div class="row align-items-center justify-content-center height-self-center"> 
                <div class="col-lg-8"> 
                    <div class="card auth-card"> 
                        <div class="card-body p-0"> 
<div class="row no-gutters align-items-center auth-content w-100">   
    

                                <div class="col-lg-7 align-self-center order-lg-1 order-2"> 
                                    <div class="p-3"> 
                                        <h2 class="mb-2">Sign In</h2> 
                                        <p>Login to stay connected.</p> 

                                        <form method="post"> 


                                            <div class="row"> 


                                                <div class="col-lg-12"> 
                                                    <div class="floating-label form-group"> 

                                                        <input class="floating-input form-control" type="text" placeholder=" " name="email"> 
                                                        <label>Email</label> 
                                                    </div> 
                                                </div> 



   <div class="col-lg-12">
    <div class="floating-label form-group position-relative">

        <input
            class="floating-input form-control pr-5"
            type="password"
            id="password"
            name="password"
            placeholder=" ">

        <label>Password</label>

        <span id="togglePassword"
              style="position:absolute; right:15px; top:50%; transform:translateY(-50%); cursor:pointer; z-index:1000;">
            <i class="fas fa-eye"></i>
        </span>

    </div>
</div>





                                                <div class="col-lg-6"> 
                                                    
                                                </div> 
                                                <div class="col-lg-6"> 
                                                    <a href="posdash/html/backend/auth-recoverpw.php" class="text-primary float-right">Forgot Password?</a> 
                                                </div> 
                                            </div> 
                                            <input type="hidden" name="latitude" id="latitude"> 
                                            <input type="hidden" name="longitude" id="longitude"> 
                                            <button type="submit" class="btn btn-primary" name="login">Sign In</button> 
                                           
                                        </form> 
                                    </div> 
                                </div> 

<div class="col-12 col-lg-5 text-center align-self-center order-1 order-lg-2"> 
    

<div class="p-3">
        <img src="posdash/html/assets/main-images/logo/Ultrapos_logo.png"
             alt="UltraPOS Logo"
             class="img-fluid"
             style="max-width:180px;">


        <p class="text-muted mb-0">
            Smart POS. Smart Business.
        </p>
    </div>
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
<script src="posdash/html/assets/js/backend-bundle.min.js"></script> 
<script src="posdash/html/assets/js/table-treeview.js"></script> 
<script src="posdash/html/assets/js/customizer.js"></script> 
<script src="posdash/html/assets/js/chart-custom.js"></script> 
<script src="posdash/html/assets/js/app.js"></script> 

<script>
if(localStorage.getItem("logout_success"))
{
    localStorage.removeItem("logout_success");

    Swal.fire({
        icon: "success",
        title: "Signed Out!",
        text: "You have been signed out successfully.",
        timer: 1900,
        showConfirmButton: false
    });
}
</script>



<script>
const togglePassword = document.getElementById("togglePassword");
const password = document.getElementById("password");

togglePassword.addEventListener("click", function () {

    const type = password.getAttribute("type") === "password" ? "text" : "password";

    password.setAttribute("type", type);

    const icon = this.querySelector("i");

    if(type === "text"){
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    }else{
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }

});
</script>



<script> 
    if (navigator.geolocation) { 
        navigator.geolocation.getCurrentPosition(function(position) { 
            document.getElementById("latitude").value = position.coords.latitude; 
            document.getElementById("longitude").value = position.coords.longitude; 
        }, function(error) { 
            alert("Please allow location permission."); 
        }); 
    } 
</script> 

</body> 
</html>