
<!doctype html>
<html lang="en">
  
<!-- Mirrored from templates.iqonic.design/posdash/html/backend/page-add-product.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 29 Jun 2026 09:56:40 GMT -->
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
    <div class="wrapper">
      
      <?php include 'db.php'; ?>
            <?php include 'header.php'; ?>


<?php 


/* ============================= */
/* Auto Generate Product Code */
/* ============================= */

$code = "PRD0001";

$result = mysqli_query($conn,"
SELECT id
FROM product
WHERE user_id='$user_id'
ORDER BY id DESC
LIMIT 1
");

if(mysqli_num_rows($result)>0)
{
    $row=mysqli_fetch_assoc($result);

    $next=$row['id']+1;

    $code="PRD".str_pad($next,4,"0",STR_PAD_LEFT);
}


/* ============================= */
/* Save Product */
/* ============================= */

if(isset($_POST['submit']))
{

    $product_code=mysqli_real_escape_string($conn,$_POST['product_code']);

    $barcode=mysqli_real_escape_string($conn,$_POST['barcode']);

    $product_name=mysqli_real_escape_string($conn,$_POST['product_name']);

    $product_type=mysqli_real_escape_string($conn,$_POST['product_type']);

    $category_id=mysqli_real_escape_string($conn,$_POST['category_id']);

    $sub_category_id=mysqli_real_escape_string($conn,$_POST['sub_category_id']);

    $brand_id=mysqli_real_escape_string($conn,$_POST['brand_id']);

    $unit_id=mysqli_real_escape_string($conn,$_POST['unit_id']);

    $purchase_price=mysqli_real_escape_string($conn,$_POST['purchase_price']);

    $sale_price=mysqli_real_escape_string($conn,$_POST['sale_price']);

    $mrp=mysqli_real_escape_string($conn,$_POST['mrp']);

    $gst=mysqli_real_escape_string($conn,$_POST['gst']);

    $hsn_code=mysqli_real_escape_string($conn,$_POST['hsn_code']);

    $opening_stock=mysqli_real_escape_string($conn,$_POST['opening_stock']);

    $alert_qty=mysqli_real_escape_string($conn,$_POST['alert_qty']);

    $reorder_level=mysqli_real_escape_string($conn,$_POST['reorder_level']);

    $shelf_location=mysqli_real_escape_string($conn,$_POST['shelf_location']);

    $batch_applicable=mysqli_real_escape_string($conn,$_POST['batch_applicable']);

    $expiry_applicable=mysqli_real_escape_string($conn,$_POST['expiry_applicable']);

    $batch_no=mysqli_real_escape_string($conn,$_POST['batch_no']);

    $expiry_date=mysqli_real_escape_string($conn,$_POST['expiry_date']);

    $product_color=mysqli_real_escape_string($conn,$_POST['product_color']);

    $product_size=mysqli_real_escape_string($conn,$_POST['product_size']);

    $product_weight=mysqli_real_escape_string($conn,$_POST['product_weight']);

    $serial_required=mysqli_real_escape_string($conn,$_POST['serial_required']);

    $manufacturer_name=mysqli_real_escape_string($conn,$_POST['manufacturer_name']);

    $description=mysqli_real_escape_string($conn,$_POST['description']);

    $status=mysqli_real_escape_string($conn,$_POST['status']);





    $product_image="";

    if(isset($_FILES['product_image']) && $_FILES['product_image']['name']!="")
    {

        $filename=time()."_".$_FILES['product_image']['name'];

        $folder="../assets/main-images/product-img/";

        if(!is_dir($folder))
        {
            mkdir($folder,0777,true);
        }

        if(move_uploaded_file(
            $_FILES['product_image']['tmp_name'],
            $folder.$filename
        ))
        {
            $product_image="../assets/main-images/product-img/".$filename;
        }

    }



    $check = mysqli_query($conn,"
        SELECT id
        FROM product
        WHERE product_name='$product_name'
        AND delete_flag='1'
        AND user_id='$user_id'
        LIMIT 1
    ");

    if(mysqli_num_rows($check) > 0)
    {
        echo "<script>alert('Product Already Exists');</script>";
    }
    else
    {

        $insert = mysqli_query($conn,"
        INSERT INTO product
        (
            user_id,
            product_code,
            barcode,
            product_name,
            product_type,
            category_id,
            sub_category_id,
            brand_id,
            unit_id,
            purchase_price,
            sale_price,
            mrp,
            gst,
            hsn_code,
            opening_stock,
            alert_qty,
            reorder_level,
            shelf_location,
            batch_applicable,
            expiry_applicable,
            batch_no,
            expiry_date,
            product_color,
            product_size,
            product_weight,
            serial_required,
            manufacturer_name,
            product_image,
            description,
            status,
            delete_flag,
            created_by,
            modified_by
        )
        VALUES
        (
            '$user_id',
            '$product_code',
            '$barcode',
            '$product_name',
            '$product_type',
            '$category_id',
            '$sub_category_id',
            '$brand_id',
            '$unit_id',
            '$purchase_price',
            '$sale_price',
            '$mrp',
            '$gst',
            '$hsn_code',
            '$opening_stock',
            '$alert_qty',
            '$reorder_level',
            '$shelf_location',
            '$batch_applicable',
            '$expiry_applicable',
            '$batch_no',
            '$expiry_date',
            '$product_color',
            '$product_size',
            '$product_weight',
            '$serial_required',
            '$manufacturer_name',
            '$product_image',
            '$description',
            '$status',
            '1',
            '$user_id',
            '$user_id'
        )
        ");

        if($insert)
        {
            echo "<script>
                    alert('Product Added Successfully');
                    window.location='page-add-product.php';
                  </script>";
        }
        else
        {
            die(mysqli_error($conn));
        }

    }

}
?>

<div class="content-page">
     <div class="container-fluid add-form-list">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Add Product</h4>
                        </div>
                    </div>
                    <div class="card-body">

<form method="POST" enctype="multipart/form-data" autocomplete="off" id="wizardForm">

<!-- ===== WIZARD STEPS ===== -->
<div class="wizard-steps-wrapper">
    <ul class="nav nav-pills nav-justified wizard-nav" id="wizardNav">
        <li class="nav-item step-item active" data-step="1">
            <a class="nav-link" href="#">
                <span class="step-circle">1</span>
                <span class="step-label">Basic Info</span>
            </a>
        </li>
        <li class="nav-item step-item" data-step="2">
            <a class="nav-link" href="#">
                <span class="step-circle">2</span>
                <span class="step-label">Pricing</span>
            </a>
        </li>
        <li class="nav-item step-item" data-step="3">
            <a class="nav-link" href="#">
                <span class="step-circle">3</span>
                <span class="step-label">Stock</span>
            </a>
        </li>
        <li class="nav-item step-item" data-step="4">
            <a class="nav-link" href="#">
                <span class="step-circle">4</span>
                <span class="step-label">Batch & Expiry</span>
            </a>
        </li>
        <li class="nav-item step-item" data-step="5">
            <a class="nav-link" href="#">
                <span class="step-circle">5</span>
                <span class="step-label">Attributes</span>
            </a>
        </li>
        <li class="nav-item step-item" data-step="6">
            <a class="nav-link" href="#">
                <span class="step-circle">6</span>
                <span class="step-label">Manufacturer</span>
            </a>
        </li>
        <li class="nav-item step-item" data-step="7">
            <a class="nav-link" href="#">
                <span class="step-circle">7</span>
                <span class="step-label">Product Details</span>
            </a>
        </li>
        <li class="nav-item step-item" data-step="8">
            <a class="nav-link" href="#">
                <span class="step-circle">8</span>
                <span class="step-label">Status & Submit</span>
            </a>
        </li>
    </ul>
    <div class="wizard-progress">
        <div class="progress-bar" id="wizardProgressBar" style="width: 20%;"></div>
    </div>
</div>

<!-- ===== WIZARD SECTIONS ===== -->
<div class="wizard-sections">

    <!-- STEP 1: Basic Information -->
    <div class="wizard-section active" data-step="1">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">📦 Basic Information</h5>
            </div>
            <div class="card-body">
                <div class="row">


                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Product Code / SKU <span class="text-danger">*</span></label>
                            <input type="text" name="product_code" class="form-control" placeholder="Auto Generate" value="<?php echo $code;?>" readonly required>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Barcode</label>
                            <input type="text" name="barcode" class="form-control" placeholder="Enter Barcode" maxlength="50" value="<?php echo isset($_POST['barcode']) ? htmlspecialchars($_POST['barcode']) : ''; ?>" pattern="[A-Za-z0-9]*" title="Only letters and numbers allowed">
                            <div class="invalid-feedback">Only letters and numbers allowed, max 50 characters.</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Product Name <span class="text-danger">*</span></label>
                            <input type="text" name="product_name" class="form-control" placeholder="Enter Product Name" required maxlength="255" minlength="2" value="<?php echo isset($_POST['product_name']) ? htmlspecialchars($_POST['product_name']) : ''; ?>" pattern=".*\S.*" title="Product name cannot be only spaces">
                            <div class="invalid-feedback">Product name is required (minimum 2 characters).</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Product Type <span class="text-danger">*</span></label>
                            <select class="form-control" name="product_type" required>
                                <option value="">Select type</option>
                                <option value="Goods" <?php if(isset($_POST['product_type']) && $_POST['product_type'] == 'Goods') echo 'selected'; ?>>Goods</option>
                                <option value="service" <?php if(isset($_POST['product_type']) && $_POST['product_type'] == 'service') echo 'selected'; ?>>Service</option>
                            </select>
                            <div class="invalid-feedback">Please select a product type.</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Category</label>
                            <select name="category_id" class="form-control">
                                <option value="">Select Category</option>
                                <?php
                                $category = mysqli_query($conn,"
                                    SELECT id, category_name
                                    FROM category
                                    WHERE delete_flag='1'
                                    AND status='Active'
                                    AND user_id='$user_id'
                                    ORDER BY category_name ASC
                                ");
                                while($row = mysqli_fetch_assoc($category)) {
                                ?>
                                    <option value="<?php echo $row['id']; ?>" <?php if(isset($_POST['category_id']) && $_POST['category_id'] == $row['id']) echo 'selected'; ?>>
                                        <?php echo $row['category_name']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <div class="invalid-feedback">Please select a category.</div>
                        </div>
                    </div>



                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Sub Category</label>
                            <select name="sub_category_id" class="form-control">
                                <option value="">Select Sub Category</option>
                                <?php
                                $subcategory = mysqli_query($conn,"
                                    SELECT id, sub_category_name
                                    FROM sub_category
                                    WHERE delete_flag='1'
                                    AND status='Active'
                                    AND user_id='$user_id'
                                    ORDER BY sub_category_name ASC
                                ");
                                while($row = mysqli_fetch_assoc($subcategory)) {
                                ?>
                                    <option value="<?php echo $row['id']; ?>" <?php if(isset($_POST['sub_category_id']) && $_POST['sub_category_id'] == $row['id']) echo 'selected'; ?>>
                                        <?php echo $row['sub_category_name']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <div class="invalid-feedback">Please select a sub category.</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Brand</label>
                            <select name="brand_id" class="form-control">
                                <option value="">Select Brand</option>
                                <?php
                                $brand = mysqli_query($conn,"
                                    SELECT id, brand_name
                                    FROM brand
                                    WHERE delete_flag='1'
                                    AND status='Active'
                                    AND user_id='$user_id'
                                    ORDER BY brand_name ASC
                                ");
                                while($row = mysqli_fetch_assoc($brand)) {
                                ?>
                                    <option value="<?php echo $row['id']; ?>" <?php if(isset($_POST['brand_id']) && $_POST['brand_id'] == $row['id']) echo 'selected'; ?>>
                                        <?php echo $row['brand_name']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <div class="invalid-feedback">Please select a brand.</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Unit</label>
                            <select name="unit_id" class="form-control">
                                <option value="">Select Unit</option>
                                <?php
                                $unit = mysqli_query($conn,"
                                    SELECT id, unit_name
                                    FROM unit
                                    WHERE delete_flag='1'
                                    AND status='Active'
                                    AND user_id='$user_id'
                                    ORDER BY unit_name ASC
                                ");
                                while($row = mysqli_fetch_assoc($unit)) {
                                ?>
                                    <option value="<?php echo $row['id']; ?>" <?php if(isset($_POST['unit_id']) && $_POST['unit_id'] == $row['id']) echo 'selected'; ?>>
                                        <?php echo $row['unit_name']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <div class="invalid-feedback">Please select a unit.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- STEP 2: Pricing Information -->
    <div class="wizard-section" data-step="2">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">💰 Pricing Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Purchase Price <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="purchase_price" class="form-control" placeholder="0.00" required min="0" value="<?php echo isset($_POST['purchase_price']) ? htmlspecialchars($_POST['purchase_price']) : ''; ?>">
                            <div class="invalid-feedback">Purchase price is required and must be 0 or greater.</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Sale Price <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="sale_price" class="form-control" placeholder="0.00" required min="0" value="<?php echo isset($_POST['sale_price']) ? htmlspecialchars($_POST['sale_price']) : ''; ?>">
                            <div class="invalid-feedback">Sale price is required and must be 0 or greater.</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>MRP <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="mrp" class="form-control" placeholder="0.00" required min="0" value="<?php echo isset($_POST['mrp']) ? htmlspecialchars($_POST['mrp']) : ''; ?>">
                            <div class="invalid-feedback">MRP is required and must be 0 or greater.</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>GST %</label>
                            <input type="number" step="0.01" name="gst" class="form-control" placeholder="Enter GST %" min="0" max="100" value="<?php echo isset($_POST['gst']) ? htmlspecialchars($_POST['gst']) : ''; ?>">
                            <div class="invalid-feedback">GST must be between 0 and 100.</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>HSN Code</label>
                            <input type="text" name="hsn_code" class="form-control" placeholder="Enter HSN Code" maxlength="20" value="<?php echo isset($_POST['hsn_code']) ? htmlspecialchars($_POST['hsn_code']) : ''; ?>" pattern="[0-9]{4,8}" title="HSN code must be 4 to 8 digits">
                            <div class="invalid-feedback">HSN code must be 4 to 8 digits only.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- STEP 3: Stock Information -->
    <div class="wizard-section" data-step="3">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">📊 Stock Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Opening Stock</label>
                            <input type="number" name="opening_stock" class="form-control" placeholder="Enter Opening Stock" min="0" value="<?php echo isset($_POST['opening_stock']) ? htmlspecialchars($_POST['opening_stock']) : ''; ?>">
                            <div class="invalid-feedback">Opening stock must be 0 or greater.</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Alert Quantity <span class="text-danger">*</span></label>
                            <input type="number" name="alert_qty" class="form-control" placeholder="Enter Alert Quantity" min="0" required value="<?php echo isset($_POST['alert_qty']) ? htmlspecialchars($_POST['alert_qty']) : ''; ?>">
                            <div class="invalid-feedback">Alert quantity is required and must be 0 or greater.</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Reorder Level</label>
                            <input type="number" name="reorder_level" class="form-control" placeholder="Enter Reorder Level" min="0" value="<?php echo isset($_POST['reorder_level']) ? htmlspecialchars($_POST['reorder_level']) : ''; ?>">
                            <div class="invalid-feedback">Reorder level must be 0 or greater.</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Shelf Location</label>
                            <input type="text" name="shelf_location" class="form-control" placeholder="Enter Shelf Location" maxlength="100" value="<?php echo isset($_POST['shelf_location']) ? htmlspecialchars($_POST['shelf_location']) : ''; ?>">
                            <div class="invalid-feedback">Shelf location max 100 characters.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- STEP 4: Batch & Expiry -->
    <div class="wizard-section" data-step="4">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">📦 Batch & Expiry</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Batch Applicable <span class="text-danger">*</span></label>
                            <select id="batch_applicable" name="batch_applicable" class="form-control" required>
                                <option value="No" <?php if(isset($_POST['batch_applicable']) && $_POST['batch_applicable'] == 'No') echo 'selected'; ?>>No</option>
                                <option value="Yes" <?php if(isset($_POST['batch_applicable']) && $_POST['batch_applicable'] == 'Yes') echo 'selected'; ?>>Yes</option>
                            </select>
                            <div class="invalid-feedback">Please select batch applicability.</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Expiry Applicable <span class="text-danger">*</span></label>
                            <select id="expiry_applicable" name="expiry_applicable" class="form-control" required>
                                <option value="No" <?php if(isset($_POST['expiry_applicable']) && $_POST['expiry_applicable'] == 'No') echo 'selected'; ?>>No</option>
                                <option value="Yes" <?php if(isset($_POST['expiry_applicable']) && $_POST['expiry_applicable'] == 'Yes') echo 'selected'; ?>>Yes</option>
                            </select>
                            <div class="invalid-feedback">Please select expiry applicability.</div>
                        </div>
                    </div>
                    <div class="col-md-6" id="batch_div">
                        <div class="form-group">
                            <label>Default Batch Number</label>
                            <input type="text" name="batch_no" class="form-control" placeholder="Enter Batch Number" maxlength="50" value="<?php echo isset($_POST['batch_no']) ? htmlspecialchars($_POST['batch_no']) : ''; ?>">
                            <div class="invalid-feedback">Batch number max 50 characters.</div>
                        </div>
                    </div>
                    <div class="col-md-6" id="expiry_div">
                        <div class="form-group">
                            <label>Default Expiry Date</label>
                            <input type="date" name="expiry_date" class="form-control" value="<?php echo isset($_POST['expiry_date']) ? htmlspecialchars($_POST['expiry_date']) : ''; ?>">
                            <div class="invalid-feedback">Please select a valid expiry date.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- STEP 5: Product Attributes -->
    <div class="wizard-section" data-step="5">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">🎨 Product Attributes</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Product Color</label>
                            <input type="text" name="product_color" class="form-control" placeholder="Enter Product Color" maxlength="50" value="<?php echo isset($_POST['product_color']) ? htmlspecialchars($_POST['product_color']) : ''; ?>" pattern="[A-Za-z\s]*" title="Only alphabets allowed">
                            <div class="invalid-feedback">Product color can only contain alphabets and spaces.</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Product Size</label>
                            <input type="text" name="product_size" class="form-control" placeholder="Enter Product Size" maxlength="50" value="<?php echo isset($_POST['product_size']) ? htmlspecialchars($_POST['product_size']) : ''; ?>">
                            <div class="invalid-feedback">Product size max 50 characters.</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Product Weight</label>
                            <input type="text" name="product_weight" class="form-control" placeholder="Ex. 500 gm / 2 Kg" maxlength="50" value="<?php echo isset($_POST['product_weight']) ? htmlspecialchars($_POST['product_weight']) : ''; ?>">
                            <div class="invalid-feedback">Product weight max 50 characters.</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Serial Number Required</label>
                            <select name="serial_required" class="form-control">
                                <option value="Yes" <?php if(isset($_POST['serial_required']) && $_POST['serial_required'] == 'Yes') echo 'selected'; ?>>Yes</option>
                                <option value="No" <?php if(!isset($_POST['serial_required']) || (isset($_POST['serial_required']) && $_POST['serial_required'] == 'No')) echo 'selected'; ?>>No</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- STEP 6: Manufacturer Details -->
    <div class="wizard-section" data-step="6">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">🏭 Manufacturer Details</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Manufacturer Name</label>
                            <input type="text" name="manufacturer_name" class="form-control" placeholder="Enter Manufacturer Name" maxlength="255" value="<?php echo isset($_POST['manufacturer_name']) ? htmlspecialchars($_POST['manufacturer_name']) : ''; ?>" pattern="[A-Za-z\s\.\-]*" title="Only alphabets, spaces, dots and hyphens allowed">
                            <div class="invalid-feedback">Manufacturer name can only contain alphabets, spaces, dots and hyphens.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- STEP 7: Product Details -->
    <div class="wizard-section" data-step="7">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">🖼️ Product Details</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Product Image</label>
                            <input type="file" name="product_image" class="form-control" id="product_image" accept=".jpg,.jpeg,.png,.webp">
                            <div id="imageError" class="invalid-feedback" style="display:none;"></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" rows="5" class="form-control" placeholder="Enter Product Description" maxlength="1000"><?php echo isset($_POST['description']) ? htmlspecialchars($_POST['description']) : ''; ?></textarea>
                            <div class="invalid-feedback">Description max 1000 characters.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- STEP 8: Status & Submit -->
    <div class="wizard-section" data-step="8">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">⚙️ Status</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Status <span class="text-danger">*</span></label>
                            <select class="form-control" name="status" required>
                                <option value="active" <?php if(isset($_POST['status']) && $_POST['status'] == 'active') echo 'selected'; ?>>Active</option>
                                <option value="inactive" <?php if(isset($_POST['status']) && $_POST['status'] == 'inactive') echo 'selected'; ?>>Inactive</option>
                            </select>
                            <div class="invalid-feedback">Please select a status.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Submit Buttons (inside final step) -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="mt-3">
                    <button type="submit" name="submit" class="btn btn-primary mr-2">Save Product</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                </div>
            </div>
        </div>
    </div>

</div><!-- /.wizard-sections -->

<!-- ===== WIZARD NAVIGATION ===== -->
<div class="wizard-navigation mt-4">
    <button type="button" class="btn btn-secondary" id="prevBtn" disabled>Previous</button>
    <button type="button" class="btn btn-primary" id="nextBtn">Next</button>
</div>

</form>

                    </div>
                </div>
            </div>
        </div>
        <!-- Page end  -->
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
                            <span class="mr-1"><script type="f10706e47e51801eb8b60eb5-text/javascript">document.write(new Date().getFullYear())</script>©</span> <a href="#" class="">POS Dash</a>.
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <style>
        /* ===== Wizard Styles (same as User Registration Wizard) ===== */
        .wizard-steps-wrapper {
            margin-bottom: 30px;
            position: relative;
        }
        .wizard-nav {
            display: flex;
            justify-content: space-between;
            padding: 0;
            margin: 0 0 10px 0;
            list-style: none;
            position: relative;
        }
        .wizard-nav .step-item {
            flex: 1;
            text-align: center;
            position: relative;
            cursor: default;
        }
        .wizard-nav .step-item .nav-link {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 8px 0;
            background: transparent !important;
            border: none !important;
            color: #9aa5b5;
            transition: all 0.3s ease;
            position: relative;
            cursor: default;
            pointer-events: none;
        }
        .wizard-nav .step-item .step-circle {
            width: 40px;
            height: 40px;
            line-height: 40px;
            border-radius: 50%;
            background: #e9ecef;
            color: #6c757d;
            font-weight: 700;
            font-size: 16px;
            display: inline-block;
            margin-bottom: 6px;
            transition: all 0.3s ease;
            border: 3px solid transparent;
        }
        .wizard-nav .step-item .step-label {
            font-size: 13px;
            font-weight: 600;
            color: #6c757d;
            transition: all 0.3s ease;
        }
        .wizard-nav .step-item.active .step-circle {
            background: #32bdea;
            color: #fff;
            border-color: #32bdea;
            box-shadow: 0 0 0 4px rgba(50, 189, 234, 0.25);
        }
        .wizard-nav .step-item.active .step-label {
            color: #32bdea;
        }
        .wizard-nav .step-item.completed .step-circle {
            background: #78c091;
            color: #fff;
            border-color: #78c091;
        }
        .wizard-nav .step-item.completed .step-label {
            color: #78c091;
        }
        .wizard-nav .step-item:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 20px;
            left: calc(50% + 25px);
            right: calc(-50% + 25px);
            height: 3px;
            background: #e9ecef;
            z-index: 0;
        }
        .wizard-nav .step-item.completed:not(:last-child)::after {
            background: #78c091;
        }
        .wizard-nav .step-item.active:not(:last-child)::after {
            background: #e9ecef;
        }

        .wizard-progress {
            height: 6px;
            background: #e9ecef;
            border-radius: 4px;
            margin: 10px 0 0 0;
            overflow: hidden;
            position: relative;
        }
        .wizard-progress .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #32bdea, #158df7);
            border-radius: 4px;
            transition: width 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            width: 20%;
        }

        .wizard-section {
            display: none;
            animation: fadeSlide 0.4s ease forwards;
        }
        .wizard-section.active {
            display: block;
        }
        @keyframes fadeSlide {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        .wizard-navigation {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #dcdfe8;
        }
        .wizard-navigation .btn {
            min-width: 120px;
            padding: 10px 25px;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .wizard-navigation .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
        .wizard-navigation .btn-primary {
            background: linear-gradient(135deg, #32bdea, #158df7);
            border: none;
            color: #fff;
        }
        .wizard-navigation .btn-primary:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(50, 189, 234, 0.35);
        }
        .wizard-navigation .btn-success {
            background: linear-gradient(135deg, #78c091, #55b075);
            border: none;
            color: #fff;
        }
        .wizard-navigation .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(120, 192, 145, 0.35);
        }

        /* Validation error styling */
        .wizard-section .form-control.is-invalid {
            border-color: #e08db4;
        }
        .wizard-section .invalid-feedback {
            display: none;
            font-size: 80%;
            color: #e08db4;
        }
        .wizard-section .form-control.is-invalid ~ .invalid-feedback {
            display: block;
        }

        @media (max-width: 768px) {
            .wizard-nav .step-item .step-label {
                font-size: 11px;
            }
            .wizard-nav .step-item .step-circle {
                width: 32px;
                height: 32px;
                line-height: 32px;
                font-size: 13px;
            }
            .wizard-nav .step-item:not(:last-child)::after {
                top: 16px;
                left: calc(50% + 18px);
                right: calc(-50% + 18px);
            }
            .wizard-navigation {
                flex-direction: column;
                gap: 10px;
            }
            .wizard-navigation .btn {
                width: 100%;
                min-width: unset;
            }
        }
        @media (max-width: 480px) {
            .wizard-nav .step-item .step-label {
                font-size: 9px;
            }
            .wizard-nav .step-item .step-circle {
                width: 26px;
                height: 26px;
                line-height: 26px;
                font-size: 11px;
                margin-bottom: 3px;
            }
            .wizard-nav .step-item:not(:last-child)::after {
                top: 13px;
                left: calc(50% + 14px);
                right: calc(-50% + 14px);
            }
        }
      </style>

    </footer>


    <!-- Backend Bundle JavaScript -->
    <script src="../assets/js/backend-bundle.min.js" type="f10706e47e51801eb8b60eb5-text/javascript"></script>
    
    <!-- Table Treeview JavaScript -->
    <script src="../assets/js/table-treeview.js" type="f10706e47e51801eb8b60eb5-text/javascript"></script>
    
    <!-- Chart Custom JavaScript -->
    <script src="../assets/js/customizer.js" type="f10706e47e51801eb8b60eb5-text/javascript"></script>
    
    <!-- Chart Custom JavaScript -->
    <script async src="../assets/js/chart-custom.js" type="f10706e47e51801eb8b60eb5-text/javascript"></script>
    
    <!-- app JavaScript -->
    <script src="../assets/js/app.js" type="f10706e47e51801eb8b60eb5-text/javascript"></script>
  <script src="../../../cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="f10706e47e51801eb8b60eb5-|49" defer></script><script defer src="https://static.cloudflareinsights.com/beacon.min.js/v833ccba57c9e4d2798f2e76cebdd09a11778172276447" integrity="sha512-57MDmcccJXYtNnH+ZiBwzC4jb2rvgVCEokYN+L/nLlmO8rfYT/gIpW2A569iJ/3b+0UEasghjuZH/ma3wIs/EQ==" data-cf-beacon='{"version":"2024.11.0","token":"41ccecab40284244aa0b52f56036ee92","r":1,"server_timing":{"name":{"cfCacheStatus":true,"cfEdge":true,"cfExtPri":true,"cfL4":true,"cfOrigin":true,"cfSpeedBrain":true},"location_startswith":null}}' crossorigin="anonymous"></script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'a1340e473c5dcdfa',t:'MTc4MjcyNjkyOA=='};var a=document.createElement('script');a.src='../../../cdn-cgi/challenge-platform/h/b/scripts/jsd/25e6c66701a0/maind41d.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script>

<script>
// =============================================
// WIZARD JAVASCRIPT - SAME AS USER REGISTRATION
// =============================================
document.addEventListener('DOMContentLoaded', function() {
    const sections = document.querySelectorAll('.wizard-section');
    const stepItems = document.querySelectorAll('.step-item');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const progressBar = document.getElementById('wizardProgressBar');
    let currentStep = 1;
    const totalSteps = sections.length;

    // ---- Additional validation helpers ----
    function validateField(field) {
        if (field.hasAttribute('required') && !field.value.trim()) {
            return false;
        }
        // Check pattern attribute
        if (field.getAttribute('pattern')) {
            const pattern = new RegExp(field.getAttribute('pattern'));
            if (field.value && !pattern.test(field.value)) {
                return false;
            }
        }
        // Check min/max for number inputs
        if (field.type === 'number') {
            const min = parseFloat(field.getAttribute('min'));
            const max = parseFloat(field.getAttribute('max'));
            const val = parseFloat(field.value);
            if (field.value && !isNaN(val)) {
                if (!isNaN(min) && val < min) return false;
                if (!isNaN(max) && val > max) return false;
            }
        }
        // Special: sale price >= purchase price (both in same step)
        if (field.name === 'sale_price') {
            const purchasePrice = field.closest('.wizard-section').querySelector('[name="purchase_price"]');
            if (purchasePrice && purchasePrice.value && field.value) {
                const pp = parseFloat(purchasePrice.value);
                const sp = parseFloat(field.value);
                if (!isNaN(pp) && !isNaN(sp) && sp < pp) return false;
            }
        }
        // Special: MRP >= sale price
        if (field.name === 'mrp') {
            const salePrice = field.closest('.wizard-section').querySelector('[name="sale_price"]');
            if (salePrice && salePrice.value && field.value) {
                const sp = parseFloat(salePrice.value);
                const mrp = parseFloat(field.value);
                if (!isNaN(sp) && !isNaN(mrp) && mrp < sp) return false;
            }
        }
        // Image validation
        if (field.type === 'file' && field.files && field.files.length > 0) {
            const file = field.files[0];
            const validTypes = ['image/jpeg', 'image/png', 'image/webp'];
            if (!validTypes.includes(file.type)) {
                return false;
            }
            if (file.size > 2 * 1024 * 1024) {
                return false;
            }
        }
        return true;
    }

    function validateCurrentStep() {
        const currentSection = document.querySelector('.wizard-section.active');
        if (!currentSection) return true;

        const fields = currentSection.querySelectorAll('input, select, textarea');
        let isValid = true;

        // Clear previous validation states
        fields.forEach(f => {
            f.classList.remove('is-invalid');
        });

        // Check required fields first
        const requiredFields = currentSection.querySelectorAll('[required]');
        for (let field of requiredFields) {
            if (field.offsetParent === null) continue;
            if (!validateField(field)) {
                field.classList.add('is-invalid');
                if (isValid) {
                    field.focus();
                    // Show custom message for specific cases
                    if (field.name === 'product_name' && !field.value.trim()) {
                        // already handled by required
                    }
                }
                isValid = false;
                // Don't break, mark all invalid fields
            }
        }

        // Check all fields with validation attributes
        const allFields = currentSection.querySelectorAll('input:not([required]), select:not([required]), textarea:not([required])');
        for (let field of allFields) {
            if (field.offsetParent === null) continue;
            if (field.value && !validateField(field)) {
                field.classList.add('is-invalid');
                isValid = false;
            }
        }

        // Special validation: if batch_applicable is Yes, batch_no is required
        const batchSelect = currentSection.querySelector('#batch_applicable');
        if (batchSelect && batchSelect.value === 'Yes') {
            const batchInput = currentSection.querySelector('[name="batch_no"]');
            if (batchInput && !batchInput.value.trim()) {
                batchInput.classList.add('is-invalid');
                if (isValid) batchInput.focus();
                isValid = false;
            }
        }

        // Special validation: if expiry_applicable is Yes, expiry_date is required
        const expirySelect = currentSection.querySelector('#expiry_applicable');
        if (expirySelect && expirySelect.value === 'Yes') {
            const expiryInput = currentSection.querySelector('[name="expiry_date"]');
            if (expiryInput && !expiryInput.value) {
                expiryInput.classList.add('is-invalid');
                if (isValid) expiryInput.focus();
                isValid = false;
            }
        }

        // Image validation
        const fileInput = currentSection.querySelector('#product_image');
        if (fileInput && fileInput.files && fileInput.files.length > 0) {
            const file = fileInput.files[0];
            const validTypes = ['image/jpeg', 'image/png', 'image/webp'];
            const errorEl = document.getElementById('imageError');
            if (!validTypes.includes(file.type)) {
                fileInput.classList.add('is-invalid');
                if (errorEl) { errorEl.style.display = 'block'; errorEl.textContent = 'Only JPG, JPEG, PNG, WEBP allowed.'; }
                isValid = false;
            } else if (file.size > 2 * 1024 * 1024) {
                fileInput.classList.add('is-invalid');
                if (errorEl) { errorEl.style.display = 'block'; errorEl.textContent = 'File size must be less than 2 MB.'; }
                isValid = false;
            } else {
                if (errorEl) { errorEl.style.display = 'none'; }
            }
        }

        // If any field is invalid, show a general alert
        if (!isValid) {
            // Scroll to first invalid field
            const firstInvalid = currentSection.querySelector('.is-invalid');
            if (firstInvalid) {
                firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }

        return isValid;
    }

    function updateWizard() {
        sections.forEach((section) => {
            const stepNum = parseInt(section.dataset.step);
            section.classList.toggle('active', stepNum === currentStep);
        });

        stepItems.forEach((item) => {
            const stepNum = parseInt(item.dataset.step);
            item.classList.remove('active', 'completed');
            if (stepNum === currentStep) {
                item.classList.add('active');
            } else if (stepNum < currentStep) {
                item.classList.add('completed');
            }
        });

        const progress = ((currentStep - 1) / (totalSteps - 1)) * 100;
        progressBar.style.width = progress + '%';

        prevBtn.disabled = (currentStep === 1);
        if (currentStep === totalSteps) {
            nextBtn.textContent = 'Submit';
            nextBtn.classList.add('btn-success');
            nextBtn.classList.remove('btn-primary');
        } else {
            nextBtn.textContent = 'Next';
            nextBtn.classList.remove('btn-success');
            nextBtn.classList.add('btn-primary');
        }

        const wrapper = document.querySelector('.wizard-steps-wrapper');
        if (wrapper) {
            wrapper.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    }

    function goToStep(step) {
        if (step < 1) step = 1;
        if (step > totalSteps) step = totalSteps;
        currentStep = step;
        updateWizard();
    }

    function nextStep() {
        if (!validateCurrentStep()) {
            return;
        }

        if (currentStep < totalSteps) {
            goToStep(currentStep + 1);
        } else {
            document.getElementById('wizardForm').submit();
        }
    }

    function prevStep() {
        if (currentStep > 1) {
            goToStep(currentStep - 1);
        }
    }

    // -------- DISABLE STEP CIRCLE CLICKS --------
    stepItems.forEach((item) => {
        item.style.cursor = 'default';
        const link = item.querySelector('.nav-link');
        if (link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                return false;
            });
        }
    });

    // -------- BUTTON EVENTS --------
    nextBtn.addEventListener('click', nextStep);
    prevBtn.addEventListener('click', prevStep);

    // -------- KEYBOARD NAVIGATION --------
    document.addEventListener('keydown', function(e) {
        const tag = e.target.tagName.toLowerCase();
        if (tag === 'input' || tag === 'textarea' || tag === 'select') return;

        if (e.key === 'ArrowRight' || e.key === 'ArrowDown') {
            e.preventDefault();
            nextStep();
        } else if (e.key === 'ArrowLeft' || e.key === 'ArrowUp') {
            e.preventDefault();
            prevStep();
        }
    });

    // -------- ENTER KEY ON FORM FIELDS --------
    document.querySelectorAll('input, select, textarea').forEach(function(field) {
        field.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                if (currentStep === totalSteps) {
                    if (validateCurrentStep()) {
                        document.getElementById('wizardForm').submit();
                    }
                } else {
                    nextStep();
                }
            }
        });
    });

    // -------- BATCH / EXPIRY TOGGLE (within wizard) --------
    function toggleBatchFields() {
        const batchSelect = document.getElementById('batch_applicable');
        const batchDiv = document.getElementById('batch_div');
        if (batchSelect && batchDiv) {
            batchDiv.style.display = (batchSelect.value === 'Yes') ? '' : 'none';
        }
    }

    function toggleExpiryFields() {
        const expirySelect = document.getElementById('expiry_applicable');
        const expiryDiv = document.getElementById('expiry_div');
        if (expirySelect && expiryDiv) {
            expiryDiv.style.display = (expirySelect.value === 'Yes') ? '' : 'none';
        }
    }

    const batchSelect = document.getElementById('batch_applicable');
    if (batchSelect) {
        batchSelect.addEventListener('change', toggleBatchFields);
        toggleBatchFields();
    }

    const expirySelect = document.getElementById('expiry_applicable');
    if (expirySelect) {
        expirySelect.addEventListener('change', toggleExpiryFields);
        toggleExpiryFields();
    }

    // -------- IMAGE VALIDATION ON CHANGE --------
    const fileInput = document.getElementById('product_image');
    if (fileInput) {
        fileInput.addEventListener('change', function() {
            const errorEl = document.getElementById('imageError');
            if (this.files && this.files.length > 0) {
                const file = this.files[0];
                const validTypes = ['image/jpeg', 'image/png', 'image/webp'];
                if (!validTypes.includes(file.type)) {
                    this.classList.add('is-invalid');
                    if (errorEl) { errorEl.style.display = 'block'; errorEl.textContent = 'Only JPG, JPEG, PNG, WEBP allowed.'; }
                } else if (file.size > 2 * 1024 * 1024) {
                    this.classList.add('is-invalid');
                    if (errorEl) { errorEl.style.display = 'block'; errorEl.textContent = 'File size must be less than 2 MB.'; }
                } else {
                    this.classList.remove('is-invalid');
                    if (errorEl) { errorEl.style.display = 'none'; }
                }
            }
        });
    }

    // -------- PRICE VALIDATION ON CHANGE --------
    document.querySelectorAll('[name="purchase_price"], [name="sale_price"], [name="mrp"]').forEach(function(field) {
        field.addEventListener('change', function() {
            const section = this.closest('.wizard-section');
            if (!section) return;
            const pp = section.querySelector('[name="purchase_price"]');
            const sp = section.querySelector('[name="sale_price"]');
            const mrp = section.querySelector('[name="mrp"]');
            if (sp && pp && sp.value && pp.value) {
                const spVal = parseFloat(sp.value);
                const ppVal = parseFloat(pp.value);
                if (!isNaN(spVal) && !isNaN(ppVal) && spVal < ppVal) {
                    sp.classList.add('is-invalid');
                } else {
                    sp.classList.remove('is-invalid');
                }
            }
            if (mrp && sp && mrp.value && sp.value) {
                const mrpVal = parseFloat(mrp.value);
                const spVal = parseFloat(sp.value);
                if (!isNaN(mrpVal) && !isNaN(spVal) && mrpVal < spVal) {
                    mrp.classList.add('is-invalid');
                } else {
                    mrp.classList.remove('is-invalid');
                }
            }
        });
    });

    // -------- INITIALIZE --------
    updateWizard();
});
</script>
<!-- Mirrored from templates.iqonic.design/posdash/html/backend/page-add-product.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 29 Jun 2026 09:56:40 GMT -->
</html>