<?php include 'session.php' ?>
<?php include 'permission.php' ?>

<html>
    <head>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css">
    
    </head>


   <div class="iq-sidebar  sidebar-default ">
          <div class="iq-sidebar-logo d-flex align-items-center justify-content-between">

<?php
if(!empty($_SESSION['company_logo']))
{
?>

   <a href="dashboard.php" class="header-logo">
                  <img src="../assets/documents/<?php echo $_SESSION['company_logo']; ?>" class="img-fluid rounded-normal light-logo" alt="logo"><h5 class="logo-title light-logo ml-3">UltraPOS</h5>
              </a>


<?php
}
else
{
?>
    <img src="../assets/images/default-logo.png"
         alt="Default Logo"
         height="45">
<?php
}
?>
           

              
              <div class="iq-menu-bt-sidebar ml-0">
                  <i class="las la-bars wrapper-menu"></i>
              </div>
          </div>

          <div class="data-scrollbar" data-scroll="1">
              <nav class="iq-sidebar-menu">
                  <ul id="iq-sidebar-toggle" class="iq-menu">

      <?php
if(isset($_POST['signout']))
{
    session_unset();
    session_destroy();

    echo "<script>
        localStorage.setItem('logout_success','1');
        window.location='../../../index.php';
    </script>";
    exit;
}
?>
            <?php if(hasPermission('Dashboard Management')){ ?>


                      <li class="">
                          <a href="dashboard.php" class="svg-icon">                        
                              <svg  class="svg-icon" id="p-dash1" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line>
                              </svg>
                              <span class="ml-4">Dashboards</span>
                          </a>
                      </li>

                <?php } ?>





                <?php
if(
    hasPermission('Company Management') ||
    hasPermission('Branch Management') ||
    hasPermission('Warehouse Management')
){
?>


                        <li class=" ">
                          <a href="#management" class="collapsed" data-toggle="collapse" aria-expanded="false">
                              <svg class="svg-icon" id="p-dash2" width="20" height="20"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle>
                                  <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                              </svg>
                              <span class="ml-4">Management</span>
                              <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                              </svg>
                          </a>



                          <ul id="management" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">


        <?php if(hasPermission('Company Management')){ ?>

                              <li class="">
                                  <a href="view-owner-company.php?id=<?= $company_id ?>">
                                      <i class="las la-minus"></i><span>Company</span>
                                  </a>
                              </li>
                 <?php } ?>             



                   <?php if(hasPermission('Branch Management')){ ?>
                              <li class="">
                                  <a href="page-list-branch.php">
                                      <i class="las la-minus"></i><span>Branches</span>
                                  </a>
                              </li>
                    <?php } ?> 

                         
                                   <?php if(hasPermission('Warehouse Management')){ ?>
    
                    <li class="">
                                  <a href="page-add-product.php">
                                      <i class="las la-minus"></i><span>Warehouse</span>
                                  </a>
                              </li>
                    <?php } ?>
                          </ul>
                      </li>
<?php } ?>




<?php
if(
    hasPermission('User Management') ||
    hasPermission('Role Management') ||
    hasPermission('Permission Management')
){
?>





                      <li class=" ">
                          <a href="#umanagement" class="collapsed" data-toggle="collapse" aria-expanded="false">


                             <svg class="svg-icon" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                     <circle cx="9" cy="7" r="4"></circle>
                         <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                     <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>




                              <span class="ml-4">User Management</span>
                              <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                              </svg>
                          </a>


                          <ul id="umanagement" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">


                          <?php if(hasPermission('User Management')){ ?>

                              <li class="">
                                  <a href="page-list-users.php">
                                      <i class="las la-minus"></i><span>User</span>
                                  </a>
                              </li>

                        <?php } ?>


  <?php if(hasPermission('Role Management')){ ?>
                              <li class="">
                                  <a href="page-list-role.php">
                                      <i class="las la-minus"></i><span>Role</span>
                                  </a>
                              </li>

<?php } ?>


  <?php if(hasPermission('Permission Management')){ ?>


                               <li class="">
                                  <a href="add-permission.php">
                                      <i class="las la-minus"></i><span>Permissions</span>
                                  </a>
                              </li>
<?php } ?>
                          </ul>
                      </li>
<?php } ?>






<?php
if(
    hasPermission('Category Management') ||
    hasPermission('Sub Category Management') ||
    hasPermission('Brand Management') ||
    hasPermission('Unit Management') ||
    hasPermission('Product Management') 
){
?>


                      <li class=" ">
                          <a href="#masters" class="collapsed" data-toggle="collapse" aria-expanded="false">

                          <svg class="svg-icon" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="3" width="20" height="18" rx="2"></rect>
                         <path d="M2 9h20"></path>
                                </svg>



                              <span class="ml-4">Masters</span>
                              <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                              </svg>
                          </a>



                          <ul id="masters" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">


<?php
if(
    hasPermission('Category Management')   
){
?>


                                  <li class="">
                                          <a href="page-list-category.php">
                                              <i class="las la-minus"></i><span>Category</span>
                                          </a>
                                  </li>


<?php } ?>


<?php
if(
    hasPermission('Sub Category Management')   
){
?>

                                  <li class="">
                                          <a href="page-list-subcategory.php">
                                              <i class="las la-minus"></i><span>Subcategory</span>
                                          </a>
                                  </li>


<?php } ?>



<?php
if(
    hasPermission('Brand Management')   
){
?>

                                    <li class="">
                                          <a href="page-list-brand.php">
                                              <i class="las la-minus"></i><span>Brand</span>
                                          </a>
                                  </li>


<?php } ?>


<?php
if(
    hasPermission('Unit Management')   
){
?>



                                    <li class="">
                                          <a href="page-list-unit.php">
                                              <i class="las la-minus"></i><span>Unit</span>
                                          </a>
                                  </li>

 <?php } ?>


 <?php
if(
    hasPermission('Product Management')   
){
?>


                                    <li class="">
                                          <a href="page-list-product.php">
                                              <i class="las la-minus"></i><span>Product</span>
                                          </a>
                                  </li>

                                   <?php } ?>



                          </ul>
                      </li>





<?php } ?>




<?php
if(
    hasPermission('Customer Management')   
){
?>




                         <li class=" ">
                          <a href="#customers" class="collapsed" data-toggle="collapse" aria-expanded="false">
                           <svg class="svg-icon" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <circle cx="12" cy="7" r="4"></circle>
    <path d="M5.5 21a6.5 6.5 0 0 1 13 0"></path>
</svg>
                              <span class="ml-4">Customers</span>
                              <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                              </svg>
                          </a>
                          <ul id="customers" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">



                          <?php
if(
    hasPermission('Customer Management')   
){
?>

                                  <li class="">
                                          <a href="page-list-customers.php">
                                              <i class="las la-minus"></i><span>Customer list</span>
                                          </a>
                                  </li>



                                  <?php } ?>
                                
                          </ul>
                      </li>




<?php } ?>





 <?php
if(
    hasPermission('Supplier Management')   
){
?>


                      <li class=" ">
                          <a href="#suppliers" class="collapsed" data-toggle="collapse" aria-expanded="false">
                         <svg class="svg-icon" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <rect x="1" y="3" width="15" height="13"></rect>
    <path d="M16 8h4l3 3v5h-7"></path>
    <circle cx="5.5" cy="18.5" r="2.5"></circle>
    <circle cx="18.5" cy="18.5" r="2.5"></circle>
</svg>
                              <span class="ml-4">Suppliers</span>
                              <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                              </svg>
                          </a>
                          <ul id="suppliers" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">

                                  <li class="">
                                          <a href="page-list-suppliers.php">
                                              <i class="las la-minus"></i><span>Suppliers list</span>
                                          </a>
                                  </li>
                                 
                          </ul>
                      </li>




<?php } ?>





 <?php
if(
    hasPermission('Purchase Management') ||
        hasPermission('Purchase Return Management') 

){
?>



                      <li class=" ">
                          <a href="#purchase" class="collapsed" data-toggle="collapse" aria-expanded="false">
                          <svg class="svg-icon" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <circle cx="9" cy="21" r="1"></circle>
    <circle cx="20" cy="21" r="1"></circle>
    <path d="M1 1h4l2.68 13.39A2 2 0 0 0 9.64 16h9.72a2 2 0 0 0 1.96-1.61L23 6H6"></path>
</svg>
                              <span class="ml-4">Purchases</span>
                              <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                              </svg>
                          </a>
                          <ul id="purchase" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">


                                  <li class="">
                                          <a href="page-list-purchase.php">
                                              <i class="las la-minus"></i><span>Purchases order</span>
                                          </a>
                                  </li>

                                  
                                  <li class="">
                                          <a href="page-add-purchase.php">
                                              <i class="las la-minus"></i><span>Purchase entry</span>
                                          </a>
                                  </li>



            
 <?php
if(
  
        hasPermission('Purchase Return Management') 

){
?>                      


                                   <li class="">
                                          <a href="page-add-purchase.php">
                                              <i class="las la-minus"></i><span>Purchase return</span>
                                          </a>
                                  </li>

<?php } ?>

                          </ul>
                      </li>



<?php } ?>





 <?php
if(
    hasPermission('Sales Management') ||
    hasPermission('Sales Return Management')

){
?>





                      <li class=" ">
                          <a href="#sales" class="collapsed" data-toggle="collapse" aria-expanded="false">
                         <svg class="svg-icon" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <path d="M12 1v22"></path>
    <path d="M17 5H9a4 4 0 000 8h6a4 4 0 010 8H7"></path>
</svg>
                              <span class="ml-4">Sales</span>
                              <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                              </svg>
                          </a>


                          <ul id="sales" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">


                                  <li class="">
                                          <a href="page-list-returns.php">
                                              <i class="las la-minus"></i><span>POS Billing</span>
                                          </a>
                                  </li>


                                  <li class="">
                                          <a href="page-add-return.php">
                                              <i class="las la-minus"></i><span>Sales invoice</span>
                                          </a>
                                  </li>



 <?php
if(
    hasPermission('Sales Return Management')

){
?>


                                   <li class="">
                                          <a href="page-add-return.php">
                                              <i class="las la-minus"></i><span>Sales return</span>
                                          </a>
                                  </li>

<?php } ?>



                                   <li class="">
                                          <a href="page-add-return.php">
                                              <i class="las la-minus"></i><span>Quotation</span>
                                          </a>
                                  </li>


                          </ul>
                      </li>



<?php } ?>






 <?php
if(
    hasPermission('Stock Management')

){
?>


                      <li class=" ">
                          <a href="#inventory" class="collapsed" data-toggle="collapse" aria-expanded="false">
                          <svg class="svg-icon" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <path d="M21 16V8L12 3 3 8v8l9 5 9-5z"></path>
    <path d="M3 8l9 5 9-5"></path>
</svg>
                              <span class="ml-4">Inventory</span>
                              <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                              </svg>
                          </a>
                          <ul id="inventory" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                  <li class="">
                                          <a href="page-list-customers.php">
                                              <i class="las la-minus"></i><span>Stock Ledger</span>
                                          </a>
                                  </li>
                                  <li class="active">
                                          <a href="page-add-customers.php">
                                              <i class="las la-minus"></i><span>Stock adjustment</span>
                                          </a>
                                  </li>
                                  <li class="">
                                          <a href="page-list-users.php">
                                              <i class="las la-minus"></i><span>Low Stock</span>
                                          </a>
                                  </li>
                                  <li class="">
                                          <a href="page-add-users.php">
                                              <i class="las la-minus"></i><span>Expiry Product</span>
                                          </a>
                                  </li>
                               
                          </ul>
                      </li>


<?php } ?>





                      


                      <li class=" ">
                          <a href="#accounts" class="collapsed" data-toggle="collapse" aria-expanded="false">
                              <svg class="svg-icon" id="p-dash8" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                              </svg>
                              <span class="ml-4">Accounts</span>
                              <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                              </svg>
                          </a>
                          <ul id="accounts" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                  <li class="">
                                          <a href="page-list-customers.php">
                                              <i class="las la-minus"></i><span>Payment Collection</span>
                                          </a>
                                  </li>
                                  <li class="active">
                                          <a href="page-add-customers.php">
                                              <i class="las la-minus"></i><span>Customer Ledger</span>
                                          </a>
                                  </li>

                                  <li class="">
                                          <a href="page-list-users.php">
                                              <i class="las la-minus"></i><span>Supplier ledger</span>
                                          </a>
                                  </li>

                                  <li class="">
                                          <a href="page-add-users.php">
                                              <i class="las la-minus"></i><span>Bank Account</span>
                                          </a>
                                  </li>


                                   <li class="">
                                          <a href="page-add-users.php">
                                              <i class="las la-minus"></i><span>Cash book</span>
                                          </a>
                                  </li>



                                     <li class="">
                                          <a href="page-add-users.php">
                                              <i class="las la-minus"></i><span>Expense Category</span>
                                          </a>
                                  </li>


                                   <li class="">
                                          <a href="page-add-users.php">
                                              <i class="las la-minus"></i><span>Expenses</span>
                                          </a>
                                  </li>
                               
                          </ul>
                      </li>










 <?php
if(
    hasPermission('Report Management')

){
?>










                        <li class=" ">
                          <a href="#reports" class="collapsed" data-toggle="collapse" aria-expanded="false">
                           <svg class="svg-icon" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <path d="M3 3v18h18"></path>
    <rect x="7" y="12" width="3" height="6"></rect>
    <rect x="12" y="8" width="3" height="10"></rect>
    <rect x="17" y="5" width="3" height="13"></rect>
</svg>
                              <span class="ml-4">Reports</span>
                              <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                              </svg>
                          </a>
                          <ul id="reports" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">

                              <li class="">
                                  <a href="page-list-product.php">
                                      <i class="las la-minus"></i><span>Dashboard report</span>
                                  </a>
                              </li>
                              
                              <li class="">
                                  <a href="page-add-product.php">
                                      <i class="las la-minus"></i><span>Sales report</span>
                                  </a>
                              </li>


                               <li class="">
                                  <a href="page-add-product.php">
                                      <i class="las la-minus"></i><span>Purchase report</span>
                                  </a>
                              </li>


                               <li class="">
                                  <a href="page-add-product.php">
                                      <i class="las la-minus"></i><span>Stock report</span>
                                  </a>
                              </li>

                            <li class="">
                                  <a href="page-add-product.php">
                                      <i class="las la-minus"></i><span>Profilt report</span>
                                  </a>
                              </li>

                             <li class="">
                                  <a href="page-add-product.php">
                                      <i class="las la-minus"></i><span>Purchase report</span>
                                  </a>
                              </li>


                                 <li class="">
                                  <a href="page-add-product.php">
                                      <i class="las la-minus"></i><span>Stock report</span>
                                  </a>
                              </li>



                             <li class="">
                                  <a href="page-add-product.php">
                                      <i class="las la-minus"></i><span>Profit report</span>
                                  </a>
                              </li>



                              <li class="">
                                  <a href="page-add-product.php">
                                      <i class="las la-minus"></i><span>Customer report</span>
                                  </a>
                              </li>


                              <li class="">
                                  <a href="page-add-product.php">
                                      <i class="las la-minus"></i><span>Supplier report</span>
                                  </a>
                              </li>


                               <li class="">
                                  <a href="page-add-product.php">
                                      <i class="las la-minus"></i><span>GST report</span>
                                  </a>
                              </li>


                                <li class="">
                                  <a href="page-add-product.php">
                                      <i class="las la-minus"></i><span>Payment report</span>
                                  </a>
                              </li>




                                <li class="">
                                  <a href="page-add-product.php">
                                      <i class="las la-minus"></i><span>Expense report</span>
                                  </a>
                              </li>


                          </ul>
                      </li>




<?php } ?>



                    
                      <li class=" ">
                          <a href="#prints" class="collapsed" data-toggle="collapse" aria-expanded="false">



                          <svg class="svg-icon" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <path d="M6 9V2h12v7"></path>
    <rect x="6" y="14" width="12" height="8"></rect>
    <rect x="3" y="9" width="18" height="8"></rect>
</svg>




                              <span class="ml-4">Prints</span>
                              <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                              </svg>
                          </a>


                          <ul id="prints" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                              <li class="">
                                  <a href="page-list-product.php">
                                      <i class="las la-minus"></i><span>Barcode Print</span>
                                  </a>
                              </li>

                              <li class="">
                                  <a href="page-add-product.php">
                                      <i class="las la-minus"></i><span>Product Lebels</span>
                                  </a>
                              </li>


                               <li class="">
                                  <a href="page-add-product.php">
                                      <i class="las la-minus"></i><span>Invoice labels</span>
                                  </a>
                              </li>

                          </ul>
                      </li>




 <?php
if(
    hasPermission('Settings Management')

){
?>

                    
                      <li class=" ">
                          <a href="#setting" class="collapsed" data-toggle="collapse" aria-expanded="false">
                            <svg class="svg-icon" width="20" height="20"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round">

                                <circle cx="12" cy="12" r="3"></circle>

                                <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06
                                        a2 2 0 1 1-2.83 2.83l-.06-.06
                                        a1.65 1.65 0 0 0-1.82-.33
                                        1.65 1.65 0 0 0-1 1.51V21
                                        a2 2 0 1 1-4 0v-.09
                                        a1.65 1.65 0 0 0-1-1.51
                                        1.65 1.65 0 0 0-1.82.33l-.06.06
                                        a2 2 0 1 1-2.83-2.83l.06-.06
                                        a1.65 1.65 0 0 0 .33-1.82
                                        1.65 1.65 0 0 0-1.51-1H3
                                        a2 2 0 1 1 0-4h.09
                                        a1.65 1.65 0 0 0 1.51-1
                                        1.65 1.65 0 0 0-.33-1.82l-.06-.06
                                        a2 2 0 1 1 2.83-2.83l.06.06
                                        a1.65 1.65 0 0 0 1.82.33H9
                                        a1.65 1.65 0 0 0 1-1.51V3
                                        a2 2 0 1 1 4 0v.09
                                        a1.65 1.65 0 0 0 1 1.51
                                        1.65 1.65 0 0 0 1.82-.33l.06-.06
                                        a2 2 0 1 1 2.83 2.83l-.06.06
                                        a1.65 1.65 0 0 0-.33 1.82V9
                                        a1.65 1.65 0 0 0 1.51 1H21
                                        a2 2 0 1 1 0 4h-.09
                                        a1.65 1.65 0 0 0-1.51 1z"></path>

                            </svg>
                              <span class="ml-4">Settings</span>
                              <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                              </svg>
                          </a>
                          <ul id="setting" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                  <li class="">
                                          <a href="page-list-customers.php">
                                              <i class="las la-minus"></i><span>Company setting</span>
                                          </a>
                                  </li>
                                  <li class="active">
                                          <a href="page-add-customers.php">
                                              <i class="las la-minus"></i><span>Tax settings</span>
                                          </a>
                                  </li>
                                  <li class="">
                                          <a href="page-list-users.php">
                                              <i class="las la-minus"></i><span>Backup & Restore</span>
                                          </a>
                                  </li>
                                  <li class="">
                                          <a href="page-add-users.php">
                                              <i class="las la-minus"></i><span>System setting</span>
                                          </a>
                                  </li>
                               
                          </ul>
                      </li>


<?php } ?>




                    






























                      <li class=" ">
                          <a href="#logs" class="collapsed" data-toggle="collapse" aria-expanded="false">
                            <svg class="svg-icon" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <polyline points="12 8 12 12 15 15"></polyline>
    <circle cx="12" cy="12" r="10"></circle>
</svg>
                              <span class="ml-4">Logs</span>
                              <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                              </svg>
                          </a>
                          <ul id="logs" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                  <li class="">
                                          <a href="page-list-customers.php">
                                              <i class="las la-minus"></i><span>Login logs</span>
                                          </a>
                                  </li>
                                  <li class="active">
                                          <a href="page-add-customers.php">
                                              <i class="las la-minus"></i><span>Activity Logs</span>
                                          </a>
                                  </li>
                              
                               
                          </ul>
                      </li>






                      

                      <li class=" ">
                          <a href="#otherpage" class="collapsed" data-toggle="collapse" aria-expanded="false">
                              <svg class="svg-icon" id="p-dash9" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><rect x="7" y="7" width="3" height="9"></rect><rect x="14" y="7" width="3" height="5"></rect>
                              </svg>
                              <span class="ml-4">other page</span>
                              <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                              </svg>
                          </a>
                          <ul id="otherpage" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                  <li class=" ">
                                      <a href="#user" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                          <svg class="svg-icon" id="p-dash10" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                              <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><polyline points="17 11 19 13 23 9"></polyline>
                                          </svg>
                                          <span class="ml-4">User Details</span>
                                          <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                              <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                                          </svg>
                                      </a>
                                      <ul id="user" class="iq-submenu collapse" data-parent="#otherpage">
                                              <li class="">
                                                  <a href="https://templates.iqonic.design/posdash/html/app/user-profile.php">
                                                      <i class="las la-minus"></i><span>User Profile</span>
                                                  </a>
                                              </li>
                                              <li class="">
                                                  <a href="https://templates.iqonic.design/posdash/html/app/user-add.php">
                                                      <i class="las la-minus"></i><span>User Add</span>
                                                  </a>
                                              </li>
                                              <li class="">
                                                  <a href="https://templates.iqonic.design/posdash/html/app/user-list.php">
                                                      <i class="las la-minus"></i><span>User List</span>
                                                  </a>
                                              </li>
                                      </ul>
                                  </li>
                                  <li class=" ">
                                      <a href="#ui" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                         <svg class="svg-icon" id="p-dash11" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                              <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                                          </svg>
                                          <span class="ml-4">UI Elements</span>
                                          <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                              <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                                          </svg>
                                      </a>
                                      <ul id="ui" class="iq-submenu collapse" data-parent="#otherpage">
                                              <li class="">
                                                  <a href="ui-avatars.php">
                                                      <i class="las la-minus"></i><span>Avatars</span>
                                                  </a>
                                              </li>
                                              <li class="">
                                                  <a href="ui-alerts.php">
                                                      <i class="las la-minus"></i><span>Alerts</span>
                                                  </a>
                                              </li>
                                              <li class="">
                                                  <a href="ui-badges.php">
                                                      <i class="las la-minus"></i><span>Badges</span>
                                                  </a>
                                              </li>
                                              <li class="">
                                                  <a href="ui-breadcrumb.php">
                                                      <i class="las la-minus"></i><span>Breadcrumb</span>
                                                  </a>
                                              </li>
                                              <li class="">
                                                  <a href="ui-buttons.php">
                                                      <i class="las la-minus"></i><span>Buttons</span>
                                                  </a>
                                              </li>
                                              <li class="">
                                                  <a href="ui-buttons-group.php">
                                                      <i class="las la-minus"></i><span>Buttons Group</span>
                                                  </a>
                                              </li>
                                              <li class="">
                                                  <a href="ui-boxshadow.php">
                                                      <i class="las la-minus"></i><span>Box Shadow</span>
                                                  </a>
                                              </li>
                                              <li class="">
                                                  <a href="ui-colors.php">
                                                      <i class="las la-minus"></i><span>Colors</span>
                                                  </a>
                                              </li>
                                              <li class="">
                                                  <a href="ui-cards.php">
                                                      <i class="las la-minus"></i><span>Cards</span>
                                                  </a>
                                              </li>
                                              <li class="">
                                                  <a href="ui-carousel.php">
                                                      <i class="las la-minus"></i><span>Carousel</span>
                                                  </a>
                                              </li>
                                              <li class="">
                                                  <a href="ui-grid.php">
                                                      <i class="las la-minus"></i><span>Grid</span>
                                                  </a>
                                              </li>
                                              <li class="">
                                                  <a href="ui-helper-classes.php">
                                                      <i class="las la-minus"></i><span>Helper classes</span>
                                                  </a>
                                              </li>
                                              <li class="">
                                                  <a href="ui-images.php">
                                                      <i class="las la-minus"></i><span>Images</span>
                                                  </a>
                                              </li>
                                              <li class="">
                                                  <a href="ui-list-group.php">
                                                      <i class="las la-minus"></i><span>list Group</span>
                                                  </a>
                                              </li>
                                              <li  class="">
                                                  <a href="ui-media-object.php">
                                                      <i class="las la-minus"></i><span>Media</span>
                                                  </a>
                                              </li>
                                              <li class="">
                                                  <a href="ui-modal.php">
                                                      <i class="las la-minus"></i><span>Modal</span>
                                                  </a>
                                              </li>
                                              <li class="">
                                                  <a href="ui-notifications.php">
                                                      <i class="las la-minus"></i><span>Notifications</span>
                                                  </a>
                                              </li>
                                              <li class="">
                                                  <a href="ui-pagination.php">
                                                      <i class="las la-minus"></i><span>Pagination</span>
                                                  </a>
                                              </li>
                                              <li class="">
                                                  <a href="ui-popovers.php">
                                                      <i class="las la-minus"></i><span>Popovers</span>
                                                  </a>
                                              </li>
                                              <li class="">
                                                  <a href="ui-progressbars.php">
                                                      <i class="las la-minus"></i><span>Progressbars</span>
                                                  </a>
                                              </li>
                                              <li class="">
                                                  <a href="ui-typography.php">
                                                      <i class="las la-minus"></i><span>Typography</span>
                                                  </a>
                                              </li>
                                              <li class="">
                                                  <a href="ui-tabs.php">
                                                      <i class="las la-minus"></i><span>Tabs</span>
                                                  </a>
                                              </li>
                                              <li class="">
                                                  <a href="ui-tooltips.php">
                                                      <i class="las la-minus"></i><span>Tooltips</span>
                                                  </a>
                                              </li>
                                              <li class="">
                                                  <a href="ui-embed-video.php">
                                                      <i class="las la-minus"></i><span>Video</span>
                                                  </a>
                                              </li>
                                      </ul>
                                  </li>






                                  <li class=" ">
                                      <a href="#auth" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                          <svg class="svg-icon" id="p-dash12" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                              <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline>
                                          </svg>
                                          <span class="ml-4">Authentication</span>
                                          <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                              <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                                          </svg>
                                      </a>
                                      <ul id="auth" class="iq-submenu collapse" data-parent="#otherpage">
                                              <li class="">
                                                  <a href="auth-sign-in.php">
                                                      <i class="las la-minus"></i><span>Login</span>
                                                  </a>
                                              </li>
                                              <li class="">
                                                  <a href="auth-sign-up.php">
                                                      <i class="las la-minus"></i><span>Register</span>
                                                  </a>
                                              </li>
                                              <li class="">
                                                  <a href="auth-recoverpw.php">
                                                      <i class="las la-minus"></i><span>Recover Password</span>
                                                  </a>
                                              </li>
                                              <li class="">
                                                  <a href="auth-confirm-mail.php">
                                                      <i class="las la-minus"></i><span>Confirm Mail</span>
                                                  </a>
                                              </li>
                                              <li class="">
                                                  <a href="auth-lock-screen.php">
                                                      <i class="las la-minus"></i><span>Lock Screen</span>
                                                  </a>
                                              </li>
                                      </ul>
                                  </li>
                                  <li class="">
                                      <a href="#form" class="collapsed svg-icon" data-toggle="collapse" aria-expanded="false">
                                          <svg class="svg-icon" id="p-dash13" width="20" height="20"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                              <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                                          </svg>
                                          <span class="ml-4">Forms</span>
                                          <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                              <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                                          </svg>
                                      </a>
                                      <ul id="form" class="iq-submenu collapse" data-parent="#otherpage">
                                          <li class="">
                                              <a href="form-layout.php">
                                                  <i class="las la-minus"></i><span class="">Form Elements</span>
                                              </a>
                                          </li>
                                          <li class="">
                                              <a href="form-input-group.php" class="svg-icon">
                                                 <i class="las la-minus"></i><span class="">Form Input</span>
                                              </a>
                                          </li>
                                          <li class="">
                                              <a href="form-validation.php" class="svg-icon">
                                                  <i class="las la-minus"></i><span class="">Form Validation</span>
                                              </a>
                                          </li>
                                          <li class="">
                                              <a href="form-switch.php" class="svg-icon">
                                                  <i class="las la-minus"></i><span class="">Form Switch</span>
                                              </a>
                                          </li>
                                          <li class="">
                                              <a href="form-chechbox.php" class="svg-icon">
                                                  <i class="las la-minus"></i><span class="">Form Checkbox</span>
                                              </a>
                                          </li>
                                          <li class="">
                                              <a href="form-radio.php" class="svg-icon">
                                                  <i class="las la-minus"></i><span class="">Form Radio</span>
                                              </a>
                                          </li>
                                          <li class="">
                                              <a href="form-textarea.php" class="svg-icon">
                                                  <i class="las la-minus"></i><span class="">Form Textarea</span>
                                              </a>
                                          </li>
                                      </ul>
                                  </li>
                                  <li class=" ">
                                      <a href="#table" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                          <svg class="svg-icon" id="p-dash14" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                              <rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect>
                                          </svg>
                                          <span class="ml-4">Table</span>
                                          <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                              <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                                          </svg>
                                      </a>
                                      <ul id="table" class="iq-submenu collapse" data-parent="#otherpage">
                                              <li class="">
                                                  <a href="tables-basic.php">
                                                      <i class="las la-minus"></i><span>Basic Tables</span>
                                                  </a>
                                              </li>
                                              <li class="">
                                                  <a href="table-data.php">
                                                      <i class="las la-minus"></i><span>Data Table</span>
                                                  </a>
                                              </li>
                                              <li class="">
                                                  <a href="table-tree.php">
                                                      <i class="las la-minus"></i><span>Table Tree</span>
                                                  </a>
                                              </li>
                                      </ul>
                                  </li>
                                  <li class=" ">
                                      <a href="#pricing" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                          <svg class="svg-icon" id="p-dash16" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                              <ellipse cx="12" cy="5" rx="9" ry="3"></ellipse><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path>
                                          </svg>
                                          <span class="ml-4">Pricing</span>
                                          <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                              <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                                          </svg>
                                      </a>
                                      <ul id="pricing" class="iq-submenu collapse" data-parent="#otherpage">
                                              <li class="">
                                                  <a href="pricing.php">
                                                      <i class="las la-minus"></i><span>Pricing 1</span>
                                                  </a>
                                              </li>
                                              <li class="">
                                                  <a href="pricing-2.php">
                                                      <i class="las la-minus"></i><span>Pricing 2</span>
                                                  </a>
                                              </li>
                                      </ul>
                                  </li>
                                  <li class="">
                                      <a href="pages-invoice.php" class="svg-icon">
                                          <svg class="svg-icon" id="p-dash07" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                              <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline>
                                          </svg>
                                          <span class="ml-4">Invoice</span>
                                      </a>
                                  </li>
                                  <li class=" ">
                                      <a href="#pages-error" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                          <svg class="svg-icon" id="p-dash17" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                              <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line>
                                          </svg>
                                          <span class="ml-4">Error</span>
                                          <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                              <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                                          </svg>
                                      </a>
                                      <ul id="pages-error" class="iq-submenu collapse" data-parent="#otherpage">
                                              <li class="">
                                                  <a href="pages-error.php">
                                                      <i class="las la-minus"></i><span>Error 404</span>
                                                  </a>
                                              </li>
                                              <li class="">
                                                  <a href="pages-error-500.php">
                                                      <i class="las la-minus"></i><span>Error 500</span>
                                                  </a>
                                              </li>
                                      </ul>
                                  </li>
                                  <li class="">
                                          <a href="pages-blank-page.php">
                                              <svg class="svg-icon" id="p-dash18" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                  <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline>
                                              </svg>
                                              <span class="ml-4">Blank Page</span>
                                          </a>
                                  </li>
                                  <li class="">
                                          <a href="pages-maintenance.php">
                                              <svg class="svg-icon" id="p-dash19" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                  <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
                                              </svg>
                                              <span class="ml-4">Maintenance</span>
                                          </a>
                                  </li>
                          </ul>
                      </li>
                  </ul>
              </nav>
              
              <div class="p-3"></div>
          </div>
          </div>      <div class="iq-top-navbar">
          <div class="iq-navbar-custom">
              <nav class="navbar navbar-expand-lg navbar-light p-0">
                  <div class="iq-navbar-logo d-flex align-items-center justify-content-between">
                      <i class="ri-menu-line wrapper-menu"></i>
                      <a href="dashboard.php" class="header-logo">
                          <img src="../assets/images/ultronyc-logo.png" class="img-fluid rounded-normal" alt="logo">
                          <h5 class="logo-title ml-3">UltraPOS</h5>
      
                      </a>
                  </div>
                  <div class="iq-search-bar device-search
                  ">
                      <form action="#" class="searchbox">
                          <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                          <input type="text" class="text search-input" placeholder="Search here...">
                      </form>
                  </div>
                  <div class="d-flex align-items-center">
                      <button class="navbar-toggler" type="button" data-toggle="collapse"
                          data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                          aria-label="Toggle navigation">
                          <i class="ri-menu-3-line"></i>
                      </button>
                      <div class="collapse navbar-collapse" id="navbarSupportedContent">
                          <ul class="navbar-nav ml-auto navbar-list align-items-center">
                              <li class="nav-item nav-icon dropdown">
                                  <a href="#" class="search-toggle dropdown-toggle btn border add-btn"
                                      id="dropdownMenuButton02" data-toggle="dropdown" aria-haspopup="true"
                                      aria-expanded="false">
                                      <img src="../assets/images/small/flag-02.png" alt="img-flag"
                                          class="img-fluid image-flag mr-2">In
                                  </a>
                                  <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                      <div class="card shadow-none m-0">


                                          <div class="card-body p-3">
                                              <a class="iq-sub-card" href="#"><img
                                                      src="../assets/images/small/flag-02.png" alt="img-flag"
                                                      class="img-fluid mr-2">French</a>
                                              <a class="iq-sub-card" href="#"><img
                                                      src="../assets/images/small/flag-03.png" alt="img-flag"
                                                      class="img-fluid mr-2">Spanish</a>
                                              <a class="iq-sub-card" href="#"><img
                                                      src="../assets/images/small/flag-04.png" alt="img-flag"
                                                      class="img-fluid mr-2">Italian</a>
                                              <a class="iq-sub-card" href="#"><img
                                                      src="../assets/images/small/flag-05.png" alt="img-flag"
                                                      class="img-fluid mr-2">German</a>
                                              <a class="iq-sub-card" href="#"><img
                                                      src="../assets/images/small/flag-06.png" alt="img-flag"
                                                      class="img-fluid mr-2">Japanese</a>
                                          </div>


                                      </div>
                                  </div>
                              </li>
                              <li>
                                  <a href="#" class="btn border add-btn shadow-none mx-2 d-none d-md-block"
                                      data-toggle="modal" data-target="#new-order"><i class="las la-plus mr-2"></i>New
                                      Order</a>
                              </li>
                              <li class="nav-item nav-icon search-content">
                                  <a href="#" class="search-toggle rounded" id="dropdownSearch" data-toggle="dropdown"
                                      aria-haspopup="true" aria-expanded="false">
                                      <i class="ri-search-line"></i>
                                  </a>
                                  <div class="iq-search-bar iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownSearch">
                                      <form action="#" class="searchbox p-2">
                                          <div class="form-group mb-0 position-relative">
                                              <input type="text" class="text search-input font-size-12"
                                                  placeholder="type here to search...">
                                              <a href="#" class="search-link"><i class="las la-search"></i></a>
                                          </div>
                                      </form>
                                  </div>
                              </li>
                              <li class="nav-item nav-icon dropdown">
                                  <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton2"
                                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                          fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                          stroke-linejoin="round" class="feather feather-mail">
                                          <path
                                              d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                          </path>
                                          <polyline points="22,6 12,13 2,6"></polyline>
                                      </svg>
                                      <span class="bg-primary"></span>
                                  </a>
                                  <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                      <div class="card shadow-none m-0">
                                          <div class="card-body p-0 ">
                                              <div class="cust-title p-3">
                                                  <div class="d-flex align-items-center justify-content-between">
                                                      <h5 class="mb-0">All Messages</h5>
                                                      <a class="badge badge-primary badge-card" href="#">3</a>
                                                  </div>
                                              </div>
                                              <div class="px-3 pt-0 pb-0 sub-card">
                                                  <a href="#" class="iq-sub-card">
                                                      <div class="media align-items-center cust-card py-3 border-bottom">
                                                          <div class="">
                                                              <img class="avatar-50 rounded-small"
                                                                  src="../assets/images/user/01.jpg" alt="01">
                                                          </div>
                                                          <div class="media-body ml-3">
                                                              <div class="d-flex align-items-center justify-content-between">
                                                                  <h6 class="mb-0">Emma Watson</h6>
                                                                  <small class="text-dark"><b>12 : 47 pm</b></small>
                                                              </div>
                                                              <small class="mb-0">Lorem ipsum dolor sit amet</small>
                                                          </div>
                                                      </div>
                                                  </a>
                                                  <a href="#" class="iq-sub-card">
                                                      <div class="media align-items-center cust-card py-3 border-bottom">
                                                          <div class="">
                                                              <img class="avatar-50 rounded-small"
                                                                  src="../assets/images/user/02.jpg" alt="02">
                                                          </div>
                                                          <div class="media-body ml-3">
                                                              <div class="d-flex align-items-center justify-content-between">
                                                                  <h6 class="mb-0">Ashlynn Franci</h6>
                                                                  <small class="text-dark"><b>11 : 30 pm</b></small>
                                                              </div>
                                                              <small class="mb-0">Lorem ipsum dolor sit amet</small>
                                                          </div>
                                                      </div>
                                                  </a>
                                                  <a href="#" class="iq-sub-card">
                                                      <div class="media align-items-center cust-card py-3">
                                                          <div class="">
                                                              <img class="avatar-50 rounded-small"
                                                                  src="../assets/images/user/03.jpg" alt="03">
                                                          </div>
                                                          <div class="media-body ml-3">
                                                              <div class="d-flex align-items-center justify-content-between">
                                                                  <h6 class="mb-0">Kianna Carder</h6>
                                                                  <small class="text-dark"><b>11 : 21 pm</b></small>
                                                              </div>
                                                              <small class="mb-0">Lorem ipsum dolor sit amet</small>
                                                          </div>
                                                      </div>
                                                  </a>
                                              </div>
                                              <a class="right-ic btn btn-primary btn-block position-relative p-2" href="#"
                                                  role="button">
                                                  View All
                                              </a>
                                          </div>
                                      </div>
                                  </div>
                              </li>
                              <li class="nav-item nav-icon dropdown">
                                  <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton"
                                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                          fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                          stroke-linejoin="round" class="feather feather-bell">
                                          <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                          <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                                      </svg>
                                      <span class="bg-primary "></span>
                                  </a>
                                  <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton">
                                      <div class="card shadow-none m-0">
                                          <div class="card-body p-0 ">
                                              <div class="cust-title p-3">
                                                  <div class="d-flex align-items-center justify-content-between">
                                                      <h5 class="mb-0">Notifications</h5>
                                                      <a class="badge badge-primary badge-card" href="#">3</a>
                                                  </div>
                                              </div>
                                              <div class="px-3 pt-0 pb-0 sub-card">
                                                  <a href="#" class="iq-sub-card">
                                                      <div class="media align-items-center cust-card py-3 border-bottom">
                                                          <div class="">
                                                              <img class="avatar-50 rounded-small"
                                                                  src="../assets/images/user/01.jpg" alt="01">
                                                          </div>
                                                          <div class="media-body ml-3">
                                                              <div class="d-flex align-items-center justify-content-between">
                                                                  <h6 class="mb-0">Emma Watson</h6>
                                                                  <small class="text-dark"><b>12 : 47 pm</b></small>
                                                              </div>
                                                              <small class="mb-0">Lorem ipsum dolor sit amet</small>
                                                          </div>
                                                      </div>
                                                  </a>
                                                  <a href="#" class="iq-sub-card">
                                                      <div class="media align-items-center cust-card py-3 border-bottom">
                                                          <div class="">
                                                              <img class="avatar-50 rounded-small"
                                                                  src="../assets/images/user/02.jpg" alt="02">
                                                          </div>
                                                          <div class="media-body ml-3">
                                                              <div class="d-flex align-items-center justify-content-between">
                                                                  <h6 class="mb-0">Ashlynn Franci</h6>
                                                                  <small class="text-dark"><b>11 : 30 pm</b></small>
                                                              </div>
                                                              <small class="mb-0">Lorem ipsum dolor sit amet</small>
                                                          </div>
                                                      </div>
                                                  </a>
                                                  <a href="#" class="iq-sub-card">
                                                      <div class="media align-items-center cust-card py-3">
                                                          <div class="">
                                                              <img class="avatar-50 rounded-small"
                                                                  src="../assets/images/user/03.jpg" alt="03">
                                                          </div>
                                                          <div class="media-body ml-3">
                                                              <div class="d-flex align-items-center justify-content-between">
                                                                  <h6 class="mb-0">Kianna Carder</h6>
                                                                  <small class="text-dark"><b>11 : 21 pm</b></small>
                                                              </div>
                                                              <small class="mb-0">Lorem ipsum dolor sit amet</small>
                                                          </div>
                                                      </div>
                                                  </a>
                                              </div>
                                              <a class="right-ic btn btn-primary btn-block position-relative p-2" href="#"
                                                  role="button">
                                                  View All
                                              </a>
                                          </div>
                                      </div>
                                  </div>
                              </li>
                               <?php
                                // FIXED: Using correct column name and checking if file exists
                                $image = "../assets/images/user/1.png"; // Default image
                                
                                if(!empty($user['profile_photo'])) {
                                    $image_path = "../assets/ownerimage/".$user['profile_photo'];
                                    
                                    if(file_exists($image_path)) {
                                        $image = $image_path;
                                    }
                                }
                                ?>
                              <li class="nav-item nav-icon dropdown caption-content">
                                  <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton4"
                                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <img src="<?php echo $image; ?>" class="img-fluid rounded" alt="user">
                                  </a>
                                  <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton">
                                      <div class="card shadow-none m-0">
                                          <div class="card-body p-0 text-center">
                                              <div class="media-body profile-detail text-center">
                                                  <img src="<?php echo $image; ?>" alt="profile-bg"
                                                      class="rounded-top img-fluid mb-4">
                                                  <img src="<?php echo $image; ?>" alt="profile-img"
                                                      class="rounded profile-img img-fluid avatar-70">
                                              </div>
                                              <div class="p-3">
                                                  <h5 class="mb-1"><?= $full_name ?></h5>
                                                  <p class="mb-0"></p>
                                                  <div class="d-flex align-items-center justify-content-center mt-3">

                                                      <a href="profile.php" class="btn border mr-2">Profile</a>
                                                      <form method="post">
                                                      <button name="signout" class="btn border">Sign Out</button>
                                                    </form>


                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </li>
                          </ul>
                      </div>
                  </div>
              </nav>
          </div>
      </div>
      <div class="modal fade" id="new-order" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                  <div class="modal-body">
                      <div class="popup text-left">
                          <h4 class="mb-3">New Order</h4>
                          <div class="content create-workform bg-body">
                              <div class="pb-3">
                                  <label class="mb-2">Email</label>
                                  <input type="text" class="form-control" placeholder="Enter Name or Email">
                              </div>
                              <div class="col-lg-12 mt-4">
                                  <div class="d-flex flex-wrap align-items-ceter justify-content-center">
                                      <div class="btn btn-primary mr-4" data-dismiss="modal">Cancel</div>
                                      <div class="btn btn-outline-primary" data-dismiss="modal">Create</div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>


            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</html>