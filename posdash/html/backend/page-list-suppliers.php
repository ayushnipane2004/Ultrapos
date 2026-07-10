<?php
include 'db.php';

$result = mysqli_query($conn, "SELECT * FROM supplier ORDER BY id DESC");
?>
<?php
include 'db.php';

/* ---------------- DELETE COMPANY ---------------- */

if(isset($_GET['delete_id']))
{
    $id = intval($_GET['delete_id']);

    $delete = mysqli_query($conn,"
        UPDATE supplier
        SET delete_flag='0'
        WHERE id='$id'
    ");

    if($delete)
    {
        echo "<script>
            alert('Company Deleted Successfully');
            window.location='page-list-suppliers.php';
        </script>";
        exit;
    }
}
?>
<!doctype html>
<html lang="en">
  
<!-- Mirrored from templates.iqonic.design/posdash/html/backend/page-list-suppliers.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 29 Jun 2026 09:56:41 GMT -->
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
    <div id="loading">
          <div id="loading-center">
          </div>
    </div>
    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper">
      
    <?php include 'header.php' ?>
      
      
      
      
      
      
      <div class="content-page">
     <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                    <div>
                        <h4 class="mb-3">Suppliers List</h4>
                        <p class="mb-0">Create and manage your vendor list, send and receive purchase orders – your online<br>
                         Dashboard is your new back of house.</p>
                    </div>
                    <a href="page-add-supplier.php" class="btn btn-primary add-list">+ Add Supplier</a>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="table-responsive rounded mb-3">
                <table class="data-table table mb-0 tbl-server-info">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>
                               
                            </th>
                            <th>
                                Supplier Code
                            </th>
                            <th>Company Name</th>
                            <th>Email</th>
                            <th>Phone No.</th>
                            <th>Address</th>
                            <th>GST No</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                        <?php
                                $i = 1;

                                while($row = mysqli_fetch_assoc($result))
                                {
                                ?>

                                <tr>


                                    <td>
                                        <div class="checkbox d-inline-block">
                                            <input type="checkbox" class="checkbox-input" id="checkbox<?php echo $row['id']; ?>">
                                            <label for="checkbox<?php echo $row['id']; ?>" class="mb-0"></label>
                                        </div>
                                    </td>

                                    <td><?php echo $row['supplier_code']; ?></td>

                                    <td><?php echo $row['supplier_name']; ?></td>

                                    <td><?php echo $row['email']; ?></td>

                                    <td><?php echo $row['phone']; ?></td>

                                    <td><?php echo $row['address']; ?></td>

                                    <td><?php echo $row['opening_balance']; ?></td>

                                    <td>
                                        <?php
                                        if($row['status']=="Active")
                                        {
                                            echo '<span class="badge badge-success">Active</span>';
                                        }
                                        else
                                        {
                                            echo '<span class="badge badge-danger">Inactive</span>';
                                        }
                                        ?>
                                    </td>

                                    

                                    <td>

                                        <div class="d-flex align-items-center list-action">

                                            <a class="badge badge-info mr-2"
                                                href="pratik.php?id=<?php echo $row['id']; ?>">
                                                <i class="ri-eye-line mr-0"></i>
                                            </a>

                                            <a class="badge bg-success mr-2"
                                            href="view-suppliers.php?id=<?php echo $row['id']; ?>">

                                                <i class="ri-pencil-line"></i>

                                            </a>

                                            <a class="badge badge-danger"
                                                href="?delete_id=<?php echo $row['id']; ?>"
                                                onclick="return confirm('Delete this supplier?');">

                                                <i class="ri-delete-bin-line"></i>

                                                </a>

                                                  

                                        </div>

                                    </td>

                                </tr>

                                <?php
                                }
                                ?>

                    </tbody>
                </table>
                </div>
            </div>
        </div>
        <!-- Page end  -->
    </div>
    <!-- Modal Edit -->
    <div class="modal fade" id="edit-note" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="popup text-left">
                        <div class="media align-items-top justify-content-between">                            
                            <h3 class="mb-3">Product</h3>
                            <div class="btn-cancel p-0" data-dismiss="modal"><i class="las la-times"></i></div>
                        </div>
                        <div class="content edit-notes">
                            <div class="card card-transparent card-block card-stretch event-note mb-0">
                                <div class="card-body px-0 bukmark">
                                    <div class="d-flex align-items-center justify-content-between pb-2 mb-3 border-bottom">                                                    
                                        <div class="quill-tool">
                                        </div>
                                    </div>
                                    <div id="quill-toolbar1">
                                        <p>Virtual Digital Marketing Course every week on Monday, Wednesday and Saturday.Virtual Digital Marketing Course every week on Monday</p>
                                    </div>
                                </div>
                                <div class="card-footer border-0">
                                    <div class="d-flex flex-wrap align-items-ceter justify-content-end">
                                        <div class="btn btn-primary mr-3" data-dismiss="modal">Cancel</div>
                                        <div class="btn btn-outline-primary" data-dismiss="modal">Save</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                            <span class="mr-1"><script type="a1705f11300faafd11428e1a-text/javascript">document.write(new Date().getFullYear())</script>©</span> <a href="#" class="">POS Dash</a>.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Backend Bundle JavaScript -->
    <script src="../assets/js/backend-bundle.min.js" type="a1705f11300faafd11428e1a-text/javascript"></script>
    
    <!-- Table Treeview JavaScript -->
    <script src="../assets/js/table-treeview.js" type="a1705f11300faafd11428e1a-text/javascript"></script>
    
    <!-- Chart Custom JavaScript -->
    <script src="../assets/js/customizer.js" type="a1705f11300faafd11428e1a-text/javascript"></script>
    
    <!-- Chart Custom JavaScript -->
    <script async src="../assets/js/chart-custom.js" type="a1705f11300faafd11428e1a-text/javascript"></script>
    
    <!-- app JavaScript -->
    <script src="../assets/js/app.js" type="a1705f11300faafd11428e1a-text/javascript"></script>
  <script src="../../../cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="a1705f11300faafd11428e1a-|49" defer></script><script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'a1340e776e7ece6f',t:'MTc4MjcyNjkzNg=='};var a=document.createElement('script');a.src='../../../cdn-cgi/challenge-platform/h/b/scripts/jsd/25e6c66701a0/maind41d.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script><script defer src="https://static.cloudflareinsights.com/beacon.min.js/v833ccba57c9e4d2798f2e76cebdd09a11778172276447" integrity="sha512-57MDmcccJXYtNnH+ZiBwzC4jb2rvgVCEokYN+L/nLlmO8rfYT/gIpW2A569iJ/3b+0UEasghjuZH/ma3wIs/EQ==" data-cf-beacon='{"version":"2024.11.0","token":"41ccecab40284244aa0b52f56036ee92","r":1,"server_timing":{"name":{"cfCacheStatus":true,"cfEdge":true,"cfExtPri":true,"cfL4":true,"cfOrigin":true,"cfSpeedBrain":true},"location_startswith":null}}' crossorigin="anonymous"></script>
</body>

<!-- Mirrored from templates.iqonic.design/posdash/html/backend/page-list-suppliers.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 29 Jun 2026 09:56:41 GMT -->
</html>