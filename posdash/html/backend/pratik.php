
<?php

include 'db.php';

if(!isset($_GET['id'])) {
    header("Location: pratik.php");
    exit;
}

$id = intval($_GET['id']);
$result = mysqli_query($conn,"SELECT * FROM supplier WHERE id='$id'");
if(mysqli_num_rows($result)==0) {
    die("Supplier Not Found");
}
$row = mysqli_fetch_assoc($result);

$update_success = false;

if(isset($_POST['update'])) {
    $supplier_name   = mysqli_real_escape_string($conn,$_POST['supplier_name']);
    $email           = mysqli_real_escape_string($conn,$_POST['email']);
    $phone           = mysqli_real_escape_string($conn,$_POST['phone']);
    $gst_no          = mysqli_real_escape_string($conn,$_POST['gst_no']);
    $pan_no          = mysqli_real_escape_string($conn,$_POST['pan_no']);
    $address         = mysqli_real_escape_string($conn,$_POST['address']);
    $bank_name       = mysqli_real_escape_string($conn,$_POST['bank_name']);
    $branch_name     = mysqli_real_escape_string($conn,$_POST['branch_name']);
    $account_holder  = mysqli_real_escape_string($conn,$_POST['account_holder']);
    $account_number  = mysqli_real_escape_string($conn,$_POST['account_number']);
    $ifsc_code       = mysqli_real_escape_string($conn,$_POST['ifsc_code']);
    $opening_balance = mysqli_real_escape_string($conn,$_POST['opening_balance']);
    $notes           = mysqli_real_escape_string($conn,$_POST['notes']);

    mysqli_query($conn,"UPDATE supplier SET 
        supplier_name='$supplier_name', email='$email', phone='$phone', 
        gst_no='$gst_no', pan_no='$pan_no', address='$address',
        bank_name='$bank_name', branch_name='$branch_name', 
        account_holder='$account_holder', account_number='$account_number', 
        ifsc_code='$ifsc_code', opening_balance='$opening_balance', 
        notes='$notes' WHERE id='$id'");

    $update_success = true;
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Edit Supplier – UltraPOS</title>

    <!-- ✅ YOUR ORIGINAL LOCAL CSS FILES – DO NOT REMOVE -->
    <link rel="stylesheet" href="../assets/css/backend-plugin.min.css">
    <link rel="stylesheet" href="../assets/css/backende209.css?v=1.0.0">
    <link rel="stylesheet" href="../assets/vendor/remixicon/fonts/remixicon.css">

    <!-- SweetAlert2 (add this new) -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- ✅ NEW CUSTOM CSS (add after your CSS) -->
   
</head>

<body>
<div class="wrapper">
    <?php include 'header.php'; ?>

    <div class="content-page">

          
        <div class="container-fluid">

            <a href="supplier_show.php" class="btn btn-secondary">
                <i class="ri-arrow-left-line"></i> Back
            </a>
    

            <div class="supplier-edit-card">
               
                <!-- Profile Header -->
                <div class="profile-header">
                    <i class="ri-store-3-line supplier-icon"></i>
                    <div class="supplier-info">

                        <h2><?php echo htmlspecialchars($row['supplier_name']); ?></h2>
                        <div class="code">Code: <?php echo htmlspecialchars($row['supplier_code']); ?></div>
                    </div>
                    <span class="badge badge-<?php echo ($row['status']=="Active") ? "success":"danger"; ?> status-badge">
                        <?php echo $row['status']; ?>
                    </span>
                </div>

                <div class="card-body">
                    <form method="post" id="supplierForm" novalidate>

                        <!-- Section 1 -->
                        <div class="section-title"><i class="ri-user-line"></i> Supplier Information</div>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label>Supplier Code</label>
                                <input type="text" class="form-control" value="<?php echo $row['supplier_code']; ?>" readonly>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Supplier Name <span class="required-star">*</span></label>
                                <input type="text" name="supplier_name" class="form-control" id="supplier_name"
                                       value="<?php echo htmlspecialchars($row['supplier_name']); ?>" required>
                                <div class="invalid-feedback">Supplier name is required.</div>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Mobile <span class="required-star">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ri-phone-line"></i></span>
                                    </div>
                                    <input type="text" id="phone" name="phone" class="form-control"
                                           value="<?php echo htmlspecialchars($row['phone']); ?>" placeholder="10-digit mobile number" required>
                                    <div class="invalid-feedback" id="phone_error"></div>
                                </div>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Email <span class="required-star">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ri-mail-line"></i></span>
                                    </div>
                                    <input type="email" id="email" name="email" class="form-control"
                                           value="<?php echo htmlspecialchars($row['email']); ?>" placeholder="example@domain.com" required>
                                    <div class="invalid-feedback" id="email_error"></div>
                                </div>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>GST Number <span class="required-star">*</span></label>
                                <input type="text" id="gst_no" name="gst_no" class="form-control"
                                       value="<?php echo htmlspecialchars($row['gst_no']); ?>" placeholder="22AAAAA0000A1Z5" required>
                                <div class="invalid-feedback" id="gst_error"></div>
                            </div>
                            <div class="col-md-4 form-group">
                                <label>PAN Number <span class="required-star">*</span></label>
                                <input type="text" id="pan_no" name="pan_no" class="form-control"
                                       value="<?php echo htmlspecialchars($row['pan_no']); ?>" placeholder="AAAAA0000A" required>
                                <div class="invalid-feedback" id="pan_error"></div>
                            </div>
                        </div>

                        <!-- Section 2 -->
                        <div class="section-title"><i class="ri-map-pin-line"></i> Address Information</div>
                        <div class="row">
                            <div class="col-12 form-group">
                                <label>Address</label>
                                <input type="text" name="address" class="form-control"
                                       value="<?php echo htmlspecialchars($row['address']); ?>" placeholder="Full address">
                            </div>
                        </div>

                        <!-- Section 3 -->
                        <div class="section-title"><i class="ri-bank-line"></i> Bank Details</div>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label>Bank Name</label>
                                <input type="text" name="bank_name" class="form-control"
                                       value="<?php echo htmlspecialchars($row['bank_name']); ?>" placeholder="e.g. State Bank of India">
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Branch Name</label>
                                <input type="text" name="branch_name" class="form-control"
                                       value="<?php echo htmlspecialchars($row['branch_name']); ?>" placeholder="Branch">
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Account Holder</label>
                                <input type="text" name="account_holder" class="form-control"
                                       value="<?php echo htmlspecialchars($row['account_holder']); ?>" placeholder="Account holder name">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Account Number</label>
                                <input type="text" name="account_number" id="account_number" class="form-control"
                                       value="<?php echo htmlspecialchars($row['account_number']); ?>" placeholder="Account number (digits only)">
                                <div class="invalid-feedback" id="account_error"></div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>IFSC Code <span class="required-star">*</span></label>
                                <input type="text" id="ifsc_code" name="ifsc_code" class="form-control"
                                       value="<?php echo htmlspecialchars($row['ifsc_code']); ?>" placeholder="SBIN0001234" required>
                                <div class="invalid-feedback" id="ifsc_error"></div>
                            </div>
                        </div>

                        <!-- Section 4 -->
                        <div class="section-title"><i class="ri-wallet-3-line"></i> Financial Information</div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Opening Balance</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₹</span>
                                    </div>
                                    <input type="text" name="opening_balance" class="form-control" id="opening_balance"
                                           value="<?php echo number_format($row['opening_balance'],2); ?>">
                                </div>
                            </div>
                        </div>

                        <!-- Section 5 -->
                        <div class="section-title"><i class="ri-file-text-line"></i> Notes</div>
                        <div class="form-group">
                            <textarea name="notes" class="form-control" rows="3" placeholder="Additional notes..."><?php echo htmlspecialchars($row['notes']); ?></textarea>
                        </div>

                        <!-- Buttons -->
                        <div class="text-right mt-5">
                           
                            <button type="submit" name="update" id="updateBtn" class="btn btn-primary ml-2">
                                <i class="ri-check-line"></i> Update Supplier
                            </button>
                            <button type="button" onclick="window.print()" class="btn btn-success ml-2">
                                <i class="ri-printer-line"></i> Print
                            </button>
                        </div>
                    </form>
                </div><!-- card-body -->
            </div><!-- card -->
        </div><!-- container -->
    </div><!-- content-page -->

    <!-- ✅ YOUR ORIGINAL FOOTER & SCRIPTS – KEEP EXACTLY AS BEFORE -->
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
                            <span class="mr-1"><script>document.write(new Date().getFullYear())</script>©</span> <a href="#">POS Dash</a>.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div><!-- wrapper -->


 <style>
        body {
            background: #f4f7fb;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .supplier-edit-card {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0,0,0,0.08);
            margin: 30px 0 50px;
        }
        .profile-header {
            background: linear-gradient(135deg, #32bdea, #158df7);
            color: white;
            padding: 2.5rem 2rem;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 1.5rem;
        }
        .profile-header .supplier-icon {
            font-size: 4rem;
            opacity: 0.9;
        }
        .profile-header .supplier-info h2 {
            font-weight: 700;
            margin-bottom: 0.2rem;
        }
        .profile-header .code {
            font-size: 0.95rem;
            opacity: 0.85;
        }
        .profile-header .status-badge {
            margin-left: auto;
            font-size: 1rem;
            padding: 0.5rem 1.5rem;
            border-radius: 30px;
            font-weight: 600;
        }
        .section-title {
            background: #eef8ff;
            border-left: 5px solid #32bdea;
            padding: 0.7rem 1.5rem;
            font-size: 1.15rem;
            font-weight: 600;
            margin: 2rem 0 1.5rem;
            border-radius: 0 10px 10px 0;
            color: #1a3b5d;
        }
        .section-title i { margin-right: 0.5rem; color: #32bdea; }
        .form-group label {
            font-weight: 600;
            font-size: 0.9rem;
            color: #495057;
            margin-bottom: 0.3rem;
        }
        .required-star { color: #dc3545; margin-left: 2px; }
        .form-control {
            border-radius: 10px;
            border: 1px solid #dee2e6;
            padding: 0.6rem 1rem;
            transition: all 0.2s ease;
        }
        .form-control:focus {
            border-color: #32bdea;
            box-shadow: 0 0 0 0.2rem rgba(50,189,234,0.15);
        }
        .form-control.is-valid {
            border-color: #28a745;
            box-shadow: 0 0 0 0.2rem rgba(40,167,69,0.15);
        }
        .form-control.is-invalid {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220,53,69,0.15);
        }
        .invalid-feedback { font-size: 0.8rem; margin-top: 0.25rem; }
        .input-group-text {
            border-radius: 10px 0 0 10px;
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            color: #6c757d;
        }
        .input-group .form-control { border-radius: 0 10px 10px 0; }
        .btn {
            border-radius: 10px;
            padding: 0.6rem 1.5rem;
            font-weight: 500;
            letter-spacing: 0.3px;
            transition: all 0.2s;
        }
        .btn-primary { background: #32bdea; border-color: #32bdea; }
        .btn-primary:hover { background: #2aa8d1; border-color: #2aa8d1; }
        .btn-secondary { background: #6c757d; border-color: #6c757d; }
        .btn-success { background: #28a745; border-color: #28a745; }
        .btn .spinner-border {
            width: 1rem; height: 1rem; margin-right: 0.3rem;
        }
        @media (max-width: 768px) {
            .profile-header { flex-direction: column; text-align: center; }
            .profile-header .status-badge { margin-left: 0; }
        }
    </style>


<!-- ✅ ORIGINAL BACKEND SCRIPTS -->
<script src="../assets/js/backend-bundle.min.js"></script>
<script src="../assets/js/table-treeview.js"></script>
<script src="../assets/js/customizer.js"></script>
<script src="../assets/js/chart-custom.js"></script>
<script src="../assets/js/app.js"></script>

<!-- ✅ NEW CUSTOM JS (add after all original scripts) -->




<script>
$(document).ready(function() {

    // Utility
    function showValid($input) { $input.removeClass('is-invalid').addClass('is-valid'); }
    function showInvalid($input, msg) {
        $input.removeClass('is-valid').addClass('is-invalid');
        $input.siblings('.invalid-feedback').text(msg);
    }
    function clearValidation($input) { $input.removeClass('is-valid is-invalid'); }

    // Auto uppercase & trim
    $('#gst_no, #pan_no, #ifsc_code').on('input', function() {
        $(this).val($(this).val().toUpperCase());
    });
    $('input, textarea').on('blur', function() {
        $(this).val($.trim($(this).val()));
    });

    // Real-time validation
    $('#phone').on('keyup blur', function() {
        var val = $(this).val().trim();
        if(val === '') { clearValidation($(this)); $('#phone_error').text(''); return; }
        if(/^[0-9]{10}$/.test(val)) { showValid($(this)); $('#phone_error').text(''); checkDuplicate('phone', val, $('#phone'), $('#phone_error')); }
        else { showInvalid($(this), 'Enter a valid 10-digit mobile number'); $('#phone_error').text('Enter a valid 10-digit mobile number'); }
    });

    $('#email').on('keyup blur', function() {
        var val = $(this).val().trim();
        if(val === '') { clearValidation($(this)); $('#email_error').text(''); return; }
        if(/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val)) { showValid($(this)); $('#email_error').text(''); checkDuplicate('email', val, $('#email'), $('#email_error')); }
        else { showInvalid($(this), 'Enter a valid email address'); $('#email_error').text('Enter a valid email address'); }
    });

    $('#gst_no').on('keyup blur', function() {
        var val = $(this).val().trim().toUpperCase(); $(this).val(val);
        if(val === '') { clearValidation($(this)); $('#gst_error').text(''); return; }
        if(/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z][1-9A-Z]Z[0-9A-Z]$/.test(val)) { showValid($(this)); $('#gst_error').text(''); checkDuplicate('gst_no', val, $('#gst_no'), $('#gst_error')); }
        else { showInvalid($(this), 'Invalid GST number'); $('#gst_error').text('Invalid GST number'); }
    });

    $('#pan_no').on('keyup blur', function() {
        var val = $(this).val().trim().toUpperCase(); $(this).val(val);
        if(val === '') { clearValidation($(this)); $('#pan_error').text(''); return; }
        if(/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/.test(val)) { showValid($(this)); $('#pan_error').text(''); }
        else { showInvalid($(this), 'Invalid PAN'); $('#pan_error').text('Invalid PAN'); }
    });

    $('#ifsc_code').on('keyup blur', function() {
        var val = $(this).val().trim().toUpperCase(); $(this).val(val);
        if(val === '') { clearValidation($(this)); $('#ifsc_error').text(''); return; }
        if(/^[A-Z]{4}0[A-Z0-9]{6}$/.test(val)) { showValid($(this)); $('#ifsc_error').text(''); }
        else { showInvalid($(this), 'Invalid IFSC'); $('#ifsc_error').text('Invalid IFSC'); }
    });

    $('#account_number').on('keyup blur', function() {
        var val = $(this).val().trim();
        if(val === '') { clearValidation($(this)); $('#account_error').text(''); return; }
        if(/^\d+$/.test(val)) { showValid($(this)); $('#account_error').text(''); }
        else { showInvalid($(this), 'Only digits allowed'); $('#account_error').text('Only digits allowed'); }
    });

    // AJAX duplicate check
    function checkDuplicate(field, value, $input, $errorSpan) {
        $.ajax({
            url: 'check-supplier-duplicate.php',
            type: 'GET',
            data: { field: field, value: value, id: <?php echo $id; ?> },
            dataType: 'json',
            success: function(res) {
                if(res.exists) {
                    showInvalid($input, 'This ' + field.replace('_',' ') + ' already exists.');
                    $errorSpan.text('Already in use');
                } else {
                    showValid($input);
                    $errorSpan.text('');
                }
            }
        });
    }

    // Form submit
    $('#supplierForm').on('submit', function(e) {
        e.preventDefault();
        $('input, textarea').each(function(){ $(this).val($.trim($(this).val())); });

        var valid = true, firstInvalid = null;

        if($('#supplier_name').val() === '') { showInvalid($('#supplier_name'), 'Supplier name is required.'); valid = false; firstInvalid = firstInvalid || $('#supplier_name')[0]; }
        if(!/^[0-9]{10}$/.test($('#phone').val())) { showInvalid($('#phone'), 'Valid 10-digit mobile required'); valid = false; firstInvalid = firstInvalid || $('#phone')[0]; }
        if(!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test($('#email').val())) { showInvalid($('#email'), 'Valid email required'); valid = false; firstInvalid = firstInvalid || $('#email')[0]; }
        if(!/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z][1-9A-Z]Z[0-9A-Z]$/.test($('#gst_no').val().toUpperCase())) { showInvalid($('#gst_no'), 'Invalid GST'); valid = false; firstInvalid = firstInvalid || $('#gst_no')[0]; }
        if(!/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/.test($('#pan_no').val().toUpperCase())) { showInvalid($('#pan_no'), 'Invalid PAN'); valid = false; firstInvalid = firstInvalid || $('#pan_no')[0]; }
        if(!/^[A-Z]{4}0[A-Z0-9]{6}$/.test($('#ifsc_code').val().toUpperCase())) { showInvalid($('#ifsc_code'), 'Invalid IFSC'); valid = false; firstInvalid = firstInvalid || $('#ifsc_code')[0]; }

        // Clean opening balance
        $('#opening_balance').val($('#opening_balance').val().replace(/[₹,]/g, '').trim());

        if(!valid) {
            if(firstInvalid) firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
            return false;
        }

        $('#updateBtn').prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Updating...');
        this.submit();
    });

    // SweetAlert2 on success (after reload)
    <?php if($update_success): ?>
    Swal.fire({
        icon: 'success',
        title: 'Supplier Updated',
        text: 'The supplier details have been saved successfully.',
        confirmButtonColor: '#32bdea',
        timer: 2500,
        showConfirmButton: true
    }).then(function() {
        window.location = 'view-suppliers.php?id=<?php echo $id; ?>';
    });
    <?php endif; ?>
});
</script>
</body>
</html>