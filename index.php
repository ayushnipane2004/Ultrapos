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
</head> 
<body class=" "> 

<?php
session_start();

include 'posdash/html/backend/db.php';

if(isset($_POST['login']))
{
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    if($email=='superadmin@gmail.com' && $password=='super@123'){
        header("Location:posdash/html/backend/super-dashboard.php");
    }
    else{
        $sql = mysqli_query($conn,"
        SELECT * FROM users
        WHERE email='$email' 
        ");

        if(mysqli_num_rows($sql)>0)
        {
            $row=mysqli_fetch_assoc($sql);

            if(password_verify($password,$row['password']))
            {
                $_SESSION['user_id']=$row['id'];
                $_SESSION['full_name']=$row['full_name'];
                $_SESSION['user_name']=$row['username'];
                $_SESSION['email']=$row['email'];
                $_SESSION['company_id']=$row['company_id'];
                $_SESSION['role_id']=$row['role_id'];
                $_SESSION['branch_id']=$row['branch_id'];
                $_SESSION['profile_photo']=$row['profile_photo'];

                $user_id=$row['id'];
                $full_name=$row['full_name'];
                $user_name=$row['username'];
                $ip_address=$_SERVER['REMOTE_ADDR'];
                $user_agent=$_SERVER['HTTP_USER_AGENT'];
                $login_status="Success";

                mysqli_query($conn,"
                INSERT INTO login
                (user_id,user_name,ip_address,user_agent,login_status,latitude,longitude)
                VALUES
                ('$user_id','$user_name','$ip_address','$user_agent','$login_status','$latitude','$longitude')
                ");

                header("Location:posdash/html/backend/dashboard.php");
                exit;
            }
            else
            {
                echo "<script>
                alert('Invalid Password');
                </script>";
                header("Location:posdash/html/backend/pages-error.html");
            }
        }
        else
        {
            echo "<script>
            alert('Email Not Found');
            </script>";
            header("Location:posdash/html/backend/pages-error.html");
        }
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
                                                    <div class="floating-label form-group"> 
                                                        <input class="floating-input form-control" type="password" placeholder=" " name="password"> 
                                                        <label>Password</label> 
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