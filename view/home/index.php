<?php
//session_start();
if(!isset($_SESSION['emp_code'])){
	header("Location: /home/login");
	exit;

}
$counts = $this->getAllCount();
?>
<!-- Content Header (Page header) -->
 <div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h4 class="m-0 text-dark">Dashboard</h4>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/home/">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
<center>


<div class="row">
   <div class="col-md-3">
      <a href="#" title="Example tile shortcut" class="tile-box tile-box-shortcut btn-danger">
         <span class="bs-badge badge-absolute"><?php echo $counts['emp_count']; ?></span>
         <div class="tile-header">Number of Employees</div>
         <div class="tile-content-wrapper"><i class="fa fa-user fafa-icon-css"></i></div>
      </a>
   </div>
   <div class="col-md-3">
      <a href="#" title="Example tile shortcut" class="tile-box tile-box-shortcut btn-success">
        <span class="bs-badge badge-absolute"><?php echo $counts['certificate_count']; ?></span>
         <div class="tile-header">Number of Certificates</div>
         <div class="tile-content-wrapper"><i class="fa fa-certificate fafa-icon-css"></i></div>
      </a>
   </div>
   <div class="col-md-3">
      <a href="#" title="Example tile shortcut" class="tile-box tile-box-shortcut btn-info">
         <span class="bs-badge badge-absolute">2</span>
         <div class="tile-header">Reviews</div>
         <div class="tile-content-wrapper"><i class="fa fa-address-book fafa-icon-css"></i></div>
      </a>
   </div>
   <div class="col-md-3">
      <a href="#" title="Example tile shortcut" class="tile-box tile-box-shortcut btn-warning">
         <div class="tile-header">Visitors</div>
         <div class="tile-content-wrapper"><i class="fa fa-address-book fafa-icon-css"></i></div>
      </a>
   </div>
</div>








</center>
