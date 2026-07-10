

<!doctype html>
<html lang="en">
  
<!-- Mirrored from templates.iqonic.design/posdash/html/backend/page-list-category.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 29 Jun 2026 09:56:40 GMT -->
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
      <link rel="stylesheet" href="../assets/vendor/remixicon/fonts/remixicon.css">  </head>
  <body class="  ">
    <!-- loader Start -->
 

 <div class="wrapper">


<?php

include 'super-header.php';
include 'db.php';



if(!isset($_GET['id']) || empty($_GET['id']))
{
    header("Location: page-list-company.php");
    exit();
}

$id = intval($_GET['id']);



$sql = mysqli_query($conn,"
SELECT *
FROM company_master
WHERE id='$id'
AND delete_flag='1'
");

if(mysqli_num_rows($sql)==0)
{
    header("Location: page-list-company.php");
    exit();
}

$row = mysqli_fetch_assoc($sql);

?>


<div class="content-page">

<div class="container-fluid">

<div class="row">

<div class="col-lg-12">

<div class="d-flex align-items-center justify-content-between mb-4">

<div>

<h4 class="mb-2">

View Company

</h4>

<p class="mb-0">

View complete company information.

</p>

</div>

<div>



<a href="page-edit-company.php?id=<?php echo $row['id'];?>"
class="btn btn-primary">

<i class="ri-pencil-line"></i>

Edit Company

</a>

</div>

</div>

</div>

</div>






<div class="row">

    <!-- Company Profile -->

    <div class="col-lg-4">

        <div class="card">

            <div class="card-body text-center">

                <?php
                if(!empty($row['company_logo']))
                {
                ?>

                <img src="../assets/documents/<?php echo $row['company_logo'];?>"
                     class="img-fluid rounded mb-3"
                     style="width:140px;height:140px;object-fit:cover;">

                <?php
                }
                else
                {
                ?>

                <img src="../assets/images/user/1.png"
                     class="img-fluid rounded mb-3"
                     style="width:140px;height:140px;object-fit:cover;">

                <?php
                }
                ?>

                <h4 class="mb-2">

                    <?php echo $row['company_name']; ?>

                </h4>

                <?php

                if($row['status']=="Active")
                {
                    echo "<span class='badge badge-success'>Active</span>";
                }
                else
                {
                    echo "<span class='badge badge-danger'>Inactive</span>";
                }

                ?>

                <hr>

                <p class="mb-2">

                    <strong>Business Type :</strong>

                    <?php echo $row['businesstype']; ?>

                </p>

                <p class="mb-2">

                    <strong>GST No :</strong>

                    <?php echo $row['gst_no']; ?>

                </p>

                <p class="mb-2">

                    <strong>Currency :</strong>

                    <?php echo $row['currency']; ?>

                </p>

                <p class="mb-0">

                    <strong>Financial Year :</strong>

                    <?php echo $row['financial_year']; ?>

                </p>

            </div>

        </div>

    </div>



    <!-- Company Information -->

    <div class="col-lg-8">

        <div class="card">

            <div class="card-header">

                <h4 class="card-title">

                    Company Information

                </h4>

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label><strong>Company Name</strong></label>

                        <p><?php echo $row['company_name']; ?></p>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label><strong>Email</strong></label>

                        <p><?php echo $row['email']; ?></p>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label><strong>Mobile</strong></label>

                        <p><?php echo $row['mobile']; ?></p>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label><strong>Website</strong></label>

                        <p><?php echo $row['website']; ?></p>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label><strong>Username</strong></label>

                        <p><?php echo $row['username']; ?></p>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label><strong>Created Date</strong></label>

                        <p>

                            <?php echo date("d-m-Y",strtotime($row['created_at'])); ?>

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>





<div class="row">

    <!-- Owner Profile -->

    <div class="col-lg-4">

        <div class="card">

            <div class="card-body text-center">

                <?php
                if(!empty($row['company_ownerimg']))
                {
                ?>

                <img src="../assets/ownerimage/<?php echo $row['company_ownerimg'];?>"
                     class="rounded-circle mb-3"
                     style="width:150px;height:150px;object-fit:cover;">

                <?php
                }
                else
                {
                ?>

                <img src="../assets/images/user/1.png"
                     class="rounded-circle mb-3"
                     style="width:150px;height:150px;object-fit:cover;">

                <?php
                }
                ?>

                <h4>

                    <?php echo $row['ownername']; ?>

                </h4>

                <span class="badge badge-primary">

                    Company Owner

                </span>

            </div>

        </div>

    </div>



    <!-- Owner Details -->

    <div class="col-lg-8">

        <div class="card">

            <div class="card-header">

                <h4 class="card-title">

                    Owner Information

                </h4>

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label><strong>Owner Name</strong></label>

                        <p>

                            <?php echo $row['ownername']; ?>

                        </p>

                    </div>



                    <div class="col-md-6 mb-3">

                        <label><strong>Contact Person</strong></label>

                        <p>

                            <?php echo $row['contactpersonname']; ?>

                        </p>

                    </div>



                    <div class="col-md-6 mb-3">

                        <label><strong>Contact Mobile</strong></label>

                        <p>

                            <?php echo $row['contactmob']; ?>

                        </p>

                    </div>



                    <div class="col-md-6 mb-3">

                        <label><strong>Alternate Mobile</strong></label>

                        <p>

                            <?php echo $row['alternatemob']; ?>

                        </p>

                    </div>



                    <div class="col-md-6 mb-3">

                        <label><strong>Contact Email</strong></label>

                        <p>

                            <?php echo $row['contactpersonemail']; ?>

                        </p>

                    </div>



                    <div class="col-md-6 mb-3">

                        <label><strong>Website</strong></label>

                        <p>

                            <a href="<?php echo $row['website']; ?>"
                               target="_blank">

                                <?php echo $row['website']; ?>

                            </a>

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>





<div class="row">

    <!-- Address Information -->

    <div class="col-lg-6">

        <div class="card">

            <div class="card-header">

                <h4 class="card-title">
                    Address Information
                </h4>

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-12 mb-3">

                        <label><strong>Address</strong></label>

                        <p>

                            <?php echo !empty($row['address']) ? nl2br(htmlspecialchars($row['address'])) : "-"; ?>

                        </p>

                    </div>

                    <div class="col-md-4 mb-3">

                        <label><strong>City</strong></label>

                        <p>

                            <?php echo $row['city']; ?>

                        </p>

                    </div>

                    <div class="col-md-4 mb-3">

                        <label><strong>State</strong></label>

                        <p>

                            <?php echo $row['state']; ?>

                        </p>

                    </div>

                    <div class="col-md-4 mb-3">

                        <label><strong>Country</strong></label>

                        <p>

                            <?php echo $row['country']; ?>

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>



    <!-- Business Information -->

    <div class="col-lg-6">

        <div class="card">

            <div class="card-header">

                <h4 class="card-title">
                    Business Information
                </h4>

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label><strong>Business Type</strong></label>

                        <p>

                            <?php echo $row['businesstype']; ?>

                        </p>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label><strong>GST Number</strong></label>

                        <p>

                            <?php echo $row['gst_no']; ?>

                        </p>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label><strong>Currency</strong></label>

                        <p>

                            <?php echo $row['currency']; ?>

                        </p>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label><strong>Financial Year</strong></label>

                        <p>

                            <?php echo $row['financial_year']; ?>

                        </p>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label><strong>Status</strong></label>

                        <p>

                            <?php

                            if($row['status']=="Active")
                            {
                                echo "<span class='badge badge-success'>Active</span>";
                            }
                            else
                            {
                                echo "<span class='badge badge-danger'>Inactive</span>";
                            }

                            ?>

                        </p>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label><strong>Created Date</strong></label>

                        <p>

                            <?php echo date("d M Y, h:i A", strtotime($row['created_at'])); ?>

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<!-- Company Summary -->

<div class="row">

    <div class="col-lg-12">

        <div class="card">

            <div class="card-header">

                <h4 class="card-title">

                    Company Summary

                </h4>

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-3 text-center">

                        <h6 class="text-muted">

                            Company Name

                        </h6>

                        <h5>

                            <?php echo $row['company_name']; ?>

                        </h5>

                    </div>

                    <div class="col-md-3 text-center">

                        <h6 class="text-muted">

                            Owner

                        </h6>

                        <h5>

                            <?php echo $row['ownername']; ?>

                        </h5>

                    </div>

                    <div class="col-md-3 text-center">

                        <h6 class="text-muted">

                            Business Type

                        </h6>

                        <h5>

                            <?php echo $row['businesstype']; ?>

                        </h5>

                    </div>

                    <div class="col-md-3 text-center">

                        <h6 class="text-muted">

                            Status

                        </h6>

                        <h5>

                            <?php

                            if($row['status']=="Active")
                            {
                                echo "<span class='badge badge-success'>Active</span>";
                            }
                            else
                            {
                                echo "<span class='badge badge-danger'>Inactive</span>";
                            }

                            ?>

                        </h5>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>



<!-- Action Buttons -->

<div class="row">

    <div class="col-lg-12 text-center mb-4">

        <a href="page-list-company.php"
           class="btn btn-secondary mr-2">

            <i class="ri-arrow-left-line"></i>

            Back

        </a>

        <a href="edit-company.php?id=<?php echo $row['id']; ?>"
           class="btn btn-primary mr-2">

            <i class="ri-pencil-line"></i>

            Edit Company

        </a>

        <button
            class="btn btn-success mr-2"
            onclick="window.print();">

            <i class="ri-printer-line"></i>

            Print

        </button>

       

    </div>

</div>

</div>

</div>

</div>


 <script src="../assets/js/backend-bundle.min.js" type="f0eb494f5a66e80d5968103e-text/javascript"></script>
    
    <!-- Table Treeview JavaScript -->
    <script src="../assets/js/table-treeview.js" type="f0eb494f5a66e80d5968103e-text/javascript"></script>
    
    <!-- Chart Custom JavaScript -->
    <script src="../assets/js/customizer.js" type="f0eb494f5a66e80d5968103e-text/javascript"></script>
    
    <!-- Chart Custom JavaScript -->
    <script async src="../assets/js/chart-custom.js" type="f0eb494f5a66e80d5968103e-text/javascript"></script>
    
    <!-- app JavaScript -->
    <script src="../assets/js/app.js" type="f0eb494f5a66e80d5968103e-text/javascript"></script>
  <script src="../../../cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="f0eb494f5a66e80d5968103e-|49" defer></script><script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'a1340e4e5da3f884',t:'MTc4MjcyNjkyOQ=='};var a=document.createElement('script');a.src='../../../cdn-cgi/challenge-platform/h/b/scripts/jsd/25e6c66701a0/maind41d.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script><script defer src="https://static.cloudflareinsights.com/beacon.min.js/v833ccba57c9e4d2798f2e76cebdd09a11778172276447" integrity="sha512-57MDmcccJXYtNnH+ZiBwzC4jb2rvgVCEokYN+L/nLlmO8rfYT/gIpW2A569iJ/3b+0UEasghjuZH/ma3wIs/EQ==" data-cf-beacon='{"version":"2024.11.0","token":"41ccecab40284244aa0b52f56036ee92","r":1,"server_timing":{"name":{"cfCacheStatus":true,"cfEdge":true,"cfExtPri":true,"cfL4":true,"cfOrigin":true,"cfSpeedBrain":true},"location_startswith":null}}' crossorigin="anonymous"></script>

</body>


</html>