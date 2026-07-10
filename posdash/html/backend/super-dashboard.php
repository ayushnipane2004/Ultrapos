

<?php
include 'super-session.php';
?>

<!doctype html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>UltraPOS | SUPER-ADMIN</title>
      
      <!-- Favicon -->
      <link rel="shortcut icon" href="https://templates.iqonic.design/posdash/html/assets/images/favicon.ico" />
      <link rel="stylesheet" href="../assets/css/backend-plugin.min.css">
      <link rel="stylesheet" href="../assets/css/backende209.css?v=1.0.0">
      <link rel="stylesheet" href="../assets/vendor/%40fortawesome/fontawesome-free/css/all.min.css">
      <link rel="stylesheet" href="../assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css">
      <link rel="stylesheet" href="../assets/vendor/remixicon/fonts/remixicon.css">  </head>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <body class="  ">
    <!-- loader Start -->
    <div id="loading">
          <div id="loading-center">
          </div>
    </div>
    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper">
      
   
      
      <?php include 'super-header.php' ?>
      
      
      
      
      <div class="content-page">
     <div class="container-fluid">
        <div class="row">
<?php
date_default_timezone_set("Asia/Kolkata");

$hour = date("H");

if ($hour >= 5 && $hour < 12) {
    $greeting = "Good Morning";
} elseif ($hour >= 12 && $hour < 17) {
    $greeting = "Good Afternoon";
} elseif ($hour >= 17 && $hour < 21) {
    $greeting = "Good Evening";
} else {
    $greeting = "Good Night";
}
?>



<?php
date_default_timezone_set("Asia/Kolkata");

$username = isset($_SESSION['full_name']) ? $_SESSION['full_name'] : "Super Admin";
?>

<div class="col-lg-12 mt-3">
    <div class="card shadow-sm border-left-primary">
        <div class="card-body">

            <div class="row align-items-center">

                <div class="col-md-3 text-center border-right">

<i class="ri-user-3-fill text-primary" style="font-size:42px;"></i>
                    <h5 class="mt-2 mb-0">
                        Welcome,
                    </h5>
                    <h4 class="text-primary mb-0">
                        <?php echo $username; ?>
                    </h4>
                </div>

                <div class="col-md-3 text-center border-right">

<i class="ri-calendar-2-fill text-success" style="font-size:40px;"></i>
                    <h6 class="mt-2 mb-1">Today's Date</h6>
                    <h5 id="todayDate"></h5>
                </div>

                <div class="col-md-3 text-center border-right">

<i class="ri-time-fill text-warning" style="font-size:40px;"></i>

                    <h6 class="mt-2 mb-1">Current Time</h6>
                    <h5 id="liveClock"></h5>
                </div>

                <div class="col-md-3 text-center">

<i class="ri-calendar-event-fill text-info" style="font-size:40px;"></i>
                    <h6 class="mt-2 mb-1">Today</h6>
                    <h5 id="todayDay"></h5>
                </div>

            </div>

        </div>
    </div>
</div>





<div class="col-lg-4">
    <div class="card card-transparent card-block card-stretch card-height border-none">
        <div class="card-body p-0 mt-lg-2 mt-0">

           <h3 class="mb-3">
    Hi Ultronyc,
    <?php echo $greeting; ?>
</h3>

            <p class="mb-0 mr-4">
                Your dashboard gives you views of key performance or business process.
            </p>

        </div>
    </div>
</div>





            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4 card-total-sale">
                                    <div class="icon iq-icon-box-2 bg-info-light">
                                        <img src="../assets/images/product/1.png" class="img-fluid" alt="image">
                                    </div>
                                    <div>
                                        <p class="mb-2">Total Sales</p>
                                        <h4>31.50</h4>
                                    </div>
                                </div>                                
                                <div class="iq-progress-bar mt-2">
                                    <span class="bg-info iq-progress progress-1" data-percent="85">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4 card-total-sale">
                                    <div class="icon iq-icon-box-2 bg-danger-light">
                                        <img src="../assets/images/product/2.png" class="img-fluid" alt="image">
                                    </div>
                                    <div>
                                        <p class="mb-2">Total Cost</p>
                                        <h4>₹ 4598</h4>
                                    </div>
                                </div>
                                <div class="iq-progress-bar mt-2">
                                    <span class="bg-danger iq-progress progress-1" data-percent="70">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4 card-total-sale">
                                    <div class="icon iq-icon-box-2 bg-success-light">
                                        <img src="../assets/images/product/3.png" class="img-fluid" alt="image">
                                    </div>
                                    <div>
                                        <p class="mb-2">Product Sold</p>
                                        <h4>4589 M</h4>
                                    </div>
                                </div>
                                <div class="iq-progress-bar mt-2">
                                    <span class="bg-success iq-progress progress-1" data-percent="75">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>









            <div class="col-lg-6">
                <div class="card card-block card-stretch card-height">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Overview</h4>
                        </div>                        
                        <div class="card-header-toolbar d-flex align-items-center">
                            <div class="dropdown">
                                <span class="dropdown-toggle dropdown-bg btn" id="dropdownMenuButton001"
                                    data-toggle="dropdown">
                                    This Month<i class="ri-arrow-down-s-line ml-1"></i>
                                </span>
                                <div class="dropdown-menu dropdown-menu-right shadow-none"
                                    aria-labelledby="dropdownMenuButton001">
                                    <a class="dropdown-item" href="#">Year</a>
                                    <a class="dropdown-item" href="#">Month</a>
                                    <a class="dropdown-item" href="#">Week</a>
                                </div>
                            </div>
                        </div>
                    </div>                    
                    <div class="card-body">
                        <div id="layout1-chart1"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card card-block card-stretch card-height">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Revenue Vs Cost</h4>
                        </div>
                        <div class="card-header-toolbar d-flex align-items-center">
                            <div class="dropdown">
                                <span class="dropdown-toggle dropdown-bg btn" id="dropdownMenuButton002"
                                    data-toggle="dropdown">
                                    This Month<i class="ri-arrow-down-s-line ml-1"></i>
                                </span>
                                <div class="dropdown-menu dropdown-menu-right shadow-none"
                                    aria-labelledby="dropdownMenuButton002">
                                    <a class="dropdown-item" href="#">Yearly</a>
                                    <a class="dropdown-item" href="#">Monthly</a>
                                    <a class="dropdown-item" href="#">Weekly</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="layout1-chart-2" style="min-height: 360px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card card-block card-stretch card-height">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Top Products</h4>
                        </div>
                        <div class="card-header-toolbar d-flex align-items-center">
                            <div class="dropdown">
                                <span class="dropdown-toggle dropdown-bg btn" id="dropdownMenuButton006"
                                    data-toggle="dropdown">
                                    This Month<i class="ri-arrow-down-s-line ml-1"></i>
                                </span>
                                <div class="dropdown-menu dropdown-menu-right shadow-none"
                                    aria-labelledby="dropdownMenuButton006">
                                    <a class="dropdown-item" href="#">Year</a>
                                    <a class="dropdown-item" href="#">Month</a>
                                    <a class="dropdown-item" href="#">Week</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled row top-product mb-0">
                            <li class="col-lg-3">
                                <div class="card card-block card-stretch card-height mb-0">
                                    <div class="card-body">
                                        <div class="bg-warning-light rounded">
                                            <img src="../assets/images/product/01.png" class="style-img img-fluid m-auto p-3" alt="image">
                                        </div>
                                        <div class="style-text text-left mt-3">
                                            <h5 class="mb-1">Organic Cream</h5>
                                            <p class="mb-0">789 Item</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="col-lg-3">
                                <div class="card card-block card-stretch card-height mb-0">
                                    <div class="card-body">
                                        <div class="bg-danger-light rounded">
                                            <img src="../assets/images/product/02.png" class="style-img img-fluid m-auto p-3" alt="image">
                                        </div>
                                        <div class="style-text text-left mt-3">
                                            <h5 class="mb-1">Rain Umbrella</h5>
                                            <p class="mb-0">657 Item</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="col-lg-3">
                                <div class="card card-block card-stretch card-height mb-0">
                                    <div class="card-body">
                                        <div class="bg-info-light rounded">
                                            <img src="../assets/images/product/03.png" class="style-img img-fluid m-auto p-3" alt="image">
                                        </div>
                                        <div class="style-text text-left mt-3">
                                            <h5 class="mb-1">Serum Bottle</h5>
                                            <p class="mb-0">489 Item</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="col-lg-3">
                                <div class="card card-block card-stretch card-height mb-0">
                                    <div class="card-body">
                                        <div class="bg-success-light rounded">
                                            <img src="../assets/images/product/02.png" class="style-img img-fluid m-auto p-3" alt="image">
                                        </div>
                                        <div class="style-text text-left mt-3">
                                            <h5 class="mb-1">Organic Cream</h5>
                                            <p class="mb-0">468 Item</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">  
                <div class="card card-transparent card-block card-stretch mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between p-0">
                        <div class="header-title">
                            <h4 class="card-title mb-0">Best Item All Time</h4>
                        </div>
                        <div class="card-header-toolbar d-flex align-items-center">
                            <div><a href="#" class="btn btn-primary view-btn font-size-14">View All</a></div>
                        </div>
                    </div>
                </div>
                <div class="card card-block card-stretch card-height-helf">
                    <div class="card-body card-item-right">
                        <div class="d-flex align-items-top">
                            <div class="bg-warning-light rounded">
                                <img src="../assets/images/product/04.png" class="style-img img-fluid m-auto" alt="image">
                            </div>
                            <div class="style-text text-left">
                                <h5 class="mb-2">Coffee Beans Packet</h5>
                                <p class="mb-2">Total Sell : 45897</p>
                                <p class="mb-0">Total Earned : $45,89 M</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-block card-stretch card-height-helf">
                    <div class="card-body card-item-right">
                        <div class="d-flex align-items-top">
                            <div class="bg-danger-light rounded">
                                <img src="../assets/images/product/05.png" class="style-img img-fluid m-auto" alt="image">
                            </div>
                            <div class="style-text text-left">
                                <h5 class="mb-2">Bottle Cup Set</h5>
                                <p class="mb-2">Total Sell : 44359</p>
                                <p class="mb-0">Total Earned : $45,50 M</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
            <div class="col-lg-4">  
                <div class="card card-block card-stretch card-height-helf">
                    <div class="card-body">
                        <div class="d-flex align-items-top justify-content-between">
                            <div class="">
                                <p class="mb-0">Income</p>
                                <h5>$ 98,7800 K</h5>
                            </div>
                            <div class="card-header-toolbar d-flex align-items-center">
                                <div class="dropdown">
                                    <span class="dropdown-toggle dropdown-bg btn" id="dropdownMenuButton003"
                                        data-toggle="dropdown">
                                        This Month<i class="ri-arrow-down-s-line ml-1"></i>
                                    </span>
                                    <div class="dropdown-menu dropdown-menu-right shadow-none"
                                        aria-labelledby="dropdownMenuButton003">
                                        <a class="dropdown-item" href="#">Year</a>
                                        <a class="dropdown-item" href="#">Month</a>
                                        <a class="dropdown-item" href="#">Week</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="layout1-chart-3" class="layout-chart-1"></div>
                    </div>
                </div>
                <div class="card card-block card-stretch card-height-helf">
                    <div class="card-body">
                        <div class="d-flex align-items-top justify-content-between">
                            <div class="">
                                <p class="mb-0">Expenses</p>
                                <h5>$ 45,8956 K</h5>
                            </div>
                            <div class="card-header-toolbar d-flex align-items-center">
                                <div class="dropdown">
                                    <span class="dropdown-toggle dropdown-bg btn" id="dropdownMenuButton004"
                                        data-toggle="dropdown">
                                        This Month<i class="ri-arrow-down-s-line ml-1"></i>
                                    </span>
                                    <div class="dropdown-menu dropdown-menu-right shadow-none"
                                        aria-labelledby="dropdownMenuButton004">
                                        <a class="dropdown-item" href="#">Year</a>
                                        <a class="dropdown-item" href="#">Month</a>
                                        <a class="dropdown-item" href="#">Week</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="layout1-chart-4" class="layout-chart-2"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">  
                <div class="card card-block card-stretch card-height">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Order Summary</h4>
                        </div>                        
                        <div class="card-header-toolbar d-flex align-items-center">
                            <div class="dropdown">
                                <span class="dropdown-toggle dropdown-bg btn" id="dropdownMenuButton005"
                                    data-toggle="dropdown">
                                    This Month<i class="ri-arrow-down-s-line ml-1"></i>
                                </span>
                                <div class="dropdown-menu dropdown-menu-right shadow-none"
                                    aria-labelledby="dropdownMenuButton005">
                                    <a class="dropdown-item" href="#">Year</a>
                                    <a class="dropdown-item" href="#">Month</a>
                                    <a class="dropdown-item" href="#">Week</a>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="card-body">
                        <div class="d-flex flex-wrap align-items-center mt-2">
                            <div class="d-flex align-items-center progress-order-left">
                                <div class="progress progress-round m-0 orange conversation-bar" data-percent="46">
                                    <span class="progress-left">
                                        <span class="progress-bar"></span>
                                    </span>
                                    <span class="progress-right">
                                        <span class="progress-bar"></span>
                                    </span>
                                    <div class="progress-value text-secondary">46%</div>
                                </div>
                                <div class="progress-value ml-3 pr-5 border-right">
                                    <h5>$12,6598</h5>
                                    <p class="mb-0">Average Orders</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center ml-5 progress-order-right">
                                <div class="progress progress-round m-0 primary conversation-bar" data-percent="46">
                                    <span class="progress-left">
                                        <span class="progress-bar"></span>
                                    </span>
                                    <span class="progress-right">
                                        <span class="progress-bar"></span>
                                    </span>
                                    <div class="progress-value text-primary">46%</div>
                                </div>
                                <div class="progress-value ml-3">
                                    <h5>$59,8478</h5>
                                    <p class="mb-0">Top Orders</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div id="layout1-chart-5"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page end  -->
    </div>
      </div>
    </div>


    <script>
function updateClock(){

    const now = new Date();

    const optionsDate = {
        day:'2-digit',
        month:'long',
        year:'numeric'
    };

    const optionsDay = {
        weekday:'long'
    };

    document.getElementById("todayDate").innerHTML =
        now.toLocaleDateString('en-IN', optionsDate);

    document.getElementById("todayDay").innerHTML =
        now.toLocaleDateString('en-IN', optionsDay);

    document.getElementById("liveClock").innerHTML =
        now.toLocaleTimeString('en-IN');
}

updateClock();

setInterval(updateClock,1000);
</script>
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
                            <span class="mr-1"><script type="58d53e6b89a173d34bd08a2c-text/javascript">document.write(new Date().getFullYear())</script>©</span> <a href="#" class="">POS Dash</a>.
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

<!-- Mirrored from templates.iqonic.design/posdash/html/backend/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 29 Jun 2026 09:56:22 GMT -->
</html>