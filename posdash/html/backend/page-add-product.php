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
      
   <?php include 'header.php'; ?>
      <?php include 'db.php'; ?>
      

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





<form method="POST" enctype="multipart/form-data" autocomplete="off">

<!-- ========================== -->
<!-- Section 1 : Basic Information -->
<!-- ========================== -->

<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">
            📦 Basic Information
        </h5>
    </div>

    <div class="card-body">

        <div class="row">

            <!-- Product Code -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Product Code / SKU <span class="text-danger">*</span></label>

                    <input type="text"
                           name="product_code"
                           class="form-control"
                           placeholder="Auto Generate"
                           value="<?php echo $code;?>"
                           readonly
                           required>
                </div>
            </div>

            <!-- Barcode -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Barcode</label>

                    <input type="text"
                           name="barcode"
                           class="form-control"
                           placeholder="Enter Barcode"
                           maxlength="50"
                           value="<?php echo isset($_POST['barcode']) ? htmlspecialchars($_POST['barcode']) : ''; ?>">
                </div>
            </div>

            <!-- Product Name -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Product Name <span class="text-danger">*</span></label>

                    <input type="text"
                           name="product_name"
                           class="form-control"
                           placeholder="Enter Product Name"
                           required
                           maxlength="255"
                           minlength="2"
                           value="<?php echo isset($_POST['product_name']) ? htmlspecialchars($_POST['product_name']) : ''; ?>">
                </div>
            </div>


            
            <!-- Product Type -->
          <div class="col-md-6">

        <div class="form-group">

            <label>Product type <span class="text-danger">*</span></label>
            <select class="form-control" name="product_type" required>
                <option value="">Select type</option>
                <option value="Goods" <?php if(isset($_POST['product_type']) && $_POST['product_type'] == 'Goods') echo 'selected'; ?>>Goods</option>
                <option value="service" <?php if(isset($_POST['product_type']) && $_POST['product_type'] == 'service') echo 'selected'; ?>>Service</option>
            </select>
        </div>
    </div>

            <!-- Category -->

                      <div class="col-md-6">

      <div class="form-group">
    <label>Category <span class="text-danger">*</span></label>

    <select name="category_id"
            class="form-control"
            data-style="py-0"
            required>

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

        while($row = mysqli_fetch_assoc($category))
        {
        ?>
            <option value="<?php echo $row['id']; ?>" <?php if(isset($_POST['category_id']) && $_POST['category_id'] == $row['id']) echo 'selected'; ?>>
                <?php echo $row['category_name']; ?>
            </option>
        <?php
        }
        ?>

    </select>
</div>
            
</div>







<!-- Sub Category -->
               <div class="col-md-6">

    <div class="form-group">
    <label>Sub Category <span class="text-danger">*</span></label>

    <select name="sub_category_id"
            class="form-control"
            data-style="py-0"
            required>

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

        while($row = mysqli_fetch_assoc($subcategory))
        {
        ?>
            <option value="<?php echo $row['id']; ?>" <?php if(isset($_POST['sub_category_id']) && $_POST['sub_category_id'] == $row['id']) echo 'selected'; ?>>
                <?php echo $row['sub_category_name']; ?>
            </option>
        <?php
        }
        ?>

    </select>
</div>
    </div>

            <!-- Brand -->
               <div class="col-md-6">

      <div class="form-group">
    <label>Brand <span class="text-danger">*</span></label>

    <select name="brand_id"
            class="form-control"
            data-style="py-0"
            required>

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

        while($row = mysqli_fetch_assoc($brand))
        {
        ?>
            <option value="<?php echo $row['id']; ?>" <?php if(isset($_POST['brand_id']) && $_POST['brand_id'] == $row['id']) echo 'selected'; ?>>
                <?php echo $row['brand_name']; ?>
            </option>
        <?php
        }
        ?>

    </select>
</div>
    </div>

            <!-- Unit -->
                <div class="col-md-6">

      <div class="form-group">
    <label>Unit <span class="text-danger">*</span></label>

    <select name="unit_id"
            class="form-control"
            data-style="py-0"
            required>

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

        while($row = mysqli_fetch_assoc($unit))
        {
        ?>
            <option value="<?php echo $row['id']; ?>" <?php if(isset($_POST['unit_id']) && $_POST['unit_id'] == $row['id']) echo 'selected'; ?>>
                <?php echo $row['unit_name']; ?>
            </option>
        <?php
        }
        ?>

    </select>
</div>
    </div>

        </div>

    </div>
</div>



<div class="card mb-4">

    <div class="card-header">
        <h5 class="mb-0">
            💰 Pricing Information
        </h5>
    </div>

    <div class="card-body">

        <div class="row">

            <!-- Purchase Price -->
            <div class="col-md-4">
                <div class="form-group">
                    <label>Purchase Price <span class="text-danger">*</span></label>

                    <input type="number"
                           step="0.01"
                           name="purchase_price"
                           class="form-control"
                           placeholder="0.00"
                           required
                           min="0"
                           value="<?php echo isset($_POST['purchase_price']) ? htmlspecialchars($_POST['purchase_price']) : ''; ?>">
                </div>
            </div>

            <!-- Sale Price -->
            <div class="col-md-4">
                <div class="form-group">
                    <label>Sale Price <span class="text-danger">*</span></label>

                    <input type="number"
                           step="0.01"
                           name="sale_price"
                           class="form-control"
                           placeholder="0.00"
                           required
                           min="0"
                           value="<?php echo isset($_POST['sale_price']) ? htmlspecialchars($_POST['sale_price']) : ''; ?>">
                </div>
            </div>

            <!-- MRP -->
            <div class="col-md-4">
                <div class="form-group">
                    <label>MRP <span class="text-danger">*</span></label>

                    <input type="number"
                           step="0.01"
                           name="mrp"
                           class="form-control"
                           placeholder="0.00"
                           required
                           min="0"
                           value="<?php echo isset($_POST['mrp']) ? htmlspecialchars($_POST['mrp']) : ''; ?>">
                </div>
            </div>

            <!-- GST -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>GST %</label>

                    <input type="number"
                           step="0.01"
                           name="gst"
                           class="form-control"
                           placeholder="Enter GST %"
                           min="0"
                           max="100"
                           value="<?php echo isset($_POST['gst']) ? htmlspecialchars($_POST['gst']) : ''; ?>">
                </div>
            </div>




            <!-- HSN Code -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>HSN Code</label>

                    <input type="text"
                           name="hsn_code"
                           class="form-control"
                           placeholder="Enter HSN Code"
                           maxlength="20"
                           value="<?php echo isset($_POST['hsn_code']) ? htmlspecialchars($_POST['hsn_code']) : ''; ?>">
                </div>
            </div>

        </div>

    </div>

</div>



<div class="card mb-4">

    <div class="card-header">
        <h5 class="mb-0">
            📊 Stock Information
        </h5>
    </div>

    <div class="card-body">

        <div class="row">

            <!-- Opening Stock -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Opening Stock <span class="text-danger"></span></label>

                    <input type="number"
                           name="opening_stock"
                           class="form-control"
                           placeholder="Enter Opening Stock"
                           min="0"
                           value="<?php echo isset($_POST['opening_stock']) ? htmlspecialchars($_POST['opening_stock']) : ''; ?>">
                </div>
            </div>

            <!-- Alert Quantity -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Alert Quantity <span class="text-danger">*</span></label>

                    <input type="number"
                           name="alert_qty"
                           class="form-control"
                           placeholder="Enter Alert Quantity"
                           min="0"
                           required
                           value="<?php echo isset($_POST['alert_qty']) ? htmlspecialchars($_POST['alert_qty']) : ''; ?>">
                </div>
            </div>

            <!-- Reorder Level -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Reorder Level</label>

                    <input type="number"
                           name="reorder_level"
                           class="form-control"
                           placeholder="Enter Reorder Level"
                           min="0"
                           value="<?php echo isset($_POST['reorder_level']) ? htmlspecialchars($_POST['reorder_level']) : ''; ?>">
                </div>
            </div>

            <!-- Shelf Location -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Shelf Location</label>

                    <input type="text"
                           name="shelf_location"
                           class="form-control"
                           placeholder="Enter Shelf Location"
                           maxlength="100"
                           value="<?php echo isset($_POST['shelf_location']) ? htmlspecialchars($_POST['shelf_location']) : ''; ?>">
                </div>
            </div>

        </div>

    </div>

</div>



<div class="card mb-4">

    <div class="card-header">
        <h5 class="mb-0">
            📦 Batch & Expiry
        </h5>
    </div>

    <div class="card-body">

        <div class="row">

            <!-- Batch Applicable -->
                  <div class="col-md-6">

        <div class="form-group">

            <label>Batch Applicable<span class="text-danger">*</span></label>
          <select
                        id="batch_applicable"
        name="batch_applicable"
            class="form-control"
            >

<option value="No" <?php if(isset($_POST['batch_applicable']) && $_POST['batch_applicable'] == 'No') echo 'selected'; ?>>No</option>

<option value="Yes" <?php if(isset($_POST['batch_applicable']) && $_POST['batch_applicable'] == 'Yes') echo 'selected'; ?>>Yes</option>

</select>
        </div>
    </div>


            <!-- Expiry Applicable -->
                  <div class="col-md-6">

        <div class="form-group">

            <label>Expiry Applicable<span class="text-danger">*</span></label>
          <select
                        id="expiry_applicable"
        name="expiry_applicable"
            class="form-control"
            >

<option value="No" <?php if(isset($_POST['expiry_applicable']) && $_POST['expiry_applicable'] == 'No') echo 'selected'; ?>>No</option>

<option value="Yes" <?php if(isset($_POST['expiry_applicable']) && $_POST['expiry_applicable'] == 'Yes') echo 'selected'; ?>>Yes</option>

</select>
        </div>
    </div>




            <!-- Batch Number -->
            <div class="col-md-6" id="batch_div">
                <div class="form-group">

                    <label>Default Batch Number</label>

                    <input type="text"
                           name="batch_no"
                           class="form-control"
                           placeholder="Enter Batch Number"
                           maxlength="50"
                           value="<?php echo isset($_POST['batch_no']) ? htmlspecialchars($_POST['batch_no']) : ''; ?>">

                </div>
            </div>

            <!-- Expiry Date -->
            <div class="col-md-6">
                <div class="form-group">

                    <label>Default Expiry Date</label>

                    <input type="date"
                           name="expiry_date"
                           class="form-control"
                           value="<?php echo isset($_POST['expiry_date']) ? htmlspecialchars($_POST['expiry_date']) : ''; ?>">

                </div>
            </div>

        </div>

    </div>

</div>
                    



<div class="card mb-4">

    <div class="card-header">
        <h5 class="mb-0">
            🎨 Product Attributes
        </h5>
    </div>

    <div class="card-body">

        <div class="row">

            <!-- Product Color -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Product Color</label>

                    <input type="text"
                           name="product_color"
                           class="form-control"
                           placeholder="Enter Product Color"
                           maxlength="50"
                           value="<?php echo isset($_POST['product_color']) ? htmlspecialchars($_POST['product_color']) : ''; ?>">
                </div>
            </div>

            <!-- Product Size -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Product Size</label>

                    <input type="text"
                           name="product_size"
                           class="form-control"
                           placeholder="Enter Product Size"
                           maxlength="50"
                           value="<?php echo isset($_POST['product_size']) ? htmlspecialchars($_POST['product_size']) : ''; ?>">
                </div>
            </div>

            <!-- Product Weight -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Product Weight</label>

                    <input type="text"
                           name="product_weight"
                           class="form-control"
                           placeholder="Ex. 500 gm / 2 Kg"
                           maxlength="50"
                           value="<?php echo isset($_POST['product_weight']) ? htmlspecialchars($_POST['product_weight']) : ''; ?>">
                </div>
            </div>

            <!-- Serial Number -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Serial Number Required</label>

                    <select name="serial_required"
                            class="form-control"
                            data-style="py-0">
                        <option value="Yes" <?php if(isset($_POST['serial_required']) && $_POST['serial_required'] == 'Yes') echo 'selected'; ?>>Yes</option>
                        <option value="No" <?php if(!isset($_POST['serial_required']) || (isset($_POST['serial_required']) && $_POST['serial_required'] == 'No')) echo 'selected'; ?>>No</option>

                    </select>
                </div>
            </div>

        </div>

    </div>

</div>





<div class="card mb-4">

    <div class="card-header">
        <h5 class="mb-0">
            🏭 Manufacturer Details
        </h5>
    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-12">

                <div class="form-group">

                    <label>Manufacturer Name</label>

                    <input type="text"
                           name="manufacturer_name"
                           class="form-control"
                           placeholder="Enter Manufacturer Name"
                           maxlength="255"
                           value="<?php echo isset($_POST['manufacturer_name']) ? htmlspecialchars($_POST['manufacturer_name']) : ''; ?>">

                </div>

            </div>

        </div>

    </div>

</div>





<div class="card mb-4">

    <div class="card-header">
        <h5 class="mb-0">
            🖼️ Product Details
        </h5>
    </div>

    <div class="card-body">

        <div class="row">

            <!-- Product Image -->
            <div class="col-md-12">

                <div class="form-group">

                    <label>Product Image</label>

                   <input
                    type="file"
                        name="product_image"
            class="form-control"
                id="product_image"
                accept="image/*">

                </div>

            </div>

            <!-- Description -->
            <div class="col-md-12">

                <div class="form-group">

                    <label>Description</label>

                    <textarea
                        name="description"
                        rows="5"
                        class="form-control"
                        placeholder="Enter Product Description"
                        maxlength="1000"><?php echo isset($_POST['description']) ? htmlspecialchars($_POST['description']) : ''; ?></textarea>

                </div>

            </div>

        </div>

    </div>

</div>




<div class="card mb-4">

    <div class="card-header">
        <h5 class="mb-0">
            ⚙️ Status
        </h5>
    </div>

    <div class="card-body">

        <div class="row">

                             <div class="col-md-6">

        <div class="form-group">

            <label>Status<span class="text-danger">*</span></label>
            <select class="form-control" name="status" required>
                <option value="active" <?php if(isset($_POST['status']) && $_POST['status'] == 'active') echo 'selected'; ?>>Active</option>
                <option value="inactive" <?php if(isset($_POST['status']) && $_POST['status'] == 'inactive') echo 'selected'; ?>>Inactive</option>
            </select>
        </div>
    </div>

        </div>

    </div>

</div>



<!-- Buttons -->

<div class="mt-3">

    <button type="submit"
            name="submit"
            class="btn btn-primary mr-2">

        Save Product

    </button>

    <button type="reset"
            class="btn btn-danger">

        Reset

    </button>

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
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'a1340e473c5dcdfa',t:'MTc4MjcyNjkyOA=='};var a=document.createElement('script');a.src='../../../cdn-cgi/challenge-platform/h/b/scripts/jsd/25e6c66701a0/maind41d.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>



<script>
document.addEventListener('DOMContentLoaded', function() {
    var fileInput = document.getElementById("product_image");
    if (fileInput) {
        fileInput.onchange = function(e) {
            const file = e.target.files[0];
            if (file) {
                var preview = document.getElementById("preview");
                if (preview) {
                    preview.src = URL.createObjectURL(file);
                    preview.style.display = "block";
                }
            }
        };
    }
});
</script>


<script>
document.addEventListener('DOMContentLoaded', function() {
    var batchSelect = document.getElementById("batch_applicable");
    if (batchSelect) {
        batchSelect.addEventListener('change', function() {
            var batchDiv = document.getElementById("batch_div");
            if (batchDiv) {
                if (this.value === "Yes") {
                    batchDiv.style.display = "";
                } else {
                    batchDiv.style.display = "none";
                }
            }
        });
        // Trigger on load to set initial state
        var event = new Event('change');
        batchSelect.dispatchEvent(event);
    }
});
</script>
<!-- Mirrored from templates.iqonic.design/posdash/html/backend/page-add-product.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 29 Jun 2026 09:56:40 GMT -->
</html>