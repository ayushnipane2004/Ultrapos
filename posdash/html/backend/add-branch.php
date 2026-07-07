<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>UltraPOS</title>
    
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




<?php include 'header.php' ?>






<?php


$role = mysqli_query($conn,"
SELECT id, role_name
FROM role
WHERE company_id='$company_id'
AND delete_flag='1' and role_name != 'owner'
ORDER BY role_name
");



if(!$role)
{
    die(mysqli_error($conn));
}

echo mysqli_num_rows($role);







if(isset($_POST['save_branch']))
{

    $branch_name            = mysqli_real_escape_string($conn,$_POST['branch_name']);
    $branch_code            = mysqli_real_escape_string($conn,$_POST['branch_code']);
    $branch_type            = mysqli_real_escape_string($conn,$_POST['branch_type']);
    $gst_no                 = mysqli_real_escape_string($conn,$_POST['gst_no']);

    $branch_email           = mysqli_real_escape_string($conn,$_POST['branch_email']);
    $branch_mobile          = mysqli_real_escape_string($conn,$_POST['branch_mobile']);

    $address                = mysqli_real_escape_string($conn,$_POST['address']);
    $area                   = mysqli_real_escape_string($conn,$_POST['area']);
    $city                   = mysqli_real_escape_string($conn,$_POST['city']);
    $district               = mysqli_real_escape_string($conn,$_POST['district']);
    $state                  = mysqli_real_escape_string($conn,$_POST['state']);
    $country                = mysqli_real_escape_string($conn,$_POST['country']);
    $pincode                = mysqli_real_escape_string($conn,$_POST['pincode']);

    $contact_person_name    = mysqli_real_escape_string($conn,$_POST['contact_person_name']);
    $contact_person_email   = mysqli_real_escape_string($conn,$_POST['contact_person_email']);
    $contact_person_mobile  = mysqli_real_escape_string($conn,$_POST['contact_person_mobile']);

    $role_id                = mysqli_real_escape_string($conn,$_POST['role_id']);

    $opening_date           = mysqli_real_escape_string($conn,$_POST['opening_date']);
    $timezone               = mysqli_real_escape_string($conn,$_POST['timezone']);
    $description            = mysqli_real_escape_string($conn,$_POST['description']);

    $status                 = mysqli_real_escape_string($conn,$_POST['status']);


   

    $check = mysqli_query($conn,"
    SELECT id
    FROM branch_master
    WHERE company_id='$company_id'
    AND branch_email='$branch_email'
    AND delete_flag='1'
    ");

    if(mysqli_num_rows($check)>0)
    {

        echo "<script>
        alert('Branch Email Already Exists.');
        </script>";

    }
    else
    {

        mysqli_query($conn,"
        INSERT INTO branch_master
        (
            company_id,

            branch_name,
            branch_code,
            branch_type,
            gst_no,

            branch_email,
            branch_mobile,

            address,
            area,
            city,
            district,
            state,
            country,
            pincode,

            contact_person_name,
            contact_person_email,
            contact_person_mobile,

            role_id,

            opening_date,
            description,

            status,

            created_by,
            modified_by

        )
        VALUES
        (
            '$company_id',

            '$branch_name',
            '$branch_code',
            '$branch_type',
            '$gst_no',

            '$branch_email',
            '$branch_mobile',

            '$address',
            '$area',
            '$city',
            '$district',
            '$state',
            '$country',
            '$pincode',

            '$contact_person_name',
            '$contact_person_email',
            '$contact_person_mobile',

            '$role_id',

            '$opening_date',
            '$description',

            '$status',

            '$created_by',
            '$modified_by'
        )
        ");

        echo "<script>
        alert('Branch Added Successfully.');
        window.location='dashboard.php';
        </script>";

    }




    

}

?>



  
                <div class="wrapper">

            <div class="content-page">
                <div class="container-fluid">
                    <div class="card">
                    <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Add Branch</h4>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                            <form method="post" enctype="multipart/form-data">
                                    <div class="card-header">
                                        <h4 class="card-title">Branch Information</h4>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">

                                            <!-- Company Name -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Branch Name <span class="text-danger">*</span></label>
                                                    <input type="text"
                                                        class="form-control"
                                                        name="branch_name"
                                                        placeholder="Enter Branch Name"
                                                        required>
                                                </div>
                                            </div>


                                        <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Branch Code <span class="text-danger">*</span></label>
                                                    <input type="text"
                                                        class="form-control"
                                                        name="branch_code"
                                                        placeholder="Branch Code"
                                                        required>
                                                </div>
                                            </div>





                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>GST Number <span class="text-danger">*</span></label>
                                                    <input type="text"
                                                        class="form-control"
                                                        name="gst_no"
                                                        placeholder="Enter GST Number"
                                                        pattern="^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$"
                                                        required>
                                                </div>
                                            </div>





             <div class="col-md-6">
                <div class="form-group">
                    <label>Branch Type <span class="text-danger">*</span></label>

                    <select name="branch_type" class="form-control">
                        <option value="">Select Branch</option>
                        <option value="1">Head Office</option>
                        <option value="2">Branch</option>
                    </select>
                </div>
            </div>



                                            <!-- Email -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Branch Email <span class="text-danger">*</span></label>
                                                    <input type="email"
                                                        class="form-control"
                                                        name="branch_email"
                                                        placeholder="Enter Email"
                                                        required>
                                                </div>
                                            </div>

                                            <!-- Mobile -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Branch Mobile <span class="text-danger">*</span></label>
                                                    <input type="text"
                                                        class="form-control"
                                                        name="branch_mobile"
                                                        placeholder="Enter Mobile Number"
                                                        required>
                                                </div>
                                            </div>








                                            <!-- Business Type -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Business Type</label>
                                                    <input type="text"
                                                        class="form-control"
                                                        name="businesstype"
                                                        placeholder="Enter Business Type">
                                                </div>
                                            </div>

                                        
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Status *</label>
                                                    <select class="form-control" name="status">
                                                        <option value="Active">Active</option>
                                                        <option value="Inactive">Inactive</option>
                                                    </select>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div> 



                

                                        </div>
                                    </div>
                                </div>

                                <!-- ================= Address Information ================= -->

                                <div class="card mt-3">
                                    <div class="card-header">
                                        <h4 class="card-title">Address Information</h4>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">
                                    
                                    <!-- Address -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Address <span class="text-danger">*</span></label>
                                            <textarea class="form-control"
                                                    rows="3"
                                                    name="address"
                                                    placeholder="Enter Full Address"
                                                    required></textarea>
                                        </div>
                                    </div>

                                    <!-- City -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>City <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control"
                                                name="city"
                                                placeholder="Enter City"
                                                required>
                                        </div>
                                    </div>

                                      <div class="col-md-4">
                                        <div class="form-group">
                                            <label>District <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control"
                                                name="district"
                                                placeholder="Enter District"
                                                required>
                                        </div>
                                    </div>

                                    <!-- State -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>State <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control"
                                                name="state"
                                                placeholder="Enter State"
                                                required>
                                        </div>
                                    </div>

                                    <!-- Country -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Country <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control"
                                                name="country"
                                                placeholder="Enter Country"
                                                required>
                                        </div>
                                    </div>



                                       <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Area <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control"
                                                name="area"
                                                placeholder="Enter Area"
                                                required>
                                        </div>
                                    </div>





                                    <!-- Pincode -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Pincode <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control"
                                                name="pincode"
                                                placeholder="Enter Pincode"
                                                required>
                                        </div>
                                    </div>
                                    <!-- Currency -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Currency</label>
                                            <select class="form-control" name="currency">
                                                <option value="INR">INR</option>
                                                <option value="USD">USD</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Financial Year -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Financial Year</label>
                                            <input type="text"
                                                class="form-control"
                                                name="financial_year"
                                                placeholder="2026-2027">
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>

















                                    <!-- ================= contact Information ================= -->




                                    <div class="card mt-3">
                                        <div class="card-header">
                                            <h4 class="card-title">Contact Information</h4>
                                        </div>

                                        <div class="card-body">
                                            <div class="row">

                                        

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Contact Person Name <span class="text-danger">*</span></label>
                                                    <input type="text"
                                                        class="form-control"
                                                        name="contact_person_name"
                                                        placeholder="Enter Person Name"
                                                        required>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Contact Person Email<span class="text-danger">*</span></label>
                                                    <input type="email"
                                                        class="form-control"
                                                        name="contact_person_email"
                                                        placeholder="Email"
                                                        required>
                                                </div>
                                            </div>


                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Contact Person Phone <span class="text-danger">*</span></label>
                                                    <input type="text"
                                                        class="form-control"
                                                        name="contact_person_mobile"
                                                        placeholder="Enter Phone"
                                                        required>
                                                </div>
                                            </div>



                                    <div class="col-md-6">
                <div class="form-group">
                    <label>Role <span class="text-danger">*</span></label>
                       <select class="form-control" name="role_id" required>

                 <option value="">Select Role</option>

                        <?php while($row=mysqli_fetch_assoc($role)){ ?>

                <option value="<?= $row['id']; ?>">

                  <?= $row['role_name']; ?>

                 </option>

                    <?php } ?>

</select>
                </div>
            </div>








                                        </div>
                                    </div>
                                </div>




                                <!-- ================= Other Information ================= -->

                                <div class="card mt-3">
                                    <div class="card-header">
                                        <h4 class="card-title">Other Information</h4>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">

                                        

                                            <!-- Date of Birth -->
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Opening Date</label>
                                                    <input type="date"
                                                        class="form-control"
                                                        name="opening_date">
                                                </div>
                                            </div>




                                                  <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description<span class="text-danger">*</span></label>
                                            <textarea class="form-control"
                                                    rows="3"
                                                    name="description"
                                                    placeholder="Description"
                                                    required></textarea>
                                        </div>
                                    </div>







                                        </div>
                                    </div>
                                </div>
                                <!-- ================= Submit Button ================= -->

                                <div class="card mt-3">
                                    <div class="card-body text-center">

                                        <button type="submit"
                                                name="save_branch"
                                                class="btn btn-primary mr-2">
                                            <i class="ri-save-line"></i> Add Branch
                                        </button>

                                        <button type="reset"
                                                class="btn btn-danger">
                                            <i class="ri-refresh-line"></i> Reset
                                        </button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
             </div>

                        <!-- Wrapper End -->

            <footer class="iq-footer">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">

                                <div class="col-lg-6">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="privacy-policy.html">Privacy Policy</a>
                                        </li>

                                        <li class="list-inline-item">
                                            <a href="terms-of-service.html">Terms of Use</a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-lg-6 text-right">
                                    <span class="mr-1">
                                        <script>
                                            document.write(new Date().getFullYear())
                                        </script> ©
                                    </span>

                                    <a href="#">POS Dash</a>
                                </div>

                                    </div>

                                </div>
                            </div>
                        </div>
</footer>

<!-- Backend Bundle JavaScript -->
<script src="../assets/js/backend-bundle.min.js"></script>

<!-- Table Treeview JavaScript -->
<script src="../assets/js/table-treeview.js"></script>

<!-- Customizer -->
<script src="../assets/js/customizer.js"></script>

<!-- Chart -->
<script src="../assets/js/chart-custom.js"></script>

<!-- App -->
<script src="../assets/js/app.js"></script>

</body>
</html>