<!doctype html>
<html lang="en">
  
<!-- Mirrored from templates.iqonic.design/posdash/html/backend/page-list-product.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 29 Jun 2026 09:56:35 GMT -->
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
 
    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper">
      
      <?php include 'header.php'; ?>

      <?php include 'db.php'; ?>

      <?php

/*====================================================
DELETE PRODUCT
====================================================*/

if(isset($_GET['delete_id']))
{
    $id = intval($_GET['delete_id']);

    $delete = mysqli_query($conn,"
        UPDATE product
        SET
            delete_flag='0',
            modified_by='$user_id'
        WHERE id='$id'
        AND user_id='$user_id'
    ");

    if($delete)
    {
        echo "<script>
        alert('Product Deleted Successfully');
        window.location='page-list-product.php';
        </script>";
        exit;
    }
}


/*====================================================
SEARCH
====================================================*/

$search = "";

if(isset($_GET['search']))
{
    $search = mysqli_real_escape_string($conn,trim($_GET['search']));
}


/*====================================================
COMPANY WISE DASHBOARD COUNTS
====================================================*/


// Total Products

$totalProduct = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) total

FROM product p

INNER JOIN users u
ON u.id=p.user_id

WHERE

p.delete_flag='1'

AND u.company_id='$company_id'
"));




// Active Products

$activeProduct = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) total

FROM product p

INNER JOIN users u
ON u.id=p.user_id

WHERE

p.delete_flag='1'

AND p.status='Active'

AND user_id='$user_id'
"));




// Total Category

$totalCategory = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) total

FROM category

WHERE

delete_flag='1'

AND user_id='$user_id'
"));




// Total Sub Category

$totalSubCategory = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) total

FROM sub_category

WHERE

delete_flag='1'

AND user_id='$user_id'
"));




// Total Brand

$totalBrand = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) total

FROM brand

WHERE

delete_flag='1'

AND user_id='$user_id'
"));



/*====================================================
SEARCH CONDITION
====================================================*/

$searchCondition="";

if($search!="")
{

$searchCondition="

AND(

p.product_name LIKE '%$search%'

OR

c.category_name LIKE '%$search%'

OR

sc.sub_category_name LIKE '%$search%'

OR

b.brand_name LIKE '%$search%'

)

";

}

?>
      
      <div class="content-page">
     <div class="container-fluid">

     <!-- ========================================= -->
     <!-- HEADER: Title + Action Buttons -->
     <!-- ========================================= -->
     <div class="row">
        <div class="col-lg-12">
            <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="mb-2">
                        Product Management
                    </h4>
                    <p class="mb-0 text-muted">
                        Manage all products, categories, sub categories and brands from one place.
                    </p>
                </div>
                <div class="d-flex flex-wrap">
                    <a href="page-add-product.php" class="btn btn-primary mr-2 mb-2">
                        <i class="las la-plus mr-1"></i> Add Product
                    </a>
                    <a href="page-add-category.php" class="btn btn-success mr-2 mb-2">
                        <i class="las la-folder-plus mr-1"></i> Add Category
                    </a>
                    <a href="page-add-sub-category.php" class="btn btn-info mr-2 mb-2">
                        <i class="las la-tags mr-1"></i> Add Sub Category
                    </a>
                    <a href="page-add-brand.php" class="btn btn-warning mb-2">
                        <i class="las la-copyright mr-1"></i> Add Brand
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- ========================================= -->
    <!-- DASHBOARD CARDS -->
    <!-- ========================================= -->
    <div class="row mb-4">
        <div class="col-xl-3 col-lg-6 col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted mb-2">Total Products</h6>
                            <h3 class="mb-0 text-primary"><?php echo number_format($totalProduct['total']); ?></h3>
                        </div>
                        <div>
                            <i class="ri-shopping-bag-3-line" style="font-size:40px;color:#5A8DEE;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted mb-2">Active Products</h6>
                            <h3 class="mb-0 text-success"><?php echo number_format($activeProduct['total']); ?></h3>
                        </div>
                        <div>
                            <i class="ri-checkbox-circle-line" style="font-size:40px;color:#28A745;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-2 col-lg-6 col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted mb-2">Categories</h6>
                            <h3 class="mb-0 text-warning"><?php echo number_format($totalCategory['total']); ?></h3>
                        </div>
                        <div>
                            <i class="ri-folder-line" style="font-size:36px;color:#FFC107;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-2 col-lg-6 col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted mb-2">Sub Categories</h6>
                            <h3 class="mb-0 text-info"><?php echo number_format($totalSubCategory['total']); ?></h3>
                        </div>
                        <div>
                            <i class="ri-folders-line" style="font-size:36px;color:#17A2B8;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-2 col-lg-6 col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-muted mb-2">Brands</h6>
                            <h3 class="mb-0 text-danger"><?php echo number_format($totalBrand['total']); ?></h3>
                        </div>
                        <div>
                            <i class="ri-price-tag-3-line" style="font-size:36px;color:#DC3545;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ========================================= -->
    <!-- SEARCH BAR -->
    <!-- ========================================= -->
    <div class="row mb-4">
        <div class="col-lg-12">
            <form method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search Product / Category / Sub Category / Brand..." value="<?php echo htmlspecialchars($search); ?>">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="ri-search-line"></i> Search
                        </button>
                        <?php if(!empty($search)): ?>
                            <a href="page-list-product.php" class="btn btn-secondary">
                                <i class="ri-close-line"></i> Clear
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- ========================================= -->
    <!-- PRODUCT TABLE -->
    <!-- ========================================= -->
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive rounded mb-3">
                <table class="data-tables table mb-0 tbl-server-info">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>
                                <div class="checkbox d-inline-block">
                                    <input type="checkbox" class="checkbox-input" id="checkbox1">
                                    <label for="checkbox1" class="mb-0"></label>
                                </div>
                            </th>
                            <th>Product</th>
                            <th>Code</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Brand Name</th>
                            <th>Cost</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">

                    <?php
                    $sql = mysqli_query($conn,"
                    SELECT
                        p.*,
                        c.category_name,
                        sc.sub_category_name,
                        b.brand_name,
                        u.unit_name
                    FROM product p
                    INNER JOIN users us ON us.id = p.user_id
                    LEFT JOIN category c ON c.id = p.category_id
                    LEFT JOIN sub_category sc ON sc.id = p.sub_category_id
                    LEFT JOIN brand b ON b.id = p.brand_id
                    LEFT JOIN unit u ON u.id = p.unit_id
                    WHERE
                        p.delete_flag='1'
                        AND us.company_id='$company_id'
                        $searchCondition
                    ORDER BY p.id DESC
                    ");

                    $i=1;
                    while($row=mysqli_fetch_assoc($sql)):
                    ?>
                        <tr>
                            <td>
                                <div class="checkbox d-inline-block">
                                    <input type="checkbox" class="checkbox-input" id="checkbox<?php echo $i; ?>">
                                    <label for="checkbox<?php echo $i; ?>"></label>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <?php if(!empty($row['product_image'])): ?>
                                        <img src="<?php echo htmlspecialchars($row['product_image']); ?>" class="img-fluid rounded avatar-50 mr-3" alt="Product">
                                    <?php else: ?>
                                        <img src="../assets/images/product/default.png" class="img-fluid rounded avatar-50 mr-3" alt="Product">
                                    <?php endif; ?>
                                    <div>
                                        <strong><?php echo htmlspecialchars($row['product_name']); ?></strong>
                                        <br>
                                        <small class="text-muted">
                                            <?php echo htmlspecialchars(substr(strip_tags($row['description']),0,40)); ?>
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge badge-light"><?php echo htmlspecialchars($row['product_code']); ?></span>
                            </td>
                            <td><?php echo htmlspecialchars($row['category_name']); ?></td>
                            <td>₹ <?php echo number_format($row['sale_price'],2); ?></td>
                            <td><?php echo htmlspecialchars($row['brand_name']); ?></td>
                            <td>₹ <?php echo number_format($row['purchase_price'],2); ?></td>
                            <td>
                                <?php
                                if(isset($row['opening_stock'])):
                                    if($row['opening_stock']<=0):
                                        echo "<span class='badge badge-danger'>Out Of Stock</span>";
                                    elseif($row['opening_stock']<=10):
                                        echo "<span class='badge badge-warning'>".$row['opening_stock']."</span>";
                                    else:
                                        echo "<span class='badge badge-success'>".$row['opening_stock']."</span>";
                                    endif;
                                else:
                                    echo "<span class='badge badge-secondary'>N/A</span>";
                                endif;
                                ?>
                            </td>
                            <td>
                                <div class="d-flex align-items-center list-action">
                                    <a class="badge badge-info mr-2" href="view-product.php?id=<?php echo $row['id']; ?>">
                                        <i class="ri-eye-line mr-0"></i>
                                    </a>

                                    <a class="badge bg-success mr-2" href="edit-product.php?id=<?php echo $row['id']; ?>">
                                        <i class="ri-pencil-line mr-0"></i>
                                    </a>
                                    
                                    <a class="badge bg-warning mr-2" href="?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this product?')">
                                        <i class="ri-delete-bin-line mr-0"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php $i++; endwhile; ?>

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
                            <span class="mr-1"><script type="5099ec83cd38577b2f27e18b-text/javascript">document.write(new Date().getFullYear())</script>©</span> <a href="#" class="">POS Dash</a>.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Backend Bundle JavaScript -->
    <script src="../assets/js/backend-bundle.min.js" type="5099ec83cd38577b2f27e18b-text/javascript"></script>
    
    <!-- Table Treeview JavaScript -->
    <script src="../assets/js/table-treeview.js" type="5099ec83cd38577b2f27e18b-text/javascript"></script>
    
    <!-- Chart Custom JavaScript -->
    <script src="../assets/js/customizer.js" type="5099ec83cd38577b2f27e18b-text/javascript"></script>
    
    <!-- Chart Custom JavaScript -->
    <script async src="../assets/js/chart-custom.js" type="5099ec83cd38577b2f27e18b-text/javascript"></script>
    
    <!-- app JavaScript -->
    <script src="../assets/js/app.js" type="5099ec83cd38577b2f27e18b-text/javascript"></script>
  <script src="../../../cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="5099ec83cd38577b2f27e18b-|49" defer></script><script defer src="https://static.cloudflareinsights.com/beacon.min.js/v833ccba57c9e4d2798f2e76cebdd09a11778172276447" integrity="sha512-57MDmcccJXYtNnH+ZiBwzC4jb2rvgVCEokYN+L/nLlmO8rfYT/gIpW2A569iJ/3b+0UEasghjuZH/ma3wIs/EQ==" data-cf-beacon='{"version":"2024.11.0","token":"41ccecab40284244aa0b52f56036ee92","r":1,"server_timing":{"name":{"cfCacheStatus":true,"cfEdge":true,"cfExtPri":true,"cfL4":true,"cfOrigin":true,"cfSpeedBrain":true},"location_startswith":null}}' crossorigin="anonymous"></script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'a1340e43ee40f884',t:'MTc4MjcyNjkyNw=='};var a=document.createElement('script');a.src='../../../cdn-cgi/challenge-platform/h/b/scripts/jsd/25e6c66701a0/maind41d.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script>
</body>

<!-- Mirrored from templates.iqonic.design/posdash/html/backend/page-list-product.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 29 Jun 2026 09:56:38 GMT -->
</html>