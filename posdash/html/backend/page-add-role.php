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
<?php
include 'db.php';

if(isset($_POST['save_role']))
{
    $company_id = $_SESSION['company_id'];
    $created_by = $_SESSION['user_id'];
    $role_name   = mysqli_real_escape_string($conn, $_POST['role_name']);
    $status      = mysqli_real_escape_string($conn, $_POST['status']);
    $description  = mysqli_real_escape_string($conn, $_POST['description']);
    

    $company = mysqli_query($conn,"
    INSERT INTO role
    (
        company_id,
        role_name,
        description,
        status,
        created_by
        
      

    )
    VALUES
    (
        '$company_id',
        '$role_name',
        '$description',
        '$status',
        '$created_by'
        
        
    )");

    if($company) {
       
        echo "<script>
        alert('Company Registered Successfully');
        window.location='dashboard.php';
        </script>";
    }
    else
    {
        echo "<script>
        alert('Registration Failed');
                window.location='page-add-role.php';

        </script>";
    }
}
?>
    <!-- Wrapper Start -->
<div class="wrapper">
    
      

    <?php include 'header.php' ?>



      
<div class="content-page">
    <div class="container-fluid add-form-list">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Add Role</h4>
                        </div>
                    </div>
                    <div class="card-body">
                      <form method="post">
                            <div class="row">

                                <!-- Company -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Role Name <span class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control"
                                            name="role_name"
                                            placeholder="Enter Role Name"
                                            required>
                                    </div>
                                </div>

                                <!-- Role Name -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control" name="status">
                                            <option value="Active">Active</option>
                                            <option value="Inactive">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Description -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control"
                                                name="description"
                                                rows="4"
                                                placeholder="Enter Description"></textarea>
                                    </div>
                                </div>

                                <!-- Buttons -->
                                <div class="col-md-12">
                                    <button type="submit"
                                            class="btn btn-primary mr-2"
                                            name="save_role">
                                        Save Role
                                    </button>

                                    <button type="reset"
                                            class="btn btn-danger">
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
    <!-- Wrapper End-->
    <footer class="iq-footer" style="margin-left: -13px;">
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

<!-- Mirrored from templates.iqonic.design/posdash/html/backend/page-add-customers.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 29 Jun 2026 09:56:41 GMT -->
</html>