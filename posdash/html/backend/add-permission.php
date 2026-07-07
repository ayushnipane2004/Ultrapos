
<?php include 'db.php' ?>
<?php include 'session.php' ?>




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

<?php include 'header.php' ?>

<?php

$role1 = mysqli_query($conn,"
SELECT id, role_name
FROM role
WHERE delete_flag='1'
AND company_id='$company_id'
AND role_name!='Owner'
ORDER BY role_name
");


if(isset($_POST['save_permission']))
{

    $selected_role_id = $_POST['role_id'];

    mysqli_query($conn,"
    DELETE FROM role_permissions
    WHERE company_id='$company_id'
    AND role_id='$selected_role_id'
    ");

    if(isset($_POST['permission']) && is_array($_POST['permission']))
    {
        foreach($_POST['permission'] as $permission_id)
        {

            mysqli_query($conn,"
            INSERT INTO role_permissions
            (
                company_id,
                role_id,
                permission_id,
                status,
                created_by,
                modified_by
            )
            VALUES
            (
                '$company_id',
                '$selected_role_id',
                '$permission_id',
                'Active',
                '$created_by',
                '$modified_by'
            )
            ");

        }

        echo "<script>alert('Permissions Saved Successfully');</script>";
    }
    else
    {
        echo "<script>alert('Please Select At Least One Permission');</script>";
    }

}

?>


<div class="container-fluid" style="margin-top: 37px;">

    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex justify-content-between align-items-center mb-4">

                <div>
                    <h2 class="font-weight-bold mb-1">
                        Role Permission Management
                    </h2>

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent p-0 mb-0">
                            <li class="breadcrumb-item">
                                <a href="dashboard.php">Dashboard</a>
                            </li>

                            <li class="breadcrumb-item active">
                                Role Permission
                            </li>
                        </ol>
                    </nav>
                </div>

            </div>
        </div>
    </div>

  
  
  
  
  <form method="post">
  
  
    <!-- Permission Card -->
    <div class="card">



        <div class="card-body">

            <div class="row align-items-end">





                <!-- Select Role -->
                <div class="col-lg-4">

                    <div class="form-group">

                        <label class="font-weight-bold">
                            Select Role
                        </label>

<select name="role_id" class="form-control" required>

            <option value="">Select Role</option>

            <?php
            mysqli_data_seek($role1,0);

            while($row=mysqli_fetch_assoc($role1))
            {
            ?>

            <option value="<?php echo $row['id'];?>"

            <?php
              if(isset($_POST['role_id1']) && $_POST['role_id1']==$row['id'])           {
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

        





            </div>

            <hr>

            <h5 class="font-weight-bold mb-4">
                Permissions
            </h5>

            <div class="row">

    <!-- Dashboard -->
    <div class="col-lg-3 p-0 border">

        <div class="bg-light p-2 border-bottom">
            <h6 class="mb-0 font-weight-bold">
                Dashboard
            </h6>
        </div>

        <div class="p-3">

            <div class="custom-control custom-checkbox mb-3">

                <input
                    type="checkbox"
                    class="custom-control-input"
                    id="dashboard" name="permission[]" value="1">

                <label
                    class="custom-control-label"
                    for="dashboard">

                    Dashboard Management

                </label>

            </div>

        </div>

    </div>


    <!-- Company Management -->

    <div class="col-lg-3 p-0 border">

        <div class="bg-light p-2 border-bottom">

            <h6 class="mb-0 font-weight-bold">

                Company Management

            </h6>

        </div>

        <div class="p-3">

            <div class="custom-control custom-checkbox mb-3">

                <input
                    type="checkbox"
                    class="custom-control-input"
                    id="company" name="permission[]" value="2">

                <label
                    class="custom-control-label"
                    for="company">

                    Company Management

                </label>

            </div>

            <div class="custom-control custom-checkbox mb-3">

                <input
                    type="checkbox"
                    class="custom-control-input"
                    id="branch" name="permission[]" value="3">

                <label
                    class="custom-control-label"
                    for="branch">

                    Branch Management

                </label>

            </div>

            <div class="custom-control custom-checkbox">

                <input
                    type="checkbox"
                    class="custom-control-input"
                    id="warehouse" name="permission[]" value="4">

                <label
                    class="custom-control-label"
                    for="warehouse">

                    Warehouse Management

                </label>

            </div>

        </div>

    </div>


    <!-- Purchase -->

    <div class="col-lg-3 p-0 border">

        <div class="bg-light p-2 border-bottom">

            <h6 class="mb-0 font-weight-bold">

                Purchase

            </h6>

        </div>

        <div class="p-3">

            <div class="custom-control custom-checkbox mb-3">

                <input
                    type="checkbox"
                    class="custom-control-input"
                    id="purchase" name="permission[]" value="15">

                <label
                    class="custom-control-label"
                    for="purchase">

                    Purchase Management

                </label>

            </div>





            <div class="custom-control custom-checkbox">

                <input
                    type="checkbox"
                    class="custom-control-input"
                    id="purchase_return" name="permission[]" value="16">

                <label
                    class="custom-control-label"
                    for="purchase_return">

                    Purchase Return Management

                </label>

            </div>

        </div>

    </div>


    <!-- Settings -->

    <div class="col-lg-3 p-0 border">

        <div class="bg-light p-2 border-bottom">

            <h6 class="mb-0 font-weight-bold">

                Settings

            </h6>

        </div>

        <div class="p-3">

            <div class="custom-control custom-checkbox">

                <input
                    type="checkbox"
                    class="custom-control-input"
                    id="settings" name="permission[]" value="21">

                <label
                    class="custom-control-label"
                    for="settings">

                    Settings Management

                </label>

            </div>

        </div>

    </div>

</div>



<div class="row">

    <!-- User Management -->
    <div class="col-lg-3 p-0 border">

        <div class="bg-light p-2 border-bottom">
            <h6 class="mb-0 font-weight-bold">
                User Management
            </h6>
        </div>

        <div class="p-3">

            <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" id="users" name="permission[]" value="5">
                <label class="custom-control-label" for="users">
                    User Management
                </label>
            </div>

            <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" id="roles" name="permission[]" value="6">
                <label class="custom-control-label" for="roles">
                    Role Management
                </label>
            </div>

            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="permissions" name="permission[]" value="7">
                <label class="custom-control-label" for="permissions">
                    Permission Management
                </label>
            </div>

        </div>

    </div>

    <!-- Customer & Supplier -->
    <div class="col-lg-3 p-0 border">

        <div class="bg-light p-2 border-bottom">
            <h6 class="mb-0 font-weight-bold">
                Customer & Supplier
            </h6>
        </div>

        <div class="p-3">

            <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" id="customer" name="permission[]" value="13">
                <label class="custom-control-label" for="customer">
                    Customer Management
                </label>
            </div>

            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="supplier" name="permission[]" value="15">
                <label class="custom-control-label" for="supplier">
                    Supplier Management
                </label>
            </div>

        </div>

    </div>

    <!-- Inventory -->
    <div class="col-lg-3 p-0 border">

        <div class="bg-light p-2 border-bottom">
            <h6 class="mb-0 font-weight-bold">
                Inventory
            </h6>
        </div>

        <div class="p-3">

            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="stock" name="permission[]" value="19">
                <label class="custom-control-label" for="stock">
                    Stock Management
                </label>
            </div>

        </div>

    </div>

    <!-- Others -->
    <div class="col-lg-3 p-0 border">

        <div class="bg-light p-2 border-bottom">
            <h6 class="mb-0 font-weight-bold">
                Others
            </h6>
        </div>

        <div class="p-3">

            <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" id="print">
                <label class="custom-control-label" for="print">
                    Print Management
                </label>
            </div>

            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="logs">
                <label class="custom-control-label" for="logs">
                    Logs Management
                </label>
            </div>

        </div>

    </div>

</div>



<div class="row">

    <!-- Product & Masters -->
    <div class="col-lg-3 p-0 border">

        <div class="bg-light p-2 border-bottom">
            <h6 class="mb-0 font-weight-bold">
                Product & Masters
            </h6>
        </div>

        <div class="p-3">

            <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" id="category" name="permission[]" value="8">
                <label class="custom-control-label" for="category">
                    Category Management
                </label>
            </div>

            <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" id="subcategory" name="permission[]" value="9">
                <label class="custom-control-label" for="subcategory">
                    Sub Category Management
                </label>
            </div>

            <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" id="brand" name="permission[]" value="10">
                <label class="custom-control-label" for="brand">
                    Brand Management
                </label>
            </div>

            <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" id="unit" name="permission[]" value="11">
                <label class="custom-control-label" for="unit">
                    Unit Management
                </label>
            </div>

            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="product" name="permission[]" value="12">
                <label class="custom-control-label" for="product">
                    Product Management
                </label>
            </div>

        </div>

    </div>


    <!-- Sales -->
    <div class="col-lg-3 p-0 border">

        <div class="bg-light p-2 border-bottom">
            <h6 class="mb-0 font-weight-bold">
                Sales
            </h6>
        </div>

        <div class="p-3">

            <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" id="sales" name="permission[]" value="17">
                <label class="custom-control-label" for="sales">
                    Sales Management
                </label>
            </div>

            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="salesreturn" name="permission[]" value="18">
                <label class="custom-control-label" for="salesreturn">
                    Sales Return Management
                </label>
            </div>

        </div>

    </div>


    <!-- Reports -->
    <div class="col-lg-3 p-0 border">

        <div class="bg-light p-2 border-bottom">
            <h6 class="mb-0 font-weight-bold">
                Reports
            </h6>
        </div>

        <div class="p-3">

            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="reports" name="permission[]" value="20">
                <label class="custom-control-label" for="reports">
                    Reports Management
                </label>
            </div>

        </div>

    </div>


    <!-- Empty Column -->
    <div class="col-lg-3 border d-flex align-items-center justify-content-center">

        <span class="text-muted">
            Select permissions from the left.
        </span>

    </div>

</div>


<!-- Information Bar -->

<div class="alert alert-primary mt-4 mb-0">

    <strong>Company :</strong> UltraPOS (ID : 1)

    &nbsp;&nbsp; | &nbsp;&nbsp;

    <strong>Role :</strong> Employee (ID : 3)

    &nbsp;&nbsp; | &nbsp;&nbsp;

    <strong>Created By :</strong> Admin (ID : 14)

    &nbsp;&nbsp; | &nbsp;&nbsp;

    <strong>Modified By :</strong> Admin (ID : 14)

</div>

</div>

</div>



<!-- Note Section -->

<div class="card mt-4 border-warning">

    <div class="card-header bg-warning text-dark">

        <h5 class="mb-0">
            <i class="las la-exclamation-circle"></i>
            Important Notes
        </h5>

    </div>

    <div class="card-body">

        <ul class="mb-0">

            <li class="mb-2">
                Dashboard access is recommended for all active users.
            </li>

            <li class="mb-2">
                Grant only the permissions required for the selected role.
            </li>

            <li class="mb-2">
                Changes will take effect immediately after saving.
            </li>

            <li class="mb-2">
                Avoid giving User, Role and Permission Management access to normal employees.
            </li>

            <li>
                Only the Owner should have Full Access to all modules.
            </li>

        </ul>

    </div>

</div>

<!-- Action Buttons -->

<div class="text-right mt-4">

    <button type="reset" class="btn btn-secondary">

        <i class="las la-redo-alt"></i>

        Reset

    </button>

<button type="submit" name="save_permission" class="btn btn-primary">

        <i class="las la-save"></i>

        Save Permissions

    </button>

</div>

        </div>
    </div>
</div>


</form>









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