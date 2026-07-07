
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
    <div id="loading">
          <div id="loading-center">
          </div>
    </div>
    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper">
      
     
      
      <?php include 'header.php' ?>
      
      



      <?php
include 'db.php';

if(isset($_GET['delete_id']))
{
    $id = intval($_GET['delete_id']);

    $delete = mysqli_query($conn,"
        UPDATE role
        SET
            delete_flag='0',
            modified_by='$user_id'
        WHERE id='$id'
        AND user_id='$user_id'
    ");

    if($delete)
    {
        echo "<script>
                alert('Role Deleted Successfully');
                window.location='page-list-role.php';
              </script>";
        exit;
    }
    else
    {
        echo "<script>alert('Something Went Wrong');</script>";
    }
}
?>
      
      <div class="content-page">
     <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                    <div>
                        <h4 class="mb-3">Role List</h4>
                        <p class="mb-0">Use category list as to describe your overall core business from the provided list. <br>
                        Click the name of the category where you want to add a list item. .</p>
                    </div>
                    <a href="page-add-role.php" class="btn btn-primary add-list"><i class="las la-plus mr-3"></i>Add Role</a>
                </div>
            </div>




            <div class="col-lg-12">
                <div class="table-responsive rounded mb-3">




                <table class="data-table table mb-0 tbl-server-info">
                  <thead class="bg-white text-uppercase">
    <tr class="ligth ligth-data">

        <th>Role Name</th>
        <th>Description</th>
        <th>Status</th>
        <th>Action</th>

    </tr>
</thead>


<tbody class="ligth-body">

<?php

$sql = mysqli_query($conn,"
SELECT *
FROM role
WHERE delete_flag='1'
AND company_id='$company_id'
ORDER BY id DESC
");

while($row = mysqli_fetch_assoc($sql))
{
?>

<tr>

    <!-- Role Name -->
    <td>
        <?php echo $row['role_name']; ?>
    </td>

    <!-- Description -->
    <td>
        <?php echo $row['description']; ?>
    </td>

    <!-- Status -->
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

    <!-- Action -->
    <td>

        <div class="d-flex align-items-center list-action">

            <!-- View -->
            <a class="badge badge-info mr-2"
               href="view-role.php?id=<?php echo $row['id']; ?>">
                <i class="ri-eye-line mr-0"></i>
            </a>

            <!-- Edit -->
            <a class="badge bg-success mr-2"
               href="edit-role.php?id=<?php echo $row['id']; ?>">
                <i class="ri-pencil-line mr-0"></i>
            </a>

            <!-- Delete -->
            <a class="badge bg-warning mr-2"
               href="?delete_id=<?php echo $row['id']; ?>"
               onclick="return confirm('Are you sure you want to delete this role?')">
                <i class="ri-delete-bin-line mr-0"></i>
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
                            <span class="mr-1"><script type="f0eb494f5a66e80d5968103e-text/javascript">document.write(new Date().getFullYear())</script>©</span> <a href="#" class="">POS Dash</a>.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Backend Bundle JavaScript -->
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

<!-- Mirrored from templates.iqonic.design/posdash/html/backend/page-list-category.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 29 Jun 2026 09:56:40 GMT -->
</html>